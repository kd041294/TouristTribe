<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} seller central</title>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
        <meta name="description" content="How to get customers for my travel agency is only solution, List your tour packages for free here." />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
    <link rel="icon" href="https://touristtribe.in/storage/public/d02a42d9cb3dec9320e5f550278911c7.jpg" type="image/gif">
    <style type="text/css">
    	    	* {
            font-family: 'Montserrat', serif !important;
            margin: 0;
            padding: 0;
        }	
    	.border10 {
    		border-radius: 10px;
    	}
    	.shadow{
    		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    	}
    	.carousel-inner img {
    width: 100%;
    height: 100%;
  }
    
    </style>
</head>
<body>

	<div class="container mt-3">
		<div class="card p-5 border border10 shadow">
		    <!--<img class="center" src="https://touristtribe.in/storage/public/32108f05212b892d201a86bc509997d7.gif" alt="Tour operator oppertunity">-->
		    <div class="container">
  <div id="demo" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
      <li data-target="#myCarousel" data-slide-to="5"></li>
      <li data-target="#myCarousel" data-slide-to="6"></li>
    </ul>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="carousel-item active">
        <img src="https://touristtribe.in/storage/public/41aa9fee3ed19dcd9f6a3d0233c766c1.png" alt="listing tour packages on touristtribe- benifit" style="width:100%;">
        
      </div>
      <div class="carousel-item">
        <img src="https://touristtribe.in/storage/public/3b5821df9ec4265abebbe2deb8ec2ff7.png" alt="listing tour packages on touristtribe- benifit" style="width:100%;">
        
      </div>

      <div class="carousel-item">
        <img src="https://touristtribe.in/storage/public/fb68ade6c7114a1672aaba45354bcddb.png" alt="listing tour packages on touristtribe- benifit" style="width:100%;">
        
      </div>
    <div class="carousel-item">
        <img src="https://touristtribe.in/storage/public/421b37b227231507178f178a03888d27.png" alt="listing tour packages on touristtribe- benifit" style="width:100%;">
        
      </div>
      <div class="carousel-item">
        <img src="https://touristtribe.in/storage/public/efd98aec27c5cf25989ff8baa6ca7169.png" alt="listing tour packages on touristtribe- benifit" style="width:100%;">
        
      </div>
    
    <div class="carousel-item">
        <img src="https://touristtribe.in/storage/public/e5e18d1178c9612779311c9016839bcf.png" alt="listing tour packages on touristtribe- benifit" style="width:100%;">
        
      </div>
  <div class="carousel-item">
        <img src="https://touristtribe.in/storage/public/5e616022ab3d7bb27d22014976498737.png" alt="listing tour packages on touristtribe- benifit" style="width:100%;">
        
      </div>
  </div>
    

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
  </div>

			@if($error)
				<div class="alert alert-danger">{{ $error }}</div>
			@endif
			<div class="card-body border10 shadow bg-light">
				<form method="post" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>Enter name</label>
						<input type="text" class="form-control border10" name="name" placeholder="Enter name" value="{{ old('name') }}" required>
					</div>
					<div class="form-group">
						<label>Enter mobile number</label>
						<input type="text" class="form-control border10" name="mobile" placeholder="Enter mobile number" value="{{ old('mobile') }}" required>
					</div>
					<div class="form-group">
						<label>Enter email id</label>
						<input type="text" class="form-control border10" name="email_id" placeholder="Enter email id" value="{{ old('email_id') }}" required>
					</div>
					<div class="form-group">
						<label>Enter company name</label>
						<input type="text" class="form-control border10" name="company_name" placeholder="Enter company name" value="{{ old('company_name') }}" required>
					</div>
					<div class="form-group">
						<label>Enter adhar number</label>
						<input type="text" class="form-control border10" name="adhar_number" placeholder="Enter adhar number" value="{{ old('adhar_number') }}" required>
					</div>
					<div class="form-group">
						<label>Enter gst</label>
						<input type="text" class="form-control border10" name="gst" placeholder="Enter gst" value="{{ old('gst') }}">
					</div>
					<div class="form-group">
						<label>Enter password</label>
						<input type="password" class="form-control border10" name="password" placeholder="Enter password" required>
					</div>
					<!--<div class="form-group">-->
					<!--	<label>Enter password again</label>-->
					<!--	<input type="password" class="form-control border10" name="confirm_password" placeholder="Enter again password">-->
					<!--</div>-->
					<div class="form-group">
						<label>Upload your logo</label>
						<input type="file" class="form-control border10" name="logo" placeholder="Enter logo">
					</div>
					<div class="text-center">
						<input type="submit" name="submit" class="btn bttn bttn-float bttn-md round20 color1 shadow">
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>