<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTransactionJob;
use App\Models\TransactionGroup;
use App\Models\AirtimeProvider;
use App\Models\AirtimeTransaction;
use App\Models\AirtimeTransactionGroup;
use App\Services\Histories;
use App\Services\Validations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Queue;

class AirtimeController extends Controller
{
    use Validations, Histories;

    public function getProviders()
    {
        $providers = AirtimeProvider::all();

        if ($providers == null) {
            return self::returnNotFound();
        }
        return self::returnSuccess($providers);
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
        if (!$user) return self::returnNotFound("action forbidden for unauthorised user.");

        $response = $this->create($request, $user);
        return self::returnSuccess($response);
    }


    public function purchaseUserTransaction(Request $request)
    {
        $user = Auth::user();
        if (!$user) return self::returnNotFound("action forbidden for unauthorised user.");

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

        $isErrored =  self::validateRequest($request, self::$AirtimeValidation);
        if ($isErrored) return self::returnFailed($isErrored);

        $amount = [];
        $payload = [];

        foreach ($request->data as $item) {
            array_push($amount, (float) $item['amount']);
        }

        $airtimeGroup = new TransactionGroup([
            "ip"                => $_SERVER['REMOTE_ADDR'],
            "service_name"      => 'Airtime',
            "user_id"           => $user->id ?? false,
            "total_amount"      => array_sum($amount),
            "payment_method"    => $request->payment_method,
            "item_number"       => count($request->data),
            "customer_phone"    => $request->phone_no,
        ]);
        $airtimeGroup->save();

        foreach ($request->data as $item) {
            array_push($payload, [
                "phone_number"      => $item['phone_number'],
                "amount"            => $item['amount'],
                "provider"          => $item['network'] == 'mtn' ? strtoupper($item['network']) : ucfirst($item['network']),
                "transaction_id"     => date(time() * rand(11, 99)),
                "response_time"        => date('D jS M Y, h:i:sA'),
                "request_time"        => $request_time,
                'group_id'          => $airtimeGroup->id,
                "created_at"        => Carbon::now(),
                "updated_at"        => Carbon::now(),
            ]);
        }

        AirtimeTransaction::insert($payload);

        $response = AirtimeTransactionGroup::with('transactions')
            ->where('id', $airtimeGroup->id)
            ->first();

        $airtimeGroup->client_request = json_encode($request->all());
        $airtimeGroup->client_response = json_encode($response);
        $airtimeGroup->update();

        if ($user != null) {
            return $response;
        } else {
            return self::returnSuccess($response);
        }
    }


    public function purchase(Request $request, $user = null)
    {
        $isErrored =  self::validateRequest($request, self::$VendValidation);
        if ($isErrored) return self::returnFailed($isErrored);

        $transaction = AirtimeTransaction::where("group_id", $request->group_id)->get();

        if ($transaction == null) return self::returnNotFound("transactions does not exist");

        $date = Carbon::now()->addSeconds(5);
        Queue::later($date, new ProcessTransactionJob($request, 'airtime'));

        $response = AirtimeTransactionGroup::with('transactions')
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
            return self::returnSuccess($response);
        }
    }


    public function getHistories(Request $request)
    {
        $isErrored =  self::validateRequest($request, self::$GetHistories);
        if ($isErrored) return self::returnFailed($isErrored);
        $history = AirtimeTransaction::query();
        $response = self::transactionHistories($request, $history);
        $history = $response->latest()->paginate(10);
        return self::returnSuccess($history);
    }
}
