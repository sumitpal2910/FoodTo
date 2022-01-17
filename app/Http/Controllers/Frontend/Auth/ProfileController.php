<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Stringable;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Update Profile
     */
    public function profile(Request $request)
    {
        # get data
        $data = $request->all();

        # get user
        $user =  User::findOrfail($this->user()->id);

        # make directory if not extsts
        $path = "users";
        if (Storage::missing($path)) {
            Storage::makeDirectory($path);
        }

        # store image
        if ($request->hasFile('thumbnail')) {

            # remove old file
            if ($user->thumbnail) Storage::delete($user->thumbnail);

            # save new image
            $file = $request->file('thumbnail');
            $url = "{$path}/" . hexdec(uniqid()) . "." . $file->getClientOriginalExtension();
            $image = Image::make($file, 256, null, function ($const) {
                $const->aspectRatio();
            });
            Storage::put($url, (string) $image->encode());

            $data['thumbnail'] = $url;
        }

        # update
        $user->update($data);

        # return back
        return back()->with(['alert-type' => 'success', 'message' => 'Profile updated']);
    }

    /**
     * Update Password
     */
    public function password(Request $request)
    {
        # validate
        $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        # get all data
        $data = $request->all();

        # get user
        $user =  User::findOrfail($this->user()->id);


        # check current password
        if (!Hash::check($data['oldPassword'], $user->password)) {
            return back()->withErrors(['Current does not match']);
        }

        # validate password
        if ($data['password'] !== $data['password_confirmation']) {
            return back()->withErrors(['Confirm password deos not match']);
        }

        # update
        $user->password = $request->password;
        $user->save();

        # return back
        return back()->with(['alert-type' => 'success', 'message' => 'Password changed']);
    }
}
