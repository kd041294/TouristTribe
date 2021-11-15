<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >

        <link rel="stylesheet" href="{{ asset('css/btn.css') }}" />
    
        <link rel="icon" href="http://touristtribe.in/storage/public/favicon.jpg" type="image/gif" />

       
        <style>
          * {
              font-family: 'Montserrat', serif !important;
              margin: 0;
              padding: 0;
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
          .color1{
            background-color: #3fad80;
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
          <a href="{{ route('seller_home') }}">🏠 Home</a>
          <hr />
          <a href="{{ route('seller_profile') }}">👨 My Profile</a>
          <hr />
          <a href="{{ route('seller_location') }}">🗾 Location</a>
          <hr />
          <a href="{{ route('seller_hotel') }}">🏢 Hotels</a>
          <hr />
          <a href="{{ route('seller_meal') }}">🥘 Meals</a>
          <hr />
          <a href="{{ route('seller_licensing_fees') }}">Licensing Fees</a>
          <hr />
          <a href="{{ route('seller_midtrip') }}">📍 MidTrips</a>
          <hr />
          <a href="{{ route('seller_transfer') }}">🚗 Transfer</a>
          <hr />
          <a href="{{ route('seller_trip') }}">🏞️ Trip</a>
          <hr />
          <a href="{{ route('seller_offline_booking') }}">📑 Offline Booking</a>
          <hr />
          <a href="{{ route('seller_holiday') }}">Operator Holiday</a>
          <hr />
          <a href="{{ route('payment_info') }}">Payment Info</a>
          <hr />
          <a href="{{ route('seller_help') }}">🆘 Help</a>
          <hr />
    
        </div>

        <div id="main" >
            <div class="card border shadow round10 p-4">
                <span style="margin-top: -20px" class="left-corner color border round10 p-1 bg-light" onclick="openNav()">&#9776; open</span>
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
