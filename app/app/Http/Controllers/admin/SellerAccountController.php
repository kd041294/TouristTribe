<?php

namespace App\Http\Controllers\admin;

use App\TourOperator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerAccountController extends Controller
{
    public function seller_account(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $data["sellers"] = TourOperator::all();
        // echo json_encode($data);die;

        if($request->isMethod('post')){
            try{

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('Admin.seller_account', $data);
    }

    public function seller_account_toggle(Request $request){

        if($request->isMethod('post')){
                
            $tour_operator_id = trim($request->input('tour_operator_id'));

            if($tour_operator_id){
                $tour_operator = TourOperator::find($tour_operator_id);
                if($tour_operator){
                    $status = $tour_operator->status;
                    $status = (int)(!$status);
                    TourOperator::where('id', $tour_operator_id)->update([
                        'status' => "$status"
                    ]);
                }
            } 
        }

        return redirect()->route('seller_account');
    }

}

