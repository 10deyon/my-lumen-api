<?php

namespace App\Services;

trait ResponseFormats
{
	public static $statusCodes = [
		"000" => ["type" => "data", "status" => "OK", "code" => "000", "message" => "Sorry, you have already registered"],
		"00000" => ["type" => "data", "status" => "OK", "code" => "0000", "message" => "Sorry, your account needs to be verified"],
		
		"0000" => ["type" => "data", "status" => "OK",  "code" => "00", "message" => "successful"],
		"0001" => ["type" => "data", "status" => "OK",  "code" => "01", "message" => "successful, will be processed later"],
		"0002" => ["type" => "error", "status" => "FAIL",  "code" => "02", "message" => "request failed"],
		"0003" => ["type" => "error", "status" => "FAIL",  "code" => "03", "message" => "too many requests"],
		"0004" => ["type" => "error", "status" => "FAIL",  "code" => "04", "message" => "unknown request"],
		"0005" => ["type" => "error", "status" => "FAIL",  "code" => "05", "message" => "record not found"],
		"0006" => ["type" => "error", "status" => "FAIL",  "code" => "06", "message" => "provider failure"],
		"0007" => ["type" => "error", "status" => "FAIL",  "code" => "07", "message" => "invalid username or password"],
		"0008" => ["type" => "error", "status" => "DENIED",  "code" => "08", "message" => "invalid access key or credential"],
		"0009" => ["type" => "error", "status" => "DENIED",  "code" => "09", "message" => "request not permitted"],
		"0051" => ["type" => "error", "status" => "FAILED",  "code" => "51", "message" => "insufficient balance"],
		"0098" => ["type" => "error", "status" => "DENIED",  "code" => "98", "message" => "service unavailable"],
		"0099" => ["type" => "error", "status" => "DENIED",  "code" => "99", "message" => "system failure"],
	];

	public static function formatResponse(array $status, $data = null, $message = null) {
		$response = [
			"status" => $status["status"],
			"code" => $status["code"],
			"message" => $message ?? $status["message"]
		];
		if ($data) $response[$status["type"]] = $data;
		return $response;
	}

	/**
	 * @param Array_Object $data	The data to be sent with the response
	*/
	public static function returnSuccess($data = null) {
		return response()->json(self::formatResponse(self::$statusCodes["0000"], $data, $data == null ? 'Successfull' : null), 200);
	}

	/**
	 * @param Array_Object $data	The data to be sent with the response
	*/
	public static function returnSuccessLater($data) {
		return response()->json(self::formatResponse(self::$statusCodes["0001"], $data), 200);
	}

	/**
	 * @param Optional_String $message	The custom message to be sent with the response
	 * To return default text, call the method without the message parameter
	*/
	public static function returnFailed($message = null) {
		return response()->json(ResponseFormats::formatResponse(ResponseFormats::$statusCodes["0002"], null, $message), 200);
	}

	/**
	 * @param Array_Object $data	The data to be sent with the response
	*/
	public static function returnTooMany($data) {
		return response()->json(ResponseFormats::formatResponse(ResponseFormats::$statusCodes["0003"], $data), 200);
	}

	/**
	 * @param Array_Object $data	The data to be sent with the response
	*/
	public static function returnUnkown($data = null) {
		return response()->json(ResponseFormats::formatResponse(ResponseFormats::$statusCodes["0004"], $data), 200);
	}

	/**
	 * @param Optional_String $message	The custom message to be sent with the response
	 * To return default text, call the method without the message parameter
	*/
	public static function returnNotFound($message = null) {
		return response()->json(ResponseFormats::formatResponse(ResponseFormats::$statusCodes["0005"], null, $message), 200);
	}

	/**
	 * @param Optional_String $message	The custom message to be sent with the response.	 
	 * To return default text, call the method without the message parameter
	*/
	public static function returnProviderFailed($message = null) {
		return response()->json(ResponseFormats::formatResponse(ResponseFormats::$statusCodes["0006"], null, $message), 200);
	}

	public static function returnInvalidUsernamePassword($data = null) {
		return response()->json(ResponseFormats::formatResponse(ResponseFormats::$statusCodes["0007"], $data), 200);
	}
	public static function returnInvalidAccessKey($data = null) {
		return response()->json(ResponseFormats::formatResponse(ResponseFormats::$statusCodes["0008"], $data), 200);
	}
	public static function returnNotPermitted($data = null) {
		return response()->json(ResponseFormats::formatResponse(ResponseFormats::$statusCodes["0009"], $data), 200);
	}
	public static function returnInsufficient($data = null) {
		return response()->json(ResponseFormats::formatResponse(ResponseFormats::$statusCodes["0051"], $data), 200);
	}
	public static function returnServiceDown($data = null) {
		return response()->json(ResponseFormats::formatResponse(ResponseFormats::$statusCodes["0098"], $data), 200);
	}
	public static function returnSystemFailure($data = null) {
		return response()->json(ResponseFormats::formatResponse(ResponseFormats::$statusCodes["0099"], $data), 200);
	}

	public static function returnAlreadyRegistered($data = null) {
		return response()->json(self::formatResponse(self::$statusCodes["000"], $data, $data == null ? 'Sorry, you have already registered' : null), 200);
	}
	public static function returnVerifyAccount($data = null) {
		return response()->json(self::formatResponse(self::$statusCodes["00000"], $data, $data == null ? 'Sorry, your account needs to be verified' : null), 200);
	}
}
