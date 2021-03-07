<?php

namespace App\Objects;

class GalleryItem
{
    public $image;

    public function __construct($image)
    {
        $this->image = $image;
    }
}
