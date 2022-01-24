<?php


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


/**
 * ======================================================================================
 * ==============  FRONTEND =============
 * ======================================================================================
 */

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


require __DIR__ . "/restaurant.php";

require __DIR__ . "/rider.php";

require __DIR__ . "/admin.php";

require __DIR__ . "/frontend.php";
