<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #8b5cf6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #06b6d4;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --sidebar-width: 280px;
            --accent-purple: #8b5cf6;
            --accent-teal: #06b6d4;
            --accent-pink: #ec4899;
            --accent-green: #10b981;
            --accent-orange: #f59e0b;
            --primary-blue: #6366f1;
            --secondary-blue: #8b5cf6;
            --white: #ffffff;
            --light-gray: #64748b;
            --border-color: #e2e8f0;
            --gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            --gradient-info: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Sidebar Styles - match /admin */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: rgba(30, 64, 175, 0.15);
            color: #374151;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 20px rgba(30, 64, 175, 0.2);
            border-right: 1px solid rgba(30, 64, 175, 0.3);
        }

        .sidebar-header {
            background: rgba(30, 64, 175, 0.2);
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(30, 64, 175, 0.3);
            min-height: 80px;
            display: flex;
            align-items: center;
            gap: 1rem;
            text-align: left;
        }

        .sidebar-logo {
            width: 50px;
            height: 50px;
            overflow: visible;
            border: none;
            box-shadow: none;
            border-radius: 0;
            background: transparent;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .sidebar-logo img{width:100%;height:100%;object-fit:contain;background:transparent;max-width:100%;max-height:100%;}

        .sidebar-title {
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            color: #1f2937;
            line-height: 1.2;
            margin: 0;
        }
        
        .sidebar-subtitle { font-size: 0.8rem; opacity: 0.7; font-weight: 700; color: #6b7280; line-height: 1.2; }

        .sidebar-nav { padding: 1.5rem 0; }

        .nav-item { margin: 0.25rem 1rem; }

        .nav-divider {
            height: 1px;
            background: rgba(30, 64, 175, 0.3);
            margin: 1rem 1.5rem;
            border-radius: 1px;
        }

        .nav-link.side {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            color: #6b7280;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            position: relative;
            margin: 0.25rem 1rem;
        }

        .nav-link.side:hover { background: rgba(30, 64, 175, 0.15); color: #1e40af; }

        .nav-link.side.active {
            background: rgba(30, 64, 175, 0.25);
            color: #1e40af;
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.3);
        }

        .nav-link.side i { margin-right: 0.875rem; width: 18px; font-size: 1rem; text-align: center; }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
            background: transparent;
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: #ffffff;
            padding: 1.5rem 2rem;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        .page-title {
            color: var(--dark-color);
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0;
        }

        .page-date {
            color: var(--light-gray);
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .notification-icons {
            display: flex;
            gap: 0.75rem;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--light-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light-gray);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .notification-icon:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .user-profile {
            position: relative;
        }

        .user-profile-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            border: 1px solid rgba(99, 102, 241, 0.2);
            box-shadow: var(--shadow-md);
            backdrop-filter: blur(10px);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-profile-content:hover {
            background: rgba(255, 255, 255, 1);
            box-shadow: var(--shadow-lg);
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            flex-shrink: 0;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            gap: 0.1rem;
        }

        .user-name {
            color: var(--dark-color);
            font-weight: 700;
            font-size: 0.9rem;
            margin: 0;
        }

        .user-role {
            color: var(--light-gray);
            font-weight: 500;
            font-size: 0.8rem;
        }

        .dropdown-arrow {
            color: var(--light-gray);
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        /* Overview Section */
        .overview-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
        }

        .overview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .overview-card {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .overview-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .overview-card:hover::before {
            transform: scaleX(1);
        }

        .overview-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .overview-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .overview-icon.total { background: var(--gradient-primary); }
        .overview-icon.published { background: var(--gradient-success); }
        .overview-icon.draft { background: var(--gradient-warning); }
        .overview-icon.archived { background: var(--gradient-info); }

        .overview-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .overview-label {
            color: var(--light-gray);
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Table Container */
        .table-container {
            background: var(--white);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
        }

        /* Header di atas kartu/daftar berita */
        .table-header {
            background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 0.875rem 1.25rem;
            box-shadow: var(--shadow-sm);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: var(--light-color);
            border: none;
            color: var(--dark-color);
            font-weight: 600;
            padding: 1rem;
            border-radius: 8px 8px 0 0;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: var(--light-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .table tbody td {
            padding: 1rem;
            border: none;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .news-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
            transition: all 0.3s ease;
        }

        .table tbody tr:hover .news-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .action-btn.view { background: var(--accent-teal); color: white; }
        .action-btn.edit { background: #f59e0b; color: white; }
        .action-btn.delete { background: var(--danger-color); color: white; }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .action-btn i {
            font-size: 0.9rem;
        }

        /* New News Button */
        .new-news-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-right: 1rem;
            text-decoration: none;
        }

        .new-news-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
        }

        /* News Cards */
        .news-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .news-card-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .news-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .news-card:hover .news-card-image img {
            transform: scale(1.05);
        }

        .news-placeholder {
            width: 100%;
            height: 100%;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }

        .news-status-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .news-card-content {
            padding: 1.5rem;
        }

        .news-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
            gap: 1rem;
        }

        .news-card-title {
            color: var(--dark-color);
            font-weight: 700;
            font-size: 1.1rem;
            line-height: 1.4;
            flex: 1;
            margin: 0;
        }

        .jenis-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .jenis-berita {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .jenis-pengumuman {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .news-card-excerpt {
            color: var(--light-gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .news-card-meta {
            margin-bottom: 1rem;
        }

        .news-card-actions {
            padding: 0 1.5rem 1.5rem;
            display: flex;
            gap: 0.5rem;
        }

        .news-card-actions .btn-action {
            flex: 1;
            min-width: 40px;
            height: 40px;
            padding: 0.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            background: transparent;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .35rem;
        }
        .btn-action.edit { color: #f59e0b; border-color: rgba(245,158,11,.35); background: #ffffff; }
        .btn-action.delete { color: #ef4444; border-color: rgba(239,68,68,.35); background: #ffffff; }
        .btn-action.view { color: #06b6d4; border-color: rgba(6,182,212,.35); background: #ffffff; }
        .btn-action:hover { background: #f9fafb; transform: translateY(-2px); box-shadow: var(--shadow-md); }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--light-gray);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.3;
            color: var(--primary-color);
        }

        .empty-state h4 {
            color: var(--dark-color);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .empty-state p {
            color: var(--light-gray);
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        /* Hamburger Menu */
        .hamburger-menu{display:none;position:fixed;top:20px;left:20px;z-index:1100;width:50px;height:50px;background:rgba(255,255,255,0.95);border:none;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.15);cursor:pointer;flex-direction:column;align-items:center;justify-content:center;gap:5px;transition:all 0.3s ease}
        .hamburger-menu:hover{transform:scale(1.05);box-shadow:0 6px 16px rgba(0,0,0,0.2)}
        .hamburger-menu span{display:block;width:24px;height:3px;background:#1e40af;border-radius:2px;transition:all 0.3s ease}
        .hamburger-menu.active span:nth-child(1){transform:rotate(45deg) translate(7px,7px)}
        .hamburger-menu.active span:nth-child(2){opacity:0}
        .hamburger-menu.active span:nth-child(3){transform:rotate(-45deg) translate(7px,-7px)}

        /* Responsive Design */
        @media (max-width: 768px) {
            .hamburger-menu{display:flex}
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active{
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 1rem;
                padding-top: 80px;
            }
            
            .overview-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .table-responsive {
                font-size: 0.9rem;
            }

            .user-info {
                flex-direction: column;
                gap: 0.5rem;
            }

            .new-news-btn {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .overview-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Filter Tabs */
        .filter-tabs {
            margin-bottom: 2rem;
        }

        .tab-buttons {
            display: flex;
            gap: 0.5rem;
            background: #f8fafc;
            padding: 0.5rem;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .tab-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: transparent;
            border: none;
            border-radius: 8px;
            color: #64748b;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-btn:hover {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .tab-btn.active {
            background: #3b82f6;
            color: white;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }

        .tab-btn i {
            font-size: 1rem;
        }


        @media (max-width: 768px) {
            .tab-buttons {
                flex-direction: column;
            }

            .tab-btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Hamburger Menu Button -->
    <button class="hamburger-menu" id="hamburgerMenu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo"><img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah"></div>
            <div>
                <div class="sidebar-title">SMKN 4 BOGOR</div>
                <div class="sidebar-subtitle">Admin Panel</div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link side">
                    <i class="fas fa-tachometer-alt"></i>Dashboard Admin
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.petugas') }}" class="nav-link side">
                    <i class="fas fa-users"></i>Manajemen Admin
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.photos.index') }}" class="nav-link side">
                    <i class="fas fa-images"></i>Kelola Galeri
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link side">
                    <i class="fas fa-folder-open"></i>Kelola Kategori
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.agenda.index') }}" class="nav-link side">
                    <i class="fas fa-calendar-alt"></i>Kelola Agenda
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.suggestions.index') }}" class="nav-link side">
                    <i class="fas fa-inbox"></i>Kotak Masuk
                    @if(isset($unreadSuggestionsCount) && $unreadSuggestionsCount > 0)
                        <span class="badge bg-danger ms-2">{{ $unreadSuggestionsCount }}</span>
                    @endif
                </a>
            </div>
            <div class="nav-divider"></div>
            <div class="nav-item">
                <a href="{{ route('admin.berita.index') }}" class="nav-link side active">
                    <i class="fas fa-newspaper"></i>Kelola Berita
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.reports') }}" class="nav-link side">
                    <i class="fas fa-chart-line"></i>Laporan Aktivitas
                </a>
            </div>
            <div class="nav-divider"></div>
            <div class="nav-item">
                <a href="{{ route('admin.logout') }}" class="nav-link side" style="color: #ef4444;">
                    <i class="fas fa-sign-out-alt"></i>Logout
                </a>
            </div>
        </nav>
        
    </div>

    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Top Bar -->
        <div class="top-bar">
            <div>
                <h1 class="page-title">Berita</h1>
                <div class="page-date">{{ now()->format('l, d F Y') }}</div>
            </div>
            <div class="user-info">
                <div class="user-profile">
                    <div class="user-profile-content">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                @if($admin)
                                    {{ $admin->username }}
                                @else
                                    Admin
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Overview Section -->
        <div class="overview-section">
            <h2 class="section-title">Overview</h2>
            <div class="overview-grid">
                <div class="overview-card">
                    <div class="overview-icon total">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="overview-number">{{ $news->total() ?? 0 }}</div>
                    <div class="overview-label">Total Berita</div>
                </div>
                <div class="overview-card">
                    <div class="overview-icon published">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="overview-number">{{ $news->where('status', 'published')->count() ?? 0 }}</div>
                    <div class="overview-label">Published</div>
                </div>
                <div class="overview-card">
                    <div class="overview-icon draft">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="overview-number">{{ $news->where('status', 'draft')->count() ?? 0 }}</div>
                    <div class="overview-label">Draft</div>
                </div>
                <div class="overview-card">
                    <div class="overview-icon archived">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="overview-number">{{ $news->where('status', 'archived')->count() ?? 0 }}</div>
                    <div class="overview-label">Archived</div>
                </div>
            </div>
        </div>

        

        <!-- Filter Tabs + Tambah Berita inline pada bar yang sama -->
        <div class="filter-tabs">
            <div class="filter-header" style="display:flex; align-items:center; justify-content:space-between; gap:1rem;">
                <div class="tab-buttons">
                    <button class="tab-btn active" data-tab="berita">
                        <i class="fas fa-newspaper"></i>
                        Berita
                    </button>
                    <button class="tab-btn" data-tab="pengumuman">
                        <i class="fas fa-bullhorn"></i>
                        Pengumuman
                    </button>
                </div>
                <button type="button" class="new-news-btn" style="margin:0;" data-bs-toggle="modal" data-bs-target="#addNewsModal">
                    <i class="fas fa-plus"></i>
                    Tambah Berita
                </button>
            </div>
        </div>


        <!-- News Cards -->
        <div class="table-container">
            <!-- Add News Modal -->
            <div class="modal fade" id="addNewsModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white;">
                            <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Berita Baru</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" id="addNewsForm">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Judul</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Ringkasan</label>
                                    <textarea name="excerpt" class="form-control" rows="3" maxlength="300"></textarea>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Jenis</label>
                                        <select name="jenis" class="form-select" required>
                                            <option value="berita">Berita</option>
                                            <option value="pengumuman">Pengumuman</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Status</label>
                                        <select name="status" class="form-select" required>
                                            <option value="draft">Draft</option>
                                            <option value="published">Published</option>
                                            <option value="archived">Archived</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Tanggal Terbit</label>
                                        <input type="datetime-local" name="published_at" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label class="form-label fw-semibold">Gambar</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Isi</label>
                                    <textarea name="content" class="form-control" rows="8" required></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" form="addNewsForm" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit News Modal -->
            <div class="modal fade" id="editNewsModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #ffffff; color: #333; border-bottom: 1px solid #e5e7eb;">
                            <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Berita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" id="editNewsForm">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Judul</label>
                                    <input type="text" name="title" id="editTitle" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Ringkasan</label>
                                    <textarea name="excerpt" id="editExcerpt" class="form-control" rows="3" maxlength="300"></textarea>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Jenis</label>
                                        <select name="jenis" id="editJenis" class="form-select" required>
                                            <option value="berita">Berita</option>
                                            <option value="pengumuman">Pengumuman</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Status</label>
                                        <select name="status" id="editStatus" class="form-select" required>
                                            <option value="draft">Draft</option>
                                            <option value="published">Published</option>
                                            <option value="archived">Archived</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Tanggal Terbit</label>
                                        <input type="datetime-local" name="published_at" id="editPublishedAt" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label class="form-label fw-semibold">Gambar</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Isi</label>
                                    <textarea name="content" id="editContent" class="form-control" rows="8" required></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" form="editNewsForm" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View News Modal -->
            <div class="modal fade" id="viewNewsModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #ffffff; color: #333; border-bottom: 1px solid #e5e7eb;">
                            <h5 class="modal-title"><i class="fas fa-eye me-2"></i>Detail Berita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div id="viewNewsContent">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-muted">Judul</label>
                                    <p id="viewTitle" class="fw-bold fs-5"></p>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold text-muted">Jenis</label>
                                        <p id="viewJenis" class="mb-0"></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold text-muted">Status</label>
                                        <p id="viewStatus" class="mb-0"></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold text-muted">Tanggal Terbit</label>
                                        <p id="viewPublishedAt" class="mb-0"></p>
                                    </div>
                                </div>
                                <div class="mb-3" id="viewImageContainer" style="display: none;">
                                    <label class="form-label fw-semibold text-muted">Gambar</label>
                                    <div class="text-center">
                                        <img id="viewImage" src="" alt="Gambar Berita" class="img-fluid rounded" style="max-height: 300px;">
                                    </div>
                                </div>
                                <div class="mb-3" id="viewExcerptContainer">
                                    <label class="form-label fw-semibold text-muted">Ringkasan</label>
                                    <p id="viewExcerpt"></p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-muted">Isi Berita</label>
                                    <div id="viewContent" class="border rounded p-3" style="background-color: #f8f9fa; min-height: 200px; white-space: pre-wrap;"></div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-muted">Dibuat</label>
                                        <p id="viewCreatedAt" class="mb-0 small"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-muted">Diperbarui</label>
                                        <p id="viewUpdatedAt" class="mb-0 small"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            @if($news->count() > 0)
                <div class="row g-4">
                    @foreach($news as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="news-card" data-jenis="{{ $item->jenis ?? 'berita' }}">
                                <div class="news-card-image">
                                    @if($item->image_path)
                                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}">
                                    @else
                                        <div class="news-placeholder">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    @endif
                                    <div class="news-status-badge">
                                        <span class="badge bg-{{ $item->status == 'published' ? 'success' : ($item->status == 'draft' ? 'warning' : 'secondary') }}">{{ ucfirst($item->status) }}</span>
                                    </div>
                                </div>
                                <div class="news-card-content">
                                    <div class="news-card-header">
                                        <h5 class="news-card-title">{{ $item->title }}</h5>
                                        <span class="jenis-badge jenis-{{ $item->jenis ?? 'berita' }}">
                                            {{ ucfirst($item->jenis ?? 'berita') }}
                                        </span>
                                    </div>
                                    @if($item->excerpt)
                                        <p class="news-card-excerpt">{{ Str::limit($item->excerpt, 100) }}</p>
                                    @endif
                                    <div class="news-card-meta">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d M Y') : 'Belum dipublikasi' }}
                                        </small>
                                    </div>
                                </div>
                                <div class="news-card-actions">
                                    <button type="button"
                                            class="btn-action view"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewNewsModal"
                                            data-id="{{ $item->id }}"
                                            title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button"
                                            class="btn-action edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editNewsModal"
                                            data-id="{{ $item->id }}"
                                            data-title="{{ $item->title }}"
                                            data-excerpt="{{ $item->excerpt }}"
                                            data-content="{{ $item->content }}"
                                            data-jenis="{{ $item->jenis ?? 'berita' }}"
                                            data-status="{{ $item->status }}"
                                            data-published_at="{{ $item->published_at }}"
                                            title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if($news->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $news->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="fas fa-newspaper"></i>
                    <h4>Belum ada berita</h4>
                    <p>Mulai dengan membuat berita pertama Anda</p>
                    <a href="{{ route('admin.berita.create') }}" class="new-news-btn">
                        <i class="fas fa-plus"></i>
                        Tambah Berita Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Filter Tabs Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const newsCards = document.querySelectorAll('.news-card');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    const tabType = this.getAttribute('data-tab');
                    
                    // Filter news cards based on tab
                    newsCards.forEach(card => {
                        const jenisBadge = card.querySelector('.jenis-badge');
                        const cardType = jenisBadge ? jenisBadge.textContent.toLowerCase().trim() : 'berita';
                        
                        if (tabType === 'all' || cardType === tabType) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
            
            // Wire up Edit modal
            const editModal = document.getElementById('editNewsModal');
            if (editModal) {
                editModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    if (!button) return;
                    const id = button.getAttribute('data-id');
                    document.getElementById('editNewsForm').action = "{{ url('admin/berita') }}/" + id;
                    document.getElementById('editTitle').value = button.getAttribute('data-title') || '';
                    document.getElementById('editExcerpt').value = button.getAttribute('data-excerpt') || '';
                    document.getElementById('editContent').value = button.getAttribute('data-content') || '';
                    const jenis = button.getAttribute('data-jenis') || 'berita';
                    const status = button.getAttribute('data-status') || 'draft';
                    const publishedAt = button.getAttribute('data-published_at') || '';
                    document.getElementById('editJenis').value = jenis;
                    document.getElementById('editStatus').value = status;
                    if (publishedAt) {
                        const dt = new Date(publishedAt);
                        const iso = dt.toISOString().slice(0,16);
                        document.getElementById('editPublishedAt').value = iso;
                    } else {
                        document.getElementById('editPublishedAt').value = '';
                    }
                });
            }

            // Wire up View modal
            const viewModal = document.getElementById('viewNewsModal');
            if (viewModal) {
                viewModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    if (!button) return;
                    const id = button.getAttribute('data-id');
                    
                    // Show loading in title
                    document.getElementById('viewTitle').innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat...';
                    
                    // Fetch news details
                    fetch(`{{ url('admin/berita') }}/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const news = data.data;
                                document.getElementById('viewTitle').textContent = news.title;
                                document.getElementById('viewJenis').innerHTML = `<span class="badge bg-${news.jenis === 'berita' ? 'primary' : 'success'}">${news.jenis.charAt(0).toUpperCase() + news.jenis.slice(1)}</span>`;
                                document.getElementById('viewStatus').innerHTML = `<span class="badge bg-${news.status === 'published' ? 'success' : (news.status === 'draft' ? 'warning' : 'secondary')}">${news.status.charAt(0).toUpperCase() + news.status.slice(1)}</span>`;
                                document.getElementById('viewPublishedAt').textContent = news.published_at ? new Date(news.published_at).toLocaleDateString('id-ID') : 'Belum dipublikasi';
                                
                                // Handle image
                                if (news.image_path) {
                                    document.getElementById('viewImageContainer').style.display = 'block';
                                    document.getElementById('viewImage').src = `{{ asset('storage') }}/${news.image_path}`;
                                } else {
                                    document.getElementById('viewImageContainer').style.display = 'none';
                                }
                                
                                // Handle excerpt
                                if (news.excerpt) {
                                    document.getElementById('viewExcerptContainer').style.display = 'block';
                                    document.getElementById('viewExcerpt').textContent = news.excerpt;
                                } else {
                                    document.getElementById('viewExcerptContainer').style.display = 'none';
                                }
                                
                                document.getElementById('viewContent').textContent = news.content;
                                document.getElementById('viewCreatedAt').textContent = news.created_at;
                                document.getElementById('viewUpdatedAt').textContent = news.updated_at;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            document.getElementById('viewTitle').innerHTML = '<span class="text-danger"><i class="fas fa-exclamation-triangle"></i> Gagal memuat data</span>';
                        });
                });
            }
        });

        // Hamburger menu toggle
        const hamburger=document.getElementById('hamburgerMenu');
        const sidebar=document.querySelector('.sidebar');
        if(hamburger && sidebar){
            hamburger.addEventListener('click',function(){
                hamburger.classList.toggle('active');
                sidebar.classList.toggle('active');
            });
            // Close sidebar when clicking outside
            document.addEventListener('click',function(e){
                if(!sidebar.contains(e.target) && !hamburger.contains(e.target) && sidebar.classList.contains('active')){
                    sidebar.classList.remove('active');
                    hamburger.classList.remove('active');
                }
            });
        }
    </script>
</body>
</html>
