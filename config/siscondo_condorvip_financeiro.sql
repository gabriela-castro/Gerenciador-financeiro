-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_financeiro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `boletos`
--

CREATE TABLE `boletos` (
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
-- Estrutura para tabela `cartoes`
--

CREATE TABLE `cartoes` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `bandeira` int(1) NOT NULL COMMENT '1=visa / 2=mastercard / 3=diners / 4=amex / 5=hipercard',
  `final` varchar(4) NOT NULL,
  `fechamento` varchar(2) NOT NULL,
  `vencimento` varchar(2) NOT NULL,
  `limite` double NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1=ativo / 2=inativo',
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cartoesgastos`
--

CREATE TABLE `cartoesgastos` (
  `id` int(11) NOT NULL,
  `id_cartao` int(11) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `valor` double NOT NULL,
  `datadacompra` date NOT NULL,
  `data` datetime NOT NULL,
  `obs` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) NOT NULL,
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
  `numero_cartao` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estrutura para tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL,
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
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conheceu`
--

CREATE TABLE `conheceu` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `conheceu`
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
-- Estrutura para tabela `contasapagar`
--

CREATE TABLE `contasapagar` (
  `id` bigint(20) NOT NULL,
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
  `parcelamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------
--
-- Estrutura para tabela `faturas`
--

CREATE TABLE `faturas` (
  `id` bigint(20) NOT NULL,
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
  `id_pagamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- -----------------------------------------------------------------------------
--
-- Estrutura para tabela `filiais`
--

CREATE TABLE `filiais` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estrutura para tabela `intermediarios`
--

CREATE TABLE `intermediarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=ativo / 2=inativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `intermediarios`
--

INSERT INTO `intermediarios` (`id`, `nome`, `email`, `status`) VALUES
(1, 'PagSeguro Uol', 'email@email.com', 2),
(2, 'PayPal', 'email@email.com', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` bigint(20) NOT NULL,
  `id_col` bigint(20) NOT NULL,
  `id_col2` bigint(20) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipopagamento`
--

CREATE TABLE `tipopagamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tipopagamento`
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
-- Estrutura para tabela `tiposervicos`
--

CREATE TABLE `tiposervicos` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `id_func` int(11) NOT NULL COMMENT 'id de colaborador no banco de funcionarios'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuarios`
-- usuario: teste, pwd: 1234


INSERT INTO `usuarios` (`id`, `nome`, `email`, `login`, `senha`, `id_func`) VALUES
(1, 'Teste usuario', 'email@email.com.br', 'teste', 'VkZaU1NtVnJOVUpRVkRBOQ==', 20)

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `boletos`
--
ALTER TABLE `boletos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cartoes`
--
ALTER TABLE `cartoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cartoesgastos`
--
ALTER TABLE `cartoesgastos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `conheceu`
--
ALTER TABLE `conheceu`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contasapagar`
--
ALTER TABLE `contasapagar`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `faturas`
--
ALTER TABLE `faturas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `filiais`
--
ALTER TABLE `filiais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `intermediarios`
--
ALTER TABLE `intermediarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipopagamento`
--
ALTER TABLE `tipopagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tiposervicos`
--
ALTER TABLE `tiposervicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`,`login`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `boletos`
--
ALTER TABLE `boletos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cartoes`
--
ALTER TABLE `cartoes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `cartoesgastos`
--
ALTER TABLE `cartoesgastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conheceu`
--
ALTER TABLE `conheceu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `contasapagar`
--
ALTER TABLE `contasapagar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=739;

--
-- AUTO_INCREMENT de tabela `faturas`
--
ALTER TABLE `faturas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=834;

--
-- AUTO_INCREMENT de tabela `filiais`
--
ALTER TABLE `filiais`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `intermediarios`
--
ALTER TABLE `intermediarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipopagamento`
--
ALTER TABLE `tipopagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `tiposervicos`
--
ALTER TABLE `tiposervicos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
