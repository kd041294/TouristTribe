<?php

namespace App\Http\Controllers\user;
use App\User;
use Exception;
use Validator;
use App\Http\Libraries\TextLocal;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class userControllers extends Controller
{
    public function signup(Request $request){
		$data = [];
		$data['error'] = "";
		$data['message'] = "";

		if($request->isMethod('post')){
			try{
				$request->flash();

				$validator = Validator::make($request->all(), [
					'user_name' => 'required|unique:users,user_name|max:255',
					'email' => 'required|unique:users,email|max:255',
					'password' => 'required|string|min:6|max:20',
				//						'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%]).*$/ |max:20',

					'phone'   => 'required|numeric'
				]);
				// $validation = \Validator::make( $validator );

  

				if($validator->fails()){
					throw new Exception($validator->errors()->first());
				}
			

				$user_name = trim($request->input('user_name'));
				$email = trim($request->input('email'));
				$password = bcrypt(trim($request->input('password')));
				$phone = trim($request->input('phone'));

				$otp = rand(100000, 999999);
				
				Mail::to($email)->send(new \App\Mail\sendMailOtp($otp));
				
                $message = TextLocal::get_message_template("User_SignUp", ['otp' => $otp]);
                
				TextLocal::send_message($phone, $message);
				

				$user = new User;
				$user->user_name = $user_name;
				$user->email = $email;
				$user->password = $password;
				$user->mobile = $phone;
				$user->otp = $otp;
				$user->save();

				$request->session()->forget("_old_input");

				$data['message'] = 'successfully created ';
				$request->session()->put("sessionIdVerification", $user->id);

				return redirect()->route('verification');
			}catch(Exception $e){
				$data['error'] = $e->getMessage();
			}
		}
		return view('User.signup', $data);
    }

    public function login(Request $request){
		$data = [];
		$data['error'] = "";
		$data['message'] = "";

		if($request->isMethod('post')){
			try{
				$request->flash();

				$validator = Validator::make($request->all(), [
					'user_name' => 'required|max:255',
					'password' => 'required|string|min:6|max:20',
				// 	'password'  => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%]).*$/ |max:20',
				]);

				if($validator->fails()){
					throw new Exception($validator->errors()->first());
				}

				$user_name = trim($request->input('user_name'));
				$password = trim($request->input('password'));
				
				$user = DB::table('users')->where('user_name', $user_name)->orWhere('email', $user_name)->first();

				if(!$user) throw new Exception("Invalid Username/Email.");

				if(!Hash::check($password, $user->password)) throw new Exception("Invalid Password !");

				if(!$user->verify) return redirect()->route('verification');

				$request->session()->forget("_old_input");
				
				$request->session()->put("sessionId", $user->id);
				$request->session()->put("sessionUser_name", $user->user_name);
				$request->session()->put("sessionEmail", $user->email);
				$request->session()->put("sessionPhone", $user->mobile);

				$data['message'] = 'successfully Loggin ';
				return redirect()->route('user_home');
			}catch(Exception $e){
				$data['error'] = $e->getMessage();
			}
			
		}

		return view('User.login', $data);
			
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

				$user_id = $request->session()->get('sessionIdVerification'); 
				$user = User::find($user_id);

				$otp = $request->input('otp');

				if(!$user) throw new Exception('Something went wrong.');

				if($user->otp != $otp) throw new Exception("Invalid OTP.");

				User::where('id', $user_id)->update([
					'verify' => true
				]);

				$request->session()->put("sessionId", $user->id);
				$request->session()->put("sessionUser_name", $user->user_name);
				$request->session()->put("sessionEmail", $user->email);
				$request->session()->put("sessionPhone", $user->mobile);

				return redirect()->route("user_home");

				
			}catch(Exception $e){
				$data["error"] = $e->getMessage();
			}
		}

		return view("User.verification", $data);	
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

				$user = DB::table('users')->where('user_name', $name_email)->orWhere('email', $name_email)->first();

				if(!$user) throw new Exception("Correct Name/Email is required.");

				$user_mobile = $user->mobile;
				$user_id = $user->id;

				$otp = rand(100000, 999999);

				// $request->session()->put("ForgotPasswordOtp", $otp);
				//Mail::to($email)->send(new \App\Mail\sendMailOtp($otp));

				$message = TextLocal::get_message_template("forgot_password_otp", ['otp' => $otp]);

				TextLocal::send_message($user_mobile, $message);

				User::where('id', $user_id)->update([
					'otp' => $otp
				]);

				$request->session()->put("sessionIdVerification", $user->id);
				
				return redirect()->route('forget_password_otp_verification');

			}catch(Exception $e){
				$data["error"] = $e->getMessage();
			}
		}

		return view('User.forgot_password', $data);
	}

	public function forget_password_otp_verification(Request $request){
		$data = [];
		$data["error"] = "";
		$data["message"] = "";
		$user_id = $request->session()->get('sessionIdVerification'); 
		$user = User::find($user_id);
		$formated_mobile = ($user) ? substr_replace($user->mobile, 'xxxxxxx', 1, 7) : "";
		$note = ($user) ? "OTP sent to $formated_mobile." : "";
		$data["note"] = $note;

		if($request->isMethod('post')){
			try{
				// echo json_encode($request->all());die;
				$request->flash();
				$validator = Validator::make($request->all(), [
					'otp' => 'required|numeric|digits:6',
					'new_password' => 'required|string|min:6|max:20',
					'confirm_new_password' => 'required|string|min:6|max:20',
				]);
	
				if($validator->fails()){
					throw new Exception($validator->errors()->first());
				}

				$otp = $request->input('otp');
				$new_password = $request->input('new_password');
				$confirm_password = $request->input('confirm_new_password');
				$user_otp = $user->otp;

				if($otp != $user_otp) throw new Exception("Invalid OTP");

				if($new_password != $confirm_password) throw new Exception("Password is not matched.");

				User::where('id', $user_id)->update([
					'password' => bcrypt($new_password)
				]);

				// $data['message'] = "Successfully Changed.";

				return redirect()->route('login');
				
			}catch(Exception $e){
				$data["error"] = $e->getMessage();
			}
		}

		return view('User.forget_password_otp_verification', $data);

	}

	
}
