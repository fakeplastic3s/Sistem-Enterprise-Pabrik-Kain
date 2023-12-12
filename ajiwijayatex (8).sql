-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2023 at 11:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ajiwijayatex`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tanggal_hadir` date NOT NULL,
  `status` enum('Hadir','Izin','Alpha','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_pegawai`, `tanggal_hadir`, `status`) VALUES
(63, 4, '2023-06-28', 'Izin'),
(64, 1, '2023-06-28', 'Hadir'),
(65, 5, '2023-06-28', 'Hadir'),
(66, 1, '2023-06-29', 'Hadir'),
(67, 4, '2023-06-29', 'Hadir'),
(68, 5, '2023-06-29', 'Izin'),
(69, 6, '2023-06-28', 'Izin'),
(70, 1, '2023-07-11', 'Hadir'),
(71, 5, '2023-07-11', 'Izin'),
(72, 5, '2023-07-12', 'Izin');

-- --------------------------------------------------------

--
-- Table structure for table `armada`
--

CREATE TABLE `armada` (
  `plat_nomor` varchar(10) NOT NULL,
  `jenis_kendaraan` varchar(50) NOT NULL,
  `umur_kendaraan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `armada`
--

INSERT INTO `armada` (`plat_nomor`, `jenis_kendaraan`, `umur_kendaraan`) VALUES
('G 23123 CK', 'bak terbuka', 2),
('G 23124 CK', 'Truck', 1);

-- --------------------------------------------------------

--
-- Table structure for table `aset_mesin`
--

CREATE TABLE `aset_mesin` (
  `id_mesin` int(11) NOT NULL,
  `nama_mesin` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `tgl_pengadaan` date NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aset_mesin`
--

INSERT INTO `aset_mesin` (`id_mesin`, `nama_mesin`, `merk`, `tgl_pengadaan`, `jumlah`) VALUES
(1, 'Mesin Sizing', 'Sizing', '2023-04-02', 20),
(3, 'Mesin Leasing', 'Leasing', '2023-07-10', 20),
(4, 'Mesin Beaming', 'Beaming', '2023-05-11', 20),
(5, 'Mesin Weaving', 'Weaving', '2023-07-10', 5);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_masuk`
--

CREATE TABLE `bahan_masuk` (
  `id_bahan_masuk` int(11) NOT NULL,
  `id_bahan_mentah` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan_masuk`
--

INSERT INTO `bahan_masuk` (`id_bahan_masuk`, `id_bahan_mentah`, `id_supplier`, `tanggal_masuk`, `jumlah`) VALUES
(1, 3, 33, '2023-06-14', 3),
(100, 3, 34, '2023-03-02', 12),
(108, 3, 33, '2023-04-05', 12),
(109, 3, 34, '2023-04-13', 8),
(110, 3, 33, '2023-06-29', 200),
(111, 7, 34, '2023-07-10', 2),
(113, 8, 35, '2023-07-11', 2),
(114, 8, 35, '2023-07-10', 20),
(115, 7, 34, '2023-07-11', 2);

--
-- Triggers `bahan_masuk`
--
DELIMITER $$
CREATE TRIGGER `BM_Delete` AFTER DELETE ON `bahan_masuk` FOR EACH ROW UPDATE bahan_mentah SET bahan_mentah.jumlah_stok = bahan_mentah.jumlah_stok - OLD.jumlah
WHERE bahan_mentah.id_bahan_mentah = OLD.id_bahan_mentah
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BM_Insert` AFTER INSERT ON `bahan_masuk` FOR EACH ROW UPDATE bahan_mentah SET bahan_mentah.jumlah_stok = bahan_mentah.jumlah_stok + NEW.jumlah
WHERE bahan_mentah.id_bahan_mentah = NEW.id_bahan_mentah
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BM_Update` AFTER UPDATE ON `bahan_masuk` FOR EACH ROW UPDATE bahan_mentah SET bahan_mentah.jumlah_stok = bahan_mentah.jumlah_stok + (NEW.jumlah - OLD.jumlah)
WHERE bahan_mentah.id_bahan_mentah = NEW.id_bahan_mentah
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bahan_mentah`
--

CREATE TABLE `bahan_mentah` (
  `id_bahan_mentah` int(11) NOT NULL,
  `nama_bahan_mentah` varchar(20) NOT NULL,
  `jumlah_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan_mentah`
--

INSERT INTO `bahan_mentah` (`id_bahan_mentah`, `nama_bahan_mentah`, `jumlah_stok`) VALUES
(3, 'Serat Rayon', 10),
(7, 'Serat Katun', 6),
(8, 'Poliester', 2),
(9, 'Serat Rami', 6),
(10, 'Serat Wool', 7),
(12, 'Serat Sutra', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_terpakai`
--

CREATE TABLE `bahan_terpakai` (
  `id_bahan_terpakai` int(11) NOT NULL,
  `id_bahan_mentah` int(11) NOT NULL,
  `tanggal_pakai` date NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan_terpakai`
--

INSERT INTO `bahan_terpakai` (`id_bahan_terpakai`, `id_bahan_mentah`, `tanggal_pakai`, `jumlah`) VALUES
(1, 3, '2023-04-22', 15),
(4, 7, '2023-04-12', 12),
(5, 3, '2023-04-12', 8),
(6, 3, '2023-04-14', 2),
(8, 12, '2023-06-14', 9),
(11, 8, '2023-07-11', 20),
(12, 10, '2023-07-11', 1),
(13, 3, '2023-07-19', 199),
(15, 3, '2023-07-11', 2);

--
-- Triggers `bahan_terpakai`
--
DELIMITER $$
CREATE TRIGGER `BT_Delete` AFTER DELETE ON `bahan_terpakai` FOR EACH ROW UPDATE bahan_mentah SET bahan_mentah.jumlah_stok = bahan_mentah.jumlah_stok + OLD.jumlah
WHERE bahan_mentah.id_bahan_mentah = OLD.id_bahan_mentah
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BT_Insert` AFTER INSERT ON `bahan_terpakai` FOR EACH ROW UPDATE bahan_mentah SET bahan_mentah.jumlah_stok = bahan_mentah.jumlah_stok - NEW.jumlah
WHERE bahan_mentah.id_bahan_mentah = NEW.id_bahan_mentah
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BT_Update` BEFORE UPDATE ON `bahan_terpakai` FOR EACH ROW UPDATE bahan_mentah SET bahan_mentah.jumlah_stok = bahan_mentah.jumlah_stok - (NEW.jumlah - OLD.jumlah)
WHERE bahan_mentah.id_bahan_mentah = NEW.id_bahan_mentah
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `data_pemesanan`
--

CREATE TABLE `data_pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_produksi`
--

CREATE TABLE `hasil_produksi` (
  `id_hasil_produksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal_produksi` date NOT NULL,
  `jumlah_hasil_produksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_produksi`
--

INSERT INTO `hasil_produksi` (`id_hasil_produksi`, `id_barang`, `tanggal_produksi`, `jumlah_hasil_produksi`) VALUES
(3, 1, '2023-04-05', 123),
(4, 1, '2023-04-04', 8),
(5, 11, '2023-06-15', 10),
(8, 1, '2023-07-11', 10);

--
-- Triggers `hasil_produksi`
--
DELIMITER $$
CREATE TRIGGER `HP_Delete` AFTER DELETE ON `hasil_produksi` FOR EACH ROW UPDATE stok_barang_jadi SET stok_barang_jadi.jumlah = stok_barang_jadi.jumlah - OLD.jumlah_hasil_produksi
WHERE stok_barang_jadi.id_barang = OLD.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `HP_Insert` AFTER INSERT ON `hasil_produksi` FOR EACH ROW UPDATE stok_barang_jadi SET stok_barang_jadi.jumlah = stok_barang_jadi.jumlah + NEW.jumlah_hasil_produksi
WHERE stok_barang_jadi.id_barang = NEW.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `HP_Update` BEFORE UPDATE ON `hasil_produksi` FOR EACH ROW UPDATE stok_barang_jadi SET stok_barang_jadi.jumlah = stok_barang_jadi.jumlah + (NEW.jumlah_hasil_produksi - OLD.jumlah_hasil_produksi)
WHERE stok_barang_jadi.id_barang = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pengiriman`
--

CREATE TABLE `jadwal_pengiriman` (
  `id_pengirim` int(11) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `tanggal_pengiriman` date NOT NULL,
  `alamat_tujuan` varchar(200) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `plat_nomor` varchar(10) NOT NULL,
  `jumlah_pengiriman` int(11) NOT NULL,
  `status` enum('Diproses','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_pengiriman`
--

INSERT INTO `jadwal_pengiriman` (`id_pengirim`, `nama_pengirim`, `tanggal_pengiriman`, `alamat_tujuan`, `id_barang`, `plat_nomor`, `jumlah_pengiriman`, `status`) VALUES
(7, 'sadas', '2023-06-01', 'asd', 1, 'G 23123 CK', 1, 'Diproses'),
(11, 'Hasan', '2023-06-01', 'fdsjfcdgh', 1, 'G 23123 CK', 42, 'Diproses');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_perawatan`
--

CREATE TABLE `jadwal_perawatan` (
  `id_perawatan` int(11) NOT NULL,
  `id_mesin` int(11) NOT NULL,
  `tanggal_perawatan` date NOT NULL,
  `status` enum('Diproses','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_perawatan`
--

INSERT INTO `jadwal_perawatan` (`id_perawatan`, `id_mesin`, `tanggal_perawatan`, `status`) VALUES
(2, 1, '2023-04-11', 'Selesai'),
(3, 3, '2023-05-02', 'Selesai'),
(5, 5, '2023-07-10', 'Diproses');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_produksi`
--

CREATE TABLE `jadwal_produksi` (
  `id_produksi` int(11) NOT NULL,
  `id_kebutuhan_produksi` int(11) NOT NULL,
  `tanggal_produksi` date NOT NULL,
  `jam_produksi` enum('07.00-15.00','15.00-23.00','23.00-07.00') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_produksi`
--

INSERT INTO `jadwal_produksi` (`id_produksi`, `id_kebutuhan_produksi`, `tanggal_produksi`, `jam_produksi`) VALUES
(12, 1, '2023-05-24', '07.00-15.00'),
(13, 3, '2023-05-25', '15.00-23.00');

-- --------------------------------------------------------

--
-- Table structure for table `kebutuhan_perawatan`
--

CREATE TABLE `kebutuhan_perawatan` (
  `id_kebutuhan_perawatan` int(11) NOT NULL,
  `id_mesin` varchar(255) NOT NULL,
  `kebutuhan_perawatan` varchar(255) NOT NULL,
  `status` enum('Ditolak','Diajukan','Disetujui') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kebutuhan_perawatan`
--

INSERT INTO `kebutuhan_perawatan` (`id_kebutuhan_perawatan`, `id_mesin`, `kebutuhan_perawatan`, `status`) VALUES
(13, '1', 'Perawatan Rutin Mesin Sizing', 'Ditolak'),
(16, '4', 'Perawatan Rutin', 'Disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `kebutuhan_produksi`
--

CREATE TABLE `kebutuhan_produksi` (
  `id_kebutuhan_produksi` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `bahan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kebutuhan_produksi`
--

INSERT INTO `kebutuhan_produksi` (`id_kebutuhan_produksi`, `nama_barang`, `bahan`) VALUES
(1, 'Kain Wool', 'Serat Wool'),
(2, 'Kain Linen', 'Serat Rami'),
(3, 'Kain Semi-Wool', 'Serat Wool, Polyester');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `gaji_pokok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `alamat`, `jabatan`, `gaji_pokok`) VALUES
(1, 'Luluk', 'Panjang wetan gang blanak', 'Teknisi', 2000000),
(4, 'Hafid', 'Jalan Soekarno-Hatta', 'Teknisi', 2000000),
(5, 'Herman', 'Jalan Pattimura no 02 Pekalongan', 'Teknisi Operasional', 2500000),
(6, 'Jancuk', 'asdas', 'asgfhfsdfafd', 2000000);

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_bahan`
--

CREATE TABLE `pengadaan_bahan` (
  `id_pengadaan` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tanggal_pengadaan` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('Disetujui','Diajukan','Ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengadaan_bahan`
--

INSERT INTO `pengadaan_bahan` (`id_pengadaan`, `id_supplier`, `tanggal_pengadaan`, `jumlah`, `status`) VALUES
(1, 33, '2023-04-01', 12, 'Disetujui'),
(3, 34, '2023-04-13', 20, 'Disetujui'),
(9, 37, '2023-04-01', 15, 'Ditolak'),
(10, 34, '2023-04-27', 8, 'Disetujui'),
(11, 34, '2023-04-27', 8, 'Ditolak'),
(12, 33, '2023-05-25', 12, 'Disetujui'),
(13, 37, '2023-05-24', 12, 'Diajukan'),
(14, 33, '2023-06-29', 20, 'Disetujui'),
(15, 36, '2023-07-10', 20, 'Diajukan'),
(16, 35, '2023-07-11', 20, 'Diajukan');

-- --------------------------------------------------------

--
-- Table structure for table `penggajian`
--

CREATE TABLE `penggajian` (
  `id_penggajian` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tgl_penggajian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penggajian`
--

INSERT INTO `penggajian` (`id_penggajian`, `id_pegawai`, `tgl_penggajian`) VALUES
(2, 4, '2023-06-01'),
(3, 1, '2023-06-02'),
(5, 5, '2023-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `jumlah_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_barang`, `id_sales`, `tanggal_penjualan`, `jumlah_penjualan`) VALUES
(4, 1, 1, '2023-06-19', 100),
(5, 1, 2, '2023-06-28', 20),
(8, 4, 4, '2023-07-11', 10);

--
-- Triggers `penjualan`
--
DELIMITER $$
CREATE TRIGGER `P_Delete` AFTER DELETE ON `penjualan` FOR EACH ROW UPDATE stok_barang_jadi SET stok_barang_jadi.jumlah = stok_barang_jadi.jumlah + OLD.jumlah_penjualan
WHERE stok_barang_jadi.id_barang = OLD.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `P_Insert` AFTER INSERT ON `penjualan` FOR EACH ROW UPDATE stok_barang_jadi SET stok_barang_jadi.jumlah=stok_barang_jadi.jumlah-NEW.jumlah_penjualan
WHERE stok_barang_jadi.id_barang = NEW.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `P_Update` BEFORE UPDATE ON `penjualan` FOR EACH ROW UPDATE stok_barang_jadi SET stok_barang_jadi.jumlah = stok_barang_jadi.jumlah - (NEW.jumlah_penjualan - OLD.jumlah_penjualan)
WHERE stok_barang_jadi.id_barang = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `presensi_admin`
--

CREATE TABLE `presensi_admin` (
  `id_presensi_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `status` enum('Hadir') NOT NULL,
  `tanggal_presensi` date NOT NULL,
  `waktu_presensi` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presensi_admin`
--

INSERT INTO `presensi_admin` (`id_presensi_admin`, `username`, `user_email`, `status`, `tanggal_presensi`, `waktu_presensi`) VALUES
(93, 'Admin Supplier', 'adminsupplier@wijayatex.com', 'Hadir', '2023-07-11', '12:29:41'),
(94, 'Admin Gudang', 'admingudang@wijayatex.com', 'Hadir', '2023-07-11', '12:31:58'),
(95, 'Admin Keuangan', 'adminkeuangan@wijayatex.com', 'Hadir', '2023-07-11', '12:35:19'),
(96, 'Admin Produksi', 'adminproduksi@wijayatex.com', 'Hadir', '2023-07-11', '12:36:15'),
(97, 'Admin Mesin', 'adminmesin@wijayatex.com', 'Hadir', '2023-07-11', '12:38:19'),
(98, 'Admin Pengiriman', 'adminpengiriman@wijayatex.com', 'Hadir', '2023-07-11', '12:41:23'),
(99, 'Admin Personalia', 'adminpersonalia@wijayatex.com', 'Hadir', '2023-07-11', '12:42:53'),
(100, 'Admin Pemasaran', 'adminpemasaran@wijayatex.com', 'Hadir', '2023-07-11', '12:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `sales_marketing`
--

CREATE TABLE `sales_marketing` (
  `id_sales` int(11) NOT NULL,
  `nama_sales` varchar(50) NOT NULL,
  `alamat_sales` varchar(200) NOT NULL,
  `umur_sales` int(11) NOT NULL,
  `daerah_operasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_marketing`
--

INSERT INTO `sales_marketing` (`id_sales`, `nama_sales`, `alamat_sales`, `umur_sales`, `daerah_operasi`) VALUES
(1, 'Hasan', 'Panjang Wetan Gang 1', 20, 'Pekalongan Timur'),
(2, 'Imron', 'Panjang Wetan gg.5', 24, 'Pekalongan Utara'),
(3, 'Harjo', 'Jl. Gajah Mada Bar. No.11A, Kramatsari', 25, 'Pekalongan Barat'),
(4, 'Bejo', 'Jalan Pattimura no 25 Pekalongan', 20, 'Pekalongan Timur');

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang_jadi`
--

CREATE TABLE `stok_barang_jadi` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_barang_jadi`
--

INSERT INTO `stok_barang_jadi` (`id_barang`, `nama_barang`, `jumlah`, `harga`, `gambar`) VALUES
(1, 'Kain Wool', 12, 55000, '1688462357_74e3c163fa042b017779.jpg'),
(4, 'Kain Linen', 10, 50000, '1688462484_608d1abedb9dc3983b2d.jpg'),
(5, 'Kain Cotton Combed', 8, 30000, '1688471065_5c11537749023b7fe7f1.png'),
(6, 'Jeans', 10, 80000, '1688462394_e64beeb4f30f7c84cbb9.jpg'),
(7, 'Kain Puring', 8, 20000, '1688471099_db670ff2eebb31012157.png'),
(8, 'Kain Rayon Twill', 8, 65000, '1688471114_174a1b43eabb5eced0cf.png'),
(9, 'Kain Uragiri', 6, 25000, '1688471123_a671ad733f744c30c7c3.png'),
(10, 'Kain Semi-Wool', 8, 30000, '1688471186_b8aa726b2ad4da0b0829.png'),
(11, 'Kain Grey', 18, 25000, '1688462470_33bf16fcf0376deccc6e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(10) NOT NULL,
  `nama_supplier` varchar(25) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `harga_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `nama_barang`, `harga_satuan`) VALUES
(33, 'Suka Maju', 'Jl. Gajah Mada Bar. No.11A, Kramatsari, Kec. Pekal', 'Serat Rayon', 5000),
(34, 'Jaya Makmur', 'Jalan Bahagia No.15', 'Serat Katun', 5000),
(35, 'Polyester Jaya Sentosa', 'Jalan Pattimura no 02 Pekalongan', 'Polyester', 4000),
(36, 'Bakti Abadi', 'Jalan Belimbing No.8', 'Serat Rami', 6000),
(37, 'Budi Jaya Abadi', 'Jalan Ahmad Yamin No.6', 'Serat Wool', 5000),
(40, 'PT Sutra Emas', 'Jalan Kebangsaan raya no.25', 'Serat Sutra', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_create_at`) VALUES
(9, 'Admin Gudang', 'admingudang@wijayatex.com', '$2y$10$XJ1Z5kCYkhTk51.0tlpCRu/62QjEwfmZawIRTgzcQ/5bm4ttUcETu', '2023-03-20 18:08:45'),
(10, 'Admin Supplier', 'adminsupplier@wijayatex.com', '$2y$10$Vfg3iiVhQnK.jzKNURQiS.uzx3WgJ/WBWcS3TgvbsOatwT63NOuay', '2023-03-20 18:16:21'),
(11, 'Admin', 'admin@wijayatex.com', '$2y$10$dQ6spDr3FZzP7Nl0nha/xOwnDrwOrr8frmgfnxadA2ci0B7bSbfEG', '2023-03-20 18:43:47'),
(12, 'Admin Produksi', 'adminproduksi@wijayatex.com', '$2y$10$Wxjo8vUjP/JJQmslgiWl.OUyBT2ArbtbbWzeXQFGOs15lOlVKe7Rq', '2023-03-20 19:36:23'),
(13, 'Admin Pengiriman', 'adminpengiriman@wijayatex.com', '$2y$10$S95UltyP0zAQrXKnYrJX3OwWscP9s1jloxzcU7UOEcLjzGvUqO69e', '2023-03-25 05:53:35'),
(15, 'Admin Pemasaran', 'adminpemasaran@wijayatex.com', '$2y$10$NleNh5aPHNv7brfScbGfo.tq2Tj5xcP/h.cl.pJGgjEu2tLxHCqpW', '2023-03-25 19:15:11'),
(16, 'Admin Mesin', 'adminmesin@wijayatex.com', '$2y$10$0w2imnZqt1I13bD8hVUMVO6JPgnPXF8oWjX1HhCG15d.hbxKYAxV6', '2023-04-04 02:31:41'),
(17, 'Admin Personalia', 'adminpersonalia@wijayatex.com', '$2y$10$8BnmnS15Wkuji232w3QOLujZB4nf/TfIQfXxUvQNIs13Op5vEYKde', '2023-04-04 03:20:47'),
(18, 'Admin Customer Support', 'admincs@wijayatex.com', '$2y$10$3ouQUygLZS6CWzq/bdO2duxAZLw4wkPMjogtmsSEkZA4YUOSAuDva', '2023-04-11 02:35:44'),
(19, 'Admin Keuangan', 'adminkeuangan@wijayatex.com', '$2y$10$DvqGmj01fYqYAjRtYJdLKuU3Ob930we5FwgF9ZIec2T4HwSpkf4H2', '2023-05-02 03:21:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `armada`
--
ALTER TABLE `armada`
  ADD PRIMARY KEY (`plat_nomor`);

--
-- Indexes for table `aset_mesin`
--
ALTER TABLE `aset_mesin`
  ADD PRIMARY KEY (`id_mesin`);

--
-- Indexes for table `bahan_masuk`
--
ALTER TABLE `bahan_masuk`
  ADD PRIMARY KEY (`id_bahan_masuk`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_bahan_mentah` (`id_bahan_mentah`);

--
-- Indexes for table `bahan_mentah`
--
ALTER TABLE `bahan_mentah`
  ADD PRIMARY KEY (`id_bahan_mentah`);

--
-- Indexes for table `bahan_terpakai`
--
ALTER TABLE `bahan_terpakai`
  ADD PRIMARY KEY (`id_bahan_terpakai`),
  ADD KEY `id_bahan_mentah` (`id_bahan_mentah`);

--
-- Indexes for table `data_pemesanan`
--
ALTER TABLE `data_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `hasil_produksi`
--
ALTER TABLE `hasil_produksi`
  ADD PRIMARY KEY (`id_hasil_produksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `jadwal_pengiriman`
--
ALTER TABLE `jadwal_pengiriman`
  ADD PRIMARY KEY (`id_pengirim`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `plat_nomor` (`plat_nomor`);

--
-- Indexes for table `jadwal_perawatan`
--
ALTER TABLE `jadwal_perawatan`
  ADD PRIMARY KEY (`id_perawatan`),
  ADD KEY `id_mesin` (`id_mesin`);

--
-- Indexes for table `jadwal_produksi`
--
ALTER TABLE `jadwal_produksi`
  ADD PRIMARY KEY (`id_produksi`),
  ADD KEY `id_barang` (`id_kebutuhan_produksi`),
  ADD KEY `id_kebutuhan_produksi` (`id_kebutuhan_produksi`);

--
-- Indexes for table `kebutuhan_perawatan`
--
ALTER TABLE `kebutuhan_perawatan`
  ADD PRIMARY KEY (`id_kebutuhan_perawatan`),
  ADD KEY `id_mesin` (`id_mesin`);

--
-- Indexes for table `kebutuhan_produksi`
--
ALTER TABLE `kebutuhan_produksi`
  ADD PRIMARY KEY (`id_kebutuhan_produksi`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pengadaan_bahan`
--
ALTER TABLE `pengadaan_bahan`
  ADD PRIMARY KEY (`id_pengadaan`),
  ADD KEY `id_daftar_pengadaan` (`id_supplier`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD PRIMARY KEY (`id_penggajian`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indexes for table `presensi_admin`
--
ALTER TABLE `presensi_admin`
  ADD PRIMARY KEY (`id_presensi_admin`);

--
-- Indexes for table `sales_marketing`
--
ALTER TABLE `sales_marketing`
  ADD PRIMARY KEY (`id_sales`);

--
-- Indexes for table `stok_barang_jadi`
--
ALTER TABLE `stok_barang_jadi`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `aset_mesin`
--
ALTER TABLE `aset_mesin`
  MODIFY `id_mesin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bahan_masuk`
--
ALTER TABLE `bahan_masuk`
  MODIFY `id_bahan_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `bahan_mentah`
--
ALTER TABLE `bahan_mentah`
  MODIFY `id_bahan_mentah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bahan_terpakai`
--
ALTER TABLE `bahan_terpakai`
  MODIFY `id_bahan_terpakai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `data_pemesanan`
--
ALTER TABLE `data_pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_produksi`
--
ALTER TABLE `hasil_produksi`
  MODIFY `id_hasil_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jadwal_pengiriman`
--
ALTER TABLE `jadwal_pengiriman`
  MODIFY `id_pengirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jadwal_perawatan`
--
ALTER TABLE `jadwal_perawatan`
  MODIFY `id_perawatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal_produksi`
--
ALTER TABLE `jadwal_produksi`
  MODIFY `id_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kebutuhan_perawatan`
--
ALTER TABLE `kebutuhan_perawatan`
  MODIFY `id_kebutuhan_perawatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kebutuhan_produksi`
--
ALTER TABLE `kebutuhan_produksi`
  MODIFY `id_kebutuhan_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengadaan_bahan`
--
ALTER TABLE `pengadaan_bahan`
  MODIFY `id_pengadaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `penggajian`
--
ALTER TABLE `penggajian`
  MODIFY `id_penggajian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `presensi_admin`
--
ALTER TABLE `presensi_admin`
  MODIFY `id_presensi_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `sales_marketing`
--
ALTER TABLE `sales_marketing`
  MODIFY `id_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stok_barang_jadi`
--
ALTER TABLE `stok_barang_jadi`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `bahan_masuk`
--
ALTER TABLE `bahan_masuk`
  ADD CONSTRAINT `bahan_masuk_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `bahan_masuk_ibfk_2` FOREIGN KEY (`id_bahan_mentah`) REFERENCES `bahan_mentah` (`id_bahan_mentah`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `bahan_terpakai`
--
ALTER TABLE `bahan_terpakai`
  ADD CONSTRAINT `bahan_terpakai_ibfk_1` FOREIGN KEY (`id_bahan_mentah`) REFERENCES `bahan_mentah` (`id_bahan_mentah`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `hasil_produksi`
--
ALTER TABLE `hasil_produksi`
  ADD CONSTRAINT `hasil_produksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `stok_barang_jadi` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_pengiriman`
--
ALTER TABLE `jadwal_pengiriman`
  ADD CONSTRAINT `jadwal_pengiriman_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `stok_barang_jadi` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_pengiriman_ibfk_2` FOREIGN KEY (`plat_nomor`) REFERENCES `armada` (`plat_nomor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_perawatan`
--
ALTER TABLE `jadwal_perawatan`
  ADD CONSTRAINT `jadwal_perawatan_ibfk_1` FOREIGN KEY (`id_mesin`) REFERENCES `aset_mesin` (`id_mesin`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_produksi`
--
ALTER TABLE `jadwal_produksi`
  ADD CONSTRAINT `jadwal_produksi_ibfk_1` FOREIGN KEY (`id_kebutuhan_produksi`) REFERENCES `kebutuhan_produksi` (`id_kebutuhan_produksi`) ON UPDATE CASCADE;

--
-- Constraints for table `pengadaan_bahan`
--
ALTER TABLE `pengadaan_bahan`
  ADD CONSTRAINT `pengadaan_bahan_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD CONSTRAINT `penggajian_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `stok_barang_jadi` (`id_barang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_sales`) REFERENCES `sales_marketing` (`id_sales`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
