# Photo Display Debug Guide

Jika foto tidak muncul di halaman admin/photos/index, ikuti langkah-langkah berikut:

## Step 1: Jalankan Fix Storage Script

Akses URL ini di browser:
```
http://127.0.0.1:8000/fix-storage.php
```

Script ini akan:
- Membuat folder `/storage/app/public/photos` jika belum ada
- Membuat storage link dari `/public/storage` ke `/storage/app/public`
- Mengatur permissions dengan benar
- Menampilkan status semua file

## Step 2: Jalankan Test Image URL

Akses URL ini di browser:
```
http://127.0.0.1:8000/test-image-url.php
```

Script ini akan:
- Menampilkan semua foto dari database
- Menunjukkan apakah file benar-benar ada di storage
- Menampilkan URL yang dihasilkan
- Menguji apakah URL dapat diakses
- Menampilkan preview gambar

## Step 3: Upload Foto Baru

1. Buka halaman admin: http://127.0.0.1:8000/admin/photos/index
2. Klik tombol "Tambah Foto Baru"
3. Isi form dan upload foto
4. Lihat apakah foto muncul di grid

## Step 4: Jika Masih Tidak Muncul

Cek di browser console (F12):
1. Buka halaman admin/photos/index
2. Tekan F12 untuk buka Developer Tools
3. Pergi ke tab "Network"
4. Refresh halaman
5. Cari request ke file gambar (lihat di Network tab)
6. Lihat status response (200 = OK, 404 = Not Found, dll)

## Troubleshooting

### Masalah: Storage link tidak terbuat di Windows

**Solusi:**
1. Buka Command Prompt sebagai Administrator
2. Jalankan command:
   ```
   mklink /J "C:\xampp\htdocs\pirawebgalery\public\storage" "C:\xampp\htdocs\pirawebgalery\storage\app\public"
   ```
3. Refresh browser

### Masalah: File tidak tersimpan

**Solusi:**
1. Pastikan folder `/storage/app/public/photos` ada
2. Pastikan folder memiliki permission write (0777)
3. Cek di `test-image-url.php` apakah file benar-benar ada

### Masalah: URL menghasilkan 404

**Solusi:**
1. Pastikan storage link sudah dibuat
2. Cek di `fix-storage.php` status storage link
3. Pastikan file benar-benar ada di `/storage/app/public/photos/`

## File-file Debug yang Tersedia

- `/fix-storage.php` - Perbaiki storage link dan permissions
- `/test-image-url.php` - Test URL dan preview gambar
- `/debug-photos.php` - Debug info database dan storage
- `/test-storage.php` - Test storage structure

## Catatan

- Semua file debug ini hanya untuk development/testing
- Jangan gunakan di production
- Hapus file-file ini setelah masalah selesai
