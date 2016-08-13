<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
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
     * @return mixed
     */
     public function handle($request, Closure $next, $role)
    {
        if($role == 'all')
        {
            return $next($request);
        }
        if ($this->auth->guest()) {
            if ($request->ajax()) {
<<<<<<< HEAD
                return redirect()->route('home')->with('info', 'Sorry, kindly log in for further access.');
            } else {
                return redirect()->route('home')->with('info', 'Sorry, kindly log in for further access.');
=======
                return response()->view('errors.403', [], 403);
            } else {
                return response()->view('errors.403', [], 403);
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
            }
        }
        if( $this->auth->guest() || !$this->auth->user()->hasRole($role))
        {
<<<<<<< HEAD
            return redirect()->route('home')->with('info', 'Sorry, kindly log in for further access.');
=======
            return response()->view('errors.403', [], 403);
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
        }
        return $next($request);
    }
}
