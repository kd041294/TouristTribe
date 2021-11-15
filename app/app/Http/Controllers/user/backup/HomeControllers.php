<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Location;

class HomeControllers extends Controller
{
    public function see(Request $request){
        $data = [];
        $data['data_served_areas'] = config('constant.location_served_areas');
        $data["genders"] = config('constant.genders');
        $data["religions"] = config('constant.religions');
        
        $location = $request->input("location");
        $gender = $request->input("gender");
        $religion = $request->input("religion");
        
        $db = DB::table('locations')->select("locations.*")
                ->join('trips', 'locations.id', '=', 'trips.location_id');

        if($location && is_array($location)){
            foreach($location as $location_single){
                $db->where("locations.type", "like", "%$location_single%");
            }
        }
        if($gender && is_array($gender)){
            $db->where(function($query) use ($gender){
                if(in_array("all_gender", $gender)){
                    $query->orWhere("trips.allGender", '1');
                }
                if(in_array("only_men", $gender)){
                    $query->orWhere("trips.onlyMens", '1');
                }
                if(in_array("only_women", $gender)){
                    $query->orWhere("trips.onlyWomens", '1');
                }
            });
        }
        if($religion && is_array($religion)){
            $db->where(function($query) use ($religion){
                if(in_array("all", $religion)){
                    $query->orWhere("trips.allCast", '1');
                }
                if(in_array("buddhism", $religion)){
                    $query->orWhere("trips.buddhismCast", '1');
                }
                if(in_array("hindu", $religion)){
                    $query->orWhere("trips.hinduCast", '1');
                }
                if(in_array("sikhism", $religion)){
                    $query->orWhere("trips.sikhismCast", '1');
                }
                if(in_array("islam", $religion)){
                    $query->orWhere("trips.islamCast", '1');
                }
                if(in_array("christian", $religion)){
                    $query->orWhere("trips.christianCast", '1');
                }
            });
        }

        $db->groupBy("locations.id");
        $data['datas'] = $db->get();
    	return view('User.welcome', $data);
    }

    public function ongoing_trip(Request $request){
        $data = [];
        $data['data_served_areas'] = config('constant.location_served_areas');
        $data["genders"] = config('constant.genders');
        $data["religions"] = config('constant.religions');

        $db = DB::table('locations')->select('locations.*', DB::raw('sum(booking_details.no_of_person) as no_of_bookings'))
                    ->join('trips', 'locations.id', '=', 'trips.location_id')
                    ->join('booking_details', 'trips.id', '=', 'booking_details.trip_id')
                    ->where('locations.use', '>', 0)
                    ->groupBy('locations.id', 'trips.id')
                    ->having('no_of_bookings', ">", 0)
                    ->get();
        
        $data['datas'] = $db;
    	return view('User.welcome', $data);
    }
}
