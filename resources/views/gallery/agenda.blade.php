<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda - SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/gallery-navbar.css') }}">
    <style>
        /* Navbar styling for agenda page - sama seperti galeri */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 80px;
            border-bottom: 1px solid rgba(37, 99, 235, 0.1);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        /* Container untuk mengatur spacing */
        .navbar .container-fluid {
            max-width: 1400px;
            margin: 0 auto;
            padding-left: 3rem;
            padding-right: 3rem;
        }

        .navbar-brand {
            color: #1E40AF !important;
            font-weight: 700;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-right: 4rem;
        }

        .navbar-brand:hover {
            color: #1e3a8a !important;
            transform: scale(1.05);
        }

        .navbar-brand span {
            color: #1E40AF !important;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .navbar-brand img {
            height: 34px;
            width: 34px;
        }

        /* Navbar nav di tengah */
        .navbar-nav {
            margin-left: auto !important;
            margin-right: 0 !important;
        }

        .navbar-nav .nav-link {
            color: #374151 !important;
            font-weight: 400;
            padding: 0.5rem 0.75rem;
            margin: 0 0.25rem;
            border-radius: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            font-size: 0.95rem;
        }

        .navbar-nav .nav-item:last-child .nav-link {
            margin-right: 0.75rem;
        }

        .navbar-nav .nav-link:hover {
            color: #1E40AF !important;
            background: transparent;
        }

        .navbar-nav .nav-link.active {
            color: #1E40AF !important;
            background: transparent;
            font-weight: 500;
        }

        .navbar-nav .nav-link i {
            color: #374151 !important;
            font-size: 0.95rem;
            margin-right: 0.4rem;
        }

        .navbar-nav .nav-link:hover i {
            color: #1E40AF !important;
        }

        .navbar-nav .nav-link.active i {
            color: #1E40AF !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 50%, #1e40af 100%);
            border: none;
            padding: 0.7rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-left: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            background: #1d4ed8;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .navbar .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .navbar-brand {
                font-size: 1.3rem;
                margin-right: 1rem;
            }

            .navbar-brand span {
                font-size: 1.3rem;
            }

            .navbar-nav {
                margin-top: 1rem;
            }

            .btn-primary {
                margin-left: 0;
                margin-top: 1rem;
                width: 100%;
            }
        }

        :root {
            --primary-blue: #2563eb;
            --secondary-blue: #1d4ed8;
            --light-blue: #dbeafe;
            --dark-gray: #333333;
            --light-gray: #666666;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --accent-orange: #f97316;
            --accent-green: #10b981;
            --accent-purple: #a855f7;
            --accent-red: #ef4444;
            --accent-yellow: #f59e0b;
            --accent-teal: #14b8a6;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--dark-gray);
            min-height: 100vh;
            scroll-behavior: smooth;
        }
        
        .main-content { 
            margin-left: 0;
            padding: 0;
            min-height: calc(100vh - 80px);
            margin-top: 80px;
        }
        
        /* Hero Section - Original Design with Blue Border */
        .page-header {
            background: #1E40AF;
            color: #ffffff;
            padding: 3rem 0;
            position: relative;
            overflow: hidden;
            margin-top: 0;
            border: none;
            border-top: 4px solid #3B82F6;
        }
        
        /* Simplified decorative elements */
        .hero-decoration {
            display: none;
        }
        
        
        /* Hide decorative icons */
        .hero-icon-left,
        .hero-icon-right {
            display: none;
        }
        
        .page-header .container {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0 0 1rem 0;
            color: #ffffff;
            line-height: 1.2;
            position: relative;
            display: inline-block;
        }
        
        .page-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.05rem;
            margin-bottom: 1.75rem;
            font-weight: 400;
            line-height: 1.6;
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            z-index: 1;
            text-align: center;
        }
        
        /* Stats or info badges in hero */
        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 1.5rem;
            position: relative;
            z-index: 1;
        }
        
        .hero-stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.4rem;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            transition: all 0.3s ease;
        }

        .hero-stat-item:hover {
            background: rgba(255, 255, 255, 0.22);
            transform: translateY(-2px);
        }
        
        .hero-stat-item i {
            color: #fcd34d;
            font-size: 1.1rem;
        }
        
        .hero-stat-item span {
            color: #ffffff;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .agenda-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
            width: 100%;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            padding: 2rem;
        }

        .calendar-section {
            display: none;
        }

        .agenda-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
            width: 100%;
        }

        /* Agenda toolbar (tabs + search) */
        .agenda-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .agenda-tabs {
            background: #f1f5f9;
            border-radius: 999px;
            padding: 5px;
            display: inline-flex;
            gap: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .agenda-tab {
            border: 0;
            background: transparent;
            padding: 0.6rem 1.2rem;
            border-radius: 999px;
            font-weight: 600;
            color: #475569;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .agenda-tab:hover {
            background: rgba(255, 255, 255, 0.5);
            color: var(--primary-blue);
        }

        .agenda-tab.active {
            background: #ffffff;
            color: var(--primary-blue);
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .agenda-search { 
            position: relative; 
            flex: 1 1 260px; 
            max-width: 420px; 
        }
        
        .agenda-search input { 
            width: 100%; 
            border: 1px solid #e5e7eb; 
            border-radius: 14px; 
            padding: 0.7rem 2.2rem 0.7rem 2.6rem; 
            outline: none; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }
        
        .agenda-search input:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .agenda-search .bi-search { 
            position: absolute; 
            left: 12px; 
            top: 50%; 
            transform: translateY(-50%); 
            color: #94a3b8;
            font-size: 1.1rem;
        }
        
        .agenda-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(229, 231, 235, 0.6);
            position: relative;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            padding: 1.8rem;
            width: 100%;
            margin: 0;
            min-height: 200px;
        }
        
        .agenda-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
            border-color: rgba(30, 64, 175, 0.2);
        }

        .agenda-card:active {
            transform: translateY(-2px) scale(0.98);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            transition: all 0.1s ease;
        }
        
        .agenda-header {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            width: 100%;
            flex: 1;
            margin-bottom: 1rem;
        }

        .agenda-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: #f0f7ff;
            display: grid;
            place-items: center;
            font-size: 1.6rem;
            color: var(--primary-blue);
            flex-shrink: 0;
            border: none;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.1);
        }
        
        .agenda-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1a202c;
            line-height: 1.5;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
            margin: 0;
            flex: 1;
            letter-spacing: -0.2px;
        }
        
        .agenda-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }
        
        .agenda-status {
            padding: 0.4rem 1rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-upcoming {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }
        
        .status-ongoing {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        
        .status-completed {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }
        
        .agenda-date {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .agenda-date i {
            color: #1E40AF;
            font-size: 1rem;
        }
        
        .agenda-actions {
            padding: 1.5rem 2rem;
            text-align: center;
        }
        
        .btn-view-photos {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            border: none;
            color: var(--white);
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-view-photos:hover {
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(31, 111, 214, 0.3);
        }
        
        .btn-back {
            background: var(--light-gray);
            border: none;
            color: var(--white);
            padding: 1rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-back:hover {
            background: var(--dark-gray);
            color: var(--white);
            transform: translateY(-2px);
        }
        
        /* Color variations for different agenda types - Soft pastel colors */
        .agenda-card.pensi .agenda-icon { 
            color: var(--accent-purple); 
            background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
        }
        .agenda-card.transforkrab .agenda-icon { 
            color: #1e40af; 
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        }
        .agenda-card.p5 .agenda-icon { 
            color: var(--accent-green); 
            background: linear-gradient(135deg, #f0fdf4 0%, #d1fae5 100%);
        }
        .agenda-card.mountor .agenda-icon { 
            color: var(--accent-orange); 
            background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%);
        }
        .agenda-card.classmeeting .agenda-icon { 
            color: var(--accent-teal); 
            background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%);
        }
        .agenda-card.lomba17agustus .agenda-icon { 
            color: var(--accent-red); 
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        }
        
        /* Responsive design */
        @media (max-width: 1024px) {
            .agenda-layout {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                width: 100%;
            }
            
            .calendar-section {
                order: 2;
            }
            
            .agenda-grid {
                order: 1;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2.2rem;
            }
            
            .page-header {
                padding: 2.5rem 1.5rem;
                margin-bottom: 1.5rem;
                border-radius: 0 0 30px 30px;
            }
            
            .agenda-layout {
                grid-template-columns: 1fr;
                gap: 1rem;
                padding: 0 1rem;
                width: 100%;
            }
            
            .calendar-section {
                padding: 1.5rem;
            }
            
            .agenda-card { 
                min-height: 180px !important; 
                padding: 1.25rem;
                border-radius: 18px;
            }
            .agenda-header { margin-bottom: 1rem; flex: 1; min-height: 60px; }
            .agenda-meta { margin-top: auto; min-height: 20px; }
            
            .main-content {
                padding: 1rem 0;
            }
        }
        
        @media (max-width: 480px) {
            .page-title {
                font-size: 1.8rem;
            }
            
            .page-header {
                padding: 2rem 1rem;
                margin-bottom: 1.5rem;
                border-radius: 0 0 25px 25px;
            }
            
            .hero-stats {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .hero-stat-item {
                width: 100%;
                justify-content: center;
            }
            
            .agenda-grid {
                padding: 0 0.5rem;
            }
            
            .agenda-card { 
                min-height: 170px !important; 
                padding: 1rem;
                border-radius: 16px;
            }
            
            .agenda-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .agenda-header {
                margin-bottom: 1rem;
                flex: 1;
                min-height: 60px;
            }
            
            .agenda-meta {
                padding: 1rem;
            }
        }
        
        /* Animation for cards */
        .agenda-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }
        
        .agenda-card:nth-child(1) { animation-delay: 0.1s; }
        .agenda-card:nth-child(2) { animation-delay: 0.2s; }
        .agenda-card:nth-child(3) { animation-delay: 0.3s; }
        .agenda-card:nth-child(4) { animation-delay: 0.4s; }
        .agenda-card:nth-child(5) { animation-delay: 0.5s; }
        .agenda-card:nth-child(6) { animation-delay: 0.6s; }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    @include('gallery.partials.navbar')

    <!-- Main Content -->
    <div class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <!-- Floating Decorative Shapes -->
                <div class="hero-decoration"></div>
                <div class="hero-decoration"></div>
                <div class="hero-decoration"></div>
                
                <!-- Decorative Icons -->
                <i class="bi bi-calendar-event hero-icon-left"></i>
                <i class="bi bi-calendar-check hero-icon-right"></i>
                
                <div class="container">
                    <h1 class="page-title">Agenda SMKN 4 Bogor</h1>
                    <p class="page-subtitle">Jadwal kegiatan dan event menarik yang akan datang dan telah berlalu</p>
                    
                    <!-- Hero Stats -->
                    <div class="hero-stats">
                        <div class="hero-stat-item">
                            <i class="bi bi-calendar-event"></i>
                            <span>{{ $agendas->count() }} Agenda</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Agenda Layout -->
        <div class="container">
            <div class="agenda-layout">
                <!-- Calendar Section -->
                <div class="calendar-section">
                    <h3 class="calendar-title">Kalender</h3>
                    <div class="calendar-container">
                        <div id="calendar"></div>
                    </div>
                </div>
                
                <!-- Agenda List Section -->
                <div class="agenda-list-section">
                    <div class="agenda-toolbar">
                        <div class="agenda-tabs">
                            <button type="button" class="agenda-tab active" data-status="all">Semua</button>
                            <button type="button" class="agenda-tab" data-status="upcoming">Akan Datang</button>
                            <button type="button" class="agenda-tab" data-status="completed">Selesai</button>
                        </div>
                        <div class="agenda-search">
                            <i class="bi bi-search"></i>
                            <input type="text" id="agendaSearch" placeholder="Cari agenda..." aria-label="Cari agenda" />
                        </div>
                    </div>
                    <div class="agenda-grid">
                @if($agendas->count() > 0)
                    @foreach($agendas as $agenda)
                        @php
                            $isUpcoming = $agenda->tanggal >= now()->toDateString();
                            $statusClass = $isUpcoming ? 'status-upcoming' : 'status-completed';
                            $statusText = $isUpcoming ? 'Akan Datang' : 'Selesai';
                            
                            // Tentukan icon berdasarkan tipe
                            // Gunakan Bootstrap Icons yang lebih profesional
                            $icon = 'bi bi-calendar-event'; // default icon
                            if($agenda->tipe) {
                                switch($agenda->tipe) {
                                    case 'pensi':
                                        $icon = 'bi bi-music-note-beamed';
                                        break;
                                    case 'transforkrab':
                                        $icon = 'bi bi-bus-front';
                                        break;
                                    case 'p5':
                                        $icon = 'bi bi-stars';
                                        break;
                                    case 'mountor':
                                        $icon = 'bi bi-activity';
                                        break;
                                    case 'classmet':
                                    case 'classmeeting':
                                        $icon = 'bi bi-people';
                                        break;
                                    case 'lomba-17-agustus':
                                        $icon = 'bi bi-flag';
                                        break;
                                }
                            }
                        @endphp
                        
                        @php
                            $tipe = $agenda->tipe ?? 'default';
                            $judul = $agenda->judul ?? 'Judul Tidak Tersedia';
                            $deskripsi = $agenda->deskripsi ?? null;
                            $tanggal = $agenda->tanggal ?? now()->toDateString();
                            $waktuMulai = $agenda->waktu_mulai ?? '00:00';
                            $waktuSelesai = $agenda->waktu_selesai ?? '23:59';
                            $keterangan = $agenda->keterangan ?? null;
                        @endphp
                        
                        <div class="agenda-card {{ $tipe }}" data-status="{{ $isUpcoming ? 'upcoming' : 'completed' }}" data-title="{{ strtolower($judul) }}">
                            <div class="agenda-header">
                                <div class="agenda-icon"><i class="{{ $icon }}"></i></div>
                                <h4 class="agenda-title">{{ $judul }}</h4>
                            </div>
                            @if(!empty($deskripsi))
                                <div class="agenda-description">
                                    <p>{{ $deskripsi }}</p>
                                </div>
                            @endif
                            <div class="agenda-meta">
                                <div class="meta-item">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="bi bi-clock"></i>
                                    <span>{{ $waktuMulai }} - {{ $waktuSelesai }}</span>
                                </div>
                                @if(!empty($agenda->lokasi))
                                <div class="meta-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>{{ $agenda->lokasi }}</span>
                                </div>
                                @endif
                                <span class="agenda-status status-{{ $isUpcoming ? 'upcoming' : 'completed' }}">
                                    {{ $isUpcoming ? 'Akan Datang' : 'Selesai' }}
                                </span>
                            </div>
                            @if(!empty($keterangan) && $keterangan !== $deskripsi)
                                <div class="agenda-keterangan">
                                    <p><strong>Keterangan:</strong> {{ $keterangan }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <!-- Fallback ke data statis jika tidak ada data dari database -->
                    @foreach($agendaData as $key => $data)
                        <div class="agenda-card {{ $key }}" data-status="upcoming" data-title="{{ strtolower($data['title']) }}">
                            <div class="agenda-header">
                                <div class="agenda-icon"><i class="bi bi-calendar-event"></i></div>
                                <h4 class="agenda-title">{{ $data['title'] }}</h4>
                            </div>
                            @if(isset($data['description']) && $data['description'])
                                <div class="agenda-description">
                                    <p>{{ $data['description'] }}</p>
                                </div>
                            @endif
                            <div class="agenda-meta">
                                <div class="meta-item">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>TBD</span>
                                </div>
                                @if(isset($data['time']) && $data['time'])
                                <div class="meta-item">
                                    <i class="bi bi-clock"></i>
                                    <span>{{ $data['time'] }}</span>
                                </div>
                                @endif
                                <span class="agenda-status status-upcoming">Akan Datang</span>
                            </div>
                        </div>
                    @endforeach
                @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white py-5" style="background:#000000;">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4 Bogor" class="me-3" style="height: 42px; width: 42px; object-fit: contain;" onerror="this.style.display='none'">
                        <h4 class="fw-bold mb-0">SMKN 4 Bogor</h4>
                    </div>
                    <p class="text-white-75 mb-0" style="font-size: 1.1rem;">
                        Mencetak generasi unggul, berkarakter, dan siap kerja.
                    </p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3 text-white">Kontak</h5>
                    <ul class="list-unstyled text-white-75 mb-0" style="font-size: 1.1rem;">
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-geo-alt me-3" style="font-size: 1.2rem; min-width: 1.2rem;"></i>
                            <span>Jl. Raya Tajur, Kp. Buntar, Muarasari, Bogor</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-telephone me-3" style="font-size: 1.2rem; min-width: 1.2rem;"></i>
                            <span>(0251) 7547381</span>
                        </li>
                        <li class="mb-0 d-flex align-items-center">
                            <i class="bi bi-envelope me-3" style="font-size: 1.2rem; min-width: 1.2rem;"></i>
                            <span>info@smkn4bogor.sch.id</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3 text-white">Ikuti Kami</h5>
                    <div class="d-flex gap-4">
                        <a href="https://www.facebook.com/p/SMK-NEGERI-4-KOTA-BOGOR-100054636630766/?locale=id_ID" target="_blank" aria-label="Facebook" style="font-size: 2rem; color: #1E40AF;"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/smkn4kotabogor/" target="_blank" aria-label="Instagram" style="font-size: 2rem; color: #1E40AF;"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/@smknegeri4bogor905" target="_blank" aria-label="YouTube" style="font-size: 2rem; color: #1E40AF;"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary mt-4 mb-4"/>
            <div class="text-center py-3 text-white-75" style="font-size: 1.1rem;">
                <span>&copy; 2024 SMKN 4 BOGOR. All rights reserved.</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Calendar functionality
        class Calendar {
            constructor(containerId) {
                this.container = document.getElementById(containerId);
                this.currentDate = new Date();
                this.currentMonth = this.currentDate.getMonth();
                this.currentYear = this.currentDate.getFullYear();
                this.events = this.getEventsFromAgenda();
                this.render();
            }

            getEventsFromAgenda() {
                const events = [];
                const agendaCards = document.querySelectorAll('.agenda-card');
                
                console.log('Total agenda cards found:', agendaCards.length);
                
                // Add hardcoded events for known dates
                const currentYear = new Date().getFullYear();
                events.push({
                    date: new Date(currentYear, 9, 6), // October 6th (month is 0-indexed)
                    title: 'Hari Ulang Tahun SMKN 4 Bogor'
                });
                events.push({
                    date: new Date(currentYear, 7, 17), // August 17th (month is 0-indexed)
                    title: 'Hari Kemerdekaan Indonesia'
                });
                
                agendaCards.forEach((card, index) => {
                    const dateElement = card.querySelector('.agenda-date');
                    if (dateElement) {
                        const dateText = dateElement.textContent.trim();
                        console.log(`Card ${index + 1} date text:`, dateText);
                        
                        // Skip TBD dates
                        if (dateText === 'TBD') {
                            console.log(`Skipping TBD date for card ${index + 1}`);
                            return;
                        }
                        
                        // Extract date from text (assuming format like "15 Januari 2024")
                        const dateMatch = dateText.match(/(\d{1,2})\s+(\w+)\s+(\d{4})/);
                        if (dateMatch) {
                            const day = parseInt(dateMatch[1]);
                            const monthName = dateMatch[2];
                            const year = parseInt(dateMatch[3]);
                            
                            console.log(`Parsed: day=${day}, month=${monthName}, year=${year}`);
                            
                            // Convert month name to number
                            const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            const month = monthNames.indexOf(monthName);
                            
                            if (month !== -1) {
                                const eventDate = new Date(year, month, day);
                                console.log(`Created date:`, eventDate);
                                
                                // Only add if the date is valid
                                if (!isNaN(eventDate.getTime())) {
                                    events.push({
                                        date: eventDate,
                                        title: card.querySelector('.agenda-title').textContent.trim()
                                    });
                                    console.log(`Added event for ${day} ${monthName} ${year}`);
                                }
                            } else {
                                console.log(`Month not found: ${monthName}`);
                            }
                        } else {
                            console.log(`Date pattern not matched for: ${dateText}`);
                        }
                    } else {
                        console.log(`No date element found in card ${index + 1}`);
                    }
                });
                
                console.log('Final events array:', events);
                return events;
            }

            render() {
                const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                  'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                
                const firstDay = new Date(this.currentYear, this.currentMonth, 1);
                const lastDay = new Date(this.currentYear, this.currentMonth + 1, 0);
                const daysInMonth = lastDay.getDate();
                const startingDayOfWeek = firstDay.getDay();

                let html = `
                    <div class="calendar-header">
                        <button class="calendar-nav" onclick="calendar.previousMonth()">‹</button>
                        <div class="calendar-month-year">${monthNames[this.currentMonth]} ${this.currentYear}</div>
                        <button class="calendar-nav" onclick="calendar.nextMonth()">›</button>
                    </div>
                    <div class="calendar-grid">
                        <div class="calendar-day-header">Min</div>
                        <div class="calendar-day-header">Sen</div>
                        <div class="calendar-day-header">Sel</div>
                        <div class="calendar-day-header">Rab</div>
                        <div class="calendar-day-header">Kam</div>
                        <div class="calendar-day-header">Jum</div>
                        <div class="calendar-day-header">Sab</div>
                `;

                // Empty cells for days before the first day of the month
                for (let i = 0; i < startingDayOfWeek; i++) {
                    html += '<div class="calendar-day"></div>';
                }

                // Days of the month
                for (let day = 1; day <= daysInMonth; day++) {
                    const date = new Date(this.currentYear, this.currentMonth, day);
                    const isToday = this.isToday(date);
                    const hasEvent = this.hasEvent(date);
                    
                    let dayClass = 'calendar-day';
                    if (isToday) dayClass += ' today';
                    if (hasEvent) dayClass += ' has-event';
                    
                    html += `<div class="${dayClass}" onclick="calendar.selectDate(${day})">${day}</div>`;
                }

                html += '</div>';
                this.container.innerHTML = html;
            }

            isToday(date) {
                const today = new Date();
                return date.toDateString() === today.toDateString();
            }

            hasEvent(date) {
                return this.events.some(event => 
                    event.date.toDateString() === date.toDateString()
                );
            }

            previousMonth() {
                this.currentMonth--;
                if (this.currentMonth < 0) {
                    this.currentMonth = 11;
                    this.currentYear--;
                }
                this.render();
            }

            nextMonth() {
                this.currentMonth++;
                if (this.currentMonth > 11) {
                    this.currentMonth = 0;
                    this.currentYear++;
                }
                this.render();
            }

            selectDate(day) {
                const selectedDate = new Date(this.currentYear, this.currentMonth, day);
                console.log('Selected date:', selectedDate.toDateString());
                // You can add more functionality here, like filtering agenda items
            }
        }

        // Initialize calendar when page loads
        let calendar;
        document.addEventListener('DOMContentLoaded', function() {
            calendar = new Calendar('calendar');
        });
    </script>
    <script>
        function viewAgendaPhotos(agendaType) {
            // Function to handle viewing photos by agenda type
            // This will be implemented when photos are added
            alert(`Melihat foto untuk agenda: ${agendaType}\n\nFitur ini akan tersedia setelah foto ditambahkan ke sistem.`);
            
            // Future implementation:
            // window.location.href = `/agenda/${agendaType}/photos`;
        }
        
        // Add click event listeners to all agenda cards
        document.addEventListener('DOMContentLoaded', function() {
            const agendaCards = document.querySelectorAll('.agenda-card');
            
            agendaCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Add ripple effect
                    const ripple = document.createElement('div');
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    ripple.style.left = '50%';
                    ripple.style.top = '50%';
                    ripple.style.width = '100px';
                    ripple.style.height = '100px';
                    ripple.style.marginLeft = '-50px';
                    ripple.style.marginTop = '-50px';
                    
                    card.style.position = 'relative';
                    card.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
        
        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
    <script>
        // Filtering: tabs (status) + search (title)
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.agenda-tab');
            const searchInput = document.getElementById('agendaSearch');
            const cards = document.querySelectorAll('.agenda-card');

            let currentStatus = 'all';
            let currentQuery = '';

            function applyFilters() {
                const q = currentQuery.trim();
                cards.forEach(card => {
                    const status = card.getAttribute('data-status') || 'upcoming';
                    const title = (card.getAttribute('data-title') || '').toLowerCase();

                    const statusOk = (currentStatus === 'all') || (status === currentStatus);
                    const queryOk = q === '' || title.includes(q);

                    card.style.display = (statusOk && queryOk) ? '' : 'none';
                });
            }

            tabs.forEach(btn => {
                btn.addEventListener('click', () => {
                    tabs.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    currentStatus = btn.getAttribute('data-status');
                    applyFilters();
                });
            });

            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    currentQuery = e.target.value.toLowerCase();
                    applyFilters();
                });
            }
        });
    </script>
</body>
</html>

