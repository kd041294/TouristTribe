@extends('travel_preneur.layouts.master')

@section('menu')
	<div id="main" >
	  <div class="card border shadow round10 p-3">
	  	<span>
	  		<img src="{{ asset('storage/public/YyHZ5a7mS8a2OUSHmWOqPp2vpTekFTx1xHPAQgp1.jpeg') }}" class="rounded-circle" width="25px" height="25px">
			TouristTribe TravelPreneur
		</span>
	    <span class="right-corner color border round10 bg-light">

	      	<a href="{{ route('travel_preneur_logout') }}">Logout</a>
	    </span>
	  </div>
	</div>
@endsection

@section('data')
	<x-message/>
	<div class="container">
	    
	        <h3 style="text-align:right;">Your Id : {{ $travel_preneur_data->id }}</h3>
            <h2 class="mt-5" style="text-align:center;">SELLER's
            </h2>
        <hr>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr align="center">
                    <th >S.No.</th>
                    <th>Name</th>
                    <th>Email</th>
					<th>Company Name</th>
					<th>Aadhar No.</th>
					<th>GST No.</th>
                    <th>Phone No.</th>
                </tr>
            </thead>
            <tbody>
                @if(count($tour_operators))
					@foreach($tour_operators as $tour_operator)
						<tr align="center">
							<td class="counterCell"></td>
							<td>{{ $tour_operator->name }}</td>
							<td>{{ $tour_operator->email }}</td>
							<td>{{ $tour_operator->comp_name }}</td>
							<td>{{ $tour_operator->adhar_number }}</td>
							<td>{{ $tour_operator->gst }}</td>
							<td>{{ $tour_operator->mobile_number }}</td>
						</tr>
					@endforeach
				@else
					<td colspan="7" align="center">No Tour Operators.</td>
				@endif
               
            </tbody>
        </table>
    </div>
	
@endsection