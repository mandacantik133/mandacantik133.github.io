<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPK Star of the Month</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0a1628;
            position: relative;
        }

        .login-wrapper {
            position: relative;
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0a1628;
            padding: 40px 20px;
        }

        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            background-image: 
                radial-gradient(2px 2px at 10% 20%, rgba(255,255,255,0.5), transparent),
                radial-gradient(2px 2px at 30% 60%, rgba(255,255,255,0.3), transparent),
                radial-gradient(1px 1px at 50% 10%, rgba(255,255,255,0.6), transparent),
                radial-gradient(2px 2px at 70% 80%, rgba(255,255,255,0.3), transparent),
                radial-gradient(1px 1px at 90% 40%, rgba(255,255,255,0.4), transparent),
                radial-gradient(1px 1px at 15% 90%, rgba(255,255,255,0.3), transparent),
                radial-gradient(2px 2px at 60% 30%, rgba(255,255,255,0.2), transparent),
                radial-gradient(1px 1px at 85% 70%, rgba(255,255,255,0.4), transparent);
            background-size: 300px 300px;
        }

        .stars-twinkle {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            background-image: 
                radial-gradient(1px 1px at 25% 35%, rgba(255,255,255,0.7), transparent),
                radial-gradient(1px 1px at 65% 55%, rgba(255,255,255,0.6), transparent),
                radial-gradient(1px 1px at 45% 75%, rgba(255,255,255,0.5), transparent);
            background-size: 300px 300px;
            animation: twinkle 3s ease-in-out infinite alternate;
        }

        @keyframes twinkle {
            0% { opacity: 0.3; }
            100% { opacity: 1; }
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 45px 40px 35px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-header .logo-wrapper {
            width: 75px;
            height: 75px;
            background: #0a1628;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            box-shadow: 0 8px 30px rgba(10, 22, 40, 0.3);
        }

        .login-header .logo-wrapper i {
            font-size: 36px;
            color: #f7c948;
            text-shadow: 0 0 20px rgba(247, 201, 72, 0.2);
        }

        .login-header h1 {
            color: #0a1628;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            line-height: 1.5;
        }

        .login-header h1 span {
            color: #f7c948;
        }

        .login-header .welcome {
            color: #6c757d;
            font-size: 13px;
            font-weight: 400;
            margin-top: 6px;
        }

        .login-header .login-text {
            color: #adb5bd;
            font-size: 12px;
            font-weight: 300;
            margin-top: 2px;
        }

        .login-header .divider {
            width: 50px;
            height: 2px;
            background: #f7c948;
            margin: 14px auto 0;
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            color: #0a1628;
            font-size: 12px;
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 15px;
            transition: color 0.3s;
        }

        .input-group-custom input {
            width: 100%;
            padding: 14px 20px 14px 48px;
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            color: #212529;
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
            transition: all 0.3s;
            outline: none;
        }

        .input-group-custom input::placeholder {
            color: #adb5bd;
            font-weight: 300;
            font-size: 13px;
        }

        .input-group-custom input:focus {
            border-color: #f7c948;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(247, 201, 72, 0.1);
        }

        .input-group-custom input:focus ~ .input-icon {
            color: #f7c948;
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #adb5bd;
            cursor: pointer;
            font-size: 15px;
            padding: 4px;
            transition: color 0.3s;
        }

        .toggle-password:hover {
            color: #0a1628;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0 26px;
        }

        .form-options .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6c757d;
            font-size: 12px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .form-options .remember-me:hover {
            color: #0a1628;
        }

        .form-options .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #f7c948;
            cursor: pointer;
        }

        .form-options .forgot-link {
            color: #adb5bd;
            font-size: 12px;
            text-decoration: none;
            transition: color 0.3s;
            font-weight: 500;
        }

        .form-options .forgot-link:hover {
            color: #0a1628;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: #0a1628;
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(10, 22, 40, 0.3);
            background: #1a2a5c;
        }

        .btn-login i {
            font-size: 16px;
            transition: transform 0.3s;
        }

        .btn-login:hover i {
            transform: translateX(4px);
        }

        .register-section {
            text-align: center;
            margin-top: 20px;
            color: #adb5bd;
            font-size: 13px;
            font-weight: 400;
        }

        .register-section a {
            color: #0a1628;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .register-section a:hover {
            color: #f7c948;
            text-decoration: underline;
        }

        .login-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #e9ecef;
        }

        .login-footer .brand {
            color: #0a1628;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .login-footer .brand i {
            color: #f7c948;
            margin: 0 4px;
        }

        .login-footer .tagline {
            color: #adb5bd;
            font-size: 11px;
            font-weight: 300;
            margin-top: 4px;
        }

        .login-footer .copyright {
            color: #ced4da;
            font-size: 10px;
            font-weight: 300;
            margin-top: 6px;
        }

        .alert-custom {
            background: rgba(220, 53, 69, 0.08);
            border: 1px solid rgba(220, 53, 69, 0.15);
            color: #dc3545;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 12px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-success-custom {
            background: rgba(40, 167, 69, 0.08);
            border: 1px solid rgba(40, 167, 69, 0.15);
            color: #28a745;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 12px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px 25px;
                border-radius: 16px;
            }
            .login-header h1 {
                font-size: 14px;
            }
            .login-header .logo-wrapper {
                width: 60px;
                height: 60px;
            }
            .login-header .logo-wrapper i {
                font-size: 28px;
            }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-card {
            animation: fadeInUp 0.7s ease-out;
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <div class="stars"></div>
        <div class="stars-twinkle"></div>

        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <div class="logo-wrapper">
                        <i class="fas fa-star"></i>
                    </div>
                    <h1>Cinépolis <span>★</span></h1>
                    <p style="color: #0a1628; font-size: 13px; font-weight: 600; margin-top: -4px;">SPK Star of the Month</p>
                    <p class="welcome">Selamat Datang di Portal SPK Star of the Month!</p>
                    <p class="login-text">Silakan Login untuk Melanjutkan.</p>
                    <div class="divider"></div>
                </div>

                @if(session('error'))
                    <div class="alert-custom">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert-success-custom">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-custom">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-group-custom">
                            <input type="text" name="username" placeholder="Masukkan Username Anda" value="{{ old('username') }}" required autofocus>
                            <i class="fas fa-user input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group-custom">
                            <input type="password" name="password" id="password" placeholder="Masukkan Kata Sandi Anda" required>
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            Ingat Saya
                        </label>
                        <a href="#" class="forgot-link">Lupa Password?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        LOGIN <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="register-section">
                    Lupa Password? <a href="#">Daftar Akun Baru</a>
                </div>

                <div class="login-footer">
                    <div class="brand">
                        Cinépolis <i class="fas fa-star"></i>
                    </div>
                    <div class="tagline">Hiburan Berkualitas untuk Semua</div>
                    <div class="copyright">© 2026 Cinépolis Indonesia | All Rights Reserved</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>