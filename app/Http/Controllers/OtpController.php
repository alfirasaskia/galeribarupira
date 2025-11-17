<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Otp;

class OtpController extends Controller
{
    /**
     * Tampilkan halaman verifikasi OTP
     */
    public function showVerifyForm()
    {
        // Cek apakah ada user_id di session (dari proses register)
        if (!session('pending_verification_user_id')) {
            return redirect()->route('login')->with('error', 'Sesi verifikasi tidak ditemukan. Silakan login atau register kembali.');
        }

        return view('auth.verify-otp');
    }

    /**
     * Proses verifikasi OTP
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6'
        ], [
            'otp.required' => 'Kode OTP harus diisi',
            'otp.size' => 'Kode OTP harus 6 digit'
        ]);

        // Ambil user_id dari session
        $userId = session('pending_verification_user_id');
        
        if (!$userId) {
            return back()->withErrors(['otp' => 'Sesi verifikasi tidak ditemukan. Silakan register kembali.']);
        }

        // Cari OTP yang valid
        $otp = Otp::where('user_id', $userId)
            ->where('code', $request->otp)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otp) {
            // Cek apakah OTP sudah digunakan atau kadaluarsa
            $expiredOtp = Otp::where('user_id', $userId)
                ->where('code', $request->otp)
                ->first();

            if ($expiredOtp) {
                if ($expiredOtp->used) {
                    return back()->withErrors(['otp' => 'Kode OTP sudah pernah digunakan.'])->withInput();
                } else {
                    return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa. Silakan minta kode baru.'])->withInput();
                }
            }

            return back()->withErrors(['otp' => 'Kode OTP tidak valid.'])->withInput();
        }

        // Tandai OTP sebagai sudah digunakan
        $otp->update(['used' => true]);

        // Update email_verified_at di tabel users
        DB::table('users')
            ->where('id', $userId)
            ->update(['email_verified_at' => now()]);

        // Ambil data user untuk auto-login
        $user = DB::table('users')->where('id', $userId)->first();

        // Auto login setelah verifikasi berhasil
        session()->put([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_type' => 'user'
        ]);

        // Hapus session pending verification
        session()->forget('pending_verification_user_id');
        session()->forget('pending_verification_user_name');
        session()->forget('pending_verification_user_email');

        // Force save session
        session()->save();

        // Redirect ke beranda dengan pesan sukses
        return redirect(route('gallery.beranda') . '#hero')->with('success', 'Email berhasil diverifikasi! Selamat datang, ' . $user->name . '!');
    }

    /**
     * Kirim ulang OTP
     */
    public function resend(Request $request)
    {
        $userId = session('pending_verification_user_id');
        
        if (!$userId) {
            return back()->withErrors(['error' => 'Sesi verifikasi tidak ditemukan.']);
        }

        // Ambil data user
        $user = DB::table('users')->where('id', $userId)->first();
        
        if (!$user) {
            return back()->withErrors(['error' => 'User tidak ditemukan.']);
        }

        // Hapus semua OTP lama (bukan hanya tandai sebagai used)
        Otp::where('user_id', $userId)->delete();

        // Generate OTP baru
        $otpCode = Otp::generateCode();
        
        $otp = Otp::create([
            'user_id' => $userId,
            'code' => $otpCode,
            'used' => false,
            'expires_at' => now()->addMinutes(10)
        ]);

        // Kirim email OTP
        try {
            \Log::info('Attempting to resend OTP email', [
                'email' => $user->email,
                'otp_code' => $otpCode,
                'user_id' => $userId,
                'mail_mailer' => config('mail.default'),
                'mail_host' => config('mail.mailers.smtp.host'),
                'mail_port' => config('mail.mailers.smtp.port'),
            ]);
            
            \Mail::to($user->email)->send(new \App\Mail\SendOtpMail($otpCode, $user->name));
            
            \Log::info('OTP email resent successfully', ['email' => $user->email]);
            return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            \Log::error('Failed to resend OTP email', [
                'email' => $user->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors(['error' => 'Gagal mengirim email. Silakan coba lagi. Error: ' . $e->getMessage()]);
        }
    }
}
