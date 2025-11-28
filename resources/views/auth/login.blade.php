<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ATR BPN - Sistem Manajemen Perizinan</title>
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

        @keyframes pulse-border {
            0%, 100% {
                box-shadow: 0 0 20px rgba(16, 185, 129, 0.3), 0 10px 30px rgba(0, 0, 0, 0.2);
            }
            50% {
                box-shadow: 0 0 40px rgba(16, 185, 129, 0.5), 0 10px 30px rgba(0, 0, 0, 0.2);
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
            max-width: 480px;
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
            margin-bottom: 25px;
            padding: 16px 20px;
            border-radius: 14px;
            font-size: 14px;
            animation: slideDown 0.4s ease-out;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
            color: #dc2626;
            border-left: 5px solid #ef4444;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
            color: #059669;
            border-left: 5px solid #10b981;
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
            margin-bottom: 12px;
            color: #1e293b;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 18px;
            color: #10b981;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .login-card input {
            width: 100%;
            padding: 14px 18px 14px 55px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            background-color: #f8fafc;
            font-weight: 500;
        }

        .login-card input:focus {
            outline: none;
            border-color: #10b981;
            background-color: white;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
            padding-left: 55px;
        }

        .login-card input:focus ~ i {
            color: #059669;
            transform: scale(1.15);
        }

        .login-card input::placeholder {
            color: #cbd5e1;
        }

        .text-danger {
            color: #ef4444;
            font-size: 12px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 25px 0 35px 0;
            font-size: 13px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .remember-forgot label {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #64748b;
            font-weight: 500;
        }

        .remember-forgot input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            cursor: pointer;
            accent-color: #10b981;
            border-radius: 4px;
        }

        .remember-forgot a {
            color: #10b981;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            position: relative;
        }

        .remember-forgot a::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #10b981, #059669);
            transition: width 0.3s ease;
        }

        .remember-forgot a:hover {
            color: #059669;
        }

        .remember-forgot a:hover::after {
            width: 100%;
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

        .signup-link {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
            padding-top: 25px;
            font-weight: 500;
        }

        .signup-link a {
            color: #10b981;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
        }

        .signup-link a::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #10b981, #059669);
            transition: width 0.3s ease;
        }

        .signup-link a:hover {
            color: #059669;
        }

        .signup-link a:hover::after {
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

            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-card">
                <!-- Logo & Branding -->
                <div class="logo-wrapper">
                    <div class="logo-container">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h1>ATR BPN</h1>
                    <p class="subtitle">Sistem Manajemen Perizinan</p>
                </div>

                <!-- Error Alert -->
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

                <!-- Success Alert -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login.post') }}" novalidate>
                    @csrf

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
                                placeholder="Masukkan password Anda" 
                                required
                                autocomplete="current-password"
                            >
                            <i class="fas fa-lock"></i>
                        </div>
                        @error('password')
                            <span class="text-danger">
                                <i class="fas fa-times-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Remember & Forgot Password -->
                    <div class="remember-forgot">
                        <label>
                            <input 
                                type="checkbox" 
                                name="remember" 
                                {{ old('remember') ? 'checked' : '' }}
                            >
                            <span>Ingat saya</span>
                        </label>
                        <a href="{{ route('password.request') }}">Lupa password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit">
                        <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> Masuk
                    </button>
                </form>

                <!-- Signup Link -->
                <div class="signup-link">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
