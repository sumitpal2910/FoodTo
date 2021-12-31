<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StateRequest;
use App\Models\City;
use App\Models\District;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
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
        $count = State::withTrashed()->count();

        return view('themes.admin.state.index', compact('count'));
    }

    /**
     * Store a newly created 'state' in database
     */
    public function store(Request $request)
    {
        # validate data
        $valid = Validator::make($request->input(), [
            'name' => 'required',
            'code' => 'required'
        ]);

        # return error if validation fails
        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'data' => $valid->errors()->all()]);
        }

        # insert data
        $state = State::create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ]);

        # return success
        return response()->json(['status' => 'success', 'message' => 'State add successfylly', 'data' => $state]);
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $state)
    {
        # validate data
        $valid = Validator::make($request->input(), [
            'name' => 'required',
            'code' => 'required'
        ]);

        # return error if validation fails
        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'data' => $valid->errors()->all()]);
        }

        # get state
        $data = State::withTrashed()->findOrFail($state);

        # update
        $updated = $data->update(['name' => $request->input('name'), 'code' => $request->input('code'), 'status' => 1]);

        # restore
        if ($data->trashed()) $data->restore();

        # update data in state
        $stateFresh =  $updated ? $data->refresh() : null;

        # return success
        return response()->json(['status' => 'success', 'message' => 'State updated successfully', 'data' => $stateFresh]);
    }

    /**
     * Delete data
     * if soft deleted then delete permanently
     */
    public function destroy($state)
    {
        # get data
        $data = State::withTrashed()->findOrFail($state);

        # delete
        $deleted = $data->trashed() ? $data->forceDelete() : $data->delete();

        # return json
        return $deleted;
    }

    /**
     * restore soft deleted data
     */
    public function restore(Request $request, $state)
    {
        # restore and get data
        $data = State::withTrashed()->findOrFail($state)->restore();

        # return success json
        return response()->json(['status' => 'success', 'message' => 'State restored successfully', 'data' => $data]);
    }

    /**
     * show all data in json
     */
    public function allData(Request $request)
    {
        # get value
        $status = $request->input('status');

        # get data by status, all:0, active:1, inactive:2, deleted:3
        switch ($status) {
            case 1:
                $states = State::where('status', 1)->get();
                break;
            case 2:
                $states = State::where('status', 0)->get();
                break;
            case 3:
                $states = State::onlyTrashed()->get();
                break;
            default:
                $states = State::withTrashed()->get();
                break;
        }

        $response = [];

        # loop over all states
        foreach ($states as $key => $state) {
            # assign name
            $name = $state->trashed() ? "<del class='text-muted'>{$state->name} (Deleted)</del> " : $state->name;

            # status
            if ($state->status == 1) {
                $status = "<span class='badge badge-pill badge-success'>Active</span>";
            } else {
                $status = "<span class='badge badge-pill badge-warning'>Inactive</span>";
            }

            # action button
            $action = '<div class="row">
                            <button title="Edit" type="button" data-toggle="modal" data-target="#modalStateEdit" state="' . $state->id . '"
                                class="edit btn btn-outline-info "><i class="fas fa-pencil-alt"></i></button>';

            if ($state->status == 1) {
                $action .=  '<button title="Inactive" type="button" state="' . $state->id . '" class="status btn btn-outline-warning ml-3">
                                <i class="fas fa-arrow-down"></i></button>';
            } else {
                $action .=  '<button title="Active" type="button" state="' . $state->id . '" class="status btn btn-outline-success ml-3">
                                <i class="fas fa-arrow-up"></i></button>';
            }

            $action .= '<button title="Delete" state="' . $state->id . '" class="delete btn btn-outline-danger ml-3">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

            # deleted data action buttons
            if ($state->trashed()) {
                $action = '<div class="row">
                                <button title="Edit" type="button" data-toggle="modal" data-target="#modalStateEdit" state="' . $state->id . '"
                                     class="edit btn btn-outline-info "><i class="fas fa-pencil-alt"></i>
                                </button>
                                <button title="Restore" state="' . $state->id . '" class="restore btn btn-outline-primary ml-3">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                                <button title="Permanant Delete" state="' . $state->id . '" class="delete btn btn-outline-danger ml-3">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>';

                # status
                $status =  "<span class='badge badge-pill badge-danger'>Deleted</span>";
            };

            $tableData = ['#' => $key + 1, 'name' => $name, 'code' => $state->code, 'status' => $status, 'action' => $action];
            array_push($response, $tableData);
        }

        return response()->json(['data' => $response]);
    }

    /**
     * show one state data in json
     */
    public function oneData($state)
    {
        # get data
        $data = State::withTrashed()->findOrFail($state);

        # return json
        return response()->json(['data' => $data]);
    }

    /**
     * change status
     */
    public function status(Request $request, $state)
    {
        # get data
        $data = State::with('district')->findOrFail($state);

        # update status
        $data->status = $data->status === 1 ? 0 : 1;
        $data->save();


        return response()->json(['status' => 'success', 'message' => 'State Status Changed', 'data' => $data]);
    }
}
