<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    private static $manager;
    
    private static function getManager()
    {
        if (!self::$manager) {
            self::$manager = new ImageManager(new Driver());
        }
        return self::$manager;
    }
    
    /**
     * Optimize image saat upload
     */
    public static function optimizeUpload($file, $path, $disk = 'public')
    {
        $manager = self::getManager();
        
        try {
            // Load image
            $image = $manager->read($file->getRealPath());
            
            // Resize jika terlalu besar (max 1920px)
            if ($image->width() > 1920 || $image->height() > 1920) {
                $image->scaleDown(1920, 1920);
            }
            
            // Save optimized JPEG
            $optimized = $image->toJpeg(85);
            Storage::disk($disk)->put($path, $optimized);
            
            // Generate WebP version
            $webpPath = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $path);
            $webp = $image->toWebp(85);
            Storage::disk($disk)->put($webpPath, $webp);
            
            // Generate thumbnail
            $thumbnail = $manager->read($file->getRealPath());
            $thumbnail->scaleDown(400, 400);
            $thumbPath = 'thumbnails/' . basename($path);
            Storage::disk($disk)->put($thumbPath, $thumbnail->toJpeg(80));
            
            // Generate WebP thumbnail
            $thumbWebpPath = 'thumbnails/' . basename($webpPath);
            Storage::disk($disk)->put($thumbWebpPath, $thumbnail->toWebp(80));
            
            return [
                'original' => $path,
                'webp' => $webpPath,
                'thumbnail' => $thumbPath,
                'thumbnail_webp' => $thumbWebpPath,
            ];
            
        } catch (\Exception $e) {
            \Log::error('Image optimization failed: ' . $e->getMessage());
            // Fallback: save original
            Storage::disk($disk)->put($path, file_get_contents($file->getRealPath()));
            return ['original' => $path];
        }
    }
    
    /**
     * Get optimized image URL dengan fallback
     */
    public static function getOptimizedUrl($path, $size = 'original')
    {
        if (!$path) {
            return asset('images/placeholder.jpg');
        }
        
        // Check if WebP supported
        $supportsWebp = isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false;
        
        // Generate paths
        $pathInfo = pathinfo($path);
        $dirname = $pathInfo['dirname'];
        $filename = $pathInfo['filename'];
        $extension = $pathInfo['extension'] ?? 'jpg';
        
        // Size mapping
        $sizeMap = [
            'thumbnail' => 'thumbnails',
            'medium' => 'medium',
            'original' => '',
        ];
        
        $sizeDir = $sizeMap[$size] ?? '';
        $basePath = $sizeDir ? $sizeDir . '/' : '';
        
        // Try WebP first if supported
        if ($supportsWebp) {
            $webpPath = $basePath . $filename . '.webp';
            if (Storage::disk('public')->exists($webpPath)) {
                return Storage::disk('public')->url($webpPath);
            }
        }
        
        // Fallback to optimized JPEG
        if ($size === 'original') {
            $optimizedPath = $dirname . '/' . $filename . '_optimized.' . $extension;
            if (Storage::disk('public')->exists($optimizedPath)) {
                return Storage::disk('public')->url($optimizedPath);
            }
        } else {
            $sizePath = $basePath . $filename . '_' . $size . '.' . $extension;
            if (Storage::disk('public')->exists($sizePath)) {
                return Storage::disk('public')->url($sizePath);
            }
        }
        
        // Fallback to original
        return Storage::disk('public')->url($path);
    }
    
    /**
     * Generate responsive image srcset
     */
    public static function getSrcSet($path, $sizes = ['400', '800', '1200', '1920'])
    {
        if (!$path) {
            return '';
        }
        
        $srcset = [];
        $pathInfo = pathinfo($path);
        $filename = $pathInfo['filename'];
        $extension = $pathInfo['extension'] ?? 'jpg';
        
        // Check WebP support
        $supportsWebp = isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false;
        $ext = $supportsWebp ? 'webp' : $extension;
        
        foreach ($sizes as $size) {
            $sizePath = $pathInfo['dirname'] . '/' . $filename . '_' . $size . 'w.' . $ext;
            if (Storage::disk('public')->exists($sizePath)) {
                $url = Storage::disk('public')->url($sizePath);
                $srcset[] = $url . ' ' . $size . 'w';
            }
        }
        
        return implode(', ', $srcset);
    }
    
    /**
     * Get image with lazy loading attributes
     */
    public static function lazyImage($path, $alt = '', $class = '', $size = 'original')
    {
        $url = self::getOptimizedUrl($path, $size);
        $srcset = self::getSrcSet($path);
        
        $attributes = [
            'src' => $url,
            'alt' => $alt,
            'class' => $class . ' lazy',
            'loading' => 'lazy',
            'decoding' => 'async',
        ];
        
        if ($srcset) {
            $attributes['srcset'] = $srcset;
            $attributes['sizes'] = '(max-width: 400px) 400px, (max-width: 800px) 800px, 1200px';
        }
        
        $attrString = '';
        foreach ($attributes as $key => $value) {
            $attrString .= ' ' . $key . '="' . htmlspecialchars($value) . '"';
        }
        
        return '<img' . $attrString . '>';
    }
}

