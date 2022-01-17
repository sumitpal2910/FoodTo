<?php

namespace App\Http\Controllers\Rider\Auth;

use App\Http\Controllers\Controller;
use App\Models\Rider;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('rider');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('themes.rider.auth.profile', ['rider' => $this->rider()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        # get rider
        $rider = $this->rider();

        dd($this->rider());
        //$rider->update();
    }

    /**
     * Upate address and kyc
     */
    public function address(Request $request)
    {
        # code...
    }

    /**
     * Update password
     */
    public function password(Request $request)
    {
        # code...
    }
}
