<?php

namespace App\Services;

class UssdService
{
	use APICaller, Histories;

	public function initiate($request)
	{
		$apiRequest = [
            "phone"         => isset($request->phone) ? $request->phone : "09099999999",
            "amount"        => $request->amount,
            "description"   => isset($request->description) ? $request->description : "NGN" . $request->amount . " transfer",
            "reference"     => $request->reference
        ];

		if ($request->type == "ussd") return self::irechargePost(["irechargeUSSD"], $apiRequest);
		if ($request->type == "bank-transfer") return self::irechargePost(["irechargeBank"], $apiRequest); 
	}
	
	
	public function verify($transaction_id)
	{
		return self::irechargePost(["irechargeColStatus", "attach"], ["transaction_id" => $transaction_id]);
	}
}
