-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Mar 2022 pada 14.57
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yazficoi_yazfi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cat_chart_of_account`
--

CREATE TABLE `cat_chart_of_account` (
  `id_cat` int(11) NOT NULL,
  `kode_parent` varchar(10) NOT NULL,
  `nama_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cat_chart_of_account`
--

INSERT INTO `cat_chart_of_account` (`id_cat`, `kode_parent`, `nama_cat`) VALUES
(1, '1', 'Fixed Asset'),
(2, '1', 'Accumulated Depreciation'),
(3, '1', 'Other Asset'),
(4, '2', 'Account Payable'),
(5, '2', 'Other Current Liability'),
(6, '2', 'Long term liability'),
(7, '3', 'Equity'),
(8, '4', 'Revenue'),
(9, '4', 'Cash & bank'),
(10, '4', 'Account Receivable'),
(11, '4', 'Inventory'),
(12, '4', 'Other current asset'),
(13, '4', 'Cost of goods Sold'),
(14, '5', 'Expense'),
(15, '5', 'Other expense'),
(16, '5', 'Other Income');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chart_of_account`
--

CREATE TABLE `chart_of_account` (
  `id_chart_of_account` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_cat` int(11) NOT NULL,
  `status_tanggal` date NOT NULL,
  `child_numb` int(11) NOT NULL,
  `currency` int(2) NOT NULL,
  `opening_balance` int(11) NOT NULL,
  `utama` int(1) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `nama_bank` varchar(20) NOT NULL,
  `atas_nama` varchar(25) NOT NULL,
  `cabang` varchar(60) NOT NULL,
  `notes` text NOT NULL,
  `balance` text NOT NULL,
  `tanggalbalance` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `chart_of_account`
--

INSERT INTO `chart_of_account` (`id_chart_of_account`, `kode`, `deskripsi`, `id_cat`, `status_tanggal`, `child_numb`, `currency`, `opening_balance`, `utama`, `no_rekening`, `nama_bank`, `atas_nama`, `cabang`, `notes`, `balance`, `tanggalbalance`, `status`) VALUES
(8, '12010', 'MANDIRI', 9, '0000-00-00', 0, 0, 0, 0, '1150002030171', 'Mandiri', 'INTI SEMESTA SE', 'kcp mangga dua', '', '-8260119354.3', '0000-00-00', 1),
(10, '11010', 'Cash', 9, '0000-00-00', 16, 0, 0, 0, '00000', 'Cash', '', '', '', '-1595087.62', '0000-00-00', 1),
(11, '12012', 'Credit Card Mandiri', 9, '0000-00-00', 8, 0, 0, 0, '0', 'Credit Card BCA', '', '', '', '-30000000', '0000-00-00', 1),
(14, '12011', 'Debit Card Mandiri', 9, '0000-00-00', 8, 0, 0, 0, '0', 'Debit Card BCA', '', '', '', '-34641200', '0000-00-00', 1),
(15, '11020', 'Kas besar', 9, '0000-00-00', 16, 0, 0, 0, '0', 'Kas Besar', '', '', '', '1583556909.3', '0000-00-00', 1),
(16, '11000', 'Kas rupiah', 9, '0000-00-00', 16, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(17, '12000', 'Bank', 9, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(18, '13000', 'Piutang dagang', 10, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '6965879562', '0000-00-00', 1),
(19, '13200', 'Piutang karyawan', 12, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(20, '16000', 'Biaya dibayar dimuka', 12, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(21, '17000', 'Aktiva tetap', 1, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(22, '17100', 'Akumulasi penyusutan', 2, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(23, '20000', 'Hutang dagang', 4, '0000-00-00', 0, 0, 1000000, 1, '', '', '', '', '', '-2447294422.0892', '0000-00-00', 1),
(24, '40000', 'Pendapatan', 8, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(25, '61000', 'Beban Penyusutan', 14, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(26, '62000', 'Biaya Umum & Administrasi	', 14, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(27, '63000', 'Biaya kirim ', 14, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(28, '65000', 'Komisi Penjualan', 14, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '1880609349.62', '0000-00-00', 1),
(29, '71000', 'Pendapatan lain lain', 16, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(30, '72000', 'Biaya lain lain	', 15, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(33, '15000', 'Uang Muka Pembelian', 10, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(34, '21000', 'Uang Muka Penjualan', 4, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(37, '13001', 'Piutang dagang', 10, '0000-00-00', 18, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(39, '13003', 'Piutang Joko', 10, '0000-00-00', 18, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(42, '12030', 'Bank BCA', 9, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 0),
(60, '14000', 'Persediaan Barang', 11, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '-2383796807.0908', '0000-00-00', 1),
(62, '16001', 'Sewa Dibayar Di Muka', 12, '0000-00-00', 20, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(63, '13300', 'Piutang Lain Lain', 12, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '36000000', '0000-00-00', 1),
(64, '17001', 'Tanah', 1, '0000-00-00', 21, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(65, '17002', 'Bangunan', 1, '0000-00-00', 21, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(66, '17003', 'Peralatan Kantor', 1, '0000-00-00', 21, 0, 0, 0, '', '', '', '', '', '15989000', '0000-00-00', 1),
(67, '17004', 'Peralatan Toko', 1, '0000-00-00', 21, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(68, '17005', 'Kendaraan', 1, '0000-00-00', 21, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(69, '17006', 'Mesin & Peralatan Kerja', 1, '0000-00-00', 21, 0, 0, 0, '', '', '', '', '', '20000000', '0000-00-00', 1),
(70, '17101', 'Akumulasi Penyusutan Tanah', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(71, '17102', 'Akumulasi Penyusutan Bangunan', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(72, '17103', 'Akumulasi Penyusutan Peralatan Kantor', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(73, '17104', 'Akumulasi Penyusutan Peralatan Toko', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(74, '17105', 'Akumulasi Penyusutan Kendaraan', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(75, '17106', 'Akumulasi Penyusutan Mesin & Peralatan Kerja', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(76, '20001', 'Hutang dagang', 4, '0000-00-00', 23, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(77, '20002', 'Hutang Ci Ani', 4, '0000-00-00', 23, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(102, '23000', 'Hutang Lain Lain', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '-50000000', '0000-00-00', 1),
(103, '30000', 'Modal', 7, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(104, '31000', 'Deviden', 7, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(105, '32000', 'Laba Ditahan', 7, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '5670349790', '0000-00-00', 1),
(106, '40001', 'Penjualan Barang', 8, '0000-00-00', 24, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(107, '40002', 'Penjualan Jasa', 8, '0000-00-00', 24, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(109, '42000', 'Potongan Penjualan', 8, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '2', '0000-00-00', 1),
(110, '41000', 'Retur Penjualan', 8, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(111, '51000', 'Harga Pokok Penjualan', 13, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '3975452', '0000-00-00', 1),
(112, '52000', 'Biaya Angkut Pembelian', 13, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '313803097', '0000-00-00', 1),
(113, '53000', 'Potongan Pembelian', 13, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(114, '61001', 'Beban Penyusutan Tanah', 14, '0000-00-00', 25, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(115, '61002', 'Beban Penyusutan Bangunan', 14, '0000-00-00', 25, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(116, '61003', 'Beban Penyusutan Peralatan Kantor', 14, '0000-00-00', 25, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(117, '61005', 'Beban Penyusutan Kendaraan', 14, '0000-00-00', 25, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(118, '61006', 'Beban Penyusutan Mesin & Peralatan Kerja', 14, '0000-00-00', 25, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(119, '62001', 'Biaya Listrik', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(120, '62002', 'Biaya PAM', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(121, '62003', 'Biaya Telpon', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(122, '62004', 'Biaya Pulsa', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(123, '62005', 'Biaya Gaji Karyawan', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '1467600000', '0000-00-00', 1),
(124, '62006', 'Biaya Pemasaran', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(125, '62007', 'Biaya Alat Tulis Kantor', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '9964598', '0000-00-00', 1),
(126, '62008', 'Biaya Fotocopy', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '1100000', '0000-00-00', 1),
(127, '62009', 'Biaya Internet', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '1320000', '0000-00-00', 1),
(128, '62010', 'Biaya Bahan Bakar', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '3472357', '0000-00-00', 1),
(129, '62011', 'Biaya Parkir', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(130, '62012', 'Biaya Makan Bersama', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '867605', '0000-00-00', 1),
(131, '62013', 'Biaya Iuran Kebersihan & Keamanan Bulanan', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '2395000', '0000-00-00', 1),
(132, '62014', 'Biaya Pemeliharaan Bangunan', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '34055350', '0000-00-00', 1),
(133, '62015', 'Biaya Pemeliharaan Peralatan Kantor', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '4876000', '0000-00-00', 1),
(134, '62016', 'Biaya Pemeliharaan Peralatan Toko', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '488000', '0000-00-00', 1),
(135, '62017', 'Biaya Pemeliharaan Kendaraan', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '45493184', '0000-00-00', 1),
(136, '62018', 'Biaya Pemeliharaan Mesin & Peralatan Kerja', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '2250000', '0000-00-00', 1),
(137, '62019', 'Biaya Lain - Lain Toko', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '2036843288', '0000-00-00', 1),
(138, '62020', 'Biaya MGK', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(139, '62021', 'Biaya Asuransi', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '2960000', '0000-00-00', 1),
(140, '62022', 'Biaya Sewa Ruko', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(141, '62023', 'Biaya Tilang', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '600000', '0000-00-00', 1),
(142, '62024', 'Biaya THR', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '122300000', '0000-00-00', 1),
(143, '62025', 'Biaya Perlengkapan Toko', 14, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(144, '63001', 'Biaya Kirim TIKI', 14, '0000-00-00', 27, 0, 0, 0, '', '', '', '', '', '675000', '0000-00-00', 1),
(145, '63002', 'Biaya Kirim Amalindo', 14, '0000-00-00', 27, 0, 0, 0, '', '', '', '', '', '220102814', '0000-00-00', 1),
(146, '63003', 'Biaya Kirim DHL', 14, '0000-00-00', 27, 0, 0, 0, '', '', '', '', '', '106542487', '0000-00-00', 1),
(147, '63004', 'Biaya Kirim TNT', 14, '0000-00-00', 27, 0, 0, 0, '', '', '', '', '', '204916271', '0000-00-00', 1),
(148, '63006', 'Biaya Kirim Lain Lain', 14, '0000-00-00', 27, 0, 0, 0, '', '', '', '', '', '115822940', '0000-00-00', 1),
(149, '63005', 'Biaya Kirim NNR', 14, '0000-00-00', 27, 0, 0, 0, '', '', '', '', '', '41104780', '0000-00-00', 1),
(150, '64000', 'Biaya Supplies', 14, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(151, '65001', 'Komisi Penjualan Tina', 14, '0000-00-00', 28, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(152, '65002', 'Komisi Penjualan Joko', 14, '0000-00-00', 28, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(153, '65003', 'Komisi Penjualan Edwin', 14, '0000-00-00', 28, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(154, '65004', 'Komisi Penjualan Lain - Lain', 14, '0000-00-00', 28, 0, 0, 0, '', '', '', '', '', '545885866', '0000-00-00', 1),
(155, '71001', 'Pendapatan Bunga Bank', 16, '0000-00-00', 29, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(156, '71002', 'Penjualan Aktiva Tetap', 16, '0000-00-00', 29, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(157, '71003', 'Pendapatan Lain Lain', 16, '0000-00-00', 29, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(158, '72001', 'Biaya Administrasi Bank', 15, '0000-00-00', 30, 0, 0, 0, '', '', '', '', '', '141200', '0000-00-00', 1),
(159, '72002', 'Pajak Bunga Bank', 15, '0000-00-00', 30, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(160, '73000', 'Laba Rugi Terealisasi', 15, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(161, '74000', 'Laba / Rugi Belum terealisasi', 15, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(162, '75000', 'Selisih Kurs', 15, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(163, '80000', 'Unbilled Goods', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(164, '80002', 'Lebih Bayar Penjualan', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '60011600', '0000-00-00', 1),
(165, '80003', 'Kurang Bayar Pembelian', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(166, '81003', 'Unbilled goods', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(179, '40000.01', 'Penjualan', 8, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '-27871323466', '0000-00-00', 1),
(180, '89889889', 'penyusutan', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '-', '0', '2020-04-22', 1),
(181, '24000', 'Ppn Keluaran', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '-934108815', '0000-00-00', 1),
(182, '16100', 'Ppn Masukan', 12, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '279549408.9', '2020-07-14', 1),
(183, '24000', 'PPn keluaran', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '2020-07-14', 0),
(184, '62026', 'Biaya Entertain', 14, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '284124141', '2020-07-14', 1),
(185, '11021', 'KAS KECIL', 9, '0000-00-00', 15, 0, 0, 0, '', '', '', '', '', '0', '2020-07-15', 0),
(186, '20003', 'Hutang Pak dhany', 4, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '-927286531', '2020-07-28', 1),
(187, '66000', 'Biaya asuransi', 14, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '2020-09-16', 1),
(188, '66001', 'Biaya Asuransi gedung', 14, '0000-00-00', 187, 0, 0, 0, '', '', '', '', '', '4745300', '2020-09-16', 1),
(189, '66002', 'Biaya asuransi bpjs ketenagakerjaan', 14, '0000-00-00', 187, 0, 0, 0, '', '', '', '', '', '84059400', '2020-09-16', 1),
(190, '66003', 'Biaya asuransi bpjs kesehatan', 14, '0000-00-00', 187, 0, 0, 0, '', '', '', '', '', '46134900', '2020-09-16', 1),
(191, '66004', 'Biaya asuransi mobil', 14, '0000-00-00', 187, 0, 0, 0, '', '', '', '', '', '22861770', '2020-09-16', 1),
(192, '11021', 'Kas kecil', 9, '0000-00-00', 16, 0, 0, 0, '', '', '', '', '', '407668755', '2020-09-16', 1),
(193, '16200', 'PPH pasal 21/25', 12, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '126615791', '0000-00-00', 1),
(194, '82000', 'PPh pasal 29', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '8270800', '2020-09-16', 1),
(195, '62020', 'Biaya pbb', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '927500', '2020-09-16', 1),
(196, '62027', 'Biaya Percetakan', 14, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '4025000', '2020-09-16', 1),
(197, '33000', 'Opening Balance Equity', 7, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '57713470', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komisi`
--

CREATE TABLE `komisi` (
  `id` int(250) NOT NULL,
  `no_komisi` varchar(250) NOT NULL,
  `tanggal_komisi` varchar(250) NOT NULL,
  `no_spr` varchar(250) NOT NULL,
  `sales` varchar(250) NOT NULL,
  `nominal_sales` varchar(250) NOT NULL,
  `spv` varchar(250) NOT NULL,
  `nominal_spv` varchar(250) NOT NULL,
  `manager` varchar(250) NOT NULL,
  `nominal_manager` varchar(250) NOT NULL,
  `status_pembayaran` varchar(250) NOT NULL,
  `tanggal_pembayaran` varchar(250) DEFAULT NULL,
  `is_active` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\User', 11),
(2, 'App\\User', 23),
(8, 'App\\User', 10),
(9, 'App\\User', 12),
(9, 'App\\User', 13),
(10, 'App\\User', 14),
(4, 'App\\User', 4),
(7, 'App\\User', 8),
(3, 'App\\User', 0),
(3, 'App\\User', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `parent_chart_of_account`
--

CREATE TABLE `parent_chart_of_account` (
  `id_parent` int(11) NOT NULL,
  `en_parent` varchar(100) NOT NULL,
  `in_parent` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `parent_chart_of_account`
--

INSERT INTO `parent_chart_of_account` (`id_parent`, `en_parent`, `in_parent`, `is_active`) VALUES
(1, 'Assets', 'Aktiva', 1),
(2, 'Liability', 'Kewajiban / Utang\r\n ', 1),
(3, 'Equity', 'Modal', 1),
(4, 'Revenue', 'Pendapatan', 1),
(5, 'Expense', 'Biaya', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembatalan_unit`
--

CREATE TABLE `pembatalan_unit` (
  `id` int(250) NOT NULL,
  `tanggal` varchar(250) NOT NULL,
  `no_pembatalan` varchar(250) NOT NULL,
  `spr_id` int(250) NOT NULL,
  `alasan_pembatalan` varchar(250) NOT NULL,
  `diajukan` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `refund` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembatalan_unit`
--

INSERT INTO `pembatalan_unit` (`id`, `tanggal`, `no_pembatalan`, `spr_id`, `alasan_pembatalan`, `diajukan`, `status`, `refund`) VALUES
(1, '22-03-2022', 'PB/01/00001', 1, 'Tidak cocok dengan rumahnya', 'Ridwanul Hakim', 'Approval', 'paid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_unit`
--

CREATE TABLE `pembayaran_unit` (
  `id` int(250) NOT NULL,
  `id_admin` int(250) NOT NULL,
  `rincian_id` int(250) NOT NULL,
  `no_detail_transaksi` varchar(250) NOT NULL,
  `tanggal_pembayaran` varchar(250) NOT NULL,
  `tanggal_konfirmasi` varchar(250) NOT NULL,
  `nominal` int(250) NOT NULL,
  `bank_tujuan` varchar(250) NOT NULL,
  `id_perusahaan` int(10) NOT NULL,
  `status_approval` varchar(250) NOT NULL,
  `tujuan` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran_unit`
--

INSERT INTO `pembayaran_unit` (`id`, `id_admin`, `rincian_id`, `no_detail_transaksi`, `tanggal_pembayaran`, `tanggal_konfirmasi`, `nominal`, `bank_tujuan`, `id_perusahaan`, `status_approval`, `tujuan`) VALUES
(1, 8, 1, 'SP/01/00001', '20/03/2022', '22-03-2022', 2000000, 'Bri', 1, 'paid', NULL),
(2, 8, 2, 'SP/01/00001', '20/03/2022', '22-03-2022', 5000000, 'Bca', 1, 'paid', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `id` int(250) NOT NULL,
  `id_perusahaan` int(250) NOT NULL,
  `project_code` varchar(250) NOT NULL,
  `nama_project` varchar(255) NOT NULL,
  `alamat_project` varchar(255) NOT NULL,
  `no_telepon_project` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `projects`
--

INSERT INTO `projects` (`id`, `id_perusahaan`, `project_code`, `nama_project`, `alamat_project`, `no_telepon_project`) VALUES
(1, 1, 'Project-01/YSP/2021', 'Ashoka Park', 'Gunung Sindar', '021912XXX'),
(2, 2, 'project-01/YSP/2021', 'Ashoka View', 'Bogor', '021xx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `refund`
--

CREATE TABLE `refund` (
  `id` int(250) NOT NULL,
  `pembatalan_id` int(250) NOT NULL,
  `no_refund` varchar(250) NOT NULL,
  `tanggal_refund` varchar(250) NOT NULL,
  `tanggal_pembayaran` varchar(250) NOT NULL,
  `no_pembatalan` varchar(250) NOT NULL,
  `diajukan` varchar(250) NOT NULL,
  `total_refund` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `refund`
--

INSERT INTO `refund` (`id`, `pembatalan_id`, `no_refund`, `tanggal_refund`, `tanggal_pembayaran`, `no_pembatalan`, `diajukan`, `total_refund`, `status`) VALUES
(1, 1, 'RF/01/00001', '22-03-2022', '20/03/2022', 'PB/01/00001', 'Ridwanul Hakim', 'Rp 4.900.000,00', 'paid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rincian_tagihan_spr`
--

CREATE TABLE `rincian_tagihan_spr` (
  `id_rincian` int(250) NOT NULL,
  `id_spr` int(250) NOT NULL,
  `no_transaksi` varchar(250) NOT NULL,
  `tipe` int(3) NOT NULL COMMENT '1:Booking fee, 2:Downpayment, 3:Pembayaran tahapan',
  `keterangan` varchar(250) NOT NULL,
  `jumlah_tagihan` int(250) NOT NULL,
  `jatuh_tempo` varchar(250) NOT NULL,
  `status_pembayaran` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rincian_tagihan_spr`
--

INSERT INTO `rincian_tagihan_spr` (`id_rincian`, `id_spr`, `no_transaksi`, `tipe`, `keterangan`, `jumlah_tagihan`, `jatuh_tempo`, `status_pembayaran`) VALUES
(1, 1, 'SP/01/00001', 1, 'Booking Fee', 2000000, '21-04-2022', 'paid'),
(2, 1, 'SP/01/00001', 2, 'Downpayment', 5000000, '21-04-2022', 'paid'),
(3, 1, 'SP/01/00001', 3, 'Cicilan Tahap 1', 59400000, '21-04-2022', 'unpaid'),
(4, 1, 'SP/01/00001', 3, 'Cicilan Tahap 2', 59400000, '21-05-2022', 'unpaid'),
(5, 1, 'SP/01/00001', 3, 'Cicilan Tahap 3', 59400000, '20-06-2022', 'unpaid'),
(6, 1, 'SP/01/00001', 3, 'Cicilan Tahap 4', 59400000, '20-07-2022', 'unpaid'),
(7, 1, 'SP/01/00001', 3, 'Cicilan Tahap 5', 59400000, '19-08-2022', 'unpaid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `key`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'Super Admin', 'web', '2021-07-16 19:56:23', '2021-07-16 19:56:23'),
(2, 'dokter', 'Dokter', 'web', '2021-07-21 18:26:17', '2021-07-21 18:26:17'),
(3, 'resepsionis', 'Resepsionis', 'web', '2021-08-01 18:38:02', '2021-08-01 18:38:02'),
(4, 'marketing', 'Marketing', 'web', '2021-08-14 01:52:46', '2021-08-14 01:52:46'),
(5, 'office-boy', 'Office Boy', 'web', '2021-08-14 01:54:47', '2021-08-14 01:54:47'),
(6, 'perawat', 'Perawat', 'web', '2021-08-14 01:55:06', '2021-08-14 01:55:06'),
(7, 'supervisor', 'Supervisor', 'web', '2021-08-25 07:07:13', '2021-08-25 07:07:13'),
(8, 'hrd', 'hrd', 'web', '2021-10-07 03:59:53', '2021-10-07 03:59:53'),
(9, 'logistik', 'Logistik', 'web', NULL, NULL),
(10, 'purchasing', 'Purchasing', 'web', '2022-02-15 05:02:08', '2022-02-15 05:02:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(11, 1),
(11, 8),
(12, 1),
(12, 8),
(13, 1),
(13, 8),
(14, 1),
(14, 8),
(15, 1),
(15, 8),
(16, 1),
(16, 8),
(17, 1),
(17, 8),
(18, 1),
(18, 8),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(31, 2),
(31, 3),
(31, 4),
(31, 5),
(31, 6),
(32, 4),
(33, 1),
(33, 4),
(34, 4),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(56, 3),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(60, 3),
(60, 7),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `skema_pembayaran`
--

CREATE TABLE `skema_pembayaran` (
  `id_skema` int(250) NOT NULL,
  `nama_skema` varchar(250) NOT NULL,
  `jumlah_skema` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skema_pembayaran`
--

INSERT INTO `skema_pembayaran` (`id_skema`, `nama_skema`, `jumlah_skema`) VALUES
(1, 'Cash Bertahap', '5'),
(2, 'Syariah', '6'),
(3, 'KPR', '7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spr`
--

CREATE TABLE `spr` (
  `id_transaksi` int(250) NOT NULL,
  `id_sales` bigint(20) UNSIGNED NOT NULL,
  `id_perusahaan` int(250) NOT NULL,
  `id_project` int(250) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `alamat_id` int(250) NOT NULL,
  `no_transaksi` varchar(250) NOT NULL,
  `tanggal_transaksi` varchar(250) NOT NULL,
  `jam_transaksi` date DEFAULT NULL,
  `nama` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `no_ktp` varchar(250) NOT NULL,
  `npwp` varchar(250) NOT NULL,
  `no_tlp` varchar(250) NOT NULL,
  `no_hp` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `pekerjaan` varchar(250) NOT NULL,
  `sumber_informasi` varchar(250) NOT NULL,
  `status_booking` varchar(11) DEFAULT NULL,
  `status_dp` varchar(11) DEFAULT NULL,
  `harga_jual` varchar(250) NOT NULL,
  `diskon` int(250) DEFAULT NULL,
  `status_approval` varchar(11) DEFAULT NULL,
  `harga_net` int(250) DEFAULT NULL,
  `total_luas_tanah` int(250) DEFAULT NULL,
  `skema` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `spr`
--

INSERT INTO `spr` (`id_transaksi`, `id_sales`, `id_perusahaan`, `id_project`, `id_unit`, `alamat_id`, `no_transaksi`, `tanggal_transaksi`, `jam_transaksi`, `nama`, `alamat`, `no_ktp`, `npwp`, `no_tlp`, `no_hp`, `email`, `pekerjaan`, `sumber_informasi`, `status_booking`, `status_dp`, `harga_jual`, `diskon`, `status_approval`, `harga_net`, `total_luas_tanah`, `skema`) VALUES
(1, 4, 1, 1, 306, 5, 'SP/01/00001', '22-03-2022', NULL, 'RIdho', 'Jl Margonda Raya No. 12', '3201175743000002', '089911782990111', '02187676331', '081378654321', 'ridho@gmail.com', 'Programmer', 'media sosial', 'paid', 'paid', '297000000', NULL, 'pending', 297000000, 64, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_rumah`
--

CREATE TABLE `unit_rumah` (
  `id_unit_rumah` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `blok` varchar(20) NOT NULL,
  `no` varchar(20) NOT NULL,
  `lb` varchar(20) NOT NULL,
  `lt` varchar(20) NOT NULL,
  `nstd` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `harga_jual` varchar(100) NOT NULL,
  `status_penjualan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `unit_rumah`
--

INSERT INTO `unit_rumah` (`id_unit_rumah`, `type`, `blok`, `no`, `lb`, `lt`, `nstd`, `total`, `harga_jual`, `status_penjualan`) VALUES
(1, 'Ruko', 'R', '1', '96', '48', ' -   ', '48', '630.000.000', 'Available'),
(2, 'Ruko', 'R', '2', '96', '48', ' -   ', '48', '634.400.000', 'Available'),
(3, 'Ruko', 'R', '3', '96', '48', ' -   ', '48', '630.000.000', 'Sold'),
(4, 'Ruko', 'R', '4', '96', '48', ' -   ', '48', '634.400.000', 'Available'),
(5, 'Ruko', 'R', '5', '96', '48', ' -   ', '48', '614.000.000', 'Sold'),
(6, 'Ruko', 'R', '6', '96', '48', ' -   ', '48', '614.000.000', 'Sold'),
(7, 'Ruko', 'R', '7', '96', '48', ' -   ', '48', '515.000.000', 'Sold'),
(8, 'Ruko', 'R', '8', '96', '48', ' -   ', '48', '630.000.000', 'Sold'),
(9, 'Ruko', 'R', '9', '96', '48', ' -   ', '48', '610.000.000', 'Sold'),
(10, 'Ruko', 'R', '10', '96', '48', ' -   ', '48', '610.000.000', 'Sold'),
(11, 'Ruko', 'R', '11', '96', '48', ' -   ', '48', '623.700.000', 'Sold'),
(12, 'Ruko', 'R', '12', '96', '48', ' -   ', '48', '634.400.000', 'Available'),
(13, 'Ruko', 'R', '13', '96', '48', ' -   ', '48', '634.400.000', 'Sold'),
(14, 'Ruko', 'R', '14', '96', '48', ' -   ', '48', '634.400.000', 'Available'),
(15, 'Ruko', 'R', '15', '96', '48', ' -   ', '48', '634.400.000', 'Available'),
(16, 'Javanika', 'A-1', '1', '45', '80', '29', '109', '434.000.000', 'Available'),
(17, 'Javanika', 'A-1', '2', '45', '80', ' -   ', '80', '432.000.000', 'Available'),
(18, 'Javanika', 'A-1', '3', '45', '80', ' -   ', '80', '432.000.000', 'Available'),
(19, 'Javanika', 'A-1', '4', '45', '80', ' -   ', '80', '432.000.000', 'Available'),
(20, 'Javanika', 'A-1', '5', '45', '80', ' -   ', '80', '432.000.000', 'Available'),
(21, 'Javanika', 'A-1', '6', '45', '80', '29', '109', '434.000.000', 'Available'),
(22, 'Javanika', 'A-1', '7', '45', '80', '29', '109', '430.000.000', 'Available'),
(23, 'Javanika', 'A-1', '8', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(24, 'Javanika', 'A-1', '9', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(25, 'Javanika', 'A-1', '10', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(26, 'Javanika', 'A-1', '11', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(27, 'Javanika', 'A-1', '12', '45', '80', '29', '109', '430.000.000', 'Available'),
(28, 'Javanika', 'A-2', '1', '45', '80', '29', '109', '373.625.000', 'Sold'),
(29, 'Javanika', 'A-2', '2', '45', '80', ' -   ', '80', '365.000.000', 'Sold'),
(30, 'Javanika', 'A-2', '3', '45', '80', ' -   ', '80', '402.950.000', 'Sold'),
(31, 'Javanika', 'A-2', '4', '45', '80', ' -   ', '80', '396.300.000', 'Sold'),
(32, 'Javanika', 'A-2', '5', '45', '80', ' -   ', '80', '365.000.000', 'Sold'),
(33, 'Javanika', 'A-2', '6', '45', '80', ' -   ', '80', '385.000.000', 'Sold'),
(34, 'Javanika', 'A-2', '7', '45', '80', ' -   ', '80', '375.400.000', 'Sold'),
(35, 'Javanika', 'A-2', '8', '45', '80', ' -   ', '80', '396.300.000', 'Sold'),
(36, 'Javanika', 'A-2', '9', '45', '80', '29', '109', '420.800.000', 'Sold'),
(37, 'Javanika', 'A-2', '10', '45', '80', '29', '109', '416.050.000', 'Sold'),
(38, 'Javanika', 'A-2', '11', '45', '80', ' -   ', '80', '360.000.000', 'Sold'),
(39, 'Javanika', 'A-2', '12', '45', '80', ' -   ', '80', '360.000.000', 'Sold'),
(40, 'Javanika', 'A-2', '13', '45', '80', ' -   ', '80', '360.000.000', 'Sold'),
(41, 'Javanika', 'A-2', '14', '45', '80', ' -   ', '80', '360.000.000', 'Sold'),
(42, 'Javanika', 'A-2', '15', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(43, 'Javanika', 'A-2', '16', '45', '80', ' -   ', '80', '370.650.000', 'Sold'),
(44, 'Javanika', 'A-2', '17', '45', '80', ' -   ', '80', '370.650.000', 'Sold'),
(45, 'Javanika', 'A-2', '18', '45', '80', '29', '109', '405.500.000', 'Sold'),
(46, 'Javanika', 'A-3', '1', '45', '80', '71', '151', '468.500.000', 'Sold'),
(47, 'Javanika', 'A-3', '2', '45', '80', ' -   ', '80', '390.000.000', 'Sold'),
(48, 'Javanika', 'A-3', '3', '45', '80', ' -   ', '80', '364.000.000', 'Sold'),
(49, 'Javanika', 'A-3', '4', '45', '80', ' -   ', '80', '396.000.000', 'Sold'),
(50, 'Javanika', 'A-3', '5', '45', '80', ' -   ', '80', '390.000.000', 'Sold'),
(51, 'Javanika', 'A-3', '6', '45', '80', '29', '109', '474.100.000', 'Sold'),
(52, 'Javanika', 'A-3', '7', '45', '80', '29', '109', '432.750.000', 'Sold'),
(53, 'Javanika', 'A-3', '8', '45', '80', ' -   ', '80', '384.000.000', 'Sold'),
(54, 'Javanika', 'A-3', '9', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(55, 'Javanika', 'A-3', '10', '45', '80', '52', '132', '499.850.000', 'Sold'),
(56, 'Javanika', 'A-4', '1', '45', '80', '29', '109', '405.500.000', 'Sold'),
(57, 'Javanika', 'A-4', '2', '45', '80', ' -   ', '80', '374.000.000', 'Sold'),
(58, 'Javanika', 'A-4', '3', '45', '80', '29', '109', '444.200.000', 'Sold'),
(59, 'Javanika', 'A-4', '4', '45', '80', '29', '109', '405.500.000', 'Sold'),
(60, 'Javanika', 'A-4', '5', '45', '80', ' -   ', '80', '384.000.000', 'Sold'),
(61, 'Javanika', 'A-4', '6', '45', '80', '29', '109', '459.100.000', 'Sold'),
(62, 'Javanika', 'A-5', '1', '45', '80', '29', '109', '430.000.000', 'Available'),
(63, 'Javanika', 'A-5', '2', '45', '80', ' -   ', '80', '393.450.000', 'Sold'),
(64, 'Javanika', 'A-5', '3', '45', '80', '29', '109', '456.150.000', 'Sold'),
(65, 'Javanika', 'A-5', '4', '45', '80', '29', '109', '468.100.000', 'Sold'),
(66, 'Javanika', 'A-5', '5', '45', '80', ' -   ', '80', '391.550.000', 'Sold'),
(67, 'Javanika', 'A-5', '6', '45', '80', '29', '109', '430.000.000', 'Available'),
(68, 'Javanika', 'A-6', '1', '45', '80', '62', '142', '430.000.000', 'Available'),
(69, 'Javanika', 'A-6', '2', '45', '80', '24', '104', '457.600.000', 'Sold'),
(70, 'Javanika', 'A-6', '3', '45', '80', '62', '142', '495.500.000', 'Sold'),
(71, 'Javanika', 'A-6', '4', '45', '80', '51', '131', '443.500.000', 'Sold'),
(72, 'Javanika', 'A-6', '5', '45', '80', '16', '96', '402.400.000', 'Sold'),
(73, 'Javanika', 'A-6', '6', '45', '80', '51', '131', '434.000.000', 'Available'),
(74, 'Javanika', 'B-1', '1', '45', '80', '29', '109', '456.000.000', 'Sold'),
(75, 'Javanika', 'B-1', '2', '45', '80', ' -   ', '80', '413.400.000', 'Sold'),
(76, 'Javanika', 'B-1', '3', '45', '80', ' -   ', '80', '413.400.000', 'Sold'),
(77, 'Javanika', 'B-1', '4', '45', '80', ' -   ', '80', '396.000.000', 'Sold'),
(78, 'Javanika', 'B-1', '5', '45', '80', ' -   ', '80', '402.000.000', 'Reserved'),
(79, 'Javanika', 'B-1', '6', '45', '80', '29', '109', '407.750.000', 'Sold'),
(80, 'Javanika', 'B-1', '7', '45', '80', '29', '109', '454.000.000', 'Sold'),
(81, 'Javanika', 'B-1', '8', '45', '80', ' -   ', '80', '409.600.000', 'Reserved'),
(82, 'Javanika', 'B-1', '9', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(83, 'Javanika', 'B-1', '10', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(84, 'Javanika', 'B-1', '11', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(85, 'Javanika', 'B-1', '12', '45', '80', '29', '109', '462.000.000', 'Sold'),
(86, 'Javanika', 'B-2', '1', '45', '80', '29', '109', '437.750.000', 'Sold'),
(87, 'Javanika', 'B-2', '2', '45', '80', ' -   ', '80', '396.300.000', 'Sold'),
(88, 'Javanika', 'B-2', '3', '45', '80', ' -   ', '80', '396.300.000', 'Sold'),
(89, 'Javanika', 'B-2', '4', '45', '80', ' -   ', '80', '396.300.000', 'Sold'),
(90, 'Javanika', 'B-2', '5', '45', '80', ' -   ', '80', '432.000.000', 'Available'),
(91, 'Javanika', 'B-2', '6', '45', '80', ' -   ', '80', '402.950.000', 'Sold'),
(92, 'Javanika', 'B-2', '7', '45', '80', ' -   ', '80', '396.300.000', 'Sold'),
(93, 'Javanika', 'B-2', '8', '45', '80', ' -   ', '80', '385.000.000', 'Sold'),
(94, 'Javanika', 'B-2', '9', '45', '80', '29', '109', '446.100.000', 'Sold'),
(95, 'Javanika', 'B-2', '10', '45', '80', '29', '109', '432.750.000', 'Sold'),
(96, 'Javanika', 'B-2', '11', '45', '80', ' -   ', '80', '391.550.000', 'Sold'),
(97, 'Javanika', 'B-2', '12', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(98, 'Javanika', 'B-2', '13', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(99, 'Javanika', 'B-2', '14', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(100, 'Javanika', 'B-2', '15', '45', '80', ' -   ', '80', '370.650.000', 'Sold'),
(101, 'Javanika', 'B-2', '16', '45', '80', ' -   ', '80', '384.000.000', 'Sold'),
(102, 'Javanika', 'B-2', '17', '45', '80', ' -   ', '80', '374.000.000', 'Sold'),
(103, 'Javanika', 'B-2', '18', '45', '80', '29', '109', '456.150.000', 'Sold'),
(104, 'Kocinea', 'B-3', '1', '32', '64', '23', '87', '262.650.000', 'Sold'),
(105, 'Kocinea', 'B-3', '2', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(106, 'Kocinea', 'B-3', '3', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(107, 'Kocinea', 'B-3', '4', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(108, 'Kocinea', 'B-3', '5', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(109, 'Kocinea', 'B-3', '6', '32', '64', '23', '87', '262.650.000', 'Sold'),
(110, 'Kocinea', 'B-3', '7', '32', '64', '23', '87', '267.400.000', 'Sold'),
(111, 'Kocinea', 'B-3', '8', '32', '64', ' -   ', '64', '231.000.000', 'Sold'),
(112, 'Kocinea', 'B-3', '9', '32', '64', ' -   ', '64', '273.000.000', 'Sold'),
(113, 'Kocinea', 'B-3', '10', '32', '64', ' -   ', '64', '248.100.000', 'Sold'),
(114, 'Kocinea', 'B-3', '11', '32', '64', ' -   ', '64', '263.300.000', 'Sold'),
(115, 'Kocinea', 'B-3', '12', '32', '64', '23', '87', '285.500.000', 'Sold'),
(116, 'Kocinea', 'B-4', '1', '32', '64', '23', '87', '266.500.000', 'Sold'),
(117, 'Kocinea', 'B-4', '2', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(118, 'Kocinea', 'B-4', '3', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(119, 'Kocinea', 'B-4', '4', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(120, 'Kocinea', 'B-4', '5', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(121, 'Kocinea', 'B-4', '6', '32', '64', '23', '87', '259.500.000', 'Sold'),
(122, 'Kocinea', 'B-4', '7', '32', '64', '23', '87', '262.650.000', 'Sold'),
(123, 'Kocinea', 'B-4', '8', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(124, 'Kocinea', 'B-4', '9', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(125, 'Kocinea', 'B-4', '10', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(126, 'Kocinea', 'B-4', '11', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(127, 'Kocinea', 'B-4', '12', '32', '64', '23', '87', '261.500.000', 'Sold'),
(128, 'Kocinea', 'B-5', '1', '32', '64', '23', '87', '262.650.000', 'Sold'),
(129, 'Kocinea', 'B-5', '2', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(130, 'Kocinea', 'B-5', '3', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(131, 'Kocinea', 'B-5', '4', '32', '64', ' -   ', '64', '269.000.000', 'Sold'),
(132, 'Kocinea', 'B-5', '5', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(133, 'Kocinea', 'B-5', '6', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(134, 'Kocinea', 'B-5', '7', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(135, 'Kocinea', 'B-5', '8', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(136, 'Kocinea', 'B-5', '9', '32', '64', '23', '87', '262.650.000', 'Sold'),
(137, 'Kocinea', 'B-5', '10', '32', '64', '23', '87', '262.500.000', 'Sold'),
(138, 'Kocinea', 'B-5', '11', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(139, 'Kocinea', 'B-5', '12', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(140, 'Kocinea', 'B-5', '13', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(141, 'Kocinea', 'B-5', '14', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(142, 'Kocinea', 'B-5', '15', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(143, 'Kocinea', 'B-5', '16', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(144, 'Kocinea', 'B-5', '17', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(145, 'Kocinea', 'B-5', '18', '32', '64', '23', '87', '262.650.000', 'Sold'),
(146, 'Kocinea', 'B-6', '1', '32', '64', '23', '87', '263.500.000', 'Sold'),
(147, 'Kocinea', 'B-6', '2', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(148, 'Kocinea', 'B-6', '3', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(149, 'Kocinea', 'B-6', '4', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(150, 'Kocinea', 'B-6', '5', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(151, 'Kocinea', 'B-6', '6', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(152, 'Kocinea', 'B-6', '7', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(153, 'Kocinea', 'B-6', '8', '32', '64', ' -   ', '64', '269.000.000', 'Sold'),
(154, 'Kocinea', 'B-6', '9', '32', '64', '23', '87', '296.500.000', 'Sold'),
(155, 'Kocinea', 'B-6', '10', '32', '64', '23', '87', '305.500.000', 'Sold'),
(156, 'Kocinea', 'B-6', '11', '32', '64', ' -   ', '64', '245.000.000', 'Sold'),
(157, 'Kocinea', 'B-6', '12', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(158, 'Kocinea', 'B-6', '13', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(159, 'Kocinea', 'B-6', '14', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(160, 'Kocinea', 'B-6', '15', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(161, 'Kocinea', 'B-6', '16', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(162, 'Kocinea', 'B-6', '17', '32', '64', ' -   ', '64', '255.000.000', 'Sold'),
(163, 'Kocinea', 'B-6', '18', '32', '64', '23', '87', '262.650.000', 'Sold'),
(164, 'Javanika', 'B-7', '1', '45', '80', '29', '109', '433.100.000', 'Sold'),
(165, 'Javanika', 'B-7', '2', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(166, 'Javanika', 'B-7', '3', '45', '80', ' -   ', '80', '390.000.000', 'Sold'),
(167, 'Javanika', 'B-7', '4', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(168, 'Javanika', 'B-7', '5', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(169, 'Javanika', 'B-7', '6', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(170, 'Javanika', 'B-7', '7', '45', '80', ' -   ', '80', '402.000.000', 'Sold'),
(171, 'Javanika', 'B-7', '8', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(172, 'Javanika', 'B-7', '9', '45', '80', '29', '109', '454.000.000', 'Sold'),
(173, 'Javanika', 'B-7', '10', '45', '80', '29', '109', '430.000.000', 'Available'),
(174, 'Javanika', 'B-7', '11', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(175, 'Javanika', 'B-7', '12', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(176, 'Javanika', 'B-7', '13', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(177, 'Javanika', 'B-7', '14', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(178, 'Javanika', 'B-7', '15', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(179, 'Javanika', 'B-7', '16', '45', '80', ' -   ', '80', '390.000.000', 'Sold'),
(180, 'Javanika', 'B-7', '17', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(181, 'Javanika', 'B-7', '18', '45', '80', '29', '109', '432.750.000', 'Sold'),
(182, 'Javanika', 'B-8', '1', '45', '80', '29', '109', '416.050.000', 'Sold'),
(183, 'Javanika', 'B-8', '2', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(184, 'Javanika', 'B-8', '3', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(185, 'Javanika', 'B-8', '4', '45', '80', ' -   ', '80', '360.000.000', 'Sold'),
(186, 'Javanika', 'B-8', '5', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(187, 'Javanika', 'B-8', '6', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(188, 'Javanika', 'B-8', '7', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(189, 'Javanika', 'B-8', '8', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(190, 'Javanika', 'B-8', '9', '45', '80', '29', '109', '430.000.000', 'Available'),
(191, 'Javanika', 'B-8', '10', '45', '80', '29', '109', '430.000.000', 'Available'),
(192, 'Javanika', 'B-8', '11', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(193, 'Javanika', 'B-8', '12', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(194, 'Javanika', 'B-8', '13', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(195, 'Javanika', 'B-8', '14', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(196, 'Javanika', 'B-8', '15', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(197, 'Javanika', 'B-8', '16', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(198, 'Javanika', 'B-8', '17', '45', '80', ' -   ', '80', '384.000.000', 'Sold'),
(199, 'Javanika', 'B-8', '18', '45', '80', '29', '109', '444.200.000', 'Sold'),
(200, 'Javanika', 'B-9', '1', '45', '80', '29', '109', '468.100.000', 'Sold'),
(201, 'Javanika', 'B-9', '2', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(202, 'Javanika', 'B-9', '3', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(203, 'Javanika', 'B-9', '4', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(204, 'Javanika', 'B-9', '5', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(205, 'Javanika', 'B-9', '6', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(206, 'Javanika', 'B-9', '7', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(207, 'Javanika', 'B-9', '8', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(208, 'Javanika', 'B-9', '9', '45', '80', '29', '109', '430.000.000', 'Available'),
(209, 'Javanika', 'B-9', '10', '45', '80', '29', '109', '430.000.000', 'Available'),
(210, 'Javanika', 'B-9', '11', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(211, 'Javanika', 'B-9', '12', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(212, 'Javanika', 'B-9', '13', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(213, 'Javanika', 'B-9', '14', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(214, 'Javanika', 'B-9', '15', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(215, 'Javanika', 'B-9', '16', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(216, 'Javanika', 'B-9', '17', '45', '80', ' -   ', '80', '398.000.000', 'Sold'),
(217, 'Javanika', 'B-9', '18', '45', '80', '29', '109', '468.100.000', 'Sold'),
(218, 'Javanika', 'B-10', '1', '45', '80', '29', '109', '430.000.000', 'Available'),
(219, 'Javanika', 'B-10', '2', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(220, 'Javanika', 'B-10', '3', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(221, 'Javanika', 'B-10', '4', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(222, 'Javanika', 'B-10', '5', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(223, 'Javanika', 'B-10', '6', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(224, 'Javanika', 'B-10', '7', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(225, 'Javanika', 'B-10', '8', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(226, 'Javanika', 'B-10', '9', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(227, 'Javanika', 'B-10', '10', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(228, 'Javanika', 'B-10', '11', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(229, 'Javanika', 'B-10', '12', '45', '80', '29', '109', '422.750.000', 'Sold'),
(230, 'Javanika', 'B-10', '13', '45', '80', '29', '109', '422.750.000', 'Sold'),
(231, 'Javanika', 'B-10', '14', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(232, 'Javanika', 'B-10', '15', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(233, 'Javanika', 'B-10', '16', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(234, 'Javanika', 'B-10', '17', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(235, 'Javanika', 'B-10', '18', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(236, 'Javanika', 'B-10', '19', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(237, 'Javanika', 'B-10', '20', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(238, 'Javanika', 'B-10', '21', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(239, 'Javanika', 'B-10', '22', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(240, 'Javanika', 'B-10', '23', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(241, 'Javanika', 'B-10', '24', '45', '80', '29', '109', '430.000.000', 'Available'),
(242, 'Javanika', 'B-11', '1', '45', '80', '29', '109', '430.000.000', 'Available'),
(243, 'Javanika', 'B-11', '2', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(244, 'Javanika', 'B-11', '3', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(245, 'Javanika', 'B-11', '4', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(246, 'Javanika', 'B-11', '5', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(247, 'Javanika', 'B-11', '6', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(248, 'Javanika', 'B-11', '7', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(249, 'Javanika', 'B-11', '8', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(250, 'Javanika', 'B-11', '9', '45', '80', ' -   ', '80', '430.000.000', 'Available'),
(251, 'Javanika', 'B-11', '10', '45', '80', '29', '109', '430.000.000', 'Available'),
(252, 'Javanika', 'B-11', '11', '45', '80', '29', '109', '428.000.000', 'Available'),
(253, 'Javanika', 'B-11', '12', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(254, 'Javanika', 'B-11', '13', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(255, 'Javanika', 'B-11', '14', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(256, 'Javanika', 'B-11', '15', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(257, 'Javanika', 'B-11', '16', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(258, 'Javanika', 'B-11', '17', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(259, 'Javanika', 'B-11', '18', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(260, 'Javanika', 'B-11', '19', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(261, 'Javanika', 'B-11', '20', '45', '80', '29', '109', '430.000.000', 'Available'),
(262, 'Acumina', 'B-12', '1', '32', '64', '23', '87', '314.100.000', 'Sold'),
(263, 'Acumina', 'B-12', '2', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(264, 'Acumina', 'B-12', '3', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(265, 'Acumina', 'B-12', '4', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(266, 'Acumina', 'B-12', '5', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(267, 'Acumina', 'B-12', '6', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(268, 'Acumina', 'B-12', '7', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(269, 'Acumina', 'B-12', '8', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(270, 'Acumina', 'B-12', '9', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(271, 'Acumina', 'B-12', '10', '32', '64', '23', '87', '310.100.000', 'Sold'),
(272, 'Acumina', 'B-12', '11', '32', '64', '23', '87', '314.750.000', 'Sold'),
(273, 'Acumina', 'B-12', '12', '32', '64', '16', '80', '273.750.000', 'Sold'),
(274, 'Acumina', 'B-12', '13', '32', '64', '16', '80', '273.750.000', 'Sold'),
(275, 'Acumina', 'B-12', '14', '32', '64', '16', '80', '273.750.000', 'Sold'),
(276, 'Acumina', 'B-12', '15', '32', '64', '16', '80', '273.750.000', 'Sold'),
(277, 'Acumina', 'B-12', '16', '32', '64', '16', '80', '273.750.000', 'Sold'),
(278, 'Acumina', 'B-12', '17', '32', '64', '16', '80', '273.750.000', 'Sold'),
(279, 'Acumina', 'B-12', '18', '32', '64', '16', '80', '273.750.000', 'Sold'),
(280, 'Acumina', 'B-12', '19', '32', '64', '16', '80', '275.000.000', 'Sold'),
(281, 'Acumina', 'B-12', '20', '32', '64', '23', '87', '309.100.000', 'Sold'),
(282, 'Acumina', 'B-13', '1', '32', '64', '19', '83', '314.300.000', 'Sold'),
(283, 'Acumina', 'B-13', '2', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(284, 'Acumina', 'B-13', '3', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(285, 'Acumina', 'B-13', '4', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(286, 'Acumina', 'B-13', '5', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(287, 'Acumina', 'B-13', '6', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(288, 'Acumina', 'B-13', '7', '32', '64', '39', '103', '341.300.000', 'Sold'),
(289, 'Acumina', 'B-13', '8', '32', '64', '28', '92', '322.600.000', 'Sold'),
(290, 'Acumina', 'B-13', '9', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(291, 'Acumina', 'B-13', '10', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(292, 'Acumina', 'B-13', '11', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(293, 'Acumina', 'B-13', '12', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(294, 'Acumina', 'B-13', '13', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(295, 'Acumina', 'B-13', '14', '32', '64', '19', '83', '303.300.000', 'Sold'),
(296, 'Acumina', 'B-14', '1', '32', '64', '19', '83', '307.950.000', 'Sold'),
(297, 'Acumina', 'B-14', '2', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(298, 'Acumina', 'B-14', '3', '32', '64', ' -   ', '64', '254.000.000', 'Sold'),
(299, 'Acumina', 'B-14', '4', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(300, 'Acumina', 'B-14', '5', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(301, 'Acumina', 'B-14', '6', '32', '64', ' -   ', '64', '271.700.000', 'Sold'),
(302, 'Acumina', 'B-14', '7', '32', '64', '68', '132', '397.600.000', 'Sold'),
(303, 'Acumina', 'B-14', '8', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(304, 'Acumina', 'B-14', '9', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(305, 'Acumina', 'B-14', '10', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(306, 'Acumina', 'B-14', '11', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(307, 'Acumina', 'B-14', '12', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(308, 'Acumina', 'B-14', '13', '32', '64', '19', '83', '285.500.000', 'Sold'),
(309, 'Acumina', 'B-15', '1', '32', '64', '19', '83', '303.300.000', 'Sold'),
(310, 'Acumina', 'B-15', '2', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(311, 'Acumina', 'B-15', '3', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(312, 'Acumina', 'B-15', '4', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(313, 'Acumina', 'B-15', '5', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(314, 'Acumina', 'B-15', '6', '32', '64', '40', '104', '316.650.000', 'Sold'),
(315, 'Acumina', 'B-15', '7', '32', '64', '29', '93', '318.300.000', 'Sold'),
(316, 'Acumina', 'B-15', '8', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(317, 'Acumina', 'B-15', '9', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(318, 'Acumina', 'B-15', '10', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(319, 'Acumina', 'B-15', '11', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(320, 'Acumina', 'B-15', '12', '32', '64', '19', '83', '301.500.000', 'Sold'),
(321, 'Acumina', 'B-16', '1', '32', '64', '19', '83', '314.300.000', 'Sold'),
(322, 'Acumina', 'B-16', '2', '32', '64', ' -   ', '64', '271.000.000', 'Sold'),
(323, 'Acumina', 'B-16', '3', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(324, 'Acumina', 'B-16', '4', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(325, 'Acumina', 'B-16', '5', '32', '64', ' -   ', '64', '271.000.000', 'Sold'),
(326, 'Acumina', 'B-16', '6', '32', '64', '70', '134', '401.000.000', 'Sold'),
(327, 'Acumina', 'B-16', '7', '32', '64', ' -   ', '64', '266.000.000', 'Sold'),
(328, 'Acumina', 'B-16', '8', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(329, 'Acumina', 'B-16', '9', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(330, 'Acumina', 'B-16', '10', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(331, 'Acumina', 'B-16', '11', '32', '64', '19', '83', '290.250.000', 'Sold'),
(332, 'Kocinea', 'B-17', '1', '32', '64', '62', '126', '351.000.000', 'Sold'),
(333, 'Kocinea', 'B-17', '2', '32', '64', '31', '95', '337.850.000', 'Sold'),
(334, 'Kocinea', 'B-17', '3', '32', '64', '35', '99', '321.500.000', 'Sold'),
(335, 'Kocinea', 'B-17', '4', '32', '64', '39', '103', '297.000.000', 'Available'),
(336, 'Kocinea', 'B-17', '5', '32', '64', '36', '100', '346.350.000', 'Sold'),
(337, 'Kocinea', 'B-17', '6', '32', '64', '32', '96', '297.000.000', 'Available'),
(338, 'Kocinea', 'B-17', '7', '32', '64', '38', '102', '297.000.000', 'Available'),
(339, 'Kocinea', 'B-17', '8', '32', '64', '43', '107', '297.000.000', 'Available'),
(340, 'Kocinea', 'B-17', '9', '32', '64', '39', '103', '297.000.000', 'Available'),
(341, 'Kocinea', 'B-17', '10', '32', '64', '97', '161', '417.500.000', 'Sold'),
(342, 'Kocinea', 'B-18', '1', '32', '64', '45', '109', '295.650.000', 'Sold'),
(343, 'Kocinea', 'B-18', '2', '32', '64', '35', '99', '325.500.000', 'Sold'),
(344, 'Kocinea', 'B-18', '3', '32', '64', '49', '113', '297.000.000', 'Available'),
(345, 'Kocinea', 'B-18', '4', '32', '64', '63', '127', '297.000.000', 'Available'),
(346, 'Kocinea', 'B-18', '5', '32', '64', '7', '71', '242.500.000', 'Sold'),
(347, 'Kocinea', 'B-18', '6', '32', '64', '4', '68', '238.000.000', 'Sold'),
(348, 'Kocinea', 'B-18', '7', '32', '64', '5', '69', '290.500.000', 'Sold'),
(349, 'Kocinea', 'B-18', '8', '32', '64', '9', '73', '239.750.000', 'Sold'),
(350, 'Kocinea', 'B-18', '9', '32', '64', '46', '110', '297.150.000', 'Sold'),
(351, 'Kocinea', 'B-18', '10', '32', '64', '35', '99', '297.000.000', 'Available'),
(352, 'Kocinea', 'B-18', '11', '32', '64', '9', '73', '239.750.000', 'Sold'),
(353, 'Kocinea', 'B-18', '12', '32', '64', '15', '79', '284.500.000', 'Sold'),
(354, 'Kocinea', 'B-19', '1', '32', '64', '14', '78', '268.000.000', 'Sold'),
(355, 'Kocinea', 'B-19', '2', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(356, 'Kocinea', 'B-19', '3', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(357, 'Kocinea', 'B-19', '4', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(358, 'Kocinea', 'B-19', '5', '32', '64', '31', '95', '308.500.000', 'Sold'),
(359, 'Kocinea', 'B-19', '6', '32', '64', '31', '95', '338.700.000', 'Sold'),
(360, 'Kocinea', 'B-19', '7', '32', '64', ' -   ', '64', '280.000.000', 'Sold'),
(361, 'Kocinea', 'B-19', '8', '32', '64', ' -   ', '64', '280.000.000', 'Sold'),
(362, 'Kocinea', 'B-19', '9', '32', '64', ' -   ', '64', '284.000.000', 'Sold'),
(363, 'Kocinea', 'B-19', '10', '32', '64', '14', '78', '305.800.000', 'Sold'),
(364, 'Kocinea', 'B-20', '11', '32', '64', '34', '98', '250.650.000', 'Sold'),
(365, 'Kocinea', 'B-20', '12', '32', '64', '15', '79', '289.900.000', 'Sold'),
(366, 'Kocinea', 'B-20', '13', '32', '64', '15', '79', '443.000.000', 'Sold'),
(367, 'Kocinea', 'B-20', '14', '32', '64', '15', '79', '422.000.000', 'Sold'),
(368, 'Kocinea', 'B-20', '15', '32', '64', '15', '79', '336.800.000', 'Sold'),
(369, 'Kocinea', 'B-20', '16', '32', '64', '15', '79', '309.500.000', 'Sold'),
(370, 'Kocinea', 'B-20', '17', '32', '64', '15', '79', '310.650.000', 'Sold'),
(371, 'Kocinea', 'B-20', '18', '32', '64', '98', '162', '310.650.000', 'Sold'),
(372, 'Kocinea', 'B-20', '19', '32', '64', '117', '181', '310.650.000', 'Sold'),
(373, 'Kocinea', 'B-20', '20', '32', '64', '15', '79', '309.500.000', 'Sold'),
(374, 'Kocinea', 'B-20', '21', '32', '64', '19', '83', '310.650.000', 'Sold'),
(375, 'Acumina', 'C-1', '1', '32', '64', '15', '79', '282.950.000', 'Sold'),
(376, 'Acumina', 'C-1', '2', '32', '64', ' -   ', '64', '258.550.000', 'Sold'),
(377, 'Acumina', 'C-1', '3', '32', '64', ' -   ', '64', '258.550.000', 'Sold'),
(378, 'Acumina', 'C-1', '4', '32', '64', ' -   ', '64', '258.550.000', 'Sold'),
(379, 'Acumina', 'C-1', '5', '32', '64', ' -   ', '64', '258.550.000', 'Sold'),
(380, 'Acumina', 'C-1', '6', '32', '64', ' -   ', '64', '258.550.000', 'Sold'),
(381, 'Acumina', 'C-1', '7', '32', '64', ' -   ', '64', '254.000.000', 'Sold'),
(382, 'Acumina', 'C-1', '8', '32', '64', ' -   ', '64', '259.000.000', 'Sold'),
(383, 'Acumina', 'C-1', '9', '32', '64', '23', '87', '295.500.000', 'Sold'),
(384, 'Acumina', 'C-1', '10', '32', '64', '23', '87', '526.000.000', 'Sold'),
(385, 'Acumina', 'C-1', '11', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(386, 'Acumina', 'C-1', '12', '32', '64', ' -   ', '64', '228.000.000', 'Sold'),
(387, 'Acumina', 'C-1', '13', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(388, 'Acumina', 'C-1', '14', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(389, 'Acumina', 'C-1', '15', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(390, 'Acumina', 'C-1', '16', '32', '64', ' -   ', '64', '252.000.000', 'Sold'),
(391, 'Acumina', 'C-1', '17', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(392, 'Acumina', 'C-1', '18', '32', '64', '15', '79', '276.500.000', 'Sold'),
(393, 'Acumina', 'C-2', '1', '32', '64', '15', '79', '279.500.000', 'Sold'),
(394, 'Acumina', 'C-2', '2', '32', '64', ' -   ', '64', '252.000.000', 'Sold'),
(395, 'Acumina', 'C-2', '3', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(396, 'Acumina', 'C-2', '4', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(397, 'Acumina', 'C-2', '5', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(398, 'Acumina', 'C-2', '6', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(399, 'Acumina', 'C-2', '7', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(400, 'Acumina', 'C-2', '8', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(401, 'Acumina', 'C-2', '9', '32', '64', '23', '87', '321.100.000', 'Sold'),
(402, 'Acumina', 'C-2', '10', '32', '64', '23', '87', '321.100.000', 'Sold'),
(403, 'Acumina', 'C-2', '11', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(404, 'Acumina', 'C-2', '12', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(405, 'Acumina', 'C-2', '13', '32', '64', ' -   ', '64', '194.687.500', 'Sold'),
(406, 'Acumina', 'C-2', '14', '32', '64', ' -   ', '64', '194.687.500', 'Sold'),
(407, 'Acumina', 'C-2', '15', '32', '64', ' -   ', '64', '256.000.000', 'Sold'),
(408, 'Acumina', 'C-2', '16', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(409, 'Acumina', 'C-2', '17', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(410, 'Acumina', 'C-2', '18', '32', '64', '15', '79', '279.500.000', 'Sold'),
(411, 'Acumina', 'C-3', '1', '32', '64', '15', '79', '279.250.000', 'Sold'),
(412, 'Acumina', 'C-3', '2', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(413, 'Acumina', 'C-3', '3', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(414, 'Acumina', 'C-3', '4', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(415, 'Acumina', 'C-3', '5', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(416, 'Acumina', 'C-3', '6', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(417, 'Acumina', 'C-3', '7', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(418, 'Acumina', 'C-3', '8', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(419, 'Acumina', 'C-3', '9', '32', '64', '23', '87', '291.150.000', 'Sold'),
(420, 'Acumina', 'C-3', '10', '32', '64', '67', '131', '364.900.000', 'Sold'),
(421, 'Acumina', 'C-3', '11', '32', '64', '22', '86', '308.400.000', 'Sold'),
(422, 'Acumina', 'C-3', '12', '32', '64', '27', '91', '314.900.000', 'Sold'),
(423, 'Acumina', 'C-3', '13', '32', '64', '23', '87', '291.150.000', 'Sold'),
(424, 'Acumina', 'C-3', '14', '32', '64', ' -   ', '64', '256.000.000', 'Sold'),
(425, 'Acumina', 'C-3', '15', '32', '64', ' -   ', '64', '264.250.000', 'Sold'),
(426, 'Acumina', 'C-3', '16', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(427, 'Acumina', 'C-3', '17', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(428, 'Acumina', 'C-3', '18', '32', '64', ' -   ', '64', '240.000.000', 'Sold'),
(429, 'Acumina', 'C-3', '19', '32', '64', ' -   ', '64', '256.000.000', 'Sold'),
(430, 'Acumina', 'C-3', '20', '32', '64', ' -   ', '64', '257.000.000', 'Sold'),
(431, 'Acumina', 'C-3', '21', '32', '64', '15', '79', '279.500.000', 'Sold'),
(432, 'Acumina', 'C-4', '1', '32', '64', '15', '79', '288.250.000', 'Sold'),
(433, 'Acumina', 'C-4', '2', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(434, 'Acumina', 'C-4', '3', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(435, 'Acumina', 'C-4', '4', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(436, 'Acumina', 'C-4', '5', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(437, 'Acumina', 'C-4', '6', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(438, 'Acumina', 'C-4', '7', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(439, 'Acumina', 'C-4', '8', '32', '64', '7', '71', '270.250.000', 'Sold'),
(440, 'Acumina', 'C-4', '9', '32', '64', '7', '71', '293.900.000', 'Sold'),
(441, 'Acumina', 'C-4', '10', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(442, 'Acumina', 'C-4', '11', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(443, 'Acumina', 'C-4', '12', '32', '64', ' -   ', '64', '235.000.000', 'Sold'),
(444, 'Acumina', 'C-4', '13', '32', '64', ' -   ', '64', '256.000.000', 'Sold'),
(445, 'Acumina', 'C-4', '14', '32', '64', ' -   ', '64', '256.000.000', 'Sold'),
(446, 'Acumina', 'C-4', '15', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(447, 'Acumina', 'C-4', '16', '32', '64', '15', '79', '280.500.000', 'Sold'),
(448, 'Acumina', 'C-5', '1', '32', '64', '15', '79', '288.250.000', 'Sold'),
(449, 'Acumina', 'C-5', '2', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(450, 'Acumina', 'C-5', '3', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(451, 'Acumina', 'C-5', '4', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(452, 'Acumina', 'C-5', '5', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(453, 'Acumina', 'C-5', '6', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(454, 'Acumina', 'C-5', '7', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(455, 'Acumina', 'C-5', '8', '32', '64', '7', '71', '297.900.000', 'Sold'),
(456, 'Acumina', 'C-5', '9', '32', '64', '9', '73', '270.150.000', 'Sold'),
(457, 'Acumina', 'C-5', '10', '32', '64', '3', '67', '254.100.000', 'Sold'),
(458, 'Acumina', 'C-5', '11', '32', '64', '7', '71', '273.900.000', 'Sold'),
(459, 'Acumina', 'C-5', '12', '32', '64', '10', '74', '289.000.000', 'Sold'),
(460, 'Acumina', 'C-5', '13', '32', '64', '7', '71', '262.900.000', 'Sold'),
(461, 'Acumina', 'C-5', '14', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(462, 'Acumina', 'C-5', '15', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(463, 'Acumina', 'C-5', '16', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(464, 'Acumina', 'C-5', '17', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(465, 'Acumina', 'C-5', '18', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(466, 'Acumina', 'C-5', '19', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(467, 'Acumina', 'C-5', '20', '32', '64', '15', '79', '284.250.000', 'Sold'),
(468, 'Acumina', 'C-6', '1', '32', '64', '15', '79', '300.500.000', 'Sold'),
(469, 'Acumina', 'C-6', '2', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(470, 'Acumina', 'C-6', '3', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(471, 'Acumina', 'C-6', '4', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(472, 'Acumina', 'C-6', '5', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(473, 'Acumina', 'C-6', '6', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(474, 'Acumina', 'C-6', '7', '32', '64', ' -   ', '64', '254.000.000', 'Sold'),
(475, 'Acumina', 'C-6', '8', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(476, 'Acumina', 'C-6', '9', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(477, 'Acumina', 'C-6', '10', '32', '64', '15', '79', '294.500.000', 'Sold'),
(478, 'Acumina', 'C-6', '11', '32', '64', '15', '79', '298.500.000', 'Sold'),
(479, 'Acumina', 'C-6', '12', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(480, 'Acumina', 'C-6', '13', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(481, 'Acumina', 'C-6', '14', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(482, 'Acumina', 'C-6', '15', '32', '64', ' -   ', '64', '256.000.000', 'Sold'),
(483, 'Acumina', 'C-6', '16', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(484, 'Acumina', 'C-6', '17', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(485, 'Acumina', 'C-6', '18', '32', '64', ' -   ', '64', '257.000.000', 'Sold'),
(486, 'Acumina', 'C-6', '19', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(487, 'Acumina', 'C-6', '20', '32', '64', '15', '79', '284.250.000', 'Sold'),
(488, 'Acumina', 'C-7', '1', '32', '64', '15', '79', '275.500.000', 'Sold'),
(489, 'Acumina', 'C-7', '2', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(490, 'Acumina', 'C-7', '3', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(491, 'Acumina', 'C-7', '4', '32', '64', ' -   ', '64', '257.000.000', 'Sold'),
(492, 'Acumina', 'C-7', '5', '32', '64', ' -   ', '64', '272.000.000', 'Sold'),
(493, 'Acumina', 'C-7', '6', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(494, 'Acumina', 'C-7', '7', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(495, 'Acumina', 'C-7', '8', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(496, 'Acumina', 'C-7', '9', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(497, 'Acumina', 'C-7', '10', '32', '64', '15', '79', '298.500.000', 'Sold'),
(498, 'Acumina', 'C-7', '11', '32', '64', '15', '79', '301.150.000', 'Sold'),
(499, 'Acumina', 'C-7', '12', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(500, 'Acumina', 'C-7', '13', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(501, 'Acumina', 'C-7', '14', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(502, 'Acumina', 'C-7', '15', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(503, 'Acumina', 'C-7', '16', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(504, 'Acumina', 'C-7', '17', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(505, 'Acumina', 'C-7', '18', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(506, 'Acumina', 'C-7', '19', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(507, 'Acumina', 'C-7', '20', '32', '64', '15', '79', '275.500.000', 'Sold'),
(508, 'Acumina', 'C-8', '1', '32', '64', '15', '79', '299.000.000', 'Close'),
(509, 'Acumina', 'C-8', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(510, 'Acumina', 'C-8', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(511, 'Acumina', 'C-8', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(512, 'Acumina', 'C-8', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(513, 'Acumina', 'C-8', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(514, 'Acumina', 'C-8', '7', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(515, 'Acumina', 'C-8', '8', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(516, 'Acumina', 'C-8', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(517, 'Acumina', 'C-8', '10', '32', '64', '15', '79', '299.000.000', 'Close'),
(518, 'Acumina', 'C-8', '11', '32', '64', '103', '167', '299.000.000', 'Close'),
(519, 'Acumina', 'C-8', '12', '32', '64', '49', '113', '297.000.000', 'Close'),
(520, 'Acumina', 'C-8', '13', '32', '64', '64', '128', '299.000.000', 'Close'),
(521, 'Acumina', 'C-8', '14', '32', '64', '15', '79', '299.000.000', 'Close'),
(522, 'Acumina', 'C-8', '15', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(523, 'Acumina', 'C-8', '16', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(524, 'Acumina', 'C-8', '17', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(525, 'Acumina', 'C-8', '18', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(526, 'Acumina', 'C-8', '19', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(527, 'Acumina', 'C-8', '20', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(528, 'Acumina', 'C-8', '21', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(529, 'Acumina', 'C-8', '22', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(530, 'Acumina', 'C-8', '23', '32', '64', '15', '79', '299.000.000', 'Close'),
(531, 'Acumina', 'C-9', '1', '32', '64', '15', '79', '299.000.000', 'Close'),
(532, 'Acumina', 'C-9', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(533, 'Acumina', 'C-9', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(534, 'Acumina', 'C-9', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(535, 'Acumina', 'C-9', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(536, 'Acumina', 'C-9', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(537, 'Acumina', 'C-9', '7', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(538, 'Acumina', 'C-9', '8', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(539, 'Acumina', 'C-9', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(540, 'Acumina', 'C-9', '10', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(541, 'Acumina', 'C-9', '11', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(542, 'Acumina', 'C-9', '12', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(543, 'Acumina', 'C-9', '13', '32', '64', '41', '105', '299.000.000', 'Close'),
(544, 'Acumina', 'C-9', '14', '32', '64', '43', '107', '299.000.000', 'Close'),
(545, 'Acumina', 'C-9', '15', '32', '64', '34', '98', '297.000.000', 'Close'),
(546, 'Acumina', 'C-9', '16', '32', '64', '33', '97', '297.000.000', 'Close'),
(547, 'Acumina', 'C-9', '17', '32', '64', '32', '96', '297.000.000', 'Close'),
(548, 'Acumina', 'C-9', '18', '32', '64', '49', '113', '299.000.000', 'Close'),
(549, 'Acumina', 'C-9', '19', '32', '64', '41', '105', '299.000.000', 'Close'),
(550, 'Acumina', 'C-9', '20', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(551, 'Acumina', 'C-9', '21', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(552, 'Acumina', 'C-9', '22', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(553, 'Acumina', 'C-9', '23', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(554, 'Acumina', 'C-9', '24', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(555, 'Acumina', 'C-9', '25', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(556, 'Acumina', 'C-9', '26', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(557, 'Acumina', 'C-9', '27', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(558, 'Acumina', 'C-9', '28', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(559, 'Acumina', 'C-9', '29', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(560, 'Acumina', 'C-9', '30', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(561, 'Acumina', 'C-9', '31', '32', '64', '15', '79', '299.000.000', 'Close'),
(562, 'Acumina', 'C-10', '1', '32', '64', '15', '79', '299.000.000', 'Close'),
(563, 'Acumina', 'C-10', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(564, 'Acumina', 'C-10', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(565, 'Acumina', 'C-10', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(566, 'Acumina', 'C-10', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(567, 'Acumina', 'C-10', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(568, 'Acumina', 'C-10', '7', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(569, 'Acumina', 'C-10', '8', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(570, 'Acumina', 'C-10', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(571, 'Acumina', 'C-10', '10', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(572, 'Acumina', 'C-10', '11', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(573, 'Acumina', 'C-10', '12', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(574, 'Acumina', 'C-10', '13', '32', '64', '41', '105', '299.000.000', 'Close'),
(575, 'Acumina', 'C-10', '14', '32', '64', '32', '96', '299.000.000', 'Close'),
(576, 'Acumina', 'C-10', '15', '32', '64', '16', '80', '297.000.000', 'Close'),
(577, 'Acumina', 'C-10', '16', '32', '64', '16', '80', '297.000.000', 'Close'),
(578, 'Acumina', 'C-10', '17', '32', '64', '16', '80', '297.000.000', 'Close'),
(579, 'Acumina', 'C-10', '18', '32', '64', '36', '100', '299.000.000', 'Close'),
(580, 'Acumina', 'C-10', '19', '32', '64', '41', '105', '299.000.000', 'Close'),
(581, 'Acumina', 'C-10', '20', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(582, 'Acumina', 'C-10', '21', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(583, 'Acumina', 'C-10', '22', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(584, 'Acumina', 'C-10', '23', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(585, 'Acumina', 'C-10', '24', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(586, 'Acumina', 'C-10', '25', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(587, 'Acumina', 'C-10', '26', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(588, 'Acumina', 'C-10', '27', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(589, 'Acumina', 'C-10', '28', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(590, 'Acumina', 'C-10', '29', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(591, 'Acumina', 'C-10', '30', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(592, 'Acumina', 'C-10', '31', '32', '64', '9', '73', '299.000.000', 'Close'),
(593, 'Acumina', 'C-11', '1', '32', '64', '15', '79', '299.000.000', 'Close'),
(594, 'Acumina', 'C-11', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(595, 'Acumina', 'C-11', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(596, 'Acumina', 'C-11', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(597, 'Acumina', 'C-11', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(598, 'Acumina', 'C-11', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(599, 'Acumina', 'C-11', '7', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(600, 'Acumina', 'C-11', '8', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(601, 'Acumina', 'C-11', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(602, 'Acumina', 'C-11', '10', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(603, 'Acumina', 'C-11', '11', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(604, 'Acumina', 'C-11', '12', '32', '64', '15', '79', '299.000.000', 'Close'),
(605, 'Acumina', 'C-11', '13', '32', '64', '27', '91', '299.000.000', 'Close'),
(606, 'Acumina', 'C-11', '14', '32', '64', '52', '116', '299.000.000', 'Close'),
(607, 'Acumina', 'C-11', '15', '32', '64', '15', '79', '299.000.000', 'Close'),
(608, 'Acumina', 'C-11', '16', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(609, 'Acumina', 'C-11', '17', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(610, 'Acumina', 'C-11', '18', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(611, 'Acumina', 'C-11', '19', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(612, 'Acumina', 'C-11', '20', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(613, 'Acumina', 'C-11', '21', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(614, 'Acumina', 'C-11', '22', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(615, 'Acumina', 'C-11', '23', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(616, 'Acumina', 'C-11', '24', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(617, 'Acumina', 'C-11', '25', '32', '64', ' -   ', '64', '299.000.000', 'Close'),
(618, 'Acumina', 'C-11', '26', '32', '64', '15', '79', '296.000.000', 'Sold'),
(619, 'Acumina', 'C-12', '1', '32', '64', '23', '87', '299.000.000', 'Close'),
(620, 'Acumina', 'C-12', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(621, 'Acumina', 'C-12', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(622, 'Acumina', 'C-12', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(623, 'Acumina', 'C-12', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(624, 'Acumina', 'C-12', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(625, 'Acumina', 'C-12', '7', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(626, 'Acumina', 'C-12', '8', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(627, 'Acumina', 'C-12', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(628, 'Acumina', 'C-12', '10', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(629, 'Acumina', 'C-12', '11', '32', '64', '15', '79', '299.000.000', 'Close'),
(630, 'Acumina', 'C-12', '12', '32', '64', '15', '79', '299.000.000', 'Close');
INSERT INTO `unit_rumah` (`id_unit_rumah`, `type`, `blok`, `no`, `lb`, `lt`, `nstd`, `total`, `harga_jual`, `status_penjualan`) VALUES
(631, 'Acumina', 'C-12', '13', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(632, 'Acumina', 'C-12', '14', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(633, 'Acumina', 'C-12', '15', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(634, 'Acumina', 'C-12', '16', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(635, 'Acumina', 'C-12', '17', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(636, 'Acumina', 'C-12', '18', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(637, 'Acumina', 'C-12', '19', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(638, 'Acumina', 'C-12', '20', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(639, 'Acumina', 'C-12', '21', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(640, 'Acumina', 'C-12', '22', '32', '64', '23', '87', '299.000.000', 'Close'),
(641, 'Acumina', 'C-13', '1', '32', '64', '23', '87', '299.000.000', 'Close'),
(642, 'Acumina', 'C-13', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(643, 'Acumina', 'C-13', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(644, 'Acumina', 'C-13', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(645, 'Acumina', 'C-13', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(646, 'Acumina', 'C-13', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(647, 'Acumina', 'C-13', '7', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(648, 'Acumina', 'C-13', '8', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(649, 'Acumina', 'C-13', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(650, 'Acumina', 'C-13', '10', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(651, 'Acumina', 'C-13', '11', '32', '64', ' -   ', '64', '299.000.000', 'Close'),
(652, 'Acumina', 'C-13', '12', '32', '64', ' -   ', '64', '299.000.000', 'Close'),
(653, 'Acumina', 'C-13', '13', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(654, 'Acumina', 'C-13', '14', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(655, 'Acumina', 'C-13', '15', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(656, 'Acumina', 'C-13', '16', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(657, 'Acumina', 'C-13', '17', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(658, 'Acumina', 'C-13', '18', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(659, 'Acumina', 'C-13', '19', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(660, 'Acumina', 'C-13', '20', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(661, 'Acumina', 'C-13', '21', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(662, 'Acumina', 'C-13', '22', '32', '64', '23', '87', '299.000.000', 'Close'),
(663, 'Acumina', 'C-14', '1', '32', '64', '23', '87', '299.000.000', 'Close'),
(664, 'Acumina', 'C-14', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(665, 'Acumina', 'C-14', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(666, 'Acumina', 'C-14', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(667, 'Acumina', 'C-14', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(668, 'Acumina', 'C-14', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(669, 'Acumina', 'C-14', '7', '32', '64', '33', '97', '299.000.000', 'Close'),
(670, 'Acumina', 'C-14', '8', '32', '64', '7', '71', '299.000.000', 'Close'),
(671, 'Acumina', 'C-14', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(672, 'Acumina', 'C-14', '10', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(673, 'Acumina', 'C-14', '11', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(674, 'Acumina', 'C-14', '12', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(675, 'Acumina', 'C-14', '13', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(676, 'Acumina', 'C-14', '14', '32', '64', '23', '87', '299.000.000', 'Close'),
(677, 'Acumina', 'C-15', '8', '32', '64', '121', '185', '299.000.000', 'Close'),
(678, 'Acumina', 'C-15', '9', '32', '64', '51', '115', '297.000.000', 'Close'),
(679, 'Acumina', 'C-15', '10', '32', '64', '89', '153', '299.000.000', 'Close'),
(680, 'Acumina', 'C-15', '11', '32', '64', '19', '83', '299.000.000', 'Close'),
(681, 'Acumina', 'C-15', '12', '32', '64', '16', '80', '297.000.000', 'Close'),
(682, 'Acumina', 'C-15', '13', '32', '64', '16', '80', '297.000.000', 'Close'),
(683, 'Acumina', 'C-15', '14', '32', '64', '16', '80', '297.000.000', 'Close'),
(684, 'Acumina', 'C-15', '15', '32', '64', '43', '107', '299.000.000', 'Close'),
(685, 'Acumina', 'C-15', '16', '32', '64', '113', '177', '299.000.000', 'Close'),
(686, 'Acumina', 'C-15', '17', '32', '64', '23', '87', '297.000.000', 'Close'),
(687, 'Acumina', 'C-15', '18', '32', '64', '35', '99', '299.000.000', 'Close'),
(688, 'Kocinea', 'D-1', '1', '32', '64', '23', '87', '296.500.000', 'Sold'),
(689, 'Kocinea', 'D-1', '2', '32', '64', ' -   ', '64', '269.000.000', 'Sold'),
(690, 'Kocinea', 'D-1', '3', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(691, 'Kocinea', 'D-1', '4', '32', '64', ' -   ', '64', '250.000.000', 'Sold'),
(692, 'Kocinea', 'D-1', '5', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(693, 'Kocinea', 'D-1', '6', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(694, 'Kocinea', 'D-1', '7', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(695, 'Kocinea', 'D-1', '8', '32', '64', ' -   ', '64', '247.000.000', 'Sold'),
(696, 'Kocinea', 'D-1', '9', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(697, 'Kocinea', 'D-1', '10', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(698, 'Kocinea', 'D-1', '11', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(699, 'Kocinea', 'D-1', '12', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(700, 'Kocinea', 'D-1', '13', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(701, 'Kocinea', 'D-1', '14', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(702, 'Kocinea', 'D-1', '15', '32', '64', '15', '79', '299.000.000', 'Available'),
(703, 'Kocinea', 'D-1', '16', '32', '64', '15', '79', '299.000.000', 'Available'),
(704, 'Kocinea', 'D-1', '17', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(705, 'Kocinea', 'D-1', '18', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(706, 'Kocinea', 'D-1', '19', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(707, 'Kocinea', 'D-1', '20', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(708, 'Kocinea', 'D-1', '21', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(709, 'Kocinea', 'D-1', '22', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(710, 'Kocinea', 'D-1', '23', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(711, 'Kocinea', 'D-1', '24', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(712, 'Kocinea', 'D-1', '25', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(713, 'Kocinea', 'D-1', '26', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(714, 'Kocinea', 'D-1', '27', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(715, 'Kocinea', 'D-1', '28', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(716, 'Kocinea', 'D-1', '29', '32', '64', ' -   ', '64', '269.000.000', 'Sold'),
(717, 'Kocinea', 'D-1', '30', '32', '64', '23', '87', '296.500.000', 'Sold'),
(718, 'Kocinea', 'D-2', '1', '32', '64', '23', '87', '295.900.000', 'Sold'),
(719, 'Kocinea', 'D-2', '2', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(720, 'Kocinea', 'D-2', '3', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(721, 'Kocinea', 'D-2', '4', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(722, 'Kocinea', 'D-2', '5', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(723, 'Kocinea', 'D-2', '6', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(724, 'Kocinea', 'D-2', '7', '32', '64', ' -   ', '64', '273.000.000', 'Sold'),
(725, 'Kocinea', 'D-2', '8', '32', '64', ' -   ', '64', '280.000.000', 'Sold'),
(726, 'Kocinea', 'D-2', '9', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(727, 'Kocinea', 'D-2', '10', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(728, 'Kocinea', 'D-2', '11', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(729, 'Kocinea', 'D-2', '12', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(730, 'Kocinea', 'D-2', '13', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(731, 'Kocinea', 'D-2', '14', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(732, 'Kocinea', 'D-2', '15', '32', '64', '15', '79', '299.000.000', 'Available'),
(733, 'Kocinea', 'D-2', '16', '32', '64', '15', '79', '299.000.000', 'Available'),
(734, 'Kocinea', 'D-2', '17', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(735, 'Kocinea', 'D-2', '18', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(736, 'Kocinea', 'D-2', '19', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(737, 'Kocinea', 'D-2', '20', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(738, 'Kocinea', 'D-2', '21', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(739, 'Kocinea', 'D-2', '22', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(740, 'Kocinea', 'D-2', '23', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(741, 'Kocinea', 'D-2', '24', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(742, 'Kocinea', 'D-2', '25', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(743, 'Kocinea', 'D-2', '26', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(744, 'Kocinea', 'D-2', '27', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(745, 'Kocinea', 'D-2', '28', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(746, 'Kocinea', 'D-2', '29', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(747, 'Kocinea', 'D-2', '30', '32', '64', '23', '87', '295.900.000', 'Sold'),
(748, 'Kocinea', 'D-3', '1', '32', '64', '23', '87', '309.500.000', 'Sold'),
(749, 'Kocinea', 'D-3', '2', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(750, 'Kocinea', 'D-3', '3', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(751, 'Kocinea', 'D-3', '4', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(752, 'Kocinea', 'D-3', '5', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(753, 'Kocinea', 'D-3', '6', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(754, 'Kocinea', 'D-3', '7', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(755, 'Kocinea', 'D-3', '8', '32', '64', ' -   ', '64', '269.000.000', 'Sold'),
(756, 'Kocinea', 'D-3', '9', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(757, 'Kocinea', 'D-3', '10', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(758, 'Kocinea', 'D-3', '11', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(759, 'Kocinea', 'D-3', '12', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(760, 'Kocinea', 'D-3', '13', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(761, 'Kocinea', 'D-3', '14', '32', '64', '75', '139', '299.000.000', 'Available'),
(762, 'Kocinea', 'D-3', '15', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(763, 'Kocinea', 'D-3', '16', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(764, 'Kocinea', 'D-3', '17', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(765, 'Kocinea', 'D-3', '18', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(766, 'Kocinea', 'D-3', '19', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(767, 'Kocinea', 'D-3', '20', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(768, 'Kocinea', 'D-3', '21', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(769, 'Kocinea', 'D-3', '22', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(770, 'Kocinea', 'D-3', '23', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(771, 'Kocinea', 'D-3', '24', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(772, 'Kocinea', 'D-3', '25', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(773, 'Kocinea', 'D-3', '26', '32', '64', ' -   ', '64', '280.000.000', 'Sold'),
(774, 'Kocinea', 'D-3', '27', '32', '64', '23', '87', '262.650.000', 'Sold'),
(775, 'Kocinea', 'D-4', '1', '32', '64', '23', '87', '262.650.000', 'Sold'),
(776, 'Kocinea', 'D-4', '2', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(777, 'Kocinea', 'D-4', '3', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(778, 'Kocinea', 'D-4', '4', '32', '64', ' -   ', '64', '230.000.000', 'Sold'),
(779, 'Kocinea', 'D-4', '5', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(780, 'Kocinea', 'D-4', '6', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(781, 'Kocinea', 'D-4', '7', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(782, 'Kocinea', 'D-4', '8', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(783, 'Kocinea', 'D-4', '9', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(784, 'Kocinea', 'D-4', '10', '32', '64', '19', '83', '256.650.000', 'Sold'),
(785, 'Kocinea', 'D-4', '11', '32', '64', '23', '87', '262.650.000', 'Sold'),
(786, 'Kocinea', 'D-4', '12', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(787, 'Kocinea', 'D-4', '13', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(788, 'Kocinea', 'D-4', '14', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(789, 'Kocinea', 'D-4', '15', '32', '64', ' -   ', '64', '242.000.000', 'Sold'),
(790, 'Kocinea', 'D-4', '16', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(791, 'Kocinea', 'D-4', '17', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(792, 'Kocinea', 'D-4', '18', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(793, 'Kocinea', 'D-4', '19', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(794, 'Kocinea', 'D-4', '20', '32', '64', '23', '87', '262.650.000', 'Sold'),
(795, 'Kocinea', 'D-5', '1', '32', '64', '23', '87', '266.500.000', 'Sold'),
(796, 'Kocinea', 'D-5', '2', '32', '64', ' -   ', '64', '245.000.000', 'Sold'),
(797, 'Kocinea', 'D-5', '3', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(798, 'Kocinea', 'D-5', '4', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(799, 'Kocinea', 'D-5', '5', '32', '64', '23', '87', '299.000.000', 'Available'),
(800, 'Kocinea', 'D-5', '6', '32', '64', ' -   ', '64', '230.000.000', 'Sold'),
(801, 'Kocinea', 'D-5', '7', '32', '64', ' -   ', '64', '230.000.000', 'Sold'),
(802, 'Kocinea', 'D-5', '8', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(803, 'Kocinea', 'D-5', '9', '32', '64', '60', '124', '347.000.000', 'Sold'),
(804, 'Kocinea', 'D-5', '10', '32', '64', '65', '129', '343.700.000', 'Sold'),
(805, 'Kocinea', 'D-6', '1', '32', '64', '23', '87', '235.500.000', 'Sold'),
(806, 'Kocinea', 'D-6', '2', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(807, 'Kocinea', 'D-6', '3', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(808, 'Kocinea', 'D-6', '4', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(809, 'Kocinea', 'D-6', '5', '32', '64', ' -   ', '64', '280.000.000', 'Sold'),
(810, 'Kocinea', 'D-6', '6', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(811, 'Kocinea', 'D-6', '7', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(812, 'Kocinea', 'D-6', '8', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(813, 'Kocinea', 'D-6', '9', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(814, 'Kocinea', 'D-6', '10', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(815, 'Kocinea', 'D-6', '11', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(816, 'Kocinea', 'D-6', '12', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(817, 'Kocinea', 'D-6', '13', '32', '64', '45', '109', '313.700.000', 'Sold'),
(818, 'Kocinea', 'D-6', '14', '32', '64', '19', '83', '299.000.000', 'Available'),
(819, 'Kocinea', 'D-6', '15', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(820, 'Kocinea', 'D-6', '16', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(821, 'Kocinea', 'D-6', '17', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(822, 'Kocinea', 'D-6', '18', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(823, 'Kocinea', 'D-6', '19', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(824, 'Kocinea', 'D-6', '20', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(825, 'Kocinea', 'D-6', '21', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(826, 'Kocinea', 'D-6', '22', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(827, 'Kocinea', 'D-6', '23', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(828, 'Kocinea', 'D-6', '24', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(829, 'Kocinea', 'D-6', '25', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(830, 'Kocinea', 'D-6', '26', '32', '64', ' -   ', '64', '280.000.000', 'Sold'),
(831, 'Kocinea', 'D-6', '27', '32', '64', '23', '87', '266.500.000', 'Sold'),
(832, 'Kocinea', 'D-7', '1', '32', '64', '57', '121', '331.700.000', 'Sold'),
(833, 'Kocinea', 'D-7', '2', '32', '64', '8', '72', '297.000.000', 'Available'),
(834, 'Kocinea', 'D-7', '3', '32', '64', '4', '68', '297.000.000', 'Available'),
(835, 'Kocinea', 'D-7', '4', '32', '64', '13', '77', '297.000.000', 'Available'),
(836, 'Kocinea', 'D-7', '5', '32', '64', '32', '96', '297.000.000', 'Available'),
(837, 'Kocinea', 'D-7', '6', '32', '64', '50', '114', '297.000.000', 'Available'),
(838, 'Kocinea', 'D-7', '7', '32', '64', '67', '131', '299.000.000', 'Available'),
(839, 'Kocinea', 'D-7', '8', '32', '64', '11', '75', '299.000.000', 'Available'),
(840, 'Kocinea', 'D-7', '9', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(841, 'Kocinea', 'D-7', '10', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(842, 'Kocinea', 'D-7', '11', '32', '64', '37', '101', '299.000.000', 'Available'),
(843, 'Kocinea', 'D-7', '12', '32', '64', '37', '101', '299.000.000', 'Available'),
(844, 'Kocinea', 'D-7', '13', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(845, 'Kocinea', 'D-7', '14', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(846, 'Kocinea', 'D-7', '15', '32', '64', '11', '75', '299.000.000', 'Available'),
(847, 'Kocinea', 'D-7', '16', '32', '64', '158', '222', '299.000.000', 'Available'),
(848, 'Kocinea', 'D-7', '17', '32', '64', '46', '110', '297.000.000', 'Available'),
(849, 'Kocinea', 'D-7', '18', '32', '64', '51', '115', '297.000.000', 'Available'),
(850, 'Kocinea', 'D-7', '19', '32', '64', '57', '121', '297.000.000', 'Available'),
(851, 'Kocinea', 'D-7', '20', '32', '64', '64', '128', '297.000.000', 'Available'),
(852, 'Kocinea', 'D-7', '21', '32', '64', '77', '141', '299.000.000', 'Available'),
(853, 'Kocinea', 'D-8', '1', '32', '64', '23', '87', '291.500.000', 'Sold'),
(854, 'Kocinea', 'D-8', '2', '32', '64', ' -   ', '64', '209.000.000', 'Sold'),
(855, 'Kocinea', 'D-8', '3', '32', '64', ' -   ', '64', '225.000.000', 'Sold'),
(856, 'Kocinea', 'D-8', '4', '32', '64', ' -   ', '64', '257.000.000', 'Sold'),
(857, 'Kocinea', 'D-8', '5', '32', '64', ' -   ', '64', '267.500.000', 'Sold'),
(858, 'Kocinea', 'D-8', '6', '32', '64', ' -   ', '64', '210.000.000', 'Sold'),
(859, 'Kocinea', 'D-8', '7', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(860, 'Kocinea', 'D-8', '8', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(861, 'Kocinea', 'D-8', '9', '32', '64', '23', '87', '262.650.000', 'Sold'),
(862, 'Kocinea', 'D-8', '10', '32', '64', '23', '87', '', 'Sold'),
(863, 'Kocinea', 'D-8', '11', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(864, 'Kocinea', 'D-8', '12', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(865, 'Kocinea', 'D-8', '13', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(866, 'Kocinea', 'D-8', '14', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(867, 'Kocinea', 'D-8', '15', '32', '64', ' -   ', '64', '225.000.000', 'Sold'),
(868, 'Kocinea', 'D-8', '16', '32', '64', ' -   ', '64', '273.000.000', 'Sold'),
(869, 'Kocinea', 'D-8', '17', '32', '64', ' -   ', '64', '244.000.000', 'Sold'),
(870, 'Kocinea', 'D-8', '18', '32', '64', '23', '87', '293.500.000', 'Sold'),
(871, 'Kocinea', 'D-9', '1', '32', '64', '23', '87', '266.250.000', 'Sold'),
(872, 'Kocinea', 'D-9', '2', '32', '64', ' -   ', '64', '251.000.000', 'Sold'),
(873, 'Kocinea', 'D-9', '3', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(874, 'Kocinea', 'D-9', '4', '32', '64', ' -   ', '64', '270.000.000', 'Sold'),
(875, 'Kocinea', 'D-9', '5', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(876, 'Kocinea', 'D-9', '6', '32', '64', '23', '87', '281.500.000', 'Sold'),
(877, 'Kocinea', 'D-9', '7', '32', '64', '23', '87', '295.900.000', 'Sold'),
(878, 'Kocinea', 'D-9', '8', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(879, 'Kocinea', 'D-9', '9', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(880, 'Kocinea', 'D-9', '10', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(881, 'Kocinea', 'D-9', '11', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(882, 'Kocinea', 'D-9', '12', '32', '64', '23', '87', '262.650.000', 'Sold'),
(883, 'Kocinea', 'D-10', '1', '32', '64', '23', '87', '278.500.000', 'Sold'),
(884, 'Kocinea', 'D-10', '2', '32', '64', ' -   ', '64', '231.000.000', 'Sold'),
(885, 'Kocinea', 'D-10', '3', '32', '64', ' -   ', '64', '248.100.000', 'Sold'),
(886, 'Kocinea', 'D-10', '4', '32', '64', ' -   ', '64', '235.000.000', 'Sold'),
(887, 'Kocinea', 'D-10', '5', '32', '64', ' -   ', '64', '249.000.000', 'Sold'),
(888, 'Kocinea', 'D-10', '6', '32', '64', '23', '87', '271.500.000', 'Sold'),
(889, 'Kocinea', 'D-10', '7', '32', '64', '23', '87', '266.500.000', 'Sold'),
(890, 'Kocinea', 'D-10', '8', '32', '64', ' -   ', '64', '230.000.000', 'Sold'),
(891, 'Kocinea', 'D-10', '9', '32', '64', ' -   ', '64', '230.000.000', 'Sold'),
(892, 'Kocinea', 'D-10', '10', '32', '64', ' -   ', '64', '230.000.000', 'Sold'),
(893, 'Kocinea', 'D-10', '11', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(894, 'Kocinea', 'D-10', '12', '32', '64', '23', '87', '277.000.000', 'Sold');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_perusahaan` int(250) NOT NULL,
  `id_jabatans` int(30) NOT NULL,
  `id_roles` int(250) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `cabang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mac_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` enum('pending','verified') COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `id_perusahaan`, `id_jabatans`, `id_roles`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `phone_number`, `is_active`, `cabang_id`, `mac_address`, `is_verified`, `updated_by`, `address`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'Admin', 'admin@localhost.com', NULL, '$2a$12$fyytii4AV3J8yzB5V4hWHOodVA0lGdkXr4z9wYUun7PwfzjgLIRra', NULL, '82114823280', 1, 1, '98-22-EF-29-EB-52', 'verified', NULL, 'Palmerah, Jakarta Barat', 'images/users/hgitp4V9MG5C6rQ.png', NULL, '2021-07-16 19:36:06', '2022-03-22 08:48:44'),
(2, 1, 2, 3, 'Muhammad Iqbal', 'iqbal@gmail.com', NULL, '$2y$10$Bx/omVY8XATNdGprMjfp.OpYTcV/2R.uQsBxKk6YGqYk/dZ2EjiU2', NULL, '082114823280', 1, 1, '98-22-EF-29-EB-52', 'verified', NULL, 'Tasikmalaya', 'images/users/LYjFsmL6jr5hYnP.jpg', NULL, '2022-03-07 02:41:50', '2022-03-22 06:37:18'),
(4, 1, 2, 4, 'Pandu', 'mrk.yazfi@gmail.com', NULL, '$2a$12$M3iPv1yM0bDm/4HAWq1FnOfxuHTHuRIfqyTwHj6rGxesHG78EEy1a', NULL, '82114823280', 1, 1, '98-22-EF-29-EB-52', 'verified', NULL, 'Jakarta', 'images/users/xabFCPG0OgGUoM2.jpg', NULL, '2021-08-14 01:57:36', '2022-03-22 06:51:32'),
(8, 1, 2, 7, 'Ridwanul Hakim', 'ridwan@gmail.com', NULL, '$2a$12$2lmr1cdCKJmedPcZeLe7UuhePw8dek2EfzeosH8xHwCrBuNNfqqIK', NULL, '0883475683645', 1, 1, '98-22-EF-29-EB-52', 'verified', NULL, 'Bandung', 'images/users/rTi7kOjdu33u9jp.jpg', NULL, '2021-08-25 07:08:23', '2022-03-22 06:43:49'),
(10, 1, 2, 8, 'hrd', 'hrd@test.com', NULL, '$2a$12$eMNtb1n9EX4bWgOz9k6JoOwM7AArixYDWYmJFu7m2cFwF0.OzIvD.', NULL, '980879', 1, 1, 'DC-53-60-02-84-01', 'verified', NULL, 'uhnjim', 'images/users/1DTA67QiTSv9EFv.jpg', NULL, '2021-10-07 04:00:59', '2021-10-07 04:01:21'),
(13, 1, 2, 9, 'zainuna', 'zainun@test.com', NULL, '$2a$12$TQNPWZ1c8cHaEU6YEUME0.CRt/4ikVc4p.3XUu4HGOvbr0DKnguDa', NULL, '0909800980', 1, 1, NULL, 'verified', NULL, 'sadsadsa', 'images/users/PlK5sRosBKNpYpp.png', NULL, '2022-02-09 04:27:10', '2022-02-09 04:27:27'),
(14, 1, 2, 10, 'salma', 'salma@gmail.com', NULL, '$2y$10$QVPsc21zrxh3Qee/1zaNoeu8h7LSZZAQPNXaA44G91RpafCN7fEly', NULL, '09090909', 1, 1, NULL, 'verified', NULL, 'qwqwq', 'images/users/nykVErTyUXXARxj.png', NULL, '2022-02-15 05:04:31', '2022-02-15 05:04:44');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cat_chart_of_account`
--
ALTER TABLE `cat_chart_of_account`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indeks untuk tabel `chart_of_account`
--
ALTER TABLE `chart_of_account`
  ADD PRIMARY KEY (`id_chart_of_account`),
  ADD KEY `child_numb` (`child_numb`),
  ADD KEY `status` (`status`),
  ADD KEY `kategori_gl` (`id_cat`);

--
-- Indeks untuk tabel `komisi`
--
ALTER TABLE `komisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembatalan_unit`
--
ALTER TABLE `pembatalan_unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spr` (`spr_id`),
  ADD KEY `no_pembatalan` (`no_pembatalan`);

--
-- Indeks untuk tabel `pembayaran_unit`
--
ALTER TABLE `pembayaran_unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rincian_id` (`rincian_id`);

--
-- Indeks untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `refund`
--
ALTER TABLE `refund`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembatalan_id` (`pembatalan_id`);

--
-- Indeks untuk tabel `rincian_tagihan_spr`
--
ALTER TABLE `rincian_tagihan_spr`
  ADD PRIMARY KEY (`id_rincian`),
  ADD KEY `id_spr` (`id_spr`);

--
-- Indeks untuk tabel `skema_pembayaran`
--
ALTER TABLE `skema_pembayaran`
  ADD PRIMARY KEY (`id_skema`);

--
-- Indeks untuk tabel `spr`
--
ALTER TABLE `spr`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_unit` (`id_unit`),
  ADD KEY `skema` (`skema`),
  ADD KEY `no_transaksi` (`no_transaksi`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_project` (`id_project`),
  ADD KEY `alamat_id` (`alamat_id`);

--
-- Indeks untuk tabel `unit_rumah`
--
ALTER TABLE `unit_rumah`
  ADD PRIMARY KEY (`id_unit_rumah`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `komisi`
--
ALTER TABLE `komisi`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembatalan_unit`
--
ALTER TABLE `pembatalan_unit`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pembayaran_unit`
--
ALTER TABLE `pembayaran_unit`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `refund`
--
ALTER TABLE `refund`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rincian_tagihan_spr`
--
ALTER TABLE `rincian_tagihan_spr`
  MODIFY `id_rincian` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `skema_pembayaran`
--
ALTER TABLE `skema_pembayaran`
  MODIFY `id_skema` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `spr`
--
ALTER TABLE `spr`
  MODIFY `id_transaksi` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembatalan_unit`
--
ALTER TABLE `pembatalan_unit`
  ADD CONSTRAINT `pembatalan_unit_ibfk_2` FOREIGN KEY (`spr_id`) REFERENCES `spr` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `pembayaran_unit`
--
ALTER TABLE `pembayaran_unit`
  ADD CONSTRAINT `pembayaran_unit_ibfk_1` FOREIGN KEY (`rincian_id`) REFERENCES `rincian_tagihan_spr` (`id_rincian`);

--
-- Ketidakleluasaan untuk tabel `refund`
--
ALTER TABLE `refund`
  ADD CONSTRAINT `refund_ibfk_1` FOREIGN KEY (`pembatalan_id`) REFERENCES `pembatalan_unit` (`id`);

--
-- Ketidakleluasaan untuk tabel `rincian_tagihan_spr`
--
ALTER TABLE `rincian_tagihan_spr`
  ADD CONSTRAINT `rincian_tagihan_spr_ibfk_1` FOREIGN KEY (`id_spr`) REFERENCES `spr` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `spr`
--
ALTER TABLE `spr`
  ADD CONSTRAINT `spr_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `unit_rumah` (`id_unit_rumah`),
  ADD CONSTRAINT `spr_ibfk_2` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `spr_ibfk_3` FOREIGN KEY (`alamat_id`) REFERENCES `alamat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
