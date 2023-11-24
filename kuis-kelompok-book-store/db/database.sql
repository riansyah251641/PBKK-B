-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2021 at 07:54 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `belanja_stok`
--

CREATE TABLE `belanja_stok` (
  `id_belanja` varchar(125) NOT NULL,
  `nama_barangb` varchar(225) NOT NULL,
  `img` varchar(125) NOT NULL,
  `tgl_belanja` date NOT NULL,
  `id_kasir` varchar(125) NOT NULL,
  `id_supplier` varchar(125) NOT NULL,
  `jumlah_belanja` varchar(25) NOT NULL,
  `harga_beli` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `belanja_stok`
--

INSERT INTO `belanja_stok` (`id_belanja`, `nama_barangb`, `img`, `tgl_belanja`, `id_kasir`, `id_supplier`, `jumlah_belanja`, `harga_beli`) VALUES
('61110d02618f6', 'PHP Pemula', '959a3768486aa056f03d16b7ce681ae3.JPG', '2021-08-09', '13431r423w', 'm334nj3nj3wd', '16', '28000'),
('611113be25aca', 'efwe', '1cbe17f3022df489fb4b9e59da830809.PNG', '2021-08-09', '13431r423w', 'm334nj3nj3wd', '2', '27000');

-- --------------------------------------------------------

--
-- Table structure for table `detail_beli`
--

CREATE TABLE `detail_beli` (
  `id_detail` varchar(125) NOT NULL,
  `id_buku` varchar(125) NOT NULL,
  `jumlah_belii` varchar(122) NOT NULL,
  `total` varchar(125) NOT NULL,
  `id_transaksi` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_beli`
--

INSERT INTO `detail_beli` (`id_detail`, `id_buku`, `jumlah_belii`, `total`, `id_transaksi`) VALUES
('1425wgt4', '610811b046aa2', '3', '75000', '610e2b9d17837'),
('6110e873435e6', '6108cb2ba6c3e', '4', '30000', '6110e8715c60b'),
('6110e873435eb', '610811b046aa2', '3', '75000', '6110e8715c60b'),
('6110fd56a9db9', '6108cb2ba6c3e', '3', '22500', '6110fd4fe5f91');

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` varchar(25) NOT NULL,
  `nama_kasir` varchar(125) NOT NULL,
  `alamat` varchar(125) NOT NULL,
  `no_hp` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `nama_kasir`, `alamat`, `no_hp`) VALUES
('13431r423w', 'Kasir IZZI', '-', '-'),
('3hihu24132e', 'Joko Joyo', 'Jl.Bumi Datar No.231', '085796841257'),
('6102793432636', 'Sutrisno', 'Jl.Bumi indonesia No.55 Banyuwangi', '085231479855');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` varchar(134) NOT NULL,
  `nama_kategori` varchar(1353) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
('6101933e6b745', 'Buku Pelajaran'),
('610196131c908', 'Komik');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `kd_konsumen` varchar(35) NOT NULL,
  `nama_konsumen` varchar(255) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `username` varchar(125) NOT NULL,
  `password` varchar(125) NOT NULL,
  `alamat` varchar(122) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `foto` varchar(45) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`kd_konsumen`, `nama_konsumen`, `jk`, `username`, `password`, `alamat`, `no_hp`, `foto`, `level`) VALUES
('610d217f82c42', 'Solihin', 'Laki - Laki', 'solihin', '$2a$12$blI4n0w/2XCccxa70c4EueBgliuAuH3lcHBc.qRVCJWJVQDkUQabO', 'Jl.Bumi Bulat Nusantara no.99 kraksaan', '089765123422', 'cb022637e5181b2f5ab4cf8c16ce91a8.jpg', 'konsumen'),
('6110ee6031c14', 'dafasfea', 'L', 'a', '$2y$10$.MqU.jOmJWTyaK.QdA98ZeF6NW7Zp2.kMFxEVFTCE1Z9r9DXOmOAy', 'rgwefw', '632532432', 'e1aafd1f13c89f04c4de874fe25bb219.jpg', 'konsumen'),
('f32terw23ed', 'Sofia', 'Perempuan', 'sofia', '$2a$12$blI4n0w/2XCccxa70c4EueBgliuAuH3lcHBc.qRVCJWJVQDkUQabO', 'Jl.Indonesia Raya no.23 Tiris', '085216548887', 'zxz.jpg', 'konsumen');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` varchar(124) NOT NULL,
  `username` varchar(125) NOT NULL,
  `password` varchar(152) NOT NULL,
  `level` varchar(10) NOT NULL,
  `id_kasir` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`, `level`, `id_kasir`) VALUES
('3ewfsr324321', 'admin', '$2y$10$w8qvAcjkW1Jkrn7RiPpafO/kiCSRLKeJCDVMOiaKoRoiKg.Vog0Yq', 'admin', '13431r423w');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(125) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `nama_penerbit` varchar(255) NOT NULL,
  `no_hp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `nama_penerbit`, `no_hp`) VALUES
('610256e99fc29', 'Sanusi', 'SHINE BOOK', '085796485785'),
('m334nj3nj3wd', 'Darwin', 'PUSTAKA CITRA', '087253648222');

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` varchar(343) NOT NULL,
  `judul_buku` varchar(343) NOT NULL,
  `nama_penerbit` varchar(214) NOT NULL,
  `keterangan` varchar(343) NOT NULL,
  `kategori` varchar(343) NOT NULL,
  `harga_stok` varchar(125) NOT NULL,
  `harga` varchar(343) NOT NULL,
  `stok` varchar(343) NOT NULL,
  `gambar` varchar(3434) NOT NULL,
  `qrcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `judul_buku`, `nama_penerbit`, `keterangan`, `kategori`, `harga_stok`, `harga`, `stok`, `gambar`, `qrcode`) VALUES
('6108105eaadcc', 'PHP Pemula', 'PUSTAKA CITRA', 'qwe', '6101933e6b745', '28000', '30000', '20', '959a3768486aa056f03d16b7ce681ae3.JPG', '6108105eaadcc.png'),
('610811b046aa2', 'MATEMATIKA', 'PUSTAKA CITRA', 'AFJSDJKFL;DSJF', '6101933e6b745', '22000', '25000', '30', '59f2970b099c7828f5292b8dbae83bb3.JPG', '610811b046aa2.png'),
('610813220b84f', 'Pengetahuan Alam', 'PUSTAKA CITRA', 'TES 123IJASKDEJ', '6101933e6b745', '8000', '10000', '53', 'a6b02b8d6c3d49d7020483d49e8d7a99.JPG', '610813220b84f.png'),
('6108cb2ba6c3e', 'Komik Ultraman', 'SHINE BOOK', 'aegfaewa', '610196131c908', '5000', '7500', '27', 'df6ae08d0f38111decd320b7fb81b27b.JPG', '6108cb2ba6c3e.png'),
('611113be25aca', 'efwe', 'PUSTAKA CITRA', '', '', '27000', '', '2', '1cbe17f3022df489fb4b9e59da830809.PNG', '611113be25aca.png');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(125) NOT NULL,
  `id_konsumen` varchar(125) NOT NULL,
  `id_kasir` varchar(125) NOT NULL,
  `tgl_belii` date NOT NULL,
  `bayar` varchar(10) NOT NULL,
  `alamat_kirim` varchar(225) NOT NULL,
  `kurir` varchar(125) NOT NULL,
  `metode_pembayaran` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_konsumen`, `id_kasir`, `tgl_belii`, `bayar`, `alamat_kirim`, `kurir`, `metode_pembayaran`) VALUES
('610e2b9d17837', '610d217f82c42', '13431r423w', '2021-08-07', '50000', '-', '-', '-'),
('6110e8715c60b', 'f32terw23ed', '-', '2021-08-09', '105000', 'Jl.Indonesia Raya no.23 Tiris', 'Sicepat', 'BCA - 314136132133'),
('6110fd4fe5f91', 'f32terw23ed', '-', '2021-08-09', '22500', 'Jl.Indonesia Raya no.23 Tiris', 'JNE', 'BCA - 314136132133');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `belanja_stok`
--
ALTER TABLE `belanja_stok`
  ADD PRIMARY KEY (`id_belanja`);

--
-- Indexes for table `detail_beli`
--
ALTER TABLE `detail_beli`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`kd_konsumen`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
