<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{

    protected $auth;
    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */    

    public function handle($request, Closure $next, $guard = null)
    {        
        if (Auth::guard($guard)->check()) {            
            if ($this->auth->user()->role == '2') {
                die("Here");
                return redirect('/home');
            }elseif ($this->auth->user()->role == '1') {
               die("Teacher");
            }else{
                return redirect('/');
            }
           // return redirect('/home');
        }

        return $next($request);
    }
}
