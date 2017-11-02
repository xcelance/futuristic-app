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
use App\Http\Requests;
use Illuminate\Http\Request;

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
Route::get('contact-us', function () {
    return view('contact');
});
Route::get('membership', function () {
    return view('membership');
});
Route::get('futuristics', function () {
    return view('futuristicwebapp');
});


Route::group(['middleware' => 'guest'], function () {

    Route::get('signup', function () {
        return view('auth/register');
    });
    Route::post('signup', 'UserController@userSignup');
    Route::get('login', function () {
        return view('auth/login');
    });

    Route::get('signupfree{stype?}', 'UserController@userSignupFreeView');
    Route::post('signupfree', 'UserController@userSignupFree');

    Route::post('login', 'UserController@userLogin');
    Route::get('register/verify/{token}', 'UserController@verify'); 

    Route::get('stripe', 'PaymentController@payWithStripe');
    Route::post('stripe', 'PaymentController@postPaymentWithStripe');
});

Route::group(['prefix' => 'admin', 'middleware' => 'guest'], function()
{
    Route::get('/', function () {
        return view('auth/adminLogin');
    });
    Route::get('login', function () {
        return view('auth/adminLogin');
    });
    Route::post('login', 'UserController@userLogin');
});

Auth::routes();
Route::get('logout','UserController@logout');
Route::get('profile','ProfileController@index');
Route::get('/change/password', 'ProfileController@changePassword');
Route::post('setpassword', 'ProfileController@setPassword');
Route::get('cancelplan', 'ProfileController@cancelPlan');
Route::post('fullpayment', 'PaymentController@postPendingPaymentWithStripe');
Route::get('modules', 'ModuleController@index');
Route::get('/mymodule/{pid?}', 'ModuleController@myModulePage');
Route::get('EQ','ModuleController@moduleEQ');
Route::get('SMB','ModuleController@moduleSMB');

Route::get('students', 'ProfileController@studentList');
Route::get('videoanalytic', 'ProfileController@videoAnalytic');
Route::post('modresponse', 'ProfileController@moduleResponse');
Route::get('modresponse', 'ProfileController@moduleResponse');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function()
{    
	Route::get('/','AdminController@index');
	Route::get('dashboard','AdminController@index');
	Route::get('modules','AdminController@moduleList');    
	Route::get('video{mid?}','AdminController@videoDetail');
	Route::post('deletemodule{vmd?}', 'AdminController@deleteModule');
	Route::post('createnew','AdminController@createModule');
	Route::post('editmodule', 'AdminController@editModule');
	Route::get('delmodule{mid?}', 'AdminController@deleteModule');
	
	Route::get('submodule{mid?}', 'AdminController@subModuleList');	
	Route::post('createnewsub','AdminController@createSubModule');
	Route::get('delsubmodule{sid?}', 'AdminController@deleteSubModule');
	Route::post('editsubmodule', 'AdminController@editSubModule');

	Route::get('students', 'AdminController@studentList');	
	Route::post('delstudent', 'AdminController@deleteStudent');
	Route::post('videoviewed', 'AdminController@editVideoviewed');

	Route::get('teachers', 'AdminController@teacherList');
	Route::post('delteacher', 'AdminController@deleteTeacher');

	Route::get('users','AdminController@userList');
	Route::post('getusers','AdminController@userListBySize');
	Route::get('logout','UserController@logout');	
});
    

