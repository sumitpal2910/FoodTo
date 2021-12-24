<?php

use App\Http\Controllers\Restaurant\Auth\LoginController;
use App\Http\Controllers\Restaurant\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;

Route::prefix('restaurant')->name('restaurant.')->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'create'])->name('loginForm')->middleware('guest:restaurant');

    Route::post('login', [LoginController::class, 'store'])->name('login')->middleware('guest:restaurant');

    // Logout
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout')->middleware('restaurant');

    // Forgot password
    Route::get('forgot-password', [PasswordResetController::class, 'create'])
        ->name('password.forgot')->middleware('guest:restaurant');

    Route::post('forgot-password', [PasswordResetController::class, 'store'])
        ->name('password.request')->middleware('guest:restaurant');

    // Reset Password
    Route::get('reset-password/{token}', [PasswordResetController::class, 'edit'])
        ->name('password.reset')->middleware('guest:restaurant');

    Route::post('reset-password', [PasswordResetController::class, 'update'])
        ->name('password.update')->middleware('guest:restaurant');
});
