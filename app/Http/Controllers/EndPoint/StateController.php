<?php

namespace App\Http\Controllers\EndPoint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $states = State::get();

        # return json
        return response()->json(['data' => $states]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($state)
    {
        # get data
        $data = State::withTrashed()->findOrFail($state);

        # return json
        return response()->json(['data' => $data]);
    }

    /**
     * get all district of a state
     */
    public function district(Request $request, $state)
    {
        # get data
        $data = State::with('district')->findOrFail($state);

        # return json
        return response()->json(['data' => $data]);
    }

    /**
     * get all city of a state
     */
    public function city($state)
    {
        # get data
        $data = State::with('city')->findOrFail($state);

        # return json
        return response()->json(['data' => $data]);
    }
}
