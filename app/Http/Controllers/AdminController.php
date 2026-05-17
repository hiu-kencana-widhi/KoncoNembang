<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Category;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard() 
    { 
        $stats = [
            'users' => User::count(),
            'tracks' => Track::count(),
            'categories' => Category::count(),
            'albums' => Album::count(),
        ];
        return view('admin.dashboard', compact('stats')); 
    }

    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        if ($user->is_admin) {
            return redirect()->route('admin.users')->with('error', 'Admin tidak dapat dihapus.');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    }

    public function uploadForm()
    {
        $categories = Category::all();
        $albums = Album::all();
        return view('admin.upload', compact('categories', 'albums'));
    }

    public function uploadStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'album_id' => 'nullable|exists:albums,id',
            'audio_file' => 'required|file|mimes:mp3,wav,ogg,flac|max:51200',
            'duration' => 'nullable|integer|min:0'
        ]);

        $file = $request->file('audio_file');
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        
        $path = $file->storeAs('music', $filename, 'local');

        Track::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'category_id' => $request->category_id,
            'album_id' => $request->album_id,
            'filename' => $filename,
            'mime_type' => $file->getClientMimeType(),
            'duration' => $request->duration ?? 0,
        ]);

        return redirect()->route('admin.upload.form')->with('success', 'Lagu berhasil diunggah.');
    }

    public function tracks()
    {
        $tracks = Track::with(['category', 'album'])->latest()->paginate(20);
        return view('admin.tracks.index', compact('tracks'));
    }

    public function editTrack(Track $track)
    {
        $categories = Category::all();
        $albums = Album::all();
        return view('admin.tracks.edit', compact('track', 'categories', 'albums'));
    }

    public function updateTrack(Request $request, Track $track)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'album_id' => 'nullable|exists:albums,id',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg,flac|max:51200',
            'duration' => 'nullable|integer|min:0'
        ]);

        $data = [
            'title' => $request->title,
            'artist' => $request->artist,
            'category_id' => $request->category_id,
            'album_id' => $request->album_id,
            'duration' => $request->duration ?? 0,
        ];

        if ($request->hasFile('audio_file')) {
            $file = $request->file('audio_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('music', $filename, 'local');
            
            if (Storage::disk('local')->exists('music/' . $track->filename)) {
                Storage::disk('local')->delete('music/' . $track->filename);
            }
            
            $data['filename'] = $filename;
            $data['mime_type'] = $file->getClientMimeType();
        }

        $track->update($data);
        return redirect()->route('admin.tracks.index')->with('success', 'Lagu berhasil diperbarui.');
    }

    public function destroyTrack(Track $track)
    {
        if (Storage::disk('local')->exists('music/' . $track->filename)) {
            Storage::disk('local')->delete('music/' . $track->filename);
        }
        $track->delete();
        return redirect()->route('admin.tracks.index')->with('success', 'Lagu berhasil dihapus.');
    }
}
