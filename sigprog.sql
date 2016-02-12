-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12-Fev-2016 às 13:52
-- Versão do servidor: 5.6.24
-- PHP Version: 5.6.8

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_eixo`
--

INSERT INTO `tb_eixo` (`id_eixo`, `nome_eixo`) VALUES
(8, 'Ensino'),
(13, 'Extensão'),
(14, 'Gestão'),
(11, 'Orientação'),
(12, 'Pesquisa'),
(15, 'Qualificação e Capacitação Docente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_item`
--

CREATE TABLE IF NOT EXISTS `tb_item` (
  `id_item` int(11) NOT NULL,
  `nome_item` text CHARACTER SET utf8 NOT NULL,
  `pontmax_item` float DEFAULT NULL,
  `quantmax_item` int(11) DEFAULT NULL,
  `fk_subeixo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_item`
--

INSERT INTO `tb_item` (`id_item`, `nome_item`, `pontmax_item`, `quantmax_item`, `fk_subeixo`) VALUES
(18, 'Na Graduação', NULL, NULL, 2),
(19, 'Na Pós-Graduação', NULL, NULL, 2),
(20, 'Coordenação de projetos de ensino, eixos de componentes curriculares, preceptores de residência ou similares', NULL, NULL, 2),
(21, 'Coordenação institucional em programas acadêmicos (CsF, PIBID, PET), por programa', NULL, NULL, 2),
(22, 'Orientação finalizada em Iniciação Científica, por plano de trabalho do aluno aprovado no PIBIC ou em projeto de pesquisa aprovador por agência de fomento', NULL, NULL, 6),
(23, 'Orientação finalizada no Programa Jovens Talentos ou PIBITI, por plano de trabalho do aluno', NULL, NULL, 6),
(24, 'Orientação de Monitoria, por projeto (por semestre)', NULL, NULL, 6),
(25, 'Orientação em Programa de Iniciação à Docência (PIBID), por projeto (por semestre)', NULL, NULL, 6),
(26, 'Orientação em grupos (PET, grupos de trabalho), por semestre', NULL, NULL, 6),
(27, 'Orientação finalizada de Monografias na graduação, por unidade ', NULL, NULL, 6),
(28, 'Orientação da produção intelectual de alunos em projetos de extensão ou PIBITI (por unidade de projeto - coletivo ou individual)', NULL, NULL, 6),
(29, 'Coordenação de estágio obrigatório (por semestre)', NULL, NULL, 6),
(30, 'Supervisão de estágio obrigatório (por semestre) ', NULL, NULL, 6),
(31, 'Apresentação de trabalhos em forma oral em eventos internacionais ou coordenação/participação em mesas de discussão, ou minicursos', NULL, NULL, 10),
(32, 'Apresentação de trabalhos em forma oral em eventos nacionais ou coordenação/participação em mesas de discussão, ou minicursos', NULL, NULL, 10),
(33, 'Apresentação de trabalhos em forma oral em eventos regionais ou coordenação/participação em mesas de discussão, ou minicursos', NULL, NULL, 10),
(34, 'Palestras /conferências ministradas em eventos científicos internacionais como conferencista convidado', NULL, NULL, 10),
(35, 'Palestras /conferências ministradas em eventos científicos nacionais como conferencista convidado', NULL, NULL, 10),
(36, 'Palestras /conferências ministradas em eventos científicos regionais como conferencista convidado', NULL, NULL, 10),
(37, 'Coordenação da comissão organizadora de eventos científicos ou artísticos culturais, internacionais, envolvendo o intercâmbio de diversos países (por unidade) (por evento com termo de concessão de agência de fomento) ', NULL, NULL, 10),
(38, 'Coordenação da comissão organizadora de eventos científicos ou artísticos culturais, internacionais, envolvendo o intercâmbio de diversos países (por unidade) (por evento sem termo de concessão de agência de fomento) ', NULL, NULL, 10),
(39, 'Coordenação da comissão organizadora de eventos científicos ou artísticos culturais nacionais, envolvendo o intercâmbio de diversos Estados, por unidade (por evento com termo de concessão de agência de fomento) ', NULL, NULL, 10),
(40, 'Coordenação da comissão organizadora de eventos científicos ou artísticos culturais nacionais, envolvendo o intercâmbio de diversos Estados, por unidade (por evento sem termo de concessão de agência de fomento) ', NULL, NULL, 10),
(41, 'Coordenação da comissão organizadora de eventos científicos, de extensão ou artísticos culturais regionais/locais, envolvendo o intercâmbio de diversos Estados, por unidade  (por evento com termo de concessão de agência de fomento) ', NULL, NULL, 10),
(42, 'Coordenação da comissão organizadora de eventos científicos, de extensão ou artísticos culturais regionais/locais, envolvendo o intercâmbio de diversos Estados, por unidade  (por evento sem termo de concessão de agência de fomento) ', NULL, NULL, 10),
(43, 'Patentes concedidas (por unidade)', NULL, NULL, 12),
(44, 'Patentes depositadas (por unidade) ', NULL, NULL, 12),
(45, 'Registros por unidade (Desenho Industrial, Software, Cultivar, Marcas e Indicações Geográficas)', NULL, NULL, 12),
(46, 'Monografia de graduação e especialização', NULL, NULL, 14),
(47, 'Qualificação de mestrado', NULL, NULL, 14),
(48, 'Dissertação de mestrado ', NULL, NULL, 14),
(49, 'Qualificação de doutorado', NULL, NULL, 14),
(50, 'Tese de doutorado', NULL, NULL, 14),
(51, 'Concurso público para ingresso na carreira do Magistério Superior', NULL, NULL, 14),
(52, 'Processo seletivo simplificado para professor substituto do Magistério Superior', NULL, NULL, 14),
(53, 'Banca para processo seletivo para ingresso de alunos nos Programas de Pós-Graduação stricto sensu', NULL, NULL, 14),
(54, 'Banca de comissão julgadora para distinção de mérito acadêmico-científico-cultural', NULL, NULL, 14),
(55, 'Banca em Exame de Habilidade Específica em Música ou outro curso', NULL, NULL, 14),
(56, 'Banca em Exame de Proficiência em Língua Estrangeira', NULL, NULL, 14),
(57, 'Avaliação de cursos de graduação, avaliação institucional e avaliação de programas de pós-graduação no âmbito do Sistema Nacional de Avaliação da Educação Superior (SINAES) ou Sistemas Estaduais de Ensino', NULL, NULL, 14),
(58, 'Representação no CONSUN, CONSEPE, CONSAD, Câmaras Técnicas e Conselho Diretor (por semestre) ', NULL, NULL, 16),
(59, 'Participação em Conselho de Unidade Acadêmica, Assembleia Departamental e Colegiado de curso de graduação e pós-graduação (por semestre)', NULL, NULL, 16),
(60, 'Representação em Conselhos Nacionais, vinculados aos Ministérios de Educação, de Cultura e de Ciência e Tecnologia (por semestre)', NULL, NULL, 16),
(61, 'Representação em Conselhos de Educação, de Ciência e Tecnologia e outros relacionados com o campo de atuação do docente, no âmbito do nível administrativo do Estado do Maranhão ou municipal (por semestre)', NULL, NULL, 16),
(62, 'Representação em diretorias de entidades sindicais (por semestre)', NULL, NULL, 16),
(63, 'Representação em diretoria de entidades profissionais e científicas (por semestre)', NULL, NULL, 16),
(64, 'Consultor “ad hoc” ou assessor técnico das agências de fomento para análise de projetos/editais (por produção/assessoria técnica)', 10.5, NULL, 11),
(65, 'Atuação como parecerista/revisor de revistas indexadas (por análise)', NULL, NULL, 11),
(66, 'Atuação como editor em revistas indexadas (por ano)', NULL, NULL, 11),
(67, 'Atuação como parecerista/revisor de editoras universitárias (por análise)', NULL, NULL, 11),
(68, 'Cargos de direção – CD1 – reitor (por semestre)', NULL, NULL, 15),
(69, 'Cargos de direção – CD 2, Vice-Reitor e Pró-Reitores (por semestre)', NULL, NULL, 15),
(70, 'Cargos de direção – CD 3 (por semestre)', NULL, NULL, 15),
(71, 'Cargos de direção – CD 4 (por semestre)', NULL, NULL, 15),
(72, 'Cargos de direção – FG 1 (por semestre)', NULL, NULL, 15),
(73, 'Exercício de função de direção, coordenação, assessoramento, chefia ou assistência, nos Ministérios de Educação, de Cultura e de Ciência, Tecnologia e Inovação, ou outro na esfera federal/internacional relacionado à área de atuação do docente (por semestre)', NULL, NULL, 15),
(74, 'Exercício de função de direção, coordenação, assessoramento, chefia ou assistência, nas Secretarias de Educação, de Cultura e de Ciência e Tecnologia, ou outro na esfera estadual ou municipal relacionado à área de atuação do docente (por semestre)', NULL, NULL, 15),
(75, 'Participação em Comissões Provisórias', 12, NULL, 15),
(76, 'Participação em Comissões Permanentes - Comissão Própria de Avaliação (CPA), Comissão de Planejamento Acadêmico, Comissão Permanente de Pessoal Docente (CPPD), Núcleo Docente Estruturante (NDE), Comissão de Avaliação de Desempenho Acadêmico e Comitê Gestor de Pesquisa, Ensino ou Extensão, Comitê de Ética ou similares com essa natureza', 12, NULL, 15),
(77, 'Cursos de pós-graduação lato sensu com natureza de aperfeiçoamento, capacitação ou atualização (no mínimo 360h)', 8, NULL, 17),
(78, 'Cursos de pós-graduação stricto sensu (com afastamento parcial ou total do docente)', NULL, NULL, 17),
(79, 'Pós-doutorado (com afastamento parcial ou total do docente)', NULL, NULL, 17),
(80, 'Programa de Ambientação de Docentes da UFMA, oferecido pela Pró-Reitoria de Ensino e Pró-Reitoria de Recursos Humanos (mínimo de 60h)', NULL, NULL, 17),
(81, 'Formação Continuada da UFMA, oferecida pela Pró-Reitoria de Ensino (mínimo de 60h)', 4, NULL, 17),
(83, 'Coordenação de projeto de pesquisa em  desenvolvimento, aprovado por agência de fomento, por  ano', NULL, NULL, 9),
(84, 'Coordenação de projeto de pesquisa em  desenvolvimento, não aprovado por agência de fomento,  por ano', NULL, 2, 9),
(85, 'Participação em projeto de pesquisa em  desenvolvimento, se aprovado por agência de fomento,  por ano', NULL, NULL, 9),
(86, 'Participação em projeto de pesquisa em  desenvolvimento, se não aprovado por agência de  fomento, por ano', NULL, 2, 9),
(87, 'Relatório final de projeto de pesquisa sob  coordenação do docente, finalizado no interstício,  contendo resultado de pesquisa comprovado envolvendo o  coordenador como autor (por relatório)', NULL, NULL, 9),
(92, 'Coordenação de programa, projeto ou curso de  extensão em desenvolvimento, aprovado por agência de  fomento (por ano)', NULL, NULL, 57),
(93, 'Coordenação de programa, projeto ou curso de  extensão em desenvolvimento, não aprovado por agência  de fomento (por ano)', NULL, NULL, 57),
(94, 'Participação em programa, projeto ou curso de  extensão em desenvolvimento (por ano), se aprovado por  agência de fomento', NULL, NULL, 57),
(95, 'Participação em programa, projeto ou curso de  extensão em desenvolvimento (por ano), se não aprovado  por agência de fomento', NULL, NULL, 57),
(96, 'Relatório final de programa, projeto ou curso de  extensão sob coordenação do docente, finalizado no  interstício, contendo resultado comprovado envolvendo o  coordenador como autor (por relatório)', NULL, NULL, 57),
(100, 'Livros publicados na área de conhecimento com ISBN de Autoria Única', NULL, NULL, 8),
(101, 'Livros publicados na área de conhecimento com ISBN de Autoria Compartilhada', NULL, NULL, 8),
(102, 'Autoria única de livros sem classificação CAPES e sem equivalência reconhecida publicado por editoras universitárias', NULL, NULL, 8),
(103, 'Autoria única de livros sem classificação CAPES e sem equivalência reconhecida publicado por editoras não universitárias', NULL, NULL, 8),
(104, 'Autoria compartilhada de livros sem classificação CAPES e sem equivalência reconhecida publicado por editoras universitárias', NULL, NULL, 8),
(105, 'Autoria compartilhada de livros sem classificação CAPES e sem equivalência reconhecida publicado por editoras não universitárias', NULL, NULL, 8),
(106, 'Organização de livros', NULL, NULL, 8),
(107, 'Capítulo de livro - Autoria Única', NULL, NULL, 8),
(108, 'Capítulo de livro - Autoria Compartilhada', NULL, NULL, 8),
(109, 'Artigos científicos publicados', NULL, NULL, 8),
(110, 'Trabalhos completos em anais de eventos científicos', 30, NULL, 8),
(111, 'Produção de material didático e instrucional com ISBN', 10, NULL, 8),
(112, 'Produção de material didático e instrucional sem ISBN', 5, NULL, 8),
(113, 'Obras artísticas premiadas - Composição ou autoria individual', NULL, NULL, 13),
(114, 'Obras artísticas premiadas - Composição ou autoria compartilhada', NULL, NULL, 13),
(115, 'Obras artísticas premiadas - Exposição ou interpretação individual', NULL, NULL, 13),
(116, 'Obras artísticas premiadas - Exposição ou interpretação coletiva', NULL, NULL, 13),
(117, 'Obras artísticas premiadas - Direção individual', NULL, NULL, 13),
(118, 'Obras artísticas premiadas - Direção compartilhada', NULL, NULL, 13),
(119, 'Obras artísticas premiadas - Produção ou coordenação individual', NULL, NULL, 13),
(120, 'Obras artísticas premiadas - Produção ou coordenação compartilhada', NULL, NULL, 13),
(121, 'Obras artísticas premiadas - Serviços técnico-artísticos', NULL, NULL, 13),
(122, 'Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Composição ou autoria individual', NULL, NULL, 13),
(123, 'Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Composição ou autoria compartilhada', NULL, NULL, 13),
(124, 'Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Exposição ou interpretação individual', NULL, NULL, 13),
(125, 'Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Exposição ou interpretação coletiva', NULL, NULL, 13),
(126, 'Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Direção individual', NULL, NULL, 13),
(127, 'Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Direção compartilhada', NULL, NULL, 13),
(128, 'Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Produção ou coordenação individual', NULL, NULL, 13),
(129, 'Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Produção ou coordenação compartilhada', NULL, NULL, 13),
(130, 'Obras artísticas apresentadas ou publicadas nas modalidades convite, seleção ou edital de caráter institucional com homologação do órgão colegiado da subunidade acadêmica - Serviços técnico-artísticos', NULL, NULL, 13);

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
  `pontmax_regra` int(11) NOT NULL,
  `formula_regra` text NOT NULL,
  `quantidade_decorrente` int(11) NOT NULL,
  `fk_tipoclass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_regra`
--

INSERT INTO `tb_regra` (`id_item`, `fk_metrica`, `pontmax_regra`, `formula_regra`, `quantidade_decorrente`, `fk_tipoclass`) VALUES
(18, 1, 0, '=(valor_informado/15) *1.5', 0, 1),
(19, 1, 0, '=((valor_informado)/15)*2', 0, 1),
(20, 2, 0, '=(valor_informado*3)', 0, 1),
(21, 2, 0, '=(valor_informado*3)', 0, 1),
(22, 3, 0, '=(2)', 0, 1),
(23, 3, 0, '=(1)', 0, 1),
(24, 4, 0, '=(valor_informado*1)', 0, 1),
(25, 4, 0, '=(valor_informado*2)', 0, 1),
(26, 4, 0, '=(valor_informado*2)', 0, 1),
(27, 3, 0, '=(valor_informado*2)', 0, 1),
(28, 3, 0, '=(valor_informado*2)', 0, 1),
(29, 4, 0, '=(valor_informado*1.5)', 0, 1),
(30, 4, 0, '=(valor_informado)', 0, 1),
(31, 3, 0, '=(4)', 0, 1),
(32, 3, 0, '=(3)', 0, 1),
(33, 3, 0, '=(1.5)', 0, 1),
(34, 3, 0, '=(8)', 0, 1),
(35, 3, 0, '=(6)', 0, 1),
(36, 3, 0, '=(3)', 0, 1),
(37, 3, 0, '=(8)', 0, 4),
(38, 3, 0, '=(4)', 0, 1),
(39, 3, 0, '=(6)', 0, 1),
(40, 3, 0, '=(3)', 0, 1),
(41, 3, 0, '=(3)', 0, 1),
(42, 3, 0, '=(1.5)', 0, 1),
(43, 3, 0, '35', 0, 1),
(44, 3, 0, '10', 0, 1),
(45, 3, 0, '15', 0, 1),
(46, 3, 0, '=(1.5)', 0, 1),
(47, 3, 0, '=(2)', 0, 1),
(48, 3, 0, '=(2)', 0, 1),
(49, 3, 0, '=(3)', 0, 1),
(50, 3, 0, '=(3)', 0, 1),
(51, 3, 0, '=(3)', 0, 1),
(52, 3, 0, '=(1.5)', 0, 1),
(53, 3, 0, '=(1.5)', 0, 1),
(54, 3, 0, '=(1.5)', 0, 1),
(55, 3, 0, '=(1.5)', 0, 1),
(56, 3, 0, '=(1.5)', 0, 1),
(57, 3, 0, '=(1.5)', 0, 1),
(58, 4, 0, '=(valor_informado*2)', 0, 1),
(59, 4, 0, '=(valor_informado)', 0, 1),
(60, 4, 0, '=(valor_informado)', 0, 1),
(61, 4, 0, '=(valor_informado)', 0, 1),
(62, 4, 0, '=(valor_informado)', 0, 1),
(63, 4, 0, '=(valor_informado)', 0, 1),
(64, 3, 0, '=(1.5)', 0, 1),
(65, 3, 0, '=(qualis_informado/2)', 0, 4),
(66, 3, 0, '=(valor_informado*qualis_informado/2)', 0, 4),
(67, 3, 0, '=(qualis_informado/2)', 0, 4),
(68, 4, 0, '=(valor_informado*17.5)', 0, 1),
(69, 4, 0, '=(valor_informado*15)', 0, 1),
(70, 4, 0, '=(valor_informado*12.5)', 0, 1),
(71, 4, 0, '=(valor_informado*10.5)', 0, 1),
(72, 4, 0, '=(valor_informado*8.5)', 0, 1),
(73, 4, 0, '=(valor_informado*4)', 0, 1),
(74, 4, 0, '=(valor_informado*4)', 0, 1),
(75, 3, 0, '=(1.5)', 0, 1),
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
(87, 3, 0, '=(producao_decorrente/2)', 1, 1),
(92, 2, 0, '=(valor_informado*6)', 0, 1),
(93, 2, 0, '=(valor_informado*3)', 0, 1),
(94, 2, 0, '=(valor_informado*2.5)', 0, 1),
(95, 2, 0, '=(valor_informado*2)', 0, 1),
(96, 1, 0, '=(producao_informada/2)', 1, 1),
(100, 3, 0, '=(valor_informado)', 0, 2),
(101, 3, 0, '=(valor_informado)', 0, 2),
(102, 3, 0, '=(15)', 0, 1),
(103, 3, 0, '=(10)', 0, 1),
(104, 3, 0, '=(10)', 0, 1),
(105, 3, 0, '=(5)', 0, 1),
(106, 3, 0, '=(valor_informado)', 0, 2),
(107, 3, 0, '=(valor_informado)', 0, 3),
(108, 3, 0, '=(valor_informado)', 0, 3),
(109, 3, 0, '=(valor_informado)', 0, 4),
(110, 3, 0, '=(valor_informado)', 0, 5),
(111, 3, 0, '=(5)', 0, 1),
(112, 3, 0, '=(2.5)', 0, 1),
(113, 3, 0, '=(valor_informado)', 0, 5),
(114, 3, 0, '=(valor_informado)', 0, 5),
(115, 1, 0, '=(valor_informado)', 0, 5),
(116, 3, 0, '=(valor_informado)', 0, 5),
(117, 3, 0, '=(valor_informado)', 0, 5),
(118, 3, 0, '=(valor_informado)', 0, 5),
(119, 3, 0, '=(valor_informado)', 0, 5),
(120, 3, 0, '=(valor_informado)', 0, 5),
(121, 3, 0, '=(valor_informado)', 0, 5),
(122, 3, 0, '=(valor_informado)', 0, 5),
(123, 3, 0, '=(valor_informado)', 0, 5),
(124, 3, 0, '=(valor_informado)', 0, 5),
(125, 3, 0, '=(valor_informado)', 0, 5),
(126, 3, 0, '=(valor_informado)', 0, 5),
(127, 3, 0, '=(valor_informado)', 0, 5),
(128, 3, 0, '=(valor_informado)', 0, 5),
(129, 3, 0, '=(valor_informado)', 0, 5),
(130, 3, 0, '=(valor_informado)', 0, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_regra_classificacao`
--

CREATE TABLE IF NOT EXISTS `tb_regra_classificacao` (
  `id_regra_classificacao` int(11) NOT NULL,
  `fk_regra` int(11) NOT NULL,
  `fk_classificacao` int(11) NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_regra_classificacao`
--

INSERT INTO `tb_regra_classificacao` (`id_regra_classificacao`, `fk_regra`, `fk_classificacao`, `valor`) VALUES
(1, 64, 3, 20),
(5, 65, 3, 30),
(6, 65, 4, 26),
(7, 65, 5, 21),
(8, 65, 6, 16),
(9, 65, 7, 12),
(10, 65, 8, 10),
(11, 65, 9, 8),
(12, 65, 10, 3),
(13, 65, 11, 20),
(14, 65, 12, 17),
(15, 65, 13, 14),
(16, 65, 14, 11),
(17, 65, 15, 8),
(18, 65, 16, 6),
(19, 65, 17, 4),
(20, 65, 18, 2),
(21, 66, 3, 30),
(22, 66, 4, 26),
(23, 66, 5, 21),
(24, 66, 6, 16),
(25, 66, 7, 12),
(26, 66, 8, 10),
(27, 66, 9, 8),
(28, 66, 10, 3),
(29, 66, 11, 20),
(30, 66, 12, 17),
(31, 66, 13, 14),
(32, 66, 14, 11),
(33, 66, 15, 8),
(34, 66, 16, 6),
(35, 66, 17, 4),
(36, 66, 18, 2),
(37, 67, 3, 30),
(38, 67, 4, 26),
(39, 67, 5, 21),
(40, 67, 6, 16),
(41, 67, 7, 12),
(42, 67, 8, 10),
(43, 67, 9, 8),
(44, 67, 10, 3),
(45, 67, 11, 20),
(46, 67, 12, 17),
(47, 67, 13, 14),
(48, 67, 14, 11),
(49, 67, 15, 8),
(50, 67, 16, 6),
(51, 67, 17, 4),
(52, 67, 18, 2),
(53, 100, 19, 30),
(54, 100, 20, 25),
(55, 100, 21, 20),
(56, 100, 22, 15),
(57, 100, 23, 25),
(58, 100, 24, 20),
(59, 100, 25, 15),
(60, 100, 26, 10),
(61, 101, 26, 5),
(62, 101, 24, 15),
(63, 101, 22, 10),
(64, 101, 20, 20),
(65, 101, 25, 10),
(66, 101, 23, 20),
(67, 101, 21, 15),
(68, 101, 19, 25),
(69, 106, 26, 5),
(70, 106, 24, 10),
(71, 106, 22, 7),
(72, 106, 20, 12),
(73, 106, 25, 8),
(74, 106, 23, 12),
(75, 106, 21, 10),
(76, 106, 19, 15),
(77, 107, 28, 14),
(79, 107, 27, 18),
(80, 107, 30, 10),
(81, 107, 29, 14),
(82, 108, 28, 10),
(83, 108, 30, 8),
(84, 108, 27, 12),
(85, 108, 29, 10),
(86, 109, 3, 30),
(87, 109, 4, 26),
(88, 109, 5, 21),
(89, 109, 6, 16),
(92, 109, 7, 12),
(93, 109, 8, 10),
(94, 109, 9, 8),
(95, 109, 10, 3),
(96, 109, 11, 20),
(97, 109, 12, 17),
(98, 109, 13, 14),
(99, 109, 14, 11),
(100, 109, 15, 8),
(101, 109, 16, 6),
(102, 109, 17, 4),
(103, 109, 18, 2),
(104, 110, 31, 5),
(105, 110, 33, 4),
(106, 110, 35, 2),
(107, 110, 32, 0),
(108, 110, 34, 3),
(109, 110, 36, 1),
(110, 113, 32, 20),
(111, 113, 34, 15),
(112, 113, 35, 10),
(113, 113, 36, 5),
(114, 114, 32, 15),
(115, 114, 34, 10),
(116, 114, 35, 8),
(117, 114, 36, 4),
(118, 115, 32, 15),
(119, 115, 34, 12),
(120, 115, 35, 8),
(121, 115, 36, 5),
(122, 116, 32, 12),
(123, 116, 34, 8),
(124, 116, 35, 5),
(125, 116, 36, 3),
(126, 117, 32, 13),
(127, 117, 34, 10),
(128, 117, 35, 7),
(129, 117, 36, 4),
(130, 118, 32, 10),
(131, 118, 34, 7),
(132, 118, 35, 4),
(133, 118, 36, 2),
(134, 119, 32, 11),
(135, 119, 34, 8),
(136, 119, 35, 5),
(137, 119, 36, 3),
(138, 120, 32, 8),
(139, 120, 34, 5),
(140, 120, 35, 3),
(141, 120, 36, 2),
(142, 121, 32, 2.5),
(143, 121, 34, 2),
(144, 121, 35, 1.5),
(145, 121, 36, 1),
(146, 122, 32, 15),
(147, 122, 34, 10),
(148, 122, 35, 5),
(149, 122, 36, 2),
(150, 123, 32, 10),
(152, 123, 33, 0),
(153, 123, 34, 8),
(154, 123, 35, 5),
(155, 123, 36, 2),
(156, 124, 32, 12),
(157, 124, 34, 8),
(158, 124, 35, 5),
(159, 124, 36, 3),
(160, 125, 32, 8),
(161, 125, 34, 5),
(162, 125, 35, 3),
(163, 125, 36, 1),
(164, 126, 32, 10),
(165, 126, 34, 7),
(166, 126, 35, 4),
(167, 126, 36, 2),
(168, 127, 32, 7),
(169, 127, 34, 5),
(170, 127, 35, 3),
(171, 127, 36, 1),
(172, 128, 32, 8),
(173, 128, 34, 5),
(174, 128, 35, 3),
(175, 128, 36, 2),
(176, 129, 32, 6),
(177, 129, 34, 4),
(178, 129, 35, 2),
(179, 129, 36, 1),
(180, 130, 32, 2.5),
(181, 130, 34, 2),
(182, 130, 35, 1.5),
(183, 130, 36, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_regra_decorrente`
--

CREATE TABLE IF NOT EXISTS `tb_regra_decorrente` (
  `id_decorrencia` int(11) NOT NULL,
  `fk_item_principal` int(11) NOT NULL,
  `fk_item_decorrente` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_subeixo`
--

CREATE TABLE IF NOT EXISTS `tb_subeixo` (
  `id_subeixo` int(11) NOT NULL,
  `nome_subeixo` varchar(60) NOT NULL,
  `pontmax_subeixo` int(11) NOT NULL,
  `fk_eixo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_subeixo`
--

INSERT INTO `tb_subeixo` (`id_subeixo`, `nome_subeixo`, `pontmax_subeixo`, `fk_eixo`) VALUES
(2, 'Atividades de Ensino', 80, 8),
(6, 'Orientação na Graduação', 30, 11),
(7, 'Orientação na Pós-Graduação', 30, 11),
(8, 'Produção Científica por Unidade', 120, 12),
(9, 'Atividades de Pesquisa', 30, 12),
(10, 'Atividades de Divulgação da Produção Científica', 30, 12),
(11, 'Produção Tecnico-científica', 30, 12),
(12, 'Patentes e Registros', 90, 12),
(13, 'Produção Artística por Unidade', 60, 12),
(14, 'Bancas Examinadoras por Unidade', 30, 12),
(15, 'Administração Universitária ou Equivalente', 70, 14),
(16, 'Representação Institucional ou de Categorias Universitárias ', 12, 14),
(17, 'Cursos', 60, 15),
(57, 'Atividades de Extensão', 30, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipoclassificacao`
--

CREATE TABLE IF NOT EXISTS `tb_tipoclassificacao` (
  `id_tipoclass` int(11) NOT NULL,
  `nome_tipoclass` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
-- Indexes for table `tb_regra_classificacao`
--
ALTER TABLE `tb_regra_classificacao`
  ADD PRIMARY KEY (`id_regra_classificacao`), ADD UNIQUE KEY `fk_regra` (`fk_regra`,`fk_classificacao`);

--
-- Indexes for table `tb_regra_decorrente`
--
ALTER TABLE `tb_regra_decorrente`
  ADD PRIMARY KEY (`id_decorrencia`), ADD UNIQUE KEY `fk_item_principal` (`fk_item_principal`,`fk_item_decorrente`);

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
  MODIFY `id_classificacao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tb_departamento`
--
ALTER TABLE `tb_departamento`
  MODIFY `id_depto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_eixo`
--
ALTER TABLE `tb_eixo`
  MODIFY `id_eixo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=131;
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
-- AUTO_INCREMENT for table `tb_regra_classificacao`
--
ALTER TABLE `tb_regra_classificacao`
  MODIFY `id_regra_classificacao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=184;
--
-- AUTO_INCREMENT for table `tb_regra_decorrente`
--
ALTER TABLE `tb_regra_decorrente`
  MODIFY `id_decorrencia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tb_subeixo`
--
ALTER TABLE `tb_subeixo`
  MODIFY `id_subeixo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `tb_tipoclassificacao`
--
ALTER TABLE `tb_tipoclassificacao`
  MODIFY `id_tipoclass` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_titulo`
--
ALTER TABLE `tb_titulo`
  MODIFY `id_titulo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
