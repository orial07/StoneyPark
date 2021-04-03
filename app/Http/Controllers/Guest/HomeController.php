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
                "Welcome to Stoney Park!",
                "Open all day, everyday.",
                "Reserve",
                url('/reserve'),
                "img/banner1.jpg"
            ),

            new CarouselItem(
                "A breath of fresh air",
                "You ever been outside? Me neither.",
                "Learn More",
                url(''),
                "img/banner2.jpg"
            ),

            new CarouselItem(
                "A park owned by a family of Parks",
                "Now that's park-ception.",
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
