<?php

namespace App\Http\Controllers;

use App\Objects\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public $gallery;

    public function __construct()
    {
        $this->gallery = [
            new GalleryItem("img/gallery/fire.jpg"),
            new GalleryItem("img/gallery/fire.jpg"),
            new GalleryItem("img/gallery/fire.jpg"),
            new GalleryItem("img/gallery/fire.jpg"),
            new GalleryItem("img/gallery/fire.jpg"),
        ];
    }

    public function show()
    {
        return view('gallery', [
            'gallery' => $this->gallery
        ]);
    }
}
