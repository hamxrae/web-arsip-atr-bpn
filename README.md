# 📚 Web Arsip ATR/BPN

**Sistem Manajemen Arsip Digital untuk Badan Pertanahan Nasional**

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-0052CC?style=flat&logo=mysql)](https://www.mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=flat&logo=bootstrap)](https://getbootstrap.com)

---

## 🎯 Tentang Aplikasi

Aplikasi web untuk mengelola arsip **Buku Tanah** dan **Surat Ukur** secara digital, meliputi:
- ✅ **CRUD Buku Tanah** - Pendataan kepemilikan tanah
- ✅ **CRUD Surat Ukur** - Manajemen dokumen pengukuran
- ✅ **CRUD Peminjam** - Pencatatan peminjaman dengan foto
- ✅ **CRUD Pengembalian** - Pencatatan pengembalian arsip
- ✅ **Dashboard Admin** - Interface intuitif dengan Bootstrap 5

---

## 🚀 Quick Start

### 1️⃣ Clone & Setup
```bash
cd c:\xampp\htdocs\tugas_ukk_ilham
git clone <repository-url> web-arsip-atr-bpn
cd web-arsip-atr-bpn

# Copy environment file
copy .env.example .env

# Generate encryption key
php artisan key:generate
```

### 2️⃣ Install Dependencies
```bash
composer install
npm install
```

### 3️⃣ Setup Database
Edit `.env`:
```env
DB_DATABASE=web_arsip_atr_bpn
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi:
```bash
php artisan migrate --seed
php artisan storage:link
```

### 3️⃣ Run Development Server
**Terminal 1:**
```bash
php artisan serve
# http://127.0.0.1:8000
```

**Terminal 2:**
```bash
npm run dev
```

### 4️⃣ Login
- 📧 **Email**: admin@example.com
- 🔐 **Password**: 12345678

---

## 📋 Fitur Utama

### Buku Tanah 📖
- Tambah, edit, hapus data buku tanah
- Kelola status berkas (Diterima/Ditolak/Proses)
- Link ke surat ukur

### Surat Ukur 📄
- CRUD surat ukur
- Relasi dengan buku tanah (dropdown)
- Data ukuran, nomor, dan tahun surat

### Peminjam 🤝
- Catat peminjam dengan nama, no HP, email
- **Upload foto peminjam** (tanpa batasan file type/size)
- Pilih surat ukur dari dropdown
- Validasi no HP: `0xxxxxxx` atau `+62xxxxxxx` ✅

### Pengembalian ✋
- Catat pengembalian dengan tanggal/waktu
- Link ke buku tanah asli
- Validasi format datetime

---

## 📦 Requirements

- PHP 8.1+ (tested: 8.2.12)
- MySQL 5.7+ / MariaDB 10.2+
- Composer 2.0+
- Node.js 14+
- RAM 2GB, Disk 500MB

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Backend** | Laravel 10 (PHP 8.1+) |
| **Frontend** | Blade, Bootstrap 5, Vite |
| **Database** | MySQL |
| **ORM** | Eloquent |
| **Auth** | Session-based |
| **Package Manager** | Composer, NPM |

---

## 📊 Database Structure (ERD)

```
USERS (1) ──── (M) PEMINJAM
BUKU_TANAH (1) ──── (M) SURAT_UKUR
SURAT_UKUR (1) ──── (M) PEMINJAM
BUKU_TANAH (1) ──── (M) PENGEMBALIAN
```

**Tabel:**
- `users` - Admin users
- `buku_tanah` - Data kepemilikan tanah
- `surat_ukur` - Dokumen pengukuran
- `peminjam` - Data peminjaman
- `pengembalian` - Pencatatan pengembalian

---

## 👨‍💼 Peran Admin

### Tanggung Jawab:
| Fungsi | Deskripsi |
|--------|-----------|
| **Kelola Buku Tanah** | CRUD data, update status |
| **Kelola Surat Ukur** | CRUD dokumen, link relasi |
| **Kelola Peminjam** | Catat peminjam, upload foto |
| **Kelola Pengembalian** | Catat pengembalian, validasi waktu |
| **Monitoring** | Dashboard real-time |

### Akses:
- ✅ CRUD penuh ke semua modul
- ✅ Tidak ada batasan operasi
- ✅ Dashboard monitoring

---

## 🔗 Main Routes

```
GET    /admin/buku-tanah              # List
GET    /admin/buku-tanah/create       # Create form
POST   /admin/buku-tanah              # Store
GET    /admin/buku-tanah/{id}         # Show
GET    /admin/buku-tanah/{id}/edit    # Edit form
PUT    /admin/buku-tanah/{id}         # Update
DELETE /admin/buku-tanah/{id}         # Delete

# Same pattern for: surat-ukur, peminjam, pengembalian
```

---

## 📁 Project Structure

```
app/Http/Controllers/
  ├── BukuTanahController.php
  ├── SuratUkurController.php
  ├── PeminjamController.php
  └── PengembalianController.php

app/Models/
  ├── User.php
  ├── BukuTanah.php
  ├── SuratUkur.php
  ├── Peminjam.php
  └── Pengembalian.php

resources/views/
  ├── layouts/admin.blade.php
  ├── daftar_surat_ukur/
  ├── peminjam/
  ├── pengembalian/
  └── partials/

storage/app/public/peminjam/  ← Upload folder

routes/web.php                ← Resource routes
```

---

## ✨ Features Highlight

### Peminjam CRUD (Enhanced)
```php
// Validation
- nama_peminjam: required, string, max 255
- no_hp: regex ^(\+62|0)[0-9]{8,12}$
- email: required, email, unique
- surat_ukur_id: required, exists:surat_ukur
- foto: nullable, any file type

// Features
- Safe file upload (sanitized filename)
- Photo delete on update/destroy
- Try-catch error handling
- User-friendly messages
```

### Pengembalian CRUD (Enhanced)
```php
// Validation
- nama: required, string
- buku_tanah_id: required, exists
- no_hp: regex validation
- email: required, email
- waktu_pengembalian: datetime format

// Features
- Dropdown for buku_tanah
- Datetime picker input
- Complete error messages
```

---

## 🐛 Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| **Database error** | Check `.env` DB credentials, ensure MySQL running |
| **Upload not working** | Run `php artisan storage:link` |
| **No APP_KEY** | Run `php artisan key:generate` |
| **Port 8000 in use** | Use `php artisan serve --port=8001` |
| **No_hp validation fails** | Use correct format: `08123456789` or `+6281234567` |

---

## 🧪 Testing Checklist

- [ ] Login/logout works
- [ ] Buku tanah CRUD ✅
- [ ] Surat ukur dropdown works ✅
- [ ] Peminjam CRUD + photo upload ✅
- [ ] Pengembalian CRUD + datetime ✅
- [ ] Alert messages display correctly
- [ ] Responsive on mobile (Bootstrap 5)
- [ ] Storage link working for photos

---

## 📖 Dokumentasi Lengkap

Untuk panduan detail, instalasi step-by-step, UML diagram, dan troubleshooting lanjutan:
👉 **Baca: [`README_LENGKAP.md`](./README_LENGKAP.md)**

---

## 📦 Installation Steps (Detailed)

### Step 1: Clone Repository
```bash
cd c:\xampp\htdocs\tugas_ukk_ilham
git clone <repository-url> web-arsip-atr-bpn
cd web-arsip-atr-bpn
```

### Step 2: Copy Environment
```bash
copy .env.example .env
```

### Step 3: Generate Key
```bash
php artisan key:generate
```

### Step 4: Install Composer
```bash
composer install
```

### Step 5: Install NPM
```bash
npm install
```

### Step 6: Configure Database (.env)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web_arsip_atr_bpn
DB_USERNAME=root
DB_PASSWORD=
```

### Step 7: Run Migrations
```bash
php artisan migrate --seed
```

### Step 8: Create Storage Link
```bash
php artisan storage:link
```

### Step 9: Start Development
**Terminal 1:**
```bash
php artisan serve
```

**Terminal 2:**
```bash
npm run dev
```

### Step 10: Access Application
```
🌐 http://127.0.0.1:8000
📧 admin@example.com
🔐 12345678
```

---

## 🚨 Important Validation Rules

### No HP Format (Peminjam & Pengembalian)
```
✅ VALID:
   - 08123456789 (0 + 8-12 digits)
   - +6281234567 (+62 + 8-12 digits)
   - 089999999999
   - +628999999999

❌ INVALID:
   - 62812345678 (missing +/0)
   - +62 812 345 (has spaces)
   - 123456 (too short)
   - +1 555 (wrong country code)
```

### Email
```
✅ VALID:
   - user@example.com
   - admin@bpn.go.id

❌ INVALID:
   - user@
   - @example.com
   - duplicate email (unique violation)
```

### Photo Upload (Peminjam)
```
✅ ANY FILE TYPE ACCEPTED:
   - .jpg, .png, .gif
   - .pdf, .docx, .xlsx
   - .txt, .zip, etc
   
✅ Features:
   - No file size limit
   - Safe filename sanitization
   - Auto-delete old photo on update
   - Auto-delete on record delete
```

---

## 📞 Support

- 📧 Email: admin@bpn.go.id
- 🐛 Report bugs in Issues
- 💬 Questions in Discussions

---

## 📄 License

MIT License - Gratis untuk pendidikan & non-komersial

---

## 🎓 Credits

**Built with:**
- Laravel 10
- Bootstrap 5
- Vite
- MySQL

**Version:** 2.0.0  
**Last Updated:** December 2025  
**Maintained by:** hamxrae

---

**Selamat menggunakan! 🎉**
