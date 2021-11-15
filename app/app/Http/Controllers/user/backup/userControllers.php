<?php

namespace App\Http\Controllers\user;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;

class userControllers extends Controller
{
    public function create(Request $req){

    	$validatedData = $req->validate([
        	'user_name' => 'required|unique:users|max:255',
        	'email' => 'required|max:255',
        	'password' => 'required|max:255',
            'phone'   => 'required'
    	]);

    	$data = new User;
    	$data->user_name = $req -> user_name;
    	$data->email = $req -> email;
    	$data->password = $req-> password;
    	$data -> password = $req -> input('password');
        $data->mobile = $req-> phone;

    	$data->save();

    	return redirect()->route('signup')->with('status','Your account created successfully'); 
    }

    public function check(Request $req){
    	$validateData = $req -> validate ([
    		'user_name' => 'required|max:255',
    		'password'  => 'required|max:255'
    	]);

        $user_name = $req -> user_name;
        $password = $req -> password;
        

        $data = DB::select('select * from users where email = ? and password = ?',[$user_name, $password]);
        
        
        foreach($data as $datas) {
            $id = $req->session()->put('sessionId',$datas->id);
            $user_name = $req->session()->put('sessionUser_name',$datas->user_name);
            $email = $req->session()->put('sessionEmail',$datas->email);
            $phone = $req->session()->put('sessionPhone',$datas->mobile);
        }
       
    	if($req -> session()->get('sessionId')){
    		return redirect('/');
    	}
        else{
            return redirect()->route('login')->with('status','Sorry data not found');
        }
    }
}
