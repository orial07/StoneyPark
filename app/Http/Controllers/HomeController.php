<?php

namespace App\Http\Controllers;

use App\Objects\CarouselItem;
use Illuminate\Http\Request;

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
                "img/banner1.jpg"
            ),

            new CarouselItem(
                "A breath of fresh air",
                "You ever been outside? Me neither.",
                "Learn More",
                "img/banner2.jpg"
            ),

            new CarouselItem(
                "A park owned by a family of Parks",
                "Now that's park-ception.",
                "Browse Gallery",
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
