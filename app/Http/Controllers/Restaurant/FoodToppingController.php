<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FoodToppingController extends Controller
{
    public function __construct()
    {
        $this->middleware('restaurant');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Food $food, Request $request)
    {
        $this->insert($request, $food);

        # return back
        return back()->with(['alert-type' => 'success', 'message' => "Topping added"]);
    }

    /**
     * insert new topping
     */
    public function insert(Request $request, Food $food)
    {
        # get toppings data
        $data = [
            'name' => $request->input('topping_name'),
            'price' => $request->input('topping_price'),
            'qty' => $request->input('topping_qty'),
            'type' => $request->input('topping_type'),
            'food_id' => $request->input('food_id'),
        ];

        # add toppings
        for ($i = 0; $i < count($data['name']); $i++) {
            if ($data['name'][$i] && $data['price'][$i]) {
                Topping::create([
                    'name' => $data['name'][$i],
                    'price' => $data['price'][$i],
                    'qty' => $data['qty'][$i],
                    'type' => $data['type'][$i],
                    'food_id' => $food->id,
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food, $topping)
    { # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        $data = Topping::withTrashed()->findOrFail($topping);

        # authorize
        $this->authorizeForUser($restaurant, 'view', $data);

        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food, $topping)
    {
        # get topping
        $topping = Topping::withTrashed()->findOrFail($topping);

        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # get data
        $data = $request->all();

        # authorize
        $this->authorizeForUser($restaurant, 'update', $topping);

        # update
        $topping->update($data);

        # return resposne
        return response()->json(['status' => 'success', 'message' => 'Topping updated', 'data' => $topping]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food, $topping)
    {
        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # get data
        $data = Topping::withTrashed()->findOrFail($topping);

        # authorize
        $this->authorizeForUser($restaurant, 'delete', $data);

        # delete
        $data->trashed() ? $data->forceDelete() : $data->delete();

        # return response
        return response()->json(['status' => 'success', 'message' => 'Topping deleted', 'data' => $data]);
    }

    /**
     * Restore
     */
    public function restore(Request $request, Food $food, $topping)
    {
        # get data
        $topping = Topping::withTrashed()->findOrFail($topping);

        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # authorize
        $this->authorizeForUser($restaurant, 'update', $topping);

        # restore
        if ($topping->trashed()) $topping->restore();

        # return response
        return response()->json(['status' => 'success', 'message' => 'Topping Restore', 'data' => $topping]);
    }

    /**
     * update status
     */
    public function updateStatus(Request $request, Food $food, Topping $topping)
    {
        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # authorize
        $this->authorizeForUser($restaurant, 'update', $topping);

        # update
        $topping->status === 0 ? $topping->status = 1 : $topping->status = 0;
        $topping->save();

        # return response
        return response()->json(['status' => 'success', 'message' => 'Topping status changed', 'data' => $topping]);
    }

    /**
     * all data
     */
    public function allData($food)
    {
        $food = Food::with(['toppings' => function ($query) {
            $query->withTrashed();
        }])->withTrashed()->findOrFail($food);

        $response = $this->tableData($food->toppings);

        return response()->json(['data' => $response]);
    }

    /**
     * all data
     */
    public function dataJson($food)
    {
        $food = Food::with(['toppings' => function ($query) {
            $query->withTrashed();
        }])->withTrashed()->findOrFail($food);


        return response()->json(['data' => $food]);
    }
    /**
     * get data table rows
     */
    protected function tableData($topping)
    {
        $response = [];

        # loop over all datas
        foreach ($topping as $key => $data) {
            # type
            $name = $data->type == 0 ? "<i class='veg-indian-vegetarian'></i> " : "<i class='fas fa-caret-up non-veg-icon'></i> ";

            # assign name
            $name .= $data->trashed() ? "<del class='text-muted'>{$data->name} (Deleted)</del>" : $data->name;

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
                           <button data-toggle="modal" data-target="#editModal"  data="' . $data->id . '"
                               class="edit btn btn-sm btn-outline-info "><i class="fas fa-pencil-alt"></i>
                        </button>';

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
                                <button data-toggle="modal" data-target="#editModal"  data="' . $data->id . '"
                                    class="edit btn btn-sm btn-outline-info "><i class="fas fa-pencil-alt"></i>
                                </button>
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
                'name' => $name,
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
