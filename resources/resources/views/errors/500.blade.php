<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 Error</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/6917ab2b89.css">
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

</head>

<body>
    <div class="container mt-5 pt-5">
        <center><H1><span class="color border round10 p-1">
	  		<img src="{{ secure_asset('storage/public/YyHZ5a7mS8a2OUSHmWOqPp2vpTekFTx1xHPAQgp1.jpeg') }}" alt="TouristTribe Logo" class="rounded-circle" width="45px" height="45px"><a href="{{secure_asset('/')}}">TouristTribe</a></span>
            </H1></center><br><br><br><br><br><br><br><br>
        <div class="alert alert-danger text-center">
            <h2><i class="fa fa-exclamation-circle " aria-hidden="true"></i></h2>
            <p>Oops! Something is wrong.</p>
            <p class="display-5">Please, <a href="#" onclick="history.go(-1)">Go Back</a>.</p>
        </div>
    </div>
</body>

</html>
   