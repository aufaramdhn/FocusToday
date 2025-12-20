# FocusToday 📰

**FocusToday** adalah website berita dan artikel yang menyajikan informasi **terkini, cepat, dan terpercaya** dari berbagai kategori seperti politik, olahraga, teknologi, ekonomi, dan hiburan.

Website ini bertujuan memberikan pengalaman membaca berita yang **fokus, mudah diakses**, serta didukung oleh tampilan **modern dan responsif** agar nyaman digunakan di berbagai perangkat.

---

## 🎯 Tujuan Website
- Menyediakan berita dan artikel yang up-to-date
- Mengelompokkan konten ke dalam kategori yang jelas
- Memberikan tampilan yang sederhana, cepat, dan responsif
- Memudahkan pengguna dalam mengakses informasi penting

---

## 🗂️ Kategori Konten
- SOON

---

## 🛠️ Tech Stack

### Backend
- **Laravel** Framework PHP untuk pengelolaan backend, routing, database.

### Frontend
- **Tailwind CSS** Digunakan untuk membangun tampilan yang modern dan responsif.
- **Alpine.js** Digunakan jika diperlukan untuk interaksi frontend yang ringan dan reaktif.

---

## 💻 Panduan Instalasi (Installation Guide)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di local computer kamu.

### 1. Persiapan & Clone Repository
- Buka folder tujuan di mana saja (misal: di Desktop).
- Buka Terminal atau Git Bash di folder tersebut.
- Salin link repository, lalu ketik perintah clone di terminal:
  ```bash
  git clone [https://github.com/aufaramdhn/FocusToday.git](https://github.com/aufaramdhn/FocusToday.git)
  ```
- Jika sudah selesai, buka folder project tersebut di **VS Code**.

### 2. Install Dependencies & Setup Environment
Buka terminal di dalam project VS Code kalian, lalu jalankan perintah berikut satu per satu:

- Install library yang dibutuhkan:
  ```bash
  npm install
  composer install
  ```
- Build asset frontend:
  ```bash
  npm run build
  ```
- Setup file environment:
  ```bash
  copy .env.example .env
  ```
    (Catatan: Sesuaikan perintah copy jika menggunakan OS berbeda, intinya duplikat file .env.example dan ubah namanya jadi .env)
- Generate Application Key:
  ```bash
  php artisan key:generate
  ```
### 3. Setup Database (SQLite)
- Cek di dalam folder `database`, pastikan ada file bernama `database.sqlite`.
- **Penting:** Jika belum ada, buat file baru kosong dengan nama `database.sqlite` di dalam folder `database` tersebut.
- Setelah file ada, jalankan migrasi:
  ```bash
  php artisan migrate:fresh
  ```
### 4. Menjalankan Project
Kamu bisa menjalankan project menggunakan salah satu cara di bawah ini:

**Opsi 1: Menggunakan Script Composer (Jika tersedia)**
  ```bash
  composer run dev
  ```
**Opsi 2: Manual (Terminal Terpisah)**
Jalanin perintah ini di dua terminal berbeda di VS Code:

- Terminal 1 (Backend):
  ```bash
  php artisan serve
  ```
- Terminal 2 (Frontend):
  ```bash
  npm run dev
  ```
**Catatan:** Jika menggunakan Laravel Herd, cukup jalankan `npm run dev` untuk frontend-nya.

---

## 👥 Tim & Role
| Nama   | Role               |
|--------|--------------------|
| Aufa   | Project Manager (PM)|
| Ariska | Frontend Developer |
| Fauzi  | Frontend Developer |
| Galang | Backend Developer  |

---

## 📌 Catatan Pengembangan
- Proyek ini dikembangkan secara tim dengan pembagian tugas yang jelas
- Menggunakan Git & GitHub untuk version control
- Pengembangan fitur dilakukan melalui branch terpisah (`feat/*`, `style/*`)
- Branch `dev` digunakan sebagai branch utama pengembangan

---

## 📄 Lisensi
Proyek ini dikembangkan untuk keperluan pembelajaran dan pengembangan akademik tugas besar praktikum web.
