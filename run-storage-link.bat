@echo off
REM Storage Link Setup Script for Windows
REM Run this as Administrator

echo ========================================
echo Storage Link Setup for Pirawebgalery
echo ========================================
echo.

REM Get current directory
set CURRENT_DIR=%~dp0

REM Define paths
set TARGET=%CURRENT_DIR%storage\app\public
set LINK=%CURRENT_DIR%public\storage

echo Target: %TARGET%
echo Link: %LINK%
echo.

REM Check if link already exists
if exist "%LINK%" (
    echo Storage link already exists!
    echo.
    echo Checking if it's a junction...
    dir "%LINK%" | find "<JUNCTION>" >nul
    if %ERRORLEVEL% EQU 0 (
        echo ✓ It's a junction - OK
    ) else (
        echo ⚠ It's a directory - May need to recreate
    )
) else (
    echo Storage link does not exist. Creating...
    echo.
    mklink /J "%LINK%" "%TARGET%"
    if %ERRORLEVEL% EQU 0 (
        echo ✓ Storage link created successfully!
    ) else (
        echo ✗ Failed to create storage link
        echo Please run this script as Administrator
        pause
        exit /b 1
    )
)

echo.
echo ========================================
echo Creating photos directory...
echo ========================================

if not exist "%TARGET%\photos" (
    mkdir "%TARGET%\photos"
    echo ✓ Created photos directory
) else (
    echo ✓ Photos directory already exists
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
