<?php

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\StateController;

use App\Http\Controllers\EndPoint\CityController as EndPointCityController;
use App\Http\Controllers\EndPoint\DistrictController as EndPointDistrictController;
use App\Http\Controllers\EndPoint\StateController as EndPointStateController;
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
 * ==============   DATA  END POINT  =============
 * ======================================================================================
 */
Route::prefix('endpoint')->group(function () {
    /**
     * State End point
     * index - get all data in json
     * show - get one data in json
     */
    Route::prefix('state')->group(function () {
        # index
        Route::get('/', [EndPointStateController::class, 'index']);

        # show
        Route::get('/{state}', [EndPointStateController::class, 'show']);

        # get district
        Route::get('/{state}/district', [EndPointStateController::class, 'district']);

        # get district
        //Route::get('/{state}/city', [EndPointStateController::class, 'city']);
    });

    /**
     * State End point
     * index - get all data in json
     * show - get one data in json
     */
    Route::prefix('district')->group(function () {
        # index
        Route::get('/', [EndPointDistrictController::class, 'index']);

        # show
        Route::get('/{district}', [EndPointDistrictController::class, 'show']);

        # get city
        Route::get('/{district}/city', [EndPointDistrictController::class, 'city']);
    });

    /**
     * City Endpoint
     * index - get all json data
     * show - get one json data
     */
    Route::resource('city', EndPointCityController::class)->only('index', 'show');


    /**
     * Bank Endpoint
     */
});

/**
 * ======================================================================================
 * ==============   ADMIN =============
 * ======================================================================================
 */
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
     * Cuisine
     */
    //    Route::prefix('cuisine')->name('cuisine.')->group(function () {
    //
    //        # get all data in json datatable
    //        Route::get('data', [CuisineController::class, 'allData']);
    //
    //        # get one data in json
    //        Route::get('data/{cuisine}', [CuisineController::class, 'oneData']);
    //
    //        # restore deleted data
    //        Route::put('restore/{cuisine}', [CuisineController::class, 'restore']);
    //
    //        # update status
    //        Route::put('status/{cuisine}', [CuisineController::class, 'status']);
    //
    //        # resource- index, store, update, destory
    //        Route::resource('', CuisineController::class)->parameters(['' => 'cuisine'])->only(['index', 'store', 'update', 'destroy']);
    //    });

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
});


/**
 * ======================================================================================
 * ==============  RESTAURANT =============
 * ======================================================================================
 */




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


require __DIR__ . "/restaurant.php";
