<?php

namespace App\Jobs;

use App\Events\NotificationEvent;
use App\Models\AirtimeTransaction;
use App\Models\DataTransaction;
use App\Traits\APIcalls;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class ProcessTransactionJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels, APIcalls;
    
    private $group_id, $service;
    
    public function __construct(Request $request, $service)
    {
        $this->group_id = $request->get('group_id');
        $this->service = $service;
    }
    
    public function handle()
    {
        Log::info($this->service);
        if ($this->service == 'airtime') {
            $this->processAirtime();
        } else {
            $this->processData();
        }
    }
    
    private function processData() 
    {
        $transactions = DataTransaction::where('group_id', $this->group_id)->get();
        
        foreach ($transactions as $data) {
            $requestTime = Carbon::now();
            
            if($data->status === 'fulfilled' ) continue;
		    $combined_string = env("IRECHARGE_VENDOR_ID")."|".$data->transaction_id."|".$data->phone_number."|".$data->provider."|".$data->dataBundle->code."|".env("IRECHARGE_PUB_KEY");
            
            $params = [
                "vendor_code"		=> env('IRECHARGE_VENDOR_ID'),
                "email"				=> env("ORG_MAIL"),
                "reference_id"		=> $data->transaction_id,
                "vtu_number"		=> $data->phone_number,
                "response_format"   => "json",
                "hash"              => self::hashString($combined_string, env("IRECHARGE_PRIV_KEY")),
                "vtu_data"          => $data->dataBundle->code,
                "vtu_network"       => $data->dataBundle->provider->name,
            ];
            
            Log::info("\nIRECHARGE PAYLOAD REQUESTT \n" . json_encode($params));            
    
            $apiVendResponse = self::get(["irechargeVendData"], $params);
            Log::info("\n\nRESPONSE FROM 3RD PARTY on vend");
            Log::info(json_encode($apiVendResponse));
            
            if (isset($apiVendResponse->status)) {
                
                $update = DataTransaction::where('transaction_id', $data->transaction_id)->first();

                if ($apiVendResponse->status != "00") {
                    $update->status = 'failed';
                    $update->update();
                    continue;
                }

                // if ($apiVendResponse->status == "02") {
                //     continue;
                // }

                $status = $apiVendResponse->status == "00" ? "fulfilled" : "pending";
                
                $update->api_vend_request   = json_encode($params);
                $update->api_vend_response  = json_encode($apiVendResponse);
                $update->status             = $status;
                $update->request_time       = $requestTime;
                $update->response_time      = Carbon::now();
                $update->update();

                Log::info(json_encode($update));
                event(new NotificationEvent($update->transaction_id, $update));
            }
        }
    }
    
    
    private function processAirtime()
    {
        Log::info("\n\nVENDING AIRTIME METHOD CALLED");

        $transactions = AirtimeTransaction::where('group_id', $this->group_id)->get();
        
        foreach ($transactions as $data) {
            $requestTime = Carbon::now();
            
            $combined_string = env("IRECHARGE_VENDOR_ID")."|".$data->transaction_id ."|".$data->phone_number."|".$data->provider."|".$data->amount."|".env("IRECHARGE_PUB_KEY");
            if($data->status === 'fulfilled' ) continue;
            
            $params = [
                "vendor_code"       => env('IRECHARGE_VENDOR_ID'),
                "vtu_email"         => env("ORG_MAIL"),
                "response_format"   => "json",
                "vtu_number"        => $data->phone_number,
                "reference_id"      => $data->transaction_id,
                "hash"              => self::hashString($combined_string, env("IRECHARGE_PRIV_KEY")),
                "vtu_network"       => $data->provider,
                "vtu_amount"        => $data->amount,
            ];

            Log::info("\nIRECHARGE PAYLOAD REQUESTT \n" . json_encode($params));            
    
            $apiVendResponse = self::get(["irechargeVendAirtime"], $params);
            Log::info("\n\nRESPONSE FROM 3RD PARTY on vend");
            Log::info(json_encode($apiVendResponse));
            
            if (isset($apiVendResponse->status)) {                
                $update = AirtimeTransaction::where('transaction_id', $data->transaction_id)->first();
                
                if ($apiVendResponse->status != "00") {
                    $update->status = 'failed';
                    $update->update();
                    continue;
                }

                $status = $apiVendResponse->status == "00" ? "fulfilled" : "pending";
                
                $newTransaction = $update->update([
                    "api_vend_request"   => json_encode($params),
                    "api_vend_response"  => json_encode($apiVendResponse),
                    "status"             => $status,
                    "request_time"       => $requestTime,
                    "response_time"      => Carbon::now(),
                ]);
                
                // Log::info(json_encode($update));
                // Log::info(json_encode($newTransaction));
                event(new NotificationEvent($update->transaction_id, $update));
            }
        }
    }
}
