@extends('layouts.admin')
@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2>Edit Lagu</h2>
    </div>

    <div class="form-wrapper">
        <form action="{{ route('admin.tracks.update', $track->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Judul Lagu</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $track->title) }}" required>
                @error('title') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="artist">Artis</label>
                <input type="text" name="artist" id="artist" class="form-control" value="{{ old('artist', $track->artist) }}">
                @error('artist') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $track->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="album_id">Album (Opsional)</label>
                <select name="album_id" id="album_id" class="form-control">
                    <option value="">-- Pilih Album --</option>
                    @foreach($albums as $album)
                        <option value="{{ $album->id }}" {{ old('album_id', $track->album_id) == $album->id ? 'selected' : '' }}>
                            {{ $album->title }}
                        </option>
                    @endforeach
                </select>
                @error('album_id') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="audio_file">File Audio Baru (Kosongkan jika tidak ingin mengubah file)</label>
                <input type="file" name="audio_file" id="audio_file" class="form-control" accept=".mp3,.wav,.ogg,.flac" style="padding: 10px;">
                <small style="display:block; margin-top:6px; color: var(--text-muted);">File saat ini: <strong style="color: var(--primary);">{{ $track->filename }}</strong></small>
                @error('audio_file') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="duration">Durasi (Detik, Opsional)</label>
                <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration', $track->duration) }}" min="0">
                @error('duration') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-top: 30px; display: flex; align-items: center; gap: 16px;">
                <button type="submit" class="btn btn-primary" style="font-size: 1rem; padding: 12px 24px;">Simpan Perubahan</button>
                <a href="{{ route('admin.tracks.index') }}" style="color: var(--text-muted); text-decoration: none; font-weight: 500;">Batal</a>
            </div>
        </form>
    </div>
@endsection
