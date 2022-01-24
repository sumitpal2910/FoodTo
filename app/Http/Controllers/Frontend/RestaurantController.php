<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Models\Menu;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::get();


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
        //$rest = Cache::tags(['restaurants'])->remember($slug, now()->addMinutes(2), function () use ($slug) {
        //    return Restaurant::with('todayTiming')->with('menus', 'menus.foods', 'menus.foods.toppings')
        //        ->where('slug', $slug)->limit(1)->get()->first();
        //});

        $rest = Restaurant::with('todayTiming', 'menus')->with(['menus.foods' => function ($query) {
            $query->withCount('toppings');
        }])
            ->where('slug', $slug)->limit(1)->get()->first();

        //dd($rest);
        if (Session::exists('user-address')) {
            $user = Session::get('user-address');
        } else {
            $user = ['lat' => $rest->lat, 'long' => $rest->long];
        }

        $distance = round(distance($user['long'], $user['lat'], $rest->long, $rest->lat));
        $travelTime = roundNumber(travelTime($distance));

        return view('themes.frontend.restaurant.show', compact('rest', 'travelTime', 'distance'));
    }

    /**
     * get restauant data in json
     */
    public function dataJson($slug)
    {
        //$rest = Cache::tags(['restaurants'])->remember($slug, now()->addMinutes(2), function () use ($slug) {
        //    return Restaurant::with('todayTiming')->with('menus', 'menus.foods', 'menus.foods.toppings')
        //        ->where('slug', $slug)->limit(1)->get()->first();
        //});

        $rest = Restaurant::where('slug', $slug)->limit(1)->get()->first();

        # get menus and foods
        $data = Menu::with(['foods' => function ($query) {
            $query->withCount('toppings');
        }])->where('restaurant_id', $rest->id)->get();


        # get cart items session
        $cartItems = Session::get('cartItems');


        return response()->json(['data' => ['menus' => $data, 'cartItems' => $cartItems]]);
    }
}
