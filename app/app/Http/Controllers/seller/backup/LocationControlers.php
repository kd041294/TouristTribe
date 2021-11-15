<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Exception;
use App\Location;

class LocationControlers extends Controller
{
	public function show() {
		$id = session('tour_operator_data')['id'];
		$data = Location::where('tour_operator_id',$id)->get();
		//return $data;
        return view('Seller.location',['locations_data' => $data]);
	}
    public function add(Request $req) {
    	$data = new Location;

    	//checkbox start
    	$Location_type_Forest = $req -> Location_type_Forest;
    	$Location_type_Beach = $req -> Location_type_Beach;
    	$Location_type_Desert = $req -> Location_type_Desert;
    	$Location_type_hill_Station = $req -> Location_type_hill_Station;
    	$Location_type_water_activities = $req -> Location_type_water_activities;
    	$Location_type_religious = $req -> Location_type_religious;
    	$Location_type_heritage = $req -> Location_type_heritage;
    	$Location_type_Picnic_spot = $req -> Location_type_Picnic_spot;
    	$Location_type_city_tour = $req -> Location_type_city_tour;
    	//checkbox stop
        
    	//add location type
    	$location_types = '';

    	if($Location_type_Forest){
    		$location_types .= $Location_type_Forest.",";
    	}
    	if($Location_type_Beach){
    		$location_types .= $Location_type_Beach.",";
    	}
    	if($Location_type_Desert){
    		$location_types .= $Location_type_Desert.",";
    	}
    	if($Location_type_hill_Station){
    		$location_types .= $Location_type_hill_Station.",";
    	}
    	if($Location_type_water_activities){
    		$location_types .= $Location_type_water_activities.",";
    	}
    	if($Location_type_religious){
    		$location_types .= $Location_type_religious.",";
    	}
    	if($Location_type_heritage){
    		$location_types .= $Location_type_heritage.",";
       	}
    	if($Location_type_city_tour){
    		$location_types .= $Location_type_city_tour.",";
    	}
    	if($Location_type_Picnic_spot){
    		$location_types .= $Location_type_Picnic_spot;
    	}
    	
    	//Convert into string to array
    	$location_type_array = explode(",", $location_types);

    	//Convert array to string due to null value
    	$count = count($location_type_array);
    	$realArray = $count - 2;
    	$location_string = '';
    	for($i = 0; $i < $count; $i++) {
    		if($i == $realArray){
	    		if($location_type_array[$i]){
	    			$location_string .=  $location_type_array[$i];
	    		}
	    		break;
	    	}
	    	else{
	    		if($location_type_array[$i]){
	    			$location_string .=  $location_type_array[$i].",";
	    		}
	    	}
    	}
    	//image store
    	$img = $req -> loc_pics;
    	if($img){
    	    $pathOfPic = $img -> store('public');    
    	}

    	$data -> tour_operator_id = session('tour_operator_data')['id'];
    	$data -> name = $req -> location_name;
    	$data -> type = $location_string;
    	$data -> name_of_city = $req -> cityName;
    	$data -> total_member_size = $req -> number_of_limit;
    	$data -> min_family_member = $req -> min_number_of_family;
    	if($img){
    	    $data -> location_images = $pathOfPic;
    	}
    	$data -> save();

    	return redirect()->route('seller_location')->with('message','Location added successfully');
    }
    public function delete($id){

        $tourId = session('tour_operator_data')['id'];
        $realId = base64_decode($id);
        $data = Location::findOrFail($realId);

        if($data['tour_operator_id'] == $tourId){
            if($data['use'] == 0){

                $imgArray = explode(',',$data['location_images']);
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
                return redirect()->route('seller_location')->with('message','Location deleted Successfully');
            }
            else{
                echo "Not Possible";
            }    
        }
        else{
            echo "Sorry";
        } 
        return $data;
	}
	
	public function edit_location(Request $request, $location_id){
		$data = [];
        
        $data["error"] = "";
        $data["message"] = "";
        $location_id = base64_decode($location_id);
        $tour_operator_id = session('tour_operator_data')['id'];
		$data["location"] = Location::find($location_id);
		$data["location_type"] = explode(',', $data["location"]->type);
		
        if($request->isMethod('post')){
            try{
				
                $validator = Validator::make($request->all(), [
                    "location_name" => "required",
					"number_of_limit" => "required",
					"min_number_of_family" => "required"
				]);
	
				if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }
				
                $tour_operator_id = session('tour_operator_data')['id'];
                $location_name = trim($request->input('location_name'));
                $Location_type_Forest = trim($request->input('Location_type_Forest'));
				$Location_type_Beach = trim($request->input('Location_type_Beach'));
				$Location_type_Desert = trim($request->input('Location_type_Desert'));
				$Location_type_hill_Station = trim($request->input('Location_type_hill_Station'));
				$Location_type_water_activities = trim($request->input('Location_type_water_activities'));
				$Location_type_religious = trim($request->input('Location_type_religious'));
				$Location_type_heritage = trim($request->input('Location_type_heritage'));
				$Location_type_Picnic_spot =  trim($request->input('Location_type_Picnic_spot'));
				$Location_type_city_tour = trim($request->input('Location_type_city_tour'));
				$total_member_size = trim($request->input('number_of_limit'));
				$min_family_member = trim($request->input('min_number_of_family'));
				$city_name = trim($request->input('cityName'));
				
				$location_types = '';

				if($Location_type_Forest){
					$location_types .= $Location_type_Forest.",";
				}
				if($Location_type_Beach){
					$location_types .= $Location_type_Beach.",";
				}
				if($Location_type_Desert){
					$location_types .= $Location_type_Desert.",";
				}
				if($Location_type_hill_Station){
					$location_types .= $Location_type_hill_Station.",";
				}
				if($Location_type_water_activities){
					$location_types .= $Location_type_water_activities.",";
				}
				if($Location_type_religious){
					$location_types .= $Location_type_religious.",";
				}
				if($Location_type_heritage){
					$location_types .= $Location_type_heritage.",";
				}
				if($Location_type_city_tour){
					$location_types .= $Location_type_city_tour.",";
				}
				if($Location_type_Picnic_spot){
					$location_types .= $Location_type_Picnic_spot;
				}

				$location_type_array = explode(",", $location_types);

				//Convert array to string due to null value
				$count = count($location_type_array);
				$realArray = $count - 2;
				$location_string = '';
				for($i = 0; $i < $count; $i++) {
					if($i == $realArray){
						if($location_type_array[$i]){
							$location_string .=  $location_type_array[$i];
						}
						break;
					}
					else{
						if($location_type_array[$i]){
							$location_string .=  $location_type_array[$i].",";
						}
					}
				}
				
				$img = $request->file('loc_pics');
				$pathOfPic = '';

				if($img){
					$pathOfPic = $img -> store('public');    
				}
				
                Location::where('id', $location_id)->update([
					'tour_operator_id' => $tour_operator_id,
					'name' => $location_name,
					'type' => $location_string,
					'total_member_size' => $total_member_size,
					'min_family_member' => $min_family_member,
					'name_of_city' => $city_name ? $city_name : null,
					'location_images' => $pathOfPic ? $pathOfPic : ''
				]);
                
                $data['message'] = "Successfully Updated.";
                return redirect()->route('seller_location');


            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view("Seller.edit_location", $data);

	}
}
