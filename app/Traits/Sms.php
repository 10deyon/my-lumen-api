<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Sms {

    private function sendSms($number,$message)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env("IRECHARGE_SMS_URL"),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => json_encode([
                "phone" => $number,
                "message" => $message,
                "access_code" => env("IRECHARGE_SMS_TOKEN")
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        Log::info($response);
    }

    private function otpMessage($otp)
    {
        return "*DO NOT DISCLOSE*\n".
        "Your verification code is: {$otp}.\n".
        "Please ignore this message if you did not request for it.";
    }
}
