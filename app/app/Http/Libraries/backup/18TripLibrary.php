<?php

namespace App\Libraries;

use App\Hotel;
use App\Midtrip;
use App\BookingDetail;
use Illuminate\Support\Facades\DB;

class TripLibrary{
    public static function get_trip_calculated_details($loc, $nod, $nop, $nor, $bt, $trip_date, $trip_id = null, $params = []){
        $commission_percent = ($params && array_key_exists("commission_percent", $params) && $params["commission_percent"]) ? (int)$params["commission_percent"] : 8;
        if($nod == 0){
            $db = DB::table('trips')
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
                    ->where('trips.location_name',$loc);
            if($trip_id){
                $db->where("trips.id", $trip_id);
            }
            $data = $db->get();
        }
        else{
            $db = DB::table('trips')
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
                    ->where('trips.no_of_days',$nod);
            if($trip_id){
                $db->where("trips.id", $trip_id);
            }
            $data = $db->get();
        }
        // echo json_encode($data);die;

        $incrementData = 0;
        
        foreach ($data as $datas) {
            if($data != '[]'){
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
                        // $p=$a*$nc;
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

                $hotel_price = 0;
                if($bt == 1){
                    $hotel_price = $nor * $single_bed_type_cost;
                }
                elseif($bt == 2){
                    $hotel_price = $nor * $double_bed_type_cost;  
                }
                else{
                    $hotel_price = $nor * $triple_bed_type_cost;   
                }


                $tripPrices = 0;
                $payable_amount = 0;
                $subtotal_price = $hotel_price +  $p + $mealPrice;
                $tripPrices = $subtotal_price;
                //Touristtribe 
                $tourist_percent_price = $tripPrices * $commission_percent;//touristtribe 
                $tripPrices = $tripPrices + $tourist_percent_price;

                $gst_price = 0;
                if($datas -> gst){
                    $gst_price = $tripPrices * 0.05;//gst
                    $tripPrices = $tripPrices + $gst_price;
                    $payable_amount = $subtotal_price + $gst_price;
                }else{
                    $payable_amount = $subtotal_price;
                }

                $payumoney_price = $tripPrices * 0.02;//payumoney gateway charges
                $tripPrices = $tripPrices + $payumoney_price;
                $tripPrices = $tripPrices;


                $tripPricesData[$incrementData] = [
                    "hotel_price" => $hotel_price,
                    "transfer_price" => $p,
                    "meal_price" => $mealPrice,
                    "subtotal_price" => $subtotal_price,
                    "tourist_percent_price" => $tourist_percent_price,
                    "gst_price" => $gst_price,
                    "payumoney_price" => $payumoney_price,
                    "total_price" => $tripPrices,
                    "payable_amount" => $payable_amount
                ];
                $incrementData = $incrementData + 1;

            }
        }

        return [
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
        ];
    }

    
    public static function updateCashbackAmount($trip_id){
        $trip = DB::table("trips as t")->select("t.id", "t.transfers", "ts.total_person", "ts.total_cost")
                    ->leftJoin("transfers as ts", "ts.id", "=", "t.transfers")
                    ->where("t.id", $trip_id)
                    ->first();
        $booking_details = DB::table("booking_details as bd")
                            ->select("bd.id", "bd.trip_id", "bd.no_of_person", "bd.trip_transfer_price")
                            ->where("bd.trip_id", $trip_id)
                            ->get();
        $total_no_of_person = array_sum(array_column($booking_details->toArray(), "no_of_person"));
        foreach($booking_details as $booking_detail){
            $cashback = $booking_detail->trip_transfer_price - (($trip->total_cost/$total_no_of_person)*$booking_detail->no_of_person);
            BookingDetail::where("id", $booking_detail->id)->update([
                "cashback_amount" => $cashback
            ]);
        }
    }
}
?>