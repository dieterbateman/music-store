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
        //If artist already exist the user wont receive any feedback and there will be an error
        Artist::firstOrCreate([
            'name' => $request->name
        ]);
    }

    public function update(Request $request, $id)
    {
        //Update storage with new artist name
        $oldName = Artist::where('id', $id)->pluck('name')->toArray();
        Storage::move('/public/artwork/' . implode($oldName), '/public/artwork/' . $request->name);
        Storage::move('/Music/' . implode($oldName), '/Music/' . $request->name);
        //Update artist name in db
        Artist::where('id', $id)->update($request->all());
    }

    public function destroy(Artist $artist)
    {
        //Remove all directories of artist
        $artwork_directory = '/public/artwork/' . $artist->name;
        Storage::deleteDirectory($artwork_directory);
        $music_directory = 'Music/' . $artist->name;
        Storage::deleteDirectory($music_directory);
        //Remove artist from db
        $artist->delete();
    }
}
