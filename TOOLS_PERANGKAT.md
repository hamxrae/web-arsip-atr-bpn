# Tools & Perangkat yang Digunakan

Dokumentasi lengkap tentang semua tools, framework, dan perangkat yang digunakan dalam proyek **Sistem Manajemen Arsip ATR/BPN**.

---

## 1. Server & Database

### XAMPP (Apache + MySQL + PHP)
**Versi:** Terbaru yang support PHP 8.1+  
**Fungsi:** Development server lokal dan database server

**Komponen XAMPP yang digunakan:**
- **Apache** - Web server untuk menjalankan aplikasi Laravel
- **MySQL** - Database server untuk menyimpan data aplikasi
- **PHP** - Runtime untuk menjalankan code Laravel

**Cara menggunakan:**
```bash
# Buka XAMPP Control Panel
# Klik "Start" pada Apache
# Klik "Start" pada MySQL
# Aplikasi siap diakses di http://localhost:8000
```

### MySQL / MariaDB
**Versi:** MySQL 5.7+ atau MariaDB 10.3+  
**Fungsi:** Menyimpan semua data aplikasi (users, buku tanah, peminjaman, dll)

**Tools GUI MySQL:**
- **phpMyAdmin** - Built-in dengan XAMPP (http://localhost/phpmyadmin)
- **DBeaver** - GUI external untuk manage database
- **MySQL Workbench** - Tool resmi dari MySQL

---

## 2. Backend Framework

### Laravel 10
**Versi:** 10.x  
**Fungsi:** Web application framework untuk backend

**Fitur Laravel yang digunakan:**
- **Routing** - Manajemen URL route (di `routes/web.php`)
- **Controllers** - Logika aplikasi (di `app/Http/Controllers/`)
- **Models** - ORM untuk database (di `app/Models/`)
- **Migrations** - Database schema management (di `database/migrations/`)
- **Seeders** - Data seeding (di `database/seeders/`)
- **Blade** - Template engine (di `resources/views/`)
- **Authentication** - Built-in auth system

**Package Laravel penting:**
- `laravel/framework` - Core framework
- `laravel/sanctum` - API authentication
- `fakerphp/faker` - Generate fake data untuk testing

**Perintah Laravel yang sering digunakan:**
```bash
php artisan serve              # Jalankan development server
php artisan make:controller    # Buat controller baru
php artisan make:model         # Buat model baru
php artisan make:migration     # Buat migration baru
php artisan migrate            # Jalankan migration
php artisan db:seed            # Jalankan seeder
php artisan tinker             # Interactive shell
```

---

## 3. Frontend Tools

### Node.js & npm
**Versi:** Node 16+ (disarankan 18 LTS)  
**Fungsi:** Runtime JavaScript dan package manager

**Digunakan untuk:**
- Menjalankan build tools (Vite)
- Mengelola package JavaScript
- Build assets untuk production

**Package npm penting:**
```json
{
  "devDependencies": {
    "vite": "^4.0",           // Build tool modern
    "vue": "^3.0",            // Frontend framework (opsional)
    "@vitejs/plugin-vue": "^4"// Vue plugin untuk Vite
  }
}
```

### Vite
**Versi:** 4.x  
**Fungsi:** Modern build tool dan development server untuk assets

**Fitur:**
- Hot Module Replacement (HMR) - Update otomatis saat edit file
- Lightning-fast development
- Optimized production builds

**Perintah Vite:**
```bash
npm run dev    # Development mode (watch & HMR)
npm run build  # Production build
```

**File konfigurasi:** `vite.config.js`

---

## 4. Version Control

### Git
**Versi:** Terbaru  
**Fungsi:** Version control untuk tracking perubahan code

**Perintah Git yang sering digunakan:**
```bash
git clone <url>           # Clone repository
git add .                 # Stage changes
git commit -m "message"   # Commit changes
git push origin main      # Push ke remote
git pull origin main      # Pull dari remote
git status                # Lihat status
git log                   # Lihat history commit
```

### GitHub
**URL Repository:** https://github.com/hamxrae/web-arsip-atr-bpn  
**Fungsi:** Cloud repository untuk menyimpan code

**Fitur yang digunakan:**
- Remote repository
- Issue tracking
- Pull requests
- Collaboration

---

## 5. Development Tools & IDE

### Visual Studio Code (VS Code)
**Versi:** Terbaru  
**Fungsi:** Code editor untuk development

**Extension yang direkomendasikan:**
- **PHP Intelephense** - PHP code intelligence
- **Laravel Extension Pack** - Integrasi Laravel
- **Prettier** - Code formatter
- **ESLint** - JavaScript linter
- **Thunder Client** - API testing
- **Git Graph** - Git visualization
- **Database Client** - Database management

**Shortcut penting:**
```
Ctrl + K, Ctrl + F  - Format document
Ctrl + /            - Comment/uncomment
Ctrl + Shift + P    - Command palette
Ctrl + `            - Terminal
```

---

## 6. Package Managers

### Composer
**Versi:** Terbaru  
**Fungsi:** PHP dependency manager

**File konfigurasi:** `composer.json`

**Perintah penting:**
```bash
composer install      # Install dependencies
composer update       # Update dependencies
composer require      # Install package baru
composer dump-autoload # Regenerate autoload
```

### npm (Node Package Manager)
**Versi:** 8+  
**Fungsi:** JavaScript dependency manager

**File konfigurasi:** `package.json`

**Perintah penting:**
```bash
npm install           # Install dependencies
npm update            # Update dependencies
npm install <package> # Install package baru
npm run dev          # Run development script
npm run build        # Run build script
```

---

## 7. Database Tools

### DBeaver Community Edition
**Fungsi:** GUI tool untuk manage database

**Keunggulan:**
- Support berbagai database (MySQL, PostgreSQL, Oracle, dll)
- UI intuitif
- Query editor dengan syntax highlighting
- Data export/import

**Cara menggunakan:**
1. Download dari https://dbeaver.io
2. Buat koneksi ke MySQL lokal
3. Browse tables dan run queries

### phpMyAdmin
**Fungsi:** Web-based MySQL management tool

**Akses:** `http://localhost/phpmyadmin`

**Fitur:**
- Create/drop database
- Run SQL queries
- Export/import data
- Manage users & privileges

---

## 8. Testing Tools

### PHPUnit
**Versi:** 10.x  
**Fungsi:** Unit testing framework untuk PHP

**File konfigurasi:** `phpunit.xml`

**Perintah:**
```bash
php artisan test              # Run all tests
php artisan test --filter=tes # Run specific test
```

**File tests:** `tests/` folder

---

## 9. API Testing Tools

### Thunder Client / Postman
**Fungsi:** Test HTTP requests dan API endpoints

**Thunder Client (VS Code Extension):**
- Langsung di VS Code
- Lightweight
- User-friendly

**Postman:**
- Standalone application
- Advanced features
- Collection management

**Contoh test request:**
```
Method: POST
URL: http://localhost:8000/login
Headers: Content-Type: application/json
Body: {
  "email": "admin@example.com",
  "password": "12345678"
}
```

---

## 10. Code Quality Tools

### Laravel Pint
**Versi:** 1.x  
**Fungsi:** PHP code style fixer

**Perintah:**
```bash
php artisan pint     # Fix code style issues
```

### ESLint
**Fungsi:** JavaScript linter

**Perintah:**
```bash
npx eslint <file>    # Check file
```

---

## 11. Dokumentasi Tools

### Markdown
**Fungsi:** Format dokumentasi (file `.md`)

**File dokumentasi proyek:**
- `README.md` - Dokumentasi utama
- `TOOLS_PERANGKAT.md` - File ini
- `DOKUMENTASI_LOGIN_REGISTER.md` - Detail login/register
- `QUICK_REFERENCE.md` - Quick reference
- `RINGKASAN_PERUBAHAN.md` - Changelog

**Markdown syntax:**
```markdown
# Heading 1
## Heading 2
- Bullet point
- Item 2
**Bold text**
`code`
```

---

## 12. Environment Management

### .env File
**Fungsi:** Menyimpan konfigurasi sensitif

**File:** `.env` (JANGAN commit ke git)

**Contoh isi:**
```env
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=web_arsip_atr_bpn
DB_USERNAME=root
DB_PASSWORD=
```

### .env.example
**Fungsi:** Template untuk `.env`

**File:** `.env.example` (boleh commit ke git)

---

## Ringkasan Tools Stack

| Layer | Tools | Versi |
|-------|-------|-------|
| **Server** | XAMPP + Apache | Latest |
| **Database** | MySQL / MariaDB | 5.7+ |
| **Backend** | Laravel | 10.x |
| **Backend Language** | PHP | 8.1+ |
| **Frontend Build** | Vite | 4.x |
| **Frontend Language** | JavaScript/Vue | 3.x |
| **Version Control** | Git + GitHub | Latest |
| **IDE** | VS Code | Latest |
| **Package Managers** | Composer, npm | Latest |
| **Testing** | PHPUnit | 10.x |
| **API Testing** | Thunder Client / Postman | Latest |
| **Database GUI** | DBeaver, phpMyAdmin | Latest |

---

## Sistem Requirements Minimal

```
Minimal:
- RAM: 4GB
- Storage: 1GB
- OS: Windows 10 / macOS / Linux

Recommended:
- RAM: 8GB
- Storage: 5GB
- OS: Windows 11 / macOS M1+ / Linux (Ubuntu 20.04+)
```

---

## Instalasi & Setup Tools (Langkah Demi Langkah)

### 1. Install XAMPP
```
1. Download dari https://www.apachefriends.org
2. Install sesuai sistem operasi
3. Buka XAMPP Control Panel
4. Start Apache dan MySQL
```

### 2. Install Node.js
```
1. Download dari https://nodejs.org
2. Pilih LTS version
3. Install sesuai instruksi
4. Verifikasi: node --version, npm --version
```

### 3. Install Composer
```
1. Download dari https://getcomposer.org
2. Install sesuai sistem operasi
3. Verifikasi: composer --version
```

### 4. Install VS Code
```
1. Download dari https://code.visualstudio.com
2. Install sesuai sistem operasi
3. Install extension yang direkomendasikan
```

### 5. Clone Project
```bash
git clone https://github.com/hamxrae/web-arsip-atr-bpn.git
cd web-arsip-atr-bpn
```

### 6. Install Dependencies
```bash
composer install
npm install
```

### 7. Setup Environment
```bash
copy .env.example .env
php artisan key:generate
```

### 8. Database Setup
```bash
php artisan migrate --seed
```

### 9. Run Development
```bash
npm run dev        # Terminal 1
php artisan serve  # Terminal 2
```

---

## Troubleshooting Tools

### Jika Composer Error
```bash
composer clear-cache
composer install
```

### Jika npm Error
```bash
rm -rf node_modules package-lock.json
npm install
```

### Jika Database Error
```bash
php artisan migrate:refresh --seed
```

### Jika Assets tidak Load
```bash
npm run dev
npm run build
```

### Jika Port 8000 Sudah Digunakan
```bash
php artisan serve --port=8001
```

---

## Links & Resources

- **Laravel Documentation:** https://laravel.com/docs/10.x
- **PHP Documentation:** https://www.php.net/manual
- **Node.js Documentation:** https://nodejs.org/docs
- **Vite Documentation:** https://vitejs.dev
- **Git Documentation:** https://git-scm.com/doc
- **MySQL Documentation:** https://dev.mysql.com/doc

---

**Dokumentasi dibuat:** November 28, 2025  
**Terakhir diupdate:** November 28, 2025  
**Framework:** Laravel 10  
**Version:** 1.0.0
