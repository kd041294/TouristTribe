<!DOCTYPE html>
<html>
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
    	a {
    color: #65B5AB;
    text-decoration: none;
    background-color: transparent;
}
    </style>
</head>
<body class="bg-light">
	
	<div class="container mt-3">
		<div class="card p-5 border border10 shadow">
			@if($error)
				<div class="alert alert-danger">{{ $error }}</div>
			@endif
			<div class="card-body border10 shadow bg-light">
                <x-message/>
				<form method="post">
                    @csrf
					<div class="form-group">
						<label>Enter email id</label>
						<input type="text" class="form-control border10" name="email_id" value="{{ old('email_id') }}" placeholder="Enter email id" required>
					</div>
					<div class="form-group">
						<label>Enter password</label>
						<input type="password" class="form-control border10" name="password" placeholder="Enter password" required>
					</div>
					<div class="text-center">
						<input type="submit" name="submit" class="btn bttn bttn-float bttn-md round20 color1 shadow">
					</div>
				</form>
			</div>
			<span class="mt-3">If your are not register then <a href="{{ route('signup_seller') }}">click here</a><a class="float-right" href="{{ route('forgot_password_seller') }}">Forgot Password</a></span>
			
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