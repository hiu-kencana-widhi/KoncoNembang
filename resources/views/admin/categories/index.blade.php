@extends('layouts.admin')
@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2>Kelola Kategori</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn" style="display: flex; align-items: center; gap: 8px;">
            <span style="font-size: 1.2rem; line-height: 1;">+</span> Tambah Kategori
        </a>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jumlah Lagu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td style="color: var(--text-muted);">{{ $category->id }}</td>
                        <td style="font-weight: 600; color: var(--text-main);">{{ $category->name }}</td>
                        <td><span style="background: var(--bg-hover); padding: 4px 10px; border-radius: 12px; font-weight: 600; font-size: 0.85rem;">{{ $category->tracks_count }}</span></td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn" style="padding: 8px 16px; font-size: 0.85rem;">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline; padding:0; background:none;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 8px 16px; font-size: 0.85rem;" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 30px;">Belum ada kategori yang dibuat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
