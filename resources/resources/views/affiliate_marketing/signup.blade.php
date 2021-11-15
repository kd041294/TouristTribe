@extends('affiliate_marketing.layout.app')

@section('menu')
	<div id="main" >
	  <div class="card border shadow round10 p-4">
	    <span style="margin-top: -20px" class="right-corner color border round10 p-1 bg-light">
	      <a href="{{ route('affiliate_marketing_login') }}">Login</a>
	    </span>
	  </div>
	</div>
@endsection

@section('data')
	<div class="row mt-3 mb-5">
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
					<form method="post">
            @csrf
            <div class="form-group">
                <label>User Id</label>
                <input type="text" name="user_id" value="{{ old('user_id') }}" class="form-control" placeholder="your unique user id" required/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}"  class="form-control" placeholder="your email id" required/>
            </div>
            <div class="form-group">
                <label>Website Name</label>
                <input type="text" name="website_name" value="{{ old('website_name') }}" placeholder="Eg. Touristtribe.in"  class="form-control" required/>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="your mobile no." required/>
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