<?php

namespace App\Http\Controllers\admin;

use Exception;
use Validator;
use App\BookingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentDetailsController extends Controller
{
    public function payment_details(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";
        $data["payment_details"] = DB::table('booking_details as bd')->select('bd.id','bd.trip_id', DB::raw('sum(bd.no_of_person) as no_of_person'), DB::raw('sum(bd.no_of_room) as no_of_room'), DB::raw('sum(bd.total_booking_amount) as total_booking_amount'), DB::raw('sum(bd.trip_hotel_price) as total_hotel_price'), DB::raw('sum(bd.trip_meal_price) as total_meal_price'), DB::raw('sum(bd.trip_transfer_price) as total_transfer_price'), DB::raw('sum(bd.payable_amount) as payable_amount'), 'bd.booking_payu_money_id', 'bd.payment_transaction_id')->groupBy('bd.trip_id')->get();

        return view('Admin.payment_details', $data);
    }

    public function add_transaction_id(Request $request){
        $data = [];
        $data["error"] = "";
        $data["message"] = "";

        if($request->isMethod('post')){
            try{

                $request->flash();
                $validator = Validator::make($request->all(), [
                    'transaction_id' => "required"
                ]);
                
                if($validator->fails()){
                    throw new Exception($validator->errors()->first());
                }

                $trip_id = trim($request->input('trip_id'));
                $transaction_id = trim($request->input('transaction_id'));

                BookingDetail::where('trip_id', $trip_id)->update([
                    'payment_transaction_id' => $transaction_id
                ]);

                $data['message'] = "successfully added.";

                return redirect()->route('admin_payment_details');


            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }
    }
}
