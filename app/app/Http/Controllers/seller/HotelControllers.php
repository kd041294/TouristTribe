<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Exception;
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
                // \Tinify\setKey("RZwyy1B0c2bz6rMxMXZQB4rd6Jlmlhzy");
                // $source = \Tinify\fromFile($pathOfPic);
                // $source->toFile($pathOfPic);
                // try {
                //     \Tinify\setKey(env("TINIFY_API_KEY"));
                //     $source = \Tinify\fromFile($pathOfPic);
                //         $source->toFile($pathOfPic);
                //     } catch(\Tinify\AccountException $e) {
                //         // Verify your API key and account limit.
                //         return redirect('ROUTE_HERE')->with('error', $e->getMessage());
                //     } catch(\Tinify\ClientException $e) {
                //         // Check your source image and request options.
                //         return redirect('ROUTE_HERE')->with('error', $e->getMessage());
                //     } catch(\Tinify\ServerException $e) {
                //         // Temporary issue with the Tinify API.
                //         return redirect('ROUTE_HERE')->with('error', $e->getMessage());
                //     } catch(\Tinify\ConnectionException $e) {
                //         // A network connection error occurred.
                //         return redirect('ROUTE_HERE')->with('error', $e->getMessage());
                //     } catch(Exception $e) {
                //         // Something else went wrong, unrelated to the Tinify API.
                //         return redirect('ROUTE_HERE')->with('error', $e->getMessage());
                //     }
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

    public function edit_hotel(Request $request, $hotel_id){
        $data = [];
        
        $data["error"] = "";
        $data["message"] = "";
        $hotel_id = base64_decode($hotel_id);
        $tour_operator_id = session('tour_operator_data')['id'];
        $data['hotel'] = Hotel::find($hotel_id);
        $data['locations'] = Location::where('tour_operator_id',$tour_operator_id)->get();
        $data['hotel_images'] = $data['hotel']->images ? explode(',', $data['hotel']->images) : false;

        

        if($request->isMethod('post')){
            try{
                
                $validator = Validator::make($request->all(), [
                    "hotel_name" => "required",
                    "location_name" => "required",
                    "hotel_rating" => "required",
                    "hotel_type" => "required"
				]);
	
				if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $tour_operator_id = session('tour_operator_data')['id'];    
                $hotel_name = trim($request->input('hotel_name'));
                $location = trim($request->input('location_name'));
                $location = explode('*', $location);
                $location_id = $location[0];
                $location_name = $location[1];
                $hotel_rating = trim($request->input('hotel_rating'));
                $hotel_type = trim($request->input('hotel_type'));
                $room_cost_single = trim($request->input('room_cost_single'));
                $room_cost_double = trim($request->input('room_cost_double'));
                $room_cost_triple = trim($request->input('room_cost_triple'));
                $hotel_pic_string = '';

                $hotel_pics = $request->file('hotel_pics');

                if($hotel_pics){
                    foreach ($hotel_pics as $images) {
                        $pathOfPic = $images -> store('public');
                        $arrayPics[] = $pathOfPic;
                    }
                    $hotel_pic_string = implode(",", $arrayPics);
                }

                Hotel::where('id', $hotel_id)->update([
                    "tour_operator_id" => $tour_operator_id,
                    "location_id" => $location_id,
                    "location_name" => $location_name,
                    "rating" => $hotel_rating,
                    "type" => $hotel_type,
                    "hotel_name" => $hotel_name,
                    "single_bed_type_cost" => $room_cost_single,
                    "double_bed_type_cost" => $room_cost_double,
                    "triple_bed_type_cost" => $room_cost_triple,
                    "images" => $hotel_pic_string
                ]);
                
                $data['message'] = "Successfully Updated.";
                return redirect()->route('seller_hotel');


            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view("Seller.edit_hotel", $data);

    }
}
