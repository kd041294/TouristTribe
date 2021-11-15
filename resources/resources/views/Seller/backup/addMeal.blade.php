@extends('Seller.layouts.app')

@section('data')
	<div class="container border p-3 bg-light shadow round10">
		<form method="post" action="meal_post" enctype="multipart/form-data">
            @csrf
            <!--Checkbox start-->
            <div class="form-check-inline"> 
                <label class="form-check-label" for="check1">
                    <input type="checkbox" onchange='breakfast(this);' class="form-check-input" name="meal_breakfast" value="Breakfast">Breakfast<br>
                </label>
            </div>
            <div class="form-check-inline">
                 <label class="form-check-label" for="check2">
                <input type="checkbox" onchange='lunch(this);' class="form-check-input" name="meal_lunch" value="lunch">Lunch<br>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label" for="check2">
                    <input type="checkbox" onchange='evening(this);'  class="form-check-input" name="meal_Evening_tea" value="Evening_tea">Evening tea<br>
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label" for="check2">
                    <input type="checkbox" onchange='dinner(this);'  class="form-check-input" name="meal_Dinner" value="Dinner">Dinner<br>
                </label>
            </div>
            <!--Checkbok close-->
            <br><br>
            <div class="form-group">
                <label for="location_name">Location Name <span class="required">*</span></label>
                <select name="location_name" class="form-control round10 shadow">
                    <option>Please Select Locations</option>
                    @foreach($location as $locations)
                        <option value="{{ $locations -> id }}*{{ $locations -> name }}">{{ $locations -> name }}</option>
                    @endforeach
                </select>
            </div>
            <!--detail start-->
            <!--breakfast data start-->
            <div class="form-group hides" id="breakfast_detail">
                <label for="breakfast">BreakFast detail</label>
                    <input type="text" class="form-control round10 shadow" name="detail_breakfast" placeholder="Enter detail of breakfast"/><br>
            </div>
            <!--breakfast data close-->
            <!--lunch data start-->
            <div class="form-group hides" id="lunch_detail">
                <label for="Lunch">Lunch detail</label>
                    <input type="text" class="form-control round10 shadow" name="detail_lunch" placeholder="Enter detail of lunch"/><br>
            </div>
            <!--lunch data close-->
            <!--evening data start-->
            <div class="form-group hides" id="evening_detail">
                <label for=Evening>Evening detail</label>
                    <input type="text" class="form-control round10 shadow" name="detail_Evening_tea" placeholder="Enter detail of Evening_tea"/><br>
            </div>
            <!--evening data close-->
            <!--Dinner data start-->
            <div class="form-group hides" id="dinner_detail">
                <label for="Dinner">Dinner detail</label>
                    <input type="text" class="form-control round10 shadow" name="detail_Dinner" placeholder="Enter detail of Dinner"/><br>
            </div>
            <!--Dinner data close-->
            <!--detail close-->
            <div class="form-group">
                <label for="money">Enter price per head</label>
                <input type="number" class="form-control round10 shadow" name="money" placeholder="Enter per head money"/>
            </div>
            <div class="text-center">
            	<input type="submit" class="bttn bttn-float bttn-md round20 color1 shadow" name="submit"/>
            </div>
        </form>
	</div>
@endsection
<script>
        function breakfast(checkbox) {
            if(checkbox.checked == true){
                document.getElementById("breakfast_detail").style.display='block';
                document.getElementById("breakfast_money").style.display='block';
            }else{
                document.getElementById("breakfast_detail").style.display='none';
                document.getElementById("breakfast_money").style.display='none';
            }
        }
        function lunch(checkbox) {
            if(checkbox.checked == true){
                document.getElementById("lunch_detail").style.display='block';
                document.getElementById("lunch_money").style.display='block';
            }else{
                document.getElementById("lunch_detail").style.display='none';
                document.getElementById("lunch_money").style.display='none';
            }
        }
        function evening(checkbox) {
            if(checkbox.checked == true){
                document.getElementById("evening_detail").style.display='block';
                document.getElementById("evening_money").style.display='block';
            }else{
                document.getElementById("evening_detail").style.display='none';
                document.getElementById("evening_money").style.display='none';
            }
        }
        function dinner(checkbox) {
            if(checkbox.checked == true){
                document.getElementById("dinner_detail").style.display='block';
                document.getElementById("dinner_money").style.display='block';
            }else{
                document.getElementById("dinner_detail").style.display='none';
                document.getElementById("dinner_money").style.display='none';
            }
        }
    </script>