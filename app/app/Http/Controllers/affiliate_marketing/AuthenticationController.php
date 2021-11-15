<?php

namespace App\Http\Controllers\affiliate_marketing;

use Exception;
use Validator;
use App\Libraries\TextLocal;
use Illuminate\Http\Request;
use App\AffiliateMarketingUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    public function signup(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        
        if($request->isMethod('post')){
            try{
                // echo json_encode($request->all());die;
                $request->flash();

                $validator = Validator::make($request->all(), [
                    "user_id" => "required|unique:affiliate_marketing_users,user_id|max:255",
                    "email" => "required|unique:affiliate_marketing_users,email",
                    "website_name" => "required",
                    "phone" => "required|numeric",
                    "password" => "required|min:6|max:20"
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }
                
                $affiliate_marketing_user_id = trim($request->input('user_id'));
                $affiliate_marketing_user_email = trim($request->input('email'));
                $affiliate_marketing_user_website_name = trim($request->input('website_name'));
                $affiliate_marketing_user_phone_no = trim($request->input('phone'));
                $affiliate_marketing_user_password = trim($request->input('password'));
                
                $otp = rand(100000, 999999);
                Mail::to($email)->send(new \App\Mail\sendMailOtp($otp));

                $message = TextLocal::get_message_template("affiliate_marketing_otp", ['name' => $affiliate_marketing_user_id,'otp' => $otp]);

                TextLocal::send_message($affiliate_marketing_user_phone_no, $message);

                $affiliate_marketing_user = new AffiliateMarketingUser;
                $affiliate_marketing_user->id = $affiliate_marketing_user_id;
                $affiliate_marketing_user->user_id = $affiliate_marketing_user_id;
                $affiliate_marketing_user->email = $affiliate_marketing_user_email;
                $affiliate_marketing_user->website_name = $affiliate_marketing_user_website_name;
                $affiliate_marketing_user->phone_no = $affiliate_marketing_user_phone_no;
                $affiliate_marketing_user->password = bcrypt($affiliate_marketing_user_password);
                $affiliate_marketing_user->otp = $otp;
                $affiliate_marketing_user->created_at = date("Y-m-d h:i:s");
                $affiliate_marketing_user->updated_at = date("Y-m-d h:i:s");
                $affiliate_marketing_user->save();

                $request->session()->forget("_old_input");
                $data['message'] = 'successfully created';
				$request->session()->put("sessionAffiliateUserId", $affiliate_marketing_user->id);

                return redirect()->route('affiliate_marketing_verification');

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('affiliate_marketing.signup', $data);
    }

    public function login(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        if($request->isMethod('post')){
            try{
                $request->flash();

                $validator = Validator::make($request->all(), [
                    "user_id_or_email" => "required|max:255",
                    "password" => "required|min:6|max:20"
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $user_id_or_email = trim($request->input('user_id_or_email'));
                $password = trim($request->input('password'));

                $affiliate_marketing_user = DB::table('affiliate_marketing_users')      ->where('user_id', $user_id_or_email)->orWhere('email', $user_id_or_email)->first();

                if(!$affiliate_marketing_user) throw new Exception("Invalid User Id/Email.");

				if(!Hash::check($password, $affiliate_marketing_user->password)) throw new Exception("Invalid Password !");

				if(!$affiliate_marketing_user->verify) return redirect()->route('affiliate_marketing_verification');

				$request->session()->forget("_old_input");
				
                $request->session()->put("sessionAffiliateMarketingUserData", $affiliate_marketing_user);

				$data['message'] = 'successfully Loggin ';
				return redirect()->route('affiliate_marketing_home');

            }catch(Exception $e){
                $data['error'] = $e->getMessage();
            }
        }

        return view('affiliate_marketing.login', $data);
    }

    public function verification(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $affiliate_marketing_user_id = $request->session()->get('sessionAffiliateUserId');
		$affiliate_marketing_user = AffiliateMarketingUser::find($affiliate_marketing_user_id);
		$formated_mobile = ($affiliate_marketing_user) ? substr_replace($affiliate_marketing_user->phone_no, 'xxxxxxx', 1, 7) : "";
        $note = ($affiliate_marketing_user) ? "OTP sent to $formated_mobile." : "";
        $data["note"] = $note;
        
        // echo $data["note"];die;

        if($request->isMethod('post')){
            try{
                $validator = Validator::make($request->all(), [
					'otp' => 'required|numeric|digits:6'
				]);

				if($validator->fails()){
					throw new Exception($validator->errors()->first());
				}

				$affiliate_marketing_user_id = $request->session()->get('sessionAffiliateUserId'); 
				$affiliate_marketing_user = AffiliateMarketingUser::find($affiliate_marketing_user_id);

				$otp = $request->input('otp');

				if(!$affiliate_marketing_user) throw new Exception('Something went wrong.');

				if($affiliate_marketing_user->otp != $otp) throw new Exception("Invalid OTP.");

				AffiliateMarketingUser::where('id', $affiliate_marketing_user_id)->update([
					'verify' => '1'
                ]);
                
                // session(['affiliate_marketing_user_data' => $affiliate_marketing_user]); 
                $request->session()->put("sessionAffiliateMarketingUserData", $affiliate_marketing_user);

                $data["message"] = "Successfully Done.";
                return redirect()->route('affiliate_marketing_home');

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('affiliate_marketing.verification', $data);
    }
}
