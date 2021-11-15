<?php

namespace App\Http\Controllers\admin;

use Validator;
use Exception;
use App\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    public function voucher(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $data["coupons"] = "";

        $data["coupons"] = Coupon::all();

        return view('Admin.voucher', $data);
    }

    public function add_voucher(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        if($request->isMethod('post')){
            try{
                // echo json_encode($request->all());die;

                $validator = Validator::make($request->all(), [
                    "coupon_name" => "required|unique:coupons,coupon_name|max:255",
                    "coupon_value" => "required",
                    "expiry_date" => "required"
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $coupon_name = trim($request->input("coupon_name"));
                $coupon_value = trim($request->input("coupon_value"));
                $expiry_date = trim($request->input("expiry_date"));

                Coupon::insert([
                    "coupon_name" => $coupon_name,
                    "coupon_value" => $coupon_value,
                    "expDate" => $expiry_date,
                    "created_at" => date('Y-m-d'),
                    "updated_at" => date('Y-m-d')
                ]);

                $data["message"] = "Voucher Added Successfully.";

                return redirect()->route('admin_voucher');

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view("Admin.add_voucher", $data);
    }

    public function voucher_toggle(Request $request){

        if($request->isMethod('post')){
            $coupon_id = trim($request->input('coupon'));
            
            if($coupon_id){
                $coupon = Coupon::find($coupon_id);
                if($coupon){
                    $status = $coupon->status;
                    $status = (int)(!$status);
                    Coupon::where('id', $coupon_id)->update([
                        'status' => "$status"
                    ]);
                }
            }
        }

        return redirect()->route('admin_voucher');
    }
}
