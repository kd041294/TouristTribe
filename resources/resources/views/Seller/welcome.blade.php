@extends('Seller.layouts.app')




@section('data')

	<x-message/>
	<a href="create-location" class="btn bttn bttn-float bttn-md round20 color1 shadow">Start Upload a Tour Package &#10149;</a><br><br>
	@if($error)
		<div class="alert alert-danger">{{ $error }}</div>
	@endif
    @if($message)
        <div class="alert alert-danger">{{ $error }}</div>
    @endif
	<h4 class="text-center">YOUR BOOKING DETAILS</h4>
    <div class="container-fluid mt-5 mb-5 table-responsive text-nowrap">
        <table class="table table-bordered table-hover text-nowrap">
            <!--<thead class="thead-dark">-->
                            <thead>
                <tr align="center">
                    <th width="5%">S.No.</th>
                    <th width="10%">Group Id</th>
                    <th width="15%">Customer Id</th>
                    <th width="15%" colspan="3">Cutomer Details(name, email, mobile no.)</th>
                    <th width="15%" colspan="4">Operator Details(name, email, company name, mobile no.)</th>
                    <th width="20%">Amount Paid By Customer</th>
                    <th width="15%">Transfer Amount</th>
                    <th width="10%" colspan="3">Package Details(Booking Date, No. Of Person, No. Of Room)</th>
                </tr>
            </thead>
            <tbody>
				@if(count($booking_details))
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
							<td>&#8377 {{ $booking_detail->total_cost }}</td>
							<td>{{ $booking_detail->bookingDate }}</td>
							<td>{{ $booking_detail->no_of_person }}</td>
							<td>{{ $booking_detail->no_of_room }}</td>
						</tr>
                	@endforeach 

				@else
					<td colspan="15" align="center">Booking is not done yet.</td>
				@endif


            </tbody>
        </table>
    </div>
@endsection