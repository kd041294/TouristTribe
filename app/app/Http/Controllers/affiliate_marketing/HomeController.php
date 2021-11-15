<?php

namespace App\Http\Controllers\affiliate_marketing;

use Illuminate\Http\Request;
use App\Libraries\TripLibrary;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(Request $request){
        
        date_default_timezone_set("Asia/Calcutta");
        $loc = false;
        $calculation = $request->cal ?? "no";
        $nop = $request->nop ?? 1;
        $nor = $request->nor ?? 1;
        $bt = $request->bt ?? 1;
        $nod = $request->nod ?? 0;
        $trip_date = $request->trip_date ? $request->trip_date : '';

        $trip_datas = TripLibrary::get_trip_calculated_details($loc, $nod, $nop, $nor, $bt, $trip_date, $params = []);

        // echo $trip_datas['data'][5]->location_name;die;
        // echo $trip_datas['hotels'][5][0]->single_bed_type_cost;
        // echo json_encode($trip_datas['hotels'][5][0]);die;

        // echo json_encode($trip_data["data"][0]->trip_name);die;

        return view('affiliate_marketing.home', $trip_datas);
    }
}
