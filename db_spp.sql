-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2021 at 02:27 PM
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
(1, 'XI', 'OTKP'),
(5, 'XI', 'TKJ'),
(6, 'X', 'OTKP'),
(8, 'X', 'TKJ'),
(9, 'XII', 'TKJ'),
(12, 'XII', 'RPL'),
(13, 'X', 'RPL'),
(15, 'XII', 'OTKP'),
(16, 'XI', 'RPL');

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
(1, 8, 'Yesica Anggraeni', 'Yesica Anggraeni', 'yesicaagrn654@gmail.com', 'yesicaagrn654@gmail.com', '08584470000', '08584470000', 'Bandung', 'Bandung', 'Admin', 'Admin', '2021-04-08'),
(2, 19, 'Celine Natalie', 'Celine Natalie', 'celine@gmail.com', 'celine@gmail.com', '088173829923', '088173829900', 'Bandung', 'Bandung', 'Petugas', 'Petugas', '2021-04-09'),
(3, 21, 'Indra Kurniawan', 'Indra Kurniawan', 'indra@gmail.com', 'indra@gmail.com', '089477839283', '089400839283', 'Bandung', 'Bandung', 'Petugas', 'Petugas', '2021-04-09'),
(5, 20, 'Celine Natalie', 'Celine Natalie', 'celine@gmail.com', 'celine@gmail.com', '088173828833', '088173828855', 'Bandung', 'Bandung', 'Petugas', 'Petugas', '2021-04-09'),
(6, 20, 'Celine Natalie', 'Celine Natalie', '', 'celine@gmail.com', '088173828855', '088173822355', 'Bandung', 'Bandung', 'Petugas', 'Petugas', '2021-04-09'),
(7, 22, 'Celine Natalie', 'Celine Natalie', 'celine@gmail.com', 'celine@gmail.com', '089478548832', '089478541132', 'Bandung', 'Bandung', 'Petugas', 'Petugas', '2021-04-09'),
(8, 8, 'Yesica Anggraeni', 'Yesica Anggraeni', 'yesicaagrn654@gmail.com', 'yesicaagrn654@gmail.com', '08584470000', '085844703403', 'Bandung', 'Bandung', 'Admin', 'Admin', '2021-04-09'),
(9, 21, 'Indra Kurniawan', 'Indra Kurniawan', 'indra@gmail.com', 'indra@gmail.com', '089400839283', '085400839283', 'Bandung', 'Bandung', 'Petugas', 'Petugas', '2021-04-09'),
(10, 8, 'Yesica Anggraeni', 'Yesica Anggraeni', 'yesicaagrn654@gmail.com', 'yesicaagrn654@gmail.com', '085844703403', '085844703403', 'Bandung', 'Bandung', 'Admin', 'Admin', '2021-04-09'),
(11, 8, 'Yesica Anggraeni', 'Yesica Anggraeni', 'yesicaagrn654@gmail.com', 'yesicaagrn654@gmail.com', '085844703403', '085844703403', 'Bandung', 'Bandung', 'Admin', 'Admin', '2021-04-09'),
(12, 22, 'Celine Natalie', 'Celine Natalie', 'celine@gmail.com', 'celine@gmail.com', '089478541132', '089400541132', 'Bandung', 'Bandung', 'Petugas', 'Petugas', '2021-04-09');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bulan_dibayar` varchar(11) NOT NULL,
  `tahun_dibayar` varchar(4) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `status` enum('Lunas','Belum Lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_petugas`, `nisn`, `tgl_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`, `status`) VALUES
(1, 8, '0084829934', '2021-04-09', 'Januari', '2020', 18, 410000, 'Lunas'),
(2, 8, '0084829934', '2021-04-09', 'Januari', '2019', 18, 410000, 'Lunas'),
(3, 8, '0084829934', '2021-04-09', 'Februari', '2019', 18, 410000, 'Lunas'),
(4, 8, '0084829934', '2021-04-09', 'Maret', '2019', 18, 410000, 'Lunas'),
(5, 8, '0084829934', '2021-04-09', 'April', '2019', 18, 410000, 'Lunas'),
(6, 8, '0084829934', '2021-04-09', 'Mei', '2019', 18, 410000, 'Lunas'),
(7, 8, '0084829934', '2021-04-09', 'Juni', '2019', 18, 410000, 'Lunas'),
(8, 8, '0084829934', '2021-04-09', 'Juli', '2019', 18, 410000, 'Lunas'),
(9, 8, '0084829934', '2021-04-09', 'Agustus', '2019', 18, 410000, 'Lunas'),
(10, 8, '0084829934', '2021-04-09', 'September', '2019', 18, 410000, 'Lunas'),
(11, 8, '0084829934', '2021-04-09', 'Oktober', '2019', 18, 410000, 'Lunas'),
(12, 8, '0084829934', '2021-04-09', 'November', '2019', 18, 410000, 'Lunas'),
(13, 8, '0084829934', '2021-04-09', 'Desember', '2019', 18, 410000, 'Lunas'),
(14, 8, '0084829934', '2021-04-09', 'Januari', '2021', 18, 410000, 'Lunas'),
(15, 22, '0084829934', '2021-04-09', 'Februari', '2020', 18, 410000, 'Lunas'),
(16, 22, '0084829934', '2021-04-09', 'Maret', '2020', 18, 410000, 'Lunas'),
(17, 8, '0027837743', '2021-04-09', 'Maret', '2018', 17, 400000, 'Lunas'),
(18, 8, '0027837743', '2021-04-09', 'Maret', '2020', 17, 400000, 'Lunas'),
(19, 8, '0027837743', '2021-04-09', 'Januari', '2019', 17, 400000, 'Lunas'),
(20, 8, '0027837743', '2021-04-09', 'Januari', '2018', 17, 400000, 'Lunas'),
(21, 8, '0048572283', '2021-04-09', 'Januari', '2018', 17, 400000, 'Lunas'),
(22, 8, '0048572283', '2021-04-09', 'Maret', '2018', 17, 400000, 'Lunas'),
(23, 8, '1920.10021', '2021-04-09', 'Februari', '2020', 18, 410000, 'Lunas'),
(24, 22, '0043287843', '2021-04-09', 'Januari', '2020', 19, 420000, 'Lunas'),
(25, 22, '0043287843', '2021-04-09', 'Mei', '2021', 19, 420000, 'Lunas'),
(26, 22, '0054382384', '2021-04-09', 'Maret', '2018', 17, 400000, 'Lunas'),
(27, 22, '0054382384', '2021-04-09', 'Februari', '2018', 17, 400000, 'Lunas'),
(28, 22, '0054382384', '2021-04-09', 'Mei', '2018', 17, 400000, 'Lunas'),
(29, 22, '0089647548', '2021-04-09', 'Januari', '2020', 19, 420000, 'Lunas'),
(30, 22, '0089647548', '2021-04-09', 'Maret', '2020', 19, 420000, 'Lunas'),
(31, 22, '0089647548', '2021-04-09', 'Mei', '2020', 19, 420000, 'Lunas'),
(32, 22, '0094327954', '2021-04-09', 'Januari', '2020', 19, 420000, 'Lunas'),
(33, 22, '0094327954', '2021-04-09', 'Maret', '2020', 19, 420000, 'Lunas'),
(34, 22, '0094327954', '2021-04-09', 'Mei', '2020', 19, 420000, 'Lunas'),
(35, 22, '0098547894', '2021-04-09', 'Januari', '2018', 17, 400000, 'Lunas'),
(36, 22, '0098547894', '2021-04-09', 'Juni', '2018', 17, 400000, 'Lunas'),
(37, 22, '0098547894', '2021-04-09', 'Februari', '2018', 17, 400000, 'Lunas'),
(38, 22, '0048957864', '2021-04-09', 'Januari', '2020', 19, 420000, 'Lunas'),
(39, 22, '0048957864', '2021-04-09', 'Februari', '2020', 19, 420000, 'Lunas'),
(40, 22, '0048957864', '2021-04-09', 'April', '2020', 19, 420000, 'Lunas'),
(41, 22, '0096537893', '2021-04-09', 'Januari', '2018', 17, 400000, 'Lunas'),
(42, 22, '0096537893', '2021-04-09', 'Maret', '2018', 17, 400000, 'Lunas'),
(43, 22, '0096537893', '2021-04-09', 'Mei', '2018', 17, 400000, 'Lunas'),
(44, 21, '0035892348', '2021-04-09', 'Januari', '2018', 17, 400000, 'Lunas'),
(45, 21, '0035892348', '2021-04-09', 'Juli', '2018', 17, 400000, 'Lunas'),
(46, 21, '0035892348', '2021-04-09', 'Maret', '2018', 17, 400000, 'Lunas'),
(47, 21, '0035892348', '2021-04-09', 'April', '2018', 17, 400000, 'Lunas'),
(48, 21, '0095437893', '2021-04-09', 'Januari', '2019', 18, 410000, 'Lunas'),
(49, 21, '0095437893', '2021-04-09', 'Juli', '2019', 18, 410000, 'Lunas'),
(50, 21, '0095437893', '2021-04-09', 'Agustus', '2019', 18, 410000, 'Lunas'),
(51, 21, '0069547843', '2021-04-09', 'Januari', '2019', 18, 410000, 'Lunas'),
(52, 21, '0069547843', '2021-04-09', 'Februari', '2019', 18, 410000, 'Lunas'),
(53, 21, '0069547843', '2021-04-09', 'Juni', '2019', 18, 410000, 'Lunas'),
(54, 21, '0085497843', '2021-04-09', 'Januari', '2019', 18, 410000, 'Lunas'),
(55, 21, '0085497843', '2021-04-09', 'Februari', '2019', 18, 410000, 'Lunas'),
(56, 21, '0085497843', '2021-04-09', 'Maret', '2019', 18, 410000, 'Lunas'),
(57, 21, '0034572677', '2021-04-09', 'Maret', '2020', 19, 420000, 'Lunas'),
(58, 21, '0034572677', '2021-04-09', 'Februari', '2020', 19, 420000, 'Lunas'),
(59, 21, '0054839538', '2021-04-09', 'Januari', '2020', 19, 420000, 'Lunas'),
(60, 21, '0043483329', '2021-04-09', 'Februari', '2020', 19, 420000, 'Lunas'),
(61, 21, '0043483329', '2021-04-09', 'Januari', '2020', 19, 420000, 'Lunas'),
(62, 21, '0048532942', '2021-04-09', 'Januari', '2018', 17, 400000, 'Lunas'),
(63, 21, '0048532942', '2021-04-09', 'Februari', '2018', 17, 400000, 'Lunas'),
(64, 21, '0047238783', '2021-04-09', 'Januari', '2018', 17, 400000, 'Lunas'),
(65, 21, '0047238783', '2021-04-09', 'Februari', '2018', 17, 400000, 'Lunas'),
(66, 21, '0034238783', '2021-04-09', 'Januari', '2018', 17, 400000, 'Lunas'),
(67, 21, '0034238783', '2021-04-09', 'Februari', '2018', 17, 400000, 'Lunas'),
(68, 8, '0054839538', '2021-04-09', 'Maret', '2020', 19, 420000, 'Lunas'),
(69, 8, '0048532942', '2021-04-09', 'April', '2018', 17, 400000, 'Lunas'),
(70, 8, '0048532942', '2021-04-09', 'Mei', '2018', 17, 400000, 'Lunas'),
(71, 8, '0027837743', '2021-04-09', 'Mei', '2018', 17, 400000, 'Lunas');

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
(8, 'yesicaagrn654@gmail.com', '$2y$10$6NfCFgm4S9R1ftMa5OoovuT9ECqiEVNNuVbm5chvxaQwAN.wfOuya', 'Yesica Anggraeni', 'Yesica_Anggraeni.jpg', '085844703403', 'Bandung', 'Admin'),
(21, 'indra@gmail.com', '$2y$10$QYdu1QCMyaSEGMGECtE4luKenZZPVFjuVeNfb6JVEQAO/1UmGG1xm', 'Indra Kurniawan', 'Indra_Kurniawan.jpg', '085400839283', 'Bandung', 'Petugas'),
(22, 'celine@gmail.com', '$2y$10$1oN6NG./4vfORBfiBBBA4ui2gdEvNYIEcYhfVcBnI/mr4RdVVzLkW', 'Celine Natalie', 'Celine_Natalie.jpg', '089400541132', 'Bandung', 'Petugas');

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
('0027837743', '1819.10011', 'Aris Resta', 'aris@gmail.com', 'Aris_Resta.jpg', 12, 'Bandung', '085178328832', 17, '$2y$10$Cx06XTtV0ZcF1g1iF6cwfOt/.3LKC9DAJtfCR6dGdOvnavAgwRKNW'),
('0034238783', '1819.10024', 'Widi Nur ', 'widi@gmail.com', 'Widi_Nur_.jpg', 12, 'Bandung', '089437883389', 17, '$2y$10$RyIfBbvfstDvR1CWO69lNewrxEr/CeDpt75Ipzx.Am1dZjfOS6zJy'),
('0034572677', '2021.10029', 'Rizal Ramdani', 'rizal@gmail.com', 'Rizal_Ramdani.jpg', 8, 'Bandung', '084378329932', 19, '$2y$10$cd7NKYv8Nn6KiXoChOLsHuwK3E6MRSbIsvLn94tjp4Wu2/MUd.PB.'),
('0035892348', '1819.10032', 'Nelwan Gunawan', 'nelwan@gmail.com', 'Nelwan_Gunawan.jpg', 9, 'Bandung', '088754892238', 17, '$2y$10$QBq2elTmgfYCbnShFiBTGenQo.0.ItKpo0V0adlE5rhj9sazL/oZK'),
('0043287843', '2021.10012', 'Ferry Saputra', 'ferry@gmail.com', 'Ferry_Saputra.jpg', 8, 'Bandung', '089478549923', 19, '$2y$10$PFB6f8LLstwVS3cq6V5sMuGG3HLCPwebHEBJiaSWDWmot7HCaJegC'),
('0043483329', '2021.10032', 'Santika Sari', 'santika@gmail.com', 'Santika_Sari.jpg', 6, 'Bandung', '088743882100', 19, '$2y$10$aJ4MAQQeRB5pGktAPVoyRuuXp3hSBdRlXval/pAVJCLDWcarxw6py'),
('0047238783', '1819.10032', 'Tresa Amelia', 'tresa@gmail.com', 'Tresa_Amelia.jpg', 15, 'Bandung', '089589349932', 17, '$2y$10$FhrOmA.KIJ6f7YT5KynhyOM8eypi9kigpUx/0fLffl6U8QHearYGi'),
('0048532942', '1819.10022', 'Tisha Destiarani', 'tisha@gmail.com', 'Tisha_Destiarani.jpg', 15, 'Bandung', '089437834388', 17, '$2y$10$7WrVlmbWjQke300ZaZtkeuA/JBLDVYVH3m1vgtfn.VyWMQ6fTyO/y'),
('0048572283', '1819.10032', 'Budi Arip', 'budi@gmail.com', 'Budi_Arip.jpg', 9, 'Bandung', '089478539923', 17, '$2y$10$E7CI9ZOk6z0exwNclvKrq.tEZ51ZMMmltwG4rf7.QZnQ/Fk3GjHRi'),
('0048957864', '2021.10012', 'Mevassaret', 'meva@gmail.com', 'Mevassaret.jpg', 6, 'Bandung', '089538797843', 19, '$2y$10$yKgL7cBB6wwvQheTpntNFe6VQ8CfTg6VnIRt7sYNFO6Sc4ssMWwM6'),
('0054382384', '1819.10014', 'Hady Setiawan', 'hady@gmail.com', 'Hady_Setiawan.jpg', 12, 'Bandung', '088178329943', 17, '$2y$10$alBWD7o2/6ZblIThO7WR6OV6PX5pfNZFMk3.tRTcwvBNh5po/aFpa'),
('0054839538', '2021.10027', 'Sahrul Gunawan', 'sahrul@gmail.com', 'Sahrul_Gunawan.jpg', 13, 'Bandung', '089433891211', 19, '$2y$10$OqLD5EO/EblGiqbUB7twyu0aQ3lGD.RrE/bhKN6fsxs5xDV.PuaWi'),
('0069547843', '1920.10017', 'Ramdan', 'ramdan@gmail.com', 'Ramdan.jpg', 16, 'Bandung', '089578932893', 18, '$2y$10$0lJfKnVD38AJQAFMQvA2uuhBjpdl9Xi2TdLNB.uu4C.jv19.gVwsm'),
('0084829934', '1920.10023', 'Agustinus', 'agustinus@gmail.com', 'Agustinus.jpg', 5, 'Bandung', '089478237743', 18, '$2y$10$zQFJBdqEjM8wtFtYphBbm.xTxGJxa./IRlQy62ImvIfRW4c0baa7S'),
('0085497843', '1920.10020', 'Riyanti', 'riyanti@gmail.com', 'Riyanti.jpg', 5, 'Bandung', '083783884389', 18, '$2y$10$hPfRVhO9cqTPYjmshUc7Ueo5Q6c9QI/9bY42CsziBuvamz32Ix/R6'),
('0089647548', '2021.10043', 'Kaka Firmansyah', 'kaka@gmail.com', 'Kaka_Firmansyah.jpg', 13, 'Bandung', '087589023430', 19, '$2y$10$JrBuLEDhpBlAEs5yFjGIy.J/M4Iv6nXx1p5oLrMVlEN1WBPssPw8a'),
('0094327954', '2021.10032', 'Khofifah', 'khofifah@gmail.com', 'Khofifah.jpg', 6, 'Bandung', '084732984398', 19, '$2y$10$lwp9SBfZhZlyD5JANOKNR.4I0MOfVwa9VwztyJIKFiH0Yj7MLasNO'),
('0095437893', '1920.10018', 'Putri Bianca', 'putri@gmail.com', 'Putri_Bianca.jpg', 1, 'Bandung', '089578938922', 18, '$2y$10$MvjFhwL8eKdpZL4j7Ty0e.PQazvHormqnP3aOmk3V0/LvuV6aeC32'),
('0096537893', '1819.10019', 'Nadila Rizki', 'nadila@gmail.com', 'Nadila_Rizki.jpg', 9, 'Bandung', '088378439832', 17, '$2y$10$7n3e.Y6ourYff3bQ9OaDju7rKjLsB.J7rh.qvhWNBT65uZrA6iEja'),
('0098547894', '1819.10023', 'Kusmawati Putri', 'kusma@gmail.com', 'Kusmawati.jpg', 15, 'Bandung', '089478398923', 17, '$2y$10$OcbiiVB47eDr.ux3Ovl3ne6RYC0bKtWwvcepSZ681QykZJORlWNCe'),
('1920.10021', '1920.10032', 'Farhan Abdullah', 'farhan@gmail.com', 'Farhan_Abdullah.jpg', 16, 'Bandung', '088174892234', 18, '$2y$10$R7JoVOlZdB1TKzufjahg3.H5jnETn/EQHPrSJ4.zXrKm5dQVjV4Sq');

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
(10, 2021, 430000),
(17, 2018, 400000),
(18, 2019, 410000),
(19, 2020, 420000),
(20, 2022, 450000);

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
(4, 'yesicaagrn04@gmail.com', 'G7TRXuawd+YOGOght08o3+Y5zEGWAabid9A7Kk3Slbk=', 1617760236),
(5, 'yesicaagrn04@gmail.com', 'Oyn9Q+ikLnHKCQAiEteHi8R6bWC0iozK31Rs90ZO6w4=', 1617780137),
(6, 'yesicaagrn654@gmail.com', 'hTITJt5dRcONm3dnntkLqFo08kIYc/e6ZSJAcGODMKI=', 1617780186),
(7, 'yesicaagrn654@gmail.com', 'CQEqi6f8krmF/OiVf9uJi1iJVrYBGv0TB+1XNXhHMkA=', 1617780902),
(8, 'yesicaagrn654@gmail.com', 'nNn6yHsmlmgHmNk58qk5NRuidExL3PRrwJDLtUqx34g=', 1617957759),
(9, 'yesicaagrn654@gmail.com', 'lDaW5Eq5ekIcS2OC8SJHW9lgdAm7hXmJPcMJ7qw0x0I=', 1617957937);

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
  ADD KEY `nisn` (`nisn`);

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
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `log_petugas`
--
ALTER TABLE `log_petugas`
  MODIFY `id_log_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
