@extends('layouts.admin')
@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2>Kelola Album</h2>
        <a href="{{ route('admin.albums.create') }}" class="btn" style="display: flex; align-items: center; gap: 8px;">
            <span style="font-size: 1.2rem; line-height: 1;">+</span> Tambah Album
        </a>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($albums as $album)
                    <tr>
                        <td style="color: var(--text-muted);">{{ $album->id }}</td>
                        <td>
                            @if($album->cover_image)
                                <img src="{{ Storage::url($album->cover_image) }}" alt="Cover" width="48" height="48" style="border-radius: 8px; object-fit: cover; box-shadow: var(--shadow-sm);">
                            @else
                                <div style="width: 48px; height: 48px; border-radius: 8px; background: var(--bg-hover); display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 0.75rem;">-</div>
                            @endif
                        </td>
                        <td style="font-weight: 600; color: var(--text-main);">{{ $album->title }}</td>
                        <td><span style="background: var(--bg-hover); padding: 4px 10px; border-radius: 12px; font-weight: 600; font-size: 0.85rem;">{{ $album->category->name ?? '-' }}</span></td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('admin.albums.edit', $album->id) }}" class="btn" style="padding: 8px 16px; font-size: 0.85rem;">Edit</a>
                                <form action="{{ route('admin.albums.destroy', $album->id) }}" method="POST" style="display:inline; padding:0; background:none;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 8px 16px; font-size: 0.85rem;" onclick="return confirm('Apakah Anda yakin ingin menghapus album ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 30px;">Belum ada album yang dibuat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
