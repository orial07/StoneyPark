<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function show()
    {
        return view('public.dashboard.gallery', [
            'pictures' => Picture::all()
        ]);
    }

    public function upload(Request $r)
    {
        if ($r->has('upload')) {
            $images = $r->file('upload');
            foreach ($images as $image) {
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
        }
        return redirect('/dashboard/gallery');
    }

    public function delete(Request $r)
    {
        $inputs = $r->all();
        $pictures = Picture::find($inputs['delete']);
        foreach ($pictures as $picture) {
            if (Storage::disk('public')->exists($picture->name)) {
                Storage::disk('public')->delete($picture->name);
            }
            $picture->delete();
        }
        return redirect('/dashboard/gallery');
    }
}
