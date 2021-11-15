@extends('User.layouts.welcomePage')
@section('menu')
@if(session('sessionId'))
	      
	<div class="card border shadow round10 p-4">
	    
        <div class="container">
            <div class="dropdown">
                <button style="margin-top: -20px"  class="btn btn-primary dropdown-toggle right-corner round5 p-1 " type="button" data-toggle="dropdown">&#9776; Menu
                <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                    <li><a class="color" data-toggle="modal" data-target="#home_filter" href="#">Filter</a>
                     </li>
                    <li><a class="color" href="{{secure_asset('/ongoing_trip')}}">Ongoing Trip</a>
                     </li>
                    <li><a class="color" href="{{secure_asset('logout')}}">Logout</a>
                     </li>
                    </ul>
            </div>
                <span style="margin-top: -20px" class="left-corner color border round10 p-1 bg-light">
	  		<img src="{{ secure_asset('storage/public/YyHZ5a7mS8a2OUSHmWOqPp2vpTekFTx1xHPAQgp1.jpeg') }}" alt="TouristTribe Logo" class="rounded-circle" width="25px" height="25px"><a href="{{secure_asset('/')}}">TouristTribe</a></span>
            </div></div>

        
		 	
	      @else
	      	<div class="card border shadow round10 p-4">
	    
        <div class="container">
            <div class="dropdown">
                <button style="margin-top: -20px"  class="right-corner btn btn-primary dropdown-toggle round5 p-1 " type="button" data-toggle="dropdown">&#9776; Menu
                <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                    <li><a class="color" data-toggle="modal" data-target="#home_filter" href="#">Filter</a>
                     </li>
                    <li><a class="color" href="{{secure_asset('/ongoing_trip')}}">Ongoing Trip</a>
                     </li>
                    <li><a class="color" href="{{secure_asset('login')}}">Login</a>
                    </li>
                    <li><a class="color" href="{{secure_asset('signup')}}">Signup</a>
                    </li>
                    </ul>
            </div>
                <span style="margin-top: -20px" class="left-corner color border round10 p-1 bg-light">
	  		<img src="{{ secure_asset('storage/public/YyHZ5a7mS8a2OUSHmWOqPp2vpTekFTx1xHPAQgp1.jpeg') }}" alt="TouristTribe logo" class="rounded-circle" width="25px" height="25px"><a href="{{secure_asset('/')}}">TouristTribe</a></span>
        </div>
        
            </div>

	      @endif

@endsection
@section('data')


<div class="hero-image color round10">
  <div class="hero-text">
    <h1 style="font-size:25px"><b>G’day, we’re TouristTribe. We list tour packages from various destination accross India. 
</b></h1>
    <h2 style="font-size:15px">Here you can customize your tour packages acordingly and book them. And we’re serious about listing amazing tour packages and world class travel experience for all.</h2>
    
  </div>
</div>





	    
	    <div class="container-fluid xs-compact-top xs-cozy-bottom n20" id="subsection-open-boxed"> 
	    <div class="row flex-container reduced-row"> 
	    <div class="column column-xs-10 column-xs-offset-1 fadeUp s0 between in-view" style="box-shadow:0px 10px 14px 0px rgba(23,43,77,0.2);padding:20px 30px;z-index:5;background-color:#F4F5F7;"> 
	    <div class="container-fluid xs-none"> 
	    <div class="row flex-container"> 
	    <div    class="column column-lg-2 xs-none xs-text-align-left sm-text-align-left md-text-align-left lg-text-align-center xl-text-align-center vertical-middle s0 between"> 
	    <div    class="component component--image" style="max-width:170px;"> 
	        <img id="59be1810" alt="Point A blueprint flag" class="component__image" style="width:75px;" src="{{ secure_asset('storage/public/a0c391dc49c440fc9962168353cedde3.svg') }}" loading="auto"> 
	            </div> </div> 
	        <div class="column column-lg-10 xs-compact vertical-middle s0 between"> 
	        <div class="container-fluid xs-none"> 
	        <div class="row flex-container"> 
	        <div class="column column-lg-8 xs-tight vertical-middle s0 between"> 
	        <div class="component component--textblock"> 
	        <h3 style="font-size:15px">Introducing world's first, the <b>Ongoing Trip</b>, where you or your family can join existing groups For that you'll be benefited to pay less.</h3> 
	        </div> </div> 
	   <div class="column column-lg-4 xs-none vertical-middle s0 between"> 
	   <div class="component component--link-button"> 
	   <a href="{{secure_asset('/ongoing_trip')}}" data-event="clicked" data-uuid="57f45c74-5a" data-event-component="linkButton" data-event-container="linkButton" data-schema-version="1" data-label="Explore new products" class="component__link link-arrow "> Ongoing Trip <font size="+6">&#9755;</font><svg class="link-arrow-image" width="11px" height="8px" viewBox="0 0 11 8" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
	    </svg> </a>
	     <p style="font-size:15px">Available <span style="color: red">EMI</span> option to pay.</p></div> </div> </div> </div> </div> </div> </div> </div> </div> </div>

	    <br>
	    
	    

	    
	    <!--product carusol-->
	    <div class="container mt-5">
        <span>
            <h4>Explore destinations by categories</h4>
        </span>
        <div id="carouselExampleFade" class="carousel slide " data-ride="carousel" >
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-4">
                            <img class="round10" src="{{ secure_asset('storage/public/0bcfef2d2d6a49f10ba12ecd64ad96aa.svg') }}" alt="Hill station" class="Hill">
                            <p class="text-center  card-footer">
                              <a href="{{ secure_asset('?location%5B%5D=Hill+station') }}">Hill</a>
                            </p>
                        </div>

                        <div class="col-4">
                            <img class="round10" src="{{ secure_asset('storage/public/eda5b39921f1c3331e5125e13f2835c3.svg') }}" alt="Aquatica" class="Aquatic">
                            <p class="text-center  card-footer">
                             <a href="{{ secure_asset('?location%5B%5D=water+activities') }}">Aquatic</a>
                            </p>
                        </div>

                        <div class="col-4">
                            <img class="round10" src="{{ secure_asset('storage/public/7193529abbf96dcc058f06d45121d8b1.svg') }}" alt="Beach" class="Beach">
                            <p class="text-center  card-footer">
                             <a href="{{ secure_asset('?location%5B%5D=Beach') }}">Beach</a>   
                            </p>
                        </div>

                

                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row">
                        <div class="col-4">
                            <img class="round10" src="{{ secure_asset('storage/public/5db931c142ccdc3101bc8c7fb8f3c34b.svg') }}" alt="heritage" class="heritage">
                            <p class="text-center  card-footer">
                             <a href="{{ secure_asset('?location%5B%5D=heritage') }}">Heritage</a>  
                            </p>
                        </div>

                        <div class="col-4">
                            <img class="round10" src="{{ secure_asset('storage/public/88d225c2e49a29a9fcd5e63b5c182438.svg') }}" alt="City Tour" class="City Tour">
                            <p class="text-center  card-footer">
                            <a href="{{ secure_asset('?location%5B%5D=city+tour') }}">CityTour</a> 
                            </p>
                        </div>

                        <div class="col-4">
                            <img class="round10" src="{{ secure_asset('storage/public/7ca6c5076bb01c621993eaf8aba35c41.svg') }}" alt="Picnic" class="Picnic">
                            <p class="text-center  card-footer">
                             <a href="{{ secure_asset('?location%5B%5D=Picnic+spot') }}"><br>Picnic</a>  
                            </p>
                        </div>

                    </div>
                </div>



            </div>
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
	    <!--product carusol-->
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	 	<div class="container mt-3">   
	    
		@if(session('message'))
			<div class="alert alert-success alert-dismissible text-center">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <p><strong>{{ session('message') }}</strong></p>
			</div>
		@endif
		<div class="row">
		@foreach($datas as $data)
			<?php 
				$img = $data -> location_images;
				$imgLocation =  "https://touristtribe.in/storage/$img";
			?>
			
			<div class="jumbotron text-center round10">
			
			                    <img class="round10" src="{{$imgLocation}}" alt="{{ $data -> name }}" width="293px"  height="293px"/>
                    <div class="card-body">
						<div class="text-center">
							<h4 class="card-title text-uppercase">{{ $data -> name }}</h4>
							<a href="trip_details/{{ $data -> name }}" class="btn btn-primary">
							View Packages </a>
						</div>
					</div>
					</div>

		@endforeach
		</div>
	</div>
@endsection


