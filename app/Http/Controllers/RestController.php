<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\LocalGovt;
use App\Models\State;

class RestController extends Controller
{
    public function getStates()
    {
        $state = State::all();
        return self::returnSuccess($state);
    }
    
    public function getLocalGovts($stateId)
    {
        $state = State::find($stateId);
        if (!$state) return self::returnFailed("Please select a valid state");
        return self::returnSuccess($state->lgas);
    }
    
    public function getBanks()
    {
        $banks = Bank::all();
        return self::returnSuccess($banks);
    }
    
    public function getLgas($id)
    {
        $localGovt = LocalGovt::where('state_id', $id)->get();
    
        return self::returnSuccess($localGovt);
    }
}
