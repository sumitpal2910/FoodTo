<?php

namespace App\Http\Controllers\EndPoint;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        # get all districts
        $districts = District::get();

        return response()->json(['data' => $districts]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        return response()->json(['data' => $district]);
    }

    /**
     * get all city of a dis$district
     */
    public function city($district)
    {
        # get data
        $data = District::with('city')->findOrFail($district);

        # return json
        return response()->json(['data' => $data]);
    }
}
