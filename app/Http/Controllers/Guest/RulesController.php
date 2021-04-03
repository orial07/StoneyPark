<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Rule;

class RulesController extends Controller
{
    public function show()
    {
        return view('public.rules', [
            'rules' => Rule::all()
        ]);
    }
}
