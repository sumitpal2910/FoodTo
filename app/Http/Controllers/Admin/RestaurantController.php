<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Owner;
use App\Models\Restaurant;
use App\Models\RestaurantManager;
use App\Models\RestaurantTiming;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Stringable;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # get count
        $count = Restaurant::withTrashed()->count();

        # get data
        $states = State::get();

        # show index page
        return view('themes.admin.restaurant.index', compact('count', 'states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        # get data
        //        $states = State::get();
        //
        //        # show index page
        //        return view('themes.admin.restaurant.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # get all input data
        $data = $request->input();

        # get owner data
        $owner = [
            'name' => $data['owner_name'], 'email' => $data['email'],
            'password' => Hash::make($data['password']), 'phone' => $data['owner_phone'],
            'alt_phone' => $data['owner_alt_phone'], 'email_verified_at' => now()
        ];

        # get manager data
        $manager = ['name' => $data['manager_name'], 'phone' => $data['manager_phone'], 'alt_phone' => $data['manager_alt_phone']];

        # get restaurant data
        $restaurant = [
            'name' => $data['name'],
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
            'pincode' => $data['pincode'],
            'status' => 1,
        ];

        # get city
        $city = City::findOrFail($data['city_id']);
        # slug
        $slugOld = str_replace("--", "-", preg_replace("/[^a-z]/i", '-', $restaurant['name']));
        $slug = strtolower("{$slugOld}-{$restaurant['address']}-{$city->name}-{$data['id']}");
        $restaurant['slug'] = $slug;

        # create folder
        $path = "restaurants/" . str_replace("-", "_", $slugOld) . "_{$restaurant['id']}/image";
        if (Storage::missing($path)) {
            Storage::makeDirectory($path);
        }

        # save owner image
        if ($request->hasFile('owner_image')) {
            $file = $request->file('owner_image');
            $url = "{$path}/owner." . $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(256, 256);
            Storage::put($url, (string) $image->encode());
            $owner['image'] = $url;
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
        $ownerCreated = Owner::create($owner);

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
        return redirect()->route('admin.restaurant.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RestaurantOwner  $restaurantOwner
     * @return \Illuminate\Http\Response
     */
    public function show($restaurantOwner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RestaurantOwner  $restaurantOwner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        # get restaurant with relation
        //        $restaurant = Restaurant::with('owner', 'manager', 'timing')->withTrashed()->findOrFail($id);
        //        $states = State::get();
        //
        //        return view('themes.admin.restaurant.edit', compact('restaurant', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RestaurantOwner  $restaurantOwner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $restaurantOwner)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RestaurantOwner  $restaurantOwner
     * @return \Illuminate\Http\Response
     */
    public function destroy($restaurant)
    {
        # get data
        $data = Restaurant::withTrashed()->findOrFail($restaurant);

        # delete
        $data->trashed() ? $data->forceDelete() : $data->delete();

        # return json
        return response()->json(['status' => 'success', 'message' => 'Restaurant deleted successfully', 'data' => $data]);
    }

    /**
     * restore soft deleted data
     */
    public function restore(Request $request, $restaurant)
    {
        # restore and get data
        $data = Restaurant::withTrashed()->findOrFail($restaurant)->restore();

        # return success json
        return response()->json(['status' => 'success', 'message' => 'Restaurant restored successfully', 'data' => $data]);
    }

    /**
     * update status
     */
    public function status(Request $request, Restaurant $restaurant)
    {
        # get value
        $value = $request->input('value');

        $restaurant->status = $value;
        $restaurant->save();

        # return json
        return response()->json(['status' => 'success', 'message' => 'Restaurant Status Changed', 'data' => $restaurant]);
    }
    /**
     *
     */
    /**
     * show all data in json
     */
    public function allData()
    {
        # get data
        $restaurants = Restaurant::with(['owner', 'manager'])->withTrashed()->latest()->limit(100)->get();

        $response = [];

        # loop over all restaurants
        foreach ($restaurants as $key => $data) {
            # assign name
            $name = $data->trashed() ? "<del class='text-muted'>{$data->name} (Deleted)</del> " : $data->name;

            # assign phone
            $phone =  "{$data->phone} <br> {$data->alt_phone}";

            # asssign owner
            $owner = "{$data->owner->name} <br>  {$data->owner->phone} ";

            # assign manager
            $manager = " {$data->manager->name} <br> {$data->manager->phone} ";

            # assign address
            $address = "<address>{$data->address}, {$data->city->name}, {$data->pincode}</address>";

            # image
            if ($data->thumbnail) {
                $image = "<img width='40px' src='" . Storage::url($data->thumbnail) . "'>";
            } else {
                $image = "<img width='40px' src='" . Storage::url('asset/default/user.png') . "'>";
            }

            # status
            if ($data->status === 0) {
                $status = "<span class='badge badge-pill badge-info'>Pending Listed</span>";
            } else if ($data->status === 1) {
                $status = "<span class='badge badge-pill badge-success'>Active</span>";
            } else if ($data->status === 2) {
                $status = "<span class='badge badge-pill badge-secondary'>Delisted</span>";
            } else if ($data->status === 3) {
                $status = "<span class='badge badge-pill badge-danger'>Reject</span>";
            }

            # action button
            $action = '<div class="row">';

            if ($data->status == 0) {
                $action .=  '<button title="Approve" type="button" data="1" id="' . $data->id . '" class="status btn btn-outline-success ml-3">
                                    <i class="fas fa-check"></i></button>
                            <button title="Reject" type="button" data="3" id="' . $data->id . '" class="status btn btn-outline-warning ml-3">
                                    <i class="fas fa-times"></i></button>';
            } else if ($data->status === 1) {
                $action .=  '<button title="Delist" type="button" data="2" id="' . $data->id . '" class="status btn btn-outline-warning ml-3">
                                <i class="fas fa-arrow-down"></i></button>';
            } else if ($data->status === 2) {
                $action .=  '<button title="Approve" type="button" data="1" id="' . $data->id . '" class="status btn btn-outline-success ml-3">
                                    <i class="fas fa-check"></i></button>
                            <button title="Pending" type="button" data="0" id="' . $data->id . '" class="status btn btn-outline-warning ml-3">
                                    <i class="fas fa-arrow-down"></i></button>';
            } else if ($data->status === 3) {
                $action .=  '<button title="Approve" type="button" data="0" id="' . $data->id . '" class="status btn btn-outline-success ml-3">
                                <i class="fas fa-check"></i></button>';
            }


            $action .= '<button title="Delete" id="' . $data->id . '" class="delete btn btn-outline-danger ml-3">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

            # deleted data action buttons
            if ($data->trashed()) {
                $action = '<div class="row">
                                <button title="Restore" id="' . $data->id . '" class="restore btn btn-outline-primary ml-3">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                                <button title="Permanant Delete" id="' . $data->id . '" class="delete btn btn-outline-danger ml-3">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>';

                # status
                $status =  "<span class='badge badge-pill badge-danger'>Deleted</span>";
            };

            $tableData = [
                '#' => $key + 1, 'image' => $image, 'name' => $name, 'phone' => $phone,
                'address' => $address, 'owner' => $owner, 'manager' => $manager, 'status' => $status,  'action' => $action
            ];
            array_push($response, $tableData);
        }

        return response()->json(['data' => $response]);
    }

    /**
     * search
     */
    public function search(Request $request)
    {
        # get request param
        $status =  intval($request->input('status'));
        $stateId = intval($request->input('state_id'));
        $districtId = intval($request->input('district_id'));
        $cityId = intval($request->input('city_id'));

        # condition
        $stateCondition = $stateId ? ['state_id', '=', $stateId] : ['state_id', '!=', null];

        $districtCondition = $districtId ? ['district_id', '=', $districtId] : ['district_id', '!=', null];

        $cityCondition = $cityId ? ['city_id', '=', $cityId] : ['city_id', '!=', null];

        # status condition
        $statusCondition = $status == 5 ? ['status', '!=', null] : ['status', '=', $status];

        # condition
        $condition = [$stateCondition, $districtCondition, $cityCondition, $statusCondition];


        # get search data
        $restaurants = Restaurant::with(['owner', 'manager'])->where($condition)->withTrashed()->latest()->get();

        $response = [];

        # loop over all restaurants
        foreach ($restaurants as $key => $data) {
            # assign name
            $name = $data->trashed() ? "<del class='text-muted'>{$data->name} (Deleted)</del> " : $data->name;

            # assign phone
            $phone =  "{$data->phone} <br> {$data->alt_phone}";

            # asssign owner
            $owner = "{$data->owner->name} <br>  {$data->owner->phone} ";

            # assign manager
            $manager = " {$data->manager->name} <br> {$data->manager->phone} ";

            # assign address
            $address = "<address>{$data->address}, {$data->city->name}, {$data->pincode}</address>";

            # image
            if ($data->thumbnail) {
                $image = "<img width='40px' src='" . Storage::url($data->thumbnail) . "'>";
            } else {
                $image = "<img width='40px' src='" . Storage::url('asset/default/user.png') . "'>";
            }

            # status
            if ($data->status === 0) {
                $status = "<span class='badge badge-pill badge-info'>Pending Listed</span>";
            } else if ($data->status === 1) {
                $status = "<span class='badge badge-pill badge-success'>Active</span>";
            } else if ($data->status === 2) {
                $status = "<span class='badge badge-pill badge-secondary'>Delisted</span>";
            } else if ($data->status === 3) {
                $status = "<span class='badge badge-pill badge-danger'>Reject</span>";
            }

            # action button
            $action = '<div class="row">';

            if ($data->status == 0) {
                $action .=  '<button title="Approve" type="button" data="1" id="' . $data->id . '" class="status btn btn-outline-success ml-3">
                                    <i class="fas fa-check"></i></button>
                            <button title="Reject" type="button" data="3" id="' . $data->id . '" class="status btn btn-outline-warning ml-3">
                                    <i class="fas fa-times"></i></button>';
            } else if ($data->status === 1) {
                $action .=  '<button title="Delist" type="button" data="2" id="' . $data->id . '" class="status btn btn-outline-warning ml-3">
                                <i class="fas fa-arrow-down"></i></button>';
            } else if ($data->status === 2) {
                $action .=  '<button title="Approve" type="button" data="1" id="' . $data->id . '" class="status btn btn-outline-success ml-3">
                                    <i class="fas fa-check"></i></button>
                            <button title="Pending" type="button" data="0" id="' . $data->id . '" class="status btn btn-outline-warning ml-3">
                                    <i class="fas fa-arrow-down"></i></button>';
            } else if ($data->status === 3) {
                $action .=  '<button title="Approve" type="button" data="0" id="' . $data->id . '" class="status btn btn-outline-success ml-3">
                                <i class="fas fa-check"></i></button>';
            }


            $action .= '<button title="Delete" id="' . $data->id . '" class="delete btn btn-outline-danger ml-3">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

            # deleted data action buttons
            if ($data->trashed()) {
                $action = '<div class="row">
                                <button title="Restore" id="' . $data->id . '" class="restore btn btn-outline-primary ml-3">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                                <button title="Permanant Delete" id="' . $data->id . '" class="delete btn btn-outline-danger ml-3">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>';

                # status
                $status =  "<span class='badge badge-pill badge-danger'>Deleted</span>";
            };

            $tableData = [
                '#' => $key + 1, 'image' => $image, 'name' => $name, 'phone' => $phone,
                'address' => $address, 'owner' => $owner, 'manager' => $manager, 'status' => $status,  'action' => $action
            ];
            array_push($response, $tableData);
        }

        return response()->json(['data' => $response]);
    }
}
