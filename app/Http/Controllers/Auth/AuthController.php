<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Requests;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    
    
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username'=> 'required|min:4|max:255',
            'password'=>'required|min:8|max:255'
            ]);

        if (Auth::attempt($request->only(['username','password']),
            $request->has('remember')))
        {
            if($this->auth->user()->hasRole('receptionist'))
            {
                return redirect()->route('reception-home');
            }
            if($this->auth->user()->hasRole('doctor'))
            {
                return redirect()->route('doctor-home');
            }
            if($this->auth->user()->hasRole('accountant'))
            {
                return redirect()->route('accounts-home');
            }
            if($this->auth->user()->hasRole('pharmacy'))
            {
                return redirect()->route('pharmacy-home');
            }
            if($this->auth->user()->hasRole('nurse'))
            {
                return redirect()->route('nurse-home');
            }
            if($this->auth->user()->hasRole('laboratorist'))
            {
                return redirect()->route('lab-home');
            }
        } else {
            return redirect()->route('home')->with('info','Sorry, we could not sign you in with those details. Please try again.');
        }
   }

    public function getLogout(Request $response)
    {
        Auth::logout();
        return redirect()->route('home')->with('info','You have successfully signed out.');;
    }

    public function homeCheck(Request $request){
        Auth::logout();
        return redirect()->route('home')->with('info','Kindly, Sign In.');
    }

}
