<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Services\API\UserAPIService;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => (object) session('api_user'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, UserAPIService $userAPIService): RedirectResponse
    {
        $userData = session('api_user');

        // Validate incoming request
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'mobile_number' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        // Remove empty password so we don't accidentally update it to an empty string
        if (empty($validated['password'])) {
            unset($validated['password']);
        }
        
        $imageFile = null;
        if ($request->hasFile('profile_image')) {
            $imageFile = $request->file('profile_image');
            // Remove from array since we will send it as a multipart attachment
            unset($validated['profile_image']);
        }

        // Send actual API request to update User
        $response = $userAPIService->updateUser($userData['id'], $validated, $imageFile);

        if ($response->successful()) {
            $updatedUser = array_merge($userData, $validated);
            unset($updatedUser['password']);
            $request->session()->put('api_user', $updatedUser);

            // Optionally try to refresh full session from API if the function exists
            if (method_exists($userAPIService, 'refreshUserSession')) {
                $userAPIService->refreshUserSession();
            }

            return Redirect::route('profile.edit')->with('success', 'Profile updated successfully.');
        }

        return Redirect::back()->withInput()->with('error', $response->json('message') ?? 'Failed to update profile.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget(['api_user', 'api_token']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
