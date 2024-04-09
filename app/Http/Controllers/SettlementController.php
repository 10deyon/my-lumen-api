<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SettlementHistory;
use App\Services\Histories;
use App\Services\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettlementController extends Controller
{
    use Histories, Validations;

    public function getHistories(Request $request)
    {
        $isErrored =  self::validateRequest($request, self::$GetHistories);   
        if ($isErrored) return self::returnFailed($isErrored);

        // $validator = Validator::make($request->all(), [
        //     "start_date" => (isset($request->start_date)) ? "date_format:Y-m-d" : "",
        //     "end_date"  => (isset($request->end_date)) ? "date_format:Y-m-d" : "",
        //     "status"    => (isset($request->status)) ? "in:all,processing,successful" : "",
        // ]);

        // if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $merchant = Auth::user()->merchant->first();
        if (!$merchant) return self::returnNotFound("Merchant record not found");

        $history = SettlementHistory::query();
        // $history = Wallet::query();
        $response = self::transactionHistories($request, $history);
        $history = $response->latest()->paginate(10);
        return self::returnSuccess($history);
        
        $history->where("settlement_histories.merchant_id", $merchant->id);
        $history->leftJoin("merchant_accounts", "settlement_histories.account_id", "merchant_accounts.id");
        $history->leftJoin("banks", "merchant_accounts.bank_id", "banks.id");

        $history->when(isset($request->start_date), function ($query) use ($request) {
            $query->where("settlement_histories.created_at", ">=", $request->start_date . " 00:00:00");
        });
        $history->when(isset($request->end_date), function ($query) use ($request) {
            $query->where("settlement_histories.created_at", "<=", $request->end_date . " 23:59:59");
        });
        $history->when(isset($request->status)  && ($request->status != "all"), function ($query) use ($request) {
            $query->where("settlement_histories.status", "=",  $request->status);
        });

        $history = $history->orderBy("settlement_histories.created_at", "desc")
            ->select(
                "settlement_histories.id",
                "settlement_histories.amount",
                "settlement_histories.transaction_reference",
                "settlement_histories.status",
                "merchant_accounts.account_name",
                "merchant_accounts.account_number",
                "banks.name",
                "settlement_histories.created_at"
            )->paginate(20);

        return self::returnSuccess($history, "Ssuccessful");
    }


    public function settlementTransactions($id)
    {
        $transactions = Auth::user()->merchant->settlements()->where('id', $id)->first()->transactions;

        return self::returnSuccess($transactions, "successfull");
    }
}
