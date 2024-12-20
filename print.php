<?php
include 'koneksi.php';

// Ambil data absensi dari database
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
    <title>Cetak Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border: 1px solid #ccc;
            }
        }
        img {
            max-width: 50px;
            max-height: 50px;
            object-fit: cover;
            border-radius: 0.25rem;
        }
    </style>
</head>
<body class="bg-white text-gray-800">
    <div class="container mx-auto py-6 px-4">
        <div class="text-center mb-4">
            <h1 class="text-3xl font-bold text-blue-600">APLIKASI ABSENSI BERBASIS WEB</h1>
            <h2 class="text-xl font-semibold text-gray-700">Laporan Data Absensi</h2>
        </div>

        <!-- Tabel Absensi -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-4 py-2 text-left text-gray-600 font-semibold border text-xs sm:text-base">ID Absensi</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-semibold border text-xs sm:text-base">Nama Mahasiswa</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-semibold border text-xs sm:text-base">Mata Kuliah</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-semibold border text-xs sm:text-base">Hari</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-semibold border text-xs sm:text-base">Jam</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-semibold border text-xs sm:text-base">Tanggal</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-semibold border text-xs sm:text-base">Status</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-semibold border text-xs sm:text-base">Photo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <?php
                            // Menentukan path foto
                            $photo_path = !empty($row['photo']) ? 'uploads/' . htmlspecialchars($row['photo']) : 'default-photo.jpg';
                            ?>
                            <tr class="border-b">
                                <td class="px-4 py-2 border text-xs sm:text-base"><?= htmlspecialchars($row['id_absensi']); ?></td>
                                <td class="px-4 py-2 border text-xs sm:text-base"><?= htmlspecialchars($row['nama_mahasiswa']); ?></td>
                                <td class="px-4 py-2 border text-xs sm:text-base"><?= htmlspecialchars($row['nama_matakuliah']); ?></td>
                                <td class="px-4 py-2 border text-xs sm:text-base"><?= htmlspecialchars($row['hari']); ?></td>
                                <td class="px-4 py-2 border text-xs sm:text-base"><?= htmlspecialchars($row['jam_mulai']) . ' - ' . htmlspecialchars($row['jam_selesai']); ?></td>
                                <td class="px-4 py-2 border text-xs sm:text-base"><?= htmlspecialchars($row['tanggal']); ?></td>
                                <td class="px-4 py-2 border text-xs sm:text-base"><?= htmlspecialchars($row['status']); ?></td>
                                <td class="px-4 py-2 border text-xs sm:text-base">
                                    <img src="<?= $photo_path; ?>" alt="Photo">
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center px-4 py-2 text-gray-500">Tidak ada data absensi</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6 text-center">
            <button class="no-print bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 text-xs sm:text-base" onclick="window.print();">Cetak</button>
            <a href="dashboard.php" class="no-print bg-green-500 text-white py-2 px-4 rounded hover:bg-red-600 ml-4 text-xs sm:text-base">Kembali</a>
        </div>
    </div>
</body>
</html>
