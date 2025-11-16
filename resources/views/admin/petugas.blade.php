<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Admin - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1E40AF;
            --primary-dark: #1e3a8a;
            --secondary-color: #3b82f6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #06b6d4;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --sidebar-width: 280px;
            --accent-blue: #1E40AF;
            --accent-teal: #06b6d4;
            --accent-pink: #ec4899;
            --accent-green: #10b981;
            --accent-orange: #f59e0b;
            --primary-blue: #1E40AF;
            --secondary-blue: #1e3a8a;
            --white: #ffffff;
            --light-gray: #64748b;
            --border-color: #e2e8f0;
            --gradient-primary: linear-gradient(135deg, #1E40AF 0%, #1e3a8a 100%);
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

        .nav-divider { height: 1px; background: rgba(30, 64, 175, 0.3); margin: 1rem 1.5rem; border-radius: 1px; }

        .nav-link.side i { margin-right: 0.875rem; width: 18px; font-size: 1rem; text-align: center; }

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

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
        }

        /* Table Container */
        .table-container {
            background: var(--white);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
        }

        /* Header di atas tabel (Daftar Petugas + tombol) */
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

        .staff-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .email-field {
            font-family: monospace;
            background: var(--light-color);
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.85rem;
            color: var(--primary-blue);
            font-weight: 500;
        }

        .password-field {
            font-family: monospace;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 0.25rem 0.5rem;
            font-size: 0.85rem;
            color: var(--light-gray);
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

        .action-btn.edit {
            background: transparent;
            color: var(--warning-color);
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .action-btn.delete {
            background: transparent;
            color: var(--danger-color);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .action-btn i {
            font-size: 0.9rem;
        }

        /* New Staff Button */
        .new-staff-btn {
            background: var(--gradient-primary);
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
        }

        .new-staff-btn:hover {
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
            color: var(--primary-blue);
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

        /* Action Section Layout */
        .action-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .action-section .section-title {
            margin-bottom: 0;
            color: var(--dark-color);
            font-weight: 700;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            

            .table-responsive {
                font-size: 0.9rem;
            }

            .user-info {
                flex-direction: column;
                gap: 0.5rem;
            }

            .action-section {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .table-container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
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
            <div class="nav-item">
                <a href="{{ route('admin.petugas') }}" class="nav-link side active">
                    <i class="fas fa-users"></i>Manajemen Admin
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
                <h1 class="page-title">Petugas</h1>
                <div class="page-date">{{ now()->format('l, d F Y') }}</div>
            </div>
            <div class="user-info">
                <div class="user-profile">
                    <div class="user-profile-content">
                        <div class="user-avatar">
                            @if($admin)
                                {{ strtoupper(substr($admin->username, 0, 2)) }}
                            @else
                                AD
                            @endif
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


        <!-- Action Section -->
        <div class="action-section">
            <h5 class="section-title">Daftar Petugas</h5>
            <button class="new-staff-btn" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                <i class="fas fa-plus"></i>
                Tambah Petugas
            </button>
        </div>

        <!-- Staff Table -->
        <div class="table-container">
            @if($petugas->count() > 0)
            <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Avatar</th>
                                <th>Username</th>
                                <th>Email (Login)</th>
                                <th>Password</th>
                                <th>Jumlah Post</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($petugas as $index => $petuga)
                                <tr>
                                    <td>
                                        <div class="staff-avatar">
                                            {{ strtoupper(substr($petuga->username, 0, 2)) }}
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $petuga->username }}</strong>
                                    </td>
                                    <td>
                                        <span class="email-field">{{ $petuga->email }}</span>
                                    </td>
                                    <td>
                                        <span class="password-field">••••••••</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            @php
                                                // Count photos uploaded by this petugas
                                                $photoCount = \App\Models\Foto::where('user_id', $petuga->id)->count();
                                                // Count news created by this petugas (if user_id exists)
                                                $newsCount = 0;
                                                try {
                                                    $newsCount = \App\Models\News::where('user_id', $petuga->id)->count();
                                                } catch (Exception $e) {
                                                    $newsCount = 0;
                                                }
                                                // Count prestasi created by this petugas (if user_id exists)
                                                $prestasiCount = 0;
                                                try {
                                                    $prestasiCount = \App\Models\Prestasi::where('user_id', $petuga->id)->count();
                                                } catch (Exception $e) {
                                                    $prestasiCount = 0;
                                                }
                                                $postCount = $photoCount + $newsCount + $prestasiCount;
                                            @endphp
                                            {{ $postCount }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $petuga->created_at->format('d M Y H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn edit" title="Edit Petugas" data-id="{{ $petuga->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.petugas.destroy', $petuga->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus petugas ini?')">
                                        @csrf
                                        @method('DELETE')
                                                <button type="submit" class="action-btn delete" title="Hapus Petugas">
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
                    @else
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <h4>Belum ada petugas</h4>
                    <p>Mulai dengan menambahkan petugas pertama</p>
                    <button type="button" class="new-staff-btn" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                        <i class="fas fa-plus"></i>
                        Tambah Petugas Pertama
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Staff Modal -->
    <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: white; color: var(--dark-color); border-bottom: 1px solid var(--border-color);">
                    <h5 class="modal-title" id="addStaffModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Tambah Petugas Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.petugas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                                <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                                </div>
                                <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                                </div>
                                <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Petugas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle edit button clicks
            document.querySelectorAll('.action-btn.edit').forEach(function(button) {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    editStaff(id);
                });
            });
        });

        function editStaff(id) {
            // Implementasi untuk edit petugas
            alert('Fitur edit petugas akan segera hadir!');
        }
    </script>
</body>
</html>