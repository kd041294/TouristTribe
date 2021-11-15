<?php

namespace App\Http\Controllers\seller;

use Exception;
use Validator;
use App\TourOperatorHoliday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HolidayController extends Controller
{
    public function holiday(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $data["holidays"] = "";
        $tour_operator_id = session('tour_operator_data')['id'];

        $data['holidays'] = TourOperatorHoliday::where('tour_operator_id', $tour_operator_id)->get();
            
        return view('Seller.holiday', $data);

    }

    public function add_holiday(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        if($request->isMethod('post')){
            try{
                // echo json_encode($request->all());die;
                $request->flash();

                $validator = Validator::make($request->all(), [
                    "reason" => "required",
                    "from_date" => "required",
                    "to_date" => "required"
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }

                $tour_operator_id = session('tour_operator_data')['id'];
                $reason = $request->input('reason');
                $from_date = $request->input('from_date');
                $to_date = $request->input('to_date');

                // echo $reason." ".$no_of_days." ".$from_date." ".$to_date;die;
                if($from_date > $to_date) throw new Exception("From Date should not be greater than the TO date.");
                $diff = strtotime($to_date) - strtotime($from_date);
                // echo ($diff/86400) + 1;die;

                $trips = DB::table('trips')
                        ->where('tour_operator_id', $tour_operator_id)
                        ->where(function($query) use ($from_date, $to_date){
                            $query->where('starting_date', '<=', $to_date);
                            $query->where('ending_date' , '>=', $to_date);
                        })
                        ->orWhere(function($query) use ($from_date, $to_date){
                            $query->where('starting_date', '<=', $from_date);
                            $query->where('ending_date' , '>=', $from_date);
                        })
                        ->orWhere(function($query) use ($from_date, $to_date){
                            $query->where('starting_date', '>=', $from_date);
                            $query->where('ending_date' , '<=', $to_date);
                        })->get();

                if(count($trips)) throw new Exception('You cant take holiday, '.count($trips).' trip is there.');

                TourOperatorHoliday::insert([
                    'tour_operator_id' => $tour_operator_id,
                    'name' => $reason,
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                return redirect()->route('seller_holiday');


            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('Seller.add_holiday', $data);
    }
}
