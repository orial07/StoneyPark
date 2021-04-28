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
            [
                'name' => 'required|string',
                'email' => 'required|email',
                'subject' => 'required|string',
                'content' => 'required|string',
            ]
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Mail::to(config('mail.to.address'))->queue(new ContactMail([
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'subject' => $inputs['subject'],
            'content' => $inputs['content'],
        ])); // send e-mail to admin
        return redirect()->to('/contact')->withErrors(['success' => "Your message has been sent!"]);
    }
}
