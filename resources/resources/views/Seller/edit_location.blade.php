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
                <label for="location_name">Enter location name</label>
                <input type="text" class="form-control round10 shadow" name="location_name" placeholder="Enter location name" value="{{ $location->name }}" required/>
            </div>
            <!--Checkbox  start-->
            <p>Location served areas :-</p>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="Location_type_Forest" value="Forest" {{ in_array("Forest", $location_type) ? 'checked' : '' }}>Forest
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"  name="Location_type_Beach" value="Beach" {{ in_array("Beach", $location_type) ? 'checked' : '' }}>Beach
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"  name="Location_type_Desert" value="Desert" {{ in_array("Desert", $location_type) ? 'checked' : '' }}>Desert
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="Location_type_hill_Station" value="Hill station" {{ in_array("Hill station", $location_type) ? 'checked' : '' }}>Hill station
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="Location_type_water_activities" value="water activities" {{ in_array("water activities", $location_type) ? 'checked' : '' }}>Water activities
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="city" onchange="call()"  name="Location_type_city_tour" value="city tour" {{ in_array("city tour", $location_type) ? 'checked' : '' }}>City tour
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-check">
                        <lable class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="Location_type_religious"
                            value="religious" {{ in_array("religious", $location_type) ? 'checked' : '' }}>Religious
                        </lable>
                    </div>
                </div>
                <div class="col-sm-4"> 
                    <div class="form-check">
                        <lable class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="Location_type_heritage"
                            value="heritage" {{ in_array("heritage", $location_type) ? 'checked' : '' }}>Heritage
                        </lable>
                    </div>
                </div>
                <div class="col-sm-4"> 
                    <div class="form-check">
                        <lable class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="Location_type_Picnic_spot"
                            value="Picnic spot" {{ in_array("Picnic spot", $location_type) ? 'checked' : '' }}>Picnic spot
                        </lable>
                    </div>
                </div>
            </div> 
            <!--Checkbox  close-->
            <div class="form-group mt-3 {{ in_array('city tour', $location_type) ? '' : 'hides' }}" id="nameForCity">
                <lable for="select-city">Enter city name: </lable>
                <input type="text" name="cityName" id="city_tour_city_name"  placeholder="Enter city name" class="form-control hide round10 shadow" value="{{ $location->name_of_city }}"/>
            </div>
            <div class="form-group">
                <label for="select_capacity">Enter maximum number of peoples to visit</label>
                <input type="number" min="1" class="form-control round10 shadow" name="number_of_limit" placeholder="Enter number of people" value="{{ $location->total_member_size }}" required/>
            </div>
            <div class="form-group">
                <label for="select_capacity">Enter min number of peoples for family booking</label>
                <input type="number" min="1" class="form-control round10 shadow" name="min_number_of_family" placeholder="Enter min number of family" value="{{ $location->min_family_member }}" required/>
            </div>
            <div class="form-group">
                <label for="file">Select File</label>
                @if($location->location_images)
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="{{ asset('storage/'.$location->location_images) }}" class="img-fluid rounded" alt="Cinque Terre">
                        </div>
                    </div>
                @endif
                <input type="file" class="form-control round10 shadow" id="loc_pics"  name="loc_pics">
            </div>
            <div id="uploaded__photos__wrapper"></div>
            <div class="text-center">
            	<input type="submit" class="bttn bttn-float bttn-md round20 color1 shadow" value="submit" name="submit">
            </div>
        </form>
	</div>
@endsection

@push('plugin')
<script src="{{ asset('script/seller/location.js') }}"></script>
@endpush

<script>
        function call(){
            let cityName = document.getElementById('nameForCity');
            let city = document.getElementById('city').checked;
            
            if(city){
                cityName.style.display = 'block';
            }
            else{
                cityName.style.display='none';
            }
        }
</script>