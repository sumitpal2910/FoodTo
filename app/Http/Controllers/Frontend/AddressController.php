<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        # get data
        $data = $request->all();

        # set user id
        $data['user_id'] = Auth::id();

        # set type
        if ($data['type'] && $data['other_type']) {
            $data['type'] = $data['other_type'];
            unset($data['other_type']);
        }

        # check if user is authencated
        if (Auth::user()) {
            $condition = [
                ['user_id', '=', Auth::id()],
                ['type', 'like', '%home%']
            ];
            $address = Address::where($condition)->limit(1)->get();
            if ($address->isNotEmpty()) {
                $address->first()->update($data);
            } else {
                Address::create($data);
            }
        }
        Session::forget('user-address');
        Session::put('user-address', $data);



        # return resposne
        return  response()->json(['status' => 'success', 'message' => 'Address Changed', 'data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
