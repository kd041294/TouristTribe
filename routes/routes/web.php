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
    	
    	// Route::view('/','Seller.welcome')->name('seller_home');
		Route::get('/', 'seller\WelcomeController@welcome')->name('seller_home');
		Route::view('/offline-booking','Seller.offlineBooking')->name('seller_offline_booking');
		// Route::view('/profile','Seller.profile')->name('seller_profile');
		Route::view('/help','Seller.help')->name('seller_help');
	
		Route::get('/profile', 'seller\ProfileController@profile')->name('seller_profile');
		
		Route::get('/my_travel_preneur', 'seller\TravelPreneurController@travel_preneur')->name('seller_travel_preneur');
		Route::get('/travel_preneur_create', 'seller\TravelPreneurController@travel_preneur_create')->name('seller_travel_preneur_create');
		Route::post('/travel_preneur_create', 'seller\TravelPreneurController@travel_preneur_create');
		Route::get('/travel_preneur_edit/{id}', 'seller\TravelPreneurController@travel_preneur_edit')->name('seller_travel_preneur_edit');
		Route::post('/travel_preneur_edit/{id}', 'seller\TravelPreneurController@travel_preneur_edit');
		Route::get('/travel_preneur_view/{id}', 'seller\TravelPreneurController@travel_preneur_view')->name('seller_travel_preneur_view');
		Route::get('/travel_preneur_delete/{id}', 'seller\TravelPreneurController@travel_preneur_delete')->name('seller_travel_preneur_delete');
		

		Route::get('/holiday', "seller\HolidayController@holiday")->name('seller_holiday');
		
		Route::get('/add_tour_operator_holiday', "seller\HolidayController@add_holiday")->name("add_tour_operator_holiday");
		Route::post('/add_tour_operator_holiday',"seller\HolidayController@add_holiday");

        /*Licensing Fees*/
		Route::get('/licensing_fees', 'seller\LicenseController@licensing_fees')->name('seller_licensing_fees');
		Route::get('/licensing_fees_create', 'seller\LicenseController@create')->name('create_licensing_fees');
		Route::post('/licensing_fees_create', 'seller\LicenseController@create');
		
		/* Trip start */
		Route::get('/trip','seller\TripControllers@see')->name('seller_trip');
		Route::get('/create-trip','seller\TripControllers@location');
		Route::post('/create-trip-again','seller\TripControllers@send');
		Route::post('/trip_post','seller\TripControllers@add');
		Route::get('/edit_trip/{id}','seller\TripControllers@edit_trip')->name("edit_trip");
		Route::post('/edit_trip/{id}','seller\TripControllers@edit_trip');
		Route::get('/delete_trip/{id}','seller\TripControllers@delete')->name('seller_delete_trip');
		/* Trip Stop */

		/* Transfer Start */
		Route::get('/transfer','seller\TransferController@see')->name('seller_transfer');
		Route::view('/create-transfer','Seller.addTransfer');
		Route::post('/transfer_post','seller\TransferController@add');
		Route::get('/edit_transfer/{id}','seller\TransferController@edit_transfer')->name("edit_transfer");
		Route::post('/edit_transfer/{id}','seller\TransferController@edit_transfer');
		Route::get('/delete_transfer/{id}','seller\TransferController@delete')->name('seller_delete_transfer');
		/* Transfer Stop */

		/* Midtrip  start */
		Route::get('/midtrip','seller\MidtripControllers@see')->name('seller_midtrip');
		Route::view('/create-midtrip','Seller.addMidtrip');
		Route::get('/create-midtrip','seller\MidtripControllers@location');
		Route::post('/midtrip_post','seller\MidtripControllers@add');
		Route::get('/edit_midtrip/{id}','seller\MidtripControllers@edit_midtrip')->name("edit_midtrip");
		Route::post('/edit_midtrip/{id}','seller\MidtripControllers@edit_midtrip');
		Route::get('/delete_midtrip/{id}','seller\MidtripControllers@delete')->name('seller_delete_midtrip');
		/* Midtrip  Stop */

		/* Meal  Start */
		Route::view('/create-meal','Seller.addMeal');
		Route::get('/meal','seller\MealControllers@see')->name('seller_meal');
		Route::get('/create-meal','seller\MealControllers@location');
		Route::post('/meal_post','seller\MealControllers@add');
		Route::get('/delete_meal/{id}','seller\MealControllers@delete')->name('seller_delete_meal');
		Route::get('/edit_meal/{id}','seller\MealControllers@edit_meal')->name("edit_meal");
		Route::post('/edit_meal/{id}','seller\MealControllers@edit_meal');

		/* Meal  Stop */
		
		/* Hotel Start */
		Route::get('/hotel','seller\HotelControllers@see')->name('seller_hotel');
		Route::get('/create-hotel','seller\HotelControllers@location');
		Route::post('/hotel_post','seller\HotelControllers@add');
		Route::get('/delete_hotel/{id}','seller\HotelControllers@delete')->name('seller_delete_hotel');
		Route::get('/edit_hotel/{id}','seller\HotelControllers@edit_hotel')->name("edit_hotel");
		Route::post('/edit_hotel/{id}','seller\HotelControllers@edit_hotel');
		/* Hotel Stop */

		/* Location Start */
		Route::view('/create-location','Seller.addLocation');
		Route::get('/location','seller\LocationControlers@show')->name('seller_location');
		Route::post('/location_post','seller\LocationControlers@add');
		Route::get('/delete_location/{id}','seller\LocationControlers@delete')->name('seller_delete_location');
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
		
		Route::get('/travel_preneur_users_account', 'admin\TravelPreneurController@travel_preneur_users_account')->name('travel_preneur_users_account');

		Route::post('/travel_preneur_users_toggle', 'admin\TravelPreneurController@travel_preneur_users_toggle')->name('travel_preneur_users_toggle');

		Route::get('/booking_details', 'admin\BookingDetailsController@booking_details')->name('booking_details');
		
		Route::post('/booking_details_account_hit', 'admin\BookingDetailsController@account_hit')->name('booking_details_account_hit');

		Route::get('/admin_payment_details', 'admin\PaymentDetailsController@payment_details')->name('admin_payment_details');

		Route::post('/payment_details_transaction_id', 'admin\PaymentDetailsController@add_transaction_id')->name('payment_details_transaction_id');

		Route::get('/admin_cashback_details', 'admin\CashbackDetailsController@cashback_details')->name('admin_cashback_details');

        Route::get('/admin_voucher', 'admin\VoucherController@voucher')->name('admin_voucher');

		Route::post('/admin_voucher_toggle', 'admin\VoucherController@voucher_toggle')->name('admin_voucher_toggle');

		Route::get("/admin_add_voucher", "admin\VoucherController@add_voucher")->name('admin_add_voucher');
		Route::post("/admin_add_voucher", "admin\VoucherController@add_voucher");

		Route::get('/logout',function(){
			session()->forget('admin_data');
			return redirect()->route('admin_login');
		})->name('admin_logout');
	});

	

	// Route::view('/','adam.admin_panel')->name('admin_home');	
});

Route::group([env("ROUTE_PREFIX") => env("AFFILIATE_MARKETING")], function(){
	Route::get('/signup', 'affiliate_marketing\AuthenticationController@signup')->name('affiliate_marketing_signup');
	Route::post('/signup', 'affiliate_marketing\AuthenticationController@signup');

	Route::get('/login', 'affiliate_marketing\AuthenticationController@login')->name('affiliate_marketing_login');
	Route::post('/login', 'affiliate_marketing\AuthenticationController@login');

	Route::get('/affiliate_marketing_verification', 'affiliate_marketing\AuthenticationController@verification')->name('affiliate_marketing_verification');
	Route::post('/affiliate_marketing_verification', 'affiliate_marketing\AuthenticationController@verification');

	Route::group(['middleware' => ['affiliate_marketing_user_check']], function () {
		Route::get('/', 'affiliate_marketing\HomeController@home')->name('affiliate_marketing_home');

		Route::get('/logout',function(){
			session()->forget('sessionAffiliateMarketingUserData');
			
			return redirect()->route('affiliate_marketing_login');
		})->name('affiliate_marketing_logout');
	});

	

});

Route::group([env("ROUTE_PREFIX") => env("TRAVEL_PRENEUR")], function(){
    
    Route::get('/welcome', 'travel_preneur\WelcomeTravelPreneurController@welcome')->name('travel_preneur_welcome');

	Route::get('signup', 'travel_preneur\AuthTravelPreneurController@signup')->name('travel_preneur_signup');
	Route::post('signup', 'travel_preneur\AuthTravelPreneurController@signup');

	Route::get('login', 'travel_preneur\AuthTravelPreneurController@login')->name('travel_preneur_login');
	Route::post('login', 'travel_preneur\AuthTravelPreneurController@login');

	Route::get('otp_verification', 'travel_preneur\AuthTravelPreneurController@verification')->name('travel_preneur_verification');
	Route::post('otp_verification', 'travel_preneur\AuthTravelPreneurController@verification');

	Route::get('forgot_password', 'travel_preneur\AuthTravelPreneurController@forgot_password')->name('travel_preneur_forgot_password');
	Route::post('forgot_password', 'travel_preneur\AuthTravelPreneurController@forgot_password');

	Route::get("/forget_password_otp_verification", "travel_preneur\AuthTravelPreneurController@forgot_password_otp_verification")->name("travel_preneur_forgot_password_otp_verification");
	Route::post("/forget_password_otp_verification", "travel_preneur\AuthTravelPreneurController@forgot_password_otp_verification");
	
	Route::group(['middleware' => ['travel_preneur_user_check']], function () {
		Route::get('/', 'travel_preneur\HomeController@home')->name('travel_preneur_home');

		Route::get('/logout',function(){
			session()->forget('user_data');
			
			return redirect()->route('travel_preneur_login');
		})->name('travel_preneur_logout');
	});

	
});

Route::group([env("ROUTE_PREFIX") => env("COMP_URL")], function(){
	Route::get("/", 'user\HomeControllers@see');
	Route::get('/trip_details/{loc}','user\TripControllers@seeComp');
	Route::get('trip_details/trip_booking/{id}/for-{nop}-people/{nor}-room/{bt}-bed-type/for-{nod}-days/{trip_date}/{trip_price}/','user\BookingController@bookingComp');
	Route::get('trip_details/family_booking/{id}/for-{nop}-people/{nor}-room/{bt}-bed-type/for-{nod}-days/{trip_date}/','user\BookingController@familyBookingComp');
	Route::get('/payment/{id}','user\BookingController@paymentComp');
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

Route::get('trip_details/trip_booking/{id}/for-{nop}-people/{nor}-room/{bt}-bed-type/for-{nod}-days/{trip_date}/{trip_price}/','user\BookingController@booking')->name('trip_booking');



Route::post('trip_details/trip_booking/{id}','user\BookingController@booking');




Route::get('trip_details/family_booking/{id}/for-{nop}-people/{nor}-room/{bt}-bed-type/for-{nod}-days/{trip_date}/','user\BookingController@familyBooking');

Route::get('/send_mails','user\BookingController@email');
Route::get('/send_mails','user\userController@email');

Route::get('/payment/{id}','user\BookingController@payment');

Route::post('/payment-success','user\BookingController@success');

Route::post('/payment-fail','user\BookingController@fail');

Route::get('/logout',function(){
			session()->forget('sessionId');
			return redirect('/');
})->name('logout');

