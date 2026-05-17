@extends('layouts.admin')
@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2>{{ $album->exists ? 'Edit Album' : 'Tambah Album' }}</h2>
    </div>

    <div class="form-wrapper">
        <form action="{{ $album->exists ? route('admin.albums.update', $album->id) : route('admin.albums.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($album->exists) @method('PUT') @endif
            
            <div class="form-group">
                <label for="title">Judul Album</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $album->title) }}" required>
                @error('title') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $album->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="cover_image">Cover Image</label>
                @if($album->cover_image)
                    <div style="margin-bottom: 12px;">
                        <img src="{{ Storage::url($album->cover_image) }}" alt="Cover" width="120" style="border-radius:12px; box-shadow: var(--shadow-sm);">
                    </div>
                @endif
                <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*" style="padding: 10px;">
                @error('cover_image') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-top: 30px; display: flex; align-items: center; gap: 16px;">
                <button type="submit" class="btn">Simpan</button>
                <a href="{{ route('admin.albums.index') }}" style="color: var(--text-muted); text-decoration: none; font-weight: 500;">Batal</a>
            </div>
        </form>
    </div>
@endsection
