<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Reservation;

class ProfileController extends Controller
{
    public function show()
    {
        $email = auth()->user()->email;
        return view('public.profile', [
            'reservations' => Reservation::where('email', $email)->paginate(20)
        ]);
    }
}
