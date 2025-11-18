<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\News;
use App\Models\Suggestion;

class GalleryController extends Controller
{
    public function index()
    {
        // Ambil data dari semua tabel yang relevan
        $fotos = DB::table('foto')->get();
        $galeries = DB::table('galery')->get();
        $kategoris = DB::table('kategori')->get();
        $petugas = DB::table('petugas')->get();
        $posts = DB::table('posts')->get();
        $profiles = DB::table('profile')->get();

        return view('gallery.index', compact('fotos', 'galeries', 'kategoris', 'petugas', 'posts', 'profiles'));
    }

    public function beranda()
    {
        // Catat view activity untuk setiap kunjungan ke halaman beranda
        // Ini digunakan untuk menghitung total pengunjung di halaman reports
        try {
            DB::table('gallery_activities')->insert([
                'activity_type' => 'view',
                'user_id' => session('user_id') ?? null,  // null jika guest/tidak login
                'foto_id' => null,  // null karena view untuk halaman beranda, bukan foto spesifik
                'content' => 'Kunjungan ke halaman beranda',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } catch (\Exception $e) {
            // Jika gagal, lanjutkan tanpa error
            \Log::warning('Failed to record view activity: ' . $e->getMessage());
        }

        // Ambil data statistik untuk halaman beranda
        $totalFotos = DB::table('foto')->count();
        $totalKategoris = DB::table('kategori')->count();
        $totalGaleries = DB::table('galery')->count();
        $totalPetugas = DB::table('petugas')->count();
        $recentFotos = DB::table('foto')
            ->orderByDesc('created_at')
            ->limit(12)
            ->get();

        // Ambil berita terbit dari tabel news untuk ditampilkan pada #news tanpa ubah markup
        $publishedNews = News::where('status', 'published')
            ->orderByDesc(DB::raw('COALESCE(published_at, created_at)'))
            ->get();

        // Ambil agenda aktif/selesai untuk seksyen agenda beranda
        $agendas = DB::table('agenda')
            ->whereIn('status', ['aktif', 'selesai'])
            ->orderBy('tanggal', 'asc')
            ->limit(12)
            ->get();

        // Ambil testimoni terbaru dari suggestions yang sudah disetujui admin
        $recentSuggestions = Suggestion::where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Ambil 6 kategori galeri terbaru untuk section Koleksi Galeri Terbaru
        $galleryCategories = DB::table('kategori')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Ambil ratings yang sudah disetujui untuk ditampilkan di testimoni
        $allRatings = DB::table('ratings')
            ->where('approved', true)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Debug: Log all ratings dengan detail
        \Log::info('=== DEBUG RATINGS ===');
        \Log::info('Total approved ratings:', ['count' => $allRatings->count()]);
        foreach($allRatings as $rating) {
            \Log::info('Rating:', [
                'id' => $rating->id,
                'nama' => $rating->nama,
                'rating' => $rating->rating,
                'approved' => $rating->approved
            ]);
        }
        \Log::info('=== DEBUG SUGGESTIONS ===');
        \Log::info('Total recent suggestions:', ['count' => $recentSuggestions->count()]);
        foreach($recentSuggestions as $suggestion) {
            \Log::info('Suggestion:', [
                'id' => $suggestion->id,
                'nama_lengkap' => $suggestion->nama_lengkap,
                'pesan' => substr($suggestion->pesan, 0, 50)
            ]);
            
            // Check matching
            $matchingRating = $allRatings->where('nama', $suggestion->nama_lengkap)->first();
            \Log::info('Matching check for ' . $suggestion->nama_lengkap, [
                'found' => $matchingRating ? 'YES' : 'NO',
                'rating' => $matchingRating ? $matchingRating->rating : 'N/A'
            ]);
        }

        return view('gallery.beranda', compact('totalFotos', 'totalKategoris', 'totalGaleries', 'totalPetugas', 'recentFotos', 'publishedNews', 'agendas', 'recentSuggestions', 'galleryCategories', 'allRatings'));
    }

    public function galeri()
    {
        $userId = session('user_id');
        
        // Ambil data untuk halaman galeri dengan join kategori, urutkan dari terbaru
        $fotos = DB::table('foto')
            ->leftJoin('kategori', 'foto.kategori_id', '=', 'kategori.id')
            ->select('foto.*', 'kategori.nama as kategori_nama')
            ->orderBy('foto.created_at', 'desc')
            ->get();
        
        // Ambil informasi like dan views untuk setiap foto
        $fotos = $fotos->map(function($foto) use ($userId) {
            // Hitung total likes
            $foto->total_likes = DB::table('gallery_activities')
                ->where('foto_id', $foto->id)
                ->where('activity_type', 'like')
                ->count();
            
            // Hitung total views
            $foto->total_views = DB::table('gallery_activities')
                ->where('foto_id', $foto->id)
                ->where('activity_type', 'view')
                ->distinct('user_id')
                ->count('user_id');
            
            // Jika tidak ada views, set ke 0
            if ($foto->total_views === 0) {
                $foto->total_views = 0;
            }
            
            // Cek apakah user ini sudah like foto ini
            $foto->is_liked_by_user = false;
            if ($userId) {
                $foto->is_liked_by_user = DB::table('gallery_activities')
                    ->where('foto_id', $foto->id)
                    ->where('user_id', $userId)
                    ->where('activity_type', 'like')
                    ->exists();
            }
            
            // Cek apakah user ini sudah bookmark foto ini
            $foto->is_bookmarked_by_user = false;
            if ($userId) {
                $foto->is_bookmarked_by_user = DB::table('gallery_activities')
                    ->where('foto_id', $foto->id)
                    ->where('user_id', $userId)
                    ->where('activity_type', 'bookmark')
                    ->exists();
            }
            
            return $foto;
        });
        
        $kategoris = DB::table('kategori')->get();
        $galeries = DB::table('galery')->get();

        return view('gallery.galeri', compact('fotos', 'kategoris', 'galeries'));
    }

    public function kategori()
    {
        // Ambil data untuk halaman kategori
        $kategoris = DB::table('kategori')->get();

        return view('gallery.kategori', compact('kategoris'));
    }

    // duplicate informasi() removed above

    public function beritaDetail($slug)
    {
        // Ambil data berita berdasarkan slug dari database
        $news = News::where('slug', $slug)
            ->where('status', 'published')
            ->first();
        
        if (!$news) {
            abort(404, 'Berita tidak ditemukan');
        }
        
        // Ambil berita terkait (berita lain dengan status published)
        $relatedNews = News::where('status', 'published')
            ->where('id', '!=', $news->id)
            ->orderByDesc(DB::raw('COALESCE(published_at, created_at)'))
            ->limit(3)
            ->get();
        
        return view('gallery.berita-detail', compact('news', 'relatedNews'));
    }

    

    

    

    

    

    // CRUD Operations untuk Foto
    

    

    

    

    // CRUD Operations untuk Kategori
    

    

    

    

    // CRUD Operations untuk Galery
    

    

    

    

    // CRUD Operations untuk Petugas
    

    

    

    

    public function tim()
    {
        // Ambil data untuk halaman tim
        $petugas = DB::table('petugas')->get();

        return view('gallery.tim', compact('petugas'));
    }

    public function tentang()
    {
        // Ambil data untuk halaman tentang
        $profiles = DB::table('profile')->get();

        return view('gallery.tentang', compact('profiles'));
    }

    public function kontak()
    {
        // Halaman kontak tidak memerlukan data dari database
        return view('gallery.kontak');
    }

    // duplicate methods below will be removed

    public function jurusanShow($slug)
    {
        // Untuk demo, pakai data yang sama dari jurusanList
        $map = collect([
            'desain-komunikasi-visual' => [
                'name' => 'Desain Komunikasi Visual',
                'hero' => asset('images/kelas-illustrator.jpg'),
                'color' => '#2D6CDF',
                'summary' => 'Pelajari dasar-dasar ilustrasi vektor, tools penting, dan workflow profesional untuk menghasilkan karya yang rapi dan scalable.',
                'curriculum' => [
                    'Pengenalan Illustrator & Workspace',
                    'Dasar Vektor: Shape, Path, Anchor',
                    'Typography & Layout',
                    'Color & Gradients',
                    'Export & Best Practices',
                ],
                'mentor' => [
                    'name' => 'Brian Christiansen',
                    'title' => 'CoFounder Sekolah Desain ID',
                    'avatar' => asset('images/mentor-illustrator.jpg'),
                ],
            ],
            // Slug yang dipakai di beranda
            'pplg' => [
                'name' => 'PPLG - Pengembangan Perangkat Lunak dan Gim',
                'hero' => asset('images/jurusan/pplg-logo.jpg'),
                'color' => '#0d6efd',
                'summary' => 'Fokus pemrograman, pengembangan aplikasi web/mobile, dan dasar game dev.',
                'objectives' => [
                    'Mahir logika pemrograman dan OOP',
                    'Mampu membangun aplikasi web dan mobile dasar',
                    'Memahami version control dan kolaborasi Git',
                    'Mengenal pipeline deployment modern',
                ],
                'competencies' => [
                    'Front-end (HTML, CSS, JS)',
                    'Back-end dasar (PHP/Laravel)',
                    'Basis data (MySQL)',
                    'UI/UX dasar',
                ],
                'facilities' => ['Lab RPL modern', 'PC spesifikasi tinggi', 'Akses internet cepat', 'Platform e-learning'],
                'careers' => ['Web Developer', 'Mobile Developer', 'QA Tester', 'UI/UX Designer', 'DevOps Junior'],
                'projects' => ['Website sekolah', 'Aplikasi todo mobile', 'Game 2D sederhana'],
                'duration' => '3 tahun',
                'requirements' => ['Minat teknologi', 'Logika matematika baik', 'Kemauan belajar mandiri'],
                'curriculum' => [
                    'Dasar Pemrograman',
                    'Web Development',
                    'Mobile App Basics',
                    'Database Fundamental',
                    'UI/UX Dasar',
                ],
                'mentor' => [
                    'name' => 'Tim PPLG',
                    'title' => 'Guru Produktif PPLG',
                    'avatar' => asset('images/jurusan/pplg-logo.jpg'),
                ],
            ],
            'tjkt' => [
                'name' => 'TJKT - Teknik Jaringan Komputer dan Telekomunikasi',
                'hero' => asset('images/jurusan/tjkt-logo.jpg'),
                'color' => '#16a34a',
                'summary' => 'Jaringan komputer, server, keamanan siber, dan virtualisasi.',
                'objectives' => [
                    'Menguasai instalasi dan konfigurasi jaringan',
                    'Memahami konsep keamanan jaringan',
                    'Mampu mengelola server Linux/Windows',
                ],
                'competencies' => ['Routing & Switching', 'Subnetting', 'Firewall & VPN', 'Virtualisasi', 'Cloud dasar'],
                'facilities' => ['Lab jaringan', 'Perangkat Cisco/MikroTik', 'Rack server', 'Wi-Fi controller'],
                'careers' => ['Network Admin', 'System Admin', 'NOC Engineer', 'Cybersecurity Analyst'],
                'projects' => ['Simulasi jaringan kampus', 'Deploy server web/file', 'Site-to-site VPN'],
                'duration' => '3 tahun',
                'requirements' => ['Tertarik hardware & jaringan', 'Teliti & tekun', 'Mau praktik langsung'],
                'curriculum' => [
                    'Dasar Jaringan',
                    'Routing & Switching',
                    'Linux Server',
                    'Cybersecurity Dasar',
                    'Virtualisasi & Cloud',
                ],
                'mentor' => [
                    'name' => 'Tim TJKT',
                    'title' => 'Guru Produktif TJKT',
                    'avatar' => asset('images/jurusan/tjkt-logo.jpg'),
                ],
            ],
            'to' => [
                'name' => 'TO - Teknik Otomotif',
                'hero' => asset('images/jurusan/to-logo.jpg'),
                'color' => '#ef4444',
                'summary' => 'Sistem mesin, kelistrikan, diagnostik, dan perawatan kendaraan.',
                'objectives' => [
                    'Mengenal sistem kendaraan modern',
                    'Mampu melakukan diagnostik dasar',
                    'Menerapkan K3 dengan benar',
                ],
                'competencies' => ['Engine', 'Transmisi', 'Brake', 'Electrical', 'Preventive maintenance'],
                'facilities' => ['Bengkel praktik', 'Peralatan OBD', 'Unit kendaraan praktik'],
                'careers' => ['Teknisi Otomotif', 'Service Advisor', 'QC Otomotif'],
                'projects' => ['Tune-up kendaraan', 'Perbaikan sistem rem', 'Diagnostik kelistrikan'],
                'duration' => '3 tahun',
                'requirements' => ['Minat otomotif', 'Fisik sehat', 'Disiplin tinggi'],
                'curriculum' => [
                    'Engine Management',
                    'Transmisi',
                    'Sistem Rem',
                    'Kelistrikan Otomotif',
                    'Diagnostik & Perawatan',
                ],
                'mentor' => [
                    'name' => 'Tim TO',
                    'title' => 'Guru Produktif Otomotif',
                    'avatar' => asset('images/jurusan/to-logo.jpg'),
                ],
            ],
            'tpfl' => [
                'name' => 'TPFL - Teknik Pengelasan Fabrikasi Logam',
                'hero' => asset('images/jurusan/tpfl-logo.jpg'),
                'color' => '#f59e0b',
                'summary' => 'Teknik pengelasan, fabrikasi, pembacaan gambar teknik, dan QC.',
                'objectives' => [
                    'Menguasai teknik pengelasan SMAW/GMAW/GTAW',
                    'Mampu membaca gambar teknik',
                    'Menjaga kualitas hasil las (QC) sesuai standar',
                ],
                'competencies' => ['SMAW/GMAW/GTAW', 'Fabrikasi', 'Gambar teknik', 'Keselamatan kerja'],
                'facilities' => ['Workshop Las', 'Mesin las lengkap', 'Alat keselamatan (APD)'],
                'careers' => ['Welder', 'Fabricator', 'QC Inspector', 'Welding Inspector'],
                'projects' => ['Proyek rangka logam', 'Sertifikasi uji las dasar'],
                'duration' => '3 tahun',
                'requirements' => ['Kesehatan fisik baik', 'Ketelitian tinggi', 'Disiplin keselamatan'],
                'curriculum' => [
                    'SMAW/GMAW/GTAW',
                    'Fabrikasi Logam',
                    'Gambar Teknik',
                    'Keselamatan Kerja',
                    'Quality Control',
                ],
                'mentor' => [
                    'name' => 'Tim TPFL',
                    'title' => 'Guru Produktif TPFL',
                    'avatar' => asset('images/jurusan/tpfl-logo.jpg'),
                ],
            ],
            'desain-foto-digital' => [
                'name' => 'Desain Foto Digital',
                'hero' => asset('images/kelas-photoshop.jpg'),
                'color' => '#2563EB',
                'summary' => 'Kuasi editing foto dasar hingga menengah, retouching, compositing, dan workflow yang efisien di Photoshop.',
                'curriculum' => [
                    'Fundamental Photoshop & Layers',
                    'Selection, Masking & Adjustment',
                    'Retouching & Color Grading',
                    'Compositing & Effects',
                    'Export untuk Web & Print',
                ],
                'mentor' => [
                    'name' => 'Bintan K. Laela',
                    'title' => 'Freelancer Desain & Arsitektur',
                    'avatar' => asset('images/mentor-photoshop.jpg'),
                ],
            ],
            'video-editing' => [
                'name' => 'Video Editing Profesional',
                'hero' => asset('images/kelas-premiere.jpg'),
                'color' => '#7C3AED',
                'summary' => 'Belajar alur kerja lengkap editing video modern, dari import, cut, audio mixing, color, hingga export.',
                'curriculum' => [
                    'Project Setup & Media Management',
                    'Timeline Editing & Transitions',
                    'Audio Mixing & Voiceover',
                    'Color Correction & Grading',
                    'Export & Delivery',
                ],
                'mentor' => [
                    'name' => 'Yulita Futty',
                    'title' => 'Professional Video Editor',
                    'avatar' => asset('images/mentor-premiere.jpg'),
                ],
            ],
        ]);

        $data = $map->get($slug);
        if (!$data) {
            abort(404);
        }

        return view('gallery.jurusan_detail', ['data' => $data, 'slug' => $slug]);
    }

    public function agenda()
    {
        // Ambil data agenda dari database yang statusnya aktif saja
        // Urutkan: agenda yang akan datang (tanggal >= hari ini) di atas, lalu yang sudah selesai di bawah
        $today = now()->toDateString();
        $agendas = DB::table('agenda')
            ->where('status', 'aktif')
            ->orderByRaw("CASE WHEN tanggal >= '{$today}' THEN 0 ELSE 1 END")
            ->orderBy('tanggal', 'asc')
            ->get();
        
        // Pastikan field tanggal & waktu adalah instance Carbon
        $agendas = $agendas->map(function ($agenda) {
            if (isset($agenda->tanggal) && !($agenda->tanggal instanceof Carbon)) {
                $agenda->tanggal = Carbon::parse($agenda->tanggal);
            }
            if (isset($agenda->waktu) && $agenda->waktu && !($agenda->waktu instanceof Carbon)) {
                $agenda->waktu = Carbon::parse($agenda->waktu);
            }
            return $agenda;
        });
        
        // Group agenda berdasarkan tipe jika ada
        $groupedAgendas = $agendas->groupBy('tipe');
        
        // Ambil tipe yang diminta dari query parameter
        $type = request()->query('type');

        return view('gallery.agenda', compact('agendas', 'groupedAgendas', 'type'));
    }

    public function profile()
    {
        // Data profil sederhana; bisa diambil dari DB jika ada
        return view('gallery.profile');
    }

    public function dashboard()
    {
        // Ambil data statistik untuk dashboard
        $totalFotos = DB::table('foto')->count();
        $totalKategoris = DB::table('kategori')->count();
        $totalGaleries = DB::table('galery')->count();
        $totalPetugas = DB::table('petugas')->count();

        return view('gallery.dashboard', compact('totalFotos', 'totalKategoris', 'totalGaleries', 'totalPetugas'));
    }

    public function show($id)
    {
        // Tampilkan detail foto berdasarkan ID
        $foto = DB::table('foto')->where('id', $id)->first();
        
        if (!$foto) {
            abort(404, 'Foto tidak ditemukan');
        }

        return view('gallery.show', compact('foto'));
    }

    // CRUD Operations untuk Foto
    public function storeFoto(Request $request)
    {
        // Handle JSON request
        if ($request->isJson()) {
            $data = $request->json()->all();
        } else {
            $data = $request->all();
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'foto' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'url' => 'nullable|url',
            'kategori_id' => 'nullable|exists:kategori,id',
            'galery_id' => 'nullable|exists:galery,id',
        ]);

        // Handle empty string values
        $kategoriId = $request->kategori_id === '' ? null : $request->kategori_id;
        $galeryId = $request->galery_id === '' ? null : $request->galery_id;

        $filePath = null;
        $thumbnailPath = null;
        $fileName = null;
        $fileSize = null;
        $fileType = null;

        // Support both 'file' and 'foto' field names
        $uploadedFile = $request->file('file') ?? $request->file('foto');

        if ($uploadedFile) {
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
            $fileSize = (string) $uploadedFile->getSize();
            $fileType = $uploadedFile->getMimeType();

            // Ensure public upload directories exist
            $uploadPath = public_path('uploads/fotos');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $thumbnailDir = public_path('uploads/thumbnails');
            if (!file_exists($thumbnailDir)) {
                mkdir($thumbnailDir, 0755, true);
            }

            // Move file to public/uploads/fotos
            $uploadedFile->move($uploadPath, $fileName);

            $filePath = 'uploads/fotos/' . $fileName;
            $thumbnailPath = 'uploads/thumbnails/' . $fileName;

            // For now, copy original as thumbnail
            @copy(public_path($filePath), public_path($thumbnailPath));
        } elseif ($request->url) {
            // If URL is provided instead of file
            $filePath = $request->url;
            $thumbnailPath = $request->url;
            $fileName = basename(parse_url($request->url, PHP_URL_PATH)) ?: 'remote-image';
            $fileSize = '0';
            $fileType = 'url';
        } else {
            // Use placeholder if no file or URL
            $filePath = 'https://via.placeholder.com/400x300?text=Photo';
            $thumbnailPath = 'https://via.placeholder.com/400x300?text=Photo';
            $fileName = 'placeholder.png';
            $fileSize = '0';
            $fileType = 'image/png';
        }

        $fotoId = DB::table('foto')->insertGetId([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_size' => $fileSize,
            'file_type' => $fileType,
            'thumbnail_path' => $thumbnailPath,
            'galery_id' => $kategoriId ? ($galeryId) : $galeryId, // keep original galeryId
            'kategori_id' => $kategoriId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $foto = DB::table('foto')->where('id', $fotoId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil ditambahkan!',
            'data' => $foto
        ]);
    }

    public function updateFoto(Request $request, $id)
    {
        // Handle JSON request
        if ($request->isJson()) {
            $data = $request->json()->all();
        } else {
            $data = $request->all();
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
            'kategori_id' => 'nullable|exists:kategori,id',
            'galery_id' => 'nullable|exists:galery,id',
        ]);

        // Handle empty string values
        $kategoriId = $request->kategori_id === '' ? null : $request->kategori_id;
        $galeryId = $request->galery_id === '' ? null : $request->galery_id;

        $updateData = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $kategoriId,
            'galery_id' => $galeryId,
            'updated_at' => now(),
        ];

        // Handle file upload if present
        $uploadedFile = $request->file('file') ?? $request->file('foto');

        if ($uploadedFile) {
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

            // Ensure public upload directories exist
            $uploadPath = public_path('uploads/fotos');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $thumbnailDir = public_path('uploads/thumbnails');
            if (!file_exists($thumbnailDir)) {
                mkdir($thumbnailDir, 0755, true);
            }

            // Move file to public/uploads/fotos
            $uploadedFile->move($uploadPath, $fileName);

            $filePath = 'uploads/fotos/' . $fileName;
            $thumbnailPath = 'uploads/thumbnails/' . $fileName;

            @copy(public_path($filePath), public_path($thumbnailPath));

            $updateData['file_path'] = $filePath;
            $updateData['file_name'] = $fileName;
            $updateData['file_size'] = (string) ($uploadedFile->getSize());
            $updateData['file_type'] = $uploadedFile->getMimeType();
            $updateData['thumbnail_path'] = $thumbnailPath;
        } elseif ($request->url) {
            // If URL is provided instead of file
            $updateData['file_path'] = $request->url;
            $updateData['file_name'] = basename(parse_url($request->url, PHP_URL_PATH)) ?: 'remote-image';
            $updateData['file_size'] = '0';
            $updateData['file_type'] = 'url';
            $updateData['thumbnail_path'] = $request->url;
        }

        DB::table('foto')->where('id', $id)->update($updateData);

        $foto = DB::table('foto')->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diperbarui!',
            'data' => $foto
        ]);
    }

    public function destroyFoto($id)
    {
        DB::table('foto')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil dihapus!'
        ]);
    }

    public function getFoto($id)
    {
        $foto = DB::table('foto')->where('id', $id)->first();

        if (!$foto) {
            return response()->json([
                'success' => false,
                'message' => 'Foto tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $foto
        ]);
    }

    // CRUD Operations untuk Kategori
    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategoriId = DB::table('kategori')->insertGetId([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kategori = DB::table('kategori')->where('id', $kategoriId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan!',
            'data' => $kategori
        ]);
    }

    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        DB::table('kategori')->where('id', $id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'updated_at' => now(),
        ]);

        $kategori = DB::table('kategori')->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui!',
            'data' => $kategori
        ]);
    }

    public function destroyKategori($id)
    {
        DB::table('kategori')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus!'
        ]);
    }

    public function getKategori($id)
    {
        $kategori = DB::table('kategori')->where('id', $id)->first();

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $kategori
        ]);
    }

    // CRUD Operations untuk Galery
    public function storeGalery(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $galeryId = DB::table('galery')->insertGetId([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $galery = DB::table('galery')->where('id', $galeryId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil ditambahkan!',
            'data' => $galery
        ]);
    }

    public function updateGalery(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        DB::table('galery')->where('id', $id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'updated_at' => now(),
        ]);

        $galery = DB::table('galery')->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil diperbarui!',
            'data' => $galery
        ]);
    }

    public function destroyGalery($id)
    {
        DB::table('galery')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil dihapus!'
        ]);
    }

    public function getGalery($id)
    {
        $galery = DB::table('galery')->where('id', $id)->first();

        if (!$galery) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $galery
        ]);
    }

    // CRUD Operations untuk Petugas
    public function storePetugas(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
        ]);

        $petugasId = DB::table('petugas')->insertGetId([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $petugas = DB::table('petugas')->where('id', $petugasId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Petugas berhasil ditambahkan!',
            'data' => $petugas
        ]);
    }

    public function updatePetugas(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
        ]);

        DB::table('petugas')->where('id', $id)->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'updated_at' => now(),
        ]);

        $petugas = DB::table('petugas')->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Petugas berhasil diperbarui!',
            'data' => $petugas
        ]);
    }

    public function destroyPetugas($id)
    {
        DB::table('petugas')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Petugas berhasil dihapus!'
        ]);
    }

    public function getPetugas($id)
    {
        $petugas = DB::table('petugas')->where('id', $id)->first();

        if (!$petugas) {
            return response()->json([
                'success' => false,
                'message' => 'Petugas tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $petugas
        ]);
    }

    // Track Gallery Activity
    public function trackActivity(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'foto_id' => 'nullable|integer',
                'user_id' => 'nullable|integer',
                'activity_type' => 'required|string|in:like,comment,report,view,bookmark,share,download',
                'content' => 'nullable|string',
                'comment_id' => 'nullable|integer'
            ]);
            
            // Get IP address and user agent
            $ipAddress = $request->ip();
            $userAgent = $request->userAgent();
            
            // Handle LIKE/UNLIKE - Toggle behavior
            if ($validated['activity_type'] === 'like' && isset($validated['foto_id']) && isset($validated['user_id'])) {
                // Cek apakah user sudah like foto ini
                $existingLike = DB::table('gallery_activities')
                    ->where('foto_id', $validated['foto_id'])
                    ->where('user_id', $validated['user_id'])
                    ->where('activity_type', 'like')
                    ->first();
                
                if ($existingLike) {
                    // UNLIKE - Hapus like yang sudah ada
                    DB::table('gallery_activities')
                        ->where('id', $existingLike->id)
                        ->delete();
                    
                    // Hitung total likes setelah unlike
                    $totalLikes = DB::table('gallery_activities')
                        ->where('foto_id', $validated['foto_id'])
                        ->where('activity_type', 'like')
                        ->count();
                    
                    return response()->json([
                        'success' => true,
                        'action' => 'unliked',
                        'message' => 'Photo unliked successfully',
                        'total_likes' => $totalLikes
                    ]);
                } else {
                    // LIKE - Tambah like baru
                    DB::table('gallery_activities')->insert([
                        'foto_id' => $validated['foto_id'],
                        'user_id' => $validated['user_id'],
                        'activity_type' => 'like',
                        'ip_address' => $ipAddress,
                        'user_agent' => $userAgent,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    
                    // Hitung total likes setelah like
                    $totalLikes = DB::table('gallery_activities')
                        ->where('foto_id', $validated['foto_id'])
                        ->where('activity_type', 'like')
                        ->count();
                    
                    return response()->json([
                        'success' => true,
                        'action' => 'liked',
                        'message' => 'Photo liked successfully',
                        'total_likes' => $totalLikes
                    ]);
                }
            }
            
            // Insert activity to database untuk activity type lainnya
            DB::table('gallery_activities')->insert([
                'foto_id' => $validated['foto_id'] ?? null,
                'user_id' => $validated['user_id'] ?? null,
                'activity_type' => $validated['activity_type'],
                'content' => $validated['content'] ?? null,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Activity tracked successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to track activity: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Remove Gallery Activity (untuk hapus bookmark)
    public function removeActivity(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'foto_id' => 'required|integer',
                'activity_type' => 'required|string|in:like,bookmark'
            ]);
            
            // Get user ID from session
            $userId = session('user_id');
            
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }
            
            // Delete activity from database
            $deleted = DB::table('gallery_activities')
                ->where('foto_id', $validated['foto_id'])
                ->where('user_id', $userId)
                ->where('activity_type', $validated['activity_type'])
                ->delete();
            
            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => ucfirst($validated['activity_type']) . ' removed successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => ucfirst($validated['activity_type']) . ' not found'
                ], 404);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove activity: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Get Comments for a Photo
    public function getComments($fotoId)
    {
        try {
            // Check if parent_id column exists
            $columns = Schema::getColumnListing('gallery_activities');
            $hasParentId = in_array('parent_id', $columns);
            
            // Get parent comments
            $commentsQuery = DB::table('gallery_activities')
                ->leftJoin('users', 'gallery_activities.user_id', '=', 'users.id')
                ->select(
                    'gallery_activities.*',
                    'users.name as user_name',
                    'users.email as user_email'
                )
                ->where('gallery_activities.foto_id', $fotoId)
                ->where('gallery_activities.activity_type', 'comment');
            
            // Only filter by parent_id if column exists
            if ($hasParentId) {
                $commentsQuery->whereNull('gallery_activities.parent_id');
            }
            
            $comments = $commentsQuery->orderBy('gallery_activities.created_at', 'desc')->get();
            
            // Get all replies for these comments (only if parent_id exists)
            $replies = collect();
            if ($hasParentId) {
                $replies = DB::table('gallery_activities')
                    ->leftJoin('users', 'gallery_activities.user_id', '=', 'users.id')
                    ->leftJoin('petugas', 'gallery_activities.user_id', '=', 'petugas.id')
                    ->select(
                        'gallery_activities.*',
                        'users.name as user_name',
                        'petugas.username as admin_name'
                    )
                    ->where('gallery_activities.foto_id', $fotoId)
                    ->where('gallery_activities.activity_type', 'comment')
                    ->whereNotNull('gallery_activities.parent_id')
                    ->orderBy('gallery_activities.created_at', 'asc')
                    ->get()
                    ->groupBy('parent_id');
            }
            
            // Format comments with replies
            $formattedComments = $comments->map(function($comment) use ($replies, $hasParentId) {
                $userName = $comment->user_name ?? 'Anonymous';
                $initials = strtoupper(substr($userName, 0, 2));
                
                // Get replies for this comment (only if parent_id exists)
                $commentReplies = [];
                if ($hasParentId && isset($replies[$comment->id])) {
                    $commentReplies = $replies[$comment->id]->map(function($reply) {
                        $replyUserName = $reply->admin_name ?? $reply->user_name ?? 'Admin';
                        return [
                            'id' => $reply->id,
                            'user' => $replyUserName,
                            'comment' => $reply->content,
                            'time' => \Carbon\Carbon::parse($reply->created_at)->diffForHumans()
                        ];
                    })->toArray();
                }
                
                return [
                    'id' => $comment->id,
                    'user' => $userName,
                    'avatar' => $initials,
                    'comment' => $comment->content,
                    'time' => \Carbon\Carbon::parse($comment->created_at)->diffForHumans(),
                    'replies' => $commentReplies
                ];
            });
            
            return response()->json([
                'success' => true,
                'comments' => $formattedComments
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load comments: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Store Comment
    public function storeComment(Request $request)
    {
        try {
            $validated = $request->validate([
                'foto_id' => 'required|integer',
                'user_id' => 'nullable|integer',
                'content' => 'required|string|max:1000',
                'parent_id' => 'nullable|integer'
            ]);
            
            // Get IP address and user agent
            $ipAddress = $request->ip();
            $userAgent = $request->userAgent();
            
            // Check if parent_id column exists
            $columns = Schema::getColumnListing('gallery_activities');
            $hasParentId = in_array('parent_id', $columns);
            
            // Insert comment to database
            $data = [
                'foto_id' => $validated['foto_id'],
                'user_id' => $validated['user_id'] ?? null,
                'activity_type' => 'comment',
                'content' => $validated['content'],
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'created_at' => now(),
                'updated_at' => now()
            ];
            
            // Add parent_id only if column exists
            if ($hasParentId && isset($validated['parent_id'])) {
                $data['parent_id'] = $validated['parent_id'];
            }
            
            $commentId = DB::table('gallery_activities')->insertGetId($data);
            
            // Get user info
            $user = null;
            if ($validated['user_id']) {
                $user = DB::table('users')->find($validated['user_id']);
            }
            
            $userName = $user->name ?? 'Anonymous';
            $initials = strtoupper(substr($userName, 0, 2));
            
            return response()->json([
                'success' => true,
                'message' => 'Comment posted successfully',
                'comment' => [
                    'id' => $commentId,
                    'user' => $userName,
                    'avatar' => $initials,
                    'comment' => $validated['content'],
                    'time' => 'Baru saja',
                    'replies' => []
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to post comment: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Delete Comment
    public function deleteComment($commentId)
    {
        try {
            // Delete comment from database
            $deleted = DB::table('gallery_activities')
                ->where('id', $commentId)
                ->where('activity_type', 'comment')
                ->delete();
            
            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Comment deleted successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Comment not found'
                ], 404);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete comment: ' . $e->getMessage()
            ], 500);
        }
    }

    // My Bookmarks Page
    public function myBookmarks()
    {
        // Check if user is logged in
        $userId = session('user_id');
        $isLoggedIn = !empty($userId);
        
        if (!$isLoggedIn) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat bookmark');
        }
        
        // Get bookmarked photos
        $bookmarkedPhotos = DB::table('gallery_activities')
            ->join('foto', 'gallery_activities.foto_id', '=', 'foto.id')
            ->leftJoin('kategori', 'foto.kategori_id', '=', 'kategori.id')
            ->select(
                'foto.*',
                'kategori.nama as kategori_nama',
                'gallery_activities.created_at as bookmarked_at'
            )
            ->where('gallery_activities.user_id', $userId)
            ->where('gallery_activities.activity_type', 'bookmark')
            ->orderBy('gallery_activities.created_at', 'desc')
            ->get();
        
        // Get user info
        $userName = session('user_name');
        $userEmail = session('user_email');
        
        return view('gallery.bookmarks', compact('bookmarkedPhotos', 'userName', 'userEmail', 'isLoggedIn', 'userId'));
    }

    // Show User Profile
    public function showUserProfile($userId)
    {
        // Get user data
        $user = DB::table('users')->where('id', $userId)->first();
        
        if (!$user) {
            abort(404, 'User tidak ditemukan');
        }
        
        // Get liked photos
        $likedPhotos = DB::table('gallery_activities')
            ->join('foto', 'gallery_activities.foto_id', '=', 'foto.id')
            ->leftJoin('kategori', 'foto.kategori_id', '=', 'kategori.id')
            ->select('foto.*', 'kategori.nama as kategori_nama')
            ->where('gallery_activities.user_id', $userId)
            ->where('gallery_activities.activity_type', 'like')
            ->orderBy('gallery_activities.created_at', 'desc')
            ->get();
        
        // Add total likes for each photo
        $likedPhotos = $likedPhotos->map(function($foto) {
            $foto->total_likes = DB::table('gallery_activities')
                ->where('foto_id', $foto->id)
                ->where('activity_type', 'like')
                ->count();
            return $foto;
        });
        
        // Get bookmarked photos
        $bookmarkedPhotos = DB::table('gallery_activities')
            ->join('foto', 'gallery_activities.foto_id', '=', 'foto.id')
            ->leftJoin('kategori', 'foto.kategori_id', '=', 'kategori.id')
            ->select('foto.*', 'kategori.nama as kategori_nama')
            ->where('gallery_activities.user_id', $userId)
            ->where('gallery_activities.activity_type', 'bookmark')
            ->orderBy('gallery_activities.created_at', 'desc')
            ->get();
        
        // Add total likes for each photo
        $bookmarkedPhotos = $bookmarkedPhotos->map(function($foto) {
            $foto->total_likes = DB::table('gallery_activities')
                ->where('foto_id', $foto->id)
                ->where('activity_type', 'like')
                ->count();
            return $foto;
        });
        
        // Count stats
        $likesCount = $likedPhotos->count();
        $bookmarksCount = $bookmarkedPhotos->count();
        
        return view('gallery.user-profile', compact('user', 'likedPhotos', 'bookmarkedPhotos', 'likesCount', 'bookmarksCount'));
    }

    // Show Edit Profile Form
    public function editUserProfile()
    {
        // Check if user is logged in
        $userId = session('user_id');
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengedit profil');
        }
        
        // Get user data
        $user = DB::table('users')->where('id', $userId)->first();
        
        if (!$user) {
            abort(404, 'User tidak ditemukan');
        }
        
        return view('gallery.edit-profile', compact('user'));
    }

    // Update User Profile
    public function updateUserProfile(Request $request)
    {
        // Check if user is logged in
        $userId = session('user_id');
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengedit profil');
        }
        
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'bio' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ]);
        
        // Get current user data
        $user = DB::table('users')->where('id', $userId)->first();
        
        // Prepare update data
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now()
        ];
        
        // Only add bio if the column exists in the table
        if (Schema::hasColumn('users', 'bio')) {
            $updateData['bio'] = $request->bio;
        }
        
        // Handle profile photo upload
        if ($request->hasFile('profile_photo') && Schema::hasColumn('users', 'profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Store in storage/app/public/profile_photos
            $path = $file->storeAs('profile_photos', $filename, 'public');
            
            // Delete old photo if exists
            if (isset($user->profile_photo) && $user->profile_photo) {
                $oldPath = storage_path('app/public/' . $user->profile_photo);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            
            $updateData['profile_photo'] = $path;
        }
        
        // Handle password change
        if ($request->filled('current_password') && $request->filled('new_password')) {
            // Verify current password
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai'])->withInput();
            }
            
            $updateData['password'] = Hash::make($request->new_password);
        }
        
        // Update user
        DB::table('users')->where('id', $userId)->update($updateData);
        
        // Update session
        session(['user_name' => $request->name, 'user_email' => $request->email]);
        
        return redirect()->route('user.profile.show', $userId)->with('success', 'Profil berhasil diperbarui!');
    }
}

/* Removed duplicate GalleryController class definition below to prevent parse/redeclare errors. */

/*
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class GalleryController extends Controller
{
    public function index()
    {
        // Ambil data dari semua tabel yang relevan
        $fotos = DB::table('foto')->get();
        $galeries = DB::table('galery')->get();
        $kategoris = DB::table('kategori')->get();
        $petugas = DB::table('petugas')->get();
        $posts = DB::table('posts')->get();
        $profiles = DB::table('profile')->get();

        return view('gallery.index', compact('fotos', 'galeries', 'kategoris', 'petugas', 'posts', 'profiles'));
    }

    public function beranda()
    {
        // Ambil data statistik untuk halaman beranda
        $totalFotos = DB::table('foto')->count();
        $totalKategoris = DB::table('kategori')->count();
        $totalGaleries = DB::table('galery')->count();
        $totalPetugas = DB::table('petugas')->count();
        $recentFotos = DB::table('foto')
            ->orderByDesc('created_at')
            ->limit(12)
            ->get();

        // Catat aktivitas view untuk halaman beranda
        // Setiap kunjungan ke beranda dihitung sebagai 1 view
        DB::table('gallery_activities')->insert([
            'activity_type' => 'view',
            'user_id' => auth()->id() ?? null,
            'foto_id' => null, // View untuk halaman beranda, bukan foto spesifik
            'content' => 'Kunjungan ke halaman beranda',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view('gallery.beranda', compact('totalFotos', 'totalKategoris', 'totalGaleries', 'totalPetugas', 'recentFotos'));
    }

    public function kategori()
    {
        // Ambil data untuk halaman kategori
        $kategoris = DB::table('kategori')->get();

        return view('gallery.kategori', compact('kategoris'));
    }

    public function tim()
    {
        // Ambil data untuk halaman tim
        $petugas = DB::table('petugas')->get();

        return view('gallery.tim', compact('petugas'));
    }

    public function tentang()
    {
        // Ambil data untuk halaman tentang
        $profiles = DB::table('profile')->get();

        return view('gallery.tentang', compact('profiles'));
    }

    public function kontak()
    {
        // Halaman kontak tidak memerlukan data dari database
        return view('gallery.kontak');
    }

    public function jurusanList()
    {
        // Sample data jurusan; bisa diganti ambil dari DB nanti
        $jurusan = [
            [
                'slug' => 'desain-komunikasi-visual',
                'kategori' => 'Kelas Reguler',
                'label' => 'Best Seller',
                'title' => 'Basic Adobe Illustrator: Mastering The Fundamentals',
                'mentor' => 'Brian Christiansen',
                'mentor_title' => 'CoFounder Sekolah Desain ID',
                'thumbnail' => asset('images/kelas-illustrator.jpg'),
                'badge' => 'Ai',
                'color' => '#2D6CDF',
            ],
            [
                'slug' => 'desain-foto-digital',
                'kategori' => 'Kelas Reguler',
                'label' => 'Best Seller',
                'title' => 'Basic Adobe Photoshop: Essential Tools & Photo Editing',
                'mentor' => 'Bintan K. Laela',
                'mentor_title' => 'Freelancer Desain & Arsitektur',
                'thumbnail' => asset('images/kelas-photoshop.jpg'),
                'badge' => 'Ps',
                'color' => '#2563EB',
            ],
            [
                'slug' => 'video-editing',
                'kategori' => 'Kelas Reguler',
                'label' => 'Best Seller',
                'title' => 'Adobe Premiere Pro 102: Learn Professional Video Editing',
                'mentor' => 'Yulita Futty',
                'mentor_title' => 'Professional Video Editor',
                'thumbnail' => asset('images/kelas-premiere.jpg'),
                'badge' => 'Pr',
                'color' => '#7C3AED',
            ],
        ];

        return view('gallery.jurusan', compact('jurusan'));
    }

    public function jurusanShow($slug)
    {
        // Untuk demo, pakai data yang sama dari jurusanList
        $map = collect([
            'desain-komunikasi-visual' => [
                'name' => 'Desain Komunikasi Visual',
                'hero' => asset('images/kelas-illustrator.jpg'),
                'color' => '#2D6CDF',
                'summary' => 'Pelajari dasar-dasar ilustrasi vektor, tools penting, dan workflow profesional untuk menghasilkan karya yang rapi dan scalable.',
                'curriculum' => [
                    'Pengenalan Illustrator & Workspace',
                    'Dasar Vektor: Shape, Path, Anchor',
                    'Typography & Layout',
                    'Color & Gradients',
                    'Export & Best Practices',
                ],
                'mentor' => [
                    'name' => 'Brian Christiansen',
                    'title' => 'CoFounder Sekolah Desain ID',
                    'avatar' => asset('images/mentor-illustrator.jpg'),
                ],
            ],
            // Slug yang dipakai di beranda
            'pplg' => [
                'name' => 'PPLG - Pengembangan Perangkat Lunak dan Gim',
                'hero' => asset('images/jurusan/pplg-logo.jpg'),
                'color' => '#0d6efd',
                'summary' => 'Fokus pemrograman, pengembangan aplikasi web/mobile, dan dasar game dev.',
                'objectives' => [
                    'Mahir logika pemrograman dan OOP',
                    'Mampu membangun aplikasi web dan mobile dasar',
                    'Memahami version control dan kolaborasi Git',
                    'Mengenal pipeline deployment modern',
                ],
                'competencies' => [
                    'Front-end (HTML, CSS, JS)',
                    'Back-end dasar (PHP/Laravel)',
                    'Basis data (MySQL)',
                    'UI/UX dasar',
                ],
                'facilities' => ['Lab RPL modern', 'PC spesifikasi tinggi', 'Akses internet cepat', 'Platform e-learning'],
                'careers' => ['Web Developer', 'Mobile Developer', 'QA Tester', 'UI/UX Designer', 'DevOps Junior'],
                'projects' => ['Website sekolah', 'Aplikasi todo mobile', 'Game 2D sederhana'],
                'duration' => '3 tahun',
                'requirements' => ['Minat teknologi', 'Logika matematika baik', 'Kemauan belajar mandiri'],
                'curriculum' => [
                    'Dasar Pemrograman',
                    'Web Development',
                    'Mobile App Basics',
                    'Database Fundamental',
                    'UI/UX Dasar',
                ],
                'mentor' => [
                    'name' => 'Tim PPLG',
                    'title' => 'Guru Produktif PPLG',
                    'avatar' => asset('images/jurusan/pplg-logo.jpg'),
                ],
            ],
            'tjkt' => [
                'name' => 'TJKT - Teknik Jaringan Komputer dan Telekomunikasi',
                'hero' => asset('images/jurusan/tjkt-logo.jpg'),
                'color' => '#16a34a',
                'summary' => 'Jaringan komputer, server, keamanan siber, dan virtualisasi.',
                'objectives' => [
                    'Menguasai instalasi dan konfigurasi jaringan',
                    'Memahami konsep keamanan jaringan',
                    'Mampu mengelola server Linux/Windows',
                ],
                'competencies' => ['Routing & Switching', 'Subnetting', 'Firewall & VPN', 'Virtualisasi', 'Cloud dasar'],
                'facilities' => ['Lab jaringan', 'Perangkat Cisco/MikroTik', 'Rack server', 'Wi-Fi controller'],
                'careers' => ['Network Admin', 'System Admin', 'NOC Engineer', 'Cybersecurity Analyst'],
                'projects' => ['Simulasi jaringan kampus', 'Deploy server web/file', 'Site-to-site VPN'],
                'duration' => '3 tahun',
                'requirements' => ['Tertarik hardware & jaringan', 'Teliti & tekun', 'Mau praktik langsung'],
                'curriculum' => [
                    'Dasar Jaringan',
                    'Routing & Switching',
                    'Linux Server',
                    'Cybersecurity Dasar',
                    'Virtualisasi & Cloud',
                ],
                'mentor' => [
                    'name' => 'Tim TJKT',
                    'title' => 'Guru Produktif TJKT',
                    'avatar' => asset('images/jurusan/tjkt-logo.jpg'),
                ],
            ],
            'to' => [
                'name' => 'TO - Teknik Otomotif',
                'hero' => asset('images/jurusan/to-logo.jpg'),
                'color' => '#ef4444',
                'summary' => 'Sistem mesin, kelistrikan, diagnostik, dan perawatan kendaraan.',
                'objectives' => [
                    'Mengenal sistem kendaraan modern',
                    'Mampu melakukan diagnostik dasar',
                    'Menerapkan K3 dengan benar',
                ],
                'competencies' => ['Engine', 'Transmisi', 'Brake', 'Electrical', 'Preventive maintenance'],
                'facilities' => ['Bengkel praktik', 'Peralatan OBD', 'Unit kendaraan praktik'],
                'careers' => ['Teknisi Otomotif', 'Service Advisor', 'QC Otomotif'],
                'projects' => ['Tune-up kendaraan', 'Perbaikan sistem rem', 'Diagnostik kelistrikan'],
                'duration' => '3 tahun',
                'requirements' => ['Minat otomotif', 'Fisik sehat', 'Disiplin tinggi'],
                'curriculum' => [
                    'Engine Management',
                    'Transmisi',
                    'Sistem Rem',
                    'Kelistrikan Otomotif',
                    'Diagnostik & Perawatan',
                ],
                'mentor' => [
                    'name' => 'Tim TO',
                    'title' => 'Guru Produktif Otomotif',
                    'avatar' => asset('images/jurusan/to-logo.jpg'),
                ],
            ],
            'tpfl' => [
                'name' => 'TPFL - Teknik Pengelasan Fabrikasi Logam',
                'hero' => asset('images/jurusan/tpfl-logo.jpg'),
                'color' => '#f59e0b',
                'summary' => 'Teknik pengelasan, fabrikasi, pembacaan gambar teknik, dan QC.',
                'objectives' => [
                    'Menguasai teknik pengelasan SMAW/GMAW/GTAW',
                    'Mampu membaca gambar teknik',
                    'Menjaga kualitas hasil las (QC) sesuai standar',
                ],
                'competencies' => ['SMAW/GMAW/GTAW', 'Fabrikasi', 'Gambar teknik', 'Keselamatan kerja'],
                'facilities' => ['Workshop Las', 'Mesin las lengkap', 'Alat keselamatan (APD)'],
                'careers' => ['Welder', 'Fabricator', 'QC Inspector', 'Welding Inspector'],
                'projects' => ['Proyek rangka logam', 'Sertifikasi uji las dasar'],
                'duration' => '3 tahun',
                'requirements' => ['Kesehatan fisik baik', 'Ketelitian tinggi', 'Disiplin keselamatan'],
                'curriculum' => [
                    'SMAW/GMAW/GTAW',
                    'Fabrikasi Logam',
                    'Gambar Teknik',
                    'Keselamatan Kerja',
                    'Quality Control',
                ],
                'mentor' => [
                    'name' => 'Tim TPFL',
                    'title' => 'Guru Produktif TPFL',
                    'avatar' => asset('images/jurusan/tpfl-logo.jpg'),
                ],
            ],
            'desain-foto-digital' => [
                'name' => 'Desain Foto Digital',
                'hero' => asset('images/kelas-photoshop.jpg'),
                'color' => '#2563EB',
                'summary' => 'Kuasi editing foto dasar hingga menengah, retouching, compositing, dan workflow yang efisien di Photoshop.',
                'curriculum' => [
                    'Fundamental Photoshop & Layers',
                    'Selection, Masking & Adjustment',
                    'Retouching & Color Grading',
                    'Compositing & Effects',
                    'Export untuk Web & Print',
                ],
                'mentor' => [
                    'name' => 'Bintan K. Laela',
                    'title' => 'Freelancer Desain & Arsitektur',
                    'avatar' => asset('images/mentor-photoshop.jpg'),
                ],
            ],
            'video-editing' => [
                'name' => 'Video Editing Profesional',
                'hero' => asset('images/kelas-premiere.jpg'),
                'color' => '#7C3AED',
                'summary' => 'Belajar alur kerja lengkap editing video modern, dari import, cut, audio mixing, color, hingga export.',
                'curriculum' => [
                    'Project Setup & Media Management',
                    'Timeline Editing & Transitions',
                    'Audio Mixing & Voiceover',
                    'Color Correction & Grading',
                    'Export & Delivery',
                ],
                'mentor' => [
                    'name' => 'Yulita Futty',
                    'title' => 'Professional Video Editor',
                    'avatar' => asset('images/mentor-premiere.jpg'),
                ],
            ],
        ]);

        $data = $map->get($slug);
        if (!$data) {
            abort(404);
        }

        return view('gallery.jurusan_detail', ['data' => $data, 'slug' => $slug]);
    }

    public function agenda()
    {
        // Ambil data agenda dari database yang statusnya aktif saja
        // Urutkan: agenda yang akan datang (tanggal >= hari ini) di atas, lalu yang sudah selesai di bawah
        $today = now()->toDateString();
        $agendas = DB::table('agenda')
            ->where('status', 'aktif')
            ->orderByRaw("CASE WHEN tanggal >= '{$today}' THEN 0 ELSE 1 END")
            ->orderBy('tanggal', 'asc')
            ->get();
        
        // Pastikan field tanggal & waktu adalah instance Carbon
        $agendas = $agendas->map(function ($agenda) {
            if (isset($agenda->tanggal) && !($agenda->tanggal instanceof Carbon)) {
                $agenda->tanggal = Carbon::parse($agenda->tanggal);
            }
            if (isset($agenda->waktu) && $agenda->waktu && !($agenda->waktu instanceof Carbon)) {
                $agenda->waktu = Carbon::parse($agenda->waktu);
            }
            return $agenda;
        });
        
        // Group agenda berdasarkan tipe jika ada
        $groupedAgendas = $agendas->groupBy('tipe');
        
        // Ambil tipe yang diminta dari query parameter
        $type = request()->query('type');

        return view('gallery.agenda', compact('agendas', 'groupedAgendas', 'type'));
    }

    public function profile()
    {
        // Data profil sederhana; bisa diambil dari DB jika ada
        return view('gallery.profile');
    }

    public function dashboard()
    {
        // Ambil data statistik untuk dashboard
        $totalFotos = DB::table('foto')->count();
        $totalKategoris = DB::table('kategori')->count();
        $totalGaleries = DB::table('galery')->count();
        $totalPetugas = DB::table('petugas')->count();

        return view('gallery.dashboard', compact('totalFotos', 'totalKategoris', 'totalGaleries', 'totalPetugas'));
    }

    public function show($id)
    {
        // Tampilkan detail foto berdasarkan ID
        $foto = DB::table('foto')->where('id', $id)->first();
        
        if (!$foto) {
            abort(404, 'Foto tidak ditemukan');
        }

        return view('gallery.show', compact('foto'));
    }

    // CRUD Operations untuk Foto
    public function storeFoto(Request $request)
    {
        // Handle JSON request
        if ($request->isJson()) {
            $data = $request->json()->all();
        } else {
            $data = $request->all();
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'foto' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'url' => 'nullable|url',
            'kategori_id' => 'nullable|exists:kategori,id',
            'galery_id' => 'nullable|exists:galery,id',
        ]);

        // Handle empty string values
        $kategoriId = $request->kategori_id === '' ? null : $request->kategori_id;
        $galeryId = $request->galery_id === '' ? null : $request->galery_id;

        $filePath = null;
        $thumbnailPath = null;
        $fileName = null;
        $fileSize = null;
        $fileType = null;

        // Support both 'file' and 'foto' field names
        $uploadedFile = $request->file('file') ?? $request->file('foto');

        if ($uploadedFile) {
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
            $fileSize = (string) $uploadedFile->getSize();
            $fileType = $uploadedFile->getMimeType();

            // Ensure public upload directories exist
            $uploadPath = public_path('uploads/fotos');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $thumbnailDir = public_path('uploads/thumbnails');
            if (!file_exists($thumbnailDir)) {
                mkdir($thumbnailDir, 0755, true);
            }

            // Move file to public/uploads/fotos
            $uploadedFile->move($uploadPath, $fileName);

            $filePath = 'uploads/fotos/' . $fileName;
            $thumbnailPath = 'uploads/thumbnails/' . $fileName;

            // For now, copy original as thumbnail
            @copy(public_path($filePath), public_path($thumbnailPath));
        } elseif ($request->url) {
            // If URL is provided instead of file
            $filePath = $request->url;
            $thumbnailPath = $request->url;
            $fileName = basename(parse_url($request->url, PHP_URL_PATH)) ?: 'remote-image';
            $fileSize = '0';
            $fileType = 'url';
        } else {
            // Use placeholder if no file or URL
            $filePath = 'https://via.placeholder.com/400x300?text=Photo';
            $thumbnailPath = 'https://via.placeholder.com/400x300?text=Photo';
            $fileName = 'placeholder.png';
            $fileSize = '0';
            $fileType = 'image/png';
        }

        $fotoId = DB::table('foto')->insertGetId([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_size' => $fileSize,
            'file_type' => $fileType,
            'thumbnail_path' => $thumbnailPath,
            'galery_id' => $kategoriId ? ($galeryId) : $galeryId, // keep original galeryId
            'kategori_id' => $kategoriId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $foto = DB::table('foto')->where('id', $fotoId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil ditambahkan!',
            'data' => $foto
        ]);
    }

    public function updateFoto(Request $request, $id)
    {
        // Handle JSON request
        if ($request->isJson()) {
            $data = $request->json()->all();
        } else {
            $data = $request->all();
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
            'kategori_id' => 'nullable|exists:kategori,id',
            'galery_id' => 'nullable|exists:galery,id',
        ]);

        // Handle empty string values
        $kategoriId = $request->kategori_id === '' ? null : $request->kategori_id;
        $galeryId = $request->galery_id === '' ? null : $request->galery_id;

        $updateData = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $kategoriId,
            'galery_id' => $galeryId,
            'updated_at' => now(),
        ];

        // Handle file upload if present
        $uploadedFile = $request->file('file') ?? $request->file('foto');

        if ($uploadedFile) {
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

            // Ensure public upload directories exist
            $uploadPath = public_path('uploads/fotos');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $thumbnailDir = public_path('uploads/thumbnails');
            if (!file_exists($thumbnailDir)) {
                mkdir($thumbnailDir, 0755, true);
            }

            // Move file to public/uploads/fotos
            $uploadedFile->move($uploadPath, $fileName);

            $filePath = 'uploads/fotos/' . $fileName;
            $thumbnailPath = 'uploads/thumbnails/' . $fileName;

            @copy(public_path($filePath), public_path($thumbnailPath));

            $updateData['file_path'] = $filePath;
            $updateData['file_name'] = $fileName;
            $updateData['file_size'] = (string) ($uploadedFile->getSize());
            $updateData['file_type'] = $uploadedFile->getMimeType();
            $updateData['thumbnail_path'] = $thumbnailPath;
        } elseif ($request->url) {
            // If URL is provided instead of file
            $updateData['file_path'] = $request->url;
            $updateData['file_name'] = basename(parse_url($request->url, PHP_URL_PATH)) ?: 'remote-image';
            $updateData['file_size'] = '0';
            $updateData['file_type'] = 'url';
            $updateData['thumbnail_path'] = $request->url;
        }

        DB::table('foto')->where('id', $id)->update($updateData);

        $foto = DB::table('foto')->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diperbarui!',
            'data' => $foto
        ]);
    }

    public function destroyFoto($id)
    {
        DB::table('foto')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil dihapus!'
        ]);
    }

    public function getFoto($id)
    {
        $foto = DB::table('foto')->where('id', $id)->first();

        if (!$foto) {
            return response()->json([
                'success' => false,
                'message' => 'Foto tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $foto
        ]);
    }

    // CRUD Operations untuk Kategori
    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategoriId = DB::table('kategori')->insertGetId([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kategori = DB::table('kategori')->where('id', $kategoriId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan!',
            'data' => $kategori
        ]);
    }

    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        DB::table('kategori')->where('id', $id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'updated_at' => now(),
        ]);

        $kategori = DB::table('kategori')->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui!',
            'data' => $kategori
        ]);
    }

    public function destroyKategori($id)
    {
        DB::table('kategori')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus!'
        ]);
    }

    public function getKategori($id)
    {
        $kategori = DB::table('kategori')->where('id', $id)->first();

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $kategori
        ]);
    }

    // CRUD Operations untuk Galery
    public function storeGalery(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $galeryId = DB::table('galery')->insertGetId([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $galery = DB::table('galery')->where('id', $galeryId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil ditambahkan!',
            'data' => $galery
        ]);
    }

    public function updateGalery(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        DB::table('galery')->where('id', $id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'updated_at' => now(),
        ]);

        $galery = DB::table('galery')->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil diperbarui!',
            'data' => $galery
        ]);
    }

    public function destroyGalery($id)
    {
        DB::table('galery')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil dihapus!'
        ]);
    }

    public function getGalery($id)
    {
        $galery = DB::table('galery')->where('id', $id)->first();

        if (!$galery) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $galery
        ]);
    }

    // CRUD Operations untuk Petugas
    public function storePetugas(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
        ]);

        $petugasId = DB::table('petugas')->insertGetId([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $petugas = DB::table('petugas')->where('id', $petugasId)->first();

        return response()->json([
            'success' => true,
            'message' => 'Petugas berhasil ditambahkan!',
            'data' => $petugas
        ]);
    }

    public function updatePetugas(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
        ]);

        DB::table('petugas')->where('id', $id)->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'updated_at' => now(),
        ]);

        $petugas = DB::table('petugas')->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Petugas berhasil diperbarui!',
            'data' => $petugas
        ]);
    }

    public function destroyPetugas($id)
    {
        DB::table('petugas')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Petugas berhasil dihapus!'
        ]);
    }

    public function getPetugas($id)
    {
        $petugas = DB::table('petugas')->where('id', $id)->first();

        if (!$petugas) {
            return response()->json([
                'success' => false,
                'message' => 'Petugas tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $petugas
        ]);
    }
*/
