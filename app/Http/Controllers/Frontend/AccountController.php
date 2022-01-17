<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show orders
     */
    public function orders()
    {
        return view('themes.frontend.user.orders');
    }

    /**
     * Show orders
     */
    public function offers()
    {
        return view('themes.frontend.user.offers');
    }

    /**
     * Show orders
     */
    public function address()
    {
        return view('themes.frontend.user.address');
    }

    /**
     * Show orders
     */
    public function favourites()
    {
        return view('themes.frontend.user.favourites');
    }

    /**
     * Show orders
     */
    public function settings()
    {
        $user =  $this->user();
        return view('themes.frontend.user.settings', compact('user'));
    }
}
