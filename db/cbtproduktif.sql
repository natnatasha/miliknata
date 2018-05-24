-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20 Mei 2018 pada 15.32
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbtproduktif`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `query_absen`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `query_absen` (
`nis` varchar(8)
,`nama` varchar(100)
,`jk` varchar(1)
,`rayon` varchar(20)
,`rombel` varchar(20)
,`hadir` int(1)
,`sakit` int(1)
,`izin` int(1)
,`alpa` int(1)
,`tgl_absen` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `query_bkp`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `query_bkp` (
`nis` varchar(8)
,`nama` varchar(100)
,`jk` varchar(1)
,`rayon` varchar(20)
,`rombel` varchar(20)
,`kode_kinerja` varchar(8)
,`nama_kinerja` varchar(250)
,`kelompok` varchar(1)
,`skor` int(11)
,`saksi` varchar(25)
,`tgl` varchar(10)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absen`
--

CREATE TABLE `tb_absen` (
  `nis` varchar(8) NOT NULL,
  `hadir` int(1) NOT NULL,
  `sakit` int(1) NOT NULL,
  `izin` int(1) NOT NULL,
  `alpa` int(1) NOT NULL,
  `tgl_absen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_absen`
--

INSERT INTO `tb_absen` (`nis`, `hadir`, `sakit`, `izin`, `alpa`, `tgl_absen`) VALUES
('11605377', 1, 0, 0, 0, '27/04/2018'),
('11605700', 1, 0, 0, 0, '27/04/2018'),
('11605377', 1, 0, 0, 0, '30/04/2018'),
('11605700', 1, 0, 0, 0, '30/04/2018'),
('11605377', 0, 1, 0, 0, '26/04/2018'),
('11605700', 0, 0, 1, 0, '26/04/2018'),
('11605377', 1, 0, 0, 0, '02/05/2018'),
('11605700', 1, 0, 0, 0, '02/05/2018'),
('1160700', 1, 0, 0, 0, '02/05/2018'),
('11605377', 0, 1, 0, 0, '01/05/2018'),
('11605700', 0, 0, 1, 0, '01/05/2018'),
('1160700', 0, 1, 0, 0, '01/05/2018'),
('11605308', 0, 1, 0, 0, '11/05/2018'),
('11605377', 0, 0, 1, 0, '11/05/2018'),
('11605700', 0, 1, 0, 0, '11/05/2018');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_input`
--

CREATE TABLE `tb_input` (
  `nis` varchar(8) NOT NULL,
  `kelompok` varchar(1) NOT NULL,
  `kode_kinerja` varchar(8) NOT NULL,
  `skor` int(11) NOT NULL,
  `saksi` varchar(25) NOT NULL,
  `tgl` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_input`
--

INSERT INTO `tb_input` (`nis`, `kelompok`, `kode_kinerja`, `skor`, `saksi`, `tgl`) VALUES
('11605524', 'P', 'P1.1', 250, 'kesiswaan', '27/04/2018'),
('11605377', 'H', 'H5.1', 50, 'b.indo', '27/04/2018'),
('11605700', 'P', 'P4.1', 5, 'kesiswaan', '02/05/2018'),
('11605700', 'P', '', 0, '', ''),
('11605700', 'P', 'P4.1', 10, 'pramuka', '02/05/2018'),
('11605700', 'H', 'H5.1', 50, 'rpl', '02/05/2018'),
('11605700', 'H', 'H5.1', 50, 'tbg', '01/05/2018'),
('11605700', 'P', 'P1.1', 250, 'kesiswaan', '08/05/2018'),
('11605308', 'P', 'P4.1', 5, 'otkp', '28/05/2018'),
('11605700', 'P', 'P1.1', 250, 'kesiswaan', '11/05/2018'),
('11605377', 'P', 'P1.1', 250, 'kesiswaan', '11/05/2018'),
('11605308', 'P', 'P2.1', 750, 'rpl', '18/05/2018');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rayon`
--

CREATE TABLE `tb_rayon` (
  `id_rayon` varchar(11) NOT NULL,
  `rayon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_rayon`
--

INSERT INTO `tb_rayon` (`id_rayon`, `rayon`) VALUES
('RY001', 'Sukasari 2'),
('RY002', 'Sukasari 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_repush`
--

CREATE TABLE `tb_repush` (
  `kode_kinerja` varchar(8) NOT NULL,
  `nama_kinerja` varchar(250) NOT NULL,
  `kelompok` varchar(1) NOT NULL,
  `skor1` int(11) NOT NULL,
  `skor2` int(11) NOT NULL,
  `skor3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_repush`
--

INSERT INTO `tb_repush` (`kode_kinerja`, `nama_kinerja`, `kelompok`, `skor1`, `skor2`, `skor3`) VALUES
('H5.1', 'Aktif dalam kelas', 'H', 50, 50, 50),
('P1.1', 'Merokok', 'P', 250, 250, 250),
('P2.1', 'Mencuri', 'P', 750, 750, 750),
('P4.1', 'Terlambat hadir di sekolah / kelas', 'P', 5, 10, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rombel`
--

CREATE TABLE `tb_rombel` (
  `id_rombel` varchar(11) NOT NULL,
  `rombel` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_rombel`
--

INSERT INTO `tb_rombel` (`id_rombel`, `rombel`) VALUES
('RB001', 'RPL XI-3'),
('RB002', 'RPL XI-4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` varchar(8) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `rayon` varchar(20) NOT NULL,
  `rombel` varchar(20) NOT NULL,
  `tgl_lahir` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `nama`, `jk`, `rayon`, `rombel`, `tgl_lahir`, `alamat`) VALUES
('11605308', 'Adam Bahtiar Firdaus', 'L', 'Sukasari 2', 'RPL XI-3', '19/01/2002', 'Kp. Bohlam'),
('11605377', 'Annisa Triani', 'P', 'Sukasari 1', 'RPL XI-3', '20/07/2001', 'Bogor'),
('11605700', 'Natasha', 'P', 'Sukasari 2', 'RPL XI-3', '29/06/2001', 'Bogor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` varchar(5) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `username` varchar(14) NOT NULL,
  `password` varchar(35) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `user_role` enum('Kesiswaan','Pembimbing') NOT NULL,
  `rayon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `user_role`, `rayon`) VALUES
('AD001', 'reza', 'reza', 'cmV6YQ==', 'Kesiswaan', ''),
('AD002', 'rachmi', 'rachmi', 'cmFjaG1p', 'Pembimbing', 'Sukasari 2');

-- --------------------------------------------------------

--
-- Struktur untuk view `query_absen`
--
DROP TABLE IF EXISTS `query_absen`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query_absen`  AS  select `tb_siswa`.`nis` AS `nis`,`tb_siswa`.`nama` AS `nama`,`tb_siswa`.`jk` AS `jk`,`tb_siswa`.`rayon` AS `rayon`,`tb_siswa`.`rombel` AS `rombel`,`tb_absen`.`hadir` AS `hadir`,`tb_absen`.`sakit` AS `sakit`,`tb_absen`.`izin` AS `izin`,`tb_absen`.`alpa` AS `alpa`,`tb_absen`.`tgl_absen` AS `tgl_absen` from (`tb_siswa` join `tb_absen` on((`tb_siswa`.`nis` = `tb_absen`.`nis`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `query_bkp`
--
DROP TABLE IF EXISTS `query_bkp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query_bkp`  AS  select `tb_siswa`.`nis` AS `nis`,`tb_siswa`.`nama` AS `nama`,`tb_siswa`.`jk` AS `jk`,`tb_siswa`.`rayon` AS `rayon`,`tb_siswa`.`rombel` AS `rombel`,`tb_input`.`kode_kinerja` AS `kode_kinerja`,`tb_repush`.`nama_kinerja` AS `nama_kinerja`,`tb_repush`.`kelompok` AS `kelompok`,`tb_input`.`skor` AS `skor`,`tb_input`.`saksi` AS `saksi`,`tb_input`.`tgl` AS `tgl` from ((`tb_siswa` join `tb_input` on((`tb_siswa`.`nis` = `tb_input`.`nis`))) join `tb_repush` on((`tb_input`.`kode_kinerja` = `tb_repush`.`kode_kinerja`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rayon`
--
ALTER TABLE `tb_rayon`
  ADD PRIMARY KEY (`id_rayon`);

--
-- Indexes for table `tb_repush`
--
ALTER TABLE `tb_repush`
  ADD PRIMARY KEY (`kode_kinerja`);

--
-- Indexes for table `tb_rombel`
--
ALTER TABLE `tb_rombel`
  ADD PRIMARY KEY (`id_rombel`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
