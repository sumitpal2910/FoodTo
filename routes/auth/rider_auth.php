<?php

use App\Http\Controllers\Rider\Auth\LoginController;
use App\Http\Controllers\Rider\Auth\ProfileController;
use App\Http\Controllers\Rider\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;

Route::prefix('rider')->name('rider.')->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'create'])->name('loginForm')->middleware('guest:rider');

    Route::post('login', [LoginController::class, 'store'])->name('login')->middleware('guest:rider');

    // Logout
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout')->middleware('rider');

    // Forgot password
    Route::get('forgot-password', [PasswordResetController::class, 'create'])
        ->name('password.forgot')->middleware('guest:rider');

    Route::post('forgot-password', [PasswordResetController::class, 'store'])
        ->name('password.request')->middleware('guest:rider');

    // Reset Password
    Route::get('reset-password/{token}', [PasswordResetController::class, 'edit'])
        ->name('password.reset')->middleware('guest:rider');

    Route::post('reset-password', [PasswordResetController::class, 'update'])
        ->name('password.update')->middleware('guest:rider');


    /**
     * Profile
     */
    Route::prefix('setting/profile')->name('profile.')->group(function () {
        # show profile
        Route::get('/', [ProfileController::class, 'index'])->name('index');

        /**
         * Update
         */
        Route::prefix('update')->name('update.')->group(function () {

            # update profile
            Route::match(['PUT', 'PATCH'], 'profile', [ProfileController::class, 'update'])->name('profile');

            # update profile
            Route::match(['PUT', 'PATCH'], 'address', [ProfileController::class, 'address'])->name('address');

            # update profile
            Route::match(['PUT', 'PATCH'], 'password', [ProfileController::class, 'password'])->name('password');
        });
    });
});
