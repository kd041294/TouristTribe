<?php

namespace App\Http\Controllers\user;

use App\Trip;
use App\Hotel;
use Exception;
use Validator;
use App\Coupon;
use App\Midtrip;

use App\TourOperator;
use App\BookingDetail;
use Illuminate\Http\Request;
use App\Http\Libraries\TripLibrary;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function bookingComp(Request $req, $comp_name, $id){
        return $this->booking($req, $id, $nop, $comp_name);
    }
    public function booking(Request $req,$id, $comp_name = null){

        $error = "";
        $message = "";

        // $comp_name = "TheNewUser";
        // echo json_encode($req->all());die;
    	$nop = $req -> nop;
    	$nor = $req -> nor;
    	$bt = $req -> bt;
    	$nod = $req -> nod;
    	$trip_date = $req -> trip_date;
        $trip_price = $req -> trip_price;
        $trip_id = $req-> trip_id;
        $coupon_id = $req -> coupon_id ? $req -> coupon_id : null;
        $coupon_name = $req -> coupon_name ? $req -> coupon_name : null;
        
        if($coupon_name){
            try{
                $req->flash();
                $validator = Validator::make($req->all(), [
                    "coupon_name" => "required"
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $coupon = Coupon::where('coupon_name', $coupon_name)->first();
                
                if(!$coupon) throw new Exception("Coupon Code is Invalid.");

                if(!$coupon->status) throw new Exception("Coupon is Expired.");

                $coupon_id = $coupon->id ? $coupon->id : null;

                $trip_price = base64_encode(base64_decode((int)$trip_price) - $nop * $coupon->coupon_value); 
                
            }catch(Exception $e){
                $error = $e->getMessage();
            }
        }
        // echo base64_decode($trip_price);die;

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
                    

        $previously_booked_dates = DB::table('booking_details as bd')->select(DB::raw('distinct(bd.starting_date)'))->where('bd.trip_id', '=', $trip_id)->get();


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
            "midtrip" => $midtripDataNew,
            "previously_booked_dates" => $previously_booked_dates,
            "error" => $error,
            "message" => $message,
            "coupon_id" => $coupon_id
        ]);
       
    }
    
    
  
    
    
    
    
    
    

    public function familyBookingComp(Request $req, $comp_name, $id){
        return $this->familyBooking($req, $id, $comp_name);
    }
    public function familyBooking(Request $req,$id, $comp_name = null){
        $nop  = $req -> nop;
        $nor = $req -> nor;
        $bt = $req -> bt;
        $nod = $req -> nod;
        $trip_date = $req -> trip_date;
        
        $data = DB::table('trips')
                    ->join('per_head_extra_fees', 'trips.per_head_extra_fees_id', '=', 'per_head_extra_fees.id')
                    ->join('meals','trips.meal','=','meals.id')
                    ->join('transfers','trips.transfers','=','transfers.id')
                    ->join('locations','trips.location_id','=','locations.id')
                    ->join('tour_operators','trips.tour_operator_id','=','tour_operators.id')
                    ->select
                        (
                            'trips.*',
                            'per_head_extra_fees.per_head_cost', 'per_head_extra_fees.fee_details',
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
                   
                   
        $incrementData = 0;      
        
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
        //$booking_number = 0;

        $vc = $vehical_capacity;
        $vp = $vehical_price;
        $ec = 0;
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
                        $p=$a*$nc;
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
        }
        /* vehical price calculations close*/
        
                //    license fees calculation
                    $license_fee_amount = $data['0']->per_head_cost; 
                
                
              
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
      

        $tripPrices = $tripPrices + ($nop * ($data['0'] -> no_of_days * $data['0'] -> mealPrice));
        $tripPrices = $tripPrices + $p + $license_fee_amount;

        //Touristtribe 
        $tripPrices = $tripPrices * 1.08;//touristtribe 

        if($data['0'] -> gst){
            $tripPrices = $tripPrices * 1.05;//gst
        }

        $tripPrices = ($tripPrices * 1.02);//payumoney  
        $tripPrices = base64_encode((int)$tripPrices);

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

    public function paymentComp(Request $req, $comp_name, $id){
        return $this->payment($req, $id, $comp_name);
    }
    public function payment(Request $req,$id, $comp_name = null){
        
        // $comp_name = "TheNewUser";
        $commission_percent = TourOperator::get_commission_by_company_name($comp_name);
        // echo $commission_percent;die;
        $payment = $req -> payment;
        $nop = $req -> nop;
        $nor = $req -> nor;
        $bt = $req -> bt;
        $nod = $req -> nod;
        $trip_date = $req -> trip_date;
        $for = $req -> bookingfor;
        $coupon_id = $req -> coupon_id; 

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
                "nod" => $nod,
                "trip_date" => $trip_date,
                "id" => $id,
                "txnid" => $txnid,
                "userID" => $userId,
                "for" => $for,
                "commission_percent" => $commission_percent,
                "coupon_id" => $coupon_id
            ]);
        }
        else{
            return redirect()->route("user_home")->with("message","Please login first");
        }
    }

    public function success(Request $req){

        if($req -> status == "success"){
            // echo json_encode($req->all());die;
            $trip_id = $req->productinfo;
            $trip = Trip::find($trip_id);
            $loc = $trip->location_name;
            $params = json_decode(html_entity_decode($req->udf2), true);
            $nod = $params["nod"];
            $nop = $params["nop"];
            $nor = $params["nor"];
            $bt = $params["bt"];
            $coupon_id = $params["coupon_id"];
            $coupon_amount = 0;
            $commission_percent = $params["commission_percent"];
            $trip_date = $req->udf3;
            $trip_calculated_data = TripLibrary::get_trip_calculated_details($loc, $nod, $nop, $nor, $bt, $trip_date, $trip_id, ["commission_percent"=>$commission_percent]);

            if($coupon_id){
                $coupon = Coupon::find($coupon_id);
                $coupon_amount = $nop * $coupon->coupon_value;
            }
            
            
            // echo json_encode($trip_calculated_data);die;
            $new_nod = $nod - 1;
            $data = new BookingDetail;
            $data -> trip_id = $trip_id;
            $data -> user_id = $req -> udf1;
            $data -> coupon_id = $coupon_id;
            $data -> person_name = $req -> firstname;
            $data -> person_email = $req -> email;
            $data -> person_mobile = $req -> phone;
            $data -> no_of_person = $nop;
            $data -> no_of_room = $nor;
            $data -> no_of_days = $nod;
            $data -> room_type = $bt;
            $data -> bookingDate = $trip_date;
            $data -> starting_date = $trip_date;
            $data -> ending_date = date('Y-m-d', strtotime($trip_date. ' + '.$new_nod.' days'));
            $data -> booking_payment_mode = "online";
            $data -> booking_for =  $req -> city;
            $data -> booking_payu_money_id = $req -> payuMoneyId;
            $data -> trip_hotel_price = $trip_calculated_data["tripPrices"][0]["hotel_price"];
            $data -> trip_transfer_price = $trip_calculated_data["tripPrices"][0]["transfer_price"];
            $data -> trip_meal_price = $trip_calculated_data["tripPrices"][0]["meal_price"];
            $data -> license_fees_amount = $trip_calculated_data["tripPrices"][0]["license_fees_amount"];
            $data -> tourist_percentage_amount = $trip_calculated_data["tripPrices"][0]["tourist_percent_price"];
            $data -> tour_operator_percentage_amount = $trip_calculated_data["tripPrices"][0]["tour_operator_percent_amount"];
            $data -> gst_amount = $trip_calculated_data["tripPrices"][0]["gst_price"];
            $data -> payumoney_amount = $trip_calculated_data["tripPrices"][0]["payumoney_price"];
            $data -> coupon_amount = $coupon_amount;
            $data -> payable_amount = $trip_calculated_data["tripPrices"][0]["payable_amount"];
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

            // update the cashback
            TripLibrary::updateCashbackAmount($trip_id);

            $details = [
                'title' => "Congrats Your trip Confirmed",
                'subject' => "Your Trip Id Number is :-".$req -> productinfo.".",
                'Date' => "Date :- ".$req -> udf4." .",
            ];
            Mail::to($req -> email)->send(new \App\Mail\sendMail($details));
            return redirect()->route("user_home")->with("message","Congrats Your trip Confirm");
        }
        else{
            echo "Sorry, something went wrong";
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
