@extends('layouts.admin')
@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2>Manajemen Lagu</h2>
        <a href="{{ route('admin.upload.form') }}" class="btn btn-primary" style="display: flex; align-items: center; gap: 8px;">
            <span style="font-size: 1.2rem; line-height: 1;">+</span> Upload Lagu
        </a>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Judul Lagu</th>
                    <th>Artis</th>
                    <th>Kategori</th>
                    <th>Album</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tracks as $track)
                    <tr>
                        <td style="font-weight: 600; color: var(--text-main);">{{ $track->title }}</td>
                        <td style="color: var(--text-muted);">{{ $track->artist ?? '-' }}</td>
                        <td><span style="background: var(--bg-hover); padding: 4px 10px; border-radius: 12px; font-weight: 600; font-size: 0.85rem;">{{ $track->category->name ?? '-' }}</span></td>
                        <td><span style="background: var(--bg-hover); padding: 4px 10px; border-radius: 12px; font-weight: 600; font-size: 0.85rem;">{{ $track->album->title ?? '-' }}</span></td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('admin.tracks.edit', $track->id) }}" class="btn" style="padding: 8px 16px; font-size: 0.85rem;">Edit</a>
                                <form action="{{ route('admin.tracks.destroy', $track->id) }}" method="POST" style="display:inline; padding:0; background:none;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 8px 16px; font-size: 0.85rem;" onclick="return confirm('Apakah Anda yakin ingin menghapus lagu ini secara permanen?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 30px;">Belum ada lagu yang diunggah.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 24px;">
        {{ $tracks->links() }}
    </div>
@endsection
