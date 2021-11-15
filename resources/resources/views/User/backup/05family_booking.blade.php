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
    <h2 class="text-center">{{ $data['0'] -> trip_name }}</h2>
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
        <h3>Loction Name : <span class="badge badge-primary">{{ $data['0'] -> location_name }}</span></h3>
        <hr />
        <h3>Gender : 
          @if($data['0'] -> allGender)
            <span class="badge badge-primary">All Genders</span>
          @endif
          @if($data['0'] -> onlyMens)
            <span class="badge badge-primary">&nbsp;Only men</span>
          @endif
          @if($data['0'] -> onlyWomens)
            <span class="badge badge-primary">&nbsp;Only Women</span>
          @endif
        </h3>
        <hr />
        <h3>
          Cast : 
          @if($data['0'] -> allCast)
            &nbsp;<span class="badge badge-primary">All Cast</span>
          @endif
          @if($data['0'] -> buddhismCast)
            &nbsp;<span class="badge badge-primary">Buddhism</span>
          @endif
          @if($data['0'] -> buddhismCast)
            &nbsp;<span class="badge badge-primary">Hindu</span>
          @endif
          @if($data['0'] -> islamCast)
            &nbsp;<span class="badge badge-primary">Islam</span>
          @endif
          @if($data['0'] -> christianCast)
            &nbsp;<span class="badge badge-primary">Christian</span>
          @endif
        </h3>
        <hr />
        <h3>
          Total Price : <span class="badge badge-primary">{{ $trip_price }}</span>
        </h3>
        <hr />
        <h3>
          Details :- 
        </h3>
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
        </p>
        <p>Trip Date : <span class="badge badge-primary"> {{ $trip_date }} </span></p>
        <hr />
        <h3> Pickup Details : </h3>
        <p>{{ $data['0'] -> pickup_details }}</p>
        <hr />
        <h3>Drop Details : </h3>
        <p>{{ $data['0'] -> drop_details }}</p>
        <hr />
        <h3>Other Details : </h3>
        <p>{{ $data['0'] -> other_details }}</p>       
      </div>
      <div id="midtrip" class="container tab-pane fade"><br>
        <div class="row p-3">
          @foreach($midtrip as $midtrips)
            <div class="col-sm-6 mb-3">
              <div class="border p-3 shadow round10">
                <h3 class="text-center"> {{ $midtrips -> name }} </h3>
                <p> {{ $midtrips -> description }} </p>
                <?php $imgLocation =  "http://127.0.0.1:8000/storage/".$midtrips -> images; ?>
                <img src="{{ $imgLocation }}" alt="{{ $midtrips -> name }}" width="100%" height="300px" />
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
              <h3 class="text-center"> {{ $hotels -> hotel_name }} </h3>
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
                    <img src="http://127.0.0.1:8000/storage/{{$hostalArray[$i]}}" alt="" width="100%" height="150px">
                  </div>
                @endfor
              </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div id="meal" class="container tab-pane fade"><br>
        <h3>Meal Details :- </h3>
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
      $location = "payment/$id?payment=$enc&nop=$nop&nor=$nor&bt=$bt&trip_date=$trip_date&bookingfor=$for" 
      ?>
      <a href={{ asset("$location") }} class="btn btn-primary">Pay Money</a>
    </div>
  </div>
</div>
@endsection