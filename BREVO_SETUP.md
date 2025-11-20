# Konfigurasi Brevo (Sendinblue) untuk Email

File ini berisi instruksi untuk mengkonfigurasi Brevo sebagai email service provider.

## Pengaturan di .env

Tambahkan atau update variabel berikut di file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=tanziljws@gmail.com
MAIL_PASSWORD=YOUR_BREVO_SMTP_API_KEY_HERE
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tanziljws@gmail.com
MAIL_FROM_NAME="SMKN 4 Bogor - Piragalery"
```

**Catatan**: Ganti `YOUR_BREVO_SMTP_API_KEY_HERE` dengan API key Brevo Anda yang sebenarnya.

## Penjelasan

- **MAIL_MAILER**: Menggunakan SMTP transport
- **MAIL_HOST**: SMTP server Brevo
- **MAIL_PORT**: Port 587 untuk TLS (alternatif: 465 untuk SSL)
- **MAIL_USERNAME**: Email yang terdaftar di Brevo
- **MAIL_PASSWORD**: API key dari Brevo (SMTP key)
- **MAIL_ENCRYPTION**: TLS encryption
- **MAIL_FROM_ADDRESS**: Alamat email pengirim
- **MAIL_FROM_NAME**: Nama yang akan muncul sebagai pengirim

## Catatan Penting

1. **SMTP API Key**: Pastikan API key yang digunakan adalah **SMTP key** (dimulai dengan `xkeysib-`), bukan API key biasa
   - Cara mendapatkan: Login ke Brevo → Settings → SMTP & API → SMTP Keys → Create New Key
   - Format: `xkeysib-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-XXXXXXXXXXXXX`
2. **Email Verification**: Email `tanziljws@gmail.com` harus sudah terverifikasi di akun Brevo
   - Login ke Brevo → Settings → Senders → Verify your sender email
3. **After Update**: Setelah update `.env`, jalankan:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```
4. **Testing**: Test email dengan melakukan registrasi atau request OTP

## Troubleshooting Email Tidak Terkirim

### 1. Cek API Key Format
- ✅ **Benar**: `xkeysib-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-XXXXXXXXXXXXX` (format SMTP key dari Brevo)
- ❌ **Salah**: `xxxxxxxxxxxxxxxxxxxx` (tanpa prefix `xkeysib-`)

### 2. Cek Email Verifikasi di Brevo
- Login ke https://app.brevo.com
- Settings → Senders
- Pastikan `tanziljws@gmail.com` statusnya **"Verified"** (bukan "Pending")

### 3. Cek Log Laravel
```bash
tail -f storage/logs/laravel.log | grep -i "otp\|mail\|brevo"
```

### 4. Test Koneksi SMTP
- Pastikan server dapat mengakses `smtp-relay.brevo.com:587`
- Cek firewall tidak memblokir port 587

### 5. Common Errors
- **"Authentication failed"**: API key salah atau expired
- **"Connection timeout"**: Firewall block atau network issue
- **"Invalid sender"**: Email belum terverifikasi di Brevo

## Testing

Untuk test email functionality:
1. Lakukan registrasi user baru
2. Atau request resend OTP di halaman verifikasi
3. Cek email inbox untuk memastikan email terkirim

## Troubleshooting

Jika email tidak terkirim:
1. Pastikan semua variabel di `.env` sudah benar
2. Pastikan API key masih valid di Brevo dashboard
3. Cek log Laravel: `storage/logs/laravel.log`
4. Pastikan firewall tidak memblokir koneksi ke smtp-relay.brevo.com:587

