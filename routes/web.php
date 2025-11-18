<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\RatingController;

// ============================================
// ROOT ROUTE - Halaman Beranda
// ============================================
Route::get('/', [GalleryController::class, 'beranda'])->name('home');

// ============================================
// AUTH ROUTES
// ============================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');
Route::post('/login/user', [AuthController::class, 'userLogin'])->name('login.user');
Route::get('/login/admin', [AdminController::class, 'showLogin'])->name('login.admin.show');
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('login.admin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');
Route::get('/auth/check', [AuthController::class, 'checkAuth'])->name('auth.check');

// OTP Verification Routes
Route::get('/verify-otp', [OtpController::class, 'showVerifyForm'])->name('verify.otp');
Route::post('/verify-otp', [OtpController::class, 'verify'])->name('verify.otp.post');
Route::post('/verify-otp/resend', [OtpController::class, 'resend'])->name('verify.otp.resend');

// API Routes for Gallery Activities
Route::post('/api/track-activity', [GalleryController::class, 'trackActivity'])->name('api.track.activity');
Route::delete('/api/track-activity', [GalleryController::class, 'removeActivity'])->name('api.remove.activity');
Route::get('/api/comments/{fotoId}', [GalleryController::class, 'getComments'])->name('api.get.comments');
Route::post('/api/comments', [GalleryController::class, 'storeComment'])->name('api.store.comment');
Route::delete('/api/comments/{commentId}', [GalleryController::class, 'deleteComment'])->name('api.delete.comment');

// Access selection page
Route::get('/access', function () {
    return view('auth.access');
})->name('access.select');

// Gallery Routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('gallery.show');

// Beranda route
Route::get('/beranda', [GalleryController::class, 'beranda'])->name('gallery.beranda');

// Galeri route
Route::get('/galeri', [GalleryController::class, 'galeri'])->name('gallery.galeri');
// Redirect my-bookmarks to user profile bookmarks tab
Route::get('/my-bookmarks', function() {
    if (!session('user_id')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }
    $userId = session('user_id');
    return redirect("/user/profile/{$userId}#bookmarks");
})->middleware('check.user')->name('gallery.bookmarks');
// Redirect informasi page to Beranda's news section
Route::get('/informasi', function () {
    return redirect()->to('/beranda#news');
})->name('gallery.informasi');
Route::get('/berita/{slug}', [GalleryController::class, 'beritaDetail'])->name('gallery.berita.detail');
Route::get('/agenda', [GalleryController::class, 'agenda'])->name('gallery.agenda');
Route::get('/profile', [GalleryController::class, 'profile'])->name('gallery.profile');
Route::get('/kategori', [GalleryController::class, 'kategori'])->name('gallery.kategori');

// User Profile Routes
Route::get('/user/profile/edit', [GalleryController::class, 'editUserProfile'])->middleware('check.user')->name('user.profile.edit');
Route::put('/user/profile/update', [GalleryController::class, 'updateUserProfile'])->middleware('check.user')->name('user.profile.update');
Route::get('/user/profile/{userId}', [GalleryController::class, 'showUserProfile'])->name('user.profile.show');

// Jurusan Pages
Route::get('/jurusan', [GalleryController::class, 'jurusanList'])->name('gallery.jurusan');
Route::get('/jurusan/{slug}', [GalleryController::class, 'jurusanShow'])->name('gallery.jurusan.show');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    
    // Protected admin routes
    Route::middleware('check.admin.only')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Berita management (CRUD)
        Route::get('/berita', [\App\Http\Controllers\AdminBeritaController::class, 'index'])->name('berita.index');
        Route::get('/berita/create', [\App\Http\Controllers\AdminBeritaController::class, 'create'])->name('berita.create');
        Route::post('/berita', [\App\Http\Controllers\AdminBeritaController::class, 'store'])->name('berita.store');
        Route::get('/berita/{beritum}', [\App\Http\Controllers\AdminBeritaController::class, 'show'])->name('berita.show');
        Route::get('/berita/{beritum}/edit', [\App\Http\Controllers\AdminBeritaController::class, 'edit'])->name('berita.edit');
        Route::put('/berita/{beritum}', [\App\Http\Controllers\AdminBeritaController::class, 'update'])->name('berita.update');
        Route::delete('/berita/{beritum}', [\App\Http\Controllers\AdminBeritaController::class, 'destroy'])->name('berita.destroy');
    
    // Photos Management
    Route::get('/photos', [AdminController::class, 'photosIndex'])->name('photos.index');
    
    // Debug route untuk test
    Route::get('/photos-debug', function() {
        return response()->json([
            'status' => 'success',
            'message' => 'Photos route is working',
            'session_admin_id' => session('admin_id'),
            'timestamp' => now()
        ]);
    })->name('photos.debug');
    Route::get('/photos/create', [AdminController::class, 'photosCreate'])->name('photos.create');
    Route::post('/photos', [AdminController::class, 'photosStore'])->name('photos.store');
    Route::get('/photos/{id}/edit', [AdminController::class, 'photosEdit'])->name('photos.edit');
    Route::put('/photos/{id}', [AdminController::class, 'photosUpdate'])->name('photos.update');
    Route::delete('/photos/{id}', [AdminController::class, 'photosDestroy'])->name('photos.destroy');
    
    // Redirect for photos admin panel
    Route::get('/photos/photo', function() {
        return redirect()->route('admin.photos.index');
    })->name('photos.redirect');
    
    // Categories Management
    Route::get('/categories', [AdminController::class, 'categoriesIndex'])->name('categories.index');
    Route::get('/categories/create', [AdminController::class, 'categoriesCreate'])->name('categories.create');
    Route::post('/categories', [AdminController::class, 'categoriesStore'])->name('categories.store');
    Route::get('/categories/{id}/edit', [AdminController::class, 'categoriesEdit'])->name('categories.edit');
    Route::put('/categories/{id}', [AdminController::class, 'categoriesUpdate'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'categoriesDestroy'])->name('categories.destroy');
    
    // Agenda Management
    Route::get('/agenda', [AdminController::class, 'agendaIndex'])->name('agenda.index');
    Route::get('/agenda/create', [AdminController::class, 'agendaCreate'])->name('agenda.create');
    Route::post('/agenda', [AdminController::class, 'agendaStore'])->name('agenda.store');
    Route::get('/agenda/{id}/edit', [AdminController::class, 'agendaEdit'])->name('agenda.edit');
    Route::put('/agenda/{id}', [AdminController::class, 'agendaUpdate'])->name('agenda.update');
    Route::delete('/agenda/{id}', [AdminController::class, 'agendaDestroy'])->name('agenda.destroy');
    Route::get('/agendas', [AdminController::class, 'agendaIndex'])->name('agenda.index.alias');
    
    // Suggestions Management
    Route::get('/suggestions', [AdminController::class, 'suggestionsIndex'])->name('suggestions.index');
    Route::get('/suggestions/{id}', [AdminController::class, 'suggestionsShow'])->name('suggestions.show');
    Route::post('/suggestions/{id}/reply', [AdminController::class, 'suggestionsReply'])->name('suggestions.reply');
    Route::delete('/suggestions/{id}', [AdminController::class, 'suggestionsDestroy'])->name('suggestions.destroy');
    
    // Logout
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout.get');
    });
});
Route::get('/tim', [GalleryController::class, 'tim'])->name('gallery.tim');
Route::get('/tentang', [GalleryController::class, 'tentang'])->name('gallery.tentang');
Route::get('/kontak', [GalleryController::class, 'kontak'])->name('gallery.kontak');

// Suggestion submission from frontend
Route::post('/suggestions', [AdminController::class, 'suggestionsStore'])->name('suggestions.store');

// Rating submission from frontend
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

// CRUD Routes untuk Foto
Route::middleware(['web'])->group(function () {
    Route::post('/foto', [GalleryController::class, 'storeFoto'])->name('foto.store');
    Route::put('/foto/{id}', [GalleryController::class, 'updateFoto'])->name('foto.update');
    Route::post('/foto/{id}', [GalleryController::class, 'updateFoto'])->name('foto.update.post');
    Route::delete('/foto/{id}', [GalleryController::class, 'destroyFoto'])->name('foto.destroy');
    Route::get('/foto/{id}', [GalleryController::class, 'getFoto'])->name('foto.show');
});

// CRUD Routes untuk Kategori
Route::middleware(['web'])->group(function () {
    Route::post('/kategori', [GalleryController::class, 'storeKategori'])->name('kategori.store');
    Route::put('/kategori/{id}', [GalleryController::class, 'updateKategori'])->name('kategori.update');
    Route::delete('/kategori/{id}', [GalleryController::class, 'destroyKategori'])->name('kategori.destroy');
    Route::get('/kategori/{id}', [GalleryController::class, 'getKategori'])->name('kategori.show');
});

// CRUD Routes untuk Galery
Route::middleware(['web'])->group(function () {
    Route::post('/galery', [GalleryController::class, 'storeGalery'])->name('galery.store');
    Route::put('/galery/{id}', [GalleryController::class, 'updateGalery'])->name('galery.update');
    Route::delete('/galery/{id}', [GalleryController::class, 'destroyGalery'])->name('galery.destroy');
    Route::get('/galery/{id}', [GalleryController::class, 'getGalery'])->name('galery.show');
});

// CRUD Routes untuk Petugas
Route::middleware(['web'])->group(function () {
    Route::post('/petugas', [GalleryController::class, 'storePetugas'])->name('petugas.store');
    Route::put('/petugas/{id}', [GalleryController::class, 'updatePetugas'])->name('petugas.update');
    Route::delete('/petugas/{id}', [GalleryController::class, 'destroyPetugas'])->name('petugas.destroy');
    Route::get('/petugas/{id}', [GalleryController::class, 'getPetugas'])->name('petugas.show');
});

// Admin Login & Register Routes
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::get('/admin/register', [AdminController::class, 'showRegister'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
// Admin Routes (Protected)
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Foto Management
    Route::get('/foto', [AdminController::class, 'fotoIndex'])->name('admin.foto.index');
    Route::get('/foto/create', [AdminController::class, 'fotoCreate'])->name('admin.foto.create');
    Route::post('/foto', [AdminController::class, 'fotoStore'])->name('admin.foto.store');
    Route::get('/foto/{id}/edit', [AdminController::class, 'fotoEdit'])->name('admin.foto.edit');
    Route::put('/foto/{id}', [AdminController::class, 'fotoUpdate'])->name('admin.foto.update');
    Route::delete('/foto/{id}', [AdminController::class, 'fotoDestroy'])->name('admin.foto.destroy');
    
    // Kategori Management
    Route::get('/kategori', [AdminController::class, 'kategoriIndex'])->name('admin.kategori.index');
    Route::get('/kategori/create', [AdminController::class, 'kategoriCreate'])->name('admin.kategori.create');
    Route::post('/kategori', [AdminController::class, 'kategoriStore'])->name('admin.kategori.store');
    Route::get('/kategori/{id}/edit', [AdminController::class, 'kategoriEdit'])->name('admin.kategori.edit');
    Route::put('/kategori/{id}', [AdminController::class, 'kategoriUpdate'])->name('admin.kategori.update');
    Route::delete('/kategori/{id}', [AdminController::class, 'kategori.destroy'])->name('admin.kategori.destroy');
    
    // Galery Management
    Route::get('/galery', [AdminController::class, 'galeryIndex'])->name('admin.galery.index');
    Route::get('/galery/create', [AdminController::class, 'galeryCreate'])->name('admin.galery.create');
    Route::post('/galery', [AdminController::class, 'galeryStore'])->name('admin.galery.store');
    Route::get('/galery/{id}/edit', [AdminController::class, 'galeryEdit'])->name('admin.galery.edit');
    Route::put('/galery/{id}', [AdminController::class, 'galeryUpdate'])->name('admin.galery.update');
    Route::delete('/galery/{id}', [AdminController::class, 'galeryDestroy'])->name('admin.galery.destroy');
    
    // Petugas Management
    Route::get('/petugas', [AdminController::class, 'petugas'])->name('admin.petugas');
    Route::post('/petugas', [AdminController::class, 'petugasStore'])->name('admin.petugas.store');
    Route::delete('/petugas/{id}', [AdminController::class, 'petugasDestroy'])->name('admin.petugas.destroy');
    Route::get('/posts', [AdminController::class, 'posts'])->name('admin.posts');
    Route::get('/profiles', [AdminController::class, 'profiles'])->name('admin.profiles');
    Route::get('/kategoris', [AdminController::class, 'kategoris'])->name('admin.kategoris');

    // Berita image uploader (simple)
    Route::get('/berita-images', [AdminController::class, 'beritaImagesForm'])->name('admin.berita.images.form');
    Route::post('/berita-images', [AdminController::class, 'beritaImagesStore'])->name('admin.berita.images.store');
});

// Admin Routes (Protected - Require Admin Login)
Route::middleware(['check.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/photos', [AdminController::class, 'photosIndex'])->name('admin.photos');
    Route::get('/admin/photos/index', [AdminController::class, 'photosIndex'])->name('admin.photos.index');
    Route::get('/admin/suggestions', [AdminController::class, 'suggestionsIndex'])->name('admin.suggestions');
    Route::get('/admin/petugas', [AdminController::class, 'petugasIndex'])->name('admin.petugas');
    Route::get('/admin/petugas/index', [AdminController::class, 'petugasIndex'])->name('admin.petugas.index');
    Route::get('/admin/reports', [AdminController::class, 'reportsIndex'])->name('admin.reports');
    Route::post('/admin/reports/{id}/complete', [AdminController::class, 'reportMarkCompleted'])->name('admin.reports.complete');
    Route::delete('/admin/reports/{id}', [AdminController::class, 'reportDelete'])->name('admin.reports.delete');
    Route::post('/admin/reports/{id}/delete-content', [AdminController::class, 'reportDeleteContent'])->name('admin.reports.delete-content');
    Route::post('/admin/comments/{id}/reply', [AdminController::class, 'replyComment'])->name('admin.comments.reply');

    // CRUD operations - Agenda (specific routes first, with constraints)
    Route::post('/admin/agenda', [AdminController::class, 'agendaStore'])->name('admin.agenda.store');
    Route::get('/admin/agenda/index', [AdminController::class, 'agendaIndex'])->name('admin.agenda.index');
    Route::get('/admin/agenda/{id}', [AdminController::class, 'agendaShow'])->name('admin.agenda.show')->where('id', '[0-9]+');
    Route::put('/admin/agenda/{id}', [AdminController::class, 'agendaUpdate'])->name('admin.agenda.update')->where('id', '[0-9]+');
    Route::post('/admin/agenda/{id}/toggle-status', [AdminController::class, 'agendaToggleStatus'])->name('admin.agenda.toggleStatus')->where('id', '[0-9]+');
    Route::delete('/admin/agenda/{id}', [AdminController::class, 'agendaDestroy'])->name('admin.agenda.destroy')->where('id', '[0-9]+');
    Route::delete('/admin/agenda/{id}/delete', [AdminController::class, 'agendaDestroy'])->name('admin.agenda.delete')->where('id', '[0-9]+');
    
    // Agenda Index (general routes)
    Route::get('/admin/agenda', [AdminController::class, 'agendaIndex'])->name('admin.agenda');

    // CRUD operations - Photos
    Route::get('/admin/photos/{id}/edit', [AdminController::class, 'photosEdit'])->name('admin.photos.edit');
    Route::post('/admin/photos', [AdminController::class, 'photosStore'])->name('admin.photos.store');
    Route::put('/admin/photos/{id}', [AdminController::class, 'photosUpdate'])->name('admin.photos.update');
    Route::delete('/admin/photos/{id}', [AdminController::class, 'photosDelete'])->name('admin.photos.delete');

    Route::post('/admin/suggestions', [AdminController::class, 'suggestionsStore'])->name('admin.suggestions.store');
    Route::post('/admin/suggestions/{id}/status', [AdminController::class, 'suggestionsUpdateStatus'])->name('admin.suggestions.updateStatus');
    Route::post('/admin/suggestions/{id}/status-multiple', [AdminController::class, 'suggestionsUpdateMultipleStatus'])->name('admin.suggestions.updateMultipleStatus');
    Route::post('/admin/suggestions/bulk-update-status', [AdminController::class, 'suggestionsBulkUpdateStatus'])->name('admin.suggestions.bulkUpdateStatus');
    Route::post('/admin/suggestions/bulk-delete', [AdminController::class, 'suggestionsBulkDelete'])->name('admin.suggestions.bulkDelete');
    Route::put('/admin/suggestions/{id}', [AdminController::class, 'suggestionsUpdate'])->name('admin.suggestions.update');
    Route::delete('/admin/suggestions/{id}', [AdminController::class, 'suggestionsDestroy'])->name('admin.suggestions.destroy');
    Route::delete('/admin/suggestions/{id}/delete', [AdminController::class, 'suggestionsDestroy'])->name('admin.suggestions.delete');
    Route::post('/admin/ratings/{id}/approve', [AdminController::class, 'approveRating'])->name('admin.ratings.approve');
    Route::delete('/admin/ratings/{id}', [AdminController::class, 'destroyRating'])->name('admin.ratings.destroy');

    Route::post('/admin/petugas', [AdminController::class, 'petugasStore'])->name('admin.petugas.store');
    Route::put('/admin/petugas/{id}', [AdminController::class, 'petugasUpdate'])->name('admin.petugas.update');
    Route::delete('/admin/petugas/{id}', [AdminController::class, 'petugasDestroy'])->name('admin.petugas.destroy');
    Route::delete('/admin/petugas/{id}/delete', [AdminController::class, 'petugasDestroy'])->name('admin.petugas.delete');
});

