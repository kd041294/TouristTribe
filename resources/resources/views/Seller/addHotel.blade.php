@extends('Seller.layouts.app')
@section('data')
<div class="container border p-3 bg-light shadow round10">
    <form action="hotel_post" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="hotel_name">Hotel Name <span class="required">*</span></label>
            <input type="text" name="hotel_name" class="form-control round10 shadow" placeholder="Hotel Name" autofocus required>
        </div>
        <div class="form-group">
            <label for="location_name">Location Name <span class="required">*</span></label>
            <select name="location_name" class="form-control round10 shadow">
                <option>Please Select Locations</option>
                @foreach($location as $locations)
                    <option value="{{ $locations -> id }}*{{ $locations -> name }}">{{ $locations -> name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="hotel_rating">Hotel Rating <span class="required">*</span></label>
            <fieldset class="rating border round10 shadow" style="background-color: white; width: 100%">
                <div class="pt-2">
                    <input type="radio" id="star5" name="hotel_rating" value="5" style="width: 5%" />
                    <label for="star5" title="Rocks!">5 stars</label>
                    <input type="radio" id="star4" name="hotel_rating" value="4" style="width: 5%"/>
                    <label for="star4" title="Pretty good">4 stars</label>
                    <input type="radio" id="star3" name="hotel_rating" value="3" style="width: 5%"/>
                    <label for="star3" title="Meh">3 stars</label>
                    <input type="radio" id="star2" name="hotel_rating" value="2" style="width: 5%"/>
                    <label for="star2" title="Kinda bad">2 stars</label>
                    <input type="radio" id="star1" name="hotel_rating" value="1" style="width: 5%"/>
                    <label for="star1" title="Sucks big time">1 star</label>
                </div>
            </fieldset>
        </div>
        <script>
    function bed1(checkbox) {
        if(checkbox.checked == true){
            document.getElementById("room_cost_single").style.display='block';
        }else{
            document.getElementById("room_cost_single").style.display='none';
        }
    }
    function bed2(checkbox) {
        if(checkbox.checked == true){
            document.getElementById("room_cost_double").style.display='block';
        }else{
            document.getElementById("room_cost_double").style.display='none';
        }
    }
    function bed3(checkbox) {
        if(checkbox.checked == true){
            document.getElementById("room_cost_triple").style.display='block';
        }else{
            document.getElementById("room_cost_triple").style.display='none';
        }
    }
</script>
        
        <!--align-items-center-->
        <div class="form-group pl-3">
            <label for="hotel_room">Room Type<span class="required">*</span></label>
            <div class="row p-3 rating border round10 shadow" style="background-color: white; width: 100%">
                <div class="col-sm-4">
                    <label class="form-check-label">
                    <input type="checkbox" onchange='bed1(this);' class="form-check-input" name="bed_type1" value="Single">Single Bed
                    </label>
                </div>
                <div class="col-sm-4">
                    <input type="checkbox" onchange='bed2(this);' class="form-check-input" name="bed_type2" value="Double"><span>Double Bed</span>
                </div>
                <div class="col-sm-4">
                    <input type="checkbox" onchange='bed3(this);' class="form-check-input" name="bed_type3" value="Triple"><span>Triple Bed</span>
                </div>
            </div>
        </div>
        <div class="form-group pl-3">
            <label for="hotel_type">Hotel Type <span class="required">*</span></label>
            <div class="row pl-4 border round10 shadow" style="background-color: white; width: 100%">
                <div class="col">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="hotel_type" value="AC">
                        <span>AC</span>
                    </label>
                </div>
                <div class="col">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="hotel_type" value="NAC">
                        <span>Non AC</span>
                    </label> 
                </div>
            </div>
        </div>
        <div class="form-group hides" id="room_cost_single">
            <label for="room_cost">Cost of Single Bed <i class="fa fa-info-circle" data-toggle="tooltip" title="Prices are end-to-end encrypted. No one, outside of this account not even TouristTribe can read."></i></label>
            <input type="number" min="0" name="room_cost_single"  class="form-control round10 shadow" placeholder="Per room & per night">
        </div>
        <div class="form-group hides" id="room_cost_double">
            <label for="room_cost">Cost of Double Bed <i class="fa fa-info-circle" data-toggle="tooltip" title="Prices are end-to-end encrypted. No one, outside of this account not even TouristTribe can read."></i></label>
            <input type="number" min="0" name="room_cost_double"  class="form-control round10 shadow" placeholder="Per room & per night">
        </div>
        <div class="form-group hides" id="room_cost_triple">
            <label for="room_cost">Cost of Triple Bed <i class="fa fa-info-circle" data-toggle="tooltip" title="Prices are end-to-end encrypted. No one, outside of this account not even TouristTribe can read."></i></label>
            <input type="number" min="0" name="room_cost_triple"  class="form-control round10 shadow" placeholder="Per room & per night">
        </div>
        <div class="form-group">
            <label for="hotel_pics">Upload Hotel Photos</label>
            <input type="file" name="hotel_pics[]" id="hotel_pics" class="form-control round10 shadow" multiple>
        </div>
        <div id="uploaded__photos__wrapper"></div>
        <div class="text-center">
            <button class="bttn bttn-float bttn-md round20 color1 shadow" type="submit" name="submit">Submit</button>
        </div>
    </form>
</div>
@endsection
