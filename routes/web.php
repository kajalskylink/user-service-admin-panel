<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiAuth;
use App\Http\Middleware\ApiGuest;
use Illuminate\Support\Facades\Route;

// Guest Routes (Only accessible if NOT logged in)
Route::middleware([ApiGuest::class])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });

    Route::controller(AuthController::class)->group(function () {
        Route::get('/register', 'createRegistration')->name('register');
        Route::post('/register', 'register');
        Route::get('/login', 'create')->name('login');
        Route::post('/login', 'store')->name('login.store');
    });
});

// Authenticated Routes (Only accessible if logged in)
Route::middleware([ApiAuth::class])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // User Route
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Permission Route
    Route::controller(PermissionController::class)->prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });
});
