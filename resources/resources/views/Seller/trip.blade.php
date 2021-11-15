@extends('Seller.layouts.app')


@section('data')
	<x-message/>
	<a href="create-trip" class="btn bttn bttn-float bttn-md round20 color1 shadow"><i class="fa fa-suitcase" aria-hidden="true"></i> ️Uploade Trip</a>

	<div class="card mt-3">
		<div style="overflow-x:auto">
		    <div class="container-fluid mt-5 mb-5 table-responsive text-nowrap">
		<table class="tablemanager table table-bordered table-striped text-center table-hover w-100">
	        <thead>
		        <tr>
		            <th>ID</th>
		            <th>Trip Name</th>
		            <th>Trip Location</th>
		            <th>Days</th>
		            <th>Night</th>
		            <th>Hotels</th>
		            <th>Midtrip</th>
		            <th>Vehical</th>
		            <th>Gender</th>
		            <th>Religions</th>
		            <th>Pickup details</th>
		            <th>Drop details</th>
		            <th>Other details</th>
					<th>Created Date</th>
		            <th width="100px">Action</th>
		        </tr>
	    	</thead>
	    	<tbody> 
	    		<?php 
	    			$increment = 1; 
	    		?>
	    		@if($tripData != '[]' )
	    		@for($i = 0; $i < $dataLimit; $i++)
	    			<?php $id = base64_encode($tripData[$i] -> id); ?>
	    			<tr>
	    				<td>{{ $increment }}</td>
	    				<td>{{ $tripData[$i]->trip_name }}</td>
	    				<td>{{ $tripData[$i] -> location_name}}</td>
	    				<td>{{ $tripData[$i] -> no_of_days}}</td>
	    				<td>{{ $tripData[$i] -> no_of_nights}}</td>
	    				<td>
	    						{{ $hotelData[$i] }}
	 	    			</td>
	    				<td>{{ $midtripData[$i] }}</td>
	    				<td>{{ $tripData[$i] -> transfers}}</td>
	    				<td>
	    					<ol>
	    						@if($tripData[$i] -> allGender)
	    							<li>All Genders</li>
	    						@endif
	    						@if($tripData[$i] -> onlyMens)
	    							<li>Only Mens</li>
	    						@endif
	    						@if($tripData[$i] -> onlyWomens)
	    							<li>Only Womens</li>
	    						@endif
	    					</ol>
	    				</td>
	    				<td>
	    					<ol>
	    						@if($tripData[$i] -> allCast)
	    							<li>All Religions</li>
	    						@endif
	    						@if($tripData[$i] -> buddhismCast)
	    							<li>Only Buddhism</li>
	    						@endif
	    						@if($tripData[$i] -> hinduCast)
	    							<li>Only Hindu</li>
	    						@endif
	    						@if($tripData[$i] -> sikhismCast)
	    							<li>Only Sikhism</li>
	    						@endif
	    						@if($tripData[$i] -> islamCast)
	    							<li>Only Islam</li>
	    						@endif
	    						@if($tripData[$i] -> christianCast)
	    							<li>Only Christian</li>
	    						@endif
	    					</ol>
	    				</td>
	    				<td>{{ $tripData[$i] -> pickup_details}}</td>
	    				<td>{{ $tripData[$i] -> drop_details}}</td>
	    				<td>
	    					{{ limit_text($tripData[$i] -> other_details, 10)}}
	    				</td>
	    				<td>{{ date('M-d-Y g:i A', strtotime($tripData[$i] -> created_at)) }}</td>
	    				<td>
	    					<a class="btn bttn bttn-float bttn-md round20 color1 shadow" 
	    					href="{{ route('seller_delete_trip', base64_encode($tripData[$i]->id)) }}">D</a>
							<a href="{{ route('edit_trip', base64_encode($tripData[$i]->id)) }}" class="btn bttn bttn-float bttn-md round20 color1 shadow">E</a>
	    				</td>
	    			</tr>
    			<?php $increment = $increment + 1; ?>
	    		@endfor
	    		@endif
	    	</tbody>
	    </table>
		</div></div>
	</div>
@endsection
<?php
	//this is for string limit
	function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}
?>