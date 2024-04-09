<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

trait APICaller
{
    public static $urlSet, $irechargeBaseUrl, $paystackUrl, $paystackKey, $irechargeCollectionUrl;

    public static function urlRequest()
    {
        APICaller::$irechargeBaseUrl = env('IRECHARGE_BASE_URL');
        APICaller::$irechargeCollectionUrl = env('IRECHARGE_COLLECTION_URL');
        APICaller::$paystackUrl = env('PAYSTACK_BASE_URL');
        APICaller::$paystackKey = env('PAYSTACK_KEY');

        (Array) APICaller::$urlSet = [
            "irechargeDataBundles"  => APICaller::$irechargeBaseUrl . "get_data_bundles.php?",
            "irechargeVendData"     => APICaller::$irechargeBaseUrl . "vend_data.php?",
            "irechargeVerifySmile"  => APICaller::$irechargeBaseUrl . "get_smile_info.php?",
            "irechargeVendAirtime"  => APICaller::$irechargeBaseUrl . "vend_airtime.php?",
            "irechargePowerDisco"   => APICaller::$irechargeBaseUrl . "get_electric_disco.php?",
            "irechargeVerifyMeter"  => APICaller::$irechargeBaseUrl . "get_meter_info.php?",
            "irechargeVendPower"    => APICaller::$irechargeBaseUrl . "vend_power.php?",
            "irechargeTvBouquets"   => APICaller::$irechargeBaseUrl . "get_tv_bouquet.php?",
            "irechargeVerifyCard"   => APICaller::$irechargeBaseUrl . "get_smartcard_info.php?",
            "irechargeVendTv"       => APICaller::$irechargeBaseUrl . "vend_tv.php?",
            "irechargeStatus"       => APICaller::$irechargeBaseUrl . "status",

            "verify_account"        => "/bank/resolve?",
            "irechargeColStatus"    => APICaller::$irechargeCollectionUrl . "status",
            "irechargeUSSD"         => APICaller::$irechargeCollectionUrl . "generate/ussd",
            "irechargeBank"         => APICaller::$irechargeCollectionUrl . "generate/bank",
        ];
    }
    
    public static function remove_utf8_bom($text) {
        $bom = pack('H*', 'EFBBBF');
        $text = preg_replace("/^$bom/", '', $text);
        return $text;
    }

    public static function hashString($string_to_hash, $privateKey) {
        $hashed = hash_hmac("sha1", $string_to_hash,  $privateKey);
        Log::info("\n\nHASHED FOR API: " . $hashed);
        return $hashed;
    }

    public static function setUrlParameters(String $url, array $obj): String {
        foreach ($obj as $key => $value) {
            $url = $url . "$key=$value&";
        }
        return substr($url, 0, (strlen($url) - 1));
    }
    
    public static function validate_passcode($passcode, $string_to_hash) {
        $expected = hash_hmac("sha512", $string_to_hash,  env('PASSKEY'));
        Log::info("\n\nCOMPARE PASSKEY AND MANUAL HASH KEY FROM FRONT END \n" . "PASSKEY: " . $passcode . "\nGENHASH: " . $expected);
        if ($passcode != $expected) {
            return false;
        }
        return true;
    }
    
    public static function get($urlArray = [], $append = [])
    {
        APICaller::urlRequest();
        
        $url = APICaller::$irechargeBaseUrl . APICaller::$urlSet[$urlArray[0]];
        
        $url = APICaller::setUrlParameters($url, $append);
        
        Log::info("\n\nIRECHARGE URL: " . $url);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        }

        $data = self::remove_utf8_bom($response);
        Log::info(json_encode($data));
        return json_decode($data, false);
    }

    public static function irechargePost($urlParams, $data)
    {
        self::urlRequest();
        
        $url = APICaller::$urlSet[$urlParams[0]];
        Log::info($url);
        
        $apitoken = APICaller::generateIrechargeToken();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $apitoken,
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        Log::info($response);
        Log::info($err);

        curl_close($curl);

        if ($err) throw new Exception("failed to generate please try again");
        
        return json_decode($response, true);
    }

    public static function generateIrechargeToken()
    {
        if (Cache::has('token')) return Cache::get("token");
        
        $data = [
            "priv_key" => env('IRECHARGE_COLLECTION_PRIV_KEY'),
            "pub_key" => env('IRECHARGE_COLLECTION_PUB_KEY'), 
            "vendor_id"=> env('IRECHARGE_COLLECTION_VENDOR_ID')
        ];
        
        $url = env('IRECHARGE_COLLECTION_URL_MAIN');
        Log::info($url."/auth/token");

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$url}/auth/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);

        if ($err) throw new Exception("failed to generate");

        $response = json_decode($response, false);
                
        Cache::put('token', $response->token->token, 60*60);
        
        return $response->token->token;
    }


    /**
     * Method to make a get request to flutter wave to verify payment
     *
     * @param  array  $urlAddress, @param string $name
     * @return object
     */
    public static function verify_payment($payload)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) return "Error #:" . $err;
        
        $data = self::remove_utf8_bom($response);

        return json_decode($data);
    }


    public static function getPaystack($urlParams, array $payload = null) 
    {
        APICaller::urlRequest();
        
        $url = APICaller::$paystackUrl . APICaller::$urlSet[$urlParams[0]];
        
        if ($payload != null) {
            $accountNo = $payload[0];
            $bankCode = $payload[1];
            
            $url = $url . "account_number=$accountNo&bank_code=$bankCode";
        }
                
        Log::info("\n\nTHIRD PARTY URL: " . $url);
        
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
                "Authorization: Bearer " . env('PAYSTACK_SECRET_KEY'),
            ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if($err){
            return $err;
        }
        
        return json_decode($response);
    }
}
