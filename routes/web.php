<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * ======================================================================================
 * ==============   ADMIN =============
 * ======================================================================================
 */
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('dashboard', function () {
        return view('themes.admin.dashboard');
    })->middleware(['admin'])->name('dashboard');
});


Route::get('/', function () {
    return view('themes.frontend.index');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::get('restaurant/dashboard', function () {
    return view('themes.restaurant.dashboard');
})->middleware(['restaurant'])->name('restaurant.dashboard');

Route::get('rider/dashboard', function () {
    return view('themes.rider.dashboard');
})->middleware(['rider'])->name('rider.dashboard');

Route::get('/diff', function () {
    $now = now()->subMinutes(10);
    return now()->diffInMinutes($now);
});



require __DIR__ . '/auth/auth.php';

require __DIR__ . "/auth/admin_auth.php";

require __DIR__ . "/auth/restaurant_auth.php";

require __DIR__ . "/auth/rider_auth.php";
