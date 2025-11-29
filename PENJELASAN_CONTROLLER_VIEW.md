# Penjelasan Controller & View Details

Dokumen ini menjelaskan controller dan view yang lebih kompleks.

---

## Controller: DashboardController

**File:** `app/Http/Controllers/DashboardController.php`

```php
public function index()
{
    $totalBukuTanah = BukuTanah::count();
    $totalSuratUkur = SuratUkur::count();
    $totalPeminjam = Peminjam::count();
    $totalPengembalian = Pengembalian::count();

    return view('dashboard', compact(
        'totalBukuTanah',
        'totalSuratUkur',
        'totalPeminjam',
        'totalPengembalian'
    ));
}
```

**Penjelasan:**
1. `Model::count()` = hitung jumlah record di tabel
2. Pass total ke view sebagai summary statistics
3. View: `resources/views/dashboard.blade.php` menampilkan card summary

---

## Controller: SuratUkurController

**File:** `app/Http/Controllers/SuratUkurController.php`

Struktur mirip dengan BukuTanahController (CRUD resource controller).

**Tambahan:**
- Surat Ukur merupakan dokumen teknis yang terkait dengan Buku Tanah
- Bisa include file upload untuk menyimpan dokumen PDF

```php
public function store(Request $request)
{
    $request->validate([
        'buku_tanah_id' => 'required|exists:buku_tanah,id',
        'nomor_surat' => 'required|unique:surat_ukur',
        'file' => 'nullable|mimes:pdf,jpg,png|max:2048',
    ]);

    $data = $request->only(['buku_tanah_id', 'nomor_surat']);

    // Handle file upload
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('surat_ukur', $filename, 'public');
        $data['file_path'] = 'surat_ukur/' . $filename;
    }

    SuratUkur::create($data);

    return redirect()->route('admin.suratukur.index')
                    ->with('success', 'Surat ukur berhasil ditambahkan!');
}
```

**Penjelasan:**
- `exists:buku_tanah,id` = validasi foreign key
- `$request->file()` = akses file upload
- `storeAs()` = simpan file dengan nama custom ke folder `storage/app/public/surat_ukur/`
- `time()` = generate unique filename dengan timestamp

---

## Controller: PeminjamController

**File:** `app/Http/Controllers/PeminjamController.php`

Menangani data peminjaman arsip.

```php
public function index()
{
    // Ambil dengan relasi (eager loading)
    $data = Peminjam::with('suratUkur.bukuTanah')->get();
    return view('peminjam.index', compact('data'));
}

public function store(Request $request)
{
    $request->validate([
        'nama_peminjam' => 'required|string|max:255',
        'no_hp' => 'required|numeric',
        'email' => 'required|email',
        'surat_ukur_id' => 'required|exists:surat_ukur,id',
        'foto' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['nama_peminjam', 'no_hp', 'email', 'surat_ukur_id']);

    // Handle foto upload
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $filename = time() . '_' . $foto->getClientOriginalName();
        $foto->storeAs('peminjam', $filename, 'public');
        $data['foto'] = $filename;
    }

    Peminjam::create($data);

    return redirect()->route('admin.peminjam.index')
                    ->with('success', 'Data peminjam berhasil ditambahkan!');
}
```

**Penjelasan:**
- `with('relasi')` = eager loading (cegah N+1 query problem)
- Tanpa: query user → loop foreach → query setiap peminjam (N+1 queries)
- Dengan: query user with relasi → 1 query saja
- File upload ke folder `storage/app/public/peminjam/`

---

## Controller: PengembalianController

**File:** `app/Http/Controllers/PengembalianController.php`

Menangani data pengembalian arsip yang sudah dipinjam.

```php
public function index()
{
    $data = Pengembalian::with('peminjam.suratUkur.bukuTanah')->get();
    return view('pengembalian.index', compact('data'));
}

public function create()
{
    // Ambil hanya Peminjam yang belum ada pengembalian
    $peminjam = Peminjam::whereDoesntHave('pengembalian')->get();
    return view('pengembalian.create', compact('peminjam'));
}

public function store(Request $request)
{
    $request->validate([
        'peminjam_id' => 'required|exists:peminjam,id',
        'tgl_pengembalian' => 'required|date',
        'catatan' => 'nullable|string',
    ]);

    Pengembalian::create($request->validated());

    return redirect()->route('admin.pengembalian.index')
                    ->with('success', 'Data pengembalian berhasil ditambahkan!');
}
```

**Penjelasan:**
- `whereDoesntHave('pengembalian')` = cari Peminjam yang tidak memiliki relasi Pengembalian
- Digunakan untuk form create (hanya show peminjaman yang belum dikembalikan)
- Jadi user tidak bisa input pengembalian untuk arsip yang sudah dikembalikan

---

## View: Blade Syntax Details

### Conditional Statements

```blade
@if (condition)
    <p>Condition true</p>
@elseif (other condition)
    <p>Other condition true</p>
@else
    <p>Nothing matched</p>
@endif

{{-- Shorthand --}}
@unless ($variable)
    <p>Variable is empty/false</p>
@endunless
```

### Loops

```blade
@foreach ($items as $item)
    <p>{{ $item->name }}</p>
@endforeach

{{-- With key --}}
@foreach ($items as $key => $item)
    <p>{{ $key }}: {{ $item->name }}</p>
@endforeach

@forelse ($items as $item)
    <p>{{ $item->name }}</p>
@empty
    <p>No items found</p>
@endforelse

{{-- Break & continue --}}
@foreach ($items as $item)
    @if ($item->active)
        <p>{{ $item->name }}</p>
    @else
        @continue
    @endif
@endforeach
```

### Comments

```blade
{{-- This is a comment (not shown in HTML) --}}

<!-- This is HTML comment (shown in HTML source) -->
```

### Variables & Output

```blade
{{-- Echo with escaping (prevent XSS) --}}
{{ $variable }}

{{-- Echo without escaping (use if you trust the data) --}}
{!! $html !!}

{{-- Null coalescing --}}
{{ $variable ?? 'default value' }}

{{-- Expression --}}
{{ $user->age > 18 ? 'Adult' : 'Minor' }}
```

### Forms & CSRF

```blade
<form method="POST" action="{{ route('store') }}">
    @csrf
    
    {{-- For PUT/PATCH/DELETE --}}
    @method('PUT')
    
    <input type="text" name="email" value="{{ old('email') }}">
    
    {{-- old() = return value yang sebelumnya diinput jika ada error --}}
    {{-- berguna untuk pre-fill form setelah validation error --}}
    
    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror
</form>
```

### Auth & Authorization

```blade
@auth
    <p>User sudah login: {{ Auth::user()->name }}</p>
    <p>Email: {{ Auth::user()->email }}</p>
@endauth

@guest
    <p>User belum login</p>
    <a href="{{ route('login') }}">Login</a>
@endguest
```

---

## Form Validation Error Handling

### Di Controller

```php
$request->validate([
    'email' => ['required', 'email'],
    'password' => ['required', 'min:8'],
], [
    // Custom error messages
    'email.required' => 'Email harus diisi',
    'email.email' => 'Email tidak valid',
    'password.required' => 'Password harus diisi',
    'password.min' => 'Password minimal 8 karakter',
]);

// Jika gagal → redirect back dengan $errors
// Jika sukses → lanjut ke line berikutnya
```

### Di View

```blade
<div class="form-group">
    <label for="email">Email</label>
    <input 
        type="email" 
        name="email" 
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email') }}"
    >
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
```

**Penjelasan:**
- `@error('field')` = check apakah field punya error
- `{{ $message }}` = tampilkan error message
- `old('field')` = return value yang sebelumnya diinput
- `is-invalid` = class Bootstrap untuk highlight error field

---

## File Upload Handling

### Controller

```php
public function store(Request $request)
{
    $request->validate([
        'foto' => 'required|image|mimes:jpg,png|max:2048', // max 2MB
    ]);

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        
        // Generate unique filename
        $filename = time() . '_' . Str::slug($file->getClientOriginalName());
        
        // Store file
        $file->storeAs('peminjam', $filename, 'public');
        // File disimpan di: storage/app/public/peminjam/filename.jpg
        
        // Simpan filename ke database
        $peminjam = Peminjam::create([
            'foto' => $filename,
        ]);
    }
}
```

### View - Display Uploaded File

```blade
@if ($peminjam->foto)
    <img src="{{ asset('storage/peminjam/' . $peminjam->foto) }}" width="100">
@else
    <p>No photo</p>
@endif

{{-- atau via accessor (jika sudah defined di model) --}}
<img src="{{ $peminjam->foto_url }}" width="100">
```

### Setup Storage Link

```bash
php artisan storage:link
```

Ini membuat symbolic link dari `storage/app/public/` ke `public/storage/`
Sehingga file bisa diakses via URL: `http://localhost:8000/storage/peminjam/xxx.jpg`

---

## Database Seeding

### File: `database/seeders/AdminSeeder.php`

```php
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
```

### Jalankan Seeding

```bash
php artisan migrate --seed
# atau
php artisan db:seed --class=AdminSeeder
```

Ini akan membuat user admin default untuk testing.

---

## Relationship Query

### Accessing Relationships

```php
// One-to-one
$bukuTanah = BukuTanah::find(1);
$suratUkur = $bukuTanah->suratUkur;  // akses property (lazy load)

// One-to-many
$bukuTanah = BukuTanah::find(1);
foreach ($bukuTanah->pengembalian as $p) {
    echo $p->tgl_pengembalian;
}

// Inverse relationship
$pengembalian = Pengembalian::find(1);
$peminjam = $pengembalian->peminjam;  // akses parent
```

### Eager Loading (Prevent N+1 Query)

```php
// Bad: N+1 queries
$bukuTanah = BukuTanah::all();
foreach ($bukuTanah as $bt) {
    echo $bt->suratUkur->nomor_surat;  // query di setiap loop
}
// Total: 1 query untuk BukuTanah + 100 queries untuk suratUkur (jika 100 buku tanah)

// Good: Eager loading
$bukuTanah = BukuTanah::with('suratUkur')->get();
foreach ($bukuTanah as $bt) {
    echo $bt->suratUkur->nomor_surat;  // sudah di-load, tidak ada query baru
}
// Total: 2 queries saja

// Multiple relationships
$peminjam = Peminjam::with('suratUkur', 'suratUkur.bukuTanah')->get();
```

---

## Flash Messages

### Di Controller

```php
return redirect('/dashboard')
    ->with('success', 'Data berhasil disimpan!');
    
return back()
    ->withErrors(['email' => 'Email tidak valid']);
    
return back()
    ->with('info', 'Info message');
    
return redirect()
    ->with('warning', 'Warning message');
```

### Di View

```blade
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
```

---

## Helper Functions

```blade
{{-- Route helper --}}
{{ route('admin.bukutanah.index') }}
{{ route('admin.bukutanah.edit', $bukuTanah->id) }}

{{-- Asset helper (untuk CSS/JS/images) --}}
{{ asset('css/style.css') }}
{{ asset('storage/peminjam/xxx.jpg') }}

{{-- Auth helpers --}}
{{ Auth::user()->name }}
{{ Auth::check() ? 'logged in' : 'not logged in' }}
{{ Auth::id() }}

{{-- Old input (untuk form pre-fill) --}}
{{ old('email') }}
{{ old('name', 'default value') }}

{{-- URL helper --}}
{{ url('/admin/dashboard') }}
{{ url()->previous() }}

{{-- Config helper --}}
{{ config('app.name') }}
```

---

## Tips & Best Practices

### 1. Always Validate Input
```php
$request->validate([...]);  // JANGAN skip validation
```

### 2. Use Accessors for Formatting
```php
// Model
public function getFullNameAttribute()
{
    return $this->first_name . ' ' . $this->last_name;
}

// View
{{ $user->full_name }}  // tidak perlu formatting di view
```

### 3. Use Scopes for Common Queries
```php
// Model
public function scopeActive($query)
{
    return $query->where('status', 'active');
}

// Controller
$users = User::active()->get();
```

### 4. Use Middleware for Authorization
```php
// Route
Route::get('/admin', [AdminController::class, 'index'])->middleware('admin');

// Middleware
public function handle(Request $request, Closure $next)
{
    if (!Auth::user()->is_admin) {
        return redirect('/');
    }
    return $next($request);
}
```

### 5. Use Observers for Event Handling
```php
// Trigger logic saat model event (creating, created, updating, deleting, etc)
protected static function booted()
{
    static::creating(function ($model) {
        // Do something before save
    });
}
```

---

Semoga dokumentasi ini membantu! 📚

