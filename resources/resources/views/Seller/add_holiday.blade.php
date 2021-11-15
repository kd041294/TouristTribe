@extends('Seller.layouts.app')

@section('data')
    <x-message/>
    
	<!-- <h4 class="text-center">ADD HOLIDAY<span><a href="" class="btn btn-primary pull-right">ADD</a></span></h4> -->
    <div class="row mt-5 mb-5">
		<div class="col-sm-4 offset-sm-4">
			<div class="card mtb-5 border shadow round10">
				<div class="card-header" style="text-align:center;">
				<h3>ADD HOLIDAY</h3>
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
							<label>Reason</label>
							<input type="text" name="reason" value="{{ old('reason') }}"  class="form-control" required>
						</div>
                        <div class="form-group">
							<label>From Date</label>
							<input type="date" name="from_date"  class="form-control" min="{{ date('Y-m-d') }}"required>
						</div>
                        <div class="form-group">
							<label>TO Date</label>
							<input type="date" name="to_date"  class="form-control" min="{{ date('Y-m-d') }}"required>
						</div>
						<div class="text-center">
							<input type="submit" value="submit" class="btn btn-primary btn-block">
						</div>
					</form><br>
					
				</div> 
			</div>
		</div>
    </div>

@endsection
