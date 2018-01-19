-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Jan 2018 pada 16.39
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_pro`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_login`
--

CREATE TABLE IF NOT EXISTS `tb_login` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `tb_login`
--

INSERT INTO `tb_login` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(3, 'abcd', '912ec803b2ce49e4a541068d495ab570', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_parkir`
--

CREATE TABLE IF NOT EXISTS `tb_parkir` (
`id_parkir` int(11) NOT NULL,
  `nomor_plat` varchar(10) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `img` text NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `tb_parkir`
--

INSERT INTO `tb_parkir` (`id_parkir`, `nomor_plat`, `rate`, `img`, `waktu`) VALUES
(1, '', '', 'uploads/19012018_092840.jpg', '2018-01-19 10:28:45'),
(2, '', '', 'uploads/19012018_093020.jpg', '2018-01-19 10:30:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
`user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_address` text NOT NULL,
  `user_phone` varchar(12) NOT NULL,
  `user_image` text NOT NULL,
  `user_plate_number` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_name`, `user_email`, `user_address`, `user_phone`, `user_image`, `user_plate_number`, `status`) VALUES
(1, 'hardi', 'hardi@gmail.com', 'jakarta', '123456678', './assets/img/30557.jpg', 'Bds23asx', 1),
(2, 'unch', 'unch@unch.com', 'unch', '12735967', './assets/img/7476.jpg', 'unch123', 1),
(3, 'uahh', 'uaahh@gmail.com', 'uahh', '127359', './assets/img/30586.png', 'uah123', 1),
(4, 'iaaahhasdasd', 'iaah@iahh.comasdasd', 'iaahhasdasd', '123123123', './assets/img/18341.jpg', 'iaah123asd', 0),
(5, 'iaaahh', 'asdasd@asdas', 'asdasd', '123123', './assets/img/22191.jpg', 'asd2d12', 0),
(6, 'asdas', 'asdasd@asdas', 'asdasd', '123123', './assets/img/28050.png', 'asdasd', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_parkir`
--
ALTER TABLE `tb_parkir`
 ADD PRIMARY KEY (`id_parkir`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_parkir`
--
ALTER TABLE `tb_parkir`
MODIFY `id_parkir` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
