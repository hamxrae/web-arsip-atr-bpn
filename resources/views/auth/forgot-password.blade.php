<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - ATR BPN</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #004d00 0%, #006600 50%, #008000 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            top: -150px;
            left: -100px;
            animation: float 8s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(0, 255, 100, 0.05);
            border-radius: 50%;
            bottom: -100px;
            right: -50px;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) translateX(0px);
            }
            50% {
                transform: translateY(40px) translateX(20px);
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
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 50px 40px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.25);
            animation: slideUp 0.7s ease-out;
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #004d00, #006600, #008000);
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
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background: linear-gradient(135deg, #004d00, #006600);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 77, 0, 0.3);
        }

        .logo-container i {
            font-size: 40px;
            color: white;
        }

        .login-card h2 {
            color: #004d00;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            font-weight: 500;
            letter-spacing: 0.5px;
            line-height: 1.6;
        }

        .alert {
            margin-bottom: 20px;
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 14px;
            animation: slideDown 0.4s ease-out;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.05));
            color: #c33;
            border-left: 4px solid #dc3545;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(40, 167, 69, 0.05));
            color: #155724;
            border-left: 4px solid #28a745;
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
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #004d00 0%, #006600 100%);
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0, 77, 0, 0.35);
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .login-card button:hover {
            background: linear-gradient(135deg, #006600 0%, #008000 100%);
            box-shadow: 0 12px 35px rgba(0, 77, 0, 0.45);
            transform: translateY(-3px);
        }

        .login-card button:hover::before {
            left: 100%;
        }

        .login-card button:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 77, 0, 0.3);
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #004d00;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-link a:hover {
            color: #006600;
        }

        .back-link a::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #004d00, #006600);
            transition: width 0.3s ease;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 35px 25px;
                border-radius: 20px;
            }

            .login-card h2 {
                font-size: 24px;
            }

            .logo-container {
                width: 70px;
                height: 70px;
            }

            .logo-container i {
                font-size: 35px;
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
                        <i class="fas fa-key"></i>
                    </div>
                    <h2>Lupa Password?</h2>
                    <p class="subtitle">Masukkan email Anda dan kami akan mengirimkan instruksi untuk mereset password</p>
                </div>

                <!-- Success Alert -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

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

                <!-- Forgot Password Form -->
                <form method="POST" action="{{ route('password.email') }}" novalidate>
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

                    <!-- Submit Button -->
                    <button type="submit">
                        <i class="fas fa-paper-plane" style="margin-right: 8px;"></i> Kirim Link Reset
                    </button>
                </form>

                <!-- Back to Login Link -->
                <div class="back-link">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

