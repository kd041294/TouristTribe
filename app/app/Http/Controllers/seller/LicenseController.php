<?php

namespace App\Http\Controllers\seller;

use App\Location;
use Validator;
use Exception;
use App\Meal;
use App\PerHeadExtraFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class LicenseController extends Controller
{
    public function licensing_fees(Request $request){
        $data = [];
        $data['error'] = [];
        $data["message"] = [];

        $id = session('tour_operator_data')['id'];
        $data = PerHeadExtraFee::where('tour_operator_id',$id)->get();
        //return $data;
        // return view('Seller.meal',['mealData'=>$data]);

        return view('Seller.licensing_fees', ['feesData'=>$data]);
    }

    public function create(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $id = session('tour_operator_data')['id'];
		$data['location'] = Location::where('tour_operator_id',$id)->get();

        if($request->isMethod('post')){
            try{
                 $request->flash();

                 $location_id_name = $request->input('location_name');
                 $location_array = explode('*', $location_id_name);
                
                 $location_id = $location_array[0];
                 $location_name = $location_array[1];
                 $per_head_cost = trim($request->input('per_head_cost'));
                 $fee_details = trim($request->input('license_fees_details'));

                 $tour_operator_id = session('tour_operator_data')['id'];

                PerHeadExtraFee::insert([
                    'tour_operator_id' => $tour_operator_id,
                    'location_id' => $location_id,
                    'per_head_cost' => $per_head_cost,
                    'location_name' => $location_name,
                    'fee_details' => $fee_details
                ]);
    //     $data = new PerHeadExtraFee;
    // 	$data -> tour_operator_id = $tour_operator_id;
    // 	$data -> location_id = $location_id;
    // 	$data -> per_head_cost = $per_head_cost;
    // 	$data -> location_name = $location_name;
    // 	$data -> fee_details = $fee_details;
    // 	$data -> save();

                return redirect()->route('seller_licensing_fees')->with('message','License Fees Details Added Successfully');

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('Seller.create_licensing_fees', $data);
    }
}
