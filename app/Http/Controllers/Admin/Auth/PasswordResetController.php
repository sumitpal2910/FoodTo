<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Events\Admin\Auth\AdminPasswordChanged;
use App\Events\Admin\Auth\ResetPassword;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{


    /**
     * Show the form for forgot password
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('themes.admin.auth.forgot-password');
    }

    /**
     * Send email to user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # validate email
        $request->validate(['email' => 'required|email|exists:admins']);

        # get the admin
        $admin = Admin::where('email', $request->input('email'))->get()->first();

        # create token
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->input('email'),
            'token' => $token,
            'created_at' => now()
        ]);

        # send mail using event
        event(new ResetPassword($admin, $token));

        return back()->with(['status' => 'success', 'message' => 'We have e-mailed your password reset link!']);
    }


    /**
     * Show the form for reset password
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('themes.admin.auth.reset-password', compact('request'));
    }

    /**
     * Update the password
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
        # validate
        $request->validate([
            'email' => 'email|required|exists:admins',
            'password' => 'required|confirmed|string'
        ]);

        # get data from password resets table
        $updatePassword = DB::table('password_resets')->where([
            'email' => $request->input('email'),
            'token' => $request->input('token')
        ])->get()->first();

        # if token is expire back with error
        if (!$updatePassword || now()->diffInMinutes($updatePassword->created_at) > 30) {
            return back()->withInput()->with(['status' => 'error', 'message' => 'Invalid Token']);
        }

        # update password
        Admin::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        # delete row from password_resets table
        DB::table('password_resets')->where(['email' => $request->email])->delete();

        # get the admin
        $admin = Admin::where('email', $request->input('email'))->get()->first();

        # send mail to admin
        event(new AdminPasswordChanged($admin));

        # back to login page
        return redirect()->route('admin.loginForm')->with([
            'status' => 'success',
            'message' => 'Your password has been changed'
        ]);
    }
}
