<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
    public function show($id)
    {
        $reservation = Reservation::find($id);
        // throw 404 if not found or user doesn't have permission to view
        if (!$reservation || auth()->user()->web_admin == 0 && strcmp($reservation->email, auth()->user()->email) != 0) {
            abort(404);
        }

        return view('auth.reservation', ['reservation' => $reservation]);
    }

    public function showAll()
    {
        return view('admin.reservations', [
            'reservations' => DB::table('reservations')
                ->where('status', 'paid')
                ->paginate(20)
        ]);
    }

    public function showFilter(Request $r)
    {
        $search = $r->input('search');
        $n = intval($search);

        $db = DB::table('reservations');
        if ($n > 0) {
            $db->where('id', $n);
        } else {
            $db->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
        }
        return view('admin.reservations', [
            'reservations' => $db->paginate(20)
        ]);
    }
}
