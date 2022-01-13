<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\FoodTiming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodTimingController extends Controller
{
    public function __construct()
    {
        $this->middleware('restaurant');
    }
    /**
     * show a data
     */
    public function show(Food $food, $timing)
    {
        # get timing
        $timing = $food->timing()->withTrashed()->findOrFail($timing);

        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # authorize
        $this->authorizeForUser($restaurant, 'view', $timing);

        # return respose
        return response()->json(['data' => $timing]);
    }

    /**
     * Store a new data
     */
    public function store(Request $request, Food $food)
    {
        # insert data
        $data =  $food->timing()->create($request->input());

        # return response
        return response()->json(['status' => 'success', 'message' => 'Timing added', 'data' => $data]);
    }

    /**
     * Update data
     */
    public function update(Request $request, Food $food,  $timing)
    {
        # get timing
        $timing = $food->timing()->withTrashed()->findOrFail($timing);

        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # authorize
        $this->authorizeForUser($restaurant, 'update', $timing);

        # update
        $timing->update($request->input());

        # return response
        return response()->json(['stauts' => 'success', 'message' => 'Time updated', 'data' => $timing]);
    }

    /**
     * Delete a data
     */
    public function destroy(Food $food, $timing)
    {
        # get timing
        $timing = $food->timing()->withTrashed()->findOrFail($timing);

        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # authorize
        $this->authorizeForUser($restaurant, 'delete', $timing);

        # delete
        $timing->trashed() ? $timing->forceDelete() : $timing->delete();

        # reutnr resposne
        return response()->json(['stauts' => 'success', 'message' => 'Time deleted', 'data' => $timing]);
    }

    /**
     * Restore
     */
    public function restore(Request $request, Food $food, $timing)
    {
        # get data
        $timing = FoodTiming::withTrashed()->findOrFail($timing);

        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # authorize
        $this->authorizeForUser($restaurant, 'update', $timing);

        # restore
        if ($timing->trashed()) $timing->restore();

        # return response
        return response()->json(['status' => 'success', 'message' => 'Timing Restore', 'data' => $timing]);
    }

    /**
     * update status
     */
    public function updateStatus(Request $request, Food $food, FoodTiming $timing)
    {
        # get restaurant
        $restaurant = Auth::guard('restaurant')->user();

        # authorize
        $this->authorizeForUser($restaurant, 'update', $timing);

        # update
        $timing->status === 0 ? $timing->status = 1 : $timing->status = 0;
        $timing->save();

        # return response
        return response()->json(['status' => 'success', 'message' => 'Timing status changed', 'data' => $timing]);
    }

    /**
     * get all data in datatable json
     */
    public function allData(Food $food)
    {
        return response()->json(['data' => $this->tableData($food->timing()->withTrashed()->get())]);
    }

    /**
     * datatable row
     */
    protected function tableData($timings)
    {
        $response = [];

        # loop over all datas
        foreach ($timings as $key => $data) {
            # assign name
            $day = $data->trashed() ? "<del class='text-muted'>{$data->day} (Deleted)</del>" : $data->day;

            # status
            if ($data->status == 1) {
                $status = "<span class='badge badge-pill badge-success'>Active</span>";
            } else if ($data->status === 0) {
                $status = "<span class='badge badge-pill badge-warning'>Inactive</span>";
            } else if ($data->trashed()) {
                $status =  "<span class='badge badge-pill badge-danger'>Deleted</span>";
            }

            # action button
            $action = '<div class="row">
                           <button data-toggle="modal" data-target="#editTimingModal"  data="' . $data->id . '"
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
                                <button data-toggle="modal" data-target="#editTimingModal"  data="' . $data->id . '"
                                    class="edit btn btn-sm btn-outline-info "><i class="fas fa-pencil-alt"></i>
                                </button>
                               <button title="Restore" data="' . $data->id . '" class="restore btn btn-sm btn-outline-primary ml-3">
                                   <i class="fas fa-trash-restore"></i>
                               </button>
                               <button title="Permanant Delete" data="' . $data->id . '" class="delete btn btn-sm btn-outline-danger ml-3">
                                   <i class="fas fa-trash"></i>
                               </button>
                           </div>';
            };

            $tableData = [
                '#' => $key + 1,
                'day' => $day,
                'open' => $data->open,
                'close' => $data->close,
                'status' => $status,
                'action' => $action
            ];
            array_push($response, $tableData);
        }

        # return data
        return $response;
    }

    /**
     * get spefic food timing in json
     */
    public function dataJson($food)
    {
        # get timings
        $data = Food::with(['timing' => function ($query) {
            $query->withTrashed();
        }])->withTrashed()->findOrFail($food);

        # return response
        return response()->json(['data' => $data]);
    }
}
