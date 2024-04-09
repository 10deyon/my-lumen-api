<?php

namespace App\Http\Controllers;

use App\Models\DataBundle;
use App\Models\DataProvider;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public static $dataToStore, $bundles = [];
    
    public function transactionStatus($service, $token)
	{
		$combined_string = env("IRECHARGE_VENDOR_ID")."|".$token."|".env("IRECHARGE_PUB_KEY");
		$hash = self::hashString($combined_string, env("IRECHARGE_PRIV_KEY"));
		
		$params = [
			"vendor_code"		=> env('IRECHARGE_VENDOR_ID'),
			"type"				=> $service,
			"access_token"		=> $token,
			"hash"				=> $hash,
			"response_format"   => "json",
		];
		try {
			$response = self::get(["irechargeStatus"], $params);
			Log::info("\n\nRESPONSE FROM 3RD PARTY to check transaction status");
			Log::info(json_encode($response));
		} catch (Exception $e) {
			return self::returnFailed($e->getMessage());
			Log::info($e);
		}

		if ($response != null) {
			if (isset($response->vend_code)) {
				if ($response->vend_code !== "00") return self::returnFailed("oops! invalid access token provided");

				return self::returnSuccess(["status" => $response->vend_status]);
			}
		}

		Log::error("\n\nERROR ON QUERYING TRANSACTION STATUS");
		return self::returnFailed("sorry, service currently unavailable");
	}

    
    public function fetchProviders($service)
	{
        switch(strtoupper($service)) {
			case "DATA":
				$model = new DataProvider();
				break;
            default:
				return self::returnFailed("Provide a valid provider name");
				break;
		}
        
        try {
            if ($service === "data") {
                $providers = json_decode(json_encode([
                    "bundles" => [
                        [
                            "code" => "Airtel",
                            "minimum_value" => "50",
                            "maximum_value" => "5000",
                            "service_charge" => 100,
                            "commission"    => 3/100
                        ], 
                        [
                            "code" => "MTN",
                            "minimum_value" => "50",
                            "maximum_value" => "5000",
                            "service_charge" => 100,
                            "commission"    => 3/100
                        ],  
                        [
                            "code" => "Etisalat",
                            "minimum_value" => "50",
                            "maximum_value" => "5000",
                            "service_charge" => 100,
                            "commission"    => 3.5/100
                        ],
                        [
                            "code" => "Glo",
                            "minimum_value" => "50",
                            "maximum_value" => "5000",
                            "service_charge" => 100,
                            "commission"    => 4/100
                        ],
                        [
                            "code" => "Smile",
                            "minimum_value" => "50",
                            "maximum_value" => "5000",
                            "service_charge" => 100,
                            "commission"    => 1.5/100
                        ],
                        [
                            "code" => "Spectranet",
                            "minimum_value" => "50",
                            "maximum_value" => "5000",
                            "service_charge" => 100,
                            "commission"    => 2/100
                        ], 
                    ]
                ]));
            }
        } catch (Exception $e) {
            Log::error($e);
            return  ["status" => "02", "message" => $e->getMessage()];
        }

        self::$dataToStore = [];
        collect($providers->bundles)->each(function ($provider) {
            $storeProvider = [
                "name"          => $provider->code,
                "min_vend"      => $provider->minimum_value,
                "max_vend"      => $provider->maximum_value,
                "service_charge" => $provider->service_charge ?? 100,
                "commission"    => $provider->commission ?? 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ];
            array_push(self::$dataToStore, $storeProvider);    
        });
        
        $model::truncate();
        $model::insert(self::$dataToStore);
        
        return self::returnSuccess();
    }


    public function fetchBundles($provider)
    {
        $provider = strtolower($provider);

        if($provider == 'mtn'|| $provider == 'gotv'|| $provider == "dstv") {
            $append_to_URL = strtoupper($provider);
        } elseif ($provider == 'startimes') {
            $append_to_URL = "StarTimes";
        } else {
            $append_to_URL = ucfirst($provider);
        }
        
        try {
            $existingProviders = DataProvider::where('name', $provider)->first();
            $bundleModel = new DataBundle();
            $data = self::get(["irechargeDataBundles"], ["response_format" => "json", "data_network" => $append_to_URL]);
            Log::info("\n\nDISCO LIST");
            Log::info(json_encode($data));
        } catch (Exception $e) {
            Log::error($e);
            return  ["status" => "02", "message" => $e->getMessage()];
        }
        
        if (isset($data->bundles)){
            collect($data->bundles)->each(function ($data, $key){
                array_push(self::$bundles, $data);
            });
        }

        if ($data != null) {
            if (isset($data->status)) {
                if ($data->status === "00") {
                    self::$dataToStore = [];
                    collect(self::$bundles)->each(function ($data) use ($existingProviders) {
                        $data = [
                            "name"          => $data->title,
                            "price"         => $data->price,
                            "code"          => $data->code,
                            "provider_id"   => $existingProviders->id,
                            "created_at"    => Carbon::now(),
                            "updated_at"    => Carbon::now(),
                        ];

                        array_push(self::$dataToStore, $data);
                    });
                    
                    $existingBundles = $bundleModel::where('id', '>', 0)->get(["name", "price", "code", "provider_id", "created_at", "updated_at"]);
            
                    $existingBundles->each(function ($data) {
                        $item = [
                            "name"          => $data->name,
                            "price"         => $data->price,
                            "code"          => $data->code,
                            "provider_id"   => $data->provider_id,
                            "created_at"    => $data->created_at,
                            "updated_at"    => $data->updated_at,
                        ];
                        array_push(self::$dataToStore, $item);
                    });
            
                    $bundleModel::truncate();
                    $bundleModel::insert(self::$dataToStore);
                    
                    return self::returnSuccess(strtoupper($existingProviders->name) . " bundles fetched successfully");
                }
            }
        }

        return self::returnFailed('service currently unavailable');
    }
}
