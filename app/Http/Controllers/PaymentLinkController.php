<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TransactionModule\TransactionController;
use App\Mails\TransactionNotification;
use App\Models\Collection;
use App\Models\Merchant;
use App\Models\PaymentLink;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\APIrequest;
use App\Traits\Sms;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaymentLinkController extends Controller
{
    use Sms;

    public function generatePaymentLink(Request $request)
    {
        $user = Auth::User();
        if (!$user) return self::returnNotFound("action forbidden for unauthorised user.");
        
        $validator = Validator::make($request->all(), [
            "amount"        => "required|numeric|min:100",
            "email"         => "email",
            "phone_number"  => "required|digits:11",
            "description"   => "required"
        ]);
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());
        
        do {
            $reference = Str::random(20);
        } while (PaymentLink::where("link_reference", $reference)->first());
        
        $paymentLink = PaymentLink::create([
            'user_id'           => $user->id,
            'link_reference'    => $reference,
            'amount'            => $request->amount,
            'customer_email'    => $request->email,
            'customer_number'   => $request->phone_number,
            'description'       => $request->description
        ]);
        
        if (env('APP_STAGE') == 'production') {
            $word = Str::of($request->description)->words(4);
    
            $message = "Payment request for \n$word \nby CreditMe. \n $paymentLink->short_link";
            
            $this->sendSms($request->phone_number, $message);
            if ($request->email) {
                try {
                    // Mail::to($request->email)->send(new MailsPaymentLink($paymentLink));
                } catch (Exception $e) {
                    Log::info($e);
                }
            }
        }
        return self::returnSuccess($paymentLink);
    }
    
    public function getLinkInfo($reference)
    {
        $paymentLink = PaymentLink::where("link_reference", $reference)->first();
        $name = $paymentLink->user->fullname;
        $paymentLink["merchant_name"] = $name;
        if (!$paymentLink) return self::returnFailed("Transaction not found");

        if ($paymentLink->paid) {
            $transaction = Collection::find($paymentLink->transaction_id);
            return self::returnSuccess(collect(["transaction" => $transaction, "amount" => $paymentLink->amount]));
        }

        return self::returnSuccess([
            "transaction" => null, 
            "amount" => $paymentLink->amount, 
            "description" => $paymentLink->description, 
            "merchant_name" => $name
        ]);
    }
}
