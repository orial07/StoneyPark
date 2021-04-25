<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Objects\CarouselItem;

class HomeController extends Controller
{

    private $carousel;

    public function __construct()
    {
        $this->carousel = array(
            new CarouselItem(
                "Welcome to Stoney Park Campgrounds!",
                "Open From May 2021 - September 2021 via reservation.",
                "Reserve Now",
                url('/reserve'),
                "img/banner1.jpg"
            ),

            new CarouselItem(
                "Over 700 acres of land to explore.",
                "",
                "Learn More",
                url(''),
                "img/banner2.jpg"
            ),

            new CarouselItem(
                "Explore our gallery",
                "",
                "Browse Gallery",
                url('gallery'),
                "img/banner3.jpg"
            ),
        );
    }

    public function show()
    {
        return view('public.home', [
            'carousel' => $this->carousel
        ]);
    }
}
