<?php

namespace App\Http\Controllers\seller;

use Validator;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Location;
use App\Meal;

class MealControllers extends Controller
{	

	public function location() {
    	$id = session('tour_operator_data')['id'];
		$data = Location::where('tour_operator_id',$id)->get();
		return view('Seller.addMeal',['location'=>$data]);
    }

    public function add(Request $req){
    	
        $location = $req -> location_name;
        $locationArray = explode('*', $location);
        
        $location_id = $locationArray[0];
        $location_name = $locationArray[1];
        
        $id = session('tour_operator_data')['id'];

        $data = new Meal;

        $data -> tour_operator_id = $id;
    	$data -> location_id = $location_id;
        $data -> location_name = $location_name;
    	$data -> breakfast_details = $req -> detail_breakfast;
    	$data -> lunch_details = $req -> detail_lunch;
    	$data -> evening_tea_details = $req -> detail_Evening_tea;
    	$data -> dinner_details = $req -> detail_Dinner;
    	$data -> per_head_cost = $req -> money;

    	$data -> save();

    	return redirect()->route('seller_meal')->with('message','Meal Added Successfully');
    }

    public function see(){
        $id = session('tour_operator_data')['id'];
        $data = Meal::where('tour_operator_id',$id)->get();
        //return $data;
        return view('Seller.meal',['mealData'=>$data]);
    }

    public function delete($id){
        $tourId = session('tour_operator_data')['id'];
        $realId = base64_decode($id);
        $data = Meal::findOrFail($realId);

        if($data['tour_operator_id'] == $tourId){
            if($data['use'] == 0){
                $data -> delete();
                return redirect()->route('seller_meal')->with('message','Meal deleted Successfully');
            }
            else{
                echo "Not Possible";
            }    
        }
        else{
            echo "Sorry";
        }  
    }

    public function edit_meal(Request $request, $meal_id){
        $data = [];
        
        $data["error"] = "";
        $data["message"] = "";
        $meal_id = base64_decode($meal_id);
        $tour_operator_id = session('tour_operator_data')['id'];
        $data['meal'] = Meal::find($meal_id);
        $data['locations'] = Location::where('tour_operator_id',$tour_operator_id)->get();

        if($request->isMethod('post')){
            try{
                $validator = Validator::make($request->all(), [
                    "location_name" => "required",
                    "money" => "required"
				]);
	
				if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $tour_operator_id = session('tour_operator_data')['id'];
                $location = trim($request->input('location_name'));
                $location = explode('*', $location);
                $location_id = $location[0];
                $location_name = $location[1];
                $detail_breakfast = trim($request->input('detail_breakfast'));
                $detail_lunch = trim($request->input('detail_lunch'));
                $detail_evening_tea = trim($request->input('detail_Evening_tea'));
                $detail_dinner = trim($request->input('detail_Dinner'));
                $money = trim($request->input('money'));

                if((!$detail_breakfast && !$detail_lunch && !$detail_evening_tea && !$detail_dinner) && $money) throw new Exception("Choose atleat one type.");
                
                Meal::where('id', $meal_id)->update([
                    "tour_operator_id" => $tour_operator_id,
                    "location_id" => $location_id,
                    "location_name" => $location_name,
                    "breakfast_details" => $detail_breakfast,
                    "lunch_details" => $detail_lunch,
                    "evening_tea_details" => $detail_evening_tea,
                    "dinner_details" => $detail_dinner,
                    "per_head_cost" => $money
                ]);
                
                $data['message'] = "Successfully Updated.";
                return redirect()->route('seller_meal');


            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view("Seller.edit_meal", $data);

    }
}
