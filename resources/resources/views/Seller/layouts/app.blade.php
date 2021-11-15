<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }} seller central</title>
        <meta name="robots" content="noindex">
        
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link rel="stylesheet" href="{{ asset('css/btn.css') }}" />

        
        <link rel="icon" href="https://touristtribe.in/storage/public/d02a42d9cb3dec9320e5f550278911c7.jpg" type="image/gif">
       <script src="https://use.fontawesome.com/8fc1111e13.js"></script>
        <style>
           body{
              font-family: 'Montserrat', serif !important;
              margin: 0;
              padding: 0;
          }
           .badge-primary {
    color: #fff;
    background-color: #65B5AB;
}
          .btn-primary:hover {
    color: #fff;
    background-color: #65B5AB;
    border-color: #65B5AB;
}
        .btn-primary{
            border-color: none;
        } 
        .btn-primary{
    color: #fff;
    background-color: #65B5AB;
    border-color: #65B5AB;
    
}
.btn-primary:hover {
    color: #fff;
    background-color: #65B5AB;
    border-color: 0 0 0 0.2rem rgb(255 211 36 / 50%);
}
.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
    color: #fff;
    background-color: #65B5AB;
    border-color: #65B5AB;
}
.btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show>.btn-primary.dropdown-toggle:focus {
    box-shadow: 0 0 0 0.2rem rgb(255 211 36 / 50%);
}
.btn-primary.focus, .btn-primary:focus {
    color: #fff;
    background-color: #65B5AB;
    border-color: #65B5AB;
    box-shadow: 0 0 0 0.2rem rgb(255 211 36 / 50%);
}
.btn-outline-info:not(:disabled):not(.disabled).active, .btn-outline-info:not(:disabled):not(.disabled):active, .show>.btn-outline-info.dropdown-toggle {
    color: #fff;
    background-color: #65B5AB;
    border-color: #65B5AB;
    box-shadow: 0 0 0 0.2rem rgb(255 211 36 / 50%);
}
.btn-outline-info {
    color: #65B5AB;
    border-color: #65B5AB;
}

a:hover {
    color: #65B5AB;
    text-decoration: none;
}
a {
    color: #65B5AB;
    text-decoration: none;
    background-color: transparent;
}
#for_numrows {
    padding: 10px;
    float: left;
    
}
button, select {
    text-transform: none;
    border-radius: 7px;
}
button, input {
    overflow: visible;
    border-radius: 10px;
    padding-top: 0;
    padding-right: 5px;
    padding-bottom: 0;
    padding-left: 10px;
    background-color: #65B5AB;
    border-color: #fff;
    color: #fff;
}
img {
    vertical-align: middle;
    border-style: none;
    object-fit: cover;
}
.img-fluid {
    max-width: 60px;
    height: 60px;
}
.color1 {
    background-color: #65B5AB;
}
body {
    margin: 0;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #65B5AB;
    text-align: left;
    background-color: #fff;
}
  .table {
    width: 100%;
    margin-bottom: 1rem;
    color: #65B5AB;
}       
          table {
                counter-reset: tableCount;     
            }
          
            .counterCell:before {              
                content: counter(tableCount); 
                counter-increment: tableCount; 
            }

          .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: white;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
          }

          .sidenav a {
            padding: 8px 0px 0px 32px;
            text-decoration: none;
            font-size: 14px;
            color: #000;
            display: block;
            transition: all 0.3s;
          }

          .sidenav a:hover {
            color: #3FAD80;
            border : 1px solid grey;
            border-radius: 20px;
            background-color: #F7F7F7;
          }

          .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 30px;
            margin-left: 50px;
          }
          #page
          {
              
          }
     
          #main {
            transition: margin-left .5s;
          }

          @media screen and (max-height: 450px) {
            .sidenav {
              padding-top: 15px;
            }
            .sidenav a {
              font-size: 18px;
            }
          }

          .left-corner{
            font-size:17px;
            cursor:pointer;
            position: absolute; 
            left: 10px;
          }

          .right-corner{
            font-size:17px;
            cursor:pointer;
            position: absolute; 
            right: 10px;
          }

          .shadow{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
          }

          .round10{
            border-radius: 7px;
          }

          .round20{
            border-radius: 20px;
          }
          
          .color{
            color : #3FAD80;
          }
          

          .hides{
            display : none;
          } 

          td{
            vertical-align : middle !important;
          }
          #for_numrows {
            padding: 10px;
            float: left;
          }
          #for_filter_by {
            padding: 10px;
            float: right;
          }
          #pagesControllers {
            display: block;
            text-align: center;
          }
        </style>
    </head>
    <body class="bg-light">
        <div id="mySidenav" class="sidenav round10 shadow">
          <a href="javascript:void(0)" class="closebtn p-1" onclick="closeNav()">&times;</a>
          <a href="{{ route('seller_home') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
          <hr />
          <a href="{{ route('seller_profile') }}"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
          <hr />
          <a href="{{ route('seller_travel_preneur') }}"><i class="fa fa-handshake-o" aria-hidden="true"></i> My TravelPreneur</a>
          <hr />
          <a href="{{ route('seller_location') }}"><i class="fa fa-location-arrow" aria-hidden="true"></i> Location</a>
          <hr />
          <a href="{{ route('seller_hotel') }}"><i class="fa fa-bed" aria-hidden="true"></i> Hotels</a>
          <hr />
          <a href="{{ route('seller_meal') }}"><i class="fa fa-cutlery" aria-hidden="true"></i> Meals</a>
          <hr />
          <a href="{{ route('seller_licensing_fees') }}"><i class="fa fa-id-card" aria-hidden="true"></i> Licensing Fees</a>
          <hr />
          <a href="{{ route('seller_midtrip') }}"><i class="fa fa-map" aria-hidden="true"></i> MidTrips</a>
          <hr />
          <a href="{{ route('seller_transfer') }}"><i class="fa fa-car" aria-hidden="true"></i> Transfer</a>
          <hr />
          <a href="{{ route('seller_trip') }}"><i class="fa fa-suitcase" aria-hidden="true"></i>️ Trip</a>
          <hr />
          <a href="{{ route('seller_offline_booking') }}"><i class="fa fa-calendar-o" aria-hidden="true"></i> Offline Booking</a>
          <hr />
          <a href="{{ route('seller_holiday') }}"><i class="fa fa-toggle-off" aria-hidden="true"></i> Operator Holiday</a>
          <hr />
          <a href="{{ route('payment_info') }}"><i class="fa fa-money" aria-hidden="true"></i> Payment Info</a>
          <hr />
          <a href="{{ route('seller_help') }}"><i class="fa fa-question" aria-hidden="true"></i> Help</a>
          <hr />
    
        </div>

        <div id="main" >
            <div class="card border shadow round10 p-4">
                <span style="margin-top: -20px" class="left-corner color border round10 p-1 bg-light" onclick="openNav()">&#9776; Menu</span>
                <span style="margin-top: -20px" class="right-corner color border round10 p-1 bg-light">
                  <a href="{{route('seller_logout')}}">Logout</a></span>
            </div>
        </div>
        <div class="card p-3 border round10 m-2 shadow">
                @yield('data')
            </div>

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        @stack('plugin')
        <script src="{{ asset('script/dataScript.js') }}"></script>
         <script src="{{ asset('script/callScript.js') }}"></script>
        <script>
        function openNav() {
          document.getElementById("mySidenav").style.width = "60%";
          document.getElementById("main").style.marginLeft = "0%";
        }

        function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
          document.getElementById("main").style.marginLeft= "0";
        }
        </script>
    </body>
</html>
