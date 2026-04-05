<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\API\UserAPIService;

class RefreshPermissions
{
    protected UserAPIService $userAPIService;

    public function __construct(UserAPIService $userAPIService)
    {
        $this->userAPIService = $userAPIService;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('api_user')) {
            $this->userAPIService->refreshUserSession();
        }

        return $next($request);
    }
}
