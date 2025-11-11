<?php
/**
 * Test URL Access
 * Akses: http://127.0.0.1:8000/test-url.php
 */

echo "<h1>Test URL Access</h1>";

// List files in storage/photos
$photosDir = __DIR__ . '/../storage/app/public/photos';

echo "<h2>Files in /storage/app/public/photos:</h2>";

if (is_dir($photosDir)) {
    $files = scandir($photosDir);
    $imageFiles = array_filter($files, function($f) {
        return !in_array($f, ['.', '..']);
    });
    
    if (count($imageFiles) > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Filename</th><th>Size</th><th>URL</th><th>Test Link</th></tr>";
        
        foreach ($imageFiles as $file) {
            $fullPath = $photosDir . '/' . $file;
            $size = filesize($fullPath);
            $sizeKB = round($size / 1024, 2);
            
            // Generate URL
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/storage/photos/' . $file;
            
            echo "<tr>";
            echo "<td><code>$file</code></td>";
            echo "<td>{$sizeKB} KB</td>";
            echo "<td><code style='font-size: 11px;'>$url</code></td>";
            echo "<td><a href='$url' target='_blank'>Open</a></td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        echo "<h2>Test Images:</h2>";
        
        foreach (array_slice($imageFiles, 0, 3) as $file) {
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/storage/photos/' . $file;
            echo "<div style='margin: 20px 0; border: 1px solid #ddd; padding: 10px;'>";
            echo "<p><strong>$file</strong></p>";
            echo "<img src='$url' style='max-width: 300px; max-height: 300px; object-fit: cover; border: 1px solid #ccc;' onerror=\"this.style.border='3px solid red'; this.style.background='#ffcccc';\">";
            echo "</div>";
        }
        
    } else {
        echo "<p>No files found</p>";
    }
} else {
    echo "<p>Directory not found: $photosDir</p>";
}

echo "<hr>";
echo "<p><a href='/pirawebgalery/admin/photos/index'>← Back to Admin Photos</a></p>";
?>
