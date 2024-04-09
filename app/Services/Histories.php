<?php

namespace App\Services;

trait Histories
{
    public static function transactionHistories($request, $history)
    {
        $history->when(isset($request->status), function ($query) use ($request) {
            $query->when(($request->status == "pending"), function ($query) {
                $query->where("verified_at", "=", NULL);
            });
            $query->when(($request->status == "verified"), function ($query) {
                $query->where("verified_at", "!=", NULL);
            });

            $query->when(isset($request->status)  && ($request->status != "all"), function ($query) use ($request) {
                $query->where("status", "=", $request->status);
            });
        });
        
        $history->when(isset($request->start_date), function ($query) use ($request) {
            $query->where("created_at", ">=", $request->start_date . " 00:00:00");
        });
        $history->when(isset($request->end_date), function ($query) use ($request) {
            $query->where("created_at", "<=", $request->end_date . " 23:59:59");
        });

        $history->when(isset($request->settlement_id), function ($query) use ($request) {
            $query->where("settlement_id", "=", $request->settlement_id);
        });

        $history->when(isset($request->type) && ($request->type != "all"), function ($query) use ($request) {
            $query->where("type", "=", $request->type);
        });
        
        $history->when(isset($request->amount), function ($query) use ($request) {
            $query->where("amount", "=", $request->amount);
        });
        
        $history->when(isset($request->phone_number), function ($query) use ($request) {
            $query->where("phone_number", "=", $request->phone_number);
        });
        $history->when(isset($request->payment_ref), function ($query) use ($request) {
            $query->where("payment_reference", "=", $request->payment_ref);
        });
        $history->when(isset($request->transaction_id), function ($query) use ($request) {
            $query->where("transaction_id", "=", $request->transaction_id);
        });

        return $history;
    }
}
