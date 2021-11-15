<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Libraries\TripLibrary;
use App\Http\Controllers\Controller;

class CashbackDetailsController extends Controller
{
    public function cashback_details(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        // TripLibrary::updateCashbackAmount(1);

        return view('Admin.cashback_details', $data);
    }
}
