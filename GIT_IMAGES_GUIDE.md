# 📸 Git & Images - Best Practices

## ❌ JANGAN Commit Images ke Git!

**Kenapa?**
- Images terlalu besar (485MB+)
- Git repository jadi lambat
- Clone/pull jadi lama
- Bisa hit GitHub file size limit (100MB)

---

## ✅ Solusi yang Benar

### 1. Images di .gitignore (Sudah diupdate!)

Images sudah di-ignore di `.gitignore`:
```
/public/uploads
/storage/app/public/photos
```

**Jangan commit images!** ✅

---

### 2. Images di Production (Railway)

Images harus di-upload ke **persistent storage** atau **CDN**:

#### Option A: Railway Volume (Persistent Storage)

1. Buka Railway Dashboard
2. Add **Volume** service
3. Mount ke `/app/storage/app/public`
4. Images akan persist meski container restart

#### Option B: External Storage (Recommended)

**Pakai Cloud Storage:**
- **AWS S3** (via Laravel Filesystem)
- **Cloudflare R2** (S3-compatible, free tier)
- **DigitalOcean Spaces**
- **Backblaze B2**

**Setup di Laravel:**

```bash
# Install S3 driver
composer require league/flysystem-aws-s3-v3 "^3.0"
```

```env
# .env
FILESYSTEM_DISK=s3

AWS_ACCESS_KEY_ID=your_key
AWS_SECRET_ACCESS_KEY=your_secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket
AWS_USE_PATH_STYLE_ENDPOINT=false
```

```php
// config/filesystems.php
's3' => [
    'driver' => 's3',
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION'),
    'bucket' => env('AWS_BUCKET'),
    'url' => env('AWS_URL'),
    'endpoint' => env('AWS_ENDPOINT'),
    'use_path_style' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
    'throw' => false,
],
```

#### Option C: Railway Volume (Simple)

1. Railway Dashboard → Add Service → Volume
2. Mount path: `/app/storage/app/public`
3. Images akan tersimpan di volume (persistent)

---

### 3. Deploy Images ke Production

#### Method 1: Upload via Admin Panel

Setelah deploy, upload images via admin panel di production.

#### Method 2: Sync dari Local ke Production

```bash
# Pakai rsync (kalau punya SSH access)
rsync -avz public/uploads/ user@server:/path/to/app/public/uploads/

# Atau pakai Railway CLI
railway run bash
# Lalu upload images via admin panel
```

#### Method 3: Import dari Database + Upload Images

1. Import database (sudah ada images paths)
2. Upload images ke storage/CDN
3. Update paths di database jika perlu

---

## 🚀 Workflow yang Benar

### Development (Local):
1. ✅ Upload images via admin panel
2. ✅ Images tersimpan di `public/uploads/`
3. ✅ Images di `.gitignore` (tidak di-commit)

### Production (Railway):
1. ✅ Setup persistent storage (Volume atau S3)
2. ✅ Upload images via admin panel di production
3. ✅ Images tersimpan di storage/CDN
4. ✅ Website load images dari storage/CDN

---

## 📋 Checklist

- [x] Images di `.gitignore` ✅
- [ ] Setup persistent storage di Railway
- [ ] Upload images ke production
- [ ] Test images load di production
- [ ] Setup CDN (optional, untuk lebih cepat)

---

## ⚠️ Important Notes

1. **Jangan commit images ke git!** - Terlalu besar, bikin repo lambat
2. **Pakai persistent storage** - Images harus persist meski container restart
3. **Optimize sebelum upload** - Script sudah auto-optimize
4. **Monitor storage usage** - Jangan sampai penuh

---

## 💡 Tips

### Backup Images

```bash
# Backup images dari production
railway run tar -czf images-backup.tar.gz storage/app/public/photos

# Download backup
railway run cat images-backup.tar.gz > images-backup.tar.gz
```

### Cleanup Old Images

```bash
# Hapus images yang tidak digunakan (berdasarkan database)
php artisan tinker
>>> // Script untuk cleanup
```

---

**Summary:** Images tidak perlu di-commit ke git. Upload langsung ke production via admin panel atau sync ke persistent storage! 🚀

