<?php

namespace App\Http\Controllers;

use App\Events\TransactionSuccessfull;
use App\Http\Controllers\Controller;
use App\Mails\TransactionNotification;
use App\Models\PaymentLink;
use App\Models\SettlementHistory;
use App\Models\Transaction;
use App\Traits\APIcalls;
use App\Traits\Sms;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public static $banks = [
        ["id" =>  "1", "bank" =>  "GT Bank"],
        ["id" =>  "2", "bank" =>  "Zenith Bank"],
        ["id" =>  "3", "bank" =>  "UBA"],
        ["id" =>  "4", "bank" =>  "Stanbic IBTC"],
        ["id" =>  "5", "bank" =>  "Sterling Bank"],
        ["id" =>  "6", "bank" =>  "Unity Bank"],
        ["id" =>  "7", "bank" =>  "Keystone Bank"],
        ["id" =>  "8", "bank" =>  "Fidelity Bank"],
        ["id" =>  "9", "bank" =>  "Ecobank"],
        ["id" =>  "10", "bank" =>  "Wema"]
    ];
    
    public function getHistories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "start_date"    => (isset($request->start_date)) ? "date_format:Y-m-d" : "",
            "end_date"      => (isset($request->end_date)) ? "date_format:Y-m-d" : "",
            "settlement_id" => "",
            "status"        => (isset($request->status)) ? "in:all,pending,verified" : "",
            "type"          => (isset($request->type)) ? "in:all,ussd,bank-transfer" : "",
        ]);
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());
        
        $user = Auth::user();
        if (!$user->type == "vendor") return self::returnNotFound("user record not found");

        $history = Transaction::query();
        $history->where("user_id", $user->id);

        $history->when(isset($request->status), function ($query) use ($request) {
            $query->when(($request->status == "pending"), function ($query) {
                $query->where("verified_at", "=", NULL);
            });
            $query->when(($request->status == "verified"), function ($query) {
                $query->where("verified_at", "!=", NULL);
            });
        });
        $history->when(isset($request->start_date), function ($query) use ($request) {
            $query->where("created_at", ">=", $request->start_date . " 00:00:00");
        });
        $history->when(isset($request->type) && ($request->type != "all"), function ($query) use ($request) {
            $query->where("type", "=", $request->type);
        });
        $history->when(isset($request->end_date), function ($query) use ($request) {
            $query->where("created_at", "<=", $request->end_date . " 23:59:59");
        });
        $history->when(isset($request->settlement_id), function ($query) use ($request) {
            $query->where("settlement_id", "=", $request->settlement_id);
        });

        $history = $history->latest()->paginate(20);

        return self::returnSuccess($history);
    }
    
    
    public function initiateTransaction(Request $request)
    {
        $user = Auth::User();
        if (!$user) return self::returnNotFound("action forbidden for unauthorised user.");
        
        $validator = Validator::make(
            $request->all(),
            [
                "phone"         => "",
                "description"   => "",
                "amount"        => "required|integer",
                "type"          => "required|in:bank-transfer,ussd",
                "bank_id"       => "required_if:type,ussd"
            ],
            ["type.in" => "invalid transaction type expected bank-transfer or ussd"]
        );
        
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());
        
        $reference = time() . rand(1111, 9999);
        $apiRequest = [
            "phone"         => isset($request->phone) ? $request->phone : "09099999999",
            "amount"        => $request->amount,
            "description"   => isset($request->description) ? $request->description : "NGN" . $request->amount . " transfer",
            "reference"     => $reference
        ];
        
        try {
            if ($request->type == "ussd") $apiResponse = self::irechargePost(["irechargeUSSD"], $apiRequest);
            
            if ($request->type == "bank-transfer") $apiResponse = self::irechargePost(["irechargeBank"], $apiRequest);
            Log::info($apiResponse);

            if (isset($apiResponse["status"])) {
                if ($apiResponse["status"] !== "00") return self::returnFailed("Error initiating a transaction");
                
                $settlement = $this->getSettlement($user);
                
                $transaction = Transaction::create([
                    "reference"             => $reference,
                    "transaction_id"        => $apiResponse["data"]["transaction_id"],
                    "amount"                => $request->amount,
                    "type"                  => $request->type,
                    "user_id"               => $user->id,
                    "description"           => $request->description,
                    "settlement_id"         => $settlement->id,
                ]);
        
                $response = $apiResponse["data"];
        
                if ($request->type == "ussd") {
                    foreach ($apiResponse["data"]["banks"] as $bank) {
                        if (static::$banks[$request->bank_id - 1]["bank"] ==  $bank["bank"]) {
                            $response = $bank;
                        }
                    }
                }
        
                $response["transaction_reference"] = $transaction->reference;
        
                return self::returnSuccess($response, "successfull");
            }

            return self::returnFailed("an error occured, please try again");
        } catch (Exception $e) {
            Log::info($e);
            return self::returnSystemFailure($e->getMessage());
        }
    }


    private function getSettlement($user)
    {
        $todaySettlement = SettlementHistory::where([
                ["user_id", '=', $user->id],
                ["status", '=', 'pending']
            ])->first();

        Log::info($todaySettlement == null);

        if ($todaySettlement != null) return $todaySettlement;
        Log::info("todaySettlement != null");

        $account = $user->account()->latest()->first();
        $reference = time() . rand(11111, 99999);

        $settlement = SettlementHistory::create([
            "user_id"       => $user->id,
            "reference"     => $reference,
            "account_id"    => $account->id,
            "amount"        => 0,
            "status"        => "pending",
            "commission"    => 0
        ]);

        Log::info($settlement);

        return $settlement;
    }


    public function transactionStatus(Request $request)
    {
        $user = Auth::User();
        if (!$user) return self::returnNotFound("action forbidden for unauthorised user.");

        $validator = Validator::make($request->all(), [
            "reference" => "required"
        ]);
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());
        
        $user = Auth::user()->user->first();
        if (!$user) return self::returnNotFound("user record not found");

        $transaction = Transaction::where([["reference", '=', $request->reference], ["user_id", '=', $user->id]])->first();
        if (!$transaction) return self::returnNotFound("Transaction record not found");

        $transaction->settlement->update([
            "amount" => $transaction->settlement->amount + $transaction->payout_amount
        ]);

        $userName = $transaction->user()->first();
        $profile = $userName->profile()->first();

        $transaction->user_profile = $profile;

        if ($transaction->verified_at) return self::returnSuccess($transaction, "Transaction verified successfully");

        try {
            $apiResponse = self::irechargePost(["irechargeStatus", "attach"], $transaction->transaction_id);
            Log::info($apiResponse);
        } catch (Exception $e) {
            Log::info($e);
            return self::returnSystemFailure("Verification failed try again");
        }

        if ($apiResponse["status"] === "20") return self::returnNotFound("Transaction Not Found");
        if ($apiResponse["status"] === "21") return self::returnSuccessLater("Transaction is Pending");
        if ($apiResponse["status"] !== "00") return self::returnFailed("Error, please try again");
        if ($transaction->amount < $apiResponse["data"]["amount"]) return self::returnFailed("Amount paid incomplete");

        $transaction->update([
            "verified_at"   => DB::raw("current_timestamp()"),
            "payout_amount" =>  $transaction->amount - ($user->commission_rate / 100 * $transaction->amount)
        ]);

        $transaction = Transaction::find($transaction->id);

        try {
            // Mail::to(Auth::user()->email)->send(new TransactionNotification($transaction));
        } catch (Exception $e) {
            Log::info($e);
        }

        return self::returnSuccess($transaction, "Transaction was successful");
    }


    public function getBanks()
    {
        return self::returnSuccess(static::$banks, "Banks loaded successfully");
    }


    public function completeCallback(Request $request)
    {
        Log::info($request);
        $validator = Validator::make($request->all(), [
            "status" => "required",
            "hash" => "required",
        ]);

        if ($validator->fails()) return self::returnFailed($validator->errors()->first());
        if ($request->status != "00") return self::returnFailed("Validation failed");

        $transaction = Transaction::where("transaction_id", $request->data["transaction_id"])->first();

        if (!$transaction) return self::returnNotFound("Transaction not found");

        if ($transaction->verified_at) return self::returnSuccess($transaction, "Transaction verified successfully");

        try {
            $apiResponse = self::irechargePost(["irechargeStatus", "attach"], $transaction->transaction_id);
            Log::info(json_encode($apiResponse));
        } catch (Exception $e) {
            Log::info($e);
            return self::returnSystemFailure("Verification failed try again");
        }

        if ($apiResponse["status"] === "20") return self::returnNotFound("Transaction Not Found");
        if ($apiResponse["status"] === "21") return self::returnSuccessLater("Transaction is Pending");
        if ($apiResponse["status"] !== "00") return self::returnFailed("Error, please try again");

        if ($transaction->amount < $apiResponse["data"]["amount"]) return self::returnFailed("Amount paid incomplete");

        $user = $transaction->user()->first();

        $transaction->update([
            "verified_at" => DB::raw("current_timestamp()"),
            "payout_amount" =>  $transaction->amount - ($user->commission_rate / 100 * $transaction->amount)
        ]);

        $transaction = Transaction::find($transaction->id);
        try {
            // Mail::to($user->user()->first()->email)->send(new TransactionNotification($transaction));
        } catch (Exception $e) {
            Log::info($e);
        }

        // event(new TransactionSuccessfull($transaction));

        //check if transaction has links
        $paymentLink = PaymentLink::where("transaction_id", $transaction->id)->first();

        if ($paymentLink) {
            $paymentLink->paid = true;
            $paymentLink->save();
        }

        return self::returnSuccess($transaction, "Successfull");
    }
}
