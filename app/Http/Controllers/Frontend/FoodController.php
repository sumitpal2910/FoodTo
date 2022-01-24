<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Show Food with all Toppings
     */
    public function toppings($foodId)
    {
        # get data
        $food = Food::with('toppings')->findOrFail($foodId);

        # return response
        return response()->json(['status' => 200, 'statusText' => 'success', 'data' => $food]);
    }
}
