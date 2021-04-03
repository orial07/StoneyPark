<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    public function show()
    {
        return view('public.dashboard.map');
    }

    public function load()
    {
        if (Storage::disk('local')->exists('geomap.json')) {
            $geomap = Storage::disk('local')->get('geomap.json');
            return Response::json(json_decode('[' . $geomap . ']'));
        }
    }
}
