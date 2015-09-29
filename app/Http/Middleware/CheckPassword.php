<?php

namespace App\Http\Middleware;

use Closure;
use Krucas\Notification\Facades\Notification;

class CheckPassword
{
    protected $except = [
        'my/password',
        'auth/logout',
        '_debugbar/*',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->guest() || $this->shouldPassThrough($request)) {
            return $next($request);
        }

        if(auth()->user()->mustChangePassword()) {
            Notification::warning(trans('users.must_change_password'));
            return redirect('my/password');
        }

        return $next($request);
    }

    protected function shouldPassThrough($request)
    {
        foreach ($this->except as $except) {
            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }

}
