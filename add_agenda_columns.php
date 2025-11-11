<?php
// Script untuk menambahkan kolom ke table agenda
require 'vendor/autoload.php';
require 'bootstrap/app.php';

use Illuminate\Support\Facades\DB;

try {
    // Check if columns exist, if not add them
    $columns = DB::select("SHOW COLUMNS FROM agenda");
    $columnNames = array_map(function($col) { return $col->Field; }, $columns);
    
    if (!in_array('deskripsi', $columnNames)) {
        DB::statement('ALTER TABLE agenda ADD COLUMN deskripsi TEXT NULL AFTER judul');
        echo "✓ Kolom 'deskripsi' berhasil ditambahkan\n";
    } else {
        echo "✓ Kolom 'deskripsi' sudah ada\n";
    }
    
    if (!in_array('waktu_mulai', $columnNames)) {
        DB::statement('ALTER TABLE agenda ADD COLUMN waktu_mulai TIME NULL AFTER tanggal');
        echo "✓ Kolom 'waktu_mulai' berhasil ditambahkan\n";
    } else {
        echo "✓ Kolom 'waktu_mulai' sudah ada\n";
    }
    
    if (!in_array('waktu_selesai', $columnNames)) {
        DB::statement('ALTER TABLE agenda ADD COLUMN waktu_selesai TIME NULL AFTER waktu_mulai');
        echo "✓ Kolom 'waktu_selesai' berhasil ditambahkan\n";
    } else {
        echo "✓ Kolom 'waktu_selesai' sudah ada\n";
    }
    
    echo "\n✓ Semua kolom sudah siap!\n";
    
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
?>
