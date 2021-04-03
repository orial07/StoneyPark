<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    public function show()
    {
        return view('public.dashboard.map');
    }

    public function save(Request $r)
    {
        $data = $r->getContent();
        Storage::disk('local')->put('geomap.json', $data);
        return Response::json(array('success' => 1));
    }

    public function load()
    {
        if (Storage::disk('local')->exists('geomap.json')) {
            $geomap = Storage::disk('local')->get('geomap.json');
            return Response::json(json_decode('[' . $geomap . ']'));
        }
    }
}
