<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 4 BOGOR - Beranda</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/beranda-mobile-optimize.css') }}">
    <script src="https://www.google.com/recaptcha/api.js?render=6Ld0ffcrAAAAAOtioZEl4nY5fpoJB745yD7yZesv" async defer onerror="console.error('reCAPTCHA script failed to load'); window.grecaptchaLoadError = true;"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
        }
        
        body {
            position: relative;
        }
        
        /* Container responsive padding */
        @media (max-width: 1200px) {
            .container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .container {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        /* Navbar styling - transparan di hero, putih saat scroll */
        .navbar {
            background: transparent !important;
            box-shadow: none !important;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 80px;
        }
        
        /* Style for auth buttons */
        .auth-btn {
            padding: 0.4rem 1rem !important;
            font-size: 0.85rem !important;
            border-radius: 6px !important;
            transition: all 0.3s ease !important;
            font-weight: 500 !important;
            height: 36px;
            display: flex !important;
            align-items: center;
            justify-content: center;
        }
        
        .auth-btn i {
            font-size: 0.9rem !important;
            margin-right: 0.3rem;
        }
        
        .btn-outline-primary {
            border-color: rgba(255, 255, 255, 0.7) !important;
            color: white !important;
            background: transparent !important;
        }
        
        .btn-outline-primary:hover {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: white !important;
        }
        
        .btn-primary {
            background: rgba(255, 255, 255, 0.9) !important;
            color: #0d6efd !important;
            border: 1px solid rgba(255, 255, 255, 0.9) !important;
            transition: all 0.3s ease !important;
        }
        
        .btn-primary:hover {
            background: white !important;
            color: #0a58ca !important;
        }
        
        /* Scrolled state */
        .navbar.scrolled .btn-outline-primary {
            border-color: #0d6efd !important;
            color: #0d6efd !important;
            background: transparent !important;
        }
        
        .navbar.scrolled .btn-outline-primary:hover {
            background: rgba(13, 110, 253, 0.1) !important;
        }
        
        .navbar.scrolled .btn-primary {
            background: transparent !important;
            color: white !important;
            border-color: rgba(255, 255, 255, 0.7) !important;
            transition: all 0.3s ease !important;
        }
        
        .navbar.scrolled .btn-primary:hover {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: white !important;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        /* Container untuk mengatur spacing */
        .navbar .container {
            max-width: 1400px;
            margin: 0 auto;
            padding-left: 3rem;
            padding-right: 3rem;
        }
        
        @media (max-width: 768px) {
            .navbar .container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }
        
        @media (max-width: 480px) {
            .navbar .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.9);
            margin-right: 4rem;
            transition: all 0.3s ease;
        }

        .navbar-brand span {
            color: white !important;
        }

        .navbar.scrolled .navbar-brand {
            color: #1E40AF !important;
            text-shadow: none;
        }

        .navbar.scrolled .navbar-brand span {
            color: #1E40AF !important;
        }

        .navbar-brand img {
            height: 34px;
            width: 34px;
        }

        /* Navbar nav bergeser ke kanan */
        .navbar-nav {
            margin-left: auto !important;
            margin-right: 0 !important;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 400;
            margin: 0 0.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-size: 0.95rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.9);
            position: relative;
        }

        .navbar-nav .nav-item:last-child .nav-link {
            margin-right: 0.75rem;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            background: transparent;
        }

        .navbar-nav .nav-link.active {
            color: white !important;
            background: transparent;
            font-weight: 500;
        }

        .navbar-nav .nav-link i {
            font-size: 0.95rem;
            color: white !important;
            margin-right: 0.4rem;
        }

        .navbar.scrolled .navbar-nav .nav-link {
            color: #374151 !important;
            text-shadow: none;
        }

        .navbar.scrolled .navbar-nav .nav-link i {
            color: #374151 !important;
        }

        .navbar.scrolled .navbar-nav .nav-link:hover {
            color: #1E40AF !important;
        }

        .navbar.scrolled .navbar-nav .nav-link:hover i {
            color: #1E40AF !important;
        }

        .navbar.scrolled .navbar-nav .nav-link.active {
            color: #1E40AF !important;
        }

        .navbar.scrolled .navbar-nav .nav-link.active i {
            color: #1E40AF !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e40af, #1e3a8a) !important;
            border: 2px solid rgba(255, 255, 255, 0.3) !important;
            color: white !important;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            font-size: 0.9rem;
            border-radius: 8px;
            margin-left: 0.5rem;
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.25);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1e3a8a, #1e293b) !important;
            border-color: rgba(255, 255, 255, 0.5) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
            color: white !important;
        }

        .navbar.scrolled .btn-primary {
            background: linear-gradient(135deg, #1e40af, #1e3a8a) !important;
            border: 2px solid #1e40af !important;
            text-shadow: none;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.2);
        }

        .navbar.scrolled .btn-primary:hover {
            background: linear-gradient(135deg, #1e3a8a, #1e293b) !important;
            border-color: #1e3a8a !important;
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.3);
        }

        /* Profile Link Styles */
        .profile-link {
            cursor: pointer;
        }
        
        .profile-link:hover {
            background: #e5e7eb !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .profile-avatar-small {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 0.5rem;
            border: 2px solid #1E40AF;
        }

        /* Profile Dropdown Styles */
        .profile-dropdown {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            padding: 0.5rem 0;
            min-width: 200px;
            margin-top: 0.5rem;
        }

        .profile-dropdown .dropdown-item {
            padding: 0.75rem 1.25rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .profile-dropdown .dropdown-item i {
            font-size: 1rem;
            width: 20px;
        }

        .profile-dropdown .dropdown-item:hover {
            background: #f3f4f6;
            padding-left: 1.5rem;
        }

        .profile-dropdown .dropdown-item.text-danger:hover {
            background: #fee2e2;
            color: #dc2626 !important;
        }

        .profile-dropdown .dropdown-divider {
            margin: 0.5rem 0;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .navbar .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .navbar-brand {
                font-size: 1.3rem;
                margin-right: 1rem;
            }

            .navbar-nav {
                margin-top: 1rem;
            }

            .btn-primary {
                margin-left: 0;
                margin-top: 1rem;
                width: 100%;
            }

            /* Auth buttons responsive */
            .d-flex.align-items-center.gap-2 {
                width: 100%;
                flex-direction: column;
                gap: 0.75rem !important;
                margin-top: 1rem;
            }

            .auth-btn {
                width: 100%;
                padding: 0.5rem 1rem !important;
                font-size: 0.9rem !important;
            }

            .btn-outline-primary {
                width: 100%;
            }
        }

        /* Tablet responsive */
        @media (max-width: 768px) {
            .auth-btn {
                padding: 0.45rem 0.9rem !important;
                font-size: 0.8rem !important;
                height: 34px;
            }

            .auth-btn i {
                font-size: 0.8rem !important;
                margin-right: 0.25rem;
            }
        }

        /* Mobile responsive */
        @media (max-width: 480px) {
            .auth-btn {
                padding: 0.4rem 0.8rem !important;
                font-size: 0.75rem !important;
                height: 32px;
            }

            .auth-btn i {
                font-size: 0.75rem !important;
                margin-right: 0.2rem;
            }

            .d-flex.align-items-center.gap-2 {
                gap: 0.5rem !important;
            }
        }

        /* Small mobile responsive */
        @media (max-width: 360px) {
            .auth-btn {
                padding: 0.35rem 0.7rem !important;
                font-size: 0.7rem !important;
                height: 30px;
            }

            .auth-btn i {
                font-size: 0.65rem !important;
                margin-right: 0.15rem;
            }
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #e3f2fd;
            color: #0d6efd;
            transform: translateX(5px);
        }

        .hero-section {
            height: 100vh;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), 
                        url('{{ asset("images/smkn4-school.jpg") }}') center/cover no-repeat;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .hero-slide[data-bg] {
            background-image: url('');
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.22) 0%, rgba(13, 110, 253, 0.18) 100%);
            z-index: 1;
        }

        .slideshow-dots {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: white;
            transform: scale(1.2);
        }

        .dot:hover {
            background: rgba(255, 255, 255, 0.8);
        }



        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 100%;
            width: 100%;
            padding: 0;
            background: transparent;
            border-radius: 0;
            backdrop-filter: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
            letter-spacing: 2px;
            color: white;
            text-align: center;
            width: 100%;
            display: block;
            transition: opacity 0.5s ease-in-out;
        }

        .hero-title.fade-out,
        #heroDesc.fade-out {
            opacity: 0;
        }

        #heroDesc {
            transition: opacity 0.5s ease-in-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
                letter-spacing: 1px;
            }
            
            .hero-content p {
                font-size: 1.2rem !important;
                padding: 0 1rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
                letter-spacing: 0.5px;
            }
            
            .hero-content p {
                font-size: 1rem !important;
                padding: 0 1rem;
            }
        }

        /* News & Pengumuman Styles */
        .news-container {
            position: relative;
            overflow-x: scroll;
            overflow-y: hidden;
            margin-bottom: 3rem;
            background: transparent;
            border-radius: 0;
            padding: 0;
            border: none;
            box-shadow: none;
            scrollbar-width: none;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            width: 100%;
            max-width: 100%;
        }
        .news-container::-webkit-scrollbar { display: none; }
        
        /* Outer arrows (outside the white grid) */
        .news-outer-wrapper { 
            position: relative; 
            overflow: visible; 
            padding: 0 60px;
            margin: 0 auto;
            max-width: 100%;
            width: 100%;
        }
        
        @media (max-width: 768px) {
            .news-outer-wrapper {
                padding: 0 30px;
            }
        }
        
        @media (max-width: 480px) {
            .news-outer-wrapper {
                padding: 0 15px;
            }
        }
        .news-outer-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 54px;
            height: 54px;
            border-radius: 50%;
            border: none;
            background: linear-gradient(135deg, #1E40AF, #1e3a8a) !important;
            color: #fff !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.3);
            border: 2px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            cursor: pointer !important;
            z-index: 9999 !important;
            transition: all 0.3s ease;
            pointer-events: auto !important;
        }
        .news-outer-arrow.left { left: 0; }
        .news-outer-arrow.right { right: 0; }
        .news-outer-arrow i { font-size: 1.35rem; }
        .news-outer-arrow:hover { 
            transform: translateY(-50%) scale(1.1); 
            box-shadow: 0 12px 30px rgba(30, 64, 175, 0.5);
            background: linear-gradient(135deg, #1e3a8a, #1e293b);
        }
        .news-outer-arrow:active { transform: translateY(-50%) scale(0.95); }
        
        /* News Dots Indicator */
        .news-dots {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }
        
        .news-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #d1d5db;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .news-dot.active {
            background: linear-gradient(135deg, #1E40AF, #1e3a8a);
            width: 30px;
            border-radius: 5px;
            border-color: rgba(30, 64, 175, 0.2);
        }
        
        .news-dot:hover {
            background: #9ca3af;
            transform: scale(1.2);
        }
        
        .news-grid {
            display: flex;
            gap: 2rem;
            overflow: visible;
            padding: 0.5rem 1rem;
            scroll-behavior: smooth;
            position: relative;
            height: auto;
            cursor: grab;
            user-select: none;
            width: max-content;
            min-width: 100%;
        }
        
        /* Drag state */
        .news-grid.dragging {
            cursor: grabbing;
        }
        .news-grid.dragging .news-card { pointer-events: none; }
        
        /* Arrow controls removed per request */
        
        .news-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            height: 100%;
            width: 380px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            border: 1px solid #e8e8e8;
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        
        @media (max-width: 768px) {
            .news-card {
                width: 320px;
            }
            
            .news-outer-wrapper {
                padding: 0 45px;
                margin: 0 auto;
                width: 100%;
                max-width: 100%;
            }
            
            .news-container {
                width: 100%;
                max-width: 100%;
            }
            
            .news-outer-arrow {
                width: 44px;
                height: 44px;
            }
            
            .news-outer-arrow i {
                font-size: 1.1rem;
            }
        }
        
        @media (max-width: 600px) {
            .news-card {
                width: 290px;
            }
            
            .news-outer-wrapper {
                padding: 0 40px;
                margin: 0 auto;
                width: 100%;
                max-width: 100%;
            }
            
            .news-container {
                width: 100%;
                max-width: 100%;
            }
            
            .news-outer-arrow {
                width: 40px;
                height: 40px;
            }
            
            .news-outer-arrow i {
                font-size: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .news-card {
                width: 280px;
            }
            
            .news-image {
                height: 200px;
            }
            
            .news-title {
                font-size: 1rem;
            }
            
            .news-description {
                font-size: 0.8rem;
            }
            
            .news-outer-wrapper {
                padding: 0 40px;
                margin: 0 auto;
                width: 100%;
                max-width: 100%;
            }
            
            .news-container {
                width: 100%;
                max-width: 100%;
            }
            
            .news-outer-arrow {
                width: 36px;
                height: 36px;
            }

            .news-outer-arrow.left {
                left: 0;
            }

            .news-outer-arrow.right {
                right: 0;
            }
            
            .news-outer-arrow i {
                font-size: 0.95rem;
            }
        }
        
        @media (max-width: 380px) {
            .news-card {
                width: 260px;
            }
            
            .news-outer-wrapper {
                padding: 0 35px;
                margin: 0 auto;
                width: 100%;
                max-width: 100%;
            }
            
            .news-container {
                width: 100%;
                max-width: 100%;
            }
            
            .news-outer-arrow {
                width: 34px;
                height: 34px;
            }

            .news-outer-arrow.left {
                left: 0;
            }

            .news-outer-arrow.right {
                right: 0;
            }
            
            .news-outer-arrow i {
                font-size: 0.9rem;
            }
        }
        
        .news-card.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        
        .news-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            border-color: #0d6efd;
        }
        
        .news-image {
            position: relative;
            width: 100%;
            height: 280px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .news-image:hover { transform: scale(1.02); }
        
        .news-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .news-image:hover::after {
            opacity: 1;
        }
        
        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            -webkit-font-smoothing: antialiased;
            filter: none;
        }
        
        .news-card:hover .news-image img {
            transform: scale(1.1);
            transition: transform 0.6s ease;
        }
        
        .news-date-overlay {
            position: absolute;
            bottom: 14px;
            left: 14px;
            background: rgba(15, 23, 42, 0.85);
            color: #fff;
            padding: 10px 14px;
            border-radius: 8px;
            display: inline-flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 2px;
            transition: all 0.3s ease;
        }
        .news-date-overlay .day { font-size: 1.6rem; font-weight: 800; line-height: 1; color: #fbbf24; }
        .news-date-overlay .month { font-size: 0.85rem; font-weight: 600; opacity: .9; }

        .news-card:hover .news-date-overlay {
            transform: translateY(-4px);
            background: rgba(15, 23, 42, 0.95);
        }

        .news-logo {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #1E40AF 0%, #1e3a8a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.4);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform: scale(1);
            border: 3px solid white;
        }

        .news-card:hover .news-logo {
            transform: scale(1.15) rotate(10deg);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.5);
        }
        
        .news-content {
            padding: 1rem 1rem 0.5rem 1rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .news-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.6rem;
            color: #1a202c;
            line-height: 1.3;
        }
        
        .news-description {
            color: #4a5568;
            font-size: 0.85rem;
            line-height: 1.4;
            margin-bottom: 0.8rem;
            flex: 1;
        }
        
        .news-meta {
            padding: 0.8rem 1.2rem 1.2rem 1.2rem;
            margin-top: auto;
            border-top: none;
            position: relative;
            z-index: 10;
            pointer-events: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .read-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #1E40AF;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            padding: 0.5rem 0;
        }

        .read-more-btn i {
            transition: transform 0.3s ease;
        }

        .read-more-btn:hover {
            color: #1e3a8a;
            gap: 0.8rem;
        }

        .read-more-btn:hover i {
            transform: translateX(5px);
        }
        
        .news-categories {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-bottom: 0.5rem;
        }
        
        .news-category-tag {
            padding: 0.25rem 0.6rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            background: #1f6fd6;
            color: white;
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .news-card:hover .news-category-tag {
            transform: translateY(-2px);
            background: #0056b3;
            box-shadow: 0 4px 12px rgba(31, 111, 214, 0.3);
        }
        
        .news-tag {
            padding: 0.3rem 0.8rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            align-self: flex-start;
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .news-date {
            font-size: 0.8rem;
            color: #718096;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        
        .news-date::before {
            content: "📅";
            font-size: 0.8rem;
        }

        /* Scroll Animation Effects */
        .news-grid {
            animation: fadeInUp 0.8s ease-out;
        }

        .news-card {
            animation: slideInRight 0.6s ease-out;
            animation-fill-mode: both;
        }

        .news-card:nth-child(1) { animation-delay: 0.1s; }
        .news-card:nth-child(2) { animation-delay: 0.2s; }
        .news-card:nth-child(3) { animation-delay: 0.3s; }
        .news-card:nth-child(4) { animation-delay: 0.4s; }
        .news-card:nth-child(5) { animation-delay: 0.5s; }
        .news-card:nth-child(6) { animation-delay: 0.6s; }
        .news-card:nth-child(7) { animation-delay: 0.7s; }
        .news-card:nth-child(8) { animation-delay: 0.8s; }
        .news-card:nth-child(9) { animation-delay: 0.9s; }
        .news-card:nth-child(10) { animation-delay: 1.0s; }
        .news-card:nth-child(11) { animation-delay: 1.1s; }
        .news-card:nth-child(12) { animation-delay: 1.2s; }
        .news-card:nth-child(13) { animation-delay: 1.3s; }
        .news-card:nth-child(14) { animation-delay: 1.4s; }
        .news-card:nth-child(15) { animation-delay: 1.5s; }

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

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Smooth scroll with momentum */
        .news-grid {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        /* Gradient fade effect removed for transparent background */

        .hero-actions { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
        .btn-hero-primary {
            background: #0d6efd;
            color: #fff;
            border: none;
            padding: 0.8rem 1.4rem;
            border-radius: 10px;
            font-weight: 600;
        }
        .btn-hero-outline {
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255,255,255,0.85);
            padding: 0.75rem 1.3rem;
            border-radius: 10px;
            font-weight: 600;
        }
        .btn-hero-primary:hover { background: #0b5ed7; color: #fff; }
        .btn-hero-outline:hover { background: rgba(255,255,255,0.1); color: #fff; }

        .content-section {
            position: relative;
            z-index: 2;
            width: 100%;
            overflow-x: hidden;
        }
        
        /* Fix untuk semua section agar background tidak terpotong */
        section {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }
        
        .container {
            max-width: 1320px;
            padding-left: 2rem;
            padding-right: 2rem;
            margin-left: auto;
            margin-right: auto;
        }
        
        .row {
            margin-left: 0;
            margin-right: 0;
        }
        
        @media (max-width: 768px) {
            .row {
                margin-left: -12px;
                margin-right: -12px;
            }
            
            .row > * {
                padding-left: 12px;
                padding-right: 12px;
            }
        }

        /* About Intro Section */
        .about-intro-section {
            padding: 50px 0;
            background: #f6f9ff;
            position: relative;
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
        }

        .about-intro-section .container {
            position: relative;
            z-index: 1;
        }

        .about-content {
            padding-left: 2rem;
        }

        .about-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #1E40AF;
            margin-bottom: 1.2rem;
            line-height: 1.2;
        }
        
        @media (max-width: 768px) {
            .about-title {
                font-size: 1.8rem;
            }
            
            .about-intro-section {
                padding: 40px 0;
            }
        }
        
        @media (max-width: 480px) {
            .about-title {
                font-size: 1.75rem;
            }
            
            .about-intro-section {
                padding: 40px 0;
            }
            
            .about-card {
                padding: 1.5rem;
            }
        }

        .about-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(108, 155, 209, 0.15);
            border: 2px solid rgba(108, 155, 209, 0.2);
            transition: all 0.3s ease;
        }

        .about-card:hover {
            box-shadow: 0 12px 35px rgba(108, 155, 209, 0.25);
            transform: translateY(-5px);
        }

        .about-text {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #1a202c;
            margin-bottom: 1.25rem;
            text-align: justify;
        }

        .about-card .about-text:last-child {
            margin-bottom: 0;
        }

        .video-wrapper {
            position: relative;
        }

        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(108, 155, 209, 0.2);
            border: 3px solid rgba(108, 155, 209, 0.3);
            background: #000;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .video-caption {
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
            font-style: italic;
            margin-top: 1rem;
            line-height: 1.6;
        }

        @media (max-width: 991px) {
            .about-intro-section::before {
                display: none;
            }

            .about-content {
                padding-left: 0;
                margin-top: 2rem;
            }

            .about-title {
                font-size: 2rem;
            }

            .about-text {
                font-size: 1rem;
            }
        }

        .section-title {
            text-align: center;
            color: #1E40AF;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 0.75rem;
        }
        
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.8rem;
                margin-bottom: 1.5rem;
            }
        }
        
        @media (max-width: 480px) {
            .section-title {
                font-size: 1.75rem;
                margin-bottom: 1.5rem;
            }
        }

        .jurusan-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 1.75rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            height: 100%;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border: 1px solid #e5e7eb;
            position: relative;
            overflow: visible;
            min-height: 420px;
        }

        .jurusan-card::before {
            display: none;
        }

        @media (max-width: 768px) {
            .jurusan-card { 
                min-height: 350px; 
                padding: 1.5rem; 
            }
        }

        .jurusan-card .detail-btn { 
            margin-top: auto; 
            width: 100%;
        }

        .jurusan-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(30, 64, 175, 0.15);
            border-color: #1E40AF;
        }

        .jurusan-icon {
            font-size: 3rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }

        /* Jurusan Section Styling */
        .jurusan-section {
            background: #f6f9ff;
            padding: 80px 0;
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }
        
        @media (max-width: 768px) {
            .jurusan-section {
                padding: 60px 0;
            }
        }
        
        @media (max-width: 480px) {
            .jurusan-section {
                padding: 40px 0;
            }
        }

        .jurusan-image-container {
            margin-bottom: 1rem;
        }

        .jurusan-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .jurusan-image-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 110px;
            margin: 0;
            position: relative;
        }

        .jurusan-image-container::before {
            display: none;
        }

        .jurusan-logo {
            width: 110px;
            height: 110px;
            border-radius: 12px;
            object-fit: cover;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .jurusan-card:hover .jurusan-logo {
            transform: scale(1.08);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .jurusan-title {
            color: #1a202c;
            font-size: 1.65rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .jurusan-card:hover .jurusan-title {
            color: #0d6efd;
            transform: translateY(-3px);
        }

        .jurusan-description {
            color: #6c757d;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            font-weight: 400;
            text-align: center;
            transition: all 0.3s ease;
        }

        .jurusan-card:hover .jurusan-description {
            color: #495057;
        }

        .jurusan-card h4 { 
            text-align: left; 
            font-size: 1.35rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }
        
        .jurusan-card p.text-muted { 
            text-align: left;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            color: #6c757d;
            line-height: 1.5;
        }
        
        .jurusan-badge {
            display: inline-block;
            background: #dbeafe;
            color: #1E40AF;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            border: 1px solid #93c5fd;
            margin-top: 0.5rem;
            text-transform: uppercase;
        }
        
        .jurusan-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 1rem;
            font-size: 0.85rem;
            color: #6b7280;
        }
        
        .jurusan-meta-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            white-space: nowrap;
        }
        
        .jurusan-meta-item i {
            font-size: 1rem;
            color: #1E40AF;
        }

        .jurusan-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: flex-start;
            margin-bottom: 1rem;
        }

        .feature-tag {
            background: #e8f2ff;
            color: #1E40AF;
            padding: 0.25rem 0.65rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid #d1e3f8;
            position: relative;
            overflow: hidden;
        }

        .feature-tag::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .feature-tag:hover::before {
            left: 100%;
        }

        .feature-tag:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 15px rgba(13, 110, 253, 0.4);
        }

        .detail-btn {
            background: #1E40AF;
            color: white;
            border: 1px solid #1E40AF;
            padding: 0.65rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: none;
            width: 100%;
        }

        .detail-btn::before {
            display: none;
        }

        .detail-btn::after {
            display: none;
        }

        .detail-btn:hover {
            background: #1e3a8a;
            color: white;
            border-color: #1e3a8a;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.3);
        }

        .detail-btn:active {
            transform: translateY(0);
        }

        .detail-btn {
            animation: btnPulse 2s ease-in-out infinite;
        }

        .detail-btn:hover {
            animation: none;
        }

        /* Memastikan tombol terlihat */
        .jurusan-content .detail-btn {
            position: relative;
            z-index: 10;
            opacity: 1;
            visibility: visible;
        }

        /* Pusatkan tombol Lihat Detail di dalam kartu jurusan */
        .jurusan-card .detail-btn {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
            color: white;
            border-radius: 20px 20px 0 0;
            border-bottom: none;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .modal-jurusan-logo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .jurusan-detail-content {
            max-height: 500px;
            overflow-y: auto;
        }
        
        .jurusan-detail-modern {
            max-height: 600px;
            overflow-y: auto;
        }
        
        .jurusan-detail-modern .nav-tabs {
            border-bottom: none;
            gap: 8px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        
        .jurusan-detail-modern .nav-tabs .nav-link {
            color: #64748b;
            border: 2px solid #e2e8f0;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            padding: 12px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border-radius: 12px;
            margin-right: 8px;
            white-space: nowrap;
        }
        
        .jurusan-detail-modern .nav-tabs .nav-link:hover {
            color: #1E40AF;
            border-color: #3b82f6;
            background: linear-gradient(135deg, #dbeafe 0%, #e0f2fe 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59,130,246,0.2);
        }
        
        .jurusan-detail-modern .nav-tabs .nav-link.active {
            color: #ffffff;
            background: linear-gradient(135deg, #1E40AF 0%, #3b82f6 100%);
            border-color: #1E40AF;
            box-shadow: 0 6px 16px rgba(30,64,175,0.3);
        }
        
        .jurusan-detail-modern .tab-content {
            padding: 20px;
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            border-radius: 12px;
            border: 2px solid #e2e8f0;
        }

        /* Responsive Media Queries untuk Modal Jurusan */
        @media (max-width: 768px) {
            .modal-content {
                border-radius: 16px;
            }

            .modal-header {
                padding: 1.5rem;
            }

            .modal-body {
                padding: 1.5rem;
            }

            .modal-jurusan-logo {
                width: 120px;
                height: 120px;
            }

            .jurusan-detail-modern {
                max-height: 500px;
            }

            .jurusan-detail-modern .nav-tabs {
                gap: 6px;
                margin-bottom: 16px;
            }

            .jurusan-detail-modern .nav-tabs .nav-link {
                padding: 10px 16px;
                font-size: 0.85rem;
                margin-right: 4px;
            }

            .jurusan-detail-modern .tab-content {
                padding: 16px;
            }

            .detail-list li {
                padding: 10px 14px;
                padding-left: 44px;
                font-size: 0.9rem;
                margin-bottom: 8px;
            }

            .detail-list li::before {
                width: 22px;
                height: 22px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .modal-content {
                border-radius: 12px;
                margin: 1rem;
            }

            .modal-header {
                padding: 1.25rem;
                flex-direction: column;
                align-items: flex-start;
            }

            .modal-header .btn-close {
                position: absolute;
                top: 1rem;
                right: 1rem;
            }

            .modal-body {
                padding: 1.25rem;
            }

            .modal-jurusan-logo {
                width: 100px;
                height: 100px;
                margin-bottom: 1rem;
            }

            .modal-title {
                font-size: 1.1rem !important;
                margin-bottom: 0.5rem;
            }

            .jurusan-detail-modern {
                max-height: 450px;
            }

            .jurusan-detail-modern .nav-tabs {
                gap: 4px;
                margin-bottom: 12px;
            }

            .jurusan-detail-modern .nav-tabs .nav-link {
                padding: 8px 12px;
                font-size: 0.75rem;
                margin-right: 2px;
                flex: 1;
                text-align: center;
                min-width: 0;
            }

            .jurusan-detail-modern .tab-content {
                padding: 12px;
            }

            .jurusan-detail-modern h5 {
                font-size: 0.95rem;
                margin-bottom: 12px;
            }

            .detail-list li {
                padding: 8px 12px;
                padding-left: 40px;
                font-size: 0.85rem;
                margin-bottom: 6px;
            }

            .detail-list li::before {
                width: 20px;
                height: 20px;
                font-size: 11px;
                left: 12px;
            }

            .jurusan-detail-modern .alert {
                padding: 12px;
                margin-top: 12px;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 360px) {
            .modal-content {
                margin: 0.5rem;
            }

            .modal-header {
                padding: 1rem;
            }

            .modal-body {
                padding: 1rem;
            }

            .modal-jurusan-logo {
                width: 80px;
                height: 80px;
            }

            .modal-title {
                font-size: 1rem !important;
            }

            .jurusan-detail-modern .nav-tabs .nav-link {
                padding: 6px 8px;
                font-size: 0.7rem;
            }

            .jurusan-detail-modern .tab-content {
                padding: 10px;
            }

            .detail-list li {
                padding: 6px 10px;
                padding-left: 36px;
                font-size: 0.8rem;
            }

            .detail-list li::before {
                width: 18px;
                height: 18px;
                font-size: 10px;
                left: 10px;
            }
        }
        
        .jurusan-detail-modern h5 {
            color: #1E40AF;
            font-weight: 700;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e0f2fe;
        }
        
        .jurusan-detail-modern .alert {
            border-radius: 12px;
            border: 2px solid;
            padding: 16px;
            margin-top: 16px;
        }
        
        .jurusan-detail-modern .alert-info {
            background: linear-gradient(135deg, #dbeafe 0%, #e0f2fe 100%);
            border-color: #3b82f6;
            color: #1e40af;
        }
        
        .jurusan-detail-modern .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border-color: #10b981;
            color: #065f46;
        }
        
        .detail-list {
            list-style: none;
            padding-left: 0;
        }
        
        .detail-list li {
            padding: 12px 16px;
            padding-left: 48px;
            position: relative;
            line-height: 1.7;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 10px;
            border-left: 4px solid #3b82f6;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
            color: #334155;
            font-weight: 500;
        }
        
        .detail-list li:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(59,130,246,0.15);
            border-left-color: #1E40AF;
        }
        
        .detail-list li::before {
            content: '✓';
            position: absolute;
            left: 16px;
            color: #ffffff;
            font-weight: bold;
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(59,130,246,0.3);
        }

        .detail-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 15px;
            border-left: 4px solid #0d6efd;
        }

        .detail-section h5 {
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .detail-section ul {
            margin-bottom: 0;
            padding-left: 1.2rem;
        }

        .detail-section li {
            margin-bottom: 0.5rem;
            color: #495057;
            font-weight: 500;
        }

        .tech-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .tech-tag {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .tech-tag:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
            padding: 1.5rem;
        }

        .modal-footer .btn {
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .modal-footer .btn:hover {
            transform: translateY(-2px);
        }

        /* Prestasi & Penghargaan Styles */
        .prestasi-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            height: 100%;
        }

        .prestasi-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .prestasi-image {
            position: relative;
            width: 100%;
            height: 250px;
            overflow: hidden;
        }

        .prestasi-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .prestasi-card:hover .prestasi-image img {
            transform: scale(1.05);
        }

        .prestasi-date {
            position: absolute;
            bottom: 15px;
            left: 15px;
            background: rgba(17, 24, 39, 0.95);
            color: #fff;
            border-radius: 12px;
            padding: 0.45rem 0.6rem;
            text-align: center;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
            min-width: 52px;
        }

        .date-day {
            display: block;
            font-size: 1.05rem;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }

        .date-month {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            color: #d1d5db;
            text-transform: uppercase;
            line-height: 1;
        }

        .date-year {
            display: block;
            font-size: 0.65rem;
            font-weight: 600;
            color: #9ca3af;
            line-height: 1;
        }

        .prestasi-content {
            padding: 1.5rem;
        }

        .prestasi-content h5 {
            color: #1e293b;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .prestasi-content p {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .prestasi-tags {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .prestasi-tags .tag {
            background: linear-gradient(135deg, #1f6fd6, #0056b3);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Map Styling */
        .map-wrapper {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .map-overlay {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
            max-width: 300px;
        }

        .map-info-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .map-info-card h5 {
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .map-info-card p {
            font-size: 0.9rem;
            line-height: 1.4;
            margin-bottom: 1rem;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .contact-info .info-item {
            display: flex;
            align-items: center;
            font-size: 0.85rem;
            padding: 0.5rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .contact-info .info-item:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateX(5px);
        }

        .contact-info .info-item i {
            margin-right: 0.75rem;
            font-size: 1rem;
            min-width: 1rem;
        }

        /* Responsive Design untuk Jurusan */
        @media (max-width: 768px) {
            .jurusan-section {
                padding: 60px 0;
            }
            
            .jurusan-logo {
                width: 100px;
                height: 100px;
            }
            
            .jurusan-title {
                font-size: 1.3rem;
            }
            
            .jurusan-description {
                font-size: 0.85rem;
            }
        }

        /* Responsive Design untuk Peta */
        @media (max-width: 768px) {
            .map-overlay {
                position: relative;
                top: 0;
                left: 0;
                max-width: 100%;
                margin-top: 1rem;
            }
            
            .map-info-card {
                background: white;
                backdrop-filter: none;
            }
            
            .contact-info .info-item {
                font-size: 0.9rem;
                padding: 0.75rem;
            }
        }

        /* Koleksi Galeri Terbaru Section */
        .gallery-collection-section {
            background: #f8fafc;
            padding: 40px 0;
            /* Optimize rendering */
            transform: translate3d(0, 0, 0);
            -webkit-transform: translate3d(0, 0, 0);
        }
        
        .gallery-section-subtitle {
            text-align: center;
            color: #475569;
            font-size: 1rem;
            margin-top: 0.5rem;
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .gallery-grid-container {
            position: relative;
            overflow: visible;
            margin-bottom: 0;
            width: 100%;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            padding: 2rem 0;
        }
        
        .swiper {
            width: 100%;
            padding: 40px 0;
        }
        
        .swiper-slide {
            width: 240px;
            height: 400px;
            transform-style: preserve-3d;
            backface-visibility: hidden;
            will-change: transform;
            /* Hardware acceleration - OPTIMIZED */
            transform: translate3d(0, 0, 0);
            -webkit-transform: translate3d(0, 0, 0);
            -webkit-backface-visibility: hidden;
            -webkit-perspective: 1000px;
        }
        
        .gallerySwiper {
            overflow: visible;
            transform: translate3d(0, 0, 0);
        }
        
        .gallerySwiper .swiper-wrapper {
            align-items: center;
            transform-style: preserve-3d;
        }

        .gallery-card {
            position: relative;
            border-radius: 32px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            height: 100%;
            width: 100%;
            background: white;
            transform: translate3d(0, 0, 0) scale(1);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            -webkit-transform: translate3d(0, 0, 0);
            border: none;
            /* Optimize rendering */
            contain: layout style paint;
            will-change: transform;
        }

        .swiper-slide-active .gallery-card {
            box-shadow: 0 30px 80px rgba(30, 64, 175, 0.4), 0 0 0 4px rgba(30, 64, 175, 0.2);
            transform: translate3d(0, 0, 0) scale(1.05);
            border-color: rgba(30, 64, 175, 0.3);
        }
        

        .gallery-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), filter 0.4s ease;
            border-radius: 32px;
            filter: brightness(0.95);
            /* Hardware acceleration */
            transform: translate3d(0, 0, 0) scale(1);
            -webkit-transform: translate3d(0, 0, 0) scale(1);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            will-change: transform, filter;
        }
        
        .swiper-slide-active .gallery-card-image {
            filter: brightness(1);
        }
        
        .gallery-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e5e7eb;
            color: #9ca3af;
            font-size: 2.5rem;
        }

        .gallery-card:hover .gallery-card-image {
            transform: translate3d(0, 0, 0) scale(1.1);
        }
        
        .swiper-slide-active .gallery-card:hover .gallery-card-image {
            transform: translate3d(0, 0, 0) scale(1.15);
        }

        .gallery-card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.4) 60%, transparent 100%);
            padding: 1.25rem 1.25rem;
            color: white;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0 0 32px 32px;
        }
        
        .swiper-slide-active .gallery-card-overlay {
            background: linear-gradient(to top, rgba(30, 64, 175, 0.9) 0%, rgba(59, 130, 246, 0.6) 60%, transparent 100%);
        }
        
        .gallery-card:hover .gallery-card-overlay {
            background: linear-gradient(to top, rgba(30, 64, 175, 0.95) 0%, rgba(59, 130, 246, 0.7) 60%, transparent 100%);
            padding-bottom: 2rem;
        }

        .gallery-card-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.8);
            line-height: 1.3;
            letter-spacing: 0.3px;
        }
        
        .swiper-slide-active .gallery-card-title {
            font-size: 1.15rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.9);
        }

        .gallery-card-meta {
            font-size: 0.85rem;
            opacity: 0.95;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        
        .gallery-card-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.95), rgba(59, 130, 246, 0.95));
            color: white;
            padding: 0.4rem 0.85rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            backdrop-filter: blur(15px);
            z-index: 10;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .swiper-slide-active .gallery-card-badge {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.6);
        }

        /* Gallery Navigation Arrows */
        .gallery-swiper-button-prev,
        .gallery-swiper-button-next {
            display: none !important;
        }
        
        .gallery-swiper-button-prev::after,
        .gallery-swiper-button-next::after {
            font-family: 'bootstrap-icons';
            font-size: 20px;
            font-weight: bold;
            color: #1E40AF;
            transition: all 0.3s ease;
        }
        
        .gallery-swiper-button-prev::after {
            content: '\F284';
            margin-right: 2px;
        }
        
        .gallery-swiper-button-next::after {
            content: '\F285';
            margin-left: 2px;
        }
        
        .gallery-swiper-button-prev {
            left: 20px;
        }
        
        .gallery-swiper-button-next {
            right: 20px;
        }
        
        .gallery-swiper-button-prev:hover,
        .gallery-swiper-button-next:hover {
            background: linear-gradient(135deg, #1E40AF, #3b82f6);
            transform: translateY(-50%) scale(1.15);
            box-shadow: 0 10px 40px rgba(30, 64, 175, 0.5), 0 4px 15px rgba(30, 64, 175, 0.3);
            border-color: rgba(255, 255, 255, 0.4);
        }
        
        .gallery-swiper-button-prev:hover::after,
        .gallery-swiper-button-next:hover::after {
            color: white;
            transform: scale(1.1);
        }
        
        .gallery-swiper-button-prev:active,
        .gallery-swiper-button-next:active {
            transform: translateY(-50%) scale(1.05);
        }
        
        .swiper-button-disabled {
            opacity: 0.3;
            cursor: not-allowed;
            pointer-events: none;
        }
        
        /* Pulse animation for arrows */
        @keyframes pulse-arrow {
            0%, 100% {
                box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2), 0 2px 8px rgba(0, 0, 0, 0.1);
            }
            50% {
                box-shadow: 0 8px 30px rgba(30, 64, 175, 0.3), 0 4px 12px rgba(30, 64, 175, 0.2);
            }
        }
        
        .gallery-swiper-button-prev,
        .gallery-swiper-button-next {
            animation: pulse-arrow 3s ease-in-out infinite;
        }

        /* Modal Styles */
        .gallery-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            overflow-y: auto;
            padding: 2rem;
        }

        .gallery-modal.active {
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }

        .gallery-modal-content {
            background: white;
            border-radius: 20px;
            max-width: 1400px;
            width: 100%;
            margin: 2rem auto;
            position: relative;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gallery-modal-header {
            padding: 2rem;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .gallery-modal-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a202c;
            margin: 0;
        }

        .gallery-modal-close {
            background: #f3f4f6;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .gallery-modal-close:hover {
            background: #e5e7eb;
            transform: rotate(90deg);
        }

        .gallery-modal-body {
            padding: 2rem;
        }

        .gallery-modal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .gallery-modal-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .gallery-modal-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .gallery-modal-item-image {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
        }

        .gallery-modal-item-info {
            padding: 0.75rem 1rem;
            background: white;
            text-align: center;
        }

        .gallery-modal-item-title {
            display: none;
        }

        .gallery-modal-item-date {
            font-size: 0.85rem;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .swiper-slide {
                width: 220px;
                height: 350px;
            }
        }
        
        @media (max-width: 768px) {
            .gallery-collection-section {
                padding: 35px 0;
            }
            
            .gallery-section-subtitle {
                font-size: 0.95rem;
                margin-bottom: 1.5rem;
            }
            
            .gallery-grid-container {
                padding: 1.5rem 0;
            }
            
            .swiper {
                padding: 40px 0;
            }
            
            .swiper-slide {
                width: 200px;
                height: 320px;
            }
            
            .gallery-card-title {
                font-size: 1.05rem;
            }
            
            .swiper-slide-active .gallery-card-title {
                font-size: 1.15rem;
            }

            .gallery-modal-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
            }

            .gallery-modal {
                padding: 1rem;
            }
            
            .gallery-swiper-button-prev,
            .gallery-swiper-button-next {
                width: 45px;
                height: 45px;
            }
            
            .gallery-swiper-button-prev::after,
            .gallery-swiper-button-next::after {
                font-size: 18px;
            }
            
            .gallery-swiper-button-prev {
                left: 15px;
            }
            
            .gallery-swiper-button-next {
                right: 15px;
            }
        }
        
        @media (max-width: 480px) {
            .swiper {
                padding: 40px 0;
            }
            
            .swiper-slide {
                width: 180px;
                height: 280px;
            }
            
            .gallery-card-badge {
                padding: 0.4rem 0.8rem;
                font-size: 0.75rem;
            }
            
            .gallery-card-title {
                font-size: 1rem;
            }
            
            .swiper-slide-active .gallery-card-title {
                font-size: 1.1rem;
            }
            
            .gallery-swiper-button-prev,
            .gallery-swiper-button-next {
                width: 40px;
                height: 40px;
            }
            
            .gallery-swiper-button-prev::after,
            .gallery-swiper-button-next::after {
                font-size: 16px;
            }
            
            .gallery-swiper-button-prev {
                left: 10px;
            }
            
            .gallery-swiper-button-next {
                right: 10px;
            }
        }

        /* Fasilitas Section Styling - Swiper Layout */
        .fasilitasSwiper {
            width: 100%;
            padding: 30px 0;
        }
        
        .fasilitas-slide {
            width: 150px;
            height: auto;
        }
        
        .fasilitas-item {
            text-align: center;
            transition: all 0.3s ease;
            padding: 0.75rem;
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fasilitas-slide:nth-child(1) .fasilitas-item { animation-delay: 0.1s; }
        .fasilitas-slide:nth-child(2) .fasilitas-item { animation-delay: 0.2s; }
        .fasilitas-slide:nth-child(3) .fasilitas-item { animation-delay: 0.3s; }
        .fasilitas-slide:nth-child(4) .fasilitas-item { animation-delay: 0.4s; }
        .fasilitas-slide:nth-child(5) .fasilitas-item { animation-delay: 0.5s; }
        .fasilitas-slide:nth-child(6) .fasilitas-item { animation-delay: 0.6s; }

        .fasilitas-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1E40AF 0%, #2563eb 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.2);
        }

        .fasilitas-item:hover .fasilitas-icon {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.3);
        }

        .fasilitas-icon i {
            font-size: 2.5rem;
            color: white !important;
            transition: all 0.3s ease;
        }

        .fasilitas-item:hover .fasilitas-icon i {
            transform: scale(1.1);
        }

        .fasilitas-item h5 {
            color: #1a202c;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .fasilitas-item:hover h5 {
            color: #1E40AF;
        }

        .fasilitas-item p {
            color: #6c757d;
            font-size: 0.85rem;
            line-height: 1.5;
            margin: 0;
        }

        /* Scroll Animation for Fasilitas */
        #fasilitas .fasilitas-item.sa-hidden {
            opacity: 0;
            transform: translateY(24px);
        }

        #fasilitas .fasilitas-item.sa-show {
            opacity: 1;
            transform: translateY(0);
            transition: transform 600ms ease, opacity 600ms ease;
        }

        /* Reusable scroll animation utility */
        .sa-hidden { opacity: 0; transform: translateY(24px); }
        .sa-show   { opacity: 1; transform: translateY(0); transition: transform 600ms ease, opacity 600ms ease; transition-delay: var(--stagger, 0ms); }

        .visi-misi-card {
            background: rgba(219, 234, 254, 0.4);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.75rem 1.5rem;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.1);
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid rgba(30, 64, 175, 0.2);
            position: relative;
            overflow: visible;
        }

        /* Puzzle notch - right side for left card */
        .visi-misi-card::before {
            content: '';
            position: absolute;
            top: 50%;
            right: -20px;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            z-index: 1;
        }

        /* Hide notch for right card */
        .col-md-6:last-child .visi-misi-card::before {
            display: none;
        }


        .visi-misi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.2);
        }

        .card-header-custom {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0;
            border-bottom: none;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }


        .card-header-custom i {
            font-size: 1.5rem;
            transition: all 0.3s ease;
            color: #1E40AF;
            margin-right: 0.5rem;
        }

        .visi-misi-card:hover .card-header-custom i {
            transform: scale(1.05);
        }

        .card-header-custom h4 {
            transition: all 0.3s ease;
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }


        .visi-misi-card ul {
            padding-left: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .visi-misi-card li {
            margin-bottom: 0.65rem;
            color: #6b7280;
            transition: all 0.3s ease;
            position: relative;
            padding-left: 0.5rem;
            font-size: 0.85rem;
            line-height: 1.5;
            font-weight: 400;
        }

        .visi-misi-card li::before {
            content: '•';
            position: absolute;
            left: -1.5rem;
            top: 0;
            color: #1E40AF;
            font-weight: 700;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }



        .visi-misi-card p {
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            line-height: 1.6;
            color: #6b7280;
            font-weight: 400;
        }



        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(1.1); opacity: 0; }
        }

        /* Tombol Selengkapnya Prestasi */
        .btn-outline-primary:hover {
            background: #0d6efd !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        /* Testimoni Cards */
        .testimoni-card {
            background: white;
            border-radius: 15px;
            padding: 1rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .testimoni-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(13, 110, 253, 0.2);
        }

        .testimoni-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .testimoni-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd, #6f42c1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
            font-size: 1.5rem;
        }

        .testimoni-info {
            flex: 1;
        }

        .testimoni-name {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 0.25rem;
            font-size: 1rem;
        }

        .testimoni-date {
            color: #64748b;
            font-size: 0.85rem;
        }

        .testimoni-content {
            margin-bottom: 1rem;
        }

        .testimoni-text {
            color: #374151;
            line-height: 1.6;
            font-style: italic;
            margin: 0;
            font-size: 0.95rem;
        }

        .testimoni-rating {
            display: flex;
            gap: 0.25rem;
        }

        .testimoni-rating i {
            font-size: 0.9rem;
        }

        /* Testimoni Slider Styles */
        .testimoni-wrapper {
            position: relative;
            padding: 0 60px;
            margin: 0 auto;
            width: 100%;
            max-width: 100%;
        }
        
        @media (max-width: 768px) {
            .testimoni-wrapper {
                padding: 0 30px;
            }
        }
        
        @media (max-width: 480px) {
            .testimoni-wrapper {
                padding: 0 15px;
            }
        }
        
        .testimoni-container {
            overflow-x: scroll;
            overflow-y: hidden;
            scrollbar-width: none;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            width: 100%;
            max-width: 100%;
        }
        
        .testimoni-container::-webkit-scrollbar {
            display: none;
        }
        
        .testimoni-grid {
            display: flex;
            gap: 2rem;
            width: max-content;
            min-width: 100%;
        }
        
        .testimoni-card-new {
            background: white;
            border-radius: 15px;
            padding: 1rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            width: 320px;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
            height: 100%;
        }
        
        .testimoni-card-new:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(13, 110, 253, 0.2);
        }
        
        .testimoni-quote-icon {
            display: none;
        }
        
        .testimoni-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .testimoni-text-new {
            color: #374151;
            line-height: 1.6;
            font-style: italic;
            margin: 0;
            font-size: 0.95rem;
        }
        
        .testimoni-avatar-new {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd, #6f42c1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        
        .testimoni-info-new {
            flex: 1;
        }
        
        .testimoni-name-new {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 0.25rem;
            font-size: 1rem;
        }
        
        .testimoni-date-new {
            color: #64748b;
            font-size: 0.85rem;
        }
        
        .testimoni-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            border: 2px solid #1E40AF;
            color: #1E40AF;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
            padding: 0;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2);
        }
        
        .testimoni-arrow.left {
            left: 10px;
        }
        
        .testimoni-arrow.right {
            right: 10px;
        }
        
        .testimoni-arrow:hover {
            background: #1E40AF;
            color: white;
            transform: translateY(-50%) scale(1.15);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
        }
        
        .testimoni-arrow:active {
            transform: translateY(-50%) scale(1.05);
        }

        /* Responsive Testimoni Slider */
        @media (max-width: 768px) {
            .testimoni-wrapper {
                padding: 0 50px;
                margin: 0 auto;
                width: 100%;
                max-width: 100%;
            }

            .testimoni-arrow {
                width: 44px;
                height: 44px;
                font-size: 1.3rem;
            }

            .testimoni-arrow.left {
                left: 5px;
            }

            .testimoni-arrow.right {
                right: 5px;
            }
        }

        @media (max-width: 480px) {
            .testimoni-wrapper {
                padding: 0 40px;
                margin: 0 auto;
                width: 100%;
                max-width: 100%;
            }

            .testimoni-arrow {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .testimoni-arrow.left {
                left: 0px;
            }

            .testimoni-arrow.right {
                right: 0px;
            }

            .testimoni-card-new {
                width: 280px;
            }
        }

        @media (max-width: 360px) {
            .testimoni-wrapper {
                padding: 0 35px;
                margin: 0 auto;
                width: 100%;
                max-width: 100%;
            }

            .testimoni-arrow {
                width: 36px;
                height: 36px;
                font-size: 1.1rem;
            }

            .testimoni-arrow.left {
                left: 0px;
            }

            .testimoni-arrow.right {
                right: 0px;
            }

            .testimoni-card-new {
                width: 260px;
            }
        }

        .map-container {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .map-placeholder {
            text-align: center;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 10px;
            border: 2px dashed #dee2e6;
        }

        .map-info {
            margin-top: 2rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .info-item i {
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .location-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        /* Hubungi Kami (Contact) */
        .contact-title {
            text-align: center;
            color: #1E40AF;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 3rem;
        }

        .contact-card {
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.08);
            border: 1px solid #e2e8f0;
        }

        .contact-card .card-body { padding: 1.25rem; }

        .map-card iframe { border-radius: 14px; }

        .contact-form .form-label { font-weight: 600; color: #334155; }
        .contact-form .form-control {
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            padding: 0.75rem 1rem;
        }
        .contact-form .form-control:focus {
            border-color: #1E40AF;
            box-shadow: 0 0 0 0.2rem rgba(30, 64, 175, 0.15);
        }
        .contact-submit {
            border-radius: 10px;
            font-weight: 700;
            padding: 0.8rem 1.2rem;
            background: linear-gradient(135deg, #1E40AF, #3b82f6) !important;
            border: none !important;
        }
        .contact-submit:hover {
            background: linear-gradient(135deg, #1e3a8a, #1E40AF) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }
        
        /* Hide reCAPTCHA v3 badge (allowed by Google if disclaimer is shown) */
        .grecaptcha-badge {
            visibility: hidden;
        }
        
        /* reCAPTCHA disclaimer text */
        .recaptcha-disclaimer {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.5rem;
            line-height: 1.4;
        }
        
        .recaptcha-disclaimer a {
            color: #1E40AF;
            text-decoration: none;
        }
        
        .recaptcha-disclaimer a:hover {
            text-decoration: underline;
        }
        
        /* reCAPTCHA styling */
        .g-recaptcha {
            display: inline-block;
            transform: scale(1);
            transform-origin: center center;
        }
        
        @media (max-width: 400px) {
            .g-recaptcha {
                transform: scale(0.85);
                transform-origin: 0 0;
            }
        }

        .contact-info-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 24px rgba(2, 6, 23, 0.06);
        }
        .info-item-contact {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem 1rem;
            transition: all 0.3s ease;
            height: 100%;
        }
        .info-item-contact:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: #3b82f6;
        }
        .info-item-contact .icon {
            width: 50px; height: 50px; border-radius: 12px;
            display: inline-flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 1.2rem;
            margin: 0 auto;
        }
        .icon-wrapper {
            display: flex;
            justify-content: center;
        }

        .location-card ul li {
            margin-bottom: 0.75rem;
            color: #6c757d;
        }

        .location-card ul li i {
            margin-right: 0.5rem;
        }

        .school-info p {
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .school-info i {
            width: 16px;
            text-align: center;
        }

        .school-motto p {
            font-size: 0.85rem;
            line-height: 1.3;
            font-style: italic;
        }

        .school-motto i {
            width: 16px;
            text-align: center;
        }

        /* Animation Classes */
        .animate-fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
        }

        .animate-slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            animation: slideInRight 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Info Card Styles */
        .info-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .card-icon i {
            color: white;
            font-size: 1.5rem;
        }

        .info-card h5 {
            color: #1f2937;
            font-weight: bold;
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
        }

        .info-card p {
            color: #6b7280;
            line-height: 1.5;
            margin-bottom: 1.2rem;
            font-size: 0.9rem;
        }

        .info-card .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .info-card .btn:hover {
            transform: translateY(-2px);
        }

        /* Announcement Section Styles */
        .announcement-container {
            position: relative;
        }

        .announcement-box {
            background: #ffd700;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
            border: 2px solid #ffed4e;
        }

        .announcement-icon {
            width: 50px;
            height: 50px;
            background: #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .announcement-icon i {
            color: white;
            font-size: 1.5rem;
        }

        .announcement-title {
            color: #000;
            font-weight: bold;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .announcement-content {
            height: 60px;
            overflow: hidden;
            position: relative;
        }

        .moving-text {
            animation: scrollUp 15s infinite linear;
        }

        .text-item {
            height: 60px;
            display: flex;
            align-items: center;
            font-weight: 600;
            color: #000;
            font-size: 1rem;
            padding: 0.5rem 0;
        }

        @keyframes scrollUp {
            0% { transform: translateY(0); }
            20% { transform: translateY(-60px); }
            40% { transform: translateY(-120px); }
            60% { transform: translateY(-180px); }
            80% { transform: translateY(-240px); }
            100% { transform: translateY(-300px); }
        }

        .document-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .document-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .document-logo {
            width: 60px;
            height: 60px;
            background: #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .document-logo i {
            color: white;
            font-size: 1.8rem;
        }

        .document-title h4 {
            color: #16a34a;
            font-weight: bold;
            margin-bottom: 0.2rem;
        }

        .document-title h5, .document-title h6 {
            color: #6b7280;
            margin-bottom: 0.1rem;
            font-size: 0.8rem;
        }

        .document-content h3 {
            color: #1f2937;
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .document-content h4 {
            color: #374151;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.3rem;
        }

        .document-content h5 {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .document-body p {
            font-size: 0.85rem;
            line-height: 1.4;
            margin-bottom: 0.8rem;
            color: #4b5563;
        }

        .document-signature {
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }

        .document-signature p {
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
            color: #6b7280;
        }

        .signature-block {
            text-align: center;
            margin-top: 1rem;
        }

        .signature-space {
            height: 40px;
            margin: 0.5rem 0;
        }

        .document-read-more {
            width: 100%;
            margin-top: 1rem;
            font-weight: 600;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.6rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .section-title {
                font-size: 2rem;
            }

            .announcement-container {
                margin-top: 2rem;
            }
            
            .document-header {
                flex-direction: column;
                text-align: center;
            }
            
            .document-logo {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .info-card {
                padding: 1.2rem;
                margin-bottom: 1rem;
            }

            .card-icon {
                width: 45px;
                height: 45px;
                margin-bottom: 0.8rem;
            }

            .card-icon i {
                font-size: 1.3rem;
            }

            .info-card h5 {
                font-size: 1rem;
                margin-bottom: 0.6rem;
            }

            .info-card p {
                font-size: 0.85rem;
                margin-bottom: 1rem;
            }
        }

        .read-more-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            color: #0d6efd;
            text-decoration: none;
            margin-top: 0.35rem;
            padding: 6px 10px;
            border-radius: 10px;
            background: rgba(13,110,253,0.08);
            position: relative;
            z-index: 999;
            cursor: pointer;
            transition: all 0.2s ease;
            pointer-events: auto;
        }
        .read-more-link i { font-size: 0.85rem; transition: transform .2s ease; }
        .read-more-link:hover { 
            color: #0b5ed7; 
            text-decoration: none; 
            background: rgba(13,110,253,0.12);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(13,110,253,0.2);
        }
        .read-more-link:hover i { transform: translateX(3px); }

        .news-title-link {
            transition: color 0.2s ease;
            position: relative;
            z-index: 5;
        }
        
        .news-title-link:hover {
            color: #0d6efd !important;
        }

        /* Bump animation on arrow click */
        @keyframes cardBump {
            0% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-8px) scale(1.01); }
            100% { transform: translateY(0) scale(1); }
        }
        .news-card.bump { animation: cardBump 280ms ease; }

        /* Rating Modal Styles */
        .rating-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .rating-modal-backdrop.show {
            display: flex;
        }

        .rating-modal-container {
            background: white;
            border-radius: 16px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
            text-align: center;
            pointer-events: auto;
            position: relative;
            z-index: 2001;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .rating-modal-icon {
            font-size: 3rem;
            color: #1E40AF;
            margin-bottom: 1rem;
        }

        .rating-modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .rating-modal-message {
            color: #666;
            margin-bottom: 2rem;
            font-size: 1rem;
            line-height: 1.6;
        }

        .rating-stars {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            pointer-events: auto;
            position: relative;
            z-index: 2001;
        }

        .rating-star {
            cursor: pointer !important;
            color: #ddd;
            transition: all 0.2s ease;
            pointer-events: auto !important;
            user-select: none;
            -webkit-user-select: none;
            display: inline-block;
            position: relative;
            z-index: 2001;
            padding: 5px;
            border: none !important;
            background: none !important;
            font-size: 2.5rem;
            line-height: 1;
            outline: none !important;
            box-shadow: none !important;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: auto;
            height: auto;
            min-width: auto;
            min-height: auto;
        }

        .rating-star:hover {
            color: #ffc107;
            transform: scale(1.2);
        }

        .rating-star.active {
            color: #ffc107;
        }

        .rating-star:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .rating-star:disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }

        .rating-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            pointer-events: auto;
            position: relative;
            z-index: 2001;
        }

        .rating-btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            pointer-events: auto;
            position: relative;
            z-index: 2001;
        }

        .rating-btn-submit {
            background: linear-gradient(135deg, #1E40AF, #3b82f6);
            color: white;
        }

        .rating-btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.3);
        }

        .rating-btn-skip {
            background: #f0f0f0;
            color: #333;
            border: 1px solid #e0e0e0;
        }

        .rating-btn-skip:hover {
            background: #e8e8e8;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('gallery.beranda') }}">
                <img src="{{ url('images/logo.png') }}" alt="SMK Negeri 4 Kota Bogor" class="me-2" style="height: 45px; width: auto;" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
                <i class="bi bi-mortarboard-fill me-2" style="color:#0d6efd; font-size: 2rem; display: none;"></i>
                <span style="color:#0d6efd; font-weight: bold; font-size: 1.8rem;">SMKN 4 BOGOR</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active" href="{{ route('gallery.beranda') }}">
                            <i class="bi bi-house text-primary me-2"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-mortarboard text-muted me-2"></i>Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="{{ route('gallery.profile') }}#sejarah"><i class="bi bi-book me-2"></i>Profile Singkat</a></li>
                            <li><a class="dropdown-item" href="#jurusan"><i class="bi bi-mortarboard me-2"></i>Jurusan</a></li>
                            <li><a class="dropdown-item" href="#fasilitas"><i class="bi bi-gear me-2"></i>Fasilitas Sekolah</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('gallery.galeri') }}">
                            <i class="bi bi-images text-muted me-2"></i>Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ url('/beranda#news') }}">
                            <i class="bi bi-newspaper text-muted me-2"></i>Informasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('gallery.agenda') }}">
                            <i class="bi bi-calendar text-muted me-2"></i>Agenda
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    @if(session('user_id') || session('admin_id'))
                        <!-- User sudah login -->
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center bg-light px-3 py-2 rounded-pill text-decoration-none profile-link dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="transition: all 0.3s ease;">
                                @php
                                    $currentUser = session('user_id') ? \DB::table('users')->where('id', session('user_id'))->first() : null;
                                    $hasPhoto = $currentUser && isset($currentUser->profile_photo) && !empty($currentUser->profile_photo);
                                @endphp
                                @if($hasPhoto)
                                    <img src="{{ asset('storage/' . $currentUser->profile_photo) }}" alt="{{ session('user_name') }}" class="profile-avatar-small">
                                @else
                                    <i class="bi bi-person-circle text-primary me-2" style="font-size: 1.2rem;"></i>
                                @endif
                                <span style="font-weight: 600; font-size: 0.9rem; color: #333;">
                                    {{ session('user_name') ?? session('admin_name') ?? 'User' }}
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end profile-dropdown" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ session('user_id') ? route('user.profile.show', session('user_id')) : '#' }}">
                                        <i class="bi bi-person me-2"></i>View Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.profile.edit') }}">
                                        <i class="bi bi-gear me-2"></i>Settings
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout.get') }}">
                                        <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <!-- User belum login -->
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('register') }}" class="btn btn-outline-primary auth-btn">
                                <i class="bi bi-person-plus"></i>Daftar
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-primary auth-btn">
                                <i class="bi bi-box-arrow-in-right"></i>Login
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="hero-section" data-images='["{{ asset('images/smkn-school.jpg') }}", "{{ asset('images/smkn-school-2.jpg') }}", "{{ asset('images/smkn-school-3.jpg') }}", "{{ asset('images/smkn-school-4.jpg') }}"]'>
        <!-- Slideshow Slides -->
        <div class="hero-slide active" data-bg="{{ asset('images/smkn-school.jpg') }}" 
             data-title="Selamat Datang di SMKN 4 Bogor" 
             data-desc="Mencetak Generasi Unggul, Berkarakter, dan Siap Bersaing di Era Digital"></div>
        <div class="hero-slide" data-bg="{{ asset('images/smkn-school-2.jpg') }}" 
             data-title="Fasilitas Lengkap & Modern" 
             data-desc="Didukung dengan Laboratorium, Workshop, dan Teknologi Terkini untuk Pembelajaran Optimal"></div>
        <div class="hero-slide" data-bg="{{ asset('images/smkn-school-3.jpg') }}" 
             data-title="Prestasi Membanggakan" 
             data-desc="Raih Prestasi di Tingkat Nasional dan Internasional Bersama Siswa-Siswi Berprestasi"></div>
        <div class="hero-slide" data-bg="{{ asset('images/smkn-school-4.jpg') }}" 
             data-title="Siap Kerja & Wirausaha" 
             data-desc="Program Pendidikan Vokasi yang Menghasilkan Lulusan Siap Kerja dan Berwirausaha"></div>
        
        <!-- Hero Content -->
        <div class="hero-content">
            <h1 class="hero-title" id="heroTitle">Selamat Datang di SMKN 4 Bogor</h1>
            <p id="heroDesc" style="font-size: 1.5rem; font-weight: 400; color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); max-width: 800px; margin: 0 auto; line-height: 1.8;">
                Mencetak Generasi Unggul, Berkarakter, dan Siap Bersaing di Era Digital
            </p>
        </div>
        
        <!-- Slideshow Indicators -->
        <div class="slideshow-dots">
            <div class="dot active" data-slide="0"></div>
            <div class="dot" data-slide="1"></div>
            <div class="dot" data-slide="2"></div>
            <div class="dot" data-slide="3"></div>
        </div>
    </section>

    <!-- Koleksi Galeri Terbaru Section -->
    <section class="gallery-collection-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-down">Koleksi Galeri Terbaru</h2>
            <p class="gallery-section-subtitle" data-aos="fade-up" data-aos-delay="100">Dokumentasi kegiatan dan momen berharga di SMKN 4 Bogor</p>
            
            <div class="gallery-grid-container" data-aos="zoom-in" data-aos-delay="200">
                <div class="swiper gallerySwiper">
                    <div class="swiper-wrapper">
                    @foreach(($galleryCategories instanceof \Illuminate\Support\Collection ? $galleryCategories->take(6) : collect($galleryCategories)->take(6)) as $category)
                    <div class="swiper-slide">
                <div class="gallery-card" onclick="openGalleryModal('{{ $category->id }}', '{{ $category->nama }}')">
                    @php
                        // Ambil foto pertama dari kategori ini
                        $firstPhoto = DB::table('foto')
                            ->where('kategori_id', $category->id)
                            ->orderBy('created_at', 'desc')
                            ->first();
                        
                        // Hitung jumlah foto dalam kategori
                        $photoCount = DB::table('foto')
                            ->where('kategori_id', $category->id)
                            ->count();
                    @endphp
                    
                    <span class="gallery-card-badge">{{ $photoCount }} Foto</span>
                    
                    @if($firstPhoto && isset($firstPhoto->file_path))
                        <img src="{{ asset('storage/' . $firstPhoto->file_path) }}" 
                             alt="{{ $category->nama }}" 
                             class="gallery-card-image"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="gallery-placeholder" style="display: none;">
                            <i class="bi bi-images"></i>
                        </div>
                    @else
                        <div class="gallery-placeholder">
                            <i class="bi bi-images"></i>
                        </div>
                    @endif
                    
                    <div class="gallery-card-overlay">
                        <div class="gallery-card-title">{{ $category->nama }}</div>
                        <div class="gallery-card-meta">
                            <i class="bi bi-calendar3"></i>
                            <span>{{ \Carbon\Carbon::parse($category->created_at)->format('d M Y') }}</span>
                        </div>
                    </div>
                    </div>
                    </div>
                    @endforeach
                    </div>
                    
                    <!-- Navigation Arrows -->
                    <div class="swiper-button-prev gallery-swiper-button-prev"></div>
                    <div class="swiper-button-next gallery-swiper-button-next"></div>
                </div>
            </div>
            
            <!-- View All Link -->
            <div class="text-center mt-5">
                <a href="{{ route('gallery.galeri') }}" style="color: #1E40AF; font-size: 1.1rem; font-weight: 600; text-decoration: none; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 0.5rem;" onmouseover="this.style.color='#1e3a8a'; this.style.gap='0.75rem';" onmouseout="this.style.color='#1E40AF'; this.style.gap='0.5rem';">
                    Lihat Semua Galeri <i class="bi bi-arrow-right" style="transition: all 0.3s ease;"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Gallery Modal -->
    <div id="galleryModal" class="gallery-modal">
        <div class="gallery-modal-content">
            <div class="gallery-modal-header">
                <h3 class="gallery-modal-title" id="modalCategoryTitle">Kategori Galeri</h3>
                <button class="gallery-modal-close" onclick="closeGalleryModal()">
                    <i class="bi bi-x" style="font-size: 1.5rem;"></i>
                </button>
            </div>
            <div class="gallery-modal-body">
                <div class="gallery-modal-grid" id="modalGalleryGrid">
                    <!-- Photos will be loaded here dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- Fasilitas Section -->
    <section id="fasilitas" class="content-section" style="background:#f6f9ff; padding: 40px 0;">
        <div class="container">
            <h2 class="section-title" data-aos="fade-down">Fasilitas Sekolah</h2>
            
            <div class="swiper fasilitasSwiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    <div class="swiper-slide fasilitas-slide">
                        <div class="fasilitas-item">
                            <div class="fasilitas-icon">
                                <i class="bi bi-laptop"></i>
                            </div>
                            <h5>Lab Komputer Modern</h5>
                            <p class="text-muted">Perangkat terbaru untuk praktik</p>
                        </div>
                    </div>
                    <div class="swiper-slide fasilitas-slide">
                        <div class="fasilitas-item">
                            <div class="fasilitas-icon">
                                <i class="bi bi-tools"></i>
                            </div>
                            <h5>Bengkel Praktik</h5>
                            <p class="text-muted">Peralatan industri terkini</p>
                        </div>
                    </div>
                    <div class="swiper-slide fasilitas-slide">
                        <div class="fasilitas-item">
                            <div class="fasilitas-icon">
                                <i class="bi bi-wifi"></i>
                            </div>
                            <h5>WiFi Gratis</h5>
                            <p class="text-muted">Internet untuk pembelajaran</p>
                        </div>
                    </div>
                    <div class="swiper-slide fasilitas-slide">
                        <div class="fasilitas-item">
                            <div class="fasilitas-icon">
                                <i class="bi bi-book"></i>
                            </div>
                            <h5>Perpustakaan</h5>
                            <p class="text-muted">Koleksi buku lengkap</p>
                        </div>
                    </div>
                    <div class="swiper-slide fasilitas-slide">
                        <div class="fasilitas-item">
                            <div class="fasilitas-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h5>Keamanan 24 Jam</h5>
                            <p class="text-muted">CCTV dan petugas</p>
                        </div>
                    </div>
                    <div class="swiper-slide fasilitas-slide">
                        <div class="fasilitas-item">
                            <div class="fasilitas-icon">
                                <i class="bi bi-trophy"></i>
                            </div>
                            <h5>Lapangan Olahraga</h5>
                            <p class="text-muted">Kegiatan olahraga</p>
                        </div>
                    </div>
                    <div class="swiper-slide fasilitas-slide">
                        <div class="fasilitas-item">
                            <div class="fasilitas-icon">
                                <i class="bi bi-cup-hot"></i>
                            </div>
                            <h5>Kantin Sehat</h5>
                            <p class="text-muted">Makanan bergizi dan bersih</p>
                        </div>
                    </div>
                    <div class="swiper-slide fasilitas-slide">
                        <div class="fasilitas-item">
                            <div class="fasilitas-icon">
                                <i class="bi bi-hospital"></i>
                            </div>
                            <h5>UKS</h5>
                            <p class="text-muted">Kesehatan siswa terjaga</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jurusan Section -->
    <section id="jurusan" class="content-section" style="background:#f6f9ff; padding: 40px 0;">
        <div class="container">
            <h2 class="section-title text-center mb-3" data-aos="fade-down">Jurusan</h2>
            
            <!-- Keterangan Jurusan -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="text-center" style="background: linear-gradient(135deg, #f0f7ff 0%, #e8f2ff 100%); padding: 1.25rem 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.1); border: 1px solid #d1e3f8;">
                        <p class="mb-0" style="color: #374151; font-size: 0.95rem; line-height: 1.6; font-weight: 500;">
                            <i class="bi bi-info-circle-fill me-2" style="color: #1E40AF; font-size: 1.1rem;"></i>
                            Semua jurusan <strong style="color: #1E40AF;">terakreditasi</strong> dengan fasilitas lengkap dan tenaga pengajar <strong style="color: #1E40AF;">profesional</strong>. 
                            Klik <strong style="color: #1E40AF;">"Lihat Detail"</strong> untuk info lengkap.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 mb-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="jurusan-card w-100">
                        <div class="d-flex mb-3">
                            <div class="jurusan-image-container">
                                <img src="{{ asset('images/jurusan/pplg-logo.jpg') }}" alt="PPLG Logo" class="jurusan-logo">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-1" style="margin-top: 0;">PPLG</h4>
                                <span style="display: inline-block; background: #dbeafe; color: #1E40AF; font-size: 0.7rem; font-weight: 600; padding: 0.25rem 0.5rem; border-radius: 4px; border: 1px solid #93c5fd; text-transform: uppercase;">Unggulan</span>
                            </div>
                        </div>
                        <p class="text-muted">Pengembangan Perangkat Lunak dan Gim</p>
                        <div class="jurusan-meta">
                            <div class="jurusan-meta-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>Bogor</span>
                            </div>
                            <div class="jurusan-meta-item">
                                <i class="bi bi-clock"></i>
                                <span>3 Tahun</span>
                            </div>
                        </div>
                        <div class="jurusan-features mb-3">
                            <span class="feature-tag">Programming</span>
                            <span class="feature-tag">Web Dev</span>
                        </div>
                        <button class="detail-btn mt-auto" onclick="showJurusanDetail('pplg')">
                            Lihat Detail
                        </button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="jurusan-card w-100">
                        <div class="d-flex mb-3">
                            <div class="jurusan-image-container">
                                <img src="{{ asset('images/jurusan/tjkt-logo.jpg') }}" alt="TJKT Logo" class="jurusan-logo">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-1" style="margin-top: 0;">TJKT</h4>
                                <span style="display: inline-block; background: #dbeafe; color: #1E40AF; font-size: 0.7rem; font-weight: 600; padding: 0.25rem 0.5rem; border-radius: 4px; border: 1px solid #93c5fd; text-transform: uppercase;">Unggulan</span>
                            </div>
                        </div>
                        <p class="text-muted">Teknik Jaringan Komputer dan Telekomunikasi</p>
                        <div class="jurusan-meta">
                            <div class="jurusan-meta-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>Bogor</span>
                            </div>
                            <div class="jurusan-meta-item">
                                <i class="bi bi-clock"></i>
                                <span>3 Tahun</span>
                            </div>
                        </div>
                        <div class="jurusan-features mb-3">
                            <span class="feature-tag">Networking</span>
                            <span class="feature-tag">Security</span>
                        </div>
                        <button class="detail-btn mt-auto" onclick="showJurusanDetail('tjkt')">
                            Lihat Detail
                        </button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="jurusan-card w-100">
                        <div class="d-flex mb-3">
                            <div class="jurusan-image-container">
                                <img src="{{ asset('images/jurusan/to-logo.jpg') }}" alt="TO Logo" class="jurusan-logo">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-1" style="margin-top: 0;">TO</h4>
                                <span style="display: inline-block; background: #dbeafe; color: #1E40AF; font-size: 0.7rem; font-weight: 600; padding: 0.25rem 0.5rem; border-radius: 4px; border: 1px solid #93c5fd; text-transform: uppercase;">Unggulan</span>
                            </div>
                        </div>
                        <p class="text-muted">Teknik Otomotif</p>
                        <div class="jurusan-meta">
                            <div class="jurusan-meta-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>Bogor</span>
                            </div>
                            <div class="jurusan-meta-item">
                                <i class="bi bi-clock"></i>
                                <span>3 Tahun</span>
                            </div>
                        </div>
                        <div class="jurusan-features mb-3">
                            <span class="feature-tag">Engine</span>
                            <span class="feature-tag">Maintenance</span>
                        </div>
                        <button class="detail-btn mt-auto" onclick="showJurusanDetail('to')">
                            Lihat Detail
                        </button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 d-flex" data-aos="fade-up" data-aos-delay="400">
                    <div class="jurusan-card w-100">
                        <div class="d-flex mb-3">
                            <div class="jurusan-image-container">
                                <img src="{{ asset('images/jurusan/tpfl-logo.jpg') }}" alt="TPFL Logo" class="jurusan-logo">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-1" style="margin-top: 0;">TPFL</h4>
                                <span style="display: inline-block; background: #dbeafe; color: #1E40AF; font-size: 0.7rem; font-weight: 600; padding: 0.25rem 0.5rem; border-radius: 4px; border: 1px solid #93c5fd; text-transform: uppercase;">Unggulan</span>
                            </div>
                        </div>
                        <p class="text-muted">Teknik Pengelasan Fabrikasi Logam</p>
                        <div class="jurusan-meta">
                            <div class="jurusan-meta-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>Bogor</span>
                            </div>
                            <div class="jurusan-meta-item">
                                <i class="bi bi-clock"></i>
                                <span>3 Tahun</span>
                            </div>
                        </div>
                        <div class="jurusan-features mb-3">
                            <span class="feature-tag">Welding</span>
                            <span class="feature-tag">Fabrication</span>
                        </div>
                        <button class="detail-btn mt-auto" onclick="showJurusanDetail('tpfl')">
                            Lihat Detail
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Berita & Pengumuman Section -->
    <section id="news" class="content-section" style="background: #ffffff; padding: 40px 0;">
        <div class="container">
            <h2 class="section-title" style="margin-bottom: 0.75rem;" data-aos="fade-down">Informasi Sekolah</h2>
            <p class="text-center text-muted mb-4" style="font-size: 1rem; font-weight: 500; color: #6b7280;" data-aos="fade-up" data-aos-delay="100">Berita dan Pengumuman Terbaru SMKN 4 Bogor</p>
            <div class="news-outer-wrapper" data-aos="fade-up" data-aos-delay="200">
                <button type="button" class="news-outer-arrow left" id="newsArrowLeft" aria-label="Sebelumnya" onclick="scrollNewsLeft(); return false;"><i class="bi bi-chevron-left"></i></button>
                <div class="news-container" id="newsContainer">
                    <div class="news-grid" id="newsGrid">
                        @if(isset($publishedNews) && $publishedNews->count())
                            @foreach($publishedNews as $item)
                                <div class="news-card">
                                    <div class="news-image" onclick="window.location.href='{{ url('/berita/'.$item->slug) }}'">
                                        <img src="{{ $item->image_path ? asset('storage/'.$item->image_path) : 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22250%22%3E%3Crect fill=%221f6fd6%22 width=%22400%22 height=%22250%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2224%22 fill=%22white%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22%3EPrestasi%3C/text%3E%3C/svg%3E' }}" alt="{{ $item->title }}" class="img-fluid">
                                        @php($dt = \Carbon\Carbon::parse($item->published_at ?? $item->created_at))
                                        <div class="news-date-overlay">{{ \Carbon\Carbon::parse($item->published_at ?? $item->created_at)->format('d M Y') }}</div>
                                        <div class="news-logo"><i class="bi {{ ($item->jenis ?? 'berita') === 'pengumuman' ? 'bi-megaphone' : 'bi-newspaper' }}"></i></div>
                                    </div>
                                    <div class="news-content">
                                        <h3 class="news-title"><a href="{{ url('/berita/'.$item->slug) }}" class="text-decoration-none text-reset news-title-link" onclick="event.preventDefault(); event.stopPropagation(); window.location.href='{{ url('/berita/'.$item->slug) }}'; return false;">{{ $item->title }}</a></h3>
                                        @if(!empty($item->excerpt))
                                            <p class="news-description">{{ \Illuminate\Support\Str::limit($item->excerpt, 160) }}</p>
                                        @endif
                                    </div>
                                    <div class="news-meta">
                                        <span class="news-tag">{{ ucfirst($item->jenis ?? 'berita') }}</span>
                                        <a class="read-more-btn" href="{{ url('/berita/'.$item->slug) }}" onclick="event.preventDefault(); event.stopPropagation(); window.location.href='{{ url('/berita/'.$item->slug) }}'; return false;">
                                            Read More <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted py-5">Belum ada berita</div>
                        @endif
                    </div>
                </div>
                <button type="button" class="news-outer-arrow right" id="newsArrowRight" aria-label="Berikutnya" onclick="scrollNewsRight(); return false;"><i class="bi bi-chevron-right"></i></button>
            </div>
            <!-- Dots Indicator -->
            <div class="news-dots" id="newsDots"></div>
        </div>
    </section>

    <!-- Testimoni Terbaru Section -->
    <section class="content-section" style="background: #ffffff; padding: 40px 0;">
        <div class="container">
            <h2 class="section-title text-center" style="margin-bottom: 0.75rem;" data-aos="fade-down">Testimoni Terbaru</h2>
            <p class="text-center mb-4" style="font-size: 1.05rem; font-weight: 500; color: #374151;" data-aos="fade-up" data-aos-delay="100">Pendapat dan pengalaman dari pengunjung website kami</p>
            
            <div class="testimoni-wrapper position-relative" data-aos="fade-up" data-aos-delay="200">
                <button type="button" class="testimoni-arrow left" onclick="scrollTestimoniLeft()"><i class="bi bi-chevron-left"></i></button>
                <div class="testimoni-container" id="testimoniContainer">
                    <div class="testimoni-grid" id="testimoniGrid">
                        @if(isset($recentSuggestions) && $recentSuggestions->count() > 0)
                            @foreach($recentSuggestions as $item)
                                <div class="testimoni-card-new">
                                    <div class="testimoni-header">
                                        <div class="testimoni-avatar-new">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                        <div class="testimoni-info-new">
                                            <h6 class="testimoni-name-new">{{ $item->nama_lengkap }}</h6>
                                            <small class="testimoni-date-new">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                    <p class="testimoni-text-new">"{{ $item->pesan }}"</p>
                                    @if(isset($allRatings) && $allRatings->count() > 0 && ($userRating = $allRatings->first(function($r) use ($item) { return strtolower(trim($r->nama)) === strtolower(trim($item->nama_lengkap)); })))
                                    <div class="testimoni-rating" style="margin-top: 0.75rem; display: flex; gap: 0.4rem; align-items: center;">
                                        @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $userRating->rating)
                                        <i class="fas fa-star" style="color: #f59e0b; font-size: 1.1rem;"></i>
                                        @else
                                        <i class="fas fa-star" style="color: #e2e8f0; font-size: 1.1rem;"></i>
                                        @endif
                                        @endfor
                                        <span style="margin-left: 0.5rem; font-size: 0.85rem; color: #64748b; font-weight: 600;">{{ $userRating->rating }}/5</span>
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted py-5">
                                <i class="bi bi-chat-quote" style="font-size: 4rem; opacity: 0.3;"></i>
                                <h4 class="mt-3">Belum ada testimoni</h4>
                                <p>Testimoni dari pengunjung akan ditampilkan di sini.</p>
                            </div>
                        @endif
                    </div>
                </div>
                <button type="button" class="testimoni-arrow right" onclick="scrollTestimoniRight()"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <!-- Hubungi Kami Section -->
    <section id="hubungi-kami" class="content-section" style="background: #f6f9ff; padding: 40px 0;">
        <div class="container">
            <h2 class="contact-title" data-aos="fade-down">Hubungi Kami</h2>
            <!-- Maps dan Kotak Saran Side by Side -->
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-8" data-aos="fade-right" data-aos-delay="100">
                    <div class="card contact-card map-card h-100">
                        <div class="card-body p-0">
                            <iframe 
                                src="https://www.google.com/maps?q=SMK%20Negeri%204%20Bogor&hl=id&z=16&output=embed"
                                width="100%" 
                                height="400"
                                style="border:0; border-radius: 14px;"
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-left" data-aos-delay="100">
                    <div class="card contact-card h-100">
                        <div class="card-body contact-form">
                            <h5 class="mb-3"><i class="bi bi-chat-dots me-2" style="color: #1E40AF;"></i>Kotak Saran</h5>
                            <form action="{{ route('suggestions.store') }}" method="POST" id="contactForm" autocomplete="on">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" autocomplete="name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="contoh@email.com" autocomplete="email" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pesan <span class="text-danger">*</span></label>
                                    <textarea name="pesan" class="form-control" rows="3" placeholder="Tuliskan pesan atau saran Anda..." autocomplete="off" required></textarea>
                                </div>
                                
                                <!-- Google reCAPTCHA v3 Token (Hidden) -->
                                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                                
                                <button type="submit" class="btn btn-primary contact-submit w-100" id="submitBtn"><i class="bi bi-send me-2"></i>Kirim Pesan</button>
                                
                                <!-- reCAPTCHA Disclaimer (Required by Google when hiding badge) -->
                                <div class="recaptcha-disclaimer text-center">
                                    Situs ini dilindungi oleh reCAPTCHA dan berlaku <a href="https://policies.google.com/privacy" target="_blank">Privacy Policy</a> serta <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> Google.
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white py-5" style="background:#000000;">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4 Bogor" class="me-3" style="height: 42px; width: 42px; object-fit: contain;" onerror="this.style.display='none'">
                        
                        <h4 class="fw-bold mb-0">SMKN 4 Bogor</h4>
                    </div>
                    <p class="text-white-75 mb-0" style="font-size: 1.1rem;">
                        Mencetak generasi unggul, berkarakter, dan siap kerja.
                    </p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3 text-white">Kontak</h5>
                    <ul class="list-unstyled text-white-75 mb-0" style="font-size: 1.1rem;">
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-geo-alt me-3" style="font-size: 1.2rem; min-width: 1.2rem;"></i>
                            <span>Jl. Raya Bogor, Kota Bogor</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-telephone me-3" style="font-size: 1.2rem; min-width: 1.2rem;"></i>
                            <span>(0251) 123-456</span>
                        </li>
                        <li class="mb-0 d-flex align-items-center">
                            <i class="bi bi-envelope me-3" style="font-size: 1.2rem; min-width: 1.2rem;"></i>
                            <span>info@smkn4bogor.sch.id</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3 text-white">Sosial Media</h5>
                    <div class="d-flex gap-4">
                        <a href="https://www.facebook.com/p/SMK-NEGERI-4-KOTA-BOGOR-100054636630766/?locale=id_ID" target="_blank" aria-label="Facebook" style="font-size: 2rem; color: #1E40AF;"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/smkn4kotabogor/" target="_blank" aria-label="Instagram" style="font-size: 2rem; color: #1E40AF;"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/@smknegeri4bogor905" target="_blank" aria-label="YouTube" style="font-size: 2rem; color: #1E40AF;"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary mt-4 mb-4"/>
            <div class="text-center py-3 text-white-75" style="font-size: 1.1rem;">
                <span>&copy; 2024 SMKN 4 BOGOR. All rights reserved.</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Navbar scroll effect
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.navbar');
            const scrollThreshold = 50; // pixels to scroll before adding scrolled class
            
            function handleScroll() {
                if (window.scrollY > scrollThreshold) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
            
            // Initial check in case page is loaded with scroll position
            handleScroll();
            
            // Add scroll event listener
            window.addEventListener('scroll', handleScroll);
        });
        
        // Global error handler untuk mencegah infinite loading
        window.addEventListener('error', function(e) {
            console.error('Global error:', e.error);
            // Prevent infinite loading by ensuring page is interactive
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    document.body.style.opacity = '1';
                });
            } else {
                document.body.style.opacity = '1';
            }
        });
        
        // reCAPTCHA v3 - Auto execute on page load dengan error handling
        if (typeof grecaptcha !== 'undefined') {
            try {
        grecaptcha.ready(function() {
            // reCAPTCHA loaded
                    console.log('reCAPTCHA ready');
                });
            } catch (e) {
                console.warn('reCAPTCHA initialization error:', e);
            }
        } else {
            console.warn('reCAPTCHA script not loaded');
        }

        // Check for success message and scroll to hubungi kami
        var hasSuccess = {{ session('success') ? 'true' : 'false' }};
        var successMessage = '{{ session('success') ?? '' }}';
        var hasError = {{ session('error') ? 'true' : 'false' }};
        var errorMessage = '{{ session('error') ?? '' }}';
        
        if (hasSuccess) {
            document.addEventListener('DOMContentLoaded', function() {
                // Scroll to hubungi kami section
                const hubungiKami = document.getElementById('hubungi-kami');
                if (hubungiKami) {
                    hubungiKami.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
                
                // Show success alert after scroll - auto close without OK button
                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: successMessage,
                        confirmButtonColor: '#1E40AF',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                }, 500);
            });
        }
        
        if (hasError) {
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak!',
                    text: errorMessage,
                    confirmButtonColor: '#1E40AF',
                    confirmButtonText: 'OK'
                });
            });
        }
        
        // Form validation with reCAPTCHA v3 for contact form
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');
            
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Disable submit button
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mengirim...';
                    
                    // Simpan nama ke variable global sebelum form di-reset
                    window.userNamaLengkap = document.querySelector('input[name="nama_lengkap"]')?.value || 'Anonymous';
                    
                    // SIMPLIFIED: Try reCAPTCHA, but if it fails, submit anyway
                    // Check if reCAPTCHA is available (with multiple checks)
                    const hasRecaptcha = typeof window.grecaptcha !== 'undefined' && 
                                        typeof window.grecaptcha.ready === 'function' &&
                                        typeof window.grecaptcha.execute === 'function' &&
                                        !window.grecaptchaLoadError;
                    
                    if (hasRecaptcha) {
                        // Try to get reCAPTCHA token (with 3 second timeout)
                        let recaptchaTimeout = setTimeout(function() {
                            console.warn('reCAPTCHA timeout, submitting without token');
                            document.getElementById('g-recaptcha-response').value = 'timeout';
                            submitFormDirectly();
                        }, 3000);
                        
                        try {
                            window.grecaptcha.ready(function() {
                                clearTimeout(recaptchaTimeout);
                                
                                window.grecaptcha.execute('6Ld0ffcrAAAAAOtioZEl4nY5fpoJB745yD7yZesv', {action: 'submit'})
                                .then(function(token) {
                                    document.getElementById('g-recaptcha-response').value = token;
                                    submitFormDirectly();
                                })
                                .catch(function(error) {
                                    clearTimeout(recaptchaTimeout);
                                    console.warn('reCAPTCHA execute failed:', error);
                                    document.getElementById('g-recaptcha-response').value = 'error';
                                    submitFormDirectly();
                                });
                            });
                        } catch (error) {
                            clearTimeout(recaptchaTimeout);
                            console.warn('reCAPTCHA ready failed:', error);
                            document.getElementById('g-recaptcha-response').value = 'error';
                            submitFormDirectly();
                        }
                    } else {
                        // reCAPTCHA not available, submit directly
                        console.log('reCAPTCHA not available, submitting without token');
                        document.getElementById('g-recaptcha-response').value = 'bypass';
                        submitFormDirectly();
                    }
                });
            }
            
            // Function to submit form directly (used as main submit function)
            function submitFormDirectly() {
                const formData = new FormData(contactForm);
                
                // Use current origin to avoid CORS issues (force HTTPS if on HTTPS)
                let formAction = contactForm.action;
                if (formAction.startsWith('/')) {
                    // Relative path - use current origin
                    formAction = window.location.origin + formAction;
                }
                // Ensure HTTPS if current page is HTTPS
                if (window.location.protocol === 'https:' && formAction.startsWith('http://')) {
                    formAction = formAction.replace('http://', 'https://');
                }
                
                fetch(formAction, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                    mode: 'same-origin'
                })
                .then(async response => {
                    const contentType = response.headers.get("content-type");
                    let errorMessage = 'Gagal mengirim pesan. Silakan coba lagi.';
                    
                    if (response.ok) {
                        // Try to parse JSON response
                        if (contentType && contentType.includes("application/json")) {
                            const data = await response.json();
                            if (data.message) {
                                errorMessage = data.message;
                            }
                        }
                        
                        // Form submitted successfully
                        contactForm.reset();
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="bi bi-send me-2"></i>Kirim Pesan';
                        
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Pesan Anda berhasil dikirim. Terima kasih!',
                            confirmButtonColor: '#1E40AF',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Show rating modal after success message
                            setTimeout(() => {
                                const ratingModal = document.getElementById('ratingModalBackdrop');
                                if (ratingModal) {
                                    ratingModal.classList.add('show');
                                }
                            }, 500);
                        });
                    } else {
                        // Try to get error message from response
                        if (contentType && contentType.includes("application/json")) {
                            try {
                                const errorData = await response.json();
                                if (errorData.message) {
                                    errorMessage = errorData.message;
                                } else if (errorData.errors) {
                                    // Laravel validation errors
                                    const errors = Object.values(errorData.errors).flat();
                                    errorMessage = errors.join(', ');
                                }
                            } catch (e) {
                                // If JSON parsing fails, use default message
                            }
                        } else {
                            // Try to get text response
                            try {
                                const text = await response.text();
                                if (text) {
                                    // Try to extract error from HTML if it's a redirect
                                    const parser = new DOMParser();
                                    const doc = parser.parseFromString(text, 'text/html');
                                    const errorElement = doc.querySelector('.alert-danger, .error');
                                    if (errorElement) {
                                        errorMessage = errorElement.textContent.trim();
                                    }
                                }
                            } catch (e) {
                                // Use default message
                            }
                        }
                        
                        throw new Error(errorMessage);
                    }
                })
                .catch(error => {
                            // Re-enable submit button
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = '<i class="bi bi-send me-2"></i>Kirim Pesan';
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                        text: error.message || 'Gagal mengirim pesan. Silakan coba lagi.',
                                confirmButtonColor: '#1E40AF',
                                confirmButtonText: 'OK'
                    });
                });
            }
        });
        
        // Global functions for news slider
        function scrollNewsLeft() {
            const container = document.getElementById('newsContainer');
            if (container) {
                container.scrollLeft -= 412;
                setTimeout(showVisibleCards, 100);
            }
        }
        
        function scrollNewsRight() {
            const container = document.getElementById('newsContainer');
            if (container) {
                container.scrollLeft += 412;
                setTimeout(showVisibleCards, 100);
            }
        }
        
        // Cache for performance
        let cachedNewsCards = null;
        let cachedNewsContainer = null;
        
        function showVisibleCards() {
            // Use cached elements to avoid repeated DOM queries
            if (!cachedNewsContainer) {
                cachedNewsContainer = document.getElementById('newsContainer');
            }
            if (!cachedNewsCards) {
                cachedNewsCards = document.querySelectorAll('.news-card');
            }
            
            const container = cachedNewsContainer;
            const cards = cachedNewsCards;
            
            if (!container || cards.length === 0) return;
            
            const containerRect = container.getBoundingClientRect();
            
            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                
                if (rect.left >= containerRect.left && rect.right <= containerRect.right + 100) {
                    card.classList.add('visible');
                }
            });
        }
        
        // Testimoni slider functions
        function scrollTestimoniLeft() {
            const container = document.getElementById('testimoniContainer');
            if (container) {
                container.scrollLeft -= 352; // 320px card + 32px gap
            }
        }
        
        function scrollTestimoniRight() {
            const container = document.getElementById('testimoniContainer');
            if (container) {
                container.scrollLeft += 352; // 320px card + 32px gap
            }
        }
        
        // Initialize Fasilitas Swiper
        document.addEventListener('DOMContentLoaded', function() {
            const fasilitasSwiper = new Swiper('.fasilitasSwiper', {
                slidesPerView: 'auto',
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                speed: 800,
                grabCursor: true,
                breakpoints: {
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 25,
                    },
                    1024: {
                        slidesPerView: 6,
                        spaceBetween: 30,
                    }
                }
            });
        });
        
        // Initialize Swiper with 3D Coverflow Effect - OPTIMIZED
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.gallerySwiper', {
                effect: 'coverflow',
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: 3,
                loop: true,
                loopFillGroupWithBlank: false,
                initialSlide: 0,
                speed: 600,
                loopedSlides: null,
                loopAdditionalSlides: 1,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                    waitForTransition: false,
                    reverseDirection: false,
                    stopOnLastSlide: false,
                },
                allowTouchMove: true,
                simulateTouch: true,
                updateOnWindowResize: true,
                observer: false,
                observeParents: false,
                navigation: {
                    nextEl: '.gallery-swiper-button-next',
                    prevEl: '.gallery-swiper-button-prev',
                },
                coverflowEffect: {
                    rotate: 35,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: false,
                },
                // Performance optimization - ULTRA SMOOTH
                watchSlidesProgress: false,
                watchSlidesVisibility: false,
                preventInteractionOnTransition: false,
                resistance: false,
                resistanceRatio: 0,
                touchRatio: 1,
                touchAngle: 45,
                freeMode: false,
                freeModeSticky: false,
                runCallbacksOnInit: false,
                preloadImages: false,
                // GPU acceleration
                cssMode: false,
                // Reduce repaints
                updateOnImagesReady: false,
                lazy: false,
                keyboard: {
                    enabled: true,
                    onlyInViewport: true,
                },
                mousewheel: {
                    enabled: false,
                },
                on: {
                    init: function() {
                        // Ensure autoplay starts
                        this.autoplay.start();
                    }
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1.5,
                        spaceBetween: 10,
                        coverflowEffect: {
                            rotate: 30,
                            depth: 100,
                            modifier: 1,
                        }
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 0,
                        coverflowEffect: {
                            rotate: 40,
                            depth: 120,
                            modifier: 1,
                        }
                    },
                    768: {
                        slidesPerView: 2.5,
                        spaceBetween: 0,
                        coverflowEffect: {
                            rotate: 45,
                            depth: 140,
                            modifier: 1,
                        }
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 0,
                        coverflowEffect: {
                            rotate: 50,
                            depth: 150,
                            modifier: 1,
                        }
                    }
                }
            });
        });
    </script>
    <script>
        // Slideshow functionality
        document.addEventListener('DOMContentLoaded', function() {
            const heroSection = document.querySelector('.hero-section');
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.dot');
            let currentSlide = 0;
            let slideInterval;

            // Set background images for all slides
            slides.forEach(slide => {
                const bgImage = slide.getAttribute('data-bg');
                if (bgImage) {
                    slide.style.backgroundImage = `url('${bgImage}')`;
                }
            });

            // Function to show specific slide
            function showSlide(index) {
                const heroTitle = document.getElementById('heroTitle');
                const heroDesc = document.getElementById('heroDesc');
                
                // Fade out text
                heroTitle.classList.add('fade-out');
                heroDesc.classList.add('fade-out');
                
                // Wait for fade out, then change content
                setTimeout(() => {
                    // Remove active class from all slides and dots
                    slides.forEach(slide => slide.classList.remove('active'));
                    dots.forEach(dot => dot.classList.remove('active'));
                    
                    // Add active class to current slide and dot
                    slides[index].classList.add('active');
                    dots[index].classList.add('active');
                    
                    // Update text content
                    const currentSlideEl = slides[index];
                    const newTitle = currentSlideEl.getAttribute('data-title');
                    const newDesc = currentSlideEl.getAttribute('data-desc');
                    
                    heroTitle.textContent = newTitle;
                    heroDesc.textContent = newDesc;
                    
                    currentSlide = index;
                    
                    // Fade in text
                    setTimeout(() => {
                        heroTitle.classList.remove('fade-out');
                        heroDesc.classList.remove('fade-out');
                    }, 50);
                }, 500);
            }

            // Function to go to next slide
            function nextSlide() {
                const nextIndex = (currentSlide + 1) % slides.length;
                showSlide(nextIndex);
            }

            // Function to start auto slideshow
            function startSlideshow() {
                slideInterval = setInterval(nextSlide, 4000); // 4 seconds
            }

            // Function to stop auto slideshow
            function stopSlideshow() {
                clearInterval(slideInterval);
            }

            // Add click event listeners to dots
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    showSlide(index);
                    stopSlideshow();
                    startSlideshow(); // Restart auto slideshow
                });
            });

            // Pause slideshow on hover
            heroSection.addEventListener('mouseenter', stopSlideshow);
            heroSection.addEventListener('mouseleave', startSlideshow);

            // Start the slideshow
            startSlideshow();
        });

        // Navbar scroll effect - REMOVED (duplicate, already handled above with debounce)

        // Jurusan Detail Modal Function
        function showJurusanDetail(jurusan) {
            const modal = document.getElementById('jurusanModal');
            const modalTitle = document.getElementById('jurusanModalTitle');
            const modalImage = document.getElementById('jurusanModalImage');
            const modalContent = document.getElementById('jurusanModalContent');
            
            const jurusanData = {
                pplg: {
                    title: 'RPL - Rekayasa Perangkat Lunak',
                    subtitle: 'Pengembangan Perangkat Lunak dan Gim',
                    image: '{{ asset("images/jurusan/pplg-logo.jpg") }}',
                    content: `
                        <div class="jurusan-detail-modern">
                            <ul class="nav nav-tabs mb-4" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#rpl-materi">Materi & Praktik</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#rpl-fasilitas">Fasilitas & Kerja Sama</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#rpl-keunggulan">Keunggulan & Karir</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="rpl-materi" class="tab-pane fade show active">
                                    <h5 class="mb-3"><i class="bi bi-code-square text-primary me-2"></i>Materi Utama & Kegiatan Praktik</h5>
                                    <ul class="detail-list">
                                        <li>Pemrograman software / aplikasi: desktop, web, mobile</li>
                                        <li>Penggunaan bahasa pemrograman dan framework umum</li>
                                        <li>Pemeliharaan, debugging, uji (testing), dokumentasi software</li>
                                        <li>Projek dengan perusahaan (Axio Class Plus) untuk meningkatkan kualitas praktik industri</li>
                                    </ul>
                                </div>
                                <div id="rpl-fasilitas" class="tab-pane fade">
                                    <h5 class="mb-3"><i class="bi bi-building text-success me-2"></i>Fasilitas & Kerja Sama</h5>
                                    <ul class="detail-list">
                                        <li><strong>Laboratorium komputer/software</strong> dengan perangkat terkini</li>
                                        <li><strong>Kelas industri dengan Axio</strong> untuk RPL</li>
                                        <li>Kerja praktek dan proyek nyata dari industri</li>
                                        <li>Akses ke teknologi dan tools development profesional</li>
                                    </ul>
                                </div>
                                <div id="rpl-keunggulan" class="tab-pane fade">
                                    <h5 class="mb-3"><i class="bi bi-trophy text-warning me-2"></i>Keunggulan & Peluang Karir</h5>
                                    <div class="mb-3">
                                        <strong>Prospek Kerja:</strong>
                                        <ul class="detail-list mt-2">
                                            <li>Developer software, web, aplikasi mobile</li>
                                            <li>Tester dan system integration</li>
                                            <li>Freelance atau bekerja di startup</li>
                                            <li>Perusahaan IT besar</li>
                                            <li>Membuat usaha sendiri di bidang aplikasi / digital</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                },
                tjkt: {
                    title: 'TKJ - Teknik Komputer & Jaringan',
                    subtitle: 'Teknik Jaringan Komputer dan Telekomunikasi',
                    image: '{{ asset("images/jurusan/tjkt-logo.jpg") }}',
                    content: `
                        <div class="jurusan-detail-modern">
                            <ul class="nav nav-tabs mb-4" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tkj-materi">Materi & Praktik</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tkj-fasilitas">Fasilitas & Kerja Sama</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tkj-keunggulan">Keunggulan & Karir</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tkj-materi" class="tab-pane fade show active">
                                    <h5 class="mb-3"><i class="bi bi-hdd-network text-primary me-2"></i>Materi Utama & Kegiatan Praktik</h5>
                                    <ul class="detail-list">
                                        <li>Pemasangan, konfigurasi, dan pemeliharaan perangkat keras komputer</li>
                                        <li>Instalasi dan manajemen jaringan lokal (LAN), jaringan internet, server</li>
                                        <li>Troubleshooting hardware & software komputer / jaringan</li>
                                        <li>Materi tambahan mengenai <strong>IoT (Internet of Things)</strong> melalui kerja sama dengan Samsung</li>
                                    </ul>
                                </div>
                                <div id="tkj-fasilitas" class="tab-pane fade">
                                    <h5 class="mb-3"><i class="bi bi-building text-success me-2"></i>Fasilitas & Kerja Sama</h5>
                                    <ul class="detail-list">
                                        <li><strong>Kelas Industri khusus TKJ</strong></li>
                                        <li><strong>Kerja sama dengan Samsung</strong> untuk pelatihan teknisi & promotor</li>
                                        <li>Laboratorium jaringan dengan perangkat modern</li>
                                        <li>Akses ke teknologi IoT dan smart devices</li>
                                    </ul>
                                </div>
                                <div id="tkj-keunggulan" class="tab-pane fade">
                                    <h5 class="mb-3"><i class="bi bi-trophy text-warning me-2"></i>Keunggulan & Peluang Karir</h5>
                                    <div class="mb-3">
                                        <strong>Prospek Kerja:</strong>
                                        <ul class="detail-list mt-2">
                                            <li>Teknisi komputer dan jaringan</li>
                                            <li>Administrator jaringan</li>
                                            <li>Support IT</li>
                                            <li>Enterprise network specialist</li>
                                            <li>IoT specialist</li>
                                            <li>Maintenance jaringan perusahaan</li>
                                        </ul>
                                    </div>
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <strong>Keunggulan:</strong> Permintaan tenaga TKJ sangat tinggi karena perkembangan teknologi dan internet yang pesat
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                },
                to: {
                    title: 'TKR - Teknik Kendaraan Ringan',
                    subtitle: 'Teknik Otomotif',
                    image: '{{ asset("images/jurusan/to-logo.jpg") }}',
                    content: `
                        <div class="jurusan-detail-modern">
                            <ul class="nav nav-tabs mb-4" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tkr-materi">Materi & Praktik</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tkr-fasilitas">Fasilitas & Kerja Sama</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tkr-keunggulan">Keunggulan & Karir</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tkr-materi" class="tab-pane fade show active">
                                    <h5 class="mb-3"><i class="bi bi-car-front text-primary me-2"></i>Materi Utama & Kegiatan Praktik</h5>
                                    <ul class="detail-list">
                                        <li>Perawatan dasar & lanjutan kendaraan ringan (mobil/sepeda motor ringan)</li>
                                        <li>Diagnosa kerusakan, servis, perbaikan sistem kelistrikan kendaraan</li>
                                        <li>Perbaikan mesin dan transmisi</li>
                                        <li>Praktek servis di bengkel dengan alat diagnosa modern</li>
                                    </ul>
                                </div>
                                <div id="tkr-fasilitas" class="tab-pane fade">
                                    <h5 class="mb-3"><i class="bi bi-building text-success me-2"></i>Fasilitas & Kerja Sama</h5>
                                    <ul class="detail-list">
                                        <li><strong>Kerja sama praktek dengan industri otomotif</strong> (Honda)</li>
                                        <li><strong>Bengkel mitra industri</strong> dengan ruang praktek Hi-Tech</li>
                                        <li>Peralatan diagnosa dan servis modern</li>
                                        <li>Workshop lengkap untuk praktik langsung</li>
                                    </ul>
                                </div>
                                <div id="tkr-keunggulan" class="tab-pane fade">
                                    <h5 class="mb-3"><i class="bi bi-trophy text-warning me-2"></i>Keunggulan & Peluang Karir</h5>
                                    <div class="mb-3">
                                        <strong>Prospek Kerja:</strong>
                                        <ul class="detail-list mt-2">
                                            <li>Mekanik kendaraan ringan</li>
                                            <li>Teknisi bengkel umum</li>
                                            <li>Workshop otomotif</li>
                                            <li>Servis dealer resmi</li>
                                            <li>Spesialis kelistrikan kendaraan modern</li>
                                        </ul>
                                    </div>
                                    <div class="alert alert-success">
                                        <i class="bi bi-check-circle me-2"></i>
                                        <strong>Peluang Usaha:</strong> Membuka bengkel sendiri, modifikasi kendaraan ringan
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                },
                tpfl: {
                    title: 'TFL - Teknik Fabrikasi Logam',
                    subtitle: 'Teknik Pengelasan Fabrikasi Logam',
                    image: '{{ asset("images/jurusan/tpfl-logo.jpg") }}',
                    content: `
                        <div class="jurusan-detail-modern">
                            <ul class="nav nav-tabs mb-4" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tfl-materi">Materi & Praktik</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tfl-fasilitas">Fasilitas & Kerja Sama</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tfl-keunggulan">Keunggulan & Karir</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tfl-materi" class="tab-pane fade show active">
                                    <h5 class="mb-3"><i class="bi bi-hammer text-primary me-2"></i>Materi Utama & Kegiatan Praktik</h5>
                                    <ul class="detail-list">
                                        <li>Teknik pengelasan, pemotongan, pembentukan bahan logam</li>
                                        <li>Fabrikasi komponen logam</li>
                                        <li>Pembacaan gambar teknik & pembuatan komponen logam sesuai spesifikasi</li>
                                        <li>Penggunaan mesin-mesin metalworking: las, bending, cutting, grinding, finishing logam</li>
                                    </ul>
                                </div>
                                <div id="tfl-fasilitas" class="tab-pane fade">
                                    <h5 class="mb-3"><i class="bi bi-building text-success me-2"></i>Fasilitas & Kerja Sama</h5>
                                    <ul class="detail-list">
                                        <li><strong>Fasilitas bengkel logam / fabrikasi logam</strong> di sekolah</li>
                                        <li><strong>Mesin-mesin praktik</strong> sesuai jurusan (las, cutting, dll)</li>
                                        <li>Kerja sama dengan industri logam/manufaktur</li>
                                        <li>Peralatan modern untuk praktik fabrikasi</li>
                                    </ul>
                                </div>
                                <div id="tfl-keunggulan" class="tab-pane fade">
                                    <h5 class="mb-3"><i class="bi bi-trophy text-warning me-2"></i>Keunggulan & Peluang Karir</h5>
                                    <div class="mb-3">
                                        <strong>Prospek Kerja:</strong>
                                        <ul class="detail-list mt-2">
                                            <li>Industri manufaktur</li>
                                            <li>Perusahaan logam</li>
                                            <li>Konstruksi</li>
                                            <li>Workshop logam</li>
                                            <li>Ahli las profesional</li>
                                            <li>Operator mesin</li>
                                            <li>Pembuat komponen logam</li>
                                        </ul>
                                    </div>
                                    <div class="alert alert-success">
                                        <i class="bi bi-check-circle me-2"></i>
                                        <strong>Peluang Usaha:</strong> Usaha kerajinan logam atau produk industri berbasis logam
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-primary mt-4">
                                <h6 class="mb-2"><i class="bi bi-star-fill me-2"></i>Spesial SMKN 4 Bogor</h6>
                                <ul class="mb-0" style="font-size: 0.9rem;">
                                    <li><strong>Kelas Industri</strong> untuk TKJ, RPL, TKR - praktik di lingkungan industri nyata</li>
                                    <li><strong>Kerja sama dengan Samsung & Axio</strong> - pengalaman langsung dengan teknologi terkini</li>
                                    <li><strong>Materi IoT</strong> untuk jurusan TKJ - teknologi modern untuk masa depan</li>
                                </ul>
                            </div>
                        </div>
                    `
                }
            };
            
            const data = jurusanData[jurusan];
            modalTitle.textContent = data.title;
            modalImage.src = data.image;
            modalContent.innerHTML = data.content;
            
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
        }

        // Search functionality
        function performSearch() {
            const searchInput = document.getElementById('searchInput');
            const searchTerm = searchInput.value.trim().toLowerCase();
            
            if (searchTerm === '') {
                alert('Silakan masukkan kata kunci pencarian');
                return;
            }
            
            // Simple search logic - redirect to appropriate page based on search term
            if (searchTerm.includes('galeri') || searchTerm.includes('foto') || searchTerm.includes('gambar')) {
                window.location.href = "{{ route('gallery.galeri') }}";
            } else if (searchTerm.includes('agenda') || searchTerm.includes('kegiatan') || searchTerm.includes('event')) {
                window.location.href = "{{ route('gallery.agenda') }}";
            } else if (searchTerm.includes('informasi') || searchTerm.includes('profil') || searchTerm.includes('sekolah')) {
                window.location.href = "{{ url('/beranda#news') }}";
            } else if (searchTerm.includes('jurusan') || searchTerm.includes('program') || searchTerm.includes('keahlian')) {
                window.location.href = "{{ route('gallery.jurusan') }}";
            } else {
                // Default to informasi page
                window.location.href = "{{ url('/beranda#news') }}";
            }
        }

        // Allow Enter key to trigger search
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
        }

        // News detail function with horizontal scroll
        function openNewsDetail(newsId) {
            // Find the clicked card and scroll to it
            const clickedCard = event.currentTarget;
            const newsGrid = document.querySelector('.news-grid');
            
            if (newsGrid && clickedCard) {
                // Calculate the position to scroll to
                const cardRect = clickedCard.getBoundingClientRect();
                const gridRect = newsGrid.getBoundingClientRect();
                const scrollLeft = newsGrid.scrollLeft;
                const cardOffsetLeft = clickedCard.offsetLeft;
                
                // Scroll to center the card in view
                const targetScrollLeft = cardOffsetLeft - (gridRect.width / 2) + (clickedCard.offsetWidth / 2);
                
                newsGrid.scrollTo({
                    left: targetScrollLeft,
                    behavior: 'smooth'
                });
                
                // Add visual feedback
                clickedCard.style.transform = 'scale(1.05)';
                clickedCard.style.zIndex = '20';
                
                setTimeout(() => {
                    clickedCard.style.transform = 'scale(1)';
                    clickedCard.style.zIndex = '1';
                }, 600);
            }
        }

        // Enhanced horizontal scroll functionality for news section - OPTIMIZED
        document.addEventListener('DOMContentLoaded', function() {
            // Combine all IntersectionObserver into ONE for better performance
            try {
                const globalObserver = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('sa-show');
                            entry.target.classList.remove('sa-hidden');
                            entry.target.classList.add('visible');
                        }
                    });
                }, { threshold: 0.15 });

                // Observe fasilitas items
                const fasilitasSection = document.getElementById('fasilitas');
                if (fasilitasSection) {
                    const items = fasilitasSection.querySelectorAll('.fasilitas-item');
                    items.forEach((item, idx) => {
                        item.style.setProperty('--stagger', (idx * 80) + 'ms');
                        globalObserver.observe(item);
                    });
                }

                // Observe other sections
                const map = [
                    ['jurusan', '.jurusan-card'],
                    ['visi-misi', '.visi-misi-card'],
                    ['news', '.news-grid'],
                    ['prestasi', '.prestasi-card']
                ];
                map.forEach(([id, selector]) => {
                    const section = document.getElementById(id);
                    if (!section) return;
                    const items = section.querySelectorAll(selector);
                    items.forEach((el, idx) => {
                        el.style.setProperty('--stagger', (idx * 80) + 'ms');
                        globalObserver.observe(el);
                    });
                });
            } catch (_) {
                // Fallback: show all items immediately
                document.querySelectorAll('.fasilitas-item, .jurusan-card, .visi-misi-card, .news-grid, .prestasi-card').forEach((el) => {
                    el.classList.add('sa-show');
                    el.classList.add('visible');
                });
            }

            const newsGrid = document.querySelector('.news-grid');
            const newsContainer = document.querySelector('.news-container');
            const newsCards = document.querySelectorAll('.news-card');
            
            if (newsGrid && newsContainer) {
                // Show initial visible cards
                setTimeout(showVisibleCards, 500);
                
                // Debounce scroll event - only update every 100ms
                let scrollTimeout;
                newsContainer.addEventListener('scroll', function() {
                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(showVisibleCards, 100);
                }, { passive: true });
                
                // assign stagger variable per card (index-based)
                newsCards.forEach((card, idx) => {
                    card.style.setProperty('--stagger', ((idx % 5) * 70) + 'ms');
                });

                // Only enable drag-to-scroll on desktop (not mobile)
                const isMobile = window.innerWidth <= 768;
                if (!isMobile) {
                    let isDownDrag = false;
                    let startX = 0;
                    let startScrollLeft = 0;
                    
                    newsContainer.addEventListener('mousedown', (e) => {
                        isDownDrag = true;
                        newsGrid.classList.add('dragging');
                        startX = e.pageX - newsContainer.offsetLeft;
                        startScrollLeft = newsContainer.scrollLeft;
                    });
                    newsContainer.addEventListener('mouseleave', () => {
                        isDownDrag = false;
                        newsGrid.classList.remove('dragging');
                    });
                    newsContainer.addEventListener('mouseup', () => {
                        isDownDrag = false;
                        newsGrid.classList.remove('dragging');
                    });
                    newsContainer.addEventListener('mousemove', (e) => {
                        if (!isDownDrag) return;
                        e.preventDefault();
                        const x = e.pageX - newsContainer.offsetLeft;
                        const walk = (x - startX) * 1.2;
                        newsContainer.scrollLeft = startScrollLeft - walk;
                    });

                    // Prevent vertical scrolling on news grid (desktop only)
                    newsContainer.addEventListener('wheel', function(e) {
                        if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
                            e.preventDefault();
                            newsContainer.scrollLeft += e.deltaY;
                        }
                    }, { passive: false });
                }

                // Debounce scroll indicators update - only update every 150ms
                let updateTimeout;
                function updateScrollIndicators() {
                    newsCards.forEach((card) => {
                        const cardRect = card.getBoundingClientRect();
                        const containerRect = newsContainer.getBoundingClientRect();
                        const isVisible = cardRect.left >= containerRect.left && cardRect.right <= containerRect.right;
                        
                        if (isVisible) {
                            card.style.transform = 'scale(1.02)';
                            card.style.zIndex = '10';
                        } else {
                            card.style.transform = 'scale(1)';
                            card.style.zIndex = '1';
                        }
                    });
                }

                newsContainer.addEventListener('scroll', function() {
                    clearTimeout(updateTimeout);
                    updateTimeout = setTimeout(updateScrollIndicators, 150);
                }, { passive: true });
                
                // Enhanced keyboard navigation for horizontal scroll
                newsContainer.addEventListener('keydown', function(e) {
                    if (e.key === 'ArrowLeft') {
                        e.preventDefault();
                        newsContainer.scrollBy({ left: -350, behavior: 'smooth' });
                    } else if (e.key === 'ArrowRight') {
                        e.preventDefault();
                        newsContainer.scrollBy({ left: 350, behavior: 'smooth' });
                    } else if (e.key === 'Home') {
                        e.preventDefault();
                        newsContainer.scrollTo({ left: 0, behavior: 'smooth' });
                    } else if (e.key === 'End') {
                        e.preventDefault();
                        newsContainer.scrollTo({ left: newsContainer.scrollWidth, behavior: 'smooth' });
                    }
                });

                // Make news grid focusable for keyboard navigation
                newsContainer.setAttribute('tabindex', '0');
                
                // Add click handlers for each image to scroll to it
                const newsImages = document.querySelectorAll('.news-image');
                newsImages.forEach((image, index) => {
                    image.addEventListener('click', function(e) {
                        // Only prevent default if clicking on the image itself, not on links
                        if (e.target.tagName !== 'A' && !e.target.closest('a')) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            // Find the parent card
                            const card = image.closest('.news-card');
                            if (card) {
                                // Calculate the position to scroll to center the card
                                const cardOffsetLeft = card.offsetLeft;
                                const cardWidth = card.offsetWidth;
                                const gridWidth = newsContainer.clientWidth;
                                
                                const targetScrollLeft = cardOffsetLeft - (gridWidth / 2) + (cardWidth / 2);
                                
                                newsContainer.scrollTo({
                                    left: targetScrollLeft,
                                    behavior: 'smooth'
                                });
                                
                                // Add visual feedback
                                card.style.transform = 'scale(1.05)';
                                card.style.zIndex = '20';
                                
                                setTimeout(() => {
                                    card.style.transform = 'scale(1)';
                                    card.style.zIndex = '1';
                                }, 600);
                            }
                        }
                    });
                });

                // Ensure read-more links work properly
                const readMoreLinks = document.querySelectorAll('.read-more-link');
                readMoreLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        // Ensure the link works by stopping any interference
                        e.stopPropagation();
                        // Let the default link behavior proceed
                    });
                });

                // Ensure news title links work properly
                const newsTitleLinks = document.querySelectorAll('.news-title-link');
                newsTitleLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        // Ensure the link works by stopping any interference
                        e.stopPropagation();
                        // Let the default link behavior proceed
                    });
                });

                // Outer arrow click handlers - DIRECT APPROACH
                const scrollAmount = 412;
                
                // Use direct getElementById for reliability
                const leftBtn = document.getElementById('newsArrowLeft');
                const rightBtn = document.getElementById('newsArrowRight');
                const container = document.getElementById('newsContainer');
                
                if (leftBtn && container) {
                    leftBtn.onclick = function() {
                        container.scrollLeft = container.scrollLeft - scrollAmount;
                        setTimeout(updateDots, 300);
                        return false;
                    };
                }
                
                if (rightBtn && container) {
                    rightBtn.onclick = function() {
                        container.scrollLeft = container.scrollLeft + scrollAmount;
                        setTimeout(updateDots, 300);
                        return false;
                    };
                }
                
                // Create dots indicator
                const dotsContainer = document.getElementById('newsDots');
                const totalCards = newsCards.length;
                const visibleCards = Math.floor(newsContainer.offsetWidth / (newsCards[0]?.offsetWidth || 360));
                const totalDots = Math.max(1, Math.ceil(totalCards / visibleCards));
                
                function createDots() {
                    dotsContainer.innerHTML = '';
                    for (let i = 0; i < totalDots; i++) {
                        const dot = document.createElement('div');
                        dot.className = 'news-dot';
                        if (i === 0) dot.classList.add('active');
                        dot.addEventListener('click', () => {
                            const scrollPosition = i * newsContainer.offsetWidth;
                            newsContainer.scrollTo({ left: scrollPosition, behavior: 'smooth' });
                            updateDots();
                        });
                        dotsContainer.appendChild(dot);
                    }
                }
                
                function updateDots() {
                    const scrollLeft = newsContainer.scrollLeft;
                    const containerWidth = newsContainer.offsetWidth;
                    const currentDot = Math.round(scrollLeft / containerWidth);
                    
                    document.querySelectorAll('.news-dot').forEach((dot, index) => {
                        dot.classList.toggle('active', index === currentDot);
                    });
                }
                
                // Initialize dots
                if (totalCards > visibleCards) {
                    createDots();
                    newsContainer.addEventListener('scroll', updateDots);
                }
            }
        });
    </script>

    <script>
        // Gallery Slider - Infinite Loop with Cloning
        document.addEventListener('DOMContentLoaded', function() {
            const gallerySlider = document.getElementById('gallerySlider');
            if (!gallerySlider) return;
            
            // Clone all cards for infinite loop
            const cards = Array.from(gallerySlider.children);
            cards.forEach(card => {
                const clone = card.cloneNode(true);
                gallerySlider.appendChild(clone);
            });
        });
        
        // Gallery Modal Functions
        function openGalleryModal(categoryId, categoryName) {
            const modal = document.getElementById('galleryModal');
            const modalTitle = document.getElementById('modalCategoryTitle');
            const modalGrid = document.getElementById('modalGalleryGrid');
            
            // Set title
            modalTitle.textContent = categoryName;
            
            // Show loading
            modalGrid.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            
            // Show modal
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Fetch photos from category
            fetch(`/api/kategori/${categoryId}/fotos`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data && data.data.fotos && data.data.fotos.length > 0) {
                        let html = '';
                        data.data.fotos.forEach(photo => {
                            const photoDate = new Date(photo.created_at).toLocaleDateString('id-ID', {
                                day: 'numeric',
                                month: 'short',
                                year: 'numeric'
                            });
                            
                            html += `
                                <div class="gallery-modal-item">
                                    <img src="/storage/${photo.file_path}" 
                                         alt="Foto" 
                                         class="gallery-modal-item-image"
                                         onerror="this.parentElement.innerHTML='<div style=\\'height:280px;display:flex;align-items:center;justify-content:center;background:#f3f4f6;border-radius:12px 12px 0 0\\'><i class=\\'bi bi-image\\' style=\\'font-size:3rem;color:#9ca3af\\'></i></div><div class=\\'gallery-modal-item-info\\'><div class=\\'gallery-modal-item-date\\'><i class=\\'bi bi-calendar3\\'></i> ${photoDate}</div></div>'">
                                    <div class="gallery-modal-item-info">
                                        <div class="gallery-modal-item-date">
                                            <i class="bi bi-calendar3"></i> ${photoDate}
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        modalGrid.innerHTML = html;
                    } else {
                        modalGrid.innerHTML = `
                            <div class="text-center py-5">
                                <i class="bi bi-images" style="font-size: 4rem; color: #cbd5e1;"></i>
                                <p class="text-muted mt-3">Belum ada foto dalam kategori ini</p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    modalGrid.innerHTML = `
                        <div class="text-center py-5">
                            <i class="bi bi-exclamation-triangle" style="font-size: 4rem; color: #ef4444;"></i>
                            <p class="text-danger mt-3">Gagal memuat foto. Silakan coba lagi.</p>
                        </div>
                    `;
                });
        }
        
        function closeGalleryModal() {
            const modal = document.getElementById('galleryModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('galleryModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeGalleryModal();
                    }
                });
            }
            
            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeGalleryModal();
                }
            });
        });
    </script>

    <!-- Jurusan Detail Modal -->
    <div class="modal fade" id="jurusanModal" tabindex="-1" aria-labelledby="jurusanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.3); overflow: hidden;">
                <div class="modal-header" style="background: linear-gradient(135deg, #1E40AF 0%, #3b82f6 100%); border: none; padding: 28px 32px; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,%3Csvg width=\"40\" height=\"40\" viewBox=\"0 0 40 40\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M0 0h20v20H0V0zm10 17a7 7 0 1 0 0-14 7 7 0 0 0 0 14z\"/%3E%3C/g%3E%3C/svg%3E'); opacity: 0.3;"></div>
                    <h4 class="modal-title fw-bold mb-0" id="jurusanModalTitle" style="color: #ffffff; position: relative; z-index: 1;">Detail Jurusan</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="position: relative; z-index: 1; filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body" style="padding: 32px; background: linear-gradient(to bottom, #fefefe 0%, #f8fafc 100%);">
                    <div class="row g-4">
                        <div class="col-md-4 text-center">
                            <div style="background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%); padding: 24px; border-radius: 20px; box-shadow: 0 8px 24px rgba(30,64,175,0.12); border: 2px solid #e0f2fe;">
                                <img id="jurusanModalImage" src="" alt="Jurusan Logo" class="mb-3" style="width: 150px; height: 150px; object-fit: cover; border-radius: 16px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); border: 4px solid #ffffff;">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="jurusanModalContent" style="background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%); padding: 24px; border-radius: 16px; box-shadow: 0 4px 16px rgba(0,0,0,0.06);">
                                <!-- Content will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e5e7eb; padding: 20px 32px; background: linear-gradient(to top, #f8fafc 0%, #ffffff 100%);">
                    <button type="button" class="btn" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%); color: white; border: none; padding: 12px 28px; border-radius: 12px; font-weight: 600; box-shadow: 0 4px 12px rgba(107,114,128,0.3); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(107,114,128,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(107,114,128,0.3)'">
                        <i class="bi bi-x-circle me-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS (Animate On Scroll)
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: false,
            mirror: true,
            offset: 100,
            delay: 100,
        });
        
        // Refresh AOS on window resize - OPTIMIZED with debounce
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                AOS.refresh();
            }, 300);
        }, { passive: true });
    </script>

    <!-- Rating Modal -->
    <div class="rating-modal-backdrop" id="ratingModalBackdrop">
        <div class="rating-modal-container">
            <div class="rating-modal-icon">
                <i class="bi bi-star-fill"></i>
            </div>
            <h3 class="rating-modal-title">Bagaimana Pengalaman Anda?</h3>
            <p class="rating-modal-message">
                Terima kasih telah menghubungi kami. Kami ingin tahu pendapat Anda tentang website kami.
            </p>
            
            <div class="rating-stars" id="ratingStars">
                <button type="button" class="rating-star" data-rating="1">★</button>
                <button type="button" class="rating-star" data-rating="2">★</button>
                <button type="button" class="rating-star" data-rating="3">★</button>
                <button type="button" class="rating-star" data-rating="4">★</button>
                <button type="button" class="rating-star" data-rating="5">★</button>
            </div>
            
            <div class="rating-buttons">
                <button class="rating-btn rating-btn-skip" id="skipRatingBtn">
                    Lewati
                </button>
                <button class="rating-btn rating-btn-submit" id="submitRatingBtn" disabled>
                    Kirim Rating
                </button>
            </div>
        </div>
    </div>

    <script>
        let selectedRating = 0;

        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.rating-star');
            const submitBtn = document.getElementById('submitRatingBtn');
            const skipBtn = document.getElementById('skipRatingBtn');
            const ratingModalBackdrop = document.getElementById('ratingModalBackdrop');
            const ratingStarsContainer = document.getElementById('ratingStars');

            // Saat klik bintang
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    selectedRating = parseInt(this.getAttribute('data-rating'));

                    // Tambahkan efek aktif ke bintang yang dipilih
                    stars.forEach(s => {
                        if (parseInt(s.getAttribute('data-rating')) <= selectedRating) {
                            s.classList.add('active');
                            s.style.color = '#ffc107';
                        } else {
                            s.classList.remove('active');
                            s.style.color = '#ddd';
                        }
                    });

                    // Aktifkan tombol kirim
                    submitBtn.disabled = false;
                });

                // Hover effect
                star.addEventListener('mouseover', function() {
                    const hoverRating = parseInt(this.getAttribute('data-rating'));
                    stars.forEach(s => {
                        if (parseInt(s.getAttribute('data-rating')) <= hoverRating) {
                            s.style.color = '#ffc107';
                        } else {
                            s.style.color = '#ddd';
                        }
                    });
                });
            });

            // Reset hover saat mouse leave
            if (ratingStarsContainer) {
                ratingStarsContainer.addEventListener('mouseleave', function() {
                    stars.forEach(s => {
                        if (parseInt(s.getAttribute('data-rating')) <= selectedRating) {
                            s.style.color = '#ffc107';
                        } else {
                            s.style.color = '#ddd';
                        }
                    });
                });
            }

            // Saat klik tombol kirim
            submitBtn.addEventListener('click', function() {
                if (selectedRating > 0) {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Mengirim...';

                    // Get CSRF token
                    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                    
                    if (!csrfToken) {
                        csrfToken = document.querySelector('input[name="_token"]')?.value;
                    }

                    if (!csrfToken) {
                        const cookies = document.cookie.split(';');
                        for (let cookie of cookies) {
                            if (cookie.includes('XSRF-TOKEN')) {
                                csrfToken = decodeURIComponent(cookie.split('=')[1]);
                                break;
                            }
                        }
                    }
                    
                    // Get nama from global variable (disimpan saat form dikirim)
                    const nama = window.userNamaLengkap || 'Anonymous';
                    
                    // Send rating to server
                    fetch('/ratings', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            rating: selectedRating,
                            page: 'beranda',
                            nama: nama
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Close modal
                            if (ratingModalBackdrop) {
                                ratingModalBackdrop.classList.remove('show');
                            }
                            
                            // Reset
                            selectedRating = 0;
                            submitBtn.disabled = false;
                            submitBtn.textContent = 'Kirim Rating';
                            stars.forEach(s => s.style.color = '#ddd');

                            // Show success
                            alert('Terima kasih! Rating Anda telah kami terima.');
                        } else {
                            throw new Error(data.message || 'Gagal mengirim rating');
                        }
                    })
                    .catch(error => {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Kirim Rating';
                        alert('Error: ' + error.message);
                    });
                }
            });

            // Saat klik tombol lewati
            if (skipBtn) {
                skipBtn.addEventListener('click', function() {
                    if (ratingModalBackdrop) {
                        ratingModalBackdrop.classList.remove('show');
                    }
                    selectedRating = 0;
                    stars.forEach(s => s.style.color = '#ddd');
                });
            }

            // Close modal when clicking outside
            if (ratingModalBackdrop) {
                ratingModalBackdrop.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.remove('show');
                        selectedRating = 0;
                        stars.forEach(s => s.style.color = '#ddd');
                    }
                });
            }
        });
    </script>
    <script src="{{ asset('js/beranda-mobile-optimize.js') }}" defer></script>
</body>
</html>





