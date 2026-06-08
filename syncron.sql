-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/06/2026 às 15:21
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
  `documento` varchar(18) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `foto_perfil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `telefone`, `email`, `tipo_cliente`, `data_cadastro`, `documento`, `usuario`, `senha`, `foto_perfil`) VALUES
(1, 'João Silva', '(11) 98765-4321', 'joao.silva@email.com', 'PF', '2026-05-14', '123.456.789-00', 'joao1', '$2y$10$.Qfvcbc1VjrPI0PzbkJrWOtFCNuVzug1wYNBPOKheCkTDSOtL2252', ''),
(2, 'Maria Oliveira', '(11) 99876-5432', 'maria.oliveira@email.com', 'PF', '2026-05-14', '987.654.321-00', 'maria2', '$2y$10$UpVYlkxTitBa7zLzkhfbiutESGEiqHRPk8B9B7ltBQvCDfqOjn6Ni', ''),
(3, 'Carlos Souza', '(11) 97654-3210', 'carlos.souza@email.com', 'PF', '2026-05-14', '456.789.123-00', 'carlos3', '$2y$10$v5tkXXGFEZ5ddXSLMIxt7OgsEU/.Y933z.1GFRY2BdZEntcSZ4i9W', ''),
(4, 'Tech Solutions LTDA', '(11) 4002-8922', 'contato@techsolutions.com.br', 'PJ', '2026-05-14', '12.345.678/0001-90', 'tech4', '$2y$10$57M2ikhdOmv4kMDBp36uIepcr6OWOFNuE6csoe3OTuTXYZyNyXZhq', ''),
(5, 'Mercado Central LTDA', '(11) 4333-2211', 'financeiro@mercadocentral.com.br', 'PJ', '2026-05-14', '98.765.432/0001-10', 'mercado5', '$2y$10$eFMKz.RzxE0NZeAb3lGLQuxiF3XNjoqEPlyX3VMSSMlK.n79ZJ8Yi', ''),
(6, 'Ana Pereira', '(11) 91234-5678', 'ana.pereira@email.com', 'PF', '2026-05-14', '321.654.987-00', 'ana6', '$2y$10$ejQswD.bG6e2gWPvNCghKufLReCMUhM3L1ly1jZb3wNkbgxlAkj5u', ''),
(7, 'Construtora Alpha SA', '(11) 4555-6677', 'contato@alpha.com.br', 'PJ', '2026-05-14', '55.444.333/0001-22', 'construtora7', '$2y$10$0FtsHU4yTlY.8lOV2TmayuSSvV5h1sTA3qM6xJIUFo50rJrJSNCba', ''),
(8, 'Lucas Andrade Silva', '(11) 91234-8008', 'lucas.andrade08@teste.com', 'PF', '2026-01-08', '108.456.789-01', 'lucas08', '$2y$10$W16gRlFeU4rxr/SqqGx.aOM5LD7pB0GtLdThxD/CEqaeEMgUDtMOO', ''),
(9, 'Carlos Henrique Lima', '(11) 99123-4501', 'carlos.h.lima09@email.com', 'PF', '2026-01-09', '321.654.987-10', 'carloslima09', '$2y$10$X7k1fM9pQmW8nJ4sL2vY2e6Qz8Kp1rH5dA7sC9fT3uB6xY1zR0nQW', ''),
(10, 'Tech Automação Industrial LTDA', '(11) 4003-7781', 'contato@techautomacaoind.com.br', 'PJ', '2026-01-10', '98.765.432/0001-11', 'techautomacao10', '$2y$10$M4nP8sK2dF7xQ1wZ9rT6uJ3cV5bH0yL8eA2mN7pR4tY6uI1oW3qE', ''),
(11, 'Fernanda Souza Alves', '(11) 99771-8822', 'fernanda.s.alves11@email.com', 'PF', '2026-01-11', '852.741.963-22', 'fernandaalves11', '$2y$10$Q9vL3xT7mN1pR5sD8fH2kJ6wZ0yB4uC7eA9nM3qW1tY5rU8iO2pL', ''),
(12, 'Indústria Nova Automação LTDA', '(11) 4000-1212', 'contato@novaautomacao12.com.br', 'PJ', '2026-01-12', '12.456.789/0001-12', 'novaauto12', '$2y$10$LGc3b7G7BmphELc6eUsnd.88H1S9Ml2214cKIbALbLOy3PEnYcPU6', ''),
(13, 'EletroMax Comércio Industrial', '(11) 3558-9914', 'vendas@eletromaxind.com.br', 'PJ', '2026-01-13', '11.222.333/0001-44', 'eletromax13', '$2y$10$A1bC3dE5fG7hI9jK2lM4nO6pQ8rS0tU2vW4xY6zA8bC1dE3fG5hI', ''),
(14, 'Ricardo Mendes Pereira', '(11) 98854-6673', 'ricardo.m.pereira14@email.com', 'PF', '2026-01-14', '159.357.486-20', 'ricardom14', '$2y$10$Z8xC6vB4nM2qW1eR3tY5uI7oP9aS1dF3gH5jK7lL9xX2cV4bN6mQ', ''),
(15, 'Mariana Costa Ferreira', '(11) 99321-4515', 'mariana.costa15@teste.com', 'PF', '2026-01-15', '215.789.456-15', 'mariana15', '$2y$10$bYOshIl7FoxJRofhX2PhcOSr4rzmdxfMdDqJQVeFkLAc3C4iYPerS', ''),
(16, 'Global Tech Solutions LTDA', '(11) 4016-1616', 'suporte@globaltech16.com.br', 'PJ', '2026-01-16', '16.789.123/0001-16', 'globaltech16', '$2y$10$3GKexANivhr8HQahVIGS1OfJBCEmKGkRYwW/JyJPtAosVy/.CGCCm', ''),
(17, 'Rafael Almeida Santos', '(11) 99717-1717', 'rafael.almeida17@teste.com', 'PF', '2026-01-17', '317.456.789-17', 'rafael17', '$2y$10$lPlUYC7NioMmaVJlrVcrNOr9rl4C7ydcX71xqjVL/1zKOGFp/55K2', ''),
(18, 'Construtech Automação LTDA', '(11) 4000-1818', 'contato@construtech18.com.br', 'PJ', '2026-01-18', '18.111.222/0001-18', 'construtech18', '$2y$10$hash18', ''),
(19, 'Bruno Henrique Souza', '(11) 99190-1919', 'bruno.souza19@teste.com', 'PF', '2026-01-19', '118.456.789-19', 'bruno19', '$2y$10$hash19', ''),
(20, 'Industria Alpha Sistemas LTDA', '(11) 4000-2020', 'contato@alpha20.com.br', 'PJ', '2026-01-20', '20.111.222/0001-20', 'alpha20', '$2y$10$hash20', ''),
(21, 'Juliana Pereira Lima', '(11) 99201-2121', 'juliana.lima21@teste.com', 'PF', '2026-01-21', '121.456.789-21', 'juliana21', '$2y$10$hash21', ''),
(22, 'Smart Indústria Digital LTDA', '(11) 4000-2222', 'contato@smart22.com.br', 'PJ', '2026-01-22', '22.111.222/0001-22', 'smart22', '$2y$10$hash22', ''),
(23, 'Paulo Ricardo Martins', '(11) 99223-2323', 'paulo.martins23@teste.com', 'PF', '2026-01-23', '123.456.789-23', 'paulo23', '$2y$10$hash23', ''),
(24, 'Neo Industrial Tech LTDA', '(11) 4000-2424', 'contato@neo24.com.br', 'PJ', '2026-01-24', '24.111.222/0001-24', 'neo24', '$2y$10$hash24', ''),
(25, 'Aline Costa Ribeiro', '(11) 99225-2525', 'aline.ribeiro25@teste.com', 'PF', '2026-01-25', '125.456.789-25', 'aline25', '$2y$10$hash25', ''),
(26, 'Omega Automação LTDA', '(11) 4000-2626', 'contato@omega26.com.br', 'PJ', '2026-01-26', '26.111.222/0001-26', 'omega26', '$2y$10$hash26', ''),
(27, 'Thiago Almeida Rocha', '(11) 99227-2727', 'thiago.rocha27@teste.com', 'PF', '2026-01-27', '127.456.789-27', 'thiago27', '$2y$10$hash27', ''),
(28, 'Delta Industrial Solutions LTDA', '(11) 4000-2828', 'contato@delta28.com.br', 'PJ', '2026-01-28', '28.111.222/0001-28', 'delta28', '$2y$10$hash28', ''),
(29, 'Camila Ferreira Santos', '(11) 99229-2929', 'camila.santos29@teste.com', 'PF', '2026-01-29', '129.456.789-29', 'camila29', '$2y$10$hash29', ''),
(30, 'Industrial Prime LTDA', '(11) 4000-3030', 'contato@prime30.com.br', 'PJ', '2026-01-30', '30.111.222/0001-30', 'prime30', '$2y$10$hash30', ''),
(31, 'Eduardo Lima Barbosa', '(11) 99231-3131', 'eduardo.barbosa31@teste.com', 'PF', '2026-02-01', '131.456.789-31', 'eduardo31', '$2y$10$hash31', ''),
(32, 'Future Tech Indústria LTDA', '(11) 4000-3232', 'contato@future32.com.br', 'PJ', '2026-02-02', '32.111.222/0001-32', 'future32', '$2y$10$hash32', ''),
(33, 'Larissa Gomes Nunes', '(11) 99233-3333', 'larissa.nunes33@teste.com', 'PF', '2026-02-03', '133.456.789-33', 'larissa33', '$2y$10$hash33', ''),
(34, 'Industrial Sigma LTDA', '(11) 4000-3434', 'contato@sigma34.com.br', 'PJ', '2026-02-04', '34.111.222/0001-34', 'sigma34', '$2y$10$hash34', ''),
(35, 'Rodrigo Alves Costa', '(11) 99235-3535', 'rodrigo.costa35@teste.com', 'PF', '2026-02-05', '135.456.789-35', 'rodrigo35', '$2y$10$hash35', ''),
(36, 'Atlas Automação LTDA', '(11) 4000-3636', 'contato@atlas36.com.br', 'PJ', '2026-02-06', '36.111.222/0001-36', 'atlas36', '$2y$10$hash36', ''),
(37, 'Marcos Vinicius Andrade', '(11) 99237-3737', 'marcos.andrade37@teste.com', 'PF', '2026-02-07', '137.456.789-37', 'marcos37', '$2y$10$hash37', ''),
(38, 'Industrial Vector LTDA', '(11) 4000-3838', 'contato@vector38.com.br', 'PJ', '2026-02-08', '38.111.222/0001-38', 'vector38', '$2y$10$hash38', ''),
(39, 'Patricia Souza Lima', '(11) 99239-3939', 'patricia.lima39@teste.com', 'PF', '2026-02-09', '139.456.789-39', 'patricia39', '$2y$10$hash39', ''),
(40, 'Industrial Nexus LTDA', '(11) 4000-4040', 'contato@nexus40.com.br', 'PJ', '2026-02-10', '40.111.222/0001-40', 'nexus40', '$2y$10$hash40', ''),
(41, 'Felipe Rodrigues Melo', '(11) 99241-4141', 'felipe.melo41@teste.com', 'PF', '2026-02-11', '141.456.789-41', 'felipe41', '$2y$10$hash41', ''),
(42, 'Industrial Orion LTDA', '(11) 4000-4242', 'contato@orion42.com.br', 'PJ', '2026-02-12', '42.111.222/0001-42', 'orion42', '$2y$10$hash42', ''),
(43, 'Gabriela Martins Silva', '(11) 99243-4343', 'gabriela.silva43@teste.com', 'PF', '2026-02-13', '143.456.789-43', 'gabriela43', '$2y$10$hash43', ''),
(44, 'Industrial Horizon LTDA', '(11) 4000-4444', 'contato@horizon44.com.br', 'PJ', '2026-02-14', '44.111.222/0001-44', 'horizon44', '$2y$10$hash44', ''),
(45, 'Renato Oliveira Dias', '(11) 99245-4545', 'renato.dias45@teste.com', 'PF', '2026-02-15', '145.456.789-45', 'renato45', '$2y$10$hash45', ''),
(46, 'Industrial Vertex LTDA', '(11) 4000-4646', 'contato@vertex46.com.br', 'PJ', '2026-02-16', '46.111.222/0001-46', 'vertex46', '$2y$10$hash46', ''),
(47, 'Carolina Mendes Alves', '(11) 99247-4747', 'carolina.alves47@teste.com', 'PF', '2026-02-17', '147.456.789-47', 'carolina47', '$2y$10$hash47', ''),
(48, 'Industrial Quantum LTDA', '(11) 4000-4848', 'contato@quantum48.com.br', 'PJ', '2026-02-18', '48.111.222/0001-48', 'quantum48', '$2y$10$hash48', ''),
(49, 'Vinicius Costa Rocha', '(11) 99249-4949', 'vinicius.rocha49@teste.com', 'PF', '2026-02-19', '149.456.789-49', 'vinicius49', '$2y$10$hash49', ''),
(50, 'Industrial Apex LTDA', '(11) 4000-5050', 'contato@apex50.com.br', 'PJ', '2026-02-20', '50.111.222/0001-50', 'apex50', '$2y$10$hash50', ''),
(51, 'Rafael Yu', '(11) 99999-2222', 'rafael@gmail.com', 'PF', '2026-05-28', '123.123.123-12', 'rafa2005', '$2y$10$rsa0F7Z1QrCpWiR1B0r3Y.tQawb4GxgTTUkut/Si6DxJ5fENbMBta', 'uploads/usuarios/51/Usuario_6a18386b3e296.webp'),
(52, 'Igor Matos', '(11) 96742-2469', 'iguinhoreidelas@gmail.com', 'PF', '2026-06-01', '123.456.789-67', 'igor', '$2y$10$XWBN3YkoWeJ13WWoIPCoYefgAfZ3gM.f7z8.QJLn0vF0vRp3/6RS.', 'uploads/usuarios/52/Usuario_6a1d81f667dfe.png');

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

--
-- Despejando dados para a tabela `itens_pedidos`
--

INSERT INTO `itens_pedidos` (`id_item`, `id_pedido`, `id_produto`, `quantidade_item`, `preco_unitario`) VALUES
(1, 40, 40, 2, 650.00),
(2, 47, 27, 3, 3350.00),
(3, 13, 6, 4, 2299.99),
(4, 29, 36, 2, 3890.00),
(5, 35, 34, 4, 890.00),
(6, 23, 6, 3, 2299.99),
(7, 47, 43, 2, 3599.00),
(8, 24, 23, 1, 79.90),
(9, 3, 35, 3, 780.00),
(10, 13, 7, 1, 2490.00),
(11, 13, 2, 5, 89.90),
(12, 26, 22, 3, 289.90),
(13, 31, 34, 2, 890.00),
(14, 44, 7, 4, 2490.00),
(15, 46, 4, 3, 320.50),
(16, 40, 13, 3, 1740.00),
(17, 40, 49, 5, 3299.90),
(18, 15, 2, 4, 89.90),
(19, 7, 48, 1, 4100.00),
(20, 35, 5, 3, 35.90),
(21, 12, 13, 5, 1740.00),
(22, 33, 10, 5, 210.75),
(23, 42, 36, 5, 3890.00),
(24, 3, 16, 2, 499.90),
(25, 21, 9, 4, 1199.00),
(26, 3, 14, 4, 98.00),
(27, 34, 32, 3, 189.50),
(28, 12, 48, 3, 4100.00),
(29, 46, 18, 3, 3599.90),
(30, 43, 13, 3, 1740.00),
(31, 6, 2, 1, 89.90),
(32, 31, 30, 1, 2680.00),
(33, 23, 18, 1, 3599.90),
(34, 18, 37, 4, 1250.00),
(35, 30, 49, 3, 3299.90),
(36, 6, 20, 4, 420.00),
(37, 30, 37, 2, 1250.00),
(38, 41, 28, 4, 540.90),
(39, 41, 50, 5, 49.90),
(40, 10, 25, 3, 2150.75),
(41, 19, 14, 4, 98.00),
(42, 46, 20, 2, 420.00),
(43, 27, 42, 1, 2990.00),
(44, 28, 6, 1, 2299.99),
(45, 25, 22, 4, 289.90),
(46, 3, 46, 4, 180.00),
(47, 8, 48, 2, 4100.00),
(48, 35, 41, 2, 115.90),
(49, 45, 16, 3, 499.90),
(50, 1, 10, 4, 210.75),
(51, 23, 32, 1, 189.50),
(52, 14, 7, 3, 2490.00),
(53, 5, 16, 3, 499.90),
(54, 32, 25, 2, 2150.75),
(55, 31, 45, 4, 2750.00),
(56, 17, 39, 5, 4590.00),
(57, 6, 42, 2, 2990.00),
(58, 20, 47, 2, 32.00),
(59, 2, 31, 4, 1999.90),
(60, 6, 41, 3, 115.90),
(61, 43, 34, 3, 890.00),
(62, 43, 20, 5, 420.00),
(63, 11, 49, 3, 3299.90),
(64, 49, 17, 2, 65.00),
(65, 47, 11, 2, 42.30),
(66, 21, 3, 1, 1450.00),
(67, 16, 9, 5, 1199.00),
(68, 12, 38, 5, 58.00),
(69, 3, 49, 2, 3299.90),
(70, 33, 15, 4, 2890.90),
(71, 39, 21, 1, 980.50),
(72, 48, 31, 4, 1999.90),
(73, 33, 9, 2, 1199.00),
(74, 37, 31, 3, 1999.90),
(75, 10, 24, 4, 4200.00),
(76, 43, 37, 4, 1250.00),
(77, 2, 32, 3, 189.50),
(78, 21, 27, 2, 3350.00),
(79, 21, 2, 5, 89.90),
(80, 19, 2, 1, 89.90),
(81, 50, 20, 2, 420.00),
(82, 11, 36, 1, 3890.00),
(83, 30, 48, 3, 4100.00),
(84, 28, 38, 2, 58.00),
(85, 20, 27, 3, 3350.00),
(86, 17, 27, 2, 3350.00),
(87, 34, 2, 2, 89.90),
(88, 27, 50, 4, 49.90),
(89, 32, 50, 5, 49.90),
(90, 50, 18, 1, 3599.90),
(91, 6, 49, 2, 3299.90),
(92, 32, 37, 4, 1250.00),
(93, 2, 49, 2, 3299.90),
(94, 1, 30, 5, 2680.00),
(95, 5, 39, 3, 4590.00),
(96, 41, 46, 5, 180.00),
(97, 6, 1, 1, 1899.90),
(98, 1, 35, 1, 780.00),
(99, 37, 1, 5, 1899.90),
(100, 47, 4, 3, 320.50),
(101, 35, 22, 2, 289.90),
(102, 36, 9, 1, 1199.00),
(103, 48, 39, 1, 4590.00),
(104, 2, 36, 5, 3890.00),
(105, 39, 10, 5, 210.75),
(106, 7, 38, 3, 58.00),
(107, 27, 15, 2, 2890.90),
(108, 19, 42, 4, 2990.00),
(109, 6, 8, 3, 129.90),
(110, 20, 6, 3, 2299.99),
(111, 7, 25, 4, 2150.75),
(112, 5, 8, 5, 129.90),
(113, 11, 29, 4, 29.90),
(114, 22, 1, 2, 1899.90),
(115, 19, 47, 3, 32.00),
(116, 15, 44, 5, 1250.00),
(117, 39, 5, 5, 35.90),
(118, 42, 20, 5, 420.00),
(119, 33, 6, 3, 2299.99),
(120, 31, 31, 2, 1999.90),
(121, 43, 33, 1, 2100.00),
(122, 39, 40, 5, 650.00),
(123, 43, 21, 3, 980.50),
(124, 30, 38, 5, 58.00),
(125, 10, 17, 5, 65.00),
(126, 11, 31, 1, 1999.90),
(127, 1, 40, 1, 650.00),
(128, 1, 50, 5, 49.90),
(129, 17, 25, 5, 2150.75),
(130, 46, 5, 5, 35.90),
(131, 34, 43, 2, 3599.00),
(132, 45, 18, 1, 3599.90),
(133, 13, 12, 5, 3150.00),
(134, 39, 49, 1, 3299.90),
(135, 42, 17, 4, 65.00),
(136, 23, 40, 3, 650.00),
(137, 21, 31, 3, 1999.90),
(138, 14, 8, 2, 129.90),
(139, 28, 19, 5, 1399.99),
(140, 50, 5, 4, 35.90),
(141, 28, 33, 5, 2100.00),
(142, 19, 25, 2, 2150.75),
(143, 23, 29, 2, 29.90),
(144, 7, 14, 3, 98.00),
(145, 7, 9, 3, 1199.00),
(146, 6, 33, 2, 2100.00),
(147, 4, 42, 3, 2990.00),
(148, 29, 27, 3, 3350.00),
(149, 32, 39, 5, 4590.00),
(150, 44, 49, 1, 3299.90);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_pedido` date NOT NULL DEFAULT curdate(),
  `status_pagamento` enum('Pendente','Realizado') NOT NULL,
  `status_geral` enum('Pendente','Em trânsito','Entregue','Cancelado') NOT NULL,
  `desconto_aplicado` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_cliente`, `data_pedido`, `status_pagamento`, `status_geral`, `desconto_aplicado`) VALUES
(1, 1, '2026-01-03', 'Pendente', 'Pendente', 0),
(2, 2, '2026-01-05', 'Realizado', 'Em trânsito', 0),
(3, 3, '2026-01-07', 'Realizado', 'Entregue', 0),
(4, 4, '2026-01-08', 'Pendente', 'Cancelado', 0),
(5, 5, '2026-01-10', 'Realizado', 'Entregue', 0),
(6, 6, '2026-01-12', 'Pendente', 'Pendente', 0),
(7, 7, '2026-01-13', 'Realizado', 'Em trânsito', 0),
(8, 8, '2026-01-14', 'Realizado', 'Entregue', 0),
(9, 12, '2026-01-15', 'Pendente', 'Cancelado', 0),
(10, 15, '2026-01-16', 'Realizado', 'Entregue', 0),
(11, 16, '2026-01-17', 'Pendente', 'Pendente', 0),
(12, 17, '2026-01-18', 'Realizado', 'Em trânsito', 0),
(13, 1, '2026-01-19', 'Realizado', 'Entregue', 0),
(14, 2, '2026-01-20', 'Pendente', 'Cancelado', 0),
(15, 3, '2026-01-21', 'Realizado', 'Entregue', 0),
(16, 4, '2026-01-22', 'Pendente', 'Pendente', 0),
(17, 5, '2026-01-23', 'Realizado', 'Em trânsito', 0),
(18, 6, '2026-01-24', 'Realizado', 'Entregue', 0),
(19, 52, '2026-01-25', 'Pendente', 'Cancelado', 10),
(20, 8, '2026-01-26', 'Realizado', 'Entregue', 0),
(21, 12, '2026-01-27', 'Pendente', 'Pendente', 0),
(22, 15, '2026-01-28', 'Realizado', 'Em trânsito', 0),
(23, 16, '2026-01-29', 'Realizado', 'Entregue', 0),
(24, 17, '2026-01-30', 'Pendente', 'Cancelado', 0),
(25, 1, '2026-02-01', 'Realizado', 'Entregue', 0),
(26, 52, '2026-02-02', 'Pendente', 'Pendente', 0),
(27, 3, '2026-02-03', 'Realizado', 'Em trânsito', 0),
(28, 52, '2026-02-04', 'Realizado', 'Entregue', 0),
(29, 5, '2026-02-05', 'Pendente', 'Cancelado', 0),
(30, 6, '2026-02-06', 'Realizado', 'Entregue', 0),
(31, 7, '2026-02-07', 'Pendente', 'Pendente', 0),
(32, 8, '2026-02-08', 'Realizado', 'Em trânsito', 0),
(33, 12, '2026-02-09', 'Realizado', 'Entregue', 0),
(34, 52, '2026-02-10', 'Pendente', 'Cancelado', 0),
(35, 16, '2026-02-11', 'Realizado', 'Entregue', 0),
(36, 17, '2026-02-12', 'Pendente', 'Pendente', 0),
(37, 1, '2026-02-13', 'Realizado', 'Em trânsito', 0),
(38, 2, '2026-02-14', 'Realizado', 'Entregue', 0),
(39, 3, '2026-02-15', 'Pendente', 'Cancelado', 0),
(40, 4, '2026-02-16', 'Realizado', 'Entregue', 0),
(41, 5, '2026-02-17', 'Pendente', 'Pendente', 0),
(42, 6, '2026-02-18', 'Realizado', 'Em trânsito', 0),
(43, 7, '2026-02-19', 'Realizado', 'Entregue', 0),
(44, 8, '2026-02-20', 'Pendente', 'Cancelado', 0),
(45, 52, '2026-02-21', 'Realizado', 'Entregue', 0),
(46, 15, '2026-02-22', 'Pendente', 'Pendente', 0),
(47, 16, '2026-02-23', 'Realizado', 'Em trânsito', 0),
(48, 17, '2026-02-24', 'Realizado', 'Entregue', 0),
(49, 1, '2026-02-25', 'Pendente', 'Cancelado', 0),
(50, 2, '2026-02-26', 'Realizado', 'Entregue', 0);

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
(1, 'CLP Siemens S7-1200', '2026-01-02', 15, 1899.90, 'Controlador lógico programável compacto para automação industrial.', 'CLPs', NULL),
(2, 'Sensor Indutivo LJ12A3', '2026-01-03', 40, 89.90, 'Sensor indutivo metálico de proximidade 12mm.', 'Sensores', NULL),
(3, 'IHM Weintek MT8071iE', '2026-01-04', 12, 1450.00, 'Interface homem-máquina touchscreen 7 polegadas.', 'IHMs', NULL),
(4, 'Fonte Industrial 24V 10A', '2026-01-05', 25, 320.50, 'Fonte chaveada industrial 24V DC 10A.', 'Fontes Industriais', NULL),
(5, 'Relé Finder 40.52', '2026-01-06', 60, 35.90, 'Relé eletromecânico industrial 24V.', 'Relés', NULL),
(6, 'Inversor WEG CFW300', '2026-01-07', 8, 2299.99, 'Inversor de frequência trifásico para motores.', 'Inversores de Frequência', NULL),
(7, 'CLP Allen Bradley Micro820', '2026-01-08', 10, 2490.00, 'CLP compacto para aplicações industriais.', 'CLPs', NULL),
(8, 'Sensor Fotoelétrico E3Z', '2026-01-09', 35, 129.90, 'Sensor fotoelétrico de alta precisão.', 'Sensores', NULL),
(9, 'IHM Delta DOP-107BV', '2026-01-10', 9, 1199.00, 'Painel IHM touchscreen industrial.', 'IHMs', NULL),
(10, 'Fonte Mean Well 24V 5A', '2026-01-11', 18, 210.75, 'Fonte industrial estabilizada 24V.', 'Fontes Industriais', NULL),
(11, 'Relé Omron MY2N', '2026-01-12', 50, 42.30, 'Relé auxiliar industrial Omron.', 'Relés', NULL),
(12, 'Inversor Schneider ATV320', '2026-01-13', 7, 3150.00, 'Inversor compacto para controle de motores.', 'Inversores de Frequência', NULL),
(13, 'CLP WEG TPW03', '2026-01-14', 11, 1740.00, 'CLP nacional para automação industrial.', 'CLPs', NULL),
(14, 'Sensor Capacitivo CR30', '2026-01-15', 22, 98.00, 'Sensor capacitivo para líquidos e sólidos.', 'Sensores', NULL),
(15, 'IHM Siemens KTP700', '2026-01-16', 6, 2890.90, 'Painel touch Siemens 7 polegadas.', 'IHMs', NULL),
(16, 'Fonte Phoenix Contact 24V', '2026-01-17', 14, 499.90, 'Fonte industrial de alta confiabilidade.', 'Fontes Industriais', NULL),
(17, 'Relé de Estado Sólido SSR-40DA', '2026-01-18', 30, 65.00, 'Relé SSR para cargas AC.', 'Relés', NULL),
(18, 'Inversor Danfoss FC51', '2026-01-19', 5, 3599.90, 'Inversor para aplicações industriais leves.', 'Inversores de Frequência', NULL),
(19, 'CLP Delta DVP14SS2', '2026-01-20', 13, 1399.99, 'CLP compacto Delta série DVP.', 'CLPs', NULL),
(20, 'Sensor Ultrassônico UC2000', '2026-01-21', 16, 420.00, 'Sensor ultrassônico industrial.', 'Sensores', NULL),
(21, 'IHM Kinco MT4434T', '2026-01-22', 10, 980.50, 'Interface touchscreen Kinco.', 'IHMs', NULL),
(22, 'Fonte Industrial 12V 20A', '2026-01-23', 19, 289.90, 'Fonte chaveada 12V industrial.', 'Fontes Industriais', NULL),
(23, 'Relé Temporizador RT-1', '2026-01-24', 28, 79.90, 'Relé temporizador multifunção.', 'Relés', NULL),
(24, 'Inversor ABB ACS355', '2026-01-25', 6, 4200.00, 'Inversor ABB para motores trifásicos.', 'Inversores de Frequência', NULL),
(25, 'CLP Schneider M221', '2026-01-26', 8, 2150.75, 'CLP modular Schneider Electric.', 'CLPs', NULL),
(26, 'Sensor Magnético Reed', '2026-01-27', 45, 25.90, 'Sensor magnético tipo reed switch.', 'Sensores', NULL),
(27, 'IHM Proface GP4100', '2026-01-28', 5, 3350.00, 'Painel industrial Proface.', 'IHMs', NULL),
(28, 'Fonte Industrial 48V 5A', '2026-01-29', 12, 540.90, 'Fonte industrial 48V DC.', 'Fontes Industriais', NULL),
(29, 'Relé Interface Slim', '2026-01-30', 70, 29.90, 'Relé slim para painéis elétricos.', 'Relés', NULL),
(30, 'Inversor Mitsubishi FR-D700', '2026-02-01', 7, 2680.00, 'Inversor Mitsubishi compacto.', 'Inversores de Frequência', NULL),
(31, 'CLP Eaton XC100', '2026-02-02', 9, 1999.90, 'CLP Eaton para automação.', 'CLPs', NULL),
(32, 'Sensor Óptico Banner QS18', '2026-02-03', 20, 189.50, 'Sensor óptico industrial.', 'Sensores', NULL),
(33, 'IHM Omron NB7W', '2026-02-04', 6, 2100.00, 'IHM Omron widescreen.', 'IHMs', NULL),
(34, 'Fonte Siemens SITOP', '2026-02-05', 11, 890.00, 'Fonte industrial Siemens SITOP.', 'Fontes Industriais', NULL),
(35, 'Relé de Segurança Pilz', '2026-02-06', 9, 780.00, 'Relé de segurança industrial.', 'Relés', NULL),
(36, 'Inversor Yaskawa V1000', '2026-02-07', 4, 3890.00, 'Inversor vetorial Yaskawa.', 'Inversores de Frequência', NULL),
(37, 'CLP Fatek FBs-24MCR2', '2026-02-08', 10, 1250.00, 'CLP compacto Fatek.', 'CLPs', NULL),
(38, 'Sensor de Pressão BMP280', '2026-02-09', 26, 58.00, 'Sensor eletrônico de pressão.', 'Sensores', NULL),
(39, 'IHM Red Lion G306', '2026-02-10', 3, 4590.00, 'IHM industrial avançada.', 'IHMs', NULL),
(40, 'Fonte Chaveada 24V 20A', '2026-02-11', 15, 650.00, 'Fonte robusta para automação.', 'Fontes Industriais', NULL),
(41, 'Relé Térmico Siemens', '2026-02-12', 18, 115.90, 'Relé térmico de proteção.', 'Relés', NULL),
(42, 'Inversor Lenze i510', '2026-02-13', 5, 2990.00, 'Inversor industrial Lenze.', 'Inversores de Frequência', NULL),
(43, 'CLP Mitsubishi FX5U', '2026-02-14', 7, 3599.00, 'CLP Mitsubishi alta performance.', 'CLPs', NULL),
(44, 'Sensor Laser Keyence', '2026-02-15', 8, 1250.00, 'Sensor laser de precisão.', 'Sensores', NULL),
(45, 'IHM Schneider HMIGXO', '2026-02-16', 5, 2750.00, 'Painel touchscreen Schneider.', 'IHMs', NULL),
(46, 'Fonte Industrial 5V 10A', '2026-02-17', 22, 180.00, 'Fonte compacta 5V.', 'Fontes Industriais', NULL),
(47, 'Relé Auxiliar WEG', '2026-02-18', 40, 32.00, 'Relé auxiliar para comandos elétricos.', 'Relés', NULL),
(48, 'Inversor Hitachi WJ200', '2026-02-19', 4, 4100.00, 'Inversor para aplicações industriais.', 'Inversores de Frequência', NULL),
(49, 'CLP Unitronics Vision350', '2026-02-20', 6, 3299.90, 'CLP com IHM integrada.', 'CLPs', NULL),
(50, 'Sensor Temperatura PT100', '2026-02-21', 55, 49.90, 'Sensor de temperatura industrial.', 'Sensores', NULL);

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `itens_pedidos`
--
ALTER TABLE `itens_pedidos`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
