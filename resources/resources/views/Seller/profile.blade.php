@extends('Seller.layouts.app')

@section('data')
	<div class="container">
		<div class="row">
			<div class="col-sm-6 offset-sm-3">
				<div class="card mt-3 mb-3 border shadow round10">
					<div class="card-header" style="text-align:center;">
					<h4>Your Profile</h4>
					</div>
					
					<div class="card-body">
						@if ($error)
							<div class="alert alert-danger">{{ $error }}</div>
						@endif
						@if ($message)
							<div class="alert alert-success">{{ $message }}</div>
						@endif

						@csrf
						<div class="form-group">
							<p>NAME = {{ $tour_operator_detail->name }}</p>
							<p>EMAIL = {{ $tour_operator_detail->email }}</p>
							<p>COMPANY NAME = {{ $tour_operator_detail->comp_name ? $tour_operator_detail->comp_name : 'NA' }}</p>
							<p>COMPANY WEBSITE = {{ $tour_operator_detail->comp_name_slug ? $tour_operator_detail->comp_name_slug : 'NA' }}.touristtribe.in</p>
							<p>MOBILE NO. = {{ $tour_operator_detail->mobile_number }}</p>
							<p>AADHAR NO. = {{ $tour_operator_detail->adhar_number ? $tour_operator_detail->adhar_number : 'NA' }}</p>
							<p>GST = {{ $tour_operator_detail->gst ? $tour_operator_detail->gst : 'NA' }}</p>
						</div>
					</div> 
				</div>
			</div>
		</div>
	</div>
	
@endsection