<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuisine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CuisineController extends Controller
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
        $count = Cuisine::count();

        # show index page
        return view('themes.admin.cuisine.index', compact('count'));
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
        # validate data
        $valid = Validator::make($request->input(), [
            'name' => 'required',
        ]);

        # return error if validation fails
        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'data' => $valid->errors()->all()]);
        }

        # make slug
        $slug = strtolower(str_replace("--", "-", preg_replace("/[^a-z]/i", '-', $request->input('name'))));

        # insert data
        $data = Cuisine::create([
            'name' => $request->input('name'),
            'slug' => $slug
        ]);

        # return success
        return response()->json(['status' => 'success', 'message' => 'Cuisine add successfully', 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $cuisine)
    {
        # validate data
        $valid = Validator::make($request->input(), [
            'name' => 'required',
        ]);

        # return error if validation fails
        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'data' => $valid->errors()->all()]);
        }

        # make slug
        $slug = strtolower(str_replace("--", "-", preg_replace("/[^a-z]/i", '-', $request->input('name'))));

        # get data
        $data = Cuisine::withTrashed()->findOrFail($cuisine);

        # update
        $updated = $data->update(['name' => $request->input('name'), 'slug' => $slug, 'status' => 1]);

        # restore
        if ($data->trashed()) $data->restore();

        # update data
        $dataFresh =  $updated ? $data->refresh() : null;

        # return success
        return response()->json(['status' => 'success', 'message' => 'Cuisine updated successfully', 'data' => $dataFresh]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function destroy($cuisine)
    {
        # get data
        $data = Cuisine::withTrashed()->findOrFail($cuisine);

        # delete
        $data->trashed() ? $data->forceDelete() : $data->delete();

        # return json
        return response()->json(['status' => 'success', 'message' => 'Cuisine deleted successfully', 'data' => $data]);
    }
    /**
     * restore soft deleted data
     */
    public function restore(Request $request, $cousine)
    {
        # restore and get data
        $data = Cuisine::withTrashed()->findOrFail($cousine)->restore();

        # return success json
        return response()->json(['status' => 'success', 'message' => 'Cuisine restored successfully', 'data' => $data]);
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
                $cuisines = Cuisine::where('status', 1)->get();
                break;
            case 2:
                $cuisines = Cuisine::where('status', 0)->get();
                break;
            case 3:
                $cuisines = Cuisine::onlyTrashed()->get();
                break;
            default:
                $cuisines = Cuisine::withTrashed()->get();
                break;
        }

        $response = [];

        # loop over all cuisines
        foreach ($cuisines as $key => $data) {
            # assign name
            $name = $data->trashed() ? "<del class='text-muted'>{$data->name} (Deleted)</del> " : $data->name;

            # status
            if ($data->status == 1) {
                $status = "<span class='badge badge-pill badge-success'>Active</span>";
            } else {
                $status = "<span class='badge badge-pill badge-warning'>Inactive</span>";
            }

            # action button
            $action = '<div class="row">
                            <button title="Edit" type="button" data-toggle="modal" data-target="#modalEdit" data="' . $data->id . '"
                                class="edit btn btn-outline-info "><i class="fas fa-pencil-alt"></i></button>';

            if ($data->status == 1) {
                $action .=  '<button title="Inactive" type="button" data="' . $data->id . '" class="status btn btn-outline-warning ml-3">
                                <i class="fas fa-arrow-down"></i></button>';
            } else {
                $action .=  '<button title="Active" type="button" data="' . $data->id . '" class="status btn btn-outline-success ml-3">
                                <i class="fas fa-arrow-up"></i></button>';
            }

            $action .= '<button title="Delete" data="' . $data->id . '" class="delete btn btn-outline-danger ml-3">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';

            # deleted data action buttons
            if ($data->trashed()) {
                $action = '<div class="row">
                                <button title="Edit" type="button" data-toggle="modal" data-target="#modalEdit" data="' . $data->id . '"
                                     class="edit btn btn-outline-info "><i class="fas fa-pencil-alt"></i>
                                </button>
                                <button title="Restore" data="' . $data->id . '" class="restore btn btn-outline-primary ml-3">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                                <button title="Permanant Delete" data="' . $data->id . '" class="delete btn btn-outline-danger ml-3">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>';

                # status
                $status =  "<span class='badge badge-pill badge-danger'>Deleted</span>";
            };

            $tableData = ['#' => $key + 1, 'name' => $name, 'status' => $status, 'action' => $action];
            array_push($response, $tableData);
        }

        return response()->json(['data' => $response]);
    }

    /**
     * get one data in json
     */
    public function oneData($cuisine)
    {
        # get data
        $data = Cuisine::withTrashed()->findOrFail($cuisine);

        # return json
        return response()->json(['data' => $data]);
    }

    /**
     * change status
     */
    public function status(Request $request, $cuisine)
    {
        # get data
        $data = Cuisine::findOrFail($cuisine);

        # update status
        $data->status = $data->status === 1 ? 0 : 1;
        $data->save();

        # return json
        return response()->json(['status' => 'success', 'message' => 'Cuisine Status Changed', 'data' => $data]);
    }
}
