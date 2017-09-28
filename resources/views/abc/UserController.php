<?php

namespace App\Http\Controllers;

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
        echo '<pre>';
        print_r($_REQUEST);
        
        $rules = ['email' => 'required|string|email|max:255|unique:fs_users', 'password' => 'required',
                'firstname' => 'required', 'lastname' => 'required', 'school_name' => 'required', 'dob' => 'required', 'yearinschool' => 'required', 'reference' => 'required','maingoal' => 'required',];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
           // handler errors
           $errors = $validator->errors();                      
           return redirect('signup')->withErrors($errors)->withInput();
        }

        if (Request::isMethod('post')) {   
            
            $user =  User::create(['firstname' => Request::get('firstname'), 'lastname' => Request::get('lastname'), 'email' => Request::get('email'), 'password' => bcrypt(Request::get('password')), 'role' => '0', 'school_name' => Request::get('school_name'), 'dob' => Request::get('dob'), 'year_in_school' => Request::get('yearinschool'),]);
            echo '<pre>';
            print_r(DB::getQueryLog());        
            die;
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
