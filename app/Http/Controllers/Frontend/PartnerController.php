<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\City;
use App\Models\Cuisine;
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

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRestaurant()
    {
        # get states
        $states = State::get();
        $banks = Bank::get();

        return view('themes.frontend.partner.restaurant', compact('states', 'banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRestaurant(Request $request)
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
            'bank_id' => $data['bank_id'],
        ];

        # get manager data
        $manager = [
            'name' => $data['manager_name'],
            'phone' => $data['manager_phone'],
            'alt_phone' => $data['manager_alt_phone']
        ];

        # get restaurant data
        $restaurant = $request->all([
            'state_id',
            'district_id',
            'city_id',
            'name',
            'email',
            'phone',
            'cuisine',
            'alt_phone',
            'gst_no',
            'trade_name',
            'license_no',
            'fssai_no',
            'full_address',
            'landmark',
            'area',
            'cuisine',
            'latitude',
            'longitude',
            'pincode',
        ]);
        $restaurant['password'] = Hash::make($data['password']);

        # get city
        $city = City::findOrFail($data['city_id']);

        # get last insert row
        $lastData = Restaurant::get()->last();
        $id = $lastData ? $lastData->id + 1 : 1;

        # slug
        $slugOld =  preg_replace("/[^a-z]/i", '-', $restaurant['name']);
        $slug = str_replace(
            ["--", "---", "----"],
            "-",
            strtolower(preg_replace("/[^a-z0-9]/i", "-", "{$restaurant['name']}-{$restaurant['address']}-{$city->name}-{$id}"))
        );
        $restaurant['slug'] = $slug;

        # create folder
        $path = "restaurants/{$id}/image";
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
        $timing = ['day' => $data['timing_day'], 'close' => $data['timing_close'], 'open' => $data['timing_open']];

        foreach ($timing['day'] as $day) {
            $time = new RestaurantTiming();
            $time->day = $day;
            $time->open = $timing['open'][$day];
            $time->close = $timing['close'][$day];
            $time->status = $timing['open'][$day] && $timing['close'][$day] ? 1 : 0;
            $time->restaurant_id = $restaurantCreated->id;
            $time->save();
        }

        # notification
        $notification = ['alert-type' => 'success', 'message' => 'Restaurant add successfully'];

        # return index
        return redirect()->route('index')->with($notification);
    }
}
