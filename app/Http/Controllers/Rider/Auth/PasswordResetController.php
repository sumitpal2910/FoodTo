<?php

namespace App\Http\Controllers\Rider\Auth;

use App\Events\Rider\Auth\RiderPasswordChanged;
use App\Events\Rider\Auth\RiderResetPassword;
use App\Http\Controllers\Controller;
use App\Models\Rider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('themes.rider.auth.forgot-password');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # validate
        $request->validate(['email' => 'email|required|exists:riders']);

        # get rider
        $rider = Rider::where('email', $request->input('email'))->get()->first();

        # generate tokrn
        $token = Str::random(64);

        # insert token, email into password_resets table
        DB::table('password_resets')->insert([
            'email' => $request->input('email'),
            'token' => $token,
            'created_at' => now()
        ]);

        # send email
        event(new RiderResetPassword($rider, $token));

        # return back with status
        return back()->with(['status' => 'success', 'message' => 'We have e-mailed your password reset link!']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('themes.rider.auth.reset-password', compact('request'));
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
        # validate
        $request->validate([
            'email' => 'required|email|exists:riders',
            'password' => 'required|string|min:8|confirmed'
        ]);

        # get data from password reset table
        $updated = DB::table('password_resets')->where('email', $request->input('email'))->get()->first();

        #  check if token is expire
        if (!$updated || now()->diffInMinutes($updated->created_at) > 30) {
            return back()->withErrors(['email' => 'Invalid Token']);
        }

        # update password
        Rider::where('email', $request->input('email'))->update(['password' => Hash::make($request->input('password'))]);

        # delete row from password resets
        DB::table('password_resets')->where('email', $request->input('email'))->delete();

        # get the rider
        $rider = Rider::where('email', $request->input('email'))->get()->first();

        # send notification email
        event(new RiderPasswordChanged($rider));

        # return to login page
        return redirect()->route('rider.loginForm')->with([
            'status' => 'success',
            'message' => 'Your password has been changed'
        ]);
    }
}
