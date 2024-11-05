-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 05/11/2024 às 16:15
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_padaria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `salario` decimal(10,2) NOT NULL,
  `cargo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--------------------------------------------------------

--
-- Estrutura para tabela `itens_venda`
--

CREATE TABLE `itens_venda` (
  `codigo_produto` int(11) NOT NULL,
  `codigo_venda` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `id` int(11) NOT NULL,
  `valor_pago` decimal(10,2) NOT NULL,
  `data_pagamento` date NOT NULL,
  `forma_pagamento` enum('cartão','dinheiro','pix') DEFAULT NULL,
  `fk_cliente_id` int(11) DEFAULT NULL,
  `fk_venda_codigo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria` varchar(30) DEFAULT NULL,
  `quantidade_em_estoque` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `codigo` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantidade_total` int(11) DEFAULT NULL,
  `fk_cliente_id` int(11) DEFAULT NULL,
  `fk_funcionario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD PRIMARY KEY (`codigo_produto`,`codigo_venda`),
  ADD KEY `codigo_venda` (`codigo_venda`);

--
-- Índices de tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_id` (`fk_cliente_id`),
  ADD KEY `fk_venda_codigo` (`fk_venda_codigo`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_cliente_id` (`fk_cliente_id`),
  ADD KEY `fk_funcionario_id` (`fk_funcionario_id`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD CONSTRAINT `itens_venda_ibfk_1` FOREIGN KEY (`codigo_produto`) REFERENCES `produto` (`codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `itens_venda_ibfk_2` FOREIGN KEY (`codigo_venda`) REFERENCES `venda` (`codigo`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `pagamento_ibfk_1` FOREIGN KEY (`fk_cliente_id`) REFERENCES `cliente` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pagamento_ibfk_2` FOREIGN KEY (`fk_venda_codigo`) REFERENCES `venda` (`codigo`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`fk_cliente_id`) REFERENCES `cliente` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`fk_funcionario_id`) REFERENCES `funcionario` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
