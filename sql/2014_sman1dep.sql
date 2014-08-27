-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 07, 2014 at 04:09 
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `2014_sman1dep`
--
CREATE DATABASE IF NOT EXISTS `2014_sman1dep` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `2014_sman1dep`;

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE IF NOT EXISTS `grup` (
  `id_grup` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_grup` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_grup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `grup_anggota`
--

CREATE TABLE IF NOT EXISTS `grup_anggota` (
  `id_grup` bigint(11) NOT NULL,
  `id_siswa` bigint(20) NOT NULL,
  `id_guru` int(11) NOT NULL,
  KEY `id_grup` (`id_grup`,`id_siswa`,`id_guru`),
  KEY `id_guru` (`id_guru`),
  KEY `id_siswa` (`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grup_keyword`
--

CREATE TABLE IF NOT EXISTS `grup_keyword` (
  `id_keyword` bigint(20) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `nip` char(5) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama_lengkap`, `alamat`, `status`, `nip`, `password`, `avatar`) VALUES
(1, 'Yusuf Akhsan Hidayat', 'Jl. Mancasan Indah 32 B', 'aktif', '21111', 'ac43724f16e9241d990427ab7c8f4228', '');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` int(11) DEFAULT NULL,
  `hari` varchar(7) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL,
  `mata_pelajaran` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `guru` (`guru`),
  KEY `mata_pelajaran` (`mata_pelajaran`),
  KEY `kelas` (`kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, '10A'),
(2, '10B');

-- --------------------------------------------------------

--
-- Table structure for table `matapelajaran`
--

CREATE TABLE IF NOT EXISTS `matapelajaran` (
  `id_matapelajaran` int(11) NOT NULL AUTO_INCREMENT,
  `matapelajaran` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_matapelajaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE IF NOT EXISTS `materi` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `id_matapelajaran` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_soal`),
  KEY `id_kelas` (`id_kelas`),
  KEY `id_guru` (`id_guru`),
  KEY `id_matapelajaran` (`id_matapelajaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
  `id_pesan` bigint(20) NOT NULL AUTO_INCREMENT,
  `pengirim` int(11) NOT NULL,
  `penerima` int(11) NOT NULL,
  `isi` varchar(400) NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id_pesan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `pengirim`, `penerima`, `isi`, `waktu`) VALUES
(11, 11111, 11111, 'just test', '2014-08-05 20:53:20'),
(12, 11112, 11111, 'pesan ke 2', '2014-08-05 20:59:40'),
(13, 11112, 11111, 'ini adalah pesan kedua', '2014-08-05 21:02:39'),
(14, 11111, 11112, 'ya benar itu pesan kedua', '2014-08-06 07:52:51'),
(20, 11111, 11112, 'yakin', '2014-08-06 08:37:49'),
(21, 11111, 11112, 'yakin ke 2', '2014-08-06 08:37:58'),
(22, 11113, 11111, 'apakah anda lapar?', '2014-08-06 20:07:29'),
(23, 11113, 11112, 'Pesan ke 1 saya', '2014-08-06 20:33:53'),
(24, 11113, 11112, 'pesan terakhir saya', '2014-08-06 20:34:10'),
(25, 11112, 11113, 'so what?', '2014-08-06 20:41:41'),
(26, 11111, 11112, 'nggk..', '2014-08-07 09:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `angkatan` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `kelas` int(11) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `nis` varchar(6) NOT NULL,
  `password` varchar(100) NOT NULL,
  `moto` varchar(200) NOT NULL,
  `avatar` varchar(30) NOT NULL,
  `kelamin` enum('perempuan','laki-laki') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kelas` (`kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `angkatan`, `nama_lengkap`, `alamat`, `kelas`, `status`, `nis`, `password`, `moto`, `avatar`, `kelamin`) VALUES
(5, 2013, 'Luthfi Puspitasari', 'Jalan Durian nomer 8 Condong Catur, Depok, Sleman, Yogyakarta', 1, 'aktif', '11111', 'ac43724f16e9241d990427ab7c8f4228', '', '', 'perempuan'),
(6, 2013, 'Yusuf Akhsan Hidayat', 'Jalan Candi Gebang 20A Depok, Sleman, Yogyakarta', 2, 'aktif', '11112', 'ac43724f16e9241d990427ab7c8f4228', '', '', 'laki-laki'),
(7, 2013, 'Nana Mizuki', 'Jl. Sumatra 12', 1, 'aktif', '11113', 'rahasia', 'makan sebelum lapar, berhenti makan sebellum kenyang', '', 'laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE IF NOT EXISTS `soal` (
  `id_materi` int(11) NOT NULL AUTO_INCREMENT,
  `id_matapelajaran` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_materi`),
  KEY `id_kelas` (`id_kelas`),
  KEY `id_guru` (`id_guru`),
  KEY `id_matapelajaran` (`id_matapelajaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id_status` bigint(20) NOT NULL AUTO_INCREMENT,
  `isi_status` varchar(400) DEFAULT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `id_siswa` bigint(20) DEFAULT NULL,
  `id_guru` int(20) DEFAULT NULL,
  `id_grup` bigint(20) NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id_status`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id_grup` (`id_guru`),
  KEY `id_grup_2` (`id_grup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status_komentar`
--

CREATE TABLE IF NOT EXISTS `status_komentar` (
  `id_status` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint(20) NOT NULL,
  `komentar` varchar(400) NOT NULL,
  PRIMARY KEY (`id_status`),
  KEY `id_siswa` (`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grup_anggota`
--
ALTER TABLE `grup_anggota`
  ADD CONSTRAINT `grup_anggota_ibfk_1` FOREIGN KEY (`id_grup`) REFERENCES `grup` (`id_grup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grup_anggota_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grup_anggota_ibfk_3` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`mata_pelajaran`) REFERENCES `matapelajaran` (`id_matapelajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi_ibfk_3` FOREIGN KEY (`id_matapelajaran`) REFERENCES `matapelajaran` (`id_matapelajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `soal_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `soal_ibfk_3` FOREIGN KEY (`id_matapelajaran`) REFERENCES `matapelajaran` (`id_matapelajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_ibfk_3` FOREIGN KEY (`id_grup`) REFERENCES `grup` (`id_grup`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status_komentar`
--
ALTER TABLE `status_komentar`
  ADD CONSTRAINT `status_komentar_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
