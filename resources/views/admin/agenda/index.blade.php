<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Agenda - Admin Dashboard</title>
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

        .sidebar-logo { width: 50px; height: 50px; overflow: visible; border: none; box-shadow: none; border-radius: 0; background: transparent; padding: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .sidebar-logo img{width:100%;height:100%;object-fit:contain;background:transparent;max-width:100%;max-height:100%;}

        .sidebar-title { font-size: 1.2rem; font-weight: 700; letter-spacing: 0.3px; color: #1f2937; line-height: 1.2; margin: 0; }
        .sidebar-subtitle { font-size: 0.8rem; opacity: 0.7; font-weight: 700; color: #6b7280; line-height: 1.2; }

        .sidebar-nav { padding: 1.5rem 0; }

        .nav-item { margin: 0.25rem 1rem; }

        .nav-link.side { display:flex; align-items:center; padding:0.875rem 1.25rem; color:#6b7280; text-decoration:none; border-radius:8px; transition:all 0.3s ease; font-weight:500; font-size:0.9rem; margin:0.25rem 1rem; }
        .nav-link.side:hover { background: rgba(30,64,175,0.15); color:#1e40af; }
        .nav-link.side.active { background: rgba(30,64,175,0.25); color:#1e40af; box-shadow: 0 2px 8px rgba(30,64,175,0.3); }
        .nav-link.side i { margin-right:0.875rem; width:18px; font-size:1rem; text-align:center; }
        .nav-divider { height:1px; background:rgba(30,64,175,0.3); margin:1rem 1.5rem; border-radius:1px; }

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

        .notification-icons { display:none; }

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
            background: rgba(99, 102, 241, 0.05);
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
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
        }

        .dropdown-divider {
            margin: 0.5rem 0;
            border-color: rgba(0, 0, 0, 0.1);
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
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
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
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }
        .overview-icon.open-rate,
        .overview-icon.complete,
        .overview-icon.unique-views,
        .overview-icon.total-views { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }

        .overview-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .overview-label {
            color: var(--light-gray);
            font-weight: 600;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            border-left: 4px solid var(--primary-color);
        }

        .agenda-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .agenda-card .card-body {
            padding: 1.5rem;
        }

        .agenda-card .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .agenda-card .card-text {
            color: var(--light-gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .agenda-meta {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px dashed #e2e8f0;
        }

        .meta-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            color: var(--light-gray);
            font-size: 0.85rem;
        }

        .meta-item i {
            width: 16px;
            text-align: center;
            margin-right: 0.5rem;
            color: var(--primary-color);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--light-gray);
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state h4 {
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .empty-state p {
            color: var(--light-gray);
            margin-bottom: 1.5rem;
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.8rem 2rem;
            background: white;
            border-bottom: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .page-date {
            color: var(--light-gray);
            font-size: 0.95rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
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

        .add-agenda-btn,
        .new-category-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            border: none;
            padding: 0.8rem 1.8rem;
            border-radius: 14px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            font-size: 0.95rem;
        }

        .add-agenda-btn:hover,
        .new-category-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }

        .add-agenda-btn:active,
        .new-category-btn:active {
            transform: translateY(-1px);
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
                <a href="{{ route('admin.agenda') }}" class="nav-link side active">
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
                <h1 class="page-title">Agenda</h1>
                <div class="page-date">{{ now()->format('l, d F Y') }}</div>
            </div>
            <div class="user-info">
                 <!-- notification icons removed -->
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
                                    admin
                                @endif
                            </div>
                            <div class="user-role">Admin</div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        <!-- Agenda List -->
        <div class="agenda-list">
            <div class="table-header d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0" style="font-weight: 700; color: var(--dark-color);">Daftar Agenda</h5>
                <button class="new-category-btn" data-bs-toggle="modal" data-bs-target="#addAgendaModal">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Agenda Baru</span>
                </button>
            </div>
            
            @if(isset($groupedAgendas) && $groupedAgendas->count() > 0)
                @foreach($groupedAgendas as $month => $items)
                    <div class="agenda-month-section" style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0;">
                        <h6 style="font-size: 0.9rem; font-weight: 500; color: #64748b; margin-bottom: 1.5rem; text-transform: capitalize;">{{ $month }}</h6>
                        <div class="row g-4">
                            @foreach($items as $item)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="agenda-card card h-100" style="min-height: 220px;">
                                        <div class="card-body" style="display: flex; flex-direction: column; padding: 1rem;">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h6 class="card-title mb-0" style="font-size: 0.95rem; font-weight: 600;">{{ strlen($item->judul) > 25 ? substr($item->judul, 0, 25) . '...' : $item->judul }}</h6>
                                                <span class="badge bg-{{ $item->status === 'aktif' ? 'success' : ($item->status === 'selesai' ? 'secondary' : 'warning') }}" style="font-size: 0.7rem; padding: 0.3rem 0.6rem;">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </div>
                                            
                                            @if(!empty($item->deskripsi))
                                                <p class="card-text text-muted" style="font-size: 0.75rem; margin-bottom: 0.8rem; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-align: justify;">{{ $item->deskripsi }}</p>
                                            @else
                                                <p class="card-text text-muted" style="font-size: 0.75rem; margin-bottom: 0.8rem; line-height: 1.3; color: #cbd5e1; font-style: italic;">Tidak ada deskripsi</p>
                                            @endif
                                            
                                            <div class="agenda-meta" style="margin-top: auto; border-top: 1px solid #e5e7eb; padding-top: 0.6rem;">
                                                <div class="meta-item" style="font-size: 0.75rem; margin-bottom: 0.3rem;">
                                                    <i class="far fa-calendar" style="width: 12px;"></i>
                                                    <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                                </div>
                                                <div class="meta-item" style="font-size: 0.75rem; margin-bottom: 0.3rem;">
                                                    <i class="far fa-clock" style="width: 12px;"></i>
                                                    <span>{{ $item->waktu_mulai ?? '00:00' }} - {{ $item->waktu_selesai ?? '23:59' }}</span>
                                                </div>
                                                @if(!empty($item->lokasi))
                                                <div class="meta-item" style="font-size: 0.75rem;">
                                                    <i class="fas fa-map-marker-alt" style="width: 12px;"></i>
                                                    <span>{{ strlen($item->lokasi) > 25 ? substr($item->lokasi, 0, 25) . '...' : $item->lokasi }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            
                                            <div class="d-flex justify-content-end gap-2" style="margin-top: 0.6rem; padding-top: 0.6rem; border-top: 1px solid #e5e7eb;">
                                                <button class="btn btn-sm btn-outline-primary edit-agenda" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editAgendaModal" style="font-size: 0.75rem; padding: 0.3rem 0.6rem;">
                                                    <i class="fas fa-edit fa-fw"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger delete-agenda" data-id="{{ $item->id }}" style="font-size: 0.75rem; padding: 0.3rem 0.6rem;">
                                                    <i class="fas fa-trash fa-fw"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                @else
                    <div class="empty-state py-5 my-4">
                        <div class="mb-3">
                            <i class="fas fa-calendar-alt fa-4x text-muted"></i>
                        </div>
                        <h4 class="h5 mb-2">Belum Ada Agenda</h4>
                        <p class="text-muted mb-4">Mulai dengan menambahkan agenda pertama untuk kegiatan sekolah</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAgendaModal">
                            <i class="fas fa-plus me-2"></i>Tambah Agenda Pertama
                        </button>
                    </div>
                @endif
        </div>
    </div>

    <!-- Add Agenda Modal -->
    <div class="modal fade" id="addAgendaModal" tabindex="-1" aria-labelledby="addAgendaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: white; color: #333; border-bottom: 1px solid #e5e7eb;">
                    <h5 class="modal-title" id="addAgendaModalLabel">
                        <i class="fas fa-plus me-2"></i>Tambah Agenda Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.agenda.store') }}" method="POST" id="agendaForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Judul Agenda <span class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control" placeholder="Masukkan judul agenda" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">Waktu Mulai <span class="text-danger">*</span></label>
                                <input type="time" name="waktu_mulai" class="form-control" required>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">Waktu Selesai <span class="text-danger">*</span></label>
                                <input type="time" name="waktu_selesai" class="form-control" required>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi agenda"></textarea>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" placeholder="Tempat pelaksanaan">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="draft">Draft</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <!-- Hidden fields for other required data -->
                        <input type="hidden" name="kelas" value="">
                        <input type="hidden" name="tipe" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" form="agendaForm" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Agenda
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Agenda Modal -->
    <div class="modal fade" id="editAgendaModal" tabindex="-1" aria-labelledby="editAgendaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: white; color: #333; border-bottom: 1px solid #e5e7eb;">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i>Edit Agenda
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAgendaForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Judul Agenda <span class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control" placeholder="Masukkan judul agenda" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">Waktu Mulai <span class="text-danger">*</span></label>
                                <input type="time" name="waktu_mulai" class="form-control" required>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">Waktu Selesai <span class="text-danger">*</span></label>
                                <input type="time" name="waktu_selesai" class="form-control" required>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi agenda"></textarea>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" placeholder="Tempat pelaksanaan">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="draft">Draft</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <!-- Hidden fields for other required data -->
                        <input type="hidden" name="kelas" value="">
                        <input type="hidden" name="tipe" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" form="editAgendaForm" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailAgendaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: white; color: #333; border-bottom: 1px solid #e5e7eb;">
                    <h5 class="modal-title">
                        <i class="fas fa-eye me-2"></i>Detail Agenda
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="fw-semibold text-muted">Judul</div>
                            <div id="detailJudul" class="fs-5"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="fw-semibold text-muted">Tanggal</div>
                            <div id="detailTanggal"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="fw-semibold text-muted">Waktu</div>
                            <div id="detailWaktu"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="fw-semibold text-muted">Lokasi</div>
                            <div id="detailLokasi"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="fw-semibold text-muted">Kelas</div>
                            <div id="detailKelas"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="fw-semibold text-muted">Status</div>
                            <div id="detailStatus"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-open modal if URL contains hash
            if (window.location.hash === '#addAgendaModal') {
                const modal = new bootstrap.Modal(document.getElementById('addAgendaModal'));
                modal.show();
            }

            // View Detail functionality
            document.querySelectorAll('.action-btn.view').forEach(function(btn){
                btn.addEventListener('click', function(){
                    const modal = new bootstrap.Modal(document.getElementById('detailAgendaModal'));
                    document.getElementById('detailJudul').textContent = this.dataset.judul || '-';
                    document.getElementById('detailTanggal').textContent = this.dataset.tanggal || '-';
                    document.getElementById('detailWaktu').textContent = this.dataset.waktu || '-';
                    document.getElementById('detailLokasi').textContent = this.dataset.lokasi || '-';
                    document.getElementById('detailKelas').textContent = this.dataset.kelas || '-';
                    document.getElementById('detailStatus').textContent = (this.dataset.status || '-').toUpperCase();
                    modal.show();
                });
            });


            // Edit Agenda: reuse add modal with method spoofing
            const addModal = document.getElementById('addAgendaModal');
            const form = document.getElementById('agendaForm');
            
            function setFormAction(id){
                if (!id) {
                    form.action = "{{ route('admin.agenda.store') }}";
                    const method = form.querySelector('input[name="_method"]');
                    if (method) method.remove();
                } else {
                    form.action = "{{ url('admin/agenda') }}/" + id;
                    if (!form.querySelector('input[name="_method"]')){
                        const spoof = document.createElement('input');
                        spoof.type = 'hidden'; spoof.name = '_method'; spoof.value = 'PUT';
                        form.appendChild(spoof);
                    }
                }
            }

            // Reset to create mode when opening with Add button - optimized
            document.querySelectorAll('[data-bs-target="#addAgendaModal"]').forEach(function(btn){
                btn.addEventListener('click', function(e){
                    e.preventDefault();
                    
                    // Only reset if it's not an edit button
                    if (!this.dataset.id) {
                        console.log('Opening add agenda modal');
                        
                        // Get form elements once
                        const form = document.getElementById('agendaForm');
                        const modalTitle = document.getElementById('addAgendaModalLabel');
                        
                        // Reset form values
                        form.querySelector('input[name="judul"]').value = '';
                        form.querySelector('input[name="tanggal"]').value = '';
                        form.querySelector('input[name="waktu_mulai"]').value = '';
                        form.querySelector('input[name="waktu_selesai"]').value = '';
                        form.querySelector('textarea[name="deskripsi"]').value = '';
                        form.querySelector('input[name="lokasi"]').value = '';
                        form.querySelector('select[name="status"]').value = 'aktif';
                        
                        // Remove any existing _method input
                        const existingMethod = form.querySelector('input[name="_method"]');
                        if (existingMethod) {
                            existingMethod.remove();
                        }
                        
                        // Set form action for new agenda (POST to store)
                        form.action = "{{ route('admin.agenda.store') }}";
                        form.method = 'POST';
                        
                        console.log('Form action set to:', form.action);
                        
                        // Update modal title
                        modalTitle.innerHTML = '<i class="fas fa-plus me-2"></i>Tambah Agenda Baru';
                    }
                });
            });

            // Edit button wiring - fetch data from server
            document.querySelectorAll('.edit-agenda').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const agendaId = this.dataset.id;
                    const form = document.getElementById('editAgendaForm');
                    
                    console.log('Edit button clicked for agenda:', agendaId);
                    
                    // Fetch agenda data from server with cache-busting
                    fetch(`/admin/agenda/${agendaId}?t=${Date.now()}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Cache-Control': 'no-cache, no-store, must-revalidate',
                            'Pragma': 'no-cache',
                            'Expires': '0'
                        }
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Fetched data:', data);
                        
                        // Populate form with fetched data
                        form.querySelector('input[name="judul"]').value = data.judul || '';
                        form.querySelector('input[name="tanggal"]').value = data.tanggal || '';
                        form.querySelector('input[name="waktu_mulai"]').value = data.waktu_mulai || '00:00';
                        form.querySelector('input[name="waktu_selesai"]').value = data.waktu_selesai || '23:59';
                        form.querySelector('textarea[name="deskripsi"]').value = data.deskripsi || '';
                        form.querySelector('input[name="lokasi"]').value = data.lokasi || '';
                        form.querySelector('select[name="status"]').value = data.status || 'aktif';
                        
                        // Set form action with PUT method
                        form.action = `/admin/agenda/${agendaId}`;
                        form.method = 'POST';
                        
                        // Ensure PUT method is set
                        let methodInput = form.querySelector('input[name="_method"]');
                        if (!methodInput) {
                            methodInput = document.createElement('input');
                            methodInput.type = 'hidden';
                            methodInput.name = '_method';
                            methodInput.value = 'PUT';
                            form.appendChild(methodInput);
                        } else {
                            methodInput.value = 'PUT';
                        }
                        
                        // Ensure CSRF token exists
                        let csrfInput = form.querySelector('input[name="_token"]');
                        if (!csrfInput) {
                            const csrfToken = document.querySelector('meta[name="csrf-token"]');
                            if (csrfToken) {
                                csrfInput = document.createElement('input');
                                csrfInput.type = 'hidden';
                                csrfInput.name = '_token';
                                csrfInput.value = csrfToken.content;
                                form.appendChild(csrfInput);
                            }
                        }
                        
                        console.log('Form action set to:', form.action, 'with method PUT');
                        console.log('Form data prepared for agenda ID:', agendaId);
                        
                        // Show the edit modal
                        const modal = new bootstrap.Modal(document.getElementById('editAgendaModal'));
                        modal.show();
                    })
                    .catch(error => {
                        console.error('Error fetching agenda:', error);
                        alert('Gagal memuat data agenda: ' + error.message);
                    });
                });
            });
            
            // Form submit handler - refresh page after successful submit
            const agendaForm = document.getElementById('agendaForm');
            const editAgendaForm = document.getElementById('editAgendaForm');
            
            if (agendaForm) {
                agendaForm.addEventListener('submit', function(e) {
                    // Let form submit normally, then refresh after a short delay
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                });
            }
            
            if (editAgendaForm) {
                editAgendaForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const form = this;
                    const formData = new FormData(form);
                    const submitBtn = form.closest('.modal').querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.innerHTML;
                    
                    // Disable submit button
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                    
                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });
                        
                        if (response.ok) {
                            // Success - close modal and reload page
                            const modal = bootstrap.Modal.getInstance(document.getElementById('editAgendaModal'));
                            if (modal) {
                                modal.hide();
                            }
                            
                            // Show success message
                            const successAlert = document.createElement('div');
                            successAlert.className = 'alert alert-success alert-dismissible fade show';
                            successAlert.innerHTML = '<strong>Berhasil!</strong> Agenda berhasil diupdate!';
                            document.querySelector('.container-fluid').insertBefore(successAlert, document.querySelector('.container-fluid').firstChild);
                            
                            // Reload page after short delay
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            // Handle validation errors
                            const contentType = response.headers.get('content-type');
                            let errorMessage = 'Gagal mengupdate agenda. Silakan coba lagi.';
                            
                            if (contentType && contentType.includes('application/json')) {
                                const errorData = await response.json();
                                if (errorData.errors) {
                                    const errors = Object.values(errorData.errors).flat();
                                    errorMessage = errors.join(', ');
                                } else if (errorData.message) {
                                    errorMessage = errorData.message;
                                }
                            } else {
                                const text = await response.text();
                                console.error('Error response:', text);
                            }
                            
                            alert(errorMessage);
                            
                            // Re-enable submit button
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalBtnText;
                        }
                    } catch (error) {
                        console.error('Error updating agenda:', error);
                        alert('Terjadi kesalahan saat mengupdate agenda. Silakan coba lagi.');
                        
                        // Re-enable submit button
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                    }
                });
            }
            
            // Delete button functionality
            document.querySelectorAll('.delete-agenda').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Apakah Anda yakin ingin menghapus agenda ini?')) {
                        const agendaId = this.dataset.id;
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `/admin/agenda/${agendaId}`;
                        
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';
                        
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken;
                        
                        form.appendChild(methodInput);
                        form.appendChild(csrfInput);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });

            // Hamburger menu toggle
            const hamburger = document.getElementById('hamburgerMenu');
            const sidebar = document.querySelector('.sidebar');
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
        });
    </script>
</body>
</html>






