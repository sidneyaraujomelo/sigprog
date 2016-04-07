-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07-Abr-2016 às 22:27
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

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
  `fk_professor` int(11) NOT NULL,
  PRIMARY KEY (`fk_professor`)
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
  `id_classificacao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_classificacao` varchar(50) NOT NULL,
  `fk_tipoclassificacao` int(11) NOT NULL,
  PRIMARY KEY (`id_classificacao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Extraindo dados da tabela `tb_classificacao`
--

INSERT INTO `tb_classificacao` (`id_classificacao`, `nome_classificacao`, `fk_tipoclassificacao`) VALUES
(1, 'Unidade', 1),
(3, 'A1 com JCR', 4),
(4, 'A2 com JCR', 4),
(5, 'B1 com JCR', 4),
(6, 'B2 com JCR', 4),
(7, 'B3 com JCR', 4),
(8, 'B4 com JCR', 4),
(9, 'B5 com JCR', 4),
(10, 'C com JCR', 4),
(11, 'A1 sem JCR', 4),
(12, 'A2 sem JCR', 4),
(13, 'B1 sem JCR', 4),
(14, 'B2 sem JCR', 4),
(15, 'B3 sem JCR', 4),
(16, 'B4 sem JCR', 4),
(17, 'B5 sem JCR', 4),
(18, 'C sem JCR', 4),
(19, 'L4', 2),
(20, 'L3', 2),
(21, 'L2', 2),
(22, 'L1', 2),
(23, 'com equivalência a L4', 2),
(24, 'com equivalência a L3', 2),
(25, 'com equivalência a L2', 2),
(26, 'com equivalência a L1', 2),
(27, 'C4', 3),
(28, 'C3', 3),
(29, 'Sem classificação Capes e com equivalência C4', 3),
(30, 'Sem classificação Capes e com equivalência C3', 3),
(31, 'Internacional (com qualis CAPES)', 5),
(32, 'Internacional', 5),
(33, 'Nacional (com qualis CAPES)', 5),
(34, 'Nacional', 5),
(35, 'Regional', 5),
(36, 'Local', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_departamento`
--

CREATE TABLE IF NOT EXISTS `tb_departamento` (
  `id_depto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_depto` varchar(20) NOT NULL,
  PRIMARY KEY (`id_depto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_departamento`
--

INSERT INTO `tb_departamento` (`id_depto`, `nome_depto`) VALUES
(1, 'DEINF'),
(2, 'DEMAT');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_depto`
--

CREATE TABLE IF NOT EXISTS `tb_depto` (
  `id_depto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_depto` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_depto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_depto`
--

INSERT INTO `tb_depto` (`id_depto`, `nome_depto`) VALUES
(1, 'Departamento de Informática');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_eixo`
--

CREATE TABLE IF NOT EXISTS `tb_eixo` (
  `id_eixo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_eixo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_eixo`),
  UNIQUE KEY `nome_eixo` (`nome_eixo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `tb_eixo`
--

INSERT INTO `tb_eixo` (`id_eixo`, `nome_eixo`) VALUES
(8, 'A. Ensino'),
(11, 'B. Orientação'),
(12, 'C. Pesquisa'),
(13, 'D. Extensão'),
(14, 'E. Gestão'),
(15, 'F. Qualificação e Capacitação Docente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_item`
--

CREATE TABLE IF NOT EXISTS `tb_item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `nome_item` text CHARACTER SET utf8 NOT NULL,
  `pontmax_item` float DEFAULT NULL,
  `quantmax_item` int(11) DEFAULT NULL,
  `fk_subeixo` int(11) NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

--
-- Extraindo dados da tabela `tb_item`
--

INSERT INTO `tb_item` (`id_item`, `nome_item`, `pontmax_item`, `quantmax_item`, `fk_subeixo`) VALUES
(18, 'A1.1 Na Graduação', NULL, NULL, 2),
(19, 'A1.2 Na Pós-Graduação', NULL, NULL, 2),
(20, 'A1.3 Coordenação de projetos de ensino, eixos de componentes curriculares, preceptores de residência ou similares', NULL, NULL, 2),
(21, 'A1.4 Coordenação institucional em programas acadêmicos (CsF, PIBID, PET), por programa', NULL, NULL, 2),
(22, 'B1.1 Orientação finalizada em Iniciação Científica, por plano de trabalho do aluno aprovado no PIBIC ou em projeto de pesquisa aprovador por agência de fomento', NULL, NULL, 6),
(23, 'B1.2 Orientação finalizada no Programa Jovens Talentos ou PIBITI, por plano de trabalho do aluno', NULL, NULL, 6),
(24, 'B1.3 Orientação de Monitoria, por projeto (por semestre)', NULL, NULL, 6),
(25, 'B1.4 Orientação em Programa de Iniciação à Docência (PIBID), por projeto (por semestre)', NULL, NULL, 6),
(26, 'B1.5 Orientação em grupos (PET, grupos de trabalho), por semestre', NULL, NULL, 6),
(27, 'B1.6 Orientação finalizada de Monografias na graduação, por unidade ', NULL, NULL, 6),
(28, 'B1.7 Orientação da produção intelectual de alunos em projetos de extensão ou PIBITI (por unidade de projeto - coletivo ou individual)', NULL, NULL, 6),
(29, 'B1.8 Coordenação de estágio obrigatório (por semestre)', NULL, NULL, 6),
(30, 'B1.9 Supervisão de estágio obrigatório (por semestre) ', NULL, NULL, 6),
(31, 'C3.1 Apresentação de trabalhos em forma oral em eventos internacionais ou coordenação/participação em mesas de discussão, ou minicursos', NULL, NULL, 10),
(32, 'C3.2 Apresentação de trabalhos em forma oral em eventos nacionais ou coordenação/participação em mesas de discussão, ou minicursos', NULL, NULL, 10),
(33, 'C3.3 Apresentação de trabalhos em forma oral em eventos regionais ou coordenação/participação em mesas de discussão, ou minicursos', NULL, NULL, 10),
(34, 'C3.4 Palestras /conferências ministradas em eventos científicos internacionais como conferencista convidado', NULL, NULL, 10),
(35, 'C3.5 Palestras /conferências ministradas em eventos científicos nacionais como conferencista convidado', NULL, NULL, 10),
(36, 'C3.6 Palestras /conferências ministradas em eventos científicos regionais como conferencista convidado', NULL, NULL, 10),
(37, 'C3.7.1 Coordenação da comissão organizadora de eventos científicos ou artísticos culturais, internacionais, envolvendo o intercâmbio de diversos países (por unidade) (por evento com termo de concessão de agência de fomento) ', NULL, NULL, 10),
(38, 'C3.7.2 Coordenação da comissão organizadora de eventos científicos ou artísticos culturais, internacionais, envolvendo o intercâmbio de diversos países (por unidade) (por evento sem termo de concessão de agência de fomento) ', NULL, NULL, 10),
(39, 'C3.8.1 Coordenação da comissão organizadora de eventos científicos ou artísticos culturais nacionais, envolvendo o intercâmbio de diversos Estados, por unidade (por evento com termo de concessão de agência de fomento) ', NULL, NULL, 10),
(40, 'C3.8.2 Coordenação da comissão organizadora de eventos científicos ou artísticos culturais nacionais, envolvendo o intercâmbio de diversos Estados, por unidade (por evento sem termo de concessão de agência de fomento) ', NULL, NULL, 10),
(41, 'C3.9.1 Coordenação da comissão organizadora de eventos científicos, de extensão ou artísticos culturais regionais/locais, envolvendo o intercâmbio de diversos Estados, por unidade  (por evento com termo de concessão de agência de fomento) ', NULL, NULL, 10),
(42, 'C3.9.2 Coordenação da comissão organizadora de eventos científicos, de extensão ou artísticos culturais regionais/locais, envolvendo o intercâmbio de diversos Estados, por unidade  (por evento sem termo de concessão de agência de fomento) ', NULL, NULL, 10),
(43, 'C5.1 Patentes concedidas (por unidade)', NULL, NULL, 12),
(44, 'C5.2 Patentes depositadas (por unidade) ', NULL, NULL, 12),
(45, 'C5.3 Registros por unidade (Desenho Industrial, Software, Cultivar, Marcas e Indicações Geográficas)', NULL, NULL, 12),
(46, 'C7.01 Monografia de graduação e especialização', NULL, NULL, 14),
(47, 'C7.02 Qualificação de mestrado', NULL, NULL, 14),
(48, 'C7.03 Dissertação de mestrado ', NULL, NULL, 14),
(49, 'C7.04 Qualificação de doutorado', NULL, NULL, 14),
(50, 'C7.05 Tese de doutorado', NULL, NULL, 14),
(51, 'C7.06 Concurso público para ingresso na carreira do Magistério Superior', NULL, NULL, 14),
(52, 'C7.07 Processo seletivo simplificado para professor substituto do Magistério Superior', NULL, NULL, 14),
(53, 'C7.08 Banca para processo seletivo para ingresso de alunos nos Programas de Pós-Graduação stricto sensu', NULL, NULL, 14),
(54, 'C7.09 Banca de comissão julgadora para distinção de mérito acadêmico-científico-cultural', NULL, NULL, 14),
(55, 'C7.10 Banca em Exame de Habilidade Específica em Música ou outro curso', NULL, NULL, 14),
(56, 'C7.11 Banca em Exame de Proficiência em Língua Estrangeira', NULL, NULL, 14),
(57, 'C7.12 Avaliação de cursos de graduação, avaliação institucional e avaliação de programas de pós-graduação no âmbito do Sistema Nacional de Avaliação da Educação Superior (SINAES) ou Sistemas Estaduais de Ensino', NULL, NULL, 14),
(58, 'E2.1 Representação no CONSUN, CONSEPE, CONSAD, Câmaras Técnicas e Conselho Diretor (por semestre) ', NULL, NULL, 16),
(59, 'E2.2 Participação em Conselho de Unidade Acadêmica, Assembleia Departamental e Colegiado de curso de graduação e pós-graduação (por semestre)', NULL, NULL, 16),
(60, 'E2.3 Representação em Conselhos Nacionais, vinculados aos Ministérios de Educação, de Cultura e de Ciência e Tecnologia (por semestre)', NULL, NULL, 16),
(61, 'E2.4 Representação em Conselhos de Educação, de Ciência e Tecnologia e outros relacionados com o campo de atuação do docente, no âmbito do nível administrativo do Estado do Maranhão ou municipal (por semestre)', NULL, NULL, 16),
(62, 'E2.5 Representação em diretorias de entidades sindicais (por semestre)', NULL, NULL, 16),
(63, 'E2.6 Representação em diretoria de entidades profissionais e científicas (por semestre)', NULL, NULL, 16),
(64, 'C4.1 Consultor ad hoc ou assessor técnico das agências de fomento para análise de projetos/editais (por produção/assessoria técnica)', 10.5, NULL, 11),
(65, 'C4.2 Atuação como parecerista/revisor de revistas indexadas (por análise)', NULL, NULL, 11),
(66, 'C4.3 Atuação como editor em revistas indexadas (por ano)', NULL, NULL, 11),
(67, 'C4.4 Atuação como parecerista/revisor de editoras universitárias (por análise)', NULL, NULL, 11),
(68, 'E1.1 Cargos de direção CD1, reitor (por semestre)', NULL, NULL, 15),
(69, 'E1.2 Cargos de direção CD 2, Vice-Reitor e Pró-Reitores (por semestre)', NULL, NULL, 15),
(70, 'E1.3 Cargos de direção CD 3 (por semestre)', NULL, NULL, 15),
(71, 'E1.4 Cargos de direção CD 4 (por semestre)', NULL, NULL, 15),
(72, 'E1.5 Cargos de direção FG 1 (por semestre)', NULL, NULL, 15),
(73, 'E1.6 Exercício de função de direção, coordenação, assessoramento, chefia ou assistência, nos Ministérios de Educação, de Cultura e de Ciência, Tecnologia e Inovação, ou outro na esfera federal/internacional relacionado à área de atuação do docente (por semestre)', NULL, NULL, 15),
(74, 'E1.7 Exercício de função de direção, coordenação, assessoramento, chefia ou assistência, nas Secretarias de Educação, de Cultura e de Ciência e Tecnologia, ou outro na esfera estadual ou municipal relacionado à área de atuação do docente (por semestre)', NULL, NULL, 15),
(75, 'E1.8 Participação em Comissões Provisórias', 12, NULL, 15),
(76, 'E1.9 Participação em Comissões Permanentes - Comissão Própria de Avaliação (CPA), Comissão de Planejamento Acadêmico, Comissão Permanente de Pessoal Docente (CPPD), Núcleo Docente Estruturante (NDE), Comissão de Avaliação de Desempenho Acadêmico e Comitê Gestor de Pesquisa, Ensino ou Extensão, Comitê de Ética ou similares com essa natureza', 12, NULL, 15),
(77, 'F1.1 Cursos de pós-graduação lato sensu com natureza de aperfeiçoamento, capacitação ou atualização (no mínimo 360h)', 8, NULL, 17),
(78, 'F1.2 Cursos de pós-graduação stricto sensu (com afastamento parcial ou total do docente)', NULL, NULL, 17),
(79, 'F1.3 Pós-doutorado (com afastamento parcial ou total do docente)', NULL, NULL, 17),
(80, 'F1.4 Programa de Ambientação de Docentes da UFMA, oferecido pela Pró-Reitoria de Ensino e Pró-Reitoria de Recursos Humanos (mínimo de 60h)', NULL, NULL, 17),
(81, 'F1.5 Formação Continuada da UFMA, oferecida pela Pró-Reitoria de Ensino (mínimo de 60h)', 4, NULL, 17),
(83, 'C2.1 Coordenação de projeto de pesquisa em  desenvolvimento, aprovado por agência de fomento, por  ano', NULL, NULL, 9),
(84, 'C2.2 Coordenação de projeto de pesquisa em  desenvolvimento, não aprovado por agência de fomento,  por ano', NULL, 2, 9),
(85, 'C2.3 Participação em projeto de pesquisa em  desenvolvimento, se aprovado por agência de fomento,  por ano', NULL, NULL, 9),
(86, 'C2.4 Participação em projeto de pesquisa em  desenvolvimento, se não aprovado por agência de  fomento, por ano', NULL, 2, 9),
(87, 'C2.5 Relatório final de projeto de pesquisa sob  coordenação do docente, finalizado no interstício,  contendo resultado de pesquisa comprovado envolvendo o  coordenador como autor (por relatório)', NULL, NULL, 9),
(92, 'D1.1 Coordenação de programa, projeto ou curso de  extensão em desenvolvimento, aprovado por agência de  fomento (por ano)', NULL, NULL, 57),
(93, 'D1.2 Coordenação de programa, projeto ou curso de  extensão em desenvolvimento, não aprovado por agência  de fomento (por ano)', NULL, NULL, 57),
(94, 'D1.3 Participação em programa, projeto ou curso de  extensão em desenvolvimento (por ano), se aprovado por  agência de fomento', NULL, NULL, 57),
(95, 'D1.4 Participação em programa, projeto ou curso de  extensão em desenvolvimento (por ano), se não aprovado  por agência de fomento', NULL, NULL, 57),
(96, 'D1.5 Relatório final de programa, projeto ou curso de  extensão sob coordenação do docente, finalizado no  interstício, contendo resultado comprovado envolvendo o  coordenador como autor (por relatório)', NULL, NULL, 57),
(100, 'C1.1.1 Livros publicados na área de conhecimento com ISBN de Autoria Única', NULL, NULL, 8),
(101, 'C1.1.2 Livros publicados na área de conhecimento com ISBN de Autoria Compartilhada', NULL, NULL, 8),
(102, 'C1.1.3.1 Autoria única de livros sem classificação CAPES e sem equivalência reconhecida publicado por editoras universitárias', NULL, NULL, 8),
(103, 'C1.1.3.2 Autoria única de livros sem classificação CAPES e sem equivalência reconhecida publicado por editoras não universitárias', NULL, NULL, 8),
(104, 'C1.1.4.1 Autoria compartilhada de livros sem classificação CAPES e sem equivalência reconhecida publicado por editoras universitárias', NULL, NULL, 8),
(105, 'C1.1.4.2 Autoria compartilhada de livros sem classificação CAPES e sem equivalência reconhecida publicado por editoras não universitárias', NULL, NULL, 8),
(106, 'C1.2 Organização de livros', NULL, NULL, 8),
(107, 'C1.3.1 Capítulo de livro - Autoria Única', NULL, NULL, 8),
(108, 'C1.3.2 Capítulo de livro - Autoria Compartilhada', NULL, NULL, 8),
(109, 'C1.4 Artigos científicos publicados', NULL, NULL, 8),
(110, 'C1.5 Trabalhos completos em anais de eventos científicos', 30, NULL, 8),
(111, 'C1.6.1 Produção de material didático e instrucional com ISBN', 10, NULL, 8),
(112, 'C1.6.2 Produção de material didático e instrucional sem ISBN', 5, NULL, 8),
(113, 'C6.1.1 Obras artísticas premiadas - Composição ou autoria individual', NULL, NULL, 13),
(114, 'C6.1.2 Obras artísticas premiadas - Composição ou autoria compartilhada', NULL, NULL, 13),
(115, 'C6.1.3 Obras artísticas premiadas - Exposição ou interpretação individual', NULL, NULL, 13),
(116, 'C6.1.4 Obras artísticas premiadas - Exposição ou interpretação coletiva', NULL, NULL, 13),
(117, 'C6.1.5 Obras artísticas premiadas - Direção individual', NULL, NULL, 13),
(118, 'C6.1.6 Obras artísticas premiadas - Direção compartilhada', NULL, NULL, 13),
(119, 'C6.1.7 Obras artísticas premiadas - Produção ou coordenação individual', NULL, NULL, 13),
(120, 'C6.1.8 Obras artísticas premiadas - Produção ou coordenação compartilhada', NULL, NULL, 13),
(121, 'C6.1.9 Obras artísticas premiadas - Serviços técnico-artísticos', NULL, NULL, 13),
(122, 'C6.2.1 Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Composição ou autoria individual', NULL, NULL, 13),
(123, 'C6.2.2 Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Composição ou autoria compartilhada', NULL, NULL, 13),
(124, 'C6.2.3 Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Exposição ou interpretação individual', NULL, NULL, 13),
(125, 'C6.2.4 Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Exposição ou interpretação coletiva', NULL, NULL, 13),
(126, 'C6.2.5 Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Direção individual', NULL, NULL, 13),
(127, 'C6.2.6 Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Direção compartilhada', NULL, NULL, 13),
(128, 'C6.2.7 Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Produção ou coordenação individual', NULL, NULL, 13),
(129, 'C6.2.8 Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Produção ou coordenação compartilhada', NULL, NULL, 13),
(130, 'C6.2.9 Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Serviços técnico-artísticos', NULL, NULL, 13),
(131, 'B2.1 Orientação finalizada de Monografias de  especialização, por unidade', NULL, NULL, 7),
(132, 'B2.2.1 Orientação finalizada de Dissertação de Mestrado,  por unidade, com produção associada/decorrente', NULL, NULL, 7),
(133, 'B2.3 Coorientação finalizada de Dissertação de Mestrado,  por unidade', NULL, 2, 7),
(134, 'B2.4 Orientação finalizada de Tese de Doutorado, por  unidade', NULL, NULL, 7),
(135, 'B2.5 Coorientação finalizada de Tese de Doutorado, por  unidade', NULL, 2, 7),
(136, 'B2.6 Supervisão de estágio de pós-doutorado na UFMA  (por ano)', NULL, NULL, 7),
(137, 'B2.7 Supervisão de estágio docência (por semestre)', NULL, NULL, 7),
(138, 'B2.2.2 Orientação finalizada de Dissertação de Mestrado,  por unidade, sem produção associada/decorrente', NULL, 3, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_metrica`
--

CREATE TABLE IF NOT EXISTS `tb_metrica` (
  `id_metrica` int(11) NOT NULL AUTO_INCREMENT,
  `nome_metrica` varchar(50) NOT NULL,
  PRIMARY KEY (`id_metrica`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tb_metrica`
--

INSERT INTO `tb_metrica` (`id_metrica`, `nome_metrica`) VALUES
(1, 'Hora(s)-aula'),
(2, 'Ano(s)'),
(3, 'Unidade'),
(4, 'Semestre(s)'),
(5, 'Quantidade');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_nivel`
--

CREATE TABLE IF NOT EXISTS `tb_nivel` (
  `id_nivel` int(11) NOT NULL AUTO_INCREMENT,
  `cod_nivel` varchar(5) NOT NULL,
  `nome_nivel` varchar(20) NOT NULL,
  PRIMARY KEY (`id_nivel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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

--
-- Extraindo dados da tabela `tb_nivel_titulo`
--

INSERT INTO `tb_nivel_titulo` (`fk_nivel`, `fk_titulo`) VALUES
(1, 3),
(2, 2),
(3, 1),
(3, 4),
(4, 3),
(5, 2),
(6, 1),
(6, 4),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_producao`
--

CREATE TABLE IF NOT EXISTS `tb_producao` (
  `id_producao` int(11) NOT NULL AUTO_INCREMENT,
  `fk_item` int(11) NOT NULL,
  `fk_professor` int(11) NOT NULL,
  `data_producao` date NOT NULL,
  `quantidade_producao` int(11) DEFAULT NULL,
  `fk_classificacao` int(11) DEFAULT NULL,
  `pontuacao_producao` float NOT NULL,
  `documento_producao` text CHARACTER SET utf8,
  `nome_producao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_producao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Extraindo dados da tabela `tb_producao`
--

INSERT INTO `tb_producao` (`id_producao`, `fk_item`, `fk_professor`, `data_producao`, `quantidade_producao`, `fk_classificacao`, `pontuacao_producao`, `documento_producao`, `nome_producao`) VALUES
(8, 18, 12345678, '2016-02-24', 60, NULL, 6, NULL, 'Aula de Calculo'),
(9, 18, 12345678, '2016-02-06', 60, NULL, 6, NULL, 'Aulas de Algebra'),
(11, 18, 12345678, '2016-02-23', 60, NULL, 6, 'Data_Mining1.pdf', 'Aula de CG'),
(16, 18, 12345678, '2016-02-24', 120, NULL, 12, NULL, 'Aula de LP'),
(20, 134, 12345678, '2016-02-24', NULL, NULL, 32, NULL, 'Orientação do Antonio'),
(26, 18, 12345678, '2016-02-26', 60, NULL, 6, 'Sistema_Integrado_de_Gestão_de_Atividades_Acadêmicas.pdf', 'Disciplinas  ministradas'),
(27, 109, 12345678, '2014-02-04', NULL, 12, 17, 'Sistema_Integrado_de_Gestão_de_Atividades_Acadêmicas2.pdf', 'Artigo  A2'),
(28, 132, 12345678, '2016-03-04', NULL, NULL, 17, '5d1819fc165d606710b94e456eed51a8.pdf', 'Orientação  da valeria ;  mestrado'),
(30, 18, 12345678, '2016-02-26', 90, NULL, 9, 'Sistema_Integrado_de_Gestão_de_Atividades_Acadêmicas5.pdf', 'TEste'),
(31, 133, 12345678, '2016-02-26', NULL, NULL, 10.5, NULL, 'Coorientação de Fulano'),
(44, 132, 12345678, '2016-03-02', NULL, NULL, 17, NULL, 'Orientação do Jack Sparrow'),
(47, 22, 12345678, '2016-03-15', 90, NULL, 180, NULL, ''),
(49, 43, 12345678, '2016-03-15', 5, NULL, 175, NULL, ''),
(51, 22, 12345678, '2017-07-11', 2, NULL, 4, '04a53398ec83f148c3fbc72d3a331b75.pdf', ''),
(53, 43, 12345678, '2018-08-08', 2, NULL, 70, '3bacac7e5ed541519735ca56ef41f3a4.pdf', ''),
(56, 43, 12345678, '2018-03-15', 1, NULL, 35, 'aa4889643c577cdadd8ccea1e81c0688.pdf', 'Patente da ferramenta revolucionária'),
(57, 109, 12345678, '2018-03-07', NULL, 6, 16, 'd5d77783a02943a1d61f6a22746c316b.pdf', 'Artigo Importante');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_producao_decorrente`
--

CREATE TABLE IF NOT EXISTS `tb_producao_decorrente` (
  `id_decorrencia` int(11) NOT NULL AUTO_INCREMENT,
  `fk_producao_principal` int(11) NOT NULL,
  `fk_producao_decorrente` int(11) NOT NULL,
  PRIMARY KEY (`id_decorrencia`),
  KEY `fk_producao_principal` (`fk_producao_principal`),
  KEY `fk_producao_decorrente` (`fk_producao_decorrente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `tb_producao_decorrente`
--

INSERT INTO `tb_producao_decorrente` (`id_decorrencia`, `fk_producao_principal`, `fk_producao_decorrente`) VALUES
(18, 31, 27);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_professor`
--

CREATE TABLE IF NOT EXISTS `tb_professor` (
  `siape` int(8) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `foto` varchar(20) NOT NULL DEFAULT 'profile_default.png',
  `fk_regime_trabalho` int(11) NOT NULL,
  `fk_nivel` int(11) NOT NULL,
  `fk_titulo` int(11) NOT NULL,
  `fk_depto` int(11) NOT NULL,
  `fk_unid_academica` int(11) NOT NULL,
  `senha` text NOT NULL,
  PRIMARY KEY (`siape`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_professor`
--

INSERT INTO `tb_professor` (`siape`, `nome`, `email`, `foto`, `fk_regime_trabalho`, `fk_nivel`, `fk_titulo`, `fk_depto`, `fk_unid_academica`, `senha`) VALUES
(12312312, 'Beltrano', 'Beltrano@gmail.com', 'profile_default.png', 1, 1, 1, 1, 1, 'f5bb0c8de146c67b44babbf4e6584cc0'),
(12345678, 'Sidney Melo', 'sidneyaraujomelo@gmail.com', 'profile_default.png', 1, 11, 2, 1, 1, '25f9e794323b453885f5181f1b624d0b'),
(15915915, 'Fulano', 'fulano@beltrano.com', '', 1, 7, 2, 1, 1, '548af13bdd5fc92c120491aef92f9a22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_progressao`
--

CREATE TABLE IF NOT EXISTS `tb_progressao` (
  `id_progressao` int(11) NOT NULL AUTO_INCREMENT,
  `fk_nivel_anterior` int(11) NOT NULL,
  `fk_nivel_seguinte` int(11) NOT NULL,
  `duracao_intersticio` int(11) NOT NULL,
  `pontuacao` int(11) NOT NULL,
  PRIMARY KEY (`id_progressao`),
  UNIQUE KEY `fk_nivel_anterior` (`fk_nivel_anterior`,`fk_nivel_seguinte`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Extraindo dados da tabela `tb_progressao`
--

INSERT INTO `tb_progressao` (`id_progressao`, `fk_nivel_anterior`, `fk_nivel_seguinte`, `duracao_intersticio`, `pontuacao`) VALUES
(58, 1, 4, 5, 90),
(59, 2, 5, 5, 90),
(60, 3, 6, 5, 90),
(61, 4, 7, 5, 90),
(62, 5, 7, 5, 90),
(63, 6, 7, 5, 90),
(64, 7, 8, 5, 100),
(65, 8, 9, 5, 110),
(66, 9, 10, 5, 110),
(67, 10, 11, 5, 110),
(68, 11, 12, 5, 110),
(69, 12, 13, 5, 150),
(70, 13, 14, 5, 150),
(71, 14, 15, 5, 150),
(72, 15, 16, 5, 150),
(73, 16, 17, 13, 660);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_progressao_corrente`
--

CREATE TABLE IF NOT EXISTS `tb_progressao_corrente` (
  `id_prog_corrente` int(11) NOT NULL AUTO_INCREMENT,
  `fk_progressao` int(11) NOT NULL,
  `fk_professor` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `documento_prog_corrente` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id_prog_corrente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `tb_progressao_corrente`
--

INSERT INTO `tb_progressao_corrente` (`id_prog_corrente`, `fk_progressao`, `fk_professor`, `data_inicio`, `data_fim`, `documento_prog_corrente`) VALUES
(5, 67, 12345678, '2015-02-03', '2017-08-03', NULL),
(6, 68, 12345678, '2017-02-03', '2019-08-03', '12345678607-04-2016-05-15-41.pdf'),
(17, 64, 15915915, '2016-04-24', '2018-10-24', NULL),
(18, 58, 12312312, '2016-04-01', '2018-10-01', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_progressao_producao`
--

CREATE TABLE IF NOT EXISTS `tb_progressao_producao` (
  `id_prog_prod` int(11) NOT NULL AUTO_INCREMENT,
  `fk_prog_finalizada` int(11) NOT NULL,
  `fk_producao` int(11) NOT NULL,
  PRIMARY KEY (`id_prog_prod`),
  KEY `fk_producao` (`fk_producao`),
  KEY `fk_prog_finalizada` (`fk_prog_finalizada`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Extraindo dados da tabela `tb_progressao_producao`
--

INSERT INTO `tb_progressao_producao` (`id_prog_prod`, `fk_prog_finalizada`, `fk_producao`) VALUES
(1, 5, 16),
(2, 5, 30),
(3, 5, 8),
(4, 5, 9),
(5, 5, 11),
(6, 5, 26),
(7, 5, 47),
(8, 5, 28),
(9, 5, 44),
(10, 5, 31),
(11, 5, 20),
(12, 5, 49),
(14, 6, 51),
(17, 6, 53),
(25, 6, 51),
(26, 6, 57),
(27, 6, 53),
(28, 6, 56),
(29, 6, 51),
(30, 6, 57),
(31, 6, 53),
(32, 6, 56),
(33, 6, 51),
(34, 6, 57),
(35, 6, 53),
(36, 6, 56);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_regime`
--

CREATE TABLE IF NOT EXISTS `tb_regime` (
  `id_regime` int(11) NOT NULL AUTO_INCREMENT,
  `nome_regime` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_regime`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_regime`
--

INSERT INTO `tb_regime` (`id_regime`, `nome_regime`) VALUES
(1, '20H DE'),
(2, '40H DE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_regra`
--

CREATE TABLE IF NOT EXISTS `tb_regra` (
  `id_item` int(11) NOT NULL,
  `fk_metrica` int(11) NOT NULL,
  `pontmax_regra` int(11) NOT NULL,
  `formula_regra` text NOT NULL,
  `quantidade_decorrente` int(11) NOT NULL,
  `fk_tipoclass` int(11) NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_regra`
--

INSERT INTO `tb_regra` (`id_item`, `fk_metrica`, `pontmax_regra`, `formula_regra`, `quantidade_decorrente`, `fk_tipoclass`) VALUES
(18, 1, 0, '=((valor_informado/15) *1.5)', 0, 1),
(19, 1, 0, '=(valor_informado/15)*2)', 0, 1),
(20, 2, 0, '=(valor_informado*3)', 0, 1),
(21, 2, 0, '=(valor_informado*3)', 0, 1),
(22, 5, 0, '=(valor_informado*2)', 0, 1),
(23, 3, 0, '=(valor_informado*1)', 0, 1),
(24, 4, 0, '=(valor_informado*1)', 0, 1),
(25, 4, 0, '=(valor_informado*2)', 0, 1),
(26, 4, 0, '=(valor_informado*2)', 0, 1),
(27, 5, 0, '=(valor_informado*2)', 0, 1),
(28, 5, 0, '=(valor_informado*2)', 0, 1),
(29, 4, 0, '=(valor_informado*1.5)', 0, 1),
(30, 4, 0, '=(valor_informado)', 0, 1),
(31, 5, 0, '=(valor_informado*4)', 0, 1),
(32, 5, 0, '=(valor_informado*3)', 0, 1),
(33, 5, 0, '=(valor_informado*1.5)', 0, 1),
(34, 5, 0, '=(valor_informado*8)', 0, 1),
(35, 5, 0, '=(valor_informado*6)', 0, 1),
(36, 5, 0, '=(valor_informado*3)', 0, 1),
(37, 3, 0, '=(8)', 0, 1),
(38, 3, 0, '=(4)', 0, 1),
(39, 3, 0, '=(6)', 0, 1),
(40, 3, 0, '=(3)', 0, 1),
(41, 3, 0, '=(3)', 0, 1),
(42, 3, 0, '=(1.5)', 0, 1),
(43, 5, 0, '=(valor_informado*35)', 0, 1),
(44, 5, 0, '=(valor_informado*10)', 0, 1),
(45, 5, 0, '=(valor_informado*15)', 0, 1),
(46, 5, 0, '=(valor_informado*1.5)', 0, 1),
(47, 5, 0, '=(valor_informado*2)', 0, 1),
(48, 5, 0, '=(valor_informado*2)', 0, 1),
(49, 5, 0, '=(valor_informado*3)', 0, 1),
(50, 5, 0, '=(valor_informado*3)', 0, 1),
(51, 5, 0, '=(valor_informado*3)', 0, 1),
(52, 5, 0, '=(valor_informado*1.5)', 0, 1),
(53, 5, 0, '=(valor_informado*1.5)', 0, 1),
(54, 5, 0, '=(valor_informado*1.5)', 0, 1),
(55, 5, 0, '=(valor_informado*1.5)', 0, 1),
(56, 5, 0, '=(valor_informado*1.5)', 0, 1),
(57, 5, 0, '=(valor_informado*1.5)', 0, 1),
(58, 4, 0, '=(valor_informado*2)', 0, 1),
(59, 4, 0, '=(valor_informado)', 0, 1),
(60, 4, 0, '=(valor_informado)', 0, 1),
(61, 4, 0, '=(valor_informado)', 0, 1),
(62, 4, 0, '=(valor_informado)', 0, 1),
(63, 4, 0, '=(valor_informado)', 0, 1),
(64, 5, 0, '=(valor_informado*1.5)', 0, 1),
(65, 3, 0, '=(qualis_informado/2)', 0, 4),
(66, 2, 0, '=((valor_informado*classif_informado)/2)', 0, 4),
(67, 3, 0, '=(classif_informado/2)', 0, 4),
(68, 4, 0, '=(valor_informado*17.5)', 0, 1),
(69, 4, 0, '=(valor_informado*15)', 0, 1),
(70, 4, 0, '=(valor_informado*12.5)', 0, 1),
(71, 4, 0, '=(valor_informado*10.5)', 0, 1),
(72, 4, 0, '=(valor_informado*8.5)', 0, 1),
(73, 4, 0, '=(valor_informado*4)', 0, 1),
(74, 4, 0, '=(valor_informado*4)', 0, 1),
(75, 5, 0, '=(valor_informado*1.5)', 0, 1),
(76, 4, 0, '=(valor_informado*3)', 0, 1),
(77, 4, 0, '=(valor_informado*4)', 0, 1),
(78, 4, 0, '=(valor_informado*15)', 0, 1),
(79, 4, 0, '=(valor_informado*10)', 0, 1),
(80, 4, 0, '=(valor_informado*2)', 0, 1),
(81, 4, 0, '=(valor_informado)', 0, 1),
(83, 2, 0, '=(valor_informado*6)', 0, 1),
(84, 2, 0, '=(valor_informado*3)', 0, 1),
(85, 2, 0, '=(valor_informado*2.5)', 0, 1),
(86, 2, 0, '=(valor_informado*2)', 0, 1),
(87, 3, 0, '=(decorrente_informado/2)', 1, 1),
(92, 2, 0, '=(valor_informado*6)', 0, 1),
(93, 2, 0, '=(valor_informado*3)', 0, 1),
(94, 2, 0, '=(valor_informado*2.5)', 0, 1),
(95, 2, 0, '=(valor_informado*2)', 0, 1),
(96, 1, 0, '=(decorrente_informado/2)', 1, 1),
(100, 3, 0, '=(classif_informado)', 0, 2),
(101, 3, 0, '=(classif_informado)', 0, 2),
(102, 3, 0, '=(15)', 0, 1),
(103, 3, 0, '=(10)', 0, 1),
(104, 3, 0, '=(10)', 0, 1),
(105, 3, 0, '=(5)', 0, 1),
(106, 3, 0, '=(classif_informado)', 0, 2),
(107, 3, 0, '=(classif_informado)', 0, 3),
(108, 3, 0, '=(classif_informado)', 0, 3),
(109, 3, 0, '=(classif_informado)', 0, 4),
(110, 3, 0, '=(classif_informado)', 0, 5),
(111, 3, 0, '=(5)', 0, 1),
(112, 3, 0, '=(2.5)', 0, 1),
(113, 3, 0, '=(classif_informado)', 0, 5),
(114, 3, 0, '=(classif_informado)', 0, 5),
(115, 1, 0, '=(classif_informado)', 0, 5),
(116, 3, 0, '=(classif_informado)', 0, 5),
(117, 3, 0, '=(classif_informado)', 0, 5),
(118, 3, 0, '=(classif_informado)', 0, 5),
(119, 3, 0, '=(classif_informado)', 0, 5),
(120, 3, 0, '=(classif_informado)', 0, 5),
(121, 3, 0, '=(classif_informado)', 0, 5),
(122, 3, 0, '=(classif_informado)', 0, 5),
(123, 3, 0, '=(classif_informado)', 0, 5),
(124, 3, 0, '=(classif_informado)', 0, 5),
(125, 3, 0, '=(classif_informado)', 0, 5),
(126, 3, 0, '=(classif_informado)', 0, 5),
(127, 3, 0, '=(classif_informado)', 0, 5),
(128, 3, 0, '=(classif_informado)', 0, 5),
(129, 3, 0, '=(classif_informado)', 0, 5),
(130, 3, 0, '=(classif_informado)', 0, 5),
(131, 5, 0, '=(valor_informado*2.5)', 0, 1),
(132, 3, 0, '=(4+(0.5*decorrente_informado))', 1, 1),
(133, 3, 0, '=(2+(0.5*decorrente_informado))', 1, 1),
(134, 3, 0, '=(((6+(0.5*decorrente_informado_1))+(0.5*decorrente_informado_2))&&(decorrente_informado_1||decorrente_informado_2))', 2, 1),
(135, 3, 0, '=((3+(0.5*decorrente_informado_1))+(0.5*decorrente_informado_2))', 2, 1),
(136, 2, 0, '=(valor_informado*2)', 0, 1),
(137, 4, 0, '=(valor_informado)', 0, 1),
(138, 1, 0, '=(valor_informado)', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_regraprog_espec`
--

CREATE TABLE IF NOT EXISTS `tb_regraprog_espec` (
  `id_regraprog_espec` int(11) NOT NULL AUTO_INCREMENT,
  `fk_progressao` int(11) NOT NULL,
  `fk_subeixo` int(11) NOT NULL,
  `pontuacao` int(11) NOT NULL,
  PRIMARY KEY (`id_regraprog_espec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_regra_classificacao`
--

CREATE TABLE IF NOT EXISTS `tb_regra_classificacao` (
  `id_regra_classificacao` int(11) NOT NULL AUTO_INCREMENT,
  `fk_regra` int(11) NOT NULL,
  `fk_classificacao` int(11) NOT NULL,
  `valor` float NOT NULL,
  `pontuacao_maxima` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_regra_classificacao`),
  UNIQUE KEY `fk_regra` (`fk_regra`,`fk_classificacao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=194 ;

--
-- Extraindo dados da tabela `tb_regra_classificacao`
--

INSERT INTO `tb_regra_classificacao` (`id_regra_classificacao`, `fk_regra`, `fk_classificacao`, `valor`, `pontuacao_maxima`) VALUES
(1, 64, 3, 20, NULL),
(5, 65, 3, 30, NULL),
(6, 65, 4, 26, NULL),
(7, 65, 5, 21, NULL),
(8, 65, 6, 16, NULL),
(9, 65, 7, 12, NULL),
(10, 65, 8, 10, NULL),
(11, 65, 9, 8, NULL),
(12, 65, 10, 3, NULL),
(13, 65, 11, 20, NULL),
(14, 65, 12, 17, NULL),
(15, 65, 13, 14, NULL),
(16, 65, 14, 11, NULL),
(17, 65, 15, 8, NULL),
(18, 65, 16, 6, NULL),
(19, 65, 17, 4, NULL),
(20, 65, 18, 2, NULL),
(21, 66, 3, 30, NULL),
(22, 66, 4, 26, NULL),
(23, 66, 5, 21, NULL),
(24, 66, 6, 16, NULL),
(25, 66, 7, 12, NULL),
(26, 66, 8, 10, NULL),
(27, 66, 9, 8, NULL),
(28, 66, 10, 3, NULL),
(29, 66, 11, 20, NULL),
(30, 66, 12, 17, NULL),
(31, 66, 13, 14, NULL),
(32, 66, 14, 11, NULL),
(33, 66, 15, 8, NULL),
(34, 66, 16, 6, NULL),
(35, 66, 17, 4, NULL),
(36, 66, 18, 2, NULL),
(37, 67, 3, 30, NULL),
(38, 67, 4, 26, NULL),
(39, 67, 5, 21, NULL),
(40, 67, 6, 16, NULL),
(41, 67, 7, 12, NULL),
(42, 67, 8, 10, NULL),
(43, 67, 9, 8, NULL),
(44, 67, 10, 3, NULL),
(45, 67, 11, 20, NULL),
(46, 67, 12, 17, NULL),
(47, 67, 13, 14, NULL),
(48, 67, 14, 11, NULL),
(49, 67, 15, 8, NULL),
(50, 67, 16, 6, NULL),
(51, 67, 17, 4, NULL),
(52, 67, 18, 2, NULL),
(53, 100, 19, 30, NULL),
(54, 100, 20, 25, NULL),
(55, 100, 21, 20, NULL),
(56, 100, 22, 15, NULL),
(58, 100, 24, 20, NULL),
(59, 100, 25, 15, NULL),
(60, 100, 26, 10, NULL),
(61, 101, 26, 5, NULL),
(62, 101, 24, 15, NULL),
(63, 101, 22, 10, NULL),
(64, 101, 20, 20, NULL),
(65, 101, 25, 10, NULL),
(66, 101, 23, 20, NULL),
(67, 101, 21, 15, NULL),
(68, 101, 19, 25, NULL),
(69, 106, 26, 5, NULL),
(70, 106, 24, 10, NULL),
(71, 106, 22, 7, NULL),
(72, 106, 20, 12, NULL),
(73, 106, 25, 8, NULL),
(74, 106, 23, 12, NULL),
(75, 106, 21, 10, NULL),
(76, 106, 19, 15, NULL),
(77, 107, 28, 14, NULL),
(79, 107, 27, 18, NULL),
(80, 107, 30, 10, NULL),
(81, 107, 29, 14, NULL),
(82, 108, 28, 10, NULL),
(83, 108, 30, 8, NULL),
(84, 108, 27, 12, NULL),
(85, 108, 29, 10, NULL),
(86, 109, 3, 30, NULL),
(87, 109, 4, 26, NULL),
(88, 109, 5, 21, NULL),
(89, 109, 6, 16, NULL),
(92, 109, 7, 12, NULL),
(93, 109, 8, 10, NULL),
(94, 109, 9, 8, NULL),
(95, 109, 10, 3, 9),
(96, 109, 11, 20, NULL),
(97, 109, 12, 17, NULL),
(98, 109, 13, 14, NULL),
(99, 109, 14, 11, NULL),
(100, 109, 15, 8, NULL),
(101, 109, 16, 6, NULL),
(102, 109, 17, 4, NULL),
(103, 109, 18, 2, 6),
(104, 110, 31, 5, 30),
(105, 110, 33, 4, 16),
(106, 110, 35, 2, 6),
(107, 110, 32, 0, NULL),
(108, 110, 34, 3, 30),
(109, 110, 36, 1, 3),
(110, 113, 32, 20, NULL),
(111, 113, 34, 15, NULL),
(112, 113, 35, 10, NULL),
(113, 113, 36, 5, NULL),
(114, 114, 32, 15, NULL),
(115, 114, 34, 10, NULL),
(116, 114, 35, 8, NULL),
(117, 114, 36, 4, NULL),
(118, 115, 32, 15, NULL),
(119, 115, 34, 12, NULL),
(120, 115, 35, 8, NULL),
(121, 115, 36, 5, NULL),
(122, 116, 32, 12, NULL),
(123, 116, 34, 8, NULL),
(124, 116, 35, 5, NULL),
(125, 116, 36, 3, NULL),
(126, 117, 32, 13, NULL),
(127, 117, 34, 10, NULL),
(128, 117, 35, 7, NULL),
(129, 117, 36, 4, NULL),
(130, 118, 32, 10, NULL),
(131, 118, 34, 7, NULL),
(132, 118, 35, 4, NULL),
(133, 118, 36, 2, NULL),
(134, 119, 32, 11, NULL),
(135, 119, 34, 8, NULL),
(136, 119, 35, 5, NULL),
(137, 119, 36, 3, NULL),
(138, 120, 32, 8, NULL),
(139, 120, 34, 5, NULL),
(140, 120, 35, 3, NULL),
(141, 120, 36, 2, NULL),
(142, 121, 32, 2.5, NULL),
(143, 121, 34, 2, NULL),
(144, 121, 35, 1.5, NULL),
(145, 121, 36, 1, NULL),
(146, 122, 32, 15, NULL),
(147, 122, 34, 10, NULL),
(148, 122, 35, 5, NULL),
(149, 122, 36, 2, NULL),
(150, 123, 32, 10, NULL),
(152, 123, 33, 0, NULL),
(153, 123, 34, 8, NULL),
(154, 123, 35, 5, NULL),
(155, 123, 36, 2, NULL),
(156, 124, 32, 12, NULL),
(157, 124, 34, 8, NULL),
(158, 124, 35, 5, NULL),
(159, 124, 36, 3, NULL),
(160, 125, 32, 8, NULL),
(161, 125, 34, 5, NULL),
(162, 125, 35, 3, NULL),
(163, 125, 36, 1, NULL),
(164, 126, 32, 10, NULL),
(165, 126, 34, 7, NULL),
(166, 126, 35, 4, NULL),
(167, 126, 36, 2, NULL),
(168, 127, 32, 7, NULL),
(169, 127, 34, 5, NULL),
(170, 127, 35, 3, NULL),
(171, 127, 36, 1, NULL),
(172, 128, 32, 8, NULL),
(173, 128, 34, 5, NULL),
(174, 128, 35, 3, NULL),
(175, 128, 36, 2, NULL),
(176, 129, 32, 6, NULL),
(177, 129, 34, 4, NULL),
(178, 129, 35, 2, NULL),
(179, 129, 36, 1, NULL),
(180, 130, 32, 2.5, NULL),
(181, 130, 34, 2, NULL),
(182, 130, 35, 1.5, NULL),
(183, 130, 36, 1, NULL),
(193, 100, 23, 25, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_regra_decorrente`
--

CREATE TABLE IF NOT EXISTS `tb_regra_decorrente` (
  `id_decorrencia` int(11) NOT NULL AUTO_INCREMENT,
  `fk_item_principal` int(11) NOT NULL,
  `fk_item_decorrente` int(11) NOT NULL,
  PRIMARY KEY (`id_decorrencia`),
  UNIQUE KEY `fk_item_principal` (`fk_item_principal`,`fk_item_decorrente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Extraindo dados da tabela `tb_regra_decorrente`
--

INSERT INTO `tb_regra_decorrente` (`id_decorrencia`, `fk_item_principal`, `fk_item_decorrente`) VALUES
(19, 132, 43),
(20, 132, 44),
(17, 132, 100),
(18, 132, 101),
(16, 132, 109),
(24, 133, 43),
(25, 133, 44),
(22, 133, 100),
(23, 133, 101),
(21, 133, 109),
(29, 134, 43),
(30, 134, 44),
(27, 134, 100),
(28, 134, 101),
(26, 134, 109),
(34, 135, 43),
(35, 135, 44),
(32, 135, 100),
(33, 135, 101),
(31, 135, 109);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_subeixo`
--

CREATE TABLE IF NOT EXISTS `tb_subeixo` (
  `id_subeixo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_subeixo` varchar(90) NOT NULL,
  `pontmax_subeixo` int(11) NOT NULL,
  `fk_eixo` int(11) NOT NULL,
  PRIMARY KEY (`id_subeixo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Extraindo dados da tabela `tb_subeixo`
--

INSERT INTO `tb_subeixo` (`id_subeixo`, `nome_subeixo`, `pontmax_subeixo`, `fk_eixo`) VALUES
(2, 'A1 Atividades de Ensino', 80, 8),
(6, 'B1 Orientação na Graduação', 30, 11),
(7, 'B2 Orientação na Pós-Graduação', 30, 11),
(8, 'C1 Produção Científica por Unidade', 120, 12),
(9, 'C2 Atividades de Pesquisa', 30, 12),
(10, 'C3 Atividades de Divulgação da Produção Científica', 30, 12),
(11, 'C4 Produção Tecnico-científica', 30, 12),
(12, 'C5 Patentes e Registros', 90, 12),
(13, 'C6 Produção Artística por Unidade', 60, 12),
(14, 'C7 Bancas Examinadoras por Unidade', 30, 12),
(15, 'E1 Administração Universitária ou Equivalente', 70, 14),
(16, 'E2 Representação Institucional ou de Categorias Universitárias', 12, 14),
(17, 'F1 Cursos', 60, 15),
(57, 'D1 Atividades de Extensão', 30, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipoclassificacao`
--

CREATE TABLE IF NOT EXISTS `tb_tipoclassificacao` (
  `id_tipoclass` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tipoclass` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipoclass`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tb_tipoclassificacao`
--

INSERT INTO `tb_tipoclassificacao` (`id_tipoclass`, `nome_tipoclass`) VALUES
(1, 'Unitário'),
(2, 'Classificação de Livros'),
(3, 'Classificação de Capítulos'),
(4, 'Qualis'),
(5, 'Âmbito');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_titulo`
--

CREATE TABLE IF NOT EXISTS `tb_titulo` (
  `id_titulo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_titulo` varchar(20) NOT NULL,
  PRIMARY KEY (`id_titulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_titulo`
--

INSERT INTO `tb_titulo` (`id_titulo`, `nome_titulo`) VALUES
(1, 'Especialista'),
(2, 'Mestre'),
(3, 'Doutor'),
(4, 'Bacharel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_unid_academica`
--

CREATE TABLE IF NOT EXISTS `tb_unid_academica` (
  `id_unid_academica` int(11) NOT NULL AUTO_INCREMENT,
  `nome_unid_academica` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_unid_academica`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_unid_academica`
--

INSERT INTO `tb_unid_academica` (`id_unid_academica`, `nome_unid_academica`) VALUES
(1, 'Centro de Ciências Exatas e Tecnologia');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_producao`
--
CREATE TABLE IF NOT EXISTS `view_producao` (
`id_producao` int(11)
,`data_producao` date
,`pontuacao_producao` float
,`id_eixo` int(11)
,`nome_eixo` varchar(50)
,`id_subeixo` int(11)
,`nome_subeixo` varchar(90)
,`id_item` int(11)
,`nome_item` text
,`nome_producao` varchar(50)
,`documento_producao` text
,`quantidade_producao` int(11)
,`id_classificacao` int(11)
,`nome_classificacao` varchar(50)
,`fk_professor` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_professor`
--
CREATE TABLE IF NOT EXISTS `view_professor` (
`siape` int(8)
,`nome` varchar(60)
,`email` varchar(40)
,`foto` varchar(20)
,`nome_regime` varchar(20)
,`nome_depto` varchar(100)
,`nome_unid_academica` varchar(100)
,`fk_nivel` int(11)
,`fk_titulo` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_progressao_corrente`
--
CREATE TABLE IF NOT EXISTS `view_progressao_corrente` (
`id_prog_corrente` int(11)
,`fk_progressao` int(11)
,`fk_professor` int(11)
,`data_inicio` date
,`data_fim` date
,`documento_prog_corrente` varchar(100)
,`cod_nivel_anterior` varchar(5)
,`nome_nivel_anterior` varchar(20)
,`cod_nivel_seguinte` varchar(5)
,`nome_nivel_seguinte` varchar(20)
);
-- --------------------------------------------------------

--
-- Structure for view `view_producao`
--
DROP TABLE IF EXISTS `view_producao`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_producao` AS select `a`.`id_producao` AS `id_producao`,`a`.`data_producao` AS `data_producao`,`a`.`pontuacao_producao` AS `pontuacao_producao`,`d`.`id_eixo` AS `id_eixo`,`d`.`nome_eixo` AS `nome_eixo`,`c`.`id_subeixo` AS `id_subeixo`,`c`.`nome_subeixo` AS `nome_subeixo`,`b`.`id_item` AS `id_item`,`b`.`nome_item` AS `nome_item`,`a`.`nome_producao` AS `nome_producao`,`a`.`documento_producao` AS `documento_producao`,`a`.`quantidade_producao` AS `quantidade_producao`,`e`.`id_classificacao` AS `id_classificacao`,`e`.`nome_classificacao` AS `nome_classificacao`,`a`.`fk_professor` AS `fk_professor` from ((((`tb_producao` `a` join `tb_item` `b` on((`a`.`fk_item` = `b`.`id_item`))) join `tb_subeixo` `c` on((`b`.`fk_subeixo` = `c`.`id_subeixo`))) join `tb_eixo` `d` on((`c`.`fk_eixo` = `d`.`id_eixo`))) left join `tb_classificacao` `e` on((`e`.`id_classificacao` = `a`.`fk_classificacao`)));

-- --------------------------------------------------------

--
-- Structure for view `view_professor`
--
DROP TABLE IF EXISTS `view_professor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_professor` AS select `a`.`siape` AS `siape`,`a`.`nome` AS `nome`,`a`.`email` AS `email`,`a`.`foto` AS `foto`,`b`.`nome_regime` AS `nome_regime`,`c`.`nome_depto` AS `nome_depto`,`d`.`nome_unid_academica` AS `nome_unid_academica`,`a`.`fk_nivel` AS `fk_nivel`,`a`.`fk_titulo` AS `fk_titulo` from (((`tb_professor` `a` left join `tb_regime` `b` on((`a`.`fk_regime_trabalho` = `b`.`id_regime`))) left join `tb_depto` `c` on((`a`.`fk_depto` = `c`.`id_depto`))) left join `tb_unid_academica` `d` on((`a`.`fk_unid_academica` = `d`.`id_unid_academica`)));

-- --------------------------------------------------------

--
-- Structure for view `view_progressao_corrente`
--
DROP TABLE IF EXISTS `view_progressao_corrente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_progressao_corrente` AS select `a`.`id_prog_corrente` AS `id_prog_corrente`,`a`.`fk_progressao` AS `fk_progressao`,`a`.`fk_professor` AS `fk_professor`,`a`.`data_inicio` AS `data_inicio`,`a`.`data_fim` AS `data_fim`,`a`.`documento_prog_corrente` AS `documento_prog_corrente`,`c`.`cod_nivel` AS `cod_nivel_anterior`,`c`.`nome_nivel` AS `nome_nivel_anterior`,`d`.`cod_nivel` AS `cod_nivel_seguinte`,`d`.`nome_nivel` AS `nome_nivel_seguinte` from (((`tb_progressao_corrente` `a` join `tb_progressao` `b` on((`a`.`fk_progressao` = `b`.`id_progressao`))) join `tb_nivel` `c` on((`b`.`fk_nivel_anterior` = `c`.`id_nivel`))) join `tb_nivel` `d` on((`b`.`fk_nivel_seguinte` = `d`.`id_nivel`)));

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_producao_decorrente`
--
ALTER TABLE `tb_producao_decorrente`
  ADD CONSTRAINT `tb_producao_decorrente_ibfk_1` FOREIGN KEY (`fk_producao_principal`) REFERENCES `tb_producao` (`id_producao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_producao_decorrente_ibfk_2` FOREIGN KEY (`fk_producao_decorrente`) REFERENCES `tb_producao` (`id_producao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_progressao_producao`
--
ALTER TABLE `tb_progressao_producao`
  ADD CONSTRAINT `tb_progressao_producao_ibfk_1` FOREIGN KEY (`fk_prog_finalizada`) REFERENCES `tb_progressao_corrente` (`id_prog_corrente`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_progressao_producao_ibfk_2` FOREIGN KEY (`fk_producao`) REFERENCES `tb_producao` (`id_producao`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
