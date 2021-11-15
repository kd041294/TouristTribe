@extends('Admin.layouts.app')

@section('data')
	<x-message/>
    @if($error)
		<div class="alert alert-danger">{{ $error }}</div>
	@endif
    @if($message)
        <div class="alert alert-danger">{{ $error }}</div>
    @endif
	<h4 class="text-center">BOOKING DETAILS</h4>
    <div class="container-fluid mt-5 mb-5 table-responsive text-nowrap">
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="thead-dark">
                <tr align="center">
                    <th width="5%">S.No.</th>
                    <th width="10%">Group Id</th>
                    <th width="15%">Customer Id</th>
                    <th width="15%" colspan="3">Cutomer Details(name, email, mobile no.)</th>
                    <th width="15%" colspan="4">Operator Details(name, email, company name, mobile no.)</th>
                    <th width="20%">Amount Paid By Customer</th>
                    <th width="10%">Transaction No.</th>
                    <th width="15%">Transfer Amount</th>
                    <th width="10%" colspan="3">Package Details(Booking Date, No. Of Person, No. Of Room)</th>
                    <th width="15%">Account Hit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($booking_details as $key => $booking_detail)
                <tr align="center">
                    <td class="counterCell"></td>
                    <td>{{ $booking_detail->trip_id }}</td>
                    <td>{{ $booking_detail->user_id }}</td>
                    <td>{{ $booking_detail->person_name}}</td>
                    <td>{{ $booking_detail->person_email }}</td>
                    <td>{{ $booking_detail->person_mobile }}</td>
                    <td>{{ $booking_detail->name }}</td>
                    <td>{{ $booking_detail->email }}</td>
                    <td>{{ $booking_detail->comp_name }}</td>
                    <td>{{ $booking_detail->mobile_number }}</td>
                    <td>&#8377 {{ $booking_detail->total_booking_amount ?: 0 }}</td>
                    <td>{{ $booking_detail->booking_payu_money_id ?: "NA" }}</td>
                    <td>&#8377 {{ $booking_detail->total_cost }}</td>
                    <td>{{ $booking_detail->bookingDate }}</td>
                    <td>{{ $booking_detail->no_of_person }}</td>
                    <td>{{ $booking_detail->no_of_room }}</td>
                    <td>
                        @if($booking_detail->account_hit)
                            {{ $booking_detail->account_hit }}
                        @else
                            <button class="btn btn-success btn-sm account_hit_yes_btn" data-booking_detail_id="{{ $booking_detail->id }}">Yes</button>
                        @endif
                    
                    </td>
                        
                    </tr>

                @endforeach 
               
            </tbody>
        </table>
    </div>

    <!-- The Modal -->
<div class="modal" id="account_hit_modal">
    <div class="modal-dialog">
        <div class="modal-content">

      <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Add Date/Time</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

      <!-- Modal body -->
        <form method="post" action="{{ route('booking_details_account_hit') }}">
            <div class="modal-body">
                <input type="hidden" name="booking_detail_id" id="booking_detail_id" value="">
                <label>Date/Time</label>
                <input type="datetime-local" name="date_time_account_hit" required> 
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
<script src="{{ asset('script/admin/booking_details.js') }}"></script>
@endpush