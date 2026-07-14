<?php

require_once 'config/Config.php';
require_once 'config/Database.php';

try {
    // Connect to MySQL first without database name to create database if it doesn't exist
    $pdo = new PDO(
        "mysql:host=" . Config::HOST,
        Config::USER,
        Config::PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . Config::DBNAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
    echo "Database `" . Config::DBNAME . "` berhasil dibuat atau sudah ada.<br>";

    // Reconnect to the specific database
    $pdo = new PDO(
        "mysql:host=" . Config::HOST . ";dbname=" . Config::DBNAME,
        Config::USER,
        Config::PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Read the SQL file
    $sqlFile = 'database/inventoryhub_db.sql';
    if (!file_exists($sqlFile)) {
        die("Error: File SQL tidak ditemukan di $sqlFile");
    }

    $sql = file_get_contents($sqlFile);

    // Execute the SQL queries
    $pdo->exec($sql);

    echo "<h3>Inisialisasi Database Berhasil!</h3>";
    echo "<p>Semua tabel telah dibuat dan data seeder berhasil dimasukkan.</p>";
    echo "<a href='" . BASE_URL . "'>Kembali ke Halaman Utama</a>";

} catch (PDOException $e) {
    echo "<h3>Terjadi Kesalahan saat Inisialisasi Database:</h3>";
    echo "<p style='color:red;'>" . $e->getMessage() . "</p>";
}
