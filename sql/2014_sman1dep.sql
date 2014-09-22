-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 22, 2014 at 06:39 
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
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `nama`) VALUES
(1, 'luthfipuspita.1993@gmail.com', 'ac43724f16e9241d990427ab7c8f4228', 'Luthfi Pus');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `konten` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(200) NOT NULL,
  `author` varchar(10) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id_berita`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `konten`, `created`, `edited`, `image`, `author`) VALUES
(1, 'HUT RI 96', 'Upacara akan diadakan di lapangan Ikada, untuk jadwalnya adalah sebagai berikut.\n</br>\n1)Kelas 10 : Upacara pagi </br>\n2)Kelas 11 dan 12 : Upacara sore </br>\nPertanyaan lebih lanjut hubungi : humas@smandep.sch.id\n', '2014-08-21 13:29:25', '2014-09-17 13:32:16', '1.jpg', 'berita'),
(2, 'Dukungan Untuk Yusuf di Astronomi Internasional', 'Mari kita beri dukungan untuk Yusuf Akhsan Hidayat untuk membela negara tercinta di Olimpiade Internsional Antariksa dari NASA USA.', '2014-08-21 19:14:32', '2014-08-21 12:14:32', '2.jpg\r\n', 'admin'),
(3, 'About', 'SMAN 01 Depok Babarsari adalah sebuah sekolah.', '2014-09-12 07:28:34', '2014-09-12 00:28:34', '3.jpg', 'admin'),
(5, 'Contoh Judul berita', 'Contoh isi beritas', '2014-09-17 20:16:57', '2014-09-18 01:12:43', 'AKO-KEITA-RIKO.jpg', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE IF NOT EXISTS `grup` (
  `id_grup` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_grup` varchar(30) DEFAULT NULL,
  `deskripsi_grup` varchar(500) NOT NULL,
  `admin_siswa` bigint(20) DEFAULT NULL,
  `admin_guru` int(11) DEFAULT NULL,
  `avatar` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('aktif','blocked') NOT NULL DEFAULT 'aktif',
  PRIMARY KEY (`id_grup`),
  KEY `admin` (`admin_siswa`),
  KEY `admin_guru` (`admin_guru`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`id_grup`, `nama_grup`, `deskripsi_grup`, `admin_siswa`, `admin_guru`, `avatar`, `created`, `status`) VALUES
(2, 'Gila Fisika', 'Penggila fisika masuk sini, ayo sampaikan semua Fisika yang kamu temukan', NULL, 2, '', '2014-08-27 04:48:39', 'aktif'),
(4, 'Ekonomi Kreatif', 'Untuk menciptakan ekonomi kreatif di Indonesia', NULL, 1, '', '2014-09-03 09:45:49', 'aktif'),
(5, 'Bahasa Kita', 'Samapaikan bahasa daerah kalian unutk dikenalkan kepada teman-teman', 8, NULL, '', '2014-09-17 15:54:10', 'blocked'),
(7, 'Matematika Moderen', 'Ya tentang matematika moderen', 8, NULL, 'bike-v-cyclist_600-600x400.jpg', '2014-09-17 15:53:41', 'blocked');

-- --------------------------------------------------------

--
-- Table structure for table `grup_anggota`
--

CREATE TABLE IF NOT EXISTS `grup_anggota` (
  `id_grup` bigint(11) NOT NULL,
  `id_siswa` bigint(20) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `joindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `id_grup` (`id_grup`,`id_siswa`,`id_guru`),
  KEY `id_guru` (`id_guru`),
  KEY `id_siswa` (`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grup_anggota`
--

INSERT INTO `grup_anggota` (`id_grup`, `id_siswa`, `id_guru`, `joindate`) VALUES
(2, NULL, 2, '2014-08-30 08:52:48'),
(4, NULL, 2, '2014-09-06 16:02:46'),
(4, 8, NULL, '2014-09-08 06:45:00'),
(5, NULL, 3, '2014-09-22 03:10:18'),
(4, NULL, 3, '2014-09-22 03:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `grup_keyword`
--

CREATE TABLE IF NOT EXISTS `grup_keyword` (
  `id_keyword` bigint(20) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_keyword`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `grup_keyword`
--

INSERT INTO `grup_keyword` (`id_keyword`, `keyword`) VALUES
(1, 'matematika'),
(2, 'bahasa');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `email` varchar(20) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `nip` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT 'ac43724f16e9241d990427ab7c8f4228',
  `avatar` varchar(30) NOT NULL,
  `kelamin` enum('laki-laki','perempuan') NOT NULL,
  `moto` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama_lengkap`, `alamat`, `email`, `telp`, `status`, `nip`, `password`, `avatar`, `kelamin`, `moto`) VALUES
(1, 'Dr. Maskur', 'Jl. Mancasan Indah 32 B', 'pandan@smadep.com', '081567567223', 'aktif', '195606011984031008', 'ac43724f16e9241d990427ab7c8f4228', 'dark.gif', 'laki-laki', 'makanlah sebelum kamu tidak bisa makan'),
(2, 'Sri Lestari, S.Pd.', 'Jl. Anda 20', 'susan@smandep.com', '081335626228', 'aktif', '195510081978032002', 'ac43724f16e9241d990427ab7c8f4228', 'susan.jpg', 'perempuan', 'siapapun bisa jadi pemenang'),
(3, 'Yussan', NULL, '', '', 'aktif', '123', '202cb962ac59075b964b07152d234b70', '', 'laki-laki', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'Kelas 10'),
(2, 'Kelas 11 IPA'),
(3, 'Kelas 11 IPS'),
(4, 'Kelas 12 IPA'),
(5, 'Kelas 12 IPS');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id_likes` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint(20) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_status` bigint(20) NOT NULL,
  PRIMARY KEY (`id_likes`),
  KEY `id_siswa` (`id_siswa`,`id_guru`,`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `matapelajaran`
--

CREATE TABLE IF NOT EXISTS `matapelajaran` (
  `id_matapelajaran` int(11) NOT NULL AUTO_INCREMENT,
  `matapelajaran` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_matapelajaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `matapelajaran`
--

INSERT INTO `matapelajaran` (`id_matapelajaran`, `matapelajaran`) VALUES
(1, 'Pendidikan Kewarganegaraan (PKn)'),
(2, 'PKN'),
(3, 'Kimia A'),
(5, 'xxxx');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE IF NOT EXISTS `materi` (
  `id_materi` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelas` int(11) NOT NULL,
  `id_matapelajaran` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `tahun` year(4) NOT NULL,
  PRIMARY KEY (`id_materi`),
  KEY `id_guru` (`id_guru`),
  KEY `id_matapelajaran` (`id_matapelajaran`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `id_kelas`, `id_matapelajaran`, `id_guru`, `judul`, `link`, `tahun`) VALUES
(1, 1, 1, 1, 'Kewarganegaraan moderen', 'kewarganegaraan-moderen.pdf', 2014),
(2, 1, 3, 1, 'Tanah dan Plastik', 'tanah-dan-plastik.pdf', 2014),
(4, 1, 1, 1, 'Materi Baru Saya', 'tenses.pdf', 2014),
(5, 1, 1, 1, 'soal PKN', 'A-&-I--Menggunakan-Git-di-Linux.html', 2014);

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

CREATE TABLE IF NOT EXISTS `mengajar` (
  `id_mengajar` int(11) NOT NULL AUTO_INCREMENT,
  `id_guru` int(11) NOT NULL,
  `id_subkelas` int(11) NOT NULL,
  `id_matapelajaran` int(11) NOT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  PRIMARY KEY (`id_mengajar`),
  KEY `id_guru` (`id_guru`),
  KEY `id_subkelas` (`id_subkelas`),
  KEY `id_matapelajaran` (`id_matapelajaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mengajar`
--

INSERT INTO `mengajar` (`id_mengajar`, `id_guru`, `id_subkelas`, `id_matapelajaran`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(1, 1, 1, 1, 'senin', '00:00:00', '00:00:00'),
(3, 2, 1, 3, 'senin', '00:00:00', '00:00:00'),
(4, 1, 2, 1, 'senin', '00:00:00', '00:00:00'),
(7, 1, 3, 1, 'senin', '00:00:00', '00:00:00'),
(8, 3, 1, 3, 'senin', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_matapelajaran` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `tahun` char(4) NOT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `id_kelas` (`id_kelas`),
  KEY `id_guru` (`id_guru`),
  KEY `id_matapelajaran` (`id_matapelajaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_matapelajaran`, `id_guru`, `id_kelas`, `judul`, `link`, `tahun`) VALUES
(3, 1, 1, 1, 'nilai PKN', 'A-&-I--Menggunakan-Git-di-Linux.html', '2014'),
(5, 1, 1, 1, 'Nilai PKN minggu 2', 'Generating-SSH-Keys-?-GitHub-Help.pdf', '2014');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
  `id_pesan` bigint(20) NOT NULL AUTO_INCREMENT,
  `pengirim` varchar(20) NOT NULL,
  `penerima` varchar(20) NOT NULL,
  `isi` varchar(400) NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id_pesan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `pengirim`, `penerima`, `isi`, `waktu`) VALUES
(11, '11111', '11111', 'just test', '2014-08-05 20:53:20'),
(12, '11112', '11111', 'pesan ke 2', '2014-08-05 20:59:40'),
(13, '11112', '11111', 'ini adalah pesan kedua', '2014-08-05 21:02:39'),
(14, '11111', '11112', 'ya benar itu pesan kedua', '2014-08-06 07:52:51'),
(20, '11111', '11112', 'yakin', '2014-08-06 08:37:49'),
(21, '11111', '11112', 'yakin ke 2', '2014-08-06 08:37:58'),
(22, '11113', '11111', 'apakah anda lapar?', '2014-08-06 20:07:29'),
(23, '11113', '11112', 'Pesan ke 1 saya', '2014-08-06 20:33:53'),
(24, '11113', '11112', 'pesan terakhir saya', '2014-08-06 20:34:10'),
(25, '11112', '11113', 'so what?', '2014-08-06 20:41:41'),
(26, '11111', '11112', 'nggk..', '2014-08-07 09:07:37'),
(27, '11112', '11111', 'test kamis', '2014-08-07 11:12:06'),
(28, '11112', '11113', 'so what ???', '2014-08-07 12:48:55'),
(29, '11111', '11113', 'halo risa', '2014-08-18 14:05:22'),
(30, '11112', '11111', 'yui apakah pesanku sampai?', '2014-08-18 14:06:21'),
(33, '195606011984031010', '195606011984031008', 'pesan buat pak panda', '2014-08-20 19:42:31'),
(34, '11111', '11111', 'buat', '2014-08-27 10:19:05'),
(35, '11111', '11112', 'sudah', '2014-08-27 10:19:15'),
(36, '123', '123', 'kirim ke diri sendiri', '2014-09-22 10:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `angkatan` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `subkelas1` int(11) DEFAULT NULL,
  `subkelas2` int(11) DEFAULT NULL,
  `subkelas3` int(11) DEFAULT NULL,
  `alamat` varchar(500) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `nis` varchar(6) NOT NULL,
  `password` varchar(100) NOT NULL,
  `moto` varchar(200) NOT NULL,
  `avatar` varchar(30) NOT NULL,
  `email` varchar(20) DEFAULT '...',
  `telp` varchar(13) DEFAULT '...',
  `kelamin` enum('perempuan','laki-laki') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subkelas` (`subkelas1`),
  KEY `subkelas2` (`subkelas2`,`subkelas3`),
  KEY `subkelas3` (`subkelas3`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `angkatan`, `nama_lengkap`, `subkelas1`, `subkelas2`, `subkelas3`, `alamat`, `status`, `nis`, `password`, `moto`, `avatar`, `email`, `telp`, `kelamin`) VALUES
(8, 2014, 'Clara Primadewi', NULL, NULL, NULL, 'Jalan begalan 45 Sumedang', 'aktif', '8208', 'ac43724f16e9241d990427ab7c8f4228', 'Hidup adalah perjuangan', 'LiSA.jpg', 'clara-pd@gmail.com', '...', 'perempuan'),
(9, 2014, 'Ervita Raihanah Aprilia', 3, NULL, NULL, '', 'aktif', '8222', 'ac43724f16e9241d990427ab7c8f4228', 'Jangan boros', '', 'ervitamax@live.com', '...', 'perempuan'),
(11, 2011, 'xxx', NULL, NULL, NULL, '', 'aktif', '8223', '3e91970f771a2c473ae36b60d1146068', '', '', '...', '...', 'laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE IF NOT EXISTS `soal` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `id_matapelajaran` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `tahun` char(4) NOT NULL,
  PRIMARY KEY (`id_soal`),
  KEY `id_kelas` (`id_kelas`),
  KEY `id_guru` (`id_guru`),
  KEY `id_matapelajaran` (`id_matapelajaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_matapelajaran`, `id_guru`, `id_kelas`, `judul`, `link`, `tahun`) VALUES
(2, 3, 1, 1, 'Soal latihan tanah dan plastik', 'tanah-dan-plastik.pdf', '2014'),
(3, 1, 1, 1, 'soal PKN', 'A-&-I--Menggunakan-Git-di-Linux.html', '2014');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id_status` bigint(20) NOT NULL AUTO_INCREMENT,
  `file` text,
  `isi_status` varchar(400) DEFAULT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `id_siswa` bigint(20) DEFAULT NULL,
  `id_guru` int(20) DEFAULT NULL,
  `id_grup` bigint(20) DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publik` int(11) NOT NULL DEFAULT '1',
  `on_id_siswa` bigint(20) DEFAULT NULL,
  `on_id_guru` int(11) DEFAULT NULL,
  `on_id_grup` bigint(20) DEFAULT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id_status`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id_grup` (`id_guru`),
  KEY `id_grup_2` (`id_grup`),
  KEY `on_id_siswa` (`on_id_siswa`,`on_id_guru`,`on_id_grup`),
  KEY `on_id_guru` (`on_id_guru`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `file`, `isi_status`, `tag`, `id_siswa`, `id_guru`, `id_grup`, `waktu`, `publik`, `on_id_siswa`, `on_id_guru`, `on_id_grup`, `likes`) VALUES
(13, NULL, 'Mari masuk sekolah lagi anak-anak', NULL, NULL, 1, NULL, '2014-08-18 01:53:47', 1, NULL, 1, NULL, 0),
(46, NULL, 'apa aku bisa', NULL, NULL, 1, NULL, '2014-08-19 14:07:30', 1, NULL, 2, NULL, 0),
(48, NULL, 'coba update status', NULL, NULL, 2, NULL, '2014-08-20 12:39:10', 1, NULL, 2, NULL, 0),
(52, NULL, 'hp hp ', NULL, NULL, 2, NULL, '2014-09-19 14:41:25', 1, NULL, 2, NULL, 1),
(56, NULL, 'status saya', NULL, 8, NULL, NULL, '2014-09-05 15:00:31', 1, 8, NULL, NULL, 0),
(57, NULL, 'ngantuk...', NULL, NULL, 2, NULL, '2014-09-22 02:53:58', 1, NULL, 2, NULL, 22),
(73, 'jawaban-ujian.txt', 'Ini jawaban saya, tolong dikoreksi', NULL, 8, NULL, NULL, '2014-09-14 14:30:04', 0, NULL, NULL, 4, 0),
(74, NULL, 'Apakah grup ini sehat', NULL, 8, NULL, NULL, '2014-09-14 14:31:30', 0, NULL, NULL, 7, 0),
(79, NULL, 'bisa', NULL, 8, NULL, NULL, '2014-09-19 14:41:06', 0, NULL, NULL, 4, 3),
(80, 'tenses.pdf', 'ini buat latihan dirumah yak ::::', NULL, NULL, 1, NULL, '2014-09-19 14:48:28', 0, NULL, NULL, 4, 2),
(81, NULL, 'siap untuk permulaan', NULL, 9, NULL, NULL, '2014-09-15 01:20:15', 0, NULL, NULL, 4, 0),
(82, NULL, 'status kematian', NULL, 8, NULL, NULL, '2014-09-22 02:14:10', 1, 8, NULL, NULL, 6),
(84, NULL, 'makan', NULL, NULL, 3, NULL, '2014-09-22 02:50:55', 1, NULL, 3, NULL, 1),
(85, 'pembayaran_spp_variabel.pdf', 'ini upload saya', NULL, NULL, 3, NULL, '2014-09-22 03:22:55', 0, NULL, NULL, 4, 0),
(86, NULL, 'kemampuan', NULL, NULL, 3, NULL, '2014-09-22 03:48:41', 1, NULL, 3, NULL, 0),
(87, NULL, 'inilah status saya hari ini...', NULL, NULL, 3, NULL, '2014-09-22 03:49:27', 1, NULL, 3, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_komentar`
--

CREATE TABLE IF NOT EXISTS `status_komentar` (
  `id_komentar` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_status` bigint(20) NOT NULL,
  `id_siswa` bigint(20) DEFAULT NULL,
  `id_guru` int(20) DEFAULT NULL,
  `komentar` varchar(400) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_komentar`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id_status` (`id_status`),
  KEY `id_guru` (`id_guru`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `status_komentar`
--

INSERT INTO `status_komentar` (`id_komentar`, `id_status`, `id_siswa`, `id_guru`, `komentar`, `time`) VALUES
(1, 82, 8, NULL, 'bisakah', '2014-09-19 14:55:16'),
(2, 57, 8, NULL, 'tidur donk ibu', '2014-09-19 15:04:38'),
(3, 13, 9, NULL, 'molek', '2014-09-20 11:45:26'),
(4, 52, 8, NULL, 'bolehlah', '2014-09-20 11:46:42'),
(5, 46, 8, NULL, 'pasti bisa', '2014-09-20 11:46:58'),
(6, 82, 8, NULL, 'buset', '2014-09-20 11:58:39'),
(7, 57, 8, NULL, 'ya', '2014-09-20 11:59:03'),
(8, 82, 8, NULL, 'buset2', '2014-09-20 12:11:15'),
(11, 56, 8, NULL, 'itotito', '2014-09-20 12:19:02'),
(12, 84, NULL, 3, 'siap pak yussan', '2014-09-22 02:52:51'),
(15, 84, NULL, 3, 'makan apakah', '2014-09-22 03:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `subkelas`
--

CREATE TABLE IF NOT EXISTS `subkelas` (
  `id_subkelas` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` int(11) NOT NULL,
  `nama` char(1) NOT NULL,
  PRIMARY KEY (`id_subkelas`),
  KEY `kelas` (`kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `subkelas`
--

INSERT INTO `subkelas` (`id_subkelas`, `kelas`, `nama`) VALUES
(1, 1, 'A'),
(2, 1, 'B'),
(3, 1, 'C'),
(4, 2, '1'),
(5, 2, '2'),
(6, 3, '1'),
(7, 3, '2'),
(9, 5, '1'),
(10, 2, '3'),
(11, 4, '1'),
(12, 4, '2');

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
-- Constraints for table `grup`
--
ALTER TABLE `grup`
  ADD CONSTRAINT `grup_ibfk_1` FOREIGN KEY (`admin_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grup_ibfk_2` FOREIGN KEY (`admin_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grup_anggota`
--
ALTER TABLE `grup_anggota`
  ADD CONSTRAINT `grup_anggota_ibfk_1` FOREIGN KEY (`id_grup`) REFERENCES `grup` (`id_grup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grup_anggota_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grup_anggota_ibfk_3` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi_ibfk_3` FOREIGN KEY (`id_matapelajaran`) REFERENCES `matapelajaran` (`id_matapelajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi_ibfk_4` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD CONSTRAINT `mengajar_ibfk_1` FOREIGN KEY (`id_subkelas`) REFERENCES `subkelas` (`id_subkelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mengajar_ibfk_2` FOREIGN KEY (`id_matapelajaran`) REFERENCES `matapelajaran` (`id_matapelajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mengajar_ibfk_3` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`id_matapelajaran`) REFERENCES `matapelajaran` (`id_matapelajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`subkelas1`) REFERENCES `subkelas` (`id_subkelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`subkelas2`) REFERENCES `subkelas` (`id_subkelas`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`subkelas3`) REFERENCES `subkelas` (`id_subkelas`) ON DELETE SET NULL ON UPDATE CASCADE;

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
  ADD CONSTRAINT `status_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_ibfk_3` FOREIGN KEY (`id_grup`) REFERENCES `grup` (`id_grup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_ibfk_4` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_ibfk_5` FOREIGN KEY (`on_id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_ibfk_6` FOREIGN KEY (`on_id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status_komentar`
--
ALTER TABLE `status_komentar`
  ADD CONSTRAINT `status_komentar_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_komentar_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subkelas`
--
ALTER TABLE `subkelas`
  ADD CONSTRAINT `subkelas_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
