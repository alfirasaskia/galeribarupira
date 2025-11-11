@echo off
REM Laravel Storage Link Setup
REM Run this as Administrator

cd /d "%~dp0"

echo ========================================
echo Laravel Storage Link Setup
echo ========================================
echo.

REM Check if artisan exists
if not exist "artisan" (
    echo Error: artisan file not found!
    echo Please run this script from project root directory
    pause
    exit /b 1
)

REM Run artisan storage:link command
echo Running: php artisan storage:link
echo.

php artisan storage:link

if %ERRORLEVEL% EQU 0 (
    echo.
    echo ✓ Storage link created successfully!
) else (
    echo.
    echo ✗ Failed to create storage link via artisan
    echo Trying manual method...
    echo.
    
    set TARGET=%CD%\storage\app\public
    set LINK=%CD%\public\storage
    
    if exist "%LINK%" (
        echo Storage link already exists
    ) else (
        mklink /J "%LINK%" "%TARGET%"
        if %ERRORLEVEL% EQU 0 (
            echo ✓ Storage link created successfully!
        ) else (
            echo ✗ Failed to create storage link
            echo Please run this script as Administrator
        )
    )
)

echo.
echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo Next steps:
echo 1. Open browser: http://127.0.0.1:8000/fix-storage.php
echo 2. Open browser: http://127.0.0.1:8000/test-image-url.php
echo 3. Go to: http://127.0.0.1:8000/admin/photos/index
echo 4. Upload a new photo
echo.
pause
