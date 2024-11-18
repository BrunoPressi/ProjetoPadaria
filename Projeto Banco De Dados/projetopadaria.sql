-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 18/11/2024 às 03:39
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
-- Banco de dados: `projetopadaria`
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

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `cpf`, `nome`, `telefone`) VALUES
(1, '123.456.789-00', 'João Silva', '(11) 91234-5678'),
(2, '987.654.321-00', 'Maria Oliveira', '(21) 98765-4321'),
(3, '456.123.789-01', 'Carlos Souza', '(31) 99876-5432'),
(4, '321.654.987-02', 'Ana Costa', '(41) 96543-2109'),
(5, '654.987.321-03', 'Patricia Lima', '(51) 93456-7890'),
(6, '789.321.654-04', 'Marcos Pereira', '(61) 92345-6789'),
(7, '852.963.741-05', 'Fernanda Alves', '(71) 91234-6789'),
(8, '741.852.963-06', 'Gabriel Fernandes', '(81) 90012-3456'),
(9, '369.258.147-07', 'Laura Rodrigues', '(91) 93214-8765'),
(10, '258.147.369-08', 'Eduardo Martins', '(51) 91345-6789');

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

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `cpf`, `nome`, `telefone`, `salario`, `cargo`) VALUES
(1, '345.876.234-09', 'Renato Costa', '(11) 91234-5678', 2500.00, 'Padeiro'),
(2, '678.234.567-89', 'Juliana Mendes', '(21) 98765-4321', 3000.00, 'Caixa'),
(3, '456.987.321-45', 'Igor Almeida', '(31) 99876-5432', 3200.00, 'Confeiteiro'),
(4, '923.741.658-12', 'Paula Martins', '(41) 96543-2109', 2800.00, 'Gerente'),
(5, '567.432.890-23', 'Felipe Souza', '(51) 93456-7890', 2200.00, 'Auxiliar de Produção'),
(6, '789.234.561-34', 'Beatriz Rocha', '(61) 92345-6789', 3500.00, 'Supervisor de Produção'),
(7, '892.365.478-56', 'Vanessa Oliveira', '(71) 91234-6789', 1800.00, 'Atendente'),
(8, '123.876.543-78', 'Marcos Silva', '(81) 90012-3456', 2400.00, 'Padeiro'),
(9, '234.567.890-12', 'Carolina Pereira', '(91) 93214-8765', 2000.00, 'Atendente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_venda`
--

CREATE TABLE `itens_venda` (
  `codigo_produto` int(11) NOT NULL,
  `codigo_venda` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens_venda`
--

INSERT INTO `itens_venda` (`codigo_produto`, `codigo_venda`, `quantidade`, `valor_unitario`) VALUES
(1, 1, 10, 0.80),
(2, 2, 3, 2.50),
(2, 6, 2, 2.50),
(3, 4, 2, 15.00),
(3, 6, 1, 15.00),
(7, 3, 1, 15.00);

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

--
-- Despejando dados para a tabela `pagamento`
--

INSERT INTO `pagamento` (`id`, `valor_pago`, `data_pagamento`, `forma_pagamento`, `fk_cliente_id`, `fk_venda_codigo`) VALUES
(1, 8.00, '2024-10-05', 'cartão', 7, 1),
(2, 7.50, '2024-06-03', 'pix', 8, 2),
(3, 18.00, '2024-11-11', 'dinheiro', 7, 3),
(4, 30.00, '2024-08-01', 'pix', 2, 4),
(5, 7.50, '2022-05-04', 'cartão', 10, 5),
(6, 20.00, '2024-06-11', 'dinheiro', 2, 6);

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

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`codigo`, `nome`, `preco`, `categoria`, `quantidade_em_estoque`) VALUES
(1, 'Pão Francês', 0.80, 'Pães', 200),
(2, 'Pão de Queijo', 2.50, 'Salgados', 150),
(3, 'Bolo de Chocolate', 15.00, 'Bolos', 50),
(4, 'Croissant', 3.00, 'Salgados', 100),
(5, 'Bolo de Fubá', 12.00, 'Bolos', 40),
(6, 'Pão Integral', 1.50, 'Pães', 180),
(7, 'Torta de Morango', 18.00, 'Tortas', 30),
(8, 'Pão de Mel', 2.20, 'Pães', 120),
(9, 'Pudim de Leite', 10.00, 'Doces', 60),
(10, 'Biscoito de Polvilho', 5.50, 'Salgados', 200);

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
-- Despejando dados para a tabela `venda`
--

INSERT INTO `venda` (`codigo`, `valor_total`, `quantidade_total`, `fk_cliente_id`, `fk_funcionario_id`) VALUES
(1, 8.00, 10, 7, 9),
(2, 7.50, 3, 8, 7),
(3, 15.00, 1, 7, 9),
(4, 30.00, 2, 2, 7),
(5, 7.50, 5, 10, 7),
(6, 20.00, 3, 2, 7);

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
