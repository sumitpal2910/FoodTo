<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\Topping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Cart::content();
        //dd(Session::all());

        # return response
        return  response()->json(['status' => 200, 'statusText' => 'success', 'data' => $data, 'count' => $data->count(), 'total' => Cart::total()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # declare variable
        $hasToppings = false;
        $toppingsStatus = null;
        $toppinsItem = [];
        $price = 0;

        # get ids
        $restId = (int) $request->input('restaurant_id');
        $foodId = (int) $request->input('food_id');

        # if restaurant is not same delete all item in cart
        $filtered = Cart::content()->filter(function ($item, $key) use ($restId) {
            return $item->options['restaurant_id'] !== $restId;
        });

        # delete cart
        if (count($filtered->all()) > 0) {
            Cart::destroy();
            Session::forget("cartItems");
        }

        # if has toppings
        if ($request->has('toppings')) {
            # get toppings that are selected
            $toppingsStatus = $request->input('toppings');

            # get toppings id
            $toppingsId = array_keys($toppingsStatus);

            # get toppings
            $toppings = Topping::whereIn('id', $toppingsId)->get();

            # loop over toppings and push in toppingsItem
            foreach ($toppings as $item) {
                $arr = ['id' => $item->id, 'name' => $item->name, 'price' => $item->price, 'veg' => $item->veg];
                array_push($toppinsItem, $arr);
                $price += $item->price;
            }

            # set has toppings true
            $hasToppings = true;
        }

        # get restaurant and food
        $rest = Restaurant::findOrFail($restId);
        $food = Food::findOrFail($foodId);

        # add to card
        $cart =  Cart::add([
            'id' => $food->id, 'name' => $food->name, 'price' => $food->price + $price, 'weight' => 0, 'qty' => 1,
            'options' => [
                'veg' => $food->veg,
                'toppings' => $toppinsItem,
                'hasToppings' => $hasToppings,
                'restaurant_id' => $rest->id,
                'restaurant_name' => $rest->name,
            ],
        ]);


        # put food in session
        if (!Session::exists("cartItems")) {
            Session::put("cartItems", []);
        }
        $arr =  ['id' => $cart->id, 'name' => $food->name, 'qty' => $cart->qty, 'hasToppings' => $cart->options['hasToppings'], 'rowId' => $cart->rowId];
        Session::put("cartItems.{$cart->id}", $arr);

        $cart = Cart::content();

        return response()->json(['data' => $arr]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Search if restaurant same or not
     */
    public function search(Request $request)
    {
        # get restaurnt id
        $restId = (int) $request->input('restaurant_id');

        # filter
        $filtered = Cart::content()->filter(function ($item, $key) use ($restId) {
            return $item->options['restaurant_id'] !== $restId;
        });

        # return result
        return response()->json(['status' => 200, 'result' => count($filtered) == 0 ? true : false, 'data' => $filtered->all()]);
    }

    /**
     * Increment Quantity
     */
    public function increment(Request $request)
    {
        # get row id
        $rowId = $request->input('rowId');

        # get food from cart
        $cartFood = Cart::get($rowId);

        # get food
        $food = Food::findOrFail($cartFood->id);

        //if ($food->left_qty <= $cartFood->qty) {
        //    return response()->json(['result' => false, 'message' => 'You have reached the food limit']);
        //} else {
        Cart::update($rowId, $cartFood->qty + 1);

        # update in session
        //$cartItem = Session::get('cartItems')[$cartFood->id]['qty'];
        $sess = Session::get("cartItems.{$food->id}");
        $sess['qty'] += 1;
        Session::put("cartItems.{$food->id}", $sess);

        //}
    }

    /**
     * Decrement
     */
    public function decrement(Request $request)
    {
        # get row id
        $rowId = $request->input('rowId');

        # get food from cart
        $cartFood = Cart::get($rowId);

        # update
        $cart = Cart::update($rowId, $cartFood->qty - 1);

        # update session
        if (!$cart) {
            Session::forget("cartItems.{$cartFood->id}");
        } else {
            $sess = Session::get("cartItems.{$cartFood->id}");
            $sess['qty'] -= 1;
            Session::put("cartItems.{$cartFood->id}", $sess);
        }
        return;
    }
}
