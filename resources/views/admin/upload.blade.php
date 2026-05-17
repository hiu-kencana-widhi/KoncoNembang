@extends('layouts.admin')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2>Upload Lagu</h2>
    </div>

    <div class="form-wrapper">
        <form action="{{ route('admin.upload.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="title">Judul Lagu</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required placeholder="Contoh: Tak Segampang Itu">
                @error('title') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="artist">Artis</label>
                <input type="text" name="artist" id="artist" class="form-control" value="{{ old('artist') }}" placeholder="Contoh: Anggi Marito">
                @error('artist') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
                        <option value="{{ $album->id }}" {{ old('album_id') == $album->id ? 'selected' : '' }}>
                            {{ $album->title }}
                        </option>
                    @endforeach
                </select>
                @error('album_id') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="audio_file">File Audio (MP3, WAV, OGG, FLAC) Maks. 50MB</label>
                <input type="file" name="audio_file" id="audio_file" class="form-control" accept=".mp3,.wav,.ogg,.flac" required style="padding: 10px;">
                @error('audio_file') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="duration">Durasi (Detik, Opsional)</label>
                <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration') }}" min="0" placeholder="Misal: 240 untuk 4 menit">
                @error('duration') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Mulai Upload 🚀</button>
            </div>
        </form>
    </div>
@endsection
