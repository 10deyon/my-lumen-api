<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Business;
use App\Models\BusinessAccount;
use App\Models\BusinessBvn;
use App\Models\LocalGovt;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function addKycProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) return self::returnNotFound("unauthenticated user");

        $validator = Validator::make($request->all(), [
            "frequency"     => "required|string",
            "account_number"=> "required|string",
            "bank_id"       => "required|integer",
            "business_name" => "required|string",
            "address"       => "required|string",
            "bvn_number"    => "required|string",
            "lga_id"        => "required|integer",
            "cac_number"    => "string",
            "reg_date"      => "string",
            "reg_number"    => "string",
        ]);
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        if ($business = $user->business) return self::returnSuccess("user already upgraded kyc");

        DB::beginTransaction();
        try {
            $data = [
                "frequency"     => $request->frequency,
                "business_name" => $request->business_name,
                "cac_number"    => $request->cac_number,
                "reg_date"      => $request->reg_date,
                "reg_number"    => $request->reg_number
            ];
            $business = $user->business()->create($data);

            $lga = $this->createLga($request);
            $business->address()->create($lga);

            $account = $this->createAccount($request);
            $business->account()->create($account);

            $bvn = $this->createBvn($request);
            $business->bvn()->create($bvn);

            $response = $business::where("id", $business->id)->with("address", "account", "bvn")->first();

            DB::commit();
            return self::returnSuccess($response);
        } catch (Exception $e) {
            return self::returnFailed($e->getMessage());
        }
    }


    public function updateKycProfile(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) return self::returnNotFound("unauthenticated user");

        $validator = Validator::make($request->all(), [
            "frequency"     => "string",
            "account_number"=> "string",
            "bank_id"       => "integer",
            "business_name" => "string",
            "cac_number"    => "string",
            "address"       => "string",
            "bvn_number"    => "string",
            "lga_id"        => "integer",
            "reg_date"      => "string",
            "reg_number"    => "string",
        ]);

        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $business = Business::where('id', $id)->first();
        if (!$business) return self::returnFailed('invalid business id');

        try {
            if ($business) {
                $data = [
                    "frequency"     => $request->frequency ?? $business->frequency,
                    "business_name" => $request->business_name ?? $business->business_name,
                    "cac_number"    => $request->cac_number ?? $business->cac_number,
                    "reg_date"      => $request->reg_date ?? $business->reg_date,
                    "reg_number"    => $request->reg_number ?? $business->reg_number
                ];

                $business->update($data);
            }

            if ($request->has('lga_id') || $request->has('address')) {
                $lga = $this->createLga($request, $business);
                $business->address()->update($lga);
            }

            if ($request->has('account_number') && $request->has('bank_id')) {
                $account = $this->createAccount($request, $business);
                
                $business->account()
                    ->whereActive(true)
                    ->where("account_number", "!=", $request->account_number)
                    ->update(["active" => false]);
                
                $business->account()->create($account);
            }

            if ($request->has('bvn_number')) {
                $bvn = $this->createBvn($request);
                $business->bvn()->update($bvn);
            }
            
            $response = $business::where("id", $id)->with("address", "account", "bvn")->first();
            return self::returnSuccess($response);

        } catch (Exception $e) {
            return self::returnFailed($e->getMessage());
        }
    }

    private function createLga($request) {
        $lga = LocalGovt::find($request->lga_id);

        return [
            "state_id"      => $lga->state->id,
            "local_govt_id" => $request->lga_id,
            "address"       => $request->address,
            "local_govt"    => $lga->lga,
            "state"         => $lga->state->name,
        ];
    }

    private function createAccount($request)
    {
        $bank = Bank::find($request->bank_id);

        // $apiRequest = [$request->account_num, $bank->code];
        // $apiResponse = self::getPaystack(["verify_account"], $apiRequest);
        // if ($apiResponse->status != true) return self::returnFailed("invalid account number");

        $name = "Emmanuel Testing";
        return [
            "account_number"=> $request->account_number,
            "account_name"  => $name, //$apiResponse->name,
            "bank_name"     => $bank->name,
            "bank_id"       => $bank->id,
            "sort_code"     => $bank->code,
        ];
    }

    private function createBvn($request) {
        return [
            "bvn_number"    => $request->bvn_number,
        ];
    }

    public function getProfile($id)
    {
        $user = Auth::user();
        if (!$user) return self::returnNotFound("unauthenticated user");
        
        $profile = Business::where("user_id", $id)->with("address", "account", "bvnDetail")->first();

        return self::returnSuccess($profile);
    }
}
