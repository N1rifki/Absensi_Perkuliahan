<?php
// Konfigurasi database
$host = "localhost";       // Host database, biasanya "localhost"
$user = "root";            // Username database, default biasanya "root"
$password = "";            // Password database, kosong jika default
$dbname = "absensi_perkuliahan"; // Nama database

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $password, $dbname);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

?>
