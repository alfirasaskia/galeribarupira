# 🚀 Railway Quick Start - Import Database

## ⚡ Cara Cepat Import Database ke Railway

### 1️⃣ Dapatkan Railway Database Credentials
1. Buka Railway Dashboard
2. Klik Project → Database Service
3. Copy connection info:
   - `MYSQL_HOST`
   - `MYSQL_PORT`
   - `MYSQL_DATABASE`
   - `MYSQL_USER`
   - `MYSQL_PASSWORD`
   - `DATABASE_URL` (otomatis)

### 2️⃣ Import Database

#### 🎯 Option A: Pakai Script Helper (Paling Cepat!)
```bash
# Edit script dengan Railway credentials
nano import-railway-db.sh

# Ganti credentials:
# MYSQL_HOST="containers-us-west-xxx.railway.app"
# MYSQL_PORT="6379"
# MYSQL_DATABASE="railway"
# MYSQL_USER="root"
# MYSQL_PASSWORD="xxxxxxxxxx"

# Run script
./import-railway-db.sh
```

#### 🎯 Option B: Pakai Railway CLI
```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link ke project
railway link

# Connect & import
railway connect
mysql -u $MYSQL_USER -p$MYSQL_PASSWORD -h $MYSQL_HOST -P $MYSQL_PORT $MYSQL_DATABASE < "/Users/tanziljws/Downloads/pira_webgalery (9).sql"
```

#### 🎯 Option C: Pakai MySQL Client
```bash
mysql -h <MYSQL_HOST> \
      -P <MYSQL_PORT> \
      -u <MYSQL_USER> \
      -p<MYSQL_PASSWORD> \
      <MYSQL_DATABASE> < "/Users/tanziljws/Downloads/pira_webgalery (9).sql"
```

#### 🎯 Option D: Pakai MySQL Workbench / DBeaver (GUI)
1. Buat connection baru dengan Railway credentials
2. Test connection
3. File → Run SQL Script → Pilih `pira_webgalery (9).sql`
4. Run!

### 3️⃣ Update Environment Variables di Railway
1. Buka Railway → Laravel Service → Variables
2. Add variables:
```env
DB_CONNECTION=mysql
DB_HOST=<MYSQL_HOST>
DB_PORT=<MYSQL_PORT>
DB_DATABASE=<MYSQL_DATABASE>
DB_USERNAME=<MYSQL_USER>
DB_PASSWORD=<MYSQL_PASSWORD>
```

**ATAU lebih simple pakai DATABASE_URL:**
```env
DATABASE_URL=<DATABASE_URL_dari_Railway>
```

### 4️⃣ Test Connection
```bash
# SSH ke Railway
railway run php artisan migrate:status

# Atau test connection
railway run php artisan tinker
>>> DB::connection()->getPdo();
```

## 📋 Files yang Tersedia

- `import-railway-db.sh` - Script helper untuk import database
- `RAILWAY_DATABASE_IMPORT.md` - Dokumentasi lengkap
- `.railway-env.example` - Template environment variables
- `pira_webgalery (9).sql` - Database SQL file (di Downloads folder)

## ⚠️ Troubleshooting

### Error: Access Denied
- Pastikan password benar
- Pastikan user punya permission

### Error: Connection Timeout
- Pastikan MYSQL_HOST benar
- Pastikan port benar
- Cek firewall Railway

### Error: Database not found
- Buat database dulu di Railway
- Atau import langsung ke database yang sudah ada

## 🚀 Next Steps

1. ✅ Import database (sudah selesai)
2. ✅ Update .env di Railway
3. ✅ Deploy aplikasi
4. ✅ Test connection
5. ✅ Setup storage untuk upload files (kalau perlu)

## 📝 Notes

- File SQL: `/Users/tanziljws/Downloads/pira_webgalery (9).sql`
- Size: ~910 lines
- Tables: agenda, cache, foto, galery, kategori, news, users, petugas, dll.
- **TIDAK PERLU NULIS ULANG SQL!** File SQL sudah ready untuk diimport langsung! 🎉

---

**Done!** Database sudah siap untuk Railway! 🚀

