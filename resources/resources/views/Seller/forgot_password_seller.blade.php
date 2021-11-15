@extends('User.layouts.app')

@section('data')
	<div class="row mt-5">
		<div class="col-sm-4 offset-sm-4">
			<div class="card mtb-30 border shadow round10">
				<div class="card-header" style="text-align:center;">
				<h3>Forgot Password</h3>
				</div>
				<div class="card-body">
					@if ($error)
						<div class="alert alert-danger">{{ $error }}</div>
					@endif
					@if ($message)
						<div class="alert alert-success">{{ $message }}</div>
					@endif
					<form method="post" action="{{ route('forgot_password_seller') }}">
					@csrf
						<div class="form-group">
							<label>Name/Email</label>
							<input type="text" name="name_email" value="{{ old('name_email') }}"  class="form-control" required>
						</div>
						<div class="text-center">
							<input type="submit" value="Send OTP" class="btn btn-primary btn-block">
						</div><br>
                        <a href="{{ route('seller_login') }}">Click Here to Login</a>
					</form>
				</div> 
			</div>
		</div>
    </div>

@endsection