<?php

namespace App\Http\Controllers;

use App\Events\ForgotPwdEvent;
use App\Events\RegisterNotificationEvent;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Mail\ForgotPassword;
use App\Models\User;
use App\Traits\Mailer;
use App\Traits\Sms;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    use Sms;

    public function verifyUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "token" => "required",
        ]);
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $user = User::where("verification_token", $request->token)->first();

        if (!$user) self::returnSuccess("user already verified");

        if ($user->timestamp + (60 * 10) < time()) return self::returnFailed("token expired");

        $user->update([
            "verified_at" => DB::raw("current_timestamp()"),
            "verification_token" => null,
            "verification_otp" => null
        ]);

        if (!env("FRONT_END_LOGIN", false)) return view("successful");
        
        return redirect(env("FRONT_END_LOGIN"));
    }


    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "otp"           => "required",
            "phone_number"  => "required_without:email",
            "email"         => "required_without:phone_number",
        ]);

        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $user = User::where("phone_number", $request->phone_number)->orWhere("email", $request->email)->first();

        if ($user) {
            if ($user->verified_at !== null) return self::returnSuccess("Your account had already been verified");
            if ($user->verification_otp == $request->otp) {
                if ($user->timestamp + (60 * 10) < time()) return self::returnFailed("Sorry, this token has expired");
                $user->update([
                    "verified_at" => DB::raw("current_timestamp()"),
                    "verification_otp" => null,
                    "verification_token" => null
                ]);
                return self::returnSuccess(User::find($user->id), "verified successfully");
            }
        }
        return self::returnFailed("Sorry, invalid token. Please try again");
    }


    public function resendVerificationCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "phone_number"  => "required_without:email",
            "email"         => "required_without:phone_number"
        ]);
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $user = User::where("phone_number", $request->phone_number)->orWhere("email", $request->email)->first();
        if (!$user) return self::returnFailed("Sorry, no user found with these credentials");
        if ($user->verified_at) return self::returnSuccess("user account already verified");

        $request->merge(["email" => $user->email]);
        DB::beginTransaction();

        try {
            $user->verification_token = Str::random(50);
            $user->verification_otp = env("APP_STAGE") == "development" ? "123456" : self::generateRandomSix();
            $user->timestamp = time();
            $user->update();

            // $this->sendSms($user->phone_number, $this->otpMessage($user->verification_otp));
            if (env('APP_STAGE') == 'production') {
                try {
                    event(new RegisterNotificationEvent($user));
                    // Mail::to($request->email)->send(new EmailVerification($user->verification_token, $user->verification_otp));
                } catch (Exception $e) {
                    Log::info($e);
                }
            }
            DB::commit();

            return self::returnSuccess("Account verification token sent successfully");
        } catch (Exception $e) {
            Log::info($e);
            DB::rollBack();

            return self::returnFailed("Sorry, something went wrong in an attempt to send verification token");
        }
    }
    
    private static function generateRandomSix()
    {
        return substr(str_shuffle("5016728349"), 0, 6);
    }
    
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name"    => "required|string",
            "last_name"     => "required|string",
            "middle_name"   => "string",
            "email"         => "required|string|email|max:255|unique:users",
            "phone_number"  => "required|numeric|unique:users",
            "password"      => "required|string|min:8|confirmed",
        ]);
        
        $userExist  = User::where('phone_number', $request->phone)->orWhere('email', $request->phone)->first();
        if ($userExist) {
			if (!$userExist->verified_at && $userExist->verification_otp) {
                return self::returnVerifyAccount($userExist);
            } else if ($userExist->verified_at) {
                return self::returnAlreadyRegistered($userExist);
            }
        }

        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $activationCode = env("APP_STAGE") == "development" ? "123456" : $activationCode = self::generateRandomSix();

        $wallet_id = strtoupper(Str::random(2)) . uniqid();

        $request->merge([
            'password'              => Hash::make($request->password),
            'verification_token'    => Str::random(50),
            'verification_otp'      => $activationCode,
            'timestamp'             => time(),
        ]);

        DB::beginTransaction();
        try {
            $user = User::create($request->all());

            $wallet = $user->wallet()->create([
                "wallet_id" => $wallet_id,
                "balance" => (float) 0.00
            ]);

            $activationCode = env("APP_STAGE") == "development" ? "123456" : self::generateRandomSix();
            
            if (env('APP_STAGE') == 'production') {
                $this->sendSms($user->phone_number, $this->otpMessage($request->verification_otp));

                try {
                    event(new RegisterNotificationEvent($request));
                    // Mail::to($request->email)->send(new EmailVerification($request->verification_token, $request->verification_otp));
                } catch (Exception $e) {
                    Log::error($e);
                }
            }

            DB::commit();

            return self::returnSuccess(['user' => $user, 'wallet' => $wallet, 'account' => null]);

        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return self::returnSystemFailure("error creating profile");
        }
    }


    public function loginUser(Request $request)
    {
        $this->validate($request, [
            'email_phone' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $login_type = filter_var($request->email_phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

            $credentials = [$login_type => $request->email_phone, 'password' => $request->password];

            if (!$token = auth()->claims(["type" => 'user'])->attempt($credentials)) return self::returnInvalidCredentials();

            $user = Auth::user();
            $user->wallet;
            $user->account;
            $user->profile;
            $user->business;

            // if (!$user->verified_at) return self::returnFailed("user not verified yet");
            if (!$user->verified_at) return self::returnVerifyAccount();


            $data = $this->respondWithToken($token, $user);
            return self::returnSuccess($data);
        } catch (JWTException $e) {
            return self::returnSystemFailure('System Failure');
        }
    }



    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "old_password"  => "required",
            "password"      => "required|confirmed"
        ]);
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        /** @var User */
        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) return self::returnFailed("Invalid password");

        if ($request->old_password == $request->password) return self::returnFailed("this password has already been used");

        $user->password = Hash::make($request->password);
        $user->save();

        return self::returnSuccess("password updated successfully");
    }


    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email"
        ]);

        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $user = User::where("email", $request->email)->first();

        if (!$user) return self::returnFailed("email not found");

        $user->forgot_password_token = Str::random(50);
        $user->timestamp = time();
        $user->save();

        if (env('APP_STAGE') == 'production') {
            try {
                event(new ForgotPwdEvent($user));

                // Mail::to($request->email)->send(new ForgotPassword($user->forgot_password_token));
            } catch (Exception $e) {
                Log::info($e);
            }
        }

        return self::returnSuccess("reset password via link sent to your mail");
    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "token"     => "required",
            "password"  => "required|string|min:8|confirmed",
        ]);

        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $user = User::where("forgot_password_token", $request->token)->first();

        if (!$user) return self::returnFailed("invalid token");

        if ($user->timestamp + (60 * 10) < time()) return self::returnFailed("token has expired");

        $user->password = Hash::make($request->password);
        $user->save();

        return self::returnSuccess("password reset successfully");
    }


    public static function logout()
    {
        auth()->logout(true);
        return self::returnSuccess();
    }
}
