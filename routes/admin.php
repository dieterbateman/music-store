<?php

use App\Http\Controllers\ArtistController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', 'is_admin')->prefix('admin')->group(function () {
    Route::get('artists/home', [ArtistController::class, 'index'])->name('artists.home');
    Route::get('artists/create', [ArtistController::class, 'create'])->name('artists.create');
});
