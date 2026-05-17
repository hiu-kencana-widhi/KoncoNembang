<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PlaylistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('player');
    }
    return view('welcome');
})->name('landing');

Route::middleware('auth')->group(function () {
    Route::get('/player', [PlayerController::class, 'index'])->name('player');
    Route::get('/stream/{track}', [PlayerController::class, 'stream'])->name('stream');

    Route::post('/playlist', [PlaylistController::class, 'store']);
    Route::get('/playlist/{playlist}/tracks', [PlaylistController::class, 'getTracks']);
    Route::post('/playlist/{playlist}/add-track', [PlaylistController::class, 'addTrack']);
    Route::delete('/playlist/{playlist}/remove-track/{track}', [PlaylistController::class, 'removeTrack']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/upload', [AdminController::class, 'uploadForm'])->name('upload.form');
    Route::post('/upload', [AdminController::class, 'uploadStore'])->name('upload.store');
    
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('albums', AlbumController::class)->except(['show']);

    Route::get('/tracks', [AdminController::class, 'tracks'])->name('tracks.index');
    Route::get('/tracks/{track}/edit', [AdminController::class, 'editTrack'])->name('tracks.edit');
    Route::put('/tracks/{track}', [AdminController::class, 'updateTrack'])->name('tracks.update');
    Route::delete('/tracks/{track}', [AdminController::class, 'destroyTrack'])->name('tracks.destroy');
});

require __DIR__.'/auth.php';
