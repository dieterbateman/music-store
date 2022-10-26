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
                    'id' => $albums->id,
                    'title' => $albums->title,
                    'artist' => $albums->artist->name,
                    'genre' => $albums->genre,
                    'artwork' => asset("storage/artwork/". $albums->artist->name ."/". $albums->artwork),
                ];
            }),
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
        if ($request->hasFile('artwork')) {

            $destination_path = 'Artwork/'. $request->artist;
            $artwork = $request->file('artwork');
            $artwork_name = $request->title . ' by ' . $request->artist .'.'.$artwork->getClientOriginalExtension();
            $path = $artwork->storeAs($destination_path, $artwork_name, 'public');
        } else {
            $artwork_name=null;
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
        }
        
        //return Redirect::route('albums.index');
    }
}
