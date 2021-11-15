@extends('affiliate_marketing.layout.app')

@section('menu')
	<div id="main" >
	  <div class="card border shadow round10 p-3">
	  	<span>
	  		<img src="{{ asset('storage/public/YyHZ5a7mS8a2OUSHmWOqPp2vpTekFTx1xHPAQgp1.jpeg') }}" class="rounded-circle" width="25px" height="25px">
			TouristTribe Affiliate Marketing
		</span>
	    <span class="right-corner color border round10 bg-light">
	      <a href="{{ route('affiliate_marketing_logout') }}">Logout</a>
	    </span>
	  </div>
	</div>
@endsection

@section('data')
<div class="container mt-5">
	<ul class="nav nav-tabs" role="tablist">
    	<li class="nav-item">
      		<a class="nav-link active" data-toggle="tab" href="#home">Home</a>
    	</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#product_linking">Product Linking</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#widges">Widges</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#reports">Reports</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#help">Help</a>
		</li>
 	</ul><hr>

  <!-- Tab panes -->
	<div class="tab-content">
		<div id="home" class="container tab-pane active"><br>
			
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<button class="btn btn-outline-info" type="button" data-toggle="modal" data-target="#BookMyTripModal">PLAN MY TRIP</button>
				</div>
					<input type="text" class="form-control" placeholder="Search Any Trips">
					<div class="input-group-append">
						<button type="button" class="btn btn-outline-info">SEARCH</button>
					</div>
			</div>

			<div class="mt-4 mb-4 bg-light p-2">
				<div class="row">
					@if(count($data))
					@foreach($data as $key => $value)
					<div class="card_new col-sm-3">
						<div>
						<img class="card-img-top mt-2" width="300px" height="150px" src="{{ asset('storage/'.$midtrip[$key][0]->images) }}">
						<h5 class="mt-2 ">{{ $data[$key]->trip_name }}</h5>
						<span class="badge badge-pill badge-primary">{{ $data[$key]->no_of_days." Days" }}</span>
						<span class="badge badge-pill badge-primary">{{ $data[$key]->no_of_nights." Nights" }}</span>
						<p class="mt-2 ">No Of Bookings : <span class="badge badge-pill badge-primary">0</span></p>
						<p class="mt-2 ">Total Limit : <span class="badge badge-pill badge-primary">{{ $data[$key]->total_member_size }}</span></p>
						<p class="mt-2 ">Starting Date : <span class="badge badge-pill badge-primary">{{ date('d M Y',  strtotime($data[$key]->starting_date)) }}</span></p>
						<p class="mt-2 ">Prices : <span class="badge badge-pill badge-primary">{{ (int)$tripPrices[$key]['total_price'] }} -/</span></p>
						
						<button type="button" class="btn btn-outline-info btn-block get_location_class" data-toggle="modal" data-location="{{ $data[$key]->location_name }}" data-target="#GetLinkModal">GET LINK</button>				
						</div>
					</div>
					@endforeach
					@else
						<p>No Trips Available</p>
					@endif
				</div>
			</div>
			
			

		</div>
		<div id="product_linking" class="container tab-pane fade"><br>
			<h3>Product Linking</h3>
			<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		</div>
		<div id="widges" class="container tab-pane fade"><br>
			<h3>Widges</h3>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
		</div>
		<div id="reports" class="container tab-pane fade"><br>
			<h3>Reports</h3>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
		</div>
		<div id="help" class="container tab-pane fade"><br>
			<h3>Help</h3>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
		</div>

	</div>
</div>

<div class="modal" id="BookMyTripModal">
  	<div class="modal-dialog">
    	<div class="modal-content">

      		<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">PLAN MY TRIP</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form method="get">
					<div class="form-group">
						<label>Select Date</label>
						<input type="date" class="form-control" name="trip_date" value="{{ $trip_date ?? '' }}" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+3 Months')) }}">
					</div>
					<div class="form-group">
						<label>Select No. Of Days</label>
						<input type="number" class="form-control" name="nod" placeholder="Enter Number Of Days" value="{{ $nod }}">
					</div>
					<div class="form-group">
						<label> No. Of Person</label>
						<input type="number" class="form-control" name="nop" placeholder="Enter No Of Person" value="{{ $nop }}">
					</div>
					<div class="form-group">
						<label>No. Of Room</label>
						<input type="number" class="form-control" name="nor" placeholder="Enter No Of Room" value="{{ $nor }}">
					</div>
					<div class="form-group">
						<label>Bed Type</label>
						<select name="bt" class="form-control">

						@if($bt == 1)
							<option value="1" selected>Single Bed</option>
						@else
							<option value="1">Single Bed</option>
						@endif

						@if($bt == 2)
							<option value="2" selected>Double Bed</option>
						@else
							<option value="2">Double Bed</option>
						@endif

						@if($bt == 3)
							<option value="3" selected>Triple Bed</option>
						@else
							<option value="3">Triple Bed</option>
						@endif
						</select>
					</div><hr>
					<button type="submit" class="btn btn-outline-info btn-block">Submit</button>
				</form>
			</div>

    	</div>
  	</div>
</div>

<div class="modal" id="GetLinkModal">
  	<div class="modal-dialog">
    	<div class="modal-content">

      		<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Get Link</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<a id="getLinkLocation" href="" target="_blank"></a>
			</div>

    	</div>
  	</div>
</div>
@endsection

@push('plugin')
<script src="{{ asset('script/affiliate_marketing/get_link.js') }}"></script>
@endpush