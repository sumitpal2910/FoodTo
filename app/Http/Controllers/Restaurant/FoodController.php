<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\FoodTiming;
use App\Models\FoodTopping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FoodController extends Controller
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
        # get count
        $count = Food::where('restaurant_id', Auth::guard('restaurant')->id())->count();

        # show  index page
        return view('themes.restaurant.food.index', compact('count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        # get restaurant Timing
        $restaurantTiming = Auth::guard('restaurant')->user()->timing;

        # show create page
        return view('themes.restaurant.food.create', compact('restaurantTiming'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # get last insert food
        $lastFood = Food::get()->last();
        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # get food data
        $foodData = $request->all(['name', 'price', 'description', 'qty', 'type']);

        # get timing data
        $timingData = $request->all(['day', 'open', 'close', 'status']);


        # slug
        $slug = strtolower(str_replace(["--", "---", "----", "-----"], "-", preg_replace("/[^a-z]/i", "-", $foodData['name'])));
        $foodData['slug'] = $slug . "-" .  $lastFood ? $lastFood->id + 1 : 1;
        $foodData['restaurant_id'] = $restaurant->id;

        # make directory
        $path = "restaurants/{$restaurant->id}/foods";
        if (Storage::missing($path)) Storage::makeDirectory($path);

        # save image
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $url = $path . "/" . hexdec(uniqid()) . "." . $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(512, null, function ($const) {
                $const->aspectRatio();
            });
            Storage::put($url, (string) $image->encode());
            $foodData['thumbnail'] = $url;
        }

        # add food
        $food = Food::create($foodData);

        # add food id to topping
        $request->request->add(['food_id' => $food->id]);

        # insert topping
        $topping = new FoodToppingController();
        $topping->insert($request, $food);

        # add timing
        foreach ($timingData['status'] as $day => $status) {
            $time = new FoodTiming();
            $time->day = $day;
            $time->open = $timingData['open'][$day];
            $time->close = $timingData['close'][$day];
            $time->status = 1;
            $time->food_id = $food->id;
            $time->save();
        }

        # return to food page
        return redirect()->route('restaurant.food.index')->with(['alert-type' => 'success', 'message' => 'Food add successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($food)
    {
        # get food
        $food = Food::with(['toppings' => function ($query) {
            $query->withTrashed();
        }, 'timing'])->withTrashed()->findOrFail($food);

        $this->authorizeForUser($this->restaurnat(), 'update', $food);


        # get restaurant Timing
        $restaurantTiming = Auth::guard('restaurant')->user()->timing;

        # show edit page
        return view('themes.restaurant.food.edit', compact('food', 'restaurantTiming'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $food)
    {
        # get food
        $food = Food::withTrashed()->findOrFail($food);

        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # authorize
        $this->authorizeForUser($restaurant, 'update', $food);

        # make directory
        $path = "restaurants/{$restaurant->id}/foods";
        if (Storage::missing($path)) Storage::makeDirectory($path);

        # get all data
        $data = $request->input();

        # update image
        if ($request->hasFile('thumbnail')) {
            # unline old file
            if ($food->thumbnail) Storage::delete($food->thumbnail);

            # save new file
            $file = $request->file('thumbnail');
            $url = $path . "/" . hexdec(uniqid()) . "." . $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(512, null, function ($const) {
                $const->aspectRatio();
            });
            Storage::put($url, (string) $image->encode());
            $data['thumbnail'] = $url;
        }

        # update data
        $food->update($data);

        # return back
        return back()->with(['alert-type' => 'info', 'message' => 'Food updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($food)
    {
        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        $data = Food::withTrashed()->findOrFail($food);

        # authorize
        $this->authorizeForUser($restaurant, 'delete', $data);


        if ($data->trashed()) {
            # delete image
            if ($data->thumbnail) Storage::delete($data->thumbnail);

            # delete
            $data->forceDelete();
        } else {
            $data->delete();
        }

        # return response
        return response()->json(['status' => 'success', 'message' => 'Food deleted', 'data' => $data]);
    }

    /**
     * Restore
     */
    public function restore(Request $request, $food)
    {
        # get data
        $food = Food::withTrashed()->findOrFail($food);

        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # authorize
        $this->authorizeForUser($restaurant, 'update', $food);

        # restore
        if ($food->trashed()) $food->restore();

        # return response
        return response()->json(['status' => 'success', 'message' => 'Food Restored', 'data' => $food]);
    }

    /**
     * update status
     */
    public function updateStatus(Request $request, Food $food)
    {
        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # authorize
        $this->authorizeForUser($restaurant, 'update', $food);

        # update
        $food->status === 0 ? $food->status = 1 : $food->status = 0;
        $food->save();

        # return response
        return response()->json(['status' => 'success', 'message' => 'Food status changed', 'data' => $food]);
    }

    /**
     * get all data in json
     */
    public function allData(Request $request)
    {
        # get status
        $status = $request->input('status');
        $condition = [['restaurant_id', '=', Auth::guard('restaurant')->id()]];

        # search by status, all:0, active:1, inactive:2, deleted:3
        switch ($status) {
            case 1:
                $foods = Food::with('toppings', 'timing')->where($condition)->where('status', 1)->latest()->get();
                break;
            case 2:
                $foods = Food::with('toppings', 'timing')->where($condition)->where('status', 0)->latest()->get();
                break;
            case 3:
                $foods = Food::with('toppings', 'timing')->where($condition)->onlyTrashed()->latest()->get();
                break;
            default:
                $foods = Food::with('toppings', 'timing')->where($condition)->withTrashed()->latest()->get();
                break;
        }

        $response = $this->tableData($foods);

        # return
        return response()->json(['data' => $response]);
    }

    /**
     * get data table rows
     */
    protected function tableData($foods)
    {
        $response = [];

        # loop over all datas
        foreach ($foods as $key => $data) {
            # veg / nonveg
            $name = $data->type == 0 ? "<i class='veg-indian-vegetarian'></i> " : "<i class='fas fa-caret-up non-veg-icon'></i> ";
            # assign name
            $name .= $data->trashed() ? "<del class='text-muted'>{$data->name} (Deleted)</del> " : $data->name;

            # available day
            $available = '<a href="#" data-toggle="modal" data-target="#timingModal" class=" badge badge-pill text-primary showTiming"
                           title="Show Timing" data="' . $data->id . '"> ' . count($data->timing) . ' days</a>';

            # image
            if ($data->thumbnail) {
                $image =  "<img width='40px' src='" . Storage::url($data->thumbnail) . "'>";
            } else {
                $image =  "<img width='40px' src='" . Storage::url('asset/default-image.png') . "'>";
            }

            # topping
            $topping = "<a href='#' data-toggle='modal' data-target='#toppingModal' class='badge badge-pill badge-success showTopping'
                            title='Show Toppings' data='{$data->id}'>" . count($data->toppings)  . "</a>";

            # quantity
            if ($data->qty >= 20) {
                $quantity = "<span class='badge badge-pill badge-success'>{$data->qty}</span>";
            } else if ($data->qty < 20 && $data->qty >= 10) {
                $quantity = "<span class='badge badge-pill badge-warning'>{$data->qty}</span>";
            } else {
                $quantity = "<span class='badge badge-pill badge-danger'>{$data->qty}</span>";
            }

            # status
            if ($data->status == 1) {
                $status = "<span class='badge badge-pill badge-success'>Active</span>";
            } else {
                $status = "<span class='badge badge-pill badge-warning'>Inactive</span>";
            }

            # action button
            $action = '<div class="row">
                           <a href="' . route('restaurant.food.edit', ['food' => $data->id]) .  '"
                               class="edit btn btn-sm btn-outline-info "><i class="fas fa-pencil-alt"></i></a>';

            if ($data->status == 1) {
                $action .=  '<button title="Inactive" type="button" data="' . $data->id . '" class="status btn btn-sm btn-outline-warning ml-3">
                                                <i class="fas fa-arrow-down"></i></button>';
            } else {
                $action .=  '<button title="Active" type="button" data="' . $data->id . '" class="status btn btn-sm btn-outline-success ml-3">
                                                <i class="fas fa-arrow-up"></i></button>';
            }

            $action .= '<button title="Delete" data="' . $data->id . '" class="delete btn btn-sm btn-outline-danger ml-3">
                               <i class="fas fa-trash"></i>
                           </button>
                       </div>';

            # deleted data action buttons
            if ($data->trashed()) {
                $action = '<div class="row">
                                <a href="' . route('restaurant.food.edit', ['food' => $data->id]) .  '"
                                    class="edit btn btn-sm btn-outline-info "><i class="fas fa-pencil-alt"></i>
                                </a>
                               <button title="Restore" data="' . $data->id . '" class="restore btn btn-sm btn-outline-primary ml-3">
                                   <i class="fas fa-trash-restore"></i>
                               </button>
                               <button title="Permanant Delete" data="' . $data->id . '" class="delete btn btn-sm btn-outline-danger ml-3">
                                   <i class="fas fa-trash"></i>
                               </button>
                           </div>';

                # status
                $status =  "<span class='badge badge-pill badge-danger'>Deleted</span>";
            };

            $tableData = [
                '#' => $key + 1,
                'image' => $image,
                'name' => $name,
                'toppings' => $topping,
                'available' => $available,
                'quantity' => $quantity,
                'price' => "&#8377; {$data->price}",
                'status' => $status,
                'action' => $action
            ];
            array_push($response, $tableData);
        }

        # return data
        return $response;
    }
}
