<?php

namespace App\Http\Controllers\travel_preneur;
use Exception;
use Validator;
use App\TravelPreneurUser;
use App\Libraries\TextLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthTravelPreneurController extends Controller
{
    public function signup(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        if($request->isMethod('post')){
            try{
                $request->flash();
                // echo json_encode($request->all());die;
				$validator = Validator::make($request->all(), [
					'user_name' => 'required|unique:travel_preneur_users,name|max:255',
                    'email' => 'required|unique:travel_preneur_users,email|max:255',
                    'aadhar_no' => 'required|max:255',
                    'phone'   => 'required|numeric',
					'password' => 'required|string|min:6|max:20'
				]);

				if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }
            
                $name = trim($request->input('user_name'));
                $email = trim($request->input('email'));
                $aadhar_no = trim($request->input('aadhar_no'));
                $aadhar_pic = $request->file('aadhar_pic');
                $phone = trim($request->input('phone'));
                $password = bcrypt(trim($request->input('password')));

                if($aadhar_pic){
                    $nameOfPic = $aadhar_pic -> getClientOriginalName();
                    $pathOfPic = $aadhar_pic -> store('public');
                }

                $otp = rand(100000, 999999);
                Mail::to($email)->send(new \App\Mail\sendMailOtp($otp));

				$message = TextLocal::get_message_template("registration_otp", ['otp' => $otp]);
                
                TextLocal::send_message($phone, $message);
                
                // MAIL
                
                

                $user = new TravelPreneurUser;
				$user->name = $name;
				$user->email = $email;
                $user->password = $password;
                $user->aadhar_no = $aadhar_no;
                if($aadhar_pic){
                    $user->aadhar_pic = $pathOfPic;
                }
                $user->phone = $phone;
                $user->otp = $otp;
                $user->status = '1';
                $user->verify = '0';
                $user->created_at = date("Y-m-d h:i:s");
				$user->save();

				$request->session()->forget("_old_input");

				$data['message'] = 'successfully created ';
				$request->session()->put("sessionIdTravelPreneurUser", $user->id);

				return redirect()->route('travel_preneur_verification');

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('travel_preneur.signup', $data);
    }

    public function login(Request $request){
        $data = [];
        $data['error'] = "";
        $data["message"] = "";

        if($request->isMethod('post')){
            try{
                $request->flash();

                $validator = Validator::make($request->all(), [
                    'email' => 'required|max:255',
					'password'  => 'required|string|min:6|max:20'
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $user_email = trim($request->input('email'));
				$password = trim($request->input('password'));

                $user = TravelPreneurUser::where('email', $user_email)->first();

                if(!$user) throw new Exception("Invalid Email.");

                if(!Hash::check($password, $user->password)) throw new Exception("Invalid Password !");
                
                if(!$user->verify) return redirect()->route('travel_preneur_verification');

                if(!$user->status) throw new Exception('You are inactive, Please contact to Admin.');

                $request->session()->forget("_old_input");
                
                session(['user_data' => $user]); 

                return redirect()->route('travel_preneur_home')->with('message','Welcome to website');


            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view("travel_preneur.login", $data);
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

                $user_id = $request->session()->get('sessionIdTravelPreneurUser');
                $user = TravelPreneurUser::find($user_id);
                
				$otp = $request->input('otp');
                
				if(!$user) throw new Exception('Something went wrong.');

				if($user->otp != $otp) throw new Exception("Invalid OTP.");

				TravelPreneurUser::where('id', $user_id)->update([
					'verify' => '1'
				]); 

				$request->session()->put("user_data", $user);

				return redirect()->route("travel_preneur_home");

				
			}catch(Exception $e){
				$data["error"] = $e->getMessage();
			}
		}

		return view("travel_preneur.verification", $data);
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

				$user = DB::table('travel_preneur_users')->where('name', $name_email)->orWhere('email', $name_email)->first();

				if(!$user) throw new Exception("Correct Name/Email is required.");

				$user_mobile = $user->phone;
				$user_id = $user->id;

				$otp = rand(100000, 999999);

				// $request->session()->put("ForgotPasswordOtp", $otp);
				Mail::to($email)->send(new \App\Mail\sendMailOtp($otp));

				$message = TextLocal::get_message_template("forgot_password_otp", ['otp' => $otp]);

				TextLocal::send_message($user_mobile, $message);
				
				
				// MAIL
				

				TravelPreneurUser::where('id', $user_id)->update([
					'otp' => $otp
				]);

				$request->session()->put("sessionIdTravelPreneurUser", $user->id);
				
				return redirect()->route('travel_preneur_forgot_password_otp_verification');

			}catch(Exception $e){
				$data["error"] = $e->getMessage();
			}
		}

		return view('travel_preneur.forgot_password', $data);
    }

    public function forgot_password_otp_verification(Request $request){
        $data = [];
		$data["error"] = "";
		$data["message"] = "";
        $user_id = $request->session()->get('sessionIdTravelPreneurUser'); 
        $user = TravelPreneurUser::find($user_id);
              
		$formated_mobile = ($user) ? substr_replace($user->phone, 'xxxxxxx', 1, 7) : "";
		$note = ($user) ? "OTP sent to $formated_mobile." : "";
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
				$user_otp = $user->otp;

				if($otp != $user_otp) throw new Exception("Invalid OTP");

				if($new_password != $confirm_password) throw new Exception("Password is not matched.");

				TravelPreneurUser::where('id', $user_id)->update([
					'password' => bcrypt($new_password)
				]);

				// $data['message'] = "Successfully Changed.";

				return redirect()->route('travel_preneur_login');
				
			}catch(Exception $e){
				$data["error"] = $e->getMessage();
			}
		}

		return view('travel_preneur.forget_password_otp_verification', $data);
    }
}
