# ⚡ Quick Reference Guide - Login & Logout

## 🎯 Gunakan Ini Untuk:
- Quick lookup saat debugging
- Copy-paste code snippets
- Understanding struktur
- Teaching others

---

## 📂 File Structure Cepat

```
LOGIN FLOW:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
user klik "login"
    ↓
route('login') → LoginController::showLoginForm()
    ↓
resources/views/auth/login_simple.blade.php
    ↓
user masukkan email + password
    ↓
form submit POST → route('login')
    ↓
LoginController::login() (validasi & auth)
    ↓
Jika benar → redirect dashboard
Jika salah → redirect login dengan error

LOGOUT FLOW:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
user klik logout di navbar
    ↓
Modal muncul (confirm)
    ↓
user klik "Keluar"
    ↓
form POST → route('logout')
    ↓
LoginController::logout() (hapus session)
    ↓
redirect login
```

---

## 💻 Code Snippets

### 1️⃣ Login Form HTML
```html
<form method="POST" action="{{ route('login') }}">
    @csrf
    
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    
    <button type="submit">Masuk</button>
</form>
```

### 2️⃣ Logout Modal HTML
```html
<div class="modal" id="logoutModal">
    <div class="modal-content">
        <h5>Keluar dari Sistem</h5>
        <p>Yakin ingin keluar?</p>
        
        <button data-dismiss="modal">Batal</button>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Keluar</button>
        </form>
    </div>
</div>
```

### 3️⃣ Logout Button di Navbar
```html
<a href="#" data-toggle="modal" data-target="#logoutModal">
    <i class="fas fa-sign-out-alt"></i>
    Logout
</a>
```

### 4️⃣ Error Display
```blade
@error('email')
    <div class="error-message">{{ $message }}</div>
@enderror
```

### 5️⃣ Show Old Value
```html
<input type="email" name="email" value="{{ old('email') }}">
```

### 6️⃣ Show Success Message
```blade
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
```

### 7️⃣ Check User Auth
```blade
@auth
    <!-- Show if user logged in -->
@endauth

@guest
    <!-- Show if user not logged in -->
@endguest
```

### 8️⃣ Get Current User
```blade
{{ Auth::user()->name }}
{{ Auth::user()->email }}
```

---

## 🎨 CSS Classes Quick Reference

### Container Classes
```css
.login-container      /* Main wrapper */
.register-container   /* Register wrapper */
.logo-section         /* Logo area */
.logo-icon            /* Logo icon */
```

### Form Classes
```css
.form-group          /* Form group wrapper */
.form-group input    /* Input styling */
.form-group label    /* Label styling */
.error-message       /* Error message color */
```

### Button Classes
```css
.btn-login           /* Login button */
.btn-register        /* Register button */
```

### Alert Classes
```css
.alert               /* Alert wrapper */
.alert-danger        /* Error alert (red) */
.alert-success       /* Success alert (green) */
```

### Link Classes
```css
.signup-text a       /* Signup link */
.signin-text a       /* Signin link */
```

---

## 🎯 Colors Cheat Sheet

```css
Primary Green:    #10b981    ← Main brand color
Dark Green:       #059669    ← Hover state
Darker Green:     #047857    ← Gradient end
Light Gray:       #f8fafc    ← Background
Border Gray:      #e0e0e0    ← Border color
Text Dark:        #333       ← Main text
Text Light:       #666       ← Secondary text
Error Red:        #ef4444    ← Error message
```

### How to Use:
```css
background: #10b981;           /* Primary */
border-color: #10b981;         /* Border */
color: #ef4444;                /* Text error */
box-shadow: 0 0 0 3px 
    rgba(16, 185, 129, 0.1);   /* With alpha */
```

---

## 🔧 Common Customizations

### 1. Change Primary Color
```css
/* Find & Replace */
#10b981 → Your primary color
#059669 → Your darker shade
```

### 2. Change Button Text
```blade
<!-- In blade file -->
<button type="submit">Masuk</button>
<!-- Change "Masuk" to anything -->
```

### 3. Change Logo Icon
```html
<!-- Find -->
<i class="fas fa-leaf"></i>

<!-- Replace with any FontAwesome icon -->
<i class="fas fa-lock"></i>
<i class="fas fa-shield-alt"></i>
<i class="fas fa-check-circle"></i>
```

### 4. Add Password Show/Hide
```html
<!-- Add button next to password input -->
<button type="button" onclick="togglePassword()">
    <i class="fas fa-eye"></i>
</button>

<script>
function togglePassword() {
    let input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
```

### 5. Change Modal Title
```html
<!-- Find -->
<h5>Keluar dari Sistem</h5>

<!-- Change to -->
<h5>Logout Confirmation</h5>
```

---

## 🐛 Debugging Tips

### Problem: Form tidak submit
```javascript
// Check console for errors
console.log('Form submitted');

// Check if button is disabled
// Check if @csrf is present
```

### Problem: Error message tidak muncul
```blade
<!-- Make sure using @error directive -->
@error('field_name')
    {{ $message }}
@enderror
```

### Problem: Old value tidak muncul
```blade
<!-- Check old() function -->
value="{{ old('email') }}"
<!-- Jika tidak ada, ganti nama field sesuai database -->
```

### Problem: Modal tidak muncul
```html
<!-- Check data attributes -->
data-toggle="modal"
data-target="#logoutModal"
<!-- data-target harus match modal id -->
```

---

## 📊 Validation Rules

```php
// Rules yang biasa dipakai:
'email' => 'required|email|unique:users',
'password' => 'required|min:6',
'name' => 'required|string',
'password_confirmation' => 'required|same:password'
```

---

## 🔐 Security Checklist

- [ ] Semua form punya `@csrf`
- [ ] Password diencrypt saat disimpan
- [ ] Session di-destroy saat logout
- [ ] Jangan simpan password di cookie
- [ ] Gunakan HTTPS di production
- [ ] Rate limit di login endpoint

---

## 📱 Responsive Breakpoints

```css
/* Mobile */
@media (max-width: 480px) {
    .login-container {
        padding: 20px 15px;
    }
}

/* Tablet */
@media (max-width: 768px) {
    /* Adjust untuk tablet */
}

/* Desktop */
/* Default styling untuk desktop */
```

---

## 🚀 Performance Tips

1. **Minimize CSS** - Hapus unused styles
2. **No unnecessary animations** - Bisa slow di mobile
3. **Optimize images** - Compress logo jika ada
4. **Cache static files** - Browser caching
5. **Use CDN** - FontAwesome bisa dari CDN

---

## 📞 Contact Points

### User Facing:
- Login page `/login`
- Register page `/register`
- Logout button (navbar)
- Forgot password `/forgot-password`

### Admin/Dev:
- Controller: `app/Http/Controllers/LoginController.php`
- Routes: `routes/web.php`
- Views: `resources/views/auth/`
- Migrations: `database/migrations/`

---

## ⚙️ Configuration

### .env Settings:
```env
APP_NAME="ATR BPN"
APP_URL=http://localhost

SESSION_DRIVER=cookie
SESSION_LIFETIME=120
```

### config/auth.php:
```php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
],
```

---

## 🎓 Learning Resources

- **Video**: Laravel Authentication tutorial
- **Docs**: laravel.com/docs/authentication
- **Docs**: laravel.com/docs/blade
- **Code**: Check this project's files

---

## 🔗 Related Routes

```php
// In routes/web.php

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Register
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');
```

---

## 📝 Notes

- Keep file simple → easier to maintain
- Comment your code → helps others understand
- Test before deploy → prevent issues
- Use git → track changes
- Backup regularly → prevent data loss

---

**Print this page atau save as bookmark untuk quick reference! 📌**

Last Updated: 2025-11-21
Version: 1.0 (Simple & Clean)
