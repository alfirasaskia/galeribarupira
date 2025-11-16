<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Admin Dashboard</title>
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

        /* Sidebar Styles */
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
            box-shadow: 4px 0 20px rgba(59, 130, 246, 0.1);
            border-right: 1px solid rgba(59, 130, 246, 0.2);
        }

        .sidebar-header {
            background: rgba(30, 64, 175, 0.2);
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(30, 64, 175, 0.3);
            min-height: 80px;
            display: flex;
            align-items: center;
            gap: 1rem;
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
            word-wrap: break-word;
        }

        .sidebar-nav {
            padding: 1.5rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link.side {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            color: #6b7280;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            position: relative;
            margin: 0.25rem 1rem;
        }

        .nav-link.side:hover {
            background: rgba(30, 64, 175, 0.15);
            color: #1e40af;
        }

        .nav-link.side.active {
            background: rgba(30, 64, 175, 0.25);
            color: #1e40af;
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.3);
        }

        .nav-link.side i {
            margin-right: 1rem;
            width: 20px;
            font-size: 1rem;
        }

        .nav-divider {
            height: 1px;
            background: rgba(30, 64, 175, 0.3);
            margin: 1rem 1.5rem;
            border-radius: 1px;
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

        /* Welcome Banner */
        .welcome-banner {
            background: var(--gradient-primary);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
        }

        .welcome-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-text h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .welcome-text p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .welcome-illustration {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }


        /* Table Container */
        .table-container {
            background: var(--white);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
        }

        /* Header di atas tabel (Daftar Kategori + tombol) */
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

        .category-icon {
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

        .table tbody tr:hover .category-icon {
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

        /* Tombol CRUD transparan dengan aksen warna */
        .action-btn.edit {
            background: transparent;
            color: var(--primary-color);
            border: 1px solid rgba(99, 102, 241, 0.35);
        }

        .action-btn.delete {
            background: transparent;
            color: var(--danger-color);
            border: 1px solid rgba(239, 68, 68, 0.35);
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background: rgba(0,0,0,0.03);
        }

        .action-btn i {
            font-size: 0.9rem;
        }

        /* New Category Button */
        .new-category-btn {
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
        }

        .new-category-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

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
            
            .welcome-content {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }


            .table-responsive {
                font-size: 0.9rem;
            }

            .user-info {
                flex-direction: column;
                gap: 0.5rem;
            }

            .new-category-btn {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .welcome-banner {
                padding: 1.5rem;
            }

            .welcome-text h2 {
                font-size: 1.5rem;
            }

            .category-card {
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
            <div class="sidebar-logo">
                <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah" style="width:100%;height:100%;object-fit:contain;background:transparent;">
            </div>
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
                <a href="{{ route('admin.categories.index') }}" class="nav-link side active">
                    <i class="fas fa-folder-open"></i>Kelola Kategori
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.agenda') }}" class="nav-link side">
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
                <h1 class="page-title">Kategori</h1>
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
                                    admin
                                @endif
                            </div>
                            <div class="user-role">Admin</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="table-container">
            <div class="table-header d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0" style="font-weight: 700; color: var(--dark-color);">Daftar Kategori</h5>
                <button class="new-category-btn" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="fas fa-plus"></i>
                    Tambah Kategori
                </button>
            </div>
            @if(isset($categories) && $categories->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Jumlah Foto</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary">{{ $category->id }}</span>
                                    </td>
                                    
                                    <td>
                                        <strong>{{ $category->nama }}</strong>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $category->deskripsi ?? 'Tidak ada deskripsi' }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $category->fotos_count ?? 0 }} foto</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $category->created_at ? \Carbon\Carbon::parse($category->created_at)->format('d M Y H:i') : 'N/A' }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn edit" title="Edit Kategori" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-id="{{ $category->id }}" data-nama="{{ $category->nama }}" data-deskripsi="{{ $category->deskripsi }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn delete" title="Hapus Kategori">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($categories->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $categories->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="fas fa-folder-open"></i>
                    <h4>Belum ada kategori</h4>
                    <p>Mulai dengan membuat kategori pertama Anda</p>
                    <button type="button" class="new-category-btn" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="fas fa-plus"></i>
                        Tambah Kategori Pertama
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: white; color: #333; border-bottom: 1px solid #e5e7eb;">
                    <h5 class="modal-title" id="addCategoryModalLabel">
                        <i class="fas fa-plus me-2"></i>Tambah Kategori Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST" id="addCategoryForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Kategori</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama kategori" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi kategori (opsional)"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" form="addCategoryForm" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Kategori
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: white; color: #333; border-bottom: 1px solid #e5e7eb;">
                    <h5 class="modal-title" id="editCategoryModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Kategori
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="editCategoryForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Kategori</label>
                            <input type="text" name="nama" id="editNama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" id="editDeskripsi" class="form-control" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" form="editCategoryForm" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = document.getElementById('editCategoryModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var nama = button.getAttribute('data-nama');
                var deskripsi = button.getAttribute('data-deskripsi') || '';

                document.getElementById('editNama').value = nama;
                document.getElementById('editDeskripsi').value = deskripsi;
                document.getElementById('editCategoryForm').action = "{{ url('admin/categories') }}/" + id;
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
        });
    </script>
</body>
</html>














