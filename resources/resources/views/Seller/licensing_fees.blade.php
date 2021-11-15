@extends('Seller.layouts.app')

@section('data')

	<x-message/>
	<a href="{{ route('create_licensing_fees') }}" class="btn bttn bttn-float bttn-md round20 color1 shadow"><i class="fa fa-id-card" aria-hidden="true"></i> Upload Licesence Fees</a>

	<div class="card mt-3">
		<div style="overflow-x:auto">
		    		    		<div class="container-fluid mt-5 mb-5 table-responsive text-nowrap">

			<table class="tablemanager table table-bordered table-striped text-center table-hover w-100">
		        <thead>
			        <tr>
			            <th>ID</th>
			            <th>Location</th>
			            <th>Per Head Cost</th>
						<th>Details</th>
						<th>Created Date</th>
			            <th>Action</th>
			        </tr>
		    	</thead>
		    	<tbody> 
		    		<?php $increment = 1; ?>
		    		@foreach($feesData as $feesDatas )
		    			<?php $id = base64_encode($feesDatas -> id); ?>
		    			<tr>
		    				<td>{{ $increment }}</td>
		    				<td>{{ $feesDatas -> location_name }}</td>
		    				<td>{{ $feesDatas -> per_head_cost }}</td>
							<td>{{ $feesDatas -> fee_details }}</td>
		    				<td>{{ date('M-d-Y g:i A', strtotime($feesDatas -> created_at)) }}</td>
		    				<td>
		    					@if($feesDatas -> use == 0)
									<a class="btn bttn bttn-float bttn-md round20 color1 shadow" 
									href="{{ route('seller_delete_meal', base64_encode($feesDatas->id)) }}">D</a>
									<a href="{{ route('edit_meal', base64_encode($feesDatas->id)) }}" class="btn bttn bttn-float bttn-md round20 color1 shadow">E</a>
		    					@else
		    						<p title="because this is connected to trip">Not Possible</p>
		    					@endif
		    				</td>
		    			</tr>
		    			<?php $increment = $increment + 1; ?>
		    		@endforeach
		    	</tbody>
		    </table>
		</div></div>
	</div><br>
	<a href="create-midtrip" class="btn bttn bttn-float bttn-md round20 color1 shadow">Next Step <i class="fa fa-arrow-right" aria-hidden="true"></i> <i class="fa fa-map" aria-hidden="true"></i> Upload Midtrip</a>

@endsection