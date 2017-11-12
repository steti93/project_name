<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }else{
            return Redirect::route('admin/login');
        }
    }
}
