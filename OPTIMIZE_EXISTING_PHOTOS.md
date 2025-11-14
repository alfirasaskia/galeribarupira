# 🖼️ Optimize Existing Photos

Script untuk optimize foto-foto yang **sudah ada** di database.

## 📋 Yang Dilakukan Script

1. ✅ Ambil semua foto dari database (`foto` table)
2. ✅ Optimize setiap foto:
   - Resize jika > 1920px
   - Compress JPEG (quality 85%)
   - Generate WebP version
   - Generate thumbnail (400px)
3. ✅ Update database:
   - Update `file_size` dengan size yang baru
   - Update `thumbnail_path` jika belum ada

## 🚀 Cara Pakai

### Di Local (Development)

```bash
php optimize-existing-photos.php
```

### Di Railway (Production)

**Option 1: Via Railway CLI**
```bash
# SSH ke Railway
railway run bash

# Jalankan script
php optimize-existing-photos.php
```

**Option 2: Via Railway Dashboard**
1. Buka Railway dashboard
2. Klik project → service Laravel
3. Tab **"Deployments"** → **"View Logs"**
4. Atau buat **one-off command**:
   - Tab **"Settings"** → **"Deploy"**
   - Add command: `php optimize-existing-photos.php`

## 📊 Output

Script akan menampilkan:
- Progress per foto
- File size sebelum & sesudah
- Total savings (MB/GB)
- Summary di akhir

Contoh output:
```
🚀 Starting Database Photo Optimization...
==========================================

📊 Found 150 photos in database

  🔄 [1/150] Processing: Foto 1 (2.5 MB)
    📐 Resized: 4000x3000 → 1920x1440
    💾 Saved optimized version
    🌐 Generated WebP version
    ✅ Optimized: 2.5 MB → 850 KB (Saved: 1.65 MB / 66.0%)
    📝 Database updated

==========================================
📊 Optimization Summary
==========================================
Total Photos: 150
Optimized: 145
Skipped: 3
Errors: 2
Total Savings: 250 MB (45.2%)
```

## ⚠️ Catatan Penting

1. **Backup dulu!** Script akan overwrite file original jika di-resize
2. **Memory limit**: Script sudah set `memory_limit = 512M`
3. **Time limit**: Script sudah set `max_execution_time = 0` (unlimited)
4. **Skip otomatis**: Foto yang sudah punya WebP version akan di-skip

## 🔄 Perbedaan dengan Auto-Optimize

| Feature | Existing Photos | New Uploads |
|---------|----------------|-------------|
| **Script** | `optimize-existing-photos.php` | Auto di controller |
| **Kapan** | Manual (sekali jalan) | Otomatis setiap upload |
| **Update DB** | ✅ Yes | ✅ Yes |
| **Generate WebP** | ✅ Yes | ✅ Yes |
| **Generate Thumbnail** | ✅ Yes | ✅ Yes |

## 💡 Tips

1. **Jalankan di production** setelah deploy untuk optimize semua foto yang sudah ada
2. **Monitor memory** jika ada banyak foto (>1000), bisa split jadi beberapa batch
3. **Check logs** jika ada error, script akan continue ke foto berikutnya
4. **Test dulu** dengan beberapa foto sebelum optimize semua

## 🐛 Troubleshooting

### Error: "File not found"
- Cek path di database (`file_path` column)
- Pastikan file benar-benar ada di storage

### Error: "Memory exhausted"
- Increase `memory_limit` di script (line 15)
- Atau optimize dalam batch (modify script)

### Error: "Permission denied"
- Pastikan folder `storage/app/public/photos` dan `thumbnails` writable
- Run: `chmod -R 755 storage/app/public`

---

**Setelah optimize, website akan load lebih cepat! 🚀**

