# 🎯 Database Import Tricks & Techniques

Dokumentasi lengkap teknik-teknik yang digunakan untuk import database, bisa diterapkan di project lain!

---

## 📋 Table of Contents

1. [Auto-detect MySQL Client](#1-auto-detect-mysql-client)
2. [Read Credentials dari .env](#2-read-credentials-dari-env)
3. [Handle Existing Tables](#3-handle-existing-tables)
4. [Error Handling](#4-error-handling)
5. [Interactive Script](#5-interactive-script)
6. [Complete Script Template](#6-complete-script-template)

---

## 1. Auto-detect MySQL Client

### Problem
MySQL client mungkin tidak ada di PATH, tapi terinstall via Homebrew.

### Solution
```bash
# Step 1: Cek di PATH dulu
MYSQL_CMD=$(which mysql 2>/dev/null)

# Step 2: Kalau tidak ada, cek Homebrew location
if [ -z "$MYSQL_CMD" ]; then
    BREW_PREFIX=$(brew --prefix mysql-client 2>/dev/null)
    if [ -n "$BREW_PREFIX" ] && [ -f "$BREW_PREFIX/bin/mysql" ]; then
        MYSQL_CMD="$BREW_PREFIX/bin/mysql"
        export PATH="$BREW_PREFIX/bin:$PATH"
    fi
fi

# Step 3: Validasi
if [ -z "$MYSQL_CMD" ]; then
    echo "❌ MySQL client not found!"
    exit 1
fi
```

### Penjelasan
- `which mysql 2>/dev/null` → Cari mysql di PATH, suppress error
- `brew --prefix mysql-client` → Dapatkan path Homebrew untuk mysql-client
- `[ -f "$BREW_PREFIX/bin/mysql" ]` → Cek apakah file exists
- `export PATH` → Tambahkan ke PATH untuk command selanjutnya

### Adaptasi untuk Tools Lain
```bash
# PostgreSQL
PSQL_CMD=$(which psql 2>/dev/null)
if [ -z "$PSQL_CMD" ]; then
    BREW_PREFIX=$(brew --prefix postgresql@15 2>/dev/null)
    if [ -n "$BREW_PREFIX" ] && [ -f "$BREW_PREFIX/bin/psql" ]; then
        PSQL_CMD="$BREW_PREFIX/bin/psql"
    fi
fi

# MongoDB
MONGO_CMD=$(which mongosh 2>/dev/null)
if [ -z "$MONGO_CMD" ]; then
    BREW_PREFIX=$(brew --prefix mongodb-community 2>/dev/null)
    if [ -n "$BREW_PREFIX" ] && [ -f "$BREW_PREFIX/bin/mongosh" ]; then
        MONGO_CMD="$BREW_PREFIX/bin/mongosh"
    fi
fi
```

---

## 2. Read Credentials dari .env

### Problem
Hardcode credentials tidak aman dan tidak fleksibel.

### Solution
```bash
# Load dari .env file
ENV_FILE=".env"

# Read dengan grep + cut
MYSQL_HOST=$(grep "^DB_HOST=" "$ENV_FILE" | cut -d '=' -f2 | tr -d '"' | tr -d "'")
MYSQL_PORT=$(grep "^DB_PORT=" "$ENV_FILE" | cut -d '=' -f2 | tr -d '"' | tr -d "'")
MYSQL_DATABASE=$(grep "^DB_DATABASE=" "$ENV_FILE" | cut -d '=' -f2 | tr -d '"' | tr -d "'")
MYSQL_USER=$(grep "^DB_USERNAME=" "$ENV_FILE" | cut -d '=' -f2 | tr -d '"' | tr -d "'")
MYSQL_PASSWORD=$(grep "^DB_PASSWORD=" "$ENV_FILE" | cut -d '=' -f2 | tr -d '"' | tr -d "'")
```

### Penjelasan
- `grep "^DB_HOST="` → Cari line yang mulai dengan `DB_HOST=`
- `cut -d '=' -f2` → Split by `=` dan ambil bagian ke-2 (value)
- `tr -d '"'` → Hapus double quotes
- `tr -d "'"` → Hapus single quotes

### Alternative: Pakai `source` (Lebih Simple)
```bash
# Method 2: Source .env (tapi harus export dulu)
set -a  # Auto export semua variables
source .env
set +a  # Stop auto export

# Sekarang bisa langsung pakai:
# $DB_HOST, $DB_PORT, dll
```

### Alternative: Pakai `awk` (Lebih Robust)
```bash
# Method 3: Pakai awk (handle comment & empty lines)
MYSQL_HOST=$(awk -F '=' '/^DB_HOST=/ && !/^#/ {print $2}' .env | tr -d ' "'"'"')
```

### Best Practice
```bash
# Validasi .env file exists
if [ ! -f "$ENV_FILE" ]; then
    echo "❌ .env file not found!"
    exit 1
fi

# Validasi credentials tidak kosong
if [ -z "$MYSQL_HOST" ] || [ -z "$MYSQL_PASSWORD" ]; then
    echo "❌ Missing credentials in .env!"
    exit 1
fi
```

---

## 3. Handle Existing Tables

### Problem
Import gagal jika tabel sudah ada (ERROR 1050).

### Solution 1: Drop Tables Dulu
```bash
# Disable foreign key checks
"$MYSQL_CMD" -h "$MYSQL_HOST" \
      -P "$MYSQL_PORT" \
      -u "$MYSQL_USER" \
      -p"$MYSQL_PASSWORD" \
      "$MYSQL_DATABASE" -e "
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS table1, table2, table3;
SET FOREIGN_KEY_CHECKS = 1;
"
```

### Solution 2: Skip Errors
```bash
# Filter out ERROR 1050 (table exists)
"$MYSQL_CMD" ... < "$SQL_FILE" 2>&1 | grep -v "ERROR 1050" || true
```

### Solution 3: Pakai `--force` Flag
```bash
# MySQL: --force untuk continue meski ada error
"$MYSQL_CMD" ... --force < "$SQL_FILE"

# PostgreSQL: ON_ERROR_STOP=off
PGOPTIONS='--client-min-messages=warning' psql ... < "$SQL_FILE"
```

### Solution 4: Dynamic Drop (Auto-detect Tables)
```bash
# Ambil list semua tables dari database
TABLES=$("$MYSQL_CMD" -h "$MYSQL_HOST" \
    -P "$MYSQL_PORT" \
    -u "$MYSQL_USER" \
    -p"$MYSQL_PASSWORD" \
    "$MYSQL_DATABASE" \
    -e "SHOW TABLES;" | tail -n +2)

# Drop semua tables
if [ -n "$TABLES" ]; then
    "$MYSQL_CMD" ... -e "
    SET FOREIGN_KEY_CHECKS = 0;
    DROP TABLE IF EXISTS $TABLES;
    SET FOREIGN_KEY_CHECKS = 1;
    "
fi
```

---

## 4. Error Handling

### Basic Error Handling
```bash
# Check exit code
"$MYSQL_CMD" ... < "$SQL_FILE"

if [ $? -eq 0 ]; then
    echo "✅ Success!"
else
    echo "❌ Failed!"
    exit 1
fi
```

### Advanced Error Handling
```bash
# Capture output & error
OUTPUT=$("$MYSQL_CMD" ... < "$SQL_FILE" 2>&1)
EXIT_CODE=$?

if [ $EXIT_CODE -eq 0 ]; then
    echo "✅ Success!"
    echo "$OUTPUT"
else
    echo "❌ Failed with exit code: $EXIT_CODE"
    echo "$OUTPUT"
    
    # Check specific errors
    if echo "$OUTPUT" | grep -q "ERROR 1050"; then
        echo "💡 Table already exists!"
    elif echo "$OUTPUT" | grep -q "Access denied"; then
        echo "💡 Wrong credentials!"
    fi
    
    exit 1
fi
```

### Suppress Warnings
```bash
# Suppress password warning
"$MYSQL_CMD" ... 2>/dev/null

# Atau redirect ke log file
"$MYSQL_CMD" ... 2>import-errors.log
```

---

## 5. Interactive Script

### Basic Input
```bash
# Simple input
read -p "Enter name: " NAME
echo "Hello, $NAME!"
```

### Input dengan Default
```bash
# Input dengan default value
read -p "Choose option (1/2) [default: 1]: " OPTION
OPTION=${OPTION:-1}  # Default ke 1 jika kosong
```

### Input dengan Validation
```bash
# Loop sampai valid input
while true; do
    read -p "Choose (1/2): " OPTION
    case $OPTION in
        1|2) break ;;
        *) echo "Invalid! Choose 1 or 2" ;;
    esac
done
```

### Yes/No Confirmation
```bash
# Yes/No dengan default
read -p "Continue? (y/n) [default: y]: " CONFIRM
CONFIRM=${CONFIRM:-y}

if [[ "$CONFIRM" =~ ^[Yy]$ ]]; then
    echo "Continuing..."
else
    echo "Cancelled!"
    exit 0
fi
```

---

## 6. Complete Script Template

### Template untuk MySQL
```bash
#!/bin/bash

# ============================================
# Database Import Script Template
# ============================================

set -e  # Exit on error (optional)

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
ENV_FILE=".env"
SQL_FILE="database.sql"

# ============================================
# Functions
# ============================================

log_info() {
    echo -e "${GREEN}✅ $1${NC}"
}

log_error() {
    echo -e "${RED}❌ $1${NC}"
}

log_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

# ============================================
# Step 1: Load Credentials
# ============================================

if [ ! -f "$ENV_FILE" ]; then
    log_error ".env file not found!"
    exit 1
fi

MYSQL_HOST=$(grep "^DB_HOST=" "$ENV_FILE" | cut -d '=' -f2 | tr -d ' "'"'"')
MYSQL_PORT=$(grep "^DB_PORT=" "$ENV_FILE" | cut -d '=' -f2 | tr -d ' "'"'"')
MYSQL_DATABASE=$(grep "^DB_DATABASE=" "$ENV_FILE" | cut -d '=' -f2 | tr -d ' "'"'"')
MYSQL_USER=$(grep "^DB_USERNAME=" "$ENV_FILE" | cut -d '=' -f2 | tr -d ' "'"'"')
MYSQL_PASSWORD=$(grep "^DB_PASSWORD=" "$ENV_FILE" | cut -d '=' -f2 | tr -d ' "'"'"')

# ============================================
# Step 2: Find MySQL Client
# ============================================

MYSQL_CMD=$(which mysql 2>/dev/null)

if [ -z "$MYSQL_CMD" ]; then
    BREW_PREFIX=$(brew --prefix mysql-client 2>/dev/null)
    if [ -n "$BREW_PREFIX" ] && [ -f "$BREW_PREFIX/bin/mysql" ]; then
        MYSQL_CMD="$BREW_PREFIX/bin/mysql"
        export PATH="$BREW_PREFIX/bin:$PATH"
    fi
fi

if [ -z "$MYSQL_CMD" ]; then
    log_error "MySQL client not found!"
    echo "Install: brew install mysql-client"
    exit 1
fi

# ============================================
# Step 3: Check SQL File
# ============================================

if [ ! -f "$SQL_FILE" ]; then
    log_error "SQL file not found: $SQL_FILE"
    exit 1
fi

# ============================================
# Step 4: Interactive Options
# ============================================

log_warning "Database import options:"
echo "   1. Drop all tables first (fresh import)"
echo "   2. Skip errors if tables exist"
echo ""
read -p "Choose (1/2) [default: 1]: " OPTION
OPTION=${OPTION:-1}

# ============================================
# Step 5: Drop Tables (if option 1)
# ============================================

if [ "$OPTION" = "1" ]; then
    log_info "Dropping existing tables..."
    
    TABLES=$("$MYSQL_CMD" -h "$MYSQL_HOST" \
        -P "$MYSQL_PORT" \
        -u "$MYSQL_USER" \
        -p"$MYSQL_PASSWORD" \
        "$MYSQL_DATABASE" \
        -e "SHOW TABLES;" 2>/dev/null | tail -n +2)
    
    if [ -n "$TABLES" ]; then
        "$MYSQL_CMD" -h "$MYSQL_HOST" \
            -P "$MYSQL_PORT" \
            -u "$MYSQL_USER" \
            -p"$MYSQL_PASSWORD" \
            "$MYSQL_DATABASE" -e "
        SET FOREIGN_KEY_CHECKS = 0;
        DROP TABLE IF EXISTS $TABLES;
        SET FOREIGN_KEY_CHECKS = 1;
        " 2>/dev/null
        
        log_info "Tables dropped!"
    else
        log_info "No existing tables found."
    fi
fi

# ============================================
# Step 6: Import Database
# ============================================

log_info "Importing database..."

if [ "$OPTION" = "2" ]; then
    # Skip errors
    OUTPUT=$("$MYSQL_CMD" -h "$MYSQL_HOST" \
        -P "$MYSQL_PORT" \
        -u "$MYSQL_USER" \
        -p"$MYSQL_PASSWORD" \
        "$MYSQL_DATABASE" < "$SQL_FILE" 2>&1 | grep -v "ERROR 1050" || true)
else
    # Normal import
    OUTPUT=$("$MYSQL_CMD" -h "$MYSQL_HOST" \
        -P "$MYSQL_PORT" \
        -u "$MYSQL_USER" \
        -p"$MYSQL_PASSWORD" \
        "$MYSQL_DATABASE" < "$SQL_FILE" 2>&1)
fi

EXIT_CODE=$?

# ============================================
# Step 7: Check Result
# ============================================

if [ $EXIT_CODE -eq 0 ]; then
    log_info "Database imported successfully!"
    exit 0
else
    log_error "Import failed!"
    echo "$OUTPUT"
    exit 1
fi
```

### Template untuk PostgreSQL
```bash
#!/bin/bash

# PostgreSQL Import Template

# Load credentials
DB_HOST=$(grep "^DB_HOST=" .env | cut -d '=' -f2 | tr -d ' "'"'"')
DB_PORT=$(grep "^DB_PORT=" .env | cut -d '=' -f2 | tr -d ' "'"'"')
DB_NAME=$(grep "^DB_DATABASE=" .env | cut -d '=' -f2 | tr -d ' "'"'"')
DB_USER=$(grep "^DB_USERNAME=" .env | cut -d '=' -f2 | tr -d ' "'"'"')
DB_PASS=$(grep "^DB_PASSWORD=" .env | cut -d '=' -f2 | tr -d ' "'"'"')

# Find psql
PSQL_CMD=$(which psql 2>/dev/null)
if [ -z "$PSQL_CMD" ]; then
    BREW_PREFIX=$(brew --prefix postgresql@15 2>/dev/null)
    if [ -n "$BREW_PREFIX" ] && [ -f "$BREW_PREFIX/bin/psql" ]; then
        PSQL_CMD="$BREW_PREFIX/bin/psql"
    fi
fi

# Export password
export PGPASSWORD="$DB_PASS"

# Import
"$PSQL_CMD" -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USER" -d "$DB_NAME" -f database.sql
```

---

## 🎯 Quick Reference

### Command Cheat Sheet

```bash
# MySQL
mysql -h HOST -P PORT -u USER -pPASSWORD DATABASE < file.sql

# PostgreSQL
PGPASSWORD=PASSWORD psql -h HOST -p PORT -U USER -d DATABASE -f file.sql

# MongoDB
mongosh "mongodb://USER:PASSWORD@HOST:PORT/DATABASE" < file.js

# SQLite
sqlite3 database.db < file.sql
```

### Common Patterns

```bash
# Read .env variable
VAR=$(grep "^VAR_NAME=" .env | cut -d '=' -f2 | tr -d ' "'"'"')

# Check if command exists
if command -v mysql &> /dev/null; then
    echo "MySQL found!"
fi

# Check if file exists
if [ -f "file.sql" ]; then
    echo "File exists!"
fi

# Suppress errors
command 2>/dev/null

# Capture output
OUTPUT=$(command 2>&1)

# Check exit code
if [ $? -eq 0 ]; then
    echo "Success!"
fi
```

---

## 📚 Tips & Best Practices

1. **Always validate inputs** - Cek file exists, credentials not empty
2. **Use colors** - Lebih mudah dibaca output-nya
3. **Add logging** - Log ke file untuk debugging
4. **Handle errors gracefully** - Jangan crash, kasih pesan jelas
5. **Make it interactive** - User bisa pilih opsi
6. **Add progress indicator** - Untuk import besar
7. **Test locally first** - Jangan langsung ke production

---

## 🚀 Adaptasi untuk Project Lain

1. **Copy template script**
2. **Ganti database type** (MySQL → PostgreSQL, dll)
3. **Update .env variable names** (sesuai project)
4. **Adjust table names** (untuk drop tables)
5. **Test dengan database lokal dulu**
6. **Deploy ke production**

---

**Done!** Sekarang lo bisa buat script import database sendiri untuk project apapun! 🎉

