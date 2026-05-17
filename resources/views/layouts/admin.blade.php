<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - KoncoNembang</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark-mode');
        } else {
            document.documentElement.classList.remove('dark-mode');
        }
    </script>
</head>
<body>
    <script>
        // Synchronize body class on the absolute earliest moment to prevent flash
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.body.classList.add('dark-mode');
        }
    </script>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <a href="{{ route('admin.dashboard') }}" class="nav-logo" style="gap: 10px; text-decoration: none; display: flex; align-items: center;">
                <img src="{{ asset('image/Logo-KoncoNembang.png') }}" alt="KoncoNembang" style="max-height: 40px; width: auto; object-fit: contain;">
                <span style="font-weight: 800; font-size: 1.35rem; color: var(--text-main); letter-spacing: -0.5px;">KoncoNembang</span>
            </a>

            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard Utama</a>
            <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">Kelola User</a>
            <a href="{{ route('admin.tracks.index') }}" class="nav-link {{ request()->routeIs('admin.tracks.*') ? 'active' : '' }}">Manajemen Lagu</a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Kategori Lagu</a>
            <a href="{{ route('admin.albums.index') }}" class="nav-link {{ request()->routeIs('admin.albums.*') ? 'active' : '' }}">Manajemen Album</a>
            
            <a href="{{ route('admin.upload.form') }}" class="upload-btn">Upload Lagu Baru</a>

            <div style="margin-top: auto; display: flex; flex-direction: column; gap: 10px; width: 100%;">
                <button class="theme-btn" onclick="toggleTheme()" aria-label="Ubah Tema" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; font-weight: 600; font-size: 0.9rem; padding: 10px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); color: var(--text-muted);">
                    <!-- Sun Icon -->
                    <svg class="sun-icon" fill="currentColor" viewBox="0 0 24 24" width="18" height="18">
                        <path d="M12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zM2 13h2c.55 0 1-.45 1-1s-.45-1-1-1H2c-.55 0-1 .45-1 1s.45 1 1 1zm18 0h2c.55 0 1-.45 1-1s-.45-1-1-1h-2c-.55 0-1 .45-1 1s.45 1 1 1zM11 2v2c0 .55.45 1 1 1s1-.45 1-1V2c0-.55-.45-1-1-1s-1 .45-1 1zm0 18v2c0 .55.45 1 1 1s1-.45 1-1v-2c0-.55-.45-1-1-1s-1 .45-1 1zM5.99 4.58c-.39-.39-1.03-.39-1.41 0s-.39 1.03 0 1.41l1.06 1.06c.39.39 1.03.39 1.41 0s.39-1.03 0-1.41L5.99 4.58zm12.37 12.37c-.39-.39-1.03-.39-1.41 0s-.39 1.03 0 1.41l1.06 1.06c.39.39 1.03.39 1.41 0s.39-1.03 0-1.41l-1.06-1.06zm1.06-10.96c.39-.39.39-1.03 0-1.41s-1.03-.39-1.41 0l-1.06 1.06c-.39.39-.39 1.03 0 1.41s1.03.39 1.41 0l1.06-1.06zM7.05 18.01c.39-.39.39-1.03 0-1.41s-1.03-.39-1.41 0l-1.06 1.06c-.39.39-.39 1.03 0 1.41s1.03.39 1.41 0l1.06-1.06z"/>
                    </svg>
                    <!-- Moon Icon -->
                    <svg class="moon-icon" fill="currentColor" viewBox="0 0 24 24" width="18" height="18">
                        <path d="M12.3 22h-.1c-5.5 0-10-4.5-10-10C2.2 6.8 6.4 2.5 11.8 2c.5-.1 1 .3.9.8-.1.4-.4.8-.8.9-3.7.8-6.2 4-6.2 7.8 0 4.4 3.6 8 8 8 3.8 0 7-2.5 7.8-6.2.1-.4.5-.7.9-.8.5-.1.9.4.8.9-.5 5.4-4.8 9.6-10.9 9.6z"/>
                    </svg>
                    <span>Ubah Tema</span>
                </button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn" style="width: 100%;">Keluar (Log Out)</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            @if(session('success'))
                <div class="alert">
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    <script>
        function toggleTheme() {
            if (document.body.classList.contains('dark-mode')) {
                document.documentElement.classList.remove('dark-mode');
                document.body.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark-mode');
                document.body.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>
</body>
</html>
