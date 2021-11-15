@extends('travel_preneur.layouts.master')

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
    <div class="row mt-5">
		<div class="col-sm-4 offset-sm-4">
			<div class="card mtb-5 border shadow round10">
				<div class="card-header" style="text-align:center;">
				<h3>Change Password</h3>
				</div>
				<div class="card-body">
                    @if($note)
						<div class="alert alert-primary">{{ $note }}</div>
					@endif
					@if($error)
						<div class="alert alert-danger">{{ $error }}</div>
					@endif
					@if($message)
						<div class="alert alert-success">{{ $message }}</div>
					@endif
					<form method="post" action="{{ route('travel_preneur_forgot_password_otp_verification') }}">
					@csrf
						<div class="form-group">
							<label>Enter OTP</label>
							<input type="text" name="otp" value="{{ old('otp') }}"  class="form-control" required>
						</div>
                        <div class="form-group">
							<label>New Password</label>
							<input type="password" name="new_password"  class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Confirm New Password</label>
							<input type="password" name="confirm_new_password"  class="form-control" required>
						</div>
						<div class="text-center">
							<input type="submit" value="submit" class="btn btn-primary btn-block">
						</div>
					</form>
				</div> 
			</div>
		</div>
    </div>
@endsection