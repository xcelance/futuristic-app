<?php

namespace App\Http\Controllers\Auth;

use App\Mail\EmailVerification;
use Mail;
use App\User;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use View;
use Session;
use Socialite;
use SocialAccount;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    { 
        return User::create([
            'name' => $data['name'],
            'firstName' => $data['firstName'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => str_random(30),
        ]);
    }

    public function Authlogin($provider){        
        return Socialite::with($provider)->redirect();        
    }

    public function socialCallback($provider){   
        DB::enableQueryLog();
        $data = Request::all();
       
        try{

            $socialUser = Socialite::with($provider)->user();
        }
        catch(\Exception $e){            
            return redirect('login');
        }

        $socialProvider = \App\SocialAccount::where('provider_id', $socialUser->getId())->first();
    
        if(empty($socialProvider)){
            $name = $socialUser->getName();
            $nameArr = @explode(" ", $name);
            $fname = @reset($nameArr); 
            $email = $socialUser->email;

            $user = User::firstOrCreate(
                ['name' => $name,
                 'firstName' => $fname,   
                'email' => $email,
                'verified' => 1]
                //['password' => bcrypt(rand(10,100).time())]
            );

            //print_r(DB::getQueryLog());
            $user->socialAccounts()->create(
                ['provider_id' => $socialUser->getId(), 'provider' => $provider]
            );

            $email = new EmailVerification(new User(['email_token' => $user->email_token, 'name' => $user->name, 'provider' => $provider]));
            Mail::to($user->email)->send($email);
            
            Session::flash('success', 'Registered successfully! Please check your mail for verification...');

            auth()->login($user, true);
            return View::make('auth.thankyou');            
        }
        else{           
            $user = $socialProvider->user;
        }
        
        auth()->login($user, true);
        return redirect('/');

    }
}
