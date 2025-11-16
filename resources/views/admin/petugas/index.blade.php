<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Admin - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary-color:#6366f1; --primary-dark:#4f46e5; --success-color:#10b981; --warning-color:#f59e0b; --danger-color:#ef4444; --info-color:#06b6d4; --dark-color:#1e293b; --light-color:#f8fafc; --sidebar-width:280px; --white:#ffffff; --light-gray:#64748b; --border-color:#e2e8f0; --gradient-primary: linear-gradient(135deg,#6366f1 0%, #8b5cf6 100%); }
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter',system-ui,Segoe UI,Roboto,sans-serif;background:linear-gradient(135deg,#f8fafc 0%, #e2e8f0 100%);min-height:100vh;overflow-x:hidden;line-height:1.6}

        /* Sidebar - match /admin */
        .sidebar{position:fixed;left:0;top:0;width:var(--sidebar-width);height:100vh;background:rgba(30,64,175,0.15);color:#374151;z-index:1000;transition:all 0.3s ease;box-shadow:4px 0 20px rgba(30,64,175,0.2);border-right:1px solid rgba(30,64,175,0.3)}
        .sidebar-header{background:rgba(30,64,175,0.2);padding:1.5rem 1rem;border-bottom:1px solid rgba(30,64,175,0.3);min-height:80px;display:flex;align-items:center;gap:1rem;text-align:left}
        .sidebar-logo{width:50px;height:50px;overflow:visible;border:none;box-shadow:none;border-radius:0;background:transparent;padding:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .sidebar-logo img{width:100%;height:100%;object-fit:contain;background:transparent;max-width:100%;max-height:100%}
        .sidebar-title{font-size:1.2rem;font-weight:700;letter-spacing:0.3px;color:#1f2937;line-height:1.2;margin:0}
        .sidebar-subtitle{display:none}
        .sidebar-nav{padding:1.5rem 0}
        .nav-item{margin:.25rem 1rem}
        .nav-divider{height:1px;background:rgba(30,64,175,0.3);margin:1rem 1.5rem;border-radius:1px}
        .nav-link.side{display:flex;align-items:center;padding:.875rem 1.25rem;color:#6b7280;text-decoration:none;border-radius:8px;transition:all 0.3s ease;font-weight:500;font-size:.9rem;margin:.25rem 1rem}
        .nav-link.side:hover{background:rgba(30,64,175,0.15);color:#1e40af}
        .nav-link.side.active{background:rgba(30,64,175,0.25);color:#1e40af;box-shadow:0 2px 8px rgba(30,64,175,0.3)}
        .nav-link.side i{margin-right:.875rem;width:18px;font-size:1rem;text-align:center}

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

        /* Table */
        .table-container{background:#fff;border-radius:16px;padding:2rem;box-shadow:0 10px 25px rgba(0,0,0,.08);border:1px solid var(--border-color)}
        .table{margin-bottom:0}
        .table thead th{background:var(--light-color);color:var(--dark-color);font-weight:600;border:none;padding:1rem}
        .table tbody td{padding:1rem;vertical-align:middle}
        .badge{padding:.5rem 1rem;border-radius:20px;font-weight:600;font-size:.85rem}
        .badge.bg-success{background:linear-gradient(135deg,#10b981,#059669)!important}
        .badge.bg-warning{background:linear-gradient(135deg,#f59e0b,#d97706)!important}
        .badge.bg-danger{background:linear-gradient(135deg,#ef4444,#dc2626)!important}
        
        .btn-add{background:linear-gradient(135deg,#3b82f6,#1d4ed8);color:#fff;border:none;border-radius:12px;padding:.9rem 1.8rem;font-weight:700;box-shadow:0 4px 12px rgba(59,130,246,.3)}
        .btn-add:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(59,130,246,.4)}
        
        .action-btn{width:36px;height:36px;border-radius:8px;border:1px solid var(--border-color);background:transparent;display:inline-flex;align-items:center;justify-content:center;margin:0 .25rem;transition:all .3s}
        .action-btn.edit{color:#f59e0b;border-color:rgba(245,158,11,.35)}
        .action-btn.edit:hover{background:#f59e0b;color:#fff}
        .action-btn.delete{color:#ef4444;border-color:rgba(239,68,68,.35)}
        .action-btn.delete:hover{background:#ef4444;color:#fff}

        /* Hamburger Menu */
        .hamburger-menu{display:none;position:fixed;top:20px;left:20px;z-index:1100;width:50px;height:50px;background:rgba(255,255,255,0.95);border:none;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.15);cursor:pointer;flex-direction:column;align-items:center;justify-content:center;gap:5px;transition:all 0.3s ease}
        .hamburger-menu:hover{transform:scale(1.05);box-shadow:0 6px 16px rgba(0,0,0,0.2)}
        .hamburger-menu span{display:block;width:24px;height:3px;background:#1e40af;border-radius:2px;transition:all 0.3s ease}
        .hamburger-menu.active span:nth-child(1){transform:rotate(45deg) translate(7px,7px)}
        .hamburger-menu.active span:nth-child(2){opacity:0}
        .hamburger-menu.active span:nth-child(3){transform:rotate(-45deg) translate(7px,-7px)}

        @media (max-width:768px){
            .hamburger-menu{display:flex}
            .main-content{margin-left:0;padding:1rem;padding-top:80px}
            .sidebar{transform:translateX(-100%)}
            .sidebar.active{transform:translateX(0)}
            .top-bar{flex-direction:column;gap:1rem;padding:1rem}
            .page-title{font-size:1.25rem}
            .table-container{padding:1rem;overflow-x:auto}
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
            <div class="sidebar-title">Admin Panel</div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link side"><i class="fas fa-tachometer-alt"></i>Dashboard Admin</a></div>
            <div class="nav-item"><a href="{{ route('admin.petugas') }}" class="nav-link side active"><i class="fas fa-users"></i>Manajemen Admin</a></div>
            <div class="nav-item"><a href="{{ route('admin.photos.index') }}" class="nav-link side"><i class="fas fa-images"></i>Kelola Galeri</a></div>
            <div class="nav-item"><a href="{{ route('admin.categories.index') }}" class="nav-link side"><i class="fas fa-folder-open"></i>Kelola Kategori</a></div>
            <div class="nav-item"><a href="{{ route('admin.agenda') }}" class="nav-link side"><i class="fas fa-calendar-alt"></i>Kelola Agenda</a></div>
            <div class="nav-item"><a href="{{ route('admin.suggestions.index') }}" class="nav-link side"><i class="fas fa-inbox"></i>Kotak Masuk @if(isset($unreadSuggestionsCount) && $unreadSuggestionsCount > 0)<span class="badge bg-danger ms-2">{{ $unreadSuggestionsCount }}</span>@endif</a></div>
            <div class="nav-divider"></div>
            <div class="nav-item"><a href="{{ route('admin.berita.index') }}" class="nav-link side"><i class="fas fa-newspaper"></i>Kelola Berita</a></div>
            <div class="nav-item"><a href="{{ route('admin.reports') }}" class="nav-link side"><i class="fas fa-chart-line"></i>Laporan Aktivitas</a></div>
            <div class="nav-divider"></div>
            <div class="nav-item"><a href="{{ route('admin.logout') }}" class="nav-link side" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i>Logout</a></div>
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
                <h1 class="page-title">Manajemen Admin</h1>
                <p class="page-date">{{ date('l, d F Y') }}</p>
            </div>
            <div class="user-profile-content">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <div class="user-name">
                        @if($admin)
                            {{ $admin->username ?? $admin->nama ?? 'Admin' }}
                        @else
                            Admin
                        @endif
                    </div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Daftar Petugas</h2>
            <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addPetugasModal">
                <i class="fas fa-plus me-2"></i>Tambah Petugas Baru
            </button>
        </div>

        <!-- Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($petugas as $index => $p)
                        <tr>
                            <td>{{ ($petugas->currentPage() - 1) * $petugas->perPage() + $index + 1 }}</td>
                            <td><strong>{{ $p->nama }}</strong></td>
                            <td>{{ $p->username }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y H:i') }}</td>
                            <td>
                                <button type="button" class="action-btn edit" data-bs-toggle="modal" data-bs-target="#editPetugasModal"
                                    data-id="{{ $p->id }}"
                                    data-nama="{{ $p->nama }}"
                                    data-username="{{ $p->username }}"
                                    data-email="{{ $p->email }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="action-btn delete" data-bs-toggle="modal" data-bs-target="#deletePetugasModal"
                                    data-id="{{ $p->id }}"
                                    data-nama="{{ $p->nama }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-users fa-3x mb-3 d-block"></i>
                                Belum ada data petugas
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($petugas->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $petugas->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>

    <!-- Add Petugas Modal -->
    <div class="modal fade" id="addPetugasModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Petugas Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.petugas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required minlength="6">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Petugas Modal -->
    <div class="modal fade" id="editPetugasModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editPetugasForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="edit_nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="edit_username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="edit_email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control" name="password" minlength="6">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Petugas Modal -->
    <div class="modal fade" id="deletePetugasModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="deletePetugasForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus petugas <strong id="delete_nama"></strong>?</p>
                        <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Edit Modal
        document.getElementById('editPetugasModal').addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const username = button.getAttribute('data-username');
            const email = button.getAttribute('data-email');
            
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_email').value = email;
            document.getElementById('editPetugasForm').action = '/admin/petugas/' + id;
        });

        // Delete Modal
        document.getElementById('deletePetugasModal').addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            
            document.getElementById('delete_nama').textContent = nama;
            document.getElementById('deletePetugasForm').action = '/admin/petugas/' + id;
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
