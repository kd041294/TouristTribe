@extends('User.layouts.app')

<style>

.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
</style>


@section('menu')
	<div id="main" >
	   
	  <div class="card border shadow round10 p-4">
	      
	    <span style="margin-top: -20px" class="right-corner color border round10 p-1 bg-light">
	        
	      @if(session('sessionId'))
		 	<a data-toggle="modal" data-target="#home_filter" href="#">Filter</a> |
		  	<a href="{{asset('/ongoing_trip')}}">Ongoing Trip</a> |
	      	<a href="{{asset('logout')}}">Logout</a>
	      @else
				<a data-toggle="modal" data-target="#home_filter" href="#">Filter</a> |	
				<a href="{{asset('/ongoing_trip')}}">Ongoing Trip</a> |
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

<!-- The Modal -->
<div class="modal" id="home_filter">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="get">
				<div class="modal-header">
					<h4 class="modal-title">Filter</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">Location Served Areas</div>
						@foreach($data_served_areas as $index => $data_served_area)
							<div class="col-sm-3">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="location[]" value="{{ $index }}">{{ $data_served_area }}</label>
								</div>
							</div>
						@endforeach
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12">Gender</div>
						@foreach($genders as $index => $gender )
							<div class="col-sm-3">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="gender[]" value="{{ $index }}">{{ $gender }}</label>
								</div>
							</div>
						@endforeach
					</div>
					<div class="row">
						<div class="col-sm-12">Religions</div>
						@foreach($religions as $index => $religion )
							<div class="col-sm-3">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="religion[]" value="{{ $index }}">{{ $religion }}</label>
								</div>
							</div>
						@endforeach
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-sm" >Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>