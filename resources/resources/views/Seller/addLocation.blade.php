@extends('Seller.layouts.app')

@section('data')
	<div class="container border p-3 bg-light shadow round10">
		<form method="post" action="location_post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="location_name">Enter location name</label>
                <input type="text" class="form-control round10 shadow" name="location_name" placeholder="Enter location name"/>
            </div>
            <!--Checkbox  start-->
            <p>Location served areas :-</p>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="Location_type_Forest" value="Forest">Forest
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"  name="Location_type_Beach" value="Beach">Beach
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"  name="Location_type_Desert" value="Desert">Desert
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="Location_type_hill_Station" value="Hill station">Hill station
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="Location_type_water_activities" value="Water activities">Water activities
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="city" onchange="call()"  name="Location_type_city_tour" value="City tour">City tour
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-check">
                        <lable class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="Location_type_religious"
                            value="Religious">Religious
                        </lable>
                    </div>
                </div>
                <div class="col-sm-4"> 
                    <div class="form-check">
                        <lable class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="Location_type_heritage"
                            value="Heritage">Heritage
                        </lable>
                    </div>
                </div>
                <div class="col-sm-4"> 
                    <div class="form-check">
                        <lable class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="Location_type_Picnic_spot"
                            value="Picnic spot">Picnic spot
                        </lable>
                    </div>
                </div>
            </div> 
            <!--Checkbox  close-->
            <div class="form-group mt-3 hides" id="nameForCity">
                <lable for="select-city">Enter city name: </lable>
                <input type="text" name="cityName"  placeholder="Enter city name" class="form-control hide round10 shadow"/>
            </div>
            <div class="form-group">
                <label for="select_capacity">Enter maximum number of peoples to visit</label>
                <input type="number" min="1" class="form-control round10 shadow" name="number_of_limit" placeholder="Enter number of people"/>
            </div>
            <div class="form-group">
                <label for="select_capacity">Enter min number of peoples for family booking</label>
                <input type="number" min="1" class="form-control round10 shadow" name="min_number_of_family" placeholder="Enter min number of family"/>
            </div>
            <div class="form-group">
                <label for="file">Select File</label>
                <input type="file" class="form-control round10 shadow" id="loc_pics"  name="loc_pics">
            </div>
            <div id="uploaded__photos__wrapper"></div>
            <div class="text-center">
            	<input type="submit" class="bttn bttn-float bttn-md round20 color1 shadow" value="submit" name="submit">
            </div>
        </form>
	</div>
@endsection
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