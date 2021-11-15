<?php

namespace App\Http\Controllers\user;
use App\Meal;
use App\Hotel;
use Validator;
use App\Midtrip;
use App\Transfer;
use App\TourOperator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Libraries\TripLibrary;
use App\Http\Controllers\Controller;

class TripControllers extends Controller
{
    public function seeComp(Request $req, $comp_name, $loc){
        
        return $this->see($req, $loc, $comp_name);
    }

    public function see(Request $req,$loc, $comp_name = null) {
        //Receive Data
        
        $tour_operator_id = TourOperator::get_id_by_company_name($comp_name);
        $commission_percent = TourOperator::get_commission_by_company_name($comp_name);
        
        $trip_all_price_details = [];
        date_default_timezone_set("Asia/Calcutta");
        $calculation = $req -> cal ?? "no";
        $nop = $req -> nop ?? 2;
        $nor = $req -> nor ?? 1;
        $bt = $req -> bt ?? 2;
        $nod = $req -> nod ?? 0;
        $trip_date = $req -> trip_date ?? date("Y-m-d");

        //data get
        if($nod == 0){
            $data = DB::table('trips')
                    ->join('per_head_extra_fees', 'trips.per_head_extra_fees_id', '=', 'per_head_extra_fees.id')
                    ->join('meals','trips.meal','=','meals.id')
                    ->join('transfers','trips.transfers','=','transfers.id')
                    ->join('locations','trips.location_id','=','locations.id')
                    ->join('tour_operators','trips.tour_operator_id','=','tour_operators.id')
                    ->join('booking_details as bd', 'bd.trip_id', '=', 'trips.id')
                    ->select
                        (
                            'per_head_extra_fees.per_head_cost', 'per_head_extra_fees.fee_details',
                            'trips.id','trips.trip_name','trips.no_of_days','trips.no_of_nights',
                            'trips.allGender','trips.onlyMens','trips.onlyWomens','trips.allCast',
                            'trips.buddhismCast','trips.hinduCast','trips.sikhismCast','trips.islamCast',
                            'trips.christianCast','trips.hotels','trips.midtrips','meals.per_head_cost as mealPrice',
                            'transfers.name as vehicalName','transfers.type as vehicalType',
                            'transfers.total_person as vehicalTotalPerson',
                            'transfers.total_cost as vehicalCost',
                            'locations.type','locations.total_member_size','locations.min_family_member',
                            'tour_operators.comp_name','tour_operators.gst', 'bd.starting_date'
                        )
                    ->where('trips.location_name',$loc)
                    ->get();
        }
        else{
            $data = DB::table('trips')
                    ->join('per_head_extra_fees', 'trips.per_head_extra_fees_id', '=', 'per_head_extra_fees.id')
                    ->join('meals','trips.meal','=','meals.id')
                    ->join('transfers','trips.transfers','=','transfers.id')
                    ->join('locations','trips.location_id','=','locations.id')
                    ->join('tour_operators','trips.tour_operator_id','=','tour_operators.id')
                    ->select
                        (
                            'per_head_extra_fees.per_head_cost', 'per_head_extra_fees.fee_details',
                            'trips.id','trips.trip_name','trips.no_of_days','trips.no_of_nights',
                            'trips.allGender','trips.onlyMens','trips.onlyWomens','trips.allCast',
                            'trips.buddhismCast','trips.hinduCast','trips.sikhismCast','trips.islamCast',
                            'trips.christianCast','trips.hotels','trips.midtrips','meals.per_head_cost as mealPrice',
                            'transfers.name as vehicalName','transfers.type as vehicalType',
                            'transfers.total_person as vehicalTotalPerson',
                            'transfers.total_cost as vehicalCost',
                            'locations.type','locations.total_member_size','locations.min_family_member',
                            'tour_operators.comp_name','tour_operators.gst'
                        )
                    ->where('trips.location_name',$loc)
                    ->where('trips.no_of_days',$nod)
                    ->get();
        }
        // echo json_encode($data);die;
        $incrementData = 0;
        $numberOfTrip = count(array($loc));
    

        $trip_data = TripLibrary::get_trip_calculated_details($loc, $nod, $nop, $nor, $bt, $trip_date);
         $trip_data["is_comp_passed"] = $tour_operator_id ? 1 : 0;
         
       // $trip_data = \TripLibrary::get_trip_calculated_details($loc, $nod, $nop, $nor, $bt, $trip_date, $trip_id, $params = []);
               // echo json_encode($trip_data);die;
               
        if($trip_data["data"] != '[]'){
            return view('User.trip_details', $trip_data);
        }
        else{
            return "Sorry Trip Not Found in $nod day";
        }
    }
}