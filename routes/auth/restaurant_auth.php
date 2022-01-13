<?php

use App\Http\Controllers\Restaurant\Auth\LoginController;
use App\Http\Controllers\Restaurant\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\RestaurantController;
use App\Http\Controllers\Restaurant\Auth\ProfileController;

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

    //Profile
    Route::prefix('setting/profile')->name('profile.')->group(function () {
        # show profile page
        Route::get('/', [ProfileController::class, 'index'])->name('index');


        Route::name('update.')->group(function () {
            # post details form
            Route::put('details', [ProfileController::class, 'details'])->name('details');

            # update address
            Route::put('address', [ProfileController::class, 'address'])->name('address');

            # update owner
            Route::put('owner', [ProfileController::class, 'owner'])->name('owner');

            # update manager
            Route::put('manager', [ProfileController::class, 'manager'])->name('manager');

            # update timing
            Route::put('timing', [ProfileController::class, 'timing'])->name('timing');

            # update document
            Route::put('document', [ProfileController::class, 'document'])->name('document');

            # update files
            Route::put('files', [ProfileController::class, 'files'])->name('files');

            # password
            Route::put('password', [ProfileController::class, 'password'])->name('password');
        });
    });
});

Route::get('partner_with_us', [RestaurantController::class, 'index'])->name('partner_with_us');
Route::post('partner_with_us',  [RestaurantController::class, 'store'])->name('restaurant.store');
