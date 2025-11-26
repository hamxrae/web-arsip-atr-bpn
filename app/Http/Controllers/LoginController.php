<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login'); // pastikan ada resources/views/auth/login.blade.php
    }

    // Proses login
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

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Berhasil logout');
    }

    // Menampilkan form lupa password
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Mengirim link reset password
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email']
        ], [
            'email.exists' => 'Email tidak terdaftar di sistem'
        ]);

        // Generate token
        $token = Str::random(60);
        
        // Simpan token ke database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // Buat link reset
        $resetLink = route('password.reset', ['token' => $token, 'email' => $request->email]);

        // TODO: Kirim email dengan link reset (opsional)
        // Mail::send('emails.password-reset', ['resetLink' => $resetLink], function($message) use ($request) {
        //     $message->to($request->email);
        // });

        return back()->with('success', 'Link reset password telah dikirim ke email Anda. Silakan periksa email Anda.');
    }

    // Menampilkan form reset password
    public function showResetPasswordForm($token)
    {
        $email = request('email');
        
        // Verifikasi token ada di database
        $resetData = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (!$resetData || !Hash::check($token, $resetData->token)) {
            return redirect('/login')->with('error', 'Link reset password tidak valid atau sudah kadaluarsa');
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $email
        ]);
    }

    // Proses reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'token' => ['required']
        ]);

        // Verifikasi token
        $resetData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetData || !Hash::check($request->token, $resetData->token)) {
            return back()->with('error', 'Link reset password tidak valid atau sudah kadaluarsa');
        }

        // Update password user
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        // Hapus token dari database
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/login')->with('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');
    }

    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa teks',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat. Silakan login dengan email dan password Anda.');
    }
}
