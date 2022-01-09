<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
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
        $count = Bank::count();
        return view('themes.admin.bank.index', compact('count'));
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
            'name' => 'required|unique:banks',
        ]);

        # return error if validation fails
        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'data' => $valid->errors()->all()]);
        }

        # insert data
        $state = Bank::create([
            'name' => $request->input('name'),
        ]);

        # return success
        return response()->json(['status' => 'success', 'message' => 'Bank add successfylly', 'data' => $state]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\data  $data
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $data)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bank)
    {
        # validate data
        $valid = Validator::make($request->input(), [
            'name' => 'required',
        ]);

        # return error if validation fails
        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'data' => $valid->errors()->all()]);
        }

        # get data
        $data  = Bank::withTrashed()->findOrFail($bank);
        $data->name = $request->input('name');
        $updated =  $data->save();

        # restore
        if ($data->trashed()) $data->restore();

        # update data in state
        $dataFresh =  $updated ? $data->refresh() : null;

        # return success
        return response()->json(['status' => 'success', 'message' => 'Bank updated successfully', 'data' => $dataFresh]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($bank)
    {
        # get data
        $data = Bank::withTrashed()->findOrFail($bank);

        # if soft deleted, delete permanently
        $data->trashed() ? $data->forceDelete() : $data->delete();

        # return json
        return response()->json(['status' => 'success', 'message' => 'Bank delete successfully', 'data' => $data]);
    }

    /**
     * restore soft deleted data
     */
    public function restore(Request $request, $bank)
    {
        # restore and get data
        $data = Bank::withTrashed()->findOrFail($bank)->restore();

        # return success json
        return response()->json(['status' => 'success', 'message' => 'Bank restored successfully', 'data' => $data]);
    }


    /**
     * show all data in json
     */
    public function allData()
    {
        # get all data
        $banks = Bank::withTrashed()->get();

        $response = [];

        # loop over all banks
        foreach ($banks as $key => $data) {
            # assign name
            $name = $data->trashed() ? "<del class='text-muted'>{$data->name} (Deleted)</del> " : $data->name;

            # status
            $status = "<span class='badge badge-pill badge-success'>Active</span>";

            # action button
            $action = '<div class="row">
                            <button title="Edit" type="button" data-toggle="modal" data-target="#modalEdit" data="' . $data->id . '"
                                class="edit btn btn-outline-info "><i class="fas fa-pencil-alt"></i></button>
                            <button title="Delete" data="' . $data->id . '" class="delete btn btn-outline-danger ml-3">
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

            $tableData = ['#' => $key + 1, 'name' => $name, 'code' => $data->code, 'status' => $status, 'action' => $action];
            array_push($response, $tableData);
        }

        return response()->json(['data' => $response]);
    }

    /**
     * show one state data in json
     */
    public function oneData($bank)
    {
        # get data
        $data = Bank::withTrashed()->findOrFail($bank);

        # return json
        return response()->json(['data' => $data]);
    }
}
