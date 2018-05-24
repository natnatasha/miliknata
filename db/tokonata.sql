-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22 Feb 2018 pada 09.58
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
-- Database: `tokonata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(5) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `jumlah`, `harga`) VALUES
('KB001', 'flashdisk', 91, '100000'),
('KB002', 'keyboard', 47, '250000'),
('KB003', 'laptop', 100, '7000000'),
('KB004', 'speaker', 40, '100000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `username` varchar(20) NOT NULL,
  `password` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('', ''),
('dean', 'deanmalik'),
('kiki', 'pudgetai'),
('nata', 'huahua');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE `pembeli` (
  `kode_pembeli` varchar(5) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`kode_pembeli`, `nama`, `no_hp`, `alamat`) VALUES
('KP001', 'nata', '083811612369', 'ciheleut bogor'),
('KP002', 'icot', '082165548991', 'Kolong Jembatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `kode_penjualan` varchar(5) NOT NULL,
  `kode_transaksi` varchar(5) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`kode_penjualan`, `kode_transaksi`, `nama_barang`, `jumlah`, `harga`) VALUES
('KJ001', 'KT001', 'flashdisk', 1, '100000'),
('KJ001', 'KT002', 'keyboard', 1, '250000'),
('KJ001', 'KT003', 'laptop', 1, '7000000'),
('KJ002', 'KT004', 'laptop', 2, '14000000'),
('KJ002', 'KT005', 'flashdisk', 1, '100000'),
('KJ003', 'KT006', 'flashdisk', 5, '500000'),
('KJ003', 'KT007', 'keyboard', 2, '500000'),
('KJ004', 'KT008', 'flashdisk', 2, '200000'),
('KJ004', 'KT009', 'laptop', 6, '42000000');

--
-- Trigger `penjualan`
--
DELIMITER $$
CREATE TRIGGER `bataljual` AFTER DELETE ON `penjualan` FOR EACH ROW BEGIN
UPDATE barang
SET jumlah = jumlah + OLD.jumlah
WHERE
nama_barang = OLD.nama_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `jualbarang` AFTER INSERT ON `penjualan` FOR EACH ROW BEGIN
UPDATE barang
SET jumlah = jumlah - NEW.jumlah
WHERE
nama_barang = NEW.nama_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan2`
--

CREATE TABLE `penjualan2` (
  `kode_penjualan` varchar(5) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `bayar` varchar(15) NOT NULL,
  `kembalian` varchar(15) NOT NULL,
  `tanggal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan2`
--

INSERT INTO `penjualan2` (`kode_penjualan`, `nama`, `total`, `bayar`, `kembalian`, `tanggal`) VALUES
('KJ001', 'nata', '7350000', '7400000', '50000', '17/02/2018'),
('KJ002', 'icot', '14100000', '14100000', '0', '17/02/2018'),
('KJ003', 'jm', '1000000', '1000000', '0', '19/02/2018'),
('KJ004', 'mila', '42200000', '42300000', '100000', '19/02/2018');

-- --------------------------------------------------------

--
-- Stand-in structure for view `struk`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `struk` (
`kode_penjualan` varchar(5)
,`nama` varchar(20)
,`kode_transaksi` varchar(5)
,`nama_barang` varchar(20)
,`jumlah` int(11)
,`harga` varchar(20)
,`total` varchar(20)
,`bayar` varchar(15)
,`kembalian` varchar(15)
,`tanggal` varchar(10)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `struk`
--
DROP TABLE IF EXISTS `struk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `struk`  AS  select `penjualan2`.`kode_penjualan` AS `kode_penjualan`,`penjualan2`.`nama` AS `nama`,`penjualan`.`kode_transaksi` AS `kode_transaksi`,`penjualan`.`nama_barang` AS `nama_barang`,`penjualan`.`jumlah` AS `jumlah`,`penjualan`.`harga` AS `harga`,`penjualan2`.`total` AS `total`,`penjualan2`.`bayar` AS `bayar`,`penjualan2`.`kembalian` AS `kembalian`,`penjualan2`.`tanggal` AS `tanggal` from (`penjualan2` join `penjualan` on((`penjualan2`.`kode_penjualan` = `penjualan`.`kode_penjualan`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`kode_pembeli`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- Indexes for table `penjualan2`
--
ALTER TABLE `penjualan2`
  ADD PRIMARY KEY (`kode_penjualan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
