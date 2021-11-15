@extends('Seller.layouts.app')


@section('data')
	<div class="container border p-3 bg-light shadow round10">
		<form method="post" action="transfer_post">
			@csrf
            <div class="form-group">
                <label for="transfer_name">Vehicle name:</label>
                <input type="text" class="form-control round10 shadow" name="transfer_name" placeholder="enter name of Transfer"/>
            </div>
            <div class="form-group">
	            <label for="Type">Vehicle Type: </label><br>
	            <div class="p-2">
		            <div class="row pl-4 pt-2 border round10 shadow" style="background-color: white; width: 100%">
			            <div class="form-check-inline">
			                <label class="form-check-label" for="check1">
			                    <input type="radio" name="transfer_type" value="AC" checked> AC
			                </label>
			            </div>
			            <div class="form-check-inline">
			                <label class="form-check-label" for="check2">
			                    <input type="radio" name="transfer_type" value="Non Ac"> Non Ac
			                </label>
			            </div>
		        	</div>
	        	</div>
        	</div>
            <div class="form-group">
                <label for="person_number">Vehicle Capacity:</label>
                <input type="number" class="form-control round10 shadow" name="person_number" placeholder="enter number of person"/>
            </div>
            <div class="form-group">
                <label for="Total_cost">Total cost: <i class="fa fa-info-circle" data-toggle="tooltip" title="Prices are end-to-end encrypted. No one, outside of this account not even TouristTribe can read."></i></label>
                <input type="number" class="form-control round10 shadow" name="total_cost" placeholder="Per vehicle"/><br>
            </div>
            <div class="text-center">
            	<input type="submit" name="submit" class="bttn bttn-float bttn-md round20 color1 shadow"/>
            </div>
        </form>
	</div>
@endsection