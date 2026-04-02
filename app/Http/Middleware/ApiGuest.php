<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiGuest
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('api_user') && $request->session()->has('api_token')) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
