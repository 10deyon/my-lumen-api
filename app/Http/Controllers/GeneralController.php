<?php

namespace App\Http\Controllers;

use App\Model\ContactUsData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
	public function createContactUs(Request $request)
	{
		$validator = Validator::make($request->all(),
            [
                "name"	=> "required|string",
                "email"	=> "required|string",
                "phone"	=> "required|string",
                "text"	=> "required|string",
            ],
        );
        
        if ($validator->fails()) return self::returnFailed($validator->errors()->first());
		
		ContactUsData::create([
			"name"		=> $request->name,
			"email"		=> $request->email,
			"phone"		=> $request->phone,
			"text"		=> $request->text,
		]);
		
		return self::returnSuccess();
	}

	public function getContactUs(Request $request)
	{
		$validator = Validator::make($request->all(),
			[
				"page"	=> "required|integer",
				"limit"	=> "required|integer",
			],
		);
		if ($validator->fails()) return self::returnFailed($validator->errors()->first());

		$skip = ($request->page - 1) * $request->limit;

		$users = ContactUsData::orderBy("id", "desc")
			->skip($skip)
			->limit($request->limit)
			->get();

			$data = [
				"items"		=> $users,
				"is_more"	=> self::checkIfRemains($users, ContactUsData::query())
			];
		return self::returnSuccess($data);
	}
}
