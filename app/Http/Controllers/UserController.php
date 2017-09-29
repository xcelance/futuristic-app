<?php



namespace App\Http\Controllers;



use App\Mail\EmailVerification;

use Mail;

use App\User;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Input;

use View;

use Session;

use DB;





class UserController extends Controller {

    public $last_insert_id;    

    public function __construct() {              

    }



    public function userSignup() {
        DB::enableQueryLog();

        // echo '<pre>';
        // print_r($_REQUEST);        

        $rules = ['email' => 'required|string|email|max:255|unique:users', 'password' => 'required',

                'firstname' => 'required', 'lastname' => 'required', 'school_name' => 'required', 'dob' => 'required', 'yearinschool' => 'required', 'reference' => 'required','maingoal' => 'required',];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

           // handler errors

           $errors = $validator->errors(); 
           return redirect('signup')->withErrors($errors)->withInput();
        }

        if (Request::isMethod('post')) {

            $dob = explode("/",Request::get('dob'));

            $dateofbirth = $dob[2].'-'.$dob[1].'-'.$dob[0];
            $user =  User::create(['firstname' => Request::get('firstname'), 'lastname' => Request::get('lastname'), 'email' => Request::get('email'), 'password' => bcrypt(Request::get('password')), 'role' => '0', 'school_name' => Request::get('school_name'), 'dob' => $dateofbirth, 'year_in_school' => Request::get('yearinschool'), 'email_token' => str_random(30),]);

            // echo '<pre>';
            // print_r(DB::getQueryLog());        
            // die;
        }   

        $email = new EmailVerification(new User(['email_token' => $user->email_token, 'firstname' => $user->firstname]));
        Mail::to($user->email)->send($email);
        Session::flash('success', 'Signup successfully! Please check your mail for verification...');

        return View::make('auth.thankyou');        

    }

    

    public function verify($token)
    {
        // The verified method has been added to the user model and chained here
        // for better readability

        User::where('email_token',$token)->firstOrFail()->verified();
        return redirect('login');
    }   



    //User Login Function

    public function userLogin(){
        echo '<pre>';
        die(print_r($_REQUEST));
    }



    public function logout() {
        Auth::logout();
        return Redirect::away('login');
    }   

}

