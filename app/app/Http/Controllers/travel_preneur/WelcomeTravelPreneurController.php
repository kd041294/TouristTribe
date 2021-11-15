<?php

namespace App\Http\Controllers\travel_preneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeTravelPreneurController extends Controller
{
    public function welcome(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        return view('travel_preneur.welcome', $data);
    }
}
