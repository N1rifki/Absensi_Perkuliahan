<?php
include 'koneksi.php';

$query = "SELECT a.id_absensi, m.nama_mahasiswa, mk.nama_matakuliah, j.hari, j.jam_mulai, j.jam_selesai, a.tanggal, a.status, a.photo
          FROM absensi a
          JOIN mahasiswa m ON a.id_mahasiswa = m.id_mahasiswa
          JOIN jadwal j ON a.id_jadwal = j.id_jadwal
          JOIN matakuliah mk ON j.id_matakuliah = mk.id_matakuliah";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto my-6">
        <h2 class="text-2xl font-semibold mb-4">Dashboard Absensi</h2>

        <a href="index.php" class="bg-green-500 text-white p-2 rounded hover:bg-green-600 mb-4 inline-block">Back to Absensi</a>

        <!-- Tabel Absensi -->
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Nama Mahasiswa</th>
                    <th class="px-4 py-2 text-left">Mata Kuliah</th>
                    <th class="px-4 py-2 text-left">Hari</th>
                    <th class="px-4 py-2 text-left">Jam</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Photo</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $photo_path = !empty($row['photo']) ? 'uploads/' . $row['photo'] : 'default-photo.jpg';
                        echo "<tr class='border-b'>
                                <td class='px-4 py-2'>$no</td>
                                <td class='px-4 py-2'>{$row['nama_mahasiswa']}</td>
                                <td class='px-4 py-2'>{$row['nama_matakuliah']}</td>
                                <td class='px-4 py-2'>{$row['hari']}</td>
                                <td class='px-4 py-2'>{$row['jam_mulai']} - {$row['jam_selesai']}</td>
                                <td class='px-4 py-2'>{$row['tanggal']}</td>
                                <td class='px-4 py-2'>{$row['status']}</td>
                                <td class='px-4 py-2'><img src='$photo_path' alt='Photo' class='w-16 h-16 rounded-lg object-cover'></td>
                                <td class='px-4 py-2'>
                                    <a href='edit_absensi.php?id={$row['id_absensi']}' class='bg-yellow-500 text-white p-2 rounded hover:bg-yellow-600'>Edit</a>
                                    <a href='hapus_absensi.php?id={$row['id_absensi']}' class='bg-red-500 text-white p-2 rounded hover:bg-red-600 ml-2' onclick='return confirm(\"Anda yakin ingin menghapus data absensi ini?\")'>Hapus</a>
                                </td>
                            </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='9' class='px-4 py-2 text-center'>Data absensi tidak tersedia.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>



<?php
include 'koneksi.php';

$query = "SELECT a.id_absensi, m.nama_mahasiswa, mk.nama_matakuliah, j.hari, j.jam_mulai, j.jam_selesai, a.tanggal, a.status, a.photo
          FROM absensi a
          JOIN mahasiswa m ON a.id_mahasiswa = m.id_mahasiswa
          JOIN jadwal j ON a.id_jadwal = j.id_jadwal
          JOIN matakuliah mk ON j.id_matakuliah = mk.id_matakuliah";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto my-6">
        <h2 class="text-2xl font-semibold mb-4">Dashboard Absensi</h2>

        <a href="index.php" class="bg-green-500 text-white p-2 rounded hover:bg-green-600 mb-4 inline-block">Back to Absensi</a>

        <!-- Tabel Absensi -->
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Nama Mahasiswa</th>
                    <th class="px-4 py-2 text-left">Mata Kuliah</th>
                    <th class="px-4 py-2 text-left">Hari</th>
                    <th class="px-4 py-2 text-left">Jam</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Photo</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $photo_path = !empty($row['photo']) ? 'uploads/' . $row['photo'] : 'default-photo.jpg';
                        echo "<tr class='border-b'>
                                <td class='px-4 py-2'>$no</td>
                                <td class='px-4 py-2'>{$row['nama_mahasiswa']}</td>
                                <td class='px-4 py-2'>{$row['nama_matakuliah']}</td>
                                <td class='px-4 py-2'>{$row['hari']}</td>
                                <td class='px-4 py-2'>{$row['jam_mulai']} - {$row['jam_selesai']}</td>
                                <td class='px-4 py-2'>{$row['tanggal']}</td>
                                <td class='px-4 py-2'>{$row['status']}</td>
                                <td class='px-4 py-2'><img src='$photo_path' alt='Photo' class='w-16 h-16 rounded-lg object-cover'></td>
                                <td class='px-4 py-2'>
                                    <a href='edit_absensi.php?id={$row['id_absensi']}' class='bg-yellow-500 text-white p-2 rounded hover:bg-yellow-600'>Edit</a>
                                    <a href='hapus_absensi.php?id={$row['id_absensi']}' class='bg-red-500 text-white p-2 rounded hover:bg-red-600 ml-2' onclick='return confirm(\"Anda yakin ingin menghapus data absensi ini?\")'>Hapus</a>
                                </td>
                            </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='9' class='px-4 py-2 text-center'>Data absensi tidak tersedia.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<!-- profil kampus -->
   <!-- Foto Profil Kampus -->
   <div class="container mx-auto my-6">
        <!-- Foto Profil Kampus -->
        <div class="text-center mb-6">
            <img src="images/Logo.png" alt="Foto Kampus" class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
            <h1 class="text-3xl font-bold text-blue-600 mt-4">APLIKASI ABSENSI BERBASIS WEB</h1>
        </div>
