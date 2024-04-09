<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionGroup;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        $user = Auth::user();
        if (!$user) return self::returnNotFound("unauthenticated user");
        
        $groups = TransactionGroup::where("user_id", $user->id)->with('airtimeGroup')->latest()->get();
        return self::returnSuccess(['groups' => $groups]);
        
        $transactions = Transaction::where("user_id", $user->id)->where("verified_at", "!=", null)->latest()->get();
        
        $settlements = $user->merchant->settlements()->latest()->get();
        $lastSettlement = (count($settlements) > 0) ? $settlements[0]->amount : 0;
        
        $nextPayout = (count($settlements) <= 0) ? null : ($settlements[0]->status == "pending" ? $settlements[0]->amount : null);
        
        if ($nextPayout == null || $nextPayout < 50) {
            $nextPayoutTime = null;
        } else {
            $nextPayoutTime = Carbon::parse($settlements[0]->created_at)->addDays(1)->hour(4)->format('D d M, Y');
            if(Carbon::parse($nextPayoutTime) < Carbon::today()) {
                if(Carbon::now()->hour < 4) {
                    $nextPayoutTime = Carbon::today()->format('D d M, Y');
                } else {
                    $nextPayoutTime = Carbon::today()->addDay(1)->format('D d M, Y');
                }
            }
        };
        
        $todaysTransaction = $transactions
            ->whereBetween("created_at", [Carbon::now()->startOfDay()->toDateTimeString(), Carbon::now()->toDateTimeString()])->sum("amount");
        $thisMonthTransaction = $transactions
            ->whereBetween("created_at", [Carbon::now()->startOfMonth()->toDateTimeString(), Carbon::now()->toDayDateTimeString()])->sum("amount");
        $thisWeeksTransactions = $transactions
            ->whereBetween("created_at", [Carbon::now()->startOfWeek()->toDateTimeString(), Carbon::now()->toDateTimeString()])->sum("amount");
        $thisYearsTransaction = $transactions
            ->whereBetween("created_at", [Carbon::now()->startOfYear()->toDateTimeString(), Carbon::now()->toDateTimeString()])->sum("amount");
        $thisMonthSettlements = $settlements
            ->whereBetween("created_at", [Carbon::now()->startOfMonth()->toDateTimeString(), Carbon::now()->toDayDateTimeString()])->sum("amount");
        $thisWeeksSettlements = $settlements
            ->whereBetween("created_at", [Carbon::now()->startOfWeek()->toDateTimeString(), Carbon::now()->toDateTimeString()])->sum("amount");
        $thisYearsSettlements = $settlements
            ->whereBetween("created_at", [Carbon::now()->startOfYear()->toDateTimeString(), Carbon::now()->toDateTimeString()])->sum("amount");
        
        $transactions = $transactions->take(20);
        
        $settlements = $settlements->take(20);
        
        return self::returnSuccess(
            compact(
                "transactions",
                "settlements",
                "nextPayout",
                "lastSettlement",
                "thisWeeksTransactions",
                "thisMonthTransaction",
                "todaysTransaction",
                "thisMonthSettlements",
                "thisWeeksSettlements",
                "thisYearsSettlements",
                "thisYearsTransaction",
                "nextPayoutTime"
            ),
            "Successful"
        );
    }
}
