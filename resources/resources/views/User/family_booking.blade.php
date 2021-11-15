@extends('User.layouts.family_bookingPage')
@section('menu')
<div id="main" >
  <div class="card border shadow round10 p-4">
    
       @if(session('sessionId'))
       <span style="margin-top: -20px" class="right-corner color border round10 p-1 bg-light">
          <a href="{{ route('logout') }}">Logout</a></span>
          <span style="margin-top: -20px" class="left-corner color border round10 p-1 bg-light">
	  		<img src="{{ secure_asset('storage/public/YyHZ5a7mS8a2OUSHmWOqPp2vpTekFTx1xHPAQgp1.jpeg') }}" alt="TouristTribe Logo" class="rounded-circle" width="25px" height="25px"><a href="{{secure_asset('/')}}">TouristTribe</a></span>

        @else
        <span style="margin-top: -20px" class="right-corner color border round10 p-1 bg-light">
          <a href="{{ route('login') }}">Login</a></span>
          <span style="margin-top: -20px" class="left-corner color border round10 p-1 bg-light">
	  		<img src="{{ secure_asset('storage/public/YyHZ5a7mS8a2OUSHmWOqPp2vpTekFTx1xHPAQgp1.jpeg') }}" alt="TouristTribe Logo" class="rounded-circle" width="25px" height="25px"><a href="{{secure_asset('/')}}">TouristTribe</a></span>
	  		<div class="hero-text color">
    
    <p style="font-size:15px"><br><br>Please, <span style="color: red">login</span> to book this package.</p>
    
  </div>
        @endif
  </div>
</div>
@endsection
@section('data')
<div class="container p-3">
  <div class="card shadow round10">
    <div class="card-header">
    <h1 style="font-size:25px" class="text-center">{{ $data['0'] -> trip_name }}</h1>
    </div>
    
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-justified mt-3">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#midtrip">Midtrips</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#hotel">Hotels</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#meal">Meals</a>
      </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <div id="home" class="container tab-pane active"><br>
        <h5>Loction Name : <span class="badge badge-primary"style="font-size: 100%">{{ $data['0'] -> location_name }}</span></h5>
        <hr />
        <h5>Gender : 
          @if($data['0'] -> allGender)
            <span class="badge badge-primary"style="font-size: 100%">All Genders</span>
          @endif
          @if($data['0'] -> onlyMens)
            <span class="badge badge-primary"style="font-size: 100%">&nbsp;Only men</span>
          @endif
          @if($data['0'] -> onlyWomens)
            <span class="badge badge-primary"style="font-size: 100%">&nbsp;Only Women</span>
          @endif
        </h5>
        <hr />
        <h5>
          Cast : 
          @if($data['0'] -> allCast)
            &nbsp;<span class="badge badge-primary"style="font-size: 100%">All Cast</span>
          @endif
          @if($data['0'] -> buddhismCast)
            &nbsp;<span class="badge badge-primary"style="font-size: 100%">Buddhism</span>
          @endif
          @if($data['0'] -> buddhismCast)
            &nbsp;<span class="badge badge-primary"style="font-size: 100%">Hindu</span>
          @endif
          @if($data['0'] -> islamCast)
            &nbsp;<span class="badge badge-primary"style="font-size: 100%">Islam</span>
          @endif
          @if($data['0'] -> christianCast)
            &nbsp;<span class="badge badge-primary"style="font-size: 100%">Christian</span>
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
        <p>Number Of Person : <span class="badge badge-primary"style="font-size: 100%"> {{ $nop }} </span></p>
        <p>Transfer: <span class="badge badge-primary" style="font-size: 100%">{{ $data['0'] -> vehicalName }}</span></p>             
        <p>Number Of Room : <span class="badge badge-primary"style="font-size: 100%"> {{ $nor }} </span></p>
        <p>Bed Type : 
          @if($bt == 1)
            <span class="badge badge-primary"style="font-size: 100%"> Single </span>
          @endif
          @if($bt == 2)
            <span class="badge badge-primary"style="font-size: 100%"> Double </span>
          @endif
          @if($bt == 3)
            <span class="badge badge-primary"style="font-size: 100%"> Triple </span>
          @endif
        </p>
        <p>Trip Date : <span class="badge badge-primary"style="font-size: 100%"> {{ $trip_date }} </span></p>
        <hr />
        <h5> Pickup Details : </h5>
        <p>{{ $data['0'] -> pickup_details }}</p>
        <hr />
        <h5>Drop Details : </h5>
        <p>{{ $data['0'] -> drop_details }}</p>
        <hr />
        <h5>Other Details : </h5>
        <div class="formatedtxt"><p>{{ $data['0'] -> other_details }}</p></div>       
      </div>
      <div id="midtrip" class="container tab-pane fade"><br>
        <div class="row p-3">
          @foreach($midtrip as $midtrips)
            <div class="col-sm-6 mb-3">
                
                
                <?php $imgLocation =  "https://touristtribe.in/storage/".$midtrips -> images; ?>
                <center><img src="{{ $imgLocation }}" alt="{{ $midtrips -> name }}"  class="shadow round10" width="100%" height="100%"  /></center>
                
              
              <div class="border p-3 shadow round10">
                <h4 class="text-center"> {{ $midtrips -> name }} </h4>
                <div class="formatedtxt"><p> {{ $midtrips -> description }} </p></div>
                
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div id="hotel" class="container tab-pane fade"><br>
        <div class="row p-3">
          @foreach($hotel as $hotels)
            <div class="col-sm-6 mb-3">
              <div class="border p-3 shadow round10">
              <h5 class="text-center"> {{ $hotels -> hotel_name }} </h5>
              <p> Hotel Rating :- <span class="badge badge-primary"style="font-size: 100%">{{ $hotels -> rating }}</span> </p>
              <p>
                Hotel Type :- <span class="badge badge-primary"style="font-size: 100%">{{ $hotels -> type }}</span>
              </p>
              <?php 
                $hostalImgString = $hotels -> images;
                $hostalArray = explode(",",$hostalImgString);
                $length = count($hostalArray); 
              ?>
                @for($i = 0; $i < $length; $i++)
                    <center><img src="https://touristtribe.in/storage/{{$hostalArray[$i]}}" alt="{{ $hotels -> hotel_name }}" class="shadow round10" width="100%" height= "100%"/><p><br></p></center>
                                  @endfor
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div id="meal" class="container tab-pane fade"><br>
        <h5>Meal Details :- </h5>
        <hr />
        @if($data['0'] -> breakfast_details)
          <h4>BreakFast Details : </h4>
          <p>{{ $data['0'] -> breakfast_details }}</p>
        <hr />
        @endif
        @if($data['0'] -> lunch_details)
          <h4>Lunch Details : </h4>
          <p>{{ $data['0'] -> lunch_details }}</p>
        <hr />
        @endif
        @if($data['0'] -> evening_tea_details)
          <h4>Evening Details : </h4>
          <p>{{ $data['0'] -> evening_tea_details }}</p>
        <hr />
        @endif
        @if($data['0'] -> dinner_details)
          <h4>Dinner Details : </h4>
          <p>{{ $data['0'] -> dinner_details }}</p>
        <hr />
        @endif
      </div>
    </div>
    <div class="card-footer text-center">
      <?php 
      $for = "family";
      $id = $data['0']->id;
      $enc = base64_encode($trip_price);
      $location = "payment/$id?payment=$enc&nop=$nop&nor=$nor&bt=$bt&nod=$nod&trip_date=$trip_date&bookingfor=$for" 
      ?>
      <a href={{ secure_asset("$location") }} class="btn btn-primary">Buy Now</a>
    </div>
    <div class="row"> 
         <div class="col center"> 
          <center><a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-share-square-o"></i></a></center>
          
       </div> 
    </div>
  </div>
</div>


<div class="modal" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">

       <!--Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Share</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

       <!--Modal body -->
      <div class="modal-body">
         <!--<?php $url = "url()->full()"; ?>-->
        <div class="social-buttons">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}"
            target="_blank">
            <i class="fa fa-facebook-square"></i> FACEBOOK
          </a><br><br>
          <a href="https://api.whatsapp.com/send?text={{ $data['0'] -> trip_name }} {{ url()->full() }}"
            target="_blank">
            <i class="fa fa-whatsapp"></i> WHATSAPP
          </a><br><br>
          <a href="$email = 'mailto:?subject=' . {{ $data['0'] -> trip_name }} . '&body=Check out this site: '. {{url()->full()}} .'" title="Share by Email';"
            target="_blank">
            <i class="fa fa-envelope"></i> EMAIL
          </a><br><br>
          <a href="https://www.linkedin.com/shareArticle?url={{url()->full()}}&title={{$data['0'] -> trip_name }}" target="_blank">
          <i class="fa fa-linkedin"></i> LINKEDIN
          </a><br><br>
          <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->full()) }}" target="_blank">
          <i class="fa fa-twitter"></i> TWITTER
          </a><br><br>
          <a href="https://pinterest.com/pin/create/button/?{{ http_build_query(['url' => url()->full()]) }}" target="_blank">
          <i class="fa fa-pinterest"></i> PINTEREST
          </a>
        </div>
      </div>
      </div>
      </div>
      </div>
@endsection