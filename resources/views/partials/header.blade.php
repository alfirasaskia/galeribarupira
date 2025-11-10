<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SMKN 4 Bogor' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body style="background:#f1f5f9;">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('gallery.beranda') }}">
                <i class="bi bi-mortarboard-fill me-2 text-primary" style="font-size: 1.6rem;"></i>
                <span class="fw-bold text-primary">SMKN 4 Bogor</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery.beranda') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery.jurusan') }}">Jurusan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery.galeri') }}">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery.agenda') }}">Agenda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/beranda#news') }}">Informasi</a></li>
                    @if(session('user_id') || session('admin_id'))
                        <!-- User sudah login -->
                        <div class="dropdown ms-2">
                            <a href="#" class="d-flex align-items-center bg-light px-3 py-1 rounded-pill text-decoration-none profile-link dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="transition: all 0.3s ease;">
                                <i class="bi bi-person-circle me-2" style="font-size: 1.25rem;"></i>
                                <span class="d-none d-md-inline">Profil Saya</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style="border: none; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); border-radius: 12px; overflow: hidden;">
                                <li>
                                    <a class="dropdown-item" href="{{ session('admin_id') ? route('admin.dashboard') : route('user.profile', ['id' => session('user_id')]) }}">
                                        <i class="bi bi-person me-2"></i>Profil Saya
                                    </a>
                                </li>
                                @if(session('admin_id'))
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <!-- Tombol Login -->
                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="{{ route('admin.login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <main>

