@extends('Seller.layouts.app')

@section('data')
	<x-message/>
	<a href="create-midtrip" class="btn bttn bttn-float bttn-md round20 color1 shadow">📍 Create Midtrip</a>

	<div class="card mt-3">
		<div style="overflow-x:auto">
		<table class="tablemanager table table-bordered table-striped text-center table-hover w-100">
	        <thead>
		        <tr>
		            <th>ID</th>
		            <th>Name</th>
		            <th>Description</th>
		            <th>Location Name</th>
		            <th>Image</th>
					<th>Created Date</th>
		            <th>Delete</th>
		        </tr>
	    	</thead>
	    	<tbody> 
	    		<?php $increment = 1; ?>
	    		@foreach($midtripData as $midtripDatas )
	    			<?php $id = base64_encode($midtripDatas -> id); ?>
	    			<tr>
	    				<td>{{ $increment }}</td>
	    				<td>{{ $midtripDatas -> name }}</td>
	    				<td>{{ $midtripDatas -> description }}</td>
	    				<td>{{ $midtripDatas -> location_name }}</td>
	    				<td>
	    					<?php $img = $midtripDatas -> images; ?>
	    					<img src='{{("/$img")}}' width="200px" height="200px"/>
	    				</td>
	    				<td>{{ date('M-d-Y g:i A', strtotime($midtripDatas -> created_at)) }}</td>
	    				<td>
	    					@if($midtripDatas -> use == 0)
	    						<a class="btn bttn bttn-float bttn-md round20 color1 shadow" 
	    						href='{{asset("seller/delete_midtrip/$id")}}'>Click Me</a>
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
	</div>
@endsection