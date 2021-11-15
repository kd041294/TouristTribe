<?php

namespace App\Http\Controllers\travel_preneur;

use App\TourOperator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $data["tour_operators"] = "";
        $data["travel_preneur_data"] = "";

        $travel_preneur_data = session('user_data');
        $travel_preneur_id = $travel_preneur_data['id'];
        
        $data['travel_preneur_data'] = $travel_preneur_data;
        
        $data["tour_operators"] = TourOperator::where('travel_preneur_users_id', $travel_preneur_id)->get();

        return view('travel_preneur.home', $data);
    }
}
