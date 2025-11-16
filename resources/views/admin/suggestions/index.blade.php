<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kotak Masuk - Admin SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            --primary-blue: #3b82f6;
            --secondary-blue: #1d4ed8;
            --white: #ffffff;
            --light-gray: #64748b;
            --border-color: #e2e8f0;
            --gradient-primary: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
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

        .sidebar-logo { width: 50px; height: 50px; overflow: visible; border: none; box-shadow: none; border-radius: 0; background: transparent; padding: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .sidebar-logo img{width:100%;height:100%;object-fit:contain;background:transparent;max-width:100%;max-height:100%;}

        .sidebar-title { font-size: 1.2rem; font-weight: 700; letter-spacing: 0.3px; color: #1f2937; line-height: 1.2; margin: 0; }
        .sidebar-subtitle { font-size: 0.8rem; opacity: 0.7; font-weight: 700; color: #6b7280; line-height: 1.2; }

        .sidebar-nav {
            padding: 1.5rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link.side { display:flex; align-items:center; padding:0.875rem 1.25rem; color:#6b7280; text-decoration:none; border-radius:8px; transition:all 0.3s ease; font-weight:500; font-size:0.9rem; margin:0.25rem 1rem; }
        .nav-link.side:hover { background: rgba(30,64,175,0.15); color:#1e40af; }
        .nav-link.side.active { background: rgba(30,64,175,0.25); color:#1e40af; box-shadow: 0 2px 8px rgba(30,64,175,0.3); }

        .nav-divider { height: 1px; background: rgba(30,64,175,0.3); margin: 1rem 1.5rem; border-radius: 1px; }

        .nav-link.side i {
            margin-right: 1rem;
            width: 20px;
            font-size: 1rem;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 2rem;
            left: 0;
            right: 0;
            padding: 0 1.5rem;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: #ff6b6b;
            text-decoration: none;
            border-radius: 12px;
            background: rgba(255, 107, 107, 0.1);
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: rgba(255, 107, 107, 0.2);
            color: #ff6b6b;
            transform: translateY(-2px);
        }

        .logout-btn i {
            margin-right: 1rem;
        }

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
            background: var(--white);
            padding: 1.5rem 2rem;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
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
            border: 1px solid rgba(59, 130, 246, 0.2);
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
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
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

        .user-email {
            color: var(--light-gray);
            font-weight: 500;
            font-size: 0.8rem;
        }

        .dropdown-arrow {
            color: var(--light-gray);
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .dropdown.show .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            border: none;
            box-shadow: var(--shadow-xl);
            border-radius: 12px;
            padding: 0.5rem 0;
            min-width: 200px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .dropdown-header {
            padding: 0.5rem 1rem;
            background: rgba(59, 130, 246, 0.05);
            border-radius: 8px;
            margin: 0 0.5rem;
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            color: var(--dark-color);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary-blue);
        }

        .dropdown-divider {
            margin: 0.5rem 0;
            border-color: rgba(0, 0, 0, 0.1);
        }

        /* Stats Cards */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 1rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
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

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--light-gray);
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        /* Suggestions Table */
        .suggestions-container {
            background: var(--white);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
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

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-badge.belum-dibaca {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-badge.dibaca {
            background: #fef3c7;
            color: #d97706;
        }

        .status-badge.dibalas {
            background: #d1fae5;
            color: #059669;
        }

        .btn-action {
            padding: 0.375rem 0.75rem;
            font-size: 0.8rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: all 0.3s ease;
        }

        .btn-view {
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary-blue);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .btn-view:hover {
            background: var(--primary-blue);
            color: white;
        }

        .btn-reply {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .btn-reply:hover {
            background: #10b981;
            color: white;
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .btn-delete:hover {
            background: #ef4444;
            color: white;
        }

        .pagination {
            justify-content: center;
            margin-top: 2rem;
        }

        .page-link {
            border: none;
            color: var(--primary-blue);
            font-weight: 600;
            padding: 0.75rem 1rem;
            margin: 0 0.25rem;
            border-radius: 8px;
            background: rgba(59, 130, 246, 0.1);
        }

        .page-link:hover {
            background: var(--primary-blue);
            color: white;
        }

        .page-item.active .page-link {
            background: var(--primary-blue);
            color: white;
        }

        /* Hamburger Menu */
        .hamburger-menu{display:none;position:fixed;top:20px;left:20px;z-index:1100;width:50px;height:50px;background:rgba(255,255,255,0.95);border:none;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.15);cursor:pointer;flex-direction:column;align-items:center;justify-content:center;gap:5px;transition:all 0.3s ease}
        .hamburger-menu:hover{transform:scale(1.05);box-shadow:0 6px 16px rgba(0,0,0,0.2)}
        .hamburger-menu span{display:block;width:24px;height:3px;background:#1e40af;border-radius:2px;transition:all 0.3s ease}
        .hamburger-menu.active span:nth-child(1){transform:rotate(45deg) translate(7px,7px)}
        .hamburger-menu.active span:nth-child(2){opacity:0}
        .hamburger-menu.active span:nth-child(3){transform:rotate(-45deg) translate(7px,-7px)}

        /* Responsive */
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
            
            .top-bar {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .stats-row {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .stats-row {
                grid-template-columns: 1fr;
            }

            .suggestions-container {
                padding: 1rem;
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
            <div class="sidebar-logo"><img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah" style="width:100%;height:100%;object-fit:contain;background:transparent;"></div>
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
                <a href="{{ route('admin.agenda') }}" class="nav-link side">
                    <i class="fas fa-calendar-alt"></i>Kelola Agenda
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.suggestions.index') }}" class="nav-link side active" style="position: relative;">
                    <i class="fas fa-inbox"></i>Kotak Masuk
                    @if($unreadCount > 0)
                        <span class="badge bg-danger rounded-pill" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); font-size: 0.75rem; padding: 0.25rem 0.5rem;">{{ $unreadCount }}</span>
                    @endif
                </a>
            </div>
            <div class="nav-divider"></div>
            <div class="nav-item">
                <a href="{{ route('admin.berita.index') }}" class="nav-link side">
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

    <!-- Main Content -->
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
                <h1 class="page-title">Kotak Masuk</h1>
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
                            <div class="user-role">Administrator</div>
                        </div>
                        </div>
                </div>
            </div>
        </div>

        <!-- Overview Stats -->
        <div class="stats-row">
            <div class="stat-card" style="border-left: 4px solid #3b82f6;">
                <div class="stat-icon" style="background: rgba(59,130,246,0.1); color: #3b82f6;">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <div>
                    <div class="stat-number">{{ $readCount }}</div>
                    <div class="stat-label">Sudah Dibaca</div>
                </div>
            </div>
            <div class="stat-card" style="border-left: 4px solid #10b981;">
                <div class="stat-icon" style="background: rgba(16,185,129,0.1); color: #10b981;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="stat-number">{{ $approvedCount }}</div>
                    <div class="stat-label">Disetujui (Testimoni)</div>
                </div>
            </div>
            <div class="stat-card" style="border-left: 4px solid #ef4444;">
                <div class="stat-icon" style="background: rgba(239,68,68,0.1); color: #ef4444;">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <div class="stat-number">{{ $rejectedCount }}</div>
                    <div class="stat-label">Ditolak</div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div style="margin-bottom: 2rem; border-bottom: 2px solid var(--border-color); display: flex; gap: 0;">
            <button class="tab-button active" onclick="switchTab('suggestions')" style="padding: 1rem 1.5rem; border: none; background: none; color: var(--dark-color); font-weight: 600; cursor: pointer; border-bottom: 3px solid var(--primary-color); margin-bottom: -2px; transition: all 0.3s ease;">
                <i class="fas fa-envelope"></i> Saran & Pesan
            </button>
            <button class="tab-button" onclick="switchTab('ratings')" style="padding: 1rem 1.5rem; border: none; background: none; color: var(--light-gray); font-weight: 600; cursor: pointer; border-bottom: 3px solid transparent; margin-bottom: -2px; transition: all 0.3s ease;">
                <i class="fas fa-star"></i> Rating Bintang
            </button>
        </div>

        <!-- Suggestions Container -->
        <div class="suggestions-container" id="suggestions-tab">
            @if($suggestions->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suggestions as $suggestion)
                                @php
                                    $tipe = $suggestion->tipe ?? 'suggestion';
                                    $ratingValue = $suggestion->rating_value ?? 0;
                                @endphp
                                <tr>
                                    <td>
                                        <strong>{{ $suggestion->nama_lengkap }}</strong>
                                    </td>
                                    <td><span style="color:#0d6efd; font-weight:600;">{{ $suggestion->email }}</span></td>
                                    <td>
                                        <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ Str::limit($suggestion->pesan, 100) }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ str_replace('_', '-', $suggestion->status) }}">
                                            {{ $suggestion->status_label }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($suggestion->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn-action btn-view" 
                                                data-id="{{ $suggestion->id }}"
                                                data-name="{{ $suggestion->nama_lengkap ?? $suggestion->name ?? '' }}"
                                                data-email="{{ $suggestion->email }}"
                                                data-message="{{ $suggestion->pesan ?? $suggestion->message ?? '' }}"
                                                data-status="{{ $suggestion->status }}"
                                                data-status-label="{{ $suggestion->status_label }}"
                                                data-date="{{ \Carbon\Carbon::parse($suggestion->created_at)->format('d/m/Y H:i') }}"
                                                data-type="{{ $tipe }}"
                                                data-rating="{{ $ratingValue }}"
                                                onclick="showDetailModal(this)">
                                                <i class="fas fa-eye"></i>
                                                Lihat
                                            </button>
                                            
                                            <form action="{{ route('admin.suggestions.destroy', $suggestion->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus saran ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete">
                                                    <i class="fas fa-trash"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $suggestions->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada saran yang masuk</h5>
                    <p class="text-muted">Saran dari pengunjung akan muncul di sini.</p>
                </div>
            @endif
        </div>

        <!-- Ratings Container -->
        <div class="suggestions-container" id="ratings-tab" style="display: none;">
            @if($ratings->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Rating</th>
                                <th>Nama</th>
                                <th>Halaman</th>
                                <th>Tanggal</th>
                                <th style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ratings as $rating)
                                <tr>
                                    <td>
                                        <div style="display: flex; gap: 0.25rem;">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star" style="color: {{ $i <= $rating->rating ? '#f59e0b' : '#e2e8f0' }}; font-size: 1rem;"></i>
                                            @endfor
                                        </div>
                                        <span style="font-weight: 600; color: #1e293b; margin-left: 0.5rem;">{{ $rating->rating }}/5</span>
                                    </td>
                                    <td>
                                        <span style="font-weight: 500; color: #1e293b;">{{ $rating->nama ?? 'Anonymous' }}</span>
                                    </td>
                                    <td>
                                        <span style="background: rgba(99,102,241,0.1); color: #6366f1; padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 500; font-size: 0.85rem;">
                                            {{ ucfirst($rating->page) }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($rating->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center flex-wrap">
                                            @if(!$rating->approved)
                                                <form action="{{ route('admin.ratings.approve', $rating->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Setujui rating ini untuk ditampilkan di testimoni?')">
                                                    @csrf
                                                    <button type="submit" class="btn-action" style="background: #10b981; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.85rem; white-space: nowrap;">
                                                        <i class="fas fa-check me-1"></i>Setujui
                                                    </button>
                                                </form>
                                            @else
                                                <span style="background: #d1fae5; color: #065f46; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 500; font-size: 0.85rem; white-space: nowrap;">
                                                    <i class="fas fa-check me-1"></i>Disetujui
                                                </span>
                                            @endif
                                            <form action="{{ route('admin.ratings.destroy', $rating->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rating ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete" style="padding: 0.5rem 1rem;">
                                                    <i class="fas fa-trash"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $ratings->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-star fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada rating yang masuk</h5>
                    <p class="text-muted">Rating dari pengunjung akan muncul di sini.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
                <div class="modal-header" style="background: #1E40AF; color: white; border-radius: 16px 16px 0 0; padding: 1.5rem;">
                    <h5 class="modal-title"><i class="fas fa-comment-dots me-2"></i>Detail Saran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="padding: 2rem;">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="fw-bold text-muted mb-2 d-block" style="font-size: 0.85rem;"><i class="fas fa-user me-2"></i>NAMA</label>
                            <p id="modalName" class="fs-5 mb-0 fw-semibold"></p>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold text-muted mb-2 d-block" style="font-size: 0.85rem;"><i class="fas fa-envelope me-2"></i>EMAIL</label>
                            <p id="modalEmail" class="mb-0" style="color: #3b82f6; font-weight: 500;"></p>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="fw-bold text-muted mb-2 d-block" style="font-size: 0.85rem;"><i class="fas fa-message me-2"></i>PESAN</label>
                        <div id="modalMessage" class="p-3" style="background: #f8fafc; border-radius: 8px; white-space: pre-wrap; border-left: 4px solid #3b82f6;"></div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="fw-bold text-muted mb-2 d-block" style="font-size: 0.85rem;"><i class="fas fa-clock me-2"></i>TANGGAL</label>
                            <p id="modalDate" class="mb-0"></p>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold text-muted mb-2 d-block" style="font-size: 0.85rem;"><i class="fas fa-info-circle me-2"></i>STATUS SAAT INI</label>
                            <span id="modalStatusBadge" class="status-badge"></span>
                        </div>
                    </div>
                    
                    <div class="p-3" style="background: #f0f9ff; border-radius: 8px; border: 1px solid #bae6fd;">
                        <label class="fw-bold mb-3 d-block" style="color: #0c4a6e;"><i class="fas fa-edit me-2"></i>Ubah Status Saran</label>
                        <div class="d-grid gap-2" id="statusButtonsContainer">
                            <!-- Buttons will be generated by JavaScript -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e2e8f0; padding: 1rem 2rem;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentSuggestionId = null;
        const detailModal = new bootstrap.Modal(document.getElementById('detailModal'));

        function showDetailModal(button) {
            try {
                // Get data from button attributes
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const email = button.getAttribute('data-email');
                const message = button.getAttribute('data-message');
                const status = button.getAttribute('data-status');
                const statusLabel = button.getAttribute('data-status-label');
                const date = button.getAttribute('data-date');
                const type = button.getAttribute('data-type') || 'suggestion';
                const rating = parseInt(button.getAttribute('data-rating')) || 0;
                
                console.log('Opening modal for suggestion:', id, 'Type:', type);
                
                // Set current suggestion ID
                currentSuggestionId = id;
                
                // Update modal content
                document.getElementById('modalName').textContent = name || 'N/A';
                document.getElementById('modalEmail').textContent = email || 'N/A';
                
                // Display rating or message based on type
                const messageElement = document.getElementById('modalMessage');
                if (type === 'rating') {
                    let stars = '';
                    for (let i = 1; i <= 5; i++) {
                        stars += i <= rating ? '★' : '☆';
                    }
                    messageElement.innerHTML = `<span style="color: #f59e0b; font-size: 1.5rem; font-weight: 600;">${stars} (${rating}/5)</span>`;
                } else {
                    messageElement.textContent = message || 'N/A';
                }
                
                document.getElementById('modalDate').textContent = date || 'N/A';
                
                // Update status badge
                const badge = document.getElementById('modalStatusBadge');
                badge.textContent = statusLabel || status;
                badge.className = 'status-badge ' + status.toLowerCase().replace('_', '-').replace(' ', '-');
                
                // Create status update checkboxes
                const container = document.getElementById('statusButtonsContainer');
                container.innerHTML = `
                    <form action="/admin/suggestions/${id}/status-multiple" method="POST" id="statusForm${id}">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                        
                        <div class="form-check mb-3 p-3" style="background: #e3f2fd; border-radius: 8px; border: 2px solid #2196f3;">
                            <input class="form-check-input" type="checkbox" name="statuses[]" value="read" id="status_read_${id}" style="width: 20px; height: 20px;">
                            <label class="form-check-label ms-2" for="status_read_${id}" style="font-weight: 600; color: #1976d2; cursor: pointer;">
                                <i class="fas fa-check me-2"></i>Tandai Sudah Dibaca
                            </label>
                        </div>
                        
                        <div class="form-check mb-3 p-3" style="background: #e8f5e9; border-radius: 8px; border: 2px solid #4caf50;">
                            <input class="form-check-input" type="checkbox" name="statuses[]" value="approved" id="status_approved_${id}" style="width: 20px; height: 20px;">
                            <label class="form-check-label ms-2" for="status_approved_${id}" style="font-weight: 600; color: #388e3c; cursor: pointer;">
                                <i class="fas fa-thumbs-up me-2"></i>Setujui (Tampil di Testimoni)
                            </label>
                        </div>
                        
                        <div class="form-check mb-3 p-3" style="background: #ffebee; border-radius: 8px; border: 2px solid #f44336;">
                            <input class="form-check-input" type="checkbox" name="statuses[]" value="rejected" id="status_rejected_${id}" style="width: 20px; height: 20px;">
                            <label class="form-check-label ms-2" for="status_rejected_${id}" style="font-weight: 600; color: #d32f2f; cursor: pointer;">
                                <i class="fas fa-times-circle me-2"></i>Tolak
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100" style="padding: 0.75rem; font-weight: 600;">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </form>
                `;
                
                // Show modal
                detailModal.show();
            } catch (error) {
                console.error('Error opening modal:', error);
                alert('Gagal membuka detail saran. Error: ' + error.message);
            }
        }

        function updateStatus(newStatus) {
            if (!currentSuggestionId) {
                alert('Error: ID saran tidak ditemukan');
                console.error('currentSuggestionId is null or undefined');
                return;
            }
            
            // Confirm action
            let statusText = 'Tidak Diketahui';
            if (newStatus === 'read') statusText = 'Sudah Dibaca';
            else if (newStatus === 'pending') statusText = 'Belum Dibaca';
            else if (newStatus === 'approved') statusText = 'Disetujui (Tampil di Testimoni)';
            else if (newStatus === 'rejected') statusText = 'Ditolak';
            
            if (!confirm(`Apakah Anda yakin ingin mengubah status menjadi "${statusText}"?`)) {
                return;
            }
            
            console.log('Updating status to:', newStatus, 'for suggestion ID:', currentSuggestionId);
            
            // Send AJAX request to update status
            const url = `/admin/suggestions/${currentSuggestionId}/status`;
            console.log('Request URL:', url);
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    // Show success message
                    alert('✓ Status berhasil diubah menjadi: ' + data.status_label);
                    
                    // Close modal and reload
                    detailModal.hide();
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                } else {
                    alert('✗ Gagal mengubah status: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error details:', error);
                alert('✗ Gagal mengubah status. Error: ' + error.message + '\nSilakan coba lagi atau hubungi administrator.');
            });
        }

        // Bulk Actions Functions
        function toggleSelectAll(checkbox) {
            const checkboxes = document.querySelectorAll('.suggestion-checkbox');
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
        }

        function selectAll() {
            const checkboxes = document.querySelectorAll('.suggestion-checkbox');
            checkboxes.forEach(cb => cb.checked = true);
            document.getElementById('selectAllCheckbox').checked = true;
        }

        function deselectAll() {
            const checkboxes = document.querySelectorAll('.suggestion-checkbox');
            checkboxes.forEach(cb => cb.checked = false);
            document.getElementById('selectAllCheckbox').checked = false;
        }

        function getSelectedIds() {
            const checkboxes = document.querySelectorAll('.suggestion-checkbox:checked');
            return Array.from(checkboxes).map(cb => cb.value);
        }

        function bulkUpdateStatus(status) {
            const ids = getSelectedIds();
            if (ids.length === 0) {
                alert('Silakan pilih minimal 1 saran terlebih dahulu');
                return;
            }

            const statusText = status === 'approved' ? 'Disetujui (Tampil di Testimoni)' : 
                              status === 'read' ? 'Sudah Dibaca' :
                              status === 'pending' ? 'Belum Dibaca' : 'Ditolak';

            if (!confirm(`Apakah Anda yakin ingin mengubah status ${ids.length} saran menjadi "${statusText}"?`)) {
                return;
            }

            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/suggestions/bulk-update-status';
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]').content;
            form.appendChild(csrfInput);

            const statusInput = document.createElement('input');
            statusInput.type = 'hidden';
            statusInput.name = 'status';
            statusInput.value = status;
            form.appendChild(statusInput);

            ids.forEach(id => {
                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = 'ids[]';
                idInput.value = id;
                form.appendChild(idInput);
            });

            document.body.appendChild(form);
            form.submit();
        }

        function bulkDelete() {
            const ids = getSelectedIds();
            if (ids.length === 0) {
                alert('Silakan pilih minimal 1 saran terlebih dahulu');
                return;
            }

            if (!confirm(`Apakah Anda yakin ingin menghapus ${ids.length} saran? Tindakan ini tidak dapat dibatalkan!`)) {
                return;
            }

            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/suggestions/bulk-delete';
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]').content;
            form.appendChild(csrfInput);

            ids.forEach(id => {
                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = 'ids[]';
                idInput.value = id;
                form.appendChild(idInput);
            });

            document.body.appendChild(form);
            form.submit();
        }

        // Hamburger menu toggle
        // Tab Switching Function
        function switchTab(tabName) {
            // Hide all tabs
            document.getElementById('suggestions-tab').style.display = 'none';
            document.getElementById('ratings-tab').style.display = 'none';

            // Show selected tab
            document.getElementById(tabName + '-tab').style.display = 'block';

            // Update button styles
            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach(btn => {
                btn.style.color = 'var(--light-gray)';
                btn.style.borderBottomColor = 'transparent';
            });

            // Highlight active button
            event.target.closest('.tab-button').style.color = 'var(--dark-color)';
            event.target.closest('.tab-button').style.borderBottomColor = 'var(--primary-color)';
        }

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