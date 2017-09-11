<?php

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

Route::get('/', 'PagesController@home');
Route::get('/home', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'TicketsController@create');
Route::get('/tickets', 'TicketsController@index');
Route::get('/ticket/{slug?}', 'TicketsController@show');
Route::get('/ticket/{slug?}/edit','TicketsController@edit');
Route::get('/users/register', 'Auth\RegisterController@showRegistrationForm');
Route::get('/users/logout', 'Auth\LoginController@logout');
Route::get('/users/login', 'Auth\LoginController@showLoginForm');
Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'), function () {
    Route::get('/users', [ 'as' => 'admin.user.index', 'uses' => 'UsersController@index']);
    Route::get('roles', 'RolesController@index');
    Route::get('roles/create', 'RolesController@create');
    Route::get('users/{id?}/edit', 'UsersController@edit');
    Route::get('/', 'PagesController@home');
    Route::get('posts', 'PostsController@index');
    Route::get('posts/create', 'PostsController@create');
    Route::get('posts/{id?}/edit', 'PostsController@edit');
    Route::get('categories', 'CategoriesController@index');
    Route::get('categories/create', 'CategoriesController@create');
    Route::get('dashboard', 'PagesController@dashboard');

    Route::post('roles/create', 'RolesController@store');
    Route::post('users/{id?}/edit','UsersController@update');
    Route::post('posts/create', 'PostsController@store');
    Route::post('posts/{id?}/edit','PostsController@update');
    Route::post('categories/create', 'CategoriesController@store');
});
Route::middleware(['member'])->group(function () {
    Route::get('users/profile', 'UsersController@profile');
    //Route::get('users/profile/edit/{id?}', 'UsersController@update_profile');
    Route::get('users/settings', 'UsersController@settings');

    Route::post('users/settings', 'UsersController@update');

    Route::get('/checkout', 'CheckoutController@index');

    Route::post('/checkout', 'CheckoutController@checkout');
});
Route::get('/blogs', 'BlogController@index');
Route::get('/blog/{slug?}', 'BlogController@show');
Route::get('/tour-packages', 'TourPackageController@index');
Route::get('/tour-packages/cheap-packages', 'TourPackageController@cheap_packages');
Route::get('/tour-packages/custom', 'TourPackageController@custom_tour');
Route::get('/tour-packages/{slug?}', 'TourPackageController@show');

Route::get('/faqs', 'PagesController@faqs');
Route::get('/hotel-cancellation-policy', 'PagesController@hotel_cancellation_policy');
Route::get('/flight-cancellation-policy', 'PagesController@flight_cancellation_policy');
Route::get('/terms-and-conditions', 'PagesController@terms_and_conditions');
Route::get('/work-with-us', 'PagesController@work_with_us');
Route::get('/testimonials', 'PagesController@testimonials');

/*
|--------------------------------------------------------------------------
| INQUIRIES
|--------------------------------------------------------------------------
|
*/
Route::get('/inquiries/airline-ticketing', 'InquiriesController@flight');
Route::get('/inquiries/bus-booking', 'InquiriesController@bus');
Route::get('/inquiries/hotel-reservation', 'InquiriesController@hotel');
Route::get('/inquiries/van-rental', 'InquiriesController@van_rental');


Route::get('/inquiries/get-drop-offs', 'InquiriesController@get_drop_offs');

Route::get('/shopping-cart', 'CartController@index');
Route::get('/cart/remove-from-cart/{id?}', 'CartController@remove_from_cart');
Route::get('/cart/proceed-to-checkout', 'CartController@proceed_to_checkout');



/*
|--------------------------------------------------------------------------
| POST / passing forms
|--------------------------------------------------------------------------
|
*/

Route::post('/contact', 'TicketsController@store');
Route::post('/ticket/{slug?}/edit','TicketsController@update');
Route::post('/ticket/{slug?}/delete','TicketsController@destroy');
Route::post('/comment', 'CommentsController@newComment');
Route::post('/users/register', 'Auth\RegisterController@register');
Route::post('/users/login', 'Auth\LoginController@login');


Route::post('/inquiries/airline-ticketing', 'InquiriesController@store_flight');
Route::post('/inquiries/bus-booking', 'InquiriesController@store_bus');
Route::post('/inquiries/van-rental', 'InquiriesController@store_van_rental');
Route::post('/inquiries/hotel-reservation', 'InquiriesController@store_hotel_reservation');
Route::post('/tour-packages/custom', 'TourPackageController@store');

Route::post('/testimonials', 'TestimonialsController@store');

Route::post('/cart/add-to-cart', 'CartController@add_to_cart');


/*
|--------------------------------------------------------------------------
| NEWSLETTER SUBSCRITPTION
|--------------------------------------------------------------------------
|
*/


Route::post('/subscribe-to-newsletter', 'SubscribersController@subscribe');
Route::get('/subscribe-to-newsletter/registered-user', 'SubscribersController@subscribe_registered');
Route::get('/unsubscribe/{uniqid?}', 'SubscribersController@unsubscribe');
Route::get('/unsubscribe-registered/{uniqid?}', 'SubscribersController@unsubscribe_registered');



/*
|--------------------------------------------------------------------------
| Emails
|--------------------------------------------------------------------------
|
*/
Route::get('sendemail', function () {

    $data = array(
        'name' => "Learning Laravel",
    );

    Mail::send('emails.welcome', $data, function ($message) {

        $message->from('creativemindsphilippines@gmail.com', 'Learning Laravel');

        $message->to('creativemindsphilippines@gmail.com')->subject('Learning Laravel test email');

    });

    return "Your email has been sent successfully";

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
