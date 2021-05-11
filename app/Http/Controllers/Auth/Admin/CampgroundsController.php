<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campground;
use Illuminate\Http\Request;

class CampgroundsController extends Controller
{
    public function show()
    {
        return view('admin.campgrounds');
    }
}
