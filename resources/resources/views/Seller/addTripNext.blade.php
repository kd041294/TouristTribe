<?php $day = $data['day']; ?>
@extends('Seller.layouts.app')


@section('data')
	<div class="container border p-3 bg-light shadow round10">
		<div class="card">
			<div class="card-header text-center">
				<h3>Create Trip</h3>
			</div>
			<div class="card-body">
				<form method="post" action="trip_post">
		            @csrf
		            <input type="hidden" value="{{ $data['location_id'] }}" name="location_id">
		            <div class="form-group">
		                <label for="day">No of Day for trip</label>
		                <input type="number" class="form-control shadow round10" readonly 
		                value="{{ $data['day'] }}" name="number_of_day"/>
		            </div>
		            <div class="form-group">
		                <label for="location">Location Name</label>
		                <input type="text" class="form-control shadow round10" readonly 
		                value="{{ $data['location_name'] }}" name="location_name"/>
		            </div>
		            <div class="form-group">
		            	<label>Enter trip name</label>
		            	<input type="text" name="trip_name" placeholder="Enter trip name" class="form-control shadow round10">
		            </div>
		            <div class="form-group">
		            	<?php 
		            		$hotelData = $data['hotel']; 
		            		$inc = 1;
		            	?>
		            	<label>Select Hotels For {{ $day }} days</label>
		            	@for($i = 1; $i < $day; $i++)
				 		        <div class="row pl-3">
				            		<div class="col-4 border shadow round10 text-center">
				            			<label style="width: 100%">day {{ $inc  }}</label>
				            		</div>
				            		<div class="col-8">
				            			<select name="hotels[]" class="form-control shadow round10">
				            				<option value="000">Select for day {{ $inc }} Hotel {{ $inc }}</option>
				            				@foreach($hotelData as $hotelDatas)
				            					<option value="{{ $hotelDatas -> id }}">
				            						{{ $hotelDatas -> hotel_name }} --
				            						[
				            							Single - ( {{ $hotelDatas -> single_bed_type_cost }} )
				            							Double - ( {{ $hotelDatas -> double_bed_type_cost }} )
				            							Triple - ( {{ $hotelDatas -> triple_bed_type_cost }} )
				            						]
				            					</option>
				            				@endforeach
				            			</select>
				            		</div>
				            	</div>
				            	@if($day != $inc)
				            		<br>
				            	@endif
				            	<?php $inc = $inc + 1; ?>
		            	@endfor
		            </div>
					<div class="form-group">
		            	<?php
		            		$feesData = $data['license_fee_details'];
		            	?>
		            	<label>Select License Fee</label>
		            	<select name="license_fee_details" class="form-control shadow round10">
		            		<option>Select License Fee</option>
		            		@foreach($feesData as $feesDatas)
		            			<option value="{{ $feesDatas -> id }}">{{ $feesDatas -> per_head_cost }}</option>
		            		@endforeach
		            	</select>
		            </div>
		            <div class="form-group">
		            	<?php
		            		$mealData = $data['meal'];
		            	?>
		            	<label>Select Meal</label>
		            	<select name="meal" class="form-control shadow round10">
		            		<option>Select Meals</option>
		            		@foreach($mealData as $mealDatas)
		            			<option value="{{ $mealDatas -> id }}">{{ $mealDatas -> per_head_cost }}</option>
		            		@endforeach
		            	</select>
		            </div>
		            <div class="form-group">
		            	<?php
		            		$transferData = $data['transfer'];
		            	?>
		            	<label>Select Vehicle</label>
		            	<select name="transfer" class="form-control shadow round10">
		            		<option>Select Vehical</option>
		            		@foreach($transferData as $transferDatas)
		            			<option value="{{ $transferDatas -> id }}">{{ $transferDatas -> name }}
		            				({{ $transferDatas -> total_cost }})</option>
		            		@endforeach
		            	</select>
		            </div>
		            <div class="form-group">
		            	<?php
		            		$midtripData = $data['midtrip'];
		            	?>
		            	<label>Select MidTrip (In Computer Use <b>ctrl key</b> and Click it)</label>
		            	<select name="midtrip[]" multiple size="5" class="form-control shadow round10">
		            		<!--<option>Select midtrips</option>-->
		            		@foreach($midtripData as $midtripDatas)
		            			<option value="{{ $midtripDatas -> id }}">{{ $midtripDatas -> name }}</option>
		            		@endforeach
		            	</select>
		            </div>
		            <div class="form-group">
		            	<label>Gender :- </label>
		            	<div class="row">
		            		<div class="col">
				            	<div class="form-check">
					                <label class="form-check-label">
					                    <input type="checkbox" class="form-check-input" id="genderAll" name="all_gender" value="all_gender">All
					                </label>
				            	</div>
				            </div>
				            <div class="col">	
					            <div class="form-check">
					                <label class="form-check-label">
					                    <input type="checkbox" class="form-check-input" id="genderMen" name="only_men" value="only_men">Men
					                </label>
					            </div>
					        </div>
					        <div class="col">
					            <div class="form-check">
					                <label class="form-check-label">
					                    <input type="checkbox" class="form-check-input" id="genderWomen" name="only_women" value="only_women">Women
					                </label>
					            </div>
					        </div>
			            </div> 
		            </div>
		            <div class="form-group">
		            	<label>Religions :- </label>
		            	<div class="row">
		            		<div class="col">
			            		<div class="form-check">
					                <label class="form-check-label">
					                    <input type="checkbox" class="form-check-input" id="Religions_all" name="Religions_all" value="all">All
					                </label>
			            		</div>
			            	</div>
			            	<div class="col"> 
					            <div class="form-check">
					                <label class="form-check-label">
					                    <input type="checkbox" class="form-check-input" id="Religions_buddhism" name="Religions_buddhism" value="buddhism">Buddhism
					                </label>
					            </div>
					        </div>
			            	<div class="col">
					            <div class="form-check">
					                <label class="form-check-label">
					                    <input type="checkbox" class="form-check-input" id="Religions_hindu" name="Religions_hindu" value="hindu">Hindu
					                </label>
					            </div>
					        </div> 
				        </div>
				        <div class="row">
					        <div class="col">
					            <div class="form-check">
					                <label class="form-check-label">
					                    <input type="checkbox" class="form-check-input" id="Religions_sikhism" name="Religions_sikhism" value="sikhism">Sikhism
					                </label>
					            </div>
					        </div>
					        <div class="col">
					            <div class="form-check">
					                <label class="form-check-label">
					                    <input type="checkbox" class="form-check-input" id="Religions_islam" name="Religions_islam" value="islam">Islam
					                </label>
					            </div>
				        	</div>
					       	<div class="col">
					            <div class="form-check">
					                <label class="form-check-label">
					                    <input type="checkbox" class="form-check-input" id="Religions_christian" name="Religions_christian" value="christian">christian
					                </label>
					            </div>
					        </div>
			            </div> 
		            </div>
		            <div class="form-group">
		                <label for="pickup">Pick up location</label>
		                <input type="text" class="form-control shadow round10" name="pickup" placeholder="Enter pick up location"/>
		            </div>
		            <div class="form-group">
		                <label for="drop">Drop location</label>
		                <input type="text" class="form-control shadow round10" name="drop" placeholder="Enter drop location"/>
		            </div>
		            <div class="form-group">
		                <label for="detail">Other Details</label>
		                <textarea class="form-control  shadow round10"  rows="10" name="detail"></textarea>
		            </div>
		            <div class="text-center">
		            	<input type="submit" class="bttn bttn-float bttn-md round20 color1 shadow" name="submit"/>
		            </div>
		        </form>
		    </div>
    	</div>
	</div>
@endsection