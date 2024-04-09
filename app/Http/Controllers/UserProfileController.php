<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\User;
use App\Models\UserProfile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function addProfile(Request $request)
    {
        $user = Auth::User();
        if (!$user) return self::returnNotFound("action forbidden for unauthorised user.");

        $validator = Validator::make($request->all(), [
            "first_name"    => "required|string",
            "last_name"     => "required|string",
            "email"         => "required|string",
            "gender"        => "required|string",
            "bank_id"       => "required|integer",
            "account_num"   => "required|string",
            "state_id"      => "required|integer",
            "address"       => "required|string",
        ]);

        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $bank = Bank::find($request->bank_id);

        $apiRequest = [$request->account_num, $bank->code];

        try {
            function createProfile(Request $request, User $user)
            {
                $profile = UserProfile::create([
                    "user_id"       => $user->id,
                    "first_name"    => $request->first_name,
                    "last_name"     => $request->last_name,
                    "email"         => $request->email,
                    "gender"        => $request->gender,
                    "bank_id"       => $request->bank_id,
                    "account_num"   => $request->account_num,
                    "state_id"      => $request->state_id,
                    "address"       => $request->address,
                ]);
                return $profile;
            }

            if (env("APP_STAGE") == "development") {
                Log::info("\nACCOUNT NUMBER VERIFICATION BYPASSED FOR USER-PROFILE\n" . json_encode($request->all()));
                return createProfile($request, $user);
            } else {
                $apiResponse = self::getPaystack(["verify_account"], $apiRequest);
                Log::info("\nACCOUNT NUMBER VERIFICATION FOR USER-PROFILE\n" . json_encode($apiResponse));

                if (isset($apiResponse->status)) {
                    if ($apiResponse->status == true) {
                        return createProfile($request, $user);
                    }
                    if ($apiResponse->status != true) return self::returnFailed("Invalid account number");
                }
            }
        } catch (Exception $e) {
            return self::returnFailed($e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::User();
        if (!$user) return self::returnNotFound("action forbidden for unauthorised user.");

        $validator = Validator::make($request->all(), [
            "first_name"    => "string",
            "last_name"     => "string",
            "email"         => "string",
            "gender"        => "string",
            "bank_id"       => "integer",
            "account_num"   => "string",
            "state_id"      => "integer",
            "address"       => "string",
        ]);

        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        if ($request->has('bank_id') && $request->has('account_num')) {
            $bank = Bank::find($request->bank_id);

            $apiRequest = [$request->account_num, $bank->code];
            try {
                $apiResponse = self::getPaystack(["verify_account"], $apiRequest);
                Log::info("\nACCOUNT NUMBER VERIFICATION FOR USER-PROFILE\n" . json_encode($apiResponse));
            } catch (Exception $e) {
                return self::returnFailed($e->getMessage());
            }

            if ($apiResponse->status != true) return self::returnFailed("invalid account number");
        }

        $profile = $user->profile->update($request->all());

        return self::returnSuccess($profile);
    }


    public function getProfile($id)
    {
        $user = Auth::user();
        if (!$user) return self::returnNotFound("action forbidden for unauthorised user.");
        $profile = UserProfile::where("user_id", $id)->first();

        return self::returnSuccess($profile);
    }
}
