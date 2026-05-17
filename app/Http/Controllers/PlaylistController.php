<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $playlist = $request->user()->playlists()->create([
            'name' => $request->name
        ]);

        $playlist->load('tracks');

        return response()->json(['success' => true, 'playlist' => $playlist]);
    }

    public function getTracks(Playlist $playlist)
    {
        if ($playlist->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json(['tracks' => $playlist->tracks]);
    }

    public function addTrack(Request $request, Playlist $playlist)
    {
        if ($playlist->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'track_id' => 'required|exists:tracks,id'
        ]);

        if (!$playlist->tracks()->where('track_id', $request->track_id)->exists()) {
            $order = $playlist->tracks()->max('order') ?? 0;
            $playlist->tracks()->attach($request->track_id, ['order' => $order + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function removeTrack(Playlist $playlist, Track $track)
    {
        if ($playlist->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $playlist->tracks()->detach($track->id);
        return response()->json(['success' => true]);
    }
}
