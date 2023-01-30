-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2019 at 04:23 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eskpd`
--

-- --------------------------------------------------------

--
-- Table structure for table `kantor`
--

CREATE TABLE `kantor` (
  `id_kantor` int(11) NOT NULL,
  `nama_kantor` varchar(100) NOT NULL,
  `singkatan` varchar(50) NOT NULL,
  `knpp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kantor`
--

INSERT INTO `kantor` (`id_kantor`, `nama_kantor`, `singkatan`, `knpp`) VALUES
(1, 'Kepala Kantor', 'Kepala, ', '0307'),
(4, 'Pps. KC', 'Pps Kepala,', '0283'),
(5, 'Kepala Bidang SDM', 'Kabid SDM,', '0423');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `jenis_kendaraan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `jenis_kendaraan`) VALUES
(1, 'Transportasi Udara'),
(2, 'Transportasi Laut'),
(3, 'Kendaraan Operasional');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `npp` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hak_akses` enum('admin','pegawai','kepala_cabang') NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `pangkat` varchar(30) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `konseptor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`npp`, `password`, `hak_akses`, `nama_pegawai`, `jenis_kelamin`, `pangkat`, `jabatan`, `konseptor`) VALUES
('0283', '21232f297a57a5a743894a0e4a801fc3', 'kepala_cabang', 'Asep', 'Laki-laki', 'A1', 'Kepala Bidang Keuangan', ''),
('0307', '21232f297a57a5a743894a0e4a801fc3', 'kepala_cabang', 'Jojo', 'Laki-laki', 'A2', 'Kepala Cabang', ''),
('0423', '21232f297a57a5a743894a0e4a801fc3', 'kepala_cabang', 'Ica', 'Perempuan', 'A3', 'Plh. Kepala Bidang', ''),
('0595', '21232f297a57a5a743894a0e4a801fc3', 'pegawai', 'Ilak', 'Perempuan', 'B1', 'Staf Pengelolaan', ''),
('0660', '21232f297a57a5a743894a0e4a801fc3', 'pegawai', 'Udin', 'Laki-laki', 'B2', 'Staf Keuangan', ''),
('0770', '21232f297a57a5a743894a0e4a801fc3', 'pegawai', 'Januar', 'Laki-laki', 'B3', 'Staf SDM', ''),
('123', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Admin', '', '-', '-', '');

-- --------------------------------------------------------

--
-- Table structure for table `skpd`
--

CREATE TABLE `skpd` (
  `no_skpd` int(11) NOT NULL,
  `id_kantor` int(11) NOT NULL,
  `maksud_perjalanan` varchar(400) NOT NULL,
  `id_kendaraan` int(11) NOT NULL,
  `tempat_berangkat` enum('Tanjungpinang') DEFAULT NULL,
  `tempat_tujuan` varchar(20) NOT NULL,
  `lama_perjalanan` int(11) NOT NULL,
  `tgl_berangkat` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `pengikut1` varchar(50) NOT NULL,
  `pengikut2` varchar(50) NOT NULL,
  `pengikut3` varchar(50) NOT NULL,
  `pengikut4` varchar(50) NOT NULL,
  `pengikut5` varchar(50) NOT NULL,
  `pembebanan_anggaran` varchar(400) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `npp1` varchar(20) NOT NULL,
  `npp2` varchar(20) DEFAULT NULL,
  `npp3` varchar(20) DEFAULT NULL,
  `npp4` varchar(20) DEFAULT NULL,
  `npp5` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kantor`
--
ALTER TABLE `kantor`
  ADD PRIMARY KEY (`id_kantor`),
  ADD KEY `kepala_cabang` (`knpp`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`npp`);

--
-- Indexes for table `skpd`
--
ALTER TABLE `skpd`
  ADD PRIMARY KEY (`waktu`),
  ADD KEY `npp` (`npp1`),
  ADD KEY `id_kantor` (`id_kantor`),
  ADD KEY `id_kendaraan` (`id_kendaraan`),
  ADD KEY `npp2` (`npp2`),
  ADD KEY `npp5` (`npp5`),
  ADD KEY `npp4` (`npp4`),
  ADD KEY `npp3` (`npp3`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kantor`
--
ALTER TABLE `kantor`
  MODIFY `id_kantor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kantor`
--
ALTER TABLE `kantor`
  ADD CONSTRAINT `kantor_ibfk_1` FOREIGN KEY (`knpp`) REFERENCES `pegawai` (`npp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skpd`
--
ALTER TABLE `skpd`
  ADD CONSTRAINT `skpd_ibfk_1` FOREIGN KEY (`npp1`) REFERENCES `pegawai` (`npp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skpd_ibfk_3` FOREIGN KEY (`id_kantor`) REFERENCES `kantor` (`id_kantor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skpd_ibfk_4` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skpd_ibfk_5` FOREIGN KEY (`npp2`) REFERENCES `pegawai` (`npp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skpd_ibfk_6` FOREIGN KEY (`npp3`) REFERENCES `pegawai` (`npp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skpd_ibfk_7` FOREIGN KEY (`npp4`) REFERENCES `pegawai` (`npp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skpd_ibfk_8` FOREIGN KEY (`npp5`) REFERENCES `pegawai` (`npp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
