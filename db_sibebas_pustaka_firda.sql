-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2021 at 07:37 AM
-- Server version: 5.6.34
-- PHP Version: 5.6.32

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
  `tahun_buku_1` varchar(4) NOT NULL,
  `judul_buku_2` varchar(500) NOT NULL,
  `tahun_buku_2` varchar(4) NOT NULL,
  `judul_buku_3` varchar(500) NOT NULL,
  `tahun_buku_3` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_info_dokumen`
--

INSERT INTO `tbl_info_dokumen` (`npm_mahasiswa`, `nm_mahasiswa`, `judul_skripsi`, `pembimbing_1`, `pembimbing_2`, `judul_buku_1`, `tahun_buku_1`, `judul_buku_2`, `tahun_buku_2`, `judul_buku_3`, `tahun_buku_3`) VALUES
('20210001', 'Monalisa', 'Analisis Sistem Keuangan Berbasis Akrual di Pemerintahan Daerah Indonesia', 'Dr. Slamet, S.E., M.M.', 'Yunan, S.E., M.M', 'Akuntansi Akrual', '2015', 'Pengelolaan Keuangan Pemerintahan Daerah', '2019', 'Akuntansi Berbasis Kas dan Akrual', '2020');

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
('FK001', 'JUR01', 'ARGOTEKNOLOGI'),
('FK001', 'JUR02', 'KETEKNIKAN PERTANIAN'),
('FK001', 'JUR03', 'PETERNAKAN'),
('FK001', 'JUR04', 'MANAJEMEN SUMBERDAYA PERAIRAN'),
('FK001', 'JUR05', 'AGRIBISNIS'),
('FK002', 'JUR01', 'TEKNIK SIPIL'),
('FK002', 'JUR02', 'TEKNIK ARISTEKTUR'),
('FK002', 'JUR03', 'TEKNIK MESIN'),
('FK002', 'JUR04', 'TEKNIK INFORMATIKA'),
('FK002', 'JUR05', 'TEKNIK ELEKTRO'),
('FK002', 'JUR06', 'SISTEM INFORMASI'),
('FK003', 'JUR01', 'MANAJEMEN'),
('FK003', 'JUR02', 'AKUNTANSI'),
('FK003', 'JUR03', 'EKONOMI PEMBANGUNAN'),
('FK004', 'JUR01', 'PENDIDIKAN JASMANIS, KESEHATAN DAN REKREASI'),
('FK004', 'JUR02', 'PENDIDIKAN MATEMATIKA'),
('FK004', 'JUR03', 'PBSI'),
('FK004', 'JUR04', 'PENDIDIKAN BIOLOGI'),
('FK004', 'JUR05', 'PENDIDIKAN KIMIA'),
('FK004', 'JUR06', 'PENDIDIKAN GURU SEKOLAH DASAR'),
('FK004', 'JUR07', 'PENDIDIKAN FISIKA'),
('FK004', 'JUR08', 'PG-PAUD'),
('FK004', 'JUR09', 'SASING'),
('FK004', 'JUR10', 'PEK'),
('FK004', 'JUR11', 'PKOM'),
('FK005', 'JUR01', 'ADMINISTRASI NEGARA - S1'),
('FK005', 'JUR02', 'ADMINISTRASI PUBLIK - S2'),
('FK006', 'JUR01', 'ILMU HUKUM');

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
('20210001', '20210001', 'Monalisa', 'Jl. Kebenaran No. 7', 'FK003', 'JUR02', '20210001', ' '),
('20210002', '20210002', 'Slamet', 'Jl. Angkatan No. 44', 'FK002', 'JUR04', '20210002', ''),
('20210003', '20210003', 'Dewi', 'Jl. Pelangi No. 55', 'FK002', 'JUR04', '20210003', ''),
('20210004', '20210004', 'Nisa', 'Jl. Salak', 'FK002', 'JUR04', '20210004', ''),
('20210005', '20210005', 'Monica', 'Jl. Mangga', 'FK002', 'JUR04', '20210005', ''),
('20210006', '20210006', 'Agung', 'Jl. H. Slamet', 'FK002', 'JUR04', '20210006', '');

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
DELIMITER $$
CREATE TRIGGER `EDIT_USERINFO_MHS` AFTER UPDATE ON `tbl_mahasiswa` FOR EACH ROW UPDATE tbl_info_dokumen SET nm_mahasiswa=new.nm_mahasiswa WHERE npm_mahasiswa=OLD.npm_mahasiswa
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
  `verifikasi` varchar(25) NOT NULL,
  `tgl_upload` date NOT NULL,
  `tgl_verifikasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
