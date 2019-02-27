-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 27-Fev-2019 às 16:34
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistema_financeiro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `boletos`
--

DROP TABLE IF EXISTS `boletos`;
CREATE TABLE IF NOT EXISTS `boletos` (
  `id` bigint(20) NOT NULL,
  `banco` varchar(100) NOT NULL,
  `pagina` varchar(150) NOT NULL,
  `prazo` int(11) NOT NULL COMMENT 'dias',
  `taxa` double NOT NULL,
  `conta_cedente` int(11) NOT NULL,
  `conta_cedente_d` int(11) NOT NULL,
  `agencia` int(11) NOT NULL,
  `agencia_d` int(11) NOT NULL,
  `conta` int(11) NOT NULL,
  `conta_d` int(11) NOT NULL,
  `carteira` varchar(10) NOT NULL,
  `carteira_descricao` varchar(100) NOT NULL,
  `identificacao` varchar(150) NOT NULL,
  `cpf_cnpj` varchar(18) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cedente` varchar(100) NOT NULL,
  `convenio` int(11) NOT NULL,
  `contrato` int(11) NOT NULL,
  `instrucoes1` varchar(100) NOT NULL,
  `instrucoes2` varchar(100) NOT NULL,
  `instrucoes3` varchar(100) NOT NULL,
  `instrucoes4` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '2' COMMENT '1=ativo/2=inativo',
  `obs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartoes`
--

DROP TABLE IF EXISTS `cartoes`;
CREATE TABLE IF NOT EXISTS `cartoes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `bandeira` int(1) NOT NULL COMMENT '1=visa / 2=mastercard / 3=diners / 4=amex / 5=hipercard',
  `final` varchar(4) NOT NULL,
  `fechamento` varchar(2) NOT NULL,
  `vencimento` varchar(2) NOT NULL,
  `limite` double NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1=ativo / 2=inativo',
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartoesgastos`
--

DROP TABLE IF EXISTS `cartoesgastos`;
CREATE TABLE IF NOT EXISTS `cartoesgastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cartao` int(11) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `valor` double NOT NULL,
  `datadacompra` date NOT NULL,
  `data` datetime NOT NULL,
  `obs` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_filial` bigint(20) NOT NULL,
  `id_conheceu` bigint(20) NOT NULL,
  `tipo` int(1) NOT NULL COMMENT '1=juridica/2=fisica',
  `nome` varchar(150) NOT NULL,
  `fantasia` varchar(200) NOT NULL,
  `razao` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `nascimento` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `orgao` varchar(50) NOT NULL,
  `endereco` text NOT NULL,
  `cep` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `tel1` varchar(15) NOT NULL,
  `tel2` varchar(15) NOT NULL,
  `tel3` varchar(15) NOT NULL,
  `obs` text NOT NULL,
  `data` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1=ativo/2=inativo',
  `id_admin` bigint(20) NOT NULL,
  `nome_cartao` int(11) DEFAULT NULL,
  `numero_cartao` int(50) DEFAULT NULL,
  `cli_for` int(11) NOT NULL COMMENT '1=cliente/2=Fornecedor',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `id_filial`, `id_conheceu`, `tipo`, `nome`, `fantasia`, `razao`, `email`, `nascimento`, `cpf`, `cnpj`, `rg`, `orgao`, `endereco`, `cep`, `bairro`, `cidade`, `uf`, `tel1`, `tel2`, `tel3`, `obs`, `data`, `status`, `id_admin`, `nome_cartao`, `numero_cartao`, `cli_for`) VALUES
(31, 7, 1, 2, 'ssss', 'ssss', '', 'aldysalvino@gmail.com', '2019-12-25', '111.111.111-11', '', '1111', '1111', '111111', '11.111-111', '111', '111', 'AC', '(11) 1111-11111', '', '', '', '2019-02-25 16:31:34', 1, 1, NULL, NULL, 0),
(32, 7, 1, 1, 'FORNEC', 'FONECEDOR 1', 'FORNECEDOR 1', 'teste@teste.com', '2019-02-26', '', '11.111.111/1111-11', '', '', 'WWWWWWWWWWWWW', '11.111-111', 'KKKKKKKKKK', 'OOOOOOO', 'AC', '(11) 1111-11111', '', '', '', '2019-02-26 01:47:53', 1, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores`
--

DROP TABLE IF EXISTS `colaboradores`;
CREATE TABLE IF NOT EXISTS `colaboradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `rg` varchar(100) NOT NULL,
  `banco` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `salario` float NOT NULL,
  `salario2` float NOT NULL,
  `data_salario2` date NOT NULL,
  `minimo` varchar(8) NOT NULL,
  `valor_semana` float NOT NULL,
  `valor_22_6` float NOT NULL,
  `valor_sab` float NOT NULL,
  `valor_dom` float NOT NULL,
  `valor_night` float NOT NULL,
  `valor_night2` float NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `cart_trab` varchar(100) NOT NULL,
  `pis` varchar(50) NOT NULL,
  `admissao` date NOT NULL,
  `endereco` int(255) NOT NULL,
  `tel1` int(14) NOT NULL,
  `tel2` int(14) NOT NULL,
  `tel3` int(14) NOT NULL,
  `obs` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conheceu`
--

DROP TABLE IF EXISTS `conheceu`;
CREATE TABLE IF NOT EXISTS `conheceu` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `conheceu`
--

INSERT INTO `conheceu` (`id`, `nome`, `data`) VALUES
(1, 'Google', '2013-12-20 17:19:19'),
(2, 'Outros', '2013-12-19 21:28:15'),
(3, 'Facebook', '2013-12-19 21:27:51'),
(4, 'Yahoo', '2014-01-15 19:40:15'),
(5, 'Twitter', '2014-01-15 19:41:15'),
(6, 'Instagram', '2014-01-15 19:41:22'),
(7, 'Indicação ', '2014-01-17 01:58:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contasapagar`
--

DROP TABLE IF EXISTS `contasapagar`;
CREATE TABLE IF NOT EXISTS `contasapagar` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_fornecedor` bigint(20) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `valor` double NOT NULL,
  `valor_pago` double NOT NULL,
  `vencimento` date NOT NULL,
  `pagamento` date NOT NULL,
  `obs` text NOT NULL,
  `data` datetime NOT NULL,
  `id_pagamento` int(11) NOT NULL,
  `compra` date NOT NULL,
  `id_aquisicao` int(11) NOT NULL,
  `parcelamento` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `faturas`
--

DROP TABLE IF EXISTS `faturas`;
CREATE TABLE IF NOT EXISTS `faturas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) NOT NULL,
  `vencimento` date NOT NULL,
  `enviado` datetime NOT NULL,
  `reenviado` datetime NOT NULL,
  `visualizado` datetime NOT NULL,
  `dia` int(1) NOT NULL DEFAULT '0',
  `dois` int(1) NOT NULL DEFAULT '0',
  `cinco` int(1) NOT NULL DEFAULT '0',
  `fechado` date NOT NULL,
  `id_servico1` int(11) NOT NULL,
  `id_servico2` int(11) NOT NULL,
  `id_servico3` int(11) NOT NULL,
  `id_servico4` int(11) NOT NULL,
  `id_servico5` int(11) NOT NULL,
  `valor1` double NOT NULL,
  `valor2` double NOT NULL,
  `valor3` double NOT NULL,
  `valor4` double NOT NULL,
  `valor5` double NOT NULL,
  `obs` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=aberto / 2=enviado / 3=reenviado / 4=visualizado / 5=fechado',
  `data` datetime NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_pagamento` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `filiais`
--

DROP TABLE IF EXISTS `filiais`;
CREATE TABLE IF NOT EXISTS `filiais` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `filiais`
--

INSERT INTO `filiais` (`id`, `nome`, `data`) VALUES
(7, 'GERAL', '2019-02-25 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
CREATE TABLE IF NOT EXISTS `fornecedores` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `intermediarios`
--

DROP TABLE IF EXISTS `intermediarios`;
CREATE TABLE IF NOT EXISTS `intermediarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=ativo / 2=inativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `intermediarios`
--

INSERT INTO `intermediarios` (`id`, `nome`, `email`, `status`) VALUES
(1, 'PagSeguro Uol', 'email@email.com', 2),
(2, 'PayPal', 'email@email.com', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

DROP TABLE IF EXISTS `mensagens`;
CREATE TABLE IF NOT EXISTS `mensagens` (
  `id` bigint(20) NOT NULL,
  `id_col` bigint(20) NOT NULL,
  `id_col2` bigint(20) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipopagamento`
--

DROP TABLE IF EXISTS `tipopagamento`;
CREATE TABLE IF NOT EXISTS `tipopagamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipopagamento`
--

INSERT INTO `tipopagamento` (`id`, `nome`, `data`) VALUES
(5, 'BB-J', '2015-03-12'),
(6, 'BB-P', '2015-03-12'),
(7, 'ITAÚ-P', '2015-03-12'),
(8, 'ITAÚ-J', '2015-03-12'),
(9, 'CASH', '2015-03-12'),
(10, 'CARTÃO BBJ-12', '2015-03-12'),
(11, 'CARTÃO BBP-12', '2015-03-12'),
(12, 'CARTÃO SANT-08', '2015-03-12'),
(13, 'CARTÃO ITAÚ P -17', '2015-03-12'),
(14, 'CHEQUE BBJ', '2015-03-12'),
(15, 'CHEQUE BBP', '2015-03-12'),
(16, 'CHEQUE ITAÚ-P', '2015-03-12'),
(17, 'CHEQUE ITAU-J', '2015-03-12'),
(18, 'BOLETO BANCÁRIO', '2015-11-05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiposervicos`
--

DROP TABLE IF EXISTS `tiposervicos`;
CREATE TABLE IF NOT EXISTS `tiposervicos` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `id_func` int(11) NOT NULL COMMENT 'id de colaborador no banco de funcionarios',
  PRIMARY KEY (`id`,`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `login`, `senha`, `id_func`) VALUES
(1, 'Teste usuario', 'email@email.com.br', 'teste', 'VkZaU1NtVnJOVUpRVkRBOQ==', 20);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
