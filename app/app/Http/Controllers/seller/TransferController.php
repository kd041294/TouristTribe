<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transfer;
use Exception;
use Validator;

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

    public function edit_transfer(Request $request, $transfer_id){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $transfer_id = base64_decode($transfer_id);
        $tour_operator_id = session('tour_operator_data')['id'];
        $data["transfer"] = Transfer::find($transfer_id);

        if($request->isMethod('post')){
            try{
                // echo json_encode($request->all());die;
                $validator = Validator::make($request->all(), [
                    'transfer_name' => 'required',
                    'person_number' => 'required',
                    'total_cost' => 'required'
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $transfer_name = trim($request->input('transfer_name'));
                $type = trim($request->input('transfer_type'));
                $person_no = trim($request->input('person_number'));
                $total_cost = trim($request->input('total_cost'));

                Transfer::where('id', $transfer_id)->update([
                    'tour_operator_id' => $tour_operator_id,
                    'name' => $transfer_name,
                    'type' => $type,
                    'total_person' => $person_no,
                    'total_cost' => $total_cost
                ]);

                $data["message"] = "successfully updated.";

                return redirect()->route('seller_transfer');

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view("Seller.edit_transfer", $data);
    }
}
