# Penjelasan Detail Code untuk UKK

**Aplikasi:** Web Arsip ATR/BPN  
**Framework:** Laravel 10  
**Database:** MySQL/MariaDB  
**Tanggal:** November 29, 2025

---

## Daftar Isi

1. [Arsitektur & Alur Aplikasi](#arsitektur--alur-aplikasi)
2. [Routing System](#routing-system)
3. [Database & Model](#database--model)
4. [Controllers (Logic Bisnis)](#controllers-logic-bisnis)
5. [Views (Tampilan)](#views-tampilan)
6. [Authentication & Security](#authentication--security)
7. [Fitur-Fitur Utama](#fitur-fitur-utama)
8. [Deployment & Running](#deployment--running)

---

## Arsitektur & Alur Aplikasi

### Model-View-Controller (MVC) Pattern

Aplikasi menggunakan arsitektur **MVC** yang membagi tanggung jawab:

```
REQUEST
  ↓
ROUTING (routes/web.php)
  ↓
CONTROLLER (app/Http/Controllers/)
  ├─ Business Logic
  ├─ Database Query
  └─ Error Handling
  ↓
MODEL (app/Models/)
  ├─ Database Interaction
  └─ Data Validation
  ↓
VIEW (resources/views/)
  ├─ HTML Template
  ├─ Form Display
  └─ Data Display
  ↓
RESPONSE (HTML/JSON)
```

### Alur User Menggunakan Aplikasi

```
1. User tidak login
   ↓
   Akses /login → LoginController::showLoginForm() → view(auth.login)
   ↓
   Input email & password → POST /login
   ↓
   LoginController::login() → Auth::attempt() → validasi
   ↓
   ✓ Login berhasil → redirect('/dashboard')
   ✗ Login gagal → back() dengan error message

2. User sudah login
   ↓
   Akses / → DashboardController::index() → view(dashboard)
   ↓
   Navigasi ke admin panel → /admin/buku-tanah → BukuTanahController::index()
   ↓
   View data, create, edit, delete → CRUD operations
   ↓
   Logout → POST /logout → Auth::logout() → redirect('/login')
```

---

## Routing System

### File: `routes/web.php`

Routing mendefinisikan URL endpoint aplikasi. Struktur lengkap:

#### 1. Guest Routes (Untuk Pengguna yang Belum Login)

```php
Route::middleware('guest')->group(function () {
    // LOGIN
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    
    // REGISTER
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register'])->name('register.store');
    
    // PASSWORD RESET
    Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');
});
```

**Penjelasan:**
- `Route::middleware('guest')` = hanya untuk pengguna yang BELUM login
- Jika user sudah login, mereka akan di-redirect ke dashboard
- `->name()` = memberikan nama untuk `route()` helper di view

#### 2. Authenticated Routes (Untuk Pengguna yang Sudah Login)

```php
Route::middleware('auth')->group(function () {
    // LOGOUT
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // DASHBOARD
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // ADMIN RESOURCES
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('buku-tanah', BukuTanahController::class)->names('bukutanah');
        Route::resource('surat-ukur', SuratUkurController::class)->names('suratukur');
        Route::resource('peminjam', PeminjamController::class)->names('peminjam');
        Route::resource('pengembalian', PengembalianController::class)->names('pengembalian');
    });
});
```

**Penjelasan:**
- `Route::middleware('auth')` = hanya untuk pengguna yang SUDAH login
- `Route::prefix('admin')` = prefix URL menjadi `/admin`
- `name('admin.')` = prefix nama route menjadi `admin.*`
- `Route::resource()` = membuat CRUD routes otomatis

#### Apa itu `Route::resource()`?

`Route::resource('buku-tanah', BukuTanahController::class)` membuat 7 routes:

| Method | URL | Controller Method | Purpose |
|--------|-----|------------------|---------|
| GET | `/admin/buku-tanah` | `index()` | Tampilkan daftar |
| GET | `/admin/buku-tanah/create` | `create()` | Form tambah |
| POST | `/admin/buku-tanah` | `store()` | Simpan data baru |
| GET | `/admin/buku-tanah/{id}` | `show()` | Tampilkan detail |
| GET | `/admin/buku-tanah/{id}/edit` | `edit()` | Form edit |
| PUT/PATCH | `/admin/buku-tanah/{id}` | `update()` | Update data |
| DELETE | `/admin/buku-tanah/{id}` | `destroy()` | Hapus data |

**Route Names (dengan `.names('bukutanah')`)**
- `admin.bukutanah.index` → list
- `admin.bukutanah.create` → form tambah
- `admin.bukutanah.store` → proses tambah
- `admin.bukutanah.edit` → form edit
- `admin.bukutanah.update` → proses edit
- `admin.bukutanah.destroy` → proses hapus

Di view, gunakan:
```blade
<a href="{{ route('admin.bukutanah.index') }}">Daftar</a>
<a href="{{ route('admin.bukutanah.create') }}">Tambah</a>
<a href="{{ route('admin.bukutanah.edit', $item->id) }}">Edit</a>
<form action="{{ route('admin.bukutanah.destroy', $item->id) }}" method="POST">
```

---

## Database & Model

### Model: User

**File:** `app/Models/User.php`

```php
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
```

**Penjelasan:**
- `User` = model untuk tabel `users`
- `protected $fillable` = field yang bisa diisi mass-assign (untuk security)
- `protected $hidden` = field yang disembunyikan saat serialisasi JSON (password, remember_token)
- `protected $casts` = casting tipe data (email_verified_at menjadi datetime object)
- `extends Authenticatable` = memungkinkan Auth::attempt() bekerja

**Table Structure:**
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    remember_token VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

### Model: BukuTanah

**File:** `app/Models/BukuTanah.php`

```php
class BukuTanah extends Model
{
    protected $table = 'buku_tanah';

    protected $fillable = [
        'no_buku_tanah',
        'nama_pemilik',
        'desa_kelurahan',
        'kecamatan',
        'jenis_pelayanan',
        'status_berkas'
    ];

    // Relasi: satu BukuTanah memiliki satu SuratUkur
    public function suratUkur()
    {
        return $this->hasOne(SuratUkur::class, 'buku_tanah_id');
    }

    // Relasi: satu BukuTanah bisa memiliki banyak Pengembalian
    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class);
    }
}
```

**Penjelasan:**
- `protected $table = 'buku_tanah'` = menunjuk ke tabel `buku_tanah` (convention: lowercase plural)
- `$fillable` = field yang bisa diisi melalui `BukuTanah::create([])`
- `hasOne()` = relasi one-to-one
- `hasMany()` = relasi one-to-many

**Table Structure:**
```sql
CREATE TABLE buku_tanah (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    no_buku_tanah VARCHAR(255) UNIQUE,
    nama_pemilik VARCHAR(255),
    desa_kelurahan VARCHAR(255),
    kecamatan VARCHAR(255),
    jenis_pelayanan VARCHAR(255),
    status_berkas VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

### Model: Peminjam

**File:** `app/Models/Peminjam.php`

```php
class Peminjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_peminjam',
        'no_hp',
        'email',
        'surat_ukur_id',
        'foto',
    ];

    // Relasi: satu Peminjam belong to satu SuratUkur
    public function suratUkur()
    {
        return $this->belongsTo(SuratUkur::class, 'surat_ukur_id');
    }

    // Accessor: generate URL foto
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/peminjam/' . $this->foto) : null;
    }
}
```

**Penjelasan:**
- `belongsTo()` = inverse relasi dari `hasMany()`
- Accessor `getFotoUrlAttribute()` = generate property `$peminjam->foto_url`
- Contoh: `$peminjam->foto_url` → `/storage/peminjam/xxx.jpg`

**Table Structure:**
```sql
CREATE TABLE peminjam (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    nama_peminjam VARCHAR(255),
    no_hp VARCHAR(20),
    email VARCHAR(255),
    surat_ukur_id BIGINT (FK),
    foto VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (surat_ukur_id) REFERENCES surat_ukur(id)
);
```

---

## Controllers (Logic Bisnis)

### LoginController

**File:** `app/Http/Controllers/LoginController.php`

Menangani semua logic untuk authentication.

#### 1. Login Form Display

```php
public function showLoginForm()
{
    return view('auth.login');
}
```

- Tampilkan halaman login
- View: `resources/views/auth/login.blade.php`

#### 2. Process Login

```php
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required','email'],
        'password' => ['required']
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/')->with('success', 'Login berhasil');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah'
    ])->onlyInput('email');
}
```

**Penjelasan step-by-step:**
1. `$request->validate()` = validasi input user
   - `email` harus ada dan format email valid
   - `password` harus ada
2. `Auth::attempt($credentials)` = coba login dengan email & password
   - Cari user dengan email tersebut
   - Hash password input dan bandingkan dengan password di DB
   - Jika cocok → login berhasil
3. `$request->session()->regenerate()` = security: regenerate session ID untuk prevent session fixation attack
4. `redirect()->intended('/')` = redirect ke halaman yang diminta sebelumnya, atau `/` jika tidak ada
5. `withErrors()` = pass error message ke view
6. `onlyInput('email')` = flashkan hanya email input (untuk re-fill form)

#### 3. Logout

```php
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login')->with('success', 'Berhasil logout');
}
```

**Penjelasan:**
1. `Auth::logout()` = clear autentikasi
2. `$request->session()->invalidate()` = hapus session user
3. `$request->session()->regenerateToken()` = regenerate CSRF token
4. `redirect('/login')` = redirect ke halaman login

#### 4. Register Form Display

```php
public function showRegisterForm()
{
    return view('auth.register');
}
```

#### 5. Process Register

```php
public function register(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ], [
        'name.required' => 'Nama harus diisi',
        'email.unique' => 'Email sudah terdaftar',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    return redirect('/login')->with('success', 'Akun berhasil dibuat.');
}
```

**Penjelasan:**
1. Validasi:
   - `unique:users` = email tidak boleh duplikat di tabel users
   - `confirmed` = password harus sama dengan password_confirmation
   - `min:8` = minimal 8 karakter
2. `Hash::make()` = hash password sebelum simpan ke DB (security)
3. `User::create()` = buat user baru di database
4. Redirect ke login karena user baru harus login dulu

#### 6. Forgot Password - Send Link

```php
public function sendResetLink(Request $request)
{
    $request->validate([
        'email' => ['required', 'email', 'exists:users,email']
    ]);

    $token = Str::random(60);
    
    DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $request->email],
        [
            'token' => Hash::make($token),
            'created_at' => now()
        ]
    );

    $resetLink = route('password.reset', ['token' => $token, 'email' => $request->email]);
    
    // TODO: Send email with reset link
    
    return back()->with('success', 'Link reset telah dikirim ke email Anda.');
}
```

**Penjelasan:**
1. `exists:users,email` = validasi email ada di tabel users
2. `Str::random(60)` = generate random token (60 karakter)
3. Hash token sebelum simpan (untuk security)
4. `updateOrInsert()` = insert baru atau update jika sudah ada
5. `route()` = generate URL reset dengan token
6. Email sending bisa diimplementasikan dengan Laravel Mail (optional)

#### 7. Show Reset Form

```php
public function showResetPasswordForm($token)
{
    $email = request('email');
    
    $resetData = DB::table('password_reset_tokens')
        ->where('email', $email)
        ->first();

    if (!$resetData || !Hash::check($token, $resetData->token)) {
        return redirect('/login')->with('error', 'Link tidak valid atau kadaluarsa');
    }

    return view('auth.reset-password', [
        'token' => $token,
        'email' => $email
    ]);
}
```

**Penjelasan:**
1. Ambil token & email dari URL
2. Cek apakah token ada di database
3. `Hash::check()` = verifikasi token dengan token di DB
4. Jika valid → tampilkan form reset password
5. Jika tidak valid → redirect ke login dengan error

#### 8. Process Reset Password

```php
public function resetPassword(Request $request)
{
    $request->validate([
        'email' => ['required', 'email', 'exists:users,email'],
        'password' => ['required', 'min:8', 'confirmed'],
        'token' => ['required']
    ]);

    $resetData = DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->first();

    if (!$resetData || !Hash::check($request->token, $resetData->token)) {
        return back()->with('error', 'Link tidak valid atau kadaluarsa');
    }

    User::where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);

    DB::table('password_reset_tokens')->where('email', $request->email)->delete();

    return redirect('/login')->with('success', 'Password berhasil direset.');
}
```

**Penjelasan:**
1. Validasi token dan password baru
2. Cek token di database (seperti showResetPasswordForm)
3. Update password user dengan hash password baru
4. Hapus token dari database (agar tidak bisa dipakai lagi)
5. Redirect ke login

---

### BukuTanahController

**File:** `app/Http/Controllers/BukuTanahController.php`

Menangani CRUD untuk Buku Tanah.

#### 1. Index - Tampilkan Daftar

```php
public function index()
{
    $data = BukuTanah::all();
    return view('daftar_buku-tanah.index', compact('data'));
}
```

**Penjelasan:**
- `BukuTanah::all()` = ambil SEMUA record dari tabel buku_tanah
- `compact('data')` = pass variable `$data` ke view
- View: `resources/views/daftar_buku-tanah/index.blade.php`
- Di view, gunakan `@foreach ($data as $item)` untuk loop

#### 2. Create - Tampilkan Form Tambah

```php
public function create()
{
    return view('daftar_buku-tanah.create');
}
```

**Penjelasan:**
- Tampilkan form kosong untuk input data baru
- View: `resources/views/daftar_buku-tanah/create.blade.php`

#### 3. Store - Simpan Data Baru

```php
public function store(Request $request)
{
    $request->validate([
        'no_buku_tanah' => 'required|unique:buku_tanah',
        'nama_pemilik' => 'required',
        'desa_kelurahan' => 'required',
        'kecamatan' => 'required',
        'jenis_pelayanan' => 'required|in:Wakaf,Balik_nama,Roya,Perubahan_hak,Skpt',
        'status_berkas' => 'required',
    ]);

    BukuTanah::create($request->all());

    return redirect()->route('admin.bukutanah.index')
                    ->with('success', 'Data berhasil ditambahkan!');
}
```

**Penjelasan:**
1. **Validasi:**
   - `required` = wajib diisi
   - `unique:buku_tanah` = nomor buku tanah tidak boleh duplikat
   - `in:...` = value harus salah satu dari list (enum)
   
2. `BukuTanah::create($request->all())` = buat record baru
   - `$request->all()` = ambil semua input yang sudah tervalidasi
   - Mass-assign menggunakan `$fillable`

3. `redirect()->route()` = redirect ke halaman list
   - `.with('success', ...)` = flashkan pesan sukses

#### 4. Edit - Tampilkan Form Edit

```php
public function edit($id)
{
    $data = BukuTanah::findOrFail($id);
    return view('daftar_buku-tanah.edit', compact('data'));
}
```

**Penjelasan:**
- `findOrFail($id)` = cari record dengan ID, jika tidak ditemukan → throw 404
- Pass `$data` ke view untuk pre-fill form

#### 5. Update - Update Data

```php
public function update(Request $request, $id)
{
    $request->validate([
        'no_buku_tanah' => 'required',
        'nama_pemilik' => 'required',
        // ... fields lainnya
    ]);

    $data = BukuTanah::findOrFail($id);
    $data->update($request->all());

    return redirect()->route('admin.bukutanah.index')
                    ->with('success', 'Data berhasil diupdate!');
}
```

**Penjelasan:**
- Cari record yang akan diupdate
- `$data->update($request->all())` = update dengan input dari form

#### 6. Destroy - Hapus Data

```php
public function destroy($id)
{
    BukuTanah::destroy($id);
    return redirect()->route('admin.bukutanah.index')
                    ->with('success', 'Data berhasil dihapus!');
}
```

**Penjelasan:**
- `BukuTanah::destroy($id)` = hapus record dengan ID tertentu
- Redirect kembali ke list dengan pesan sukses

---

## Views (Tampilan)

### Login View

**File:** `resources/views/auth/login.blade.php`

```blade
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <p class="mt-3 text-center">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
```

**Penjelasan Blade Syntax:**
- `{{ ... }}` = echo variable / expression
- `@csrf` = tambah CSRF token untuk security (wajib untuk form POST)
- `@if / @endif` = conditional (like PHP if)
- `@error / @enderror` = tampilkan error validation
- `route()` = generate URL dari route name
- `class="... @error('field') is-invalid @enderror"` = dynamic class (highlight error field)

---

### Daftar Buku Tanah Index

**File:** `resources/views/daftar_buku-tanah/index.blade.php`

```blade
<div class="container mt-4">
    <h2>Daftar Buku Tanah</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.bukutanah.create') }}" class="btn btn-success btn-sm mb-3">
        + Tambah Data
    </a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No. Buku Tanah</th>
                <th>Nama Pemilik</th>
                <th>Desa/Kelurahan</th>
                <th>Kecamatan</th>
                <th>Jenis Pelayanan</th>
                <th>Status Berkas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{ $item->no_buku_tanah }}</td>
                    <td>{{ $item->nama_pemilik }}</td>
                    <td>{{ $item->desa_kelurahan }}</td>
                    <td>{{ $item->kecamatan }}</td>
                    <td>{{ $item->jenis_pelayanan }}</td>
                    <td>{{ $item->status_berkas }}</td>
                    <td>
                        <a href="{{ route('admin.bukutanah.edit', $item->id) }}" class="btn btn-primary btn-sm">
                            Edit
                        </a>
                        <form action="{{ route('admin.bukutanah.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
```

**Penjelasan:**
- `@forelse ... @endforelse` = loop data, jika kosong tampilkan @empty block
- `@method('DELETE')` = spoof HTTP method ke DELETE (karena form hanya support GET/POST)
- `session('success')` = ambil flash message dari controller
- `{{ $item->field }}` = echo property dari model object

---

## Authentication & Security

### 1. Middleware Protection

```php
// Guest middleware: hanya untuk belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm']);
});

// Auth middleware: hanya untuk sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

### 2. CSRF Protection

Setiap form POST harus include CSRF token:

```blade
<form method="POST" action="{{ route('login.post') }}">
    @csrf
    ...
</form>
```

Laravel secara otomatis memvalidasi CSRF token.

### 3. Password Hashing

Password tidak pernah disimpan plaintext:

```php
$user = User::create([
    'password' => Hash::make($request->password)  // hash dulu
]);

Auth::attempt([
    'email' => $email,
    'password' => $password  // Laravel auto-hash dan bandingkan
]);
```

### 4. Session Security

- Session ID di-regenerate setiap login
- Session di-invalidate setiap logout
- CSRF token di-regenerate untuk prevent session fixation

---

## Fitur-Fitur Utama

### 1. Authentication Flow

**Register:**
```
User → Register Form → Input name, email, password → Validate
→ Hash password → Save ke DB → Redirect to Login
```

**Login:**
```
User → Login Form → Input email, password → Validate
→ Auth::attempt() → Check hash → Start session → Redirect to Dashboard
```

**Logout:**
```
User → Click Logout → Destroy session → Clear auth → Redirect to Login
```

**Forgot Password:**
```
User → Forgot Form → Input email → Generate token → Save token to DB
→ Generate reset link → [Send via email] → User click link → Reset password
→ Update password → Delete token → Redirect to Login
```

### 2. CRUD Operations

**Create (Tambah):**
```
Click "Tambah" → Form view → Input data → Validate → Save to DB
→ Flashkan success message → Redirect to list
```

**Read (Lihat):**
```
Index view → Query all records → Loop foreach → Display table
```

**Update (Edit):**
```
Click "Edit" → Pre-fill form dengan current data → Change data
→ Validate → Update DB → Flashkan message → Redirect to list
```

**Delete (Hapus):**
```
Click "Hapus" → Confirm dialog → Send DELETE request
→ Delete from DB → Flashkan message → Redirect to list
```

### 3. Form Validation

Setiap form input divalidasi di controller:

```php
$request->validate([
    'email' => 'required|email|unique:users',
    'password' => 'required|min:8|confirmed',
    'no_buku_tanah' => 'required|unique:buku_tanah',
]);
```

Jika validasi gagal → redirect back dengan error → tampilkan error di form.

### 4. Database Relationships

**One-to-One:**
```php
// BukuTanah memiliki 1 SuratUkur
$bukuTanah->suratUkur;  // akses via property
```

**One-to-Many:**
```php
// User memiliki banyak Peminjam
$user->peminjam;  // collection
```

**Belongs-To:**
```php
// Peminjam belongs to SuratUkur
$peminjam->suratUkur;  // akses parent
```

---

## Deployment & Running

### Development Setup

```bash
# 1. Clone & setup environment
git clone https://github.com/hamxrae/web-arsip-atr-bpn.git
cd web-arsip-atr-bpn
cp .env.example .env

# 2. Install dependencies
composer install
npm install

# 3. Generate key & setup DB
php artisan key:generate
php artisan migrate --seed

# 4. Storage link
php artisan storage:link

# 5. Run development
# Terminal 1:
npm run dev

# Terminal 2:
php artisan serve
```

### Production Deployment

```bash
# Build assets
npm run build

# Clear & cache config
php artisan config:cache
php artisan route:cache

# Use production database
# (set DB_* di .env ke production database)
php artisan migrate --force

# Gunakan web server (Apache/Nginx), bukan `php artisan serve`
```

---

## Kesimpulan

**Alur Aplikasi:**
1. User akses URL → Router cocokkan dengan route
2. Router jalankan controller method
3. Controller query database via model
4. Model return data ke controller
5. Controller pass data ke view
6. View render HTML → browser tampilkan halaman

**Security Features:**
- CSRF token pada setiap form
- Password hashing
- Session regeneration
- Input validation
- Middleware protection

**Tech Stack:**
- Backend: Laravel 10 + PHP 8.1+
- Frontend: Bootstrap 5 + Blade templates
- Database: MySQL/MariaDB
- Asset Pipeline: Vite

Semoga penjelasan ini membantu Anda memahami code aplikasi untuk presentasi UKK! 🚀

