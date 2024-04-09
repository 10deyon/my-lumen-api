<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Services\Histories;
use App\Services\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    use Validations, Histories;

    public function creditWallet(Request $request)
    {
        $user = Auth::user();
        if (!$user) return self::returnNotFound("unauthorized user");

        $validator = Validator::make($request->all(),
            [
                "phone"         => "",
                "description"   => "string",
                "amount"        => "required|numeric",
                "type"          => "required|in:bank-transfer,ussd,link,qr",
                "bank_id"       => "required_if:type,ussd"
            ],
            ["type.in" => "invalid transaction type expected bank-transfer or ussd"]
        );
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());
        
        $wallet = $user->wallet;
        $wallet->balance = (float) $user->wallet->balance + (float)$request->amount;
        $wallet->balance = (float)$request->amount;
        $wallet->update();
        
        return self::returnSuccess("Your wallet has been credited with NGN" . $request->amount);
    }


    public function chargeWallet (Request $request)
    {
        $user = Auth::user();
        if (!$user) return self::returnNotFound("unauthorized user");

        $isError = self::validateRequest($request, self::$debitValidationRule);
        if ($isError)  return self::returnFailed($isError);
        
        $wallet = $user->wallet;
        if ((float) $request->amount > (float)$wallet->balance) return self::returnInsufficient();
        
        $wallet->balance -= (float) $request->amount;
        $wallet->balance_snapshot = (float) $request->amount;
        $wallet->category = "debit";
        $wallet->update();

        return self::returnSuccess('wallet charge successful');
        
    }
    
    
    public function balanceEnquiry()
    {
        $user = Auth::user()->id;
        if (!$user) return self::returnNotFound("unauthorized user");

        $wallet = $user->wallet->balance;
        
        return self::returnSuccess($wallet);
    }


    public function getHistories(Request $request)
    {
        $isErrored =  self::validateRequest($request, self::$GetHistories);   
        if ($isErrored) return self::returnFailed($isErrored);
        
        $history = Wallet::query();
        $response = self::transactionHistories($request, $history);
        $history = $response->latest()->paginate(10);
        return self::returnSuccess($history);
    }
}
