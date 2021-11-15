<?php

namespace App\Http\Controllers\admin;

use App\Admin;
use Exception;
use Validator;
use App\Http\Libraries\TextLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function login(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        if($request->isMethod('post')){
            try{
                $request->flash();
                // echo json_encode($request->all());die;
                $validator = Validator::make($request->all(), [
                    'user_name_email' => 'required|max:255',
                    'password' => 'required|string|min:6|max:20'
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $admin_name_email = trim($request->input('user_name_email'));
                $admin_password = trim($request->input('password'));

                $admin = DB::table('admins')->where('name', $admin_name_email)->orWhere('email', $admin_name_email)->first();

                // echo json_encode($admin);die;
                if(!$admin) throw new Exception("Correct Email is required.");

                if(!Hash::check($admin_password, $admin->password)) throw new Exception("Correct Email and Password is required.");

                $phone = $admin->mobile_no;
                $otp = rand(100000, 999999);
                Mail::to($request->input('user_name_email'))->send(new \App\Mail\sendMailOtp($otp));

                $message = TextLocal::get_message_template("admin_login_otp", ['otp' => $otp, 'name' => $admin->name]);

				TextLocal::send_message($phone, $message);

				Admin::where('id', $admin->id)->update([
                    'otp' => $otp
                ]);

                $request->session()->forget("_old_input");

                $request->session()->put("sessionAdminId", $admin->id);

                $data['message'] = 'successfully Loggin';
                return redirect()->route('admin_otp_verification');
                

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('Admin.login', $data);
    }

    public function admin_otp_verification(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $admin_id = $request->session()->get('sessionAdminId');
		$admin = Admin::find($admin_id);
		$formated_mobile = ($admin) ? substr_replace($admin->mobile_no, 'xxxxxxx', 1, 7) : "";
        $note = ($admin) ? "OTP sent to mail & $formated_mobile." : "";
		$data["note"] = $note;

        if($request->isMethod('post')){
            try{
                
                $validator = Validator::make($request->all(), [
                    'otp' => 'required|numeric|digits:6'
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $otp = trim($request->input('otp'));

                if($otp != $admin->otp) throw new Exception("Invalid OTP.");

                // $request->session()->put("sessionAdminId", $admin->id);
                // $request->session()->put("sessionAdminName", $admin->name);
                // $request->session()->put("sessionAdminMobile", $admin->mobile_no);
                // $request->session()->put("sessionAdminEmail", $admin->email);

                session(['admin_data' => $admin]); 

                $data["message"] = "Successfully Loggin.";
                return redirect()->route('admin_home');

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('Admin.otp_verification', $data);

    }
}
