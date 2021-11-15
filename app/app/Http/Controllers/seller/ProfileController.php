<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        $data['tour_operator_detail'] = session('tour_operator_data');

        return view('Seller.profile', $data);
    }
}
