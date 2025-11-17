<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Models\Otp;
use App\Mail\SendOtpMail;

class AuthController extends Controller
{
    // Show login form - KHUSUS USER GALERI
    public function showLogin()
    {
        // Jika sudah login sebagai user, redirect ke beranda
        if (session('user_id')) {
            return redirect()->route('gallery.beranda');
        }
        
        return view('auth.login');
    }

    // Process login - KHUSUS USER GALERI
    public function processLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $username = $request->username;
        $password = $request->password;
        
        // HANYA CEK TABEL USERS (untuk user galeri)
        // Cek apakah input adalah email atau username
        $user = DB::table('users')
            ->where(function($query) use ($username) {
                $query->where('email', $username)
                      ->orWhere('name', $username);
            })
            ->first();
        
        if ($user && Hash::check($password, $user->password)) {
            // LOGIN LANGSUNG TANPA CEK VERIFIKASI
            // Verifikasi email hanya untuk register, bukan untuk login
            
            // Store user session
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_type' => 'user'
            ]);

            // User redirect ke beranda atau intended URL
            $intended = $request->intended_url ?: session('url.intended', route('gallery.beranda') . '#hero');
            session()->forget('url.intended');
            
            return redirect($intended)->with('success', 'Login berhasil! Selamat datang, ' . $user->name . '!');
        }

        // Demo user credentials
        if ($username === 'user@example.com' && $password === 'password') {
            session([
                'user_id' => 999,
                'user_name' => 'Demo User',
                'user_email' => 'user@example.com',
                'user_type' => 'user'
            ]);
            
            $intended = $request->intended_url ?: session('url.intended', route('gallery.beranda') . '#hero');
            session()->forget('url.intended');
            
            return redirect($intended)->with('success', 'Login demo berhasil!');
        }

        return back()->withErrors(['username' => 'Email atau password salah.'])->withInput();
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        // Check if user exists in users table
        $user = DB::table('users')->where('email', $request->email)->first();
        
        if ($user && Hash::check($request->password, $user->password)) {
            // Store user session
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_type' => 'user'
            ]);

            return redirect()->intended(route('gallery.beranda') . '#hero')->with('success', 'Login berhasil!');
        }

        // Demo user credentials
        if ($request->email === 'user@example.com' && $request->password === 'password') {
            session([
                'user_id' => 999,
                'user_name' => 'Demo User',
                'user_email' => 'user@example.com',
                'user_type' => 'user'
            ]);

            return redirect()->intended(route('gallery.beranda') . '#hero')->with('success', 'Login demo berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check if admin exists in petugas table
        $admin = DB::table('petugas')->where('username', $request->username)->first();
        
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Store admin session
            session([
                'admin_id' => $admin->id,
                'admin_name' => $admin->username,
                'admin_email' => $admin->email,
                'user_type' => 'admin'
            ]);

            return redirect()->intended(route('admin.dashboard'))->with('success', 'Login admin berhasil!');
        }

        // Demo admin credentials
        if ($request->username === 'admin' && $request->password === 'admin123') {
            session([
                'admin_id' => 1,
                'admin_name' => 'admin',
                'admin_email' => 'admin@example.com',
                'user_type' => 'admin'
            ]);

            return redirect()->intended(route('admin.dashboard'))->with('success', 'Login demo admin berhasil!');
        }

        return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
    }

    public function logout()
    {
        session()->flush();
        return redirect(route('gallery.beranda') . '#hero')->with('success', 'Logout berhasil!');
    }

    public function checkAuth()
    {
        return response()->json([
            'is_logged_in' => session()->has('user_id') || session()->has('admin_id'),
            'user_type' => session('user_type'),
            'user_name' => session('user_name') ?? session('admin_name')
        ]);
    }

    // Show register form - KHUSUS USER GALERI
    public function showRegister()
    {
        // Jika sudah login, redirect ke beranda
        if (session('user_id')) {
            return redirect()->route('gallery.beranda');
        }
        
        return view('auth.register');
    }

    // Process registration - KHUSUS USER GALERI
    public function processRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ], [
            'name.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain atau login jika sudah memiliki akun.',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok'
        ]);
        
        try {
            // Cek apakah email sudah terdaftar dan TERVERIFIKASI
            $existingUser = DB::table('users')->where('email', $request->email)->whereNotNull('email_verified_at')->first();
            if ($existingUser) {
                return back()->withErrors(['email' => 'Email sudah terdaftar. Silakan login jika Anda sudah memiliki akun.'])->withInput();
            }
            
            // Jika email ada tapi belum terverifikasi, hapus user lama dan OTP-nya
            $unverifiedUser = DB::table('users')->where('email', $request->email)->whereNull('email_verified_at')->first();
            if ($unverifiedUser) {
                // Hapus OTP yang terkait
                DB::table('otps')->where('user_id', $unverifiedUser->id)->delete();
                // Hapus user yang belum terverifikasi
                DB::table('users')->where('id', $unverifiedUser->id)->delete();
            }
            
            // Insert new user (email_verified_at masih NULL)
            $userId = DB::table('users')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => null, // Belum terverifikasi
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            // Generate OTP 6 digit
            $otpCode = Otp::generateCode();
            
            // Simpan OTP ke database
            Otp::create([
                'user_id' => $userId,
                'code' => $otpCode,
                'used' => false,
                'expires_at' => now()->addMinutes(10) // Berlaku 10 menit
            ]);
            
            // Kirim OTP ke email
            \Log::info('Attempting to send OTP email', [
                'email' => $request->email,
                'otp_code' => $otpCode,
                'user_id' => $userId,
                'mail_mailer' => config('mail.default'),
                'mail_host' => config('mail.mailers.smtp.host'),
                'mail_port' => config('mail.mailers.smtp.port'),
            ]);
            
            try {
                Mail::to($request->email)->send(new SendOtpMail($otpCode, $request->name));
                \Log::info('OTP email sent successfully', ['email' => $request->email]);
            } catch (\Exception $mailException) {
                \Log::error('Failed to send OTP email', [
                    'email' => $request->email,
                    'error' => $mailException->getMessage(),
                    'trace' => $mailException->getTraceAsString()
                ]);
                throw $mailException;
            }
            
            // Simpan data user ke session untuk proses verifikasi
            session()->put([
                'pending_verification_user_id' => $userId,
                'pending_verification_user_name' => $request->name,
                'pending_verification_user_email' => $request->email
            ]);
            
            // Redirect ke halaman verifikasi OTP
            return redirect()->route('verify.otp')->with('success', 'Registrasi berhasil! Kode OTP telah dikirim ke email Anda. Silakan cek email dan masukkan kode verifikasi.');
            
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database errors (duplicate entry, etc)
            if ($e->getCode() == 23000) {
                // Duplicate entry error
                return back()->withErrors(['email' => 'Email sudah terdaftar. Silakan gunakan email lain atau login jika sudah memiliki akun.'])->withInput();
            }
            
            // Log error untuk debugging
            \Log::error('Registration error', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.'])->withInput();
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Registration error', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.'])->withInput();
        }
    }
}

