-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/05/2026 às 15:25
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
  `categoria` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome`, `data_cadastro`, `quantidade_estoque`, `preco_unitario`, `descricao`, `categoria`) VALUES
(1, 'Notebook Dell ', '2026-05-14', 15, 3499.90, 'Notebook com processador Intel i5, 8GB RAM e SSD 512GB.', 'Informática'),
(2, 'Mouse Gamer Redragon', '2026-05-14', 40, 129.90, 'Mouse gamer RGB com 7200 DPI e 7 botões programáveis.', 'Periféricos'),
(3, 'Teclado Mecânico HyperX', '2026-05-14', 20, 289.90, 'Teclado mecânico RGB com switches red.', 'Periféricos'),
(4, 'Monitor LG 24 Polegadas', '2026-05-14', 10, 899.90, 'Monitor Full HD IPS de 24 polegadas.', 'Monitores'),
(5, 'Cadeira Gamer XT Racer', '2026-05-14', 8, 1199.90, 'Cadeira ergonômica gamer com ajuste de altura.', 'Móveis'),
(6, 'SSD Kingston 1TB', '2026-05-14', 30, 459.90, 'SSD SATA 1TB para alta velocidade de leitura e gravação.', 'Armazenamento'),
(7, 'Headset Logitech G435', '2026-05-14', 18, 399.90, 'Headset gamer sem fio com microfone integrado.', 'Áudio'),
(8, 'Smartphone Samsung Galaxy A55', '2026-05-14', 12, 2199.90, 'Smartphone com 256GB de armazenamento e câmera tripla.', 'Celulares'),
(9, 'Impressora Epson EcoTank', '2026-05-14', 6, 1499.90, 'Impressora multifuncional com tanque de tinta.', 'Impressoras'),
(10, 'Webcam Logitech C920', '2026-05-14', 25, 349.90, 'Webcam Full HD ideal para reuniões e streaming.', 'Acessórios'),
(11, 'Processador Ryzen 7 5700X', '2026-05-14', 14, 1299.90, 'Processador AMD Ryzen 7 com 8 núcleos e 16 threads.', 'Hardware'),
(12, 'Placa de Vídeo RTX 4060', '2026-05-14', 7, 2599.90, 'Placa de vídeo NVIDIA RTX 4060 com 8GB GDDR6.', 'Hardware'),
(13, 'Memória RAM Corsair 16GB', '2026-05-14', 35, 319.90, 'Memória DDR4 3200MHz para alto desempenho.', 'Hardware'),
(14, 'Gabinete Gamer Rise Mode', '2026-05-14', 11, 279.90, 'Gabinete gamer com lateral em vidro temperado.', 'Hardware'),
(15, 'Fonte Corsair 650W', '2026-05-14', 16, 499.90, 'Fonte 80 Plus Bronze com proteção contra surtos.', 'Hardware'),
(16, 'Roteador TP-Link Archer C6', '2026-05-14', 22, 249.90, 'Roteador dual band com velocidade de até 1200Mbps.', 'Redes'),
(17, 'Switch 8 Portas Intelbras', '2026-05-14', 18, 139.90, 'Switch ethernet de 8 portas gigabit.', 'Redes'),
(18, 'HD Externo Seagate 2TB', '2026-05-14', 13, 579.90, 'HD externo portátil USB 3.0 com 2TB.', 'Armazenamento'),
(19, 'Caixa de Som JBL Go 3', '2026-05-14', 28, 229.90, 'Caixa de som bluetooth portátil resistente à água.', 'Áudio'),
(20, 'Microfone Fifine K669B', '2026-05-14', 19, 249.90, 'Microfone condensador USB para streaming e gravações.', 'Áudio'),
(21, 'Mesa Digitalizadora Wacom One', '2026-05-14', 5, 799.90, 'Mesa digitalizadora para design gráfico e ilustração.', 'Periféricos'),
(22, 'Controle Xbox Series', '2026-05-14', 17, 399.90, 'Controle sem fio compatível com PC e Xbox.', 'Games'),
(23, 'PlayStation 5 Slim', '2026-05-14', 4, 3899.90, 'Console Sony PlayStation 5 versão Slim.', 'Games'),
(24, 'Nintendo Switch OLED', '2026-05-14', 6, 2399.90, 'Console híbrido com tela OLED de 7 polegadas.', 'Games'),
(25, 'Smart TV Samsung 50\"', '2026-05-14', 9, 2899.90, 'Smart TV 4K UHD com sistema Tizen.', 'Televisores'),
(26, 'Ventilador Arno Turbo', '2026-05-14', 20, 189.90, 'Ventilador silencioso com 6 pás.', 'Eletrodomésticos'),
(27, 'Air Fryer Mondial 5L', '2026-05-14', 14, 429.90, 'Fritadeira elétrica sem óleo com capacidade de 5 litros.', 'Eletrodomésticos'),
(28, 'Cafeteira Nespresso Essenza', '2026-05-14', 8, 599.90, 'Cafeteira expresso compacta para cápsulas.', 'Eletrodomésticos'),
(29, 'Smartwatch Xiaomi Redmi Watch', '2026-05-14', 24, 349.90, 'Relógio inteligente com monitor cardíaco.', 'Wearables'),
(30, 'Tablet Samsung Galaxy Tab S9', '2026-05-14', 7, 3299.90, 'Tablet Android com tela AMOLED e caneta S Pen.', 'Tablets');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_sistema`
--

CREATE TABLE `usuarios_sistema` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `data_cadastro` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `usuarios_sistema`
--
ALTER TABLE `usuarios_sistema`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

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
