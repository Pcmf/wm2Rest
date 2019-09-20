-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2019 at 09:56 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wm2`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `nome`, `descricao`) VALUES
(1, 'Restaurante', NULL),
(2, 'Tasca', NULL),
(3, 'Bar', NULL),
(4, 'Café', NULL),
(5, 'Cervejaria', NULL),
(6, 'Marisqueira', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `artigos`
--

CREATE TABLE `artigos` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `familia` int(11) NOT NULL,
  `descricao` varchar(1024) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artigos`
--

INSERT INTO `artigos` (`id`, `empresa`, `nome`, `familia`, `descricao`, `imagem`, `ativo`) VALUES
(1, 1, 'Artigo A', 1, 'descricao artigo A', NULL, 1),
(4, 1, 'Artigo B', 1, 'descricao artigo B', '', 1),
(5, 1, 'Artigo C', 3, 'descricao artigo C', 'xptg_C.jpg', 1),
(6, 1, 'Artigo D', 2, 'descricao artigo D', 'xptg_D.jpg', 1),
(7, 1, 'Artigo E', 2, 'descricao artigo E', 'xptg.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `destaques`
--

CREATE TABLE `destaques` (
  `empresa` int(11) NOT NULL,
  `artigo` int(11) NOT NULL,
  `nome` int(255) NOT NULL,
  `descricao` varchar(1024) NOT NULL,
  `posicao` int(11) NOT NULL,
  `horarios` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `localidade` varchar(150) DEFAULT NULL,
  `cpostal` varchar(10) DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `responsavel` int(11) DEFAULT NULL,
  `diasfuncionamento` varchar(255) DEFAULT NULL,
  `horario` varchar(255) DEFAULT NULL,
  `tipospagamento` varchar(255) DEFAULT NULL,
  `aberto` tinyint(1) NOT NULL DEFAULT 1,
  `descricao` varchar(512) DEFAULT NULL,
  `fotos` varchar(512) DEFAULT NULL,
  `outrasinfo` varchar(512) DEFAULT NULL,
  `contactos` varchar(512) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `hashcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`id`, `nome`, `area`, `rua`, `localidade`, `cpostal`, `longitude`, `latitude`, `responsavel`, `diasfuncionamento`, `horario`, `tipospagamento`, `aberto`, `descricao`, `fotos`, `outrasinfo`, `contactos`, `email`, `pass`, `token`, `hashcode`) VALUES
(1, 'Torralta', 1, 'Av. Zeferino', 'Penafiel', '4560-452', 0, 0, 2, '', '', '', 0, '', '', '', '', 'teste@email.com', 'xpto', NULL, NULL),
(2, 'Empresa B', 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'email.b@g.c', 'xptg_B', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `familias`
--

CREATE TABLE `familias` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `descricao` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `familias`
--

INSERT INTO `familias` (`id`, `empresa`, `nome`, `imagem`, `descricao`) VALUES
(1, 2, 'Carnes', 'img_famC.jpg', 'descricao familia C'),
(2, 1, 'Vinhos', 'img_famC.jpg', 'descricao familia C'),
(3, 1, 'Cervejas', 'img_famC.jpg', 'descricao familia C');

-- --------------------------------------------------------

--
-- Table structure for table `idiomas`
--

CREATE TABLE `idiomas` (
  `id` int(11) NOT NULL,
  `sigla` varchar(4) NOT NULL,
  `idioma` varchar(50) NOT NULL,
  `bandeira` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `empresa` int(11) NOT NULL,
  `familia` int(11) NOT NULL,
  `artigo` int(11) NOT NULL DEFAULT 0,
  `posicao` int(11) DEFAULT NULL,
  `preco` decimal(6,2) DEFAULT NULL,
  `promocao` int(11) DEFAULT NULL,
  `precopromo` decimal(6,2) DEFAULT NULL,
  `disponivel` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `promocoes`
--

CREATE TABLE `promocoes` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(1024) DEFAULT NULL,
  `imagem` varchar(255) NOT NULL,
  `diaspromo` varchar(255) DEFAULT NULL,
  `horariopromo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `responsaveis`
--

CREATE TABLE `responsaveis` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `telemovel` varchar(15) DEFAULT NULL,
  `horacontacto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `responsaveis`
--

INSERT INTO `responsaveis` (`id`, `nome`, `cargo`, `email`, `telefone`, `telemovel`, `horacontacto`) VALUES
(1, 'Responsavel A', 'Gerente', 'resp_a@g.c', '22332332', '9192929', ''),
(2, 'Responsavel B', 'Dono', 'resp_b@g.c', '234332332', '9692929', '12h 20h');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artigos`
--
ALTER TABLE `artigos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destaques`
--
ALTER TABLE `destaques`
  ADD PRIMARY KEY (`empresa`,`artigo`);

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`empresa`,`familia`,`artigo`);

--
-- Indexes for table `promocoes`
--
ALTER TABLE `promocoes`
  ADD PRIMARY KEY (`id`,`empresa`);

--
-- Indexes for table `responsaveis`
--
ALTER TABLE `responsaveis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `artigos`
--
ALTER TABLE `artigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `familias`
--
ALTER TABLE `familias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responsaveis`
--
ALTER TABLE `responsaveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
