<?php

namespace App\Http\Middleware;

use Closure;

class CustomeAuth
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('logged_in'))
        {
            return redirect()->route('login')->with('error', 'Please login!');
        }

        return $next($request);
    }
}