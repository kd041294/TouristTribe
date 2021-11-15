<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TourOperator;
use Validator;
use App\Hotel;
use App\Midtrip;
use App\Meal;
use App\Transfer;

class TripControllers extends Controller
{
    public function seeComp(Request $req, $comp_name, $loc){
        return $this->see($req, $loc, $comp_name);
    }
    
    public function see(Request $req,$loc, $comp_name = null) {
        //Receive Data
        // echo 1;die;
        $tour_operator_id = TourOperator::get_id_by_company_name($comp_name);
        $commission_percent = TourOperator::get_commission_by_company_name($comp_name);
        // echo json_encode($req->all());die;
        $trip_all_price_details = [];
        date_default_timezone_set("Asia/Calcutta");
        $calculation = $req -> cal ?? "no";
        $nop = $req -> nop ?? 1;
        $nor = $req -> nor ?? 1;
        $bt = $req -> bt ?? 1;
        $nod = $req -> nod ?? 0;
        $trip_date = $req -> trip_date ?? date("Y-m-d");
        // echo $calculation." ".$nop." ".$nor." ".$bt." ".$nod." ".$trip_date;die; 
        //data get
        if($nod == 0){
            $data = DB::table('trips')
                    ->join('meals','trips.meal','=','meals.id')
                    ->join('transfers','trips.transfers','=','transfers.id')
                    ->join('locations','trips.location_id','=','locations.id')
                    ->join('tour_operators','trips.tour_operator_id','=','tour_operators.id')
                    ->select
                        (
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
                    ->get();
        }
        else{
            $data = DB::table('trips')
                    ->join('meals','trips.meal','=','meals.id')
                    ->join('transfers','trips.transfers','=','transfers.id')
                    ->join('locations','trips.location_id','=','locations.id')
                    ->join('tour_operators','trips.tour_operator_id','=','tour_operators.id')
                    ->select
                        (
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
        // echo json_encode($data);die;
        foreach ($data as $datas) {
            if($data != '[]'){
                $tripPrices = 0;    
                //Hotels Data start
                $hotelsString = $datas -> hotels;
                $hotelArray = explode(",", $hotelsString);
                $hotelCount = count($hotelArray);

                $inc = 0;
                $single_bed_type_cost = 0;
                $double_bed_type_cost = 0;
                $triple_bed_type_cost = 0;

                for($i = 0; $i < $hotelCount; $i++) {
                    $hotelId = $hotelArray[$i];
                    if($hotelId != '000') {
                            $hotelData = Hotel::find($hotelId);
                        if($hotelData['single_bed_type_cost']){
                            $single_bed_type_cost = $single_bed_type_cost + $hotelData['single_bed_type_cost'];
                        }
                        if($hotelData['double_bed_type_cost']){
                            $double_bed_type_cost = $double_bed_type_cost + $hotelData['double_bed_type_cost'];
                        }
                        if($hotelData['triple_bed_type_cost']){
                            $triple_bed_type_cost = $triple_bed_type_cost + $hotelData['triple_bed_type_cost'];
                        }         
                        $hotalDataNew[$inc] = json_decode($hotelData);
                        $inc = $inc + 1;
                    }
                }

                $hotelIncrementData[$incrementData] = $hotalDataNew;
                //Hotels Data stop

                //midtrip Data start
                $midtripString = $datas -> midtrips;
                $midtripArray = explode(",", $midtripString);
                $midtripCount = count($midtripArray);
                    
                for($i = 0; $i < $midtripCount; $i++) {
                    $midtripId = $midtripArray[$i];
                    $midtripData = Midtrip::find($midtripId);
                    $midtripDataNew[$i] = json_decode($midtripData);
                }
                $midtripIncrementData[$incrementData] = $midtripDataNew; 
                // echo json_encode($midtripIncrementData);
                //midtrip Data stop
                
                //Bokking Number Start
                $bookingCount = DB::table('booking_details')
                                ->where('trip_id',$datas -> id)
                                ->where('bookingDate',$trip_date)
                                ->get();

                $numberOfPersonBooking = 0;
                foreach ($bookingCount as $bookingCounts) {
                    $numberOfPersonBooking = $numberOfPersonBooking + $bookingCounts -> no_of_person;
                }
                $bookingIncrementData[$incrementData] = $numberOfPersonBooking;
                //Booking Number Close

                //Vehical Price Calculations Start
                $trip_capacity = (int)$datas -> total_member_size;
                $vehical_capacity = (int)$datas -> vehicalTotalPerson;
                $vehical_price = (int)$datas -> vehicalCost;

                $vc = $vehical_capacity;
                $vp = $vehical_price;
                $ec = $numberOfPersonBooking;
                $nc = $nop;
                            
                $c = $ec + $nc;//total_seat
                if($trip_capacity >= $c){
                    
                $a=$vp/$vc;

                if($ec==0 && $nc<=$vc)
                {
                    //  $p=$a*$nc;
                    $p = $vp;
                }
                else if($ec==0 && $nc>$vc)
                {
                    $b=$nc%$vc;
                    $d=(int)($nc/$vc);
                    if($b!=0)
                    {
                        $d++;
                        $p=$d*$vp;
                    }
                    else
                    {
                        $p=$d*$vp;
                    }
                }
                else if($ec!=0 && $c<=$vc)
                {
                    // $p=$a*$nc;
                    $p1=$vp/$c;
                    $p=$p1*$nc;
                }
                else if($ec!=0 && $c>$vc)
                {
                    $b=$nc%$vc;    
                    $d=(int)($nc/$vc);
                    $e=$ec%$vc;
                    $e=$vc-$e;
                    if($b<=$e)
                    {
                        $p1=$a*$e;
                        $p2=$d*$vp;
                        $p=$p1+$p2;
                    }
                    else
                    {
                        $d++;
                        $p=$d*$vp;
                    }
                }
                    
                    
                    // if($vc < $c){
                    //     $b = $c % $vc;
                    //     $cc = $c / $vc;
                    
                    //     $a0 = $nc - $b;
                    //     $a1 = $vp;
                    //     $a2 = $vp/$vc;
                    //     $a3 = $a2 * $a0;
                    //     if($b == 0){
                    //         $p = $a3;
                    //     }
                    //     else{
                    //         $p = $a3 + $vp;
                    //         //vehical price is $p
                    //     }
                    // }
                    // else{
                    //     $s = $vp/$c;
                    //     $p = $s * $nc;
                    // }         
                    $tripError[$incrementData] = "Possible";   
                }
                else{
                    //echo "Sorry booking not possible";
                    $p = 0;
                    $tripError[$incrementData] = "Not Possible";
                }
                /* vehical price calculations close*/

                //meal Prices
                $mealPrice = 0;
                $mealPrice = $nop * ($datas -> no_of_days * $datas -> mealPrice);
                //All price Calculation 

                if($bt == 1){
                    $tripPrices = $nor * $single_bed_type_cost;
                }
                elseif($bt == 2){
                    $tripPrices = $nor * $double_bed_type_cost;  
                }
                else{
                    $tripPrices = $nor * $triple_bed_type_cost;   
                }

                // echo $p." ";
                $tripPrices = $tripPrices +  $p + $mealPrice;
                //Touristtribe 
                $tripPrices = $tripPrices * (1+$commission_percent);//touristtribe 
                if($datas -> gst){
                    $tripPrices = $tripPrices * 1.05;//gst
                }

                $tripPrices = $tripPrices * 1.02;//payumoney gateway charges

                
                $tripPricesData[$incrementData] = (int)$tripPrices;
                $incrementData = $incrementData + 1;

            }
        }
        // die;
        // echo json_encode($midtripIncrementData);die;

        
        if($data != '[]'){
            return view('User.trip_details',[
            "data" => $data,
            "hotels" => $hotelIncrementData,
            "midtrip" => $midtripIncrementData,
            "numberOfTrip" => $incrementData,
            "tripPrices" => $tripPricesData,
            "booking" => $bookingIncrementData,
            "nop" => $nop,
            "nor" => $nor,
            "bt" => $bt,
            "nod" => $nod,
            "trip_date" => $trip_date,
            "loc" => $loc,
            "tripError" => $tripError,
            "is_comp_passed" => ($tour_operator_id) ? 1 : 0

            ]);
        }
        else{
            return "Sorry Trip Not Found in $nod day";
        }
    }
}