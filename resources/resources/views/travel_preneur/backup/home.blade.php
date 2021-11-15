@extends('travel_preneur.layouts.master')

@section('menu')
	<div id="main" >
	  <div class="card border shadow round10 p-3">
	  	<span>
	  		<img src="{{ asset('storage/public/YyHZ5a7mS8a2OUSHmWOqPp2vpTekFTx1xHPAQgp1.jpeg') }}" class="rounded-circle" width="25px" height="25px">
			TouristTribe Travel Preneur
		</span>
	    <span class="right-corner color border round10 bg-light">

	      <a href="{{ route('travel_preneur_logout') }}">Logout</a>
	    </span>
	  </div>
	</div>
@endsection

@section('data')
	<h1>Hello New User</h1>
	
@endsection