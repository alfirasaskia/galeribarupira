<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - SMKN 4 Bogor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.4) 0%, rgba(96, 165, 250, 0.4) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            overflow: hidden;
            position: relative;
        }

        /* Decorative wave shapes on body background */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: rgba(96, 165, 250, 0.35);
            border-radius: 40% 60% 70% 30%;
            animation: wave 8s ease-in-out infinite;
            z-index: 0;
            filter: blur(40px);
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: rgba(147, 197, 253, 0.35);
            border-radius: 60% 40% 30% 70%;
            animation: wave 10s ease-in-out infinite reverse;
            z-index: 0;
            filter: blur(40px);
        }

        @keyframes wave {
            0%, 100% {
                transform: rotate(0deg) scale(1);
            }
            50% {
                transform: rotate(10deg) scale(1.1);
            }
        }

        /* Animated background particles */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            animation: float 15s infinite;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }

        .particle:nth-child(1) { width: 80px; height: 80px; left: 10%; animation-delay: 0s; animation-duration: 12s; }
        .particle:nth-child(2) { width: 60px; height: 60px; left: 70%; animation-delay: 2s; animation-duration: 15s; }
        .particle:nth-child(3) { width: 100px; height: 100px; left: 40%; animation-delay: 4s; animation-duration: 18s; }
        .particle:nth-child(4) { width: 50px; height: 50px; left: 80%; animation-delay: 1s; animation-duration: 14s; }
        .particle:nth-child(5) { width: 70px; height: 70px; left: 20%; animation-delay: 3s; animation-duration: 16s; }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 0.3; }
            90% { opacity: 0.3; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }

        .register-container {
            position: relative;
            z-index: 1;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 480px;
            padding: 40px 50px 45px 50px;
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .logo-container {
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .logo-container img {
            width: 65px;
            height: 65px;
            object-fit: contain;
        }

        .logo-text {
            text-align: left;
        }

        .logo-text h2 {
            font-size: 20px;
            font-weight: 800;
            color: #1E40AF;
            margin: 0;
            line-height: 1.2;
        }

        .logo-text p {
            font-size: 12px;
            color: #64748b;
            margin: 0;
            font-weight: 500;
        }

        .register-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .register-header h1 {
            display: none;
        }

        .register-header p {
            color: #666;
            font-size: 14px;
            margin: 0;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 16px;
            z-index: 1;
        }

        .toggle-password {
            position: absolute;
            right: 45px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            padding: 0;
            margin: 0;
            cursor: pointer;
            color: #666;
            font-size: 16px;
            z-index: 2;
            width: auto;
            height: auto;
        }

        .toggle-password:focus {
            outline: none;
        }

        #password,
        #password_confirmation {
            padding-right: 65px;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px 14px 45px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
            outline: none;
            background: #f8f9fa;
            min-height: 50px;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
            background: white;
        }

        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        .btn-register {
            width: 100%;
            padding: 15px 45px;
            background: #1E40AF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
        }

        .btn-register:hover {
            background: #1e3a8a;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            color: #999;
            font-size: 14px;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            margin-bottom: 5px;
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: #1E40AF;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-danger {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        .alert-success {
            background: #efe;
            color: #3c3;
            border: 1px solid #cfc;
        }

        /* Responsive Design for Tablet */
        @media (max-width: 768px) {
            body {
                padding: 15px;
                overflow-y: auto;
            }

            .register-container {
                padding: 35px 25px;
                border-radius: 15px;
                max-width: 100%;
            }

            .logo-container {
                margin-bottom: 20px;
                gap: 12px;
            }

            .logo-container img {
                width: 55px;
                height: 55px;
            }

            .logo-text h2 {
                font-size: 18px;
            }

            .logo-text p {
                font-size: 11px;
            }

            .register-header {
                margin-bottom: 20px;
            }

            .register-header h1 {
                font-size: 24px;
            }

            .register-header p {
                font-size: 13px;
            }

            .form-group {
                margin-bottom: 13px;
            }

            .form-group label {
                font-size: 13px;
                margin-bottom: 6px;
            }

            .form-control {
                padding: 12px 14px 12px 42px;
                font-size: 14px;
                min-height: 46px;
            }

            .input-group i {
                left: 12px;
                font-size: 14px;
            }

            .btn-register {
                padding: 13px;
                font-size: 15px;
                margin-top: 18px;
            }

            .login-link,
            .back-home {
                font-size: 13px;
            }

            .alert {
                padding: 10px 12px;
                font-size: 13px;
            }
        }

        /* Responsive Design for Mobile */
        @media (max-width: 600px) {
            body {
                padding: 12px;
                overflow-y: auto;
            }

            .register-container {
                padding: 28px 18px;
                border-radius: 14px;
                max-width: 100%;
            }

            .logo-container {
                margin-bottom: 18px;
                gap: 10px;
            }

            .logo-container img {
                width: 50px;
                height: 50px;
            }

            .logo-text h2 {
                font-size: 16px;
            }

            .logo-text p {
                font-size: 10px;
            }

            .register-header {
                margin-bottom: 18px;
            }

            .register-header h1 {
                font-size: 22px;
            }

            .register-header p {
                font-size: 12px;
            }

            .form-group {
                margin-bottom: 12px;
            }

            .form-group label {
                font-size: 12px;
                margin-bottom: 5px;
            }

            .form-control {
                padding: 11px 12px 11px 40px;
                font-size: 13px;
                min-height: 44px;
            }

            .input-group i {
                left: 11px;
                font-size: 13px;
            }

            .btn-register {
                padding: 12px;
                font-size: 14px;
                margin-top: 16px;
            }

            .login-link,
            .back-home {
                font-size: 12px;
                margin-top: 20px;
            }

            .alert {
                padding: 9px 11px;
                font-size: 12px;
                margin-bottom: 16px;
            }

            .divider {
                margin: 16px 0;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .register-container {
                padding: 24px 16px;
                border-radius: 13px;
            }

            .logo-container {
                margin-bottom: 16px;
                gap: 8px;
            }

            .logo-container img {
                width: 45px;
                height: 45px;
            }

            .logo-text h2 {
                font-size: 15px;
            }

            .logo-text p {
                font-size: 9px;
            }

            .register-header {
                margin-bottom: 16px;
            }

            .register-header h1 {
                font-size: 20px;
            }

            .register-header p {
                font-size: 11px;
            }

            .form-group {
                margin-bottom: 11px;
            }

            .form-group label {
                font-size: 11px;
                margin-bottom: 4px;
            }

            .form-control {
                padding: 10px 11px 10px 38px;
                font-size: 12px;
                min-height: 42px;
            }

            .input-group i {
                left: 10px;
                font-size: 12px;
            }

            .btn-register {
                padding: 11px;
                font-size: 13px;
                margin-top: 14px;
            }

            .login-link,
            .back-home {
                font-size: 11px;
                margin-top: 18px;
            }

            .alert {
                padding: 8px 10px;
                font-size: 11px;
                margin-bottom: 14px;
            }

            .divider {
                margin: 14px 0;
                font-size: 11px;
            }
        }

        /* Small Mobile */
        @media (max-width: 360px) {
            body {
                padding: 8px;
            }

            .register-container {
                padding: 20px 14px;
                border-radius: 12px;
            }

            .logo-container {
                margin-bottom: 14px;
                gap: 8px;
            }

            .logo-container img {
                width: 40px;
                height: 40px;
            }

            .logo-text h2 {
                font-size: 14px;
            }

            .logo-text p {
                font-size: 8px;
            }

            .register-header {
                margin-bottom: 14px;
            }

            .register-header h1 {
                font-size: 18px;
            }

            .register-header p {
                font-size: 10px;
            }

            .form-group {
                margin-bottom: 10px;
            }

            .form-group label {
                font-size: 10px;
                margin-bottom: 3px;
            }

            .form-control {
                padding: 9px 10px 9px 36px;
                font-size: 11px;
                min-height: 40px;
            }

            .input-group i {
                left: 9px;
                font-size: 11px;
            }

            .btn-register {
                padding: 10px;
                font-size: 12px;
                margin-top: 12px;
            }

            .login-link,
            .back-home {
                font-size: 10px;
                margin-top: 16px;
            }

            .alert {
                padding: 7px 9px;
                font-size: 10px;
                margin-bottom: 12px;
            }

            .divider {
                margin: 12px 0;
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Background Animation -->
    <div class="bg-animation">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Register Container -->
    <div class="register-container">
        <div class="logo-container">
            @php
                $primaryLogo = file_exists(public_path('uploads/logo.png')) ? 'uploads/logo.png' : 'images/logo.png';
            @endphp
            <img src="{{ asset($primaryLogo) }}" alt="SMKN 4 Bogor">
            <div class="logo-text">
                <h2>SMKN 4 BOGOR</h2>
                <p>Galeri Foto Sekolah</p>
            </div>
        </div>
        
        <div class="register-header">
            <h1>Create Account</h1>
            <p>Register to join our gallery</p>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST" id="registerForm">
            @csrf
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your full name" value="{{ old('name') }}" required>
                </div>
                <span class="error-message" id="nameError"></span>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                </div>
                <span class="error-message" id="emailError"></span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter password (min 6 characters)" required>
                    <button type="button" class="toggle-password" data-target="password" aria-label="Toggle password visibility">
                        <i class="fas fa-eye-slash"></i>
                    </button>
                </div>
                <span class="error-message" id="passwordError"></span>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter password" required>
                    <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Toggle confirm password visibility">
                        <i class="fas fa-eye-slash"></i>
                    </button>
                </div>
                <span class="error-message" id="confirmError"></span>
            </div>

            <button type="submit" class="btn-register">
                Sign Up
            </button>
        </form>

        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Form validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let isValid = true;
            
            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.classList.remove('show'));
            
            // Validate name
            const name = document.getElementById('name').value.trim();
            if (name.length < 3) {
                document.getElementById('nameError').textContent = 'Nama minimal 3 karakter';
                document.getElementById('nameError').classList.add('show');
                isValid = false;
            }
            
            // Validate email
            const email = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                document.getElementById('emailError').textContent = 'Format email tidak valid';
                document.getElementById('emailError').classList.add('show');
                isValid = false;
            }
            
            // Validate password
            const password = document.getElementById('password').value;
            if (password.length < 6) {
                document.getElementById('passwordError').textContent = 'Password minimal 6 karakter';
                document.getElementById('passwordError').classList.add('show');
                isValid = false;
            }
            
            // Validate password confirmation
            const passwordConfirm = document.getElementById('password_confirmation').value;
            if (password !== passwordConfirm) {
                document.getElementById('confirmError').textContent = 'Konfirmasi password tidak cocok';
                document.getElementById('confirmError').classList.add('show');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    text: 'Mohon periksa kembali form registrasi Anda',
                    confirmButtonColor: '#667eea'
                });
            }
        });

        // Toggle show/hide password fields
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButtons = document.querySelectorAll('.toggle-password');
            toggleButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    if (!input) return;

                    const icon = this.querySelector('i');
                    if (input.type === 'password') {
                        input.type = 'text';
                        if (icon) {
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        }
                    } else {
                        input.type = 'password';
                        if (icon) {
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        }
                    }
                });
            });
        });

        // Show success message if exists
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Registrasi Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#667eea'
        });
        @endif
    </script>
</body>
</html>
