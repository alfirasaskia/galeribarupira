<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('gallery.beranda') }}">
            <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4 Bogor" width="34" height="34" class="me-2" style="object-fit: contain;"
                 onerror="this.onerror=null; this.style.display='none';">
            <span style="color:#0d6efd; font-weight: bold;">SMKN 4 BOGOR</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('gallery.beranda') ? 'active' : '' }}" href="{{ route('gallery.beranda') }}">
                        <i class="bi bi-house text-muted me-2"></i>Beranda
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-mortarboard text-muted me-2"></i>Profile
                    </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="{{ route('gallery.profile') }}#sejarah"><i class="bi bi-book me-2"></i>Profile Singkat</a></li>
                            <li><a class="dropdown-item" href="{{ route('gallery.beranda') }}#jurusan"><i class="bi bi-mortarboard me-2"></i>Jurusan</a></li>
                            <li><a class="dropdown-item" href="{{ route('gallery.beranda') }}#fasilitas"><i class="bi bi-gear me-2"></i>Fasilitas Sekolah</a></li>
                        </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('gallery.galeri') ? 'active' : '' }}" href="{{ route('gallery.galeri') }}">
                        <i class="bi bi-images text-muted me-2"></i>Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ url('/beranda#news') }}">
                        <i class="bi bi-newspaper text-muted me-2"></i>Informasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('gallery.agenda') ? 'active' : '' }}" href="{{ route('gallery.agenda') }}">
                        <i class="bi bi-calendar text-muted me-2"></i>Agenda
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <!-- User Account Section -->
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center bg-light px-3 py-1 rounded-pill text-decoration-none profile-link dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="transition: all 0.3s ease;">
                        @php
                            $user = session('user_id') ? \DB::table('users')->where('id', session('user_id'))->first() : null;
                        @endphp
                        @if($user && $user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ session('user_name') }}" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                        @else
                            <i class="bi bi-person-circle me-2" style="font-size: 1.25rem;"></i>
                        @endif
                        <span class="d-none d-md-inline">{{ session('user_name') ?? 'Akun Saya' }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style="border: none; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); border-radius: 12px; overflow: hidden;">
                        @if(session('user_id'))
                            <li>
                                <a class="dropdown-item" href="{{ url('/user/profile/' . session('user_id')) }}">
                                    <i class="bi bi-person me-2"></i>Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/user/profile/edit') }}">
                                    <i class="bi bi-pencil-square me-2"></i>Edit Profil
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('register') }}">
                                    <i class="bi bi-person-plus me-2"></i>Daftar
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <style>
                    .profile-link:hover {
                        background: #e5e7eb !important;
                        transform: translateY(-2px);
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                    }
                    .profile-avatar-small {
                        width: 35px;
                        height: 35px;
                        border-radius: 50%;
                        object-fit: cover;
                        margin-right: 0.5rem;
                        border: 2px solid #1E40AF;
                    }
                </style>
            </div>
        </div>
    </div>
</nav>

