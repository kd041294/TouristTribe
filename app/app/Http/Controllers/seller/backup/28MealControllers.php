<?php

namespace App\Http\Controllers\seller;

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
}
