-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2020 at 06:32 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubeswebpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_obat`
--

CREATE TABLE `jenis_obat` (
  `id_jenis_obat` int(11) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `kode_obat` varchar(5) NOT NULL,
  `nama_obat` varchar(128) NOT NULL,
  `id_jenis_obat` int(11) NOT NULL,
  `harga` int(6) NOT NULL,
  `stok` int(6) NOT NULL,
  `bentuk` varchar(10) NOT NULL,
  `fungsi` varchar(128) NOT NULL,
  `aturan` text NOT NULL,
  `gambar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pemesanan` date NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `role_id` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `username`, `password`, `jenis_kelamin`, `tgl_lahir`, `alamat`, `telepon`, `foto`, `role_id`, `date_created`) VALUES
(1, 'Admin Website', 'admin@admin.com', 'admin', '$2y$10$AcBtLNi2Z1wdvFZ/8LTiUuAMcX4hlDQhQ6gMUKoux87l0R8LGr7QC', 'Pria', '2020-04-15', 'di Website', '085945289027', 'default.jpg', 1, 1586929321),
(2, 'Budi Setiawan', 'budi@budi.com', 'budisetiawan', '$2y$10$aNkdtttwt.DjPo5ERt1BSOXfn0LFAGbsy5JHLJ1KWlmxOaUJoF4Ri', 'Pria', '1995-08-07', 'Jl. Ciganitri, Bojongsoang, Buahbatu, Kab. Bandung, Jawa Barat', '085945289027', 'default.jpg', 3, 1586339679),
(10, 'Siti Nurhayati', 'customer@customer.com', 'customer', '$2y$10$s8tRN18Xz8rnYVaXYcaKXO.s/aBByvVhDy6Y6T3LeKojcENmDMBX6', 'Wanita', '2020-04-08', 'Jawa Barat', '085945289027', 'FOTO_IRASWIRA.jpg', 3, 1586341942),
(11, 'Lina Melinda', 'apoteker@apoteker.com', 'apoteker', '$2y$10$kGSiSYm2WXY5H48UnWDGH.Q2oo3mR/d1CeKejUAYxMZhha0FG7YDe', 'Wanita', '2020-04-08', 'Jakarta', '085945289027', 'default.jpg', 2, 1586928181),
(12, 'Mada Riyanhadi', 'apoteker2@apoteker2.com', 'madariyanhadi', '$2y$10$SzP92fQb4tuAs8djMNFhIeYwM8.m9kzt4W6GaHv7Vl6TCgiXAuS1a', 'Pria', '2020-04-10', 'Bandung, Jawa Barat', '085945289027', 'default.jpg', 2, 1586457532),
(14, 'Andika Elang Dirgantara', 'andikelang@gmail.com', 'andikaelang', '$2y$10$o9UeQgtvDamqK8nH2VMR8eqpxjGa8U0c5UFvrmvIuAGW9VCxPTNna', 'Pria', '2020-04-15', 'Di Kosan', '085945289027', '20180910_173451-1.jpg', 1, 1586962393);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role`) VALUES
(1, 'Admin'),
(2, 'Apoteker'),
(3, 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD KEY `detail_pemesanan_fk0` (`id_pemesanan`),
  ADD KEY `detail_pemesanan_fk1` (`id_obat`);

--
-- Indexes for table `jenis_obat`
--
ALTER TABLE `jenis_obat`
  ADD PRIMARY KEY (`id_jenis_obat`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `obat_fk0` (`id_jenis_obat`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `pemesanan_fk0` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `user_fk0` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_obat`
--
ALTER TABLE `jenis_obat`
  MODIFY `id_jenis_obat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_fk0` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`),
  ADD CONSTRAINT `detail_pemesanan_fk1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`);

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_fk0` FOREIGN KEY (`id_jenis_obat`) REFERENCES `jenis_obat` (`id_jenis_obat`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_fk0` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_fk0` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
