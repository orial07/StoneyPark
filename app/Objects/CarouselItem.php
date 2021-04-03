<?php

namespace App\Objects;

class CarouselItem
{
    public $title;
    public $subtitle;
    public $button;
    public $url;
    public $image;

    public function __construct($title, $subtitle, $button, $url, $image)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->button = $button;
        $this->url = $url;
        $this->image = $image;
    }
}
