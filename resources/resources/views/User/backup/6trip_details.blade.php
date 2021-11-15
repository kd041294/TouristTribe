@extends('User.layouts.app')

@section('menu')
    <div id="mySidenav" class="sidenav round10 shadow">
        
          <a href="javascript:void(0)"  class="closebtn p-1" onclick="closeNav()">&times;</a>
          <form method="get" action={{asset("trip_details/$loc")}}>
              <div class="form-group" style="padding:8px 8px 8px 8px;">
                <label>Enter date</label>
                <input type="date" class="form-control" name="trip_date" value="{{ $trip_date ?? '' }}" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+3 Months')) }}">
              </div>
              <div class="form-group" style="padding:8px 8px 8px 8px;">
                <label>Enter number of days</label>
                <input type="number" class="form-control" name="nod" value="{{ $nod }}">
              </div>
              <div class="form-group" style="padding:8px 8px 8px 8px;">
                <label>Enter number of person</label>
                <input type="number" class="form-control" name="nop" value="{{ $nop }}">
              </div>
              <div class="form-group" style="padding:8px 8px 8px 8px;">
                <label>Enter number of room</label>
                <input type="number" class="form-control" name="nor" value="{{ $nor }}">
              </div>
              <div class="form-group" style="padding:8px 8px 8px 8px;">
                <label>Select Bed Type</label>
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
              </div>
              <div class="text-center" >
                <input type="submit">
              </div>
          </form>
        </div>

        <div id="main" >
            <div class="card border shadow round10 p-4">
                <span style="margin-top: -20px" class="left-corner color border round10 p-1 bg-light" onclick="openNav()">&#9776; PlanMyTrip</span>
                <span style="margin-top: -20px" class="right-corner color border round10 p-1 bg-light">
                  @if(session('sessionId'))
                    <a href="{{asset('logout')}}">Logout</a>
                  @else
                    <a href="{{asset('login')}}">Login</a>
                  @endif
            </div>
        </div>
@endsection
@section('data')
    <div class="mt-3 bg-light p-2">
        <div class="row">
            @for($i = 0; $i < $numberOfTrip; $i++)
                <div class="col-sm-4">
                    <div class="card shadow" style="width:300px">
                        <div id="demo" class="carousel slide" data-ride="carousel">  
                            <div class="carousel-inner">
                                <?php $firstmidtripImage = $midtrip[$i] ?>
                                <?php $firstImg = $firstmidtripImage[$i] -> images ?>
                                
                                <div class="carousel-item active">
                                  <img src="{{ asset('storage/'.$firstImg) }}" class="card-img-top" width="300px" height="150px">
                                </div>
                                
                                @for($j = 0; $j < count($firstmidtripImage); $j++)
                                <?php $midtripAllImg = $firstmidtripImage[$j] -> images ?>
                                <div class="carousel-item">
                                  <img class="card-img-top" width="300px" 
                                  height="150px" src="{{ asset('storage/'.$midtripAllImg) }}">
                                </div>
                                @endfor
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-center">{{ $data[$i]->trip_name }}</h4>
                            <span class="badge badge-primary">{{ $data[$i]->no_of_days }} Days</span>
                            <span class="badge badge-primary">{{ $data[$i]->no_of_nights }} Night</span>
                            <br>
                            <span class="badge badge-primary">{{ $data[$i]->type }}</span>
                            <p>No of Booking :- <span class="badge badge-primary">{{ $booking[$i] }}</span></p>
                            <p>Total Limit :- <span class="badge badge-primary">{{ $data[$i] -> total_member_size }}</span></p>
                            
                            
                            <?php $trip_prices = $tripPrices[$i]['total_price']; ?>

                            @for($j = 0; $j < $numberOfTrip; $j++)
                                <?php $single_room = $hotels[$i][$j]-> single_bed_type_cost ?>
                                <?php $double_room = $hotels[$i][$j]-> double_bed_type_cost ?>
                                <?php $triple_room = $hotels[$i][$j]-> triple_bed_type_cost ?>

                                @if($bt == 1)
                                    @if(!$single_room)
                                        <?php $trip_prices = "Sorry single bed not present in this trip"; ?>
                                        @break
                                    @endif
                                @endif
                                @if($bt == 2)
                                    @if(!$double_room)
                                        <?php $trip_prices = "Sorry double bed not present in this trip"; ?>
                                        @break
                                    @endif
                                @endif
                                @if($bt == 3)
                                    @if(!$triple_room)
                                        <?php $trip_prices = "Sorry triple bed not present in this trip"; ?>
                                        @break
                                    @endif
                                @endif

                            @endfor

                            <p>Prices :- <span class="badge badge-primary">{{ $trip_prices }}-/</span></p>
                            
                            @if($tripError[$i] == "Possible")
                            <div class="text-center">
                                @if($is_comp_passed)
                                <span>
                                    <a 
                                    href=
                                    "trip_booking/{{$data[$i]->id}}?nop={{$nop}}&nor={{$nor}}&bt={{$bt}}&nod={{$nod}}&trip_date={{$trip_date}}&trip_price={{ base64_encode($tripPrices[$i]['total_price']) }}" class="btn btn-primary">BookTrip</a></span>
                                @else
                                <span>
                                    <a 
                                    href=
                                    "trip_booking/{{$data[$i]->id}}?trip_id={{$data[$i]->id}}&nop={{$nop}}&nor={{$nor}}&bt={{$bt}}&nod={{$nod}}&trip_date={{$trip_date}}&trip_price={{ base64_encode($tripPrices[$i]['total_price']) }}" class="btn btn-primary">BookTrip</a></span>
                                <span>
                                    <a href="family_booking/{{$data[$i]->id}}?nop={{$nop}}&nor={{$nor}}&bt={{$bt}}&nod={{$nod}}&trip_date={{$trip_date}}" class="btn btn-primary">Family Booking</a>
                                </span>
                                
                                @endif
                            </div>
                            @endif
                            <br>
                            <div class="row">
                              <div class="col text-center">
                                <a href="#" class="text-center" data-toggle="modal" data-target="#myModal"><i class="fa fa-share-alt"></i></a>
                                
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Share</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php $url = "http://127.0.0.1:8000/trip_details/Test1"; ?>
        <div class="social-buttons">
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}"
            target="_blank">
            FACEBOOK
            <i class="fa fa-facebook-square"></i>
          </a><br>
          <a href="https://api.whatsapp.com/send?text=[post-title] {{ $url }}"
            target="_blank">
            WHATSAPP
            <i class="fa fa-whatsapp"></i>
          </a><br>
          <a href="$email = 'mailto:?subject=' . $[post-title] . '&body=Check out this site: '. $url .'" title="Share by Email';"
            target="_blank">
            GOOGLE
            <i class="fa fa-google"></i>
          </a><br>
          <a href="https://plus.google.com/share?url={{ urlencode($url) }}"
       target="_blank">
            GOOGLE PLUS
            <i class="fa fa-google-plus"></i>
          </a><br>
          <a href="https://www.linkedin.com/shareArticle?url=$url&title=[post-title]" target="_blank">LINKEDIN
          <i class="fa fa-linkedin"></i>
          </a><br>
          <a href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}" target="_blank">TWITTER
          <i class="fa fa-twitter"></i>
          </a><br>
          <a href="https://pinterest.com/pin/create/button/?{{ http_build_query(['url' => $url]) }}" target="_blank">PINTEREST
          <i class="fa fa-pinterest"></i>
          </a>
          
          
        </div>

      </div>

    </div>
  </div>
</div>

@endsection
