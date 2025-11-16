<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Galeri - Admin Dashboard</title>
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

        /* Overview */
        .overview-section{margin-bottom:2rem}
        .section-title{font-size:1.25rem;font-weight:700;color:var(--dark-color);margin-bottom:1.5rem}
        .overview-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1.5rem}
        .overview-card{background:#fff;border-radius:16px;padding:1.5rem;box-shadow:0 10px 25px rgba(0,0,0,.08);border:1px solid var(--border-color);display:flex;align-items:center;gap:1.25rem}
        .overview-icon{width:60px;height:60px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.5rem}
        .bg-primary{background:var(--gradient-primary)} .bg-success{background:linear-gradient(135deg,#10b981,#059669)} .bg-warning{background:linear-gradient(135deg,#f59e0b,#d97706)} .bg-info{background:linear-gradient(135deg,#06b6d4,#0891b2)}

        /* Photos */
        .photos-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-top:2rem}
        .photo-card{background:#fff;border:1px solid var(--border-color);border-radius:16px;overflow:hidden;box-shadow:0 10px 25px rgba(0,0,0,.08);transition:.3s}
        .photo-card:hover{transform:translateY(-5px)}
        .photo-thumbnail{height:200px;overflow:hidden}
        .photo-thumbnail img{width:100%;height:100%;object-fit:cover;transition:transform .3s}
        .photo-card:hover .photo-thumbnail img{transform:scale(1.05)}
        .photo-info{padding:1.5rem}
        .photo-title{font-weight:700;color:var(--dark-color);margin-bottom:.5rem;font-size:1rem}
        .photo-description{color:var(--light-gray);font-size:.9rem;margin-bottom:.8rem}
        .status-badge{padding:.25rem .75rem;border-radius:20px;font-size:.75rem;font-weight:600;background:#d1fae5;color:#065f46}
        .meta-item{display:flex;align-items:center;gap:.25rem;color:var(--light-gray);font-size:.8rem}
        .photo-actions{display:flex;gap:.5rem}
        .action-btn{width:32px;height:32px;border-radius:8px;border:1px solid var(--border-color);background:transparent;color:var(--light-gray);display:flex;align-items:center;justify-content:center}
        .action-btn.view{color:#06b6d4;border-color:rgba(6,182,212,.35)}
        .action-btn.edit{color:#f59e0b;border-color:rgba(245,158,11,.35)}
        .action-btn.delete{color:#ef4444;border-color:rgba(239,68,68,.35)}

        .btn-add{background:linear-gradient(135deg,#3b82f6,#1d4ed8);color:#fff;border:none;border-radius:12px;padding:.9rem 1.8rem;font-weight:700}

        /* Hamburger Menu */
        .hamburger-menu{display:none;position:fixed;top:20px;left:20px;z-index:1100;width:50px;height:50px;background:rgba(255,255,255,0.95);border:none;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.15);cursor:pointer;flex-direction:column;align-items:center;justify-content:center;gap:5px;transition:all 0.3s ease}
        .hamburger-menu:hover{transform:scale(1.05);box-shadow:0 6px 16px rgba(0,0,0,0.2)}
        .hamburger-menu span{display:block;width:24px;height:3px;background:#1e40af;border-radius:2px;transition:all 0.3s ease}
        .hamburger-menu.active span:nth-child(1){transform:rotate(45deg) translate(7px,7px)}
        .hamburger-menu.active span:nth-child(2){opacity:0}
        .hamburger-menu.active span:nth-child(3){transform:rotate(-45deg) translate(7px,-7px)}

        @media (max-width:1200px){.photos-grid{grid-template-columns:repeat(3,1fr)}}
        @media (max-width:992px){.photos-grid{grid-template-columns:repeat(2,1fr)}}
        @media (max-width:768px){
            .hamburger-menu{display:flex}
            .sidebar{transform:translateX(-100%)}
            .sidebar.active{transform:translateX(0)}
            .photos-grid{grid-template-columns:1fr}
            .main-content{margin-left:0;padding:1rem;padding-top:80px}
            .top-bar{flex-direction:column;gap:1rem;padding:1rem}
            .page-title{font-size:1.25rem}
            .overview-grid{grid-template-columns:repeat(2,1fr);gap:1rem}
        }
        @media (max-width:480px){
            .overview-grid{grid-template-columns:1fr}
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
            <div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link side"><i class="fas fa-tachometer-alt"></i>Dashboard Admin</a></div>
            <div class="nav-item"><a href="{{ route('admin.petugas') }}" class="nav-link side"><i class="fas fa-users"></i>Manajemen Admin</a></div>
            <div class="nav-item"><a href="{{ route('admin.photos.index') }}" class="nav-link side active"><i class="fas fa-images"></i>Kelola Galeri</a></div>
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
                <h1 class="page-title">Kelola Galeri</h1>
                <p class="page-date">{{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('l, d F Y') }}</p>
            </div>
            <div class="user-profile-content">
                <div class="user-avatar">
                    @php 
                        // Use session-based admin data like in AdminController
                        if (Session::has('admin_id')) {
                            $adminId = Session::get('admin_id');
                            $adminName = Session::get('admin_name') ?? 'Admin';
                        } else {
                            $adminName = 'Admin';
                        }
                    @endphp
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-details">
                    <div class="user-name">{{ $adminName }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
                        </div>

        <!-- Overview -->
        <div class="overview-section">
            <h2 class="section-title">Overview Galeri</h2>
            <div class="overview-grid">
                <div class="overview-card"><div class="overview-icon bg-primary"><i class="fas fa-images"></i></div><div><h3>{{ $totalPhotos ?? 0 }}</h3><p>Total Foto</p></div></div>
                <div class="overview-card"><div class="overview-icon bg-success"><i class="fas fa-folder"></i></div><div><h3>{{ $photosWithCategory ?? 0 }}</h3><p>Foto dengan Kategori</p></div></div>
                <div class="overview-card"><div class="overview-icon bg-warning"><i class="fas fa-calendar-week"></i></div><div><h3>{{ $photosThisWeek ?? 0 }}</h3><p>Foto Minggu Ini</p></div></div>
                <div class="overview-card"><div class="overview-icon bg-info"><i class="fas fa-calendar-alt"></i></div><div><h3>{{ $photosThisMonth ?? 0 }}</h3><p>Foto Bulan Ini</p></div></div>
                </div>
            </div>

        <!-- Header daftar foto -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0">Daftar Foto</h2>
            <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addPhotoModal">
                <i class="fas fa-plus me-2"></i>Tambah Foto Baru
                </button>
        </div>

        <!-- Photos Grid -->
        <div class="photos-grid" id="photosGrid">
                @if($photos && $photos->count() > 0)
                        @foreach($photos as $photo)
                                <div class="photo-card">
                        <div class="photo-thumbnail">
                                    @if($photo->file_path)
                                        <img src="{{ asset('storage/' . $photo->file_path) }}" alt="{{ $photo->judul ?? 'Foto' }}" style="width:100%;height:100%;object-fit:cover;" onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'d-flex w-100 h-100 align-items-center justify-content-center text-muted flex-column\' style=\'background:#f1f5f9\'><i class=\'fas fa-image fa-2x\'></i><small style=\'margin-top:5px;font-size:10px;color:#999;\'>{{ $photo->file_path }}</small></div>'">
                                    @else
                                <div class="d-flex w-100 h-100 align-items-center justify-content-center text-muted" style="background:#f1f5f9">
                                    <i class="fas fa-image fa-2x"></i>
                                        </div>
                                    @endif
                        </div>
                                    <div class="photo-info">
                            <h3 class="photo-title">{{ $photo->judul ?? 'Foto Tanpa Judul' }}</h3>
                            @if($photo->deskripsi && trim($photo->deskripsi) !== '')
                                <p class="photo-description">{{ $photo->deskripsi }}</p>
                            @endif
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="status-badge">Published</span>
                                <span class="meta-item"><i class="fas fa-tag"></i>{{ $photo->kategori_nama ?? 'Tanpa Kategori' }}</span>
                                        </div>
                                        <div class="photo-actions">
                                <button type="button" class="action-btn view" data-bs-toggle="modal" data-bs-target="#photoDetailModal"
                                                    data-photo-id="{{ $photo->id }}"
                                                    data-photo-title="{{ htmlspecialchars($photo->judul ?? 'Foto Tanpa Judul') }}"
                                                    data-photo-description="{{ htmlspecialchars($photo->deskripsi ?? 'Tidak ada deskripsi') }}"
                                                    data-photo-image="{{ asset('storage/' . $photo->file_path) }}?t={{ time() }}"
                                                    data-photo-category="{{ htmlspecialchars($photo->kategori_nama ?? 'Tanpa Kategori') }}"
                                        data-photo-date="{{ $photo->created_at ?? 'N/A' }}">
                                    <i class="fas fa-eye"></i>
                                            </button>
                                <button type="button" class="action-btn edit" data-bs-toggle="modal" data-bs-target="#editPhotoModal"
                                                    data-photo-id="{{ $photo->id }}"
                                                    data-photo-title="{{ htmlspecialchars($photo->judul ?? '') }}"
                                                    data-photo-description="{{ htmlspecialchars($photo->deskripsi ?? '') }}"
                                        data-photo-category="{{ $photo->kategori_id ?? '' }}">
                                    <i class="fas fa-edit"></i>
                                            </button>
                                <button type="button" class="action-btn delete" data-bs-toggle="modal" data-bs-target="#deletePhotoModal"
                                        data-photo-id="{{ $photo->id }}" data-photo-title="{{ htmlspecialchars($photo->judul ?? 'Foto') }}">
                                    <i class="fas fa-trash"></i>
                                            </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                @else
                <div class="text-center text-muted py-5">
                    <i class="fas fa-images fa-3x mb-3"></i>
                    <div>Belum Ada Foto</div>
                    <button type="button" class="btn btn-add mt-3" data-bs-toggle="modal" data-bs-target="#addPhotoModal">
                        <i class="fas fa-plus me-2"></i>Tambah Foto Pertama
                        </button>
                    </div>
                @endif
    </div>

        @if($photos && $photos->hasPages())
            <div class="d-flex justify-content-center mt-4">{{ $photos->links('pagination::bootstrap-5') }}</div>
        @endif
                </div>

    <!-- Detail Photo Modal -->
    <div class="modal fade" id="photoDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="detailTitle">Detail Foto</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><div class="row g-3"><div class="col-md-6"><img id="detailImage" src="" alt="Preview" class="img-fluid rounded" style="object-fit:cover;width:100%;max-height:320px;"></div><div class="col-md-6"><div class="mb-2"><strong>Judul:</strong> <span id="detailJudul">-</span></div><div class="mb-2"><strong>Kategori:</strong> <span id="detailKategori">-</span></div><div class="mb-2"><strong>Dibuat:</strong> <span id="detailTanggal">-</span></div><div class="mt-2"><strong>Deskripsi:</strong><p id="detailDeskripsi" class="mb-0 text-muted"></p></div></div></div></div></div></div>
    </div>

    <!-- Edit Photo Modal -->
    <div class="modal fade" id="editPhotoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Edit Foto</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><form id="editPhotoForm" method="POST" enctype="multipart/form-data"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="PUT"><div class="mb-3"><label class="form-label fw-semibold">Judul Foto</label><input type="text" name="judul" id="editJudul" class="form-control" required></div><div class="mb-3"><label class="form-label fw-semibold">Kategori</label><select name="kategori_id" id="editKategori" class="form-select" required><option value="">Pilih Kategori</option>
@if(isset($categories))
@foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                    @endforeach
@endif
</select></div><div class="mb-3"><label class="form-label fw-semibold">Deskripsi</label><textarea name="deskripsi" id="editDeskripsi" class="form-control" rows="4"></textarea></div><div class="mb-3"><label class="form-label fw-semibold">Ganti Foto (opsional)</label><input type="file" name="file" class="form-control" accept="image/*"><small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small></div></form></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Batal</button><button type="submit" form="editPhotoForm" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan Perubahan</button></div></div></div>
    </div>

    <!-- Delete Photo Modal -->
    <div class="modal fade" id="deletePhotoModal" tabindex="-1" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Hapus Foto</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body">Apakah Anda yakin ingin menghapus foto: <strong id="deleteJudul">(judul)</strong>?</div><div class="modal-footer"><form id="deletePhotoForm" method="POST"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Batal</button><button type="submit" class="btn btn-danger"><i class="fas fa-trash me-2"></i>Hapus</button></form></div></div></div></div>

    <!-- Add Photo Modal -->
    <div class="modal fade" id="addPhotoModal" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Tambah Foto Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><form id="addPhotoForm" action="{{ route('admin.photos.store') }}" method="POST" enctype="multipart/form-data">@csrf<div class="mb-3"><label class="form-label fw-semibold">Judul Foto <span class="text-danger">*</span></label><input type="text" name="judul" class="form-control" placeholder="Masukkan judul foto" required></div><div class="mb-3"><label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label><select name="kategori_id" class="form-select" required><option value="">Pilih Kategori</option>
@if(isset($categories))
@foreach($categories as $category)
<option value="{{ $category->id }}">{{ $category->nama }}</option>
@endforeach
@endif
</select></div><div class="mb-3"><label class="form-label fw-semibold">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsi (opsional)"></textarea></div><div class="mb-3"><label class="form-label fw-semibold">Foto <span class="text-danger">*</span></label><input type="file" name="file" id="photoInput" class="form-control" accept="image/*" required><small class="text-muted">Format: JPG, PNG, GIF, WEBP (Maks: 10MB)</small><div id="photoPreview" class="mt-2" style="display:none;"><img id="previewImage" src="" alt="Preview" class="img-fluid rounded" style="max-height:200px;object-fit:cover;"></div></div></form></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Batal</button><button type="submit" form="addPhotoForm" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan Foto</button></div></div></div></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const baseEditUrl = "{{ url('admin/photos') }}/";
        const baseDeleteUrl = "{{ url('admin/photos') }}/";
        
        // Debug: Log all image sources
        console.log('=== Photo Debug Info ===');
        document.querySelectorAll('.photo-thumbnail img').forEach((img, index) => {
            console.log(`Image ${index + 1}:`, {
                src: img.src,
                alt: img.alt,
                complete: img.complete,
                naturalWidth: img.naturalWidth,
                naturalHeight: img.naturalHeight
            });
        });
        
        // Photo preview
        const photoInput=document.getElementById('photoInput');
        if(photoInput){photoInput.addEventListener('change',function(e){const f=e.target.files[0];if(!f){document.getElementById('photoPreview').style.display='none';return;}const r=new FileReader();r.onload=function(ev){document.getElementById('previewImage').src=ev.target.result;document.getElementById('photoPreview').style.display='block';};r.readAsDataURL(f);});}

        // Detail modal
        const detail=document.getElementById('photoDetailModal');
        if(detail){detail.addEventListener('show.bs.modal',function(event){const b=event.relatedTarget;if(!b)return;document.getElementById('detailTitle').textContent=b.getAttribute('data-photo-title')||'Detail Foto';document.getElementById('detailJudul').textContent=b.getAttribute('data-photo-title')||'-';document.getElementById('detailKategori').textContent=b.getAttribute('data-photo-category')||'-';document.getElementById('detailTanggal').textContent=b.getAttribute('data-photo-date')||'-';document.getElementById('detailImage').src=b.getAttribute('data-photo-image')||'';document.getElementById('detailDeskripsi').textContent=b.getAttribute('data-photo-description')||'';});}

        // Edit modal
        const edit=document.getElementById('editPhotoModal');
        if(edit){edit.addEventListener('show.bs.modal',function(event){const b=event.relatedTarget;if(!b)return;document.getElementById('editJudul').value=b.getAttribute('data-photo-title')||'';document.getElementById('editDeskripsi').value=b.getAttribute('data-photo-description')||'';const sel=document.getElementById('editKategori');if(sel) sel.value=b.getAttribute('data-photo-category')||'';document.getElementById('editPhotoForm').action=baseEditUrl+b.getAttribute('data-photo-id');});}

        // Delete modal
        const del=document.getElementById('deletePhotoModal');
        if(del){del.addEventListener('show.bs.modal',function(event){const b=event.relatedTarget;if(!b)return;document.getElementById('deleteJudul').textContent=b.getAttribute('data-photo-title')||'Foto';document.getElementById('deletePhotoForm').action=baseDeleteUrl+b.getAttribute('data-photo-id');});}

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
