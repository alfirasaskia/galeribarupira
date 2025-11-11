<?php
/**
 * Test Image URL Generation
 * Akses: http://127.0.0.1:8000/test-image-url.php
 */

// Get all photos from database
require_once __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

try {
    $photos = \Illuminate\Support\Facades\DB::table('foto')
        ->select('id', 'judul', 'file_path', 'file_name')
        ->limit(10)
        ->get();
    
    echo "<h1>Image URL Test</h1>";
    echo "<p>Total photos: " . count($photos) . "</p>";
    
    if (count($photos) > 0) {
        echo "<table border='1' cellpadding='15' style='width: 100%; border-collapse: collapse;'>";
        echo "<tr style='background: #f0f0f0;'>";
        echo "<th>ID</th>";
        echo "<th>Judul</th>";
        echo "<th>File Path</th>";
        echo "<th>File Exists (storage)</th>";
        echo "<th>Generated URL</th>";
        echo "<th>URL Works?</th>";
        echo "<th>Preview</th>";
        echo "</tr>";
        
        foreach ($photos as $photo) {
            $storagePath = __DIR__ . '/../storage/app/public/' . $photo->file_path;
            $fileExists = file_exists($storagePath);
            
            // Generate URL using asset() helper
            $url = asset('storage/' . $photo->file_path);
            
            // Check if URL is accessible
            $urlWorks = 'Unknown';
            try {
                $headers = @get_headers($url);
                if ($headers && strpos($headers[0], '200') !== false) {
                    $urlWorks = '✓ YES (200)';
                } else {
                    $urlWorks = '✗ NO (' . (isset($headers[0]) ? $headers[0] : 'No response') . ')';
                }
            } catch (\Exception $e) {
                $urlWorks = '✗ Error: ' . $e->getMessage();
            }
            
            echo "<tr>";
            echo "<td>{$photo->id}</td>";
            echo "<td>{$photo->judul}</td>";
            echo "<td><code style='font-size: 11px; word-break: break-all;'>{$photo->file_path}</code></td>";
            echo "<td style='color: " . ($fileExists ? 'green' : 'red') . ";'>" . ($fileExists ? '✓ YES' : '✗ NO') . "</td>";
            echo "<td><code style='font-size: 11px; word-break: break-all;'>{$url}</code></td>";
            echo "<td>{$urlWorks}</td>";
            echo "<td>";
            if ($fileExists) {
                echo "<img src='{$url}' style='max-width: 100px; max-height: 100px; object-fit: cover; border: 1px solid #ddd;' onerror=\"this.innerHTML='Error loading'\">";
            } else {
                echo "File not found";
            }
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p>No photos in database</p>";
    }
    
} catch (\Exception $e) {
    echo "<h1 style='color: red;'>Error</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p><a href='/pirawebgalery/admin/photos'>← Back to Admin Photos</a></p>";
?>
