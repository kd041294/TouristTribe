@extends('Seller.layouts.app')

@section('data')
	<x-message/>
	<a href="create-hotel" class="btn bttn bttn-float bttn-md round20 color1 shadow">🏢 Create Hotel</a>

	<div class="card mt-3">
		<div style="">
			<table class="tablemanager table-bordered trips table  table-striped w-100">
			<thead>
				<tr>
					<th>Id</th>
					<th>Location Name</th>
					<th>Hotel Name </th>
					<th>Hotel Type</th>
					<th>Hotel Rating </th>
					<th>Single bed price</th>
					<th>Double bed price</th>
					<th>Triple bed price</th>
					<th>Created date</th>
					<th>Hotel pics</th>
					<th>Delete</th><!--₹-->
				</tr>
			</thead>
			<tbody>
				<?php $increment = 1; ?>
				@foreach($hotelData as $hotelDatas)
					<?php $id = base64_encode($hotelDatas -> id); ?>
					<tr>
						<td> {{ $increment }} </td>
						<td> {{ $hotelDatas -> location_name }} </td>
						<td> {{ $hotelDatas -> hotel_name }} </td>
						<td> {{ $hotelDatas -> type }} </td>
						<td> {{ $hotelDatas -> rating }} </td>
						<td> {{ $hotelDatas -> single_bed_type_cost }} </td>
						<td> {{ $hotelDatas -> double_bed_type_cost }} </td>
						<td> {{ $hotelDatas -> triple_bed_type_cost }} </td>
						<td> {{ date('M-d-Y g:i A', strtotime($hotelDatas -> created_at))  }} </td>
						<td> --- </td>
	    				<td>
	    					@if($hotelDatas -> use == 0)
	    						<a class="btn bttn bttn-float bttn-md round20 color1 shadow" 
	    						href='{{asset("seller/delete_hotel/$id")}}'>Click Me</a>
	    					@else
	    						<p title="because this is connected to trip">Not Possible</p>
	    					@endif
	    				</td>
	    				<?php $increment = $increment + 1;  ?>
					</tr>
				@endforeach
			</tbody>
		</table>
		</div>
	</div>
@endsection