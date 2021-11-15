@extends('User.layouts.app')

@section('menu')
	<div id="main" >
	  <div class="card border shadow round10 p-4">
	    <span style="margin-top: -20px" class="right-corner color border round10 p-1 bg-light">
	      <a href="{{asset('login')}}">Login</a>
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
					  <p><strong>{{ session('status')}}</strong></p>
					</div>
				@endif
			</div>
			<form method="post" action="{{asset('/sinup/sinup_data')}}"
//       action="https://www.aweber.com/scripts/addlead.pl>
				@csrf
				<div class="form-group">
					<label>Enter user name</label>
					<input
					type="text" name="user_name" class="form-control" required
					placeholder="Enter user name"
					/>
				</div>
				<div class="form-group">
					<label>Enter email id</label>
					<input
					type="text" name="email" class="form-control" required
					placeholder="Enter your email id"
					/>
				</div>
				<div class="form-group">
					<label>Enter Phone number</label>
					<input type="number" name="phone" class="form-control" required placeholder="Enter your phone number"/>
				</div>
				<div class="form-group">
					<label>Enter password</label>
					<input
					type="password" name="password" class="form-control" required
					placeholder="Enter password"
					/>
				</div>
				<div class="text-center">
					<input type="submit" value="submit" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
@endsection