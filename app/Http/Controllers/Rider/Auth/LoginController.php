<?php

namespace App\Http\Controllers\Rider\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('themes.rider.auth.login');
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
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);

        # login
        if (Auth::guard('rider')->attempt($credentials)) {
            $request->session()->regenerate();

            # return to dashboard
            return  redirect()->route('rider.dashboard');
        }

        # return back with error
        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        # logout
        Auth::guard('rider')->logout();

        # session invalidate
        $request->session()->invalidate();

        # regenerate session
        $request->session()->regenerateToken();

        # return to restaurant login page
        return redirect()->route('rider.loginForm');
    }
}
