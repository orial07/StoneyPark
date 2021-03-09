<?php

namespace App\Http\Controllers;

use App\Models\Picture;

class GalleryController extends Controller
{
    public function show()
    {
        return view('gallery', [
            'pictures' => Picture::all()
        ]);
    }
}
