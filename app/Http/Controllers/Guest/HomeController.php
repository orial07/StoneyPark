<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function show()
    {
        return view('public.home');
    }
}
