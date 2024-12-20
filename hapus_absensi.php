<?php
include 'koneksi.php';

// Cek apakah ada id yang diterima dari URL
if (isset($_GET['id'])) {
    $id_absensi = $_GET['id'];

    // Query untuk menghapus data absensi
    $query = "DELETE FROM absensi WHERE id_absensi = $id_absensi";
    if (mysqli_query($koneksi, $query)) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
