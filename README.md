<div align="center">

  <h1>FocusToday 📰</h1>
  <p><strong>Portal Berita Digital: Terkini, Cepat, & Terpercaya</strong></p>

  <p>
    <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel"></a>
    <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css" alt="Tailwind"></a>
    <a href="https://alpinejs.dev"><img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js" alt="Alpine"></a>
    <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php" alt="PHP"></a>
  </p>

  <p>
    <a href="#-fitur-unggulan">Fitur</a> •
    <a href="#-tech-stack">Tech Stack</a> •
    <a href="#-instalasi-lokal">Instalasi</a> •
    <a href="#-tim-pengembang-cybernauts">Tim</a>
  </p>

</div>

---

## 📖 Tentang Project

**FocusToday** adalah platform portal berita modern yang dirancang untuk memberikan pengalaman membaca yang fokus dan bebas gangguan. Terinspirasi oleh desain minimalis *Quartz (qz.com)* dan fungsionalitas multimedia *Narasi TV*, website ini menyajikan informasi dari berbagai kategori seperti Politik, Teknologi, Olahraga, dan Hiburan dengan antarmuka yang responsif.

Project ini dikembangkan sebagai **Tugas Besar Praktikum Pemrograman Web 2025** oleh kelompok **Cybernauts**, dengan fokus pada implementasi fitur *backend* yang robust dan *frontend* yang interaktif.

---

## 🚀 Fitur Unggulan

### 🔐 Autentikasi & Keamanan Lanjutan
- **Google OAuth Integration**: Login dan Register instan menggunakan akun Google.
- **Secure Email Verification**: Sistem verifikasi email dengan halaman *Custom Success View* yang interaktif.
- **Role-Based Access Control**: Pemisahan hak akses antara User dan Admin.
- **Password Management**: Fitur Lupa Password dan Ubah Password.

### 📝 Manajemen Konten & Interaksi
- **Artikel CRUD**: Pembuatan artikel dengan dukungan *Rich Text* dan *Thumbnail*.
- **Live Search**: Pencarian berita real-time tanpa reload halaman.
- **Interactive Comments**: Sistem komentar dengan validasi kepemilikan (User bisa edit/hapus komentarnya sendiri, Admin bisa moderasi semua).
- **Advanced Filtering**: Filter berita berdasarkan Kategori, Tag, Rentang Tanggal, dan Penulis.

### 📊 Administrasi & Pelaporan
- **Dashboard Admin**: Ringkasan statistik (Total User, Artikel, View, Komentar).
- **PDF Reporting**: Ekspor data laporan pengguna ke format PDF.
- **User Management**: Fitur *Banned/Unbanned* pengguna yang melanggar aturan.
- **Maintenance Mode**: Halaman maintenance khusus dengan akses *bypass* untuk developer.

---

## 🛠 Tech Stack

| Komponen | Teknologi | Deskripsi |
| :--- | :--- | :--- |
| **Backend** | Laravel 12 | Framework utama untuk routing, logic, dan keamanan. |
| **Frontend** | Blade & Tailwind CSS | Templating engine dengan styling utility-first. |
| **Interactivity** | Alpine.js | Micro-framework untuk interaksi UI (Dropdown, Modal). |
| **Database** | MySQL / SQLite | Penyimpanan data relasional. |
| **Asset Build** | Vite | Build tool untuk kompilasi aset frontend yang cepat. |

---

## 💻 Instalasi Lokal

Ikuti langkah berikut untuk menjalankan proyek di komputer lokal:

### 1. Clone Repository
```
git clone https://github.com/aufaramdhn/FocusToday.git
```
Lalu: 
```
cd FocusToday
```

### 2. Install Depedencies

Install paket PHP
```
composer install
```
Install paket Node.js (Frontend)
```
npm install
```

### 3. Konfigurasi Environment

Duplikat file .env.example menjadi .env:
```
cp .env.example .env
```
Or
```
copy .env.example .env
```
Setup OAuth untuk google login:
```evn
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URL=[http://127.0.0.1:8000/auth/google/callback](http://127.0.0.1:8000/auth/google/callback)
```
Konfigurasi Email (Resend)
Agar fitur Verifikasi Email & Lupa Password berjalan, daftar di [Resend.com](https://resend.com), lalu tambahkan API Key ke file `.env`:
```env
MAIL_MAILER=resend
RESEND_API_KEY=re_123456789_your_api_key
MAIL_FROM_ADDRESS="onboarding@resend.dev"
MAIL_FROM_NAME="${APP_NAME}"
```
- #### **Tambahan untuk README.txt (Plain Text)**
Sisipkan ini di bawah bagian konfigurasi Google Login:

```text
KONFIGURASI EMAIL (RESEND)
Daftar akun di https://resend.com, lalu tambahkan konfigurasi ini di file .env:
```
```env
MAIL_MAILER=resend
RESEND_API_KEY=isi_api_key_resend_anda
MAIL_FROM_ADDRESS="onboarding@resend.dev"
MAIL_FROM_NAME="${APP_NAME}"
```
```
Catatan: Gunakan "onboarding@resend.dev" jika Anda belum memverifikasi domain sendiri.
```

- #### Penting untuk diingat (Tips Teknis):
Install Package: Pastikan tim kamu sudah menjalankan perintah ini (biasanya sudah ada di composer.json, tapi untuk jaga-jaga):
```
composer require resend/resend-laravel
```
- #### Publish Config: 
Jika perlu kustomisasi, jalankan:
```
php artisan vendor:publish --tag=resend-config
```
- #### konfigurasi lainnya 

YOUTUBE DATA API
```env
YOUTUBE_API_KEY=isi_api_key_youtube_kamu
YOUTUBE_CHANNEL_ID_MALAKA=UCxxxxxx  <-- Isi ID Channel Malaka Project
YOUTUBE_CHANNEL_ID_NARASI=UCxxxxxx  <-- Isi ID Channel Narasi
```

### 4. Setup Database & Key

Generate App Key
```
php artisan key:generate
```
Migrasi Database (Pastikan file database.sqlite sudah ada jika pakai SQLite)
```
php artisan migrate:fresh --seed
```

### 5. Jalankan Aplikasi

Buka dua terminal terpisah:
- #### Terminal 1: Menjalankan Server Laravel
```
php artisan serve
```
- #### Terminal 2: Menjalankan Vite (Hot Reload)
```
npm run dev
```
Akses website di: http://127.0.0.1:8000

---

## 👥 Tim Pengembang (Cybernauts)
|NPM      | Nama                  | Role               | Github Profile |
|---------|-----------------------|--------------------|----------------|
|233040028| Aufa Ramadhan         | Project Manager    |<a href="https://github.com/aufaramdhn">Link</a>|
|233040041| Ariska Putri          | Frontend Developer |<a href="https://github.com/AriskaPutri04">Link</a>|
|233040019| Fauzi  Ahmad Ramdani  | Frontend Developer |<a href="https://github.com/Zayyzz">Link</a>|
|233040024| Dhaffa Galang Fahriza | Backend Developer  |<a href="https://github.com/GalangDhaffa">Link</a>|

---

## 📌 Catatan Pengembangan
- Proyek ini dikembangkan secara tim dengan pembagian tugas yang jelas
- Menggunakan Git & GitHub untuk version control
- Pengembangan fitur dilakukan melalui branch terpisah (`feat/*`, `style/*`)
- Branch `dev` digunakan sebagai branch utama pengembangan

---

## 📄 Lisensi
Proyek ini dikembangkan untuk keperluan pembelajaran dan pengembangan akademik tugas besar praktikum web.
