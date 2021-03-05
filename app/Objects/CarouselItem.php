<?php

namespace App\Objects;

class CarouselItem
{
    public $title;
    public $subtitle;
    public $button;
    public $image;

    public function __construct($title, $subtitle, $button, $image)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->button = $button;
        $this->image = $image;
    }
}
