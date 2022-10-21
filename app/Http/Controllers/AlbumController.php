<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AlbumController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Albums/Index', [
            'albums' => Album::all()->map(function ($albums) {
                return [
                    'title' => $albums->title,
                    'artist' => $albums->artist->name,
                    'genre' => $albums->genre,
                    'artwork' => asset("storage/artwork/" . $albums->artwork),
                ];
            }),
            //Provides a prop containing all artist names to be used when adding new albums. 
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
        //$image=Request::file('artwork')->store('artwork', 'public');

        if ($request->hasFile('artwork')) {

            $destination_path = 'Artwork';
            $artwork = $request->file('artwork');
            $artwork_name = $request->title . ' by ' . $request->artist . '.jpeg';
            //using only jpeg for now
            $path = $request->file('artwork')->storeAs($destination_path, $artwork_name, 'public');

            $input['artwork'] = $artwork_name;
        }

        //Get artist id
        $artist_id = Artist::select('id')->where('name', $request->artist)->get();
        if ($artist_id) {
            //Create new album only if it doesnt exist
            Album::Create(
                [
                    'artist_id' => $artist_id[0]->id,
                    'title' => $request->title,
                    'genre' => $request->genre,
                    'artwork' => $artwork_name
                ]
            );
            return Redirect::route('albums.index');
        }
    }
}
