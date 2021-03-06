<?php

namespace App\Http\Controllers\Auth\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function upload(Request $r)
    {
        if ($r->has('upload')) {
            $images = $r->file('upload');
            foreach ($images as $image) {
                $name = $image->getClientOriginalName();
                $errors = [];

                if (Storage::disk('public')->exists($name)) {
                    $errors['exists'] = "A picture named $name already exists.";
                } else {
                    try {
                        $path = $image->storeAs('', $name, 'public');

                        $picture = new Picture();
                        $picture->name = $name;
                        $picture->url = $path;
                        $picture->save();


                        Image::make($image->getRealPath())
                            ->save(Storage::disk('public')->path($name), 70, 'jpg');
                    } catch (Exception $e) {
                        $errors[$name] = "Failed to upload $name: {$e->getMessage()}";
                    }
                }
            }
            return redirect()->back()->withErrors($errors);
        } else return redirect()->back()->withErrors(['error' => "You must select at least one picture"]);
    }

    public function delete(Request $r)
    {
        if (!$r->get('delete')) return redirect()->back()->withErrors(['error' => "You must select at least one picture"]);

        $pictures = Picture::find($r->get('delete'));
        foreach ($pictures as $picture) {
            if (Storage::disk('public')->exists($picture->name)) {
                Storage::disk('public')->delete($picture->name);
            }
            $picture->delete();
        }
        return redirect()->back();
    }
}
