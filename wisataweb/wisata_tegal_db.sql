-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2021 at 06:41 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata_tegal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '1234admin');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_kriteria`
--

CREATE TABLE `daftar_kriteria` (
  `id` int(10) NOT NULL,
  `kriteria` varchar(20) NOT NULL,
  `bawah` varchar(20) NOT NULL,
  `tengah` varchar(20) NOT NULL,
  `atas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_kriteria`
--

INSERT INTO `daftar_kriteria` (`id`, `kriteria`, `bawah`, `tengah`, `atas`) VALUES
(41, 'Harga', 'Murah', 'Sedang', 'Mahal'),
(47, 'Jarak', 'Dekat', 'Sedang', 'Jauh'),
(48, 'Pengunjung', 'Sepi', 'Biasa', 'Ramai'),
(53, 'Luas', 'Sempit', 'Sedang', 'Longgar');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_kriteria_static`
--

CREATE TABLE `daftar_kriteria_static` (
  `id` int(20) NOT NULL,
  `kriteria` varchar(30) NOT NULL,
  `bawah` varchar(30) NOT NULL,
  `tengah` varchar(30) NOT NULL,
  `atas` varchar(30) NOT NULL,
  `nbawah` int(20) NOT NULL,
  `ntengah` int(20) NOT NULL,
  `natas` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_kriteria_static`
--

INSERT INTO `daftar_kriteria_static` (`id`, `kriteria`, `bawah`, `tengah`, `atas`, `nbawah`, `ntengah`, `natas`) VALUES
(1, 'Jarak', 'Dekat', 'Sedang', 'Jauh', 5, 10, 20),
(2, 'Pengunjung', 'Sepi', 'Biasa', 'Ramai', 1000, 4500, 10000),
(3, 'Jenis', 'Alam', 'Sosial_budaya', 'Religi_Sejarah', 0, 0, 0),
(4, 'Fasilitas', 'Sedikit', 'Cukup', 'Banyak', 5, 10, 20),
(5, 'Harga', 'Murah', 'Sedang', 'Mahal', 10000, 25000, 50000),
(17, 'Luas', 'Sempit', 'Sedang', 'Longgar', 13, 123, 232);

-- --------------------------------------------------------

--
-- Table structure for table `fuzzy_fasilitas`
--

CREATE TABLE `fuzzy_fasilitas` (
  `id` int(10) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `fasilitas` int(10) NOT NULL,
  `sedikit` float NOT NULL,
  `cukup` float NOT NULL,
  `banyak` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuzzy_fasilitas`
--

INSERT INTO `fuzzy_fasilitas` (`id`, `obyek_wisata`, `fasilitas`, `sedikit`, `cukup`, `banyak`) VALUES
(1, 'Desa Wisata Guci', 16, 0, 0.4, 0.6),
(2, 'Pantai Alam Indah', 7, 0.6, 0.4, 0),
(3, 'Pantai Purwahamba Indah', 15, 0, 0.5, 0.5),
(4, 'Waduk Cacaban', 4, 1, 0, 0),
(5, 'Wisata Kesehatan Jamu Kalibaku', 5, 1, 0, 0),
(6, 'Yogya Waterboom', 11, 0, 0.9, 0.1),
(7, 'Konsorsium Rumah Wayang', 4, 1, 0, 0),
(8, 'Gerbang Mas Bahari Waterpark', 5, 1, 0, 0),
(9, 'Rita Park', 24, 0, 0, 1),
(10, 'Hutan Mangrove Tegal', 2, 1, 0, 0),
(11, 'Makam Ki Gede Sebayu', 3, 1, 0, 0),
(12, 'Makam Sunan Amangkurat I', 3, 1, 0, 0),
(13, 'Klenteng Tek Hay Kiong', 4, 1, 0, 0),
(14, 'Situs Purbakala Semedo', 2, 1, 0, 0),
(15, 'Pool Terace Samudra', 7, 0.6, 0.4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fuzzy_harga`
--

CREATE TABLE `fuzzy_harga` (
  `id` int(10) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `harga` float NOT NULL,
  `murah` float NOT NULL,
  `sedang` float NOT NULL,
  `mahal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuzzy_harga`
--

INSERT INTO `fuzzy_harga` (`id`, `obyek_wisata`, `harga`, `murah`, `sedang`, `mahal`) VALUES
(1, 'Desa Wisata Guci', 7000, 1, 0, 0),
(2, 'Pantai Alam Indah', 5000, 1, 0, 0),
(3, 'Pantai Purwahamba Indah', 3500, 1, 0, 0),
(4, 'Waduk Cacaban', 4000, 1, 0, 0),
(5, 'Wisata Kesehatan Jamu Kalibaku', 5000, 1, 0, 0),
(6, 'Yogya Waterboom', 15000, 0, 1, 0),
(7, 'Konsorsium Rumah Wayang', 0, 1, 0, 0),
(8, 'Gerbang Mas Bahari Waterpark', 25000, 0.67, 0.33, 0),
(9, 'Rita Park', 60000, 0, 0, 1),
(10, 'Hutan Mangrove Tegal', 0, 1, 0, 0),
(11, 'Makam Ki Gede Sebayu', 0, 1, 0, 0),
(12, 'Makam Sunan Amangkurat I', 0, 1, 0, 0),
(13, 'Klenteng Tek Hay Kiong', 0, 1, 0, 0),
(14, 'Situs Purbakala Semedo', 0, 1, 0, 0),
(15, 'Pool Terace Samudra', 7500, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fuzzy_jarak`
--

CREATE TABLE `fuzzy_jarak` (
  `id` int(10) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `jarak` int(10) NOT NULL,
  `dekat` float NOT NULL,
  `sedang` float NOT NULL,
  `jauh` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuzzy_jarak`
--

INSERT INTO `fuzzy_jarak` (`id`, `obyek_wisata`, `jarak`, `dekat`, `sedang`, `jauh`) VALUES
(1, 'Desa Wisata Guci', 28, 0, 0, 1),
(2, 'Pantai Alam Indah', 18, 0, 0.2, 0.8),
(3, 'Pantai Purwahamba Indah', 25, 0, 0, 1),
(4, 'Waduk Cacaban', 14, 0, 0.6, 0.4),
(5, 'Wisata Kesehatan Jamu Kalibaku', 22, 0, 0, 1),
(6, 'Yogya Waterboom', 16, 0, 0.4, 0.6),
(7, 'Konsorsium Rumah Wayang', 4, 1, 0, 0),
(8, 'Gerbang Mas Bahari Waterpark', 11, 0, 0.9, 0.1),
(9, 'Rita Park', 15, 0, 0.5, 0.5),
(10, 'Hutan Mangrove Tegal', 18, 0, 0.2, 0.8),
(11, 'Makam Ki Gede Sebayu', 10, 0, 1, 0),
(12, 'Makam Sunan Amangkurat I', 9, 0.2, 0.8, 0),
(13, 'Klenteng Tek Hay Kiong', 16, 0, 0.4, 0.6),
(14, 'Situs Purbakala Semedo', 24, 0, 0, 1),
(15, 'Pool Terace Samudra', 15, 0, 0.5, 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `fuzzy_jenis`
--

CREATE TABLE `fuzzy_jenis` (
  `id` int(10) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `alam` float NOT NULL,
  `sosial_budaya` float NOT NULL,
  `religi_sejarah` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuzzy_jenis`
--

INSERT INTO `fuzzy_jenis` (`id`, `obyek_wisata`, `jenis`, `alam`, `sosial_budaya`, `religi_sejarah`) VALUES
(1, 'Desa Wisata Guci', 'Alam', 1, 0, 0),
(2, 'Pantai Alam Indah', 'Alam', 1, 0, 0),
(3, 'Pantai Purwahamba Indah', 'Alam', 1, 0, 0),
(4, 'Waduk Cacaban', 'Alam', 1, 0, 0),
(5, 'Wisata Kesehatan Jamu Kalibaku', 'Alam', 1, 0, 0),
(6, 'Yogya Waterboom', 'Sosial dan Budaya', 0, 1, 0),
(7, 'Konsorsium Rumah Wayang', 'Sosial dan Budaya', 0, 1, 0),
(8, 'Gerbang Mas Bahari Waterpark', 'Sosial dan Budaya', 0, 1, 0),
(9, 'Rita Park', 'Sosial dan Budaya', 0, 1, 0),
(10, 'Hutan Mangrove Tegal', 'Alam', 1, 0, 0),
(11, 'Makam Ki Gede Sebayu', 'Religi dan Sejarah', 0, 0, 1),
(12, 'Makam Sunan Amangkurat I', 'Religi dan Sejarah', 0, 0, 1),
(13, 'Klenteng Tek Hay Kiong', 'Religi dan Sejarah', 0, 0, 1),
(14, 'Situs Purbakala Semedo', 'Religi dan Sejarah', 0, 0, 1),
(15, 'Pool Terace Samudra', 'Sosial dan Budaya', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fuzzy_luas`
--

CREATE TABLE `fuzzy_luas` (
  `id` int(11) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `luas` float NOT NULL,
  `sempit` float NOT NULL,
  `sedang` float NOT NULL,
  `longgar` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuzzy_luas`
--

INSERT INTO `fuzzy_luas` (`id`, `obyek_wisata`, `luas`, `sempit`, `sedang`, `longgar`) VALUES
(1, 'Desa Wisata Guci', 123, 0, 1, 0),
(2, 'Pantai Alam Indah', 21, 0.927273, 0.0727273, 0),
(3, 'Pantai Purwahamba Indah', 23, 0.909091, 0.0909091, 0),
(4, 'Waduk Cacaban', 232, 0, 0, 0.886179),
(5, 'Wisata Kesehatan Jamu Kalibaku', 23, 0.909091, 0.0909091, 0),
(6, 'Yogya Waterboom', 23, 0.909091, 0.0909091, 0),
(7, 'Konsorsium Rumah Wayang', 23, 0.909091, 0.0909091, 0),
(8, 'Gerbang Mas Bahari Waterpark', 232, 0, 0, 0.886179),
(9, 'Rita Park', 32, 0.827273, 0.172727, 0),
(10, 'Hutan Mangrove Tegal', 23, 0.909091, 0.0909091, 0),
(11, 'Makam Ki Gede Sebayu', 323, 0, 0, 1),
(12, 'Makam Sunan Amangkurat I', 23, 0.909091, 0.0909091, 0),
(13, 'Klenteng Tek Hay Kiong', 123, 0, 1, 0),
(14, 'Situs Purbakala Semedo', 133, 0, 0.908257, 0.0813008),
(15, 'Pool Terrace Samudra', 232, 0, 0, 0.886179);

-- --------------------------------------------------------

--
-- Table structure for table `fuzzy_pengunjung`
--

CREATE TABLE `fuzzy_pengunjung` (
  `id` int(11) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `pengunjung` int(10) NOT NULL,
  `sepi` float NOT NULL,
  `biasa` float NOT NULL,
  `ramai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuzzy_pengunjung`
--

INSERT INTO `fuzzy_pengunjung` (`id`, `obyek_wisata`, `pengunjung`, `sepi`, `biasa`, `ramai`) VALUES
(1, 'Desa Wisata Guci', 66558, 0, 0, 1),
(2, 'Pantai Alam Indah', 31446, 0, 0, 1),
(3, 'Pantai Purwahamba Indah', 29257, 0, 0, 1),
(4, 'Waduk Cacaban', 934, 1, 0, 0),
(5, 'Wisata Kesehatan Jamu Kalibaku', 3832, 0.1909, 0.8091, 0),
(6, 'Yogya Waterboom', 31187, 0, 0, 1),
(7, 'Konsorsium Rumah Wayang', 4644, 0, 0.9863, 0.0137),
(8, 'Gerbang Mas Bahari Waterpark', 1487, 0.8609, 0.1391, 0),
(9, 'Rita Park', 25043, 0, 0, 1),
(10, 'Hutan Mangrove Tegal', 900, 1, 0, 0),
(11, 'Makam Ki Gede Sebayu', 3888, 0.1749, 0.8251, 0),
(12, 'Makam Sunan Amangkurat I', 4255, 0.07, 0.93, 0),
(13, 'Klenteng Tek Hay Kiong', 5627, 0, 0.8927, 0.1073),
(14, 'Situs Purbakala Semedo', 649, 1, 0, 0),
(15, 'Pool Terace Samudra', 4411, 0.0254, 0.9746, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `id` int(10) NOT NULL,
  `nama kelompok` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`id`, `nama kelompok`) VALUES
(1, 'harga'),
(2, 'jarak');

-- --------------------------------------------------------

--
-- Table structure for table `penghitungan_bobot_tb`
--

CREATE TABLE `penghitungan_bobot_tb` (
  `id` int(11) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `bobot_jenis` float NOT NULL,
  `bobot_harga` float NOT NULL,
  `bobot_jarak` float NOT NULL,
  `bobot_fasilitas` float NOT NULL,
  `bobot_pengunjung` float NOT NULL,
  `fire_strength` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi_tb`
--

CREATE TABLE `rekomendasi_tb` (
  `no` int(10) NOT NULL,
  `obyek_wisata` varchar(30) NOT NULL,
  `harga` int(10) NOT NULL,
  `jarak` int(10) NOT NULL,
  `fire_strength` float NOT NULL,
  `fasilitas` int(10) NOT NULL,
  `pengunjung` int(10) NOT NULL,
  `jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tempat_wisata_tb`
--

CREATE TABLE `tempat_wisata_tb` (
  `obyek_wisata` varchar(30) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `fasilitas` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `pengunjung` int(10) NOT NULL,
  `jarak` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `luas` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tempat_wisata_tb`
--

INSERT INTO `tempat_wisata_tb` (`obyek_wisata`, `jenis`, `fasilitas`, `harga`, `pengunjung`, `jarak`, `id`, `luas`) VALUES
('Desa Wisata Guci', 'Alam', 16, 7000, 66558, 28, 1, 123),
('Pantai Alam Indah', 'Alam', 7, 5000, 31336, 18, 2, 21),
('Pantai Purwahamba Indah', 'Alam', 15, 3500, 29257, 25, 3, 23),
('Waduk Cacaban', 'Alam', 6, 4000, 3833, 22, 4, 232),
('Wisata Kesehatan Jamu Kalibaku', 'Alam', 6, 5000, 710, 14, 5, 23),
('Yogya Waterboom', 'Sosial dan Budaya', 10, 15000, 4644, 4, 6, 23),
('Konsorsium Rumah Wayang', 'Sosial dan Budaya', 5, 0, 1487, 11, 7, 23),
('Gerbang Mas Bahari Waterpark', 'Sosial dan Budaya', 11, 25000, 31187, 16, 8, 232),
('Rita Park', 'Sosial dan Budaya', 24, 60000, 25043, 15, 9, 32),
('Hutan Mangrove Tegal', 'Alam', 2, 0, 900, 18, 10, 23),
('Makam Ki Gede Sebayu', 'Religi dan Sejarah', 3, 0, 3888, 10, 11, 323),
('Makam Sunan Amangkurat I', 'Religi dan Sejarah', 3, 0, 4255, 9, 12, 23),
('Klenteng Tek Hay Kiong', 'Religi dan Sejarah', 4, 0, 5627, 16, 13, 123),
('Situs Purbakala Semedo', 'Religi dan Sejarah', 2, 0, 649, 24, 14, 133),
('Pool Terrace Samudra', 'Sosial dan Budaya', 7, 7500, 4411, 15, 15, 232);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_kriteria`
--
ALTER TABLE `daftar_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_kriteria_static`
--
ALTER TABLE `daftar_kriteria_static`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuzzy_fasilitas`
--
ALTER TABLE `fuzzy_fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuzzy_harga`
--
ALTER TABLE `fuzzy_harga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuzzy_jarak`
--
ALTER TABLE `fuzzy_jarak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuzzy_jenis`
--
ALTER TABLE `fuzzy_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuzzy_luas`
--
ALTER TABLE `fuzzy_luas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuzzy_pengunjung`
--
ALTER TABLE `fuzzy_pengunjung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penghitungan_bobot_tb`
--
ALTER TABLE `penghitungan_bobot_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekomendasi_tb`
--
ALTER TABLE `rekomendasi_tb`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tempat_wisata_tb`
--
ALTER TABLE `tempat_wisata_tb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_kriteria`
--
ALTER TABLE `daftar_kriteria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `daftar_kriteria_static`
--
ALTER TABLE `daftar_kriteria_static`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `fuzzy_fasilitas`
--
ALTER TABLE `fuzzy_fasilitas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `fuzzy_harga`
--
ALTER TABLE `fuzzy_harga`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `fuzzy_jarak`
--
ALTER TABLE `fuzzy_jarak`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `fuzzy_jenis`
--
ALTER TABLE `fuzzy_jenis`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `fuzzy_luas`
--
ALTER TABLE `fuzzy_luas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `fuzzy_pengunjung`
--
ALTER TABLE `fuzzy_pengunjung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penghitungan_bobot_tb`
--
ALTER TABLE `penghitungan_bobot_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=569;

--
-- AUTO_INCREMENT for table `rekomendasi_tb`
--
ALTER TABLE `rekomendasi_tb`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1465;

--
-- AUTO_INCREMENT for table `tempat_wisata_tb`
--
ALTER TABLE `tempat_wisata_tb`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
