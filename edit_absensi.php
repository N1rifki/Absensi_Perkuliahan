<?php
include 'koneksi.php';

// Cek apakah ada id yang diterima dari URL
if (isset($_GET['id'])) {
    $id_absensi = $_GET['id'];

    // Query untuk mendapatkan data absensi berdasarkan ID
    $query = "SELECT a.id_absensi, m.nama_mahasiswa, mk.nama_matakuliah, j.hari, j.jam_mulai, j.jam_selesai, a.tanggal, a.status
              FROM absensi a
              JOIN mahasiswa m ON a.id_mahasiswa = m.id_mahasiswa
              JOIN jadwal j ON a.id_jadwal = j.id_jadwal
              JOIN matakuliah mk ON j.id_matakuliah = mk.id_matakuliah
              WHERE a.id_absensi = $id_absensi";
    $result = mysqli_query($koneksi, $query);

    // Cek jika data ada
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
}

// Proses update absensi
if (isset($_POST['update'])) {
    $status = $_POST['status'];

    // Update data absensi
    $update_query = "UPDATE absensi SET status = '$status' WHERE id_absensi = $id_absensi";
    if (mysqli_query($koneksi, $update_query)) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto my-6">
        <h2 class="text-2xl font-semibold mb-4">Edit Absensi Mahasiswa</h2>

        <!-- Form Edit Absensi -->
        <form method="post" class="bg-white p-6 rounded-lg shadow-md">
            <!-- Nama Mahasiswa -->
            <label class="block mb-4">
                <span class="text-gray-700">Nama Mahasiswa</span>
                <input type="text" name="nama_mahasiswa" value="<?= $row['nama_mahasiswa']; ?>" disabled 
                       class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-50" />
            </label>

            <!-- Mata Kuliah -->
            <label class="block mb-4">
                <span class="text-gray-700">Mata Kuliah</span>
                <input type="text" name="mata_kuliah" value="<?= $row['nama_matakuliah']; ?>" disabled 
                       class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-50" />
            </label>

            <!-- Jadwal -->
            <label class="block mb-4">
                <span class="text-gray-700">Jadwal</span>
                <input type="text" name="jadwal" value="<?= $row['hari'] . ', ' . $row['jam_mulai'] . ' - ' . $row['jam_selesai']; ?>" disabled 
                       class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-50" />
            </label>

            <!-- Tanggal -->
            <label class="block mb-4">
                <span class="text-gray-700">Tanggal</span>
                <input type="text" value="<?= $row['tanggal']; ?>" disabled 
                       class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-50" />
            </label>

            <!-- Status -->
            <label class="block mb-4">
                <span class="text-gray-700">Status</span>
                <select name="status" class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-50">
                    <option value="Hadir" <?= ($row['status'] == 'Hadir') ? 'selected' : ''; ?>>Hadir</option>
                    <option value="Izin" <?= ($row['status'] == 'Izin') ? 'selected' : ''; ?>>Izin</option>
                    <option value="Sakit" <?= ($row['status'] == 'Sakit') ? 'selected' : ''; ?>>Sakit</option>
                    <option value="Alpha" <?= ($row['status'] == 'Alpha') ? 'selected' : ''; ?>>Alpha</option>
                </select>
            </label>

            <button type="submit" name="update" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Update</button>
        </form>
    </div>

</body>
</html>
