<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use Inertia\Inertia;

class SongController extends Controller
{
    public function show(Album $album)
    {
        // Get album specific info
        $album_info_obj = Album::get()->where('id', $album->id)->map(function ($album) {
            return [
                'id' => $album->id,
                'title' => $album->title,
                'artist' => $album->artist->name,
                'artwork' => asset("storage/artwork/" . $album->artist->name . "/" . $album->artwork,),
            ];
        });
        $album_info = $album_info_obj[($album->id) - 1]; //using album id as key but should minus 1 due to index starting at 0

        //Get songs for the entire album
        $songs_info = Song::all()->where('album_id', $album->id)->map(function ($songs) {
            return [
                'id' => $songs->id,
                'title' => $songs->title,
            ];
        });
        return Inertia::render('Admin/Songs/Index', [
            'songs' => $songs_info,
            'album' => $album_info
        ]);
        
    }
}
