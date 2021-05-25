<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;

class GalleryController extends Controller
{
    public function show()
    {
        SEOMeta::setTitle("Campsite Photos")
            ->setDescription("See photos of our campsites.")
            ->setKeywords(["campsites", "campsite", "photo"]);

        return view('public.gallery');
    }
}
