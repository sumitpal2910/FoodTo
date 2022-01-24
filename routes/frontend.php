<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutContolller;
use App\Http\Controllers\Frontend\FoodController;
use App\Http\Controllers\Frontend\RestaurantController;
use Predis\Configuration\PrefixOption;

// Address
Route::resource('address', AddressController::class)->only(['store']);

// Restaurants
Route::get('restaurants/{restaurants:slug}/data', [RestaurantController::class, 'dataJson'])->name('data');

Route::resource('restaurants', RestaurantController::class)
    ->only(['index', 'show', 'edit'])
    ->parameters(['restaurants' => 'restaurants:slug']);



Route::get('/', function () {
    return view('themes.frontend.index');
})->name('index');



/**
 * -------------------------------------
 *  ---- Ajax Request ----
 * -------------------------------------
 */

# get foods with all toppings
Route::get('foods/{foods}/toppings', [FoodController::class, 'toppings'])->name('food.with-toppings');


/**
 * Cart
 */
Route::prefix('carts')->name('carts.')->group(function () {
    # index
    Route::get('/', [CartController::class, 'index'])->name('index');

    # index
    Route::post('/', [CartController::class, 'store'])->name('store');

    # search
    Route::post('search', [CartController::class, 'search'])->name('search');

    # increment
    Route::post('increment', [CartController::class, 'increment'])->name('increment');

    # decrement
    Route::post('decrement', [CartController::class, 'decrement'])->name('decrement');
});


/**
 * Checkout
 */
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutContolller::class, 'index'])->name('index');
});
