<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

// Proses penyimpanan data absensi
if (isset($_POST['submit'])) {
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $id_jadwal = $_POST['id_jadwal'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    // File upload handling
    $photo = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_name = $_FILES['photo']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_new_name = uniqid() . '.' . $file_ext;

        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $upload_path = $upload_dir . $file_new_name;
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $photo = $file_new_name;
        }
    }

    // Simpan data ke database
    $query = "INSERT INTO absensi (id_mahasiswa, id_jadwal, tanggal, status, photo) 
              VALUES ('$id_mahasiswa', '$id_jadwal', '$tanggal', '$status', '$photo')";
    if (mysqli_query($koneksi, $query)) {
        // Redirect ke dashboard.php setelah berhasil menyimpan data
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Gagal menyimpan data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masukan Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto my-6 px-4">
        <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-center uppercase text-blue-600">Welcome, <?= $_SESSION['username']; ?></h2>

        <!-- Tombol Logout -->
        <div class="mb-4 flex justify-between">
            <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 text-sm sm:text-base">Logout</a>
            <a href="dashboard.php" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm sm:text-base">Lihat Absensi</a>
        </div>

        <!-- Form Input Absensi -->
        <form action="" method="post" enctype="multipart/form-data" class="bg-white p-6 sm:p-8 rounded-lg shadow-md max-w-lg mx-auto">
            <label class="block mb-4">
                <span class="text-gray-700">Nama Mahasiswa</span>
                <select name="id_mahasiswa" required class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-50 focus:ring focus:ring-blue-300">
                    <?php
                    $query = "SELECT * FROM mahasiswa";
                    $result = mysqli_query($koneksi, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id_mahasiswa']}'>{$row['nama_mahasiswa']}</option>";
                    }
                    ?>
                </select>
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Jadwal</span>
                <select name="id_jadwal" required class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-50 focus:ring focus:ring-blue-300">
                    <?php
                    $query = "SELECT j.id_jadwal, mk.nama_matakuliah, j.hari, j.jam_mulai, j.jam_selesai
                              FROM jadwal j
                              JOIN matakuliah mk ON j.id_matakuliah = mk.id_matakuliah";
                    $result = mysqli_query($koneksi, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id_jadwal']}'>{$row['nama_matakuliah']} ({$row['hari']} - {$row['jam_mulai']} s/d {$row['jam_selesai']})</option>";
                    }
                    ?>
                </select>
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Tanggal</span>
                <input type="date" name="tanggal" required class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-50 focus:ring focus:ring-blue-300" />
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Status</span>
                <select name="status" required class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-50 focus:ring focus:ring-blue-300">
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Izin</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Alpha">Alpha</option>
                </select>
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Masukan Foto Mahasiswa</span>
                <input type="file" name="photo" accept="image/*" class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-50 focus:ring focus:ring-blue-300"required />
            </label>

            <button type="submit" name="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 w-full">Kirim Absen</button>
        </form>
    </div>
</body>
</html>
