<?php

namespace App\Http\Controllers;

use App\Models\Picture;

class GalleryController extends Controller
{
    public function show()
    {
        return view('public.gallery', [
            'pictures' => Picture::all()
        ]);
    }
}
