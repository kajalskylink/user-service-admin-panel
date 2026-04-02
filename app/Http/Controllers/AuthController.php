<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Services\API\AuthAPIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected AuthAPIService $authAPIService;

    public function __construct(AuthAPIService $authAPIService)
    {
        $this->authAPIService = $authAPIService;
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $response = $this->authAPIService->register($validatedData);

        if ($response->successful()) {
            $userData = $response->json('user');
            if ($userData) {
                $request->session()->put('api_user', $userData);
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors(['email' => 'Registration failed.'])->withInput();
    }

    public function createRegistration()
    {
        return view('auth.register');
    }

    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $response = $this->authAPIService->login($validatedData);

        if ($response->successful()) {
            $userData = $response->json('user');
            if ($userData) {
                // Manually store in session
                $request->session()->put('api_user', $userData);
                if ($token = $response->json('token')) {
                    $request->session()->put('api_token', $token);
                }
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $token = $request->session()->get('api_token');
        
        // Optional: Call logout on the external API
        $this->authAPIService->logout($token);

        $request->session()->forget(['api_user', 'api_token']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
