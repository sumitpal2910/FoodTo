<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\EndPoint\CityController as EndPointCityController;
use App\Http\Controllers\EndPoint\DistrictController as EndPointDistrictController;
use App\Http\Controllers\EndPoint\StateController as EndPointStateController;
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
        Route::get('/{state}/city', [EndPointStateController::class, 'city']);
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
    });

    /**
     * City Endpoint
     * index - get all json data
     * show - get one json data
     */
    Route::resource('city', EndPointCityController::class)->only('index', 'show');
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
    Route::prefix('service')->group(function () {
        // ===  State   ===
        Route::prefix('state')->group(function () {
            # get all data in json
            Route::get('data', [StateController::class, 'allData']);

            # get one data in json
            Route::get('data/{state}', [StateController::class, 'oneData']);

            # restore deleted data
            Route::put('restore/{state}', [StateController::class, 'restore']);

            # update status
            Route::put('status/{state}', [StateController::class, 'status']);
        });
        # state resource
        Route::resource('state', StateController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

        // ===  District  ===
        Route::prefix('district')->group(function () {
            # get all data in json
            Route::get('data', [DistrictController::class, 'allData']);

            # get one data in json
            Route::get('data/{district}', [DistrictController::class, 'oneData']);

            # restore deleted data
            Route::put('restore/{district}', [DistrictController::class, 'restore']);

            # update status
            Route::put('status/{district}', [DistrictController::class, 'status']);
        });
        # district resource
        Route::resource('district', DistrictController::class)->only(['index', 'store', 'update', 'destroy']);


        // ===  City  ===
        Route::prefix('city')->group(function () {
            # get all data in json
            Route::get('data', [CityController::class, 'allData']);

            # get one data in json
            Route::get('data/{city}', [CityController::class, 'oneData']);

            # restore deleted data
            Route::put('restore/{city}', [CityController::class, 'restore']);

            # update status
            Route::put('status/{city}', [CityController::class, 'status']);
        });
        # city resource
        Route::resource('city', CityController::class)->only(['index', 'create', 'store', 'update', 'destroy']);
    });
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
