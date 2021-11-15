@extends('Seller.layouts.app')
@section('data')
<div class="container border p-3 bg-light shadow round10">
    @if($error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endif
    @if($message)
        <div class="alert alert-danger">{{ $message }}</div>
    @endif
	<form method="post" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label for="location">Select Location</label>
			<select name="location_name" required class="form-control round10 shadow">
                <option>Please Select Location</option>
                @foreach($locations as $location)
                    <option value="{{ $location -> id }}*{{ $location -> name }}" {{ $midtrip->location_id == $location->id ? 'selected' : '' }}>{{ $location -> name }}</option>
                @endforeach
            </select>
		</div>
		<div class="form-group">
			<label> Enter midtrip name :-</label>
			<input type="text" class="form-control shadow round10" name="midtrip_name" placeholder="Enter midtrip name" value="{{ $midtrip->name }}" required/>
		</div>
		
		<div class="form-group">
			<label> Enter midtrip description :-</label>
			<textarea class="form-control shadow round10" row="05" name="midtrip_des">{{ $midtrip->description }}</textarea>
		</div>
		<div class="form-group">
            <label>Uploaded Images :-</label>
            @if($midtrip->images)
                <div class="row">
                    <div class="col-sm-3">
                        <img src="{{ asset('storage/'.$midtrip->images) }}" class="img-fluid rounded" alt="Cinque Terre">
                    </div>
                </div>
            @endif
        </div>
		<div class="form-group">
			<input type="file" name="midtrip_pic" class="form-control shadow round10" />
		</div>
		<div id="cont">
		</div>
		
		<div class="text-center mt-4">
			<input class="bttn bttn-float bttn-md round20 color1 shadow" type="submit" name="submit"/>
		</div>
	</form>
</div>
@endsection
