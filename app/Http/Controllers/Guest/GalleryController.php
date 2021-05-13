<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Picture;

class GalleryController extends Controller
{
    public function show() {
        return view('public.gallery');
    }
}
