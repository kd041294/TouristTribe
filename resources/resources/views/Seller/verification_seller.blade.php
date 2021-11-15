@extends('User.layouts.app')
@section('menu')

@endsection
@section('data')
	<div class="row mt-5">
		<div class="col-sm-4 offset-sm-4">
			<div class="card mtb-5 border shadow round10">
				<div class="card-header" style="text-align:center;">
				<h3>Verification</h3>
				</div>
				<div class="card-body">
					@if ($error)
						<div class="alert alert-danger">{{ $error }}</div>
					@endif
					@if ($message)
						<div class="alert alert-success">{{ $message }}</div>
					@endif
					<form method="post">
					@csrf
						<div class="form-group">
							<label>Enter OTP (Check your mail & SMS)</label>
							<input type="text" name="otp"  class="form-control" required>
							<p>Please, wait for a while. <br>We are generating your OTP</p>
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