<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    public function show()
    {
        return view('rules', [
            'rules' => Rule::all()
        ]);
    }
}
