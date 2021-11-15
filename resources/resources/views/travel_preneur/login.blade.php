@extends('travel_preneur.layouts.loginPage')

@section('menu')
	<div id="main" >
	  <div class="card border shadow round10 p-3">
	  	<span>
	  		<img src="{{ asset('storage/public/YyHZ5a7mS8a2OUSHmWOqPp2vpTekFTx1xHPAQgp1.jpeg') }}" class="rounded-circle" width="25px" height="25px">
			TouristTribe TravelPreneur
		</span>
	    <span class="right-corner color border round10 bg-light">
	      <a href="{{ route('travel_preneur_signup') }}">Signup</a>
	    </span>
	  </div>
	</div>
@endsection

@section('data')
	<div class="row mt-5">
		<div class="col-sm-4 offset-sm-4">
			<div class="card mtb-5 border shadow round10">
				<div class="card-header" style="text-align:center;">
				<h3>Login</h3>
				</div>
				<div class="card-body">
					@if ($error)
						<div class="alert alert-danger">{{ $error }}</div>
					@endif
					@if ($message)
						<div class="alert alert-success">{{ $message }}</div>
					@endif
					<form method="post" action="{{ route('travel_preneur_login') }}">
					@csrf
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" value="{{ old('email') }}"  class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password"  class="form-control" required>
						</div>
						<div class="text-center">
							<input type="submit" value="submit" class="btn btn-primary btn-block">
						</div>
					</form><br>
					<a href="{{ route('travel_preneur_forgot_password') }}">Forgot Password</a>
				</div> 
			</div>
		</div>
    </div>

@endsection