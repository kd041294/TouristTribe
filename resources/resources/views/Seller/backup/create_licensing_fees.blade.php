@extends('Seller.layouts.app')

@section('data')
	<div class="container border p-3 bg-light shadow round10">
		<form method="post">
            @csrf
            <div class="form-group">
                <label for="location_name">Location Name <span class="required">*</span></label>
                <select name="location_name" class="form-control round10 shadow" required>
                    <option>Please Select Locations</option>
                    @foreach($location as $locations)
                        <option value="{{ $locations -> id }}*{{ $locations -> name }}">{{ $locations -> name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="money">Enter price per head</label>
                <input type="number" class="form-control round10 shadow" name="per_head_cost" placeholder="Enter per head money" required/>
            </div>
            <div class="form-group">
                <label for="money">Enter License Fees Details</label>
                <input type="text" class="form-control round10 shadow" name="license_fees_details" placeholder="Enter License Fees Details"/>
            </div>
            <div class="text-center">
            	<input type="submit" class="bttn bttn-float bttn-md round20 color1 shadow" name="submit"/>
            </div>
        </form>
	</div>
@endsection
