<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', 'is_admin')->prefix('admin')->group(function () {
    Route::resource('/artists', ArtistController::class)->only([
        'index', 'store','update', 'destroy'
    ]);
    Route::resource('/albums', AlbumController::class)->only([
        'index', 'store','update', 'destroy'
    ]);
    Route::get('/songs/{album}', [SongController::class, 'show'])->name('songs.show');
    Route::post('/songs/{album}', [SongController::class, 'store'])->name('songs.store');
});


