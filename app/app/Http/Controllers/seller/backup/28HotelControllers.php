<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Location;
use App\Hotel;
use App\Trip;

class HotelControllers extends Controller
{
    public function location() {
    	$id = session('tour_operator_data')['id'];
		$data = Location::where('tour_operator_id',$id)->get();
        
        return view('Seller.addHotel',['location'=>$data]);
    }

    public function add(Request $req) {
    	
        $location = $req -> location_name;
        $locationArray = explode('*', $location);
        
        $location_id = $locationArray[0];
        $location_name = $locationArray[1];
        $hotel_pic_string = '';
        $data = new Hotel;
	
		$data -> tour_operator_id = session('tour_operator_data')['id'];    	
    	$data -> location_id = $location_id;
        $data -> location_name = $location_name;
    	$data -> hotel_name = $req -> hotel_name;
    	$data -> rating = $req -> hotel_rating;

    	$data -> single_bed_type_cost = $req -> room_cost_single;
    	$data -> double_bed_type_cost = $req -> room_cost_double;
    	$data -> triple_bed_type_cost = $req -> room_cost_triple;
    	
    	$data -> type = $req -> hotel_type;
    	$hotel_pics = $req -> hotel_pics;
    	
        if($hotel_pics){
        	foreach ($hotel_pics as $images) {
                $pathOfPic = $images -> store('public');
                $arrayPics[] = $pathOfPic;
            }

            $array_length = count($arrayPics);
            $hotel_pic_string = '';
            $real_array = $array_length - 1;

            for($i = 0; $i < $array_length; $i++){
            	if($i == $real_array){
            		$hotel_pic_string .= $arrayPics[$i];
            	}
            	else{
            		$hotel_pic_string .= $arrayPics[$i].",";	
            	}
            }
        }
        $data -> images = $hotel_pic_string;
        $data -> save();

		return redirect()->route('seller_hotel')->with('message','Hotel added Successfully');
    }

    public function see(){
        $id = session('tour_operator_data')['id'];
        $data = Hotel::where('tour_operator_id',$id)->get();
        //return $data;
        return view('Seller.hotel',['hotelData'=>$data]);
    }

    public function delete($id){
        $tourId = session('tour_operator_data')['id'];
        $realId = base64_decode($id);
        $data = Hotel::findOrFail($realId);
         
        if($data['tour_operator_id'] == $tourId){
            if($data['use'] == 0){
                $imgArray = explode(',',$data['images']);
                $imgCount = count($imgArray);

                for($i = 0; $i < $imgCount; $i++) {
                    $realImg = $imgArray[$i];
                    if(Storage::delete($realImg)){
                        echo "Deleted";
                    }
                    else{
                        echo "Sorry";
                    }
                }
                $data -> delete();
                return redirect()->route('seller_hotel')->with('message','Hotel deleted Successfully');
            }
            else{
                echo "Not Possible";
            }    
        }
        else{
            echo "Sorry";
        }        
    }
}
