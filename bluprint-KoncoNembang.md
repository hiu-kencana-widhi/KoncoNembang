Visi & Konsep
KoncoNembang adalah aplikasi streaming musik yang dibuat khusus untuk kalian dan teman-teman. Semua musik yang kamu upload bisa didengarkan tanpa iklan, tanpa tracking, tanpa batasan. Tampilan full dark biar nyaman di mata, ringan di HP, dan bisa jalan mulus di browser apa aja. Admin bisa mengelola musik, kategori, album, dan lihat siapa aja yang udah gabung. Fitur player-nya lengkap: putar per album, acak lagu Indonesia atau lagu Asing, ulangi satu lagu atau seluruh antrian, dan bikin playlist sendiri.

Kenapa pake Laravel? Karena kita butuh backend yang simpel, Blade bikin gampang bikin UI tanpa ribet pake Vue/React, dan semua serba native – nggak ada loading berat, nggak bikin HP panas.

Arsitektur Sistem
Komponen Utama
Laravel 11 (backend + templating Blade)

MySQL / MariaDB (penyimpanan data)

Nginx / Apache (web server, reverse proxy)

PHP-FPM 8.2+

Browser (client player)

Alur Kerja
User register/login.

Admin upload file musik via panel admin, file disimpan di storage/app/private/music/ (tidak bisa diakses langsung).

Saat diputar, browser melakukan request ke /stream/{track} yang dilindungi middleware auth. Controller membaca file dan mengirimkan response dengan dukungan HTTP Range agar seek dan buffer stabil.

JavaScript vanilla menangani queue, shuffle, repeat, dan playlist.

CSS murni (tanpa framework) dengan mobile-first design menghasilkan tampilan responsif native.

Skema Jaringan
text
[User Browser] <--HTTPS--> [Nginx] <--> [PHP-FPM / Laravel] <--> [MySQL]
                                      |
                                 [Storage Private]
Spesifikasi Teknis
PHP: 8.2+

Laravel: 11.x (bisa 10.x dengan sedikit penyesuaian)

Database: MySQL 8.0 / MariaDB 10.6+

Web Server: Nginx 1.24+ dengan konfigurasi untuk streaming range.

Browser Target: Chrome Android 90+, Safari iOS 15+, Firefox, Edge.

Resolusi Target: 320px – 1440px (mobile, tablet, desktop).

Library Eksternal: TIDAK ADA. Semua vanilla. (kecuali library opsional getID3 untuk durasi, itu pun nanti kita bisa hitung manual).

Desain Database Lengkap
Tabel users
Kolom	Tipe	Keterangan
id	bigint (PK)	auto increment
name	varchar(255)	nama user
email	varchar(255)	unik
password	varchar(255)	hash bcrypt
is_admin	tinyint(1)	default 0, hanya admin bisa 1
created_at	timestamp	
updated_at	timestamp	
Tabel categories
Kolom	Tipe	Keterangan
id	bigint (PK)	
name	varchar(100)	"Indonesia", "Asing"
created_at	timestamp	
updated_at	timestamp	
Tabel albums
Kolom	Tipe	Keterangan
id	bigint (PK)	
category_id	bigint (FK)	nullable? tidak, setiap album harus punya kategori bahasa.
title	varchar(255)	
cover_image	varchar(255)	nullable, path di storage public
created_at	timestamp	
updated_at	timestamp	
Tabel tracks
Kolom	Tipe	Keterangan
id	bigint (PK)	
title	varchar(255)	
artist	varchar(255)	nullable
album_id	bigint (FK)	nullable (untuk single)
filename	varchar(255)	nama file di storage private
mime_type	varchar(50)	audio/mpeg, dll
duration	integer	durasi dalam detik (0 jika tidak diketahui)
created_at	timestamp	
updated_at	timestamp	
Relasi: albums.category_id -> categories.id, tracks.album_id -> albums.id.
Setiap track otomatis punya kategori lewat albumnya (jika ada). Jika album null, kita tetap perlu tau kategorinya? Untuk single, kita bisa set album "Single" dalam kategori tertentu, atau nanti admin pilih kategori langsung di form upload, tapi kita tidak simpan di track. Alternatif: tambahkan category_id di tracks untuk memudahkan query shuffle per kategori. Saya sarankan tambahkan category_id langsung di tabel tracks agar tidak bergantung pada album. Album tetap punya category_id untuk filter album.

Tabel playlists
Kolom	Tipe	Keterangan
id	bigint (PK)	
user_id	bigint (FK)	
name	varchar(255)	
created_at	timestamp	
updated_at	timestamp	
Tabel playlist_track (pivot)
Kolom	Tipe	Keterangan
id	bigint (PK)	
playlist_id	bigint (FK)	
track_id	bigint (FK)	
order	integer	default 0, urutan
created_at	timestamp	
updated_at	timestamp	
Indeks: unique(playlist_id, track_id) untuk mencegah duplikat.

Struktur Direktori Laravel
Hanya file dan folder yang relevan:

text
project-root/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── AlbumController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── PlayerController.php
│   │   │   ├── PlaylistController.php
│   │   │   └── Auth/ (Login, Register, etc. jika manual)
│   │   ├── Middleware/
│   │   │   └── IsAdmin.php
│   │   └── Kernel.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Category.php
│   │   ├── Album.php
│   │   ├── Track.php
│   │   └── Playlist.php
│   └── ...
├── database/
│   └── migrations/
│       ├── ...create_users_table.php
│       ├── ...create_categories_table.php
│       ├── ...create_albums_table.php
│       ├── ...create_tracks_table.php
│       ├── ...create_playlists_table.php
│       └── ...create_playlist_track_table.php
├── public/
│   ├── css/
│   │   ├── player.css
│   │   └── admin.css
│   ├── js/
│   │   ├── player.js
│   │   └── admin.js (minim, hanya konfirmasi hapus)
│   ├── manifest.json
│   └── sw.js (opsional)
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php (layout player)
│       │   └── admin.blade.php (layout admin)
│       ├── player.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── users.blade.php
│       │   ├── upload.blade.php
│       │   ├── categories/
│       │   │   ├── index.blade.php
│       │   │   └── form.blade.php
│       │   └── albums/
│       │       ├── index.blade.php
│       │       └── form.blade.php
│       └── auth/
│           ├── login.blade.php
│           └── register.blade.php
├── routes/
│   └── web.php
├── storage/
│   └── app/
│       └── private/
│           └── music/  (file audio)
│   └── app/public/
│       └── album_covers/ (jika pakai symbolic link)
└── .env
Autentikasi & Otorisasi
Gunakan Laravel Breeze (versi Blade) untuk setup auth cepat. Breeze sudah menyediakan halaman login, register, dan dashboard sederhana. Kita modif supaya setelah login user langsung ke route / (player). Admin diarahkan ke /admin jika role-nya admin.

Instalasi Breeze
bash
composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan migrate
Modifikasi Redirect
Di app/Http/Controllers/Auth/AuthenticatedSessionController.php, setelah login:

php
if (auth()->user()->is_admin) {
    return redirect('/admin');
}
return redirect('/');
Middleware IsAdmin
Buat middleware dan daftarkan di Kernel. Route group admin pakai auth + admin.

Panel Admin – Fitur & Implementasi
Route Admin
php
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/upload', [AdminController::class, 'uploadForm'])->name('upload.form');
    Route::post('/upload', [AdminController::class, 'uploadStore'])->name('upload.store');
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('albums', AlbumController::class)->except(['show']);
});
Halaman Dashboard
Statistik sederhana: jumlah user, jumlah lagu, jumlah album, kategori.

Manajemen User
Tabel user dengan kolom: Nama, Email, Tanggal Daftar, Aksi (Hapus). Admin tidak bisa dihapus.

Upload Musik
Form dengan input:

Judul (required)

Artis

Pilih Kategori (select dropdown)

Pilih Album (select dropdown, optional). Untuk mempermudah, kita isi album berdasarkan kategori (via JavaScript fetch atau kita load semua). Karena ringan, kita load semua album di view.

File audio (required, validasi mime: mp3, ogg, wav, flac, max 50MB)

Durasi (opsional, integer detik)

Proses upload: file disimpan di storage/app/private/music/ dengan nama unik. Data track masuk database dengan category_id dari input langsung.

CRUD Kategori & Album
Kategori: hanya nama.

Album: judul, pilih kategori, cover image (opsional). Cover disimpan di public/album_covers/ via symbolic link.

Keamanan Upload
Hanya admin yang bisa akses. Validasi file ketat.

Player Musik – Frontend & Backend
Route
php
Route::middleware('auth')->group(function () {
    Route::get('/', [PlayerController::class, 'index'])->name('player');
    Route::get('/stream/{track}', [PlayerController::class, 'stream'])->name('stream');
    // Playlist
    Route::post('/playlist', [PlaylistController::class, 'store']);
    Route::get('/playlist/{playlist}/tracks', [PlaylistController::class, 'getTracks']);
    Route::post('/playlist/{playlist}/add-track', [PlaylistController::class, 'addTrack']);
    Route::delete('/playlist/{playlist}/remove-track/{track}', [PlaylistController::class, 'removeTrack']);
});
PlayerController index()
Kirim data kategori beserta album dan track-nya dalam satu JSON agar tidak banyak AJAX call. Batasi jika koleksi besar bisa pakai pagination, tapi untuk private use ratusan lagu masih aman.

php
$categories = Category::with(['albums.tracks'])->get();
$playlists = auth()->user()->playlists()->with('tracks')->get();
return view('player', compact('categories', 'playlists'));
Method stream(Track $track)
Support range request dengan response()->file().

php
public function stream(Track $track)
{
    $path = storage_path('app/private/music/' . $track->filename);
    if (!file_exists($path)) abort(404);
    
    return response()->file($path, [
        'Content-Type' => $track->mime_type,
        'Accept-Ranges' => 'bytes',
        'Cache-Control' => 'public, max-age=86400',
    ]);
}
Laravel otomatis menangani header range dari request.

Fitur Player JavaScript
Queue: array track dari album, kategori, atau playlist.

Shuffle: tombol toggle, acak antrian dengan Fisher-Yates. Simpan originalQueue untuk kembali.

Repeat: mode none -> all -> one -> none.

Play Album: klik album -> set queue dengan track album itu, urut, mainkan pertama.

Acak Kategori: dua tombol khusus "Acak Indonesia" / "Acak Asing". Bisa di sidebar.

Playlist: klik playlist di panel, fetch track-nya dan set queue.

Add to Playlist: tombol "+" pada tiap track, muncul dropdown playlist milik user, pilih salah satu untuk menambah.

Media Session API: kontrol notifikasi dan lock screen.

Progress Bar dengan requestAnimationFrame.

Auto-next saat track berakhir, perhatikan repeat mode.

Semua state disimpan di objek global.

UI/UX & Dark Theme Native Responsif
Kita akan merancang tampilan dengan CSS murni, menggunakan Flexbox dan Grid, dengan mobile-first approach.

Layout Player
Mobile (max-width 767px):

Sidebar disembunyikan di kiri dengan transform, bisa dibuka dengan tombol hamburger ☰.

Daftar lagu full width.

Player bar di bawah tetap.

Desktop (min-width 768px):

Sidebar di kiri (220px) selalu tampil.

Konten utama di kanan.

Player bar di bawah full.

Komponen Visual
Background hitam pekat #000 atau #0a0a0a.

Teks putih #fff, abu-abu #ccc untuk sekunder.

Aksen hijau #1db954 untuk tombol play/aktif.

Border subtle #222 atau #333.

Font system-ui agar cepat dimuat.

Icon menggunakan emoji (▶️, ⏸, ⏮, ⏭, 🔀, 🔁, ➕, dll) untuk mengurangi request gambar.

Tombol besar (min. 44x44px) dengan border-radius 12px.

Input range (progress bar) dengan aksen hijau.

Scroll halus dengan -webkit-overflow-scrolling: touch.

CSS Utama (player.css)
Kode lengkap akan diberikan di lampiran.

Responsivitas Admin
Navbar horizontal bisa discroll horizontal di mobile.

Tabel dibungkus div overflow-x auto.

Form full width di mobile, max-width 500px di desktop.

Playlist Pribadi User
Membuat Playlist
User bisa klik tombol "Buat Playlist" di sidebar atau popup, masukkan nama, kirim POST /playlist via fetch.

Menambah Lagu ke Playlist
Di setiap item daftar lagu, ada tombol "+". Saat diklik, muncul dropdown berisi playlist user (diambil dari state yang sudah di-load di halaman). Pilih playlist -> POST /playlist/{id}/add-track dengan track_id.

Memutar Playlist
Klik nama playlist di sidebar, fetch tracknya via GET /playlist/{id}/tracks, set queue dengan track tersebut.

Hapus Lagu dari Playlist
Opsi di dalam halaman playlist (bisa di-popup atau panel khusus) dengan tombol hapus.

Semua interaksi playlist menggunakan JavaScript fetch API, UI diperbarui tanpa reload.

Keamanan & Performa
File Musik Terlindungi: Disimpan di storage/app/private/, hanya bisa diakses via controller yang terotentikasi.

Validasi Upload: Ekstensi dan MIME dicek, ukuran dibatasi.

Rate Limiting: Opsional, bisa dipasang di route streaming untuk mencegah abuse.

SQL Injection: Tidak ada query mentah, semua pakai Eloquent.

XSS: Blade otomatis escape {{ }}. Data JSON di-encode dengan @json.

CSRF: Laravel menyediakan token, fetch API kita sertakan header.

Performa Streaming: Gunakan response()->file() yang efisien dan mendukung partial content. Pastikan Nginx tidak buffer besar.

Caching: Browser cache file statis (CSS, JS) dengan Cache-Control. File musik juga di-cache.

Optimasi DB: Indeks pada kolom yang sering dicari (category_id, album_id, user_id).

Minify CSS/JS: Karena vanilla dan kecil, tidak perlu build tools. Bisa manual jika perlu.

Deployment & Konfigurasi Server
VPS Setup (Ubuntu 22.04)
Install Nginx, PHP 8.2 dengan ekstensi (mbstring, pdo_mysql, fileinfo, dll), MySQL.

Clone project Laravel, atur .env.

composer install --optimize-autoloader --no-dev

php artisan key:generate

php artisan migrate --force

php artisan storage:link

Set permission storage dan bootstrap/cache.

Konfigurasi Nginx
text
server {
    listen 80;
    server_name konconembang.com;
    root /var/www/konconembang/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location /stream/ {
        # jangan buffer, langsung kirim file
        proxy_buffering off;
        try_files $uri /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
Untuk mendukung range request, tidak perlu setting khusus karena Laravel sudah mengirim header yang tepat.

SSL dengan Certbot
Pasang Let's Encrypt untuk HTTPS, wajib untuk PWA dan kenyamanan.

PWA (Opsional)
File manifest.json dan sw.js di folder public.

Daftarkan service worker di player.js.

Pengujian & Troubleshooting
Cek Streaming
Coba akses langsung URL stream, harus bisa di-download dengan range request (gunakan curl dengan header Range).

Debug Player
Gunakan browser devtools untuk lihat network request, pastikan audio buffer tidak putus-putus. Jika putus, periksa dukungan range.

Responsivitas
Gunakan Chrome DevTools device toolbar, cek di berbagai ukuran. Pastikan tombol tidak terpotong, teks terbaca.

Keamanan
Coba akses /storage/private/music/... harus 404. Akses /stream/1 tanpa login harus redirect ke login.

Admin
Buat user admin via tinker, coba upload lagu, kelola album.

Lampiran: Kode Penting
Migrasi Tracks dengan category_id (final)
php
Schema::create('tracks', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('artist')->nullable();
    $table->foreignId('album_id')->nullable()->constrained()->onDelete('set null');
    $table->foreignId('category_id')->constrained()->onDelete('cascade');
    $table->string('filename');
    $table->string('mime_type')->default('audio/mpeg');
    $table->integer('duration')->default(0);
    $table->timestamps();
});
Model Track
php
class Track extends Model
{
    protected $fillable = ['title', 'artist', 'album_id', 'category_id', 'filename', 'mime_type', 'duration'];

    public function album() { return $this->belongsTo(Album::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function playlists() { return $this->belongsToMany(Playlist::class, 'playlist_track')->withPivot('order'); }
}
CategoryController (ringkas)
php
public function index() {
    $categories = Category::withCount('tracks')->get();
    return view('admin.categories.index', compact('categories'));
}
public function store(Request $request) {
    $request->validate(['name' => 'required|string|max:100|unique:categories']);
    Category::create($request->all());
    return back()->with('success', 'Kategori ditambahkan.');
}
// update, destroy...
AlbumController
Mirip, dengan tambahan upload cover.

View player.blade.php (struktur utama)
blade
@extends('layouts.app')
@section('content')
<button id="menu-toggle">☰</button>
<div id="app">
    <aside id="sidebar">
        <h3>Kategori</h3>
        <ul id="category-list">
            <li data-category="all">Semua</li>
            @foreach($categories as $cat)
                <li data-category="{{ $cat->id }}">{{ $cat->name }}</li>
            @endforeach
            <li><button id="shuffle-indo">Acak Indonesia</button></li>
            <li><button id="shuffle-asing">Acak Asing</button></li>
        </ul>
        <hr>
        <h3>Album</h3>
        <ul id="album-list"></ul>
        <hr>
        <h3>Playlist Anda</h3>
        <ul id="user-playlists">
            @foreach($playlists as $pl)
                <li data-playlist-id="{{ $pl->id }}">{{ $pl->name }}</li>
            @endforeach
            <li><button id="new-playlist-btn">+ Buat Baru</button></li>
        </ul>
    </aside>
    <main id="main-content">
        <div id="track-list-container">
            <ul id="track-list"></ul>
        </div>
    </main>
</div>
<footer id="player-bar">
    <span id="now-playing">Pilih lagu</span>
    <audio id="audio" preload="metadata"></audio>
    <div id="controls">
        <button id="shuffle-btn">🔀</button>
        <button id="prev">⏮</button>
        <button id="play">▶️</button>
        <button id="next">⏭</button>
        <button id="repeat-btn">🔁</button>
    </div>
    <input type="range" id="progress" value="0" max="100">
    <small id="time-display">0:00 / 0:00</small>
</footer>
@endsection
JavaScript player.js (struktur state & fungsi utama)
js
const audio = document.getElementById('audio');
const playBtn = document.getElementById('play');
const nowPlaying = document.getElementById('now-playing');
const progress = document.getElementById('progress');
const timeDisplay = document.getElementById('time-display');
const trackListEl = document.getElementById('track-list');
const albumListEl = document.getElementById('album-list');
const categoryListItems = document.querySelectorAll('#category-list li[data-category]');

// State
const state = {
    queue: [],
    currentIndex: -1,
    repeatMode: 'none', // none, all, one
    shuffle: false,
    originalQueue: [],
    currentCategoryId: null,
    currentAlbumId: null,
    currentPlaylistId: null,
    tracksData: window.tracksData, // dari backend
    userPlaylists: window.userPlaylists
};

// Render album berdasarkan kategori
function renderAlbums(categoryId) { ... }

// Set queue dari album
function playAlbum(albumId) { ... }

// Shuffle
function toggleShuffle() { ... }

// Repeat
function cycleRepeat() { ... }

// Load track by index
function loadTrack(index) { ... }

// Event listeners
playBtn.addEventListener('click', () => { ... });
document.getElementById('prev').addEventListener('click', () => { ... });
document.getElementById('next').addEventListener('click', () => { ... });
document.getElementById('shuffle-btn').addEventListener('click', toggleShuffle);
document.getElementById('repeat-btn').addEventListener('click', cycleRepeat);
progress.addEventListener('input', () => { ... });

// Media Session
if ('mediaSession' in navigator) { ... }
Kode lengkap bisa terlalu panjang di sini, tapi blueprint ini sudah mencakup semua konsep.

CSS player.css (potongan responsif)
css
/* Mobile first */
#app { display: flex; flex-direction: column; }
#sidebar {
    position: fixed; top: 0; left: 0; width: 260px; height: 100%;
    background: #0a0a0a; transform: translateX(-100%); transition: transform 0.2s;
    z-index: 100; overflow-y: auto;
}
#sidebar.open { transform: translateX(0); }
#menu-toggle { position: fixed; top: 10px; left: 10px; z-index: 110; }
#main-content { flex: 1; padding: 16px; }
#player-bar {
    position: fixed; bottom: 0; left: 0; right: 0; background: #111;
    display: flex; align-items: center; padding: 10px; flex-wrap: wrap;
}

@media (min-width: 768px) {
    #app { flex-direction: row; }
    #sidebar {
        position: static; transform: none; width: 240px; height: calc(100vh - 70px);
    }
    #menu-toggle { display: none; }
    #player-bar { position: static; }