@extends('Seller.layouts.app')


@section('data')
	<div class="container border p-3 bg-light shadow round10">
		<form method="post" action="create-trip-again">
            @csrf
            <div class="form-group">
                <label for="day">Enter number of day</label>
                <input type="number" class="form-control shadow round10" onchange="myFunction()" min="1"  name="number_of_day" id="day" placeholder="enter number of day"/><br>
            </div>
            <div class="form-group">
                <label for="night">Enter number of night</label>
                <input type="number" class="form-control shadow round10" name="number_of_night" readonly id="night" placeholder="enter number of night"/><br>
            </div>
            <div class="form-group">
                <label for="location">Select Location</label>
                <select name="location_name" class="form-control round10 shadow">
                <option>Please Select Locations</option>
                    @foreach($location as $locations)
                        <option value="{{ $locations -> id }}*{{ $locations -> name }}">{{ $locations -> name }}</option>
                    @endforeach
            </select>
            </div>
            <div class="text-center">
            	<input type="submit" class="bttn bttn-float bttn-md round20 color1 shadow" name="submit"/>
            </div>
        </form>
	</div>
@endsection
<script>
        function myFunction(){
            var day = document.getElementById('day').value;
            var night;
            night = day - 1;
            document.getElementById('night').setAttribute("value", night); 
        }            
</script>