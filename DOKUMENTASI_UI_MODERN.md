# 📚 Dokumentasi UI & Struktur Kode Aplikasi ATR/BPN

## 📋 Daftar Isi
1. [Struktur Project](#struktur-project)
2. [Panduan UI Components](#panduan-ui-components)
3. [Warna & Desain](#warna--desain)
4. [Cara Memodifikasi UI](#cara-memodifikasi-ui)
5. [List Halaman](#list-halaman)

---

## 🏗️ Struktur Project

```
resources/views/
├── layouts/
│   └── admin.blade.php          # Layout utama (sidebar + topbar)
├── dashboard.blade.php           # Halaman dashboard
├── daftar_buku-tanah/
│   ├── index.blade.php          # List buku tanah
│   ├── create.blade.php         # Form tambah buku tanah
│   └── edit.blade.php           # Form edit buku tanah
├── daftar_surat_ukur/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── peminjam/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
└── pengembalian/
    ├── index.blade.php
    ├── create.blade.php
    └── edit.blade.php
```

---

## 🎨 Panduan UI Components

### 1. Layout Admin (Sidebar + Topbar)
File: `resources/views/layouts/admin.blade.php`

**Fitur:**
- Sidebar fixed dengan menu navigasi
- Topbar sticky dengan profile dropdown
- Responsive design
- Smooth transitions

**Kode struktur:**
```html
<div class="app-container">
    <aside class="sidebar">
        <!-- Menu navigasi -->
    </aside>
    
    <div class="main-wrapper">
        <header class="topbar">
            <!-- Search & profile -->
        </header>
        
        <main class="content-wrapper">
            @yield('content')
        </main>
    </div>
</div>
```

### 2. Page Header
Digunakan di semua halaman untuk menampilkan judul dan subtitle.

**Template:**
```blade
<div class="page-header">
    <div class="page-title">
        <i class="fas fa-icon"></i>
        Judul Halaman
    </div>
    <div class="page-subtitle">Deskripsi halaman</div>
</div>
```

### 3. Card Components
Untuk menampilkan data dalam kotak dengan shadow.

**Statistics Card (Dashboard):**
```blade
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <div style="font-size: 12px; color: #6b7280; font-weight: 500;">
                    Total Buku Tanah
                </div>
                <div style="font-size: 28px; font-weight: 700; color: #111827;">
                    {{ $totalBukuTanah }}
                </div>
            </div>
            <div style="width: 56px; height: 56px; background-color: #d1fae5; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #10b981;">
                <i class="fas fa-book" style="font-size: 24px;"></i>
            </div>
        </div>
    </div>
</div>
```

### 4. Data Tables
Tabel untuk menampilkan list data.

**Struktur:**
```blade
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Column 1</th>
                        <th>Column 2</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->field }}</td>
                            <td>{{ $item->field2 }}</td>
                            <td style="text-align: center; display: flex; gap: 4px; justify-content: center;">
                                <a href="" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 48px 16px;">
                                <div style="font-size: 48px; margin-bottom: 12px;">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                <div style="font-weight: 500; color: #6b7280;">Tidak ada data</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
```

### 5. Buttons
- `.btn .btn-primary` - Tombol utama (hijau)
- `.btn .btn-danger` - Tombol delete (merah)
- `.btn-sm` - Ukuran kecil untuk action buttons

**Contoh:**
```blade
<a href="#" class="btn btn-primary">
    <i class="fas fa-plus me-2"></i>Tambah Data
</a>

<button type="submit" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i>
</button>
```

### 6. Badges
Untuk menampilkan status.

**Contoh:**
```blade
<span class="badge bg-info text-dark">{{ $item->status }}</span>
```

---

## 🎨 Warna & Desain

### Color Palette
```css
--primary-color: #10b981;        /* Hijau */
--primary-dark: #059669;          /* Hijau gelap */
--primary-light: #d1fae5;         /* Hijau muda */
--sidebar-bg: #1f2937;            /* Abu-abu gelap */
--sidebar-hover: #374151;         /* Abu-abu hover */
--topbar-bg: #ffffff;             /* Putih */
--content-bg: #f3f4f6;            /* Abu-abu terang */
```

### Card Shadow
```css
--card-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
--card-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
```

### Typography
- **Body Font**: System UI (Roboto, Segoe UI, etc)
- **Page Title**: 28px, bold, #111827
- **Subtitle**: 14px, #6b7280
- **Table Header**: 14px, bold, #374151
- **Body Text**: 14px, #111827

---

## ✏️ Cara Memodifikasi UI

### 1. Mengubah Warna Tema
Edit `resources/views/layouts/admin.blade.php` bagian `:root`:

```css
:root {
    --primary-color: #YOUR_COLOR;     /* Ubah warna utama */
    --primary-dark: #YOUR_DARK_COLOR;
    /* ... warna lainnya */
}
```

### 2. Menambah Kolom di Tabel
1. Buka file view tabel (misal: `daftar_buku-tanah/index.blade.php`)
2. Tambah `<th>` baru di `<thead>`
3. Tambah `<td>` baru di `<tbody>` sesuai dengan data

**Contoh:**
```blade
<!-- Tambah di <thead> -->
<th>Email</th>

<!-- Tambah di <tbody> -->
<td>{{ $item->email }}</td>
```

### 3. Mengubah Header Halaman
```blade
<div class="page-header">
    <div class="page-title">
        <i class="fas fa-ICON_BARU"></i>
        Judul Baru
    </div>
    <div class="page-subtitle">Subtitle baru</div>
</div>
```

### 4. Menambah Menu Sidebar
Edit `resources/views/layouts/admin.blade.php`:

```blade
<li class="sidebar-menu-item">
    <a href="{{ route('route.name') }}" class="sidebar-menu-link">
        <i class="fas fa-icon"></i>
        <span>Menu Baru</span>
    </a>
</li>
```

### 5. Mengubah Styling Card
Gunakan inline style atau tambah class baru:

```blade
<div class="card" style="background-color: #f0f0f0;">
    <!-- content -->
</div>
```

---

## 📄 List Halaman & Fungsi

### 1. Dashboard (`/`)
**File:** `resources/views/dashboard.blade.php`

**Fitur:**
- Statistik total: Buku Tanah, Surat Ukur, Peminjam, Pengembalian
- Tabel data terbaru
- Quick action buttons

**Komponen:**
- 4 Statistics Cards
- 1 Data Table

---

### 2. Daftar Buku Tanah
**File:** `resources/views/daftar_buku-tanah/`
- `index.blade.php` - List buku tanah
- `create.blade.php` - Form tambah
- `edit.blade.php` - Form edit

**Kolom Tabel:**
- No Buku Tanah
- Nama Pemilik
- Desa / Kelurahan
- Kecamatan
- Jenis Pelayanan
- Status Berkas
- Aksi (Edit, Delete)

---

### 3. Daftar Surat Ukur
**File:** `resources/views/daftar_surat_ukur/`

**Kolom Tabel:**
- No Surat Tanah
- Ukuran Luar
- Tahun
- No Buku Tanah
- Nama Pemilik
- Aksi

---

### 4. Daftar Peminjam
**File:** `resources/views/peminjam/`

**Kolom Tabel:**
- Foto
- Nama Peminjam
- No HP
- Email
- No Surat Tanah
- Aksi

---

### 5. Data Pengembalian
**File:** `resources/views/pengembalian/`

**Kolom Tabel:**
- Nama
- No Buku Tanah
- No HP
- Email
- Waktu Pengembalian
- Aksi

---

## 🔄 Flow Aplikasi

```
Login → Dashboard → 
    ├── Daftar Buku Tanah (CRUD)
    ├── Daftar Surat Ukur (CRUD)
    ├── Daftar Peminjam (CRUD)
    └── Data Pengembalian (CRUD)
```

---

## 💡 Tips untuk UKK

1. **Pahami structure**
   - Semua page punya layout sama (sidebar + topbar)
   - Semua use Bootstrap 5 & Font Awesome 6

2. **Mudah diubah**
   - CSS ada di layout (centralized)
   - Inline style untuk customisasi per halaman
   - Kode rapi dan terkommentir

3. **Konsistensi**
   - Warna sama di semua halaman
   - Button styling sama
   - Table format sama

4. **Modifikasi mudah**
   - Tambah/hapus kolom di tabel
   - Ubah warna di `:root`
   - Tambah menu di sidebar

---

## 📞 Troubleshooting

**Q: Cache tidak ter-clear?**
A: Jalankan `php artisan cache:clear && php artisan view:clear`

**Q: Style tidak berubah?**
A: Refresh browser (Ctrl+Shift+R) dan clear cache Laravel

**Q: Icon tidak muncul?**
A: Pastikan class Font Awesome benar (misal: `fas fa-book`)

---

**Dibuat untuk UKK - Mudah dipelajari dan dimodifikasi**
