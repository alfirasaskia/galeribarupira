<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMKN 4 Bogor</title>
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
            padding: 20px;
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

        .particle:nth-child(1) {
            width: 120px;
            height: 120px;
            left: 10%;
            animation-delay: 0s;
            animation-duration: 12s;
        }

        .particle:nth-child(2) {
            width: 90px;
            height: 90px;
            left: 70%;
            animation-delay: 2s;
            animation-duration: 15s;
        }

        .particle:nth-child(3) {
            width: 150px;
            height: 150px;
            left: 40%;
            animation-delay: 4s;
            animation-duration: 18s;
        }

        .particle:nth-child(4) {
            width: 80px;
            height: 80px;
            left: 80%;
            animation-delay: 1s;
            animation-duration: 14s;
        }

        .particle:nth-child(5) {
            width: 110px;
            height: 110px;
            left: 20%;
            animation-delay: 3s;
            animation-duration: 16s;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.6;
            }
            90% {
                opacity: 0.6;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container {
            width: 100%;
            padding: 50px 50px 60px 50px;
        }

        form {
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0;
            height: 100%;
            text-align: center;
        }

        .form-title {
            display: none;
        }

        .form-subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
            margin-top: 0;
        }

        .social-container {
            display: none;
        }

        .divider {
            margin: 15px 0;
            color: #999;
            font-size: 13px;
        }

        .input-wrapper {
            position: relative;
            margin: 12px 0;
            width: 100%;
        }

        .input-label {
            display: none;
        }

        .input-wrapper i {
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

        #loginPassword {
            padding-right: 65px;
        }

        input {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            padding: 18px 20px 18px 45px;
            margin: 0;
            width: 100%;
            max-width: 100%;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
            min-height: 56px;
        }

        input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
        }

        button {
            border-radius: 8px;
            border: none;
            background: #1E40AF;
            color: white;
            font-size: 16px;
            font-weight: 600;
            padding: 18px 45px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.3s;
            cursor: pointer;
            margin-top: 30px;
            width: 100%;
            max-width: 100%;
        }

        button:hover {
            background: #1e3a8a;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        button:active {
            transform: scale(0.95);
        }

        button.ghost {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        button.ghost:hover {
            background: white;
            color: #2563eb;
        }

        .overlay-panel h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .overlay-panel p {
            font-size: 16px;
            font-weight: 400;
            line-height: 1.6;
            margin-bottom: 30px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .signup-link {
            color: #666;
            font-size: 14px;
            margin-top: 30px;
            margin-bottom: 10px;
            text-align: center;
        }

        .signup-link a {
            color: #1E40AF;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }


        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            width: 100%;
            font-size: 14px;
        }

        .alert-danger {
            background: #fee;
            color: #c33;
            border-left: 4px solid #c33;
        }

        .alert-success {
            background: #efe;
            color: #3c3;
            border-left: 4px solid #3c3;
        }

        .logo-container {
            margin-bottom: 30px;
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

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .container {
                border-radius: 20px;
            }

            .form-container {
                padding: 30px 20px;
            }

            .form-title {
                font-size: 24px;
            }

            .logo-container img {
                width: 45px;
                height: 45px;
            }

            .logo-text h2 {
                font-size: 16px;
            }

            .logo-text p {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-animation">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="container">
        <!-- Sign In Form -->
        <div class="form-container">
            <form method="POST" action="{{ url('/login') }}" id="loginForm">
                @csrf
                <input type="hidden" name="intended_url" id="intendedUrl" value="">
                
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
                <h1 class="form-title">Welcome Back !</h1>
                <p class="form-subtitle">Login to like and comment photos</p>
                
                
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                
                <div class="input-wrapper">
                    <label class="input-label">Email or Username</label>
                    <div style="position: relative;">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Enter your Email or Username" required />
                    </div>
                </div>
                <div class="input-wrapper">
                    <label class="input-label">Password</label>
                    <div style="position: relative;">
                        <i class="fas fa-lock"></i>
                        <input id="loginPassword" type="password" name="password" placeholder="Enter Password" required />
                        <button type="button" class="toggle-password" data-target="loginPassword" aria-label="Toggle password visibility">
                            <i class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit">Login</button>
                
                <!-- Signup Link -->
                <div class="signup-link">
                    Don't have an account? <a href="{{ route('register') }}">Sign up</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Set intended URL from sessionStorage
        document.addEventListener('DOMContentLoaded', function() {
            const intendedUrl = sessionStorage.getItem('intended_url');
            if (intendedUrl) {
                document.getElementById('intendedUrl').value = intendedUrl;
                sessionStorage.removeItem('intended_url');
            }

            // Toggle show/hide password
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

        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        });
    </script>
</body>
</html>
