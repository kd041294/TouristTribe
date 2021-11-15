@extends('User.layouts.trip_detailsPage')

@section('menu')
    <div id="mySidenav" class="sidenav round10 shadow">
        
          <a href="javascript:void(0)"  class="closebtn p-1" onclick="closeNav()">&times;</a>
          <form method="get" action={{secure_asset("trip_details/$loc")}}>
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
              <div class="text-center">
                <input type="submit">
              </div>
          </form>
        </div>

        <div id="main" >
            <div class="card border shadow round10 p-4">
                <span style="margin-top: -20px" class="left-corner color border round10 p-1 bg-light" onclick="openNav()">&#9776; PlanMyTrip</span>
                <span style="margin-top: -20px" class="right-corner color border round10 p-1 bg-light">
                  @if(session('sessionId'))
                    <a href="{{secure_asset('logout')}}">Logout</a>
                  @else
                    <a href="{{secure_asset('login')}}">Login</a>
                  @endif
            </div>
        </div>
@endsection
@section('data')
    <div class="mt-3 bg-light p-2">
        <div class="row">
            
            @for($i = 0; $i < $numberOfTrip; $i++)
                <div class="col-sm-4">
                    <div class="card shadow" >
                        <div id="demo" class="carousel slide" data-ride="carousel">  
                            <div class="carousel-inner">
                                 @for($ii = 0; $ii < 2; $ii++)
                                        <?php $firstmidtripImage = $midtrip[$ii] ?>
                                        <?php $firstImg = $firstmidtripImage[$ii] -> images ?>
                                        @endfor
                                
                                <div class="carousel-item active">
                                  <img src="{{ secure_asset('storage/'.$firstImg) }}" alt="{{ $data[$i]->trip_name }}" class="card-img-top" width="293px" height="293px">
                                </div>
                                
                                @for($j = 0; $j < count($firstmidtripImage); $j++)
                                <?php $midtripAllImg = $firstmidtripImage[$j] -> images ?>
                                <div class="carousel-item">
                                  <img class="card-img-top" width="293px" 
                                  height="293px" src="{{ secure_asset('storage/'.$midtripAllImg) }}" alt="{{ $data[$i]->trip_name }}">
                                </div>
                                @endfor
                            </div><br><br><br>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-center">{{ $data[$i]->trip_name }}</h4>
                            <p><span class="badge badge-primary" style="background-color: #FFD700; font-size: 100%">{{ $data[$i]->no_of_days }} Days</span>
                            <span class="badge badge-primary" style="background-color: #FFD700; font-size: 100%">{{ $data[$i]->no_of_nights }} Night</span></p>
                                                        <p><span class="badge badge-primary">{{ $data[$i]->type }}</span></p>
                           
                            <p>Seat Booked: <span class="badge badge-primary" style="font-size: 100%">{{ $booking[$i] }}</span></p>
                            <p>Total Seat: <span class="badge badge-primary" style="font-size: 100%">{{ $data[$i] -> total_member_size }}</span></p>
                            <p>Hotel Rating: <span class="badge badge-primary" style="background-color: #FFD700; font-size: 100%">  {{ $hotels[$i][0] -> rating }}   Star</span> </p>
                            <p>Transport: <span class="badge badge-primary" style="background-color: #FFD700; font-size: 100%">  {{ $data[$i] -> vehicalTotalPerson }} seater {{ $data[$i] -> vehicalName }}</span> </p>
                            <?php $trip_prices = $tripPrices[$i]['total_price'] ?>
                            
                         
                            @for($j = 0; $j < 2; $j++)
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
                            
                           <span>Price:
                            <div class="badge badge-primary" style="font-size: 100%">
                                
                            <?php $formatter = new NumberFormatter('en_IN',  NumberFormatter::CURRENCY);
                                echo ' ', $formatter->formatCurrency((int)$trip_prices, 'INR'), PHP_EOL; ?></div></span><br><br>
                                <span>Price per person:
                            <div class="badge badge-primary" style="font-size: 100%">
                             <?php    $trip_prices_pp = $trip_prices/$nop; ?>
                            <?php $formatter = new NumberFormatter('en_IN',  NumberFormatter::CURRENCY);
                                echo ' ', $formatter->formatCurrency((int)$trip_prices_pp, 'INR'), PHP_EOL; ?></div></span>
                                <br><br>
                            
                            @if($tripError[$i] == "Possible")
                            <div class="text-center">
                                <p style="font-size:15px">Available <span style="color: red">EMI</span> option to pay.</p>
                                @if($is_comp_passed)
                                <span>
                                    <a 
                                    href=
                                    "trip_booking/{{$data[$i]->id}}/?nop={{$nop}}&nor={{$nor}}&bt={{$bt}}&nod={{$nod}}&trip_date={{$trip_date}}&trip_price={{ base64_encode($tripPrices[$i]['total_price']) }}" class="btn btn-primary">BookTrip</a></span>
                                @else
                                <span>
                                    <a 
                                    href=
                                    "trip_booking/{{$data[$i]->id}}/for-{{$nop}}-people/{{$nor}}-room/{{$bt}}-bed-type/for-{{$nod}}-days/{{$trip_date}}/{{base64_encode($tripPrices[$i]['total_price'])}}/?coupon_id={{ $coupon_id }}" class="btn btn-primary">BookTrip</a></span>
                            
                                <span>
                                    <a href="family_booking/{{$data[$i]->id}}/for-{{$nop}}-people/{{$nor}}-room/{{$bt}}-bed-type/for-{{$nod}}-days/{{$trip_date}}/" class="btn btn-primary">Family Booking</a>
                                </span>
                                
                                @endif
                            </div>
                            @endif
                            <br>
                            <!--<div class="row">-->
                            <!--  <div class="col text-center">-->
                            <!--    <a href="#" class="text-center" data-toggle="modal" data-target="#myModal"><i class="fa fa-share-square-o"></i></a>-->
                                
                            <!--  </div>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            @endfor
            
        </div>
    </div>
    

@endsection
