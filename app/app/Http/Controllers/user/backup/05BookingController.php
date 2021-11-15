<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Trip;
use App\Hotel;
use App\Midtrip;
use App\BookingDetail;

class BookingController extends Controller
{
    public function booking(Request $req,$id){
    	$nop = $req -> nop;
    	$nor = $req -> nor;
    	$bt = $req -> bt;
    	$nod = $req -> nod;
    	$trip_date = $req -> trip_date;
    	$trip_price = $req -> trip_price;


    	$tripDetails = DB::table('trips')
                    ->join('meals','trips.meal','=','meals.id')
                    ->join('transfers','trips.transfers','=','transfers.id')
                    ->join('locations','trips.location_id','=','locations.id')
                    ->join('tour_operators','trips.tour_operator_id','=','tour_operators.id')
                    ->select
                        (
                            'trips.*',
                            'meals.breakfast_details','meals.lunch_details','meals.evening_tea_details',
                            'meals.dinner_details',
                            'transfers.name as vehicalName','transfers.type as vehicalType',
                            'locations.type as locationsType',
                            'tour_operators.comp_name','tour_operators.gst','tour_operators.name'
                        )
                    ->where('trips.id',$id)
                    ->first();

        //midtrip Data start
        $midtripString = $tripDetails -> midtrips;
        $midtripArray = explode(",", $midtripString);
        $midtripCount = count($midtripArray);
                    
        for($i = 0; $i < $midtripCount; $i++) {
            $midtripId = $midtripArray[$i];
            $midtripData = Midtrip::find($midtripId);
            $midtripDataNew[$i] = json_decode($midtripData);
        } 
        //midtrip Data stop
        
        //Hotels Data start
        $hotelsString = $tripDetails -> hotels;
        $hotelArray = explode(",", $hotelsString);
        $hotelCount = count($hotelArray);
        
        for($i = 0; $i < $hotelCount; $i++) {
            $hotelId = $hotelArray[$i];
            if($hotelId != '000') {
                $hotelData = Hotel::find($hotelId);         
                $hotalDataNew[$i] = json_decode($hotelData);
            }
        }
        //Hotels Data stop

        
    	return view('User.trip_booking',[
            "data"=>$tripDetails,
            "nop"=>$nop,
            "nor"=>$nor,
            "bt"=>$bt,
            "nod"=>$nod,
            "trip_date"=>$trip_date,
            "trip_price"=>$trip_price,
            "hotel" => $hotalDataNew,
            "midtrip" => $midtripDataNew
        ]);        
    }

    public function familyBooking(Request $req,$id){
        $nop  = $req -> nop;
        $nor = $req -> nor;
        $bt = $req -> bt;
        $nod = $req -> nod;
        $trip_date = $req -> trip_date;
        
        $data = DB::table('trips')
                    ->join('meals','trips.meal','=','meals.id')
                    ->join('transfers','trips.transfers','=','transfers.id')
                    ->join('locations','trips.location_id','=','locations.id')
                    ->join('tour_operators','trips.tour_operator_id','=','tour_operators.id')
                    ->select
                        (
                            'trips.*',
                            'meals.per_head_cost as mealPrice','meals.breakfast_details','meals.lunch_details',
                            'meals.evening_tea_details','meals.dinner_details',
                            'transfers.name as vehicalName','transfers.type as vehicalType',
                            'transfers.total_person as vehicalTotalPerson',
                            'transfers.total_cost as vehicalCost',
                            'locations.type','locations.total_member_size','locations.min_family_member',
                            'tour_operators.comp_name','tour_operators.gst'
                        )
                    ->where('trips.id',$id)
                    ->get();
        
        //Hotels prices
        $hotelsString = $data['0'] -> hotels;
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

        //midtrip Data
        $midtripString = $data['0'] -> midtrips;
        $midtripArray = explode(",", $midtripString);
        $midtripCount = count($midtripArray);
                    
        for($i = 0; $i < $midtripCount; $i++) {
            $midtripId = $midtripArray[$i];
            $midtripData = Midtrip::find($midtripId);
            $midtripDataNew[$i] = json_decode($midtripData);
        }

        //Vehical Price Calculations Start
        $trip_capacity = $data['0'] -> total_member_size;
        $vehical_capacity = $data['0'] -> vehicalTotalPerson;
        $vehical_price = $data['0'] -> vehicalCost;
        $booking_number = 0;

        $vc = $vehical_capacity;
        $vp = $vehical_price;
        $ec = $booking_number;
        $nc = $nop;
                            
        $c = $ec + $nc;//total_seat
        if($trip_capacity >= $c){
            if($vc < $c){
                $b = $c % $vc;
                $cc = $c / $vc;
                    
                $a0 = $nc - $b;
                $a1 = $vp;
                $a2 = $vp/$vc;
                $a3 = $a2 * $a0;
                if($b == 0){
                    $p = $a3;
                }
                else{
                    $p = $a3 + $vp;
                    //vehical price is $p
                }
            }
            else{
                $s = $vp/$c;
                $p = $s * $nc;
            }            
        }
        else{
            //echo "Sorry booking not possible";
            $p = 0;
        }
        /* vehical price calculations close*/

        if($bt == 1){
            $tripPrices = $nor * $single_bed_type_cost;
        }
        elseif($bt == 2){
            $tripPrices = $nor * $double_bed_type_cost;  
        }
        else{
            $tripPrices = $nor * $triple_bed_type_cost;   
        }

        $tripPrices = $tripPrices + ($nop * ($data['0'] -> no_of_days * $data['0'] -> mealPrice));
        $tripPrices = $tripPrices + $p;

        //Touristtribe 
        $tripPrices = $tripPrices * 1.08;//touristtribe 

        if($data['0'] -> gst){
            $tripPrices = $tripPrices * 1.05;//gst
        }

        $tripPrices = $tripPrices * 1.02;//payumoney

        return view("User.family_booking",[
            "data" => $data,
            "hotel" => $hotalDataNew,
            "midtrip" => $midtripDataNew,
            "trip_price" => $tripPrices,
            "nop" => $nop,
            "nor" => $nor,
            "bt" => $bt,
            "nod" => $nod,
            "trip_date" => $trip_date
        ]);         
    }

    public function email(){
        $details = [
            'title' => "This is title",
            'subject' => 'This is subject'
        ];
        Mail::to("touristtribe.official@gmail.com")->send(new \App\Mail\sendMail($details));
    }

    public function payment(Request $req,$id){
        
        $payment = $req -> payment;
        $nop = $req -> nop;
        $nor = $req -> nor;
        $bt = $req -> bt;
        $trip_date = $req -> trip_date;
        $for = $req -> bookingfor;

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

        $MERCHANT_KEY = "ayvqgdEG";
        $SALT = "7k5t0xEEWm";
        $userId = session('sessionId');
        $name = session('sessionUser_name');
        $email = session('sessionEmail');
        $phone = session('sessionPhone');

        if(session('sessionId')){
            return view('User.payment',[
                "payment" => $payment,
                "MERCHANT_KEY" => $MERCHANT_KEY,
                "SALT" => $SALT,
                "name" => $name,
                "email" => $email,
                "phone" => $phone,
                "nop" => $nop,
                "nor" => $nor,
                "bt" => $bt,
                "trip_date" => $trip_date,
                "id" => $id,
                "txnid" => $txnid,
                "userID" => $userId,
                "for" => $for
            ]);
        }
        else{
            return redirect()->route("user_home")->with("message","Please login first");
        }
    }

    public function success(Request $req){

        if($req -> status == "success"){
            $data = new BookingDetail;

            $data -> trip_id = $req -> productinfo;
            $data -> user_id = $req -> udf5;
            $data -> person_name = $req -> firstname;
            $data -> person_email = $req -> email;
            $data -> person_mobile = $req -> phone;
            $data -> no_of_person = $req -> udf1;
            $data -> no_of_room = $req -> udf2;
            $data -> room_type = $req -> udf3;
            $data -> bookingDate = $req -> udf4;
            $data -> booking_payment_mode = "online";
            $data -> booking_for =  $req -> city;
            $data -> booking_payu_money_id = $req -> payuMoneyId;
            $data -> total_booking_amount = $req -> amount;
            $data -> booking_amount_paid = $req -> net_amount_debit;
            $data -> booking_amount_not_paid = $req -> discount;
            
            $booking_amount_paid = $req -> net_amount_debit;
            $booking_amount_not_paid = $req -> discount;

            $check =  $booking_amount_paid + $booking_amount_not_paid;

            if($booking_amount_paid == $check){
                $data -> booking_amount_full_paid = "yes";
            }else{
                $data -> booking_amount_full_paid =  "no"; 
            }
            $data -> save();

            $details = [
                'title' => "Congress Your trip Confirm",
                'subject' => "Your Trip Id Number is :-".$req -> productinfo.".",
                'Date' => "Date :- ".$req -> udf4." .",
            ];
            Mail::to($req -> email)->send(new \App\Mail\sendMail($details));
            return redirect()->route("user_home")->with("message","Congress Your trip Confirm");
        }
        else{
            echo "Sorry Something error";
        }
        
    }
    public function fail(Request $req){
        $tripId = $req -> productinfo;
        $userId = $req -> udf5;
        $person_name = $req -> firstname;
        $person_email = $req -> email;
        $details = [
                'title' => "Trip Cancelled By User",
                'subject' => "Trip Cancelled",
                'Date' => date('Y-m-d')
            ];
        Mail::to($person_email)->send(new \App\Mail\sendMail($details));
        return redirect()->route("user_home")->with("message","Sorry Your trip Cancelled");
    }
}
