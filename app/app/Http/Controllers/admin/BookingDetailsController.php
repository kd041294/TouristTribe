<?php

namespace App\Http\Controllers\admin;

use Validator;
use App\BookingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BookingDetailsController extends Controller
{
    public function booking_details(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $data["booking_details"] = DB::table("booking_details as bd")
            ->select("bd.id", "bd.trip_id", "bd.user_id", "bd.person_name", "bd.person_email", "bd.person_mobile", "to.name", "to.email", "to.mobile_number", "to.comp_name", "bd.total_booking_amount", "bd.booking_payu_money_id", "ts.total_cost", "bd.bookingDate", "bd.no_of_person", "bd.no_of_room", "bd.account_hit")
            ->join('trips as t', 'bd.trip_id', '=', 't.id')
            ->join('tour_operators as to', 't.tour_operator_id', '=', 'to.id')
            ->join('transfers as ts', 'ts.id', '=', 't.transfers')
            ->get();
        // echo json_encode($data["booking_details"]);die;
        // $data['tour_operator_details'] = DB::table('booking_details as bd')->select('to.id', 'to.name', 'to.mobile_number', 'to.email', 'to.comp_name')
                            // ->join('trips as t', 'bd.trip_id', '=', 't.id')
                            // ->join('tour_operators as to', 't.tour_operator_id', '=', 'to.id')
                            // ->get();

        // $data['transfer_details'] = DB::table('booking_details as bd')->select('ts.id', 'ts.name', 'ts.type', 'ts.total_person', 'ts.total_cost')
                            // ->join('trips as t', 'bd.trip_id', '=', 't.id')
                            // ->join('transfers as ts', 't.transfers', '=', 'ts.id')
                            // ->get();

        // echo json_encode($data['tour_operator_details']);die;
        // echo json_encode($data["transfer_details"]);die;

        if($request->isMethod('post')){
            try{

            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }

        return view('Admin.booking_details', $data);
    }

    public function account_hit(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        if($request->isMethod('post')){
            
            $validator = Validator::make($request->all(), [
                'date_time_account_hit' => "required"
            ]);

            $booking_detail_id = trim($request->input('booking_detail_id'));
            $account_hit_date_time = trim($request->input('date_time_account_hit'));
            $account_hit_date_time_format = date('Y-m-d h:i:s', strtotime($account_hit_date_time));
                
            BookingDetail::where('id', $booking_detail_id)->update([
                'account_hit' => $account_hit_date_time_format
            ]);

            $data["message"] = "Successfully Added.";
            
            return redirect()->route('booking_details');
        }
    }
}
