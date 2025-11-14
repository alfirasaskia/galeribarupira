<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Galeri Foto - SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/gallery-navbar.css') }}">
    <style>
        /* Navbar styling for galeri page - sama seperti profile */
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
            --primary-blue: #1f6fd6;
            --secondary-blue: #0056b3;
            --light-blue: #e3f2fd;
            --dark-gray: #333333;
            --light-gray: #666666;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --accent-orange: #ff6b35;
            --accent-green: #4caf50;
            --accent-purple: #9c27b0;
            --accent-red: #f44336;
            --accent-yellow: #ff9800;
            --accent-teal: #009688;
            --border-color: #e5e7eb;
        }

        body {
            background: #ffffff;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 0;
            color: #333333;
        }
        
        /* User view overrides */
        .sidebar { display: none !important; }
        .btn-add-photo { display: none !important; }
        .main-content { 
            margin-left: 0 !important; 
            margin-top: 80px;
            padding: 0;
            min-height: calc(100vh - 80px);
        }
        
        .sidebar-brand {
            padding: 2rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 1rem;
        }
        
        .sidebar-brand h4 {
            color: var(--primary-blue);
            margin: 0;
            font-weight: 700;
            font-size: 1.4rem;
        }
        
        .sidebar-brand .brand-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--primary-blue);
        }
        
        .user-profile {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 1rem;
        }
        
        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: var(--white);
            box-shadow: 0 4px 15px rgba(31, 111, 214, 0.3);
        }
        
        .user-info h6 {
            color: var(--dark-gray);
            margin: 0;
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .user-info p {
            color: var(--light-gray);
            margin: 0;
            font-size: 0.85rem;
        }
        
        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-nav li {
            margin: 0;
        }
        
        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: var(--dark-gray);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0;
            margin: 0.25rem 1rem;
        }
        
        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: var(--light-blue);
            color: var(--primary-blue);
            border-radius: 8px;
        }
        
        .sidebar-nav a i {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }
        
        .main-content {
            margin-left: 0;
            padding: 0;
            min-height: calc(100vh - 100px);
            }

        /* Scroll Animation utility */
        .sa-hidden { opacity: 0; transform: translateY(24px); }
        .sa-show   { opacity: 1; transform: translateY(0); transition: transform 600ms ease, opacity 600ms ease; transition-delay: var(--stagger, 0ms); }
        
        /* Ensure gallery cards are visible by default */
        .gallery-card { opacity: 1; transform: translateY(0); }
            
            /* Hero section */
            .page-header {
            background: #1E3A8A; /* rgb(30, 58, 138) */
            color: white;
            padding: 3.5rem 0 2.5rem;
            text-align: center;
            position: relative;
            align-items: center;
            margin-bottom: 2rem;
            border-radius: 0 0 20px 20px;
            margin-left: 0;
            margin-right: 0;
            margin-top: 0;
            max-width: 100%;
            width: 100%;
            transition: all 0.5s ease;
            box-shadow: 0 10px 40px rgba(30, 64, 175, 0.25);
            overflow: hidden;
            }
            
            /* Decorative soft blobs */
            .page-header::before {
                content: '';
                position: absolute;
                top: -80px;
                right: -120px;
                width: 360px;
                height: 360px;
                background: radial-gradient(closest-side, rgba(255,255,255,0.25), rgba(255,255,255,0) 70%);
                filter: blur(4px);
                opacity: 0.25;
                transform: rotate(8deg);
            }
            
            .page-header::after {
                content: '';
                position: absolute;
                bottom: -100px;
                left: -120px;
                width: 420px;
                height: 420px;
                background: radial-gradient(closest-side, rgba(59,130,246,0.25), rgba(59,130,246,0) 70%);
                filter: blur(8px);
                opacity: 0.25;
            }

            /* Subtle star field overlay */
            .page-header .container { position: relative; z-index: 1; }
            .page-header .container::before,
            .page-header .container::after {
                content: '';
                position: absolute;
                inset: -20px; /* slightly larger than container */
                background-image:
                    radial-gradient(circle, rgba(255,255,255,0.25) 1px, transparent 1px),
                    radial-gradient(circle, rgba(255,255,255,0.18) 1px, transparent 1px),
                    radial-gradient(circle, rgba(255,255,255,0.12) 1px, transparent 1px);
                background-size: 90px 90px, 120px 120px, 150px 150px;
                background-position: 10px 20px, 40px 60px, 75px 30px;
                pointer-events: none;
                z-index: 0;
                opacity: 0.3;
                animation: twinkle 6s ease-in-out infinite;
            }
            .page-header .container::after {
                background-position: 60px 40px, 100px 20px, 130px 90px;
                opacity: 0.2;
                animation-duration: 8s;
                animation-direction: alternate;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            
            /* Welcome badge dengan warna yang cocok dengan navbar */
            .page-header .welcome-badge {
                position: absolute;
                top: 20px;
                right: 20px;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                padding: 0.6rem 1.3rem;
                border-radius: 50px;
                border: 2px solid rgba(30, 64, 175, 0.2);
                color: #1E40AF;
                font-size: 0.9rem;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 0.6rem;
                z-index: 10;
                animation: slide-in 0.5s ease-out;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            }
            
            .welcome-badge i {
                color: #1E40AF;
                font-size: 1.2rem;
                background: rgba(30, 64, 175, 0.1);
                padding: 0.3rem;
                border-radius: 50%;
            }
            
            @keyframes slide-in {
                from {
                    opacity: 0;
                    transform: translateX(20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            
            /* Accent lines dihapus - tidak digunakan */
            .page-header .accent-line {
                display: none;
            }
            
            /* Guest mode uses same enhanced gradient */
            .page-header.guest-mode {
                background: #1E3A8A; /* rgb(30, 58, 138) */
                color: white;
                padding: 3.5rem 0 2.5rem;
                box-shadow: 0 10px 40px rgba(30, 64, 175, 0.25);
                position: relative;
                overflow: hidden;
                border-radius: 0;
                margin-bottom: 2rem;
            }
            
            .page-header.guest-mode::before {
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
                background-size: 50px 50px, 80px 80px, 110px 110px;
                background-position: 0 0, 40px 60px, 130px 270px;
                opacity: 0.3;
                animation: twinkle 3s ease-in-out infinite;
            }
            
            .page-header.guest-mode::after {
                content: '✦';
                position: absolute;
                top: 20%;
                right: 15%;
                font-size: 1.5rem;
                color: rgba(255, 255, 255, 0.6);
                animation: twinkleMove 4s ease-in-out infinite;
            }
            
            @keyframes twinkleMove {
                0%, 100% { 
                    transform: translate(0, 0) rotate(0deg);
                    opacity: 0.6;
                }
                25% { 
                    transform: translate(10px, -10px) rotate(90deg);
                    opacity: 0.8;
                }
                50% { 
                    transform: translate(20px, 0) rotate(180deg);
                    opacity: 0.4;
                }
                75% { 
                    transform: translate(10px, 10px) rotate(270deg);
                    opacity: 0.8;
                }
            }
            
            @keyframes twinkle {
                0%, 100% { opacity: 0.25; }
                50% { opacity: 0.4; }
            }
            
            /* Decorative circles on left and right */
            .page-header.guest-mode .container::before,
            .page-header.guest-mode .container::after {
                content: '';
                position: absolute;
                width: 300px;
                height: 300px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
                z-index: 0;
            }
            
            .page-header.guest-mode .container::before {
                top: -100px;
                left: -150px;
                animation: float 6s ease-in-out infinite;
            }
            
            .page-header.guest-mode .container::after {
                bottom: -100px;
                right: -150px;
                animation: float 8s ease-in-out infinite reverse;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            
            .page-header.guest-mode .page-title {
                color: white;
                font-size: 2.75rem;
                text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            }
            
            .page-header.guest-mode .page-subtitle {
                color: rgba(255, 255, 255, 0.9);
                font-size: 1.05rem;
            }
            
            .page-header .container {
                position: relative;
                z-index: 1;
            }
            
            .hero-content {
                text-align: center;
            }
            
            .hero-image {
                display: none;
            }
            
            .page-title {
            font-size: 2.75rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: white;
            letter-spacing: -0.5px;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }
        
        .page-subtitle {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1rem;
            margin-bottom: 0.5rem;
            font-weight: 400;
            line-height: 1.5;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .page-header.guest-mode .page-title {
            background: white;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .page-stats {
            display: none;
        }
        
        .page-stat-item {
            display: none;
        }
        
        .page-stat-item i {
            display: none;
        }
        
        .page-stat-number {
            display: none;
        }
        
        .page-stat-label {
            display: none;
        }

        /* Filter & Search Bar */
        .filter-search-bar {
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: center;
            margin-top: 1.25rem;
            padding: 0 2rem;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            flex-wrap: wrap;
        }
        
        .filter-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .filter-label {
            font-weight: 600;
            color: white;
            font-size: 0.9rem;
            white-space: nowrap;
        }
        
        .filter-select {
            min-width: 200px;
            padding: 0.6rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #333333;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            padding-right: 2.5rem;
        }
        
        .filter-select:hover {
            border-color: #1f6fd6;
            box-shadow: 0 2px 8px rgba(31, 111, 214, 0.15);
        }
        
        .filter-select:focus {
            outline: none;
            border-color: #1f6fd6;
            box-shadow: 0 0 0 3px rgba(31, 111, 214, 0.1);
        }
        
        .search-box {
            position: relative;
            flex: 1;
            max-width: 350px;
        }
        
        .search-input {
            width: 100%;
            padding: 0.6rem 1rem 0.6rem 2.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #333333;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #1f6fd6;
            box-shadow: 0 0 0 3px rgba(31, 111, 214, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1.1rem;
            pointer-events: none;
        }
        
        .search-btn {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            background: #1E40AF;
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .search-btn:hover {
            background: #1e3a8a;
            transform: translateY(-50%) scale(1.05);
        }
        
        /* Guest mode filter styling */
        .page-header.guest-mode .filter-select {
            background-color: rgba(255, 255, 255, 0.95);
            border-color: rgba(255, 255, 255, 0.3);
        }
        
        .page-header.guest-mode .filter-label {
            color: white;
        }
        
        .page-header.guest-mode .search-input {
            background-color: rgba(255, 255, 255, 0.95);
            border-color: rgba(255, 255, 255, 0.3);
        }
        
        
        .btn-add-photo {
            background: var(--primary-blue);
            border: none;
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-add-photo:hover {
            background: var(--secondary-blue);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(31, 111, 214, 0.3);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            color: var(--dark-gray);
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: var(--primary-blue);
        }
        
        .stat-label {
            font-size: 1rem;
            color: var(--light-gray);
            font-weight: 500;
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-bottom: 3rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 2rem;
        }
        
        .gallery-card {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            cursor: default;
            transition: all 0.3s ease;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }
        
        .gallery-card .gallery-action-bar {
            pointer-events: auto !important;
            z-index: 100;
            position: relative;
        }
        
        .gallery-card .action-btn {
            pointer-events: auto !important;
            z-index: 101;
            position: relative;
        }
        
        .gallery-card .gallery-info-card {
            pointer-events: auto !important;
            z-index: 50;
            position: relative;
        }

        .gallery-card::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e5e7eb;
            z-index: 1;
            pointer-events: none;
        }

        .gallery-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            z-index: 10;
            display: none;
        }
        
        .gallery-category-tag {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            z-index: 10;
            display: none;
        }
        
        /* Instagram-style Three Dots Menu - Di Atas Foto */
        .gallery-top-menu {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.95);
            color: #333333;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            z-index: 300;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 4px;
            pointer-events: auto !important;
            min-width: 40px;
            min-height: 40px;
            justify-content: center;
        }
        
        .gallery-top-menu:hover {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        
        .gallery-top-menu i {
            font-size: 1.1rem;
            pointer-events: none;
        }
        
        .gallery-report-menu {
            background: #f8f9fa;
            color: #666666;
            padding: 4px 6px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            flex-shrink: 0;
            display: none;
            pointer-events: auto;
        }
        
        .gallery-report-menu:hover {
            background: #e5e7eb;
            color: #333333;
            pointer-events: auto;
        }
        
        .gallery-report-menu i {
            font-size: 0.8rem;
            pointer-events: auto;
        }
        
        .gallery-card:hover {
            transform: scale(1.05);
            z-index: 10;
        }

        .gallery-card:hover .gallery-overlay {
            opacity: 1;
            pointer-events: none !important;
        }

        /* Gallery Overlay */
        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.5) 50%, transparent 100%);
            padding: 2rem 1.5rem 1.5rem;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
            pointer-events: none !important;
        }

        .overlay-title {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        /* White Info Card Below Photo - Instagram Style */
        .gallery-info-card {
            background: #ffffff;
            border-radius: 0 0 12px 12px;
            padding: 0.75rem 1rem 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-top: none;
            pointer-events: auto !important;
            position: relative;
            z-index: 10;
        }

        .gallery-info-content {
            display: flex;
            flex-direction: column;
            gap: 0;
            pointer-events: auto;
        }

        /* Photo Info Section - Instagram Style */
        .gallery-photo-info {
            margin-bottom: 0.5rem;
            pointer-events: auto;
        }
        
        .gallery-photo-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
            pointer-events: auto;
        }
        
        .gallery-photo-title {
            color: #262626;
            font-size: 0.95rem;
            font-weight: 600;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
            margin-right: 0.5rem;
            pointer-events: auto;
        }
        
        /* Instagram-style Description for all categories */
        .gallery-description {
            color: #262626;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-top: 0.5rem;
            padding: 0;
            pointer-events: auto;
        }
        
        .gallery-description-text {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin: 0;
        }
        
        .gallery-description-text.expanded {
            -webkit-line-clamp: unset;
        }
        
        .gallery-read-more {
            color: #8e8e8e;
            font-weight: 500;
            cursor: pointer;
            display: inline;
            margin-left: 0.25rem;
        }
        
        .gallery-read-more:hover {
            color: #262626;
        }
        
        /* Enhanced styling for Prestasi & Ekstrakurikuler cards */
        .gallery-card[data-category="Prestasi"],
        .gallery-card[data-category="Ekstrakurikuler"] {
            border: 2px solid #e5e7eb;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        }
        
        .gallery-card[data-category="Prestasi"]:hover,
        .gallery-card[data-category="Ekstrakurikuler"]:hover {
            border-color: #1E40AF;
            box-shadow: 0 10px 35px rgba(30, 64, 175, 0.2);
        }
        
        .gallery-card[data-category="Prestasi"] .gallery-info-card,
        .gallery-card[data-category="Ekstrakurikuler"] .gallery-info-card {
            background: #ffffff;
            padding: 1rem 1.25rem 1.25rem;
        }
        
        /* Category badge for Prestasi & Ekstrakurikuler */
        .gallery-category-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: linear-gradient(135deg, #1E40AF, #3b82f6);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 10;
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.3);
            display: block;
        }
        
        .gallery-card[data-category="Prestasi"] .gallery-category-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }
        
        .gallery-card[data-category="Ekstrakurikuler"] .gallery-category-badge {
            background: linear-gradient(135deg, #1E40AF, #3b82f6);
        }
        
        /* Warna khusus kategori lain */
        /* Prestasi & Penghargaan gabungan juga emas */
        .gallery-card[data-category*="Prestasi"] .gallery-category-badge,
        .gallery-card[data-category*="Penghargaan"] .gallery-category-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }
        .gallery-card[data-category="Penghargaan"] .gallery-category-badge {
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
        }
        .gallery-card[data-category="Kegiatan"] .gallery-category-badge {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        .gallery-card[data-category="Lomba"] .gallery-category-badge {
            background: linear-gradient(135deg, #fb923c, #f97316);
        }
        /* Default fallback */
        .gallery-card[data-category="Tanpa Kategori"] .gallery-category-badge,
        .gallery-card:not([data-category]) .gallery-category-badge {
            background: linear-gradient(135deg, #06b6d4, #0ea5e9);
        }

        /* Kelas warna berbasis mapping server-side (lebih kuat dari fallback) */
        .gallery-category-badge.badge-gold { background: linear-gradient(135deg, #f5c542, #d4a80a) !important; }
        .gallery-category-badge.badge-hero-blue { background: linear-gradient(135deg, #1E40AF, #1e3a8a) !important; }
        .gallery-category-badge.badge-light-blue { background: linear-gradient(135deg, #93c5fd, #60a5fa) !important; }
        .gallery-category-badge.badge-teal { background: linear-gradient(135deg, #14b8a6, #0ea5a3) !important; }
        .gallery-category-badge.badge-dark-blue { background: linear-gradient(135deg, #1e3a8a, #172554) !important; }
        .gallery-category-badge.badge-purple { background: linear-gradient(135deg, #8b5cf6, #6d28d9) !important; }
        .gallery-category-badge.badge-green { background: linear-gradient(135deg, #10b981, #059669) !important; }
        .gallery-category-badge.badge-orange { background: linear-gradient(135deg, #fb923c, #f97316) !important; }
        .gallery-category-badge.badge-gray { background: linear-gradient(135deg, #06b6d4, #0ea5e9) !important; }
        
        .gallery-metadata {
            display: flex;
            flex-direction: row;
            gap: 0.5rem;
            align-items: center;
            pointer-events: auto;
        }

        .gallery-metadata-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            color: #8e8e8e;
            font-size: 0.8rem;
            pointer-events: auto;
        }
        
        .gallery-metadata-item i {
            color: #8e8e8e;
            font-size: 0.85rem;
            width: 14px;
        }

        .gallery-date-info i {
            color: #1f6fd6;
            font-size: 1rem;
        }
        
        .gallery-date-info {
            pointer-events: auto;
        }

        /* Action Bar - Instagram Style */
        .gallery-action-bar {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 0.75rem 0;
            margin-top: 0.5rem;
            gap: 0.75rem;
            border-top: 1px solid #e5e7eb;
            position: relative;
            z-index: 100;
            pointer-events: auto;
            width: 100%;
        }
        
        .gallery-action-group {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            pointer-events: auto;
            margin-right: auto;
        }
        
        .gallery-comment-btn {
            margin-left: auto;
            pointer-events: auto;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            background: transparent;
            border: none;
            color: #333333;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer !important;
            padding: 0.5rem 0.6rem;
            border-radius: 4px;
            transition: all 0.2s ease;
            position: relative;
            z-index: 200;
            pointer-events: auto !important;
            -webkit-tap-highlight-color: transparent;
            min-width: 44px;
            min-height: 44px;
            justify-content: center;
        }
        
        .action-btn * {
            pointer-events: none !important;
            cursor: pointer !important;
        }

        .action-btn:hover {
            background: rgba(0, 0, 0, 0.05);
            transform: scale(1.05);
        }
        
        .action-btn:active {
            transform: scale(0.95);
            background: rgba(0, 0, 0, 0.1);
        }
        
        .gallery-comment-btn .action-btn {
            margin-left: auto;
            pointer-events: auto;
        }
        
        /* Bookmark button always on the right */
        .bookmark-btn {
            margin-left: auto !important;
            pointer-events: auto !important;
        }

        .action-btn i {
            font-size: 1.5rem;
            pointer-events: none;
        }

        .action-btn span {
            font-size: 0.9rem;
            font-weight: 600;
            color: #333333;
            pointer-events: none;
        }

        /* Like Button Special Styling - Instagram Red Heart */
        .like-btn i {
            color: #262626;
            pointer-events: none;
        }
        
        .like-btn.liked i {
            color: #ed4956;
            pointer-events: none;
            animation: likeAnimation 0.3s ease;
        }

        .like-btn:hover i {
            color: #8e8e8e;
            pointer-events: none;
        }
        
        .like-btn.liked:hover i {
            color: #ed4956;
            pointer-events: none;
        }

        /* Comment Button Special Styling - Instagram Style */
        .comment-btn i {
            color: #262626;
            pointer-events: none;
        }
        
        .comment-btn:hover i {
            color: #8e8e8e;
            pointer-events: none;
        }

        /* Share Button Special Styling - Black */
        .share-btn i {
            color: #262626;
            pointer-events: none;
        }
        
        .share-btn:hover i {
            color: #666666;
            pointer-events: none;
            transform: scale(1.15);
        }
        
        /* Bookmark Button Special Styling - Instagram Style */
        .bookmark-btn {
            margin-left: auto;
            pointer-events: auto;
        }
        
        .bookmark-btn i {
            color: #262626;
            pointer-events: none;
        }
        
        .bookmark-btn:hover i {
            color: #8e8e8e;
            pointer-events: none;
        }
        
        .bookmark-btn.bookmarked i {
            color: #262626;
            pointer-events: none;
        }

        /* Download Button Special Styling */
        .download-btn {
            text-decoration: none !important;
            color: #64748b !important;
            pointer-events: auto;
        }
        
        .download-btn:hover {
            color: #059669 !important;
            background: #f1f5f9;
            transform: translateY(-1px);
            pointer-events: auto;
        }

        @keyframes likeAnimation {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); }
            100% { transform: scale(1); }
        }

        /* Responsive Design for Gallery Info Card */
        @media (max-width: 768px) {
            .gallery-info-card {
                padding: 0.75rem;
            }
            
            .gallery-info-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
            
            .gallery-action-bar {
                gap: 0.6rem;
                padding: 0.75rem 0;
            }
            
            .action-btn {
                justify-content: center;
                padding: 0.5rem 0.4rem;
                font-size: 0.8rem;
                min-width: 42px;
                min-height: 42px;
            }
            
            .action-btn i {
                font-size: 1.3rem;
            }
            
            .action-btn span {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 600px) {
            .gallery-action-bar {
                gap: 0.5rem;
                padding: 0.75rem 0;
            }
            
            .action-btn {
                padding: 0.45rem 0.35rem;
                font-size: 0.75rem;
                min-width: 40px;
                min-height: 40px;
            }
            
            .action-btn i {
                font-size: 1.2rem;
            }
            
            .action-btn span {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .gallery-action-buttons {
                gap: 0.4rem;
            }
            
            .gallery-action-bar {
                gap: 0.4rem;
                padding: 0.75rem 0;
            }
            
            .action-btn {
                padding: 0.4rem 0.3rem;
                font-size: 0.7rem;
                min-width: 38px;
                min-height: 38px;
            }
            
            .action-btn i {
                font-size: 1.1rem;
            }
            
            .action-btn span {
                font-size: 0.7rem;
            }
        }
        
        @media (max-width: 380px) {
            .gallery-action-bar {
                gap: 0.35rem;
                padding: 0.6rem 0;
            }
            
            .action-btn {
                padding: 0.35rem 0.25rem;
                font-size: 0.65rem;
                min-width: 36px;
                min-height: 36px;
            }
            
            .action-btn i {
                font-size: 1rem;
            }
            
            .action-btn span {
                font-size: 0.65rem;
            }
        }
        
        .gallery-media {
            position: relative;
            width: 100%;
            background: #f8f9fa;
            overflow: hidden;
            aspect-ratio: 4 / 3;
            min-height: 220px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .gallery-media::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none !important;
        }

        .gallery-card:hover .gallery-media::after {
            opacity: 1;
            pointer-events: none !important;
        }


        .gallery-media .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1), filter 0.3s ease;
            filter: brightness(1) contrast(1);
        }

        /* Foto tampil normal untuk semua user */
        .gallery-card:hover .gallery-media .gallery-image {
            transform: scale(1.08);
            filter: brightness(1.05) contrast(1.05);
            pointer-events: none;
        }

        /* Fallback: jika wrapper gallery-media tidak ter-render */
        .gallery-card > img.gallery-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            background: #f8fafc;
            display: block;
            pointer-events: none;
        }
        
        .gallery-content {
            display: none;
            pointer-events: auto;
        }
        
        .gallery-title {
            color: #1e293b;
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
            line-height: 1.4;
            transition: color 0.3s ease;
            pointer-events: auto;
        }
        
        .gallery-card:hover .gallery-title {
            color: #1f6fd6;
            pointer-events: auto;
        }
        
        .gallery-date {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
            pointer-events: auto;
        }
        
        .gallery-date i {
            color: #1f6fd6;
            font-size: 1rem;
            pointer-events: auto;
        }

        /* Description pill inside gallery card */
        .gallery-description {
            background: rgba(37, 99, 235, 0.04);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 0.75rem 0.9rem;
            margin: 0.5rem 0 0.25rem;
            color: #475569;
            line-height: 1.5;
        }
        .gallery-description-text {
            margin: 0;
            white-space: normal;
            word-break: break-word;
        }

        /* Gallery Stats */
        .gallery-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid #e2e8f0;
            pointer-events: auto;
        }

        .stat-btn {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            background: transparent;
            border: none;
            color: #64748b;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0.4rem 0.6rem;
            border-radius: 6px;
            pointer-events: auto;
        }

        .stat-btn:hover {
            background: #f1f5f9;
            color: #1f6fd6;
            pointer-events: auto;
        }

        .stat-btn i {
            font-size: 1.1rem;
            pointer-events: auto;
        }

        .like-btn.liked {
            color: #ef4444;
            pointer-events: auto;
        }

        .like-btn.liked i {
            animation: likeAnimation 0.3s ease;
            pointer-events: auto;
        }

        @keyframes likeAnimation {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.3); }
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #64748b;
            font-size: 0.9rem;
        }

        .stat-item i {
            font-size: 1.1rem;
        }

        .stat-count {
            font-weight: 600;
            min-width: 20px;
        }
        
        .gallery-actions {
            display: none;
        }
        
        .btn-action { display: none; }

        .btn-gallery {
            display: none;
        }
        
        .btn-view { display: none; }
        
        /* Responsive Design */
        @media (max-width: 1400px) {
            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
            }
        }
        
        @media (max-width: 1024px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
                padding: 0 1rem;
            }
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 0;
            }
            
            .page-header {
                padding: 6rem 0 4rem;
                min-height: 35vh;
            }
            
            .page-title {
                font-size: 2.2rem;
                margin-bottom: 1rem;
            }
            
            .page-subtitle {
                font-size: 1.05rem;
                padding: 0 1rem;
            }
            
            .page-stats {
                gap: 2rem;
            }
            
            .page-stat-number {
                font-size: 1.6rem;
            }
            
            .category-bar-wrapper {
                padding: 0 1rem;
                margin-bottom: 2rem;
            }
            
            .category-bar {
                padding: 0.85rem 1rem;
                border-radius: 14px;
            }
            
            .category-bar-label {
                width: 100%;
                margin-bottom: 0.5rem;
                font-size: 0.95rem;
            }
            
            .cat-pill {
                padding: 0.55rem 1.2rem;
                font-size: 0.9rem;
            }
            
            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                padding: 0 1rem;
            }
            
            .gallery-card {
                min-height: 340px;
            }
            
            .gallery-media {
                min-height: 200px;
            }
            
            .gallery-content {
                padding: 1.2rem 1.3rem;
            }
            
            .gallery-title {
                font-size: 1.2rem;
            }
            
            .gallery-description {
                font-size: 0.95rem;
            }
        }
        
        @media (max-width: 480px) {
            .main-content {
                padding: 0;
            }
            
            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 1.2rem;
                padding: 0 0.5rem;
            }
            
            .gallery-card {
                min-height: 320px;
            }
            
            .gallery-media {
                min-height: 160px;
            }
            
            .gallery-content {
                padding: 1rem;
            }
            
            .gallery-title {
                font-size: 1.3rem;
            }
            
            .gallery-description {
                font-size: 0.9rem;
            }
            
            .category-bar-wrapper {
                padding: 0 0.75rem;
            }
            
            .category-bar {
                padding: 0.75rem 0.85rem;
            }
            
            .cat-pill {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }
            
            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
                padding: 0 0.75rem;
            }
            
            .gallery-card {
                min-height: 320px;
                border-radius: 14px;
            }
            
            .gallery-media {
                min-height: 180px;
            }
            
            .gallery-content {
                padding: 1rem 1.2rem;
            }
            
            .gallery-title {
                font-size: 1.1rem;
            }
            
            .gallery-description {
                font-size: 0.9rem;
            }
        }
        
        .btn-edit {
            background: #f59e0b;
            color: var(--white);
        }
        
        .btn-edit:hover {
            background: #d97706;
            transform: scale(1.1);
        }
        
        .btn-delete {
            background: #ef4444;
            color: var(--white);
        }
        
        .btn-delete:hover {
            background: #dc2626;
            transform: scale(1.1);
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--light-gray);
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        .sidebar-toggle {
            display: none;
        }
        
        .sidebar-toggle:hover {
            background: var(--secondary-blue);
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(31, 111, 214, 0.4);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 1.25rem 0 2rem;
            }
            
            .page-title {
                font-size: 3rem;
            }
            
            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .sidebar-toggle {
                display: block !important;
            }
            
            /* Responsive welcome badge */
            .page-header .welcome-badge {
                top: 10px;
                right: 10px;
                font-size: 0.75rem;
                padding: 0.4rem 1rem;
            }
            
            .welcome-badge i {
                font-size: 0.9rem;
            }
            
            .page-header {
                border-radius: 0 0 15px 15px;
            }
        }
        
        @media (max-width: 480px) {
            .page-header .welcome-badge {
                position: relative;
                top: 0;
                right: 0;
                margin: 0 auto 1rem;
                width: fit-content;
            }
            
            .page-header {
                border-radius: 0 0 12px 12px;
            }
        }

        /* Photo Modal Pop-up Styles */
        .photo-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.95);
            display: none;
            z-index: 2000;
            animation: fadeIn 0.3s ease;
            padding: 20px;
            overflow-y: auto;
        }

        .photo-modal-backdrop.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .photo-modal-container {
            position: relative;
            width: 100%;
            max-width: 85vw;
            max-height: 85vh;
            background: #000;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.8);
            animation: slideUp 0.3s ease;
            display: flex;
            flex-direction: column;
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

        .photo-modal-image {
            width: 100%;
            height: auto;
            max-height: 70vh;
            object-fit: contain;
            display: block;
            flex: 1;
        }

        .photo-modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #000;
            z-index: 2010;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .photo-modal-close:hover {
            background: #fff;
            transform: scale(1.1);
        }

        .photo-modal-info {
            position: relative;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.95), rgba(0, 0, 0, 0.7));
            color: white;
            padding: 20px 20px 15px;
            z-index: 2005;
            min-height: auto;
        }

        .photo-modal-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0;
            color: white;
            line-height: 1.4;
            word-break: break-word;
        }

        .photo-modal-stats {
            display: none;
        }

        .photo-modal-stat-item {
            display: none;
        }

        .photo-modal-stat-item i {
            display: none;
        }

        .photo-modal-stat-count {
            display: none;
        }

        .photo-modal-actions {
            display: none;
        }

        .photo-modal-action-btn {
            display: none;
        }

        .photo-modal-action-btn.liked i {
            display: none;
        }

        .photo-modal-action-btn.bookmarked i {
            display: none;
        }

        .photo-modal-action-btn#photoModalViewsBtn {
            display: none;
        }

        .photo-modal-action-btn#photoModalViewsBtn:hover {
            display: none;
        }

        /* Responsive Photo Modal */
        @media (max-width: 768px) {
            .photo-modal-backdrop {
                padding: 15px;
            }

            .photo-modal-container {
                max-width: 95vw;
                max-height: 90vh;
                border-radius: 10px;
            }

            .photo-modal-image {
                max-height: 65vh;
            }

            .photo-modal-close {
                top: 12px;
                right: 12px;
                width: 44px;
                height: 44px;
                font-size: 1.2rem;
            }

            .photo-modal-info {
                padding: 18px 18px 12px;
            }

            .photo-modal-title {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .photo-modal-backdrop {
                padding: 10px;
                align-items: flex-start;
                padding-top: 60px;
            }

            .photo-modal-container {
                max-width: 100vw;
                max-height: 85vh;
                border-radius: 8px;
            }

            .photo-modal-image {
                max-height: 60vh;
            }

            .photo-modal-close {
                top: 10px;
                right: 10px;
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }

            .photo-modal-info {
                padding: 15px 15px 10px;
            }

            .photo-modal-title {
                font-size: 1rem;
            }
        }

        @media (max-width: 360px) {
            .photo-modal-backdrop {
                padding: 8px;
                padding-top: 50px;
            }

            .photo-modal-container {
                max-width: 100vw;
                border-radius: 6px;
            }

            .photo-modal-image {
                max-height: 55vh;
            }

            .photo-modal-close {
                top: 8px;
                right: 8px;
                width: 36px;
                height: 36px;
                font-size: 1rem;
            }

            .photo-modal-info {
                padding: 12px 12px 8px;
            }

            .photo-modal-title {
                font-size: 0.95rem;
            }
        }

        /* Login Popup Modal */
        .login-popup-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            z-index: 3000;
            max-width: 500px;
            width: 90%;
            animation: popIn 0.3s ease;
            display: none;
        }

        .login-popup-modal.show {
            display: block;
        }

        @keyframes popIn {
            from {
                transform: translate(-50%, -50%) scale(0.8);
                opacity: 0;
            }
            to {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
        }

        .login-popup-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2999;
            display: none;
        }

        .login-popup-backdrop.show {
            display: block;
        }

        .login-popup-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        .login-popup-icon {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-popup-icon i {
            font-size: 3rem;
            color: #1E40AF;
        }

        .login-popup-title {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }

        .login-popup-message {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .login-popup-buttons {
            display: flex;
            gap: 12px;
        }

        .login-popup-btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .login-popup-btn-primary {
            background: linear-gradient(135deg, #1E40AF 0%, #1e3a8a 100%);
            color: white;
        }

        .login-popup-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.3);
        }

        .login-popup-btn-secondary {
            background: #f0f0f0;
            color: #333;
            border: 1px solid #e0e0e0;
        }

        .login-popup-btn-secondary:hover {
            background: #e8e8e8;
        }

        /* Views Button Styling */
        .action-btn.views-btn {
            color: #262626;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 3px;
            font-size: 0.9rem;
            font-weight: 500;
            padding: 0;
            background: none;
            border: none;
            cursor: pointer;
        }

        .action-btn.views-btn:hover {
            color: #1f6fd6;
            transform: scale(1.1);
        }

        .action-btn.views-btn i {
            font-size: 1.1rem;
        }

        .views-count-badge {
            font-size: 0.85rem;
            font-weight: 600;
            min-width: auto;
            text-align: center;
        }

        /* Views Count Text */
        .views-count-text {
            transition: all 0.3s ease;
        }

        .views-count-text:hover {
            color: #1f6fd6 !important;
        }
    </style>
</head>
<body>
    @include('gallery.partials.navbar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header" id="pageHeader">
            <div class="container">
                <h1 class="page-title" id="heroTitle" data-aos="fade-down">Galeri Foto SMKN 4 Bogor</h1>
                <p class="page-subtitle" id="heroSubtitle" data-aos="fade-up" data-aos-delay="100">Dokumentasi kegiatan, prestasi, dan momen berharga dalam perjalanan pendidikan kami</p>
                
                <!-- Filter & Search Bar -->
                <div class="filter-search-bar" data-aos="fade-up" data-aos-delay="200">
                    <!-- Filter Kategori -->
                    <div class="filter-group">
                        <label class="filter-label">
                            <i class="bi bi-funnel me-1"></i>Kategori:
                        </label>
                        <select id="categoryFilter" class="filter-select">
                            <option value="all">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->nama }}">{{ $kategori->nama }}</option>
                        @endforeach
                        </select>
                    </div>
                    
                    <!-- Sort Terbaru/Terlama -->
                    <div class="filter-group">
                        <label class="filter-label">
                            <i class="bi bi-sort-down me-1"></i>Urutkan:
                        </label>
                        <select id="sortFilter" class="filter-select">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="most-liked">Paling Disukai</option>
                        </select>
                </div>
                    
                    <!-- Search Box -->
                    <div class="search-box">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" id="searchInput" class="search-input" placeholder="Cari foto...">
                        <button class="search-btn" onclick="performSearch()">Cari</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Photo Grid -->
            <div class="gallery-grid" id="galleryGrid">
            @if(isset($fotos) && $fotos->count() > 0)
                @foreach($fotos as $index => $foto)
                        @php
                            // Try different path variations for compatibility
                            $imagePath = '';
                            $downloadPath = '';
                            
                            if ($foto->file_path) {
                                // Try storage path first (new photos)
                                if (file_exists(public_path('storage/' . $foto->file_path))) {
                                    $imagePath = asset('storage/' . $foto->file_path);
                                    $downloadPath = $imagePath;
                                } 
                                // Try direct public path (old photos)
                                elseif (file_exists(public_path($foto->file_path))) {
                                    $imagePath = asset($foto->file_path);
                                    $downloadPath = $imagePath;
                                }
                                // Try without leading slash
                                elseif (file_exists(public_path(ltrim($foto->file_path, '/')))) {
                                    $imagePath = asset(ltrim($foto->file_path, '/'));
                                    $downloadPath = $imagePath;
                                }
                            }
                            
                            // Fallback to thumbnail_path if exists
                            if (!$imagePath && isset($foto->thumbnail_path) && $foto->thumbnail_path) {
                                if (file_exists(public_path($foto->thumbnail_path))) {
                                    $imagePath = asset($foto->thumbnail_path);
                                }
                            }
                        @endphp
                    <div class="gallery-card sa-show" data-category="{{ $foto->kategori_nama ?? 'Tanpa Kategori' }}" data-foto-id="{{ $foto->id }}" data-judul="{{ e($foto->judul ?? 'Foto') }}" data-image-url="{{ $imagePath }}" data-aos="fade-up" data-aos-delay="{{ ($index % 12) * 50 }}">
                        <div class="gallery-media">
                            @if($imagePath)
                                <img src="{{ $imagePath }}" 
                                     alt="{{ $foto->judul ?? 'Foto' }}" 
                                     class="gallery-image"
                                     loading="lazy"
                                     decoding="async"
                                     onerror="this.parentElement.innerHTML='<i class=\'fas fa-image fa-3x text-muted\'></i>'">
                            @else
                                <i class="fas fa-image fa-3x text-muted"></i>
                            @endif
                            
                            <!-- Category Badge (selalu tampil, warna ditentukan via mapping) -->
                            @php
                                $rawCat = $foto->kategori_nama ?? 'Tanpa Kategori';
                                $lower = strtolower($rawCat);
                                $badgeClass = 'badge-gray';
                                if (strpos($lower, 'prestasi') !== false || strpos($lower, 'penghargaan') !== false) {
                                    $badgeClass = 'badge-gold';
                                } elseif (strpos($lower, 'ekstrakurikuler') !== false || strpos($lower, 'ekstrakulikuler') !== false || strpos($lower, 'ekstra') !== false) {
                                    $badgeClass = 'badge-hero-blue';
                                } elseif (strpos($lower, 'montour') !== false || strpos($lower, 'mountour') !== false) {
                                    $badgeClass = 'badge-light-blue';
                                } elseif (strpos($lower, 'pelepasan pkl') !== false || strpos($lower, 'pkl') !== false) {
                                    $badgeClass = 'badge-teal';
                                } elseif (strpos($lower, 'kegiatan sekolah') !== false) {
                                    $badgeClass = 'badge-dark-blue';
                                } elseif (strpos($lower, 'smarttren') !== false) {
                                    $badgeClass = 'badge-purple';
                                } elseif (strpos($lower, 'kegiatan') !== false) {
                                    $badgeClass = 'badge-green';
                                } elseif (strpos($lower, 'lomba') !== false) {
                                    $badgeClass = 'badge-orange';
                                }
                            @endphp
                            @if (strpos($lower, 'prestasi') !== false || strpos($lower, 'ekstrakurikuler') !== false || strpos($lower, 'ekstrakulikuler') !== false || strpos($lower, 'ekstra') !== false)
                                <div class="gallery-category-badge {{ $badgeClass }}">{{ $rawCat }}</div>
                            @endif
                            
                            <!-- Instagram-style Three Dots Menu - Di Atas Foto -->
                            <button class="gallery-top-menu" data-foto-id="{{ $foto->id }}" data-action="options" title="Opsi" style="pointer-events: auto !important;">
                                <i class="bi bi-three-dots" style="pointer-events: none !important;"></i>
                            </button>
                            
                            <div class="gallery-overlay">
                                <h5 class="overlay-title">{{ $foto->judul ?? 'Foto' }}</h5>
                            </div>
                        </div>
                        
                        <!-- Dark Card Below Photo -->
                        <div class="gallery-info-card">
                            <!-- Photo Info Section -->
                            <div class="gallery-photo-info">
                                <div class="gallery-photo-header">
                                    <div class="gallery-photo-title">{{ $foto->judul ?? 'Foto' }}</div>
                                </div>
                                
                                @if(!empty($foto->deskripsi))
                                    <!-- Instagram-style Description -->
                                    <div class="gallery-description">
                                        <div class="gallery-description-text" id="desc-{{ $foto->id }}">
                                            {{ $foto->deskripsi }}
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="gallery-metadata">
                                    <div class="gallery-metadata-item">
                                    <i class="bi bi-calendar3"></i>
                                        <span>{{ optional($foto->created_at)->format('d M Y') ?? '08 Oct 2025' }}</span>
                                    </div>
                                </div>
                                </div>
                                
                            <!-- Action Bar - Minimalist Style -->
                            <div class="gallery-action-bar">
                                <div class="gallery-action-group">
                                    <button class="action-btn like-btn {{ $foto->is_liked_by_user ? 'liked' : '' }}" data-foto-id="{{ $foto->id }}" data-action="like" title="Suka" style="pointer-events: auto !important;">
                                        <i class="bi {{ $foto->is_liked_by_user ? 'bi-heart-fill' : 'bi-heart' }}" style="pointer-events: none !important;"></i>
                                    </button>
                                    <button class="action-btn comment-btn" data-foto-id="{{ $foto->id }}" data-action="comment" title="Komentar" style="pointer-events: auto !important;">
                                        <i class="bi bi-chat" style="pointer-events: none !important;"></i>
                                    </button>
                                </div>
                                <button class="action-btn bookmark-btn {{ $foto->is_bookmarked_by_user ?? false ? 'bookmarked' : '' }}" data-foto-id="{{ $foto->id }}" data-action="bookmark" title="Simpan" style="pointer-events: auto !important;">
                                    <i class="bi {{ $foto->is_bookmarked_by_user ?? false ? 'bi-bookmark-fill' : 'bi-bookmark' }}" style="pointer-events: none !important;"></i>
                                </button>
                            </div>
                            
                            <!-- Likes Count -->
                            <div style="padding: 0.25rem 0; font-size: 0.9rem;">
                                <span style="font-weight: 600; color: #262626;"><span class="likes-count" data-foto-id="{{ $foto->id }}">{{ $foto->total_likes ?? 0 }}</span> suka</span>
                            </div>
                        </div>
                    </div>
                @endforeach
        @else
            <div class="empty-state">
                    <i class="fas fa-images"></i>
                    <h4>Belum ada foto</h4>
                <p>Belum ada foto yang tersedia saat ini</p>
            </div>
        @endif
        </div>
    </div>

    <!-- Login Modal DIHAPUS - Langsung redirect ke /login -->

    <!-- Photo Detail Modal -->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content" style="background: #000; border: none;">
                <div class="modal-header" style="border: none; position: absolute; top: 0; right: 0; z-index: 1000;">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0" style="position: relative;">
                    <img id="modalImage" src="" alt="Foto" style="width: 100%; height: auto; max-height: 80vh; object-fit: contain;">
                    
                    <!-- Floating Action Buttons -->
                    <div style="position: absolute; bottom: 20px; right: 20px; display: flex; flex-direction: column; gap: 15px;">
                        <button class="modal-action-btn" id="modalLikeBtn" onclick="handleModalLike()" style="background: rgba(255,255,255,0.9); border: none; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.3); transition: all 0.3s ease;">
                            <i class="bi bi-heart-fill" style="font-size: 1.5rem; color: #ef4444;"></i>
                        </button>
                        <button class="modal-action-btn" onclick="handleModalBookmark()" style="background: rgba(255,255,255,0.9); border: none; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.3); transition: all 0.3s ease;">
                            <i class="bi bi-bookmark-fill" style="font-size: 1.5rem; color: #1f6fd6;"></i>
                        </button>
                    </div>
                    
                    <!-- Photo Info -->
                    <div style="position: absolute; bottom: 20px; left: 20px; color: white; max-width: 50%;">
                        <h4 id="modalTitle" style="font-weight: 700; margin-bottom: 10px; text-shadow: 0 2px 4px rgba(0,0,0,0.5);"></h4>
                        <div style="display: flex; gap: 20px; font-size: 0.95rem;">
                            <span><i class="bi bi-heart-fill" style="color: #ef4444;"></i> <span id="modalLikes">0</span></span>
                            <span><i class="bi bi-chat-fill" style="color: #1f6fd6;"></i> <span id="modalComments">0</span></span>
                            <span><i class="bi bi-eye-fill" style="color: #10b981;"></i> <span id="modalViews">0</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Photo Modal Pop-up Backdrop -->
    <div class="photo-modal-backdrop" id="photoModalBackdrop">
        <div class="photo-modal-container">
            <button class="photo-modal-close" onclick="closePhotoModal()">
                <i class="bi bi-x-lg"></i>
            </button>
            
            <img id="photoModalImage" class="photo-modal-image" src="" alt="Foto">
            
            <!-- Photo Info Section -->
            <div class="photo-modal-info">
                <h3 class="photo-modal-title" id="photoModalTitle">Judul Foto</h3>
            </div>
        </div>
    </div>

    <!-- Login Popup Modal -->
    <div class="login-popup-backdrop" id="loginPopupBackdrop"></div>
    <div class="login-popup-modal" id="loginPopupModal">
        <button class="login-popup-close" onclick="closeLoginPopup()">
            <i class="bi bi-x-lg"></i>
        </button>
        <div class="login-popup-icon">
            <i class="bi bi-lock"></i>
        </div>
        <h2 class="login-popup-title">Login Diperlukan</h2>
        <p class="login-popup-message">
            Anda harus login terlebih dahulu untuk dapat menyukai, berkomentar, dan menyimpan foto favorit Anda.
        </p>
        <div class="login-popup-buttons">
            <button class="login-popup-btn login-popup-btn-secondary" onclick="closeLoginPopup()">
                Batal
            </button>
            <button class="login-popup-btn login-popup-btn-primary" onclick="redirectToLogin()">
                Login Sekarang
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/galeri-actions.js') }}"></script>
    <script>
        // BERSIHKAN localStorage dulu sebelum cek login
        localStorage.removeItem('galleryUser');
        sessionStorage.removeItem('galleryUser');
        
        // Check if user is logged in from backend session ONLY
        // PENTING: Harus boolean, bukan string!
        // HANYA USER yang bisa akses galeri, BUKAN ADMIN
        @php
            $userId = session()->get('user_id');
            $isLoggedIn = !empty($userId); // Hanya cek user_id, TIDAK cek admin_id
        @endphp
        
        const isUserLoggedIn = {{ $isLoggedIn ? 'true' : 'false' }};
        window.isUserLoggedIn = isUserLoggedIn; // Make it globally accessible
        window.APP_URL = '{{ config("app.url") }}'; // Make APP_URL globally accessible for JS files
        
        // Login System - HANYA dari backend session
        let isLoggedIn = isUserLoggedIn;
        let currentUser = isUserLoggedIn ? {
            id: {{ $userId ?? 0 }},
            name: '{{ session()->get('user_name') ?? '' }}',
            email: '{{ session()->get('user_email') ?? '' }}',
            type: 'user'
        } : null;
        
        // Log status login untuk debugging - DETAIL
        console.log('=== STATUS LOGIN DETAIL (USER ONLY) ===');
        console.log('RAW Session user_id:', '{{ $userId ?? 'null' }}');
        console.log('RAW Session user_name:', '{{ session()->get('user_name') ?? 'null' }}');
        console.log('RAW Session user_type:', '{{ session()->get('user_type') ?? 'null' }}');
        console.log('---');
        console.log('isUserLoggedIn:', isUserLoggedIn);
        console.log('typeof isUserLoggedIn:', typeof isUserLoggedIn);
        console.log('!isUserLoggedIn:', !isUserLoggedIn);
        console.log('currentUser:', currentUser);
        console.log('NOTE: Admin tidak bisa akses galeri, hanya user!');
        console.log('======================================');

        // Restore like counts from localStorage on page load
        // Function ini tidak diperlukan lagi karena like status sudah dari database
        function restoreLikeCounts() {
            console.log('Like counts loaded from database');
        }
        
        // Check login status on page load
        function checkLoginStatus() {
            // TIDAK MENGGUNAKAN localStorage lagi untuk login
            // Hanya menggunakan backend session
            console.log('Login status dari backend:', isUserLoggedIn);
        }

        // Update login UI
        function updateLoginUI() {
            const loginBtn = document.getElementById('loginBtn');
            const userStatus = document.getElementById('userStatus');
            const userName = document.getElementById('userName');

            if (isLoggedIn) {
                loginBtn.classList.add('d-none');
                userStatus.classList.remove('d-none');
                userName.textContent = currentUser.name || currentUser.email;
            } else {
                loginBtn.classList.remove('d-none');
                userStatus.classList.add('d-none');
            }
        }

        // showLoginModal dan loginForm DIHAPUS - Langsung redirect ke /login

        // Logout function - Redirect ke route logout
        function logout() {
            window.location.href = '/logout';
        }

        // Check if user needs to login - HANYA cek backend session
        function requireLogin(action) {
            console.log('requireLogin called with action:', action);
            console.log('isUserLoggedIn from backend:', isUserLoggedIn);
            
            // HANYA cek backend session, TIDAK menggunakan localStorage
            if (isUserLoggedIn) {
                console.log('User is logged in via backend session');
                return Promise.resolve(true);
            }
            
            // If not logged in, redirect to login page
            console.log('User not logged in, redirecting to /login');
            sessionStorage.setItem('intended_url', window.location.href);
            window.location.href = '/login';
            return Promise.resolve(false);
        }

        // Debug function to test buttons
        function testButton(fotoId) {
            console.log('testButton called with fotoId:', fotoId);
            alert('Button clicked! Foto ID: ' + fotoId);
        }

        // Test function to verify JavaScript is working
        function testJS() {
            console.log('JavaScript is working!');
            alert('JavaScript is working!');
        }

        // Make testJS available globally
        window.testJS = testJS;
        
        // Test function for button clicks
        function testButtonClick() {
            console.log('Button click test function called');
            alert('Button click test - JavaScript is working!');
        }
        
        // Make testButtonClick available globally
        window.testButtonClick = testButtonClick;

        // Handle Download Function
        function handleDownload(fotoId, filePath, fileName) {
            // Check if user is logged in
            if (!isUserLoggedIn) {
                // User not logged in - save intended URL and redirect to login page
                sessionStorage.setItem('intended_url', window.location.href);
                
                // LANGSUNG redirect ke login tanpa popup
                window.location.href = '/login';
                return false; // STOP eksekusi
            }
            
            // Create download link
            const link = document.createElement('a');
            link.href = filePath;
            link.download = fileName;
            link.target = '_blank';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Show success message
            Swal.fire({
                title: 'Download Berhasil!',
                text: 'Foto berhasil diunduh',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
                confirmButtonColor: '#1f6fd6'
            });
        }

        // Handle Like Function - Instagram Style with TOGGLE (Like/Unlike)
        window.handleLike = function(fotoId, event) {
            console.log('handleLike called with fotoId:', fotoId);
            console.log('isUserLoggedIn:', isUserLoggedIn);
            
            // STOP event dulu - CRITICAL untuk mencegah redirect
            if (event) {
                event.preventDefault();
                event.stopPropagation();
                event.stopImmediatePropagation();
            }
            
            // Check if user is logged in - LANGSUNG REDIRECT tanpa popup
            if (!isUserLoggedIn) {
                // User not logged in - save intended URL and redirect to login page
                sessionStorage.setItem('intended_url', window.location.href);
                
                // LANGSUNG redirect ke login tanpa popup
                window.location.href = '/login';
                return false; // STOP eksekusi
            }
            
            // HANYA jalankan jika sudah login
            console.log('User sudah login, menjalankan like functionality');
            
            // Toggle like functionality - BISA LIKE DAN UNLIKE
            const likeBtn = document.querySelector(`.like-btn[data-foto-id="${fotoId}"]`);
            const likesCountSpan = document.querySelector(`.likes-count[data-foto-id="${fotoId}"]`);
            
            if (likeBtn) {
                const icon = likeBtn.querySelector('i');
                
                // TRACK ACTIVITY ke database - server akan handle like/unlike
                fetch('/api/track-activity', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        foto_id: fotoId,
                        user_id: currentUser?.id || null,
                        activity_type: 'like'
                    })
                }).then(response => response.json())
                  .then(data => {
                      console.log('Activity tracked:', data);
                      
                      if (data.success) {
                          // Update UI berdasarkan response dari server
                          if (data.action === 'liked') {
                              // LIKE - Tambah like
                              likeBtn.classList.add('liked');
                              icon.classList.remove('bi-heart');
                              icon.classList.add('bi-heart-fill');
                              
                              // Animasi bounce
                              likeBtn.style.transform = 'scale(1.3)';
                              setTimeout(() => {
                                  likeBtn.style.transform = 'scale(1)';
                              }, 200);
                          } else if (data.action === 'unliked') {
                              // UNLIKE - Kurangi like
                              likeBtn.classList.remove('liked');
                              icon.classList.remove('bi-heart-fill');
                              icon.classList.add('bi-heart');
                              
                              // Show unlike message
                              Swal.fire({
                                  icon: 'info',
                                  title: 'Unlike Berhasil',
                                  text: 'Anda berhenti menyukai foto ini',
                                  timer: 1000,
                                  showConfirmButton: false,
                                  toast: true,
                                  position: 'top-end'
                              });
                          }
                          
                          // Update like count dari server
                          if (likesCountSpan && data.total_likes !== undefined) {
                              likesCountSpan.textContent = data.total_likes;
                          }
                      }
                  })
                  .catch(error => {
                          console.error('Failed to track activity:', error);
                      });
            }
            
            return false; // CRITICAL: Prevent any default action
        }

        // Handle Comment Function - Wrapper untuk showComments
        window.handleComment = function(fotoId, event) {
            console.log('handleComment called with fotoId:', fotoId);
            
            // STOP event dulu - CRITICAL untuk mencegah redirect
            if (event) {
                event.preventDefault();
                event.stopPropagation();
                event.stopImmediatePropagation();
            }
            
            // Panggil showComments
            showComments(fotoId, event);
            
            return false; // CRITICAL: Prevent any default action
        }

        // Global comments storage
        let photoComments = {};
        let replyingTo = null;
        
        // Show Comments Function - Enhanced with View, Reply, and Report
        window.showComments = function(fotoId, event) {
            console.log('showComments called with fotoId:', fotoId);
            console.log('isUserLoggedIn:', isUserLoggedIn);
            
            // STOP event dulu - CRITICAL untuk mencegah redirect
            if (event) {
                event.preventDefault();
                event.stopPropagation();
                event.stopImmediatePropagation();
            }
            
            // Check if user is logged in
            if (!isUserLoggedIn) {
                // User not logged in - save intended URL and redirect to login page
                sessionStorage.setItem('intended_url', window.location.href);
                
                // LANGSUNG redirect ke login tanpa popup
                window.location.href = '/login';
                return false; // STOP eksekusi
            }
            
            // Always load comments from database via API to ensure fresh data
            fetch(`/api/comments/${fotoId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        photoComments[fotoId] = data.comments || [];
                        displayCommentsModal(fotoId);
                    } else {
                        photoComments[fotoId] = [];
                        displayCommentsModal(fotoId);
                    }
                })
                .catch(error => {
                    console.error('Failed to load comments:', error);
                    photoComments[fotoId] = [];
                    displayCommentsModal(fotoId);
                });
        }
        
        function displayCommentsModal(fotoId) {
            console.log('=== displayCommentsModal CALLED - NEW VERSION WITH TOGGLE ===');
            
            const sampleComments = photoComments[fotoId];
            console.log('Total comments:', sampleComments.length);
            
            let commentsHtml = '';
            sampleComments.forEach(comment => {
                // Debug: Check if replies exist
                console.log('Comment:', comment.user, 'Replies:', comment.replies, 'Length:', comment.replies?.length);
                
                // Truncate long comments (Instagram style)
                const commentText = comment.comment;
                const maxLength = 100;
                const isTruncated = commentText.length > maxLength;
                const displayText = isTruncated ? commentText.substring(0, maxLength) : commentText;
                
                commentsHtml += `
                    <div class="comment-item" style="border-bottom: 1px solid #e5e7eb; padding: 1rem 0;">
                        <div class="d-flex gap-2">
                            <div class="comment-avatar" style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #1E40AF 0%, #1e3a8a 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1.2rem;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div style="flex: 1;">
                                        <strong style="font-size: 0.95rem; color: #262626;">${comment.user}</strong>
                                        <p style="margin: 0.25rem 0 0.5rem 0; color: #262626; font-size: 0.9rem;">
                                            <span class="comment-text-${comment.id}">${displayText}</span>${isTruncated ? '<span class="comment-full-${comment.id}" style="display: none;">' + commentText + '</span>' : ''}
                                            ${isTruncated ? '<button onclick="toggleCommentText(' + comment.id + ')" class="toggle-btn-' + comment.id + '" style="border: none; background: none; color: #8e8e8e; font-weight: 600; cursor: pointer; padding: 0; margin-left: 4px;">... Baca selengkapnya</button>' : ''}
                                        </p>
                                        <div class="d-flex gap-3" style="font-size: 0.85rem; color: #8e8e8e;">
                                            <span>${comment.time}</span>
                                            <button onclick="replyToComment(${comment.id}, '${comment.user}')" style="border: none; background: none; color: #8e8e8e; font-weight: 600; cursor: pointer; padding: 0;">Balas</button>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm" style="border: none; background: none; color: #8e8e8e; padding: 0;" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#" onclick="reportComment(${comment.id}); return false;"><i class="bi bi-flag me-2"></i>Laporkan Komentar</a></li>
                                        </ul>
                                    </div>
                                </div>
                                ${(comment.replies && Array.isArray(comment.replies) && comment.replies.length > 0) ? `
                                    <button onclick="toggleReplies(${comment.id})" class="view-replies-btn-${comment.id}" style="border: none; background: none; color: #8e8e8e; font-weight: 600; cursor: pointer; padding: 0; margin-top: 0.5rem; font-size: 0.85rem;">
                                        <span class="show-text">━━ Lihat balasan (${comment.replies.length})</span>
                                        <span class="hide-text" style="display: none;">━━ Sembunyikan balasan</span>
                                    </button>
                                    <div class="replies-container-${comment.id}" style="display: none; margin-top: 0.5rem;">
                                        <div class="ms-4">
                                            ${comment.replies.map(reply => {
                                                const replyText = reply.comment;
                                                const replyMaxLength = 80;
                                                const isReplyTruncated = replyText.length > replyMaxLength;
                                                const displayReplyText = isReplyTruncated ? replyText.substring(0, replyMaxLength) : replyText;
                                                
                                                return `
                                                <div class="d-flex gap-2 mb-2">
                                                    <div class="comment-avatar" style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #1E40AF 0%, #1e3a8a 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1rem;">
                                                        <i class="bi bi-person-fill"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <strong style="font-size: 0.9rem; color: #262626;">${reply.user}</strong>
                                                        <p style="margin: 0.25rem 0; color: #262626; font-size: 0.85rem;">
                                                            <span class="reply-text-${reply.id}">${displayReplyText}</span>${isReplyTruncated ? '<span class="reply-full-${reply.id}" style="display: none;">' + replyText + '</span>' : ''}
                                                            ${isReplyTruncated ? '<button onclick="toggleReplyText(' + reply.id + ')" class="toggle-reply-btn-' + reply.id + '" style="border: none; background: none; color: #8e8e8e; font-weight: 600; cursor: pointer; padding: 0; margin-left: 4px;">... Baca selengkapnya</button>' : ''}
                                                        </p>
                                                        <div class="d-flex gap-3" style="font-size: 0.8rem; color: #8e8e8e;">
                                                            <span>${reply.time}</span>
                                                            <button onclick="replyToComment(${comment.id}, '${reply.user}')" style="border: none; background: none; color: #8e8e8e; font-weight: 600; cursor: pointer; padding: 0;">Balas</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            `}).join('')}
                                        </div>
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                `;
            });
            
            // HANYA jalankan jika sudah login
            Swal.fire({
                title: '<i class="bi bi-chat-dots"></i> Komentar',
                html: `
                    <div class="text-start" style="max-height: 500px; overflow-y: auto;">
                        <div class="comments-list mb-3">
                            ${commentsHtml || '<p class="text-center text-muted py-4">Belum ada komentar. Jadilah yang pertama berkomentar!</p>'}
                        </div>
                        <div class="comment-input-section" style="border-top: 2px solid #e5e7eb; padding-top: 1rem;">
                            <label style="font-weight: 600; margin-bottom: 0.5rem; color: #262626;">Tulis Komentar:</label>
                            <textarea id="commentText" class="form-control" rows="3" placeholder="Tulis komentar Anda..." style="border: 2px solid #e5e7eb; border-radius: 8px; font-size: 0.95rem;"></textarea>
                            <div class="d-flex justify-content-end gap-2 mt-2">
                                <button type="button" class="btn btn-secondary" onclick="Swal.close()">Batal</button>
                                <button type="button" class="btn btn-primary" onclick="submitComment(${fotoId})"><i class="bi bi-send me-2"></i>Kirim</button>
                            </div>
                        </div>
                    </div>
                `,
                showConfirmButton: false,
                width: '650px',
                padding: '1.5rem',
                customClass: {
                    popup: 'rounded-4',
                    title: 'fs-5 fw-bold'
                }
            });
        }

        // Submit Comment Function - Save to Database
        function submitComment(fotoId) {
            const commentText = document.getElementById('commentText').value;
            if (!commentText.trim()) {
                Swal.fire('Error', 'Komentar tidak boleh kosong', 'error');
                return;
            }
            
            // Save comment to database
            fetch('/api/comments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    foto_id: fotoId,
                    user_id: currentUser?.id || null,
                    content: commentText,
                    parent_id: replyingTo || null
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Komentar Berhasil!',
                        text: 'Komentar Anda telah ditambahkan',
                        timer: 1500,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                    
                    // Reset replyingTo and label
                    const wasReplying = replyingTo !== null;
                    replyingTo = null;
                    
                    // Reload comments from API to get updated nested structure
                    fetch(`/api/comments/${fotoId}`)
                        .then(response => response.json())
                        .then(commentsData => {
                            if (commentsData.success) {
                                photoComments[fotoId] = commentsData.comments || [];
                                
                                // Refresh the comments modal
                                Swal.close();
                                setTimeout(() => {
                                    displayCommentsModal(fotoId);
                                }, 100);
                            }
                        })
                        .catch(error => {
                            console.error('Failed to reload comments:', error);
                            // Still close and refresh even if reload fails
                            Swal.close();
                            setTimeout(() => {
                                displayCommentsModal(fotoId);
                            }, 100);
                        });
                } else {
                    Swal.fire('Error', data.message || 'Gagal menambahkan komentar', 'error');
                }
            })
            .catch(error => {
                console.error('Failed to submit comment:', error);
                Swal.fire('Error', 'Gagal menambahkan komentar', 'error');
            });
        }

        // Handle Bookmark Function - Instagram Style with Explanation
        window.handleBookmark = function(fotoId, event) {
            console.log('handleBookmark called with fotoId:', fotoId);
            console.log('isUserLoggedIn:', isUserLoggedIn);
            
            // STOP event dulu - CRITICAL untuk mencegah redirect
            if (event) {
                event.preventDefault();
                event.stopPropagation();
                event.stopImmediatePropagation();
            }
            
            // Check if user is logged in
            if (!isUserLoggedIn) {
                // User not logged in - save intended URL and redirect to login page
                sessionStorage.setItem('intended_url', window.location.href);
                
                // LANGSUNG redirect ke login tanpa popup
                window.location.href = '/login';
                return false; // STOP eksekusi
            }
            
            const bookmarkBtn = document.querySelector(`.bookmark-btn[data-foto-id="${fotoId}"]`);
            if (bookmarkBtn) {
                const isBookmarked = bookmarkBtn.classList.contains('bookmarked');
                
                if (isBookmarked) {
                    // Remove bookmark
                    bookmarkBtn.classList.remove('bookmarked');
                    const icon = bookmarkBtn.querySelector('i');
                    icon.classList.remove('bi-bookmark-fill');
                    icon.classList.add('bi-bookmark');
                    
                    Swal.fire({
                        icon: 'info',
                        title: 'Bookmark Dihapus!',
                        html: `
                            <p>Foto telah dihapus dari koleksi bookmark Anda</p>
                            <p style="font-size: 0.9rem; color: #666;">Anda masih bisa menambahkannya kembali kapan saja</p>
                        `,
                        timer: 2000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                } else {
                    // Add bookmark - langsung simpan tanpa dialog
                    bookmarkBtn.classList.add('bookmarked');
                    const icon = bookmarkBtn.querySelector('i');
                    icon.classList.remove('bi-bookmark');
                    icon.classList.add('bi-bookmark-fill');
                    
                    // Track bookmark activity to database
                    fetch('/api/track-activity', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            foto_id: fotoId,
                            user_id: currentUser?.id || null,
                            activity_type: 'bookmark',
                            content: 'User bookmarked this photo'
                        })
                    }).then(response => response.json())
                      .then(data => {
                          console.log('Bookmark tracked:', data);
                      })
                      .catch(error => {
                          console.error('Failed to track bookmark:', error);
                      });
                    
                    // Notifikasi toast sederhana
                    Swal.fire({
                        icon: 'success',
                        title: 'Bookmark Ditambahkan!',
                        text: 'Foto berhasil disimpan',
                        timer: 2000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                }
            }
            
            return false; // CRITICAL: Prevent any default action
        }

        // Handle Share Function - Direct to WhatsApp Web & Instagram Web
        window.handleShare = function(fotoId, judul, event) {
            console.log('handleShare called with fotoId:', fotoId);
            
            // STOP event dulu - CRITICAL untuk mencegah redirect
            if (event) {
                event.preventDefault();
                event.stopPropagation();
                event.stopImmediatePropagation();
            }
            
            // Check if user is logged in
            if (!isUserLoggedIn) {
                sessionStorage.setItem('intended_url', window.location.href);
                window.location.href = '/login';
                return false;
            }
            
            // Directly call handleShareOptions to show WhatsApp Web & Instagram Web options
            const fileUrl = ''; // Not needed for web share
            window.handleShareOptions(fotoId, judul, fileUrl, event);
            
            return false; // CRITICAL: Prevent any default action
        }
        
        // ===== ALL ACTION FUNCTIONS MOVED TO galeri-actions.js =====
        // No duplicate definitions here
        
        // ===== EVENT LISTENERS =====
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOMContentLoaded - Gallery page loaded');
            console.log('=== FINAL CHECK ===');
            console.log('isUserLoggedIn:', isUserLoggedIn);
            console.log('typeof isUserLoggedIn:', typeof isUserLoggedIn);
            
            // CRITICAL: Prevent gallery card click from interfering with buttons
            document.querySelectorAll('.gallery-card').forEach(card => {
                // Add click handler to gallery-media only (foto area)
                const mediaElement = card.querySelector('.gallery-media');
                if (mediaElement) {
                    mediaElement.addEventListener('click', function(e) {
                        // Check if click is on button or its children
                        if (e.target.closest('.action-btn') || 
                            e.target.closest('.gallery-top-menu') ||
                            e.target.closest('.gallery-action-bar')) {
                            // Don't do anything, let button handler work
                            console.log('Click on button, ignoring card click');
                            return;
                        }
                        
                        // Click pada area foto (tanpa membuka modal)
                        console.log('Click on photo area');
                        return;
                    })
                }
            });
            
            // REMOVED: This was blocking the event delegation in galeri-actions.js
            // The event delegation in galeri-actions.js will handle all button clicks
        });
        
        // Share to WhatsApp
        window.shareToWhatsApp = function(url, text) {
            const shareUrl = 'https://wa.me/?text=' + encodeURIComponent(text + ' ' + url);
            window.open(shareUrl, '_blank');
            if (typeof Swal !== 'undefined') {
                Swal.close();
            }
        };
        
        // Handle Share Options - REMOVED DUPLICATE - Using galeri-actions.js version
        // Keep this minimal version for backward compatibility if needed
        if (typeof window.handleShareOptions === 'undefined') {
            window.handleShareOptions = function(fotoId, judul, fileUrl, event) {
            console.log('handleShareOptions called');
            
            // STOP event dulu
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            // Use APP_URL from Laravel config for Ngrok support
            const appUrl = '{{ config("app.url") }}';
            const shareUrl = appUrl + '/galeri?foto=' + fotoId;
            const shareText = `Lihat foto "${judul}" di Galeri SMKN 4 Bogor`;
            const whatsappText = encodeURIComponent(shareText + '\n\n' + shareUrl);
            
            Swal.fire({
                title: '<div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 0.5rem;"><i class="bi bi-share-fill" style="color: #1E40AF;"></i><span>Bagikan Foto</span></div>',
                html: `
                    <div style="text-align: center; padding: 0.5rem;">
                        <p style="color: #333; margin-bottom: 1rem; font-size: 1rem; font-weight: 600;">${judul}</p>
                        
                        <!-- Link Box with Copy Button -->
                        <div style="background: #f8f9fa; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; border: 2px solid #e5e7eb;">
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 0.5rem;">
                                <div style="flex: 1; text-align: left;">
                                    <p style="font-size: 0.75rem; color: #999; margin-bottom: 0.25rem; font-weight: 600;">LINK FOTO</p>
                                    <p style="font-size: 0.8rem; color: #666; margin: 0; word-break: break-all; line-height: 1.4;">${shareUrl}</p>
                                </div>
                                <button onclick="navigator.clipboard.writeText('${shareUrl}'); const btn = this; btn.innerHTML='<i class=\\'bi bi-check2\\'></i>'; setTimeout(() => btn.innerHTML='<i class=\\'bi bi-clipboard\\'></i>', 1000);" style="background: #1E40AF; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; min-width: 45px; transition: all 0.2s;" onmouseover="this.style.background='#1e3a8a'" onmouseout="this.style.background='#1E40AF'">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>
                        </div>
                        
                        <p style="color: #999; margin-bottom: 1rem; font-size: 0.85rem;">Pilih platform untuk membagikan:</p>
                        
                        <!-- Share Grid - App Style -->
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1rem;">
                            <!-- WhatsApp -->
                            <div onclick="trackShare(${fotoId}, 'WhatsApp'); window.open('https://web.whatsapp.com/send?text=${whatsappText}', '_blank'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#25D366';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                                <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #25D366; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-whatsapp" style="font-size: 1.5rem; color: white;"></i>
                                </div>
                                <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">WhatsApp</p>
                            </div>
                            
                            <!-- Facebook -->
                            <div onclick="trackShare(${fotoId}, 'Facebook'); window.open('https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}', '_blank'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#1877F2';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                                <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #1877F2; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-facebook" style="font-size: 1.5rem; color: white;"></i>
                                </div>
                                <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Facebook</p>
                            </div>
                            
                            <!-- Twitter -->
                            <div onclick="trackShare(${fotoId}, 'Twitter'); window.open('https://twitter.com/intent/tweet?url=${encodeURIComponent(shareUrl)}&text=${encodeURIComponent(shareText)}', '_blank'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#1DA1F2';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                                <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #1DA1F2; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-twitter" style="font-size: 1.5rem; color: white;"></i>
                                </div>
                                <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Twitter</p>
                            </div>
                            
                            <!-- Telegram -->
                            <div onclick="trackShare(${fotoId}, 'Telegram'); window.open('https://t.me/share/url?url=${encodeURIComponent(shareUrl)}&text=${encodeURIComponent(shareText)}', '_blank'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#0088cc';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                                <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #0088cc; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-telegram" style="font-size: 1.5rem; color: white;"></i>
                                </div>
                                <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Telegram</p>
                            </div>
                            
                            <!-- Instagram -->
                            <div onclick="trackShare(${fotoId}, 'Instagram'); window.shareToInstagramWeb('${shareUrl}', '${judul}'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#E4405F';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                                <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-instagram" style="font-size: 1.5rem; color: white;"></i>
                                </div>
                                <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Instagram</p>
                            </div>
                            
                            <!-- Email -->
                            <div onclick="trackShare(${fotoId}, 'Email'); window.location.href='mailto:?subject=${encodeURIComponent(shareText)}&body=${encodeURIComponent(shareUrl)}'; Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#EA4335';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                                <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #EA4335; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-envelope-fill" style="font-size: 1.5rem; color: white;"></i>
                                </div>
                                <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Email</p>
                            </div>
                        </div>
                    </div>
                `,
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonText: 'Tutup',
                cancelButtonColor: '#6c757d',
                width: '550px',
                padding: '1.5rem',
                customClass: {
                    popup: 'rounded-4'
                }
            });
            };
        }
        
        // Share to Instagram Web
        window.shareToInstagramWeb = function(shareUrl, judul) {
            // Open Instagram Web with instructions
            Swal.fire({
                icon: 'info',
                title: 'Bagikan ke Instagram',
                html: `
                    <p style="margin-bottom: 1rem; color: #666;">Link foto telah disalin ke clipboard!</p>
                    <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                        <p style="font-size: 0.9rem; color: #333; margin: 0;"><strong>${judul}</strong></p>
                        <p style="font-size: 0.85rem; color: #666; margin-top: 0.5rem; word-break: break-all;">${shareUrl}</p>
                    </div>
                    <p style="margin-bottom: 1rem; font-size: 0.9rem; color: #666;">Untuk membagikan ke Instagram:</p>
                    <ol style="text-align: left; padding-left: 1.5rem; color: #666; font-size: 0.9rem;">
                        <li>Klik tombol di bawah untuk membuka Instagram Web</li>
                        <li>Buat post atau story baru</li>
                        <li>Paste link yang sudah disalin di caption atau bio</li>
                    </ol>
                    <button class="btn w-100 mt-3" onclick="window.open('https://www.instagram.com/', '_blank'); Swal.close();" style="padding: 0.75rem; font-size: 1rem; background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); color: white; border: none;">
                        <i class="bi bi-instagram me-2" style="font-size: 1.2rem;"></i>Buka Instagram Web
                    </button>
                `,
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonText: 'Tutup',
                width: '500px',
                didOpen: () => {
                    // Copy link to clipboard
                    navigator.clipboard.writeText(shareUrl).catch(err => {
                        console.error('Failed to copy:', err);
                    });
                }
            });
        }
        
        // Share to Instagram (legacy function - keep for compatibility)
        window.shareToInstagram = function(fileUrl) {
            // Redirect to new Instagram Web function using APP_URL
            const appUrl = '{{ config("app.url") }}';
            const shareUrl = `${appUrl}/galeri`;
            const judul = 'Foto dari Galeri SMKN 4 Bogor';
            window.shareToInstagramWeb(shareUrl, judul);
        }
        
        // Handle Download Direct - No Login Check
        function handleDownloadDirect(fileUrl, judul) {
            console.log('handleDownloadDirect called');
            
            // Show downloading toast
            Swal.fire({
                icon: 'info',
                title: 'Mengunduh...',
                text: 'Foto sedang diunduh',
                timer: 1500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
            
            // Create temporary link and trigger download
            const link = document.createElement('a');
            link.href = fileUrl;
            link.download = judul.replace(/[^a-z0-9]/gi, '_').toLowerCase() + '.jpg';
            link.target = '_blank';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Show success message
            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Foto berhasil diunduh',
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            }, 1500);
        }
        
        // Handle Download Function - iPhone Style
        function handleDownload(fileUrl, judul, event) {
            console.log('handleDownload called');
            
            // STOP event dulu
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            // Check if user is logged in
            if (!isUserLoggedIn) {
                sessionStorage.setItem('intended_url', window.location.href);
                window.location.href = '/login';
                return false;
            }
            
            // Show downloading toast
            Swal.fire({
                icon: 'info',
                title: '<i class="bi bi-download" style="color: #34C759;"></i> Mengunduh...',
                html: `<p style="color: #666;">Foto sedang diunduh</p>`,
                timer: 1500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                customClass: {
                    popup: 'rounded-4'
                }
            });
            
            // Create temporary link and trigger download
            const link = document.createElement('a');
            link.href = fileUrl;
            link.download = judul.replace(/[^a-z0-9]/gi, '_').toLowerCase() + '.jpg';
            link.target = '_blank';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Show success message after a delay
            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: '<i class="bi bi-check-circle" style="color: #34C759;"></i> Berhasil!',
                    html: `<p style="color: #666;">Foto berhasil diunduh</p>`,
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                    customClass: {
                        popup: 'rounded-4'
                    }
                });
            }, 1500);
        }
        
        // Handle Photo Options - Three Dots Menu
        window.handlePhotoOptions = function(fotoId, event) {
            console.log('handlePhotoOptions called with fotoId:', fotoId);
            console.log('isUserLoggedIn:', isUserLoggedIn);
            
            // STOP event dulu
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            // Check if user is logged in
            if (!isUserLoggedIn) {
                // User not logged in - save intended URL and redirect to login page
                sessionStorage.setItem('intended_url', window.location.href);
                
                // LANGSUNG redirect ke login tanpa popup
                window.location.href = '/login';
                return false; // STOP eksekusi
            }
            
            // Get photo data for download
            const galleryCard = document.querySelector(`[data-foto-id="${fotoId}"]`);
            let downloadData = null;
            
            if (galleryCard) {
                const img = galleryCard.querySelector('.gallery-image');
                const title = galleryCard.querySelector('.gallery-photo-title')?.textContent || 'Foto';
                
                downloadData = {
                    url: img?.src || '',
                    title: title
                };
            }
            
            Swal.fire({
                title: '<i class="bi bi-three-dots-vertical"></i> Opsi Foto',
                html: `
                    <div class="text-center" style="max-width: 350px; margin: 0 auto;">
                        <button class="btn btn-outline-dark w-100 mb-2" onclick="Swal.close(); setTimeout(() => handleDownloadDirect('${downloadData?.url || ''}', '${downloadData?.title || 'foto'}'), 300);" style="padding: 14px 20px; font-size: 1rem; border-width: 2px;">
                            <i class="bi bi-download me-2"></i>Download Foto
                        </button>
                        <button class="btn btn-outline-danger w-100 mb-3" onclick="Swal.close(); setTimeout(() => handleReportNew(${fotoId}), 300);" style="padding: 14px 20px; font-size: 1rem; border-width: 2px;">
                            <i class="bi bi-flag-fill me-2"></i>Laporkan Foto
                        </button>
                        <button class="btn btn-outline-secondary w-100" onclick="Swal.close();" style="padding: 12px 20px; font-size: 0.95rem;">
                            <i class="bi bi-x-circle me-2"></i>Batal
                        </button>
                    </div>
                `,
                showConfirmButton: false,
                showCancelButton: false,
                width: '380px',
                padding: '2rem',
                customClass: {
                    popup: 'rounded-4',
                    title: 'fs-5 fw-bold text-center'
                }
            });
        }

        // Handle Share Photo Function
        function handleSharePhoto(fotoId) {
            // Use APP_URL from Laravel config for Ngrok support
            const appUrl = '{{ config("app.url") }}';
            const photoUrl = `${appUrl}/galeri?foto=${fotoId}`;
            const shareText = `Lihat foto ini di Galeri SMKN 4 Bogor`;
            const whatsappText = encodeURIComponent(shareText + '\n\n' + photoUrl);
            
            Swal.fire({
                title: '<div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 0.5rem;"><i class="bi bi-share-fill" style="color: #1E40AF;"></i><span>Bagikan Foto</span></div>',
                html: `
                    <div style="text-align: center; padding: 0.5rem;">
                        <!-- Link Box with Copy Button -->
                        <div style="background: #f8f9fa; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; border: 2px solid #e5e7eb;">
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 0.5rem;">
                                <div style="flex: 1; text-align: left;">
                                    <p style="font-size: 0.75rem; color: #999; margin-bottom: 0.25rem; font-weight: 600;">LINK FOTO</p>
                                    <p style="font-size: 0.8rem; color: #666; margin: 0; word-break: break-all; line-height: 1.4;">${photoUrl}</p>
                                </div>
                                <button onclick="navigator.clipboard.writeText('${photoUrl}'); const btn = this; btn.innerHTML='<i class=\\'bi bi-check2\\'></i>'; setTimeout(() => btn.innerHTML='<i class=\\'bi bi-clipboard\\'></i>', 1000);" style="background: #1E40AF; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; min-width: 45px; transition: all 0.2s;" onmouseover="this.style.background='#1e3a8a'" onmouseout="this.style.background='#1E40AF'">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>
                        </div>
                        
                        <p style="color: #999; margin-bottom: 1rem; font-size: 0.85rem;">Pilih platform untuk membagikan:</p>
                        
                        <!-- Share Grid - App Style -->
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1rem;">
                            <!-- WhatsApp -->
                            <div onclick="window.open('https://web.whatsapp.com/send?text=${whatsappText}', '_blank'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#25D366';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                                <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #25D366; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-whatsapp" style="font-size: 1.5rem; color: white;"></i>
                                </div>
                                <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">WhatsApp</p>
                            </div>
                            
                            <!-- Facebook -->
                            <div onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(photoUrl)}', '_blank'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#1877F2';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                                <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #1877F2; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-facebook" style="font-size: 1.5rem; color: white;"></i>
                                </div>
                                <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Facebook</p>
                            </div>
                            
                            <!-- Twitter -->
                            <div onclick="window.open('https://twitter.com/intent/tweet?url=${encodeURIComponent(photoUrl)}&text=${encodeURIComponent(shareText)}', '_blank'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#1DA1F2';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                                <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #1DA1F2; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-twitter" style="font-size: 1.5rem; color: white;"></i>
                                </div>
                                <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Twitter</p>
                            </div>
                            
                            <!-- Telegram -->
                            <div onclick="window.open('https://t.me/share/url?url=${encodeURIComponent(photoUrl)}&text=${encodeURIComponent(shareText)}', '_blank'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#0088cc';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                                <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #0088cc; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-telegram" style="font-size: 1.5rem; color: white;"></i>
                                </div>
                                <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Telegram</p>
                            </div>
                            
                            <!-- Instagram -->
                            <div onclick="window.shareToInstagramWeb('${photoUrl}', '${shareText}'); Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#E4405F';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                                <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-instagram" style="font-size: 1.5rem; color: white;"></i>
                                </div>
                                <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Instagram</p>
                            </div>
                            
                            <!-- Email -->
                            <div onclick="window.location.href='mailto:?subject=${encodeURIComponent(shareText)}&body=${encodeURIComponent(photoUrl)}'; Swal.close();" style="cursor: pointer; padding: 1rem; background: #fff; border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s; text-align: center;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)'; this.style.borderColor='#EA4335';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e5e7eb';">
                                <div style="width: 50px; height: 50px; margin: 0 auto 0.5rem; background: #EA4335; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-envelope-fill" style="font-size: 1.5rem; color: white;"></i>
                                </div>
                                <p style="margin: 0; font-size: 0.75rem; color: #333; font-weight: 600;">Email</p>
                            </div>
                        </div>
                    </div>
                `,
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonText: 'Tutup',
                cancelButtonColor: '#6c757d',
                width: '550px',
                padding: '1.5rem'
            });
        }

        // Toggle Comment Text (Baca selengkapnya)
        function toggleCommentText(commentId) {
            const shortText = document.querySelector(`.comment-text-${commentId}`);
            const fullText = document.querySelector(`.comment-full-${commentId}`);
            const toggleBtn = document.querySelector(`.toggle-btn-${commentId}`);
            
            if (fullText.style.display === 'none') {
                // Show full text
                shortText.style.display = 'none';
                fullText.style.display = 'inline';
                toggleBtn.textContent = 'Sembunyikan';
            } else {
                // Show truncated text
                shortText.style.display = 'inline';
                fullText.style.display = 'none';
                toggleBtn.textContent = '... Baca selengkapnya';
            }
        }
        
        // Toggle Reply Text (Baca selengkapnya untuk balasan)
        function toggleReplyText(replyId) {
            const shortText = document.querySelector(`.reply-text-${replyId}`);
            const fullText = document.querySelector(`.reply-full-${replyId}`);
            const toggleBtn = document.querySelector(`.toggle-reply-btn-${replyId}`);
            
            if (fullText.style.display === 'none') {
                // Show full text
                shortText.style.display = 'none';
                fullText.style.display = 'inline';
                toggleBtn.textContent = 'Sembunyikan';
            } else {
                // Show truncated text
                shortText.style.display = 'inline';
                fullText.style.display = 'none';
                toggleBtn.textContent = '... Baca selengkapnya';
            }
        }
        
        // Toggle Replies Visibility (Lihat/Sembunyikan balasan)
        function toggleReplies(commentId) {
            const repliesContainer = document.querySelector(`.replies-container-${commentId}`);
            const viewBtn = document.querySelector(`.view-replies-btn-${commentId}`);
            const showText = viewBtn.querySelector('.show-text');
            const hideText = viewBtn.querySelector('.hide-text');
            
            if (repliesContainer.style.display === 'none') {
                // Show replies
                repliesContainer.style.display = 'block';
                showText.style.display = 'none';
                hideText.style.display = 'inline';
            } else {
                // Hide replies
                repliesContainer.style.display = 'none';
                showText.style.display = 'inline';
                hideText.style.display = 'none';
            }
        }
        
        // Track Share Activity - Updated signature
        function trackShare(fotoId, platform) {
            console.log('Tracking share:', fotoId, platform);
            
            fetch('/api/track-activity', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    foto_id: fotoId,
                    user_id: currentUser?.id || null,
                    activity_type: 'share',
                    content: `Shared via ${platform}`
                })
            }).then(response => response.json())
              .then(data => {
                  console.log('Share tracked successfully:', data);
              })
              .catch(error => console.error('Error tracking share:', error));
        }

        // Handle Unlike Function
        function handleUnlike(fotoId) {
            const likeBtn = document.querySelector(`.like-btn[data-foto-id="${fotoId}"]`);
            
            if (likeBtn && likeBtn.classList.contains('liked')) {
                // Unlike the photo
                likeBtn.classList.remove('liked');
                const icon = likeBtn.querySelector('i');
                icon.classList.remove('bi-heart-fill');
                icon.classList.add('bi-heart');
                
                // Update like count
                const likesCountSpan = likeBtn.closest('.gallery-card').querySelector('.likes-count');
                if (likesCountSpan) {
                    let count = parseInt(likesCountSpan.textContent) || 0;
                    if (count > 0) count--;
                    likesCountSpan.textContent = count;
                }
                
                Swal.fire({
                    icon: 'info',
                    title: 'Unlike Berhasil',
                    text: 'Anda telah berhenti menyukai foto ini',
                    timer: 1500,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi',
                    text: 'Anda belum menyukai foto ini',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }

        // Handle Copy Link Function - Enhanced with explanation
        function handleCopyLink(fotoId) {
            // Use APP_URL from Laravel config for Ngrok support
            const appUrl = '{{ config("app.url") }}';
            const photoUrl = `${appUrl}/galeri?foto=${fotoId}`;
            
            Swal.fire({
                title: '<i class="bi bi-link-45deg"></i> Salin Link Foto',
                html: `
                    <div class="text-start" style="padding: 1rem;">
                        <p style="color: #666; margin-bottom: 1.5rem;">
                            <i class="bi bi-info-circle text-primary me-2"></i>
                            Link foto ini bisa Anda bagikan ke teman melalui WhatsApp, Email, atau media sosial lainnya.
                        </p>
                        <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; border-left: 4px solid #0d6efd; margin-bottom: 1rem;">
                            <p style="margin: 0; font-size: 0.9rem; color: #333;">
                                <strong>Link yang akan disalin:</strong><br>
                                <code style="font-size: 0.85rem; word-break: break-all;">${photoUrl}</code>
                            </p>
                        </div>
                        <div style="background: #d1ecf1; padding: 1rem; border-radius: 8px; border-left: 4px solid #0c5460; margin-bottom: 1rem;">
                            <p style="margin: 0; font-size: 0.9rem; color: #0c5460;">
                                <i class="bi bi-share me-2"></i>
                                <strong>Cara Membagikan:</strong>
                            </p>
                            <ul style="margin: 0.5rem 0 0 1.5rem; font-size: 0.85rem; color: #0c5460;">
                                <li>Klik "Salin Link" di bawah</li>
                                <li>Buka WhatsApp/Email/SMS</li>
                                <li>Paste link (Ctrl+V atau tahan lalu Paste)</li>
                                <li>Kirim ke teman Anda!</li>
                            </ul>
                        </div>
                        <p style="color: #666; font-size: 0.9rem; margin: 0;">
                            <i class="bi bi-clipboard-check text-success me-2"></i>
                            Link ini akan langsung membuka foto spesifik ini di galeri.
                        </p>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '<i class="bi bi-clipboard me-2"></i>Salin Link',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#0d6efd',
                width: '600px',
                padding: '1.5rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    navigator.clipboard.writeText(photoUrl).then(() => {
                        // Track share activity to database
                        fetch('/api/track-activity', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                foto_id: fotoId,
                                user_id: currentUser?.id || null,
                                activity_type: 'share',
                                content: 'User copied photo link: ' + photoUrl
                            })
                        }).then(response => response.json())
                          .then(data => {
                              console.log('Share tracked:', data);
                          })
                          .catch(error => {
                              console.error('Failed to track share:', error);
                          });
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Link Berhasil Disalin!',
                            html: `
                                <div style="text-align: center; padding: 1rem;">
                                    <p style="font-size: 1.1rem; margin-bottom: 1rem;">Link foto telah disalin ke clipboard</p>
                                    <div style="background: #d4edda; padding: 1rem; border-radius: 8px; border-left: 4px solid #28a745; margin-bottom: 1rem;">
                                        <p style="margin: 0; font-size: 0.9rem; color: #155724;">
                                            <i class="bi bi-whatsapp me-2"></i>
                                            Sekarang buka WhatsApp dan paste link ini untuk membagikan foto!
                                        </p>
                                    </div>
                                    <p style="font-size: 0.85rem; color: #666; margin: 0;">
                                        Tekan <kbd>Ctrl+V</kbd> (Windows) atau <kbd>Cmd+V</kbd> (Mac) untuk paste
                                    </p>
                                </div>
                            `,
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#28a745',
                            width: '500px'
                        });
                    }).catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menyalin',
                            text: 'Browser Anda tidak mendukung fitur copy otomatis. Silakan salin link secara manual.',
                            confirmButtonColor: '#dc3545'
                        });
                    });
                }
            });
        }
        
        // Reply to Comment Function
        function replyToComment(commentId, userName) {
            replyingTo = commentId;
            const commentText = document.getElementById('commentText');
            if (commentText) {
                commentText.value = `@${userName} `;
                commentText.focus();
                commentText.setSelectionRange(commentText.value.length, commentText.value.length);
                
                // Show visual indicator that we're replying
                const label = commentText.previousElementSibling;
                if (label) {
                    label.innerHTML = `<i class="bi bi-reply-fill text-primary me-2"></i>Membalas ${userName}:`;
                }
            }
        }
        
        // Report Comment Function
        function reportComment(commentId) {
            // Check if user is logged in
            if (!currentUser || !currentUser.id) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Login Diperlukan',
                    text: 'Anda harus login untuk melaporkan komentar',
                    confirmButtonText: 'Login Sekarang',
                    showCancelButton: true,
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/login';
                    }
                });
                return;
            }

            Swal.fire({
                title: '<i class="bi bi-flag-fill text-warning"></i> Laporkan Komentar',
                html: `
                    <div style="text-align: left; padding: 1rem;">
                        <p style="color: #666; margin-bottom: 1.5rem; text-align: center;">Mengapa Anda melaporkan komentar ini?</p>
                        
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">
                                <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>Alasan Laporan:
                            </label>
                            <select id="commentReportReason" class="form-select" style="padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px;">
                                <option value="">-- Pilih Alasan --</option>
                                <option value="spam">📧 Spam</option>
                                <option value="harassment">😡 Pelecehan atau Bullying</option>
                                <option value="hate_speech">🚫 Ujaran Kebencian</option>
                                <option value="inappropriate">🔞 Konten Tidak Pantas</option>
                                <option value="misinformation">❌ Informasi Menyesatkan</option>
                                <option value="other">📝 Lainnya</option>
                            </select>
                        </div>
                        
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">
                                <i class="bi bi-chat-left-text-fill text-primary me-2"></i>Detail (Opsional):
                            </label>
                            <textarea id="commentReportDetails" class="form-control" rows="3" placeholder="Jelaskan lebih detail..." style="padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; resize: none;"></textarea>
                        </div>
                        
                        <div style="background: #fff3cd; padding: 1rem; border-radius: 8px; border-left: 4px solid #ffc107;">
                            <p style="margin: 0; font-size: 0.85rem; color: #856404;">
                                <i class="bi bi-shield-check me-2"></i>
                                Laporan Anda akan ditinjau oleh moderator. Identitas Anda akan dirahasiakan.
                            </p>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '<i class="bi bi-send-fill me-2"></i>Kirim Laporan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#ffc107',
                width: '550px',
                padding: '1.5rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    const reason = document.getElementById('commentReportReason').value;
                    const details = document.getElementById('commentReportDetails').value;
                    
                    if (!reason) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Silakan pilih alasan laporan!',
                            confirmButtonColor: '#ffc107'
                        });
                        return;
                    }
                    
                    // Show loading
                    Swal.fire({
                        title: 'Mengirim Laporan...',
                        html: '<div class="spinner-border text-warning" role="status"><span class="visually-hidden">Loading...</span></div>',
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                    
                    // Send report to backend
                    const reportContent = `COMMENT_REPORT - ${reason}: ${details}`;
                    
                    fetch('/api/track-activity', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            foto_id: null,
                            user_id: currentUser.id,
                            activity_type: 'report',
                            content: reportContent,
                            comment_id: commentId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Laporan Terkirim!',
                            html: `
                                <p>Terima kasih telah membantu menjaga komunitas kami.</p>
                                <div style="background: #fff3cd; padding: 1rem; border-radius: 8px; margin-top: 1rem;">
                                    <p style="margin: 0; font-size: 0.9rem; color: #856404;">
                                        <i class="bi bi-clock me-2"></i>
                                        Tim moderator akan meninjau laporan Anda dalam <strong>24 jam</strong>
                                    </p>
                                </div>
                            `,
                            confirmButtonColor: '#28a745'
                        });
                    })
                    .catch(error => {
                        console.error('Failed to send report:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Mengirim',
                            text: 'Terjadi kesalahan. Silakan coba lagi.',
                            confirmButtonColor: '#dc3545'
                        });
                    });
                }
            });
        }

        // Handle Add to Collection Function
        function handleAddToCollection(fotoId) {
            Swal.fire({
                title: '<i class="bi bi-collection"></i> Tambah ke Koleksi',
                html: `
                    <div class="text-start">
                        <p class="mb-3">Pilih koleksi atau buat koleksi baru:</p>
                        <select class="form-select mb-3" id="collectionSelect">
                            <option value="">-- Pilih Koleksi --</option>
                            <option value="favorit">❤️ Favorit</option>
                            <option value="inspirasi">✨ Inspirasi</option>
                            <option value="kegiatan">📸 Kegiatan Sekolah</option>
                            <option value="prestasi">🏆 Prestasi</option>
                            <option value="new">➕ Buat Koleksi Baru</option>
                        </select>
                        <input type="text" class="form-control d-none" id="newCollectionName" placeholder="Nama koleksi baru">
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#ffc107',
                width: '450px',
                didOpen: () => {
                    document.getElementById('collectionSelect').addEventListener('change', function() {
                        const newInput = document.getElementById('newCollectionName');
                        if (this.value === 'new') {
                            newInput.classList.remove('d-none');
                        } else {
                            newInput.classList.add('d-none');
                        }
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Foto berhasil ditambahkan ke koleksi',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }

        // Handle Photo Info Function
        function handlePhotoInfo(fotoId) {
            const galleryCard = document.querySelector(`[data-foto-id="${fotoId}"]`);
            let photoInfo = {
                title: 'Foto',
                category: 'Umum',
                date: 'N/A',
                photographer: 'Admin',
                views: '0',
                likes: '0',
                comments: '0'
            };
            
            if (galleryCard) {
                const title = galleryCard.querySelector('.gallery-photo-title')?.textContent || 'Foto';
                const category = galleryCard.querySelector('.gallery-category')?.textContent || 'Umum';
                const likes = galleryCard.querySelector('.likes-count')?.textContent || '0';
                const comments = galleryCard.querySelector('.comments-count')?.textContent || '0';
                
                photoInfo = {
                    title: title,
                    category: category,
                    date: new Date().toLocaleDateString('id-ID'),
                    photographer: 'Admin SMKN 4 Bogor',
                    views: '128',
                    likes: likes,
                    comments: comments
                };
            }
            
            Swal.fire({
                title: '<i class="bi bi-info-circle"></i> Informasi Foto',
                html: `
                    <div class="text-start">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" style="width: 40%;">Judul:</td>
                                <td>${photoInfo.title}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Kategori:</td>
                                <td><span class="badge bg-primary">${photoInfo.category}</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Upload:</td>
                                <td>${photoInfo.date}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Fotografer:</td>
                                <td>${photoInfo.photographer}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Views:</td>
                                <td><i class="bi bi-eye me-1"></i>${photoInfo.views}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Likes:</td>
                                <td><i class="bi bi-heart-fill text-danger me-1"></i>${photoInfo.likes}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Komentar:</td>
                                <td><i class="bi bi-chat-fill text-primary me-1"></i>${photoInfo.comments}</td>
                            </tr>
                        </table>
                    </div>
                `,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#6c757d',
                width: '500px'
            });
        }

        // Handle Share Simple Function
        function handleShareSimple(fotoId, event) {
            // STOP event dulu
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            // Check if user is logged in - LANGSUNG REDIRECT tanpa popup
            if (!isUserLoggedIn) {
                // User not logged in - save intended URL and redirect to login page
                sessionStorage.setItem('intended_url', window.location.href);
                
                // LANGSUNG redirect ke login tanpa popup
                window.location.href = '/login';
                return false; // STOP eksekusi
            }
            
            // Simple share - copy link using APP_URL
            const appUrl = '{{ config("app.url") }}';
            const url = `${appUrl}/galeri?foto=${fotoId}`;
            navigator.clipboard.writeText(url).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Link Disalin!',
                    text: 'Link foto telah disalin, sekarang Anda bisa membagikannya',
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        }

        // Handle Report New Function - Desain Bagus
        function handleReportNew(fotoId) {
            // Check if user is logged in
            if (!currentUser || !currentUser.id) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Login Diperlukan',
                    text: 'Anda harus login untuk melaporkan foto',
                    confirmButtonText: 'Login Sekarang',
                    showCancelButton: true,
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        sessionStorage.setItem('intended_url', window.location.href);
                        window.location.href = '/login';
                    }
                });
                return;
            }

            Swal.fire({
                title: '<div style="text-align: center;"><i class="bi bi-flag-fill text-danger" style="font-size: 3rem;"></i><br><strong style="font-size: 1.5rem; margin-top: 1rem; display: block;">Laporkan Foto</strong></div>',
                html: `
                    <div style="text-align: left; padding: 1rem;">
                        <p style="color: #666; margin-bottom: 1.5rem; text-align: center;">Bantu kami menjaga komunitas tetap aman dengan melaporkan konten yang tidak pantas</p>
                        
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">
                                <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>Alasan Laporan:
                            </label>
                            <select id="reportReason" class="form-select" style="padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem;">
                                <option value="">-- Pilih Alasan --</option>
                                <option value="inappropriate">🔞 Konten Tidak Pantas</option>
                                <option value="spam">📧 Spam atau Iklan</option>
                                <option value="harassment">😡 Pelecehan atau Bullying</option>
                                <option value="violence">⚠️ Kekerasan</option>
                                <option value="copyright">©️ Pelanggaran Hak Cipta</option>
                                <option value="misinformation">❌ Informasi Menyesatkan</option>
                                <option value="other">📝 Lainnya</option>
                            </select>
                        </div>
                        
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">
                                <i class="bi bi-chat-left-text-fill text-primary me-2"></i>Detail Laporan (Opsional):
                            </label>
                            <textarea id="reportDetails" class="form-control" rows="4" placeholder="Jelaskan lebih detail mengapa Anda melaporkan foto ini..." style="padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 0.95rem; resize: none;"></textarea>
                        </div>
                        
                        <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; border-left: 4px solid #0d6efd;">
                            <p style="margin: 0; font-size: 0.85rem; color: #666;">
                                <i class="bi bi-info-circle-fill text-info me-2"></i>
                                <strong>Catatan:</strong> Laporan Anda akan ditinjau oleh tim kami dalam 24 jam. Identitas Anda akan dirahasiakan.
                            </p>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '<i class="bi bi-send-fill me-2"></i>Kirim Laporan',
                cancelButtonText: '<i class="bi bi-x-circle me-2"></i>Batal',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                width: '600px',
                padding: '2rem',
                customClass: {
                    popup: 'rounded-4 shadow-lg',
                    confirmButton: 'btn-lg',
                    cancelButton: 'btn-lg'
                },
                didOpen: () => {
                    // Focus on select
                    document.getElementById('reportReason').focus();
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const reason = document.getElementById('reportReason').value;
                    const details = document.getElementById('reportDetails').value;
                    
                    if (!reason) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Silakan pilih alasan laporan terlebih dahulu!',
                            confirmButtonColor: '#dc3545'
                        });
                        return;
                    }
                    
                    // TRACK ACTIVITY ke database untuk laporan admin
                    const reportContent = `${reason}: ${details}`;
                    
                    fetch('/api/track-activity', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            foto_id: fotoId,
                            user_id: currentUser?.id || null,
                            activity_type: 'report',
                            content: reportContent
                        })
                    }).then(response => response.json())
                      .then(data => {
                          console.log('Report tracked:', data);
                      })
                      .catch(error => {
                          console.error('Failed to track report:', error);
                      });
                    
                    // Get reason text
                    const reasonSelect = document.getElementById('reportReason');
                    const reasonText = reasonSelect.options[reasonSelect.selectedIndex].text;
                    
                    // Show loading and success message
                    Swal.fire({
                        title: 'Mengirim Laporan...',
                        html: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1500
                    }).then(() => {
                        Swal.fire({
                            icon: 'success',
                            title: '<strong>Laporan Berhasil Dikirim!</strong>',
                            html: `
                                <div style="text-align: center; padding: 1rem;">
                                    <p style="font-size: 1.1rem; color: #666; margin-bottom: 1rem;">
                                        Terima kasih telah membantu menjaga komunitas kami tetap aman.
                                    </p>
                                    <div style="background: #fff3cd; padding: 1rem; border-radius: 8px; border-left: 4px solid #ffc107; margin-bottom: 1rem;">
                                        <p style="margin: 0; color: #856404; font-size: 0.95rem; text-align: left;">
                                            <i class="bi bi-flag-fill me-2"></i>
                                            <strong>Alasan Laporan:</strong><br>
                                            <span style="margin-left: 1.5rem;">${reasonText}</span>
                                        </p>
                                        ${details ? `
                                        <p style="margin: 0.5rem 0 0 0; color: #856404; font-size: 0.9rem; text-align: left;">
                                            <i class="bi bi-chat-left-text me-2"></i>
                                            <strong>Detail:</strong><br>
                                            <span style="margin-left: 1.5rem;">${details}</span>
                                        </p>
                                        ` : ''}
                                    </div>
                                    <div style="background: #d1ecf1; padding: 1rem; border-radius: 8px; border-left: 4px solid #0c5460;">
                                        <p style="margin: 0; color: #0c5460; font-size: 0.95rem;">
                                            <i class="bi bi-check-circle-fill me-2"></i>
                                            Tim kami akan meninjau laporan Anda dalam <strong>24 jam</strong>
                                        </p>
                                    </div>
                                </div>
                            `,
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#28a745',
                            width: '600px'
                        });
                    });
                }
            });
        }

        // Handle Report Function
        function handleReport(fotoId) {
            // Check if user is logged in
            if (!isUserLoggedIn) {
                // User not logged in - save intended URL and redirect to login page
                sessionStorage.setItem('intended_url', window.location.href);
                
                // LANGSUNG redirect ke login tanpa popup
                window.location.href = '/login';
                return false; // STOP eksekusi
            }
            
            Swal.fire({
                title: 'Report Foto',
                html: `
                    <div class="text-start">
                        <p class="mb-3">Pilih alasan untuk melaporkan foto ini:</p>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="reportReason" id="inappropriate" value="inappropriate">
                            <label class="form-check-label" for="inappropriate">Konten tidak pantas</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="reportReason" id="spam" value="spam">
                            <label class="form-check-label" for="spam">Spam</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="reportReason" id="harassment" value="harassment">
                            <label class="form-check-label" for="harassment">Pelecehan</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="reportReason" id="other" value="other">
                            <label class="form-check-label" for="other">Lainnya</label>
                        </div>
                        <div class="mt-3">
                            <textarea id="reportDetails" class="form-control" rows="2" placeholder="Jelaskan lebih detail (opsional)"></textarea>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Kirim Report',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                width: '500px'
            }).then((result) => {
                if (result.isConfirmed) {
                    const selectedReason = document.querySelector('input[name="reportReason"]:checked');
                    const details = document.getElementById('reportDetails').value;
                    
                    if (!selectedReason) {
                        Swal.fire('Error', 'Pilih alasan report terlebih dahulu', 'error');
                        return;
                    }
                    
                    // Simulate report submission
                    Swal.fire({
                        title: 'Report Berhasil Dikirim!',
                        text: 'Terima kasih telah melaporkan. Tim kami akan meninjau laporan ini.',
                        icon: 'success',
                        timer: 3000,
                        showConfirmButton: false,
                        confirmButtonColor: '#1f6fd6'
                    });
                }
            });
        }

        // Toggle Description Function for Instagram-style
        function toggleDescription(fotoId) {
            const descElement = document.getElementById(`desc-${fotoId}`);
            const readMoreBtn = descElement.nextElementSibling;
            
            if (descElement.classList.contains('expanded')) {
                descElement.classList.remove('expanded');
                if (readMoreBtn) readMoreBtn.textContent = 'selengkapnya';
            } else {
                descElement.classList.add('expanded');
                if (readMoreBtn) readMoreBtn.textContent = 'lebih sedikit';
            }
        }
        
        // View Photo Function
        function viewPhoto(fotoId) {
            requireLogin('view').then(canProceed => {
                if (!canProceed) return;
                
                // Find the gallery card with this foto ID
                const galleryCard = document.querySelector(`[data-foto-id="${fotoId}"]`);
                if (galleryCard) {
                    const media = galleryCard.querySelector('.gallery-media');
                    const img = media.querySelector('.gallery-image');
                    const overlay = media.querySelector('.gallery-overlay');
                    const category = galleryCard.getAttribute('data-category');
                    
                    if (img && overlay) {
                        let displayText = overlay.querySelector('.overlay-title').textContent;
                        
                        // Show description if available for all categories
                        const descElement = galleryCard.querySelector('.gallery-description-text');
                        if (descElement && descElement.textContent.trim()) {
                            displayText = descElement.textContent;
                        }
                        
                        const likes = galleryCard.querySelector('.likes-count').textContent;
                        const comments = '0'; // Default
                        const views = '0'; // Default
                        
                        openPhotoModal(fotoId, img.src, displayText, likes, comments, views, category);
                    }
                }
            });
        }

        // Modal Functions
        let currentFotoId = null;

        function openPhotoModal(fotoId, imageSrc, title, likes, comments, views, category = null) {
            currentFotoId = fotoId;
            document.getElementById('modalImage').src = imageSrc;
            
            // Set title/description based on category
            const modalTitle = document.getElementById('modalTitle');
            modalTitle.textContent = title;
            
            // Style modal title for Prestasi & Ekstrakurikuler
            if (category === 'Prestasi' || category === 'Ekstrakurikuler') {
                modalTitle.style.fontSize = '1rem';
                modalTitle.style.lineHeight = '1.5';
                modalTitle.style.fontWeight = '400';
            } else {
                modalTitle.style.fontSize = '1.5rem';
                modalTitle.style.lineHeight = '1.2';
                modalTitle.style.fontWeight = '700';
            }
            
            document.getElementById('modalLikes').textContent = likes;
            document.getElementById('modalComments').textContent = comments;
            document.getElementById('modalViews').textContent = views;
            
            // TRACK VIEW ACTIVITY ke database
            fetch('/api/track-activity', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    foto_id: fotoId,
                    user_id: currentUser?.id || null,
                    activity_type: 'view'
                })
            }).then(response => response.json())
              .then(data => {
                  console.log('View tracked:', data);
              })
              .catch(error => {
                  console.error('Failed to track view:', error);
              });
            
            const modal = new bootstrap.Modal(document.getElementById('photoModal'));
            modal.show();
        }

        function handleModalLike() {
            requireLogin('like').then(canProceed => {
                if (!canProceed) return;
                handleLike(currentFotoId, null);
            });
        }

        function handleModalBookmark() {
            requireLogin('bookmark').then(canProceed => {
                if (!canProceed) return;
                
                Swal.fire({
                    title: 'Bookmark Ditambahkan!',
                    text: 'Foto telah disimpan ke bookmark',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false,
                    confirmButtonColor: '#1f6fd6'
                });
            });
        }

        // Update gallery display based on login status
        function updateGalleryDisplay() {
            const loginBanner = document.getElementById('loginBanner');
            const pageHeader = document.getElementById('pageHeader');
            const heroTitle = document.getElementById('heroTitle');
            const heroSubtitle = document.getElementById('heroSubtitle');
            
            console.log('updateGalleryDisplay called');
            console.log('isUserLoggedIn:', isUserLoggedIn);
            console.log('isLoggedIn:', isLoggedIn);
            
            // Update hero section
            if (pageHeader) {
                if (isUserLoggedIn) {
                    // Hero normal untuk user yang sudah login
                    pageHeader.classList.remove('guest-mode');
                    if (heroTitle) heroTitle.textContent = 'Galeri Foto SMKN 4 Bogor';
                    if (heroSubtitle) heroSubtitle.textContent = 'Dokumentasi kegiatan, prestasi, dan momen berharga dalam perjalanan pendidikan kami';
                } else {
                    // Hero menarik untuk guest/belum login
                    pageHeader.classList.add('guest-mode');
                    if (heroTitle) heroTitle.textContent = 'Galeri Foto SMKN 4 Bogor';
                    if (heroSubtitle) heroSubtitle.textContent = 'Login untuk berinteraksi dengan galeri - like, comment, dan bookmark foto favorit Anda';
                }
            }
            
            // Tampilkan/sembunyikan banner login
            if (loginBanner) {
                if (isUserLoggedIn) {
                    loginBanner.style.display = 'none';
                } else {
                    loginBanner.style.display = 'block';
                }
            }
            
            console.log('Gallery display updated. Login status:', isUserLoggedIn);
        }
        
        // Filter by category
        function filterByCategory() {
            const categoryFilter = document.getElementById('categoryFilter');
            const selectedCategory = (categoryFilter.value || '').toLowerCase().trim();
            const grid = document.getElementById('galleryGrid');
            const cards = grid.querySelectorAll('.gallery-card');
            
            cards.forEach(card => {
                const cardCategory = (card.dataset.category || '').toLowerCase().trim();
                let show = false;
                if (selectedCategory === 'all' || selectedCategory === '') {
                    show = true;
                } else if (selectedCategory.includes('prestasi') || selectedCategory.includes('penghargaan')) {
                    // Gabungan prestasi & penghargaan
                    show = cardCategory.includes('prestasi') || cardCategory.includes('penghargaan');
                } else {
                    // Cocokkan partial text untuk kategori lain
                    show = cardCategory.includes(selectedCategory);
                }
                card.style.display = show ? '' : 'none';
            });
        }
        
        // Sort photos
        function sortPhotos() {
            const sortFilter = document.getElementById('sortFilter');
            const sortValue = sortFilter.value;
            const grid = document.getElementById('galleryGrid');
            const cards = Array.from(grid.querySelectorAll('.gallery-card'));
            
            cards.sort((a, b) => {
                if (sortValue === 'newest') {
                    return parseInt(b.dataset.fotoId) - parseInt(a.dataset.fotoId);
                } else if (sortValue === 'oldest') {
                    return parseInt(a.dataset.fotoId) - parseInt(b.dataset.fotoId);
                } else if (sortValue === 'most-liked') {
                    const likesA = parseInt(a.querySelector('.likes-count')?.textContent || 0);
                    const likesB = parseInt(b.querySelector('.likes-count')?.textContent || 0);
                    return likesB - likesA;
                }
                return 0;
            });
            
            cards.forEach(card => grid.appendChild(card));
        }
        
        // Search photos
        function performSearch() {
            const searchInput = document.getElementById('searchInput');
            const searchTerm = searchInput.value.toLowerCase();
            const grid = document.getElementById('galleryGrid');
            const cards = grid.querySelectorAll('.gallery-card');
            
            cards.forEach(card => {
                const title = card.querySelector('.gallery-photo-title')?.textContent.toLowerCase() || '';
                const category = (card.dataset.category || '').toLowerCase();
                
                if (title.includes(searchTerm) || category.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        // ===== EVENT LISTENERS =====
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOMContentLoaded - Gallery page loaded');
            console.log('=== FINAL CHECK ===');
            console.log('isUserLoggedIn:', isUserLoggedIn);
            console.log('typeof isUserLoggedIn:', typeof isUserLoggedIn);
            console.log('==================');
            
            // Check if SweetAlert2 is loaded
            if (typeof Swal === 'undefined') {
                console.error('SweetAlert2 not loaded!');
                alert('SweetAlert2 library not loaded. Please refresh the page.');
                return;
            }
            
            // Check if Bootstrap is loaded
            if (typeof bootstrap === 'undefined') {
                console.error('Bootstrap not loaded!');
                alert('Bootstrap library not loaded. Please refresh the page.');
                return;
            }
            
            console.log('All libraries loaded successfully');
            
            // Test if functions are defined
            console.log('handleLike function:', typeof handleLike);
            console.log('requireLogin function:', typeof requireLogin);
            
            // Initialize login status
            checkLoginStatus();
            
            // Restore like counts from localStorage (PERSISTENT)
            restoreLikeCounts();
            
            // Update gallery display based on login status
            updateGalleryDisplay();
            
            // DISABLE semua tombol jika belum login
            if (!isUserLoggedIn) {
                console.log('User belum login - menambahkan visual indicator');
                document.querySelectorAll('.action-btn').forEach(btn => {
                    btn.style.opacity = '0.6';
                    btn.style.cursor = 'pointer'; // Tetap pointer agar bisa klik untuk popup
                });
            }
            
            // ===== EVENT DELEGATION FOR ACTION BUTTONS =====
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.action-btn, .gallery-top-menu');
                if (!btn) return;
                
                e.stopPropagation();
                e.preventDefault();
                
                const action = btn.dataset.action;
                const fotoId = parseInt(btn.dataset.fotoId);
                
                console.log('Button clicked:', action, 'fotoId:', fotoId);
                
                switch(action) {
                    case 'like':
                        window.handleLikeNoLogin(fotoId, e);
                        break;
                    case 'comment':
                        window.handleComment(fotoId, e);
                        break;
                    case 'share':
                        window.handleShareOptions(fotoId, btn.dataset.judul, btn.dataset.fileUrl, e);
                        break;
                    case 'bookmark':
                        window.handleBookmark(fotoId, e);
                        break;
                    case 'options':
                        window.handlePhotoOptions(fotoId, e);
                        break;
                }
            });
            
            // Add event listeners for download buttons (if any)
            document.querySelectorAll('.download-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const fotoId = this.dataset.fotoId;
                    const filePath = this.dataset.filePath;
                    const fileName = this.dataset.fileName;
                    handleDownload(fotoId, filePath, fileName);
                });
            });

            // Event listeners are now handled via onclick attributes in HTML
            // This keeps the code cleaner and prevents duplicate event handlers
            
            // Debug: Check if action buttons exist
            const actionButtons = document.querySelectorAll('.action-btn');
            console.log('Found action buttons:', actionButtons.length);
            actionButtons.forEach(btn => {
                console.log('Action button:', btn.className, btn.dataset.fotoId);
            });

            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const fotoId = this.dataset.fotoId;
                    viewPhoto(fotoId);
                });
            });

            // Add event listeners for filter and sort
            const categoryFilter = document.getElementById('categoryFilter');
            const sortFilter = document.getElementById('sortFilter');
            const searchInput = document.getElementById('searchInput');
            
            if (categoryFilter) {
                categoryFilter.addEventListener('change', filterByCategory);
            }
            
            if (sortFilter) {
                sortFilter.addEventListener('change', sortPhotos);
            }
            
            if (searchInput) {
                searchInput.addEventListener('keyup', function(e) {
                    if (e.key === 'Enter') {
                        performSearch();
                    }
                });
            }
            
            // Gallery cards - No modal on click (removed to prevent accidental clicks)
            // Scroll animation for gallery cards
            (function initGalleryScrollAnimation() {
                const grid = document.getElementById('galleryGrid');
                if (!grid) return;
                const cards = grid.querySelectorAll('.gallery-card');
                
                // Ensure all cards are visible by default
                cards.forEach((c) => {
                    c.classList.add('sa-show');
                    c.classList.remove('sa-hidden');
                });
                
                cards.forEach((c, idx) => c.style.setProperty('--stagger', (idx * 60) + 'ms'));
                try {
                    const io = new IntersectionObserver((entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('sa-show');
                                entry.target.classList.remove('sa-hidden');
                            }
                        });
                    }, { threshold: 0.15 });
                    cards.forEach((c) => io.observe(c));
                } catch (_) {
                    // Fallback: ensure all cards are visible
                    cards.forEach((c) => {
                        c.classList.add('sa-show');
                        c.classList.remove('sa-hidden');
                    });
                }
            })();
            // Category filtering sudah diganti dengan dropdown
        });
        
        // Helper Functions (Outside DOMContentLoaded)
        function ensureModal() {
                if (document.getElementById('photoDetailModal')) return;
                const modalHtml = `
                <div class="modal fade" id="photoDetailModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="photoDetailTitle">Detail Foto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="text-center mb-3">
                          <img id="photoDetailImage" src="" alt="Foto" style="max-width:100%;max-height:60vh;object-fit:contain;"/>
                        </div>
                        <p id="photoDetailDesc" class="mb-2 text-muted"></p>
                        <small id="photoDetailCategory" class="text-muted"></small>
                      </div>
                      <div class="modal-footer">
                        <a id="photoDetailDownload" href="#" class="btn btn-primary" download>
                          <i class="fas fa-download me-2"></i>Download Foto
                        </a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>`;
                document.body.insertAdjacentHTML('beforeend', modalHtml);
        }

        function openPhotoModal(data) {
            ensureModal();
            document.getElementById('photoDetailTitle').textContent = data.title || 'Detail Foto';
            document.getElementById('photoDetailImage').src = data.image || '';
            document.getElementById('photoDetailDesc').textContent = data.desc || '';
            document.getElementById('photoDetailCategory').innerHTML = data.category ? `<i class=\"fas fa-tag me-1\"></i>${data.category}` : '';
            const dl = document.getElementById('photoDetailDownload');
            if (data.download) { dl.href = data.download; dl.style.display = ''; }
            else { dl.removeAttribute('href'); dl.style.display = 'none'; }

            const modal = new bootstrap.Modal(document.getElementById('photoDetailModal'));
            modal.show();
        }

        // Navbar scroll effect - sama seperti beranda
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            const pageHeader = document.querySelector('.page-header');
            
            if (pageHeader) {
                const headerHeight = pageHeader.offsetHeight;
                
                // Navbar berubah saat scroll melewati 80% dari tinggi hero section
                if (window.scrollY > headerHeight * 0.8) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            } else {
                // Fallback jika tidak ada page-header
                if (window.scrollY > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });

        // ===== PHOTO MODAL POP-UP FUNCTIONS =====
        let currentPhotoData = null;

        // Open Photo Modal
        function openPhotoModalPopup(fotoId) {
            const card = document.querySelector(`.gallery-card[data-foto-id="${fotoId}"]`);
            if (!card) return;

            const imageUrl = card.dataset.imageUrl;
            const title = card.dataset.judul;
            const likesCount = card.querySelector('.likes-count')?.textContent || '0';
            const viewsCount = card.querySelector('.views-count')?.textContent || '0';
            const isLiked = card.querySelector('.like-btn')?.classList.contains('liked') || false;
            const isBookmarked = card.querySelector('.bookmark-btn')?.classList.contains('bookmarked') || false;

            currentPhotoData = {
                fotoId: fotoId,
                imageUrl: imageUrl,
                title: title,
                likesCount: likesCount,
                viewsCount: viewsCount,
                isLiked: isLiked,
                isBookmarked: isBookmarked
            };

            // Update modal content
            const photoModalImage = document.getElementById('photoModalImage');
            const photoModalTitle = document.getElementById('photoModalTitle');
            
            if (photoModalImage) photoModalImage.src = imageUrl;
            if (photoModalTitle) photoModalTitle.textContent = title;

            // Show modal
            const backdrop = document.getElementById('photoModalBackdrop');
            if (backdrop) {
                backdrop.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
        }

        // Close Photo Modal
        function closePhotoModal() {
            const backdrop = document.getElementById('photoModalBackdrop');
            if (backdrop) {
                backdrop.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
            currentPhotoData = null;
        }

        // Handle Photo Modal Like
        function handlePhotoModalLike() {
            if (!isUserLoggedIn) {
                showLoginPopup();
                return;
            }

            if (!currentPhotoData) return;

            const likeBtn = document.getElementById('photoModalLikeBtn');
            const isLiked = likeBtn.classList.contains('liked');

            // Toggle like state
            if (isLiked) {
                likeBtn.classList.remove('liked');
                likeBtn.querySelector('i').classList.add('bi-heart');
                likeBtn.querySelector('i').classList.remove('bi-heart-fill');
                currentPhotoData.likesCount = Math.max(0, parseInt(currentPhotoData.likesCount) - 1);
            } else {
                likeBtn.classList.add('liked');
                likeBtn.querySelector('i').classList.remove('bi-heart');
                likeBtn.querySelector('i').classList.add('bi-heart-fill');
                currentPhotoData.likesCount = parseInt(currentPhotoData.likesCount) + 1;
            }

            document.getElementById('photoModalLikes').textContent = currentPhotoData.likesCount;

            // Call the actual like function from galeri-actions.js
            window.handleLike(currentPhotoData.fotoId, null);
        }

        // Handle Photo Modal Comment
        function handlePhotoModalComment() {
            if (!isUserLoggedIn) {
                showLoginPopup();
                return;
            }

            if (!currentPhotoData) return;

            // Call the actual comment function from galeri-actions.js
            window.handleComment(currentPhotoData.fotoId, null);
        }

        // Handle Photo Modal Bookmark
        function handlePhotoModalBookmark() {
            if (!isUserLoggedIn) {
                showLoginPopup();
                return;
            }

            if (!currentPhotoData) return;

            const bookmarkBtn = document.getElementById('photoModalBookmarkBtn');
            const isBookmarked = bookmarkBtn.classList.contains('bookmarked');

            // Toggle bookmark state
            if (isBookmarked) {
                bookmarkBtn.classList.remove('bookmarked');
                bookmarkBtn.querySelector('i').classList.add('bi-bookmark');
                bookmarkBtn.querySelector('i').classList.remove('bi-bookmark-fill');
            } else {
                bookmarkBtn.classList.add('bookmarked');
                bookmarkBtn.querySelector('i').classList.remove('bi-bookmark');
                bookmarkBtn.querySelector('i').classList.add('bi-bookmark-fill');
            }

            // Call the actual bookmark function from galeri-actions.js
            window.handleBookmark(currentPhotoData.fotoId, null);
        }

        // ===== LOGIN POPUP FUNCTIONS =====
        function showLoginPopup() {
            document.getElementById('loginPopupBackdrop').classList.add('show');
            document.getElementById('loginPopupModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeLoginPopup() {
            document.getElementById('loginPopupBackdrop').classList.remove('show');
            document.getElementById('loginPopupModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        function redirectToLogin() {
            sessionStorage.setItem('intended_url', window.location.href);
            window.location.href = '/login';
        }

        // Close login popup when clicking backdrop
        document.getElementById('loginPopupBackdrop')?.addEventListener('click', closeLoginPopup);

        // ===== GALLERY CARD CLICK HANDLER =====
        document.addEventListener('DOMContentLoaded', function() {
            // Add click handler untuk gallery-media (foto area)
            document.querySelectorAll('.gallery-media').forEach(media => {
                media.addEventListener('click', function(e) {
                    // Jangan buka modal jika klik pada button atau menu
                    if (e.target.closest('.action-btn') || 
                        e.target.closest('.gallery-top-menu') ||
                        e.target.closest('.gallery-action-bar')) {
                        return;
                    }

                    // Ambil foto ID dari parent card
                    const card = this.closest('.gallery-card');
                    if (card) {
                        const fotoId = card.dataset.fotoId;
                        openPhotoModalPopup(fotoId);
                    }
                });
            });
        });
    </script>

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

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS (Animate On Scroll)
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: false,
            mirror: true,
            offset: 100,
            delay: 50,
        });
        
        // Refresh AOS on window resize
        window.addEventListener('resize', function() {
            AOS.refresh();
        });
    </script>
</body>
</html>