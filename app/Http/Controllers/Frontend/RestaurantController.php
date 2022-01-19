<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::active()->get();

        return view('themes.frontend.restaurant.index', compact('restaurants'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $rest = Cache::tags(['restaurants'])->remember($slug, 120, function () use ($slug) {
            return Restaurant::with('menu', 'menu.foods')->where('slug', $slug)->active()->limit(1)->get()->first();
        });

        if (Session::exists('user-address')) {
            $user = Session::get('user-address');
        } else {
            $user = ['latitude' => $rest->latutude, 'longitude' => $rest->longitude];
        }

        $distance = round(distance($user['longitude'], $user['latitude'], $rest->longitude, $rest->latitude));
        $travelTime = roundNumber(travelTime($distance));

        return view('themes.frontend.restaurant.show', compact('rest', 'travelTime', 'distance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
