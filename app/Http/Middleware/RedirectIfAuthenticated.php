<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Events\UserFailedLoggedInEvent;
use Event;

class RedirectIfAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
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
    public function handle($request, Closure $next)
    {
        
        if ($this->auth->check()) {
            
            return redirect('/home');
        }
        
        $data =  $next($request);
        
        $headers = $data->headers->all();
        
        
        if (isset($headers['location'][0])) {
            
            if ($headers['location'][0] == "http://localhost:8000/auth/login") {
                
                Event::fire(new UserFailedLoggedInEvent($request));
            }
        }
        
        
        return $next($request);
        
    }
    
   
}
