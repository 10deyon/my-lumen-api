

    private function checkCompliance(Vendor $vendor)
    {
        $level = 0;

        $account = $vendor->account()->first();
        $bvn = $vendor->bvn()->first();

        if ($account) $level++;
        if ($bvn) $level++;

        Log::info('\n\nCOMPLIANCE LEVEL ' . $level, '\n', $vendor);

        if ($level != $vendor->level) {
            if (!$vendor->complied && $level == $this->MAX_COMPLIANCE) {
                try {
                    $user = User::find($vendor->user_id);
                    $profile = $vendor->profile()->first();
                    // Mail::to($user->email)->send(new ComplianceNotification($profile));
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }
            }

            $vendor->update([
                "level"     => $level,
                "complied"  => ($level == $this->MAX_COMPLIANCE) ? true : false,
            ]);
        }
    }



    public function verifyAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "account_number"    => "required|numeric",
            "bank_id"           => "required|integer"
        ]);

        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $bank = Bank::find($request->bank_id);
        $apiRequest = [$request->account_number, $bank->code];

        $reference = time() . rand(1111, 9999);

        $user = User::where('id', Auth::user()->id)->first();

        if (!$user) return self::returnNotFound("unauthorised user");

        $apiRequest = [$request->account_number, $bank->code];

        try {
            $apiResponse = self::getPaystack(["verify_account"], $apiRequest);
            Log::info($apiResponse);
        } catch (Exception $e) {
            return self::returnFailed($e->getMessage());
        }

        if ($apiResponse->status != true) return self::returnFailed("invalid account number");

        $accountName = $apiResponse->target_accountName;
        $accountNameArray = explode(" ", $accountName);

        if (
            strtolower($accountNameArray[0]) != strtolower($user->first_name) ||
            strtolower($accountNameArray[1]) != strtolower($user->first_name) ||
            strtolower($accountNameArray[2]) != strtolower($user->first_name)
            ||
            strtolower($accountNameArray[1]) != strtolower($user->middle_name) ||
            strtolower($accountNameArray[2]) != strtolower($user->middle_name) ||
            strtolower($accountNameArray[0]) != strtolower($user->middle_name)
            ||
            strtolower($accountNameArray[1]) != strtolower($user->middle_name) ||
            strtolower($accountNameArray[1]) != strtolower($user->middle_name) ||
            strtolower($accountNameArray[0]) != strtolower($user->middle_name)
        ) return self::returnFailed("bank account name does not match your profile details");

        $login_type = filter_var($user->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';
        $credentials = [$login_type => $user->email, 'password' => $user->password];

        if (!$token = auth()->claims(["type" => 'vendor'])->attempt($credentials)) return self::returnInvalidCredentials();

        //create temp verification
        $verification = TempAccountVerification::create([
            // "account_name"      => $accountName,
            "account_name"      => "accountName",
            "account_number"    => $request->account_number,
            "bank_id"           => $request->bank_id,
            "reference"         => $reference
        ]);

        return self::returnSuccess($verification, "account verification was successful");
    }


    public function addSettlementAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "reference" => "required"
        ]);

        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $verification = TempAccountVerification::where("reference", $request->reference)->first();

        if (!$verification) return self::returnNotFound("account verification record not found");

        $vendor = Vendor::where("user_id", Auth::user()->id)->first();

        if (!$vendor) return self::returnFailed("vendor record not found");

        $account = $vendor->account()->create([
            "account_name"      => $verification->account_name,
            "account_number"    => $verification->account_number,
            "bank_id"           => $verification->bank_id
        ]);


        $verification->delete();

        $this->checkCompliance($vendor);

        return self::returnSuccess($account, "account details added successfully");
    }


    public function matchBVN(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "bvn" => "required|numeric",
        ]);

        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $vendor = Vendor::where("user_id", Auth::user()->id)->first();

        if (!$vendor) return self::returnNotFound("vendor record not found");

        if (!$vendor) return self::returnFailed("Profile information needed to verify BVN");

        // Verify BVN MATCH
        $bvn = [
            "bvn"               => $request->bvn,
            "account_number"    => $vendor->accountNumber->account_number,
            "bank_code"         => $vendor->accountNumber->bank->code,
        ];

        try {
            $response = $this->verifyBVN($bvn);
            Log::info(json_encode($response));
        } catch (Exception $e) {
            Log::info($e);
            return self::returnServiceDown("Failed to verify BVN");
        }

        $vendor->bvn()->create([
            "bvn_number"    => $request->bvn,
        ]);

        $this->checkCompliance($vendor);

        User::find($vendor->id)->update([
            'type' => "vendor"
        ]);

        return self::returnSuccess("BVN verified successfully");
    }


    public function getMerchantProfile()
    {
        $vendor = Vendor::where("user_id", Auth::user()->id)->first();

        if (!$vendor) return self::returnNotFound("vendor record not found");

        $profile = $vendor->user()->getFullNameAttribute();
        $account = $vendor->account()->latest()->first();
        $bvn = $vendor->bvn()->latest()->first();

        $this->checkCompliance($vendor);

        return self::returnSuccess(compact("vendor", "profile", "account", "bvn"), "successful");
    }


    public function updateKYCProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name"    => "required|string",
            "last_name"     => "required|string",
            "middle_name"   => "string",
            "address"       => "required",
            "city"          => "required",
            "state_id"      => "required",
        ]);

        if ($validator->fails()) return self::returnFailed($validator->errors()->first());

        $vendor = Vendor::where("user_id", Auth::user()->id)->first();

        if (!$vendor) return self::returnNotFound("Vendor record not found");

        $data = [
            "first_name"    => $request->first_name,
            "last_name"     => $request->last_name,
            "middle_name"   => $request->middle_name,
            "address"       => $request->address,
            "city"          => $request->city,
            "state_id"      => $request->state_id
        ];

        $profile = $vendor->profile()->update($data);
        $profile = $vendor->profile()->first();

        return self::returnSuccess($profile, "Profile updated successfully");
    }













    private static function upload_image_file($base64_encoded)
    {
        $uploads_dir = base_path('/storage/app/public/images');
        $file_name = uniqid();

        $allowed_mimes = ['data:image/jpeg;base64', 'data:image/png;base64'];
        $the_image = explode(',', $base64_encoded);

        $mime = $the_image[0]; // data:image/jpeg;base64
        $image = $the_image[1];
        $extension = '.jpg';

        if (!in_array($mime, $allowed_mimes))
            return [
                "status"    => "02",
                "error"        => "File type not allowed. Only png, jpg, pdf, jpeg required"
            ];

        $file = fopen($uploads_dir . '/' . $file_name . $extension, 'wb');

        fwrite($file, base64_decode($image));
        fclose($file);

        return [
            "status"    => "00",
            "fileName"        => $file_name . $extension
        ];
    }

    public function uploadCustomerProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name"    => "required|string",
            "last_name"     => "required",
            "middle_name"   => "string",
            "id_type"       => "required",
            "id_file"       => "required",
            "address"       => "required",
            "city"          => "required",
            "state_id"      => "required",
        ]);

        if ($validator->fails()) self::returnFailed($validator->errors()->first());

        //convert image to base64 extensions
        try {
            $extension = preg_match("/^data:image\/(png|jpeg|jpg);base64,*/", $request->image);
            // $extension = explode("/", explode(":", explode(";", $request->id_file)[0])[1])[1];
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return self::returnFailed('The file format is invalid.', 415);
        }

        $image =  $this->upload_image_file($request->image);
        if ($image["status"] == "00") {
            $imageName = $image["fileName"];
        }

        // $merchant = Merchant::where("user_id", Auth::user()->id)->first();
        $merchant = Auth::user()->id;

        if (!$merchant) return self::returnNotFound("Merchant record not found");

        $data = [
            "first_name"    => $request->first_name,
            "last_name"     => $request->last_name,
            "middle_name"   => $request->middle_name,
            "id_type"       => $request->id_type,
            "id_file"       => $imageName,
            "address"       => $request->address,
            "city"          => $request->city,
            "state_id"      => $request->state_id,
        ];

        if (!$merchant->profile->first()) {
            $profile = $merchant->profile->create($data);
        } else {
            $profile = $merchant->profile->update($data);
            $profile = $merchant->profile->first();
        }

        $this->checkCompliance($merchant);
        return self::returnSuccess($profile, "Profile upload successfully");
    }








            // $lga = LocalGovt::find($request->lga_id);
            
            // $business->address()->create([
            //     "state_id"      => $lga->state->id,
            //     "local_govt_id" => $request->lga_id,
            //     "address"       => $request->address,
            //     "local_govt"    => $lga->lga,
            //     "state"         => $lga->state->name,
            // ]);
            // $name = "Emmanuel Testing";
            // $business->account()->create([
            //     "account_number"    => $request->address,
            //     "account_name"      => $name, //$apiResponse->name,
            //     "bank_id"           => $bank->id,
            // ]);
            // $business->bvn()->create([
            //     "bvn_number"    => $request->bvn_number,
            // ]);
