-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2021 at 05:22 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spp`
--
CREATE DATABASE `db_spp`;
-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `kompetensi_keahlian`) VALUES
(1, 'XII', 'OTKP'),
(5, 'XI', 'TKJ'),
(6, 'XI', 'OTKP'),
(8, 'X', 'TKJ'),
(9, 'XII', 'TKJ'),
(10, 'X', 'OTKP'),
(11, 'X', 'RPL'),
(12, 'XII', 'RPL'),
(13, 'XI', 'RPL');

-- --------------------------------------------------------

--
-- Table structure for table `log_petugas`
--

CREATE TABLE `log_petugas` (
  `id_log_petugas` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nama_petugas_baru` varchar(128) NOT NULL,
  `nama_petugas_lama` varchar(128) NOT NULL,
  `email_baru` varchar(128) NOT NULL,
  `email_lama` varchar(128) NOT NULL,
  `no_telp_lama` varchar(128) NOT NULL,
  `no_telp_baru` varchar(128) NOT NULL,
  `alamat_lama` text NOT NULL,
  `alamat_baru` text NOT NULL,
  `posisi_lama` varchar(128) NOT NULL,
  `posisi_baru` varchar(128) NOT NULL,
  `tgl_diubah` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_petugas`
--

INSERT INTO `log_petugas` (`id_log_petugas`, `id_petugas`, `nama_petugas_baru`, `nama_petugas_lama`, `email_baru`, `email_lama`, `no_telp_lama`, `no_telp_baru`, `alamat_lama`, `alamat_baru`, `posisi_lama`, `posisi_baru`, `tgl_diubah`) VALUES
(1, 2, 'Ajeng Mae', 'Ajeng Maelani', 'ajengm@gmail.com', 'ajeng@gmail.com', '08945432222', '08945432323', 'Jl.Cibaduyut Raya', 'Jl.Cibaduyut', 'Petugas', 'Admin', '2021-04-01'),
(2, 2, 'Ajeng Maelani', 'Ajeng Mae', 'ajeng@gmail.com', 'ajengm@gmail.com', '08945432323', '08945432323', 'Jl.Cibaduyut', 'Jl. Cibaduyut', 'Admin', 'Petugas', '2021-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bulan_dibayar` varchar(8) NOT NULL,
  `tahun_dibayar` varchar(4) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `status` enum('Lunas','Belum Lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_petugas`, `nisn`, `tgl_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`, `status`) VALUES
(2, 1, '0043542387', '2021-03-31', 'Maret', '2020', 1, 800000, 'Lunas'),
(3, 1, '0043542387', '2021-03-31', 'Maret', '2021', 1, 800000, 'Lunas'),
(4, 1, '0043542387', '2021-04-01', 'Agustus', '2014', 1, 800000, 'Lunas'),
(5, 2, '0043542387', '2021-04-01', 'Januari', '2021', 1, 800000, 'Lunas'),
(7, 2, '0043542387', '2021-04-01', 'Septembe', '2014', 1, 800000, 'Lunas'),
(8, 1, '0043542387', '2021-04-01', 'Agustus', '2008', 1, 800000, 'Lunas'),
(9, 1, '0048954338', '2021-04-02', 'Januari', '2021', 1, 800000, 'Lunas'),
(10, 1, '0054783248', '2021-04-02', 'Maret', '2020', 10, 400000, 'Lunas'),
(11, 1, '0047849248', '2021-04-02', 'Maret', '2020', 13, 200000, 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `gambar` varchar(128) DEFAULT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `level` enum('Admin','Petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `email`, `password`, `nama_petugas`, `gambar`, `no_telp`, `alamat`, `level`) VALUES
(1, 'yesicaagrn04@gmail.com', '$2y$10$m.jsg5lZoFrzie3.mI8pSuV2cv/tenXb97.dBghc9mjRSo02ahhIS', 'Yesica Anggraeni', 'default.png', '08945434544', 'Jl. Ciparay Tengah', 'Admin'),
(2, 'ajeng@gmail.com', '$2y$10$Z145QqMT90VLwoEWLmN0MuChS9Hv1yNh4bfFfpGQk2qOlWGLFQPGe', 'Ajeng Maelani', 'default.png', '08945432323', 'Jl. Cibaduyut', 'Petugas');

--
-- Triggers `petugas`
--
DELIMITER $$
CREATE TRIGGER `before_update_petugas` BEFORE UPDATE ON `petugas` FOR EACH ROW BEGIN

INSERT INTO log_petugas
SET id_petugas = old.id_petugas,
nama_petugas_baru = new.nama_petugas,
nama_petugas_lama = old.nama_petugas,
email_baru = new.email,
email_lama = old.email,
no_telp_baru = new.no_telp,
no_telp_lama = old.no_telp,
alamat_baru = new.alamat,
alamat_lama = old.alamat,
posisi_baru = new.level,
posisi_lama = old.level,
tgl_diubah = now();

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` char(10) NOT NULL,
  `nis` char(10) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `email` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nis`, `nama`, `email`, `gambar`, `id_kelas`, `alamat`, `no_telp`, `id_spp`, `password`) VALUES
('0032475543', '1819.10032', 'Tisha Destiarani', 'tisha@gmail.com', 'default.png', 6, 'Jl. Ciparay Tengah', '08945434545', 10, '$2y$10$SUcv4a5OLDktdPygK0GqqOc8WIWSBIiGEj7Aa/k0aRavlUjjLzCDu'),
('0043542387', '1718.10032', 'Riana Damayanti', 'riana@gmail.com', 'default.png', 1, 'Jl. Cibaduyut Raya', '08945434544', 1, '$2y$10$htpl8NQ6EYWpXghXGZ.HKuUfYZfxoxJaWdwzWs/OWKzOhnMSHvfey'),
('0047839238', '1819.10003', 'Alif Haryanto Sutendar', 'alif@gmail.com', 'default.png', 8, 'Bandung', '085748983374', 14, '$2y$10$Iem60C4HNoDTkB0/kfrG5emuMzJ6f95UR0w30mXnoP4U3qE3KhPxa'),
('0047849248', '1819.10002', 'Alghifari Prasetya', 'alghi@gmail.com', 'default.png', 5, 'Bandung', '089436784782', 13, '$2y$10$Vkubpaq0h./pDPrLhTNRnu4hEXj0cr3/xO1qzcj4b.WhUS4TK9uzK'),
('0048954338', '1819.10010', 'Dudi Setiadi', 'dudi@gmail.com', 'default.png', 12, 'Bandung', '087489323455', 1, '$2y$10$oh2y0MEFV2WRiEvkxwoY0eBORIk.G.UXNdWCix78VWkM0pqDFtik2'),
('0054783248', '1819.10001', 'Alfredo Santos', 'alfredo@gmail.com', 'default.png', 8, 'Bandung', '089432673423', 10, '$2y$10$57qhnR4bQyP3lZkzk52WI.mKrrjjevTPPn1bmSLEYjw26EQ/sEUSK'),
('0075894432', '1819.10006', 'Alma Damayanti', 'alma@gmail.com', 'default.png', 10, 'Bandung', '089578493234', 10, '$2y$10$K3/47OfkryPex8vsPftqKe7eQEahCfqWSwp3PToEDb1P9GTz.mhMi'),
('0078984387', '1819.10022', 'Maya Gita Cahyani', 'maya@gmail.com', 'default.png', 13, 'Bandung', '088178328733', 1, '$2y$10$3EpX0KChC.8qzYriVneux.FONNhqe11wrhHgtSZV/h.xNoi.7QqFC'),
('0089543228', '1819.10025', 'Kirani Rizkya Desta', 'kirani@gmail.com', 'default.png', 1, 'Bandung', '088743892333', 13, '$2y$10$JmITNWGdVTqaqslOeXvHOOT/OxHgBjuVt3HtJK08PsUlErZ2Zbz9a'),
('4353543454', '1819.10030', 'Pebi Riyani', 'pebi@gmail.com', 'default.png', 12, 'Jl. Cibaduyut Raya', '08945434543', 1, '$2y$10$dP3zZfB7VA0vEhZ3VGa5u.FqsUXH3sbvpqQxW5J3DpLw6D/K.bU0G');

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id_spp`, `tahun`, `nominal`) VALUES
(1, 2017, 800000),
(10, 2021, 400000),
(13, 2010, 200000),
(14, 2020, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(1, 'yesicaagrn654@gmail.com', 'dNWOQ+nRqlI7R4I70R9jAJcYCIm9cIfuUWfxWmlOM7Q=', 1617008090),
(2, 'yesicaagrn04@gmail.com', 'nfeOxAdV6fHegYvC8Xg2pX19B4rr1hkB9FYlx2WoUO4=', 1617009151);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `log_petugas`
--
ALTER TABLE `log_petugas`
  ADD PRIMARY KEY (`id_log_petugas`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `idx_spp` (`id_spp`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `log_petugas`
--
ALTER TABLE `log_petugas`
  MODIFY `id_log_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`id_spp`) REFERENCES `siswa` (`id_spp`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_4` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id_spp`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
