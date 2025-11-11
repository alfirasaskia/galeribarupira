<?php
// Direct database connection to add columns
$host = 'localhost';
$db = 'pira_webgalery';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get existing columns
    $stmt = $pdo->query("SHOW COLUMNS FROM agenda");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $columnNames = array_map(function($col) { return $col['Field']; }, $columns);
    
    // Add deskripsi column
    if (!in_array('deskripsi', $columnNames)) {
        $pdo->exec('ALTER TABLE agenda ADD COLUMN deskripsi TEXT NULL AFTER judul');
        echo "✓ Kolom 'deskripsi' berhasil ditambahkan\n";
    } else {
        echo "✓ Kolom 'deskripsi' sudah ada\n";
    }
    
    // Add waktu_mulai column
    if (!in_array('waktu_mulai', $columnNames)) {
        $pdo->exec('ALTER TABLE agenda ADD COLUMN waktu_mulai TIME NULL AFTER tanggal');
        echo "✓ Kolom 'waktu_mulai' berhasil ditambahkan\n";
    } else {
        echo "✓ Kolom 'waktu_mulai' sudah ada\n";
    }
    
    // Add waktu_selesai column
    if (!in_array('waktu_selesai', $columnNames)) {
        $pdo->exec('ALTER TABLE agenda ADD COLUMN waktu_selesai TIME NULL AFTER waktu_mulai');
        echo "✓ Kolom 'waktu_selesai' berhasil ditambahkan\n";
    } else {
        echo "✓ Kolom 'waktu_selesai' sudah ada\n";
    }
    
    echo "\n✓✓✓ Semua kolom sudah siap! ✓✓✓\n";
    echo "Silakan refresh halaman http://127.0.0.1:8000/admin/agenda/17\n";
    
} catch (PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
?>
