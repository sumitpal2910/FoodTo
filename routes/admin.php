<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\RiderController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('dashboard', function () {
        return view('themes.admin.dashboard');
    })->middleware(['admin'])->name('dashboard');

    /**
     * Service Area
     */

    // ===  State   ===
    Route::prefix('state')->name('state.')->group(function () {
        # get all data in json
        Route::get('data', [StateController::class, 'allData']);

        # get one data in json
        Route::get('data/{state}', [StateController::class, 'oneData']);

        # restore deleted data
        Route::put('restore/{state}', [StateController::class, 'restore']);

        # update status
        Route::put('status/{state}', [StateController::class, 'status']);

        # state resource
        Route::resource('', StateController::class)->parameters(['' => 'state'])->only(['index', 'show', 'store', 'update', 'destroy']);
    });

    // ===  District  ===
    Route::prefix('district')->name('district.')->group(function () {
        # get all data in json
        Route::get('data', [DistrictController::class, 'allData']);

        # get one data in json
        Route::get('data/{district}', [DistrictController::class, 'oneData']);

        # restore deleted data
        Route::put('restore/{district}', [DistrictController::class, 'restore']);

        # update status
        Route::put('status/{district}', [DistrictController::class, 'status']);

        # district resource
        Route::resource('', DistrictController::class)->parameters(['' => 'district'])->only(['index', 'store', 'update', 'destroy']);
    });


    // ===  City  ===
    Route::prefix('city')->name('city.')->group(function () {
        # get all data in json
        Route::get('data', [CityController::class, 'allData']);

        # get one data in json
        Route::get('data/{city}', [CityController::class, 'oneData']);

        # restore deleted data
        Route::put('restore/{city}', [CityController::class, 'restore']);

        # update status
        Route::put('status/{city}', [CityController::class, 'status']);

        # city resource
        Route::resource('', CityController::class)->parameters(['' => 'city'])->only(['index', 'create', 'store', 'update', 'destroy']);
    });



    /**
     * Restaurant
     */
    Route::prefix('restaurant')->name('restaurant.')->group(function () {

        # get all data in json datatable
        Route::get('data', [RestaurantController::class, 'allData']);

        # restore deleted data
        Route::put('restore/{restaurant}', [RestaurantController::class, 'restore']);

        # update status
        Route::put('status/{restaurant}', [RestaurantController::class, 'status']);

        # search
        Route::get('search', [RestaurantController::class, 'search']);

        Route::resource('', RestaurantController::class)->parameters(['' => 'restaurant']);
    });


    /**
     * Bank
     */
    Route::prefix('bank')->name('bank.')->group(function () {
        # get all data in json
        Route::get('data', [BankController::class, 'allData']);

        # get one data in json
        Route::get('data/{state}', [BankController::class, 'oneData']);

        # restore deleted data
        Route::put('restore/{state}', [BankController::class, 'restore']);

        # bank resource
        Route::resource('', BankController::class)->only(['index', 'store', 'update', 'destroy'])->parameters(['' => 'bank']);
    });

    /**
     * Rider
     */
    Route::prefix('rider')->name('rider.')->group(function () {
        # get all data in json
        Route::get('data', [RiderController::class, 'allData'])->name('data');

        # get one data in json
        Route::match(['PUT', "PATCH"], '{rider}/status', [RiderController::class, 'status'])->name('status');

        # restore deleted data
        Route::put('{rider}/restore', [RiderController::class, 'restore'])->name('restore');

        # bank resource
        Route::resource('', RiderController::class)->only(['index', 'destroy'])->parameters(['' => 'rider']);
    });
});
