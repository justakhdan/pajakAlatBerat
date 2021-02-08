-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2021 at 01:06 AM
-- Server version: 10.1.28-MariaDB
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
-- Database: `pajakalatberat`
--

-- --------------------------------------------------------

--
-- Table structure for table `alatberat`
--

CREATE TABLE `alatberat` (
  `kodeAB` varchar(15) NOT NULL,
  `kodeType` varchar(13) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `njkb` bigint(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alatberat`
--

INSERT INTO `alatberat` (`kodeAB`, `kodeType`, `tahun`, `njkb`) VALUES
('DAE22D11', 'DAE22D', '2011', 1250000000);

-- --------------------------------------------------------

--
-- Table structure for table `datakaryawan`
--

CREATE TABLE `datakaryawan` (
  `kodeAkses` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomorTelepon` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datakaryawan`
--

INSERT INTO `datakaryawan` (`kodeAkses`, `nama`, `alamat`, `nomorTelepon`, `email`) VALUES
('A0001', 'RIDWAN BAYU', 'JL. MUSI', '085244158966', 'ridwan@upt.co.id'),
('O0001', 'HENDRI', 'JL. KAPUAS', '085223366998', 'hendri@upt.co.id'),
('O0002', 'IWAN SETIAWAN', 'Jalan BOJONGSARI, RT. 03, RW 02, No. 21 Kelurahan BOJONGKONENG, Kecamatan BOJONGSOANG, Kode Pos 22183', '082399382019', 'iwan@upt.co.id');

-- --------------------------------------------------------

--
-- Table structure for table `datauser`
--

CREATE TABLE `datauser` (
  `kodeAkses` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomorTelepon` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datauser`
--

INSERT INTO `datauser` (`kodeAkses`, `nama`, `alamat`, `nomorTelepon`, `email`) VALUES
('P0001', 'PT. SUMITOMO', 'INDAHKIAT', '081234561234', 'admin@sumitomo.com'),
('P0002', 'PT. INTECS', 'JALAN SOEKANO HATTA, RT. 10, RW 15, NO. 01 KELURAHAN TANGKERANG, KECAMATAN TANGKERANG SELATAN, KODE POS 288391', '08117736271', 'admin@intecs.co.id'),
('P0003', 'PT INDEX', 'JALAN SOEKARNO HATTA, RT. 10, RW 22, NO. 03 KELURAHAN REJOSARI, KECAMATAN REJOBABAKAN, KODE POS 28837', '0762883721', 'admin@index.co.id'),
('U0001', 'JUNAIDI', 'JALAN SOEKARNO-HATTA, RT. 03, RW 02, NO. 1 KELURAHAN REJOSARI, KECAMATAN TENAYAN RAYA, KODE POS 22371', '081277362783', 'junaidi@gmail.com'),
('U0002', 'RIYADH SAIFUL', 'JALAN UJUNG GENTENG, RT. 10, RW 21, NO. 7 KELURAHAN KULON, KECAMATAN CEMPAKA, KODE POS 32113', '081677382611', 'riyadhsaiful21@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `dendapajak`
--

CREATE TABLE `dendapajak` (
  `indexDenda` int(11) NOT NULL,
  `nilaiDenda` decimal(5,4) NOT NULL,
  `keteranganDenda` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dendapajak`
--

INSERT INTO `dendapajak` (`indexDenda`, `nilaiDenda`, `keteranganDenda`) VALUES
(1, '0.2500', 'DENDA DASAR');

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `kodeInvent` varchar(8) NOT NULL,
  `noRangka` varchar(17) NOT NULL,
  `noMesin` varchar(10) NOT NULL,
  `warna` varchar(12) NOT NULL,
  `tanggalMasuk` datetime NOT NULL,
  `tanggalJatuhTempo` datetime NOT NULL,
  `kodeAB` varchar(15) NOT NULL,
  `kodeAkses` varchar(5) NOT NULL,
  `kodeAju` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`kodeInvent`, `noRangka`, `noMesin`, `warna`, `tanggalMasuk`, `tanggalJatuhTempo`, `kodeAB`, `kodeAkses`, `kodeAju`) VALUES
('P0001003', 'RANGKA12', 'MESIN12', 'HIJAU', '2017-02-06 00:00:00', '2020-02-06 00:00:00', 'DAE22D11', 'P0001', NULL),
('U0001001', 'RANGKA11', 'MESIN11', 'BIRU', '2018-02-05 00:00:00', '2019-02-05 00:00:00', 'DAE22D11', 'U0001', NULL),
('U0002001', 'RANGKA13', 'MESIN13', 'ORANGE', '2018-02-07 00:00:00', '2019-02-07 00:00:00', 'DAE22D11', 'U0002', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenisalat`
--

CREATE TABLE `jenisalat` (
  `indexJenis` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenisalat`
--

INSERT INTO `jenisalat` (`indexJenis`, `jenis`) VALUES
(2, 'CRAWLER EXCAVATOR'),
(6, 'FORKLIFT'),
(1, 'WHEEL EXCAVATOR');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `kodeAksesKaryawan` varchar(5) DEFAULT NULL,
  `kodeAksesUser` varchar(5) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `hakAkses` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`kodeAksesKaryawan`, `kodeAksesUser`, `username`, `password`, `hakAkses`) VALUES
('O0001', NULL, 'hendri', 'hendri', 'Operator'),
(NULL, 'P0003', 'index', 'index', 'Perusahaan'),
(NULL, 'P0002', 'intecs', 'intecs', 'Perusahaan'),
('O0002', NULL, 'iwan', 'seti', 'Operator'),
(NULL, 'U0001', 'junaid1', 'junaid1', 'Perorangan'),
('A0001', NULL, 'ridwan', 'bayu', 'Admin'),
(NULL, 'U0002', 'riyadh', 'riyadh', 'Perorangan'),
(NULL, 'P0001', 'sumitomo', 'sumitomo', 'Perusahaan');

-- --------------------------------------------------------

--
-- Table structure for table `merkalat`
--

CREATE TABLE `merkalat` (
  `kodeMerk` varchar(3) NOT NULL,
  `merk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merkalat`
--

INSERT INTO `merkalat` (`kodeMerk`, `merk`) VALUES
('CAT', 'CATERPILLAR'),
('DAE', 'DAEWOO'),
('DOO', 'DOOSAN'),
('HIT', 'HITACHI'),
('KOM', 'KOMATSU');

-- --------------------------------------------------------

--
-- Table structure for table `pajakdasar`
--

CREATE TABLE `pajakdasar` (
  `indexPajak` int(11) NOT NULL,
  `nilaiKaliPajak` decimal(7,6) NOT NULL,
  `keteranganPajak` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pajakdasar`
--

INSERT INTO `pajakdasar` (`indexPajak`, `nilaiKaliPajak`, `keteranganPajak`) VALUES
(1, '0.002000', 'PAJAK DASAR'),
(2, '0.007500', 'BEA BALIK NAMA I'),
(3, '0.000750', 'BEA BALIK NAMA II'),
(4, '0.000075', 'WARISAN');

-- --------------------------------------------------------

--
-- Table structure for table `pajakinventaris`
--

CREATE TABLE `pajakinventaris` (
  `kodeInvent` varchar(8) NOT NULL,
  `indexPajak` int(11) NOT NULL,
  `indexDenda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pajakinventaris`
--

INSERT INTO `pajakinventaris` (`kodeInvent`, `indexPajak`, `indexDenda`) VALUES
('U0001001', 4, 1),
('P0001003', 2, 1),
('U0002001', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `kodeAju` varchar(7) NOT NULL,
  `warna` varchar(12) NOT NULL,
  `noRangka` varchar(17) NOT NULL,
  `noMesin` varchar(10) NOT NULL,
  `tanggalPengajuan` datetime NOT NULL,
  `dataFaktur` varchar(255) NOT NULL,
  `dataGambar` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `kodeAkses` varchar(5) NOT NULL,
  `kodeAB` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `riwayatbbn`
--

CREATE TABLE `riwayatbbn` (
  `indexBBN` int(11) NOT NULL,
  `noRangka` varchar(17) NOT NULL,
  `kodeAksesLama` varchar(5) NOT NULL,
  `keteranganBBN` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayatbbn`
--

INSERT INTO `riwayatbbn` (`indexBBN`, `noRangka`, `kodeAksesLama`, `keteranganBBN`) VALUES
(1, 'RANGKA12', 'P0002', 'BEA BALIK NAMA I'),
(2, 'RANGKA11', 'P0002', 'WARISAN');

-- --------------------------------------------------------

--
-- Table structure for table `riwayatpajak`
--

CREATE TABLE `riwayatpajak` (
  `noIndex` int(4) NOT NULL,
  `kodeInvent` varchar(8) NOT NULL,
  `tanggalJatuhTempo` datetime NOT NULL,
  `tanggalPembayaran` datetime NOT NULL,
  `nilaiPajak` int(10) NOT NULL,
  `denda` int(10) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `keteranganBayar` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayatpajak`
--

INSERT INTO `riwayatpajak` (`noIndex`, `kodeInvent`, `tanggalJatuhTempo`, `tanggalPembayaran`, `nilaiPajak`, `denda`, `jumlah`, `keteranganBayar`) VALUES
(1, 'P0001003', '2018-02-06 00:00:00', '2019-03-17 00:00:00', 2500000, 625000, 3125000, 'PEMBAYARAN TELAT 1 TAHUN'),
(2, 'P0001003', '2019-02-06 00:00:00', '2019-03-17 00:00:00', 2500000, 104166, 2604166, 'PEMBAYARAN TELAT 2 BULAN');

-- --------------------------------------------------------

--
-- Table structure for table `tandatangan`
--

CREATE TABLE `tandatangan` (
  `indexTTD` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tandatangan`
--

INSERT INTO `tandatangan` (`indexTTD`, `nama`, `jabatan`, `keterangan`) VALUES
(1, 'H. RUDY SYAFIRUDIN, S.I.K., S.H.', 'KAPOLDA RIAU DIR. LANTAS', 'KOMRES POL. NRP 71120453'),
(2, 'DRS. H. INDRA PUTRAYANA, M.SI.', 'KEPALA BADAN PENDAPATAN DAERAH PROVINSI RIAU', 'PEMBINA UTAMA MADYA NIP 19620217 198503 1 017'),
(3, 'H. WIDAYANA, S.E., M.M.', 'KACAB PT. JASA RAHARJA (PERSERO) CABANG RIAU', 'NPP. 638911169');

-- --------------------------------------------------------

--
-- Table structure for table `typealat`
--

CREATE TABLE `typealat` (
  `kodeType` varchar(13) NOT NULL,
  `kodeMerk` varchar(3) NOT NULL,
  `type` varchar(12) NOT NULL,
  `indexJenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `typealat`
--

INSERT INTO `typealat` (`kodeType`, `kodeMerk`, `type`, `indexJenis`) VALUES
('DAE22D', 'DAE', '22D', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alatberat`
--
ALTER TABLE `alatberat`
  ADD PRIMARY KEY (`kodeAB`),
  ADD KEY `kodeType` (`kodeType`);

--
-- Indexes for table `datakaryawan`
--
ALTER TABLE `datakaryawan`
  ADD PRIMARY KEY (`kodeAkses`);

--
-- Indexes for table `datauser`
--
ALTER TABLE `datauser`
  ADD PRIMARY KEY (`kodeAkses`);

--
-- Indexes for table `dendapajak`
--
ALTER TABLE `dendapajak`
  ADD PRIMARY KEY (`indexDenda`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`kodeInvent`),
  ADD UNIQUE KEY `noRangka` (`noRangka`),
  ADD UNIQUE KEY `noMesin` (`noMesin`),
  ADD KEY `kodeAju` (`kodeAju`),
  ADD KEY `kodeAB` (`kodeAB`),
  ADD KEY `kodeAkses` (`kodeAkses`);

--
-- Indexes for table `jenisalat`
--
ALTER TABLE `jenisalat`
  ADD PRIMARY KEY (`indexJenis`),
  ADD UNIQUE KEY `jenis` (`jenis`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `kodeAksesKaryawan` (`kodeAksesKaryawan`),
  ADD UNIQUE KEY `kodeAksesUser_2` (`kodeAksesUser`),
  ADD KEY `kodeAkses` (`kodeAksesKaryawan`),
  ADD KEY `kodeAksesUser` (`kodeAksesUser`);

--
-- Indexes for table `merkalat`
--
ALTER TABLE `merkalat`
  ADD PRIMARY KEY (`kodeMerk`),
  ADD UNIQUE KEY `merk` (`merk`);

--
-- Indexes for table `pajakdasar`
--
ALTER TABLE `pajakdasar`
  ADD PRIMARY KEY (`indexPajak`);

--
-- Indexes for table `pajakinventaris`
--
ALTER TABLE `pajakinventaris`
  ADD KEY `kodeInvent` (`kodeInvent`),
  ADD KEY `indexPajak` (`indexPajak`),
  ADD KEY `indexDenda` (`indexDenda`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`kodeAju`),
  ADD KEY `kodeAkses` (`kodeAkses`),
  ADD KEY `kodeAB` (`kodeAB`);

--
-- Indexes for table `riwayatbbn`
--
ALTER TABLE `riwayatbbn`
  ADD PRIMARY KEY (`indexBBN`),
  ADD KEY `noRangka` (`noRangka`);

--
-- Indexes for table `riwayatpajak`
--
ALTER TABLE `riwayatpajak`
  ADD PRIMARY KEY (`noIndex`),
  ADD KEY `kodeInvent` (`kodeInvent`);

--
-- Indexes for table `tandatangan`
--
ALTER TABLE `tandatangan`
  ADD PRIMARY KEY (`indexTTD`);

--
-- Indexes for table `typealat`
--
ALTER TABLE `typealat`
  ADD PRIMARY KEY (`kodeType`),
  ADD UNIQUE KEY `type` (`type`),
  ADD KEY `kodeMerk` (`kodeMerk`),
  ADD KEY `indexJenis` (`indexJenis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dendapajak`
--
ALTER TABLE `dendapajak`
  MODIFY `indexDenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenisalat`
--
ALTER TABLE `jenisalat`
  MODIFY `indexJenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pajakdasar`
--
ALTER TABLE `pajakdasar`
  MODIFY `indexPajak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `riwayatbbn`
--
ALTER TABLE `riwayatbbn`
  MODIFY `indexBBN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `riwayatpajak`
--
ALTER TABLE `riwayatpajak`
  MODIFY `noIndex` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tandatangan`
--
ALTER TABLE `tandatangan`
  MODIFY `indexTTD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alatberat`
--
ALTER TABLE `alatberat`
  ADD CONSTRAINT `alatberat_ibfk_1` FOREIGN KEY (`kodeType`) REFERENCES `typealat` (`kodeType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD CONSTRAINT `inventaris_ibfk_2` FOREIGN KEY (`kodeAkses`) REFERENCES `datauser` (`kodeAkses`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventaris_ibfk_3` FOREIGN KEY (`kodeAB`) REFERENCES `alatberat` (`kodeAB`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventaris_ibfk_4` FOREIGN KEY (`kodeAju`) REFERENCES `pengajuan` (`kodeAju`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`kodeAksesKaryawan`) REFERENCES `datakaryawan` (`kodeAkses`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`kodeAksesUser`) REFERENCES `datauser` (`kodeAkses`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pajakinventaris`
--
ALTER TABLE `pajakinventaris`
  ADD CONSTRAINT `pajakinventaris_ibfk_1` FOREIGN KEY (`kodeInvent`) REFERENCES `inventaris` (`kodeInvent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pajakinventaris_ibfk_2` FOREIGN KEY (`indexPajak`) REFERENCES `pajakdasar` (`indexPajak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pajakinventaris_ibfk_3` FOREIGN KEY (`indexDenda`) REFERENCES `dendapajak` (`indexDenda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`kodeAkses`) REFERENCES `datauser` (`kodeAkses`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_2` FOREIGN KEY (`kodeAB`) REFERENCES `alatberat` (`kodeAB`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayatbbn`
--
ALTER TABLE `riwayatbbn`
  ADD CONSTRAINT `riwayatbbn_ibfk_1` FOREIGN KEY (`noRangka`) REFERENCES `inventaris` (`noRangka`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayatpajak`
--
ALTER TABLE `riwayatpajak`
  ADD CONSTRAINT `riwayatpajak_ibfk_1` FOREIGN KEY (`kodeInvent`) REFERENCES `inventaris` (`kodeInvent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `typealat`
--
ALTER TABLE `typealat`
  ADD CONSTRAINT `typealat_ibfk_1` FOREIGN KEY (`kodeMerk`) REFERENCES `merkalat` (`kodeMerk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `typealat_ibfk_2` FOREIGN KEY (`indexJenis`) REFERENCES `jenisalat` (`indexJenis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
