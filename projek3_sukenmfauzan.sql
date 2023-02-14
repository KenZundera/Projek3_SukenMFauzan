-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Feb 2023 pada 13.10
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek3_sukenmfauzan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `namaAdmin` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Admin') NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`idAdmin`, `namaAdmin`, `username`, `password`, `level`, `status`, `profil`) VALUES
(6, 'Igris', 'Igris', '$2y$10$Bd7M2IafWkg7UVlXgO37F.NSvo5eWD2qpxVm44dinffSHxyggjZYK', 'Admin', 'Aktif', NULL),
(7, 'Beru', 'Beru', '$2y$10$Bd7M2IafWkg7UVlXgO37F.NSvo5eWD2qpxVm44dinffSHxyggjZYK', 'Admin', 'Aktif', NULL),
(8, 'Kaisel', 'Kaisel', '$2y$10$Bd7M2IafWkg7UVlXgO37F.NSvo5eWD2qpxVm44dinffSHxyggjZYK', 'Admin', 'Aktif', '63ddca57c2894.png'),
(11, 'Tusk', 'Tusk', '$2y$10$gql00QTTBuGK51jMwWe8W.NFM9N6MPlWwawijklh.MM6SrmZDQomC', 'Admin', 'Aktif', '63e8c86802b36.jpg'),
(12, 'Kamish', 'Kamish', '$2y$10$IMtJRrd6pvfdilTW/U3FBe5xqQM7s2XiWlV8PK/bK7jSDQjgPC/bq', 'Admin', 'Aktif', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `idAnggota` int(11) NOT NULL,
  `namaAnggota` varchar(50) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tempatLahir` varchar(50) DEFAULT NULL,
  `tanggalLahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`idAnggota`, `namaAnggota`, `username`, `password`, `tempatLahir`, `tanggalLahir`) VALUES
(1, 'Agus Budi', 'agusb', '$2y$10$wBkGmsCsMmbmRs6J.STqCOa7ajIDulKnyKmM/6.zOhBoDy98Vmb.S', 'Saranjana', '1994-01-13'),
(2, 'Eko Santoso', 'ekos', '$2y$10$Bd7M2IafWkg7UVlXgO37F.NSvo5eWD2qpxVm44dinffSHxyggjZYK', 'Amerika', '1994-01-29'),
(3, 'Herry Hermansyah', 'herry', '$2y$10$a/vLqvUP.5c7J/bplJsKiu7Emi2LK7BJLkVqaN7SwdnUQ8tcKfXGi', 'Subang', '1983-06-14'),
(4, 'Dafif Al Aziz Imansyah', 'dafif', '$2y$10$4dTl.2fCg5ry7YGS1zBkJ.M6YrgVERnVfCMo2ISX8uGz9u/JCHHF2', 'Subang', '2004-08-12'),
(5, 'Bakri', 'roti', '$2y$10$4NuzgVFSQQXtf5Xcuoxju.wpA0K9z8XY5Y/c4Za.APJauGvenuSaS', 'Jakarta', '1967-02-01'),
(6, 'Tusk', 'tusk', '$2y$10$vuoALgLvvcUdRazkijfh3eNE2WO128zlgxRj2wSoOw0.BRXU03Wie', 'Saranjana', '1969-12-09'),
(7, 'Roronoa Zoro', 'zoro', '$2y$10$x81nWGmU.yLSWSyp7Fma7.tCg4h1iryPIm0o3p08VvRJEXCTBOGsy', 'Wanokuni', '1994-01-05'),
(8, 'Luffy', 'luffy', '$2y$10$H8q81XX6ooG3beFySgC5BOGxIy6BBlmWTP5xxtgyndT9ntBEGB2Na', 'East Blue', '1994-01-28'),
(9, 'Vinsmoke Sanji', 'sanji', '$2y$10$09qvyCvl1/meWN7RuUegSuWRX3YT7al1iKFWIuvlv6AqGENDnDWS6', 'East Blue', '1994-01-22'),
(10, 'Nami', 'nami', '$2y$10$DZvPXvcDDvMbN2khunJo9.f2XW5u1Lc.LJbc22AMLf73xC81sWhbW', 'East Blue', '1994-04-08'),
(11, 'Nico Robin', 'robin', '$2y$10$Hmg2qgILJOE0MgDH2ROmS.7uMaNwQT1Rz0vL.PYPV4cLqsauovES6', 'Ohara', '1994-05-26'),
(12, 'Franky', 'franky', '$2y$10$ZdhXPUcwrgN81wqtAo.qzO8BQUqb8LVeS76v4361FxnvRO.w/0V6m', 'Water 7', '1994-06-29'),
(13, 'Tony Tony Chopper', 'chopper', '$2y$10$RCjzdRv6G5jcUuqlVsWf9em1KBFoSVqdP2CUTJDAazf37KoMdkP1e', 'Drum', '1994-06-14'),
(14, 'Usopp', 'usopp', '$2y$10$VWYppCAFYKHezhdC31yeaukKw5oCwsogkIax2blcKo7ymBWGKKT06', 'Syrup', '1994-06-10'),
(15, 'Brook', 'brook', '$2y$10$yXmuHlhxj9YShy103xYli.Hd8GoxPxx1WCP5bUQE4j47lcYWV1DJa', 'Florian Triangle', '1994-04-08'),
(16, 'Jinbe', 'jinbe', '$2y$10$L5tz3Id2EaA0o2o1OZzJoelK88/SrQpALdVkkkLxRS3jhgVN0Jpte', 'Fishman Island', '1994-04-08'),
(17, 'Greed', 'greed', '$2y$10$tnvWfrk09YHniVlJVfefzeXm9CikVty89NYbT2xgH.rvPfd94.MLi', 'Shadow', '1994-04-08'),
(18, 'Bellion', 'bellion', '$2y$10$gA5fVKK4FKgLgu4NF4dsa.rP1fC7PAR1mCdNaSsffrDTs15ZAU9x6', 'Shadow', '1994-03-17'),
(19, 'Giants', 'giants', '$2y$10$EhNw2gSKjvCfKzOWrnrNOeBOCF3fkW4r4YQSfC0rwNlGduVUjD4ee', 'Shadow', '1994-03-18'),
(20, 'Anton', 'anton', '$2y$10$5.PyXEgNLzaOMYGXVOAzYOoTuL6O1GIF5YbaUfmly2DMGX7gyETB6', 'Jakarta', '2004-12-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `idBuku` int(11) NOT NULL,
  `idKategori` int(11) NOT NULL,
  `judulBuku` varchar(128) DEFAULT NULL,
  `pengarang` varchar(128) DEFAULT NULL,
  `penerbit` varchar(128) DEFAULT NULL,
  `deskripsi` varchar(512) DEFAULT NULL,
  `gambarBuku` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`idBuku`, `idKategori`, `judulBuku`, `pengarang`, `penerbit`, `deskripsi`, `gambarBuku`) VALUES
(1, 1, 'The Alchemist One', 'Paulo Coelho', 'HarperCollins', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', '63e37f0762e4a.png'),
(2, 1, 'The Power of Now', 'Eckhart Tolle', 'New World Library', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', '63e31ae11c304.png'),
(3, 2, 'The Lean Startup', 'Eric Ries', 'Crown Business', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(4, 3, 'To Kill a Mockingbird', 'Harper Lee', 'HarperCollins', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(5, 3, 'Pride and Prejudice', 'Jane Austen', 'Penguin Classics', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(6, 4, '1984', 'George Orwell', 'Signet Classics', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(7, 4, 'Brave New World', 'Aldous Huxley', 'HarperCollins', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(8, 5, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 'Bloomsbury', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(9, 5, 'The Lord of the Rings', 'J.R.R. Tolkien', 'HarperCollins', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(10, 6, 'The 5 Love Languages', 'Gary Chapman', 'Northfield Publishing', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(11, 6, 'The 7 Habits of Highly Effective People', 'Stephen Covey', 'Free Press', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(12, 7, 'The Art of War', 'Sun Tzu', 'Oxford University Press', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(13, 7, 'Meditations', 'Marcus Aurelius', 'Penguin Classics', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(14, 8, 'The Hitchhiker\'s Guide to the Galaxy', 'Douglas Adams', 'Pan Books', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(15, 8, 'Good Omens', 'Neil Gaiman, Terry Pratchett', 'HarperCollins', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(16, 9, 'The Da Vinci Code', 'Dan Brown', 'Doubleday', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(17, 4, 'Harry Potter dan Batu Bertuah', 'J.K. Rowling', 'Penerbit Gramedia', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(18, 2, 'The Origin of Species', 'Charles Darwin', 'John Murray', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(19, 1, 'Einstein’s Dreams', 'Alan Lightman', 'Vintage', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(20, 5, 'Percy Jackson dan Ksatria petir', 'Rick Riordan', 'Gramedia Pustaka Utama', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?', ''),
(51, 15, 'Epic RPG Guide', 'Lume', 'Zundera', 'Some Guide for playing EPIC RPG', '63e6de64b0a35.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailbuku`
--

CREATE TABLE `detailbuku` (
  `idDetailBuku` int(11) NOT NULL,
  `idBuku` int(11) DEFAULT NULL,
  `status` enum('Dipinjam','Ada') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detailbuku`
--

INSERT INTO `detailbuku` (`idDetailBuku`, `idBuku`, `status`) VALUES
(6, 1, 'Dipinjam'),
(7, 2, 'Dipinjam'),
(8, 3, 'Dipinjam'),
(14, 1, 'Dipinjam'),
(48, 4, 'Dipinjam'),
(49, 5, 'Dipinjam'),
(50, 5, 'Ada'),
(51, 5, 'Ada'),
(52, 5, 'Ada'),
(53, 6, 'Dipinjam'),
(54, 6, 'Dipinjam'),
(55, 6, 'Dipinjam'),
(56, 6, 'Dipinjam'),
(57, 6, 'Dipinjam'),
(58, 3, 'Dipinjam'),
(60, 1, 'Dipinjam'),
(61, 1, 'Dipinjam'),
(62, 1, 'Dipinjam'),
(63, 1, 'Ada'),
(64, 1, 'Ada'),
(71, 1, 'Ada'),
(100, 1, 'Ada'),
(101, 1, 'Ada'),
(102, 1, 'Ada'),
(103, 1, 'Ada'),
(104, 1, 'Ada'),
(105, 1, 'Ada'),
(106, 1, 'Ada'),
(107, 1, 'Ada'),
(108, 1, 'Ada'),
(109, 2, 'Ada'),
(110, 3, 'Ada'),
(111, 3, 'Ada'),
(112, 3, 'Ada'),
(113, 3, 'Ada'),
(114, 3, 'Ada'),
(115, 3, 'Ada'),
(116, 3, 'Ada'),
(117, 3, 'Ada'),
(118, 2, 'Ada'),
(119, 2, 'Ada'),
(120, 2, 'Ada'),
(121, 2, 'Ada'),
(122, 4, 'Ada'),
(123, 4, 'Ada'),
(124, 4, 'Ada'),
(125, 4, 'Ada'),
(126, 4, 'Ada'),
(127, 4, 'Ada'),
(128, 4, 'Ada'),
(129, 4, 'Ada'),
(130, 4, 'Ada'),
(131, 4, 'Ada'),
(132, 5, 'Ada'),
(133, 5, 'Ada'),
(134, 5, 'Ada'),
(135, 5, 'Ada'),
(136, 5, 'Ada'),
(137, 5, 'Ada'),
(138, 5, 'Ada'),
(139, 6, 'Ada'),
(140, 6, 'Ada'),
(141, 6, 'Ada'),
(142, 6, 'Ada'),
(143, 6, 'Ada'),
(144, 6, 'Ada'),
(145, 6, 'Ada'),
(146, 6, 'Ada'),
(147, 6, 'Ada'),
(148, 6, 'Ada'),
(149, 6, 'Ada'),
(150, 6, 'Ada'),
(151, 6, 'Ada'),
(152, 6, 'Ada'),
(153, 7, 'Ada'),
(154, 7, 'Ada'),
(155, 7, 'Ada'),
(156, 7, 'Ada'),
(157, 7, 'Ada'),
(158, 7, 'Ada'),
(159, 7, 'Ada'),
(160, 7, 'Ada'),
(161, 7, 'Ada'),
(162, 7, 'Ada'),
(163, 7, 'Ada'),
(164, 7, 'Ada'),
(165, 7, 'Ada'),
(166, 7, 'Ada'),
(167, 8, 'Ada'),
(168, 8, 'Ada'),
(169, 8, 'Ada'),
(170, 8, 'Ada'),
(171, 8, 'Ada'),
(172, 8, 'Ada'),
(173, 8, 'Ada'),
(174, 8, 'Ada'),
(175, 11, 'Ada'),
(176, 11, 'Ada'),
(177, 11, 'Ada'),
(178, 11, 'Ada'),
(179, 11, 'Ada'),
(180, 11, 'Ada'),
(181, 11, 'Ada'),
(182, 11, 'Ada'),
(183, 11, 'Ada'),
(184, 11, 'Ada'),
(185, 11, 'Ada'),
(186, 11, 'Ada'),
(187, 12, 'Ada'),
(188, 12, 'Ada'),
(189, 12, 'Ada'),
(190, 12, 'Ada'),
(191, 12, 'Ada'),
(192, 12, 'Ada'),
(193, 12, 'Ada'),
(194, 12, 'Ada'),
(195, 12, 'Ada'),
(196, 12, 'Ada'),
(197, 12, 'Ada'),
(198, 12, 'Ada'),
(199, 13, 'Ada'),
(200, 13, 'Ada'),
(201, 13, 'Ada'),
(202, 13, 'Ada'),
(203, 13, 'Ada'),
(204, 13, 'Ada'),
(205, 13, 'Ada'),
(206, 13, 'Ada'),
(207, 13, 'Ada'),
(208, 13, 'Ada'),
(209, 13, 'Ada'),
(210, 14, 'Ada'),
(211, 14, 'Ada'),
(212, 14, 'Ada'),
(213, 14, 'Ada'),
(214, 14, 'Ada'),
(215, 14, 'Ada'),
(216, 14, 'Ada'),
(217, 14, 'Ada'),
(218, 14, 'Ada'),
(219, 14, 'Ada'),
(220, 14, 'Ada'),
(221, 15, 'Ada'),
(222, 15, 'Ada'),
(223, 15, 'Ada'),
(224, 15, 'Ada'),
(225, 15, 'Ada'),
(226, 15, 'Ada'),
(227, 15, 'Ada'),
(228, 15, 'Ada'),
(229, 15, 'Ada'),
(230, 15, 'Ada'),
(231, 16, 'Ada'),
(232, 16, 'Ada'),
(233, 16, 'Ada'),
(234, 16, 'Ada'),
(235, 16, 'Ada'),
(236, 16, 'Ada'),
(237, 16, 'Ada'),
(238, 16, 'Ada'),
(239, 16, 'Ada'),
(240, 16, 'Ada'),
(241, 16, 'Ada'),
(242, 16, 'Ada'),
(243, 16, 'Ada'),
(244, 17, 'Ada'),
(245, 17, 'Ada'),
(246, 17, 'Ada'),
(247, 17, 'Ada'),
(248, 17, 'Ada'),
(249, 17, 'Ada'),
(250, 17, 'Ada'),
(251, 17, 'Ada'),
(252, 17, 'Ada'),
(253, 17, 'Ada'),
(254, 17, 'Ada'),
(255, 17, 'Ada'),
(256, 17, 'Ada'),
(257, 17, 'Ada'),
(258, 18, 'Ada'),
(259, 18, 'Ada'),
(260, 18, 'Ada'),
(261, 18, 'Ada'),
(262, 18, 'Ada'),
(263, 18, 'Ada'),
(264, 18, 'Ada'),
(265, 18, 'Ada'),
(266, 18, 'Ada'),
(267, 18, 'Ada'),
(268, 18, 'Ada'),
(269, 18, 'Ada'),
(270, 18, 'Ada'),
(271, 19, 'Ada'),
(272, 19, 'Ada'),
(273, 19, 'Ada'),
(274, 19, 'Ada'),
(275, 19, 'Ada'),
(276, 19, 'Ada'),
(277, 19, 'Ada'),
(278, 20, 'Ada'),
(279, 20, 'Ada'),
(280, 20, 'Ada'),
(281, 20, 'Ada'),
(282, 20, 'Ada'),
(283, 20, 'Ada'),
(284, 51, 'Dipinjam'),
(285, 51, 'Ada'),
(286, 1, 'Ada'),
(287, 1, 'Ada'),
(288, 1, 'Ada');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailpeminjaman`
--

CREATE TABLE `detailpeminjaman` (
  `idDetailPeminjaman` int(11) NOT NULL,
  `idPeminjaman` int(11) DEFAULT NULL,
  `idDetailBuku` int(11) DEFAULT NULL,
  `tanggalKembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detailpeminjaman`
--

INSERT INTO `detailpeminjaman` (`idDetailPeminjaman`, `idPeminjaman`, `idDetailBuku`, `tanggalKembali`) VALUES
(8, 8, 8, '2023-02-08'),
(11, 11, 8, '2023-02-09'),
(13, 13, 8, '0000-00-00'),
(19, 19, 6, '0000-00-00'),
(51, 54, 62, '0000-00-00'),
(55, 58, 58, '0000-00-00'),
(56, 59, 284, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `kategori` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`idkategori`, `kategori`) VALUES
(1, 'Sains'),
(2, 'Matematika'),
(3, 'Sejarah'),
(4, 'Geografi'),
(5, 'Bahasa'),
(6, 'Seni'),
(7, 'Ekonomi'),
(8, 'Sosiologi'),
(9, 'Fisika'),
(10, 'Kimia'),
(11, 'Biologi'),
(12, 'Komik Anak'),
(13, 'Komik Dewasa'),
(14, 'Novel'),
(15, 'Buku Pelajaran'),
(16, 'Ensiklopedia'),
(17, 'Buku Ilmiah'),
(18, 'Buku Keuangan'),
(19, 'Buku Hiburan'),
(20, 'Buku Motivasi'),
(27, 'Buku Tutorial');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `idPeminjaman` int(11) NOT NULL,
  `idAdmin` int(11) DEFAULT NULL,
  `idAnggota` int(11) DEFAULT NULL,
  `tanggalPinjam` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`idPeminjaman`, `idAdmin`, `idAnggota`, `tanggalPinjam`) VALUES
(8, 8, 8, '2023-02-01'),
(11, 8, 12, '2023-02-08'),
(13, 6, 14, '2023-02-09'),
(19, 6, 9, '2023-02-09'),
(54, 6, 1, '2023-02-10'),
(57, 6, 4, '2023-02-09'),
(58, 6, 1, '2023-02-09'),
(59, 6, 1, '2023-02-10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`idAnggota`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`idBuku`),
  ADD KEY `buku_ibfk_1` (`idKategori`);

--
-- Indeks untuk tabel `detailbuku`
--
ALTER TABLE `detailbuku`
  ADD PRIMARY KEY (`idDetailBuku`),
  ADD KEY `idBuku` (`idBuku`) USING BTREE;

--
-- Indeks untuk tabel `detailpeminjaman`
--
ALTER TABLE `detailpeminjaman`
  ADD PRIMARY KEY (`idDetailPeminjaman`),
  ADD KEY `idPeminjaman` (`idPeminjaman`) USING BTREE,
  ADD KEY `idDetailbuku` (`idDetailBuku`) USING BTREE;

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`idPeminjaman`),
  ADD KEY `peminjaman_ibfk_2` (`idAdmin`),
  ADD KEY `peminjaman_ibfk_1` (`idAnggota`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `idAnggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `idBuku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `detailbuku`
--
ALTER TABLE `detailbuku`
  MODIFY `idDetailBuku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT untuk tabel `detailpeminjaman`
--
ALTER TABLE `detailpeminjaman`
  MODIFY `idDetailPeminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `idPeminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`idKategori`) REFERENCES `kategori` (`idkategori`);

--
-- Ketidakleluasaan untuk tabel `detailbuku`
--
ALTER TABLE `detailbuku`
  ADD CONSTRAINT `detailbuku_ibfk_1` FOREIGN KEY (`idBuku`) REFERENCES `buku` (`idBuku`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `detailpeminjaman`
--
ALTER TABLE `detailpeminjaman`
  ADD CONSTRAINT `detailpeminjaman_ibfk_1` FOREIGN KEY (`idPeminjaman`) REFERENCES `peminjaman` (`idPeminjaman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailpeminjaman_ibfk_2` FOREIGN KEY (`idDetailBuku`) REFERENCES `detailbuku` (`idDetailBuku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`idAnggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`idAdmin`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
