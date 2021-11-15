<?php

namespace App\Http\Controllers\seller;

use Exception;
use Validator;
use App\TourOperator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function payment_info(Request $request){
        $data = [];
        $data['tour_operator_id'] = $request->session()->get('tour_operator_data')['id'];
        $data['tour_operator'] = TourOperator::where('id', $data['tour_operator_id'])->first();

        return view('Seller.payment_info', $data);
    }

    public function payment_info_edit(Request $request){
        $data = [];
        $data["error"] = '';
        $data['tour_operator_id'] = $request->session()->get('tour_operator_data')['id'];

        $data['tour_operator'] = TourOperator::where('id', $data['tour_operator_id'])->first();

        if($request->isMethod('post')){
            try{
                $request->flash();
                $validator = Validator::make($request->all(), [
					'bank_account_name' => 'required|max:255',
					'bank_account_no' => 'required||max:255',
					'ifsc_code' => 'required||max:255',
					'bank_mobile_no'   => 'required|min:10'
                ]);

                if($validator->fails()){
					throw new Exception($validator->errors()->first());
                }
                

                $bank_account_name = $request->input('bank_account_name');
                $bank_account_no = $request->input('bank_account_no');
                $bank_ifsc_code = $request->input('ifsc_code');
                $bank_mobile_no = $request->input('bank_mobile_no');

                $data['tour_operator_id'] = $request->session()->get('tour_operator_data')['id'];
                
                TourOperator::where('id', $data['tour_operator_id'])->update([
                    'bank_account_name' => $bank_account_name,
                    'bank_account_no' => $bank_account_no,
                    'bank_ifsc_code' => $bank_ifsc_code,
                    'bank_mobile_number' => $bank_mobile_no
                ]);

                return redirect()->route('payment_info');
                
            }catch(Exception $e){
                $data["error"] = $e->getMessage();
            }
        }
        

        return view('Seller.payment_info_edit', $data);
    }

    public function payment_info_delete(Request $request){
        $data = [];
        $data['tour_operator_id'] = $request->session()->get('tour_operator_data')['id'];

        TourOperator::where('id', $data['tour_operator_id'])->update([
            'bank_account_name' => null,
            'bank_account_no' => null,
            'bank_ifsc_code' => null,
            'bank_mobile_number' => null
        ]);

        return redirect()->route('payment_info');

    }
}
