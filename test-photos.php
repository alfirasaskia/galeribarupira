<?php
/**
 * Test Image URL Generation
 * Akses: http://127.0.0.1:8000/test-photos.php
 */

// Bootstrap Laravel
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

// Get the kernel
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

try {
    // Get all photos from database
    $photos = \Illuminate\Support\Facades\DB::table('foto')
        ->select('id', 'judul', 'file_path', 'file_name')
        ->limit(10)
        ->get();
    
    echo "<h1>📸 Image URL Test</h1>";
    echo "<p>Total photos: " . count($photos) . "</p>";
    
    if (count($photos) > 0) {
        echo "<table border='1' cellpadding='15' style='width: 100%; border-collapse: collapse; margin-top: 20px;'>";
        echo "<tr style='background: #f0f0f0;'>";
        echo "<th>ID</th>";
        echo "<th>Judul</th>";
        echo "<th>File Path</th>";
        echo "<th>File Exists?</th>";
        echo "<th>Generated URL</th>";
        echo "<th>Preview</th>";
        echo "</tr>";
        
        foreach ($photos as $photo) {
            $storagePath = __DIR__ . '/storage/app/public/' . $photo->file_path;
            $fileExists = file_exists($storagePath);
            
            // Generate URL using asset() helper
            $url = asset('storage/' . $photo->file_path);
            
            echo "<tr>";
            echo "<td>{$photo->id}</td>";
            echo "<td>{$photo->judul}</td>";
            echo "<td><code style='font-size: 11px; word-break: break-all;'>{$photo->file_path}</code></td>";
            echo "<td style='color: " . ($fileExists ? 'green' : 'red') . "; font-weight: bold;'>" . ($fileExists ? '✓ YES' : '✗ NO') . "</td>";
            echo "<td><code style='font-size: 11px; word-break: break-all;'>{$url}</code></td>";
            echo "<td>";
            if ($fileExists) {
                echo "<img src='{$url}' style='max-width: 100px; max-height: 100px; object-fit: cover; border: 1px solid #ddd;' onerror=\"this.style.display='none'; this.parentElement.innerHTML='Error loading'\">";
            } else {
                echo "<span style='color: red;'>File not found</span>";
            }
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        echo "<hr style='margin-top: 30px;'>";
        echo "<h2>📊 Summary</h2>";
        
        $existCount = 0;
        foreach ($photos as $photo) {
            $storagePath = __DIR__ . '/storage/app/public/' . $photo->file_path;
            if (file_exists($storagePath)) {
                $existCount++;
            }
        }
        
        echo "<p>Total photos: " . count($photos) . "</p>";
        echo "<p>Files that exist: " . $existCount . "</p>";
        echo "<p>Files missing: " . (count($photos) - $existCount) . "</p>";
        
        if ($existCount == count($photos)) {
            echo "<p style='color: green; font-weight: bold;'>✓ All files exist! Storage link is working correctly!</p>";
        } else {
            echo "<p style='color: red; font-weight: bold;'>✗ Some files are missing. Storage link may not be working.</p>";
        }
        
    } else {
        echo "<p style='color: orange;'>⚠ No photos in database</p>";
        echo "<p>Upload a photo first at: <a href='/pirawebgalery/admin/photos/index'>/admin/photos/index</a></p>";
    }
    
} catch (\Exception $e) {
    echo "<h1 style='color: red;'>Error</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p><strong>Stack trace:</strong></p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<hr>";
echo "<p><a href='/pirawebgalery/admin/photos/index'>← Back to Admin Photos</a></p>";
?>
