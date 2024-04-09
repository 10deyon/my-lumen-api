<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait Validations
{
	public static $errorArray;

	public static $WalletValidationRule = [
		[
			"user_id"	=> "required|int",
			"user_type"	=> "required|string",
			"balance"	=> "required|numeric"
		]
	];

	public static $UpdateVariationValidationRule = [
		[
			"id"					=> "integer",
			"name"					=> "string",
			"type"					=> "string",
			"third_party_service"	=> "string",
			"status"				=> "string|in:down,up"
		]
	];

	public static $creditValidationRule = [
		[
			"amount"	=> "required|numeric",
			"remarks"	=> "string"
		]
	];

	public static $debitValidationRule = [
		[
			"amount"		=> "required|numeric",
			"remarks"		=> "string",
			"transaction_id" => "string",
		]
	];

	public static $AirtimeValidation = [
		[
			'data'  => 'required|array|min:1',
			'data.*.phone_number'   => "required|regex:/(0)[0-9]/|not_regex:/[a-z]/|distinct|min:11",
			'data.*.network'        => "required|string|min:1",
			'data.*.amount'        => "required|integer|distinct|min:1",
			// "data.*.passcode"       => 'required|string',
			'phone_no'		=> "regex:/(0)[0-9]/|not_regex:/[a-z]/|min:11",
		]
	];

	public static $VendValidation = [
		[
			'group_id'		=> 'required|integer',
			'payment_ref'	=> 'required',
			'payment_type'		=> "required|string|in:bank-transfer,ussd,wallet,card,voucher",
			// 'passcode'		=> 'required|string'
		],
		[
			'platform.in' => "invalid platform type, expected any of mobile,web,USSD,POS,whatsapp,desktop,API",
		]
	];

	public static $DataValidation = [
		[
			'data'					=> 'required|array|min:1',
			"data.*.phone_number"	=> "required|regex:/(0)[0-9]/|not_regex:/[a-z]/|distinct|min:11",
			"data.*.bundle_id"		=> "required|integer",
			"data.*.provider"        => "required|string",
			// 'passcode' 			=> 'required|string',
			'payment_method'		=> 'required|string',
			'phone_no'		=> "required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:11",
		],
	];

	public static $GetHistories = [
		[
			"start_date"	=> "date_format:Y-m-d" ?? "",
			"end_date"		=> "date_format:Y-m-d" ?? "",
			"status"		=> "in:all,fulfilled,incomplete" ?? "",
			"amount"		=> "numeric" ?? "",
			"phone_number"	=> "string",
			"payment_method" => "string",
			"card_number"	=> "string",
			"payment_ref"	=> "string",
			"transaction_id"	=> "string",
		],
	];
	
	private static function formatError($errorArray)
	{
		self::$errorArray = collect($errorArray);
		$newErrorFormat = self::$errorArray->map(function ($error) {
			return $error[0];
		});
		return $newErrorFormat;
	}
	
	public static function validateRequest(Request $request, array $validationRule)
	{
		$validation = Validator::make($request->all(), $validationRule[0], $validationRule[1] ?? []);

		if ($validation->fails()) return self::formatError($validation->errors());
		return false;
	}
}
