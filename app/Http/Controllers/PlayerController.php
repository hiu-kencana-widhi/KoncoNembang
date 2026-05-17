<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Sebagai Admin, Anda hanya bertugas mengelola lagu dan pengguna. Untuk mendengarkan lagu, silakan daftar sebagai User biasa.');
        }

        $categories = Category::with(['albums.tracks', 'tracks'])->get();
        $playlists = auth()->user()->playlists()->with('tracks')->get();
        
        return view('player', compact('categories', 'playlists'));
    }

    public function stream(Track $track)
    {
        if (auth()->user()->is_admin) {
            abort(403, 'Admin tidak diizinkan memutar lagu.');
        }

        $path = Storage::disk('local')->path('music/' . $track->filename);

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        return response()->file($path, [
            'Content-Type' => $track->mime_type,
            'Accept-Ranges' => 'bytes',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
