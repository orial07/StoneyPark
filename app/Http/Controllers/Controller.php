<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function contact()
    {
        return view('public.contact');
    }

    public function contact_send(Request $r)
    {
        $inputs = $r->all();
        $validator = Validator::make(
            $inputs,
            []
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Mail::to(env('MAIL_TO_ADDRESS'))->queue(new ContactMail([
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'subject' => $inputs['subject'],
            'content' => $inputs['content'],
        ])); // send e-mail to admin
        return redirect()->to('/contact')->withErrors(['success' => "Mail sent!"]);
    }
}
