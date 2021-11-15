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
            <!--Checkbox start-->
            <div class="form-check-inline"> 
                <input type="checkbox" onchange='breakfast(this);' class="form-check-input"  name="meal_breakfast" id="type_breakfast" value="Breakfast" {{ $meal->breakfast_details ? 'checked' : '' }}>
                <label class="form-check-label" for="check1">Breakfast</label>

            </div>
            <div class="form-check-inline">
                 <label class="form-check-label" for="check2">
                <input type="checkbox" onchange='lunch(this);' class="form-check-input" name="meal_lunch" id="type_lunch"  value="lunch" {{ $meal->lunch_details ? 'checked' : '' }}>
                <label class="form-check-label" for="check1">Lunch</label>
            </div>
            <div class="form-check-inline">
                
                    <input type="checkbox" onchange='evening(this);'  class="form-check-input" name="meal_Evening_tea"
                    value="Evening_tea" id="type_evening_tea"  {{ $meal->evening_tea_details ? 'checked' : '' }}>
                    <label class="form-check-label" for="check2">Evening tea</label>
            </div>
            <div class="form-check-inline">
                    <input type="checkbox" onchange='dinner(this);'  class="form-check-input" id="type_dinner" name="meal_Dinner"   value="Dinner" {{ $meal->dinner_details ? 'checked' : '' }}>
                    <label class="form-check-label" for="check2">Dinner</label>
            </div>
            <!--Checkbok close-->
            <br><br>
            <div class="form-group">
                <label for="location_name">Location Name <span class="required">*</span></label>
                <select name="location_name" class="form-control round10 shadow" required   >
                    <option>Please Select Locations</option>
                    @foreach($locations as $location)
                        <option value="{{ $location -> id }}*{{ $location -> name }}" {{ $meal->location_id == $location->id ? 'selected' : '' }}>{{ $location -> name }}</option>
                    @endforeach
                </select>
            </div>
            <!--detail start-->
            <!--breakfast data start-->
            <div class="form-group {{ $meal->breakfast_details ? '' : 'hides' }}" id="breakfast_detail">
                <label for="breakfast">BreakFast detail</label>
                <input type="text" class="form-control round10 shadow" name="detail_breakfast" id="food_detail_breakfast" placeholder="Enter detail of breakfast" value="{{ $meal->breakfast_details }}"/><br>
            </div>
            <!--breakfast data close--> 
            <!--lunch data start-->
            <div class="form-group {{ $meal->lunch_details ? '' : 'hides' }}" id="lunch_detail">
                <label for="Lunch">Lunch detail</label>
                <input type="text" class="form-control round10 shadow" name="detail_lunch" id="food_detail_lunch" placeholder="Enter detail of lunch" value="{{ $meal->lunch_details }}"/><br>
            </div>
            <!--lunch data close-->
            <!--evening data start-->
            <div class="form-group {{ $meal->evening_tea_details ? '' : 'hides' }}" id="evening_detail">
                <label for=Evening>Evening detail</label>
                <input type="text" class="form-control round10 shadow" name="detail_Evening_tea" id="food_detail_evening_tea" placeholder="Enter detail of Evening_tea" value=" {{ $meal->evening_tea_details }}"/><br>
            </div>
            <!--evening data close-->
            <!--Dinner data start-->
            <div class="form-group {{ $meal->dinner_details ? '' : 'hides' }}" id="dinner_detail">
                <label for="Dinner">Dinner detail</label>
                <input type="text" class="form-control round10 shadow" name="detail_Dinner" id="food_detail_dinner" placeholder="Enter detail of Dinner" value=" {{ $meal->dinner_details }}"/><br>
            </div>
            <!--Dinner data close-->
            <!--detail close-->
            <div class="form-group">
                <label for="money">Enter price per head</label>
                <input type="number" class="form-control round10 shadow" name="money" placeholder="Enter per head money" value="{{ $meal->per_head_cost }}" required/>
            </div>
            <div class="text-center">
            	<input type="submit" class="bttn bttn-float bttn-md round20 color1 shadow" name="submit"/>
            </div>
        </form>
	</div>
@endsection

@push('plugin')
<script src="{{ asset('script/seller/meal.js') }}"></script>
@endpush

<script>
        function breakfast(checkbox) {
            if(checkbox.checked == true){
                document.getElementById("breakfast_detail").style.display='block';
                // document.getElementById("breakfast_money").style.display='block';
            }else{
                document.getElementById("breakfast_detail").style.display='none';
                // document.getElementById("breakfast_money").style.display='none';
            }
        }
        function lunch(checkbox) {
            if(checkbox.checked == true){
                document.getElementById("lunch_detail").style.display='block';
                // document.getElementById("lunch_money").style.display='block';
            }else{
                document.getElementById("lunch_detail").style.display='none';
                // document.getElementById("lunch_money").style.display='none';
            }
        }
        function evening(checkbox) {
            if(checkbox.checked == true){
                document.getElementById("evening_detail").style.display='block';
                // document.getElementById("evening_money").style.display='block';
            }else{
                document.getElementById("evening_detail").style.display='none';
                // document.getElementById("evening_money").style.display='none';
            }
        }
        function dinner(checkbox) {
            if(checkbox.checked == true){
                document.getElementById("dinner_detail").style.display='block';
                // document.getElementById("dinner_money").style.display='block';
            }else{
                document.getElementById("dinner_detail").style.display='none';
                // document.getElementById("dinner_money").style.display='none';
            }
        }
    </script>