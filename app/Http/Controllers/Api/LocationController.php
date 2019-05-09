<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function getCountries(){
        return Country::all();
    }

    public function getStates(Country $country){
        return State::where('country_id','=',$country->id)->get();
    }

    public function getCities(State $state){
        return City::where('state_id','=',$state->id)->get();
    }
}
