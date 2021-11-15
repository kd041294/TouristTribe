@extends('Seller.layouts.app')

@section('data')
	<x-message/>
	<a href="create-location" class="btn bttn bttn-float bttn-md round20 color1 shadow"><i class="fa fa-location-arrow" aria-hidden="true"></i> Upload Location</a>
	
	<div class="card mt-3">
		<div style="overflow-x:auto">
		<table class="tablemanager table table-bordered table-striped text-center table-hover w-100">
	        <thead>
		        <tr>
		            <th>ID</th>
		            <th>Name</th>
		            <th>Image</th>
		            <th>Type</th>
		            <th>City Name</th>
		            <th>Total member</th>
		            <th>Min family member</th>
					<th>Created Date</th>
		            <th width="10%">Action</th>
		        </tr>
	    	</thead>
	    	<tbody>
	    		<?php $increment = 1 ?>
	    		@foreach($locations_data as $datas)
	    			<?php $id = base64_encode($datas -> id); ?>
	    			<tr>
	    				<td><?php echo $increment ?></td>
	    			
	    				<td>{{ $datas -> name }}</td>
	    			
	    				<td>
	    					<?php $img = $datas -> location_images ?>
	    					<img src="{{ asset('storage/'.$img) }}" class="img-fluid rounded">
	    				</td>
	    		
	    				<td>
	    					<?php
	    						$string = $datas -> type; 
	    						$array = explode(',',$string);
	    						$count = count($array);
	    						echo "
	    						<div class='pl-3'>
	    							<ol>";
	    						for($i = 0; $i < $count; $i++){
	    							echo "<li>". $array[$i] ."</li>";
	    						}
	    						echo "
	    							</ol>
	    						</div>";
	    					?>
	    				</td>
	    				<td>
	    					@if($datas -> name_of_city)
	    						{{ $datas -> name_of_city }}
	    					@else
	    						{{ "Sorry not selected" }}
	    					@endif
	    				</td>
	    				<td>{{ $datas -> total_member_size }}</td>
	    				<td>{{ $datas -> min_family_member }}</td>
	    				<td>
	    					{{ date('M-d-Y g:i A', strtotime($datas -> created_at)) }}
	    				</td>
	    				<td>
	    					@if($datas -> use == 0)
	    						<a class="btn bttn bttn-float bttn-md round20 color1 shadow" 
	    						href="{{ route('seller_delete_location', base64_encode($datas->id)) }}">D</a>
								<a href="{{ route('edit_location', base64_encode($datas->id)) }}" class="btn bttn bttn-float bttn-md round20 color1 shadow">E</a>
	    					@else
	    						<p title="because this is connected to trip">Not Possible</p>
	    					@endif
	    				</td>
	    			</tr>
	    			<?php $increment = $increment + 1 ?>
	    		@endforeach
	    	</tbody>
	    </table>
		</div>

	</div>
	<br>
	<a href="create-hotel" class="btn bttn bttn-float bttn-md round20 color1 shadow">Next Step <i class="fa fa-arrow-right" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i> Upload Hotel</a>
@endsection