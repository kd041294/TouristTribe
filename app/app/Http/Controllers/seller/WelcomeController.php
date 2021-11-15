<?php

namespace App\Http\Controllers\seller;

use App\BookingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function welcome(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        $tour_operator_id = session('tour_operator_data')['id'];
        
        
        $data["booking_details"] = DB::table("booking_details as bd")
                                ->select("bd.id", "bd.trip_id", "bd.user_id", "bd.person_name", "bd.person_email", "bd.person_mobile", "to.name", "to.email", "to.mobile_number", "to.comp_name", "bd.total_booking_amount", "ts.total_cost", "bd.bookingDate", "bd.no_of_person", "bd.no_of_room", "to.id as tour_operator_id")
                                ->join('trips as t', 'bd.trip_id', '=', 't.id')
                                ->join('tour_operators as to', 't.tour_operator_id', '=', 'to.id')
                                ->join('transfers as ts', 'ts.id', '=', 't.transfers')
                                ->where('to.id', $tour_operator_id)
                                ->get();

        return view('Seller.welcome', $data);
    }
}
