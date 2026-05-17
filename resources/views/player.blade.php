@extends('layouts.app')

@section('content')
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
        <div style="width: 28px;"></div> <!-- Spacer for center alignment -->
    </header>

    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <aside id="sidebar">
        <div class="brand-header" style="display: flex; align-items: center; gap: 10px;">
            <img src="{{ asset('image/Logo-KoncoNembang.png') }}" alt="KoncoNembang" class="brand-logo" style="max-height: 40px;">
            <span style="font-weight: 800; font-size: 1.35rem; color: var(--text-main); letter-spacing: -0.5px;">KoncoNembang</span>
        </div>
        
        <div class="sidebar-nav">
            <a href="{{ route('profile.edit') }}" class="nav-link">
                <svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                Profil Akun
            </a>
            @if(auth()->user() && auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="nav-link admin-link">
                    <svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20"><path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.06-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.73,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.06,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.43-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.49-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/></svg>
                    Panel Admin
                </a>
            @endif
        </div>
        
        <div class="section-title">Kategori</div>
        <ul id="category-list">
            <li data-category="all" class="active">Semua Lagu</li>
            @foreach($categories as $cat)
                <li data-category="{{ $cat->id }}">{{ $cat->name }}</li>
            @endforeach
            <button id="shuffle-indo" class="action-btn" style="margin-top: 10px;">
                <svg fill="currentColor" viewBox="0 0 24 24" width="16" height="16"><path d="M10.59 9.17L5.41 4 4 5.41l5.17 5.17 1.42-1.41zM14.5 4l2.04 2.04L4 18.59 5.41 20 17.96 7.46 20 9.5V4h-5.5zm.33 9.41l-1.41 1.41 3.13 3.13L14.5 20H20v-5.5l-2.04 2.04-3.13-3.13z"/></svg>
                Acak Kategori
            </button>
        </ul>
        
        <div class="section-title">Album</div>
        <ul id="album-list">
            <li><span style="color:var(--text-muted);font-style:italic;">Pilih kategori dulu</span></li>
        </ul>
        
        <div class="section-title">Playlist Anda</div>
        <ul id="user-playlists">
            @foreach($playlists as $pl)
                <li data-playlist-id="{{ $pl->id }}">{{ $pl->name }}</li>
            @endforeach
            <button id="new-playlist-btn" class="text-btn">+ Buat Playlist</button>
        </ul>

        <div style="flex-grow: 1;"></div>
        
        <button class="theme-btn" onclick="toggleTheme()" aria-label="Ubah Tema" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; font-weight: 600; font-size: 0.9rem; padding: 10px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); color: var(--text-muted); background: transparent; margin-bottom: 10px;">
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
            <button type="submit" class="action-btn" style="width: 100%; color: var(--danger); justify-content: center; border-color: #fca5a5; background: transparent;">
                <svg fill="currentColor" viewBox="0 0 24 24" width="18" height="18"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                Keluar (Log Out)
            </button>
        </form>
    </aside>

    <main id="main-content">
        <div class="top-bar">
            <div class="search-container">
                <svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20" class="search-icon"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                <input type="text" id="search-input" placeholder="Apa yang ingin Anda putar hari ini?">
            </div>
        </div>

        <div id="track-list-container">
            <h2 id="current-view-title">Semua Lagu</h2>
            <ul id="track-list">
                <li><span style="color:var(--text-muted);">Memuat lagu...</span></li>
            </ul>
        </div>
    </main>
</div>

<footer id="player-bar">
    <div class="player-top">
        <span id="now-playing">Pilih lagu untuk memutar</span>
        <div id="controls">
            <button id="shuffle-btn" class="control-btn" aria-label="Shuffle">
                <svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20"><path d="M10.59 9.17L5.41 4 4 5.41l5.17 5.17 1.42-1.41zM14.5 4l2.04 2.04L4 18.59 5.41 20 17.96 7.46 20 9.5V4h-5.5zm.33 9.41l-1.41 1.41 3.13 3.13L14.5 20H20v-5.5l-2.04 2.04-3.13-3.13z"/></svg>
            </button>
            <button id="prev" class="control-btn" aria-label="Previous">
                <svg fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"/></svg>
            </button>
            <button id="play" class="control-btn" aria-label="Play/Pause">
                <svg fill="currentColor" viewBox="0 0 24 24" width="28" height="28"><path d="M8 5v14l11-7z"/></svg>
            </button>
            <button id="next" class="control-btn" aria-label="Next">
                <svg fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/></svg>
            </button>
            <button id="repeat-btn" class="control-btn" aria-label="Repeat">
                <svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20"><path d="M7 7h10v3l4-4-4-4v3H5v6h2V7zm10 10H7v-3l-4 4 4 4v-3h12v-6h-2v4z"/></svg>
            </button>
        </div>
    </div>
    
    <div class="progress-container">
        <input type="range" id="progress" value="0" max="100" aria-label="Progress Bar">
        <small id="time-display">0:00 / 0:00</small>
    </div>
    
    <audio id="audio" preload="metadata"></audio>
</footer>

<script>
    window.tracksData = @json($categories, JSON_UNESCAPED_SLASHES);
    window.userPlaylists = @json($playlists, JSON_UNESCAPED_SLASHES);

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
<script src="{{ asset('js/player.js') }}"></script>
@endsection
