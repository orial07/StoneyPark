<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CampgroundsController extends Controller
{
    public function show()
    {
        return view('admin.campgrounds');
    }
}
