<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'create'])->name('loginForm')
        ->middleware('guest:admin');
    Route::post('login', [LoginController::class, 'store'])->name('login')
        ->middleware('guest:admin');

    // Logout
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout')->middleware('admin');

    // Forget Password
    Route::get('forgot-password', [PasswordResetController::class, 'create'])
        ->name('password.forgot')->middleware('guest:admin');

    Route::post('forgot-password', [PasswordResetController::class, 'store'])
        ->name('password.request')->middleware('guest:admin');

    // Reset Password
    Route::get('reset-password/{token}', [PasswordResetController::class, 'edit'])
        ->name('password.reset')->middleware('guest:admin');

    Route::post('reset-password', [PasswordResetController::class, 'update'])
        ->name('password.update')->middleware('guest:admin');
});
