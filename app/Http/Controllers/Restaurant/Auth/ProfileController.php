<?php

namespace App\Http\Controllers\Restaurant\Auth;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\City;
use App\Models\District;
use App\Models\Restaurant;
use App\Models\RestaurantOwner;
use App\Models\RestaurantTiming;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('restaurant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # get id
        $id = Auth::guard('restaurant')->id();

        # get data
        $restaurant = Restaurant::with(['owner.bank', 'manager', 'timing',])->findOrFail($id);

        # get states
        $states = State::get();

        # get districts
        $districts = District::where('state_id', $restaurant->state_id)->get();

        # cities
        $cities = City::where('district_id', $restaurant->district_id)->get();

        # get banks
        $banks = Bank::get();

        return view('themes.restaurant.auth.profile', compact('restaurant', 'states', 'districts', 'cities', 'banks'));
    }


    /**
     * Update General Details
     */
    public function details(Request $request)
    {
        # get restaurant
        $restaurant = Restaurant::findOrFail(Auth::guard('restaurant')->id());

        # path - restaurants/restaurant_name_id
        $path = "restaurants/{$restaurant->id}/image";
        if (Storage::missing($path)) {
            Storage::makeDirectory($path);
        }

        $slug = str_replace(
            ["--", "---", "----", "-----"],
            "-",
            strtolower(
                preg_replace("/[^a-z]/i", "-", "{$request->name}-{$restaurant->address}-{$restaurant->city->name}-{$restaurant->id}")
            )
        );

        if ($request->hasFile('thumbnail')) {
            # delete old file
            if ($restaurant->thumbnail) Storage::delete($restaurant->thumbnail);

            # save restaurant thmbnail
            $file = $request->file('thumbnail');
            $url = "{$path}/thumbnail." .  $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(256, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::put($url, (string) $image->encode());
            $restaurant->thumbnail = $url;
        }

        if ($request->hasFile('bg_image')) {
            # delete old file
            if ($restaurant->bg_image) Storage::delete($restaurant->bg_image);

            # save restaurant bg image
            $file = $request->file('bg_image');
            $url = "{$path}/bg_image." . $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(1360, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::put($url, (string) $image->encode());
            $restaurant->bg_image = $url;
        }

        # update info
        $restaurant->name = $request->input('name');
        $restaurant->cuisine = $request->input('cuisine');
        $restaurant->email = $request->input('email');
        $restaurant->phone = $request->input('phone');
        $restaurant->alt_phone = $request->input('alt_phone');
        $restaurant->slug = $slug;

        $restaurant->save();

        # nofitication
        $notification = ['alert-type' => 'info', 'message' => 'Details update successfully'];

        # return back
        return back()->with($notification);
    }

    /**
     * Update Address
     */
    public function address(Request $request)
    {
        # get restaurant
        $restaurant = Restaurant::findOrFail(Auth::guard('restaurant')->id());

        # get data
        $data = $request->input();

        # update
        $restaurant->update($data);


        # nofitication
        $notification = ['alert-type' => 'info', 'message' => 'Address update successfully'];

        # return back
        return back()->with($notification);
    }

    /**
     * Update Owner
     */
    public function owner(Request $request)
    {
        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # get owner
        $owner = $restaurant->owner;

        # authorize
        $this->authorizeForUser($restaurant, 'update', $owner);

        # get input
        $data = $request->input();

        # update data
        $owner->update($data);

        # nofitication
        $notification = ['alert-type' => 'info', 'message' => 'Owner update successfully'];

        # return back
        return back()->with($notification);
    }

    /**
     * Update Manager
     */
    public function manager(Request $request)
    {
        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # get manager
        $manager = $restaurant->manager;

        # authorize
        $this->authorizeForUser($restaurant, 'update', $manager);

        # get data
        $data = $request->input();

        # update
        $manager->update($data);

        # nofitication
        $notification = ['alert-type' => 'info', 'message' => 'Manager update successfully'];

        # return back
        return back()->with($notification);
    }

    /**
     * Update Timing
     */
    public function timing(Request $request)
    {
        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # get data
        $data = $request->input();

        # loop over timing
        foreach ($restaurant->timing as $timing) {
            if ($timing->id == $data['id'][$timing->day]) {

                $timing->open = $data['open'][$timing->day];
                $timing->close = $data['close'][$timing->day];
                $timing->status =  $data['open'][$timing->day] && $data['close'][$timing->day] ? 1 : 0;
                $timing->save();
            }
        }

        # nofitication
        $notification = ['alert-type' => 'info', 'message' => 'Timing update successfully'];

        # return back
        return back()->with($notification);
    }

    /**
     * Update Document
     */
    public function document(Request $request)
    {
        # get restaurant
        $restaurant = Restaurant::findOrFail(Auth::guard('restaurant')->id());
        # get data
        $data = $request->input();

        #update
        $restaurant->update($data);

        # nofitication
        $notification = ['alert-type' => 'info', 'message' => 'Document update successfully'];

        # return back
        return back()->with($notification);
    }

    /**
     * Update FIles
     */
    public function files(Request $request)
    {
        # get restaurant
        $restaurant = Restaurant::findOrFail(Auth::guard('restaurant')->id());

        # path - restaurants/restaurant_name_id
        $path = "restaurants/{$restaurant->id}/image";
        if (Storage::missing($path)) {
            Storage::makeDirectory($path);
        }

        # save menu
        if ($request->hasFile('menu')) {
            # delete old file
            if ($restaurant->menu) Storage::delete($restaurant->menu);

            # save new file
            $file = $request->file('menu');
            $url = "menu." . $file->getClientOriginalExtension();
            $url =  Storage::putFileAs($path, $file, $url);
            $restaurant->menu = $url;
        }

        # save kyc
        if ($request->hasFile('kyc')) {
            # delete old file
            if ($restaurant->kyc) Storage::delete($restaurant->kyc);

            # save new file
            $file = $request->file('kyc');
            $url = "kyc." . $file->getClientOriginalExtension();
            $url =  Storage::putFileAs($path, $file, $url);
            $restaurant->kyc = $url;
        }

        # save fssai
        if ($request->hasFile('fssai_image')) {
            # delete old file
            if ($restaurant->fssai_image) Storage::delete($restaurant->fssai_image);

            # save new file
            $file = $request->file('fssai_image');
            $url = "fssai_image." . $file->getClientOriginalExtension();
            $url =  Storage::putFileAs($path, $file, $url);
            $restaurant->fssai_image = $url;
        }

        # save license
        if ($request->hasFile('license_image')) {
            # delete old file
            if ($restaurant->license_image) Storage::delete($restaurant->license_image);

            # save new file
            $file = $request->file('license_image');
            $url = "license." . $file->getClientOriginalExtension();
            $url =  Storage::putFileAs($path, $file, $url);
            $restaurant->license_image =  $url;
        }

        $restaurant->save();

        # nofitication
        $notification = ['alert-type' => 'info', 'message' => 'Files update successfully'];

        # return back
        return back()->with($notification);
    }

    /**
     * update password
     */
    public function password(Request $request)
    {
        # get restaurant
        $restaurant = Restaurant::findOrFail(Auth::guard('restaurant')->id());
        
        # get data
        $data = $request->input();
        //dd(!Hash::check($data['passwordOld'], $restaurant->password));
        # check current password
        if (!Hash::check($data['passwordOld'], $restaurant->password)) {
            return back()->with(['alert-type' => 'error', 'message' => 'Current password does not match']);
        }

        # validate password
        if ($data['password'] !== $data['password_confirmation']) {
            return back()->with(['alert-type' => 'error', 'message' => 'Confirm password does not match']);
        }

        # update password
        $restaurant->password = Hash::make($data['password']);
        $restaurant->save();

        # return back
        return back()->with(['alert-type' => 'info', 'message' => 'Password change successfully']);
    }
}
