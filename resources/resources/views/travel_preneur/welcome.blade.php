@extends('travel_preneur.layouts.welcomePage')


@section('menu')
	<div id="main" >
	  <div class="card border shadow round10 p-3">
	  	<span>
	  		<img src="{{ asset('storage/public/YyHZ5a7mS8a2OUSHmWOqPp2vpTekFTx1xHPAQgp1.jpeg') }}" class="rounded-circle" width="25px" height="25px">
			TouristTribe TravelPreneur
		</span>
	    <span class="right-corner color border bg-light">
	      <a class="btn btn-outline-info" href="{{ route('travel_preneur_signup') }}">Signup</a> 
          <a class="btn btn-outline-info" href="{{ route('travel_preneur_login') }}">Login</a>
	    </span>
	  </div>
	</div>
@endsection

@section('data')
    <div class="mt-4">
        <img class="responsive " src="{{ url('travel_preneur_background.jpg') }}">
        <h1 class="text_image">Hey Travelpreneur</h1>
    </div>
    <hr>
    <div class="container mt-4">
        <div class="row card_new">
            <div class="col-sm-6">
                <img class="responsive " src="{{ url('tp_4.jpg') }}">
            </div>
            <div class="col-sm-6" style="text-align:center;">
                <h2 class="bold_text mt-3">Start Your Business</h2>
                <h2 class="bold_text">Without Any</h2>
                <h2 class="bold_text">Degree & Investment</h2><br>
                <p>We TouristTribe offering you an opportunity to start your own business. With the help of tech, you can operate this business from anywhere. We'll be providing you training so you don't have to need any school degree. You just have to have local language, professionalism, and enthusiasm.</p>
            </div>
        </div>
    </div><hr>

    <div class="container mt-4">
        <div class="row card_new">
            <div class="col-sm-6" style="text-align:center;">
                <h2 class="bold_text mt-3">Anyone Can Start,</h2>
                <h2 class="bold_text">Any Sex, Age</h2>
                <h2 class="bold_text">But Should Have Technical Knowledge.</h2><br>
                <p>Don't you have a job, no worries just join our community, no matter your age, degree. As we know the quote "Practice makes a man perfect." So, with us, we'll be hosting regular small updates, with following some steps you can be your Boss.</p>
            </div>
            <div class="col-sm-6">
                <img class="responsive " src="{{ url('tp_6.jpg') }}">
            </div>
        </div>
    </div><hr>

    <div class="container mt-4">
        <div class="row card_new">
            <div class="col-sm-6">
                <img class="responsive " src="{{ url('tp_5.jpg') }}">
            </div>
            <div class="col-sm-6" style="text-align:center;">
                <h2 class="bold_text mt-3">What We Provide ?</h2>
                <h3>Nation Wide Platform,</h3>
                <h3>Brand Value</h3><br>
                <p>We are a tech company based in Kolkata, we give service nationwide. So, you can hover over the internet and get all of our all facilities. Also, you are getting a brand value that you can offer to folks, no need for you to marketing. Here is a bonus the first 100 TravelPreneur will get one free ticket to travel around the nation..</p>
            </div>
        </div>
    </div><hr>

    <div class="container mt-4">
        <div class="row card_new">
            <div class="col-sm-6" style="text-align:center;">
                <h2 class="bold_text mt-3">Maximize Your Income</h2>
                <h2>Have A Look Into It</h2><br>
                <p>Here we are not bounding any limit for you to make money. So the number of relations you manage is directly proportional to making money.Cheers!
                Sounds interesting to know more call us at 8479953731. Or, you can <b>signup now.</b></p>
            </div>
            <div class="col-sm-6">
                <img class="responsive " src="{{ url('tp_7.jpg') }}">
            </div>
        </div>
    </div><hr>

    <div class="container mt-4">
        <div class="row card_new">
            <div class="col-sm-6">
                <img class="responsive " src="{{ url('tp_1.jpg') }}">
            </div>
            <div class="col-sm-6" style="text-align:center;">
                <h2 class="bold_text mt-3">Yearly Free Trips</h2>
                <h3>Foreign & Indian</h3><br>
                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. In publishing and graphic design.</p>
            </div>
        </div>
    </div><hr>

    <div class="container card_new mt-4">
        <h2 class="bold_text mt-3" style="text-align:center;">Profit Chart</h2><br>
            <img class="responsive_new center" src="{{ url('travel_preneur_profit_2.jpeg') }}">
    </div><hr>

    <div class="container card_new mt-4">
        <h2 class="bold_text mt-3" style="text-align:center;">Responsibilities</h2><br>
        <div class="row">
            <div class="col-sm-6 offset-sm-3 p-3">
                <h5> 1) Contact your nearest tour operator.</h5>
                <h5> 2) Register them on our account with your ID.</h5>
                <h5> 3) Put tour packages on their behalf.</h5>
                <h5> 4) Make money.</h5>
                <br>
            </div>
        </div>
    </div><hr>

    <div class="container mt-2 mb-3">
		<div class="col-sm-6 offset-sm-3">
			<div class="card mt-5 border shadow round10">
				<div class="card-header" style="text-align:center;">
				<h4>Signup</h4>
				</div>
				
				<div class="card-body">
					@if ($error)
						<div class="alert alert-danger">{{ $error }}</div>
					@endif
					@if ($message)
						<div class="alert alert-success">{{ $message }}</div>
					@endif
					<form method="post" action="{{ route('travel_preneur_signup') }}" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
					<label>Name</label>
					<input
					type="text" name="user_name" value="{{ old('user_name') }}" class="form-control" required
					/>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input
					type="email" name="email" value="{{ old('email') }}"  class="form-control" required
					/>
				</div>
                <div class="form-group">
					<label>Aadhar No.</label>
					<input
					type="text" name="aadhar_no" value="{{ old('aadhar_no') }}"  class="form-control" required
					/>
				</div>
                <div class="form-group">
					<label>Aadhar Pic</label>
					<input type="file" name="aadhar_pic" class="form-control"/>
				</div>
				<div class="form-group">
					<label>Phone Number</label>
					<input type="number" name="phone" class="form-control" value="{{ old('phone') }}" required/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input
					type="password" name="password" class="form-control" required/>
				</div>
				<div class="text-center">
					<input type="submit" value="Submit" class="btn btn-primary btn-block">
				</div>
					</form>
				</div> 
			</div>
		</div>
    </div>
    

@endsection