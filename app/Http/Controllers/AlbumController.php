<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('category')->withCount('tracks')->get();
        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.albums.form', ['album' => new Album(), 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['title', 'category_id']);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('album_covers', 'public');
            $data['cover_image'] = $path;
        }

        Album::create($data);

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil ditambahkan.');
    }

    public function edit(Album $album)
    {
        $categories = Category::all();
        return view('admin.albums.form', compact('album', 'categories'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['title', 'category_id']);

        if ($request->hasFile('cover_image')) {
            if ($album->cover_image) {
                Storage::disk('public')->delete($album->cover_image);
            }
            $path = $request->file('cover_image')->store('album_covers', 'public');
            $data['cover_image'] = $path;
        }

        $album->update($data);

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil diperbarui.');
    }

    public function destroy(Album $album)
    {
        if ($album->cover_image) {
            Storage::disk('public')->delete($album->cover_image);
        }
        $album->delete();
        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil dihapus.');
    }
}
