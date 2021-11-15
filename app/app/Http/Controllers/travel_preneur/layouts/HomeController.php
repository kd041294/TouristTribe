<?php

namespace App\Http\Controllers\travel_preneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        return view('travel_preneur.home', $data);
    }
}
