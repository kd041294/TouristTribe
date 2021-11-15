<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([env("ROUTE_PREFIX") => env("SELLER_URL")], function () {
    
    // Route::view('/login','Seller.login')->name('seller_login');
	// Route::view('/signup','Seller.signup')->name('seller_signup');

	/* UserControllers Start*/
	// Route::post('/signup_post','seller\UserActionsControllers@signup');
	// Route::post('/login_post','seller\UserActionsControllers@login');
	/* UserControllers End*/

	// New Login
	Route::get('/login', 'seller\UserActionsControllers@login_seller')->name('seller_login');
	Route::post('/login', 'seller\UserActionsControllers@login_seller');

	// New Signup
	Route::get('/signup', 'seller\UserActionsControllers@signup_seller')->name('signup_seller');
	Route::post('/signup', 'seller\UserActionsControllers@signup_seller');

	// OTP verification for seller
	Route::get('/verification', "seller\UserActionsControllers@verification")->name("verification_seller");
	Route::post('/verification', "seller\UserActionsControllers@verification");

	// Forgot Password for seller side
	Route::get("/forgot_password", "seller\UserActionsControllers@forgot_password")->name("forgot_password_seller");
	Route::post("/forgot_password", "seller\UserActionsControllers@forgot_password");

	Route::get("/forget_password_otp_verification", "seller\UserActionsControllers@forget_password_otp_verification")->name("forget_password_otp_verification_seller");
	Route::post("/forget_password_otp_verification", "seller\UserActionsControllers@forget_password_otp_verification");

	Route::group(['middleware' => ['tour_operator_login_check']], function () {
    	
    	Route::view('/','Seller.welcome')->name('seller_home');
		Route::view('/offline-booking','Seller.offlineBooking');
		Route::view('/profile','Seller.profile');
		Route::view('/help','Seller.help');
		
		/* Trip start */
		Route::get('/trip','seller\TripControllers@see')->name('seller_trip');
		Route::get('/create-trip','seller\TripControllers@location');
		Route::post('/create-trip-again','seller\TripControllers@send');
		Route::post('/trip_post','seller\TripControllers@add');
		Route::get('/edit_trip/{id}','seller\TripControllers@edit_trip')->name("edit_trip");
		Route::post('/edit_trip/{id}','seller\TripControllers@edit_trip');
		Route::get('/delete_trip/{id}','seller\TripControllers@delete');
		/* Trip Stop */

		/* Transfer Start */
		Route::get('/transfer','seller\TransferController@see')->name('seller_transfer');
		Route::view('/create-transfer','Seller.addTransfer');
		Route::post('/transfer_post','seller\TransferController@add');
		Route::get('/edit_transfer/{id}','seller\TransferController@edit_transfer')->name("edit_transfer");
		Route::post('/edit_transfer/{id}','seller\TransferController@edit_transfer');
		Route::get('/delete_transfer/{id}','seller\TransferController@delete');
		/* Transfer Stop */

		/* Midtrip  start */
		Route::get('/midtrip','seller\MidtripControllers@see')->name('seller_midtrip');
		Route::view('/create-midtrip','Seller.addMidtrip');
		Route::get('/create-midtrip','seller\MidtripControllers@location');
		Route::post('/midtrip_post','seller\MidtripControllers@add');
		Route::get('/edit_midtrip/{id}','seller\MidtripControllers@edit_midtrip')->name("edit_midtrip");
		Route::post('/edit_midtrip/{id}','seller\MidtripControllers@edit_midtrip');
		Route::get('/delete_midtrip/{id}','seller\MidtripControllers@delete');
		/* Midtrip  Stop */

		/* Meal  Start */
		Route::view('/create-meal','Seller.addMeal');
		Route::get('/meal','seller\MealControllers@see')->name('seller_meal');
		Route::get('/create-meal','seller\MealControllers@location');
		Route::post('/meal_post','seller\MealControllers@add');
		Route::get('/delete_meal/{id}','seller\MealControllers@delete');
		Route::get('/edit_meal/{id}','seller\MealControllers@edit_meal')->name("edit_meal");
		Route::post('/edit_meal/{id}','seller\MealControllers@edit_meal');

		/* Meal  Stop */
		
		/* Hotel Start */
		Route::get('/hotel','seller\HotelControllers@see')->name('seller_hotel');
		Route::get('/create-hotel','seller\HotelControllers@location');
		Route::post('/hotel_post','seller\HotelControllers@add');
		Route::get('/delete_hotel/{id}','seller\HotelControllers@delete');
		Route::get('/edit_hotel/{id}','seller\HotelControllers@edit_hotel')->name("edit_hotel");
		Route::post('/edit_hotel/{id}','seller\HotelControllers@edit_hotel');
		/* Hotel Stop */

		/* Location Start */
		Route::view('/create-location','Seller.addLocation');
		Route::get('/location','seller\LocationControlers@show')->name('seller_location');
		Route::post('/location_post','seller\LocationControlers@add');
		Route::get('/delete_location/{id}','seller\LocationControlers@delete');
		Route::get('/edit_location/{id}','seller\LocationControlers@edit_location')->name("edit_location");
		Route::post('/edit_location/{id}','seller\LocationControlers@edit_location');
		/* Location Stop */

		// payment info
		Route::get('/payment_info', "seller\PaymentController@payment_info")->name("payment_info");
		Route::get('/payment_info_edit', "seller\PaymentController@payment_info_edit")->name("payment_info_edit");
		Route::post('/payment_info_edit', "seller\PaymentController@payment_info_edit");
		Route::get('/payment_info_delete', "seller\PaymentController@payment_info_delete")->name('payment_info_delete');
		

		Route::get('/logout',function(){
			session()->forget('tour_operator_data');
			return redirect()->route('seller_login');
		})->name("seller_logout");

	});
});

Route::prefix('qna')->group(function(){
	Route::view('/','Qna.welcome');	
});

Route::group([env("ROUTE_PREFIX") => env("ADMIN_URL")], function(){

	Route::get('/login', 'admin\AdminController@login')->name('admin_login');
	Route::post('/login', 'admin\AdminController@login');

	Route::get('/admin_otp_verification', 'admin\AdminController@admin_otp_verification')->name('admin_otp_verification');
	Route::post('/admin_otp_verification', 'admin\AdminController@admin_otp_verification');

	Route::group(['middleware' => ['admin_login_check']], function () {
		Route::get('/', 'admin\HomeController@home')->name('admin_home');

		Route::get('/seller_account', 'admin\SellerAccountController@seller_account')->name('seller_account');

		Route::post('/seller_account_toggle', 'admin\SellerAccountController@seller_account_toggle')->name('seller_account_toggle');

		Route::get('/booking_details', 'admin\BookingDetailsController@booking_details')->name('booking_details');
		
		Route::post('/booking_details_account_hit', 'admin\BookingDetailsController@account_hit')->name('booking_details_account_hit');

		Route::get('/admin_payment_details', 'admin\PaymentDetailsController@payment_details')->name('admin_payment_details');

		Route::post('/payment_details_transaction_id', 'admin\PaymentDetailsController@add_transaction_id')->name('payment_details_transaction_id');

		Route::get('/admin_cashback_details', 'admin\CashbackDetailsController@cashback_details')->name('admin_cashback_details');

		Route::get('/logout',function(){
			session()->forget('admin_data');
			return redirect()->route('admin_login');
		});
	});

	

	// Route::view('/','adam.admin_panel')->name('admin_home');	
});

//echo "<img src='".asset('storage/public/8jhrnhRdfO5Kdx1k7uKKyYWCIB60YJckbrC68F8R.jpeg')."'/>";
//return Storage::download('public/8jhrnhRdfO5Kdx1k7uKKyYWCIB60YJckbrC68F8R.jpeg');

// Adding Sitemap for the Website
Route::get('/sitemap', function(){
   return Response::view('sitemap')->header('Content-Type', 'application/xml');
});

Route::get('/setroutes', function () {
  Artisan::call('storage:link');
});
Route::get('/','user\HomeControllers@see')->name('user_home');

Route::get('/ongoing_trip', 'user\HomeControllers@ongoing_trip')->name('ongoing_trip');

/*User Controller start*/
Route::get('/signup', 'user\userControllers@signup')->name('signup');
Route::post('/signup', 'user\userControllers@signup');
// Route::view('/signup','User.signup')->name('signup');
// Route::post('/sinup/sinup_data','user\userControllers@create');

Route::get('/login', "user\userControllers@login")->name('login');
Route::post('/login', "user\userControllers@login");
// Route::view('/login','User.login')->name('login');	
// Route::post('login/login_data','user\userControllers@check');
Route::get('/verification', "user\userControllers@verification")->name("verification");
Route::post('/verification', "user\userControllers@verification");

Route::get("/forgot_password", "user\userControllers@forgot_password")->name("forgot_password");
Route::post("/forgot_password", "user\userControllers@forgot_password");

Route::get("/forget_password_otp_verification", "user\userControllers@forget_password_otp_verification")->name("forget_password_otp_verification");
Route::post("/forget_password_otp_verification", "user\userControllers@forget_password_otp_verification");

Route::get('/trip_details/{loc}','user\TripControllers@see');

Route::get('trip_details/trip_booking/{id}','user\BookingController@booking');

Route::get('trip_details/family_booking/{id}','user\BookingController@familyBooking');

Route::get('/send_mails','user\BookingController@email');

Route::get('/payment/{id}','user\BookingController@payment');

Route::post('/payment-success','user\BookingController@success');

Route::post('/payment-fail','user\BookingController@fail');

Route::get('/logout',function(){
			session()->forget('sessionId');
			return redirect('/');
		});

