<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\DB;

// Get all photos
$photos = DB::table('foto')->select('id', 'judul', 'file_path', 'file_name', 'created_at')->get();

echo "<h2>Debug: Foto di Database</h2>";
echo "<p>Total foto: " . count($photos) . "</p>";

if (count($photos) > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Judul</th><th>File Path</th><th>File Name</th><th>File Exists?</th><th>Full Path</th><th>URL</th></tr>";
    
    foreach ($photos as $photo) {
        $storagePath = storage_path('app/public/' . $photo->file_path);
        $fileExists = file_exists($storagePath) ? '✓ YES' : '✗ NO';
        $url = asset('storage/' . $photo->file_path);
        
        echo "<tr>";
        echo "<td>{$photo->id}</td>";
        echo "<td>{$photo->judul}</td>";
        echo "<td><code>{$photo->file_path}</code></td>";
        echo "<td><code>{$photo->file_name}</code></td>";
        echo "<td style='color: " . (file_exists($storagePath) ? 'green' : 'red') . ";'>{$fileExists}</td>";
        echo "<td><code style='font-size: 11px;'>{$storagePath}</code></td>";
        echo "<td><a href='{$url}' target='_blank'>View</a></td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>Tidak ada foto di database</p>";
}

// Check storage directories
echo "<hr>";
echo "<h2>Debug: Storage Directories</h2>";

$dirs = [
    'storage/app/public' => storage_path('app/public'),
    'storage/app/public/photos' => storage_path('app/public/photos'),
    'public/storage' => public_path('storage'),
    'public/storage/photos' => public_path('storage/photos'),
];

foreach ($dirs as $name => $path) {
    $exists = file_exists($path) ? '✓' : '✗';
    $isDir = is_dir($path) ? ' (DIR)' : ' (FILE)';
    echo "<p>{$exists} {$name}: <code>{$path}</code>{$isDir}</p>";
    
    if (is_dir($path)) {
        $files = @scandir($path);
        if ($files && count($files) > 2) {
            $fileCount = count($files) - 2; // exclude . and ..
            echo "<p style='margin-left: 20px; color: #666;'>→ {$fileCount} items</p>";
        }
    }
}
?>
