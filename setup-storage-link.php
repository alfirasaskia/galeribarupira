<?php
/**
 * Setup Storage Link untuk Windows
 * Jalankan file ini dari browser: http://localhost/pirawebgalery/setup-storage-link.php
 */

$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

echo "<h2>Setup Storage Link</h2>";
echo "<p>Target: $target</p>";
echo "<p>Link: $link</p>";

// Check if link already exists
if (file_exists($link)) {
    echo "<p style='color: green;'><strong>✓ Storage link sudah ada!</strong></p>";
    echo "<p>Link menunjuk ke: " . realpath($link) . "</p>";
} else {
    echo "<p style='color: orange;'><strong>⚠ Storage link belum ada, membuat...</strong></p>";
    
    try {
        // For Windows
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Create junction on Windows
            $target_win = str_replace('/', '\\', $target);
            $link_win = str_replace('/', '\\', $link);
            
            $command = "mklink /J \"$link_win\" \"$target_win\"";
            echo "<p>Menjalankan command: <code>$command</code></p>";
            
            $output = shell_exec($command . " 2>&1");
            echo "<pre>$output</pre>";
            
            if (file_exists($link)) {
                echo "<p style='color: green;'><strong>✓ Storage link berhasil dibuat!</strong></p>";
            } else {
                echo "<p style='color: red;'><strong>✗ Gagal membuat storage link via command.</strong></p>";
                echo "<p>Coba jalankan command berikut di Command Prompt (sebagai Administrator):</p>";
                echo "<code>mklink /J \"$link_win\" \"$target_win\"</code>";
            }
        } else {
            // Create symlink on Unix/Linux
            if (symlink($target, $link)) {
                echo "<p style='color: green;'><strong>✓ Storage link berhasil dibuat!</strong></p>";
            } else {
                echo "<p style='color: red;'><strong>✗ Gagal membuat storage link.</strong></p>";
            }
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'><strong>✗ Error: " . $e->getMessage() . "</strong></p>";
    }
}

// Check if photos directory exists
$photosDir = __DIR__ . '/storage/app/public/photos';
echo "<hr>";
echo "<h3>Cek Folder Foto</h3>";
if (file_exists($photosDir)) {
    echo "<p style='color: green;'><strong>✓ Folder /storage/app/public/photos ada</strong></p>";
    $files = scandir($photosDir);
    $imageFiles = array_filter($files, function($f) {
        return !in_array($f, ['.', '..']) && is_file($photosDir . '/' . $f);
    });
    echo "<p>Total file: " . count($imageFiles) . "</p>";
    if (count($imageFiles) > 0) {
        echo "<p>File yang ada:</p>";
        echo "<ul>";
        foreach (array_slice($imageFiles, 0, 10) as $file) {
            echo "<li>$file</li>";
        }
        if (count($imageFiles) > 10) {
            echo "<li>... dan " . (count($imageFiles) - 10) . " file lainnya</li>";
        }
        echo "</ul>";
    }
} else {
    echo "<p style='color: orange;'><strong>⚠ Folder /storage/app/public/photos tidak ada</strong></p>";
    echo "<p>Folder akan dibuat otomatis saat upload foto pertama.</p>";
}

echo "<hr>";
echo "<p><a href='http://localhost/pirawebgalery/admin/photos'>← Kembali ke Admin Photos</a></p>";
?>
