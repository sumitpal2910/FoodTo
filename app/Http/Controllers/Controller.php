<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function restaurant()
    {
        return Auth::guard('restaurant')->user();
    }

    public function rider()
    {
        return  Auth::guard('rider')->user();
    }

    public function user()
    {
        return Auth::user();
    }
}
