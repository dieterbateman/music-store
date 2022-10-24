<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\artists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;



class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Create new artist only if it doesnt exist
        Artist::firstOrCreate([
            'name' => $request->name
        ]);
        //No feedback to user indicating artist exists
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Using Primary Key 'id' however 'artist' is unique and will give error if theres a duplicate
        $oldName=Artist::where('id',$id)->pluck('name')->toArray();
        Storage::move('/public/artwork/'. implode($oldName),  '/public/artwork/'. $request->name);
        Artist::where('id', $id)->update($request->all());
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        $directory='/public/artwork/'. $artist->name;
        Storage::deleteDirectory($directory); //remove artist folder containing all artwork
    }
}
