<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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
Route::middleware([ApiAuth::class, 'refresh_permissions'])->group(function () {
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
    Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/update/{user}', 'update')->name('update');
        Route::delete('/delete/{user}', 'destroy')->name('destroy');
        Route::patch('/{user}/change-status', 'changeStatus')->name('changeStatus');
    });

    // Permission Route
    Route::controller(PermissionController::class)->prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/update/{permission}', 'update')->name('update');
        Route::delete('/delete/{permission}', 'destroy')->name('destroy');
    });

    // Role Route
    Route::controller(RoleController::class)->prefix('roles')->name('roles.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{role}/edit', 'edit')->name('edit');
        Route::post('/update/{role}', 'update')->name('update');
        Route::delete('/delete/{role}', 'destroy')->name('destroy');
        Route::patch('/{role}/change-status', 'changeStatus')->name('changeStatus');
    });
});
