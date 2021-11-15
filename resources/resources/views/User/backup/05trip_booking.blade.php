@extends('User.layouts.app')
@section('menu')
<div id="main" >
  <div class="card border shadow round10 p-4">
    <span style="margin-top: -20px" class="right-corner color border round10 p-1 bg-light">
       @if(session('sessionId'))
          <a href="{{asset('logout')}}">Logout</a>
        @else
          <a href="{{asset('login')}}">Login</a>
        @endif
    </span>
  </div>
</div>
@endsection
@section('data')
<div class="container p-3">
    
  <div class="card shadow round10">


    
    <div class="card-header">
    <h3 class="text-center">{{ $data -> trip_name }}</h3>
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
        <h5>Loction Name : <span class="badge badge-primary">{{ $data -> location_name }}</span></h5>
        <hr />
        <h5>Gender : 
          @if($data -> allGender)
            <span class="badge badge-primary">All Genders</span>
          @endif
          @if($data -> onlyMens)
            <span class="badge badge-primary">&nbsp;Only men</span>
          @endif
          @if($data -> onlyWomens)
            <span class="badge badge-primary">&nbsp;Only Women</span>
          @endif
        </h5>
        <hr />
        <h5>
          Cast : 
          @if($data -> allCast)
            &nbsp;<span class="badge badge-primary">All Cast</span>
          @endif
          @if($data -> buddhismCast)
            &nbsp;<span class="badge badge-primary">Buddhism</span>
          @endif
          @if($data -> buddhismCast)
            &nbsp;<span class="badge badge-primary">Hindu</span>
          @endif
          @if($data -> islamCast)
            &nbsp;<span class="badge badge-primary">Islam</span>
          @endif
          @if($data -> christianCast)
            &nbsp;<span class="badge badge-primary">Christian</span>
          @endif
        </h5>
        <hr />
        <h5>
          Total Price : <span class="badge badge-primary">{{ base64_decode($trip_price) }}</span>
        </h5>
        <hr />
        <h5>
          Details :- 
        </h5>
        <p>Number Of Person : <span class="badge badge-primary"> {{ $nop }} </span></p>
        <p>Number Of Room : <span class="badge badge-primary"> {{ $nor }} </span></p>
        <p>Bed Type : 
          @if($bt == 1)
            <span class="badge badge-primary"> Single </span>
          @endif
          @if($bt == 2)
            <span class="badge badge-primary"> Double </span>
          @endif
          @if($bt == 3)
            <span class="badge badge-primary"> Triple </span>
          @endif
        </p><hr />
        <h5>Trip Start Date : <span class="badge badge-primary"> {{ $trip_date }} </span></h5>
        <hr />
        <h5> Pickup Point : </h5>
        <p>{{ $data -> pickup_details }}</p>
        <hr />
        <h5>Drop Point : </h5>
        <p>{{ $data -> drop_details }}</p>
        <hr />
        <h5>Other Details : </h5>
           
        <p>{{ $data -> other_details }}</p>
        
     
      </div>
      
      
      
      
      <div id="midtrip" class="container tab-pane fade"><br>
        <div class="row p-3">
          @foreach($midtrip as $midtrips)
            <div class="col-sm-6 mb-3">
              <div class="border p-3 shadow round10">
                <h5 class="text-center"> {{ $midtrips -> name }} </h5>
                
                <?php $imgLocation =  "http://touristtribe.in/storage/".$midtrips -> images; ?>
                <img src="{{ $imgLocation }}" alt="{{ $midtrips -> name }}" width="100%" height=auto />
                <p> {{ $midtrips -> description }} </p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div id="hotel" class="container tab-pane fade"><br>
        <div class="row p-3">
          @foreach($hotel as $hotels)
            <div class="col-sm-6 mb-3">
              <div class="border p-3 shadow type">
              <h5 class="text-center"> {{ $hotels -> hotel_name }} </h5>
              <p> Hotel Rating :- <span class="badge badge-primary">{{ $hotels -> rating }}</span> </p>
              <p>
                Hotel Type :- <span class="badge badge-primary">{{ $hotels -> type }}</span>
              </p>
              <?php 
                $hostalImgString = $hotels -> images;
                $hostalArray = explode(",",$hostalImgString);
                $length = count($hostalArray); 
              ?>
              <div class="row">
                @for($i = 0; $i < $length; $i++)
                  <div class="col-sm-4">
                    <img src="http://touristtribe.in/storage/{{$hostalArray[$i]}}" alt="" width="100%" height=auto>
                  </div>
                @endfor
              </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div id="meal" class="container tab-pane fade"><br>
        
        @if($data -> breakfast_details)
          <h4>BreakFast Details : </h4>
          <p>{{ $data -> breakfast_details }}</p>
        <hr />
        @endif
        @if($data -> lunch_details)
          <h4>Lunch Details : </h4>
          <p>{{ $data -> lunch_details }}</p>
        <hr />
        @endif
        @if($data -> evening_tea_details)
          <h4>Evening Details : </h4>
          <p>{{ $data -> evening_tea_details }}</p>
        <hr />
        @endif
        @if($data -> dinner_details)
          <h4>Dinner Details : </h4>
          <p>{{ $data -> dinner_details }}</p>
        <hr />
        @endif
      </div>
    </div>
    <div class="card-footer text-center">
      <?php 
      $for = "general";
      $location = "payment/$data->id?payment=$trip_price&nop=$nop&nor=$nor&bt=$bt&trip_date=$trip_date&bookingfor=$for" 
      ?>
      <a href={{ asset("$location") }} class="btn btn-primary">Pay Money</a>
    </div>
  </div>
</div>
@endsection