<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTransactionJob;
use App\Models\DataBundle;
use App\Models\DataProvider;
use App\Models\DataTransaction;
use App\Models\DataTransactionGroup;
use App\Models\TransactionGroup;
use App\Services\Histories;
use App\Services\Validations;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DataController extends Controller
{
    use Validations, Histories;
    
    public function getProviders()
    {
        $providers = DataProvider::all();

        if ($providers == null) {
            return self::returnNotFound();
        }
        return self::returnSuccess($providers);
    }


    public function getBundles($network)
    {
        $provider = DataProvider::where('name', $network)->first();

        if ($provider != null) {
            $bundles = $provider->dataBundles;
            if (count($bundles) > 0) {
                return self::returnSuccess($bundles);
            }
            return self::returnNotFound("no bundles for this provider, try again");
        }

        return self::returnNotFound("Please provide valid provider name");
    }


    private function update($values, $groupId)
    {
        $transaction = TransactionGroup::find($groupId);

        collect($values)->each(function ($value, $key) use ($transaction) {
            $transaction->$key = $value;
        });

        $transaction->update();
    }

    public function createUserTransaction(Request $request)
    {
        $user = Auth::user();

        if (!$user) return self::returnNotFound("user not found");

        // if (!(self::validate_passcode($request->passcode, $request->phone_number))) return self::returnFailed("invalid passcode");

        $response = $this->create($request, $user);
        return self::returnSuccess($response);
    }


    public function purchaseUserTransaction(Request $request)
    {
        $user = Auth::user();

        if (!$user) return self::returnNotFound("user not found");

        // if (!(self::validate_passcode($request->passcode, $request->phone_number))) return self::returnFailed("invalid passcode");

        $response = $this->purchase($request, $user);

        return self::returnSuccess($response);
    }

    private function validateInput($request)
    {
        if (!(self::validate_passcode($request->passcode, $request->phone_number))) return false;
    }

    public function create(Request $request, $user = null)
    {
        $request_time = date('D jS M Y, h:i:sA');

        $isErrored =  self::validateRequest($request, self::$DataValidation);
        if ($isErrored) return self::returnFailed($isErrored);

        // if ($user == null) {
        //     if(!(self::validate_passcode($request->passcode, $request->phone_number))) return self::returnFailed("invalid passcode");
        // }

        $amount = [];
        $payload = [];

        foreach ($request->data as $item) {
            $bundle = DataBundle::find($item['bundle_id']);
            array_push($amount, (float) $bundle->price);
        }

        if (strtolower($bundle->provider->name) == "smile") {
            $combined_string = env("IRECHARGE_VENDOR_ID") . "|" . $request->phone_number . "|" . env("IRECHARGE_PUB_KEY");

            $response = $this->verifySmile($request->phone_number, $combined_string);

            if (isset($response->status)) {
                if ($response->status != "00") return self::returnFailed("error occured while verifying smile info");
            } else {
                Log::error("\n\nERROR VERIFYING SMILE");
                Log::error("METHOD NAME: `verifySmile()`");
                return self::returnFailed("sorry, service currently unavailable");
            }
        }

        $grouped = new TransactionGroup([
            "ip"                => $_SERVER['REMOTE_ADDR'],
            "service_name"      => 'Data',
            "user_id"           => $user->id ?? false,
            "total_amount"      => array_sum($amount),
            "payment_method"    => $request->payment_method,
            "item_number"       => count($request->data),
            "customer_phone"    => $request->phone_no,
        ]);
        $grouped->save();

        foreach ($request->data as $item) {
            array_push($payload, [
                "phone_number"      => $item['phone_number'],
                "bundle_id"         => $item['bundle_id'],
                "provider"          => $item['provider'] == 'mtn' ? strtoupper($item['provider']) : ucfirst($item['provider']),
                "transaction_id"    => date(time() * rand(11, 99)),
                "response_time"     => date('D jS M Y, h:i:sA'),
                "request_time"      => $request_time,
                'group_id'          => $grouped->id,
                "created_at"        => Carbon::now(),
                "updated_at"        => Carbon::now(),
            ]);
        }

        DataTransaction::insert($payload);

        $response = DataTransactionGroup::with('transactions')
            ->where('id', $grouped->id)
            ->first();

        $grouped->client_request = json_encode($request->all());
        $grouped->client_response = json_encode($response);
        $grouped->update();

        if ($user != null) {
            return $response;
        } else {
            return self::returnSuccess($response);
        }
    }



    public function purchase(Request $request, $user = null)
    {
        $isErrored = self::validateRequest($request, self::$VendValidation);
        if ($isErrored) return self::returnFailed($isErrored);

        // if ($user == null) {
        //     if(!(self::validate_passcode($request->passcode, $request->phone_number))) return self::returnFailed("invalid passcode");
        // }

        $transaction = DataTransaction::where("group_id", $request->group_id)->get();
        if ($transaction == null) return self::returnNotFound("transaction does not exist");

        $date = Carbon::now()->addSeconds(5);
        Queue::later($date, new ProcessTransactionJob($request, 'data'));

        // $response = DataTransaction::where('group_id', $request->group_id)->with('dataGroup')->get();
        $response = DataTransactionGroup::with('transactions')
            ->where('id', $request->group_id)
            ->first();

        $updateData = [
            "payment_ref"           => $request->payment_ref,
            "client_vend_request"   => json_encode($request->all()),
            "client_vend_response"  => json_encode($response),
        ];

        $this->update($updateData, $request->group_id);

        if ($user != null) {
            return $response;
        } else {
            return self::returnSuccessLater($response);
        }
    }


    private function verifySmile($phone, $combined_string)
    {

        $hash = self::hashString($combined_string, env("IRECHARGE_PRIV_KEY"));

        $smileParams = [
            "vendor_code"        => env('IRECHARGE_VENDOR_ID'),
            "receiver"            => $phone,
            "hash"                => $hash,
            "response_format"   => "json",
        ];

        try {
            $apiVerifySmile = self::get(["irechargeVerifySmile"], $smileParams);
            Log::info("\n\nRESPONSE FROM 3RD PARTY on vend");
            Log::info(json_encode($apiVerifySmile));
        } catch (Exception $e) {
            Log::error($e);
            return self::returnFailed($e->getMessage());
        }

        return $apiVerifySmile;
    }


    public function getHistories(Request $request)
    {
        $isErrored =  self::validateRequest($request, self::$GetHistories);
        if ($isErrored) return self::returnFailed($isErrored);
        $history = DataTransaction::query();
        $response = self::transactionHistories($request, $history);
        $history = $response->latest()->paginate(10);
        return self::returnSuccess($history);
    }
}
