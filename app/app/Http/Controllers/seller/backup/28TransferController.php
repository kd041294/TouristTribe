<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transfer;

class TransferController extends Controller
{
	public function see(){
		$id = session('tour_operator_data')['id'];
        $data = Transfer::where('tour_operator_id',$id)->get();
        return view('Seller.transfer',['transferData'=>$data]);
	}
	
    public function add(Request $req){
    	$data = new Transfer;
    	$data -> tour_operator_id = session('tour_operator_data')['id'];
    	$data -> name = $req -> transfer_name;
    	$data -> type = $req -> transfer_type;
    	$data -> total_person = $req -> person_number;
    	$data -> total_cost = $req -> total_cost;
    	$data -> save();

    	return redirect()->route('seller_transfer')->with('message','Transfer added Successfully');
    }

    public function delete($id){
        $tourId = session('tour_operator_data')['id'];
        $realId = base64_decode($id);
        $data = Transfer::findOrFail($realId);

        if($data['tour_operator_id'] == $tourId){
            if($data['use'] == 0){
                $data -> delete();
                return redirect()->route('seller_transfer')->with('message','Vehical deleted Successfully');
            }
            else{
                echo "Not Possible";
            }    
        }
        else{
            echo "Sorry";
        }  
    }
}
