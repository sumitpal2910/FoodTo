<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Restaurant;
use App\Models\RestaurantManager;
use App\Models\RestaurantOwner;
use App\Models\RestaurantTiming;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::get();

        return view('themes.frontend.restaurant.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['email' => 'unique:restaurants']);
        # get all input data
        $data = $request->input();

        # get owner data
        $owner = [
            'name' => $data['owner_name'],
            'phone' => $data['owner_phone'],
            'alt_phone' => $data['owner_alt_phone'],
            'account_no' => $data['account_no'],
            'ifsc' => $data['ifsc'],
            'bank' => $data['bank'],
        ];

        # get manager data
        $manager = [
            'name' => $data['manager_name'],
            'phone' => $data['manager_phone'],
            'alt_phone' => $data['manager_alt_phone']
        ];

        # get restaurant data
        $restaurant = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'state_id' => $data['state_id'],
            'district_id' => $data['district_id'],
            'city_id' => $data['city_id'],
            'phone' => $data['phone'],
            'alt_phone' => $data['alt_phone'],
            'gst_no' => $data['gst_no'],
            'trade_name' => $data['trade_name'],
            'license_no' => $data['license_no'],
            'fssai_no' => $data['fssai_no'],
            'address' => $data['address'],
            'locality' => $data['locality'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'pincode' => $data['pincode'],
            'status' => 0,
        ];
        # get city
        $city = City::findOrFail($data['city_id']);

        # get last insert row
        $lastData = Restaurant::get()->last();
        $id = $lastData ? $lastData->id + 1 : 1;

        # slug
        $slugOld =  preg_replace("/[^a-z]/i", '-', $restaurant['name']);
        $slug = str_replace("--", "-", strtolower(preg_replace("/[^a-z]/i", "-", "{$restaurant['name']}-{$restaurant['address']}-{$city->name}-{$id}")));
        $restaurant['slug'] = $slug;

        # create folder
        $path = "restaurants/" . str_replace("-", "_", $slugOld) . "_{$id}/image";
        if (Storage::missing($path)) {
            Storage::makeDirectory($path);
        }

        # save owner image
        if ($request->hasFile('passbook')) {
            $file = $request->file('passbook');
            $url = "passbook." . $file->getClientOriginalExtension();
            $url =  Storage::putFileAs($path, $file, $url);
            $owner['passbook'] = $url;
            $url = null;
        }

        # save restaurant thmbnail
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $url = "{$path}/thumbnail." .  $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(256, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::put($url, (string) $image->encode());

            $restaurant['thumbnail'] = $url;
            $url = null;
        }

        # save restaurant bg image
        if ($request->hasFile('bg_image')) {
            $file = $request->file('bg_image');
            $url = "{$path}/bg_image." . $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(1360, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::put($url, (string) $image->encode());

            $restaurant['bg_image'] = $url;
        }

        # save menu
        if ($request->hasFile('menu')) {
            $file = $request->file('menu');
            $url = "menu." . $file->getClientOriginalExtension();
            $url =  Storage::putFileAs($path, $file, $url);
            $restaurant['menu'] = $url;
        }

        # save kyc
        if ($request->hasFile('kyc')) {
            $file = $request->file('kyc');
            $url = "kyc." . $file->getClientOriginalExtension();
            $url =  Storage::putFileAs($path, $file, $url);
            $restaurant['kyc'] = $url;
        }

        # save fssai
        if ($request->hasFile('fssai_image')) {
            $file = $request->file('fssai_image');
            $url = "fssai_image." . $file->getClientOriginalExtension();
            $url =  Storage::putFileAs($path, $file, $url);
            $restaurant['fssai_image'] = $url;
        }

        # save license
        if ($request->hasFile('license_image')) {
            $file = $request->file('license_image');
            $url = "license." . $file->getClientOriginalExtension();
            $url =  Storage::putFileAs($path, $file, $url);
            $restaurant['license_image'] =  $url;
        }

        # create owner
        $ownerCreated = RestaurantOwner::create($owner);

        # set owner id
        $restaurant['owner_id'] = $ownerCreated->id;

        # create restaurant
        $restaurantCreated =  Restaurant::create($restaurant);

        # create manager
        $manager['restaurant_id'] = $restaurantCreated->id;
        RestaurantManager::create($manager);

        # get timing
        $timing = [];
        if ($data['timing_status']) {
            $timing = ['status' => $data['timing_status'], 'close' => $data['timing_close'], 'open' => $data['timing_open']];
        }

        # timing
        if ($timing) {
            foreach ($timing['status'] as $key => $value) {
                $time = [
                    'day' => $key, 'open' => $timing['open'][$key],
                    'close' => $timing['close'][$key], 'status' => 1,
                    'restaurant_id' => $restaurantCreated->id,
                ];

                # create timing
                RestaurantTiming::create($time);
            }
        }

        # notification
        $notification = ['alert-type' => 'success', 'message' => 'Restaurant add successfully'];

        # return index
        return redirect()->route('index')->with($notification);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
