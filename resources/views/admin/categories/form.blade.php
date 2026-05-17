@extends('layouts.admin')
@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2>{{ $category->exists ? 'Edit Kategori' : 'Tambah Kategori' }}</h2>
    </div>

    <div class="form-wrapper">
        <form action="{{ $category->exists ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" method="POST">
            @csrf
            @if($category->exists) @method('PUT') @endif
            
            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                @error('name') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-top: 30px; display: flex; align-items: center; gap: 16px;">
                <button type="submit" class="btn">Simpan</button>
                <a href="{{ route('admin.categories.index') }}" style="color: var(--text-muted); text-decoration: none; font-weight: 500;">Batal</a>
            </div>
        </form>
    </div>
@endsection
