<?php

/**
 * Optimize Existing Photos from Database
 * Script ini akan:
 * 1. Ambil semua foto dari database
 * 2. Optimize file yang ada
 * 3. Generate WebP dan thumbnail
 * 4. Update database dengan info yang baru
 * 
 * Usage: php optimize-existing-photos.php
 */

// Increase memory limit untuk handle large images
ini_set('memory_limit', '512M');
ini_set('max_execution_time', '0'); // No time limit

define('LARAVEL_START', microtime(true));

require __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';

// Load environment variables
$app->loadEnvironmentFrom('.env');

// Bootstrap application
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

$manager = new ImageManager(new Driver());

// Configuration
$config = [
    'max_width' => 1920,
    'max_height' => 1920,
    'quality' => 85,
    'webp_quality' => 85,
    'thumbnail_width' => 400,
    'thumbnail_height' => 400,
];

// Stats
$stats = [
    'total' => 0,
    'processed' => 0,
    'optimized' => 0,
    'skipped' => 0,
    'errors' => 0,
    'original_size' => 0,
    'optimized_size' => 0,
];

echo "🚀 Starting Database Photo Optimization...\n";
echo "==========================================\n\n";

// Check for force flag
$force = in_array('--force', $argv) || in_array('-f', $argv);

if ($force) {
    echo "⚠️  FORCE MODE: Will re-optimize all photos (even if already optimized)\n\n";
}

// Get all photos from database
$photos = DB::table('foto')->get();
$stats['total'] = count($photos);

echo "📊 Found {$stats['total']} photos in database\n\n";

foreach ($photos as $photo) {
    $stats['processed']++;
    
    try {
        // Get file path
        $filePath = $photo->file_path;
        
        // Handle different path formats
        $fullPath = null;
        if (strpos($filePath, 'storage/') === 0) {
            $fullPath = storage_path('app/public/' . str_replace('storage/', '', $filePath));
        } elseif (strpos($filePath, 'photos/') === 0 || strpos($filePath, 'uploads/') === 0) {
            $fullPath = storage_path('app/public/' . $filePath);
        } elseif (strpos($filePath, 'public/') === 0) {
            $fullPath = public_path($filePath);
        } else {
            // Try storage first
            $fullPath = storage_path('app/public/' . $filePath);
            if (!file_exists($fullPath)) {
                // Try public
                $fullPath = public_path($filePath);
            }
        }
        
        // Check if file exists
        if (!file_exists($fullPath)) {
            echo "  ⚠️  [{$stats['processed']}/{$stats['total']}] File not found: {$filePath}\n";
            $stats['skipped']++;
            continue;
        }
        
        // Skip if already optimized (check for WebP version) - unless force mode
        $pathInfo = pathinfo($fullPath);
        $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
        if (!$force && file_exists($webpPath)) {
            echo "  ⏭️  [{$stats['processed']}/{$stats['total']}] Already optimized: {$photo->judul}\n";
            $stats['skipped']++;
            continue;
        }
        
        $originalSize = filesize($fullPath);
        $stats['original_size'] += $originalSize;
        
        echo "  🔄 [{$stats['processed']}/{$stats['total']}] Processing: {$photo->judul} (" . formatBytes($originalSize) . ")\n";
        
        // Load image
        $image = $manager->read($fullPath);
        
        // Get original dimensions
        $width = $image->width();
        $height = $image->height();
        
        // Resize if too large
        $wasResized = false;
        if ($width > $config['max_width'] || $height > $config['max_height']) {
            $image->scaleDown($config['max_width'], $config['max_height']);
            echo "    📐 Resized: {$width}x{$height} → {$image->width()}x{$image->height()}\n";
            $wasResized = true;
        }
        
        // Save optimized version (overwrite original if resized, or create new)
        if ($wasResized) {
            // Save optimized version
            $optimized = $image->toJpeg($config['quality']);
            file_put_contents($fullPath, $optimized);
            echo "    💾 Saved optimized version\n";
        }
        
        // Generate WebP version
        $webp = $image->toWebp($config['webp_quality']);
        file_put_contents($webpPath, $webp);
        echo "    🌐 Generated WebP version\n";
        
        // Free memory
        unset($image);
        
        // Generate thumbnail
        $thumbnailDir = dirname($fullPath) . '/../thumbnails';
        if (strpos($fullPath, 'public/') !== false) {
            $thumbnailDir = dirname($fullPath) . '/thumbnails';
        }
        
        if (!is_dir($thumbnailDir)) {
            mkdir($thumbnailDir, 0755, true);
        }
        
        $thumbnail = $manager->read($fullPath);
        $thumbnail->scaleDown($config['thumbnail_width'], $config['thumbnail_height']);
        $thumbnailPath = $thumbnailDir . '/' . basename($fullPath);
        $thumbnail->toJpeg(80)->save($thumbnailPath);
        
        // Generate WebP thumbnail
        $thumbWebpPath = $thumbnailDir . '/' . $pathInfo['filename'] . '.webp';
        $thumbnail->toWebp(80)->save($thumbWebpPath);
        
        // Free memory
        unset($thumbnail);
        gc_collect_cycles();
        
        // Calculate new file size
        $newSize = filesize($fullPath);
        $stats['optimized_size'] += $newSize;
        $savings = $originalSize - $newSize;
        $savingsPercent = ($savings / $originalSize) * 100;
        
        // Update database
        $updateData = [
            'file_size' => $newSize,
            'updated_at' => now(),
        ];
        
        // Update thumbnail_path if not set
        $relativeThumbPath = null;
        if (strpos($thumbnailPath, 'storage/app/public/') !== false) {
            $relativeThumbPath = str_replace(storage_path('app/public/'), '', $thumbnailPath);
        } elseif (strpos($thumbnailPath, 'public/') !== false) {
            $relativeThumbPath = str_replace(public_path(), '', $thumbnailPath);
            $relativeThumbPath = ltrim($relativeThumbPath, '/');
        }
        
        if ($relativeThumbPath && !$photo->thumbnail_path) {
            $updateData['thumbnail_path'] = $relativeThumbPath;
        }
        
        DB::table('foto')
            ->where('id', $photo->id)
            ->update($updateData);
        
        echo "    ✅ Optimized: " . formatBytes($originalSize) . " → " . formatBytes($newSize);
        echo " (Saved: " . formatBytes($savings) . " / " . number_format($savingsPercent, 1) . "%)\n";
        echo "    📝 Database updated\n\n";
        
        $stats['optimized']++;
        
    } catch (\Exception $e) {
        echo "    ❌ Error: " . $e->getMessage() . "\n";
        echo "    Stack: " . $e->getTraceAsString() . "\n\n";
        $stats['errors']++;
    }
}

// Summary
echo "==========================================\n";
echo "📊 Optimization Summary\n";
echo "==========================================\n";
echo "Total Photos: {$stats['total']}\n";
echo "Processed: {$stats['processed']}\n";
echo "Optimized: {$stats['optimized']}\n";
echo "Skipped: {$stats['skipped']}\n";
echo "Errors: {$stats['errors']}\n";
echo "\n";
echo "Original Total Size: " . formatBytes($stats['original_size']) . "\n";
echo "Optimized Total Size: " . formatBytes($stats['optimized_size']) . "\n";
$totalSavings = $stats['original_size'] - $stats['optimized_size'];
$totalSavingsPercent = $stats['original_size'] > 0 ? ($totalSavings / $stats['original_size']) * 100 : 0;
echo "Total Savings: " . formatBytes($totalSavings) . " (" . number_format($totalSavingsPercent, 1) . "%)\n";
echo "\n";
echo "✅ Optimization complete!\n";
echo "\n";
echo "💡 Tips:\n";
echo "   - WebP versions sudah di-generate untuk browser modern\n";
echo "   - Thumbnails sudah dibuat untuk loading yang lebih cepat\n";
echo "   - Database sudah di-update dengan file size yang baru\n";
echo "   - Website akan load lebih cepat sekarang! 🚀\n";

function formatBytes($bytes, $precision = 2) {
    if ($bytes == 0) return '0 B';
    
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    
    for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
        $bytes /= 1024;
    }
    
    return round($bytes, $precision) . ' ' . $units[$i];
}

