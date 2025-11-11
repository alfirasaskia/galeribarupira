<?php
/**
 * Check Photos - Simple Version
 * Akses: http://127.0.0.1:8000/check-photos.php
 */

echo "<h1>📸 Check Photos</h1>";

// Check storage directories
echo "<h2>1. Storage Directories</h2>";

$dirs = [
    'storage/app/public' => __DIR__ . '/../storage/app/public',
    'storage/app/public/photos' => __DIR__ . '/../storage/app/public/photos',
    'public/storage' => __DIR__ . '/storage',
];

foreach ($dirs as $name => $path) {
    $exists = file_exists($path) ? '✓' : '✗';
    $isDir = is_dir($path) ? ' (DIR)' : (is_link($path) ? ' (LINK)' : ' (FILE)');
    echo "<p>{$exists} {$name}: <code>{$path}</code>{$isDir}</p>";
    
    if (is_dir($path)) {
        $files = @scandir($path);
        if ($files && count($files) > 2) {
            $fileCount = count($files) - 2; // exclude . and ..
            echo "<p style='margin-left: 20px; color: #666;'>→ {$fileCount} items</p>";
        }
    }
}

// Check if we can access Laravel
echo "<h2>2. Try to Access Database</h2>";

try {
    // Try to load Laravel
    require_once __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    
    $photos = \Illuminate\Support\Facades\DB::table('foto')
        ->select('id', 'judul', 'file_path')
        ->limit(5)
        ->get();
    
    echo "<p style='color: green;'>✓ Database connected</p>";
    echo "<p>Total photos: " . count($photos) . "</p>";
    
    if (count($photos) > 0) {
        echo "<h3>Photos in Database:</h3>";
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Judul</th><th>File Path</th><th>File Exists?</th></tr>";
        
        foreach ($photos as $photo) {
            $fullPath = __DIR__ . '/../storage/app/public/' . $photo->file_path;
            $exists = file_exists($fullPath) ? '✓ YES' : '✗ NO';
            $color = file_exists($fullPath) ? 'green' : 'red';
            
            echo "<tr>";
            echo "<td>{$photo->id}</td>";
            echo "<td>{$photo->judul}</td>";
            echo "<td><code style='font-size: 11px;'>{$photo->file_path}</code></td>";
            echo "<td style='color: {$color};'>{$exists}</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
    
} catch (\Exception $e) {
    echo "<p style='color: red;'>✗ Database error: " . $e->getMessage() . "</p>";
}

// Manual file check
echo "<h2>3. Manual File Check</h2>";

$photosDir = __DIR__ . '/../storage/app/public/photos';
if (is_dir($photosDir)) {
    $files = scandir($photosDir);
    $imageFiles = array_filter($files, function($f) {
        return !in_array($f, ['.', '..']);
    });
    
    echo "<p>Files in /storage/app/public/photos: " . count($imageFiles) . "</p>";
    
    if (count($imageFiles) > 0) {
        echo "<ul>";
        foreach (array_slice($imageFiles, 0, 10) as $file) {
            $fullPath = $photosDir . '/' . $file;
            $size = filesize($fullPath);
            $sizeKB = round($size / 1024, 2);
            echo "<li><code>$file</code> ({$sizeKB} KB)</li>";
        }
        if (count($imageFiles) > 10) {
            echo "<li>... and " . (count($imageFiles) - 10) . " more files</li>";
        }
        echo "</ul>";
    }
} else {
    echo "<p style='color: red;'>✗ Photos directory not found</p>";
}

echo "<hr>";
echo "<p><a href='/pirawebgalery/admin/photos/index'>← Back to Admin Photos</a></p>";
?>
