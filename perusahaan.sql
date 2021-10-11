-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2018 at 12:01 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `perusahaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `formulir_pp`
--

CREATE TABLE IF NOT EXISTS `formulir_pp` (
`no_formulir` int(11) NOT NULL,
  `nama_direktur` varchar(30) NOT NULL,
  `penanggung_jwb` varchar(30) NOT NULL,
  `tmp_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `npwp` varchar(25) NOT NULL,
  `kewarganegaraan` varchar(30) NOT NULL,
  `no_telp_direktur` varchar(20) NOT NULL,
  `nama_perusahaan` varchar(40) NOT NULL,
  `alamat_perusahaan` text NOT NULL,
  `perusahaan` varchar(50) NOT NULL,
  `email_perusahaan` varchar(30) NOT NULL,
  `no_telp_perusahaan` varchar(20) NOT NULL,
  `modal_dasar` double NOT NULL,
  `modal_ditempatkan` double NOT NULL,
  `bidang_usaha` varchar(30) NOT NULL,
  `kegiatan_usaha` varchar(30) NOT NULL,
  `komposisi_saham` varchar(70) NOT NULL,
  `direktur_perusahaan` varchar(30) NOT NULL,
  `wakil_direktur` varchar(30) NOT NULL,
  `komisaris1` varchar(30) NOT NULL,
  `komisaris2` varchar(30) NOT NULL,
  `gambar1` varchar(50) NOT NULL,
  `id_user` int(5) NOT NULL,
  `status_bayar` varchar(30) DEFAULT 'Belum Bayar',
  `status_berkas` varchar(30) DEFAULT 'Submit'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `formulir_pp`
--

INSERT INTO `formulir_pp` (`no_formulir`, `nama_direktur`, `penanggung_jwb`, `tmp_lahir`, `tgl_lahir`, `alamat`, `pekerjaan`, `nik`, `npwp`, `kewarganegaraan`, `no_telp_direktur`, `nama_perusahaan`, `alamat_perusahaan`, `perusahaan`, `email_perusahaan`, `no_telp_perusahaan`, `modal_dasar`, `modal_ditempatkan`, `bidang_usaha`, `kegiatan_usaha`, `komposisi_saham`, `direktur_perusahaan`, `wakil_direktur`, `komisaris1`, `komisaris2`, `gambar1`, `id_user`, `status_bayar`, `status_berkas`) VALUES
(1, 'sirius', 'sirius', 'sirius', '2018-08-02', 'sirius', 'sirius', 'sirius', 'sirius', 'sirius', 'sirius', 'sirius', 'sirius', 'sirius', 'sirius@gmail.com', 'sirius', 12345678, 132456, 'sirius', '', '', '', '', '', '', '', 1, 'bayar dp', 'proses'),
(2, 'CobaDone', 'Coba', 'Coba', '2018-08-09', 'Coba', 'Coba', 'Coba', 'Coba', 'Coba', 'Coba', 'Coba', 'Coba', 'Coba', 'sirius@gmail.com', 'Coba', 1234567890, 1234567890, 'Coba', '', 'Coba', 'Coba', 'Coba', 'Coba', 'Coba', '', 1, 'lunas', 'selesai'),
(4, 'reni', 'Coba', 'Coba', '2018-08-09', 'Coba', 'Coba', 'Coba', 'Coba', 'Coba', 'Coba', 'Coba', 'Coba', 'Coba', 'sirius@gmail.com', 'Coba', 1234567890, 1234567890, 'Coba', '', 'Coba', 'Coba', 'Coba', 'Coba', 'Coba', '', 2, 'Belum Bayar', 'Submit'),
(5, 'tugas', 'pak tugas', 'Jakarta Timur', '1980-10-15', 'Perum Mustika kalianda1 Blok H10 No 35', 'ada deeh', '158587', '87787', 'WNI', '8587885', 'PT Maju Mundur', 'Jakarta', 'MAJu terus', 'ete@dhgd.com', '85858', 800000, 800000, 'Jasa', 'banyak', '18%', 'uya', 'kuya ', 'cinta', 'kuya', '', 2, 'Belum Bayar', 'Submit'),
(6, 'tes 2', 'pak tugas', 'Jakarta Timur', '1987-10-15', 'Perum Mustika Grande Blok H10 No 35', 'ada deeh', '158587', '131', 'WNI', '8587885', 'PT Maju Mundur', 'fd', 'MAJu terus', 'ete@dhgd.com', 'gdgdg', 600000, 600000, 'Jasa', 'banyak', '18%', 'uya', 'kuya ', 'cinta', 'kuya', '', 2, 'Belum Bayar', 'Submit'),
(7, 'tes 3', 'pak tugas2', 'Jakarta Timur', '1990-05-14', 'Perum Mustika Grande Blok H10 No 35', 'ada deeh', '158587', '131', 'WNI', '8587885', 'PT Maju Mundur', 'ddgd', 'MAJu terus', 'ete@dhgd.com', 'gdgdg', 21000, 21000, 'Jasa', 'banyak', '80-20', 'uya', 'kuya ', 'cinta', 'kuya', 'penjualan.jpg', 2, 'Belum Bayar', 'Submit');

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE IF NOT EXISTS `sertifikat` (
`id_sertikikat` int(11) NOT NULL,
  `nama_penjual` varchar(50) NOT NULL,
  `tempat_lahir_penjual` varchar(30) NOT NULL,
  `tgl_lahir_penjual` date NOT NULL,
  `alamat_penjual` varchar(100) NOT NULL,
  `pekerjaan_penjual` varchar(30) NOT NULL,
  `nik_penjual` varchar(25) NOT NULL,
  `npwp_penjual` varchar(25) NOT NULL,
  `nama_pasangan_penjual` varchar(30) NOT NULL,
  `tmp_lahir_pasangan` varchar(30) NOT NULL,
  `tgl_lahir_pasangan` date NOT NULL,
  `alamat_pasangan` varchar(100) NOT NULL,
  `pekerjaan_pasangan` varchar(30) NOT NULL,
  `nik_pasangan` varchar(25) NOT NULL,
  `npwp_pasangan` varchar(25) NOT NULL,
  `no_sertifikat` varchar(25) NOT NULL,
  `no_surat_ukur` varchar(25) NOT NULL,
  `luas_tanah` varchar(5) NOT NULL,
  `luas_bangunan` varchar(5) NOT NULL,
  `tgl_surat_ukur` date NOT NULL,
  `no_id_bdg_tnh` varchar(30) NOT NULL,
  `alamat_objek` varchar(100) NOT NULL,
  `no_objek_pajak` varchar(30) NOT NULL,
  `harga_transaksi` double NOT NULL,
  `id_user` int(5) NOT NULL,
  `status_bayar` varchar(20) DEFAULT 'Belum Bayar',
  `status_berkas` varchar(20) DEFAULT 'Submit'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sertifikat`
--

INSERT INTO `sertifikat` (`id_sertikikat`, `nama_penjual`, `tempat_lahir_penjual`, `tgl_lahir_penjual`, `alamat_penjual`, `pekerjaan_penjual`, `nik_penjual`, `npwp_penjual`, `nama_pasangan_penjual`, `tmp_lahir_pasangan`, `tgl_lahir_pasangan`, `alamat_pasangan`, `pekerjaan_pasangan`, `nik_pasangan`, `npwp_pasangan`, `no_sertifikat`, `no_surat_ukur`, `luas_tanah`, `luas_bangunan`, `tgl_surat_ukur`, `no_id_bdg_tnh`, `alamat_objek`, `no_objek_pajak`, `harga_transaksi`, `id_user`, `status_bayar`, `status_berkas`) VALUES
(2, 'asd', 'asd', '0000-00-00', 'asd', 'asd', 'asd', 'asd', 'ads', 'asd', '0000-00-00', 'ads', 'asd', 'asd', 'ad', 'as', 'as', 'asd', 'asd', '0000-00-00', 'asd', 'asd', 'asd', 5000000, 1, 'Bayar Dp', 'Proses'),
(3, 'SiriusDone', 'Milkyway', '2018-08-01', 'jl.asb', 'gajelas', '20xxz', 'asd2e', 'asdf', 'asdsa', '2018-08-08', 'asd', 'asd', 'asda', 'asda', 'sda', 'sada', '20000', '20000', '2018-08-22', '20dfda', 'asda', 'asda', 100000, 2, 'Lunas', 'Selesai'),
(4, 'daniel', 'semarang', '1990-05-10', 'semaranf', 'kuli', '676767', '8886', 'sulastri', 'jakarta', '1990-05-10', 'hahaj', 'hahah', 'jahah', 'jhahah', 'ahhah', 'kaha', '100', '100', '2018-05-10', '089800', 'grabd', '9707', 900000, 2, 'Belum Bayar', 'Submit');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `password`, `email`, `no_telp`, `jabatan`) VALUES
(1, 'user', 'user', '827ccb0eea8a706c4c34a16891f84e7b', 'user@gmail.com', '085621218871', 'user'),
(2, 'userreni', 'reni', '827ccb0eea8a706c4c34a16891f84e7b', 'user@gmail.com', '085621218871', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `formulir_pp`
--
ALTER TABLE `formulir_pp`
 ADD PRIMARY KEY (`no_formulir`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
 ADD PRIMARY KEY (`id_sertikikat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `formulir_pp`
--
ALTER TABLE `formulir_pp`
MODIFY `no_formulir` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
MODIFY `id_sertikikat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
