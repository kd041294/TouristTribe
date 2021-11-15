@extends('travel_preneur.layouts.signupPage')

@section('menu')
	<div id="main" >
	  <div class="card border shadow round10 p-3">
	  	<span>
	  		<img src="{{ asset('storage/public/YyHZ5a7mS8a2OUSHmWOqPp2vpTekFTx1xHPAQgp1.jpeg') }}" class="rounded-circle" width="25px" height="25px">
			TouristTribe TravelPreneur
		</span>
	    <span class="right-corner color border round10 bg-light">
	      <a href="{{ route('travel_preneur_login') }}">Login</a>
	    </span>
	  </div>
	</div>
@endsection

@section('data')
	<div class="row mt-2 mb-5">
		<div class="col-sm-6 offset-sm-3">
			<div class="card mt-5 border shadow round10">
				<div class="card-header" style="text-align:center;">
				<h4>Signup</h4>
				</div>
				
				<div class="card-body">
					@if ($error)
						<div class="alert alert-danger">{{ $error }}</div>
					@endif
					@if ($message)
						<div class="alert alert-success">{{ $message }}</div>
					@endif
					<form method="post" action="{{ route('travel_preneur_signup') }}" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
					<label>Name</label>
					<input
					type="text" name="user_name" value="{{ old('user_name') }}" class="form-control" required
					/>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input
					type="email" name="email" value="{{ old('email') }}"  class="form-control" required
					/>
				</div>
                <div class="form-group">
					<label>Aadhar No.</label>
					<input
					type="text" name="aadhar_no" value="{{ old('aadhar_no') }}"  class="form-control" required
					/>
				</div>
                <div class="form-group">
					<label>Aadhar Pic</label>
					<input type="file" name="aadhar_pic" class="form-control"/>
				</div>
				<div class="form-group">
					<label>Phone Number</label>
					<input type="number" name="phone" class="form-control" value="{{ old('phone') }}" required/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input
					type="password" name="password" class="form-control" required/>
				</div>
				<div class="text-center">
					<input type="submit" value="Submit" class="btn btn-primary btn-block">
				</div>
					</form>
				</div> 
			</div>
		</div>
    </div>
	
@endsection