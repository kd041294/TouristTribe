@extends('Seller.layouts.app')

@section('data')
	<x-message/>
	<a href="create-midtrip" class="btn bttn bttn-float bttn-md round20 color1 shadow"><i class="fa fa-map" aria-hidden="true"></i> Upload Midtrip</a>

	<div class="card mt-3">
		<div style="overflow-x:auto">		    		
		<div class="container-fluid mt-5 mb-5 table-responsive text-nowrap">
		<table class="tablemanager table table-bordered table-striped text-center table-hover w-100">
	        <thead>
		        <tr>
		            <th>ID</th>
		            <th>Name</th>
		            <th>Description</th>
		            <th>Location Name</th>
		            <th>Image</th>
					<th>Created Date</th>
		            <th>Action</th>
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
	    					<img src="{{ asset('storage/'.$img) }}" class="img-fluid rounded" width="200px" height="auto">
	    				</td>
	    				<td>{{ date('M-d-Y g:i A', strtotime($midtripDatas -> created_at)) }}</td>
	    				<td>
	    					@if($midtripDatas -> use == 0)
	    						<a class="btn bttn bttn-float bttn-md round20 color1 shadow" 
	    						href="{{ route('seller_delete_midtrip', base64_encode($midtripDatas->id)) }}">D</a>
								<a href="{{ route('edit_midtrip', base64_encode($midtripDatas->id)) }}" class="btn bttn bttn-float bttn-md round20 color1 shadow">E</a>
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
	<a href="create-transfer" class="btn bttn bttn-float bttn-md round20 color1 shadow">Next Step <i class="fa fa-arrow-right" aria-hidden="true"></i> <i class="fa fa-car" aria-hidden="true"></i> Upload Transfer</a>
@endsection