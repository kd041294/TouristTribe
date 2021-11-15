<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Location;
use App\Midtrip;

class MidtripControllers extends Controller
{
    public function location(){
    	$id = session('tour_operator_data')['id'];
		$data = Location::where('tour_operator_id',$id)->get();
		return view('Seller.addMidtrip',['location'=>$data]);
    }

    public function add(Request $req){

        $id = session('tour_operator_data')['id'];

        $location = $req -> location_name;
        $locationArray = explode('*', $location);
        
        $location_id = $locationArray[0];
        $location_name = $locationArray[1];

    	$midtripName = $req -> midtrip_name;
    	$midtripDescription = $req -> midtrip_des;
    	$midtripPic = $req -> midtrip_pic;
    	$count = count($midtripName);

        for($i = 0; $i < $count; $i++) {
            $data = new Midtrip;
            $data -> tour_operator_id = $id;
            $data -> location_id = $location_id;
            $data -> location_name = $location_name;
            $data -> name = $midtripName[$i];
            $data -> description = $midtripDescription[$i];
            $pathOfPic = $midtripPic[$i] -> store('public');
            $data -> images = $pathOfPic;
            $data -> save();
        }
        return redirect()->route('seller_midtrip')->with('message','Midtrips added successfully');
    }

    public function see(){
        $id = session('tour_operator_data')['id'];
        $data = Midtrip::where('tour_operator_id',$id)->get();
        //return $data;
        return view('Seller.midtrip',['midtripData'=>$data]);
    }

    public function delete($id) {

        $tourId = session('tour_operator_data')['id'];
        $realId = base64_decode($id);
        $data = Midtrip::findOrFail($realId);

        if($data['tour_operator_id'] == $tourId){
            if($data['use'] == 0){

                $imgArray = explode(',',$data['images']);
                $imgCount = count($imgArray);

                for($i = 0; $i < $imgCount; $i++) {
                    $realImg = $imgArray[$i];
                    if(Storage::delete($realImg)){
                        echo "Deleted";
                    }
                    else{
                        echo "Sorry";
                    }
                }

                $data -> delete();
                return redirect()->route('seller_midtrip')->with('message','Midtrip deleted Successfully');
            }
            else{
                echo "Not Possible";
            }    
        }
        else{
            echo "Sorry";
        } 
        return $data;
    }
}
