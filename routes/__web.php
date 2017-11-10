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


//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/', function () {
    return view('home');
});

Route::get('signup', function () {
    return view('auth/register');
});
Route::post('signup', 'UserController@userSignup');
Route::get('login', function () {
    return view('auth/login');
});
Route::post('login', 'UserController@userLogin');
Route::get('register/verify/{token}', 'UserController@verify'); 
Route::get('stripe', array('as' => 'paywithstripe','uses' => 'PaymentController@payWithStripe',));
Route::post('stripe', array('as' => 'stripe','uses' => 'PaymentController@postPaymentWithStripe',));

Auth::routes();
    Route::get('logout','UserController@logout');
    

