<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # get count
        $count = District::count();

        $states = State::withTrashed()->get();

        # show index page
        return view('themes.admin.district.index', compact('count', 'states'));
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
            'state_id' => 'required'
        ]);

        # return error if validation fails
        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'data' => $valid->errors()->all()]);
        }

        # insert data
        $district = District::create([
            'name' => $request->input('name'),
            'state_id' => $request->input('state_id')
        ]);

        # return success
        return response()->json(['status' => 'success', 'message' => 'District add successfylly', 'data' => $district]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $district)
    {
        # validate data
        $valid = Validator::make($request->input(), [
            'name' => 'required',
            'state_id' => 'required'
        ]);

        # return error if validation fails
        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'data' => $valid->errors()->all()]);
        }

        # get state
        $data = District::withTrashed()->findOrFail($district);

        # update
        $updated = $data->update(['name' => $request->input('name'), 'state_id' => $request->input('state_id'), 'status' => 1]);

        # restore
        if ($data->trashed()) $data->restore();

        # update data in state
        $stateFresh =  $updated ? $data->refresh() : null;

        # return success
        return response()->json(['status' => 'success', 'message' => 'District updated successfully', 'data' => $stateFresh]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($district)
    {
        # get data
        $data = District::withTrashed()->findOrFail($district);

        # delete
        $data->trashed() ? $data->forceDelete() : $data->delete();

        # return success json
        return response()->json(['status' => 'success', 'message' => 'District deleted successfully', 'data' => $data]);
    }

    /**
     * restore soft deleted data
     */
    public function restore(Request $request, $district)
    {
        # restore and get data
        $data = District::withTrashed()->findOrFail($district)->restore();

        # return success json
        return response()->json(['status' => 'success', 'message' => 'District restored successfully', 'data' => $data]);
    }

    /**
     * get all data in json
     */
    public function allData(Request $request)
    {
        # get value
        $status = $request->input('status');
        $stateId =  $request->input('state_id');

        # get data by status, all:0, active:1, inactive:2, deleted:3
        switch ($status) {
            case 1:
                $districts = District::with('state')->where('status', 1)->where('state_id', $stateId)->get();
                break;
            case 2:
                $districts = District::with('state')->where('status', 0)->where('state_id', $stateId)->get();
                break;
            case 3:
                $districts = District::with('state')->where('state_id', $stateId)->onlyTrashed()->get();
                break;
            default:
                if ($stateId) {
                    $districts = District::with(['state' => function ($query) {
                        $query->withTrashed();
                    }])->where('state_id', $stateId)->withTrashed()->get();
                } else {
                    $districts = District::with(['state' => function ($query) {
                        $query->withTrashed();
                    }])->withTrashed()->limit(100)->get();
                }
                break;
        }
        //dd($districts);
        $response = [];

        # loop over all districts
        foreach ($districts as $key => $district) {
            # assign name
            $name = $district->trashed() ? "<del class='text-muted'>{$district->name} (Deleted)</del> " : $district->name;
            $state = $district->state->trashed() ?
                "<del class='text-muted'>{$district->state->name} (Deleted)</del> " : $district->state->name;

            # status
            if ($district->status == 1) {
                $status = "<span class='badge badge-pill badge-success'>Active</span>";
            } else {
                $status = "<span class='badge badge-pill badge-warning'>Inactive</span>";
            }

            # action button
            $action = '<div class="row">
                           <button title="Edit" type="button" data-toggle="modal" data-target="#modalEdit" district="' . $district->id . '"
                               class="edit btn btn-outline-info "><i class="fas fa-pencil-alt"></i></button>';

            if ($district->status == 1) {
                $action .=  '<button title="Inactive" type="button" district="' . $district->id . '" class="status btn btn-outline-warning ml-3">
                                                <i class="fas fa-arrow-down"></i></button>';
            } else {
                $action .=  '<button title="Active" type="button" district="' . $district->id . '" class="status btn btn-outline-success ml-3">
                                                <i class="fas fa-arrow-up"></i></button>';
            }

            $action .= '<button title="Delete" district="' . $district->id . '" class="delete btn btn-outline-danger ml-3">
                               <i class="fas fa-trash"></i>
                           </button>
                       </div>';

            # deleted data action buttons
            if ($district->trashed()) {
                $action = '<div class="row">
                               <button title="Edit" type="button" data-toggle="modal" data-target="#modalDistrictEdit" district="' . $district->id . '"
                                    class="edit btn btn-outline-info "><i class="fas fa-pencil-alt"></i>
                               </button>
                               <button title="Restore" district="' . $district->id . '" class="restore btn btn-outline-primary ml-3">
                                   <i class="fas fa-trash-restore"></i>
                               </button>
                               <button title="Permanant Delete" district="' . $district->id . '" class="delete btn btn-outline-danger ml-3">
                                   <i class="fas fa-trash"></i>
                               </button>
                           </div>';

                # status
                $status =  "<span class='badge badge-pill badge-danger'>Deleted</span>";
            };

            $tableData = ['#' => $key + 1, 'name' => $name, 'state' => $state, 'status' => $status, 'action' => $action];
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
        $district = District::withTrashed()->findOrFail($id);

        # return json
        return response()->json(['data' => $district]);
    }

    /**
     * change status
     */
    public function status(Request $request, $district)
    {
        # get data
        $data = District::findOrFail($district);

        # update status
        $data->status = $data->status === 1 ? 0 : 1;
        $data->save();

        return response()->json(['status' => 'success', 'message' => 'District Status Changed', 'data' => $data]);
    }
}
