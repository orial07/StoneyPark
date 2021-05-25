<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Rule;
use Artesaos\SEOTools\Facades\SEOMeta;

class RulesController extends Controller
{
    public function show()
    {
        SEOMeta::setTitle("Rules & Refund Policy")
            ->setDescription("Rules are to be followed when on campgrounds. Note our refund policy and contact us if you have any questions.")
            ->setKeywords(["refund", "policy", "rules"]);

        return view('public.rules', [
            'rules' => Rule::all()
        ]);
    }
}
