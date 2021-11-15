

@section('data')
<div class="container p-3">
    
  <div class="card shadow round10">
    
    <div class="card-header">
    <h1 style="font-size:25px" class="text-center">{{ $data -> trip_name }}</h1>
    </div>
    @if ($error)
			<div class="alert alert-danger">{{ $error }}</div>
    @endif
    @if ($message)
      <div class="alert alert-success">{{ $message }}</div>
    @endif
    
    
    <!-- Tab panes -->
    <div class="tab-content">
      <div id="home" class="container tab-pane active"><br>
        <h5>Loction Name : <span class="badge badge-primary" style="font-size: 100%">{{ $data -> location_name }}</span></h5>
        <hr />
        <h5>Gender : 
          @if($data -> allGender)
            <span class="badge badge-primary" style="font-size: 100%">All Genders</span>
          @endif
          @if($data -> onlyMens)
            <span class="badge badge-primary" style="font-size: 100%">&nbsp;Only men</span>
          @endif
          @if($data -> onlyWomens)
            <span class="badge badge-primary" style="font-size: 100%">&nbsp;Only Women</span>
          @endif
        </h5>
        <hr />
        <h5>
          Cast : 
          @if($data -> allCast)
            &nbsp;<span class="badge badge-primary" style="font-size: 100%">All Cast</span>
          @endif
          @if($data -> buddhismCast)
            &nbsp;<span class="badge badge-primary" style="font-size: 100%">Buddhism</span>
          @endif
          @if($data -> buddhismCast)
            &nbsp;<span class="badge badge-primary" style="font-size: 100%">Hindu</span>
          @endif
          @if($data -> islamCast)
            &nbsp;<span class="badge badge-primary" style="font-size: 100%">Islam</span>
          @endif
          @if($data -> christianCast)
            &nbsp;<span class="badge badge-primary" style="font-size: 100%">Christian</span>
          @endif
        </h5>
        <hr />
        <h5>
          Price : <span class="badge badge-primary" style="font-size: 100%"><?php $formatter = new NumberFormatter('en_IN',  NumberFormatter::CURRENCY);
                                echo ' ', $formatter->formatCurrency(base64_decode($trip_price), 'INR'), PHP_EOL; ?></span>
        </h5>
        <hr />
        <h5>
          Details :- 
        </h5>
        <p>Number Of Person : <span class="badge badge-primary" style="font-size: 100%"> {{ $nop }} </span></p>
        <p>Transfer: <span class="badge badge-primary" style="font-size: 100%">{{ $data -> vehicalName }}    </span></p>             
        <p>Number Of Room : <span class="badge badge-primary" style="font-size: 100%"> {{ $nor }} </span></p>
        <p>Bed Type : 
          @if($bt == 1)
            <span class="badge badge-primary" style="font-size: 100%"> Single </span>
          @endif
          @if($bt == 2)
            <span class="badge badge-primary" style="font-size: 100%"> Double </span>
          @endif
          @if($bt == 3)
            <span class="badge badge-primary"style="font-size: 100%"> Triple </span>
          @endif
        </p><hr />
        <h5>Trip Start Date : <span class="badge badge-primary" style="font-size: 100%"> {{ $trip_date }} </span></h5>
        <hr />
        <h5> Pickup Point : </h5>
        <p>{{ $data -> pickup_details }}</p>
        <hr />
        <h5>Drop Point : </h5>
        <p>{{ $data -> drop_details }}</p>
        <hr />
        <h5>Other Details : </h5>
        <div class="formatedtxt"><p>{{ $data -> other_details }}</p></div>
      </div>
      
    
    <div class="card-footer text-center">
      <?php 
      $for = "general";
      $location = "payment/$data->id?payment=$trip_price&nop=$nop&nor=$nor&bt=$bt&nod=$nod&trip_date=$trip_date&bookingfor=$for&coupon_id=$coupon_id" 
      ?>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_coupon_modal">Add Coupon
      </button>
      <a href={{ secure_asset("$location") }} class="btn btn-primary">Buy Now</a>
      </div>
       <div class="row"> 
         <div class="col center"> 
          <center><a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-share-square-o"></i></a></center>
          
       </div> 
    </div>
  </div>
</div>


<div class="container p-3">
    
  <div class="card shadow round10">
    
    <div class="card-header">
    <h1 style="font-size:25px" class="text-center"> its ok</h1>
    </div></div></div>




@endsection