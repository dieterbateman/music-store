<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;


class SongController extends Controller
{
    public function show(Album $album)
    {
        // Get album specific info
        $album_info = [
            'id' => $album->id,
            'title' => $album->title,
            'artist' => $album->artist->name,
            'artwork' => asset("storage/artwork/" . $album->artist->name . "/" . $album->artwork),
        ];

        //Get songs for the entire album
        $songs_info = Song::all()->where('album_id', $album->id)->map(function ($songs) {
            return [
                'id' => $songs->id,
                'title' => $songs->title,
                'file' => asset("private/music/" . $songs->album->artist->name . "/" .  $songs->file,),
            ];
        });
        return Inertia::render('Admin/Songs/Index', [
            'songs' => $songs_info,
            'album' => $album_info
        ]);
    }

    public function dashboard_show(Album $album)
    {
        $album_info = [
            'id' => $album->id,
            'title' => $album->title,
            'artist' => $album->artist->name,
            'artwork' => asset("storage/artwork/" . $album->artist->name . "/" . $album->artwork),
        ];

        $songs_info = Song::all()->where('album_id', $album->id)->map(function ($songs) {
            return [
                'id' => $songs->id,
                'title' => $songs->title,
                'file' => asset("private/music/" . $songs->album->artist->name . "/" .  $songs->file,),
            ];
        });
        return Inertia::render('User/SongsIndex', [
            'songs' => $songs_info,
            'album' => $album_info
        ]);
    }

    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'albumTitle' => 'required|exists:albums,title',
            'song' => 'required|file|mimes:mp4,wav,mp3,aac,wma,flac,m4a'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $destination_path = 'private/music/' . $request->artist;
        $song = $request->file('song');
        $song_name = $request->albumTitle . ' - ' . $request->title . '.' . $song->getClientOriginalExtension();
        $song->storeAs($destination_path, $song_name, 'local');

        Song::Create(
            [
                'album_id' => $id,
                'title' => $request->title,
                'file' => $song_name,
            ]
        );
        return Redirect::route('songs.show', [$id]);
    }

    public function download($artist, $file)
    {
        $path = "private/music/{$artist}/{$file}";
        if (Storage::exists($path)) {
            return Storage::download($path);
        }
        abort(404);
    }
}
