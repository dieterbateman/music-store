<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Artists/Index', [
            'artists' => Artist::all()->map(function ($artist) {
                return [
                    'id' => $artist->id,
                    'name' => $artist->name
                ];
            })
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:artists|string|max:255'
        ]);
        Artist::create([
            'name' => $request->name
        ]);
    }

    public function update(Artist $artist, Request $request)
    {
        $request->validate([
            'name' => 'required|unique:artists|string|max:255'
        ]);
        $artwork_directory = '/public/artwork/' . $artist->name;
        if (Storage::exists($artwork_directory)) {
            Storage::move($artwork_directory, '/public/artwork/' . $request->name);
        }
        //private directory isn't updating correctly
        $music_directory = '/private/music/' . $artist->name;
        if (Storage::exists($music_directory)) {
            Storage::move($music_directory, '/private/music/' . $request->name);
        }

        //Update artist in db
        $artist->update($request->all());
    }

    public function destroy(Artist $artist, Request $request)
    {
        $request->validate([
            'name' => 'required|exists:artists|string|max:255'
        ]);
        $artwork_directory = '/public/artwork/' . $artist->name;
        if (Storage::exists($artwork_directory)) {
            Storage::deleteDirectory($artwork_directory);
        }

        //private directory not deleting
        $music_directory = '/private/music/' . $artist->name;
        if (Storage::exists($music_directory)) {
            Storage::deleteDirectory($music_directory);
        }

        //Remove artist from db
        $artist->delete();
    }
}
