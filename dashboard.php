<?php
include 'koneksi.php';

// Query data absensi
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
    <div class="container mx-auto my-6 px-4">
        <h2 class="text-2xl font-semibold mb-4 text-center uppercase text-blue-600">Dashboard Absensi</h2>

        <!-- Tombol Aksi -->
        <div class="mb-4 flex space-x-2 justify-between">
            <a href="print.php" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 text-sm sm:text-base">Cetak Absen</a>
            <a href="index.php" class="bg-green-500 text-white p-2 rounded hover:bg-red-600 text-sm sm:text-base">Kembali</a>
        </div>

        <!-- Tabel Absensi -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs sm:text-base">No</th>
                        <th class="px-4 py-2 text-left text-xs sm:text-base">Nama Mahasiswa</th>
                        <th class="px-4 py-2 text-left text-xs sm:text-base">Mata Kuliah</th>
                        <th class="px-4 py-2 text-left text-xs sm:text-base">Hari</th>
                        <th class="px-4 py-2 text-left text-xs sm:text-base">Jam</th>
                        <th class="px-4 py-2 text-left text-xs sm:text-base">Tanggal</th>
                        <th class="px-4 py-2 text-left text-xs sm:text-base">Status</th>
                        <th class="px-4 py-2 text-left text-xs sm:text-base">Photo</th>
                        <th class="px-4 py-2 text-left text-xs sm:text-base">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $photo_path = !empty($row['photo']) ? 'uploads/' . $row['photo'] : 'default-photo.jpg';
                            echo "<tr class='border-b'>
                                    <td class='px-4 py-2 text-xs sm:text-base'>$no</td>
                                    <td class='px-4 py-2 text-xs sm:text-base'>{$row['nama_mahasiswa']}</td>
                                    <td class='px-4 py-2 text-xs sm:text-base'>{$row['nama_matakuliah']}</td>
                                    <td class='px-4 py-2 text-xs sm:text-base'>{$row['hari']}</td>
                                    <td class='px-4 py-2 text-xs sm:text-base'>{$row['jam_mulai']} - {$row['jam_selesai']}</td>
                                    <td class='px-4 py-2 text-xs sm:text-base'>{$row['tanggal']}</td>
                                    <td class='px-4 py-2 text-xs sm:text-base'>{$row['status']}</td>
                                    <td class='px-4 py-2 text-xs sm:text-base'>
                                        <img src='$photo_path' alt='Photo' class='w-16 h-16 rounded-lg object-cover'>
                                    </td>
                                    <td class='px-4 py-2 text-xs sm:text-base'>
                                        <div class='flex flex-col sm:flex-row sm:space-x-2 space-y-2 sm:space-y-0'>
                                            <a href='edit_absensi.php?id={$row['id_absensi']}' class='bg-yellow-500 text-white p-2 rounded hover:bg-yellow-600 text-xs sm:text-base'>Edit</a>
                                            <a href='hapus_absensi.php?id={$row['id_absensi']}' class='bg-red-500 text-white p-2 rounded hover:bg-red-600 text-xs sm:text-base' onclick='return confirm(\"Anda yakin ingin menghapus data absensi ini?\")'>Hapus</a>
                                        </div>
                                    </td>
                                </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='9' class='px-4 py-2 text-center text-xs sm:text-base'>Data absensi tidak tersedia.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
