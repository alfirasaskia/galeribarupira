# 🚀 Railway Database Import Guide

## Quick Import Database ke Railway

### Step 1: Dapatkan Connection Info dari Railway
1. Buka Railway Dashboard → Project → Database Service
2. Copy connection info:
   - `MYSQL_HOST`
   - `MYSQL_PORT`
   - `MYSQL_DATABASE`
   - `MYSQL_USER`
   - `MYSQL_PASSWORD`
   - `DATABASE_URL` (otomatis)

### Step 2: Import Database

#### Option A: Pakai Railway CLI (Paling Gampang)
```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link ke project
railway link

# Connect ke database & import
railway connect
mysql -u $MYSQL_USER -p$MYSQL_PASSWORD -h $MYSQL_HOST -P $MYSQL_PORT $MYSQL_DATABASE < "/Users/tanziljws/Downloads/pira_webgalery (9).sql"
```

#### Option B: Pakai MySQL Client Direct
```bash
# Install MySQL client (kalau belum ada)
# macOS: brew install mysql-client

# Import langsung
mysql -h <MYSQL_HOST> \
      -P <MYSQL_PORT> \
      -u <MYSQL_USER> \
      -p<MYSQL_PASSWORD> \
      <MYSQL_DATABASE> < "/Users/tanziljws/Downloads/pira_webgalery (9).sql"
```

#### Option C: Pakai MySQL Workbench / DBeaver
1. Buat connection baru dengan Railway credentials
2. Test connection
3. File → Run SQL Script → Pilih `pira_webgalery (9).sql`
4. Run!

### Step 3: Update .env di Railway
1. Buka Railway → Laravel Service → Variables
2. Add/Update:
```env
DB_CONNECTION=mysql
DB_HOST=<MYSQL_HOST>
DB_PORT=<MYSQL_PORT>
DB_DATABASE=<MYSQL_DATABASE>
DB_USERNAME=<MYSQL_USER>
DB_PASSWORD=<MYSQL_PASSWORD>
```

**ATAU lebih simple:**
```env
DATABASE_URL=<DATABASE_URL_dari_Railway>
```

### Step 4: Update config/database.php (Optional)
Pastikan config sudah support `DATABASE_URL`:
```php
'mysql' => [
    'driver' => 'mysql',
    'url' => env('DATABASE_URL'),
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    // ...
],
```

### Step 5: Test Connection
```bash
# SSH ke Railway
railway run php artisan migrate:status

# Atau test connection
railway run php artisan tinker
>>> DB::connection()->getPdo();
```

## 🎯 Quick Script

Copy script ini dan jalankan (ganti dengan Railway credentials):
```bash
#!/bin/bash
# Railway Database Import Script

MYSQL_HOST="containers-us-west-xxx.railway.app"
MYSQL_PORT="6379"
MYSQL_DATABASE="railway"
MYSQL_USER="root"
MYSQL_PASSWORD="xxxxxxxxxx"
SQL_FILE="/Users/tanziljws/Downloads/pira_webgalery (9).sql"

mysql -h $MYSQL_HOST \
      -P $MYSQL_PORT \
      -u $MYSQL_USER \
      -p$MYSQL_PASSWORD \
      $MYSQL_DATABASE < "$SQL_FILE"

echo "✅ Database imported successfully!"
```

## ⚠️ Troubleshooting

### Error: Access Denied
- Pastikan password benar
- Pastikan IP whitelist di Railway (kalau ada)

### Error: Connection Timeout
- Pastikan MYSQL_HOST benar
- Pastikan port benar
- Cek firewall Railway

### Error: Database not found
- Buat database dulu di Railway
- Atau import langsung ke database yang sudah ada

## 🚀 Alternative: Pakai Migration (Lebih Clean)

Kalau mau lebih professional, bisa pakai migration:

```bash
# 1. Export schema saja (tanpa data)
php artisan schema:dump

# 2. Deploy migration ke Railway
git push

# 3. Run migration di Railway
railway run php artisan migrate --force

# 4. Seed data (kalau ada seeder)
railway run php artisan db:seed --force
```

---

**File SQL yang akan diimport:**
`/Users/tanziljws/Downloads/pira_webgalery (9).sql`

**Size:** ~910 lines
**Tables:** agenda, cache, foto, galery, kategori, news, users, petugas, dll.

