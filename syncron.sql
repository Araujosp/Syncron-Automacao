-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/05/2026 às 14:42
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedidos`
--

CREATE TABLE `itens_pedidos` (
  `id_item` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade_item` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_pedido` date NOT NULL DEFAULT curdate(),
  `status_pagamento` enum('Pendente','Realizado') NOT NULL,
  `status_geral` enum('Pendente','Em trânsito','Entregue','Cancelado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `data_cadastro` date NOT NULL DEFAULT curdate(),
  `quantidade_estoque` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `categoria` varchar(40) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome`, `data_cadastro`, `quantidade_estoque`, `preco_unitario`, `descricao`, `categoria`, `foto`) VALUES
(1, 'Notebook Dell ', '2026-05-14', 15, 3499.90, 'Notebook com processador Intel i5, 8GB RAM e SSD 512GB.', 'Sensores', NULL),
(2, 'Mouse Gamer Redragon', '2026-05-14', 40, 129.90, 'Mouse gamer RGB com 7200 DPI e 7 botões programáveis.', 'Fontes Industriais', NULL),
(3, 'Teclado Mecânico HyperX', '2026-05-14', 20, 289.90, 'Teclado mecânico RGB com switches red.', 'Periféricos', NULL),
(7, 'Headset Logitech G435', '2026-05-14', 18, 399.90, 'Headset gamer sem fio com microfone integrado.', 'Áudio', NULL),
(8, 'Smartphone Samsung Galaxy A55', '2026-05-14', 12, 2199.90, 'Smartphone com 256GB de armazenamento e câmera tripla.', 'Celulares', NULL),
(31, 'teste', '2026-05-20', 252, 250.00, '', 'Sensores', 'uploads/31/Produto_6a0db2c2d38da.jpeg'),
(32, 'IHM', '2026-05-20', 67, 124.00, '', 'Sensores', 'uploads/32/Produto_6a0db336959e7.webp'),
(33, 'teste', '2026-05-20', 50, 250.00, 'Controladores programáveis com IHM incorporada Família XL - CLPs & IHMs - Controle e Indicação de Processos - CIP - Produtos - NOVUS Automation ', 'IHMs', 'uploads/33/Produto_6a0dbc2770da6.webp');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_sistema`
--

CREATE TABLE `usuarios_sistema` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `data_cadastro` date NOT NULL DEFAULT curdate(),
  `foto_perfil` varchar(255) DEFAULT NULL,
  `tipo_usuario` enum('sistema') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios_sistema`
--

INSERT INTO `usuarios_sistema` (`id_usuario`, `nome`, `usuario`, `senha`, `cpf`, `cargo`, `data_cadastro`, `foto_perfil`, `tipo_usuario`) VALUES
(1, 'Rafael Yu', 'rafael', '$2y$10$..Z/qALUB1M6QsoLqoJO6ekS2.RbfVwwAWzumJZ.bGBQ5PpPHqQa.', '11785567891', 'Funcionario', '2026-05-19', 'rafael.jpeg', 'sistema'),
(2, 'Derick Condolo', 'derick', '$2y$10$EkBf4X0L74/itLlwLz2/QuHhjnFIIrX8.eyzHK59rygEPT214pXfO', '21025479768', 'Funcionario', '2026-05-19', 'derick.jpeg', 'sistema'),
(3, 'Nicole Hanai', 'nicole', '$2y$10$sk55POn/USu0/h2GCN7Z3e3PCWU.vZrTFhZKBFrpbSytplgIsrJlm', '33895657789', 'Funcionario', '2026-05-19', 'nicole.jpeg', 'sistema'),
(4, 'Gabriel Araujo', 'gabriel', '$2y$10$JuRbd8bOqql7BZ4KVZKsCOEP6FHi6GkWtOhXA9ie6C//i9LTKQnCC', '445449874589', 'Administrador', '2026-05-19', 'gabriel.jpeg', 'sistema');

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
-- Índices de tabela `itens_pedidos`
--
ALTER TABLE `itens_pedidos`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `usuarios_sistema`
--
ALTER TABLE `usuarios_sistema`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `itens_pedidos`
--
ALTER TABLE `itens_pedidos`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `usuarios_sistema`
--
ALTER TABLE `usuarios_sistema`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_pedidos`
--
ALTER TABLE `itens_pedidos`
  ADD CONSTRAINT `itens_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `itens_pedidos_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
