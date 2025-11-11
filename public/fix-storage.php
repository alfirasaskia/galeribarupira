<?php
/**
 * Fix Storage Link & Permissions
 * Akses: http://127.0.0.1:8000/fix-storage.php
 */

echo "<h1>Fix Storage Link & Permissions</h1>";

$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

echo "<h2>Step 1: Check Current Status</h2>";

if (is_link($link)) {
    echo "<p style='color: green;'>✓ Storage link exists (symlink/junction)</p>";
} elseif (is_dir($link)) {
    echo "<p style='color: orange;'>⚠ Storage is a directory (not a link)</p>";
} else {
    echo "<p style='color: red;'>✗ Storage link does NOT exist</p>";
}

echo "<h2>Step 2: Ensure Photos Directory Exists</h2>";

$photosDir = __DIR__ . '/../storage/app/public/photos';
if (!file_exists($photosDir)) {
    if (mkdir($photosDir, 0777, true)) {
        echo "<p style='color: green;'>✓ Created /storage/app/public/photos</p>";
    } else {
        echo "<p style='color: red;'>✗ Failed to create /storage/app/public/photos</p>";
    }
} else {
    echo "<p style='color: green;'>✓ /storage/app/public/photos already exists</p>";
}

// Set permissions
chmod($photosDir, 0777);
echo "<p>Set permissions to 0777</p>";

echo "<h2>Step 3: Create Storage Link</h2>";

if (is_link($link)) {
    echo "<p style='color: green;'>✓ Storage link already exists</p>";
} else {
    if (is_dir($link)) {
        echo "<p>Removing existing directory...</p>";
        // Remove directory recursively
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($link, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            $todo($fileinfo->getRealPath());
        }
        rmdir($link);
    }
    
    // Create link
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        // Windows
        $target_win = str_replace('/', '\\', $target);
        $link_win = str_replace('/', '\\', $link);
        $command = "mklink /J \"$link_win\" \"$target_win\"";
        
        echo "<p>Executing: <code>$command</code></p>";
        $output = shell_exec($command . " 2>&1");
        echo "<pre>$output</pre>";
        
        if (is_link($link) || is_dir($link)) {
            echo "<p style='color: green;'>✓ Storage link created successfully</p>";
        } else {
            echo "<p style='color: red;'>✗ Failed to create storage link</p>";
            echo "<p>Please run this command in Command Prompt (as Administrator):</p>";
            echo "<code>mklink /J \"$link_win\" \"$target_win\"</code>";
        }
    } else {
        // Unix/Linux
        if (symlink($target, $link)) {
            echo "<p style='color: green;'>✓ Storage link created successfully</p>";
        } else {
            echo "<p style='color: red;'>✗ Failed to create storage link</p>";
        }
    }
}

echo "<h2>Step 4: Verify Files</h2>";

$files = scandir($photosDir);
$imageFiles = array_filter($files, function($f) {
    return !in_array($f, ['.', '..']);
});

echo "<p>Files in /storage/app/public/photos: " . count($imageFiles) . "</p>";

if (count($imageFiles) > 0) {
    echo "<ul>";
    foreach (array_slice($imageFiles, 0, 5) as $file) {
        $fullPath = $photosDir . '/' . $file;
        $size = filesize($fullPath);
        $sizeKB = round($size / 1024, 2);
        echo "<li><code>$file</code> ({$sizeKB} KB)</li>";
    }
    if (count($imageFiles) > 5) {
        echo "<li>... and " . (count($imageFiles) - 5) . " more files</li>";
    }
    echo "</ul>";
}

echo "<h2>Step 5: Test URL Access</h2>";

if (count($imageFiles) > 0) {
    $testFile = array_values(array_filter($imageFiles, function($f) {
        return is_file($photosDir . '/' . $f);
    }))[0];
    
    $testUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/storage/photos/' . $testFile;
    echo "<p>Test URL: <a href='$testUrl' target='_blank'>$testUrl</a></p>";
    
    // Check if URL is accessible
    $headers = @get_headers($testUrl);
    if ($headers && strpos($headers[0], '200') !== false) {
        echo "<p style='color: green;'>✓ URL is accessible (200 OK)</p>";
    } else {
        echo "<p style='color: red;'>✗ URL is NOT accessible (" . (isset($headers[0]) ? $headers[0] : 'No response') . ")</p>";
    }
}

echo "<hr>";
echo "<p><a href='/pirawebgalery/admin/photos'>← Back to Admin Photos</a></p>";
?>
