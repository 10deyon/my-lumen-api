<?php

namespace App\Http\Controllers;

use App\Services\APICaller;
use App\Services\ResponseFormats;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
	use ResponseFormats, APICaller;
	
	protected function respondWithToken($token, $data)
	{
		$data['token'] = $token;
		$data['token_type'] = 'bearer';
		$data['expires_in'] = Auth::factory()->getTTL() * 60;
		return $data;
	}
}
