<?php

use Illuminate\Support\Facades\Route;

Route::prefix('rider')->name('rider.')->group(function () {

    Route::get('', function () {
        return view('themes.rider.dashboard');
    })->name('rider.dashboard');

    /**
     * P
     */
});
