<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - ATR BPN Sistem Manajemen Perizinan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            top: -200px;
            left: -150px;
            animation: float 15s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            bottom: -150px;
            right: -100px;
            animation: float 20s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) translateX(0px);
            }
            50% {
                transform: translateY(50px) translateX(30px);
            }
        }

        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 520px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 60px 50px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.2), 0 0 40px rgba(16, 185, 129, 0.1);
            animation: slideUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 1px solid rgba(255, 255, 255, 0.5);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #10b981, #059669, #047857);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-wrapper {
            text-align: center;
            margin-bottom: 35px;
            animation: fadeInDown 0.8s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            width: 140px;
            height: 140px;
            margin: 0 auto 25px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 15px 40px rgba(16, 185, 129, 0.4);
            animation: pulse-border 3s ease-in-out infinite;
            position: relative;
        }

        .logo-container::after {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 25px;
            opacity: 0.3;
            filter: blur(10px);
            z-index: -1;
        }

        .logo-container i {
            font-size: 70px;
            color: white;
            position: relative;
            z-index: 1;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse-border {
            0%, 100% {
                box-shadow: 0 0 20px rgba(16, 185, 129, 0.3), 0 15px 40px rgba(16, 185, 129, 0.4);
            }
            50% {
                box-shadow: 0 0 40px rgba(16, 185, 129, 0.5), 0 15px 40px rgba(16, 185, 129, 0.4);
            }
        }

        .login-card h1 {
            color: #10b981;
            font-size: 38px;
            font-weight: 900;
            margin-bottom: 8px;
            letter-spacing: -0.8px;
        }

        .subtitle {
            color: #64748b;
            font-size: 15px;
            margin-bottom: 35px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .alert {
            margin-bottom: 20px;
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 14px;
            animation: slideDown 0.4s ease-out;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
            color: #dc2626;
            border-left: 5px solid #ef4444;
            font-weight: 500;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 22px;
            position: relative;
            animation: fadeIn 0.6s ease-out;
            animation-fill-mode: both;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            color: #004d00;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .login-card input {
            width: 100%;
            padding: 14px 16px 14px 50px;
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
            font-weight: 500;
        }

        .login-card input:focus {
            outline: none;
            border-color: #004d00;
            background-color: white;
            box-shadow: 0 0 0 4px rgba(0, 77, 0, 0.12);
        }

        .login-card input:focus + i {
            color: #006600;
            transform: scale(1.2);
        }

        .login-card input::placeholder {
            color: #aaa;
        }

        .text-danger {
            color: #dc3545;
            font-size: 12px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .login-card button {
            width: 100%;
            padding: 16px 20px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.35);
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            position: relative;
            overflow: hidden;
        }

        .login-card button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transition: left 0.6s ease;
        }

        .login-card button:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            box-shadow: 0 12px 35px rgba(16, 185, 129, 0.45);
            transform: translateY(-3px);
        }

        .login-card button:hover::before {
            left: 100%;
        }

        .login-card button:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .signin-link {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
            padding-top: 25px;
            font-weight: 500;
        }

        .signin-link a {
            color: #10b981;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
        }

        .signin-link a::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #10b981, #059669);
            transition: width 0.3s ease;
        }

        .signin-link a:hover {
            color: #059669;
        }

        .signin-link a:hover::after {
            width: 100%;
        }

        .password-strength {
            margin-top: 10px;
            height: 5px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            background: #ef4444;
            transition: all 0.3s ease;
        }

        .password-strength-bar.fair {
            background: linear-gradient(90deg, #f97316, #f59e0b);
            width: 50%;
        }

        .password-strength-bar.good {
            background: linear-gradient(90deg, #10b981, #059669);
            width: 75%;
        }

        .password-strength-bar.strong {
            background: #28a745;
            width: 100%;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 35px 25px;
                border-radius: 20px;
            }

            .login-card h1 {
                font-size: 26px;
            }

            .logo-container {
                width: 100px;
                height: 100px;
            }

            .logo-container i {
                font-size: 50px;
            }

            .login-container {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-card">
                <!-- Logo -->
                <div class="logo-wrapper">
                    <div class="logo-container">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h1>Daftar Akun</h1>
                    <p class="subtitle">Buat akun baru untuk mengakses ATR BPN</p>
                </div>

                <!-- Alert Messages -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Register Form -->
                <form method="POST" action="{{ route('register.store') }}" novalidate>
                    @csrf

                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user" style="margin-right: 5px;"></i> Nama Lengkap
                        </label>
                        <div class="input-wrapper">
                            <input 
                                type="text" 
                                id="name"
                                name="name" 
                                placeholder="Masukkan nama lengkap Anda" 
                                value="{{ old('name') }}" 
                                required
                                autocomplete="name"
                            >
                            <i class="fas fa-user"></i>
                        </div>
                        @error('name')
                            <span class="text-danger">
                                <i class="fas fa-times-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope" style="margin-right: 5px;"></i> Email
                        </label>
                        <div class="input-wrapper">
                            <input 
                                type="email" 
                                id="email"
                                name="email" 
                                placeholder="Masukkan email Anda" 
                                value="{{ old('email') }}" 
                                required
                                autocomplete="email"
                            >
                            <i class="fas fa-envelope"></i>
                        </div>
                        @error('email')
                            <span class="text-danger">
                                <i class="fas fa-times-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-lock" style="margin-right: 5px;"></i> Password
                        </label>
                        <div class="input-wrapper">
                            <input 
                                type="password" 
                                id="password"
                                name="password" 
                                placeholder="Minimal 8 karakter" 
                                required
                                autocomplete="new-password"
                                onchange="checkPasswordStrength()"
                                oninput="checkPasswordStrength()"
                            >
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="password-strength">
                            <div class="password-strength-bar" id="strengthBar"></div>
                        </div>
                        @error('password')
                            <span class="text-danger">
                                <i class="fas fa-times-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-group">
                        <label for="password_confirmation">
                            <i class="fas fa-lock" style="margin-right: 5px;"></i> Konfirmasi Password
                        </label>
                        <div class="input-wrapper">
                            <input 
                                type="password" 
                                id="password_confirmation"
                                name="password_confirmation" 
                                placeholder="Ulangi password Anda" 
                                required
                                autocomplete="new-password"
                            >
                            <i class="fas fa-lock"></i>
                        </div>
                        @error('password_confirmation')
                            <span class="text-danger">
                                <i class="fas fa-times-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit">
                        <i class="fas fa-check-circle" style="margin-right: 8px;"></i> Daftar Sekarang
                    </button>
                </form>

                <!-- Sign In Link -->
                <div class="signin-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('strengthBar');
            
            if (password.length === 0) {
                strengthBar.className = 'password-strength-bar';
                return;
            }

            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            switch(strength) {
                case 1:
                case 2:
                    strengthBar.className = 'password-strength-bar fair';
                    break;
                case 3:
                    strengthBar.className = 'password-strength-bar good';
                    break;
                case 4:
                    strengthBar.className = 'password-strength-bar strong';
                    break;
                default:
                    strengthBar.className = 'password-strength-bar';
            }
        }
    </script>
</body>
</html>
