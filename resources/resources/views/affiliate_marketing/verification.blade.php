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
                    @if($note)
                        <div class="alert alert-primary">{{ $note }}</div>
                    @endif
					<form method="post">
					@csrf
						<div class="form-group">
							<label>Enter OTP</label>
							<input type="text" name="otp"  class="form-control" required>
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