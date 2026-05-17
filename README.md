<img src="https://capsule-render.vercel.app/api?type=waving&color=4F46E5&height=200&section=header" width="100%"/>
<div align="center">

# 🎵 KONCONEMBANG
**Platform Streaming Musik Campursari, Pop Jawa & Pop Indonesia Modern Berkinerja Tinggi**

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![Styling](https://img.shields.io/badge/Styling-Premium_CSS_Stack-4F46E5?style=for-the-badge)](/)
[![Theme](https://img.shields.io/badge/Theme-Dwi_Warna-6366F1?style=for-the-badge)](#)
[![Status](https://img.shields.io/badge/Status-Production_Ready-success?style=for-the-badge)](#)

*KoncoNembang adalah portal streaming musik modern yang melestarikan seni Campursari dan Pop Jawa dalam kemasan teknologi terkini. Menyajikan alur streaming audio instan bebas iklan, manajemen playlist kustom tanpa batasan, dasbor administrator terpadu, serta sistem tema dwi-warna (Light/Dark Mode) berskala penuh dengan optimalisasi anti-flash.*

</div>

---

## 📖 Tentang Proyek

**KoncoNembang** lahir sebagai solusi digitalisasi kebudayaan musik nusantara, khususnya genre Campursari, Pop Jawa, dan musik pop nasional terpopuler. Aplikasi ini merombak pengalaman usang mendengarkan musik daerah menjadi platform berskala modern yang terarah. 

Mengusung prinsip keindahan antarmuka bernilai tinggi dan minimalis, KoncoNembang berfokus pada empat pilar interaksi utama:
1. **Landing Page Publik SaaS High-Fidelity**: Gerbang awal pengenalan platform yang spektakuler, dilengkapi simulasi mockup player vinyl dinamis, bento grid features, dan live badge darurat yang memikat calon pengguna.
2. **Pemutar Musik Compact di Tengah (Centered Music Player)**: Antarmuka pemutar musik utama yang matematis berada tepat di tengah layar baik perangkat desktop maupun gawai seluler terkecil.
3. **Manajemen Playlist Kustom Mandiri**: Kebebasan warga/pengguna membuat, mengelola, dan mengurasi koleksi lagu favorit secara instan tanpa auto-play paksa, melainkan menggunakan render trek manual demi kontrol navigasi yang natural.
4. **Sistem Dwi-Tema Diri (Adaptive Light & Dark Mode)**: Fleksibilitas visual dengan opsi beralih tema instan yang menyimpan preferensi pengguna secara permanen (`localStorage`), dengan warna mode malam berbasis *Deep Slate & High-End Navy (#0b0f19 & #131b2e)* yang ramah di mata.

---

## 🎨 Identitas Visual & Filosofi Logo

<div align="center">
  <img src="public/image/Logo-KoncoNembang.png" alt="Logo KoncoNembang" width="180"/>
</div>

<br>

Logo resmi **KoncoNembang** dirancang untuk mencerminkan sinergi harmonis antara tradisi musik nusantara dan masa depan digital. Berikut adalah makna mendalam dari elemen visual identitas ini:

### 1. Analisis Visual & Bentuk Geometris
- **Lingkaran Sempurna (Piringan Hitam/Vinyl)**: Logo ini digambarkan melalui lingkaran cakram padat yang melambangkan **piringan hitam musik klasik (vinyl)** serta gelombang suara konseptual. Secara filosofis, lingkaran mewakili keutuhan, kebersamaan (*konco*), dan siklus alunan nada yang tak pernah berakhir (*nembang*).
- **Elemen Sinergi Pusat**: Bagian inti logo melambangkan titik pusat poros piringan yang menyeimbangkan arah jarum pemutar, merepresentasikan stabilitas platform dalam melayani ribuan aliran audio berkualitas tinggi.

### 2. Filosofi Warna & Versatilitas Latar Belakang
Logo KoncoNembang didesain menggunakan skema warna **Indigo Premium & Royal Cobalt**, memberikan fleksibilitas adaptasi visual tingkat tinggi:
- **Indigo Utama (`#4f46e5`)**:
  - **Kreativitas & Harmoni**: Mewakili kemegahan nada, rasa seni yang mendalam, serta harmoni musik tradisi Campursari yang dikemas modern.
  - **Inovasi Teknologi**: Menandakan platform dibangun di atas standar pengembangan teknologi web modern berkinerja tinggi.
- **Universal Background Versatility**:
  - **Di Atas Latar Terang (*Light Mode*)**: Memancarkan kontras biru indigo yang tajam, profesional, bersih, dan memikat mata.
  - **Di Atas Latar Gelap (*Dark Mode*)**: Menyala bersinar dengan keanggunan eksklusif di atas warna latar *Deep Navy Slate*, memperkuat kesan mewah dan premium.

---

## ✨ Fitur & Modul Utama

### 🏠 1. Landing Page Publik Interaktif (Guest Portal)
- **Hero Section Premium**: Judul dengan gradasi warna memukau, ajakan bertindak (CTA) interaktif, dan simulasi browser mockup player.
- **Mockup Player Vinyl Animasi**: Piringan vinyl berputar secara dinamis (`animation: spin-vinyl`), timeline lagu interaktif, dan kontrol fiktif untuk demo visual.
- **Bento Grid Highlights**: Informasi fitur unggulan terkemas dalam kartu grid modern yang memantul anggun saat di-*hover*.
- **Pintu Otomatisasi Rute**: Mengarahkan otomatis pengguna yang sudah login ke panel pemutar `/player` (atau `/admin` jika administrator) demi memangkas durasi pemuatan.

### 🎵 2. Dasbor Pengguna (Pemutar Musik & Playlist Kustom)
- **Compact & Centered Player**: Pemutar musik bawah ramping setinggi `10px padding` dengan kendali volume, trek baris tipis `3px`, dan tombol navigasi pegas (`cubic-bezier scale`) yang presisi di tengah layar desktop maupun HP.
- **Kategori & Album Terarah**: Pengelompokan lagu berdasarkan kategori Campursari/Pop dan Album terkait secara dinamis.
- **Manajemen Playlist Saya**: Membuat playlist kustom instan. Klik playlist tidak memicu putar paksa (anti auto-play), melainkan merender daftar lagu di bagian tengah agar pengguna dapat memilih secara manual.
- **Sidebar Auto-Close Mobile**: Laci navigasi samping akan menutup secara otomatis begitu kategori, album, atau menu diklik di perangkat HP agar layar utama langsung terlihat longgar.
- **Edit Profil Akun**: Panel pengeditan informasi profil pengguna yang aman, responsif, dan menyatu harmonis dalam sistem tema dwi-warna.

### 🛡️ 3. Dasbor Administrator (Pusat Kendali Konten)
- **Manajemen Lagu Terpadu**: Unggah berkas audio (.mp3), tentukan judul, artis, lirik, kategori, dan album pengiring.
- **Manajemen Album & Kategori**: Kendali penuh pembuatan album baru dan kategori lagu baru dengan visual yang teratur.
- **Kelola User**: Pemantauan basis data pengguna terdaftar dan hak akses admin.
- **Nama Brand Persisten**: Nama brand "KoncoNembang" bersanding kokoh di samping logo di bagian atas sidebar admin.

### 🌓 4. Sistem Tema Dwi-Warna (Light & Dark Mode)
- **Aksi Switch Tunggal & Rapi**: Satu tombol switch dinamis yang disematkan di lokasi strategis:
  - Di *Navbar Actions* pada Landing Page Publik.
  - Di *Sidebar Bottom* (di atas tombol Log Out) pada Panel Player dan Panel Admin.
- **Teknologi Bebas Kedipan (Anti-Flash)**: Skrip deteksi dini `localStorage` disuntik langsung di `<head>` dan `<body>` paling awal untuk memastikan layar langsung termuat gelap saat mode malam aktif.
- **Warna Mode Malam Premium**: Menggunakan palet *Deep Blue Slate* (`#0b0f19` & `#131b2e`) yang menenangkan mata saat mendengarkan musik di ruang gelap.

### 🔐 5. Panel Autentikasi yang Selaras
- **Desain Sinkron**: Halaman login dan register (`layouts/guest.blade.php`) secara otomatis mendeteksi tema peramban pengguna dan menyesuaikan diri ke mode terang/gelap.
- **Branding Sempurna**: Teks logo "KoncoNembang" tersemat rapi secara vertikal di bawah gambar logo utama dengan transisi hover pegas.

---

## 🔐 Kredensial Demo Master

KoncoNembang membedakan hak akses masuk berdasarkan atribut `is_admin` di basis data. Gunakan akun demo di bawah untuk menguji coba di lingkungan lokal Anda:

| Peran Akun | Alamat Surel (Email) | Kata Sandi (Password) | Kapabilitas Dasbor |
| :--- | :---: | :---: | :--- |
| **Administrator Utama** | `admin@konconembang.com` | `password` | Kendali penuh unggah lagu, kelola kategori/album, manajemen user, dan ubah tema |
| **Pengguna Umum (Warga)** | *(Silakan daftar akun baru)* | *(Kustom)* | Pemutaran lagu, pembuatan playlist pribadi, edit profil, dan ubah tema |

---

## 📱 Keunggulan UX: Responsivitas Total

KoncoNembang dirancang dengan komitmen kegunaan (*usability*) 100% tanpa kompromi di perangkat mobile:
- **Centered Player Bar Mobile**: Bilah pemutar bawah ditransformasikan secara vertikal di HP, memusatkan nama lagu, progress bar, dan tombol kontrol pegas tepat di pusat jangkauan ibu jari.
- **Auto-Dismiss Sidebar**: Sidebar menu mobile otomatis meluncur menutup begitu pengguna menyentuh kategori atau playlist, meniadakan langkah penutupan manual yang menjengkelkan.
- **Z-Index Safeguard**: Pengamanan tumpukan layar mencegah bar pemutar menimpa tombol klik kritis di menu bawah atau modal.

---

## 🚀 Panduan Instalasi Lokal

Ikuti langkah-langkah di bawah untuk memasang dan menjalankan KoncoNembang pada lingkungan pengembangan lokal Anda:

### 1. Kloning Repositori
```bash
git clone https://github.com/hiu-kencana-widhi/KoncoNembang.git
cd KoncoNembang
```

### 2. Instalasi Dependensi PHP & JS
Pastikan peladen Anda menjalankan PHP versi 8.1 atau yang lebih baru dan Composer telah terpasang.
```bash
composer install
npm install
```

### 3. Persiapan Konfigurasi Lingkungan
```bash
cp .env.example .env
php artisan key:generate
```
Buka berkas `.env` dan sesuaikan parameter koneksi basis data (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) dengan kredensial MySQL lokal Anda.

### 4. Migrasi Skema & Penanaman Seeder Master
Perintah ini akan membangun fisik tabel dari awal dan menanamkan akun administrator demo:
```bash
php artisan migrate:fresh --seed
```

### 5. Hubungkan Link Penyimpanan Media (Storage)
Guna memastikan musik (.mp3) dan gambar sampul album dapat diakses secara publik oleh pemutar:
```bash
php artisan storage:link
```

### 6. Bersihkan Cache & Jalankan Server Lokal
```bash
php artisan optimize:clear
php artisan serve
```
Akses portal melalui tautan `http://localhost:8000` di peramban gawai atau PC Anda.

---

## 🔄 Diagram Alur Kerja (System Workflows)

Berikut adalah visualisasi alur operasional utama platform **KoncoNembang**:

### A. Alur Navigasi & Landing Page Publik (*Smart Routing*)
```
[ Pengunjung Umum / Tamu ]
            │
            ▼
    [ Landing Page / ] ────► Tinjau Fitur & Musik Demo
            │
            ├─► (Belum Login) ──► Klik "Masuk" ──► Render Form Login
            │
            └─► (Sudah Login) ──► Otomatis Pengalihan Rute (Redirect)
                                             │
                                ┌────────────┴────────────┐
                                ▼                         ▼
                        [ User / Warga ]           [ Administrator ]
                        Redirect to `/player`      Redirect to `/admin`
```

### B. Alur Manajemen & Putar Lagu Playlist Pribadi (*Player Control*)
```
[ User: Dasbor Player ] ──► [ Klik "+ Buat Playlist" ] ──► [ Beri Nama Playlist ]
                                                                     │
                                                                     ▼
                                                         [ Tambah Lagu Ke Playlist ]
                                                                     │
                                                                     ▼
                                                         [ Klik Playlist di Sidebar ]
                                                                     │
                                                        (Anti Auto-Play Safeguard)
                                                                     │
                                                                     ▼
                                                         [ Render Daftar Trek Tengah ]
                                                                     │
                                                                     ▼
                                                         [ User Klik Lagu Manual ]
                                                                     │
                                                                     ▼
                                                         [ Audio Mulai Mengalir ]
```

### C. Alur Pengunggahan & Distribusi Musik (*Admin Curation*)
```
[ Admin: Dasbor Manajemen Lagu ] ──► [ Unggah File .mp3, Sampul, Judul, Kategori & Album ]
                                                               │
                                                               ▼
                                                  [ Validasi File & Ukuran ]
                                                               │
                                                               ▼
                                                  [ Penyimpanan Direktori Storage ]
                                                               │
                                                               ▼
                                                   [ Otomatis Tayang Publik ]
                                            (Tersedia di Pilihan Kategori Player Warga)
```

### D. Alur Pergantian & Persistensi Tema (*Theme Switcher Flow*)
```
[ Pengguna klik "Ubah Tema" ] 
               │
               ▼
   [ Periksa Class 'dark-mode' ]
               │
        ┌──────┴──────────────────────────┐
        ▼ (Aktif)                         ▼ (Tidak Aktif)
 [ Hapus 'dark-mode' ]             [ Tambah 'dark-mode' ]
 [ Set localStorage = 'light' ]    [ Set localStorage = 'dark' ]
        │                                 │
        └─────────────────┬───────────────┘
                          ▼
             [ Transisi CSS Berjalan ]
     (Warna latar & teks berubah seketika)
```

---

<br>

<div align="center">

## 📸 GALERI ANTARMUKA & CUPLIKAN LAYAR
Dokumentasi visual keindahan antarmuka pemutar musik daerah modern KoncoNembang.

</div>

<br>

### 🖥️ Cuplikan Antarmuka Halaman Utama & Pemutar
*Visualisasi Landing Page premium, dasbor pemutar musik presisi tengah, dan panel kontrol admin terpadu.*

#### 1. Landing Page Publik Modern (Mode Terang)
![Landing Page Light](public/image/readme/public/landing_light.png)

#### 2. Landing Page Publik Modern (Mode Gelap)
![Landing Page Dark](public/image/readme/public/landing_dark.png)

#### 3. Dasbor Player Utama Centered (Mode Gelap)
![Player Dark](public/image/readme/player/player_dark.png)

#### 4. Dasbor Player Utama Centered (Mode Terang)
![Player Light](public/image/readme/player/player_light.png)

#### 5. Dasbor Manajemen Admin (Manajemen Lagu & Kategori)
![Admin Dashboard](public/image/readme/admin/dashboard.png)

---

<div align="center">
<br>

**Didedikasikan untuk menjaga kelestarian musik tradisional Campursari dan Pop Jawa melalui standar kegunaan teknologi tinggi.**  
© Hak Cipta Platform Streaming Musik **KoncoNembang**.

</div>

<img src="https://capsule-render.vercel.app/api?type=waving&color=4F46E5&height=200&section=footer" width="100%"/>
