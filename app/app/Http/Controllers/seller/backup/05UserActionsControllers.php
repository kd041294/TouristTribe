<?php

namespace App\Http\Controllers\seller;

use Exception;
use Validator;
use App\TourOperator;
use App\Libraries\TextLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class UserActionsControllers extends Controller
{
    public function signup(Request $req){
        $data = [];
		$data['error'] = "";
		$data['message'] = "";

        $confirm_password = $req -> input('confirm_password');
        $password = $req -> input('password');
        $logo = $req -> file('logo');
        if($logo){
            $nameOfPic = $logo -> getClientOriginalName();
            $pathOfPic = $logo -> store('public');
        }

        $user = new TourOperator;

        if($password == $confirm_password){
            // echo 1;die;
            $otp = rand(100000, 999999);
            $message = TextLocal::get_message_template("registration_otp", ['otp' => $otp]);
            TextLocal::send_message($req->input('mobile'), $message);
            
            $user -> name = $req->input('name');
            $user -> mobile_number = $req->input('mobile');
            $user -> email = $req->input('email_id');
            $user -> comp_name = $req->input('company_name');
            $user -> adhar_number = $req -> input('adhar_number');
            $user -> gst = $req -> input('gst');
            $user -> password = bcrypt($req -> input('password'));
            if($logo){
                $user -> pic = $pathOfPic;
            }
            $user -> otp = $otp;
            $user->status = '0';
            $user -> save();

            $req->session()->forget("_old_input");

            $data['message'] = 'successfully created ';
            $req->session()->put("sessionIdVerification", $user->id);

            return redirect()->route('verification_seller');

            // return redirect()->route('seller_login')->with('message','Signup Successfull');
        }
        else{
            return redirect()->route('seller_signup')->with('message','Signup not Completed');
        }
    }

    public function signup_seller(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        // echo 1;die;
        if($request->isMethod('post')){
            try{
                // echo 1;die;
                $request->flash();

                $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:tour_operators,name|max:255',
                    'mobile' => 'required|numeric|digits:10',
                    'email_id' => 'required|unique:tour_operators,email|max:255',
                    'company_name' => 'required',
                    'adhar_number' => 'required|digits:12',
                    'gst' => 'required',
                    'password' => 'required|string|min:6|max:20',
                    'confirm_password' => 'required|string|min:6|max:20',
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }
                
                $name = trim($request->input('name'));
                $mobile = trim($request->input('mobile'));
                $email_id = trim($request->input('email_id'));
                $company_name = trim($request->input('company_name'));
                $adhar_number = trim($request->input('adhar_number'));
                $gst = trim($request->input('gst'));
                $password = trim($request->input('password'));
                $confirm_password = trim($request->input('confirm_password'));
                $logo = $request->file('logo');

                if($password != $confirm_password) throw new Exception("Password is not matched.");

                $otp = rand(100000, 999999);

				$message = TextLocal::get_message_template("registration_otp", ['otp' => $otp]);

                TextLocal::send_message($mobile, $message);

                $tour_operator = new TourOperator;
                $tour_operator->name = $name;
                $tour_operator->mobile_number = $mobile;
                $tour_operator->email = $email_id;
                $tour_operator->comp_name = $company_name;
                $tour_operator->adhar_number = $adhar_number;
                $tour_operator->gst = $gst;
                $tour_operator->password = bcrypt($password);
                if($logo){
                    $tour_operator->pic = $pathOfPic;
                }
                $tour_operator->otp = $otp;
                $tour_operator->status = '0';
                $tour_operator->save();
                
                $request->session()->forget("_old_input");
                $data['message'] = 'successfully created ';
                $request->session()->put("sessionIdVerification", $tour_operator->id);
                return redirect()->route('verification_seller');

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('Seller.signup', $data);
    }

    public function login_seller(Request $request){
        $data = [];
        $data['error'] = "";
        $data["message"] = "";

        if($request->isMethod('post')){
            try{
                $request->flash();

                $validator = Validator::make($request->all(), [
                    'email_id' => 'required|max:255',
					'password'  => 'required|string|min:6|max:20'
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $seller_email = trim($request->input('email_id'));
				$password = trim($request->input('password'));

                $seller = TourOperator::where('email', $seller_email)->first();

                if(!$seller) throw new Exception("Invalid Email.");

                if(!Hash::check($password, $seller->password)) throw new Exception("Invalid Password !");
                
                if(!$seller->status) return redirect()->route('verification_seller');

                $request->session()->forget("_old_input");
                
                session(['tour_operator_data' => $seller]); 

                return redirect()->route('seller_home')->with('message','Welcome to website');


            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view("Seller.login", $data);
    }

    public function login(Request $req){
        $email = $req -> input('email_id');
        $password = $req -> input('password');

        
        // $data = TourOperator::where('email', $email)->where('password',$password)->first();
        $data = TourOperator::where('email', $email)->first();
        
        
        if(!$data){
            return "Email is not found !";
        }
        
        if(!Hash::check($password, $data->password)){
       
            
            session(['tour_operator_data' => $data]);
            return redirect()->route('seller_home')->with('message','Welcome to website');
        }
    
        
        // if($data){
        //     session(['tour_operator_data' => $data]);
        //     return redirect()->route('seller_home')->with('message','Welcome to website');    
        // }
        // else{
        //     return "Sorry Data not matched";
        // }
        
    }

    public function verification(Request $request){
		$data = [];
		$data["error"] = "";
		$data["message"] = "";

		if($request->isMethod("post")){
			try{
				$validator = Validator::make($request->all(), [
					'otp' => 'required|numeric|digits:6'
				]);

				if($validator->fails()){
					throw new Exception($validator->errors()->first());
				}

				$tour_operator_id = $request->session()->get('sessionIdVerification'); 
				$tour_operator = TourOperator::find($tour_operator_id);

				$otp = $request->input('otp');

				if(!$tour_operator) throw new Exception('Something went wrong.');

				if($tour_operator->otp != $otp) throw new Exception("Invalid OTP.");

				TourOperator::where('id', $tour_operator_id)->update([
					'status' => '1'
				]); 

				$request->session()->put("tour_operator_data", $tour_operator);

				return redirect()->route("seller_home");

				
			}catch(Exception $e){
				$data["error"] = $e->getMessage();
			}
		}

		return view("Seller.verification_seller", $data);	
    }
    
    public function forgot_password(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        if($request->isMethod('post')){
            try{
                $validator = Validator::make($request->all(), [
					"name_email" => "required"
				]);
	
				if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }
                
                $name_email = $request->input('name_email');

                $seller = DB::table('tour_operators')->where('name', $name_email)->orWhere('email', $name_email)->first();
                
                // echo json_encode($user);die;

				if(!$seller) throw new Exception("Correct Name/Email is required.");

				$seller_mobile = $seller->mobile_number;
                $seller_id = $seller->id;

				$otp = rand(100000, 999999);
				// $request->session()->put("ForgotPasswordOtp", $otp);

				$message = TextLocal::get_message_template("forgot_password_otp", ['otp' => $otp]);

				TextLocal::send_message($seller_mobile, $message);

				TourOperator::where('id', $seller_id)->update([
					'otp' => $otp
                ]);
                
				$request->session()->put("sessionIdVerificationSeller", $seller_id);
				// echo $request->session()->get("sessionIdVerificationSeller");die;
				return redirect()->route('forget_password_otp_verification_seller');
            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('Seller.forgot_password_seller', $data);
    }

    public function forget_password_otp_verification(Request $request){
        $data = [];
		$data["error"] = "";
		$data["message"] = "";
        $seller_id = $request->session()->get('sessionIdVerificationSeller'); 
        $seller = TourOperator::find($seller_id);
        $formated_mobile = ($seller) ? substr_replace($seller->mobile_number, 'xxxxxxx', 1, 7) : "";
        $note = ($seller) ? "OTP sent to $formated_mobile." : "";
		$data["note"] = $note;

		if($request->isMethod('post')){
			try{
				// echo json_encode($request->all());die;
				$request->flash();
				$validator = Validator::make($request->all(), [
					'otp' => 'required|numeric|digits:6',
					'new_password' => 'required|string|min:6|max:20',
					'confirm_new_password' => 'required|string|min:6|max:20'
				]);
	
				if($validator->fails()){
					throw new Exception($validator->errors()->first());
				}

				$otp = $request->input('otp');
				$new_password = $request->input('new_password');
				$confirm_password = $request->input('confirm_new_password');
				$seller_otp = $seller->otp;

				if($otp != $seller_otp) throw new Exception("Invalid OTP");

				if($new_password != $confirm_password) throw new Exception("Password is not matched.");

				TourOperator::where('id', $seller_id)->update([
					'password' => bcrypt($new_password)
				]);

				// $data['message'] = "Successfully Changed.";

				return redirect()->route('seller_login');
				
			}catch(Exception $e){
				$data["error"] = $e->getMessage();
			}
        }
        
        return view('Seller.forget_password_otp_verification_seller', $data);
    }
}
