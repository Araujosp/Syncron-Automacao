-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/05/2026 às 15:21
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `syncron`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tipo_cliente` enum('PF','PJ') NOT NULL,
  `data_cadastro` date NOT NULL DEFAULT curdate(),
  `documento` varchar(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `telefone`, `email`, `tipo_cliente`, `data_cadastro`, `documento`) VALUES
(1, 'João Silva', '(11) 98765-4321', 'joao.silva@email.com', 'PF', '2026-05-14', '123.456.789-00'),
(2, 'Maria Oliveira', '(11) 99876-5432', 'maria.oliveira@email.com', 'PF', '2026-05-14', '987.654.321-00'),
(3, 'Carlos Souza', '(11) 97654-3210', 'carlos.souza@email.com', 'PF', '2026-05-14', '456.789.123-00'),
(4, 'Tech Solutions LTDA', '(11) 4002-8922', 'contato@techsolutions.com.br', 'PJ', '2026-05-14', '12.345.678/0001-90'),
(5, 'Mercado Central LTDA', '(11) 4333-2211', 'financeiro@mercadocentral.com.br', 'PJ', '2026-05-14', '98.765.432/0001-10'),
(6, 'Ana Pereira', '(11) 91234-5678', 'ana.pereira@email.com', 'PF', '2026-05-14', '321.654.987-00'),
(7, 'Construtora Alpha SA', '(11) 4555-6677', 'contato@alpha.com.br', 'PJ', '2026-05-14', '55.444.333/0001-22');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `telefone` (`telefone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `documento` (`documento`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
