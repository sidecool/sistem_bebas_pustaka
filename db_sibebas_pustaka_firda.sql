-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2021 at 05:58 AM
-- Server version: 5.6.34
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sibebas_pustaka_firda`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daftar_upload`
--

CREATE TABLE `tbl_daftar_upload` (
  `id_daftar_upload` int(11) NOT NULL,
  `ket_daftar_upload` varchar(500) NOT NULL,
  `filetype` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_daftar_upload`
--

INSERT INTO `tbl_daftar_upload` (`id_daftar_upload`, `ket_daftar_upload`, `filetype`) VALUES
(1, 'Skripsi Lengkap', '.doc, .docx'),
(2, 'Skripsi Lengkap', '.pdf'),
(3, 'Jurnal', '.doc, .docx'),
(4, 'Jurnal', '.pdf'),
(5, 'Cover', '.doc, .docx'),
(6, 'Daftar Isi', '.doc, .docx'),
(7, 'Daftar Tabel', '.doc, .docx'),
(8, 'Daftar Gambar', '.doc, .docx'),
(9, 'Abstrak Indonesia', '.doc, .docx'),
(10, 'Abstrak Inggris', '.doc, .docx'),
(11, 'Hasil Bebas Turnitin Full', '.pdf'),
(12, 'Hasil Turnitin dari Fakultas', '.pdf'),
(13, 'Cover, BAB I sampai dengan BAB V', '.doc, .docx');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fakultas`
--

CREATE TABLE `tbl_fakultas` (
  `id_fakultas` varchar(25) NOT NULL,
  `nm_fakultas` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fakultas`
--

INSERT INTO `tbl_fakultas` (`id_fakultas`, `nm_fakultas`) VALUES
('FK001', 'FAKULTAS PERTANIAN'),
('FK002', 'FAKULTAS TEKNIK'),
('FK003', 'FAKULTAS EKONOMI DAN BISNIS'),
('FK004', 'FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN'),
('FK005', 'FAKULTAS ILMU SOSIAL DAN ILMU POLITIK'),
('FK006', 'FAKULTAS HUKUM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info_dokumen`
--

CREATE TABLE `tbl_info_dokumen` (
  `npm_mahasiswa` varchar(50) NOT NULL,
  `nm_mahasiswa` varchar(250) NOT NULL,
  `judul_skripsi` text NOT NULL,
  `pembimbing_1` varchar(250) NOT NULL,
  `pembimbing_2` varchar(250) NOT NULL,
  `judul_buku_1` varchar(500) NOT NULL,
  `judul_buku_2` varchar(500) NOT NULL,
  `judul_buku_3` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_info_dokumen`
--

INSERT INTO `tbl_info_dokumen` (`npm_mahasiswa`, `nm_mahasiswa`, `judul_skripsi`, `pembimbing_1`, `pembimbing_2`, `judul_buku_1`, `judul_buku_2`, `judul_buku_3`) VALUES
('20210001', 'Mahasiswa 1', 'coba', 'coa', 'coba', 'coba', 'coba', 'coba'),
('20210002', 'aMahasiswa 2', 'apa', 'apa', 'apa', 'apa', 'apa', 'apasaja');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `id_fakultas` varchar(25) NOT NULL,
  `id_jurusan` varchar(25) NOT NULL,
  `nm_jurusan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`id_fakultas`, `id_jurusan`, `nm_jurusan`) VALUES
('FK001', 'JUR01', 'PRODI ARGOTEKNOLOGI'),
('FK001', 'JUR02', 'PRODI KETEKNIKAN PERTANIAN'),
('FK001', 'JUR03', 'PRODI PETERNAKAN'),
('FK001', 'JUR04', 'PRODI MANAJEMEN SUMBERDAYA PERAIRAN'),
('FK001', 'JUR05', 'PRODI AGRIBISNIS'),
('FK002', 'JUR01', 'PRODI TEKNIK SIPIL'),
('FK002', 'JUR02', 'PRODI TEKNIK ARISTEKTUR'),
('FK002', 'JUR03', 'PRODI TEKNIK MESIN'),
('FK002', 'JUR04', 'PRODI TEKNIK INFORMATIKA'),
('FK002', 'JUR05', 'PRODI TEKNIK ELEKTRO'),
('FK002', 'JUR06', 'PRODI SISTEM INFORMASI'),
('FK003', 'JUR01', 'PRODI MANAJEMEN'),
('FK003', 'JUR02', 'PRODI AKUNTANSI'),
('FK003', 'JUR03', 'PRODI EKONOMI PEMBANGUNAN'),
('FK004', 'JUR01', 'PRODI PENDIDIKAN JASMANIS, KESEHATAN DAN REKREASI'),
('FK004', 'JUR02', 'PRODI PENDIDIKAN MATEMATIKA'),
('FK004', 'JUR03', 'PRODI PBSI'),
('FK004', 'JUR04', 'PRODI PENDIDIKAN BIOLOGI'),
('FK004', 'JUR05', 'PRODI PENDIDIKAN KIMIA'),
('FK004', 'JUR06', 'PRODI PENDIDIKAN GURU SEKOLAH DASAR'),
('FK004', 'JUR07', 'PRODI PENDIDIKAN FISIKA'),
('FK004', 'JUR08', 'PRODI PG-PAUD'),
('FK004', 'JUR09', 'PRODI SASING'),
('FK004', 'JUR10', 'PRODI PEK'),
('FK004', 'JUR11', 'PRODI PKOM'),
('FK005', 'JUR01', 'PRODI ADMINISTRASI NEGARA - S1'),
('FK005', 'JUR02', 'PRODI ADMINISTRASI PUBLIK - S2'),
('FK006', 'JUR01', 'PRODI ILMU HUKUM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hak_akses` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`username`, `password`, `hak_akses`) VALUES
('197405162014041001', '12345', 'PEGAWAI'),
('19832011501', '12345', 'PEGAWAI'),
('20210001', '12345', 'MAHASISWA'),
('20210002', '12345', 'MAHASISWA'),
('20210003', '12345', 'MAHASISWA'),
('20210004', '12345', 'MAHASISWA'),
('20210005', '12345', 'MAHASISWA'),
('20210006', '12345', 'MAHASISWA'),
('admin', '12345', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `npm_mahasiswa` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nm_mahasiswa` varchar(250) NOT NULL,
  `alamat` varchar(5000) NOT NULL,
  `id_fakultas` varchar(25) NOT NULL,
  `id_jurusan` varchar(25) NOT NULL,
  `id_anggota_perpus` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`npm_mahasiswa`, `username`, `nm_mahasiswa`, `alamat`, `id_fakultas`, `id_jurusan`, `id_anggota_perpus`, `email`) VALUES
('20210001', '20210001', 'Mahasiswa 1', 'Alamat 1', 'FK003', 'JUR02', '20210001', ' '),
('20210002', '20210002', 'aMahasiswa 2', 'Alamat 2', 'FK002', 'JUR04', '20210002', 'a'),
('20210003', '20210003', 'Mahasiswa 3', 'Alamat 3', 'FK002', 'JUR04', '20210003', ''),
('20210004', '20210004', 'Mahasiswa 4', 'Alamat 4', 'FK002', 'JUR04', '20210004', ''),
('20210005', '20210005', 'Mahasiswa 5', 'Alamat 5', 'FK002', 'JUR04', '20210005', ''),
('20210006', '20210006', 'Mahasiswa 6', 'Alamat 6', 'FK002', 'JUR04', '20210006', '');

--
-- Triggers `tbl_mahasiswa`
--
DELIMITER $$
CREATE TRIGGER `ADD_USERLOGIN_MHS` BEFORE INSERT ON `tbl_mahasiswa` FOR EACH ROW INSERT INTO tbl_login(username, password, hak_akses) VALUES (NEW.npm_mahasiswa, '12345', 'MAHASISWA')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `DEL_USERLOGIN_MHS` AFTER DELETE ON `tbl_mahasiswa` FOR EACH ROW DELETE FROM tbl_login WHERE username=OLD.username
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nm_pegawai` varchar(250) NOT NULL,
  `nip_pegawai` varchar(50) NOT NULL,
  `jabatan` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `username`, `nm_pegawai`, `nip_pegawai`, `jabatan`) VALUES
('197405162014041001', '197405162014041001', 'Samuel Waas, S.E., M.Si', '197405162014041001', 'Kepala UPT. Perpustakaan'),
('19832011501', '19832011501', 'Lita Maulany, S.Sos', '19832011501', 'Petugas Pemeriksa');

--
-- Triggers `tbl_pegawai`
--
DELIMITER $$
CREATE TRIGGER `ADD_USERLOGIN` BEFORE INSERT ON `tbl_pegawai` FOR EACH ROW INSERT INTO tbl_login(username, password, hak_akses) VALUES (NEW.nip_pegawai, '12345', 'PEGAWAI')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `DEL_USERLOGIN` AFTER DELETE ON `tbl_pegawai` FOR EACH ROW DELETE FROM tbl_login WHERE username=OLD.username
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_upload_dokumen`
--

CREATE TABLE `tbl_upload_dokumen` (
  `npm_mahasiswa` varchar(50) NOT NULL,
  `id_daftar_upload` int(11) NOT NULL,
  `nama_file` text NOT NULL,
  `verifikasi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_upload_dokumen`
--

INSERT INTO `tbl_upload_dokumen` (`npm_mahasiswa`, `id_daftar_upload`, `nama_file`, `verifikasi`) VALUES
('20210001', 1, '1. 20210001_skripsi_lengkap.docx', 'B'),
('20210002', 1, '1. 20210002_skripsi_lengkap.docx', 'B'),
('20210002', 5, '5. 20210002_cover.docx', 'B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_daftar_upload`
--
ALTER TABLE `tbl_daftar_upload`
  ADD PRIMARY KEY (`id_daftar_upload`),
  ADD KEY `id_daftar_upload` (`id_daftar_upload`);

--
-- Indexes for table `tbl_fakultas`
--
ALTER TABLE `tbl_fakultas`
  ADD PRIMARY KEY (`id_fakultas`),
  ADD KEY `IDX_FAKULTAS` (`id_fakultas`);

--
-- Indexes for table `tbl_info_dokumen`
--
ALTER TABLE `tbl_info_dokumen`
  ADD PRIMARY KEY (`npm_mahasiswa`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`id_fakultas`,`id_jurusan`),
  ADD KEY `IDX_JURUSAN` (`id_fakultas`,`id_jurusan`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`username`),
  ADD KEY `IDX_LOGIN` (`username`) USING BTREE;

--
-- Indexes for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`npm_mahasiswa`) USING BTREE,
  ADD KEY `IDX_MAHASISWA` (`npm_mahasiswa`) USING BTREE,
  ADD KEY `FK_USERNAME_MAHASISWA` (`username`),
  ADD KEY `FK_JURUSAN_MAHASISWA` (`id_fakultas`,`id_jurusan`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `IDX_PEGAWAI` (`id_pegawai`),
  ADD KEY `FK_USERNAME_PEGAWAI` (`username`);

--
-- Indexes for table `tbl_upload_dokumen`
--
ALTER TABLE `tbl_upload_dokumen`
  ADD PRIMARY KEY (`npm_mahasiswa`,`id_daftar_upload`),
  ADD KEY `FK_DAFTAR_UPLOAD` (`id_daftar_upload`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_info_dokumen`
--
ALTER TABLE `tbl_info_dokumen`
  ADD CONSTRAINT `FK_NPM_MAHASISWA` FOREIGN KEY (`npm_mahasiswa`) REFERENCES `tbl_mahasiswa` (`npm_mahasiswa`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD CONSTRAINT `FK_FAKULTAS` FOREIGN KEY (`id_fakultas`) REFERENCES `tbl_fakultas` (`id_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD CONSTRAINT `FK_JURUSAN_MAHASISWA` FOREIGN KEY (`id_fakultas`,`id_jurusan`) REFERENCES `tbl_jurusan` (`id_fakultas`, `id_jurusan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USERNAME_MAHASISWA` FOREIGN KEY (`username`) REFERENCES `tbl_login` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD CONSTRAINT `FK_USERNAME_PEGAWAI` FOREIGN KEY (`username`) REFERENCES `tbl_login` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_upload_dokumen`
--
ALTER TABLE `tbl_upload_dokumen`
  ADD CONSTRAINT `FK_DAFTAR_UPLOAD` FOREIGN KEY (`id_daftar_upload`) REFERENCES `tbl_daftar_upload` (`id_daftar_upload`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MAHASISWA_UPLOAD` FOREIGN KEY (`npm_mahasiswa`) REFERENCES `tbl_mahasiswa` (`npm_mahasiswa`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
