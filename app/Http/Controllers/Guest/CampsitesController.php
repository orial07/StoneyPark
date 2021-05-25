<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;

class CampsitesController extends Controller
{
    public function show()
    {
        SEOMeta::setTitle("Campsite Photos & Amenities")
            ->setDescription("See photos and amenities of our campsites.")
            ->setKeywords(["campsites", "campsite", "photo", "amenities"]);

        return view('public.campsites');
    }
}
