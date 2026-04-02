<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('api_user') || !$request->session()->has('api_token')) {
            return redirect()->route('login')->withErrors(['email' => 'Please login to access this page.']);
        }

        return $next($request);
    }
}
