<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Events\TransactionSuccessfulEvent;
use App\Http\Controllers\Controller;
use App\Models\PaymentLink;
use App\Models\Collection;
use App\Models\SettlementHistory;
use App\Models\Transaction;
use App\Services\Histories;
use App\Services\PaymentService;
use App\Traits\Sms;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
{
    use Sms, Histories;
    
    private $payment;
    public function __construct(PaymentService $payment)
    {
        $this->payment = $payment;
    }
    
    public function getBanks()
    {
        return self::returnSuccess($this->payment::banks());
    }
    
    public function initiateCollection(Request $request)
    {
        $user = Auth::User();
        if (!$user) return self::returnNotFound("action forbidden for unauthorised user.");
        
        $validator = Validator::make($request->all(),
            [
                "amount"        => "required_if:type,link|numeric|min:100",
                "email"         => "email",
                "type"          => "required|in:bank-transfer,ussd,link",
                "phone_number"  => "",
                "description"   => "string",
                "bank_id"       => "required_if:type,ussd",
                "reference"     => "string",
            ],
            ["type.in" => "invalid transaction type expected link, QR, bank-transfer or ussd"]
        );
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());
        
        if ($request->type !== 'link') $request->merge(['reference' => date(time() . rand(1111, 9999))]);
        
        return $this->payment->initiate($request, $user);
    }
    

    public function getLinkInfo($reference)
    {
        $collection = Collection::where("link_reference", $reference)->first();
        $name = $collection->user->fullname;
        $collection["merchant_name"] = $name;
        if (!$collection) return self::returnFailed("Transaction not found");

        if ($collection->settled == true) {
            $transaction = Collection::find($collection->transaction_id);
            return self::returnSuccess(collect(["transaction" => $transaction, "amount" => $collection->amount]));
        }

        return self::returnSuccess([
            "transaction" => null, 
            "amount" => $collection->amount, 
            "description" => $collection->description, 
            "merchant_name" => $name
        ]);
    }


    public function getHistories(Request $request)
    {
        $user = Auth::user();
        if (!$user) return self::returnNotFound("action forbidden for unauthorised user.");
        if ($user->type !== "vendor") return self::returnNotFound("vendor record not found");
        
        $validator = Validator::make($request->all(), [
            "start_date"    => isset($request->start_date) ? "date_format:Y-m-d" : "",
            "end_date"      => isset($request->end_date) ? "date_format:Y-m-d" : "",
            "status"        => isset($request->status) ? "in:all,pending,verified" : "",
            "type"          => isset($request->type) ? "in:all,ussd,bank-transfer" : "",
            "settlement_id" => "integer",
        ]);
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());
        
        $history = Collection::query();
        $history->where("user_id", $user->id);
        $response = self::transactionHistories($request, $history);
        $history = $response->latest()->paginate(10);
        return self::returnSuccess($history);
    }

    public function transactionStatus(Request $request)
    {
        $user = Auth::user();
        if (!$user) return self::returnNotFound("action forbidden for unauthorised user.");

        $validator = Validator::make($request->all(), [
            "transaction_reference" => "required|string"
        ]);
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());
        
        $collection = Collection::where([
            ["transaction_reference", '=', $request->transaction_reference], 
            ["user_id", '=', $user->id]
        ])->first();

        if (!$collection) return self::returnNotFound("Transaction record not found");
        if ($collection->verified_at) return self::returnSuccess($collection, "Transaction verified successfully");
        
        try {
            $apiResponse = $this->payment->verify($collection->transaction_id);
            
            if(isset($apiResponse["status"])) {
                if ($apiResponse["status"] === "20") return self::returnNotFound("Transaction Not Found");
                if ($apiResponse["status"] === "21") return self::returnSuccessLater("");
                if ($apiResponse["status"] !== "00") return self::returnFailed("Error, please try again");

                if ($collection->amount < $apiResponse["data"]["amount"]) return self::returnFailed("Amount paid incomplete");
        
                $collection = tap($collection)->update([
                    "settled" => true,
                    "verified_at"   => DB::raw("current_timestamp()"),
                    "payout_amount" =>  $collection->amount - ($user->business->commission_rate / 100 * $collection->amount)
                ]);
                
                if (env('APP_STAGE') == 'production') {
                    try {
                        event(new NotificationEvent($collection));
                        // Mail::to(Auth::user()->email)->send(new TransactionNotification($collection));
                    } catch (Exception $e) {
                        Log::info($e);
                    }
                }
                return self::returnSuccess($collection);
            }
            return self::returnFailed("Verification failed try again");
        } catch (Exception $e) {
            Log::info($e);
            return self::returnSystemFailure("Verification failed try again");
        }
    }
    
    public function completeCallback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "status" => "required",
            "hash" => "required",
        ]);
        
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());
        if ($request->status != "00") return self::returnFailed("Validation failed");

        $collection = Collection::where("transaction_id", $request->data["transaction_id"])->first();
        if (!$collection) return self::returnNotFound("collection not found");
        if ($collection->verified_at) return self::returnSuccess($collection, "collection verified successfully");

        try {
            $apiResponse = $this->payment->verify($collection->transaction_id);
            
            if (isset($apiResponse["status"])) {
                if ($apiResponse["status"] === "20") return self::returnNotFound("Transaction Not Found");
                if ($apiResponse["status"] === "21") return self::returnSuccessLater("processing");
                if ($apiResponse["status"] !== "00") return self::returnFailed("Error, please try again");
        
                if ($collection->amount < $apiResponse["data"]["amount"]) return self::returnFailed("Invalid amount paid");
        
                $user = $collection->user()->first();
                $collection = tap($collection)->update([
                    "settled" => true,
                    "verified_at" => DB::raw("current_timestamp()"),
                    "payout_amount" =>  $collection->amount - ($user->commission_rate / 100 * $collection->amount)
                ]);
        
                if (env('APP_STAGE') == 'production') {
                    try {
                        event(new NotificationEvent($collection));
                        // Mail::to($user->user()->first()->email)->send(new NotificationEvent($collection));
                    } catch (Exception $e) {
                        Log::info($e);
                    }
                    event(new TransactionSuccessfulEvent($collection));
                }

                return self::returnSuccess($collection);
            }
            
            return self::returnFailed("an error occured, please try again");
        } catch (Exception $e) {
            Log::info($e);
            return self::returnSystemFailure("Verification failed try again");
        }
    }
}
