# 📚 Aplikasi Web Arsip ATR/BPN

**Sistem Manajemen Arsip Buku Tanah dan Surat Ukur** berbasis Laravel 10 dengan fitur CRUD lengkap untuk mengelola data peminjaman dan pengembalian arsip.

---

## 📋 Daftar Isi

1. [Tentang Aplikasi](#tentang-aplikasi)
2. [Fitur Utama](#fitur-utama)
3. [Tech Stack](#tech-stack)
4. [Requirements](#requirements)
5. [Instalasi & Setup](#instalasi--setup)
6. [Cara Menggunakan](#cara-menggunakan)
7. [Peran Admin](#peran-admin)
8. [Database Structure (ERD)](#database-structure-erd)
9. [Architecture (UML)](#architecture-uml)
10. [API Routes](#api-routes)
11. [Troubleshooting](#troubleshooting)

---

## 🎯 Tentang Aplikasi

**Web Arsip ATR/BPN** adalah aplikasi web yang dirancang untuk membantu **Badan Pertanahan Nasional (BPN)** mengelola arsip buku tanah dan surat ukur secara digital. Aplikasi ini memudahkan:

- **Pencatatan arsip** buku tanah dan surat ukur
- **Pengelolaan peminjaman** arsip oleh masyarakat/institusi
- **Pencatatan pengembalian** arsip dengan waktu dan identitas peminjam
- **Dashboard real-time** untuk monitoring status arsip

**Tujuan**: Meningkatkan efisiensi pengelolaan arsip dan menjaga keamanan data dokumen penting.

---

## ✨ Fitur Utama

### 1. **Manajemen Buku Tanah** 📖
- ✅ Tambah, edit, hapus data buku tanah
- ✅ Lihat detail dan status berkas
- ✅ Pencarian berdasarkan nomor buku tanah, pemilik, atau lokasi

### 2. **Manajemen Surat Ukur** 📄
- ✅ CRUD surat ukur dengan relasi ke buku tanah
- ✅ Isi data ukuran tanah, nomor surat, tahun
- ✅ Tampilkan surat ukur yang tersedia untuk dipinjam

### 3. **Manajemen Peminjaman** 🤝
- ✅ Catat peminjam dengan nama, no HP, email
- ✅ **Upload foto peminjam** (tanpa batasan file type/size)
- ✅ Pilih surat ukur yang dipinjam
- ✅ Validasi no HP format: `0xxxxxxxxx` atau `+62xxxxxxxxx`
- ✅ Edit dan hapus data peminjaman

### 4. **Manajemen Pengembalian** ✋
- ✅ Catat pengembalian dengan nama, tanggal/waktu, email
- ✅ Link ke buku tanah asli
- ✅ Validasi format tanggal/waktu
- ✅ Edit dan hapus catatan pengembalian

### 5. **Dashboard & Navigasi** 📊
- ✅ Menu admin intuitif dengan sidebar
- ✅ Layout responsive (Bootstrap 5)
- ✅ Alert notifikasi (success, error, warning)
- ✅ Footer dengan informasi BPN

---

## 🛠 Tech Stack

| Komponen | Teknologi |
|----------|-----------|
| **Backend** | Laravel 10 (PHP 8.1+) |
| **Frontend** | Blade Templates, Bootstrap 5, Vite |
| **Database** | MySQL 5.7+ |
| **Server** | Apache/XAMPP |
| **Package Manager** | Composer, NPM |
| **Auth** | Laravel Session-based |

---

## 📦 Requirements

### Minimum System Requirements
- **PHP**: 8.1 atau lebih tinggi (tested dengan PHP 8.2.12)
- **MySQL**: 5.7 atau MariaDB 10.2+
- **Composer**: 2.0+
- **Node.js**: 14+ (untuk frontend dev)
- **RAM**: 2GB
- **Disk Space**: 500MB

### Software yang Dibutuhkan
```
✓ XAMPP / WAMP / LAMP
✓ Git
✓ Composer
✓ Node.js & NPM
```

---

## 🚀 Instalasi & Setup

### Step 1: Clone Repository
```bash
cd c:\xampp\htdocs\tugas_ukk_ilham
git clone <repository-url> web-arsip-atr-bpn
cd web-arsip-atr-bpn
```

### Step 2: Setup Environment File
```bash
# Copy .env.example ke .env
copy .env.example .env

# (Atau manual: salin file .env.example → .env)
```

### Step 3: Generate APP_KEY
```bash
php artisan key:generate
```

### Step 4: Install Composer Dependencies
```bash
composer install
```

### Step 5: Install NPM Dependencies (Frontend Assets)
```bash
npm install
```

### Step 6: Konfigurasi Database (di .env)
Edit file `.env` dan sesuaikan database connection:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web_arsip_atr_bpn      # nama database
DB_USERNAME=root                    # username MySQL
DB_PASSWORD=                        # password (kosong untuk XAMPP default)
```

### Step 7: Jalankan Migrasi & Seeder
```bash
# Buat tabel di database
php artisan migrate

# Isi data default (admin user + sample data)
php artisan migrate --seed
```

### Step 8: Buat Symbolic Link untuk Storage
```bash
# Supaya upload foto bisa diakses lewat /storage/peminjam/<file>
php artisan storage:link
```

### Step 9: Jalankan Development Server

**Terminal 1 - Backend (PHP Server)**
```bash
php artisan serve
# Server berjalan di http://127.0.0.1:8000
```

**Terminal 2 - Frontend Build (Watch Mode)**
```bash
npm run dev
# Vite watch untuk auto-reload CSS/JS
```

### Step 10: Akses Aplikasi
```
🌐 URL: http://127.0.0.1:8000
📧 Email Admin: admin@example.com
🔐 Password: 12345678
```

---

## 📖 Cara Menggunakan

### Login ke Aplikasi
1. Buka browser → `http://127.0.0.1:8000`
2. Masuk dengan **Email**: `admin@example.com`, **Password**: `12345678`
3. Klik **Login**

### Menambah Data Buku Tanah
1. Sidebar → **Arsip** → **Buku Tanah**
2. Klik tombol **+ Tambah Buku Tanah**
3. Isi form:
   - **No Buku Tanah**: `BT-001` (format bebas)
   - **Nama Pemilik**: nama pemilik tanah
   - **Desa/Kelurahan**: lokasi tanah
   - **Kecamatan**: kecamatan
   - **Jenis Pelayanan**: pilih dari dropdown (Wakaf, Hibah, Jual-Beli, dll)
   - **Status Berkas**: Diterima / Ditolak / Proses
4. Klik **Simpan**

### Menambah Data Surat Ukur
1. Sidebar → **Arsip** → **Surat Ukur**
2. Klik **+ Tambah Surat Ukur**
3. Isi form:
   - **Buku Tanah**: pilih dari dropdown (harus sudah ada data)
   - **Ukuran Luar Tanah**: misal `100m x 50m`
   - **No Surat Tanah**: nomor referensi surat
   - **Tahun**: tahun surat dibuat
4. Klik **Simpan**

### Menambah Data Peminjam (PENTING!)
1. Sidebar → **Data** → **Peminjam**
2. Klik **+ Tambah Peminjam**
3. Isi form **WAJIB**:
   - **Nama Peminjam**: nama lengkap
   - **No HP**: format `0812345678` atau `+6281234567890` ⚠️ **WAJIB format ini**
   - **Email**: email unik (belum terdaftar)
   - **Pilih Surat Ukur**: pilih dari dropdown (harus ada data surat ukur)
   - **Foto** (OPSIONAL): upload foto peminjam (format/ukuran bebas)
4. Klik **Simpan**
5. Lihat di tabel index → data muncul dengan foto (jika diupload)

**Validasi No HP:**
- ✅ `08123456789` (0 diikuti 8-12 angka)
- ✅ `+6281234567` (+62 diikuti 8-12 angka)
- ❌ `123456789` (tidak dimulai 0 atau +62)
- ❌ `+1 123 4567` (format salah)

### Menambah Data Pengembalian
1. Sidebar → **Data** → **Pengembalian**
2. Klik **+ Tambah Pengembalian**
3. Isi form:
   - **Nama**: nama peminjam (dari catatan)
   - **Pilih Buku Tanah**: pilih dari dropdown
   - **No HP**: format sama seperti peminjam
   - **Email**: email pengembalian
   - **Waktu Pengembalian**: pilih tanggal & waktu dari picker
4. Klik **Simpan**

### Mengedit Data
1. Klik menu **Arsip** / **Data**
2. Cari data di tabel
3. Klik tombol **Edit** (ikon pensil)
4. Ubah data → klik **Update**

### Menghapus Data
1. Di tabel, klik tombol **Hapus** (ikon tong sampah)
2. Konfirmasi penghapusan
3. Data terhapus dari database (foto juga otomatis dihapus)

---

## 👨‍💼 Peran Admin

### Tanggung Jawab Admin

| Peran | Tanggung Jawab |
|------|-----------------|
| **Kelola Buku Tanah** | Tambah/edit/hapus data buku tanah, perbarui status berkas |
| **Kelola Surat Ukur** | Manajemen surat ukur, link ke buku tanah, atur ketersediaan |
| **Kelola Peminjam** | Catat peminjam, verifikasi data, upload foto, hapus data invalid |
| **Kelola Pengembalian** | Catat pengembalian arsip, validasi waktu pengembalian, update status |
| **Monitoring** | Pantau dashboard, laporan peminjaman aktif, arsip yang belum dikembalikan |

### Akses Admin
- ✅ Penuh akses CRUD ke semua modul
- ✅ Tidak ada batasan operasi (bisa edit/hapus semua data)
- ✅ Dashboard monitoring real-time

### Keamanan
- 🔐 Email & password login (Laravel Session-based)
- 🔐 Hanya user terdaftar bisa akses aplikasi
- 🔐 Session timeout otomatis (120 menit)

---

## 📊 Database Structure (ERD)

```
┌──────────────────────────────────────────────────────────────┐
│               ENTITY RELATIONSHIP DIAGRAM (ERD)                │
└──────────────────────────────────────────────────────────────┘

                        ┌──────────────┐
                        │    USERS     │
                        ├──────────────┤
                        │ id (PK)      │
                        │ name         │
                        │ email        │
                        │ password     │
                        └──────────────┘
                               │
                (Membuat/Mengelola Peminjam)
                               │
              ┌────────────────┴────────────────┐
              │                                  │
    ┌─────────▼──────────┐          ┌──────────▼──────────┐
    │   BUKU_TANAH       │          │    PEMINJAM         │
    ├────────────────────┤          ├─────────────────────┤
    │ id (PK)            │          │ id (PK)             │
    │ no_buku_tanah      │◄─────────┤ nama_peminjam       │
    │ nama_pemilik       │    FK    │ no_hp               │
    │ desa_kelurahan     │          │ email               │
    │ kecamatan          │          │ surat_ukur_id (FK)  │
    │ jenis_pelayanan    │          │ foto                │
    │ status_berkas      │          │ created_at          │
    └────────────────────┘          └─────────────────────┘
              │
        (Memiliki)
              │
    ┌─────────▼──────────┐
    │   SURAT_UKUR       │
    ├────────────────────┤
    │ id (PK)            │
    │ buku_tanah_id (FK) │
    │ ukuran_luar_tanah  │
    │ no_surat_tanah     │
    │ tahun_tanah        │
    └────────────────────┘
              │
        (Dipinjam oleh)
              │
    ┌─────────▼──────────┐
    │  PENGEMBALIAN      │
    ├────────────────────┤
    │ id (PK)            │
    │ nama               │
    │ buku_tanah_id (FK) │
    │ no_hp              │
    │ email              │
    │ waktu_pengembalian │
    └────────────────────┘

RELATIONSHIPS DETAIL:
═════════════════════════════════════════════════════════════

1. Users (1) ──── (M) Peminjam
   └─ Admin/user bisa membuat banyak catatan peminjam

2. BukuTanah (1) ──── (M) SuratUkur  
   └─ Satu buku tanah bisa memiliki banyak surat ukur

3. SuratUkur (1) ──── (M) Peminjam
   └─ Satu surat ukur dipinjam oleh banyak peminjam (berbeda waktu)

4. BukuTanah (1) ──── (M) Pengembalian
   └─ Pengembalian mencatat arsip dari buku tanah mana yang dikembalikan
```

### Spesifikasi Tabel

**USERS**
| Column | Type | Constraint | Keterangan |
|--------|------|-----------|-----------|
| id | BIGINT | PK, AI | Primary key |
| name | VARCHAR(255) | NOT NULL | Nama user |
| email | VARCHAR(255) | UNIQUE | Email unik |
| password | VARCHAR(255) | - | Hash password |
| created_at | TIMESTAMP | DEFAULT NOW | Waktu buat |
| updated_at | TIMESTAMP | - | Waktu update |

**BUKU_TANAH**
| Column | Type | Constraint | Keterangan |
|--------|------|-----------|-----------|
| id | BIGINT | PK, AI | Primary key |
| no_buku_tanah | VARCHAR(255) | - | Nomor identitas |
| nama_pemilik | VARCHAR(255) | - | Nama pemilik tanah |
| desa_kelurahan | VARCHAR(255) | - | Lokasi desa |
| kecamatan | VARCHAR(255) | - | Nama kecamatan |
| jenis_pelayanan | VARCHAR(255) | - | Tipe pelayanan |
| status_berkas | VARCHAR(100) | - | Status (Diterima/Ditolak/Proses) |
| created_at | TIMESTAMP | - | Waktu buat |
| updated_at | TIMESTAMP | - | Waktu update |

**SURAT_UKUR**
| Column | Type | Constraint | Keterangan |
|--------|------|-----------|-----------|
| id | BIGINT | PK, AI | Primary key |
| buku_tanah_id | BIGINT | FK → buku_tanah.id | Relasi buku tanah |
| ukuran_luar_tanah | VARCHAR(255) | - | Dimensi tanah |
| no_surat_tanah | VARCHAR(255) | - | No surat referensi |
| tahun_tanah | VARCHAR(4) | - | Tahun pembuatan |
| created_at | TIMESTAMP | - | Waktu buat |
| updated_at | TIMESTAMP | - | Waktu update |

**PEMINJAM**
| Column | Type | Constraint | Keterangan |
|--------|------|-----------|-----------|
| id | BIGINT | PK, AI | Primary key |
| nama_peminjam | VARCHAR(255) | NOT NULL | Nama peminjam |
| no_hp | VARCHAR(20) | Regex: `^(\+62\|0)[0-9]{8,12}$` | No HP format Indonesia |
| email | VARCHAR(255) | UNIQUE | Email unik |
| surat_ukur_id | BIGINT | FK → surat_ukur.id | Relasi surat ukur |
| foto | VARCHAR(255) | NULLABLE | Nama file foto |
| created_at | TIMESTAMP | - | Waktu buat |
| updated_at | TIMESTAMP | - | Waktu update |

**PENGEMBALIAN**
| Column | Type | Constraint | Keterangan |
|--------|------|-----------|-----------|
| id | BIGINT | PK, AI | Primary key |
| nama | VARCHAR(255) | NOT NULL | Nama peminjam (saat kembali) |
| buku_tanah_id | BIGINT | FK → buku_tanah.id | Relasi buku tanah |
| no_hp | VARCHAR(20) | Regex: `^(\+62\|0)[0-9]{8,12}$` | No HP format Indonesia |
| email | VARCHAR(255) | - | Email pengembalian |
| waktu_pengembalian | DATETIME | Format: Y-m-d\TH:i | Tanggal & waktu kembali |
| created_at | TIMESTAMP | - | Waktu buat |
| updated_at | TIMESTAMP | - | Waktu update |

---

## 🏗 Architecture (UML)

### Class Diagram - Controllers, Models & Routes

```
┌────────────────────────────────────────────────────────────┐
│                  LARAVEL MVC ARCHITECTURE                   │
└────────────────────────────────────────────────────────────┘

HTTP REQUEST (Browser)
        ↓
ROUTES/WEB.PHP
────────────────
Route::resource('/admin/buku-tanah', BukuTanahController::class);
Route::resource('/admin/surat-ukur', SuratUkurController::class);
Route::resource('/admin/peminjam', PeminjamController::class);
Route::resource('/admin/pengembalian', PengembalianController::class);
        ↓
CONTROLLERS
──────────────────────────────────────────────────────────────
┌──────────────────────┐
│ BukuTanahController  │
├──────────────────────┤
│ index()          │ → PeminjamController@index
│ create()         │ → Form tambah
│ store(Request)   │ → Simpan ke DB
│ show(BukuTanah)  │ → Detail single
│ edit(BukuTanah)  │ → Form edit
│ update(Req, BT)  │ → Update DB
│ destroy(BT)      │ → Hapus dari DB
└──────────────────────┘

┌──────────────────────┐
│ SuratUkurController  │
├──────────────────────┤
│ index()              │
│ create()             │
│ store(Request)       │ ← Validasi FK buku_tanah
│ show(SuratUkur)      │
│ edit(SuratUkur)      │
│ update(Request, SU)  │
│ destroy(SuratUkur)   │
└──────────────────────┘

┌──────────────────────┐
│ PeminjamController   │ ⭐ ENHANCED
├──────────────────────┤
│ index()              │
│ create()             │
│ store(Request)       │ ← File upload + regex no_hp
│ show(Peminjam)       │
│ edit(Peminjam)       │
│ update(Request, P)   │ ← Delete old photo & re-upload
│ destroy(Peminjam)    │ ← Cleanup photo from storage
└──────────────────────┘

┌──────────────────────┐
│ PengembalianController│ ⭐ ENHANCED
├──────────────────────┤
│ index()              │
│ create()             │
│ store(Request)       │ ← Datetime format validation
│ show(Pengembalian)   │
│ edit(Pengembalian)   │
│ update(Request, Pg)  │
│ destroy(Pengembalian)│
└──────────────────────┘
        ↓
MODELS (app/Models/)
──────────────────────────────────────────────────────────────
┌──────────────────────┐
│ User                 │
├──────────────────────┤
│ $fillable = [...]    │
│ auth related         │
└──────────────────────┘
        ↓
┌──────────────────────┐
│ BukuTanah            │
├──────────────────────┤
│ $table = 'buku_tanah'│
│ hasMany(SuratUkur)   │
│ hasMany(Pengembalian)│
└──────────────────────┘
        ↓
┌──────────────────────┐
│ SuratUkur            │
├──────────────────────┤
│ $table = 'surat_ukur'│
│ belongsTo(BukuTanah) │
│ hasMany(Peminjam)    │
└──────────────────────┘
        ↓
┌──────────────────────┐
│ Peminjam             │
├──────────────────────┤
│ $fillable = [...]    │
│ belongsTo(SuratUkur) │
│ getFotoUrlAttribute()│ ← Helper
└──────────────────────┘

┌──────────────────────┐
│ Pengembalian         │
├──────────────────────┤
│ $fillable = [...]    │
│ belongsTo(BukuTanah) │
└──────────────────────┘
        ↓
VIEWS (resources/views/)
──────────────────────────────────────────────────────────────
layouts/admin.blade.php     ← Master template
peminjam/
  ├─ index.blade.php        ← List tabel
  ├─ create.blade.php       ← Form tambah (with file upload)
  ├─ edit.blade.php         ← Form edit
  └─ show.blade.php         ← Detail view

daftar_surat_ukur/
  ├─ index.blade.php        ← List tabel
  ├─ create.blade.php       ← Form + dropdown buku_tanah
  ├─ edit.blade.php         ← Form edit
  └─ show.blade.php         ← Detail view

pengembalian/
  ├─ index.blade.php        ← List tabel
  ├─ create.blade.php       ← Form + datetime input
  ├─ edit.blade.php         ← Form edit
  └─ show.blade.php         ← Detail view

partials/
  ├─ alerts.blade.php       ← Error/success messages
  └─ form-header.blade.php  ← Page header

DATABASE
──────────────────────────────────────────────────────────────
MySQL/MariaDB dengan 5 tabel:
users, buku_tanah, surat_ukur, peminjam, pengembalian
```

---

## 🔗 API Routes

### Complete Routes List (RESTful)

```bash
# BUKU TANAH
GET    /admin/buku-tanah              # List semua buku tanah
GET    /admin/buku-tanah/create       # Form tambah buku tanah
POST   /admin/buku-tanah              # Simpan buku tanah baru
GET    /admin/buku-tanah/{id}         # Detail 1 buku tanah
GET    /admin/buku-tanah/{id}/edit    # Form edit
PUT    /admin/buku-tanah/{id}         # Update buku tanah
DELETE /admin/buku-tanah/{id}         # Hapus buku tanah

# SURAT UKUR
GET    /admin/surat-ukur              # List
GET    /admin/surat-ukur/create       # Form create
POST   /admin/surat-ukur              # Store
GET    /admin/surat-ukur/{id}         # Show
GET    /admin/surat-ukur/{id}/edit    # Form edit
PUT    /admin/surat-ukur/{id}         # Update
DELETE /admin/surat-ukur/{id}         # Delete

# PEMINJAM
GET    /admin/peminjam                # List peminjam
GET    /admin/peminjam/create         # Form tambah
POST   /admin/peminjam                # Store (file upload)
GET    /admin/peminjam/{id}           # Show detail
GET    /admin/peminjam/{id}/edit      # Form edit
PUT    /admin/peminjam/{id}           # Update (foto re-upload)
DELETE /admin/peminjam/{id}           # Delete (cleanup photo)

# PENGEMBALIAN
GET    /admin/pengembalian            # List
GET    /admin/pengembalian/create     # Form create
POST   /admin/pengembalian            # Store
GET    /admin/pengembalian/{id}       # Show
GET    /admin/pengembalian/{id}/edit  # Form edit
PUT    /admin/pengembalian/{id}       # Update
DELETE /admin/pengembalian/{id}       # Delete

# AUTHENTICATION
GET    /login                         # Login page
POST   /login                         # Process login
POST   /logout                        # Logout
GET    /register                      # Register (if enabled)
POST   /register                      # Process register (if enabled)
```

---

## 🐛 Troubleshooting

### 1. Error: "Target class [...] does not exist"
**Penyebab**: Namespace error atau route belum teregistrasi  
**Solusi**:
```bash
php artisan cache:clear
php artisan route:clear
composer dump-autoload
```

### 2. Error: "Syntax error or access violation [...] column not found"
**Penyebab**: Migration belum dijalankan  
**Solusi**:
```bash
php artisan migrate --fresh --seed
```

### 3. Upload foto tidak muncul / Error 404
**Penyebab**: Storage link belum dibuat atau folder tidak ada  
**Solusi**:
```bash
php artisan storage:link
# Pastikan folder storage/app/public/peminjam ada dan writable
chmod -R 755 storage/app/public
```

### 4. Error: "No Application Encryption Key Specified"
**Penyebab**: APP_KEY belum di-generate  
**Solusi**:
```bash
php artisan key:generate
```

### 5. Error: "File not found in .env"
**Penyebab**: File .env belum dicopy dari .env.example  
**Solusi**:
```bash
copy .env.example .env
php artisan key:generate
```

### 6. MySQL Connection Error
**Penyebab**: Database tidak berjalan / credential salah  
**Solusi**:
```bash
# 1. Pastikan MySQL running di XAMPP Control Panel
# 2. Cek .env credentials (DB_HOST, DB_USER, DB_PASSWORD, DB_PORT)
# 3. Test connection dengan Tinker:
php artisan tinker
>>> DB::connection()->getPDO();  # Success jika terkoneksi
```

### 7. Validasi No HP selalu error
**Format yang BENAR**:
- ✅ `08123456789` - dimulai 0, total 10-13 digit
- ✅ `+6281234567` - dimulai +62, total 10-14 digit
- ✅ `089999999999` - OK

**Format yang SALAH**:
- ❌ `62812345678` - tanpa + atau 0 di depan
- ❌ `+62 812 345` - ada spasi
- ❌ `123456` - terlalu pendek
- ❌ `+1 555 123` - bukan +62

### 8. Port 8000 sudah terpakai
**Solusi**: Gunakan port lain
```bash
php artisan serve --port=8001
php artisan serve --port=3000
```

### 9. Permission denied saat upload foto
**Penyebab**: Folder storage tidak punya write permission  
**Solusi**:
```bash
# Windows (PowerShell as Admin)
icacls "storage" /grant:r "%username%":(OI)(CI)F /t

# Linux/Mac
chmod -R 775 storage bootstrap/cache
```

---

## 📁 Project Directory Structure

```
web-arsip-atr-bpn/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── BukuTanahController.php
│   │   │   ├── SuratUkurController.php
│   │   │   ├── PeminjamController.php
│   │   │   └── PengembalianController.php
│   │   ├── Middleware/
│   │   │   └── (Auth middleware, etc)
│   │   └── Kernel.php
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── BukuTanah.php
│   │   ├── SuratUkur.php
│   │   ├── Peminjam.php
│   │   └── Pengembalian.php
│   │
│   ├── Providers/
│   │   └── (Service providers)
│   └── Console/
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── admin.blade.php          ← Master layout
│   │   ├── daftar_buku_tanah/           ← Buku Tanah views
│   │   ├── daftar_surat_ukur/           ← Surat Ukur views
│   │   ├── peminjam/                    ← Peminjam views
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── show.blade.php
│   │   ├── pengembalian/                ← Pengembalian views
│   │   ├── partials/
│   │   │   ├── alerts.blade.php         ← Error/success alerts
│   │   │   └── form-header.blade.php
│   │   └── auth/
│   │       ├── login.blade.php
│   │       └── register.blade.php
│   │
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
│
├── routes/
│   ├── web.php                          ← Resource routes
│   └── api.php
│
├── database/
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2024_xx_xx_xxxxxx_create_buku_tanah_table.php
│   │   ├── 2024_xx_xx_xxxxxx_create_surat_ukur_table.php
│   │   ├── 2024_xx_xx_xxxxxx_create_peminjams_table.php
│   │   └── 2024_xx_xx_xxxxxx_create_pengembalians_table.php
│   │
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── AdminSeeder.php
│
├── config/
│   ├── database.php
│   ├── auth.php
│   ├── filesystems.php
│   └── ...
│
├── storage/
│   ├── app/
│   │   └── public/
│   │       └── peminjam/                ← Upload foto disimpan di sini
│   ├── logs/
│   └── framework/
│
├── bootstrap/
│   ├── app.php
│   └── cache/
│
├── public/
│   ├── index.php
│   ├── css/
│   ├── js/
│   └── storage/ → symbolic link to storage/app/public/
│
├── vendor/                              ← Composer packages
├── node_modules/                        ← NPM packages
│
├── .env.example                         ← Copy ini ke .env
├── .env                                 ← Local configuration
├── .gitignore
├── composer.json                        ← Backend dependencies
├── package.json                         ← Frontend dependencies
├── vite.config.js
├── README.md                            ← Dokumentasi ini
├── artisan                              ← CLI tool
└── README_LENGKAP.md                    ← Dokumentasi komprehensif
```

---

## 🧪 Manual Testing Checklist

Sebelum submit aplikasi, pastikan checklist ini tercapai:

- [ ] **Login & Logout**
  - [ ] Login dengan admin@example.com / 12345678 berhasil
  - [ ] Logout berfungsi

- [ ] **Buku Tanah CRUD**
  - [ ] Bisa tambah buku tanah
  - [ ] Bisa lihat list & detail
  - [ ] Bisa edit data
  - [ ] Bisa hapus data

- [ ] **Surat Ukur CRUD**
  - [ ] Dropdown buku_tanah muncul dengan benar
  - [ ] Bisa tambah surat ukur
  - [ ] Foreign key validation bekerja
  - [ ] Edit & delete berfungsi

- [ ] **Peminjam CRUD** (PENTING)
  - [ ] Form muncul dengan dropdown surat_ukur
  - [ ] No HP validation:
    - [ ] ✅ Accept `08123456789`
    - [ ] ✅ Accept `+6281234567`
    - [ ] ❌ Reject format salah
  - [ ] Email unique validation bekerja
  - [ ] File upload tanpa batasan:
    - [ ] ✅ Upload foto JPG/PNG
    - [ ] ✅ Upload file lain (testing)
    - [ ] ✅ Foto muncul di index
  - [ ] Edit peminjam:
    - [ ] Foto lama otomatis dihapus saat upload foto baru
    - [ ] Data terupdate
  - [ ] Delete peminjam:
    - [ ] Data terhapus dari DB
    - [ ] File foto otomatis dihapus dari storage

- [ ] **Pengembalian CRUD**
  - [ ] Form muncul dengan dropdown buku_tanah
  - [ ] Datetime picker berfungsi
  - [ ] No HP validation sama seperti peminjam
  - [ ] Data tersimpan dengan benar
  - [ ] Edit & delete berfungsi

- [ ] **Alert Messages**
  - [ ] Success message muncul saat add/edit/delete
  - [ ] Error message muncul saat validation error
  - [ ] Auto-dismiss atau bisa manual close

- [ ] **UI/UX**
  - [ ] Layout responsive di mobile
  - [ ] Sidebar navigasi berfungsi
  - [ ] Button & form styling konsisten
  - [ ] Table paging (jika ada banyak data)

---

## 📝 Environment Variables (.env)

Contoh `.env` configuration:

```env
# App Configuration
APP_NAME="Web Arsip ATR/BPN"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
APP_KEY=base64:xxxxxxxxxxxx  # Auto-generate: php artisan key:generate

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web_arsip_atr_bpn
DB_USERNAME=root
DB_PASSWORD=

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=debug

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Mail (optional)
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null

# Storage
FILESYSTEM_DISK=local
```

---

## 📄 License

MIT License - Aplikasi ini dapat digunakan secara bebas untuk keperluan pendidikan, pembelajaran, dan non-komersial.

---

## 👨‍💻 Kontribusi & Support

### Cara Berkontribusi
1. Fork repository ini
2. Buat branch feature: `git checkout -b feature/NamaFeature`
3. Commit changes: `git commit -m 'Add NamaFeature'`
4. Push ke branch: `git push origin feature/NamaFeature`
5. Buat Pull Request

### Laporan Bug & Pertanyaan
- 📧 Email: admin@bpn.go.id
- 🐛 GitHub Issues untuk bug report
- 💬 GitHub Discussions untuk pertanyaan

---

## 🎓 Catatan Untuk Tim Pengembang

### Developer Notes
- Jangan commit `.env` ke repository (gunakan `.env.example`)
- Jalankan `php artisan migrate` setelah pull terbaru
- Gunakan `php artisan tinker` untuk quick testing
- Commit message harus deskriptif & jelas

### Testing Local
```bash
# Quick test database connection
php artisan tinker
>>> DB::connection()->getPDO();

# Check all routes
php artisan route:list

# View logs
tail -f storage/logs/laravel.log
```

---

**Selamat menggunakan Web Arsip ATR/BPN! 🎉**

*Last Updated: December 2025*  
*Version: 2.0.0*  
*Built with ❤️ using Laravel 10 & Bootstrap 5*  
*Maintained by: hamxrae*
