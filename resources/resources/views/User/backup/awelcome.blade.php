@extends('User.layouts.app')

@section('menu')
	<div id="main" >
	   
	  <div class="card border shadow round10 p-4">
	      
	    <span style="margin-top: -20px" class="right-corner color border round10 p-1 bg-light">
	        
	      @if(session('sessionId'))
	      	<a href="{{asset('logout')}}">Logout</a>
	      @else
	      <a href="{{asset('/signup')}}">Signup</a> |
	      	<a href="{{asset('login')}}">Login</a>
	      @endif
	    </span>
	  </div>
	</div>
@endsection
@section('data')
	<div class="container mt-3">
		@if(session('message'))
			<div class="alert alert-success alert-dismissible text-center">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <p><strong>{{ session('message') }}</strong></p>
			</div>
		@endif
		<div class="row">
		@foreach($datas as $data)
			<?php 
				$img = $data -> location_images;
				$imgLocation =  "http://touristtribe.in/storage/$img";
			?>
			<div class="col-sm-4">
				<div class="card border10 shadow" style="width: 100%;">
					<img class="card-img-top" src="{{$imgLocation}}" height=auto />
					<div class="card-body">
						<div class="text-center">
							<h4 class="card-title text-uppercase">{{ $data -> name }}</h4>
							<a href="trip_details/{{ $data -> name }}" class="btn btn-primary">
							See Profile</a>
						</div>
					</div>
				</div>	
			</div>
		@endforeach
		</div>
	</div>
@endsection