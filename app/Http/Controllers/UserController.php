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
use Socialite;
use SocialAccount;

class UserController extends Controller {

    public $last_insert_id;    

    public function __construct() {              
    }

      public function userSignup() {
        
        DB::enableQueryLog();
        // echo '<pre>';
        // print_r($_REQUEST);
        
        $rules = ['email' => 'required|string|email|max:255|unique:users', 'password' => 'required',
                'password_confirmation' => 'required|same:password'];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
           // handler errors
           $errors = $validator->errors();
                      
           return redirect('signup')->withErrors($errors)->withInput();
        }

        if (Request::isMethod('post')) {
        
            $name = Request::get('name');
            $name = explode(' ', $name);            
            $fname = reset($name);
            
            $user =  User::create(['name' => Request::get('name'), 'firstName' => $fname, 'email' => Request::get('email'), 'password' => bcrypt(Request::get('password')), 'email_token' => str_random(30),]);
            //print_r(DB::getQueryLog());        
        }
              
        $email = new EmailVerification(new User(['email_token' => $user->email_token, 'name' => $user->name]));
        Mail::to($user->email)->send($email);
        
        Session::flash('success', 'Signup successfully! Please check your mail for verification...');
        
        return View::make('auth.thankyou');        
    }

    //User Login Function
    public function userLogin(){
        echo '<pre>';
        die(print_r($_REQUEST));
    }


    public function verify($token)
    {
        // The verified method has been added to the user model and chained here
        // for better readability
        User::where('email_token',$token)->firstOrFail()->verified();
        return redirect('login');
    }

    public function authenticate() {
        die("45555");
        
        if (Auth::attempt(['email' => Request::get('email'), 'password' => Request::get('password')])) {
            return redirect()->intended('checkout');
        } else {            
            return view('login', array('title' => 'Welcome', 'description' => '', 'page' => 'home'));
        }
    }

    public function login() {  
        die("45687");      
        return view('login', array('title' => 'Welcome', 'description' => '', 'page' => 'home'));
    }

    public function logout() {
        Auth::logout();

        return Redirect::away('login');
    }   
}
