-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24-Jul-2018 às 00:17
-- Versão do servidor: 5.7.20-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `meupossante`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `abastecimentos`
--

CREATE TABLE IF NOT EXISTS `abastecimentos` (
  `idaba` int(11) NOT NULL AUTO_INCREMENT,
  `idveiculo` int(11) DEFAULT NULL,
  `idcomb` int(11) DEFAULT NULL,
  `idposto` int(11) DEFAULT NULL,
  `odoaba` int(11) DEFAULT NULL,
  `dataaba` date DEFAULT NULL,
  `valoraba` double(10,2) DEFAULT NULL,
  `precoaba` double(10,3) DEFAULT NULL,
  `litro` double(10,3) DEFAULT NULL,
  `cheio` tinyint(1) NOT NULL,
  PRIMARY KEY (`idaba`),
  KEY `idcomb` (`idcomb`),
  KEY `idveiculo` (`idveiculo`),
  KEY `idposto` (`idposto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Extraindo dados da tabela `abastecimentos`
--

INSERT INTO `abastecimentos` (`idaba`, `idveiculo`, `idcomb`, `idposto`, `odoaba`, `dataaba`, `valoraba`, `precoaba`, `litro`, `cheio`) VALUES
(6, 3, 1, 5, 54477, '2018-05-19', 37.07, 4.695, 7.896, 1),
(7, 3, 1, 5, 54366, '2018-05-14', 20.00, 4.590, 4.357, 0),
(8, 3, 1, 5, 54204, '2018-05-05', 20.00, 4.499, 4.445, 0),
(9, 3, 1, 4, 54040, '2018-04-25', 20.00, 4.549, 4.397, 0),
(10, 3, 1, 5, 53714, '2018-04-06', 41.46, 4.499, 9.215, 1),
(11, 3, 1, 31, 53376, '2018-03-18', 38.45, 4.339, 8.861, 1),
(12, 3, 1, 31, 53054, '2018-02-26', 40.49, 4.439, 9.121, 1),
(13, 7, 1, 31, 102881, '2018-05-20', 127.08, 4.579, 27.753, 1),
(14, 7, 1, 5, 102699, '2018-04-17', 140.00, 4.499, 31.118, 1),
(15, 7, 1, 27, 102617, '2018-04-08', 20.00, 4.377, 4.569, 0),
(16, 7, 1, 31, 102551, '2018-03-31', 50.00, 4.399, 11.366, 0),
(17, 7, 1, 31, 102486, '2018-03-25', 100.00, 4.399, 22.732, 0),
(19, 7, 1, 31, 102362, '2018-03-10', 50.00, 4.440, 11.261, 0),
(20, 7, 1, 31, 102235, '2018-02-18', 100.00, 4.340, 23.041, 0),
(21, 7, 1, 4, 102220, '2018-02-18', 30.00, 4.480, 6.696, 0),
(22, 3, 1, 4, 54791, '2018-06-12', 44.04, 4.799, 9.177, 1),
(30, 12, 1, 41, 3, '2018-07-24', 3.00, 3.000, 1.000, 0),
(32, 10, 1, 20, 1, '0001-01-11', 0.00, 0.001, 0.001, 0),
(33, 7, 1, 1, 103098, '2018-07-19', 10.00, 4.699, 2.128, 0),
(34, 10, 2, 2, 12, '2018-07-19', 1.00, 2.800, 0.357, 0),
(35, 10, 3, 11, 15, '2018-06-28', 1.00, 3.499, 0.286, 0),
(36, 3, 1, 31, 55108, '2018-07-01', 41.51, 4.657, 8.913, 1),
(37, 7, 1, 4, 103100, '2018-07-21', 170.00, 4.797, 35.439, 1),
(38, 3, 1, 31, 55423, '2018-07-22', 41.40, 4.657, 8.890, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `combustiveis`
--

CREATE TABLE IF NOT EXISTS `combustiveis` (
  `idcomb` int(11) NOT NULL AUTO_INCREMENT,
  `tipocomb` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idcomb`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `combustiveis`
--

INSERT INTO `combustiveis` (`idcomb`, `tipocomb`) VALUES
(1, 'Gasolina'),
(2, 'Álcool'),
(3, 'Diesel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE IF NOT EXISTS `despesas` (
  `iddesp` int(11) NOT NULL AUTO_INCREMENT,
  `idveiculo` int(11) DEFAULT NULL,
  `ododesp` int(11) DEFAULT NULL,
  `valordesp` double(10,2) DEFAULT NULL,
  `datadesp` date DEFAULT NULL,
  `descdesp` varchar(255) DEFAULT NULL,
  `localdesp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`iddesp`),
  KEY `idveiculo` (`idveiculo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`iddesp`, `idveiculo`, `ododesp`, `valordesp`, `datadesp`, `descdesp`, `localdesp`) VALUES
(3, 3, 53948, 95.02, '2018-04-19', 'Licenciamento', 'Estado de Minas'),
(4, 3, 52454, 63.61, '2018-01-15', 'IPVA', 'Estado de Minas'),
(5, 3, 52454, 185.50, '2018-01-15', 'DPVAT', 'Estado de Minas'),
(6, 7, 102702, 85.20, '2018-04-19', 'IPVA parcela 3', 'Estado de Minas'),
(7, 7, 102702, 85.20, '2018-04-19', 'IPVA parcela 2', 'Estado de Minas'),
(8, 7, 102702, 95.02, '2018-04-19', 'Licenciamento', 'Estado de Minas'),
(9, 7, 102702, 45.72, '2018-01-15', 'Dpvat', 'Estado de Minas'),
(10, 7, 102702, 85.20, '2018-01-15', 'IPVA parcela 1', 'Estado de Minas'),
(14, 10, 9, 9.00, '2018-07-03', '9', '9'),
(15, 10, 1431, 2411.97, '2018-07-17', 'assdfa', 'asdfasf'),
(16, 10, 1234, 1243.00, '2015-12-15', '14123', '23414'),
(17, 10, 123, 321.00, '1984-05-30', 'testando', 'casa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lembretes`
--

CREATE TABLE IF NOT EXISTS `lembretes` (
  `idlemb` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `idveiculo` int(11) NOT NULL,
  `odolemb` int(11) DEFAULT NULL,
  `datalemb` date DEFAULT NULL,
  `desclemb` varchar(255) DEFAULT NULL,
  `tipolemb` tinyint(1) NOT NULL,
  PRIMARY KEY (`idlemb`),
  KEY `idveiculo` (`idveiculo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `lembretes`
--

INSERT INTO `lembretes` (`idlemb`, `idusuario`, `idveiculo`, `odolemb`, `datalemb`, `desclemb`, `tipolemb`) VALUES
(14, 1, 3, 56347, '2018-07-12', 'troca de oleo', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencoes`
--

CREATE TABLE IF NOT EXISTS `manutencoes` (
  `idmanu` int(11) NOT NULL AUTO_INCREMENT,
  `idveiculo` int(11) DEFAULT NULL,
  `odomanu` int(11) DEFAULT NULL,
  `valormanu` double(10,2) DEFAULT NULL,
  `datamanu` date DEFAULT NULL,
  `descmanu` varchar(255) DEFAULT NULL,
  `localmanu` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idmanu`),
  KEY `idveiculo` (`idveiculo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `manutencoes`
--

INSERT INTO `manutencoes` (`idmanu`, `idveiculo`, `odomanu`, `valormanu`, `datamanu`, `descmanu`, `localmanu`) VALUES
(5, 3, 54215, 17.00, '2018-05-07', 'troca de óleo', 'Fúria Motos'),
(6, 3, 53248, 17.00, '2018-03-08', 'Troca de óleo', 'Fúria Motos'),
(7, 3, 53751, 65.00, '2018-04-10', 'Troca da chave da seta', 'Fúria Motos'),
(8, 7, 102002, 720.00, '2018-01-20', 'Revisão geral', 'Mecânica do jader'),
(10, 3, 55347, 17.00, '2018-07-12', 'Troca de óleo', 'Fúria Motos'),
(12, 10, 123423455, 12345678.00, '2018-07-03', 'ver se muda', '1'),
(16, 10, 4, 4.00, '0004-04-04', '4', '4'),
(18, 10, 6, 6.00, '0006-06-06', '6', '6'),
(19, 10, 99, 999.00, '0009-09-09', '999', '999'),
(21, 7, 103098, 770.00, '2018-07-19', 'revisão', 'mecânica Morais');

-- --------------------------------------------------------

--
-- Estrutura da tabela `postos`
--

CREATE TABLE IF NOT EXISTS `postos` (
  `idposto` int(11) NOT NULL AUTO_INCREMENT,
  `nomeposto` varchar(50) DEFAULT NULL,
  `lat` double(10,6) DEFAULT NULL,
  `lon` double(10,6) DEFAULT NULL,
  PRIMARY KEY (`idposto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Extraindo dados da tabela `postos`
--

INSERT INTO `postos` (`idposto`, `nomeposto`, `lat`, `lon`) VALUES
(1, 'Auto Posto Nações', -20.156486, -44.861097),
(2, 'Auto Posto Interlagos', -20.157195, -44.875448),
(3, 'Posto Minas Gerais - Ale', -20.149585, -44.879349),
(4, 'Posto Serve Bem - Ipiranga', -20.149741, -44.879785),
(5, 'Posto Vem Car - Petrobras', -20.147345, -44.887209),
(6, 'Posto Xavante', -20.144997, -44.886780),
(7, 'Posto Avenida', -20.143225, -44.885692),
(8, 'Posto Divinópolis - Petrobras', -20.140382, -44.882219),
(9, 'Posto DP', -20.141436, -44.886297),
(10, 'Posto de Combustível Vila Cruzeiro - Ipiranga', -20.137154, -44.889937),
(11, 'Auto Posto Mato Grosso', -20.143375, -44.895184),
(12, 'Premium Com de Comb Ltda - Shell', -20.144412, -44.895748),
(13, 'Posto Mourão - Ale', -20.141912, -44.898751),
(14, 'Posto Sete - Petrobras', -20.140610, -44.906447),
(15, 'Posto as Mesquitas - Petrobras', -20.136205, -44.908385),
(16, 'Lavauto União Ltda - Ipiranga', -20.149380, -44.901305),
(17, 'Auto Posto Olinda', -20.153727, -44.902973),
(18, 'Auto Posto Catalão', -20.163703, -44.906607),
(19, 'Auto Posto Marreco', -20.167117, -44.908051),
(20, 'Auto Posto Autorama', -20.167117, -44.908051),
(21, 'Posto Santo Antônio', -20.103115, -44.972779),
(22, 'Auto Posto Peçanha - SAP', -20.140472, -44.877867),
(23, 'DP Auto Posto', -20.140333, -44.877176),
(24, 'Posto Tigrão', -20.135935, -44.873519),
(25, 'Posto Bitelão - Petrobras', -20.115593, -44.855630),
(26, 'Posto Nicodemos', -20.113592, -44.852409),
(27, 'Posto Soberano - Petrobras', -20.144835, -44.897914),
(28, 'Posto Valadão - Ipiranga', -20.128881, -44.876733),
(29, 'Posto ABC', -20.114100, -44.880035),
(30, 'Posto Marcal', -20.165281, -44.932603),
(31, 'Prime Auto Posto - Ipiranga', -20.130231, -44.882739),
(32, 'Posto Santa Clara - Petrobras', -20.129967, -44.887019),
(33, 'Auto Posto Três Bandeiras', -20.122717, -44.884277),
(34, 'P Lava Jato Ltda - Ipiranga', -20.120974, -44.883633),
(35, 'Master Auto Posto Ltda - Petrobras', -20.119795, -44.883526),
(36, 'Posto Aeroporto - Ipiranga', -20.164976, -44.877991),
(37, 'Posto Gentil Divinópolis Alvorada', -20.114667, -44.894956),
(38, 'Posto Prata - Ipiranga', -20.135772, -44.915464),
(39, 'DP Auto Posto Ltda - Epp', -20.175111, -44.919692),
(40, 'Posto Sidil - Ale', -20.140506, -44.892368),
(41, 'Outro', 0.000000, 0.000000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `sobrenome` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `nomeusuario` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nome`, `sobrenome`, `username`, `senha`) VALUES
(1, 'Leonardo', 'Barbosa', 'LEO', '202cb962ac59075b964b07152d234b70'),
(97, 'a', 'a', 'A', '0cc175b9c0f1b6a831c399e269772661'),
(99, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e'),
(100, 'tcc', 'tcc', 'tcc', 'a');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE IF NOT EXISTS `veiculos` (
  `idveiculo` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `placa` varchar(7) DEFAULT NULL,
  `odoini` int(11) DEFAULT NULL,
  `tipocomb` varchar(20) NOT NULL,
  `tanque` double DEFAULT NULL,
  PRIMARY KEY (`idveiculo`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`idveiculo`, `idusuario`, `placa`, `odoini`, `tipocomb`, `tanque`) VALUES
(3, 1, 'GYN5681', 53054, 'gasolina', 10.6),
(7, 1, 'GWM1248', 102257, 'Gasolina', 42),
(10, 1, '111', 111, '1111', 1111),
(11, 1, 'HAH0887', 38000, 'gasolina', 12),
(12, 97, 'AAA9999', 0, 'flex', 60),
(14, 100, 'A', 1, 'a', 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `abastecimentos`
--
ALTER TABLE `abastecimentos`
  ADD CONSTRAINT `abastecimentos_ibfk_1` FOREIGN KEY (`idcomb`) REFERENCES `combustiveis` (`idcomb`),
  ADD CONSTRAINT `abastecimentos_ibfk_2` FOREIGN KEY (`idveiculo`) REFERENCES `veiculos` (`idveiculo`),
  ADD CONSTRAINT `abastecimentos_ibfk_3` FOREIGN KEY (`idposto`) REFERENCES `postos` (`idposto`);

--
-- Limitadores para a tabela `despesas`
--
ALTER TABLE `despesas`
  ADD CONSTRAINT `despesas_ibfk_1` FOREIGN KEY (`idveiculo`) REFERENCES `veiculos` (`idveiculo`);

--
-- Limitadores para a tabela `lembretes`
--
ALTER TABLE `lembretes`
  ADD CONSTRAINT `lembretes_ibfk_1` FOREIGN KEY (`idveiculo`) REFERENCES `veiculos` (`idveiculo`);

--
-- Limitadores para a tabela `manutencoes`
--
ALTER TABLE `manutencoes`
  ADD CONSTRAINT `manutencoes_ibfk_1` FOREIGN KEY (`idveiculo`) REFERENCES `veiculos` (`idveiculo`);

--
-- Limitadores para a tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD CONSTRAINT `veiculos_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
