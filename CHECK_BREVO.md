# Checklist Verifikasi Brevo

## ❗ Error: Authentication Failed (535)

Jika Anda mendapatkan error **"535 5.7.8 Authentication failed"**, ikuti langkah berikut:

### 1. ✅ Verifikasi Email di Brevo

1. Login ke **Brevo Dashboard**: https://app.brevo.com
2. Buka menu **Settings** → **Senders** (atau **SMTP & API**)
3. Cari email `tanziljws@gmail.com`
4. Pastikan statusnya **"Verified"** (bukan "Pending")
5. Jika masih "Pending", klik **"Verify"** dan ikuti instruksi

### 2. ✅ Cek SMTP API Key

1. Login ke **Brevo Dashboard**: https://app.brevo.com
2. Buka menu **Settings** → **SMTP & API** → **SMTP Keys**
3. Pastikan SMTP key Anda:
   - **Format**: `xkeysib-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-XXXXXXXXXXXXX`
   - **Status**: Active (tidak expired)
   - **Type**: SMTP (bukan Transactional API)
4. Jika expired, buat SMTP key baru:
   - Klik **"Create New Key"**
   - Pilih **"SMTP"** sebagai type
   - Copy key yang di-generate

### 3. ✅ Update .env

Pastikan di file `.env` Anda:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=tanziljws@gmail.com
MAIL_PASSWORD=YOUR_BREVO_SMTP_API_KEY_HERE
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tanziljws@gmail.com
MAIL_FROM_NAME="SMKN 4 Bogor"
```

**Penting**:
- `MAIL_USERNAME` = Email yang terverifikasi di Brevo (tanziljws@gmail.com)
- `MAIL_PASSWORD` = SMTP API key (format: `xkeysib-...`)
- `MAIL_FROM_ADDRESS` = Sama dengan `MAIL_USERNAME`

### 4. ✅ Clear Cache

Setelah update `.env`, jalankan:

```bash
php artisan config:clear
php artisan cache:clear
```

### 5. ✅ Test Email

```bash
php test-brevo-email.php tanziljws@gmail.com
```

### 6. ⚠️ Jika Masih Gagal

1. **Cek di Brevo Dashboard** → **Settings** → **SMTP & API** → **Logs**
   - Lihat apakah ada attempt koneksi
   - Lihat error message dari Brevo

2. **Cek Laravel Logs**:
   ```bash
   tail -f storage/logs/laravel.log | grep -i "otp\|mail\|brevo"
   ```

3. **Verifikasi API Key**:
   - Pastikan API key tidak ada spasi di awal/akhir
   - Pastikan menggunakan SMTP key, bukan Transactional API key

4. **Hubungi Brevo Support**:
   - Jika semua sudah benar tapi masih error
   - Kirim screenshot error dan konfigurasi

## 📝 Catatan Penting

- **Email harus terverifikasi** di Brevo sebelum bisa digunakan sebagai sender
- **API key harus SMTP key**, bukan API key biasa
- **Rate limit**: Brevo free tier memiliki limit 300 email/hari
- **Domain verification**: Jika menggunakan custom domain, domain harus terverifikasi juga

