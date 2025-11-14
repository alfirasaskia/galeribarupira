<?php

/**
 * Image Optimization Script
 * Optimize semua images yang sudah ada di project
 * 
 * Usage: php optimize-images.php
 */

// Increase memory limit untuk handle large images
ini_set('memory_limit', '512M');
ini_set('max_execution_time', '0'); // No time limit

require __DIR__ . '/vendor/autoload.php';

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

$manager = new ImageManager(new Driver());

// Configuration
$config = [
    'max_width' => 1920,        // Max width untuk full image
    'max_height' => 1920,       // Max height untuk full image
    'quality' => 85,            // JPEG quality (0-100)
    'webp_quality' => 85,       // WebP quality (0-100)
    'thumbnail_width' => 400,   // Thumbnail width
    'thumbnail_height' => 400,  // Thumbnail height
    'medium_width' => 800,      // Medium size width
    'medium_height' => 800,     // Medium size height
];

// Directories to process
$directories = [
    public_path('uploads/photos'),
    public_path('uploads/fotos'),
    storage_path('app/public/photos'),
];

// Stats
$stats = [
    'processed' => 0,
    'optimized' => 0,
    'skipped' => 0,
    'errors' => 0,
    'original_size' => 0,
    'optimized_size' => 0,
];

echo "🚀 Starting Image Optimization...\n";
echo "================================\n\n";

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        echo "⚠️  Directory not found: $dir\n";
        continue;
    }

    echo "📁 Processing: $dir\n";
    
    $files = glob($dir . '/*.{jpg,jpeg,JPG,JPEG,png,PNG}', GLOB_BRACE);
    
    foreach ($files as $file) {
        $stats['processed']++;
        
        try {
            $originalSize = filesize($file);
            $stats['original_size'] += $originalSize;
            
            $pathInfo = pathinfo($file);
            $extension = strtolower($pathInfo['extension']);
            $filename = $pathInfo['filename'];
            $dirname = $pathInfo['dirname'];
            
            // Skip jika sudah di-optimize (ada file .webp atau _optimized)
            // Skip juga jika filename sudah mengandung _optimized (double optimization)
            if (strpos($filename, '_optimized') !== false) {
                echo "  ⏭️  Skipped (already optimized): " . basename($file) . "\n";
                $stats['skipped']++;
                continue;
            }
            
            if (file_exists($dirname . '/' . $filename . '.webp')) {
                echo "  ⏭️  Skipped (WebP exists): " . basename($file) . "\n";
                $stats['skipped']++;
                continue;
            }
            
            echo "  🔄 Processing: " . basename($file) . " (" . formatBytes($originalSize) . ")\n";
            
            // Load image (process one at a time to save memory)
            $image = $manager->read($file);
            
            // Get original dimensions
            $width = $image->width();
            $height = $image->height();
            
            // Resize jika terlalu besar
            if ($width > $config['max_width'] || $height > $config['max_height']) {
                $image->scaleDown($config['max_width'], $config['max_height']);
                echo "    📐 Resized: {$width}x{$height} → {$image->width()}x{$image->height()}\n";
            }
            
            // Save optimized JPEG
            $optimizedPath = $dirname . '/' . $filename . '_optimized.' . $extension;
            $image->toJpeg($config['quality'])->save($optimizedPath);
            
            // Generate WebP version
            $webpPath = $dirname . '/' . $filename . '.webp';
            $image->toWebp($config['webp_quality'])->save($webpPath);
            
            // Free memory - unset image
            unset($image);
            
            // Generate thumbnail (reload from file to save memory)
            $thumbnailDir = dirname($dir) . '/thumbnails';
            if (!is_dir($thumbnailDir)) {
                mkdir($thumbnailDir, 0755, true);
            }
            
            $thumbnail = $manager->read($file);
            $thumbnail->scaleDown($config['thumbnail_width'], $config['thumbnail_height']);
            $thumbnailPath = $thumbnailDir . '/' . $filename . '_thumb.' . $extension;
            $thumbnail->toJpeg(80)->save($thumbnailPath);
            
            // Generate WebP thumbnail
            $thumbnailWebpPath = $thumbnailDir . '/' . $filename . '_thumb.webp';
            $thumbnail->toWebp(80)->save($thumbnailWebpPath);
            
            // Free memory
            unset($thumbnail);
            
            // Generate medium size (reload from file)
            $mediumDir = dirname($dir) . '/medium';
            if (!is_dir($mediumDir)) {
                mkdir($mediumDir, 0755, true);
            }
            
            $medium = $manager->read($file);
            $medium->scaleDown($config['medium_width'], $config['medium_height']);
            $mediumPath = $mediumDir . '/' . $filename . '_medium.' . $extension;
            $medium->toJpeg($config['quality'])->save($mediumPath);
            
            // Generate WebP medium
            $mediumWebpPath = $mediumDir . '/' . $filename . '_medium.webp';
            $medium->toWebp($config['webp_quality'])->save($mediumWebpPath);
            
            // Free memory
            unset($medium);
            
            // Force garbage collection
            gc_collect_cycles();
            
            // Calculate savings
            $optimizedSize = filesize($optimizedPath);
            $stats['optimized_size'] += $optimizedSize;
            $savings = $originalSize - $optimizedSize;
            $savingsPercent = ($savings / $originalSize) * 100;
            
            echo "    ✅ Optimized: " . formatBytes($originalSize) . " → " . formatBytes($optimizedSize);
            echo " (Saved: " . formatBytes($savings) . " / " . number_format($savingsPercent, 1) . "%)\n";
            
            $stats['optimized']++;
            
        } catch (\Exception $e) {
            echo "    ❌ Error: " . $e->getMessage() . "\n";
            $stats['errors']++;
        }
    }
    
    echo "\n";
}

// Summary
echo "================================\n";
echo "📊 Optimization Summary\n";
echo "================================\n";
echo "Processed: {$stats['processed']} files\n";
echo "Optimized: {$stats['optimized']} files\n";
echo "Skipped: {$stats['skipped']} files\n";
echo "Errors: {$stats['errors']} files\n";
echo "\n";
echo "Original Size: " . formatBytes($stats['original_size']) . "\n";
echo "Optimized Size: " . formatBytes($stats['optimized_size']) . "\n";
$totalSavings = $stats['original_size'] - $stats['optimized_size'];
$totalSavingsPercent = $stats['original_size'] > 0 ? ($totalSavings / $stats['original_size']) * 100 : 0;
echo "Total Savings: " . formatBytes($totalSavings) . " (" . number_format($totalSavingsPercent, 1) . "%)\n";
echo "\n";
echo "✅ Optimization complete!\n";

function formatBytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    
    for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
        $bytes /= 1024;
    }
    
    return round($bytes, $precision) . ' ' . $units[$i];
}

function public_path($path = '') {
    return __DIR__ . '/public' . ($path ? '/' . ltrim($path, '/') : '');
}

function storage_path($path = '') {
    return __DIR__ . '/storage' . ($path ? '/' . ltrim($path, '/') : '');
}

