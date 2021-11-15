<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\TravelPreneurUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TravelPreneurController extends Controller
{
    public function travel_preneur_users_account(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $data["travel_preneur_users"] = TravelPreneurUser::all();
        // echo json_encode($data);die;

        if($request->isMethod('post')){
            try{

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('Admin.travel_preneur_users_account', $data);
    }

    public function travel_preneur_users_toggle(Request $request){
        if($request->isMethod('post')){
                
            $travel_preneur_user_id = trim($request->input('travel_preneur_user_id'));

            if($travel_preneur_user_id){
                $travel_preneur_user = TravelPreneurUser::find($travel_preneur_user_id);
                if($travel_preneur_user){
                    $status = $travel_preneur_user->status;
                    $status = (int)(!$status);
                    TravelPreneurUser::where('id', $travel_preneur_user_id)->update([
                        'status' => "$status"
                    ]);
                }
            } 
        }

        return redirect()->route('travel_preneur_users_account');
    }
}
