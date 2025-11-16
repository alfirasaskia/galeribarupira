<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Foto - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1f6fd6;
            --secondary-blue: #0056b3;
            --light-blue: #e3f2fd;
            --dark-gray: #333333;
            --light-gray: #666666;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --accent-orange: #f59e0b;
            --accent-green: #10b981;
            --accent-red: #ef4444;
            --border-color: #e9ecef;
        }

        body {
            background: var(--light-bg);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: var(--white) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-bottom: 1px solid #e9ecef;
        }
        
        .navbar-brand {
            color: var(--primary-blue) !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .navbar-nav .nav-link {
            color: var(--dark-gray) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
            border-radius: 6px;
            padding: 0.5rem 1rem;
        }
        
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary-blue) !important;
            background: var(--light-blue);
        }
        
        .btn-logout {
            background: var(--primary-blue);
            border: none;
            color: var(--white);
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-left: 1rem;
        }
        
        .btn-logout:hover {
            background: var(--secondary-blue);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(31, 111, 214, 0.3);
        }
        
        .main-content {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .page-header {
            background: linear-gradient(135deg, var(--accent-orange) 0%, var(--primary-blue) 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(245, 158, 11, 0.3);
            position: relative;
            overflow: hidden;
            color: var(--white);
            animation: float 6s ease-in-out infinite;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 8s linear infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .page-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--white);
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            position: relative;
            z-index: 2;
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.9);
            font-weight: 500;
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        .btn-add-photo {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: var(--white);
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 2;
        }

        .btn-add-photo:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        
        .main-content {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .photo-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .photo-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-orange), var(--primary-blue));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .photo-card:hover::before {
            transform: scaleX(1);
        }

        .photo-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .photo-card:nth-child(1) { animation-delay: 0.1s; }
        .photo-card:nth-child(2) { animation-delay: 0.2s; }
        .photo-card:nth-child(3) { animation-delay: 0.3s; }
        .photo-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .photo-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--accent-orange), var(--primary-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--white);
            font-size: 2rem;
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
            transition: all 0.3s ease;
        }

        .photo-card:hover .photo-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .photo-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 1rem;
            text-align: center;
        }

        .photo-description {
            color: var(--light-gray);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .photo-stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: var(--light-bg);
            border-radius: 15px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-orange);
            display: block;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--light-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .photo-actions {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .btn-edit {
            background: var(--accent-green);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-edit:hover {
            background: #059669;
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-delete {
            background: var(--accent-red);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-view {
            background: var(--primary-blue);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-view:hover {
            background: var(--secondary-blue);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(31, 111, 214, 0.3);
        }
        
        .btn-custom {
            background: var(--primary-blue);
            border: none;
            border-radius: 6px;
            padding: 0.75rem 1.5rem;
            color: var(--white);
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-custom:hover {
            background: var(--secondary-blue);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(31, 111, 214, 0.3);
        }
        
        .photo-card {
            background: var(--white);
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            position: relative;
            overflow: hidden;
        }
        
        .photo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .photo-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
        }
        
        .photo-info {
            padding: 1.5rem;
        }
        
        .photo-title {
            color: var(--dark-gray);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        .photo-description {
            color: var(--light-gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        
        .photo-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.85rem;
            color: var(--light-gray);
        }
        
        .photo-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-edit {
            background: var(--warning-color);
            color: var(--white);
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        
        .btn-edit:hover {
            background: #d97706;
            color: var(--white);
            transform: translateY(-2px);
        }
        
        .btn-delete {
            background: var(--danger-color);
            color: var(--white);
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        
        .btn-delete:hover {
            background: #dc2626;
            color: var(--white);
            transform: translateY(-2px);
        }
        
        .btn-view {
            background: var(--success-color);
            color: var(--white);
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        
        .btn-view:hover {
            background: #059669;
            color: var(--white);
            transform: translateY(-2px);
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
        
        .alert {
            border-radius: 8px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid var(--success-color);
        }
        
        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--danger-color);
        }
        
        .filters {
            background: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #e9ecef;
            padding: 0.5rem 0.75rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(31, 111, 214, 0.25);
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .photo-actions {
                flex-direction: column;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" style="position: fixed; left: 0; top: 0; width: 280px; height: 100vh; background: linear-gradient(180deg, #3b82f6 0%, #1d4ed8 100%); color: white; z-index: 1000; box-shadow: 4px 0 20px rgba(0,0,0,0.1);">
        <div class="sidebar-header" style="background: rgba(255,255,255,0.1); padding: 2rem 1.5rem; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div class="sidebar-logo" style="width: 80px; height: 80px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 2rem; color: white; box-shadow: 0 8px 25px rgba(99,102,241,0.35);">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="sidebar-title" style="font-size: 1.1rem; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 0.5rem;">SMKN 4 KOTA BOGOR</div>
            <div class="sidebar-subtitle" style="font-size: 0.85rem; opacity: 0.8; font-weight: 400;">Admin Panel</div>
        </div>
        <nav class="sidebar-nav" style="padding: 2rem 0;">
            <div class="nav-item" style="margin: 0.5rem 1rem;">
                <a href="{{ route('admin.dashboard') }}" class="nav-link side" style="display:flex;align-items:center;padding:0.875rem 1.25rem;color:rgba(255,255,255,0.7);text-decoration:none;border-radius:10px;transition:all 0.3s ease;font-weight:500;font-size:0.9rem;">
                    <i class="fas fa-tachometer-alt" style="margin-right:1rem;width:20px;font-size:1rem;"></i>Dashboard Admin
                </a>
            </div>
            <div class="nav-item" style="margin: 0.5rem 1rem;">
                <a href="{{ route('admin.photos.index') }}" class="nav-link side" style="display:flex;align-items:center;padding:0.875rem 1.25rem;color:rgba(255,255,255,0.7);text-decoration:none;border-radius:10px;transition:all 0.3s ease;font-weight:500;font-size:0.9rem;">
                    <i class="fas fa-images" style="margin-right:1rem;width:20px;font-size:1rem;"></i>Kelola Galeri
                </a>
            </div>
            <div class="nav-item" style="margin: 0.5rem 1rem;">
                <a href="{{ route('admin.categories.index') }}" class="nav-link side" style="display:flex;align-items:center;padding:0.875rem 1.25rem;color:rgba(255,255,255,0.7);text-decoration:none;border-radius:10px;transition:all 0.3s ease;font-weight:500;font-size:0.9rem;">
                    <i class="fas fa-folder-open" style="margin-right:1rem;width:20px;font-size:1rem;"></i>Kelola Kategori
                </a>
            </div>
            <div class="nav-item" style="margin: 0.5rem 1rem;">
                <a href="{{ route('admin.agenda.index') }}" class="nav-link side" style="display:flex;align-items:center;padding:0.875rem 1.25rem;color:rgba(255,255,255,0.7);text-decoration:none;border-radius:10px;transition:all 0.3s ease;font-weight:500;font-size:0.9rem;">
                    <i class="fas fa-calendar-alt" style="margin-right:1rem;width:20px;font-size:1rem;"></i>Kelola Agenda
                </a>
            </div>
            <div class="nav-item" style="margin: 0.5rem 1rem;">
                <a href="{{ route('admin.suggestions.index') }}" class="nav-link side" style="display:flex;align-items:center;padding:0.875rem 1.25rem;color:rgba(255,255,255,0.7);text-decoration:none;border-radius:10px;transition:all 0.3s ease;font-weight:500;font-size:0.9rem;">
                    <i class="fas fa-inbox" style="margin-right:1rem;width:20px;font-size:1rem;"></i>Kotak Masuk
                    @if(isset($unreadSuggestionsCount) && $unreadSuggestionsCount > 0)
                        <span class="badge bg-danger ms-2">{{ $unreadSuggestionsCount }}</span>
                    @endif
                </a>
            </div>
            <div class="nav-item" style="margin: 0.5rem 1rem;">
                <a href="{{ route('admin.petugas') }}" class="nav-link side" style="display:flex;align-items:center;padding:0.875rem 1.25rem;color:rgba(255,255,255,0.7);text-decoration:none;border-radius:10px;transition:all 0.3s ease;font-weight:500;font-size:0.9rem;">
                    <i class="fas fa-users" style="margin-right:1rem;width:20px;font-size:1rem;"></i>Manajemen Admin
                </a>
            </div>
            <div class="nav-divider" style="height:1px;background:rgba(255,255,255,0.2);margin:1rem 1.5rem;border-radius:1px;"></div>
            <div class="nav-item" style="margin: 0.5rem 1rem;">
                <a href="{{ route('admin.berita.index') }}" class="nav-link side" style="display:flex;align-items:center;padding:0.875rem 1.25rem;color:rgba(255,255,255,0.7);text-decoration:none;border-radius:10px;transition:all 0.3s ease;font-weight:500;font-size:0.9rem;">
                    <i class="fas fa-newspaper" style="margin-right:1rem;width:20px;font-size:1rem;"></i>Kelola Berita
                </a>
            </div>
            <div class="nav-item" style="margin: 0.5rem 1rem;">
                <a href="{{ route('admin.reports') }}" class="nav-link side" style="display:flex;align-items:center;padding:0.875rem 1.25rem;color:rgba(255,255,255,0.7);text-decoration:none;border-radius:10px;transition:all 0.3s ease;font-weight:500;font-size:0.9rem;">
                    <i class="fas fa-chart-line" style="margin-right:1rem;width:20px;font-size:1rem;"></i>Laporan Aktivitas
                </a>
            </div>
            <div class="nav-divider" style="height:1px;background:rgba(255,255,255,0.2);margin:1rem 1.5rem;border-radius:1px;"></div>
            <div class="nav-item" style="margin: 0.5rem 1rem;">
                <a href="{{ route('admin.logout') }}" class="nav-link side" style="display:flex;align-items:center;padding:0.875rem 1.25rem;color:#ef4444;text-decoration:none;border-radius:10px;transition:all 0.3s ease;font-weight:500;font-size:0.9rem;">
                    <i class="fas fa-sign-out-alt" style="margin-right:1rem;width:20px;font-size:1rem;"></i>Logout
                </a>
            </div>
    </nav>
    </div>

    <!-- Main Content -->
    <div class="container" style="margin-left:280px;max-width: calc(100% - 280px);">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Kelola Foto</h1>
            <p class="page-subtitle">Mengelola foto sekolah</p>
            <a href="{{ route('admin.foto.create') }}" class="btn btn-custom">
                <i class="fas fa-plus me-2"></i>Upload Foto Baru
            </a>
        </div>

        <!-- Filters -->
        <div class="filters">
            <form method="GET" action="{{ route('admin.foto.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Cari Foto</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Cari judul foto...">
                </div>
                <div class="col-md-3">
                    <label for="galery_id" class="form-label">Galeri</label>
                    <select class="form-select" id="galery_id" name="galery_id">
                        <option value="">Semua Galeri</option>
                        @foreach($galeries as $galery)
                            <option value="{{ $galery->id }}" {{ request('galery_id') == $galery->id ? 'selected' : '' }}>
                                {{ $galery->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori_id" name="kategori_id">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-custom">
                            <i class="fas fa-search me-1"></i>Cari
                        </button>
                        <a href="{{ route('admin.foto.index') }}" class="btn btn-secondary">
                            <i class="fas fa-refresh me-1"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Photo List -->
        <div class="main-content">
            @if($fotos->count() > 0)
                <div class="row g-4">
                    @foreach($fotos as $foto)
                        <div class="col-md-6 col-lg-4">
                            <div class="photo-card">
                                @if($foto->file)
                                    <img src="{{ asset('uploads/fotos/' . $foto->file) }}" 
                                         alt="{{ $foto->judul }}" 
                                         class="photo-image">
                                @else
                                    <div class="photo-image d-flex align-items-center justify-content-center" 
                                         style="background: var(--light-bg);">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                                
                                <div class="photo-info">
                                    <h5 class="photo-title">{{ $foto->judul }}</h5>
                                    <p class="photo-description">{{ $foto->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                    
                                    <div class="photo-meta">
                                        <span>
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $foto->created_at->format('d M Y') }}
                                        </span>
                                        <span>
                                            <i class="fas fa-folder me-1"></i>
                                            {{ $foto->galery->nama ?? 'Tanpa Galeri' }}
                                        </span>
                                    </div>
                                    
                                    <div class="photo-actions">
                                        <a href="{{ route('admin.foto.edit', $foto->id) }}" 
                                           class="btn btn-edit">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <a href="{{ asset('uploads/fotos/' . $foto->file) }}" 
                                           target="_blank"
                                           class="btn btn-view">
                                            <i class="fas fa-eye me-1"></i>Lihat
                                        </a>
                                        <form action="{{ route('admin.foto.destroy', $foto->id) }}" 
                                              method="POST" 
                                              style="display: inline;"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($fotos->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $fotos->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="fas fa-camera"></i>
                    <h4>Belum ada foto</h4>
                    <p>Mulai dengan mengupload foto pertama Anda</p>
                    <a href="{{ route('admin.foto.create') }}" class="btn btn-custom">
                        <i class="fas fa-plus me-2"></i>Upload Foto Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Foto - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1f6fd6;
            --secondary-blue: #0056b3;
            --light-blue: #e3f2fd;
            --dark-gray: #333333;
            --light-gray: #666666;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --accent-orange: #f59e0b;
            --accent-green: #10b981;
            --accent-red: #ef4444;
            --border-color: #e9ecef;
        }

        body {
            background: var(--light-bg);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: var(--white) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-bottom: 1px solid #e9ecef;
        }
        
        .navbar-brand {
            color: var(--primary-blue) !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .navbar-nav .nav-link {
            color: var(--dark-gray) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
            border-radius: 6px;
            padding: 0.5rem 1rem;
        }
        
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary-blue) !important;
            background: var(--light-blue);
        }
        
        .btn-logout {
            background: var(--primary-blue);
            border: none;
            color: var(--white);
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-left: 1rem;
        }
        
        .btn-logout:hover {
            background: var(--secondary-blue);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(31, 111, 214, 0.3);
        }
        
        .main-content {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .page-header {
            background: linear-gradient(135deg, var(--accent-orange) 0%, var(--primary-blue) 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(245, 158, 11, 0.3);
            position: relative;
            overflow: hidden;
            color: var(--white);
            animation: float 6s ease-in-out infinite;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 8s linear infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .page-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--white);
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            position: relative;
            z-index: 2;
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.9);
            font-weight: 500;
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        .btn-add-photo {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: var(--white);
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 2;
        }

        .btn-add-photo:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        
        .main-content {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .photo-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .photo-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-orange), var(--primary-blue));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .photo-card:hover::before {
            transform: scaleX(1);
        }

        .photo-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .photo-card:nth-child(1) { animation-delay: 0.1s; }
        .photo-card:nth-child(2) { animation-delay: 0.2s; }
        .photo-card:nth-child(3) { animation-delay: 0.3s; }
        .photo-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .photo-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--accent-orange), var(--primary-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--white);
            font-size: 2rem;
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
            transition: all 0.3s ease;
        }

        .photo-card:hover .photo-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .photo-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 1rem;
            text-align: center;
        }

        .photo-description {
            color: var(--light-gray);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .photo-stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: var(--light-bg);
            border-radius: 15px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-orange);
            display: block;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--light-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .photo-actions {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .btn-edit {
            background: var(--accent-green);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-edit:hover {
            background: #059669;
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-delete {
            background: var(--accent-red);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-view {
            background: var(--primary-blue);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-view:hover {
            background: var(--secondary-blue);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(31, 111, 214, 0.3);
        }
        
        .btn-custom {
            background: var(--primary-blue);
            border: none;
            border-radius: 6px;
            padding: 0.75rem 1.5rem;
            color: var(--white);
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-custom:hover {
            background: var(--secondary-blue);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(31, 111, 214, 0.3);
        }
        
        .photo-card {
            background: var(--white);
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            position: relative;
            overflow: hidden;
        }
        
        .photo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .photo-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
        }
        
        .photo-info {
            padding: 1.5rem;
        }
        
        .photo-title {
            color: var(--dark-gray);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        .photo-description {
            color: var(--light-gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        
        .photo-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.85rem;
            color: var(--light-gray);
        }
        
        .photo-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-edit {
            background: var(--warning-color);
            color: var(--white);
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        
        .btn-edit:hover {
            background: #d97706;
            color: var(--white);
            transform: translateY(-2px);
        }
        
        .btn-delete {
            background: var(--danger-color);
            color: var(--white);
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        
        .btn-delete:hover {
            background: #dc2626;
            color: var(--white);
            transform: translateY(-2px);
        }
        
        .btn-view {
            background: var(--success-color);
            color: var(--white);
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        
        .btn-view:hover {
            background: #059669;
            color: var(--white);
            transform: translateY(-2px);
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
        
        .alert {
            border-radius: 8px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid var(--success-color);
        }
        
        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--danger-color);
        }
        
        .filters {
            background: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #e9ecef;
            padding: 0.5rem 0.75rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(31, 111, 214, 0.25);
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .photo-actions {
                flex-direction: column;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-graduation-cap me-2"></i>SMKN 4 Bogor
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.galery.index') }}">
                            <i class="fas fa-images me-1"></i>Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.kategori.index') }}">
                            <i class="fas fa-folder me-1"></i>Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.foto.index') }}">
                            <i class="fas fa-camera me-1"></i>Foto
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.petugas') }}">
                            <i class="fas fa-users me-1"></i>Petugas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn-logout" href="{{ route('admin.logout') }}">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Kelola Foto</h1>
            <p class="page-subtitle">Mengelola foto sekolah</p>
            <a href="{{ route('admin.foto.create') }}" class="btn btn-custom">
                <i class="fas fa-plus me-2"></i>Upload Foto Baru
            </a>
        </div>

        <!-- Filters -->
        <div class="filters">
            <form method="GET" action="{{ route('admin.foto.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Cari Foto</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Cari judul foto...">
                </div>
                <div class="col-md-3">
                    <label for="galery_id" class="form-label">Galeri</label>
                    <select class="form-select" id="galery_id" name="galery_id">
                        <option value="">Semua Galeri</option>
                        @foreach($galeries as $galery)
                            <option value="{{ $galery->id }}" {{ request('galery_id') == $galery->id ? 'selected' : '' }}>
                                {{ $galery->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori_id" name="kategori_id">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-custom">
                            <i class="fas fa-search me-1"></i>Cari
                        </button>
                        <a href="{{ route('admin.foto.index') }}" class="btn btn-secondary">
                            <i class="fas fa-refresh me-1"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Photo List -->
        <div class="main-content">
            @if($fotos->count() > 0)
                <div class="row g-4">
                    @foreach($fotos as $foto)
                        <div class="col-md-6 col-lg-4">
                            <div class="photo-card">
                                @if($foto->file)
                                    <img src="{{ asset('uploads/fotos/' . $foto->file) }}" 
                                         alt="{{ $foto->judul }}" 
                                         class="photo-image">
                                @else
                                    <div class="photo-image d-flex align-items-center justify-content-center" 
                                         style="background: var(--light-bg);">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                                
                                <div class="photo-info">
                                    <h5 class="photo-title">{{ $foto->judul }}</h5>
                                    <p class="photo-description">{{ $foto->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                    
                                    <div class="photo-meta">
                                        <span>
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $foto->created_at->format('d M Y') }}
                                        </span>
                                        <span>
                                            <i class="fas fa-folder me-1"></i>
                                            {{ $foto->galery->nama ?? 'Tanpa Galeri' }}
                                        </span>
                                    </div>
                                    
                                    <div class="photo-actions">
                                        <a href="{{ route('admin.foto.edit', $foto->id) }}" 
                                           class="btn btn-edit">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <a href="{{ asset('uploads/fotos/' . $foto->file) }}" 
                                           target="_blank"
                                           class="btn btn-view">
                                            <i class="fas fa-eye me-1"></i>Lihat
                                        </a>
                                        <form action="{{ route('admin.foto.destroy', $foto->id) }}" 
                                              method="POST" 
                                              style="display: inline;"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($fotos->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $fotos->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="fas fa-camera"></i>
                    <h4>Belum ada foto</h4>
                    <p>Mulai dengan mengupload foto pertama Anda</p>
                    <a href="{{ route('admin.foto.create') }}" class="btn btn-custom">
                        <i class="fas fa-plus me-2"></i>Upload Foto Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
