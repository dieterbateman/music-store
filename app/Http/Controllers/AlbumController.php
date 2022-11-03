<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
                    'artwork' => asset("storage/artwork/" . $albums->artist->name . "/" . $albums->artwork),
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

    public function dashboard_show()
    {
        return Inertia::render('User/Dashboard', [
            'albums' => Album::all()->map(function ($albums) {
                return [
                    'id' => $albums->id,
                    'title' => $albums->title,
                    'artist' => $albums->artist->name,
                    'genre' => $albums->genre,
                    'artwork' => asset("storage/artwork/" . $albums->artist->name . "/" . $albums->artwork),
                ];
            })
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'artist' => 'required|exists:artists,name',
            'genre' => 'required|string',
            'artwork' => 'required|image|dimensions:max_width=225,ratio=1/1',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $destination_path = 'artwork/' . $request->artist;
        $artwork = $request->file('artwork');
        $artwork_name = $request->title . '.' . $artwork->getClientOriginalExtension();
        $artwork->storeAs($destination_path, $artwork_name, 'public');

        //Get artist id
        $artist_id = Artist::select('id')->where('name', $request->artist)->get();
        Album::Create(
            [
                'artist_id' => $artist_id[0]->id,
                'title' => $request->title,
                'genre' => $request->genre,
                'artwork' => $artwork_name
            ]
        );
        //No need to redirect as promise will trigger clearForm() which redirects
    }

}
