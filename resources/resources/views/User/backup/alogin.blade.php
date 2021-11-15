@extends('User.layouts.app')
@section('menu')
<div id="main" >
	<div class="card border shadow round10 p-4">
		<span style="margin-top: -20px" class="right-corner color border round10 p-1 bg-light">
			<a href="{{asset('/signup')}}">Signup</a>
		</span>
	</div>
</div>
@endsection
@section('data')
<div class="row">
	<div class="col-sm-12 p-4 border-left border-right">
		<div class="text-center">
			@if (session('status'))
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<p><strong>{{ session('status') }}</strong></p>
			</div>
			@endif
		</div>
		<form method="post" action="{{asset('login/login_data')}}">
			@csrf
			<div class="form-group">
				<label>Enter user name or email</label>
				<input type="text" name="user_name" class="form-control" required
				placeholder="Enter user name or email">
			</div>
			<div class="form-group">
				<label>Enter password</label>
				<input type="password" name="password" class="form-control" required
				placeholder="Enter password">
			</div>
			<div class="text-center">
				<input type="submit" value="submit"
				class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
@endsection