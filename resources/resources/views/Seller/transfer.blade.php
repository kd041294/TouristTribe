@extends('Seller.layouts.app')


@section('data')
	<x-message/>
	<a href="create-transfer" class="btn bttn bttn-float bttn-md round20 color1 shadow"><i class="fa fa-car" aria-hidden="true"></i> Upload Transfer</a>

	<div class="card mt-3">
		<div style="overflow-x:auto">
		    		    		<div class="container-fluid mt-5 mb-5 table-responsive text-nowrap">
		<table class="tablemanager table table-bordered table-striped text-center table-hover w-100">
	        <thead>
		        <tr>
		            <th>ID</th>
		            <th>Name</th>
		            <th>Type</th>
		            <th>Total Person</th>
		            <th>Total Cost</th>
					<th>Created Date</th>
		            <th>Action</th>
		        </tr>
	    	</thead>
	    	<tbody> 
	    		<?php $increment = 1; ?>
	    		@foreach($transferData as $transferDatas)
	    			<?php $id = base64_encode($transferDatas -> id); ?>
		    		<tr>
		    			<td>{{ $increment }}</td>
		    			<td>{{ $transferDatas -> name }}</td>
		    			<td>{{ $transferDatas -> type }}</td>
		    			<td>{{ $transferDatas -> total_person }}</td>
		    			<td>{{ $transferDatas -> total_cost }}</td>
		    			<td>{{ date('M-d-Y g:i A', strtotime($transferDatas -> created_at)) }}</td>
		    			<td>
		    				@if($transferDatas -> use == 0)
		    					<a class="btn bttn bttn-float bttn-md round20 color1 shadow" 
		    					href="{{ route('seller_delete_transfer', base64_encode($transferDatas->id)) }}">D</a>
								<a href="{{ route('edit_transfer', base64_encode($transferDatas->id)) }}" class="btn bttn bttn-float bttn-md round20 color1 shadow">E</a>
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
	<a href="create-trip" class="btn bttn bttn-float bttn-md round20 color1 shadow">Next Step <i class="fa fa-arrow-right" aria-hidden="true"></i> <i class="fa fa-suitcase" aria-hidden="true"></i> ️Uploade Trip</a>
@endsection