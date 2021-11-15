<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Location;
use App\Hotel;
use App\Meal;
use App\Transfer;
use App\Midtrip;
use App\Trip;

class TripControllers extends Controller
{
    public function location(){
    	$id = session('tour_operator_data')['id'];
		$data = Location::where('tour_operator_id',$id)->get();
		return view('Seller.addTrip',['location'=>$data]);
    }

    public function send(Request $req){
    	$location = $req -> location_name;
        $locationArray = explode('*', $location);
        
        $location_id = $locationArray[0];
        $location_name = $locationArray[1];

        $day = $req -> number_of_day;
        $night = $req -> number_of_night;

        
        
        //Hotels
        $id = session('tour_operator_data')['id'];
        
        $hotels = Hotel::where('location_id', $location_id)->get();
        
        //Meals
        $meals = Meal::where('location_id', $location_id)->get();

        //Transfer
        $transfers = Transfer::where('tour_operator_id',$id)->get();

        //midtrip
        $midtrips = Midtrip::where('location_id', $location_id)->get();
        
        $data = [
        		"day"=>$day,"location_name"=>$location_name,
        		"location_id"=>$location_id,"hotel"=>$hotels,
        		"meal"=>$meals,"transfer"=>$transfers,"midtrip"=>$midtrips
        	];
        //return $data;
        return view('Seller.addTripNext',['data'=>$data]);
    }

    public function add(Request $req) {
        $day = $req -> number_of_day;
        $hotel = $req -> hotels;
        $midtrip = $req -> midtrip;

        //create hotel string
        $countHotel = count($hotel);
        $hotelString = '';
        $check = 1;
        for($i = 0; $i < $countHotel; $i++){
            $hotelId =  $hotel[$i];
            if($hotelId != '000'){
                //Hotel Use Update
                $hotelData = Hotel::find($hotelId);
                $hotelUse = $hotelData['use'];
                $hotelUse = $hotelUse + 1;
                $hotelData['use'] = (int)$hotelUse;
                $hotelData -> save();
                
                if($check == $countHotel){
                    $hotelString .= $hotelId;
                }
                else{
                    $hotelString .= $hotelId.",";
                }
            }
            else{
                if($check == $countHotel){
                    $hotelString .= '000';
                }
                else{
                    $hotelString .= '000,';
                }
            }
            $check = $check + 1;
        }

        //create midtrip string
        $countMidtrip = count($midtrip);
        $midtripString = '';
        $check = 1;
        for($i = 0; $i < $countMidtrip; $i++){
            $midtripId = $midtrip[$i];

            //Midtrip Use Update
            $midtripDatas = Midtrip::find($midtripId);
            $midtripUse = (int)$midtripDatas['use'];
            $midtripUse = $midtripUse + 1;
            $midtripDatas['use'] = (int)$midtripUse;
            $midtripDatas -> save();
            if($check == $countMidtrip){
                $midtripString .= $midtrip[$i];
            }
            else{
                $midtripString .= $midtrip[$i].",";
            }
            $check = $check + 1; 
        }

        $allGender = $req -> all_gender;
        $onlyMens = $req -> only_men;
        $onlyWomens = $req -> only_women;

        

        $Religions_all = $req -> Religions_all;
        $Religions_buddhism = $req -> Religions_buddhism;
        $Religions_hindu = $req -> Religions_hindu;
        $Religions_sikhism = $req -> Religions_sikhism;
        $Religions_islam = $req -> Religions_islam;
        $Religions_christian = $req -> Religions_christian;

        //meal Use Update
        $mealId = $req -> meal;
        $mealData = Meal::find($mealId);
        $mealUse = $mealData['use'];
        $mealUse = $mealUse + 1;
        $mealData['use'] = (int)$mealUse;
        $mealData -> save();

        //Location Use Update
        $locationId = $req -> location_id;
        $locationData = Location::find($locationId);
        $locationUse = $locationData['use'];
        $locationUse = $locationUse + 1;
        $locationData['use'] = (int)$locationUse;
        $locationData -> save();

        //Transfer Use Update
        $transferId = $req -> transfer;
        $transferData = Transfer::find($transferId);
        $transferUse = $transferData['use'];
        $transferUse = $transferUse + 1; 
        $transferData['use'] = (int)$transferUse;
        $transferData -> save();

        $data = new Trip;

        $data -> tour_operator_id = session('tour_operator_data')['id'];
        $data -> location_id = $req -> location_id;
        $data -> location_name = $req -> location_name;
        $data -> trip_name = $req -> trip_name;
        $data -> no_of_days = $day;
        $data -> no_of_nights = $day -1; 
        $data -> hotels = $hotelString;
        $data -> midtrips = $midtripString;

        $data -> meal = $mealId;
        $data -> transfers= $transferId;
        
        /*Cast Start*/
        if($allGender){
            $data -> allGender = '1';    
        }

        if($onlyMens){
            $data -> onlyMens = '1';
        }
    
        if($onlyWomens){
            $data -> onlyWomens = '1';
        }
        /*Cast Stop*/

        /* Religion Start*/
        if($Religions_all){
            $data -> allCast = '1';    
        }

        if($Religions_buddhism){
            $data -> buddhismCast = '1';    
        }

        if($Religions_hindu){
            $data -> hinduCast = '1';    
        }

        if($Religions_sikhism){
            $data -> sikhismCast = '1';    
        }
       
        if($Religions_islam){
            $data -> islamCast = '1';    
        }
        
        if($Religions_christian){
            $data -> christianCast = '1';    
        }
        /* Religion Stop*/

        $data -> pickup_details = $req -> pickup;
        $data -> drop_details = $req -> drop;
        $data -> other_details = $req -> detail;

        $data -> save();        

        if($data){
            return redirect()->route('seller_trip')->with('message','Trip added Successfully');
        }
        else{
            return redirect()->route('seller_trip')->with('message','Trip Not added');
        }
        
    }

    public function see(){
        
        $id = session('tour_operator_data')['id'];
        $data = Trip::where('tour_operator_id',$id)->get();
        
        if($data != '[]'){
            $number = count($data);
            $inc = 1;

            for($i = 0; $i < $number; $i++){
                $hotealString = $data[$i]['hotels'];
                $hotealArray = explode(",",$hotealString);
                $countArray = count($hotealArray);
                $hotelName = '';

                //loop for hotels
                for($j = 0; $j < $countArray; $j++){
                    if($hotealArray[$j] != '000'){
                        $hotelId = $hotealArray[$j];
                        $hotelData = Hotel::where('id', $hotelId)->first();
                        if($inc == $countArray){
                            $hotelName .= $hotelData['hotel_name'];    
                        }else{
                            $hotelName .= $hotelData['hotel_name'].",";
                        }
                        
                    }
                    else{
                        if($inc == $countArray){
                            $hotelName .= "Not Select Hotel";    
                        }else{
                            $hotelName .= "Not Select Hotel,";
                        }
                    }
                    $inc = $inc + 1;
                }
                $hotelNamesArray[$i] = $hotelName;
                $inc = 1;
                
                //loop for midtrips

                $midtripString = $data[$i]['midtrips'];
                $midtripArray = explode(",",$midtripString);
                $countMidtripArray = count($midtripArray);
                $midtripName = '';

                for($k = 0; $k < $countMidtripArray; $k++){
                    $midtripId = $midtripArray[$k];
                    $midtripData = Midtrip::where('id',$midtripId)->first();
                    if($inc == $countMidtripArray) {
                        $midtripName .= $midtripData -> name;
                    }else{
                        $midtripName .= $midtripData -> name.",";
                    }
                    $inc = $inc + 1;
                }
                $midtripNamesArray[$i] = $midtripName; 
                $inc = 1;
            }

            return view('Seller.trip',
                [
                'tripData'=>$data,'hotelData'=>$hotelNamesArray,
                'dataLimit'=>$number,'midtripData'=>$midtripNamesArray
                ]
            );
        }
        else{
            return view('Seller.trip',['tripData'=>$data]);
        }
    }

    public function delete($id) {
        $tourId = session('tour_operator_data')['id'];
        $realId = base64_decode($id);
        $data = Trip::findOrFail($realId);

        if($data['tour_operator_id'] == $tourId){
            
            //For Hotels
            $hotalArray = explode(",",$data['hotels']);    
            $hotalCount = count($hotalArray);

            for($i = 0; $i < $hotalCount; $i++) {
                $hotelId = $hotalArray[$i];
                if($hotelId != '000'){
                    $hotelData  = Hotel::findOrFail($hotelId);
                    $hotelUse = (int)$hotelData['use'];
                    $hotelUse = $hotelUse - 1;
                    $hotelData['use'] = (int)$hotelUse;
                    $hotelData -> save();
                }
            }

            //For Midtrip
            $midtripArray = explode(",",$data['midtrips']);    
            $midtripCount = count($midtripArray);

            for($i = 0; $i < $midtripCount; $i++) {
                $midtripId = $midtripArray[$i];
                $midtripData  = Midtrip::findOrFail($midtripId);
                $midtripUse = (int)$midtripData['use'];
                $midtripUse = $midtripUse - 1;
                $midtripData['use'] = (int)$midtripUse;
                $midtripData -> save();  
            }

            //For Transfer
            $transferData = Transfer::findOrFail($data['transfers']);
            $transferUse = (int)$transferData['use'];
            $transferUse = $transferUse - 1;
            $transferData['use'] = (int)$transferUse;
            $transferData -> save(); 

            //For Meal
            $mealData = Meal::findOrFail($data['meal']);
            $mealUse = (int)$mealData['use'];
            $mealUse = $mealUse - 1;
            $mealData['use'] = (int)$mealUse;
            $mealData -> save();  

            //For Location
            $locationData = Location::findOrFail($data['location_id']);
            $locationUse = (int)$locationData['use'];
            $locationUse = $locationUse - 1;
            $locationData['use'] = (int)$locationUse;
            $locationData -> save();  

            //Delete Data

            if($data -> delete()){
                return redirect()->route('seller_trip')->with('message','Trip deleted Successfully');
            }
            else{
                return redirect()->route('seller_trip')->with('message','Trip not deleted Successfully');
            }
        }
        else{
            echo "Sorry";
        }        
    }
}
