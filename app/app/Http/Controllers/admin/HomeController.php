<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        if($request->isMethod('post')){
            try{

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('Admin.home', $data);
    }
}
