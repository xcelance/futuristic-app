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
    
        $rules = ['email' => 'required|string|email|max:255|unique:users', 'password' => 'required', 'utype' => 'required', 

                'firstname' => 'required', 'lastname' => 'required', 'school_name' => 'required', 'dob' => 'required', 'yearinschool' => 'required', 'reference' => 'required','maingoal' => 'required',];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
           // handler errors

           $errors = $validator->errors(); 
           return redirect('signup')->withErrors($errors)->withInput();
        }

        if (Request::isMethod('post')) {

            $dob = explode("/",Request::get('dob'));
            $role = Request::get('utype') == 'student'? '0':'1';

            $dateofbirth = $dob[2].'-'.$dob[1].'-'.$dob[0];
            $user =  User::create(['firstname' => Request::get('firstname'), 'lastname' => Request::get('lastname'), 'email' => Request::get('email'), 'password' => bcrypt(Request::get('password')), 'role' => $role, 'school_name' => Request::get('school_name'), 'dob' => $dateofbirth, 'year_in_school' => Request::get('yearinschool'), 'email_token' => str_random(30),]);

            // echo '<pre>';
            // print_r(DB::getQueryLog());        
            // die;
        }  

        return View::make('paywithstripe', compact('user'));
    }

    function userSignupFreeView($stype = NULL) {

        if(isset($_REQUEST['stype'])){
            $stype = $_REQUEST['stype'];
        }else{
            $stype = '';
        }        
        return View::make('auth/register-free', compact('stype'));
    }  

    function userSignupFree2() {
        DB::enableQueryLog();

        $from = new \SendGrid\Email("Example User", "niraj.pathak@xcelance.com");
        $subject = "Sending with SendGrid is Fun 132";
        $to = new SendGrid\Email("Example User", "niraj.pathak@xcelance.com");
        $content = new SendGrid\Content("text/plain", "and easy to do anywhere, even with PHP");
        $mail = new SendGrid\Mail($from, $subject, $to, $content);
        $apiKey = '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';
        $sg = new \SendGrid($apiKey);
        $response = $sg->client->mail()->send()->post($mail);

        die;      
    }

    function userSignupFree() {
        DB::enableQueryLog();

        $rules = ['email' => 'required|string|email|max:255|unique:users', 'password' => 'required', 'utype' => 'required', 'firstname' => 'required', 'lastname' => 'required', 'school_name' => 'required', 'dob' => 'required', 'yearinschool' => 'required', 'reference' => 'required','maingoal' => 'required',];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
          
           $errors = $validator->errors(); 
           return redirect('signup-free')->withErrors($errors)->withInput();
        }

        if (Request::isMethod('post')) {

            $dob = explode("/",Request::get('dob'));
            $role = Request::get('utype') == 'student'? '0':'1';

            $dateofbirth = $dob[2].'-'.$dob[1].'-'.$dob[0];
            $user =  User::create(['firstname' => Request::get('firstname'), 'lastname' => Request::get('lastname'), 'email' => Request::get('email'), 'password' => bcrypt(Request::get('password')), 'role' => $role, 'school_name' => Request::get('school_name'), 'dob' => $dateofbirth, 'year_in_school' => Request::get('yearinschool'), 'email_token' => str_random(30), ]);
        }

        DB::table('users')                    
            ->where('users.id', $user->id)                
            ->update(['payment_status' => '4']);  

        $email = new EmailVerification(new User(['email_token' => $user->email_token, 'firstname' => $user->firstname]));
        $sentStatus = Mail::to($user->email)->send($email);

        Session::flash('success', 'Signup successfully! Please check your mail for verification...');

        return View::make('auth.thankyou');
    }

    function teacherSignupFreeView($stype = NULL) {

        if(isset($_REQUEST['stype'])){
            $stype = $_REQUEST['stype'];
        }else{
            $stype = '';
        }        
        return View::make('auth/register-teacher', compact('stype'));
    }  

    function teacherSignupFree() {
        DB::enableQueryLog();

        $rules = ['email' => 'required|string|email|max:255|unique:users', 'password' => 'required', 'utype' => 'required', 'firstname' => 'required', 'lastname' => 'required', 'school_name' => 'required', 'dob' => 'required', 'whatyearinschool' => 'required', 'reference' => 'required','maingoal' => 'required',];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
          
           $errors = $validator->errors(); 
           return redirect('signup-teacher?stype=1507300342')->withErrors($errors)->withInput();
        }

        if (Request::isMethod('post')) {

            $dob = explode("/",Request::get('dob'));
            $role = Request::get('utype') == 'teacher'? '1':'0';

            $dateofbirth = $dob[2].'-'.$dob[1].'-'.$dob[0];
            $user =  User::create(['firstname' => Request::get('firstname'), 'lastname' => Request::get('lastname'), 'email' => Request::get('email'), 'password' => bcrypt(Request::get('password')), 'role' => $role, 'school_name' => Request::get('school_name'), 'dob' => $dateofbirth, 'year_in_school' => Request::get('whatyearinschool'), 'email_token' => str_random(30), ]);
        }  

        DB::table('users')                    
            ->where('users.id', $user->id)                
            ->update(['payment_status' => '4']);

        $email = new EmailVerification(new User(['email_token' => $user->email_token, 'firstname' => $user->firstname]));
        $sentStatus = Mail::to($user->email)->send($email);

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

    public function logout() {
        Auth::logout();
        return Redirect::away('login');
    }   

}

