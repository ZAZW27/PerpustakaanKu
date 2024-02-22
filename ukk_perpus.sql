-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 12:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE `tbl_buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`id_buku`, `judul`, `image`, `penulis`, `penerbit`, `tahun_terbit`) VALUES
(1, 'Laskar Pelangi', 'laskar-pelangi.jpeg', 'Andrea Hirata', 'Bentang Pustaka', '2005-05-30'),
(2, 'Bumi Masunia', 'bumi-manusia.jpeg', 'Pramoedya Ananta Toer', 'Hasta Mitra', '1980-01-01'),
(3, 'Supernova', '6700_Supernova_Dee Lestari_Bentang Pustaka_2001-01-01.jpg', 'Dee Lestari', 'Bentang Pustaka', '2001-01-01'),
(4, 'The Jakarta Method: Washington\'s Anticommunist Crusade and the Improbable Nation', 'jakarta-method.jpeg', 'Vincent Bevins', 'PublicAffairs', '2020-05-19'),
(5, 'Indonesia Etc.: Exploring the Imporbable Nation ', 'indonesiaEtc.jpeg', 'Elizabeth Pisani', 'W.W. Norton & Company', '2014-10-27'),
(6, 'Kartini\'s Letters to Stella Zeehandelaar', 'on feminism and nationalism.jpeg', 'Kartini', 'Kartini Asia Consulting', '2020-04-21'),
(7, 'Kamus Besar Bahasa Indonesia', 'kamus besar bahasa indonesia.jpeg', 'Balai Pustaka', 'Balai Pustaka', '0000-00-00'),
(8, 'Si Buta dari Gua Hantu', 'si buta dari goa hantu.jpeg', 'RA Kosasih', 'R.A. Kosasih', '0000-00-00'),
(9, 'Tentang Kamu: Pendidikan Seksualitas untuk Anak dan Remaja', '', 'Dr. Boyke Dian Nugraha', 'PT. Gramedia Pustaka Utama', '2014-05-30'),
(10, 'Sepakbola: Menyelami Dunia Persepakbolaan Indonesia ', 'sepakbola.jpeg', 'Muhammad Sutan Remy', 'Bentang Pustaka', '2010-01-01'),
(11, 'Eat, Pray, Love', 'eat pray love.jpeg', 'Elizabeth Gilbert', 'Penguin Books', '2006-02-16'),
(12, 'The Teaching of Haji Hasan', 'the teaching of al banna.jpeg', 'Haji Hasan Al-Banna', 'Kube Publishing', '2013-08-01'),
(13, 'Detective Conan', '3976_asdibsajd_jsanjdsanjnd_sadfjbaskjd_2024-03-05.jpeg', 'Gosho Aoyama', 'VIZ Media', '1994-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Fiksi'),
(2, 'Non-Fiksi'),
(3, 'Referensi'),
(4, 'Anaka-anak dan Remaja'),
(5, 'Pendidikan dan akademis'),
(6, 'Olahraga dan Rekreasi'),
(7, 'Kesehatan dan gaya hidup'),
(8, 'Seni dan Desain'),
(9, 'Agama'),
(10, 'Spiritual'),
(11, 'komik dan grafik novel');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_buku`
--

CREATE TABLE `tbl_kategori_buku` (
  `id_kategoribuku` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori_buku`
--

INSERT INTO `tbl_kategori_buku` (`id_kategoribuku`, `id_buku`, `id_kategori`) VALUES
(25, 1, 1),
(26, 1, 4),
(27, 2, 1),
(28, 3, 1),
(29, 4, 2),
(30, 5, 2),
(31, 6, 2),
(32, 7, 3),
(33, 8, 4),
(34, 9, 5),
(35, 10, 6),
(36, 11, 7),
(37, 12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_koleksi_pribadi`
--

CREATE TABLE `tbl_koleksi_pribadi` (
  `id_koleksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_koleksi_pribadi`
--

INSERT INTO `tbl_koleksi_pribadi` (`id_koleksi`, `id_user`, `id_buku`) VALUES
(4, 2, 11),
(5, 2, 12),
(6, 2, 8),
(13, 3, 1),
(15, 3, 2),
(16, 2, 13),
(17, 2, 2),
(18, 2, 3),
(20, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peminjaman`
--

CREATE TABLE `tbl_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(200) NOT NULL,
  `id_buku` int(200) NOT NULL,
  `tgl_peminjaman` date NOT NULL DEFAULT current_timestamp(),
  `tgl_tegat` date DEFAULT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `status_peminjaman` enum('on going','late','retrieved','late retrieved') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_peminjaman`
--

INSERT INTO `tbl_peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `tgl_peminjaman`, `tgl_tegat`, `tgl_pengembalian`, `status_peminjaman`) VALUES
(1, 3, 3, '2024-02-01', '2024-03-01', '2024-02-05', 'retrieved'),
(2, 3, 11, '2024-01-01', '2024-02-01', '2024-02-02', 'late retrieved'),
(3, 3, 4, '2024-01-01', '2024-02-01', '2024-02-13', 'retrieved'),
(4, 3, 12, '2024-01-01', '2024-02-01', '2024-02-01', 'retrieved'),
(5, 2, 4, '2023-12-13', '2024-01-13', '2024-01-13', 'retrieved'),
(6, 1, 6, '2024-02-04', '2024-02-16', '2024-02-05', 'retrieved'),
(7, 1, 3, '2024-02-05', '2024-02-17', NULL, 'on going'),
(8, 1, 4, '2024-02-13', '2024-02-25', NULL, 'on going');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `level` enum('administrator','petugas','peminjam','') NOT NULL DEFAULT 'peminjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `level`) VALUES
(1, 'zharif', 'c4ca4238a0b923820dcc509a6f75849b', 'zharifazizzulkarnain@gmail.com', 'Zharif Aziz Zulkarnain Widodo', 'Perum. Graha Indah Block W No. 22', 'administrator'),
(2, 'yusoup', 'c4ca4238a0b923820dcc509a6f75849b', 'youshouldrun@gmail.com', 'Muhammad Yusuf Pratama', 'kariangau', 'petugas'),
(3, 'radeet', 'c4ca4238a0b923820dcc509a6f75849b', 'mradytikhsan@gmail.com', 'Muhammad Radyt Ikhsan Pratama', 'perumahan wiwiw', 'petugas'),
(5, 'asdasdas', '', '', '', '', 'peminjam'),
(6, 'maul', 'c4ca4238a0b923820dcc509a6f75849b', 'arya@gmail.com', 'maulana', 'semabrang', 'peminjam');

-- --------------------------------------------------------

--
-- Table structure for table `ulasanbuku`
--

CREATE TABLE `ulasanbuku` (
  `id_ulasan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `ulasan` text NOT NULL,
  `rating` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasanbuku`
--

INSERT INTO `ulasanbuku` (`id_ulasan`, `id_user`, `id_buku`, `ulasan`, `rating`) VALUES
(1, 1, 1, 'Buku ini bagus menceritakan tentang pertualangan anak anak muda yang sungguh cerah sekali', 5),
(2, 1, 1, 'lumayan sih menceritakan tentang sebuah pertualangan yang keren\r\n', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_kategori_buku`
--
ALTER TABLE `tbl_kategori_buku`
  ADD PRIMARY KEY (`id_kategoribuku`),
  ADD KEY `kategoriBukuBuku` (`id_buku`),
  ADD KEY `kategoriBukuKategori` (`id_kategori`);

--
-- Indexes for table `tbl_koleksi_pribadi`
--
ALTER TABLE `tbl_koleksi_pribadi`
  ADD PRIMARY KEY (`id_koleksi`),
  ADD KEY `kolPribadiUser` (`id_user`),
  ADD KEY `kolPribadiBuku` (`id_buku`);

--
-- Indexes for table `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `peminjamanBuku` (`id_buku`),
  ADD KEY `peminjamanUser` (`id_user`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_kategori_buku`
--
ALTER TABLE `tbl_kategori_buku`
  MODIFY `id_kategoribuku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_koleksi_pribadi`
--
ALTER TABLE `tbl_koleksi_pribadi`
  MODIFY `id_koleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_kategori_buku`
--
ALTER TABLE `tbl_kategori_buku`
  ADD CONSTRAINT `kategoriBukuBuku` FOREIGN KEY (`id_buku`) REFERENCES `tbl_buku` (`id_buku`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kategoriBukuKategori` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_koleksi_pribadi`
--
ALTER TABLE `tbl_koleksi_pribadi`
  ADD CONSTRAINT `kolPribadiBuku` FOREIGN KEY (`id_buku`) REFERENCES `tbl_buku` (`id_buku`),
  ADD CONSTRAINT `kolPribadiUser` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  ADD CONSTRAINT `peminjamanBuku` FOREIGN KEY (`id_buku`) REFERENCES `tbl_buku` (`id_buku`) ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjamanUser` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
