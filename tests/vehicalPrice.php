<?php
//vehical cost
    $trip_capacity = 60;
    $vehical_capacity = 10;
    $vehical_price = 1000;
    $booking_number = 8;
    $total_person = 2;

    $vc = $vehical_capacity;
    $vp = $vehical_price;
    $ec = $booking_number;
    $nc = $total_person;
                
    $c = $ec + $nc;//total_seat
    if($trip_capacity >= $c){
        if($vc < $c){
            $b = $c % $vc;
            $cc = $c / $vc;
        
            $a0 = $nc - $b;
            $a1 = $vp;
            $a2 = $vp/$vc;
            $a3 = $a2 * $a0;
            if($b == 0){
                $p = $a3;
            }
            else{
                $p = $a3 + $vp;
                //vehical price is $p
            }
        }
        else{
            $s = $vp/$c;
            $p = $s * $nc;
        }            
    }
    else{
        //echo "Sorry booking not possible";
        $p = "booking is not possible at this date";
    }
    /* vehical price calculations close*/
    echo $p;
?>


@for($i = 0; $i < $numberOfTrip; $i++)
                    <?php $midtripImage = $midtrip[$i] ?>
                    <?php $firstImg = $midtripImage[$i]->images ?>
                    <div class="card" style="width:300px">
                        <!--Midtrips-->
                        <div id="demo" class="carousel slide" data-ride="carousel">  
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <img src='{{ asset("storage/$firstImg") }}' class="card-img-top" alt="Los Angeles" class="card-img-top">
                            </div>
                            @for($j = 0; $j < $numberOfTrip; $j++)
                            <div class="carousel-item">
                              <img src="http://127.0.0.1:8000/storage/public/RyouErMWUP7a5CLTn3woDcbPQpL7QKkYZFIJV4Xk.jpeg" alt="Los Angeles" class="card-img-top">
                            </div>
                            @endfor
                          </div>
                        </div>
                        <div>
                            
                        </div>
                    </div>
                @endfor