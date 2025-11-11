<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Aktivitas - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { --primary-color:#6366f1; --primary-dark:#4f46e5; --success-color:#10b981; --warning-color:#f59e0b; --danger-color:#ef4444; --info-color:#06b6d4; --dark-color:#1e293b; --light-color:#f8fafc; --sidebar-width:280px; --white:#ffffff; --light-gray:#64748b; --border-color:#e2e8f0; --gradient-primary: linear-gradient(135deg,#6366f1 0%, #8b5cf6 100%); }
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter',system-ui,Segoe UI,Roboto,sans-serif;background:linear-gradient(135deg,#f8fafc 0%, #e2e8f0 100%);min-height:100vh;overflow-x:hidden;line-height:1.6}

        /* Sidebar - match /admin */
        .sidebar{position:fixed;left:0;top:0;width:var(--sidebar-width);height:100vh;background:rgba(30,64,175,0.15);color:#374151;z-index:1000;transition:all 0.3s ease;box-shadow:4px 0 20px rgba(30,64,175,0.2);border-right:1px solid rgba(30,64,175,0.3)}
        .sidebar-header{background:rgba(30,64,175,0.2);padding:1.5rem 1rem;border-bottom:1px solid rgba(30,64,175,0.3);min-height:80px;display:flex;align-items:center;gap:1rem}
        .sidebar-logo{width:50px;height:50px;overflow:visible;border:none;box-shadow:none;border-radius:0;background:transparent;padding:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .sidebar-logo img{width:100%;height:100%;object-fit:contain;background:transparent;max-width:100%;max-height:100%}
        .sidebar-title{font-size:1.2rem;font-weight:700;letter-spacing:0.3px;color:#1f2937;line-height:1.2;word-wrap:break-word}
        .sidebar-subtitle{font-size:0.8rem;opacity:0.7;font-weight:700;color:#6b7280;line-height:1.2;word-wrap:break-word}
        .sidebar-nav{padding:1.5rem 0}
        .nav-item{margin:0.25rem 1rem}
        .nav-link{display:flex;align-items:center;padding:0.875rem 1.25rem;color:#6b7280;text-decoration:none;border-radius:8px;transition:all 0.3s ease;font-weight:500;font-size:0.9rem;position:relative;margin:0.25rem 1rem}
        .nav-link:hover{background:rgba(30,64,175,0.15);color:#1e40af}
        .nav-link.active{background:rgba(30,64,175,0.25);color:#1e40af;box-shadow:0 2px 8px rgba(30,64,175,0.3)}
        .nav-link i{margin-right:0.875rem;width:18px;font-size:1rem;text-align:center}
        .nav-divider{height:1px;background:rgba(30,64,175,0.3);margin:1rem 1.5rem;border-radius:1px}

        /* Main */
        .main-content{margin-left:var(--sidebar-width);padding:2rem;min-height:100vh}
        .top-bar{display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;background:#fff;padding:1.5rem 2rem;border-radius:16px;box-shadow:0 10px 25px rgba(0,0,0,.08);border:1px solid var(--border-color)}
        .page-title{color:var(--dark-color);font-weight:700;font-size:1.5rem;margin:0}
        .page-date{color:var(--light-gray);font-size:.9rem;margin-top:.25rem}

        /* User */
        .user-profile-content{display:flex;align-items:center;gap:.75rem;padding:.5rem 1rem;background:rgba(255,255,255,.9);border-radius:12px;border:1px solid rgba(99,102,241,.2);box-shadow:0 4px 12px rgba(0,0,0,.06)}
        .user-avatar{width:50px;height:50px;border-radius:50%;background:linear-gradient(135deg,#3b82f6,#1d4ed8);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700}
        .user-name{color:var(--dark-color);font-weight:700;font-size:.9rem}
        .user-role{color:var(--light-gray);font-weight:500;font-size:.8rem}

        /* Overview */
        .overview-section{margin-bottom:2rem}
        .section-title{font-size:1.25rem;font-weight:700;color:var(--dark-color);margin-bottom:1.5rem}
        .overview-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1.5rem}
        .overview-card{background:#fff;border-radius:16px;padding:1.5rem;box-shadow:0 10px 25px rgba(0,0,0,.08);border:1px solid var(--border-color);display:flex;align-items:center;gap:1.25rem;transition:transform 0.3s ease}
        .overview-card:hover{transform:translateY(-5px)}
        .overview-icon{width:60px;height:60px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.5rem}
        .bg-primary{background:var(--gradient-primary)} 
        .bg-success{background:linear-gradient(135deg,#10b981,#059669)} 
        .bg-warning{background:linear-gradient(135deg,#f59e0b,#d97706)} 
        .bg-info{background:linear-gradient(135deg,#06b6d4,#0891b2)}
        .bg-danger{background:linear-gradient(135deg,#ef4444,#dc2626)}
        .overview-content{flex:1}
        .overview-label{color:var(--light-gray);font-size:.85rem;font-weight:500;margin-bottom:.25rem}
        .overview-value{color:var(--dark-color);font-size:1.75rem;font-weight:700}

        /* Filter Section */
        .filter-section{background:#fff;border-radius:16px;padding:1.5rem;margin-bottom:2rem;box-shadow:0 10px 25px rgba(0,0,0,.08);border:1px solid var(--border-color)}
        .filter-row{display:flex;gap:1rem;align-items:end;flex-wrap:wrap}
        .filter-group{flex:1;min-width:200px}
        .filter-label{font-weight:600;color:var(--dark-color);margin-bottom:.5rem;font-size:.9rem}
        .filter-select,.filter-input{width:100%;padding:.75rem 1rem;border:1px solid var(--border-color);border-radius:8px;font-size:.9rem}
        .filter-btn{padding:.75rem 1.5rem;border:none;border-radius:8px;font-weight:600;cursor:pointer;transition:all 0.3s ease;font-size:0.9rem}
        .btn-filter{background:#1E40AF;color:#fff}
        .btn-filter:hover{background:#1e3a8a;transform:translateY(-2px);box-shadow:0 4px 12px rgba(30,64,175,0.4)}
        .btn-export{background:#10b981;color:#fff}
        .btn-export:hover{background:#059669;transform:translateY(-2px);box-shadow:0 4px 12px rgba(16,185,129,0.4)}
        .btn-reset{background:#64748b;color:#fff}
        .btn-reset:hover{background:#475569;transform:translateY(-2px);box-shadow:0 4px 12px rgba(100,116,139,0.4)}

        /* Chart Section */
        .chart-section{background:#fff;border-radius:16px;padding:1.5rem;margin-bottom:1.5rem;box-shadow:0 10px 25px rgba(0,0,0,.08);border:1px solid var(--border-color)}
        .chart-container{position:relative;height:300px}

        /* Table Section */
        .table-section{background:#fff;border-radius:16px;padding:1.5rem;margin-bottom:1.5rem;box-shadow:0 10px 25px rgba(0,0,0,.08);border:1px solid var(--border-color)}
        .table{margin-bottom:0}
        .table thead th{background:var(--light-color);color:var(--dark-color);font-weight:600;border:none;padding:1rem}
        .table tbody td{padding:1rem;vertical-align:middle;border-color:var(--border-color)}
        .badge{padding:.5rem .75rem;border-radius:6px;font-weight:600;font-size:.75rem}
        .badge-like{background:#fef3c7;color:#92400e}
        .badge-comment{background:#dbeafe;color:#1e40af}
        .badge-report{background:#fee2e2;color:#991b1b}
        .badge-view{background:#e0e7ff;color:#3730a3}

        /* Top Photos */
        .top-photos-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem}
        .photo-card{background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,.08);border:1px solid var(--border-color);transition:transform 0.3s ease}
        .photo-card:hover{transform:translateY(-5px)}
        .photo-img{width:100%;height:150px;object-fit:cover}
        .photo-info{padding:1rem}
        .photo-title{font-weight:600;color:var(--dark-color);font-size:.9rem;margin-bottom:.5rem}
        .photo-likes{color:var(--light-gray);font-size:.85rem}
        .photo-likes i{color:#ef4444;margin-right:.25rem}
        
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
            .sidebar{transform:translateX(-100%)}
            .sidebar.active{transform:translateX(0)}
            .main-content{margin-left:0;padding:1rem;padding-top:80px}
            .top-bar{flex-direction:column;gap:1rem;padding:1rem}
            .page-title{font-size:1.25rem}
            .stats-grid{grid-template-columns:repeat(2,1fr);gap:1rem}
            .chart-section{padding:1rem}
            .table-section{padding:1rem;overflow-x:auto}
        }
        @media (max-width: 480px) {
            .stats-grid{grid-template-columns:1fr}
        }
        
        /* Print Styles */
        @media print {
            .sidebar, .filter-section, .btn, button, .no-print {
                display: none !important;
            }
            .main-content {
                margin-left: 0 !important;
                padding: 1rem !important;
            }
            .chart-section, .table-section {
                page-break-inside: avoid;
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
            body {
                background: white !important;
            }
        }
        
        /* Compact Table Styles */
        .table-compact {
            font-size: 0.85rem;
        }
        .table-compact th, .table-compact td {
            padding: 0.6rem !important;
            font-size: 0.9rem;
        }
        .table-compact img {
            width: 50px !important;
            height: 50px !important;
        }
        .section-title {
            font-size: 1.15rem !important;
            margin-bottom: 0.75rem !important;
        }
        .chart-section p, .table-section p {
            margin-bottom: 0.75rem !important;
            font-size: 0.85rem !important;
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
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo" onerror="this.style.display='none'">
            </div>
            <div>
                <h1 class="sidebar-title">SMKN 4 BOGOR</h1>
                <div class="sidebar-subtitle">Admin Panel</div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fas fa-tachometer-alt"></i> Dashboard Admin
            </a>
            <a href="{{ route('admin.petugas') }}" class="nav-link">
                <i class="fas fa-users"></i> Manajemen Admin
            </a>
            <a href="{{ route('admin.photos.index') }}" class="nav-link">
                <i class="fas fa-images"></i> Kelola Galeri
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link">
                <i class="fas fa-folder-open"></i> Kelola Kategori
            </a>
            <a href="{{ route('admin.agenda.index') }}" class="nav-link">
                <i class="fas fa-calendar"></i> Kelola Agenda
            </a>
            <a href="{{ route('admin.suggestions') }}" class="nav-link">
                <i class="fas fa-inbox"></i> Kotak Masuk
                @if(isset($unreadSuggestionsCount) && $unreadSuggestionsCount > 0)
                    <span class="badge bg-danger ms-2">{{ $unreadSuggestionsCount }}</span>
                @endif
            </a>
            <div class="nav-divider"></div>
            <a href="{{ route('admin.berita.index') }}" class="nav-link">
                <i class="fas fa-newspaper"></i> Kelola Berita
            </a>
            <a href="{{ route('admin.reports') }}" class="nav-link active">
                <i class="fas fa-chart-line"></i> Laporan Aktivitas
            </a>
            <div class="nav-divider"></div>
            <a href="{{ route('admin.logout') }}" class="nav-link" style="color: #ef4444;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div>
                <h1 class="page-title">Laporan Aktivitas Galeri</h1>
                <p class="page-date">{{ now()->format('l, d F Y') }}</p>
            </div>
            <div class="user-profile-content">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <div class="user-name">{{ session('admin_name', 'Admin') }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form method="GET" action="{{ route('admin.reports') }}">
                <div class="filter-row">
                    <div class="filter-group">
                        <label class="filter-label"><i class="fas fa-calendar-alt"></i> Filter Periode</label>
                        <select name="filter" class="filter-select" id="filterSelect">
                            <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                            <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                            <option value="custom" {{ $filter == 'custom' ? 'selected' : '' }}>Custom Range</option>
                            <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>Semua Data</option>
                        </select>
                    </div>
                    <div class="filter-group" id="customDateGroup" style="display:{{ $filter == 'custom' ? 'block' : 'none' }}">
                        <label class="filter-label">Dari Tanggal</label>
                        <input type="date" name="start_date" class="filter-input" value="{{ $startDate ? $startDate->format('Y-m-d') : '' }}">
                    </div>
                    <div class="filter-group" id="customDateGroup2" style="display:{{ $filter == 'custom' ? 'block' : 'none' }}">
                        <label class="filter-label">Sampai Tanggal</label>
                        <input type="date" name="end_date" class="filter-input" value="{{ $endDate ? $endDate->format('Y-m-d') : '' }}">
                    </div>
                    <div>
                        <button type="submit" class="filter-btn btn-filter">
                            <i class="fas fa-filter"></i> Terapkan Filter
                        </button>
                    </div>
                    <div>
                        <button type="button" class="filter-btn btn-export" onclick="showExportModal()">
                            <i class="fas fa-download"></i> Export Laporan
                        </button>
                    </div>
                </div>
                <div style="margin-top: 1rem; padding: 0.75rem; background: #f0f9ff; border-radius: 8px; border-left: 4px solid #0ea5e9;">
                    <p style="margin: 0; font-size: 0.9rem; color: #0c4a6e;">
                        <i class="fas fa-info-circle"></i> <strong>Info:</strong> Filter digunakan untuk menampilkan data dalam rentang waktu tertentu. Pilih "Custom Range" untuk menentukan tanggal sendiri.
                    </p>
                </div>
            </form>
        </div>

        <!-- Layout 2 Kolom: Statistik & Chart -->
        <div class="row mb-4">
            <!-- Kolom Kiri: Statistik Umum -->
            <div class="col-md-6">
                <div class="table-section" style="height: 100%;">
                    <h3 class="section-title">1. Statistik Umum Galeri</h3>
                    <p style="color: #64748b; margin-bottom: 1rem; font-size: 0.9rem;">Ringkasan aktivitas di seluruh galeri</p>
            <div class="table-responsive">
                <table class="table table-hover table-compact">
                    <thead>
                        <tr>
                            <th style="width: 50px; text-align: center;">Icon</th>
                            <th>Keterangan</th>
                            <th style="text-align: right; width: 120px;">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;">
                                <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg,#6366f1 0%, #8b5cf6 100%); display: flex; align-items: center; justify-content: center; color: white; margin: 0 auto; font-size: 0.85rem;">
                                    <i class="fas fa-images"></i>
                                </div>
                            </td>
                            <td style="font-weight: 600; color: #1e293b; font-size: 0.9rem;">Total Foto</td>
                            <td style="text-align: right; font-size: 1.3rem; font-weight: 700; color: #6366f1;">{{ number_format($totalPhotos) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg,#ef4444,#dc2626); display: flex; align-items: center; justify-content: center; color: white; margin: 0 auto; font-size: 0.85rem;">
                                    <i class="fas fa-heart"></i>
                                </div>
                            </td>
                            <td style="font-weight: 600; color: #1e293b; font-size: 0.9rem;">Total Like</td>
                            <td style="text-align: right; font-size: 1.3rem; font-weight: 700; color: #ef4444;">{{ number_format($totalLikes) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg,#06b6d4,#0891b2); display: flex; align-items: center; justify-content: center; color: white; margin: 0 auto; font-size: 0.85rem;">
                                    <i class="fas fa-comments"></i>
                                </div>
                            </td>
                            <td style="font-weight: 600; color: #1e293b; font-size: 0.9rem;">Total Komentar</td>
                            <td style="text-align: right; font-size: 1.3rem; font-weight: 700; color: #06b6d4;">{{ number_format($totalComments) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg,#8b5cf6,#7c3aed); display: flex; align-items: center; justify-content: center; color: white; margin: 0 auto; font-size: 0.85rem;">
                                    <i class="fas fa-bookmark"></i>
                                </div>
                            </td>
                            <td style="font-weight: 600; color: #1e293b; font-size: 0.9rem;">Total Bookmark</td>
                            <td style="text-align: right; font-size: 1.3rem; font-weight: 700; color: #8b5cf6;">{{ number_format($totalBookmarks) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg,#10b981,#059669); display: flex; align-items: center; justify-content: center; color: white; margin: 0 auto; font-size: 0.85rem;">
                                    <i class="fas fa-user-group"></i>
                                </div>
                            </td>
                            <td style="font-weight: 600; color: #1e293b; font-size: 0.9rem;">Total Pengunjung</td>
                            <td style="text-align: right; font-size: 1.3rem; font-weight: 700; color: #10b981;">{{ number_format($totalViews) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
                </div>
            </div>
            
            <!-- Kolom Kanan: Statistik Harian/Bulanan -->
            <div class="col-md-6">
                <div class="chart-section" style="height: 100%;">
                    <h3 class="section-title">2. Statistik Harian / Bulanan</h3>
                    <p style="color: #64748b; margin-bottom: 1rem; font-size: 0.9rem;">Grafik tren aktivitas harian (Line Chart untuk Like & Komentar, Bar Chart untuk Bookmark)</p>
                    <div class="chart-container" style="height: 350px;">
                        <canvas id="dailyActivityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Foto Paling Populer -->
        <div class="chart-section mb-4">
            <h3 class="section-title">3. Foto Paling Populer</h3>
            <p style="color: #64748b; margin-bottom: 1rem; font-size: 0.9rem;">Menampilkan 5 foto teratas dengan interaksi terbanyak (Like + Komentar + Bookmark)</p>
            @if($topPhotosByLikes->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-compact">
                    <thead>
                        <tr>
                            <th style="width: 60px;">Foto</th>
                            <th>Judul Foto</th>
                            <th style="text-align: center; width: 90px;">Like</th>
                            <th style="text-align: center; width: 90px;">Komentar</th>
                            <th style="text-align: center; width: 90px;">Bookmark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topPhotosByLikes->take(5) as $photo)
                        <tr>
                            <td>
                                @php
                                    $imagePath = '';
                                    if ($photo->file_path) {
                                        if (file_exists(public_path('storage/' . $photo->file_path))) {
                                            $imagePath = asset('storage/' . $photo->file_path);
                                        } elseif (file_exists(public_path($photo->file_path))) {
                                            $imagePath = asset($photo->file_path);
                                        }
                                    }
                                @endphp
                                @if($imagePath)
                                    <img src="{{ $imagePath }}" alt="{{ $photo->judul }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                                @else
                                    <div style="width: 50px; height: 50px; border-radius: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="font-weight: 600; color: #1e293b; font-size: 0.9rem;">{{ Str::limit($photo->judul, 50) }}</td>
                            <td style="text-align: center;">
                                <span class="badge" style="background: #fee2e2; color: #991b1b; font-size: 0.85rem; padding: 0.4rem 0.8rem;">
                                    <i class="fas fa-heart"></i> {{ number_format($photo->likes_count) }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <span class="badge" style="background: #dbeafe; color: #1e40af; font-size: 0.85rem; padding: 0.4rem 0.8rem;">
                                    <i class="fas fa-comment"></i> {{ number_format($photo->comments_count) }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <span class="badge" style="background: #ede9fe; color: #5b21b6; font-size: 0.85rem; padding: 0.4rem 0.8rem;">
                                    <i class="fas fa-bookmark"></i> {{ number_format($photo->bookmarks_count) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div style="text-align: center; padding: 3rem; color: #64748b;">
                <i class="fas fa-images" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                <p>Belum ada foto dengan interaksi. Foto akan muncul setelah ada aktivitas like, komentar, atau bookmark.</p>
            </div>
            @endif
        </div>

        <!-- 4. Aktivitas Komentar Terbaru -->
        <div class="chart-section mb-4">
            <h3 class="section-title">4. Aktivitas Komentar Terbaru</h3>
            <p style="color: #64748b; margin-bottom: 1rem; font-size: 0.9rem;">8 komentar terakhir untuk moderasi cepat. Admin bisa hapus komentar, balas, atau tandai sudah dibaca.</p>
            
            <div class="table-responsive">
                <table class="table table-hover table-compact">
                    <thead>
                        <tr>
                            <th>Nama Foto</th>
                            <th>Komentar</th>
                            <th style="width: 120px;">Tanggal</th>
                            <th style="text-align: center; width: 100px;">Status</th>
                            <th style="text-align: center; width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentComments as $comment)
                        <tr>
                            <td style="font-weight: 600; color: #1e293b;">{{ Str::limit($comment->foto_title ?? 'N/A', 40) }}</td>
                            <td style="color: #64748b;">{{ Str::limit($comment->content ?? '-', 80) }}</td>
                            <td style="color: #64748b; font-size: 0.85rem;">{{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i') }}</td>
                            <td style="text-align: center;">
                                <span class="badge" style="background: #dcfce7; color: #166534; font-size: 0.75rem;">
                                    <i class="fas fa-check-circle"></i> Aktif
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" style="background: #8B5CF6; color: white; padding: 0.25rem 0.5rem; font-size: 0.75rem; margin-right: 0.25rem;" onclick="markAsRead({{ $comment->id }})" title="Tandai Dibaca">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-sm" style="background: #06b6d4; color: white; padding: 0.25rem 0.5rem; font-size: 0.75rem; margin-right: 0.25rem;" onclick="replyComment({{ $comment->id }})" title="Balas">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;" onclick="deleteComment({{ $comment->id }})" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 2rem; color: #64748b;">
                                <i class="fas fa-comments" style="font-size: 2rem; opacity: 0.3; display: block; margin-bottom: 0.5rem;"></i>
                                Belum ada komentar dalam periode ini
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 5. Data Bookmark -->
        <div class="chart-section mb-4">
            <h3 class="section-title">5. Data Bookmark</h3>
            <p style="color: #64748b; margin-bottom: 1rem; font-size: 0.9rem;">Foto yang paling banyak disimpan oleh pengguna</p>
            <div class="table-responsive">
                <table class="table table-hover table-compact">
                    <thead>
                        <tr>
                            <th style="width: 60px;">Foto</th>
                            <th>Judul Foto</th>
                            <th style="text-align: center; width: 140px;">Jumlah Disimpan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topBookmarkedPhotos as $photo)
                        <tr>
                            <td>
                                @php
                                    $bookmarkImagePath = '';
                                    if ($photo->file_path) {
                                        if (file_exists(public_path('storage/' . $photo->file_path))) {
                                            $bookmarkImagePath = asset('storage/' . $photo->file_path);
                                        } elseif (file_exists(public_path($photo->file_path))) {
                                            $bookmarkImagePath = asset($photo->file_path);
                                        }
                                    }
                                @endphp
                                @if($bookmarkImagePath)
                                    <img src="{{ $bookmarkImagePath }}" alt="{{ $photo->judul }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div style="width: 50px; height: 50px; border-radius: 8px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="font-weight: 600; color: #1e293b;">{{ Str::limit($photo->judul, 60) }}</td>
                            <td style="text-align: center;">
                                <span class="badge" style="background: #ede9fe; color: #5b21b6; font-size: 1.1rem; padding: 0.6rem 1.2rem;">
                                    <i class="fas fa-bookmark"></i> {{ number_format($photo->bookmark_count) }} kali
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 2rem; color: #64748b;">
                                <i class="fas fa-bookmark" style="font-size: 2rem; opacity: 0.3; display: block; margin-bottom: 0.5rem;"></i>
                                Belum ada foto yang di-bookmark dalam periode ini
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 6. Laporan Interaktif -->
        <div class="chart-section mb-4">
            <h3 class="section-title">6. 🚩 Laporan Interaktif</h3>
            <p style="color: #64748b; margin-bottom: 1rem; font-size: 0.9rem;">
                <i class="fas fa-hand-pointer"></i> Klik pada kartu laporan untuk melihat detail lengkap
            </p>
            <div class="top-photos-grid">
                @forelse($reports as $index => $report)
                <div class="photo-card report-card" onclick="showReportDetail({{ $report->id }})" style="cursor: pointer; transition: transform 0.3s ease;">
                    @php
                        $reportImagePath = '';
                        if ($report->file_path) {
                            if (file_exists(public_path('storage/' . $report->file_path))) {
                                $reportImagePath = asset('storage/' . $report->file_path);
                            } elseif (file_exists(public_path($report->file_path))) {
                                $reportImagePath = asset($report->file_path);
                            }
                        }
                    @endphp
                    @if($reportImagePath)
                        <img src="{{ $reportImagePath }}" alt="{{ $report->foto_title ?? 'Laporan' }}" class="photo-img">
                    @else
                        <div style="width:100%;height:150px;background:linear-gradient(135deg,#ef4444,#dc2626);display:flex;align-items:center;justify-content:center;color:white;font-size:2rem;">
                            <i class="fas fa-flag"></i>
                        </div>
                    @endif
                    <div class="photo-info">
                        <div class="photo-title">
                            <strong>Laporan {{ $index + 1 }}</strong><br>
                            <small style="color: #64748b;">{{ $report->foto_title ?? 'Foto tidak tersedia' }}</small>
                        </div>
                        <div style="margin-top: 0.5rem; font-size: 0.85rem;">
                            <div style="color: #ef4444; font-weight: 600;">
                                <i class="fas fa-flag"></i> 
                                @php
                                    $reason = explode(':', $report->content)[0] ?? 'Lainnya';
                                @endphp
                                {{ ucfirst($reason) }}
                            </div>
                            <div style="color: #64748b; margin-top: 0.25rem;">
                                <i class="fas fa-user"></i> User #{{ $report->user_id ?? 'Guest' }}
                            </div>
                            <div style="color: #64748b; font-size: 0.75rem;">
                                <i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($report->created_at)->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div style="text-align: center; padding: 3rem; color: #64748b; grid-column: 1 / -1;">
                    <i class="fas fa-flag" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                    <p>Belum ada laporan dalam periode ini</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- 7. Laporan Pengguna Aktif -->
        @if($activeUsers->count() > 0)
        <div class="chart-section mb-4">
            <h3 class="section-title">7. Laporan Pengguna Aktif</h3>
            <p style="color: #64748b; margin-bottom: 1rem; font-size: 0.9rem;">5 pengguna teratas dengan total interaksi terbanyak (Like + Komentar + Bookmark)</p>
            <div class="table-responsive">
                <table class="table table-hover table-compact">
                    <thead>
                        <tr>
                            <th>Pengguna</th>
                            <th style="text-align: center; width: 90px;">Like</th>
                            <th style="text-align: center; width: 90px;">Komentar</th>
                            <th style="text-align: center; width: 90px;">Bookmark</th>
                            <th style="text-align: center; width: 110px;">Total Interaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeUsers as $user)
                        <tr>
                            <td style="font-weight: 600; color: #1e293b;">
                                <i class="fas fa-user-circle" style="color: #6366f1; margin-right: 0.5rem;"></i>
                                User #{{ $user->user_id }}
                            </td>
                            <td style="text-align: center;">
                                <span class="badge badge-like" style="font-size: 0.85rem;">{{ number_format($user->likes_given) }}</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="badge badge-comment" style="font-size: 0.85rem;">{{ number_format($user->comments_sent) }}</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="badge" style="background: #ede9fe; color: #5b21b6; font-size: 0.85rem;">{{ number_format($user->bookmarks_created) }}</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="badge" style="background: #f3f4f6; color: #1f2937; font-size: 0.95rem; font-weight: 700;">{{ number_format($user->total_activities) }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- 8. Aktivitas Terbaru -->
        <div class="table-section">
            <h3 class="section-title">8. Aktivitas Terbaru</h3>
            <p style="color: #64748b; margin-bottom: 1rem; font-size: 0.9rem;">8 aktivitas terakhir untuk audit dan keamanan</p>
            <div class="table-responsive">
                <table class="table table-hover table-compact">
                    <thead>
                        <tr>
                            <th style="width: 180px;">Waktu (Tanggal & Jam)</th>
                            <th style="width: 120px;">Tipe</th>
                            <th>Foto</th>
                            <th style="width: 150px;">User</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentActivities->take(8) as $activity)
                        <tr>
                            <td style="color: #64748b; font-size: 0.85rem;">
                                <div>{{ \Carbon\Carbon::parse($activity->created_at)->format('d/m/Y') }}</div>
                                <div style="color: #1e40af; font-weight: 600;">{{ \Carbon\Carbon::parse($activity->created_at)->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                @if($activity->activity_type == 'like')
                                    <span class="badge badge-like"><i class="fas fa-heart"></i> Like</span>
                                @elseif($activity->activity_type == 'comment')
                                    <span class="badge badge-comment"><i class="fas fa-comment"></i> Comment</span>
                                @elseif($activity->activity_type == 'bookmark')
                                    <span class="badge" style="background: #ede9fe; color: #5b21b6;"><i class="fas fa-bookmark"></i> Bookmark</span>
                                @elseif($activity->activity_type == 'report')
                                    <span class="badge badge-report"><i class="fas fa-flag"></i> Report</span>
                                @else
                                    <span class="badge badge-view"><i class="fas fa-eye"></i> View</span>
                                @endif
                            </td>
                            <td style="font-weight: 600; color: #1e293b;">{{ Str::limit($activity->foto_title ?? 'N/A', 40) }}</td>
                            <td style="color: #1e293b;">
                                @php
                                    $user = $activity->user_id ? \App\Models\User::find($activity->user_id) : null;
                                @endphp
                                @if($user)
                                    <div style="font-weight: 600;">{{ $user->name }}</div>
                                    <div style="font-size: 0.75rem; color: #64748b;">ID: {{ $user->id }}</div>
                                @else
                                    <span style="color: #64748b; font-style: italic;">Guest</span>
                                @endif
                            </td>
                            <td style="color: #64748b;">{{ Str::limit($activity->content ?? '-', 60) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center" style="color: #64748b;">Belum ada aktivitas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal Detail Laporan -->
    <div class="modal fade" id="reportDetailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 16px; border: none;">
                <div class="modal-header" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border-radius: 16px 16px 0 0;">
                    <h5 class="modal-title"><i class="fas fa-flag"></i> Detail Laporan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="reportDetailContent" style="padding: 2rem;">
                    <!-- Content will be loaded here -->
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e2e8f0; padding: 1.5rem; background: #f8fafc;">
                    <div class="w-100">
                        <div class="d-flex gap-2 mb-3 flex-wrap">
                            <button type="button" class="btn btn-success" onclick="markAsCompleted()">
                                <i class="fas fa-check-circle"></i> Tandai Selesai
                            </button>
                            <button type="button" class="btn btn-danger" onclick="deleteReport()">
                                <i class="fas fa-trash"></i> Hapus Laporan
                            </button>
                            <button type="button" class="btn btn-warning text-white" onclick="deleteContent()">
                                <i class="fas fa-ban"></i> Hapus Konten
                            </button>
                        </div>
                        <div class="d-flex gap-2 justify-content-between align-items-center flex-wrap">
                            <small class="text-muted" style="font-size: 0.75rem;">
                                <i class="fas fa-info-circle"></i> Gunakan Print/PDF untuk arsip atau bukti dokumentasi sekolah
                            </small>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i> Tutup
                                </button>
                                <button type="button" class="btn btn-primary" onclick="printReport()">
                                    <i class="fas fa-print"></i> Print
                                </button>
                                <button type="button" class="btn btn-info text-white" onclick="downloadReportPDF()">
                                    <i class="fas fa-download"></i> Download PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        // Filter select handler
        document.getElementById('filterSelect').addEventListener('change', function() {
            const customGroups = document.querySelectorAll('#customDateGroup, #customDateGroup2');
            if (this.value === 'custom') {
                customGroups.forEach(g => g.style.display = 'block');
            } else {
                customGroups.forEach(g => g.style.display = 'none');
            }
        });

        // Daily Activity Chart - Multi-line chart
        const dailyData = @json($dailyActivities);
        const dailyLabels = dailyData.map(item => {
            const date = new Date(item.date);
            return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
        });
        
        const likesData = dailyData.map(item => item.likes || 0);
        const commentsData = dailyData.map(item => item.comments || 0);
        const bookmarksData = dailyData.map(item => item.bookmarks || 0);
        const sharesData = dailyData.map(item => item.shares || 0);

        new Chart(document.getElementById('dailyActivityChart'), {
            type: 'line',
            data: {
                labels: dailyLabels,
                datasets: [
                    {
                        label: 'Likes',
                        data: likesData,
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.2)',
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        pointBackgroundColor: '#ef4444',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#ef4444',
                        pointHoverBorderWidth: 2
                    },
                    {
                        label: 'Komentar',
                        data: commentsData,
                        borderColor: '#06b6d4',
                        backgroundColor: 'rgba(6, 182, 212, 0.2)',
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        pointBackgroundColor: '#06b6d4',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#06b6d4',
                        pointHoverBorderWidth: 2
                    },
                    {
                        label: 'Bookmark',
                        data: bookmarksData,
                        borderColor: '#8b5cf6',
                        backgroundColor: 'rgba(139, 92, 246, 0.2)',
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        pointBackgroundColor: '#8b5cf6',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#8b5cf6',
                        pointHoverBorderWidth: 2
                    },
                    {
                        label: 'Share',
                        data: sharesData,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.2)',
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#10b981',
                        pointHoverBorderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' aktivitas';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });

        // 7. Export Functions - Langsung export PDF
        function showExportModal() {
            // Langsung export ke PDF tanpa modal pilihan
            exportPDF();
        }

        function exportPDF() {
            Swal.close();
            
            // Show quick toast
            const toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });
            
            toast.fire({
                icon: 'info',
                title: 'Membuat PDF Lengkap dengan Chart...'
            });
            
            // Generate PDF with complete data including chart
            setTimeout(() => {
                // Capture chart as image
                const chartCanvas = document.getElementById('dailyActivityChart');
                const chartImage = chartCanvas.toDataURL('image/png', 1.0);
                
                // Create complete content for PDF
                let pdfContent = document.createElement('div');
                pdfContent.style.padding = '20px';
                pdfContent.style.fontFamily = 'Arial, sans-serif';
                pdfContent.innerHTML = `
                    <h1 style="text-align: center; margin-bottom: 5px; font-size: 18px; color: #1e40af;">LAPORAN AKTIVITAS GALERI</h1>
                    <h2 style="text-align: center; margin-bottom: 3px; font-size: 16px; color: #1e40af;">SMKN 4 BOGOR</h2>
                    <p style="text-align: center; margin-bottom: 15px; font-size: 10px; color: #64748b;">Periode: {{ $filter }} | Tanggal Export: ${new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
                    <hr style="border: 1px solid #e5e7eb; margin-bottom: 15px;">
                    
                    <h3 style="font-size: 14px; margin-bottom: 8px; color: #1e40af; border-bottom: 2px solid #1e40af; padding-bottom: 3px;">📊 STATISTIK UMUM GALERI</h3>
                    <table border="1" cellpadding="8" style="width: 100%; border-collapse: collapse; margin-bottom: 15px; font-size: 10px;">
                        <tr style="background: #dbeafe; font-weight: bold;"><th style="text-align: left;">Keterangan</th><th style="text-align: center; width: 100px;">Jumlah</th></tr>
                        <tr><td>Total Foto di Galeri</td><td style="text-align: center; font-weight: bold;">{{ $totalPhotos }}</td></tr>
                        <tr><td>Total Like</td><td style="text-align: center; font-weight: bold;">{{ $totalLikes }}</td></tr>
                        <tr><td>Total Komentar</td><td style="text-align: center; font-weight: bold;">{{ $totalComments }}</td></tr>
                        <tr><td>Total Bookmark</td><td style="text-align: center; font-weight: bold;">{{ $totalBookmarks }}</td></tr>
                        <tr><td>Total Share</td><td style="text-align: center; font-weight: bold;">{{ $totalShares }}</td></tr>
                        <tr style="background: #f0f9ff; font-weight: bold;"><td>TOTAL INTERAKSI</td><td style="text-align: center;">{{ $totalLikes + $totalComments + $totalBookmarks + $totalShares }}</td></tr>
                    </table>
                    
                    <h3 style="font-size: 14px; margin-bottom: 8px; margin-top: 15px; color: #1e40af; border-bottom: 2px solid #1e40af; padding-bottom: 3px;">📈 GRAFIK STATISTIK HARIAN / BULANAN</h3>
                    <div style="text-align: center; margin-bottom: 15px;">
                        <img src="${chartImage}" style="width: 100%; max-width: 700px; height: auto; border: 1px solid #e5e7eb; border-radius: 8px;" />
                        <p style="font-size: 9px; color: #64748b; margin-top: 5px; font-style: italic;">Grafik tren aktivitas harian (Likes, Komentar, Bookmark, Share)</p>
                    </div>
                    
                    @if($topPhotosByLikes->count() > 0)
                    <h3 style="font-size: 14px; margin-bottom: 8px; margin-top: 15px; color: #1e40af; border-bottom: 2px solid #1e40af; padding-bottom: 3px;">🏆 FOTO PALING POPULER (TOP 10)</h3>
                    <table border="1" cellpadding="6" style="width: 100%; border-collapse: collapse; margin-bottom: 15px; font-size: 9px;">
                        <tr style="background: #dbeafe; font-weight: bold;">
                            <th style="width: 30px; text-align: center;">No</th>
                            <th style="text-align: left;">Judul Foto</th>
                            <th style="width: 50px; text-align: center;">Like</th>
                            <th style="width: 60px; text-align: center;">Komentar</th>
                            <th style="width: 70px; text-align: center;">Bookmark</th>
                            <th style="width: 50px; text-align: center;">Total</th>
                        </tr>
                        @foreach($topPhotosByLikes->take(10) as $index => $photo)
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td>{{ $photo->judul }}</td>
                            <td style="text-align: center;">{{ $photo->likes_count }}</td>
                            <td style="text-align: center;">{{ $photo->comments_count }}</td>
                            <td style="text-align: center;">{{ $photo->bookmarks_count }}</td>
                            <td style="text-align: center; font-weight: bold;">{{ $photo->likes_count + $photo->comments_count + $photo->bookmarks_count }}</td>
                        </tr>
                        @endforeach
                    </table>
                    @endif
                    
                    @if($topPhotosByComments->count() > 0)
                    <h3 style="font-size: 14px; margin-bottom: 8px; margin-top: 15px; color: #1e40af; border-bottom: 2px solid #1e40af; padding-bottom: 3px;">💬 FOTO PALING BANYAK DIKOMENTARI (TOP 5)</h3>
                    <table border="1" cellpadding="6" style="width: 100%; border-collapse: collapse; margin-bottom: 15px; font-size: 9px;">
                        <tr style="background: #dbeafe; font-weight: bold;">
                            <th style="width: 30px; text-align: center;">No</th>
                            <th style="text-align: left;">Judul Foto</th>
                            <th style="width: 80px; text-align: center;">Komentar</th>
                        </tr>
                        @foreach($topPhotosByComments->take(5) as $index => $photo)
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td>{{ $photo->judul }}</td>
                            <td style="text-align: center; font-weight: bold;">{{ $photo->comments_count }}</td>
                        </tr>
                        @endforeach
                    </table>
                    @endif
                    
                    <div style="margin-top: 20px; padding: 10px; background: #f0f9ff; border-left: 4px solid #1e40af; font-size: 9px;">
                        <p style="margin: 0; font-weight: bold; color: #1e40af;">📌 Catatan:</p>
                        <p style="margin: 5px 0 0 0; color: #64748b;">Laporan ini berisi data lengkap aktivitas galeri untuk periode {{ $filter }}. Data diambil dari sistem pada ${new Date().toLocaleString('id-ID')}.</p>
                    </div>
                    
                    <div style="margin-top: 15px; text-align: center; font-size: 8px; color: #94a3b8; border-top: 1px solid #e5e7eb; padding-top: 10px;">
                        <p style="margin: 0;">Dokumen ini dibuat secara otomatis oleh Sistem Galeri Digital SMKN 4 Bogor</p>
                        <p style="margin: 3px 0 0 0;">© 2025 SMKN 4 Bogor - Semua Hak Dilindungi</p>
                    </div>
                `;
                
                const opt = {
                    margin: [10, 10, 10, 10],
                    filename: 'Laporan_Galeri_SMKN4_' + new Date().getTime() + '.pdf',
                    image: { type: 'jpeg', quality: 0.95 },
                    html2canvas: { scale: 2, logging: false, useCORS: true },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };
                
                html2pdf().set(opt).from(pdfContent).save().then(() => {
                    toast.fire({
                        icon: 'success',
                        title: 'PDF Lengkap Berhasil Diunduh!'
                    });
                });
            }, 300);
        }

        function exportExcel() {
            Swal.close();
            
            const toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });
            
            toast.fire({
                icon: 'info',
                title: 'Membuat Excel...'
            });
            
            setTimeout(() => {
                // Create Excel-compatible HTML table with COMPLETE DATA
                let excelContent = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
                excelContent += '<head><meta charset="utf-8"><title>Laporan Galeri Lengkap</title></head><body>';
                excelContent += '<h1>LAPORAN AKTIVITAS GALERI - SMKN 4 BOGOR (DATA LENGKAP)</h1>';
                excelContent += '<p><strong>Periode:</strong> {{ $filter }}</p>';
                excelContent += '<p><strong>Tanggal Export:</strong> ' + new Date().toLocaleString('id-ID') + '</p>';
                excelContent += '<p><strong>Tujuan:</strong> Analisis / Backup</p><br>';
                
                // 1. Statistik Umum
                excelContent += '<h2>1. STATISTIK UMUM GALERI</h2>';
                excelContent += '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';
                excelContent += '<tr style="background: #e0f2fe;"><th>Keterangan</th><th>Jumlah</th></tr>';
                excelContent += '<tr><td>Total Foto</td><td>{{ $totalPhotos }}</td></tr>';
                excelContent += '<tr><td>Total Like</td><td>{{ $totalLikes }}</td></tr>';
                excelContent += '<tr><td>Total Komentar</td><td>{{ $totalComments }}</td></tr>';
                excelContent += '<tr><td>Total Bookmark</td><td>{{ $totalBookmarks }}</td></tr>';
                excelContent += '<tr><td>Total Share</td><td>{{ $totalShares }}</td></tr>';
                excelContent += '</table><br><br>';
                
                // 2. Foto Paling Populer
                @if($topPhotosByLikes->count() > 0)
                excelContent += '<h2>2. FOTO PALING POPULER (TOP 5)</h2>';
                excelContent += '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';
                excelContent += '<tr style="background: #e0f2fe;"><th>No</th><th>ID Foto</th><th>Judul Foto</th><th>File Path</th><th>Like</th><th>Komentar</th><th>Bookmark</th><th>Total Interaksi</th></tr>';
                @foreach($topPhotosByLikes->take(5) as $index => $photo)
                excelContent += '<tr>';
                excelContent += '<td>{{ $index + 1 }}</td>';
                excelContent += '<td>{{ $photo->id }}</td>';
                excelContent += '<td>{{ addslashes($photo->judul) }}</td>';
                excelContent += '<td>{{ addslashes($photo->file_path) }}</td>';
                excelContent += '<td>{{ $photo->likes_count }}</td>';
                excelContent += '<td>{{ $photo->comments_count }}</td>';
                excelContent += '<td>{{ $photo->bookmarks_count }}</td>';
                excelContent += '<td>{{ $photo->likes_count + $photo->comments_count + $photo->bookmarks_count }}</td>';
                excelContent += '</tr>';
                @endforeach
                excelContent += '</table><br><br>';
                @endif
                
                // 3. Aktivitas Komentar
                @if($recentComments->count() > 0)
                excelContent += '<h2>3. AKTIVITAS KOMENTAR TERBARU (8 DATA)</h2>';
                excelContent += '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';
                excelContent += '<tr style="background: #e0f2fe;"><th>No</th><th>ID Aktivitas</th><th>Nama Foto</th><th>Komentar</th><th>User ID</th><th>IP Address</th><th>Tanggal</th><th>Status</th></tr>';
                @foreach($recentComments as $index => $comment)
                excelContent += '<tr>';
                excelContent += '<td>{{ $index + 1 }}</td>';
                excelContent += '<td>{{ $comment->id }}</td>';
                excelContent += '<td>{{ addslashes($comment->foto_title ?? "N/A") }}</td>';
                excelContent += '<td>{{ addslashes($comment->content ?? "-") }}</td>';
                excelContent += '<td>{{ $comment->user_id ?? "Guest" }}</td>';
                excelContent += '<td>{{ $comment->ip_address ?? "-" }}</td>';
                excelContent += '<td>{{ \Carbon\Carbon::parse($comment->created_at)->format("d/m/Y H:i:s") }}</td>';
                excelContent += '<td>Aktif</td>';
                excelContent += '</tr>';
                @endforeach
                excelContent += '</table><br><br>';
                @endif
                
                // 4. Data Bookmark
                @if($topBookmarkedPhotos->count() > 0)
                excelContent += '<h2>4. DATA BOOKMARK (TOP 10)</h2>';
                excelContent += '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';
                excelContent += '<tr style="background: #e0f2fe;"><th>No</th><th>ID Foto</th><th>Judul Foto</th><th>File Path</th><th>Jumlah Bookmark</th></tr>';
                @foreach($topBookmarkedPhotos as $index => $photo)
                excelContent += '<tr>';
                excelContent += '<td>{{ $index + 1 }}</td>';
                excelContent += '<td>{{ $photo->id }}</td>';
                excelContent += '<td>{{ addslashes($photo->judul) }}</td>';
                excelContent += '<td>{{ addslashes($photo->file_path) }}</td>';
                excelContent += '<td>{{ $photo->bookmark_count }}</td>';
                excelContent += '</tr>';
                @endforeach
                excelContent += '</table><br><br>';
                @endif
                
                // 5. Pengguna Aktif
                @if($activeUsers->count() > 0)
                excelContent += '<h2>5. LAPORAN PENGGUNA AKTIF (TOP 5)</h2>';
                excelContent += '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';
                excelContent += '<tr style="background: #e0f2fe;"><th>No</th><th>User ID</th><th>Like Diberikan</th><th>Komentar Dikirim</th><th>Bookmark Dibuat</th><th>Total Interaksi</th></tr>';
                @foreach($activeUsers as $index => $user)
                excelContent += '<tr>';
                excelContent += '<td>{{ $index + 1 }}</td>';
                excelContent += '<td>User #{{ $user->user_id }}</td>';
                excelContent += '<td>{{ $user->likes_given }}</td>';
                excelContent += '<td>{{ $user->comments_sent }}</td>';
                excelContent += '<td>{{ $user->bookmarks_created }}</td>';
                excelContent += '<td>{{ $user->total_activities }}</td>';
                excelContent += '</tr>';
                @endforeach
                excelContent += '</table><br><br>';
                @endif
                
                // 6. Aktivitas Terbaru
                @if($recentActivities->count() > 0)
                excelContent += '<h2>6. AKTIVITAS TERBARU (8 DATA)</h2>';
                excelContent += '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';
                excelContent += '<tr style="background: #e0f2fe;"><th>No</th><th>ID Aktivitas</th><th>Tipe</th><th>Foto</th><th>User ID</th><th>IP Address</th><th>Detail</th><th>Tanggal</th></tr>';
                @foreach($recentActivities->take(8) as $index => $activity)
                excelContent += '<tr>';
                excelContent += '<td>{{ $index + 1 }}</td>';
                excelContent += '<td>{{ $activity->id }}</td>';
                excelContent += '<td>{{ ucfirst($activity->activity_type) }}</td>';
                excelContent += '<td>{{ addslashes($activity->foto_title ?? "N/A") }}</td>';
                excelContent += '<td>{{ $activity->user_id ?? "Guest" }}</td>';
                excelContent += '<td>{{ $activity->ip_address ?? "-" }}</td>';
                excelContent += '<td>{{ addslashes($activity->content ?? "-") }}</td>';
                excelContent += '<td>{{ \Carbon\Carbon::parse($activity->created_at)->format("d/m/Y H:i:s") }}</td>';
                excelContent += '</tr>';
                @endforeach
                excelContent += '</table>';
                @endif
                
                excelContent += '<br><br><p style="font-size: 11px; color: #64748b;"><strong>Catatan:</strong> File ini berisi semua data lengkap untuk keperluan analisis dan backup. Termasuk: statistik, foto, komentar, bookmark, aktivitas, tanggal, user ID, dan IP address.</p>';
                excelContent += '</body></html>';
                
                // Create blob and download
                const blob = new Blob([excelContent], { type: 'application/vnd.ms-excel' });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'Laporan_Galeri_Lengkap_' + new Date().getTime() + '.xls';
                link.click();
                
                toast.fire({
                    icon: 'success',
                    title: 'Excel berhasil diunduh!'
                });
            }, 500);
        }

        function exportCSV() {
            Swal.close();
            
            // Create CSV content with full data
            let csv = 'Laporan Aktivitas Galeri - SMKN 4 BOGOR\n\n';
            csv += 'Periode: {{ $filter }}\n';
            csv += 'Tanggal: {{ now()->format("d/m/Y H:i") }}\n\n';
            
            csv += '1. STATISTIK UMUM GALERI\n';
            csv += 'Keterangan,Jumlah\n';
            csv += 'Total Foto,{{ $totalPhotos }}\n';
            csv += 'Total Like,{{ $totalLikes }}\n';
            csv += 'Total Komentar,{{ $totalComments }}\n';
            csv += 'Total Bookmark,{{ $totalBookmarks }}\n';
            csv += 'Total Share,{{ $totalShares }}\n\n';
            
            @if($topPhotosByLikes->count() > 0)
            csv += '3. FOTO PALING POPULER\n';
            csv += 'Judul Foto,Like,Komentar,Bookmark\n';
            @foreach($topPhotosByLikes as $photo)
            csv += '"{{ str_replace('"', '""', $photo->judul) }}",{{ $photo->likes_count }},{{ $photo->comments_count }},{{ $photo->bookmarks_count }}\n';
            @endforeach
            csv += '\n';
            @endif
            
            @if($recentComments->count() > 0)
            csv += '4. AKTIVITAS KOMENTAR TERBARU\n';
            csv += 'Nama Foto,Komentar,Tanggal\n';
            @foreach($recentComments as $comment)
            csv += '"{{ str_replace('"', '""', $comment->foto_title ?? "N/A") }}","{{ str_replace('"', '""', $comment->content ?? "-") }}","{{ \Carbon\Carbon::parse($comment->created_at)->format("d/m/Y H:i") }}"\n';
            @endforeach
            csv += '\n';
            @endif
            
            @if($activeUsers->count() > 0)
            csv += '6. LAPORAN PENGGUNA AKTIF\n';
            csv += 'User ID,Like,Komentar,Bookmark,Total Interaksi\n';
            @foreach($activeUsers as $user)
            csv += 'User #{{ $user->user_id }},{{ $user->likes_given }},{{ $user->comments_sent }},{{ $user->bookmarks_created }},{{ $user->total_activities }}\n';
            @endforeach
            @endif
            
            // Create download link
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', 'laporan_galeri_' + new Date().getTime() + '.csv');
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            const toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });
            
            toast.fire({
                icon: 'success',
                title: 'CSV berhasil diunduh!'
            });
        }

        function printReportPage() {
            Swal.close();
            window.print();
        }

        // Mark comment as read
        function markAsRead(commentId) {
            Swal.fire({
                title: 'Tandai Dibaca?',
                text: 'Komentar ini akan ditandai sebagai sudah dibaca',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Tandai',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // In real implementation, send AJAX request to mark as read
                    // For now, just show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Komentar telah ditandai sebagai dibaca',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    // Optional: Remove or fade out the row
                    // document.querySelector(`tr[data-comment-id="${commentId}"]`).style.opacity = '0.5';
                }
            });
        }

        // Delete comment
        function deleteComment(commentId) {
            Swal.fire({
                title: 'Hapus Komentar?',
                text: 'Komentar ini akan dihapus permanen. Tindakan ini tidak dapat dibatalkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete comment
                    fetch(`/api/comments/${commentId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Dihapus!',
                                text: 'Komentar telah dihapus dari sistem',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                // Reload page to refresh data
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Menghapus!',
                                text: data.message || 'Terjadi kesalahan saat menghapus komentar',
                                confirmButtonColor: '#ef4444'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menghapus!',
                            text: 'Terjadi kesalahan saat menghapus komentar',
                            confirmButtonColor: '#ef4444'
                        });
                    });
                }
            });
        }

        // Reply comment
        function replyComment(commentId) {
            Swal.fire({
                title: 'Balas Komentar',
                html: `
                    <textarea id="replyText" class="swal2-textarea" placeholder="Tulis balasan Anda..." style="width: 100%; min-height: 100px;"></textarea>
                `,
                showCancelButton: true,
                confirmButtonColor: '#8B5CF6',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="fas fa-paper-plane"></i> Kirim Balasan',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    const reply = document.getElementById('replyText').value;
                    if (!reply) {
                        Swal.showValidationMessage('Balasan tidak boleh kosong');
                        return false;
                    }
                    return reply;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // In real implementation, send AJAX request to save reply
                    Swal.fire({
                        icon: 'success',
                        title: 'Balasan Terkirim!',
                        text: 'Balasan Anda telah dikirim ke pengguna',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }

        // Reset filter
        function resetFilter() {
            window.location.href = '{{ route("admin.reports") }}';
        }

        // Apply comment filter
        function applyCommentFilter() {
            const foto = document.getElementById('filterFoto').value;
            const status = document.getElementById('filterStatus').value;
            const tanggal = document.getElementById('filterTanggal').value;
            
            // In real implementation, this would filter the table
            // For now, just show a message
            Swal.fire({
                icon: 'info',
                title: 'Filter Diterapkan',
                html: `
                    <p>Filter yang dipilih:</p>
                    <ul style="text-align: left;">
                        ${foto ? '<li>Foto: ' + document.getElementById('filterFoto').options[document.getElementById('filterFoto').selectedIndex].text + '</li>' : ''}
                        ${status ? '<li>Status: ' + status + '</li>' : ''}
                        ${tanggal ? '<li>Tanggal: ' + tanggal + '</li>' : ''}
                    </ul>
                `,
                timer: 3000,
                showConfirmButton: false
            });
        }

        // Reports data for modal
        const reportsData = @json($reports);
        let currentReportId = null;

        // Show Report Detail Modal
        function showReportDetail(reportId) {
            const report = reportsData.find(r => r.id == reportId);
            if (!report) {
                alert('Laporan tidak ditemukan');
                return;
            }

            currentReportId = reportId;
            
            // Parse content
            const contentParts = report.content ? report.content.split(':') : ['Lainnya', ''];
            const reason = contentParts[0] || 'Lainnya';
            const details = contentParts.slice(1).join(':').trim() || 'Tidak ada detail tambahan';
            
            // Format date
            const date = new Date(report.created_at);
            const formattedDate = date.toLocaleDateString('id-ID', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });

            // Reason emoji and label
            const reasonMap = {
                'inappropriate': { emoji: '🔞', label: 'Konten Tidak Pantas' },
                'spam': { emoji: '📧', label: 'Spam atau Iklan' },
                'harassment': { emoji: '😡', label: 'Pelecehan atau Bullying' },
                'violence': { emoji: '⚠️', label: 'Kekerasan' },
                'copyright': { emoji: '©️', label: 'Pelanggaran Hak Cipta' },
                'misinformation': { emoji: '❌', label: 'Informasi Menyesatkan' },
                'other': { emoji: '📝', label: 'Lainnya' }
            };
            
            const reasonInfo = reasonMap[reason.toLowerCase()] || reasonMap['other'];

            // Build modal content
            const storageUrl = '{{ asset("storage") }}';
            const content = `
                <div class="row">
                    <div class="col-md-5">
                        <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                            <img src="${report.file_path ? storageUrl + '/' + report.file_path : 'https://via.placeholder.com/400x300?text=No+Image'}" 
                                 alt="Foto" 
                                 style="width: 100%; height: auto; display: block;"
                                 onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h4 style="color: #1e293b; font-weight: 700; margin-bottom: 1rem;">
                            ${report.foto_title || 'Foto Tidak Tersedia'}
                        </h4>
                        
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                            <div style="display: grid; grid-template-columns: 140px 1fr; gap: 0.75rem; font-size: 0.95rem;">
                                <div style="color: #64748b; font-weight: 600;">ID Laporan:</div>
                                <div style="color: #1e293b;">#${report.id}</div>
                                
                                <div style="color: #64748b; font-weight: 600;">Dilaporkan oleh:</div>
                                <div style="color: #1e293b;">User #${report.user_id || 'Guest'}</div>
                                
                                <div style="color: #64748b; font-weight: 600;">Tanggal:</div>
                                <div style="color: #1e293b;">${formattedDate}</div>
                                
                                <div style="color: #64748b; font-weight: 600;">IP Address:</div>
                                <div style="color: #1e293b; font-family: monospace;">${report.ip_address || '-'}</div>
                            </div>
                        </div>
                        
                        <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                            <div style="font-weight: 700; color: #991b1b; margin-bottom: 0.5rem; font-size: 1.1rem;">
                                ${reasonInfo.emoji} ${reasonInfo.label}
                            </div>
                            <div style="color: #7f1d1d; font-size: 0.95rem;">
                                <strong>Detail:</strong><br>
                                ${details}
                            </div>
                        </div>
                        
                        ${report.deskripsi ? `
                        <div style="background: #f1f5f9; padding: 1rem; border-radius: 8px;">
                            <div style="font-weight: 600; color: #475569; margin-bottom: 0.5rem;">
                                <i class="fas fa-info-circle"></i> Deskripsi Foto:
                            </div>
                            <div style="color: #64748b; font-size: 0.9rem;">
                                ${report.deskripsi}
                            </div>
                        </div>
                        ` : ''}
                    </div>
                </div>
            `;

            document.getElementById('reportDetailContent').innerHTML = content;
            const modal = new bootstrap.Modal(document.getElementById('reportDetailModal'));
            modal.show();
        }

        // Print Report
        function printReport() {
            const printContent = document.getElementById('reportDetailContent').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.write('<!DOCTYPE html><html><head><title>Cetak Laporan</title>');
            printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">');
            printWindow.document.write('<style>body { font-family: Arial, sans-serif; padding: 2rem; } @media print { .no-print { display: none; } }</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write('<div style="text-align: center; margin-bottom: 2rem;"><h2>LAPORAN FOTO</h2><p>SMKN 4 BOGOR - Sistem Galeri</p><hr></div>');
            printWindow.document.write(printContent);
            printWindow.document.write('<div style="margin-top: 3rem; text-align: center; color: #64748b; font-size: 0.85rem;"><p>Dicetak pada: ' + new Date().toLocaleString('id-ID') + '</p></div>');
            printWindow.document.write('<script>window.onload = function() { window.print(); setTimeout(function() { window.close(); }, 100); }<\/script>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
        }

        // Download Report as PDF - Using Print Method
        function downloadReportPDF() {
            // Just call printReport which already works
            printReport();
            
            // Show info about saving as PDF
            setTimeout(function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Simpan sebagai PDF',
                    html: 'Untuk menyimpan sebagai PDF:<br><br>1. Di dialog print, pilih <strong>"Save as PDF"</strong> atau <strong>"Microsoft Print to PDF"</strong><br>2. Klik tombol <strong>Print/Save</strong>',
                    confirmButtonText: 'Mengerti',
                    confirmButtonColor: '#1E40AF'
                });
            }, 1000);
        }

        // Mark Report as Completed
        function markAsCompleted() {
            Swal.fire({
                title: 'Tandai Selesai?',
                text: 'Laporan akan ditandai sebagai "Selesai Ditinjau"',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="fas fa-check"></i> Ya, Tandai Selesai',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to mark as completed
                    fetch(`/admin/reports/${currentReportId}/complete`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '✅ Laporan Ditandai Selesai',
                                text: 'Laporan telah ditandai sebagai selesai ditinjau',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.message || 'Gagal menandai laporan', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                    });
                }
            });
        }

        // Delete Report
        function deleteReport() {
            Swal.fire({
                title: 'Hapus Laporan?',
                text: 'Laporan akan dihapus permanen dari database',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete report
                    fetch(`/admin/reports/${currentReportId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '✅ Laporan Telah Dihapus',
                                text: 'Laporan berhasil dihapus dari database',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.message || 'Gagal menghapus laporan', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                    });
                }
            });
        }

        // Delete Content (Photo/Comment)
        function deleteContent() {
            const report = reportsData.find(r => r.id == currentReportId);
            
            Swal.fire({
                title: 'Hapus Konten?',
                html: `<p>Konten yang dilaporkan akan dihapus dari galeri:</p>
                       <p><strong>${report.foto_title || 'Konten'}</strong></p>
                       <p class="text-danger"><small>⚠️ Tindakan ini tidak dapat dibatalkan!</small></p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f59e0b',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="fas fa-ban"></i> Ya, Hapus Konten',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete content
                    fetch(`/admin/reports/${currentReportId}/delete-content`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '🚫 Konten Berhasil Dihapus',
                                text: 'Konten yang dilaporkan telah dihapus dari galeri',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.message || 'Gagal menghapus konten', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                    });
                }
            });
        }

        // Hover effect for report cards
        document.addEventListener('DOMContentLoaded', function() {
            const reportCards = document.querySelectorAll('.report-card');
            reportCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px)';
                    this.style.boxShadow = '0 12px 24px rgba(0,0,0,0.15)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 4px 12px rgba(0,0,0,.08)';
                });
            });
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
