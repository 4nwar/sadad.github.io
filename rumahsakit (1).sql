-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2021 pada 09.07
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumahsakit`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `level` int(11) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`level`, `keterangan`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `id_dokter` varchar(50) NOT NULL,
  `nama_dokter` varchar(80) NOT NULL,
  `spesialis` varchar(50) NOT NULL,
  `alamat` mediumtext NOT NULL DEFAULT '',
  `no_telp` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama_dokter`, `spesialis`, `alamat`, `no_telp`) VALUES
('de86a347-d1e8-4382-86db-af3a4ead681f', 'Taufik', 'Mata', 'Jakarta', '081654387569');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(200) DEFAULT NULL,
  `ket_obat` mediumtext DEFAULT '',
  `supplier` varchar(200) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `nama_obat`, `ket_obat`, `supplier`, `jumlah`, `satuan`) VALUES
(1, 'Wood', 'obat batuk', 'PT. Kalbe', 150, 'botol'),
(2, 'Enterostop', 'obat diare', 'PT. Kalbe', 70, 'kapsul'),
(3, 'komix', 'obat batuk', 'PT. Kalbe', 60, 'botol'),
(5, 'Afidal', 'Obat panas', 'PT Afiat', 100, 'botol'),
(6, 'Afidryl', 'Obat Batuk', 'PT Afiat', 100, 'botol'),
(7, 'Oskadon', 'Obat Sakit Kepala', 'PT Supra Ferbindo Farma', 80, 'botol'),
(8, 'Insto', 'Obat tetes mata', 'PT Supra Ferbindo Farma', 48, 'botol');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` varchar(50) NOT NULL,
  `nomor_identitas` varchar(30) NOT NULL,
  `nama_pasien` varchar(80) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` mediumtext DEFAULT '',
  `no_telp` varchar(15) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `nomor_identitas`, `nama_pasien`, `jenis_kelamin`, `alamat`, `no_telp`) VALUES
('d49619ce-46b7-4e4e-912c-226508b142bc', '202012347', 'Angga', 'L', 'Kudus', '0888123125'),
('a375507c-cab3-43b0-9c9d-22ba81f826d8', '202012345', 'M. Nur', 'L', 'Pati', '0888123123'),
('139951a8-f6f8-4765-bd14-038f8e291d1d', '202012346', 'Andhan', 'L', 'Kudus', '0888123124'),
('4707ceb7-419c-4041-b9fa-b8d799c528a6', '202012348', 'Tuyem', 'P', 'Kediri', '0888123126');

--
-- Trigger `tb_pasien`
--
DELIMITER $$
CREATE TRIGGER `tb_pasien_before_insert` BEFORE INSERT ON `tb_pasien` FOR EACH ROW BEGIN
	INSERT INTO tb_user (nama_user,id_user,username,password,level) VALUES (NEW.nama_pasien,NEW.id_pasien,NEW.nama_pasien,SHA1(NEW.nomor_identitas),2);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_poliklinik`
--

CREATE TABLE `tb_poliklinik` (
  `id_poli` varchar(50) NOT NULL,
  `nama_poli` varchar(50) DEFAULT NULL,
  `gedung` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_poliklinik`
--

INSERT INTO `tb_poliklinik` (`id_poli`, `nama_poli`, `gedung`) VALUES
('a76bbba0-3742-4389-bea6-96fd66c10830', 'Poli Mata', 'Gedung A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rekammedis`
--

CREATE TABLE `tb_rekammedis` (
  `id_rm` varchar(50) NOT NULL,
  `tgl_periksa` date DEFAULT NULL,
  `id_poli` varchar(50) NOT NULL,
  `id_pasien` varchar(50) NOT NULL,
  `keluhan` mediumtext DEFAULT '',
  `id_dokter` varchar(50) NOT NULL,
  `diagnosa` text DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rekammedis`
--

INSERT INTO `tb_rekammedis` (`id_rm`, `tgl_periksa`, `id_poli`, `id_pasien`, `keluhan`, `id_dokter`, `diagnosa`) VALUES
('0fc8a5ce-3450-4681-a493-7598f6b376e5', '2021-05-21', 'a76bbba0-3742-4389-bea6-96fd66c10830', 'a375507c-cab3-43b0-9c9d-22ba81f826d8', '<p>penglihatan kabur</p>\r\n', 'de86a347-d1e8-4382-86db-af3a4ead681f', 'Rabun'),
('ca680b25-97a3-4f51-b22e-8bfca4470246', '2021-05-27', 'a76bbba0-3742-4389-bea6-96fd66c10830', 'd49619ce-46b7-4e4e-912c-226508b142bc', '<p>Mata merah</p>\r\n', 'de86a347-d1e8-4382-86db-af3a4ead681f', 'Iritasi Mata');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rm_obat`
--

CREATE TABLE `tb_rm_obat` (
  `id` int(8) NOT NULL,
  `id_rm` varchar(50) DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rm_obat`
--

INSERT INTO `tb_rm_obat` (`id`, `id_rm`, `id_obat`) VALUES
(5, '0fc8a5ce-3450-4681-a493-7598f6b376e5', 8),
(4, 'ca680b25-97a3-4f51-b22e-8bfca4470246', 8);

--
-- Trigger `tb_rm_obat`
--
DELIMITER $$
CREATE TRIGGER `tb_rm_obat_before_insert` BEFORE INSERT ON `tb_rm_obat` FOR EACH ROW BEGIN
	UPDATE tb_obat SET jumlah = jumlah - 1 WHERE id_obat = NEW.id_obat;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id` int(11) DEFAULT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_satuan`
--

INSERT INTO `tb_satuan` (`id`, `satuan`) VALUES
(1, 'botol'),
(3, 'kapsul'),
(2, 'taplet');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `nama_perusahaan` varchar(200) NOT NULL,
  `alamat` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`nama_perusahaan`, `alamat`) VALUES
('PT Afiat', 'kediri, jawa Timur'),
('PT Supra Ferbindo Farma', 'Cikarang Selatan, Bekasi'),
('PT. Kalbe', 'Jakarta Utara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_update_obat`
--

CREATE TABLE `tb_update_obat` (
  `id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_update_obat`
--

INSERT INTO `tb_update_obat` (`id`, `tanggal`, `nama`, `jumlah`) VALUES
(NULL, '2021-05-23', 'Afidryl', 20);

--
-- Trigger `tb_update_obat`
--
DELIMITER $$
CREATE TRIGGER `tb_update_obat_before_insert` BEFORE INSERT ON `tb_update_obat` FOR EACH ROW BEGIN
	UPDATE tb_obat SET jumlah = jumlah + NEW.jumlah WHERE nama_obat = NEW.nama;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(50) NOT NULL,
  `nama_user` varchar(80) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
('139951a8-f6f8-4765-bd14-038f8e291d1d', 'Andhan', 'Andhan', '1a65271b86362ab6e102621f38281580f974a316', 2),
('4707ceb7-419c-4041-b9fa-b8d799c528a6', 'Tuyem', 'Tuyem', '524b39ade44675c2eb9f96b8263491a625078261', 2),
('a375507c-cab3-43b0-9c9d-22ba81f826d8', 'M. Nur', 'M. Nur', '1fb69cca8be8a421b919bf9059e99f2c06bd60e0', 2),
('d49619ce-46b7-4e4e-912c-226508b142bc', 'Angga', 'Angga', 'd3551a068c246017be8fdbe78e492afc5a6f0d4c', 2),
('d6c9337c-a8bb-11eb-a0fa-00ffd682aec5', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
('fa2242a4-ab74-11eb-bc23-00ffd682aec5', 'Nor Mohammad Anwar Sadad', 'sadad', '77d1fe4b880e2af0922e556392aa45953fc2a308', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level`);

--
-- Indeks untuk tabel `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `suplaier` (`supplier`),
  ADD KEY `satuan` (`satuan`);

--
-- Indeks untuk tabel `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD KEY `jenis_kelamin` (`jenis_kelamin`);

--
-- Indeks untuk tabel `tb_poliklinik`
--
ALTER TABLE `tb_poliklinik`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indeks untuk tabel `tb_rekammedis`
--
ALTER TABLE `tb_rekammedis`
  ADD PRIMARY KEY (`id_rm`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indeks untuk tabel `tb_rm_obat`
--
ALTER TABLE `tb_rm_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rm` (`id_rm`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`satuan`);

--
-- Indeks untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`nama_perusahaan`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `level` (`level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_rm_obat`
--
ALTER TABLE `tb_rm_obat`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD CONSTRAINT `FK_tb_obat_tb_satuan` FOREIGN KEY (`satuan`) REFERENCES `tb_satuan` (`satuan`),
  ADD CONSTRAINT `FK_tb_obat_tb_supplier` FOREIGN KEY (`supplier`) REFERENCES `tb_supplier` (`nama_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `FK_level` FOREIGN KEY (`level`) REFERENCES `level` (`level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
