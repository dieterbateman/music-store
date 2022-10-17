<?php

use App\Http\Controllers\ArtistController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', 'is_admin')->prefix('admin')->group(function () {
    Route::resource('artists', ArtistController::class);
    // Route::get('artists/create', [ArtistController::class, 'create'])->name('artists.create');
});
