<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\State;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
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
        $count = City::count();

        $states = State::withTrashed()->get();
        $districts = District::withTrashed()->get();

        # show index page
        return view('themes.admin.city.index', compact('count', 'states', 'districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::get();

        # show index page
        return view('themes.admin.city.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # validate data
        $valid = Validator::make($request->input(), [
            'name' => 'required',
            'state_id' => 'required',
            'district_id' => 'required'
        ]);

        # return error if validation fails
        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'data' => $valid->errors()->all()]);
        }

        # insert data
        $district = City::create([
            'name' => $request->input('name'),
            'state_id' => $request->input('state_id'),
            'district_id' => $request->input('district_id'),
        ]);

        # return success
        return response()->json(['status' => 'success', 'message' => 'City add successfully', 'data' => $district]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $city)
    {
        # validate data
        $valid = Validator::make($request->input(), [
            'name' => 'required',
            'state_id' => 'required',
            'district_id' => 'required'
        ]);

        # return error if validation fails
        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'data' => $valid->errors()->all()]);
        }

        # get state
        $data = City::withTrashed()->findOrFail($city);

        # update
        $updated = $data->update([
            'name' => $request->input('name'),
            'state_id' => $request->input('state_id'),
            'district_id' => $request->input('district_id'),
            'status' => 1
        ]);

        # restore
        if ($data->trashed()) $data->restore();

        # update data in state
        $stateFresh =  $updated ? $data->refresh() : null;

        # return success
        return response()->json(['status' => 'success', 'message' => 'City updated successfully', 'data' => $stateFresh]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($city)
    {
        # get data
        $data = City::withTrashed()->findOrFail($city);

        # delete
        $data->trashed() ? $data->forceDelete() : $data->delete();

        # return success json
        return response()->json(['status' => 'success', 'message' => 'City deleted successfully', 'data' => $data]);
    }

    /**
     * restore soft deleted data
     */
    public function restore(Request $request, $city)
    {
        # restore and get data
        $data = City::withTrashed()->findOrFail($city)->restore();

        # return success json
        return response()->json(['status' => 'success', 'message' => 'City restored successfully', 'data' => $data]);
    }

    /**
     * get all data in json
     */
    public function allData(Request $request)
    {
        # get value
        $status = $request->input('status');
        $stateId =  $request->input('state_id');
        $districtId =  $request->input('district_id');

        # get data by status, all:0, active:1, inactive:2, deleted:3
        switch ($status) {
            case 1:
                $cites = City::with(['state', 'district'])->where('status', 1)->where('district_id', $districtId)->where('state_id', $stateId)->get();
                break;
            case 2:
                $cites = City::with(['state', 'district'])->where('status', 0)->where('district_id', $districtId)->where('state_id', $stateId)->get();
                break;
            case 3:
                $cites = City::with(['state', 'district'])->where('state_id', $stateId)->where('district_id', $districtId)->onlyTrashed()->get();
                break;
            default:
                if ($stateId && $districtId) {
                    # with state and district id also trashed
                    $cites = City::with([
                        'state' => function ($query) use ($stateId) {
                            $query->withTrashed();
                        },
                        'district' => function ($query) use ($districtId) {
                            $query->withTrashed();
                        }
                    ])->where('district_id', $districtId)->where('state_id', $stateId)->withTrashed()->get();
                } elseif ($stateId) {
                    $cites = City::with([
                        'state' => function ($query) use ($stateId) {
                            $query->withTrashed();
                        }
                    ])->where('state_id', $stateId)->withTrashed()->get();
                } else {
                    # with state and district also trashed
                    $cites = City::with([
                        'state' => function ($query) {
                            $query->withTrashed();
                        },
                        'district' => function ($query) {
                            $query->withTrashed();
                        }
                    ])->withTrashed()->limit(100)->get();
                }
                break;
        }
        //dd($districts);
        $response = [];

        # loop over all districts
        foreach ($cites as $key => $value) {
            # assign name
            $name = $value->trashed() ? "<del class='text-muted'>{$value->name} (Deleted)</del> " : $value->name;

            # assign state name
            $state = $value->state->trashed() ?
                "<del class='text-muted'>{$value->state->name} (Deleted)</del> " : $value->state->name;

            # distruct name
            $district = $value->district->trashed() ?
                "<del class='text-muted'>{$value->district->name} (Deleted)</del> " : $value->district->name;

            # status
            if ($value->status == 1) {
                $status = "<span class='badge badge-pill badge-success'>Active</span>";
            } else {
                $status = "<span class='badge badge-pill badge-warning'>Inactive</span>";
            }

            # action button
            $action = '<div class="row">
                           <button title="Edit" type="button" data-toggle="modal" data-target="#modalEdit" city="' . $value->id . '"
                               class="edit btn btn-outline-info "><i class="fas fa-pencil-alt"></i></button>';

            if ($value->status == 1) {
                $action .=  '<button title="Inactive" type="button" city="' . $value->id . '" class="status btn btn-outline-warning ml-3">
                                                <i class="fas fa-arrow-down"></i></button>';
            } else {
                $action .=  '<button title="Active" type="button" city="' . $value->id . '" class="status btn btn-outline-success ml-3">
                                                <i class="fas fa-arrow-up"></i></button>';
            }

            $action .= '<button title="Delete" city="' . $value->id . '" class="delete btn btn-outline-danger ml-3">
                               <i class="fas fa-trash"></i>
                           </button>
                       </div>';

            # deleted data action buttons
            if ($value->trashed()) {
                $action = '<div class="row">
                               <button title="Edit" type="button" data-toggle="modal" data-target="#modalDistrictEdit" city="' . $value->id . '"
                                    class="edit btn btn-outline-info "><i class="fas fa-pencil-alt"></i>
                               </button>
                               <button title="Restore" city="' . $value->id . '" class="restore btn btn-outline-primary ml-3">
                                   <i class="fas fa-trash-restore"></i>
                               </button>
                               <button title="Permanant Delete" city="' . $value->id . '" class="delete btn btn-outline-danger ml-3">
                                   <i class="fas fa-trash"></i>
                               </button>
                           </div>';

                # status
                $status =  "<span class='badge badge-pill badge-danger'>Deleted</span>";
            };

            $tableData = [
                '#' => $key + 1, 'name' => $name, 'district' => $district,
                'state' => $state, 'status' => $status, 'action' => $action
            ];
            array_push($response, $tableData);
        }

        return response()->json(['data' => $response]);
    }

    /**
     * get one data in json
     */
    public function oneData($id)
    {
        # get data
        $district = City::with('district')->withTrashed()->findOrFail($id);

        # return json
        return response()->json(['data' => $district]);
    }

    /**
     * change status
     */
    public function status(Request $request, $city)
    {
        # get data
        $data = City::findOrFail($city);

        # update status
        $data->status = $data->status === 1 ? 0 : 1;
        $data->save();

        return response()->json(['status' => 'success', 'message' => 'City Status Changed', 'data' => $data]);
    }
}
