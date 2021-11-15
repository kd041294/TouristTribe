@extends('User.layouts.app')
@section('menu')
<div id="main" >
	<div class="card border shadow round10 p-4">
		<span style="margin-top: -20px" class="right-corner color border round10 p-1 bg-light">
			<a href="{{ route('signup') }}">Signup</a>
		</span>
	</div>
</div>
@endsection
@section('data')
	<div class="row mt-5">
		<div class="col-sm-4 offset-sm-4">
			<div class="card mtb-5 border shadow round10">
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
					<form method="post" action="{{ route('forgot_password') }}">
					@csrf
						<div class="form-group">
							<label>Name/Email</label>
							<input type="text" name="name_email" value="{{ old('name_email') }}"  class="form-control" required>
						</div>
						<div class="text-center">
							<input type="submit" value="Send OTP" class="btn btn-primary btn-block">
						</div><br>
                        <a href="{{ route('login') }}">Click Here to Login</a>
					</form>
				</div> 
			</div>
		</div>
    </div>

@endsection