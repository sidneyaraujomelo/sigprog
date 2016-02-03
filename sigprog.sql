-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03-Fev-2016 às 18:05
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sigprog`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `fk_professor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin`
--

INSERT INTO `tb_admin` (`fk_professor`) VALUES
(12345678);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_classificacao`
--

CREATE TABLE IF NOT EXISTS `tb_classificacao` (
`id_classificacao` int(11) NOT NULL,
  `nome_classificacao` varchar(50) NOT NULL,
  `fk_tipoclassificacao` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_classificacao`
--

INSERT INTO `tb_classificacao` (`id_classificacao`, `nome_classificacao`, `fk_tipoclassificacao`) VALUES
(1, 'Unidade', 1),
(2, 'Unidade', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_departamento`
--

CREATE TABLE IF NOT EXISTS `tb_departamento` (
`id_depto` int(11) NOT NULL,
  `nome_depto` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_departamento`
--

INSERT INTO `tb_departamento` (`id_depto`, `nome_depto`) VALUES
(1, 'DEINF'),
(2, 'DEMAT');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_eixo`
--

CREATE TABLE IF NOT EXISTS `tb_eixo` (
`id_eixo` int(11) NOT NULL,
  `nome_eixo` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_eixo`
--

INSERT INTO `tb_eixo` (`id_eixo`, `nome_eixo`) VALUES
(8, 'Ensino'),
(11, 'Orientação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_item`
--

CREATE TABLE IF NOT EXISTS `tb_item` (
`id_item` int(11) NOT NULL,
  `nome_item` text CHARACTER SET utf8 NOT NULL,
  `pontmax_item` int(11) DEFAULT NULL,
  `quantmax_item` int(11) DEFAULT NULL,
  `fk_item` int(11) DEFAULT NULL,
  `fk_subeixo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_item`
--

INSERT INTO `tb_item` (`id_item`, `nome_item`, `pontmax_item`, `quantmax_item`, `fk_item`, `fk_subeixo`) VALUES
(18, 'Na Graduação', NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_metrica`
--

CREATE TABLE IF NOT EXISTS `tb_metrica` (
`id_metrica` int(11) NOT NULL,
  `nome_metrica` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_metrica`
--

INSERT INTO `tb_metrica` (`id_metrica`, `nome_metrica`) VALUES
(1, 'Hora(s)-aula'),
(2, 'Ano(s)'),
(3, 'Unidade'),
(4, 'Semestre(s)');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_nivel`
--

CREATE TABLE IF NOT EXISTS `tb_nivel` (
`id_nivel` int(11) NOT NULL,
  `cod_nivel` varchar(5) NOT NULL,
  `nome_nivel` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_nivel`
--

INSERT INTO `tb_nivel` (`id_nivel`, `cod_nivel`, `nome_nivel`) VALUES
(1, 'AdA1', 'Adjunto A 1'),
(2, 'AsA1', 'Assistente A 1'),
(3, 'Au1', 'Auxiliar 1'),
(4, 'AdA2', 'Adjunto A 2'),
(5, 'AsA2', 'Assistente A 2'),
(6, 'Au2', 'Auxiliar 2'),
(7, 'B1', 'Assistente 1'),
(8, 'B2', 'Assistente 2'),
(9, 'C1', 'Adjunto 1'),
(10, 'C2', 'Adjunto 2'),
(11, 'C3', 'Adjunto 3'),
(12, 'C4', 'Adjunto 4'),
(13, 'D1', 'Associado 1'),
(14, 'D2', 'Associado 2'),
(15, 'D3', 'Associado 3'),
(16, 'D4', 'Associado 4'),
(17, 'E', 'Titular');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_nivel_titulo`
--

CREATE TABLE IF NOT EXISTS `tb_nivel_titulo` (
  `fk_nivel` int(11) NOT NULL,
  `fk_titulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_professor`
--

CREATE TABLE IF NOT EXISTS `tb_professor` (
  `siape` int(8) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `foto` varchar(20) NOT NULL,
  `regime_trabalho` int(11) NOT NULL,
  `fk_nivel` int(11) NOT NULL,
  `fk_titulo` int(11) NOT NULL,
  `fk_depto` int(11) NOT NULL,
  `senha` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_professor`
--

INSERT INTO `tb_professor` (`siape`, `nome`, `email`, `foto`, `regime_trabalho`, `fk_nivel`, `fk_titulo`, `fk_depto`, `senha`) VALUES
(12345678, 'Sidney Melo', 'sidneyaraujomelo@gmail.com', 'profile_default.png', 0, 0, 0, 0, '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_progressao`
--

CREATE TABLE IF NOT EXISTS `tb_progressao` (
`id_progressao` int(11) NOT NULL,
  `fk_nivel_anterior` int(11) NOT NULL,
  `fk_nivel_seguinte` int(11) NOT NULL,
  `duracao_intersticio` int(11) NOT NULL,
  `pontuacao` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_progressao`
--

INSERT INTO `tb_progressao` (`id_progressao`, `fk_nivel_anterior`, `fk_nivel_seguinte`, `duracao_intersticio`, `pontuacao`) VALUES
(1, 1, 3, 601, 30),
(52, 2, 6, 3, 90),
(55, 1, 8, 3, 91),
(56, 3, 8, 3, 91),
(57, 1, 13, 3, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_regra`
--

CREATE TABLE IF NOT EXISTS `tb_regra` (
  `id_item` int(11) NOT NULL,
  `fk_metrica` int(11) NOT NULL,
  `fk_classificacao` int(11) NOT NULL,
  `pontmax_regra` int(11) NOT NULL,
  `formula_regra` text NOT NULL,
  `quantidade_decorrente` int(11) NOT NULL,
  `fk_tipoclass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_regra`
--

INSERT INTO `tb_regra` (`id_item`, `fk_metrica`, `fk_classificacao`, `pontmax_regra`, `formula_regra`, `quantidade_decorrente`, `fk_tipoclass`) VALUES
(18, 1, 0, 0, '=(valor_informado/15) *1.5', 0, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_subeixo`
--

CREATE TABLE IF NOT EXISTS `tb_subeixo` (
`id_subeixo` int(11) NOT NULL,
  `nome_subeixo` varchar(60) NOT NULL,
  `pontmax_subeixo` int(11) NOT NULL,
  `fk_eixo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_subeixo`
--

INSERT INTO `tb_subeixo` (`id_subeixo`, `nome_subeixo`, `pontmax_subeixo`, `fk_eixo`) VALUES
(2, 'Atividades de Ensino', 81, 8),
(6, 'Orientação na Graduação', 30, 11),
(7, 'Orientação na Pós-Graduação', 30, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipoclassificacao`
--

CREATE TABLE IF NOT EXISTS `tb_tipoclassificacao` (
`id_tipoclass` int(11) NOT NULL,
  `nome_tipoclass` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_tipoclassificacao`
--

INSERT INTO `tb_tipoclassificacao` (`id_tipoclass`, `nome_tipoclass`) VALUES
(1, 'Unitário'),
(2, 'Classificação de Livros'),
(3, 'Classificação de Capítulos'),
(4, 'Qualis');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_titulo`
--

CREATE TABLE IF NOT EXISTS `tb_titulo` (
`id_titulo` int(11) NOT NULL,
  `nome_titulo` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_titulo`
--

INSERT INTO `tb_titulo` (`id_titulo`, `nome_titulo`) VALUES
(1, 'Especialista'),
(2, 'Mestre'),
(3, 'Doutor'),
(4, 'Bacharel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
 ADD PRIMARY KEY (`fk_professor`);

--
-- Indexes for table `tb_classificacao`
--
ALTER TABLE `tb_classificacao`
 ADD PRIMARY KEY (`id_classificacao`);

--
-- Indexes for table `tb_departamento`
--
ALTER TABLE `tb_departamento`
 ADD PRIMARY KEY (`id_depto`);

--
-- Indexes for table `tb_eixo`
--
ALTER TABLE `tb_eixo`
 ADD PRIMARY KEY (`id_eixo`), ADD UNIQUE KEY `nome_eixo` (`nome_eixo`);

--
-- Indexes for table `tb_item`
--
ALTER TABLE `tb_item`
 ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `tb_metrica`
--
ALTER TABLE `tb_metrica`
 ADD PRIMARY KEY (`id_metrica`);

--
-- Indexes for table `tb_nivel`
--
ALTER TABLE `tb_nivel`
 ADD PRIMARY KEY (`id_nivel`);

--
-- Indexes for table `tb_professor`
--
ALTER TABLE `tb_professor`
 ADD PRIMARY KEY (`siape`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_progressao`
--
ALTER TABLE `tb_progressao`
 ADD PRIMARY KEY (`id_progressao`), ADD UNIQUE KEY `fk_nivel_anterior` (`fk_nivel_anterior`,`fk_nivel_seguinte`);

--
-- Indexes for table `tb_regra`
--
ALTER TABLE `tb_regra`
 ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `tb_subeixo`
--
ALTER TABLE `tb_subeixo`
 ADD PRIMARY KEY (`id_subeixo`);

--
-- Indexes for table `tb_tipoclassificacao`
--
ALTER TABLE `tb_tipoclassificacao`
 ADD PRIMARY KEY (`id_tipoclass`);

--
-- Indexes for table `tb_titulo`
--
ALTER TABLE `tb_titulo`
 ADD PRIMARY KEY (`id_titulo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_classificacao`
--
ALTER TABLE `tb_classificacao`
MODIFY `id_classificacao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_departamento`
--
ALTER TABLE `tb_departamento`
MODIFY `id_depto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_eixo`
--
ALTER TABLE `tb_eixo`
MODIFY `id_eixo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_item`
--
ALTER TABLE `tb_item`
MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tb_metrica`
--
ALTER TABLE `tb_metrica`
MODIFY `id_metrica` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_nivel`
--
ALTER TABLE `tb_nivel`
MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tb_progressao`
--
ALTER TABLE `tb_progressao`
MODIFY `id_progressao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `tb_subeixo`
--
ALTER TABLE `tb_subeixo`
MODIFY `id_subeixo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_tipoclassificacao`
--
ALTER TABLE `tb_tipoclassificacao`
MODIFY `id_tipoclass` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_titulo`
--
ALTER TABLE `tb_titulo`
MODIFY `id_titulo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
