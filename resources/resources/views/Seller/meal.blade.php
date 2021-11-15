@extends('Seller.layouts.app')

@section('data')

	<x-message/>
	<a href="create-meal" class="btn bttn bttn-float bttn-md round20 color1 shadow"><i class="fa fa-cutlery" aria-hidden="true"></i> Upload Meal</a>

	<div class="card mt-3">
		<div style="overflow-x:auto">
		    		<div class="container-fluid mt-5 mb-5 table-responsive text-nowrap">

			<table class="tablemanager table table-bordered table-striped text-center table-hover w-100">
		        <thead>
			        <tr>
			            <th>ID</th>
			            <th>Location</th>
			            <th>Breakfast</th>
			            <th>Lunch</th>
			            <th>Evening</th>
			            <th>Dinner</th>
			            <th>Per Head Cost</th>
						<th>Created Date</th>
			            <th>Action</th>
			        </tr>
		    	</thead>
		    	<tbody> 
		    		<?php $increment = 1; ?>
		    		@foreach($mealData as $mealDatas )
		    			<?php $id = base64_encode($mealDatas -> id); ?>
		    			<tr>
		    				<td>{{ $increment }}</td>
		    				<td>{{ $mealDatas -> location_name }}</td>
		    				<td>{{ $mealDatas -> breakfast_details }}</td>
		    				<td>{{ $mealDatas -> lunch_details }}</td>
		    				<td>{{ $mealDatas -> evening_tea_details }}</td>
		    				<td>{{ $mealDatas -> dinner_details }}</td>
		    				<td>{{ $mealDatas -> per_head_cost }}</td>
		    				<td>{{ date('M-d-Y g:i A', strtotime($mealDatas -> created_at)) }}</td>
		    				<td>
		    					@if($mealDatas -> use == 0)
									<a class="btn bttn bttn-float bttn-md round20 color1 shadow" 
									href="{{ route('seller_delete_meal', base64_encode($mealDatas->id)) }}">D</a>
									<a href="{{ route('edit_meal', base64_encode($mealDatas->id)) }}" class="btn bttn bttn-float bttn-md round20 color1 shadow">E</a>
		    					@else
		    						<p title="because this is connected to trip">Not Possible</p>
		    					@endif
		    				</td>
		    			</tr>
		    			<?php $increment = $increment + 1; ?>
		    		@endforeach
		    	</tbody>
		    </table>
		</div>
	</div></div>
	<br>
	<a href="{{ route('create_licensing_fees') }}" class="btn bttn bttn-float bttn-md round20 color1 shadow">Next Step <i class="fa fa-arrow-right" aria-hidden="true"></i> <i class="fa fa-id-card" aria-hidden="true"></i> Upload Licesence Fees</a>

@endsection