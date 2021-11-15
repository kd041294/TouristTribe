@extends('Seller.layouts.app')

@section('data')
	<div class="container border p-3 bg-light shadow round10">
        @if($error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endif
        @if($message)
            <div class="alert alert-danger">{{ $message }}</div>
        @endif
		<form method="post">
            @csrf
            <div class="form-group">
                <label>Enter trip name</label>
                <input type="text" name="trip_name" placeholder="Enter trip name" class="form-control shadow round10" value="{{ $trip->trip_name }}" required>
            </div>
            <div class="form-group">
                <label>Pick up location</label>
                <input type="text" name="pickup" placeholder="Enter pick up location" class="form-control shadow round10" value="{{ $trip->pickup_details }}" required>
            </div>
            <div class="form-group">
                <label>Drop Location</label>
                <input type="text" name="drop" placeholder="Enter drop location" class="form-control shadow round10" value="{{ $trip->drop_details }}" required>
            </div>
            <div class="form-group">
                <label for="detail">Other Detail</label>
                <textarea class="form-control  shadow round10"  rows="10" name="detail">{{ $trip->other_details }}</textarea>
            </div>
            
            <div class="text-center">
            	<input type="submit" class="bttn bttn-float bttn-md round20 color1 shadow" name="submit"/>
            </div>
        </form>
	</div>
@endsection
