<?php
/**
 * Test Storage & File Access
 * Akses: http://localhost/pirawebgalery/test-storage.php
 */

echo "<h1>Test Storage & File Access</h1>";

// 1. Check storage link
echo "<h2>1. Storage Link Status</h2>";
$storageLink = __DIR__ . '/public/storage';
if (is_link($storageLink)) {
    echo "<p style='color: green;'>✓ Storage link exists (symlink/junction)</p>";
    echo "<p>Points to: " . readlink($storageLink) . "</p>";
} elseif (is_dir($storageLink)) {
    echo "<p style='color: orange;'>⚠ Storage is a directory (not a link)</p>";
} else {
    echo "<p style='color: red;'>✗ Storage link does NOT exist</p>";
}

// 2. Check photos directory
echo "<h2>2. Photos Directory</h2>";
$photosDir = __DIR__ . '/storage/app/public/photos';
if (is_dir($photosDir)) {
    echo "<p style='color: green;'>✓ /storage/app/public/photos exists</p>";
    $files = scandir($photosDir);
    $imageFiles = array_filter($files, function($f) {
        return !in_array($f, ['.', '..']);
    });
    echo "<p>Total files: " . count($imageFiles) . "</p>";
    
    if (count($imageFiles) > 0) {
        echo "<h3>Files in photos directory:</h3>";
        echo "<ul>";
        foreach ($imageFiles as $file) {
            $fullPath = $photosDir . '/' . $file;
            $size = filesize($fullPath);
            $sizeKB = round($size / 1024, 2);
            echo "<li><code>$file</code> ({$sizeKB} KB)</li>";
        }
        echo "</ul>";
    } else {
        echo "<p style='color: orange;'>⚠ No files in photos directory</p>";
    }
} else {
    echo "<p style='color: red;'>✗ /storage/app/public/photos does NOT exist</p>";
}

// 3. Check public/storage/photos
echo "<h2>3. Public Storage Photos</h2>";
$publicPhotos = __DIR__ . '/public/storage/photos';
if (is_dir($publicPhotos)) {
    echo "<p style='color: green;'>✓ /public/storage/photos exists</p>";
    $files = scandir($publicPhotos);
    $imageFiles = array_filter($files, function($f) {
        return !in_array($f, ['.', '..']);
    });
    echo "<p>Total files: " . count($imageFiles) . "</p>";
} else {
    echo "<p style='color: red;'>✗ /public/storage/photos does NOT exist</p>";
}

// 4. Test file access via URL
echo "<h2>4. Test File Access via URL</h2>";
$testFile = __DIR__ . '/storage/app/public/photos/.test';
if (!file_exists($testFile)) {
    file_put_contents($testFile, 'test');
}

$testUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/pirawebgalery/storage/photos/.test';
$testUrl2 = 'http://' . $_SERVER['HTTP_HOST'] . '/pirawebgalery/public/storage/photos/.test';

echo "<p>Testing URLs:</p>";
echo "<ul>";
echo "<li><a href='{$testUrl}' target='_blank'>{$testUrl}</a></li>";
echo "<li><a href='{$testUrl2}' target='_blank'>{$testUrl2}</a></li>";
echo "</ul>";

// 5. Database check
echo "<h2>5. Database Photos</h2>";
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

try {
    $photos = \Illuminate\Support\Facades\DB::table('foto')
        ->select('id', 'judul', 'file_path', 'file_name')
        ->limit(5)
        ->get();
    
    if (count($photos) > 0) {
        echo "<p>Found " . count($photos) . " photos in database</p>";
        echo "<table border='1' cellpadding='10' style='width: 100%;'>";
        echo "<tr><th>ID</th><th>Judul</th><th>File Path</th><th>File Exists?</th><th>URL</th></tr>";
        
        foreach ($photos as $photo) {
            $fullPath = __DIR__ . '/storage/app/public/' . $photo->file_path;
            $exists = file_exists($fullPath) ? '✓ YES' : '✗ NO';
            $color = file_exists($fullPath) ? 'green' : 'red';
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/pirawebgalery/storage/' . $photo->file_path;
            
            echo "<tr>";
            echo "<td>{$photo->id}</td>";
            echo "<td>{$photo->judul}</td>";
            echo "<td><code style='font-size: 11px;'>{$photo->file_path}</code></td>";
            echo "<td style='color: {$color};'>{$exists}</td>";
            echo "<td><a href='{$url}' target='_blank'>View</a></td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p style='color: orange;'>⚠ No photos in database</p>";
    }
} catch (\Exception $e) {
    echo "<p style='color: red;'>✗ Database error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p><a href='http://localhost/pirawebgalery/admin/photos'>← Back to Admin Photos</a></p>";
?>
