<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\PaymentLink;
use App\Models\SettlementHistory;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentService extends Controller
{
	use APICaller, Histories;

    public static function banks()
    {
        return [
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
    }


    public function initiate($request, $user)
	{
        if ($request->type == "link") {
            return $this->generatePaymentLink($request, $user);
        } elseif ($request->type == "ussd") {
            return $this->generateUssd($request, $user);
        } elseif ($request->type == "bank-transfer") {
            return $this->generateBankAccount($request, $user);
        } else {
            // return $this->generateQR($request, $user);
        }
	}


    public function generatePaymentLink($request, $user)
    {
        do {
            $link_reference = Str::random(20);
        } while (Collection::where("link_reference", $link_reference)->first());
        
        $collection = $this->createCollection($user, $request);
        
        $collection->link_reference = $link_reference;
        $collection->save();
        
        if (env('APP_STAGE') == 'production') {
            $word = Str::of($request->description)->words(4);
    
            $message = "Payment request for \n$word \nby CreditMe. \n $collection->short_link";
            
            // $this->sendSms($request->phone_number, $message);
            if ($request->email) {
                try {
                    // Mail::to($request->email)->send(new MailsPaymentLink($paymentLink));
                } catch (Exception $e) {
                    Log::info($e);
                }
            }
        }

        return self::returnSuccess($collection);
    }

    private function apiRequest($request, $collection)
    {
        return [
            "phone"         => isset($request->phone) ? $request->phone : "09099999999" ?? $collection->phone_number,
            "amount"        => $request->amount ?? $collection->amount,
            "description"   => isset($request->description) ? $request->description : "NGN" . $request->amount . " transfer" ?? $collection->description,
            "reference"     => $collection->transaction_reference ?? $request->reference
        ];
    }
    
    private function generateUssd($request, $user)
    {
        if ($request->has('link_reference')) {
            $collection = Collection::where("link_reference", $request->link_reference)->first();
            if (!$collection) return self::returnNotFound("link reference not found");
        } else {
            $collection = $this->createCollection($user, $request);
        }
        
        $apiRequest = $this->apiRequest($request, $collection);
        
        try {
            $apiResponse = self::irechargePost(["irechargeUSSD"], $apiRequest);
    
            if (isset($apiResponse["status"])) {
                if ($apiResponse["status"] !== "00") return self::returnFailed("error initiating a transaction");
                
                $res = self::banks();
                foreach ($apiResponse["data"]["banks"] as $bank) {
                    if ($res[$request->bank_id - 1]['bank'] ==  $bank["bank"]) {
                        $response = $bank;
                    }
                }
                $collection->update([
                    'payment_method'    => $request->type,
                    "transaction_reference" => $request->reference,
                    'bank_name' => $response['bank'],
                    'ussd_code' => $response['code'],
                    'transaction_id'  => $apiResponse["data"]["transaction_id"],
                ]);
                
                $response["transaction_reference"] = $collection->transaction_reference;
                return self::returnSuccess($response);
            }
            return self::returnFailed("an error occured, please try again");
        } catch (Exception $ex) {
            return self::returnSystemFailure("system error");
        }
    }

    private function generateBankAccount($request, $user)
    {
        if ($request->has('link_reference')) {
            $collection = Collection::where("link_reference", $request->link_reference)->first();
            if (!$collection) return self::returnNotFound("Please send a valid transaction id");
        } else {
            $collection = $this->createCollection($user, $request);
        }
        
        $apiRequest = $this->apiRequest($request, $collection);
        
        try {
            $apiResponse = self::irechargePost(["irechargeBank"], $apiRequest);
    
            if (isset($apiResponse["status"])) {
                if ($apiResponse["status"] !== "00") return self::returnFailed("error initiating a transaction");
                
                $collection->update([
                    'payment_method'    => $request->type,
                    "transaction_reference" => $request->reference,
                    'transaction_id'  => $apiResponse["data"]["transaction_id"],
                    'bank_name'       => $apiResponse["data"]["bank"],
                    'account_number'  => $apiResponse["data"]["account_number"],
                    'account_name'    => $apiResponse["data"]["account_name"],
                ]);

                $response = [
                    "transaction_reference" => $collection->transaction_reference,
                    'bank' => $collection->bank_name,
                    'account_number' => $collection->account_number,
                    'transaction_id' => $collection->transaction_id,
                    'account_name' => $collection->account_name,
                ];
                return self::returnSuccess($response);
            }
            return self::returnFailed("an error occured, please try again");
        } catch (Exception $ex) {
            return self::returnSystemFailure("system error");
        }
    }
	
	
	public function verify($transaction_id)
	{
		return self::irechargePost(["irechargeColStatus", "attach"], ["transaction_id" => $transaction_id]);
	}
    
    
    private function createCollection($user, $request) 
    {
        $settlement = $this->getSettlement($user);
        
        $collection = Collection::create([
            'user_id'       => $user->id,
            'phone_number'  => $request->phone_number,
            'email'         => $request->email,
            'collection_method' => $request->type,
            'description'       => $request->description,
            'amount'            => $request->amount,
            'settlement_id'     => $settlement->id,
            'date'              => date('D jS M Y, h:i:sa'),
        ]);
        return $collection;
    }
    
    private function getSettlement($user)
    {
        $todaySettlement = SettlementHistory::where([
                ["user_id", '=', $user->id],
                ["status", '=', 'pending']
            ])->first();
        
            $todaySettlement->total_transactions ++;
            $todaySettlement->update();
        if ($todaySettlement != null) return $todaySettlement;

        $account = $user->business->account;
        $reference = time() . rand(11111, 99999);

        $settlement = SettlementHistory::create([
            "user_id"       => $user->id,
            "account_number"    => $account->account_number,
            "account_name"  => $account->account_name,
            "bank_name"     => $account->bank_name,
            "sort_code"     => $account->sort_code,
            "amount"        => 0,
            "status"        => "pending",
            "commission"    => 0,
            "total_transactions" => 1,
            "transaction_reference" => $reference,
        ]);
        
        return $settlement;
    }
}
