<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Picture;
use App\Models\Reservation;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function show()
    {
        return view('dashboard.main');
    }

    public function showHome()
    {
        return view('dashboard.home');
    }

    public function showRules()
    {
        return view('dashboard.rules', [
            'rules' => Rule::all()
        ]);
    }

    public function showGallery()
    {
        return view('dashboard.gallery', [
            'pictures' => Picture::all()
        ]);
    }

    public function showReservation($id)
    {
        $reservation = Reservation::find($id);
        echo "<pre>";
        print_r($reservation);
        echo "</pre>";
    }

    public function showReservations()
    {
        return view('dashboard.reservations', [
            'reservations' => DB::table('reservations')
                ->where('date_in', '>=', (new DateTime())->format("Y-m-d"))
                ->orWhere('date_out', '>=', (new DateTime())->format("Y-m-d"))
                ->paginate(20)
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
