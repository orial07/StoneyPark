<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\ReservationUtil;
use App\Http\Controllers\Controller;
use App\Models\Picture;
use App\Models\Reservation;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function show()
    {
        $email = auth()->user()->email;
        return view('public.dashboard.main', [
            'reservations' => Reservation::where('email', $email)->paginate(20)
        ]);
    }

    public function showMap()
    {
        $geomap = '';
        if (Storage::disk('local')->exists('geomap.json')) {
            $geomap = Storage::disk('local')->get('geomap.json');
        }
        return view('public.dashboard.map', ['geomap' => json_encode(json_decode($geomap))]);
    }

    public function editMap(Request $r) {
        $data = $r->getContent();
        Storage::disk('local')->put('geomap.json', $data);
        return Response::json(array('success' => 1));
    }

    public function showReservation($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation || auth()->user()->web_admin == 0 && strcmp($reservation->email, auth()->user()->email) != 0) abort(404);

        $campers = $reservation->campers;
        return view('public.dashboard.reservation', [
            'reservation' => $reservation,
            'campers' => $campers,
            'nights' => ReservationUtil::getNights($reservation),
            'cost' => ReservationUtil::getCost($reservation),
        ]);
    }

    public function showReservations()
    {
        return view('public.dashboard.reservations', [
            'reservations' => DB::table('reservations')
                // ->where('date_in', '>=', (new DateTime())->format("Y-m-d"))
                // ->orWhere('date_out', '>=', (new DateTime())->format("Y-m-d"))
                ->paginate(20)
        ]);
    }

    public function searchReservation(Request $r)
    {
        $search = $r->input('search');
        return view('public.dashboard.reservations', [
            'reservations' => DB::table('reservations')
                ->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->paginate(20)
        ]);
    }
    
    public function showRules()
    {
        return view('public.dashboard.rules', [
            'rules' => Rule::all()
        ]);
    }

    public function editRules(Request $r)
    {
        $inputs = $r->all();
        $rows = array();

        for ($i = 0; true; $i++) {
            if (!isset($inputs["title_$i"])) break;
            array_push($rows, [
                'title' => $inputs["title_$i"],
                'description' => $inputs["description_$i"],
            ]);
        }

        DB::table('rules')->truncate();
        DB::table('rules')->insert($rows);
        return redirect('/dashboard/rules')->withErrors(['success' => 'success']);
    }

    public function showGallery()
    {
        return view('public.dashboard.gallery', [
            'pictures' => Picture::all()
        ]);
    }

    public function editGallery(Request $r)
    {
        $errors = array();

        if ($r->has('upload')) {
            $image = $r->file('upload');
            $name = $image->getClientOriginalName();

            if (Storage::disk('public')->exists($name)) {
                $errors['exists'] = "A picture named $name already exists.";
            } else {
                $path = $image->storeAs('', $name, 'public');

                $picture = new Picture();
                $picture->name = $name;
                $picture->url = $path;
                $picture->save();
            }
        }
        $inputs = $r->all();

        foreach ($inputs as $key => $value) {
            if (!str_starts_with($key, "picture-")) continue;
            $id = explode("-", $key)[1];

            Storage::disk('public')->delete($value);
            Picture::destroy($id);
        }
        return redirect('/dashboard/gallery')->withErrors($errors);
    }
}
