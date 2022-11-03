<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SongController;
use App\Http\Controllers\AlbumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth', 'verified')->prefix('dashboard')->group(function () {
    Route::get('/', [AlbumController::class, 'dashboard_show'])->name('dashboard.index');
    Route::get('/songs/{album}', [SongController::class, 'dashboard_show'])->name('dashboard.songs');
});

Route::get('/private/music/{artist}/{file}', [SongController::class, 'download'])->middleware(['auth', 'verified'])->name('songs.download');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
