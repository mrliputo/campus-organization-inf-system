-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2016 at 06:31 AM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siorg`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `nim` varchar(9) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `pic` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`nim`, `nama_anggota`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `password`, `pic`) VALUES
('admin', '', '', '', '1997-02-27', '', '', '21232f297a57a5a743894a0e4a801fc3', 0),
('f1e115001', 'Nofita Rahayu Ningsih', 'Perempuan', NULL, NULL, NULL, NULL, '61fb571c0b8bc1dd563553866b263325', 0),
('f1e115015', 'Yulia Oktaviani', 'Perempuan', 'Kota Jambi', '2016-11-05', 'Thehok', 'yulia@oktaviani.com', '03be66295cd7eb6cf6001c9181bb904d', 0),
('f1e115031', 'Soraya Mara Konita Tila', 'Perempuan', 'sungai bahar', '2016-09-25', 'Mendalo darat', 'ilasoraya@gmai.com', '13c585f34d6edd63f5f40abae1838735', 0),
('m1a115017', 'Norman Syarif', 'Laki-laki', 'Teluk Kiambang', '1997-02-27', 'Jl. Penerangan, No. 11, Kota Jambi', 'normansyarif@programmer.net', '23d1e10df85ef805b442a922b240ce25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_chat`
--

CREATE TABLE `tb_chat` (
  `nim` varchar(9) NOT NULL,
  `waktu_post_chat` datetime NOT NULL,
  `id_org` int(11) NOT NULL,
  `isi_chat` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

CREATE TABLE `tb_event` (
  `id_org` int(11) NOT NULL,
  `tanggal_event` datetime NOT NULL,
  `nama_event` varchar(100) NOT NULL,
  `tanggal_post_event` datetime NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `dresscode` varchar(100) NOT NULL,
  `ket_event` varchar(1000) DEFAULT NULL,
  `pic` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_info`
--

CREATE TABLE `tb_info` (
  `id_org` int(11) NOT NULL,
  `nama_info` varchar(100) NOT NULL,
  `tanggal_post_info` datetime NOT NULL,
  `isi_info` varchar(1000) NOT NULL,
  `pic` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_notif`
--

CREATE TABLE `tb_notif` (
  `id` int(11) NOT NULL,
  `nim` varchar(9) NOT NULL,
  `id_org` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `link` varchar(20) DEFAULT NULL,
  `time` datetime NOT NULL,
  `dibaca` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_organisasi`
--

CREATE TABLE `tb_organisasi` (
  `id_org` int(11) NOT NULL,
  `nama_org` varchar(50) NOT NULL,
  `kepanjangan_org` varchar(50) DEFAULT NULL,
  `ketua_org` varchar(50) DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `visi` varchar(500) DEFAULT NULL,
  `misi` varchar(1000) DEFAULT NULL,
  `pic` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_organisasi`
--

INSERT INTO `tb_organisasi` (`id_org`, `nama_org`, `kepanjangan_org`, `ketua_org`, `keterangan`, `visi`, `misi`, `pic`) VALUES
(1, 'BEM KBM UNJA', 'BEM Keluarga Besar Mahasiswa Universitas Jambi', 'Hardiyansyah', 'Badan Eksekutif Mahasiswa Universitas Jambi Kabinet Simponi, selanjutnya disingkat Bemunja adalah lembaga eksekutif tertinggi di tingkat pusat dalam kehidupan kemahasiswaan di seluruh kampus Universitas Jambi dan bertanggung jawab kepada MAM KBM UNJA serta seluruh mahasiswa Universitas Jambi.', 'Mahasiswa Universitas Jambi yang unggul dalam SDM (Sumber Daya Manusia).', '1. Mewujudkan mahasiswa Universitas Jambi yang spiritualitas, superioritas, dan berkualitas.<br>\r\n2. Melahirkan mahasiswa Universitas Jambi yang mempunyai daya saing dalam berbagai bidang baik di lokal, nasional, maupun internasional.<br>\r\n3. Membuayakan mahasiswa Universitas Jambi yang berjiwa kritis, positif, dan konstruktif melalui diskusi, dialog dan musyawarah.<br>\r\n4. Sebagai wadah penghubung bagi mahasiswa dengan pihak Rektorat dan Birokrasi<br>\r\n5. Membangun rasa kekeluargaan dan pesahabatan dalam Harmoni Universitas Jambi.', 1),
(2, 'EXIST', 'Excellent, Intellectual, and Smart Student', 'Rachmat Hidayat', 'UKM Riset dan Penalaran EXIST merupakan salah satu media atau tempat para mahasiswa Universitas Jambi untuk senantiasa mengeksistensikan dirinya menjadi seorang mahasiswa yang melaksanakan perannya menjadi seorang mahasiswa, yaitu menjadi agen of change, melaksanakan perannya sebagai seorang akademisi dan juga mengamalkan Tri Dharma Perguruan Tinggi.', 'Mencetak mahasiswa berprestasi di kancah nasional maupun internasional.', '1. Tempat mahasiswa universitas jambi untuk senantiasa mengeksistensikan dirinya menjadi seorang mahasiswa  yang melaksanakan perannya menjadi seorang mahasiswa, yaitu menjadi agent of change, melaksanakan perannya menjadi akademisi dan juga mengamalkan tri dharma perguruan tinggi<br>\r\n2. Mencetak anggota nya agar memiliki IPK lebih dari 3.00.', 1),
(3, 'UTMC', 'Unja Training Motivation Centre', 'Muhammad Harun Alrasyid', 'Unja Training Motivation Center merupakan UKM yang kompeten dalam bidang motivasi, ukm ini menjadikan mahasiswa sebagai seorang trainee muda yang memiliki kecakapan untuk memotivasi mahasiswa lainnya.', '<ol>\r\n<li>Membangun karakter Trainer bagi Mahasiswa Universitas Jambi</li>\r\n<li> Mengembangkan daya kreativitas Mahasiswa Universitas Jambi</li>\r\n</ol>', '<ol>\r\n<li>Melakukan pembinaan terhadap mahasiswa Universitas Jambi</li>\r\n<li>Membangun iklim yang kondusif untuk mengembangkan nilai-nilai agamis melalui acara training dan sejenisnya</li>\r\n<li>Mengadakan kegiatan-kegiatan yang menumbuhkan jiwa kreatif dalam diri mahasiswa.</li>\r\n</ol>', 1),
(4, 'LSI', 'Lingkaran Saintis Islam', 'Randi Maulana', 'Lingkaran Saintis Islam merupakan cabang unit dari UKM Rohis Ar-Rahman yang berbasis di Fakultas Sains dan Teknologi. LSI memiliki kegiatan-kegiatan yang memadukan islami dan ilmiah, sehingga menjadikan mahasiswa FST memiliki karakter seorang saintis yang berjiwa islami.', 'Mewujudkan lingkungan yang baik melalui pemahaman agama Islam di Fakultas Sains dan Teknologi.', '1. Memberikan wadah mahasiswa FST untuk memperdalam ilmu agama<br>\r\n2. Menjadi panutan mahasiswa FST dalam bidang agama<br>\r\n3. Menjadi wadah keterampilan mahasiswa FST dalam bakat dan minat yang mendukung prestasi akademik dan non akademik.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_request`
--

CREATE TABLE `tb_request` (
  `nim` varchar(9) NOT NULL,
  `id_org` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_status_anggota`
--

CREATE TABLE `tb_status_anggota` (
  `nim` varchar(9) NOT NULL,
  `id_org` int(11) NOT NULL,
  `status` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_status_anggota`
--

INSERT INTO `tb_status_anggota` (`nim`, `id_org`, `status`) VALUES
('f1e115015', 1, 'admin'),
('f1e115015', 2, 'user'),
('f1e115031', 1, 'user'),
('f1e115031', 2, 'user'),
('f1e115031', 4, 'user'),
('m1a115017', 2, 'admin'),
('m1a115017', 3, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `tb_chat`
--
ALTER TABLE `tb_chat`
  ADD PRIMARY KEY (`nim`,`waktu_post_chat`);

--
-- Indexes for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`id_org`,`tanggal_post_event`);

--
-- Indexes for table `tb_info`
--
ALTER TABLE `tb_info`
  ADD PRIMARY KEY (`id_org`,`tanggal_post_info`);

--
-- Indexes for table `tb_notif`
--
ALTER TABLE `tb_notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_organisasi`
--
ALTER TABLE `tb_organisasi`
  ADD PRIMARY KEY (`id_org`);

--
-- Indexes for table `tb_request`
--
ALTER TABLE `tb_request`
  ADD PRIMARY KEY (`nim`,`id_org`);

--
-- Indexes for table `tb_status_anggota`
--
ALTER TABLE `tb_status_anggota`
  ADD PRIMARY KEY (`nim`,`id_org`),
  ADD KEY `id_org` (`id_org`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_notif`
--
ALTER TABLE `tb_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
