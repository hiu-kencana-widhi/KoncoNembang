@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<div id="app">
    <!-- Mobile Header -->
    <header class="mobile-header">
        <button id="menu-toggle" aria-label="Toggle Menu">
            <svg fill="currentColor" viewBox="0 0 24 24" width="28" height="28"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
        </button>
        <div style="display: flex; align-items: center; gap: 8px;">
            <img src="{{ asset('image/Logo-KoncoNembang.png') }}" alt="KoncoNembang" class="mobile-logo">
            <span style="font-weight: 800; font-size: 1.15rem; color: var(--text-main); letter-spacing: -0.5px;">KoncoNembang</span>
        </div>
        <div style="width: 28px;"></div>
    </header>

    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    
    <!-- Sidebar -->
    <aside id="sidebar" style="display: flex;">
        <div class="brand-header" style="display: flex; align-items: center; gap: 10px;">
            <img src="{{ asset('image/Logo-KoncoNembang.png') }}" alt="KoncoNembang" class="brand-logo" style="max-height: 40px;">
            <span style="font-weight: 800; font-size: 1.35rem; color: var(--text-main); letter-spacing: -0.5px;">KoncoNembang</span>
        </div>
        
        <div class="sidebar-nav">
            <a href="/" class="nav-link admin-link" style="color: var(--primary); background: var(--primary-light); border-color: var(--primary-border);">
                <svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20" style="margin-right: 4px;"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                Kembali Bermain
            </a>
        </div>
        
        <div style="flex-grow: 1;"></div>

        <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <button type="submit" class="logout-btn" style="border-radius: var(--radius-sm);">Keluar (Log Out)</button>
        </form>
    </aside>

    <!-- Main Content -->
    <main id="main-content">
        <div style="max-width: 650px; margin: 0 auto;">
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 8px; color: var(--text-main); letter-spacing: -0.5px;">Profil Akun</h2>
            <p class="page-subtitle" style="margin-bottom: 28px;">Kelola informasi profil dan keamanan akun Anda.</p>

            @if (session('status') === 'profile-updated')
                <div class="alert" style="margin-bottom: 24px;">
                    <span>Informasi profil Anda berhasil diperbarui!</span>
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="alert" style="margin-bottom: 24px;">
                    <span>Password Anda berhasil diperbarui!</span>
                </div>
            @endif

            <!-- 1. Update Profile Info -->
            <div class="form-wrapper" style="margin-top: 0; margin-bottom: 24px;">
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 6px; color: var(--text-main);">Informasi Profil</h3>
                <p style="font-size: 0.88rem; color: var(--text-muted); margin-bottom: 20px;">Perbarui nama dan alamat email akun Anda.</p>
                
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autocomplete="name">
                        @error('name') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                        @error('email') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" style="padding: 10px 20px;">Simpan Perubahan</button>
                </form>
            </div>

            <!-- 2. Update Password -->
            <div class="form-wrapper" style="margin-bottom: 24px;">
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 6px; color: var(--text-main);">Perbarui Password</h3>
                <p style="font-size: 0.88rem; color: var(--text-muted); margin-bottom: 20px;">Pastikan akun Anda menggunakan password acak yang panjang agar tetap aman.</p>
                
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="update_password_current_password">Password Saat Ini</label>
                        <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" required>
                        @error('current_password') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="update_password_password">Password Baru</label>
                        <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" required>
                        @error('password') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="update_password_password_confirmation">Konfirmasi Password Baru</label>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" required>
                        @error('password_confirmation') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" style="padding: 10px 20px;">Perbarui Password</button>
                </form>
            </div>

            <!-- 3. Delete Account -->
            <div class="form-wrapper" style="margin-bottom: 40px; border-color: var(--danger-border); background: var(--danger-light);">
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 6px; color: var(--danger);">Hapus Akun</h3>
                <p style="font-size: 0.88rem; color: var(--danger); margin-bottom: 20px; opacity: 0.9;">Setelah akun Anda dihapus, semua data dan aset di dalamnya akan dihapus secara permanen.</p>
                
                <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda benar-benar yakin ingin menghapus akun ini secara permanen?')">
                    @csrf
                    @method('delete')

                    <div class="form-group">
                        <label for="password" style="color: var(--danger);">Masukkan Password Anda untuk Konfirmasi</label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Password Anda" required style="border-color: var(--danger-border);">
                        @error('password') <small style="color:var(--danger); display:block; margin-top:6px;">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn btn-danger" style="padding: 10px 20px;">Hapus Akun Permanen</button>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    const toggleSidebar = (e) => {
        if(e) e.stopPropagation();
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    };

    menuToggle.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
    });
</script>
@endsection
