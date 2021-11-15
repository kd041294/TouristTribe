<?php

namespace App\Http\Controllers\seller;

use Exception;
use Validator;
use App\TourOperator;
use App\TravelPreneurUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TravelPreneurController extends Controller
{
    public function travel_preneur(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $data["tour_operator"] = session('tour_operator_data');
        $tour_operator_id =  $data["tour_operator"]['id'];
        $tour_operator_data = TourOperator::where('id', $tour_operator_id)->first();
        $travel_preneur_id = $tour_operator_data['travel_preneur_users_id'];
        $data["travel_preneur"] = "";

        if($travel_preneur_id){
            $data["travel_preneur"] = TravelPreneurUser::where('id', $travel_preneur_id)->first();
        }

        if($request->isMethod('post')){

        }

        return view('Seller.travel_preneur', $data);
    }

    public function travel_preneur_create(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $data["travel_preneurs"] = TravelPreneurUser::all();
        $tour_operator_data = session('tour_operator_data');


        if($request->isMethod('post')){
            try{
                $validator = Validator::make($request->all(), [
                    'travel_preneur_user' => 'required'
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $travel_preneur_id = $request->input('travel_preneur_user');

                $travel_preneur = TravelPreneurUser::where('id', $travel_preneur_id)->first();

                if(!$travel_preneur) throw new Exception('Invalid Travel Preneur Id.');

                if(!$travel_preneur_id) throw new Exception('Select Atleast One User.');

                $tour_operator =  TourOperator::where('travel_preneur_users_id', $travel_preneur_id)->get();

                // if($tour_operator) throw new Exception('Not Available.');

                TourOperator::where('id', $tour_operator_data->id)->update([
                    'travel_preneur_users_id' => $travel_preneur_id
                ]);

                return redirect()->route('seller_travel_preneur')->with('message', 'TravelPreneur Added !');


            }catch(Exception $e){   
                $data["error"] = $e->getMessage();
            }
        }

        return view('Seller.travel_preneur_create', $data);
    }

    public function travel_preneur_edit(Request $request, $travel_preneur_id){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $data["travel_preneurs"] = TravelPreneurUser::all();
        $tour_operator_data = session('tour_operator_data');
        $data["travel_preneur_id"] = $travel_preneur_id;

        if($request->isMethod('post')){
            try{
                // echo json_encode($request->all());die;
                $validator = Validator::make($request->all(), [
                    'travel_preneur_user' => 'required'
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $travel_preneur_id = $request->input('travel_preneur_user');

                $travel_preneur = TravelPreneurUser::where('id', $travel_preneur_id)->first();

                if(!$travel_preneur) throw new Exception('Invalid Travel Preneur Id.');

                if(!$travel_preneur_id) throw new Exception('Select Atleast One User.');

                $tour_operator =  TourOperator::where('travel_preneur_users_id', $travel_preneur_id)->get();

                // if($tour_operator) throw new Exception('Not Available.');

                TourOperator::where('id', $tour_operator_data->id)->update([
                    'travel_preneur_users_id' => $travel_preneur_id
                ]);

                return redirect()->route('seller_travel_preneur')->with('message', 'TravelPreneur Updated !');


            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('Seller.travel_preneur_edit', $data);
    }

    public function travel_preneur_view(Request $request, $travel_preneur_id){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $data["travel_preneur"] = TravelPreneurUser::where('id', $travel_preneur_id)->first();

        return view('Seller.travel_preneur_view', $data);

    }

    public function travel_preneur_delete(Request $request, $travel_preneur_id){
        $tour_operator_data = session('tour_operator_data');
        $tour_operator_id = $tour_operator_data['id'];
        
        TourOperator::where('id', $tour_operator_id)->update([
            'travel_preneur_users_id' => 'null'
        ]);

        return redirect()->route('seller_travel_preneur')->with('message', 'TravelPreneur Deleted !');


    }
}
