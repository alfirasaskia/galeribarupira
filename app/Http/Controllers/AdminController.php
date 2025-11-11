<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware akan diterapkan di routes
    }

    /**
     * Ensure storage link exists
     */
    private function ensureStorageLink()
    {
        $target = storage_path('app/public');
        $link = public_path('storage');

        // Check if link already exists
        if (!file_exists($link)) {
            try {
                // For Windows
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                    // Create junction on Windows
                    $target = str_replace('/', '\\', $target);
                    $link = str_replace('/', '\\', $link);
                    exec("mklink /J \"$link\" \"$target\"");
                } else {
                    // Create symlink on Unix/Linux
                    symlink($target, $link);
                }
            } catch (\Exception $e) {
                // If symlink fails, try to create directory and copy
                if (!file_exists($link)) {
                    mkdir($link, 0755, true);
                }
            }
        }
    }

    // Show login form - KHUSUS ADMIN
    public function showLogin()
    {
        // Jika sudah login, redirect ke dashboard
        if (session('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        
        // Tampilkan halaman login admin (bukan redirect)
        return view('admin.login');
    }

    // Show register form
    public function showRegister()
    {
        // Jika sudah login, redirect ke dashboard
        if (session('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.register');
    }

    // Process registration
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:petugas,username',
            'email' => 'required|email|unique:petugas,email',
            'password' => 'required|min:6|confirmed'
        ], [
            'nama.required' => 'Nama lengkap harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok'
        ]);
        
        // Insert new admin/petugas
        $petugasId = DB::table('petugas')->insertGetId([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        // Auto login after registration
        session([
            'admin_id' => $petugasId,
            'admin_name' => $request->nama,
            'admin_email' => $request->email,
            'user_type' => 'admin'
        ]);
        
        return redirect()->route('admin.petugas.index')->with('success', 'Registrasi berhasil! Data petugas telah ditambahkan.');
    }

    // Process login - KHUSUS ADMIN
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);
        
        // Cari admin berdasarkan username atau email di tabel petugas
        $admin = DB::table('petugas')
            ->where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // Login berhasil - set session admin
            session([
                'admin_id' => $admin->id,
                'admin_name' => $admin->nama,
                'admin_email' => $admin->email,
                'user_type' => 'admin'
            ]);
            
            // Admin SELALU redirect ke dashboard
            return redirect()->route('admin.dashboard')->with('success', 'Login admin berhasil!');
        }
        
        // Demo admin credentials
        if ($request->username === 'admin' && $request->password === 'admin123') {
            session([
                'admin_id' => 1,
                'admin_name' => 'Admin Demo',
                'admin_email' => 'admin@example.com',
                'user_type' => 'admin'
            ]);
            
            return redirect()->route('admin.dashboard')->with('success', 'Login demo admin berhasil!');
        }
        
        return back()->withErrors(['username' => 'Username/Email atau password admin salah'])->withInput();
    }
    
    // Logout
    public function logout()
    {
        Session::flush();
        return redirect()->route('gallery.beranda')->with('success', 'Logout berhasil!');
    }
    
    // Dashboard
    public function dashboard()
    {
        // Check if admin is logged in
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }
        
        // Get admin data
        $admin = DB::table('petugas')
            ->where('id', session('admin_id'))
            ->first();

        // Get statistics dengan error handling
        try {
            $totalPhotos = DB::table('foto')->count();
            $totalCategories = DB::table('kategori')->count();
            $totalAgenda = DB::table('agenda')->count();
            $totalSuggestions = DB::table('suggestions')->count();
            $totalPetugas = DB::table('petugas')->count();
            $totalBerita = DB::table('news')->count();
            // Get unread suggestions count for notification badge
            $unreadCount = DB::table('suggestions')->where('status', 'pending')->count();
        } catch (\Exception $e) {
            // Jika tabel belum ada, set default values
            $totalPhotos = 0;
            $totalCategories = 0;
            $totalAgenda = 0;
            $totalSuggestions = 0;
            $totalPetugas = 0;
            $totalBerita = 0;
            $unreadCount = 0;
        }
        
        return view('admin.dashboard', compact('admin', 'totalPhotos', 'totalCategories', 'totalAgenda', 'totalSuggestions', 'totalPetugas', 'totalBerita', 'unreadCount'));
    }
    
    public function index()
    {
        // Get reporting statistics
        $reportStats = [
            'total_reports' => DB::table('reports')->count(),
            'pending_reports' => DB::table('reports')->where('status', 'pending')->count(),
            'resolved_reports' => DB::table('reports')->where('status', 'resolved')->count(),
            'rejected_reports' => DB::table('reports')->where('status', 'rejected')->count(),
        ];

        // Get recent reports with photo info
        $reports = DB::table('reports')
            ->leftJoin('fotos', 'reports.foto_id', '=', 'fotos.id')
            ->leftJoin('kategoris', 'fotos.kategori_id', '=', 'kategoris.id')
            ->select(
                'reports.*',
                'fotos.judul as foto_judul',
                'fotos.file_path as foto_path',
                'kategoris.nama as kategori_nama'
            )
            ->orderBy('reports.created_at', 'desc')
            ->paginate(10);

        return view('admin.index', compact('reportStats', 'reports'));
    }

    public function updateReportStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,resolved,rejected'
        ]);

        DB::table('reports')
            ->where('id', $id)
            ->update([
                'status' => $request->status,
                'admin_notes' => $request->admin_notes,
                'updated_at' => now()
            ]);

        return response()->json(['success' => true, 'message' => 'Status laporan berhasil diperbarui']);
    }

    public function deleteReport($id)
    {
        DB::table('reports')->where('id', $id)->delete();
        
        return response()->json(['success' => true, 'message' => 'Laporan berhasil dihapus']);
    }
    
    // Photos Management
    public function photosIndex()
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }

        try {
            $photos = DB::table('foto')
                ->leftJoin('kategori', 'foto.kategori_id', '=', 'kategori.id')
                ->leftJoin('galery', 'foto.galery_id', '=', 'galery.id')
                ->select('foto.*', 'kategori.nama as kategori_nama', 'galery.nama as galery_nama')
                ->orderBy('foto.created_at', 'desc')
                ->paginate(20);
                
            // Get categories for modal
            $categories = DB::table('kategori')->get();
        } catch (\Exception $e) {
            // Jika error, buat paginator kosong
            $photos = new \Illuminate\Pagination\LengthAwarePaginator(
                [],
                0,
                20,
                1,
                ['path' => request()->url()]
            );
            $categories = collect();
        }
        
        $admin = DB::table('petugas')->where('id', session('admin_id'))->first();
        
        // Statistics
        try {
            $totalPhotos = DB::table('foto')->count();
            $totalCategories = DB::table('kategori')->count();
            $totalGalleries = DB::table('galery')->count();
            
            // Additional statistics for overview
            $photosWithCategory = DB::table('foto')->whereNotNull('kategori_id')->count();
            $photosThisWeek = DB::table('foto')->where('created_at', '>=', now()->subWeek())->count();
            $photosThisMonth = DB::table('foto')->where('created_at', '>=', now()->subMonth())->count();
        } catch (\Exception $e) {
            $totalPhotos = 0;
            $totalCategories = 0;
            $totalGalleries = 0;
            $photosWithCategory = 0;
            $photosThisWeek = 0;
            $photosThisMonth = 0;
        }
        
        return view('admin.photos.index', compact('photos', 'admin', 'categories', 'totalPhotos', 'totalCategories', 'totalGalleries', 'photosWithCategory', 'photosThisWeek', 'photosThisMonth'));
    }
    
    public function photosCreate()
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }
        
        $admin = DB::table('petugas')->where('id', session('admin_id'))->first();
        $categories = DB::table('kategori')->get();
        $galleries = DB::table('galery')->get();
        
        return view('admin.photos.create', compact('admin', 'categories', 'galleries'));
    }
    
    public function photosStore(Request $request)
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }

        // Create storage link if not exists
        $this->ensureStorageLink();

        try {
            // Validasi input
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'kategori_id' => 'required|exists:kategori,id',
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // max 10MB
            ]);

            // Upload file
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Ensure photos directory exists
                $photosDir = storage_path('app/public/photos');
                if (!file_exists($photosDir)) {
                    mkdir($photosDir, 0755, true);
                }
                
                // Store file directly to ensure it's saved
                $path = $file->storeAs('photos', $filename, 'public');
                
                // Verify file was actually saved
                $fullPath = storage_path('app/public/' . $path);
                if (!file_exists($fullPath)) {
                    // Try alternative save method
                    $content = file_get_contents($file->getRealPath());
                    if (!file_put_contents($fullPath, $content)) {
                        throw new \Exception('File gagal disimpan ke storage (storeAs dan file_put_contents gagal)');
                    }
                }

                // Get file information
                $fileSize = $file->getSize(); // in bytes
                $fileType = $file->getMimeType(); // Get MIME type

                // Get or create default gallery
                $defaultGallery = DB::table('galery')->first();
                
                // If no gallery exists, create a default one
                if (!$defaultGallery) {
                    $galeryId = DB::table('galery')->insertGetId([
                        'nama' => 'Galeri Default',
                        'deskripsi' => 'Galeri default untuk foto',
                        'user_id' => session('admin_id'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    $galeryId = $defaultGallery->id;
                }

                // Insert ke database - dengan semua field yang required
                DB::table('foto')->insert([
                    'judul' => $request->judul,
                    'deskripsi' => $request->deskripsi,
                    'kategori_id' => $request->kategori_id,
                    'galery_id' => $galeryId,
                    'file_path' => $path,
                    'file_name' => $filename,
                    'file_size' => $fileSize,
                    'file_type' => $fileType,
                    'user_id' => session('admin_id'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect()->route('admin.photos.index')->with('success', 'Foto berhasil ditambahkan!');
            }

            return back()->with('error', 'File foto tidak ditemukan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan foto: ' . $e->getMessage())->withInput();
        }
    }
    
    public function photosEdit($id)
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }
        
        $admin = DB::table('petugas')->where('id', session('admin_id'))->first();
        $photo = DB::table('foto')->where('id', $id)->first();
        
        if (!$photo) {
            return redirect()->route('admin.photos.index')->with('error', 'Foto tidak ditemukan!');
        }
        
        $categories = DB::table('kategori')->get();
        $galleries = DB::table('galery')->get();
        
        return view('admin.photos.edit', compact('admin', 'photo', 'categories', 'galleries'));
    }
    
    public function photosUpdate(Request $request, $id)
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }

        try {
            // Validasi input
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'kategori_id' => 'required|exists:kategori,id',
                'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // max 10MB
            ]);

            // Get existing photo data
            $photo = DB::table('foto')->where('id', $id)->first();
            
            if (!$photo) {
                return redirect()->route('admin.photos.index')->with('error', 'Foto tidak ditemukan!');
            }

            $updateData = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'kategori_id' => $request->kategori_id,
                'updated_at' => now(),
            ];

            // Upload new file if provided
            if ($request->hasFile('file')) {
                // Create storage link if not exists
                $this->ensureStorageLink();
                
                // Ensure photos directory exists
                $photosDir = storage_path('app/public/photos');
                if (!file_exists($photosDir)) {
                    mkdir($photosDir, 0755, true);
                }
                
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('photos', $filename, 'public');
                
                // Verify file was actually saved
                $fullPath = storage_path('app/public/' . $path);
                if (!file_exists($fullPath)) {
                    // Try alternative save method
                    $content = file_get_contents($file->getRealPath());
                    if (!file_put_contents($fullPath, $content)) {
                        throw new \Exception('File gagal disimpan ke storage (storeAs dan file_put_contents gagal)');
                    }
                }

                // Get file information
                $fileSize = $file->getSize();
                $fileType = $file->getMimeType();

                // Delete old file
                if ($photo->file_path) {
                    $oldFilePath = storage_path('app/public/' . $photo->file_path);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // Update file data
                $updateData['file_path'] = $path;
                $updateData['file_name'] = $filename;
                $updateData['file_size'] = $fileSize;
                $updateData['file_type'] = $fileType;
            }

            // Update database
            DB::table('foto')->where('id', $id)->update($updateData);

            return redirect()->route('admin.photos.index')->with('success', 'Foto berhasil diupdate!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupdate foto: ' . $e->getMessage())->withInput();
        }
    }
    
    public function photosDelete($id)
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }

        try {
            // Get photo data
            $photo = DB::table('foto')->where('id', $id)->first();
            
            if (!$photo) {
                return redirect()->route('admin.photos.index')->with('error', 'Foto tidak ditemukan!');
            }

            // Delete physical file
            if ($photo->file_path) {
                $filePath = storage_path('app/public/' . $photo->file_path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Delete from database
            DB::table('foto')->where('id', $id)->delete();
            
            // Delete related activities
            DB::table('gallery_activities')->where('foto_id', $id)->delete();

            return redirect()->route('admin.photos.index')->with('success', 'Foto berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.photos.index')->with('error', 'Gagal menghapus foto: ' . $e->getMessage());
        }
    }
    
    // Categories Management
    public function categoriesIndex()
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }
        
        try {
            // Get all categories
            $categoriesData = DB::table('kategori')
                ->orderBy('created_at', 'desc')
                ->get();
            
            // Add photo count to each category
            foreach ($categoriesData as $category) {
                $category->fotos_count = DB::table('foto')
                    ->where('kategori_id', $category->id)
                    ->count();
            }
            
            // Manual pagination
            $perPage = 20;
            $currentPage = request()->get('page', 1);
            $offset = ($currentPage - 1) * $perPage;
            
            $paginatedData = $categoriesData->slice($offset, $perPage)->values();
            
            $categories = new \Illuminate\Pagination\LengthAwarePaginator(
                $paginatedData,
                $categoriesData->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        } catch (\Exception $e) {
            \Log::error('Categories Index Error: ' . $e->getMessage());
            $categories = new \Illuminate\Pagination\LengthAwarePaginator(
                [],
                0,
                20,
                1,
                ['path' => request()->url()]
            );
        }
        
        $admin = DB::table('petugas')->where('id', session('admin_id'))->first();
        
        return view('admin.categories.index', compact('categories', 'admin'));
    }

    public function categoriesCreate()
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }
        
        $admin = DB::table('petugas')->where('id', session('admin_id'))->first();
        
        return view('admin.categories.create', compact('admin'));
    }

    public function categoriesStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);
        
        DB::table('kategori')->insert([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function categoriesEdit($id)
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }
        
        $admin = DB::table('petugas')->where('id', session('admin_id'))->first();
        $category = DB::table('kategori')->where('id', $id)->first();
        
        return view('admin.categories.edit', compact('admin', 'category'));
    }

    public function categoriesUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);
        
        DB::table('kategori')->where('id', $id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diupdate!');
    }

    public function categoriesDestroy($id)
    {
        DB::table('kategori')->where('id', $id)->delete();
        
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
    
    // Agenda Management
    public function agendaIndex()
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }
        
        try {
            $agendas = DB::table('agenda')
                ->orderBy('tanggal', 'desc')
                ->get();
                
            // Group agendas by month - using array grouping
            $groupedAgendas = [];
            foreach ($agendas as $item) {
                $monthKey = \Carbon\Carbon::parse($item->tanggal)->format('F Y');
                if (!isset($groupedAgendas[$monthKey])) {
                    $groupedAgendas[$monthKey] = [];
                }
                $groupedAgendas[$monthKey][] = $item;
            }
            $groupedAgendas = collect($groupedAgendas);
        } catch (\Exception $e) {
            $agendas = collect();
            $groupedAgendas = collect();
        }
        
        $admin = DB::table('petugas')->where('id', session('admin_id'))->first();
        
        // Statistics
        try {
            $totalAgendas = DB::table('agenda')->count();
            $agendasThisWeek = DB::table('agenda')->where('tanggal', '>=', now()->subWeek())->count();
            $agendasThisMonth = DB::table('agenda')->where('tanggal', '>=', now()->subMonth())->count();
        } catch (\Exception $e) {
            $totalAgendas = 0;
            $agendasThisWeek = 0;
            $agendasThisMonth = 0;
        }
        
        return view('admin.agenda.index', compact('agendas', 'groupedAgendas', 'admin', 'totalAgendas', 'agendasThisWeek', 'agendasThisMonth'));
    }
    
    public function agendaCreate()
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }
        
        $admin = DB::table('petugas')->where('id', session('admin_id'))->first();
        
        return view('admin.agenda.create', compact('admin'));
    }

    public function agendaStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string',
            'status' => 'required|in:aktif,draft,selesai'
        ]);
        
        DB::table('agenda')->insert([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil ditambahkan!');
    }

    public function agendaShow($id)
    {
        $agenda = DB::table('agenda')->where('id', $id)->first();
        
        if (!$agenda) {
            return response()->json(['error' => 'Agenda tidak ditemukan'], 404);
        }
        
        return response()->json($agenda);
    }

    public function agendaEdit($id)
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }

        $admin = DB::table('petugas')->where('id', session('admin_id'))->first();
        $agenda = DB::table('agenda')->where('id', $id)->first();
        
        return view('admin.agenda.edit', compact('admin', 'agenda'));
    }

    public function agendaUpdate(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string',
            'status' => 'required|in:aktif,draft,selesai'
        ]);
        
        DB::table('agenda')->where('id', $id)->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
            'updated_at' => now()
        ]);
        
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil diupdate!');
    }

    public function agendaDestroy($id)
    {
        DB::table('agenda')->where('id', $id)->delete();
        
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil dihapus!');
    }
    
    public function agendaToggleStatus(Request $request, $id)
    {
        $status = $request->input('status');
        
        DB::table('agenda')
            ->where('id', $id)
            ->update(['status' => $status]);
        
        return response()->json(['success' => true, 'status' => $status]);
    }
    
    // Suggestions Management
    public function suggestionsIndex()
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }
        
        try {
            $suggestions = DB::table('suggestions')
                ->orderBy('created_at', 'desc')
                ->get();
                
            // Add status_label to each suggestion
            $suggestions = $suggestions->map(function($suggestion) {
                $statusLabels = [
                    'pending' => 'Belum Dibaca',
                    'read' => 'Sudah Dibaca',
                    'approved' => 'Disetujui (Tampil di Testimoni)',
                    'rejected' => 'Ditolak'
                ];
                $suggestion->status_label = $statusLabels[$suggestion->status] ?? 'Tidak Diketahui';
                return $suggestion;
            });
            
            // Paginate manually
            $perPage = 20;
            $currentPage = request()->get('page', 1);
            $offset = ($currentPage - 1) * $perPage;
            $itemsForCurrentPage = $suggestions->slice($offset, $perPage)->values();
            $suggestions = new \Illuminate\Pagination\LengthAwarePaginator(
                $itemsForCurrentPage,
                $suggestions->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
                
            // Statistics
            $totalSuggestions = DB::table('suggestions')->count();
            $unreadCount = DB::table('suggestions')->where('status', 'pending')->count();
            // Sudah Dibaca = read + approved + rejected (semua yang sudah diproses)
            $readCount = DB::table('suggestions')->whereIn('status', ['read', 'approved', 'rejected'])->count();
            $approvedCount = DB::table('suggestions')->where('status', 'approved')->count();
            $rejectedCount = DB::table('suggestions')->where('status', 'rejected')->count();
        } catch (\Exception $e) {
            $suggestions = new \Illuminate\Pagination\LengthAwarePaginator(
                [],
                0,
                20,
                1,
                ['path' => request()->url()]
            );
            $totalSuggestions = 0;
            $unreadCount = 0;
            $readCount = 0;
            $approvedCount = 0;
            $rejectedCount = 0;
        }
        
        $admin = DB::table('petugas')->where('id', session('admin_id'))->first();
        
        return view('admin.suggestions.index', compact('suggestions', 'admin', 'totalSuggestions', 'unreadCount', 'readCount', 'approvedCount', 'rejectedCount'));
    }
    
    public function suggestionsShow($id)
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }
        
        $admin = DB::table('petugas')->where('id', session('admin_id'))->first();
        $suggestion = DB::table('suggestions')->where('id', $id)->first();
        
        // Get unread count for badge
        $unreadCount = DB::table('suggestions')
            ->where('status', 'pending')
            ->count();
        
        if ($suggestion) {
            // Mark as read if status is pending
            if ($suggestion->status === 'pending') {
                DB::table('suggestions')
                    ->where('id', $id)
                    ->update([
                        'status' => 'read',
                        'updated_at' => now()
                    ]);
                $suggestion->status = 'read';
            }
            
            // Add status_label
            $statusLabels = [
                'pending' => 'Menunggu',
                'read' => 'Sudah Dibaca',
                'replied' => 'Sudah Dibalas',
                'resolved' => 'Selesai',
                'rejected' => 'Ditolak'
            ];
            $suggestion->status_label = $statusLabels[$suggestion->status] ?? 'Tidak Diketahui';
        }
        
        return view('admin.suggestions.show', compact('admin', 'suggestion', 'unreadCount'));
    }
    
    public function suggestionsStore(Request $request)
    {
        // Log untuk debugging
        \Log::info('Form submission received', [
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'has_recaptcha' => $request->has('g-recaptcha-response')
        ]);
        
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email',
            'pesan' => 'required|string',
            'g-recaptcha-response' => 'required'
        ], [
            'g-recaptcha-response.required' => 'Verifikasi reCAPTCHA diperlukan.'
        ]);

        // Verifikasi Google reCAPTCHA v3
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $secretKey = env('RECAPTCHA_SECRET_KEY');
        $isLocal = app()->environment('local')
            || in_array($request->ip(), ['127.0.0.1', '::1'])
            || str_contains($request->getHost(), '127.0.0.1')
            || str_contains($request->getHost(), 'localhost');
        
        // Log secret key status (jangan log key asli untuk keamanan)
        \Log::info('reCAPTCHA verification', [
            'has_secret_key' => !empty($secretKey),
            'token_length' => strlen($recaptchaResponse)
        ]);
        
        // Jika tidak ada secret key ATAU sedang di lingkungan lokal, skip verifikasi (untuk pengembangan lokal)
        if (empty($secretKey) || $isLocal) {
            \Log::warning('RECAPTCHA_SECRET_KEY not set in .env, skipping verification');
            
            DB::table('suggestions')->insert([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'pesan' => $request->pesan,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            return redirect()->route('gallery.beranda')->with('success', 'Terima kasih! Pesan Anda berhasil dikirim dan akan ditampilkan di testimoni setelah disetujui admin.');
        }
        
        $verifyResponse = \Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip()
        ]);

        $recaptchaResult = $verifyResponse->json();
        
        // Log hasil verifikasi
        \Log::info('reCAPTCHA result', [
            'success' => $recaptchaResult['success'] ?? false,
            'score' => $recaptchaResult['score'] ?? 0,
            'error_codes' => $recaptchaResult['error-codes'] ?? []
        ]);
        
        // reCAPTCHA v3 validation with score threshold
        if (!isset($recaptchaResult['success']) || !$recaptchaResult['success']) {
            \Log::error('reCAPTCHA verification failed', $recaptchaResult);
            // Jika verifikasi gagal tetapi lingkungan lokal, tetap izinkan untuk keperluan pengembangan
            if ($isLocal) {
                DB::table('suggestions')->insert([
                    'nama_lengkap' => $request->nama_lengkap,
                    'email' => $request->email,
                    'pesan' => $request->pesan,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                return redirect()->route('gallery.beranda')->with('success', 'Terima kasih! Pesan Anda berhasil dikirim dan akan ditampilkan di testimoni setelah disetujui admin.');
            }
            return back()->withErrors(['recaptcha' => 'Verifikasi reCAPTCHA gagal, coba lagi.'])->withInput();
        }
        
        // Check score (v3 returns score 0.0 - 1.0, higher is more likely human)
        // Threshold 0.3 untuk localhost (lebih rendah dari 0.5 untuk testing)
        $score = $recaptchaResult['score'] ?? 0;
        if ($score < 0.3 && !$isLocal) {
            \Log::warning('reCAPTCHA score too low', ['score' => $score]);
            return back()->withErrors(['recaptcha' => 'Verifikasi keamanan gagal. Score: ' . $score . '. Silakan coba lagi.'])->withInput();
        }
        
        DB::table('suggestions')->insert([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'pesan' => $request->pesan,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        \Log::info('Suggestion saved successfully');
        
        return redirect()->route('gallery.beranda')->with('success', 'Terima kasih! Pesan Anda berhasil dikirim dan akan ditampilkan di testimoni setelah disetujui admin.');
    }
    
    public function suggestionsDestroy($id)
    {
        DB::table('suggestions')->where('id', $id)->delete();
        
        return redirect()->route('admin.suggestions')->with('success', 'Saran berhasil dihapus!');
    }
    
    public function suggestionsUpdateStatus(Request $request, $id)
    {
        if (!session('admin_id')) {
            return redirect()->route('admin.suggestions')->with('error', 'Unauthorized');
        }
        
        $status = $request->input('status');
        
        // Validate status
        $validStatuses = ['pending', 'read', 'approved', 'rejected'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->route('admin.suggestions')->with('error', 'Status tidak valid');
        }
        
        // Check if suggestion exists
        $suggestion = DB::table('suggestions')->where('id', $id)->first();
        if (!$suggestion) {
            return redirect()->route('admin.suggestions')->with('error', 'Saran tidak ditemukan');
        }
        
        // Update status
        DB::table('suggestions')->where('id', $id)->update([
            'status' => $status,
            'updated_at' => now()
        ]);
        
        // Get status label
        $statusLabels = [
            'pending' => 'Belum Dibaca',
            'read' => 'Sudah Dibaca',
            'approved' => 'Disetujui (Tampil di Testimoni)',
            'rejected' => 'Ditolak'
        ];
        
        return redirect()->route('admin.suggestions')->with('success', 'Status berhasil diubah menjadi: ' . $statusLabels[$status]);
    }
    
    public function suggestionsUpdateMultipleStatus(Request $request, $id)
    {
        if (!session('admin_id')) {
            return redirect()->route('admin.suggestions')->with('error', 'Unauthorized');
        }
        
        $statuses = $request->input('statuses', []);
        
        if (empty($statuses)) {
            return redirect()->route('admin.suggestions')->with('error', 'Silakan pilih minimal 1 status');
        }
        
        // Check if suggestion exists
        $suggestion = DB::table('suggestions')->where('id', $id)->first();
        if (!$suggestion) {
            return redirect()->route('admin.suggestions')->with('error', 'Saran tidak ditemukan');
        }
        
        // Validate statuses
        $validStatuses = ['pending', 'read', 'approved', 'rejected'];
        foreach ($statuses as $status) {
            if (!in_array($status, $validStatuses)) {
                return redirect()->route('admin.suggestions')->with('error', 'Status tidak valid');
            }
        }
        
        // Priority: rejected > approved > read > pending
        // Apply the highest priority status
        $finalStatus = 'pending';
        if (in_array('rejected', $statuses)) {
            $finalStatus = 'rejected';
        } elseif (in_array('approved', $statuses)) {
            $finalStatus = 'approved';
        } elseif (in_array('read', $statuses)) {
            $finalStatus = 'read';
        }
        
        // Update status
        DB::table('suggestions')->where('id', $id)->update([
            'status' => $finalStatus,
            'updated_at' => now()
        ]);
        
        $statusLabels = [
            'pending' => 'Belum Dibaca',
            'read' => 'Sudah Dibaca',
            'approved' => 'Disetujui (Tampil di Testimoni)',
            'rejected' => 'Ditolak'
        ];
        
        $selectedLabels = array_map(function($s) use ($statusLabels) {
            return $statusLabels[$s] ?? $s;
        }, $statuses);
        
        return redirect()->route('admin.suggestions')->with('success', 'Status berhasil diubah. Pilihan: ' . implode(', ', $selectedLabels) . '. Status akhir: ' . $statusLabels[$finalStatus]);
    }
    
    public function suggestionsBulkUpdateStatus(Request $request)
    {
        if (!session('admin_id')) {
            return redirect()->route('admin.suggestions')->with('error', 'Unauthorized');
        }
        
        $ids = $request->input('ids', []);
        $status = $request->input('status');
        
        if (empty($ids)) {
            return redirect()->route('admin.suggestions')->with('error', 'Tidak ada saran yang dipilih');
        }
        
        // Validate status
        $validStatuses = ['pending', 'read', 'approved', 'rejected'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->route('admin.suggestions')->with('error', 'Status tidak valid');
        }
        
        // Update status for all selected suggestions
        DB::table('suggestions')
            ->whereIn('id', $ids)
            ->update([
                'status' => $status,
                'updated_at' => now()
            ]);
        
        $statusLabels = [
            'pending' => 'Belum Dibaca',
            'read' => 'Sudah Dibaca',
            'approved' => 'Disetujui (Tampil di Testimoni)',
            'rejected' => 'Ditolak'
        ];
        
        $count = count($ids);
        return redirect()->route('admin.suggestions')->with('success', "Berhasil mengubah status {$count} saran menjadi: " . $statusLabels[$status]);
    }
    
    public function suggestionsBulkDelete(Request $request)
    {
        if (!session('admin_id')) {
            return redirect()->route('admin.suggestions')->with('error', 'Unauthorized');
        }
        
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return redirect()->route('admin.suggestions')->with('error', 'Tidak ada saran yang dipilih');
        }
        
        // Delete all selected suggestions
        $deleted = DB::table('suggestions')->whereIn('id', $ids)->delete();
        
        return redirect()->route('admin.suggestions')->with('success', "Berhasil menghapus {$deleted} saran");
    }
    
    // Petugas Management
    public function petugas()
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }
        
        try {
            $petugas = DB::table('petugas')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } catch (\Exception $e) {
            $petugas = new \Illuminate\Pagination\LengthAwarePaginator(
                [],
                0,
                20,
                1,
                ['path' => request()->url()]
            );
        }
        
        $admin = DB::table('petugas')->where('id', session('admin_id'))->first();
        
        return view('admin.petugas.index', compact('petugas', 'admin'));
    }
    
    // Alias for petugasIndex
    public function petugasIndex()
    {
        return $this->petugas();
    }
    
    public function petugasStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:petugas,email',
            'password' => 'required|min:6',
            'username' => 'required|string|max:255|unique:petugas,username'
        ]);
        
        DB::table('petugas')->insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return redirect()->route('admin.petugas')->with('success', 'Petugas berhasil ditambahkan!');
    }
    
    public function petugasUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:petugas,email,' . $id,
            'username' => 'required|string|max:255|unique:petugas,username,' . $id,
            'password' => 'nullable|min:6'
        ]);
        
        $updateData = [
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'updated_at' => now()
        ];
        
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }
        
        DB::table('petugas')->where('id', $id)->update($updateData);
        
        return redirect()->route('admin.petugas')->with('success', 'Petugas berhasil diupdate!');
    }
    
    public function petugasDestroy($id)
    {
        // Tidak bisa hapus diri sendiri
        if ($id == session('admin_id')) {
            return redirect()->route('admin.petugas')->with('error', 'Tidak dapat menghapus akun sendiri!');
        }
        
        DB::table('petugas')->where('id', $id)->delete();
        
        return redirect()->route('admin.petugas')->with('success', 'Petugas berhasil dihapus!');
    }
    
    // Reports/Laporan Management
    public function reportsIndex(Request $request)
    {
        if (!session('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }
        
        // Get filter parameters
        $filter = $request->get('filter', 'month'); // today, week, month, all
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        
        // Set date range based on filter
        $now = now();
        switch ($filter) {
            case 'today':
                $startDate = $now->copy()->startOfDay();
                $endDate = $now->copy()->endOfDay();
                break;
            case 'week':
                $startDate = $now->copy()->startOfWeek();
                $endDate = $now->copy()->endOfWeek();
                break;
            case 'month':
                $startDate = $now->copy()->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                break;
            case 'custom':
                $startDate = $startDate ? \Carbon\Carbon::parse($startDate)->startOfDay() : $now->copy()->subDays(30);
                $endDate = $endDate ? \Carbon\Carbon::parse($endDate)->endOfDay() : $now->copy()->endOfDay();
                break;
            default:
                $startDate = null;
                $endDate = null;
        }
        
        // Query activities
        $activitiesQuery = DB::table('gallery_activities');
        
        if ($startDate && $endDate) {
            $activitiesQuery->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        // Summary cards - 1. Statistik Umum Galeri
        $totalLikes = (clone $activitiesQuery)->where('activity_type', 'like')->count();
        $totalComments = (clone $activitiesQuery)->where('activity_type', 'comment')->count();
        $totalBookmarks = (clone $activitiesQuery)->where('activity_type', 'bookmark')->count();
        $totalShares = (clone $activitiesQuery)->where('activity_type', 'share')->count();
        $totalReports = (clone $activitiesQuery)->where('activity_type', 'report')->count();
        $totalViews = (clone $activitiesQuery)->where('activity_type', 'view')->count();
        
        // Get total photos uploaded in period
        $photosQuery = DB::table('foto');
        if ($startDate && $endDate) {
            $photosQuery->whereBetween('created_at', [$startDate, $endDate]);
        }
        $totalPhotos = $photosQuery->count();
        
        // Get activities by type for chart
        $activitiesByType = DB::table('gallery_activities')
            ->select('activity_type', DB::raw('count(*) as total'))
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                return $q->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->groupBy('activity_type')
            ->get();
        
        // 4. Statistik Harian/Bulanan - Get daily activities for chart
        $dailyActivities = DB::table('gallery_activities')
            ->select(
                DB::raw('DATE(created_at) as date'), 
                DB::raw('SUM(CASE WHEN activity_type = "like" THEN 1 ELSE 0 END) as likes'),
                DB::raw('SUM(CASE WHEN activity_type = "comment" THEN 1 ELSE 0 END) as comments'),
                DB::raw('SUM(CASE WHEN activity_type = "bookmark" THEN 1 ELSE 0 END) as bookmarks'),
                DB::raw('SUM(CASE WHEN activity_type = "view" THEN 1 ELSE 0 END) as views'),
                DB::raw('count(*) as total')
            )
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                return $q->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        
        // Get recent activities
        $recentActivities = DB::table('gallery_activities')
            ->leftJoin('foto', 'gallery_activities.foto_id', '=', 'foto.id')
            ->select('gallery_activities.*', 'foto.judul as foto_title')
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                return $q->whereBetween('gallery_activities.created_at', [$startDate, $endDate]);
            })
            ->orderBy('gallery_activities.created_at', 'desc')
            ->limit(50)
            ->get();
        
        // 2. Foto Paling Populer - Get top photos by interactions (likes + comments + bookmarks)
        $topPhotosByLikes = DB::table('gallery_activities')
            ->join('foto', 'gallery_activities.foto_id', '=', 'foto.id')
            ->select(
                'foto.id', 
                'foto.judul', 
                'foto.file_path',
                DB::raw('SUM(CASE WHEN gallery_activities.activity_type = "like" THEN 1 ELSE 0 END) as likes_count'),
                DB::raw('SUM(CASE WHEN gallery_activities.activity_type = "comment" THEN 1 ELSE 0 END) as comments_count'),
                DB::raw('SUM(CASE WHEN gallery_activities.activity_type = "bookmark" THEN 1 ELSE 0 END) as bookmarks_count')
            )
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                return $q->whereBetween('gallery_activities.created_at', [$startDate, $endDate]);
            })
            ->groupBy('foto.id', 'foto.judul', 'foto.file_path')
            ->orderByRaw('(SUM(CASE WHEN gallery_activities.activity_type = "like" THEN 1 ELSE 0 END) + SUM(CASE WHEN gallery_activities.activity_type = "comment" THEN 1 ELSE 0 END) + SUM(CASE WHEN gallery_activities.activity_type = "bookmark" THEN 1 ELSE 0 END)) DESC')
            ->limit(10)
            ->get();
        
        // 3. Aktivitas Komentar Terbaru
        $recentComments = DB::table('gallery_activities')
            ->leftJoin('foto', 'gallery_activities.foto_id', '=', 'foto.id')
            ->select('gallery_activities.*', 'foto.judul as foto_title')
            ->where('gallery_activities.activity_type', 'comment')
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                return $q->whereBetween('gallery_activities.created_at', [$startDate, $endDate]);
            })
            ->orderBy('gallery_activities.created_at', 'desc')
            ->limit(8)
            ->get();
        
        // Foto Paling Banyak Dikomentari
        $topPhotosByComments = DB::table('gallery_activities')
            ->join('foto', 'gallery_activities.foto_id', '=', 'foto.id')
            ->select(
                'foto.id', 
                'foto.judul', 
                'foto.file_path',
                DB::raw('count(*) as comments_count')
            )
            ->where('gallery_activities.activity_type', 'comment')
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                return $q->whereBetween('gallery_activities.created_at', [$startDate, $endDate]);
            })
            ->groupBy('foto.id', 'foto.judul', 'foto.file_path')
            ->orderBy('comments_count', 'desc')
            ->limit(10)
            ->get();
        
        // 5. Data Bookmark - Most bookmarked photos
        $topBookmarkedPhotos = DB::table('gallery_activities')
            ->join('foto', 'gallery_activities.foto_id', '=', 'foto.id')
            ->select('foto.id', 'foto.judul', 'foto.file_path', DB::raw('count(*) as bookmark_count'))
            ->where('gallery_activities.activity_type', 'bookmark')
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                return $q->whereBetween('gallery_activities.created_at', [$startDate, $endDate]);
            })
            ->groupBy('foto.id', 'foto.judul', 'foto.file_path')
            ->orderBy('bookmark_count', 'desc')
            ->limit(10)
            ->get();
        
        // 6. Laporan Pengguna Aktif
        $activeUsers = DB::table('gallery_activities')
            ->select(
                'user_id',
                DB::raw('SUM(CASE WHEN activity_type = "like" THEN 1 ELSE 0 END) as likes_given'),
                DB::raw('SUM(CASE WHEN activity_type = "comment" THEN 1 ELSE 0 END) as comments_sent'),
                DB::raw('SUM(CASE WHEN activity_type = "bookmark" THEN 1 ELSE 0 END) as bookmarks_created'),
                DB::raw('count(*) as total_activities')
            )
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                return $q->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->whereNotNull('user_id')
            ->groupBy('user_id')
            ->orderBy('total_activities', 'desc')
            ->limit(5)
            ->get();
        
        // 8. Data Share/Salin Link
        $topSharedPhotos = DB::table('gallery_activities')
            ->join('foto', 'gallery_activities.foto_id', '=', 'foto.id')
            ->select(
                'foto.id', 
                'foto.judul', 
                'foto.file_path',
                DB::raw('count(*) as total_shares'),
                DB::raw('SUM(CASE WHEN content LIKE "%copy%" OR content LIKE "%salin%" THEN 1 ELSE 0 END) as copy_link'),
                DB::raw('SUM(CASE WHEN content LIKE "%whatsapp%" THEN 1 ELSE 0 END) as whatsapp'),
                DB::raw('SUM(CASE WHEN content LIKE "%facebook%" THEN 1 ELSE 0 END) as facebook'),
                DB::raw('SUM(CASE WHEN content LIKE "%instagram%" THEN 1 ELSE 0 END) as instagram')
            )
            ->where('gallery_activities.activity_type', 'share')
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                return $q->whereBetween('gallery_activities.created_at', [$startDate, $endDate]);
            })
            ->groupBy('foto.id', 'foto.judul', 'foto.file_path')
            ->orderBy('total_shares', 'desc')
            ->limit(10)
            ->get();
        
        // Get reports with photo details for interactive gallery
        $reports = DB::table('gallery_activities')
            ->leftJoin('foto', 'gallery_activities.foto_id', '=', 'foto.id')
            ->select('gallery_activities.*', 'foto.judul as foto_title', 'foto.file_path', 'foto.deskripsi')
            ->where('gallery_activities.activity_type', 'report')
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                return $q->whereBetween('gallery_activities.created_at', [$startDate, $endDate]);
            })
            ->orderBy('gallery_activities.created_at', 'desc')
            ->get();
        
        return view('admin.reports.index', compact(
            'filter',
            'startDate',
            'endDate',
            'totalLikes',
            'totalComments',
            'totalBookmarks',
            'totalShares',
            'totalReports',
            'totalViews',
            'totalPhotos',
            'activitiesByType',
            'dailyActivities',
            'recentActivities',
            'topPhotosByLikes',
            'topPhotosByComments',
            'recentComments',
            'topBookmarkedPhotos',
            'activeUsers',
            'topSharedPhotos',
            'reports'
        ));
    }
    
    // Mark Report as Completed
    public function reportMarkCompleted($id)
    {
        try {
            DB::table('gallery_activities')
                ->where('id', $id)
                ->where('activity_type', 'report')
                ->update([
                    'content' => DB::raw("CONCAT(content, ' [STATUS: Selesai Ditinjau]')"),
                    'updated_at' => now()
                ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Laporan berhasil ditandai sebagai selesai'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai laporan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Delete Report
    public function reportDelete($id)
    {
        try {
            DB::table('gallery_activities')
                ->where('id', $id)
                ->where('activity_type', 'report')
                ->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Laporan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus laporan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Delete Content (Photo that was reported)
    public function reportDeleteContent($id)
    {
        try {
            // Get report data
            $report = DB::table('gallery_activities')
                ->where('id', $id)
                ->where('activity_type', 'report')
                ->first();
            
            if (!$report) {
                return response()->json([
                    'success' => false,
                    'message' => 'Laporan tidak ditemukan'
                ], 404);
            }
            
            // Delete the photo
            if ($report->foto_id) {
                // Get photo data first to delete file
                $photo = DB::table('foto')->where('id', $report->foto_id)->first();
                
                if ($photo && $photo->file_path) {
                    // Delete physical file
                    $filePath = public_path('storage/' . $photo->file_path);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                
                // Delete from database
                DB::table('foto')->where('id', $report->foto_id)->delete();
                
                // Also delete all activities related to this photo
                DB::table('gallery_activities')->where('foto_id', $report->foto_id)->delete();
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Konten berhasil dihapus dari galeri'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus konten: ' . $e->getMessage()
            ], 500);
        }
    }
}