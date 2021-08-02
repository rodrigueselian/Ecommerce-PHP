-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Dez-2019 às 09:08
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `shop`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `clicodig` int(11) NOT NULL,
  `procodig` int(11) NOT NULL,
  `qtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`clicodig`, `procodig`, `qtd`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `catcodig` int(11) NOT NULL,
  `catdescr` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`catcodig`, `catdescr`) VALUES
(1, 'RPG'),
(2, 'FPS'),
(3, 'Adventure');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `clicodig` int(11) NOT NULL,
  `clinome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cliemail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clisenha` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`clicodig`, `clinome`, `cliemail`, `clisenha`) VALUES
(1, 'Admin', 'admin@admin.com', 'senha'),
(2, 'Maria', 'maria', '123'),
(3, 'Elian', 'eee', '1234'),
(4, 'Japunes', 'corno', 'thomazio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE `compras` (
  `idcompra` int(11) NOT NULL,
  `clicodig` int(11) NOT NULL,
  `procodig` int(11) NOT NULL,
  `qtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `compras`
--

INSERT INTO `compras` (`idcompra`, `clicodig`, `procodig`, `qtd`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `procodig` int(11) NOT NULL,
  `pronome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `procateg` int(11) NOT NULL,
  `propreco` decimal(10,2) NOT NULL,
  `img` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'uploads/undefined.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`procodig`, `pronome`, `procateg`, `propreco`, `img`) VALUES
(1, 'Cyberpunk 2077', 2, '59.99', 'uploads/cyber.jpg'),
(55, 'Devil may cry 5', 1, '49.99', 'uploads/dmc5.jpg'),
(56, 'Battlefield V', 2, '19.99', 'uploads/bf5.jpg'),
(57, 'Dark Souls Remastered', 1, '29.99', 'uploads/dsr.jpg'),
(58, 'Grand Theft Auto 5', 1, '19.99', 'uploads/gtav.jpg'),
(59, 'Monster Hunter World', 1, '39.99', 'uploads/mhw.jpg'),
(60, 'The Wither 3: Wild Hunt', 1, '29.99', 'uploads/tw3.jpg'),
(61, 'Resident Evil 2', 1, '49.99', 'uploads/re2r.jpg'),
(62, 'Spider-Man', 3, '39.99', 'uploads/spm.jpg'),
(63, 'Red Dead Redemption 2', 1, '49.99', 'uploads/rdr2.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD KEY `clicodig` (`clicodig`),
  ADD KEY `procodig` (`procodig`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`catcodig`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`clicodig`),
  ADD UNIQUE KEY `unique` (`cliemail`);

--
-- Índices para tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idcompra`),
  ADD KEY `clicodig` (`clicodig`),
  ADD KEY `procodig` (`procodig`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`procodig`),
  ADD KEY `prodcat` (`procateg`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `catcodig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `clicodig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `idcompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `procodig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`clicodig`) REFERENCES `clientes` (`clicodig`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`procodig`) REFERENCES `produtos` (`procodig`);

--
-- Limitadores para a tabela `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`clicodig`) REFERENCES `clientes` (`clicodig`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`procodig`) REFERENCES `produtos` (`procodig`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `prodcat` FOREIGN KEY (`procateg`) REFERENCES `categorias` (`catcodig`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
