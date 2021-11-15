<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--<title>{{ config('app.name', 'Laravel') }}</title>-->
        <title>TouristTribe Home Page</title>
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/6917ab2b89.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ secure_asset('css/btn.css') }}" />
     
        
        <link rel="icon" href="{{ secure_asset('storage/public/d02a42d9cb3dec9320e5f550278911c7.jpg') }}">
        <link rel="icon" href="https://touristtribe.in/storage/public/d02a42d9cb3dec9320e5f550278911c7.jpg">
        <link rel="apple-touch-icon" href="{{ secure_asset('storage/public/d02a42d9cb3dec9320e5f550278911c7.jpg') }}">
        
        <!-- This site is optimized with the Yoast SEO plugin v16.3 - https://yoast.com/wordpress/plugins/seo/ -->
	
	<meta name="description" content="We agreegate tour operators across india to serve our user best tour package" >
	<link rel="canonical" href="{{url()->full()}}" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" >
	<meta property="og:title" content="TouristTribe" >
	<meta property="og:description" content="We agreegate tour operators across india to serve our user best tour package" >
	<meta property="og:url" content="{{url()->full()}}" >
	<meta property="article:publisher" content="https://www.facebook.com/touristtribeofficial" >
	<meta property="article:modified_time" content="2021-05-20T14:10:16+00:00" >
	<meta property="og:image" content="{{ secure_asset('storage/public/YyHZ5a7mS8a2OUSHmWOqPp2vpTekFTx1xHPAQgp1.jpeg') }}" >
	<meta property="og:image:width" content="985" >
	<meta property="og:image:height" content="578" >
	<meta name="twitter:card" content="summary_large_image" >
	<meta name="twitter:label1" content="Est. reading time">
	<meta name="twitter:data1" content="12 minutes">

	<!-- / Yoast SEO plugin. -->
        

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NH6SXTS');</script>

        <!-- End Google Tag Manager -->
        
<!--                TtTtTtTtTt    tttttt    tt      tt   tt  tt     tt tt tt  tt  tt  tt                                           -->
<!--                    Tt      tt      tt  tt      tt  tt    tt       tt         tt                                               -->
<!--                    Tt      tt	     tt tt      tt  tt tt          tt         tt                                               -->
<!--                    Tt      tt      tt  tt      tt  tt    tt       tt         tt                                               -->
<!--                    Tt        tttttt      tt  tt    tt      tt  tt tt tt      tt                                               -->

<!--                                                                      TtTtTtTtTt   tt  tt     tt tt tt    tttt    tt tt tt                                         -->
<!--                                                                          Tt      tt    tt       tt     tt    tt  tt                                               -->
<!--                                                                          Tt      tt  tt         tt     tt  tt    tt tt                                            -->
<!--                                                                          Tt      tt    tt       tt     tt    tt  tt                                               -->
<!--                                                                          Tt      tt      tt  tt tt tt  tt  tt    tt tt tt                                         -->
        <style>
        
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
a:hover {
    color: #65B5AB;
    text-decoration: none;
}
a {
    color: #65B5AB;
    text-decoration: none;
    background-color: transparent;
}
  img {
  object-fit: cover;
}

          body {
              font-family: 'Montserrat', serif !important;
              margin: 0px;
              padding: 0px;
          }

.dropdown-menu>li>a {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #65B5AB;
    white-space: nowrap;
}
footer {
  display: block;
  text-align: center;
}
.hero-image {
  background-image: url("{{ secure_asset('storage/public/90ac55a144ae52545a159daa36ff10fc.svg') }}");
  background-color: #defffb;
  height: 300px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  text-align: center;
  position: absolute;
  bottom: 10%;
 
  color: #65B5AB;
}

.jumbotron {
    padding: 2rem 1rem;
    margin-bottom: 2rem;
    background-color: #ebfaf8;
    border-radius: .3rem;
}
.card-footer {
    padding: .75rem 1.25rem;
    background-color: transparent;
    border-top: transparent;
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
            right: 0px;
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
            color : #65B5AB;
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
       <script data-ad-client="ca-pub-7706985969972564" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    </head>
    <body class="bg-light">
        <!-- The Modal -->
<div class="modal" id="home_filter">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="get">
				<div class="modal-header">
					<h4 class="modal-title">Filter</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">Location Served Areas</div>
						@foreach($data_served_areas as $index => $data_served_area)
							<div class="col-sm-3">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="location[]" value="{{ $index }}">{{ $data_served_area }}</label>
								</div>
							</div>
						@endforeach
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12">Gender</div>
						@foreach($genders as $index => $gender )
							<div class="col-sm-3">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="gender[]" value="{{ $index }}">{{ $gender }}</label>
								</div>
							</div>
						@endforeach
					</div>
					<div class="row">
						<div class="col-sm-12">Religions</div>
						@foreach($religions as $index => $religion )
							<div class="col-sm-3">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="religion[]" value="{{ $index }}">{{ $religion }}</label>
								</div>
							</div>
						@endforeach
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-sm" >Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
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
        <script src="{{ secure_asset('script/dataScript.js') }}"></script>
        <script src="{{ secure_asset('script/callScript.js') }}"></script>

        
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


        // function openNav() {
        //   document.getElementById("mySidenav").style.width = "70%";
        //   document.getElementById("main").style.marginLeft = "0%";
        // }

        // function closeNav() {
        //   document.getElementById("mySidenav").style.width = "0";
        //   document.getElementById("main").style.marginLeft= "0";
        // }
        </script>
        

    </body>
    
    <footer>
        <br><br><br><br><br>
        <div class="card border shadow round10 p-4">
        <div class="container">
  <p>	<i class="fa fa-copyright" aria-hidden="true"></i> TouristTribe 2021 <br> <a href="https://touristtribe.in/blog/contact-us/" target="_blank">Contact Us</a> <br><a href="https://touristtribe.in/blog/terms-and-conditions/" target="_blank">Terms & Conditions</a> | <a href="https://touristtribe.in/blog/privacy-policy/" target="_blank">Privacy Policy</a>
  <br>
  <a href="https://www.facebook.com/touristtribeofficial/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> </a>&nbsp;&nbsp;&nbsp;
  <a href="https://twitter.com/on_touristtribe" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> </a>&nbsp;&nbsp;&nbsp;
  <a href="https://www.instagram.com/touristtribe.official/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i> </a>&nbsp;&nbsp;&nbsp;
  <a href="https://www.linkedin.com/company/72641935/admin/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i> </a>&nbsp;&nbsp;&nbsp;
  <br> <img class="center" src="{{ secure_asset('storage/public/6ba408e34a2570d54dcc2b1c81a9a136.svg') }}" height="12px" width="auto"></p>
</div></div>

</footer>
</html>
