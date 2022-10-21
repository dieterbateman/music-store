<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', 'is_admin')->prefix('admin')->group(function () {
    Route::resource('/artists', ArtistController::class)->only([
        'index', 'store','update', 'destroy'
    ]);
    Route::resource('/albums', AlbumController::class)->only([
        'index', 'store','update', 'destroy'
    ]);
});


