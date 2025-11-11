<!DOCTYPE html>
<html lang="id" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda - SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/gallery-navbar.css') }}">
    <style>
        /* Smooth scroll untuk semua halaman */
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 100px;
        }
        /* Navbar styling for agenda page - sama seperti galeri */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 80px;
            border-bottom: 1px solid rgba(37, 99, 235, 0.1);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        /* Container untuk mengatur spacing */
        .navbar .container-fluid {
            max-width: 1400px;
            margin: 0 auto;
            padding-left: 3rem;
            padding-right: 3rem;
        }

        .navbar-brand {
            color: #1E40AF !important;
            font-weight: 700;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-right: 4rem;
        }

        .navbar-brand:hover {
            color: #1e3a8a !important;
            transform: scale(1.05);
        }

        .navbar-brand span {
            color: #1E40AF !important;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .navbar-brand img {
            height: 34px;
            width: 34px;
        }

        /* Navbar nav di tengah */
        .navbar-nav {
            margin-left: auto !important;
            margin-right: 0 !important;
        }

        .navbar-nav .nav-link {
            color: #374151 !important;
            font-weight: 400;
            padding: 0.5rem 0.75rem;
            margin: 0 0.25rem;
            border-radius: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            font-size: 0.95rem;
        }

        .navbar-nav .nav-item:last-child .nav-link {
            margin-right: 0.75rem;
        }

        .navbar-nav .nav-link:hover {
            color: #1E40AF !important;
            background: transparent;
        }

        .navbar-nav .nav-link.active {
            color: #1E40AF !important;
            background: transparent;
            font-weight: 500;
        }

        .navbar-nav .nav-link i {
            color: #374151 !important;
            font-size: 0.95rem;
            margin-right: 0.4rem;
        }

        .navbar-nav .nav-link:hover i {
            color: #1E40AF !important;
        }

        .navbar-nav .nav-link.active i {
            color: #1E40AF !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 50%, #1e40af 100%);
            border: none;
            padding: 0.7rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-left: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            background: #1d4ed8;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .navbar .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .navbar-brand {
                font-size: 1.3rem;
                margin-right: 1rem;
            }

            .navbar-brand span {
                font-size: 1.3rem;
            }

            .navbar-nav {
                margin-top: 1rem;
            }

            .btn-primary {
                margin-left: 0;
                margin-top: 1rem;
                width: 100%;
            }
        }

        :root {
            --primary-blue: #2563eb;
            --secondary-blue: #1d4ed8;
            --light-blue: #dbeafe;
            --dark-gray: #333333;
            --light-gray: #666666;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --accent-orange: #f97316;
            --accent-green: #10b981;
            --accent-purple: #a855f7;
            --accent-red: #ef4444;
            --accent-yellow: #f59e0b;
            --accent-teal: #14b8a6;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--dark-gray);
            min-height: 100vh;
            scroll-behavior: smooth;
        }
        
        .main-content {
            margin-left: 0;
            padding: 0;
            min-height: calc(100vh - 80px);
            margin-top: 80px;
        }
        
        /* Hero Section - Enhanced with decorative elements */
        .page-header {
            background: #1E40AF;
            color: #ffffff;
            padding: 3.5rem 0 2.5rem;
            text-align: center;
            position: relative;
            align-items: center;
            margin-bottom: 0;
            border-radius: 0;
            margin-left: 0;
            margin-right: 0;
            margin-top: 0;
            max-width: 100%;
            width: 100%;
            box-shadow: 0 10px 40px rgba(30, 64, 175, 0.25);
            overflow: hidden;
        }

        /* Wave decoration at bottom - simplified */
        .page-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            background: #f8fafc;
            clip-path: polygon(0 30%, 100% 0, 100% 100%, 0 100%);
            z-index: 2;
        }
        
        /* Twinkling stars background */
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle, rgba(255, 255, 255, 0.8) 1px, transparent 1px),
                radial-gradient(circle, rgba(255, 255, 255, 0.6) 1px, transparent 1px),
                radial-gradient(circle, rgba(255, 255, 255, 0.4) 1px, transparent 1px);
            background-size: 60px 60px, 90px 90px, 120px 120px;
            background-position: 0 0, 30px 50px, 80px 100px;
            opacity: 0.3;
            animation: twinkle 3s ease-in-out infinite;
            z-index: 0;
        }
        
        @keyframes twinkle {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.5; }
        }
        
        /* Icon decorations - removed for cleaner look */
        .hero-icon-left,
        .hero-icon-right {
            display: none;
        }
        
        .page-header .container {
            position: relative;
            z-index: 1;
        }
        
        .page-title {
            font-size: 2.75rem;
            font-weight: 700;
            margin-bottom: 0.85rem;
            color: #ffffff;
            letter-spacing: -0.5px;
            line-height: 1.2;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        .page-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.05rem;
            margin-bottom: 1.75rem;
            font-weight: 400;
            line-height: 1.6;
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            z-index: 1;
        }
        
        /* Stats or info badges in hero */
        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 1.5rem;
            position: relative;
            z-index: 1;
        }
        
        .hero-stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.25rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .hero-stat-item:hover {
            background: rgba(255, 255, 255, 0.22);
            transform: translateY(-2px);
        }
        
        .hero-stat-item i {
            color: #fcd34d;
            font-size: 1.1rem;
        }
        
        .hero-stat-item span {
            color: #ffffff;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .agenda-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
            width: 100%;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            padding: 2rem;
        }

        .calendar-section {
            display: none;
        }

        .agenda-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
            width: 100%;
        }

        /* Agenda toolbar (tabs + search) */
        .agenda-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .agenda-tabs {
            background: #eef2f7;
            border-radius: 999px;
            padding: 4px;
            display: inline-flex;
            gap: 4px;
        }

        .agenda-tab {
            border: 0;
            background: transparent;
            padding: 0.5rem 0.9rem;
            border-radius: 999px;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
        }

        .agenda-tab.active {
            background: #ffffff;
            color: var(--primary-blue);
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        .agenda-search { position: relative; flex: 1 1 260px; max-width: 420px; }
        .agenda-search input { width: 100%; border: 1px solid #e5e7eb; border-radius: 12px; padding: 0.6rem 2.2rem 0.6rem 2.4rem; outline: none; box-shadow: 0 1px 2px rgba(0,0,0,0.03); }
        .agenda-search .bi-search { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
        
        .agenda-card {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e5e7eb;
            border-left: 4px solid transparent;
            position: relative;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            padding: 1.6rem;
            width: 100%;
            margin: 0;
            min-height: 190px;
        }
        
        .agenda-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            border-left: 4px solid #1E40AF;
            transform: translateY(-2px);
        }

        .agenda-card:active {
            transform: translateY(0) scale(0.98);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.1s ease;
        }
        
        .agenda-header {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            width: 100%;
            flex: 1;
            margin-bottom: 1rem;
        }

        .agenda-icon {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            background: #f0f7ff;
            display: grid;
            place-items: center;
            font-size: 1.5rem;
            color: var(--primary-blue);
            flex-shrink: 0;
            border: 1px solid #e0e7ff;
        }
        
        .agenda-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1a202c;
            line-height: 1.4;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
            margin: 0;
            flex: 1;
        }
        
        .agenda-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }
        
        .agenda-status {
            padding: 0.35rem 0.85rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .status-upcoming {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }
        
        .status-ongoing {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        
        .status-completed {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }
        
        .agenda-date {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        
        .agenda-date i {
            color: #1E40AF;
            font-size: 1rem;
        }
        
        .agenda-actions {
            padding: 1.5rem 2rem;
            text-align: center;
        }
        
        .btn-view-photos {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            border: none;
            color: var(--white);
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-view-photos:hover {
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(31, 111, 214, 0.3);
        }
        
        .btn-back {
            background: var(--light-gray);
            border: none;
            color: var(--white);
            padding: 1rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-back:hover {
            background: var(--dark-gray);
            color: var(--white);
            transform: translateY(-2px);
        }
        
        /* Color variations for different agenda types */
        .agenda-card.pensi .agenda-icon { 
            color: var(--accent-purple); 
            background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%);
        }
        .agenda-card.transforkrab .agenda-icon { 
            color: #1e40af; 
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        }
        .agenda-card.p5 .agenda-icon { 
            color: var(--accent-green); 
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        }
        .agenda-card.mountor .agenda-icon { 
            color: var(--accent-orange); 
            background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
        }
        .agenda-card.classmeeting .agenda-icon { 
            color: var(--accent-teal); 
            background: linear-gradient(135deg, #ccfbf1 0%, #99f6e4 100%);
        }
        .agenda-card.lomba17agustus .agenda-icon { 
            color: var(--accent-red); 
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        }
        
        /* Responsive design */
        @media (max-width: 1024px) {
            .agenda-layout {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                width: 100%;
            }
            
            .calendar-section {
                order: 2;
            }
            
            .agenda-grid {
                order: 1;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2.2rem;
            }
            
            .page-header {
                padding: 2.5rem 1.5rem;
                margin-bottom: 2.5rem;
            }
            
            .agenda-layout {
                grid-template-columns: 1fr;
                gap: 1rem;
                padding: 0 1rem;
                width: 100%;
            }
            
            .calendar-section {
                padding: 1.5rem;
            }
            
            .agenda-card { height: 120px !important; padding: 1.25rem; }
            .agenda-header { margin-bottom: 1rem; flex: 1; min-height: 60px; }
            .agenda-meta { margin-top: auto; min-height: 20px; }
            
            .main-content {
                padding: 1rem 0;
            }
        }
        
        @media (max-width: 480px) {
            .page-title {
                font-size: 1.8rem;
            }
            
            .page-header {
                padding: 2rem 1rem;
                margin-bottom: 2rem;
            }
            
            .agenda-grid {
                padding: 0 0.5rem;
            }
            
            .agenda-card { height: 120px !important; padding: 1rem; }
            
            .agenda-header {
                margin-bottom: 1rem;
                flex: 1;
                min-height: 60px;
            }
            
            .agenda-meta {
                padding: 1rem;
            }
        }
        
        /* Animation for cards */
        .agenda-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }
        
        .agenda-card:nth-child(1) { animation-delay: 0.1s; }
        .agenda-card:nth-child(2) { animation-delay: 0.2s; }
        .agenda-card:nth-child(3) { animation-delay: 0.3s; }
        .agenda-card:nth-child(4) { animation-delay: 0.4s; }
        .agenda-card:nth-child(5) { animation-delay: 0.5s; }
        .agenda-card:nth-child(6) { animation-delay: 0.6s; }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animasi fade-in untuk section saat scroll - ENHANCED */
        .fade-in-section {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .fade-in-section.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Animasi slide-in dari kiri */
        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }
        
        .slide-in-left.is-visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        /* Animasi slide-in dari kanan */
        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }
        
        .slide-in-right.is-visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* Animasi untuk row/card */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Delay untuk animasi bertahap */
        .animate-on-scroll:nth-child(1) { transition-delay: 0.1s; }
        .animate-on-scroll:nth-child(2) { transition-delay: 0.2s; }
        .animate-on-scroll:nth-child(3) { transition-delay: 0.3s; }
        .animate-on-scroll:nth-child(4) { transition-delay: 0.4s; }
    </style>
</head>
<body>
    @include('gallery.partials.navbar')

    <!-- Main Content -->
    <div class="main-content">
            <!-- Hero Section with Image -->
            <div class="container">
                <div style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); border-radius: 24px; margin: 2rem 0; overflow: hidden; position: relative;">
                    <div class="row g-0 align-items-center">
                        <div class="col-lg-6 p-5">
                            <h1 class="text-white mb-3" style="font-size: 2.5rem; font-weight: 800; line-height: 1.2;">Mencetak Generasi Unggul dan Berkarakter</h1>
                            <p class="text-white mb-4" style="font-size: 1.1rem; opacity: 0.95; line-height: 1.6;">SMK Negeri 4 Bogor berkomitmen memberikan pendidikan kejuruan terbaik dengan fokus pada pengembangan kompetensi dan karakter siswa</p>
                            <a href="https://youtu.be/N6cmqCbQllo?si=aed4uau0OQ9UbAz9" target="_blank" class="btn btn-light btn-lg px-4 py-2" style="border-radius: 50px; font-size: 1rem; font-weight: 600;">
                                <i class="bi bi-play-circle-fill me-2"></i>Tonton Video Profile
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <img src="{{ asset('images/hero-profile.jpg') }}" alt="SMKN 4 Bogor" style="width: 100%; height: 400px; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800'">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="container mb-5">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card border-0 h-100" style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); border-radius: 20px;">
                            <div class="card-body p-4 text-white">
                                <div class="d-flex align-items-center mb-3">
                                    <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                                        <i class="bi bi-eye-fill" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h3 class="mb-0" style="font-weight: 700; font-size: 1.8rem;">Visi</h3>
                                </div>
                                <p class="mb-0" style="font-size: 1.1rem; line-height: 1.7; opacity: 0.95;">"Menjadi sekolah kejuruan yang unggul, berkarakter, dan mampu mencetak lulusan siap kerja dan kompeten di era industri."</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card border-0 h-100" style="background: #f0f4f0; border-radius: 20px;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div style="width: 50px; height: 50px; background: #1e40af; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                                        <i class="bi bi-list-check text-white" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h3 class="mb-0" style="color: #1e3a8a; font-weight: 700; font-size: 1.8rem;">Misi</h3>
                                </div>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2" style="color: #4a5568; font-size: 1rem;"><i class="bi bi-check-circle-fill me-2" style="color: #1e40af;"></i>Menyelenggarakan pendidikan kejuruan berkualitas</li>
                                    <li class="mb-2" style="color: #4a5568; font-size: 1rem;"><i class="bi bi-check-circle-fill me-2" style="color: #1e40af;"></i>Meningkatkan kompetensi guru dan tenaga kependidikan</li>
                                    <li class="mb-2" style="color: #4a5568; font-size: 1rem;"><i class="bi bi-check-circle-fill me-2" style="color: #1e40af;"></i>Menanamkan karakter dan nilai-nilai kebangsaan</li>
                                    <li class="mb-0" style="color: #4a5568; font-size: 1rem;"><i class="bi bi-check-circle-fill me-2" style="color: #1e40af;"></i>Mengembangkan kemitraan dengan dunia industri</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Profile Content -->
        <div class="container py-5">
            <!-- Mengenal Lebih Dekat dengan Gambar -->
            <div class="row mb-5 align-items-center fade-in-section">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('images/mengenal-smkn4.jpg') }}" alt="SMKN 4 Bogor" class="img-fluid rounded shadow" style="border-radius: 20px !important;" onerror="this.src='https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=600'">
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                        <div class="card-body" style="padding: 1.25rem 1.5rem;">
                            <h3 class="mb-3" style="font-size: 1.6rem; font-weight: 700; line-height: 1.4; color: #1a202c;">
                                <span style="color: #1e40af;">Mengenal Lebih Dekat</span> <span style="color: #1a202c;">SMKN 4 Bogor</span>
                            </h3>
                            <p class="mb-3" style="color: #2d3748; font-size: 1rem; line-height: 1.8; text-align: justify;">
                                SMK Negeri 4 Bogor adalah sekolah menengah kejuruan negeri yang berkomitmen untuk mencetak generasi yang <strong style="color: #1e40af;">cerdas, berkarakter, dan berdaya saing tinggi</strong>. Sebagai lembaga pendidikan vokasi, SMKN 4 Bogor tidak hanya fokus pada penguasaan keterampilan teknis, tetapi juga menanamkan nilai-nilai <strong style="color: #1e40af;">kedisiplinan, tanggung jawab, dan integritas</strong> kepada setiap peserta didik.
                            </p>
                            <p class="mb-0" style="color: #2d3748; font-size: 1rem; line-height: 1.8; text-align: justify;">
                                Dengan dukungan tenaga pendidik profesional, fasilitas belajar yang lengkap, serta suasana belajar yang kondusif, SMKN 4 Bogor terus berupaya menciptakan lingkungan pendidikan yang <strong style="color: #1e40af;">inspiratif dan menyenangkan</strong>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Section -->
            <div class="row mb-5 fade-in-section">
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #f0f4f0 0%, #e8f0e8 100%); border-radius: 20px; padding: 3rem;">
                        <div class="row text-center">
                            <div class="col-md-3 mb-4 mb-md-0">
                                <h2 class="mb-2" style="font-size: 3.5rem; font-weight: 800; color: #1e40af;">15+</h2>
                                <p class="mb-0" style="color: #1e3a8a; font-weight: 600;">Tahun Pengalaman</p>
                            </div>
                            <div class="col-md-3 mb-4 mb-md-0">
                                <h2 class="mb-2" style="font-size: 3.5rem; font-weight: 800; color: #1e40af;">1066</h2>
                                <p class="mb-0" style="color: #1e3a8a; font-weight: 600;">Siswa Aktif</p>
                            </div>
                            <div class="col-md-3 mb-4 mb-md-0">
                                <h2 class="mb-2" style="font-size: 3.5rem; font-weight: 800; color: #1e40af;">95%</h2>
                                <p class="mb-0" style="color: #1e3a8a; font-weight: 600;">Tingkat Kepuasan</p>
                            </div>
                            <div class="col-md-3">
                                <h2 class="mb-2" style="font-size: 3.5rem; font-weight: 800; color: #1e40af;">4</h2>
                                <p class="mb-0" style="color: #1e3a8a; font-weight: 600;">Jurusan Unggulan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sejarah Section dengan Gambar -->
            <div class="row mb-5 align-items-center fade-in-section" id="sejarah">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                        <div class="card-body" style="padding: 1.25rem 1.5rem;">
                            <h3 class="mb-3" style="font-size: 1.6rem; font-weight: 700; line-height: 1.4; color: #1a202c;">
                                <i class="bi bi-clock-history me-2" style="color: #1e40af;"></i><span style="color: #1e40af;">Sejarah</span> <span style="color: #1a202c;">SMKN 4 Bogor</span>
                            </h3>
                            <p class="mb-3" style="color: #2d3748; font-size: 1rem; line-height: 1.8; text-align: justify;">SMK Negeri 4 Bogor merupakan salah satu sekolah menengah kejuruan negeri yang berdiri di bawah naungan Dinas Pendidikan Provinsi Jawa Barat.</p>
                            <p class="mb-3" style="color: #2d3748; font-size: 1rem; line-height: 1.8; text-align: justify;">Sekolah ini berdiri berdasarkan <strong style="color: #1e40af;">SK Operasional Nomor 421-45-177 Tahun 2009</strong>, tepatnya pada tanggal <strong style="color: #1e40af;">15 Juni 2009</strong>. Pendirian sekolah ini dilatarbelakangi oleh kebutuhan masyarakat Kota Bogor akan pendidikan kejuruan yang dapat menghasilkan lulusan siap kerja, terampil, serta mampu bersaing di era industri dan teknologi digital.</p>
                            <p class="mb-0" style="color: #2d3748; font-size: 1rem; line-height: 1.8; text-align: justify;">Berlokasi di <strong style="color: #1e40af;">Kampung Buntar, Kelurahan Muarasari, Kota Bogor</strong>, SMKN 4 Bogor terus berkembang dan berinovasi dalam memberikan pendidikan berkualitas kepada para siswa.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/sejarah-smkn4.jpg') }}" alt="Sejarah SMKN 4" class="img-fluid rounded shadow" style="border-radius: 20px !important; height: 400px; width: 100%; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1562774053-701939374585?w=600'">
                </div>
            </div>

            <!-- Mengapa Memilih SMKN 4 Bogor -->
            <div class="row mb-5">
                <div class="col-12 mb-4">
                    <h2 class="text-center" style="font-size: 2.5rem; font-weight: 800; color: #1a202c;">Mengapa Memilih SMKN 4 Bogor?</h2>
                    <p class="text-center" style="color: #4a5568; font-size: 1.2rem;">4 alasan mengapa kami adalah pilihan terbaik untuk pendidikan kejuruan Anda</p>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card border-0 h-100" style="background: #f0f4f0; border-radius: 16px;">
                        <div class="card-body p-4">
                            <div class="mb-3" style="width: 60px; height: 60px; background: #1e40af; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-award text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h5 style="color: #1e3a8a; font-weight: 700; margin-bottom: 1rem; font-size: 1.3rem;">Kualitas</h5>
                            <p style="color: #4a5568; font-size: 1.05rem; line-height: 1.7;">Menggunakan kurikulum terbaik yang sesuai dengan kebutuhan industri dan perkembangan teknologi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card border-0 h-100" style="background: #f0f4f0; border-radius: 16px;">
                        <div class="card-body p-4">
                            <div class="mb-3" style="width: 60px; height: 60px; background: #1e40af; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-lightning text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h5 style="color: #1e3a8a; font-weight: 700; margin-bottom: 1rem; font-size: 1.3rem;">Kecepatan</h5>
                            <p style="color: #4a5568; font-size: 1.05rem; line-height: 1.7;">Proses pembelajaran yang efektif dan efisien dengan hasil maksimal dalam waktu singkat</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card border-0 h-100" style="background: #f0f4f0; border-radius: 16px;">
                        <div class="card-body p-4">
                            <div class="mb-3" style="width: 60px; height: 60px; background: #1e40af; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-grid text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h5 style="color: #1e3a8a; font-weight: 700; margin-bottom: 1rem; font-size: 1.3rem;">Beragam</h5>
                            <p style="color: #4a5568; font-size: 1.05rem; line-height: 1.7;">Menyediakan 4 jurusan unggulan dengan berbagai pilihan kompetensi keahlian</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card border-0 h-100" style="background: #f0f4f0; border-radius: 16px;">
                        <div class="card-body p-4">
                            <div class="mb-3" style="width: 60px; height: 60px; background: #1e40af; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-people text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h5 style="color: #1e3a8a; font-weight: 700; margin-bottom: 1rem; font-size: 1.3rem;">Dukungan</h5>
                            <p style="color: #4a5568; font-size: 1.05rem; line-height: 1.7;">Tenaga pendidik profesional dan fasilitas lengkap untuk mendukung pembelajaran</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Identitas Sekolah & Data -->
            <div class="row mb-5">
                <div class="col-lg-6 mb-4">
                    <div class="card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); border-radius: 20px; overflow: hidden;">
                        <div style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); padding: 1rem 1.5rem;">
                            <div class="d-flex align-items-center">
                                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 0.75rem;">
                                    <i class="bi bi-building text-white" style="font-size: 1.2rem;"></i>
                                </div>
                                <h3 class="mb-0 text-white" style="font-weight: 700; font-size: 1.3rem;">Identitas Sekolah</h3>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="mb-2 pb-2" style="border-bottom: 1px solid #e5e7eb;">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-bookmark-fill me-2" style="color: #1e40af; font-size: 1rem;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #6b7280; font-weight: 600; display: block; margin-bottom: 0.25rem;">Nama Lengkap</small>
                                        <span style="color: #1a202c; font-weight: 600; font-size: 1.05rem;">SMK Negeri 4 Bogor</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 pb-2" style="border-bottom: 1px solid #e5e7eb;">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-hash me-2" style="color: #1e40af; font-size: 1rem;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #6b7280; font-weight: 600; display: block; font-size: 0.8rem;">NPSN</small>
                                        <span style="color: #1a202c; font-weight: 600; font-size: 0.95rem;">20258095</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 pb-2" style="border-bottom: 1px solid #e5e7eb;">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-award-fill me-2" style="color: #1e40af; font-size: 1rem;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #6b7280; font-weight: 600; display: block; font-size: 0.8rem;">Status</small>
                                        <span style="color: #1a202c; font-weight: 600; font-size: 0.95rem;">SMK Negeri</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 pb-2" style="border-bottom: 1px solid #e5e7eb;">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-calendar-event me-2" style="color: #1e40af; font-size: 1rem;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #6b7280; font-weight: 600; display: block; font-size: 0.8rem;">Tanggal Berdiri</small>
                                        <span style="color: #1a202c; font-weight: 600; font-size: 0.95rem;">15 Juni 2009</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 pb-2" style="border-bottom: 1px solid #e5e7eb;">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-file-earmark-text me-2" style="color: #1e40af; font-size: 1rem;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #6b7280; font-weight: 600; display: block; font-size: 0.8rem;">SK Pendirian</small>
                                        <span style="color: #1a202c; font-weight: 600; font-size: 0.95rem;">No. 421-45-177 Tahun 2009</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 pb-2" style="border-bottom: 1px solid #e5e7eb;">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-star-fill me-2" style="color: #1e40af; font-size: 1rem;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #6b7280; font-weight: 600; display: block; font-size: 0.8rem;">Akreditasi</small>
                                        <span style="color: #1a202c; font-weight: 600; font-size: 0.95rem;">A (SK 1214/BAN-SM/SK/2018)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 pb-2" style="border-bottom: 1px solid #e5e7eb;">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-geo-alt-fill me-2" style="color: #1e40af; font-size: 1rem;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #6b7280; font-weight: 600; display: block; font-size: 0.8rem;">Alamat</small>
                                        <span style="color: #1a202c; font-weight: 600; font-size: 0.95rem;">KP. Buntar, Kel. Muarasari, Kec. Bogor Selatan</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-globe me-2" style="color: #1e40af; font-size: 1rem;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #6b7280; font-weight: 600; display: block; font-size: 0.8rem;">Website</small>
                                        <a href="https://smkn4bogor.sch.id" target="_blank" style="color: #1e40af; font-weight: 700; text-decoration: none; font-size: 0.95rem;">smkn4bogor.sch.id <i class="bi bi-box-arrow-up-right ms-1" style="font-size: 0.75rem;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); border-radius: 20px; overflow: hidden;">
                        <div style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); padding: 1rem 1.5rem;">
                            <div class="d-flex align-items-center">
                                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 0.75rem;">
                                    <i class="bi bi-people text-white" style="font-size: 1.2rem;"></i>
                                </div>
                                <h3 class="mb-0 text-white" style="font-weight: 700; font-size: 1.3rem;">Data Siswa & Guru</h3>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="mb-2 pb-2" style="border-bottom: 1px solid #e5e7eb;">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-person-badge-fill me-2" style="color: #1e40af; font-size: 1rem;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #6b7280; font-weight: 600; display: block; font-size: 0.8rem;">Kepala Sekolah</small>
                                        <span style="color: #1a202c; font-weight: 600; font-size: 0.95rem;">Drs. Mulya Murprihartono, M.Si</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 pb-2" style="border-bottom: 1px solid #e5e7eb;">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-person-workspace me-2" style="color: #1e40af; font-size: 1rem;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #6b7280; font-weight: 600; display: block; font-size: 0.8rem;">Jumlah Guru</small>
                                        <span style="color: #1a202c; font-weight: 600; font-size: 0.95rem;">45 tenaga pendidik profesional</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 pb-2" style="border-bottom: 1px solid #e5e7eb;">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-briefcase-fill me-2" style="color: #1e40af; font-size: 1rem;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #6b7280; font-weight: 600; display: block; font-size: 0.8rem;">Staff TU</small>
                                        <span style="color: #1a202c; font-weight: 600; font-size: 0.95rem;">22 staff pendukung</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-people-fill me-2" style="color: #1e40af; font-size: 1rem;"></i>
                                    <div style="flex: 1;">
                                        <small style="color: #6b7280; font-weight: 600; display: block; font-size: 0.8rem;">Jumlah Siswa</small>
                                        <span style="color: #1a202c; font-weight: 600; font-size: 0.95rem;">±1.066 siswa (746 L, 320 P)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jurusan / Kompetensi Keahlian -->
            <div class="row mb-5">
                <div class="col-12 mb-4">
                    <h2 class="text-center" style="font-size: 2rem; font-weight: 700; color: #1a202c;"><i class="bi bi-mortarboard me-2" style="color: #1e40af;"></i>Kompetensi Keahlian / Jurusan</h2>
                    <p class="text-center text-muted">4 jurusan unggulan dengan fasilitas dan kurikulum terkini</p>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border-0 h-100" style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); border-radius: 16px;">
                        <div class="card-body p-4 text-white">
                            <div class="d-flex align-items-center">
                                <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                                    <i class="bi bi-router" style="font-size: 2rem;"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1" style="font-weight: 700;">TJKT</h4>
                                    <p class="mb-0" style="font-size: 0.95rem; opacity: 0.9;">Teknik Jaringan Komputer dan Telekomunikasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border-0 h-100" style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); border-radius: 16px;">
                        <div class="card-body p-4 text-white">
                            <div class="d-flex align-items-center">
                                <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                                    <i class="bi bi-controller" style="font-size: 2rem;"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1" style="font-weight: 700;">PPLG</h4>
                                    <p class="mb-0" style="font-size: 0.95rem; opacity: 0.9;">Pengembangan Perangkat Lunak dan Gim</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border-0 h-100" style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); border-radius: 16px;">
                        <div class="card-body p-4 text-white">
                            <div class="d-flex align-items-center">
                                <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                                    <i class="bi bi-car-front" style="font-size: 2rem;"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1" style="font-weight: 700;">Teknik Otomotif</h4>
                                    <p class="mb-0" style="font-size: 0.95rem; opacity: 0.9;">Teknik Kendaraan Ringan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border-0 h-100" style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); border-radius: 16px;">
                        <div class="card-body p-4 text-white">
                            <div class="d-flex align-items-center">
                                <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                                    <i class="bi bi-fire" style="font-size: 2rem;"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1" style="font-weight: 700;">TPFL</h4>
                                    <p class="mb-0" style="font-size: 0.95rem; opacity: 0.9;">Teknik Pengelasan dan Fabrikasi Logam</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="container d-none">
            <div class="agenda-layout d-none">
                <div class="agenda-list-section d-none">
                    <div class="agenda-grid d-none">
                        <!-- Konten agenda disembunyikan -->
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <span>Jl. Raya Tajur, Kp. Buntar, Muarasari, Bogor</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-telephone me-3" style="font-size: 1.2rem; min-width: 1.2rem;"></i>
                            <span>(0251) 7547381</span>
                        </li>
                        <li class="mb-0 d-flex align-items-center">
                            <i class="bi bi-envelope me-3" style="font-size: 1.2rem; min-width: 1.2rem;"></i>
                            <span>info@smkn4bogor.sch.id</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3 text-white">Ikuti Kami</h5>
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
    <script>
        // Calendar functionality
        class Calendar {
            constructor(containerId) {
                this.container = document.getElementById(containerId);
                this.currentDate = new Date();
                this.currentMonth = this.currentDate.getMonth();
                this.currentYear = this.currentDate.getFullYear();
                this.events = this.getEventsFromAgenda();
                this.render();
            }

            getEventsFromAgenda() {
                const events = [];
                const agendaCards = document.querySelectorAll('.agenda-card');
                
                console.log('Total agenda cards found:', agendaCards.length);
                
                // Add hardcoded events for known dates
                const currentYear = new Date().getFullYear();
                events.push({
                    date: new Date(currentYear, 9, 6), // October 6th (month is 0-indexed)
                    title: 'Hari Ulang Tahun SMKN 4 Bogor'
                });
                events.push({
                    date: new Date(currentYear, 7, 17), // August 17th (month is 0-indexed)
                    title: 'Hari Kemerdekaan Indonesia'
                });
                
                agendaCards.forEach((card, index) => {
                    const dateElement = card.querySelector('.agenda-date');
                    if (dateElement) {
                        const dateText = dateElement.textContent.trim();
                        console.log(`Card ${index + 1} date text:`, dateText);
                        
                        // Skip TBD dates
                        if (dateText === 'TBD') {
                            console.log(`Skipping TBD date for card ${index + 1}`);
                            return;
                        }
                        
                        // Extract date from text (assuming format like "15 Januari 2024")
                        const dateMatch = dateText.match(/(\d{1,2})\s+(\w+)\s+(\d{4})/);
                        if (dateMatch) {
                            const day = parseInt(dateMatch[1]);
                            const monthName = dateMatch[2];
                            const year = parseInt(dateMatch[3]);
                            
                            console.log(`Parsed: day=${day}, month=${monthName}, year=${year}`);
                            
                            // Convert month name to number
                            const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            const month = monthNames.indexOf(monthName);
                            
                            if (month !== -1) {
                                const eventDate = new Date(year, month, day);
                                console.log(`Created date:`, eventDate);
                                
                                // Only add if the date is valid
                                if (!isNaN(eventDate.getTime())) {
                                    events.push({
                                        date: eventDate,
                                        title: card.querySelector('.agenda-title').textContent.trim()
                                    });
                                    console.log(`Added event for ${day} ${monthName} ${year}`);
                                }
                            } else {
                                console.log(`Month not found: ${monthName}`);
                            }
                        } else {
                            console.log(`Date pattern not matched for: ${dateText}`);
                        }
                    } else {
                        console.log(`No date element found in card ${index + 1}`);
                    }
                });
                
                console.log('Final events array:', events);
                return events;
            }

            render() {
                const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                  'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                
                const firstDay = new Date(this.currentYear, this.currentMonth, 1);
                const lastDay = new Date(this.currentYear, this.currentMonth + 1, 0);
                const daysInMonth = lastDay.getDate();
                const startingDayOfWeek = firstDay.getDay();

                let html = `
                    <div class="calendar-header">
                        <button class="calendar-nav" onclick="calendar.previousMonth()">‹</button>
                        <div class="calendar-month-year">${monthNames[this.currentMonth]} ${this.currentYear}</div>
                        <button class="calendar-nav" onclick="calendar.nextMonth()">›</button>
                    </div>
                    <div class="calendar-grid">
                        <div class="calendar-day-header">Min</div>
                        <div class="calendar-day-header">Sen</div>
                        <div class="calendar-day-header">Sel</div>
                        <div class="calendar-day-header">Rab</div>
                        <div class="calendar-day-header">Kam</div>
                        <div class="calendar-day-header">Jum</div>
                        <div class="calendar-day-header">Sab</div>
                `;

                // Empty cells for days before the first day of the month
                for (let i = 0; i < startingDayOfWeek; i++) {
                    html += '<div class="calendar-day"></div>';
                }

                // Days of the month
                for (let day = 1; day <= daysInMonth; day++) {
                    const date = new Date(this.currentYear, this.currentMonth, day);
                    const isToday = this.isToday(date);
                    const hasEvent = this.hasEvent(date);
                    
                    let dayClass = 'calendar-day';
                    if (isToday) dayClass += ' today';
                    if (hasEvent) dayClass += ' has-event';
                    
                    html += `<div class="${dayClass}" onclick="calendar.selectDate(${day})">${day}</div>`;
                }

                html += '</div>';
                this.container.innerHTML = html;
            }

            isToday(date) {
                const today = new Date();
                return date.toDateString() === today.toDateString();
            }

            hasEvent(date) {
                return this.events.some(event => 
                    event.date.toDateString() === date.toDateString()
                );
            }

            previousMonth() {
                this.currentMonth--;
                if (this.currentMonth < 0) {
                    this.currentMonth = 11;
                    this.currentYear--;
                }
                this.render();
            }

            nextMonth() {
                this.currentMonth++;
                if (this.currentMonth > 11) {
                    this.currentMonth = 0;
                    this.currentYear++;
                }
                this.render();
            }

            selectDate(day) {
                const selectedDate = new Date(this.currentYear, this.currentMonth, day);
                console.log('Selected date:', selectedDate.toDateString());
                // You can add more functionality here, like filtering agenda items
            }
        }

        // Initialize calendar when page loads
        let calendar;
        document.addEventListener('DOMContentLoaded', function() {
            calendar = new Calendar('calendar');
        });
    </script>
    <script>
        function viewAgendaPhotos(agendaType) {
            // Function to handle viewing photos by agenda type
            // This will be implemented when photos are added
            alert(`Melihat foto untuk agenda: ${agendaType}\n\nFitur ini akan tersedia setelah foto ditambahkan ke sistem.`);
            
            // Future implementation:
            // window.location.href = `/agenda/${agendaType}/photos`;
        }
        
        // Add click event listeners to all agenda cards
        document.addEventListener('DOMContentLoaded', function() {
            const agendaCards = document.querySelectorAll('.agenda-card');
            
            agendaCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Add ripple effect
                    const ripple = document.createElement('div');
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    ripple.style.left = '50%';
                    ripple.style.top = '50%';
                    ripple.style.width = '100px';
                    ripple.style.height = '100px';
                    ripple.style.marginLeft = '-50px';
                    ripple.style.marginTop = '-50px';
                    
                    card.style.position = 'relative';
                    card.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
        
        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
    <script>
        // Filtering: tabs (status) + search (title)
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.agenda-tab');
            const searchInput = document.getElementById('agendaSearch');
            const cards = document.querySelectorAll('.agenda-card');

            let currentStatus = 'all';
            let currentQuery = '';

            function applyFilters() {
                const q = currentQuery.trim();
                cards.forEach(card => {
                    const status = card.getAttribute('data-status') || 'upcoming';
                    const title = (card.getAttribute('data-title') || '').toLowerCase();

                    const statusOk = (currentStatus === 'all') || (status === currentStatus);
                    const queryOk = q === '' || title.includes(q);

                    card.style.display = (statusOk && queryOk) ? '' : 'none';
                });
            }

            tabs.forEach(btn => {
                btn.addEventListener('click', () => {
                    tabs.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    currentStatus = btn.getAttribute('data-status');
                    applyFilters();
                });
            });

            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    currentQuery = e.target.value.toLowerCase();
                    applyFilters();
                });
            }
        });
    </script>

    <script>
        // Prevent auto-scroll to hash on page load
        if (window.location.hash) {
            // Store the hash
            const hash = window.location.hash;
            // Remove hash from URL without scrolling
            history.replaceState(null, null, ' ');
            // Scroll to top immediately
            window.scrollTo(0, 0);
            // After page loads, restore hash without scrolling
            setTimeout(() => {
                history.replaceState(null, null, hash);
            }, 100);
        }
        
        // Intersection Observer untuk animasi fade-in saat scroll - ENHANCED
        document.addEventListener('DOMContentLoaded', function() {
            const fadeInSections = document.querySelectorAll('.fade-in-section');
            const animateOnScroll = document.querySelectorAll('.animate-on-scroll');
            const slideInLeft = document.querySelectorAll('.slide-in-left');
            const slideInRight = document.querySelectorAll('.slide-in-right');
            
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -100px 0px',
                threshold: 0.15
            };
            
            const observer = new IntersectionObserver(function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        // Stop observing after animation for better performance
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            
            // Observe semua section dengan class fade-in-section
            fadeInSections.forEach(section => {
                observer.observe(section);
            });
            
            // Observe semua elemen dengan class animate-on-scroll
            animateOnScroll.forEach(element => {
                observer.observe(element);
            });
            
            // Observe slide-in animations
            slideInLeft.forEach(element => {
                observer.observe(element);
            });
            
            slideInRight.forEach(element => {
                observer.observe(element);
            });
            
            // Smooth scroll untuk internal links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>

