@extends('Admin.layouts.app')

@section('data')
	<x-message/>
    @if($error)
		<div class="alert alert-danger">{{ $error }}</div>
	@endif
    @if($message)
        <div class="alert alert-danger">{{ $message }}</div>
    @endif
	<h4 class="text-center">PAYMENT DETAILS</h4>
    <div class="container-fluid mt-5 mb-5 table-responsive text-nowrap">
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="thead-dark">
                <tr align="center">
                    <th width="5%">S.No.</th>
                    <th width="10%">Group Id</th>
                    <th width="15%">Total No. Of Person</th>
                    <th width="15%" colspan="2">Hotel(rent+meal)</th>
                    <th width="10%">Transfer Price</th>
                    <th width="15%">Payable Amount</th>
                    <th width="20%" colspan="2">Confirmation(paid/unpaid, transaction no.)</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($payment_details as $payment_detail)
                    <tr align="center">
                        <td class="counterCell"></td>
                        <td>{{ $payment_detail->trip_id }}</td>
                        <td>{{ $payment_detail->no_of_person }}</td>
                        <td>&#8377 {{ $payment_detail->total_hotel_price }}</td>
                        <td>&#8377 {{ $payment_detail->total_meal_price }}</td>
                        <td>&#8377 {{ $payment_detail->total_transfer_price }}</td>
                        <td><input type="number" name="payable_amount" value="{{ $payment_detail->payable_amount ? $payment_detail->payable_amount : 'NA' }}" disabled></td>
                        
                        <td>{{ $payment_detail->payment_transaction_id ? 'Paid' : 'Unpaid' }}</td>
                        <td>
                            @if($payment_detail->payment_transaction_id)
                                {{ $payment_detail->payment_transaction_id }}
                            @else
                                <button class="btn btn-success btn-sm payment_check_btn" data-trip_id="{{ $payment_detail->trip_id }}">Yes</button>
                            @endif
                        </td>
                        
                    </tr>
                @endforeach
               
            </tbody>
        </table>
    </div>

    <!-- The Modal -->
<div class="modal" id="payment_details_modal">
    <div class="modal-dialog">
        <div class="modal-content">

      <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Add Transaction Id</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        @if($error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endif

      <!-- Modal body -->
        <form method="post" action="{{ route('payment_details_transaction_id') }}">
            <div class="modal-body">
                <input type="hidden" name="trip_id" id="trip_id" value="">
                <label>Transaction Id</label>
                <input type="text" name="transaction_id" required> 
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" >Add</button>
            </div>
        </form>

    </div>
  </div>
</div>

@endsection

@push('plugin')
<script src="{{ asset('script/admin/payment_details.js') }}"></script>
@endpush