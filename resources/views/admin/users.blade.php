@extends('layouts.admin')
@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2>Kelola Pengguna</h2>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: var(--text-main);">{{ $user->name }}</div>
                            @if($user->is_admin) 
                                <span style="font-size: 0.75rem; background: #e0e7ff; color: var(--primary); padding: 2px 8px; border-radius: 12px; font-weight: 700; margin-top: 4px; display: inline-block;">Admin</span>
                            @endif
                        </td>
                        <td style="color: var(--text-muted);">{{ $user->email }}</td>
                        <td style="color: var(--text-muted);">{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            @if(!$user->is_admin)
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline; padding:0; background:none;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 8px 16px; font-size: 0.85rem;" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.')">Hapus</button>
                            </form>
                            @else
                            <span style="color: var(--text-muted); font-size: 0.85rem; font-style: italic;">Tidak dapat dihapus</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 30px;">Belum ada pengguna yang mendaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 24px;">
        {{ $users->links() }}
    </div>
@endsection
