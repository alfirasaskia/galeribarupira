<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register - SMKN 4 Bogor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            padding: 30px 50px 35px 50px;
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
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .logo-container img {
            width: 55px;
            height: 55px;
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

        .form-title {
            display: none;
        }

        .form-subtitle {
            color: #666;
            font-size: 14px;
            margin: 0;
            text-align: center;
        }

        .admin-badge {
            display: block;
            text-align: center;
            background: linear-gradient(135deg, #1E40AF 0%, #3b82f6 100%);
            color: white;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            margin: 0 auto 15px auto;
            letter-spacing: 0.5px;
            width: fit-content;
        }

        .register-header {
            text-align: center;
            margin-bottom: 18px;
        }

        .register-header h1 {
            display: none;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
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
            padding: 12px 16px 12px 42px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
            outline: none;
            background: #f8f9fa;
            min-height: 45px;
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
            padding: 13px 45px;
            background: #1E40AF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
        }

        .btn-register:hover {
            background: #1e3a8a;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .btn-register:active {
            transform: translateY(0);
        }


        .alert {
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 13px;
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

        .login-link {
            text-align: center;
            margin-top: 18px;
            margin-bottom: 5px;
            color: #666;
            font-size: 13px;
        }

        .login-link a {
            color: #1E40AF;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
                overflow-y: auto;
            }

            .register-container {
                padding: 30px 20px;
                border-radius: 15px;
                max-width: 100%;
            }

            .register-header h1 {
                font-size: 24px;
            }

            .register-header p {
                font-size: 13px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                font-size: 13px;
                margin-bottom: 6px;
            }

            .form-control {
                padding: 10px 12px 10px 40px;
                font-size: 14px;
            }

            .input-group i {
                left: 12px;
                font-size: 14px;
            }

            .btn-register {
                padding: 12px;
                font-size: 15px;
            }

            .login-link {
                font-size: 13px;
            }

            .alert {
                padding: 10px 12px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 25px 15px;
            }

            .register-header h1 {
                font-size: 22px;
            }

            .register-header p {
                font-size: 12px;
            }

            .form-control {
                padding: 10px 10px 10px 38px;
                font-size: 13px;
            }

            .btn-register {
                padding: 11px;
                font-size: 14px;
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
            <span class="admin-badge">
                <i class="fas fa-shield-alt"></i> ADMIN REGISTRATION
            </span>
            <h1>Create Account</h1>
            <p>Register as Administrator</p>
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

        <form action="{{ route('admin.register.post') }}" method="POST" id="registerForm">
            @csrf
            
            <div class="form-group">
                <label for="nama">Full Name</label>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Enter your full name" value="{{ old('nama') }}" required>
                </div>
                <span class="error-message" id="nameError"></span>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-group">
                    <i class="fas fa-user-circle"></i>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" value="{{ old('username') }}" required>
                </div>
                <span class="error-message" id="usernameError"></span>
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
            Already have an admin account? <a href="{{ route('admin.login') }}">Login</a>
        </div>
    </div>

    <script>
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
    </script>
</body>
</html>

