<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Objects\CarouselItem;

class HomeController extends Controller
{
    public function show()
    {
        return view('public.home');
    }
}
