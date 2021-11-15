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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="{{ asset('css/btn.css') }}" />

        <link rel="icon" href="http://touristtribe.in/storage/public/favicon.jpg" type="image/gif"/>

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NH6SXTS');</script>

        <!-- End Google Tag Manager -->
        
        <style>
          * {
              font-family: 'Montserrat', serif !important;
              margin: 0px;
              padding: 0px;
          }

          .card_new {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: auto;
            height: auto;
            margin: 3px;
            padding: 5px;
          }
        

          .card_new:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.7);
            
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
            padding-top: 50px;
          }

          .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
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
            font-size: 36px;
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
              font-size: 14px;
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
        @yield('menu')
        <div class="container">
          @yield('data')
          
        </div>
        <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NH6SXTS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="{{ asset('script/dataScript.js') }}"></script>
        <script src="{{ asset('script/callScript.js') }}"></script>

        
        <script>
          $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
          });
          $('#example').popover({
              placement: 'left',
              html: true,
              content: function() {
                  return '<a href="#" id="example2" data-toggle="popover" data-placement="left" class="title1">Location Served Areas</a><br><a href="#" id="example3" data-toggle="popover" data-placement="left" class="title1">Gender</a><br><a href="#" id="example4" data-toggle="popover" data-placement="left" class="title2">Religious</a>';
              },
          });
          $('#example2').popover({
            placement: 'left',
            html: true,
            content: function() {
              return '<a href="#" id="example2" data-toggle="popover" data-placement="left" class="title1">Location Served Areas</a><br><a href="#" data-toggle="popover" data-placement="left" class="title1">Gender</a>';
            }
          })


        function openNav() {
          document.getElementById("mySidenav").style.width = "70%";
          document.getElementById("main").style.marginLeft = "0%";
        }

        function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
          document.getElementById("main").style.marginLeft= "0";
        }
        </script>
    </body>
</html>
