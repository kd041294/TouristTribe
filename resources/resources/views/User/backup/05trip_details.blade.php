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
                                  <img src='{{ asset("$firstImg") }}' class="card-img-top" width="300px" height=auto>
                                </div>
                                @for($j = 0; $j < $numberOfTrip; $j++)
                                <?php $midtripAllImg = $firstmidtripImage[$j] -> images ?>
                                <div class="carousel-item">
                                  <img class="card-img-top" width="300px" 
                                  height=auto src={{ asset("$midtripAllImg") }}>
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
                            
                            
                            <?php $trip_prices = $tripPrices[$i] ?>

                            @for($j = 0; $j < $numberOfTrip; $j++)
                                <?php $single_room = $hotels[$i][$j]-> single_bed_type_cost ?>
                                <?php $double_room = $hotels[$i][$j]-> double_bed_type_cost ?>
                                <?php $triple_room = $hotels[$i][$j]-> triple_bed_type_cost ?>

                                @if($bt == 1)
                                    @if(is_null($single_room))
                                        <?php $trip_prices = "Sorry single bed not present in this trip"; ?>
                                        @break
                                    @endif
                                @endif
                                @if($bt == 2)
                                    @if(is_null($double_room))
                                        <?php $trip_prices = "Sorry double bed not present in this trip"; ?>
                                        @break
                                    @endif
                                @endif
                                @if($bt == 3)
                                    @if(is_null($triple_room))
                                        <?php $trip_prices = "Sorry triple bed not present in this trip"; ?>
                                        @break
                                    @endif
                                @endif

                            @endfor

                            <p>Prices :- <span class="badge badge-primary">{{ $trip_prices }}-/</span></p>
                            
                            
                            @if($tripError[$i] == "Possible")
                            <div class="text-center">
                                <span>
                                    <a 
                                    href=
                                    "trip_booking/{{$data[$i]->id}}?nop={{$nop}}&nor={{$nor}}&bt={{$bt}}&nod={{$nod}}&trip_date={{$trip_date}}&trip_price={{ base64_encode($tripPrices[$i]) }}" class="btn btn-primary">BookTrip</a></span>
                                <span>
                                    <a href="family_booking/{{$data[$i]->id}}?nop={{$nop}}&nor={{$nor}}&bt={{$bt}}&nod={{$nod}}&trip_date={{$trip_date}}" class="btn btn-primary">Family Booking</a>
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection