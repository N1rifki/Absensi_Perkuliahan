-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Des 2024 pada 03.51
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_perkuliahan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpha') NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nama_dosen`, `email`, `no_hp`) VALUES
(1, 'Dr. Ahmad Fauzi', 'ahmadfauzi@gmail.com', '081234567890'),
(2, 'Prof. Siti Rahmawati', 'siti.rahmawati@yahoo.com', '082234567890'),
(3, 'Ir. Budi Santoso', 'budi.santoso@outlook.com', '083234567890'),
(4, 'Dr. Andi Prasetyo', 'andi.prasetyo@gmail.com', '084234567890'),
(5, 'Prof. Lina Suryani', 'lina.suryani@u.edu', '085234567890'),
(6, 'Dr. Ahmad Santoso', 'ahmad.santoso@example.com', '081234567890'),
(7, 'Prof. Rina Suryani', 'rina.suryani@example.com', '081234567891'),
(8, 'Dr. Budi Pratama', 'budi.pratama@example.com', '081234567892'),
(9, 'Prof. Wati Rahmawati', 'wati.rahmawati@example.com', '081234567893'),
(10, 'Dr. Sutrisno', 'sutrisno@example.com', '081234567894'),
(11, 'Prof. Adi Wijaya', 'adi.wijaya@example.com', '081234567895'),
(12, 'Dr. Indah Permata', 'indah.permata@example.com', '081234567896'),
(13, 'Dr. Rendra Saputra', 'rendra.saputra@example.com', '081234567897'),
(14, 'Prof. Siti Aminah', 'siti.aminah@example.com', '081234567898'),
(15, 'Dr. Bagus Firmansyah', 'bagus.firmansyah@example.com', '081234567899'),
(36, 'Dr. Budi Santoso', 'budi.santoso@univ.edu', '081234567890'),
(37, 'Prof. Lina Marlina', 'lina.marlina@univ.edu', '081234567891'),
(38, 'Dr. Aditya Kusuma', 'aditya.kusuma@univ.edu', '081234567892'),
(39, 'Dr. Siti Aminah', 'siti.aminah@univ.edu', '081234567893'),
(40, 'Dr. Bambang Widodo', 'bambang.widodo@univ.edu', '081234567894'),
(41, 'Prof. Indah Permata', 'indah.permata@univ.edu', '081234567895'),
(42, 'Dr. Agus Salim', 'agus.salim@univ.edu', '081234567896'),
(43, 'Dr. Fitri Ayu', 'fitri.ayu@univ.edu', '081234567897'),
(44, 'Prof. Joko Purwanto', 'joko.purwanto@univ.edu', '081234567898'),
(45, 'Dr. Dewi Ratnasari', 'dewi.ratnasari@univ.edu', '081234567899');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_matakuliah` int(11) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `ruang` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_dosen`, `id_matakuliah`, `hari`, `jam_mulai`, `jam_selesai`, `ruang`) VALUES
(1, 1, 1, 'Senin', '08:00:00', '10:00:00', 'Ruang 101'),
(2, 2, 2, 'Selasa', '09:00:00', '11:00:00', 'Ruang 102'),
(3, 3, 3, 'Rabu', '10:00:00', '12:00:00', 'Ruang 103'),
(4, 4, 4, 'Kamis', '13:00:00', '15:00:00', 'Ruang 104'),
(5, 5, 5, 'Jumat', '08:00:00', '10:00:00', 'Ruang 105'),
(6, 1, 1, 'Senin', '08:00:00', '10:00:00', 'Ruang 101'),
(7, 2, 2, 'Selasa', '10:00:00', '12:00:00', 'Ruang 102'),
(8, 3, 3, 'Rabu', '13:00:00', '15:00:00', 'Ruang 103'),
(9, 4, 4, 'Kamis', '15:00:00', '17:00:00', 'Ruang 104'),
(10, 5, 5, 'Jumat', '08:00:00', '10:00:00', 'Ruang 105'),
(11, 6, 6, 'Sabtu', '10:00:00', '12:00:00', 'Ruang 106'),
(12, 7, 7, 'Senin', '13:00:00', '15:00:00', 'Ruang 107'),
(13, 8, 8, 'Selasa', '15:00:00', '17:00:00', 'Ruang 108'),
(14, 9, 9, 'Rabu', '08:00:00', '10:00:00', 'Ruang 109'),
(15, 10, 10, 'Kamis', '10:00:00', '12:00:00', 'Ruang 110');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `nim` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `email`, `no_hp`, `nim`) VALUES
(1, 'Alya Azzahra', 'rina.maulani@students.com', '089123456789', '1234567890'),
(2, 'Rifki Eko Satrio', 'eko.prasetyo@students.com', '089223456789', '1234567891'),
(3, 'Angga Erdiyanto', 'fauzi.ramadhan@students.com', '089323456789', '1234567892'),
(4, 'Felisa Aprilia', 'dina.kurniawati@students.com', '089423456789', '1234567893'),
(5, 'Vina Mauliana', 'budi.setiawan@students.com', '089523456789', '1234567894'),
(11, 'Aulia Putri', 'aulia.putri@example.com', '08111111111', '210001'),
(12, 'Fadli Akbar', 'fadli.akbar@example.com', '08111111112', '210002'),
(13, 'Siti Nurhaliza', 'siti.nurhaliza@example.com', '08111111113', '210003'),
(14, 'Rizky Ramadhan', 'rizky.ramadhan@example.com', '08111111114', '210004'),
(15, 'Dewi Anggraini', 'dewi.anggraini@example.com', '08111111115', '210005'),
(16, 'Bayu Prasetyo', 'bayu.prasetyo@example.com', '08111111116', '210006'),
(17, 'Nina Safitri', 'nina.safitri@example.com', '08111111117', '210007'),
(18, 'Eka Puspita Sari', 'EkaPuspitaSari@example.com', '08111111118', '210008'),
(19, 'Citra Larasati', 'citra.larasati@example.com', '08111111119', '210009'),
(20, 'Dewi Kirana', 'dewikirana@example.com', '08111111110', '210010');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id_matakuliah` int(11) NOT NULL,
  `nama_matakuliah` varchar(100) NOT NULL,
  `kode_matakuliah` varchar(20) NOT NULL,
  `sks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `matakuliah`
--

INSERT INTO `matakuliah` (`id_matakuliah`, `nama_matakuliah`, `kode_matakuliah`, `sks`) VALUES
(1, 'Pemrograman Web', 'PW101', 3),
(2, 'Basis Data', 'BD101', 3),
(3, 'Algoritma dan Struktur Data', 'ASD101', 3),
(4, 'Matematika Diskrit', 'MD101', 2),
(5, 'Jaringan Komputer', 'JK101', 3),
(6, 'Pemrograman Web', 'IF101', 3),
(7, 'Kalkulus', 'MT101', 4),
(8, 'Basis Data', 'IF102', 3),
(9, 'Struktur Data', 'IF103', 3),
(10, 'Sistem Operasi', 'IF104', 3),
(11, 'Jaringan Komputer', 'IF105', 3),
(12, 'Statistika', 'MT102', 2),
(13, 'Pengembangan Aplikasi Mobile', 'IF106', 3),
(14, 'Kecerdasan Buatan', 'IF107', 3),
(15, 'Algoritma Pemrograman', 'IF108', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`) VALUES
(1, 'rifki', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_matakuliah` (`id_matakuliah`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indeks untuk tabel `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id_matakuliah`),
  ADD UNIQUE KEY `kode_matakuliah` (`kode_matakuliah`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id_matakuliah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`),
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`);

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah` (`id_matakuliah`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
