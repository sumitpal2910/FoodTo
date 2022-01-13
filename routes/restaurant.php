<?php

use App\Http\Controllers\Restaurant\FoodController;
use App\Http\Controllers\Restaurant\FoodTimingController;
use App\Http\Controllers\Restaurant\FoodToppingController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;


Route::prefix('restaurant')->name('restaurant.')->group(function () {
    /**
     * Food
     */
    Route::prefix('food')->name('food.')->group(function () {
        # all data in json
        Route::get('data', [FoodController::class, 'allData'])->name('data');

        # restore
        Route::put('{food}/restore', [FoodController::class, 'restore'])->name('restore');

        # update status
        Route::put('{food}/update-status', [FoodController::class, 'updateStatus'])->name('update-status');

        # resource
        Route::resource('', FoodController::class)->parameters(['' => 'food']);


        Route::prefix("{food}/topping")->name('topping.')->group(function () {

            # get all topping for data table
            Route::get('data', [FoodToppingController::class, 'allData'])->name('data');

            # get all data in json
            Route::get('data/json', [FoodToppingController::class, 'dataJson'])->name('data-json');

            // restore
            Route::put('{topping}/restore', [FoodToppingController::class, 'restore'])->name('restore');

            # update status
            Route::put('{topping}/update-status', [FoodToppingController::class, 'updateStatus'])->name('update-status');
        });

        Route::prefix("{food}/timing")->name('timing.')->group(function () {

            # get all topping for data table
            Route::get('data', [FoodTimingController::class, 'allData'])->name('data');

            # get all data in json
            Route::get('data/json', [FoodTimingController::class, 'dataJson'])->name('data-json');

            # restore
            Route::match(['PUT', 'PATCH'], '{timing}/restore', [FoodTimingController::class, 'restore'])->name('restore');

            # update status
            Route::match(['PUT', 'PATCH'], '{timing}/update-status', [FoodTimingController::class, 'updateStatus'])->name('update-status');
        });
    });


    // Topping Resource
    Route::resource('food.topping', FoodToppingController::class)->only(['show', 'store', 'update', 'destroy']);

    // Food Timing Resource
    Route::resource('food.timing', FoodTimingController::class)->only(['show', 'store', 'update', 'destroy']);
});
