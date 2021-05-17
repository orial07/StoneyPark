<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function show() {
        return view('public.gallery');
    }
}
