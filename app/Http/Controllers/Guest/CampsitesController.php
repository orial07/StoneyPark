<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;

class CampsitesController extends Controller
{
    public function show()
    {
        SEOMeta::setTitle("Campsite Photos & Amenities | Stoney Park Campgrounds")
            ->setDescription("See photos and amenities of our campsites at Stoney Park Campgrounds providing Washroom service, public water tank, fire pit & picnic table")
            ->setKeywords(["campsites", "campsite", "photo", "amenities"]);

        return view('public.campsites');
    }
}
