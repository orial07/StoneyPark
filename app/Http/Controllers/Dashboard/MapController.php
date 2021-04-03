<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
}
