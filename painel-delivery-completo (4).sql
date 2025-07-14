-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/07/2025 às 20:08
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
-- Banco de dados: `painel-delivery-completo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `abertura_mesa`
--

CREATE TABLE `abertura_mesa` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `mesa` int(11) NOT NULL,
  `nomee_mesa` varchar(100) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `cliente` varchar(50) DEFAULT NULL,
  `data` date NOT NULL,
  `horario_abertura` time NOT NULL,
  `horario_fechamento` time DEFAULT NULL,
  `garcon` int(11) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `pessoas` int(11) NOT NULL,
  `comissao_garcon` decimal(8,2) DEFAULT NULL,
  `couvert` decimal(8,2) DEFAULT NULL,
  `subtotal` decimal(8,2) DEFAULT NULL,
  `forma_pgto` varchar(35) DEFAULT NULL,
  `valor_adiantado` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `abertura_mesa`
--

INSERT INTO `abertura_mesa` (`id`, `company_id`, `mesa`, `nomee_mesa`, `total`, `cliente`, `data`, `horario_abertura`, `horario_fechamento`, `garcon`, `status`, `obs`, `pessoas`, `comissao_garcon`, `couvert`, `subtotal`, `forma_pgto`, `valor_adiantado`) VALUES
(10, 29, 35, NULL, 0.00, 'fabio', '2025-06-22', '16:40:15', '16:57:38', 0, 'Fechada', '', 1, 0.00, 0.00, 0.00, '1', 0.00),
(11, 29, 35, NULL, 0.00, 'joao', '2025-06-22', '17:13:21', '18:02:45', 0, 'Fechada', '', 1, 0.00, 0.00, 0.00, '1', 0.00),
(12, 29, 35, NULL, 33.98, 'Sabrina', '2025-07-07', '15:05:54', '15:57:28', 94, 'Fechada', '', 1, 0.00, 0.00, 10.98, '1', 23.00),
(13, 29, 35, NULL, 0.00, 'tozee', '2025-07-07', '16:34:58', '16:40:54', 94, 'Fechada', '', 1, 0.00, 0.00, 0.00, '1', 0.00),
(14, 29, 35, '7', 11.00, 'CCCC', '2025-07-07', '16:45:25', '17:02:16', 94, 'Fechada', '', 1, 0.00, 0.00, 11.00, '1', 0.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `acessos`
--

CREATE TABLE `acessos` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(50) NOT NULL,
  `chave` varchar(50) NOT NULL,
  `grupo` int(11) NOT NULL,
  `pagina` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `acessos`
--

INSERT INTO `acessos` (`id`, `company_id`, `nome`, `chave`, `grupo`, `pagina`) VALUES
(1, 1, 'Home', 'home', 0, 'Sim'),
(2, 1, 'Configurações', 'configuracoes', 0, 'Não'),
(3, 1, 'Usuários', 'usuarios', 1, 'Sim'),
(4, 1, 'Acessos', 'acessos', 2, 'Sim'),
(5, 1, 'Grupos Acesso', 'grupo_acessos', 2, 'Sim'),
(8, 1, 'Funcionários', 'funcionarios', 1, 'Sim'),
(9, 1, 'Fornecedores', 'fornecedores', 1, 'Sim'),
(10, 1, 'Formas de Pagamento', 'formas_pgto', 2, 'Sim'),
(11, 1, 'Cargos', 'cargos', 2, 'Sim'),
(12, 1, 'Frequências', 'frequencias', 2, 'Sim'),
(13, 1, 'Contas à Receber', 'receber', 4, 'Sim'),
(14, 1, 'Contas à Pagar', 'pagar', 4, 'Sim'),
(15, 1, 'Clientes', 'clientes', 1, 'Sim'),
(23, 1, 'Caixas', 'caixas', 7, 'Sim'),
(25, 1, 'Tarefas', 'tarefas', 0, 'Sim'),
(26, 1, 'Lançar Tarefas', 'lancar_tarefas', 0, 'Não'),
(28, 1, 'Bairro / Locais', 'bairros', 2, 'Sim'),
(29, 1, 'Dias Fechado', 'dias', 2, 'Sim'),
(30, 1, 'Banner Rotativo', 'banner_rotativo', 2, 'Sim'),
(31, 1, 'Mesas', 'mesas', 2, 'Sim'),
(32, 1, 'Cupom Desconto', 'cupons', 2, 'Sim'),
(33, 1, 'Formas Pgto', 'formas_pgto', 2, 'Sim'),
(34, 1, 'Adicionais', 'adicionais', 2, 'Sim'),
(35, 1, 'Produtos', 'produtos', 9, 'Sim'),
(36, 1, 'Categorias', 'categorias', 9, 'Sim'),
(37, 1, 'Estoque', 'estoque', 9, 'Sim'),
(38, 1, 'Entradas', 'entradas', 9, 'Sim'),
(39, 1, 'Saídas', 'saidas', 9, 'Sim'),
(40, 1, 'Vendas / Pedidos', 'vendas', 4, 'Sim'),
(41, 1, 'Compras', 'compras', 4, 'Sim'),
(42, 1, 'Rel Produtos', 'rel_produtos', 10, 'Sim'),
(43, 1, 'Rel Vendas / Pedidos', 'rel_vendas', 10, 'Sim'),
(44, 1, 'Rel Financeiro', 'rel_financeiro', 10, 'Sim'),
(45, 1, 'Rel Lucro', 'rel_lucro', 0, 'Sim'),
(46, 1, 'Rel Sintético Desp', 'rel_sintetico_despesas', 10, 'Sim'),
(47, 1, 'Rel Sintético	Recb', 'rel_sintetico_receber', 10, 'Sim'),
(48, 1, 'Rel Balanço Anual', 'rel_balanco', 10, 'Sim'),
(49, 1, 'Pedidos', 'pedidos', 0, 'Sim'),
(50, 1, 'Pedidos Esteira', 'pedidos_esteiras', 0, 'Sim'),
(51, 1, 'Novo Pedido', 'novo_pedido', 0, 'Sim'),
(52, 1, 'Anotações', 'anotacoes', 0, 'Sim'),
(53, 1, 'Pedidos Cozinha', 'pedidos_mesa', 0, 'Sim'),
(54, 1, 'Lista Pedidos Mesas', 'lista_pedidos_mesas', 4, 'Sim'),
(55, 1, 'Pedido Balcão', 'pedido_site', 0, 'Sim'),
(56, 1, 'Minhas Comissões', 'minhas_comissoes', 0, 'Sim'),
(57, 1, 'Lista de Comissões', 'comissoes', 4, 'Sim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `adicionais`
--

CREATE TABLE `adicionais` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(50) NOT NULL,
  `valor` decimal(8,2) DEFAULT NULL,
  `ativo` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `adicionais_cat`
--

CREATE TABLE `adicionais_cat` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `categoria` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `valor` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `anotacoes`
--

CREATE TABLE `anotacoes` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `titulo` varchar(250) NOT NULL,
  `msg` text NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL,
  `mostrar_home` varchar(5) NOT NULL,
  `privado` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `data_cad` date NOT NULL,
  `registro` varchar(50) DEFAULT NULL,
  `id_reg` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `arquivos`
--

INSERT INTO `arquivos` (`id`, `company_id`, `nome`, `descricao`, `arquivo`, `data_cad`, `registro`, `id_reg`, `usuario`) VALUES
(46, 29, 'entrega', NULL, '29-06-2025-15-50-37-170851836165d5ebd9ce468.jpeg', '2025-06-29', 'Funcionário', 93, 89);

-- --------------------------------------------------------

--
-- Estrutura para tabela `bairros`
--

CREATE TABLE `bairros` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `bairros`
--

INSERT INTO `bairros` (`id`, `company_id`, `nome`, `valor`) VALUES
(27, 29, 'portal', 2.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `banner_rotativo`
--

CREATE TABLE `banner_rotativo` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `foto` varchar(100) NOT NULL,
  `categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `banner_rotativo`
--

INSERT INTO `banner_rotativo` (`id`, `company_id`, `foto`, `categoria`) VALUES
(14, 29, '28-06-2025-14-51-54-pizza-de-pepperoni-caseira-portal-minha-receita.jpg', 1),
(15, 29, '28-06-2025-14-52-13-tipos-de-salgados-para-lanchonete-1.jpg', 14),
(16, 29, '28-06-2025-14-52-25-170851836165d5ebd9ce468.jpeg', 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `bordas`
--

CREATE TABLE `bordas` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `categoria` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `valor` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `bordas`
--

INSERT INTO `bordas` (`id`, `company_id`, `categoria`, `nome`, `ativo`, `valor`) VALUES
(1, 29, 1, 'Borda Cheddar', 'Sim', 5.00),
(2, 29, 1, 'Borda Catupiri', 'Sim', 4.00),
(3, 29, 1, 'Borda Cream Chese', 'Sim', 5.00),
(13, 29, 23, 'Chocolate', 'Sim', 3.00),
(14, 29, 23, 'Doçe de Leite', 'Sim', 4.00),
(15, 29, 23, 'Banana', 'Sim', 5.50),
(16, 29, 24, 'Chocloate', 'Sim', 5.00),
(17, 29, 24, 'Doce de Leite', 'Sim', 6.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `caixas`
--

CREATE TABLE `caixas` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `operador` int(11) NOT NULL,
  `data_abertura` date NOT NULL,
  `data_fechamento` date DEFAULT NULL,
  `valor_abertura` decimal(8,2) NOT NULL,
  `valor_fechamento` decimal(8,2) DEFAULT NULL,
  `quebra` decimal(8,2) DEFAULT NULL,
  `usuario_abertura` int(11) NOT NULL,
  `usuario_fechamento` int(11) DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `sangrias` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `caixas`
--

INSERT INTO `caixas` (`id`, `company_id`, `operador`, `data_abertura`, `data_fechamento`, `valor_abertura`, `valor_fechamento`, `quebra`, `usuario_abertura`, `usuario_fechamento`, `obs`, `sangrias`) VALUES
(13, 29, 89, '2025-07-13', '2025-07-13', 130.00, 130.00, 0.00, 89, 89, '', NULL),
(14, 29, 89, '2025-07-13', '2025-07-13', 130.00, 130.00, 0.00, 89, 89, 'novamente', NULL),
(15, 29, 89, '2025-07-14', '2025-07-14', 100.00, 100.00, 0.00, 89, 89, '', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cargos`
--

INSERT INTO `cargos` (`id`, `company_id`, `nome`) VALUES
(1, 1, 'Administrador'),
(4, 1, 'Gerente'),
(5, 1, 'Recepcionista'),
(6, 1, 'Atendente'),
(8, 1, 'Faxineiro'),
(9, 1, 'Garçon'),
(11, 1, 'Entregador'),
(15, 1, 'Balconista');

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `sessao` varchar(35) NOT NULL,
  `cliente` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `total_item` decimal(8,2) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `pedido` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `id_sabor` int(11) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `variacao` int(11) DEFAULT NULL,
  `mesa` varchar(25) DEFAULT NULL,
  `nome_cliente` varchar(50) DEFAULT NULL,
  `nome_produto` varchar(100) DEFAULT NULL,
  `sabores` int(11) DEFAULT NULL,
  `borda` int(11) DEFAULT NULL,
  `valor_unitario` decimal(8,2) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `company_id`, `sessao`, `cliente`, `produto`, `quantidade`, `total_item`, `obs`, `pedido`, `data`, `id_sabor`, `categoria`, `item`, `variacao`, `mesa`, `nome_cliente`, `nome_produto`, `sabores`, `borda`, `valor_unitario`, `status`, `hora`) VALUES
(105, 29, '2025-06-20-14:44:22-1216', 0, 55, 1, 7.00, '', 0, '2025-06-20', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '14:44:24'),
(106, 29, '2025-06-20-15:06:21-1150', 14, 55, 1, 7.00, '', 38, '2025-06-20', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '15:06:33'),
(107, 29, '2025-06-20-15:19:02-1468', 14, 55, 1, 7.00, '', 39, '2025-06-20', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '15:19:05'),
(108, 29, '2025-06-21-12:13:10-162', 0, 55, 1, 7.00, '', 40, '2025-06-21', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '12:13:12'),
(109, 1, '2025-06-21-15:23:56-1203', 14, 55, 1, 7.00, '', 41, '2025-06-21', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '15:23:57'),
(110, 1, '2025-06-21-17:23:12-158', 14, 55, 2, 7.00, '', 42, '2025-06-21', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '17:23:16'),
(111, 1, '2025-06-21-17:33:05-569', 0, 55, 1, 7.00, '', 0, '2025-06-21', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '17:33:07'),
(117, 29, '2025-06-21-17:33:58-199', 0, 55, 2, 7.00, '', 0, '2025-06-21', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '18:43:16'),
(119, 29, '2025-06-21-17:34:50-765', 0, 55, 2, 7.00, '', 0, '2025-06-21', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '18:56:51'),
(120, 29, '2025-06-21-19:36:24-151', 14, 55, 1, 7.00, '', 43, '2025-06-21', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '19:36:27'),
(121, 29, '2025-06-21-19:41:52-351', 15, 55, 2, 7.00, '', 44, '2025-06-21', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '19:41:55'),
(122, 29, '2025-06-22-10:11:01-1395', 16, 55, 2, 7.00, 'quero o meu bem novinho', 45, '2025-06-22', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '16:24:59'),
(124, 29, '2025-06-25-15:17:09-151', 16, 55, 1, 7.00, 'quero o meu bem bom', 46, '2025-06-25', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '15:17:19'),
(125, 29, '2025-06-27-16:41:19-1056', 16, 55, 2, 7.00, '', 47, '2025-06-27', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '16:41:35'),
(126, 29, '2025-06-28-12:06:47-1166', 16, 55, 2, 7.00, 'quero com queijo', 48, '2025-06-28', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '12:07:39'),
(127, 29, '2025-06-28-12:41:02-64', 16, 55, 1, 7.00, '', 50, '2025-06-28', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '12:41:05'),
(128, 30, '2025-06-28-12:41:19-127', 17, 56, 2, 17.00, '', 49, '2025-06-28', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 17.00, '', '12:41:26'),
(129, 30, '2025-06-28-13:47:51-960', 17, 56, 1, 17.00, '', 51, '2025-06-28', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 17.00, '', '13:47:52'),
(130, 29, '2025-06-28-14:40:11-491', 18, 14, 1, 26.50, 'quero que me aivise quando tiver pronto', 52, '2025-06-28', 0, 1, NULL, 33, '', '', 'Pizza de Bacon /  Peperoni ', 2, 0, NULL, '', '15:07:31'),
(131, 29, '2025-06-28-15:11:04-1442', 19, 21, 2, 17.00, 'com flores comestíveis na decoração ', 53, '2025-06-28', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 18.00, '', '15:23:15'),
(132, 29, '2025-06-28-15:11:04-1442', 19, 11, 5, 7.00, 'sem cebola', 53, '2025-06-28', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '15:24:06'),
(133, 29, '2025-06-28-15:11:04-1442', 19, 13, 3, 8.00, '', 53, '2025-06-28', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 8.00, '', '15:24:23'),
(134, 29, '2025-06-28-15:11:04-1442', 19, 4, 1, 20.00, '', 53, '2025-06-28', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 20.00, '', '15:24:40'),
(135, 29, '2025-06-28-15:18:03-324', 20, 17, 1, 25.00, '', 54, '2025-06-28', 0, 1, NULL, 38, '', '', 'Pizza Peperoni /  Calabresa ', 2, 0, NULL, '', '15:56:06'),
(136, 29, '2025-06-28-16:00:26-943', 21, 3, 1, 16.00, 'bem caprichado', 55, '2025-06-28', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 10.00, '', '17:34:18'),
(137, 29, '2025-06-28-17:40:10-134', 22, 33, 1, 8.44, '', 56, '2025-06-28', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 0.00, '', '17:40:31'),
(138, 29, '2025-06-29-15:44:52-213', 23, 3, 1, 22.00, '', 57, '2025-06-29', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 15.00, '', '15:45:34'),
(139, 29, '2025-06-29-16:27:36-547', 24, 18, 1, 23.00, '', 58, '2025-06-29', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 23.00, '', '16:27:38'),
(140, 29, '2025-07-03-22:22:27-901', 24, 18, 1, 23.00, '', 59, '2025-07-03', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 23.00, '', '22:22:28'),
(141, 29, '2025-07-03-22:37:42-1184', 24, 9, 1, 9.00, '', 60, '2025-07-03', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 9.00, '', '22:37:43'),
(142, 29, '2025-07-07-14:08:42-80', 24, 3, 2, 17.00, '', 61, '2025-07-07', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 10.00, '', '14:09:00'),
(143, 29, '2025-07-07-14:34:17-1121', 24, 11, 1, 7.00, '', 62, '2025-07-07', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 7.00, '', '14:34:18'),
(144, 29, '2025-07-07-14:59:45-298', 24, 24, 2, 6.99, '', 63, '2025-07-07', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 8.00, '', '14:59:50'),
(145, 29, '2025-07-07-15:41:45-308', 0, 18, 1, 23.00, '', 0, '2025-07-07', NULL, NULL, NULL, NULL, '12', '', NULL, NULL, NULL, 23.00, 'Finalizado', '15:41:46'),
(146, 29, '2025-07-07-15:41:45-308', 0, 9, 1, 9.00, '', 0, '2025-07-07', NULL, NULL, NULL, NULL, '12', '', NULL, NULL, NULL, 9.00, 'Finalizado', '15:42:41'),
(147, 29, '2025-07-07-15:44:23-263', 0, 33, 1, 1.98, '', 0, '2025-07-07', NULL, NULL, NULL, NULL, '12', '', NULL, NULL, NULL, 0.00, 'Finalizado', '15:44:27'),
(148, 29, '2025-07-07-15:44:23-263', 0, 8, 1, 11.00, '', 0, '2025-07-07', NULL, NULL, NULL, NULL, '14', '', NULL, NULL, NULL, 11.00, 'Finalizado', '16:48:03'),
(150, 29, '2025-07-11-14:12:55-1061', 0, 18, 1, 23.00, '', 0, '2025-07-11', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 23.00, '', '14:15:16'),
(151, 29, '2025-07-11-16:48:49-1055', 19, 9, 1, 9.00, '', 64, '2025-07-11', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 9.00, '', '16:58:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `cor` varchar(30) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `url` varchar(100) NOT NULL,
  `mais_sabores` varchar(5) NOT NULL,
  `delivery` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `company_id`, `nome`, `descricao`, `foto`, `cor`, `ativo`, `url`, `mais_sabores`, `delivery`) VALUES
(1, 29, 'Pizzas', 'Pizzas Vários Sabores', '16-08-2024-11-53-04-Pizza-3007395.jpg', 'azul', 'Sim', 'pizzas', 'Sim', 'Sim'),
(2, 29, 'Sanduiches', 'Comuns e Artesanais', '16-08-2024-11-47-48-hamburger.jpg', 'rosa', 'Sim', 'sanduiches', 'Não', 'Sim'),
(4, 29, 'Bebidas', 'Refrigerantes, Sucos, Cervejas', '16-08-2024-11-47-40-159304.png', 'azul-escuro', 'Sim', 'bebidas', 'Não', 'Sim'),
(6, 29, 'Hot Dogs', 'Deliciosos Cachorro Quente', '16-08-2024-11-47-34-istock-143175178-1iuy9pef5iz3q.jpg', 'verde', 'Sim', 'hot-dogs', 'Não', 'Sim'),
(7, 29, 'Pastéis', 'Comuns e Especiais', '16-08-2024-11-47-28-pasteis.jpg', 'roxo', 'Sim', 'pasteis', 'Não', 'Sim'),
(8, 29, 'Açaí', 'Vitaminas e Creme', '16-08-2024-11-47-23-acai.jpg', 'vermelho', 'Sim', 'acai', 'Não', 'Sim'),
(9, 29, 'Sobremesas', 'Diversos Doces', '16-08-2024-11-47-10-receita-de-sobremesa-tentacao.jpg', 'verde-escuro', 'Sim', 'sobremesas', 'Não', 'Sim'),
(10, 29, 'Sorvetes', 'Pote e Agranel', '16-08-2024-11-47-04-images.jpg', 'laranja', 'Sim', 'sorvetes', 'Não', 'Sim'),
(14, 29, 'Salgados', 'Fritos e Congelados', '16-08-2024-11-46-32-salgados-comerciais.jpg', 'roxo', 'Sim', 'salgados', 'Não', 'Sim'),
(15, 29, 'Café da Manhã ', 'Café da Manhã ', '29-07-2024-11-27-55-cafe-da-manha-1642012355257_v2_450x450.jpg', 'amarelo', 'Sim', 'cafe-da-manha', 'Não', 'Não'),
(19, 29, 'Hamburger', 'Deliciosos Hamburger', '15-08-2024-17-59-44-images.jpg', 'laranja', 'Sim', 'hamburger', 'Não', 'Sim'),
(24, 29, 'Pizza Doce', 'Uma deliciosa pizza doce', '17-11-2024-14-55-06-banana.png', '', 'Sim', 'pizza-doce', 'Sim', 'Sim'),
(28, 29, 'salgados', 'salgados quentinhos feitos na hora', 'sem-foto.jpg', '', 'Sim', 'salgados', 'Não', 'Sim'),
(29, 30, 'macarronadas', 'macorranada feita na hora', '28-06-2025-12-36-28-c_0.jpg', '', 'Sim', 'macarronadas', 'Não', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(25) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `data_cad` date NOT NULL,
  `data_nasc` date DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `company_id`, `nome`, `cpf`, `telefone`, `email`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `data_cad`, `data_nasc`, `usuario`) VALUES
(14, 29, 'marcelo', NULL, '(84) 99176-3691', NULL, '', '', '', '', '', NULL, '', '2025-06-20', NULL, NULL),
(15, 29, 'jose', NULL, '(84) 99174-8176', NULL, '', '', '', '', '', NULL, '', '2025-06-21', NULL, NULL),
(16, 29, 'melo', NULL, '(84) 99159-8402', NULL, 'valdecir vitor', '105', 'proximo ao abrigo de idosos', 'portal', '', NULL, '', '2025-06-22', NULL, NULL),
(17, 30, 'ze roberto', NULL, '(84) 99174-8176', NULL, '', '', '', '', '', NULL, '', '2025-06-28', NULL, NULL),
(18, 29, 'maike', NULL, '(84) 99176-3524', NULL, '', '', '', '', '', NULL, '', '2025-06-28', NULL, NULL),
(19, 29, 'edileuza', NULL, '(84) 99466-2299', NULL, 'Rua Fabrício maranhão ', '32-A', 'amaro construções ', 'portal', '', NULL, '', '2025-06-28', NULL, NULL),
(20, 29, 'CHARLES', NULL, '(84) 99174-8596', NULL, '', '', '', '', '', NULL, '', '2025-06-28', NULL, NULL),
(21, 29, 'Mateus', NULL, '(84) 99175-8752', NULL, 'valdecir vitor', '105', 'proximo ao abrigo de idosos', 'portal', '', NULL, '', '2025-06-28', NULL, NULL),
(22, 29, 'bob', NULL, '(84) 77458-4714', NULL, 'valdecir vitor', '58', 'proximo ao abrigo de idosos', 'portal', '', NULL, '', '2025-06-28', NULL, NULL),
(23, 29, 'thomas', NULL, '(84) 99174-8475', NULL, 'manoel jose de brito', '114', 'proximo ao portal ', 'portal', '', NULL, '', '2025-06-29', NULL, NULL),
(24, 29, 'manel', NULL, '(84) 99174-8714', NULL, 'mateus moreira', '342', 'proximo  ao mercado de ze', 'portal', '', NULL, '', '2025-06-29', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `trial_days` int(11) NOT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `sem_numero` tinyint(1) NOT NULL DEFAULT 0,
  `documento` varchar(20) DEFAULT NULL,
  `subscription_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `subscription_start` date NOT NULL,
  `subscription_end` date NOT NULL,
  `status` enum('active','expired') NOT NULL DEFAULT 'active',
  `admin_password` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `companies`
--

INSERT INTO `companies` (`id`, `nome`, `slug`, `trial_days`, `whatsapp`, `cidade`, `cep`, `rua`, `numero`, `sem_numero`, `documento`, `subscription_price`, `subscription_start`, `subscription_end`, `status`, `admin_password`) VALUES
(1, 'Empresa Genérica', 'empresa-generica', 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.00, '2025-06-09', '2025-06-09', 'expired', NULL),
(29, 'teste1', 'teste1', 30, '84991478563', 'nova cruz', '59215000', 'rua fenadno', '854', 0, '01775491498', 200.00, '2025-06-20', '2025-07-20', 'active', '123456'),
(30, 'teste2', 'teste2', 30, '84994857463', 'nova cruz', '59215000', 'rua nova sul', '147', 0, '', 100.00, '2025-06-28', '2025-07-28', 'active', '123456');

-- --------------------------------------------------------

--
-- Estrutura para tabela `config`
--

CREATE TABLE `config` (
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `icone` varchar(100) DEFAULT NULL,
  `logo_rel` varchar(100) DEFAULT NULL,
  `logo_assinatura` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `ativo` varchar(5) DEFAULT NULL,
  `multa_atraso` decimal(8,2) DEFAULT NULL,
  `juros_atraso` decimal(8,2) DEFAULT NULL,
  `marca_dagua` varchar(5) DEFAULT NULL,
  `assinatura_recibo` varchar(5) DEFAULT NULL,
  `impressao_automatica` varchar(5) DEFAULT NULL,
  `cnpj` varchar(25) DEFAULT NULL,
  `entrar_automatico` varchar(5) DEFAULT NULL,
  `mostrar_preloader` varchar(5) DEFAULT NULL,
  `ocultar_mobile` varchar(5) DEFAULT NULL,
  `api_whatsapp` varchar(25) DEFAULT NULL,
  `token_whatsapp` varchar(70) DEFAULT NULL,
  `instancia_whatsapp` varchar(70) DEFAULT NULL,
  `dados_pagamento` varchar(100) DEFAULT NULL,
  `telefone_fixo` varchar(20) DEFAULT NULL,
  `tipo_rel` varchar(10) DEFAULT NULL,
  `tipo_miniatura` varchar(10) DEFAULT NULL,
  `previsao_entrega` int(11) DEFAULT NULL,
  `horario_abertura` time DEFAULT NULL,
  `horario_fechamento` time DEFAULT NULL,
  `texto_fechamento_horario` varchar(255) DEFAULT NULL,
  `status_estabelecimento` varchar(20) DEFAULT NULL,
  `texto_fechamento` varchar(255) DEFAULT NULL,
  `tempo_atualizar` int(11) DEFAULT NULL,
  `tipo_chave` varchar(35) DEFAULT NULL,
  `dias_apagar` int(11) DEFAULT NULL,
  `banner_rotativo` varchar(5) DEFAULT NULL,
  `pedido_minimo` decimal(8,2) DEFAULT NULL,
  `mostrar_aberto` varchar(5) DEFAULT NULL,
  `entrega_distancia` varchar(5) DEFAULT NULL,
  `chave_api_maps` varchar(255) DEFAULT NULL,
  `latitude_rest` varchar(100) DEFAULT NULL,
  `longitude_rest` varchar(100) DEFAULT NULL,
  `distancia_entrega_km` int(11) DEFAULT NULL,
  `valor_km` int(11) DEFAULT NULL,
  `mais_sabores` varchar(30) NOT NULL,
  `abrir_comprovante` varchar(5) NOT NULL,
  `mostrar_acessos` varchar(5) NOT NULL,
  `fonte_comprovante` int(11) DEFAULT NULL,
  `mensagem_auto` varchar(5) DEFAULT NULL,
  `data_cobranca` date DEFAULT NULL,
  `api_merc` varchar(255) DEFAULT NULL,
  `couvert` int(11) DEFAULT NULL,
  `comissao_garcon` decimal(8,2) DEFAULT NULL,
  `abertura_caixa` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `config`
--

INSERT INTO `config` (`nome`, `email`, `telefone`, `endereco`, `instagram`, `logo`, `icone`, `logo_rel`, `logo_assinatura`, `id`, `company_id`, `ativo`, `multa_atraso`, `juros_atraso`, `marca_dagua`, `assinatura_recibo`, `impressao_automatica`, `cnpj`, `entrar_automatico`, `mostrar_preloader`, `ocultar_mobile`, `api_whatsapp`, `token_whatsapp`, `instancia_whatsapp`, `dados_pagamento`, `telefone_fixo`, `tipo_rel`, `tipo_miniatura`, `previsao_entrega`, `horario_abertura`, `horario_fechamento`, `texto_fechamento_horario`, `status_estabelecimento`, `texto_fechamento`, `tempo_atualizar`, `tipo_chave`, `dias_apagar`, `banner_rotativo`, `pedido_minimo`, `mostrar_aberto`, `entrega_distancia`, `chave_api_maps`, `latitude_rest`, `longitude_rest`, `distancia_entrega_km`, `valor_km`, `mais_sabores`, `abrir_comprovante`, `mostrar_acessos`, `fonte_comprovante`, `mensagem_auto`, `data_cobranca`, `api_merc`, `couvert`, `comissao_garcon`, `abertura_caixa`) VALUES
('churrascaria', '', '(84) 99176-3691', '', '', 'logo_29_68716c3b874f8.jpg', 'icone.png', 'logo_rel_29_6873f196b53a4.jpg', 'logo_assinatura_29_686daef93853b.jpg', 29, 29, 'Sim', 0.00, 0.00, 'Sim', 'Sim', 'Não', '22.831.673/0001-26', 'Sim', 'Sim', 'Não', 'menuia', '', '', '84991763691', '', 'PDF', 'Cores', 60, '12:00:00', '00:00:00', '', 'Aberto', '', 30, 'CNPJ', 60, 'Sim', 0.00, 'Sim', '0', 'AIzaSyDh2ZVIcqEeBpI7LFyV2U1m63KYjNBkd9A', '-6.4818067351366', '-35.433379382896', 50, 1, 'Média', 'Não', 'Sim', 0, 'Sim', '2025-07-14', '', 0, 0.00, 'Sim'),
('Nome do Sistema', '', '(84) 99485-7463', '', '', 'logo.png', 'icone.png', 'logo.jpg', NULL, 30, 30, 'Sim', 0.00, 0.00, 'Sim', 'Sim', 'Não', '', 'Não', 'Sim', 'Não', 'menuia', '', '', '', '', 'PDF', 'Cores', 60, '12:00:00', '00:00:00', 'Estamos fechados no momento', 'Aberto', '', 30, 'Telefone', 60, 'Sim', 0.00, 'Sim', '0', 'AIzaSyDh2ZVIcqEeBpI7LFyV2U1m63KYjNBkd9A', '-6.4818067351366', '-35.433379382896', 50, 1, 'Média', 'Não', 'Não', 0, 'Sim', '2025-07-11', 'APP_USR-5155455831525633-110710-8ff24066b7152213c6ebd7eaf92b3628-30518896', 0, 0.00, 'Sim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cupons`
--

CREATE TABLE `cupons` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `codigo` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data` date DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor_minimo` decimal(8,2) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cupons`
--

INSERT INTO `cupons` (`id`, `company_id`, `codigo`, `valor`, `data`, `quantidade`, `valor_minimo`, `tipo`) VALUES
(26, 29, 'LOJA10', 10.00, '2025-06-29', 8, 10.00, '%');

-- --------------------------------------------------------

--
-- Estrutura para tabela `delivery_users`
--

CREATE TABLE `delivery_users` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `delivery_users`
--

INSERT INTO `delivery_users` (`id`, `company_id`, `name`, `email`, `password`, `role`) VALUES
(22, 29, 'teste1', 'teste1@gmail.com', '$2y$10$yaNnvx0LiY73xrCczPO3Pu02Asf6tuDpbDnSrqatQlkRFaoIOpTyS', 'admin'),
(23, 30, 'teste2', 'teste2@gmail.com', '$2y$10$XRP9NUNv24dnezzbGqR4tOuIw/Ko9jreeb3khrpRwxCwczuezj9Yi', 'admin');

-- --------------------------------------------------------

--
-- Estrutura para tabela `dias`
--

CREATE TABLE `dias` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `dia` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `entradas`
--

INSERT INTO `entradas` (`id`, `company_id`, `produto`, `quantidade`, `motivo`, `usuario`, `data`) VALUES
(4, 29, 55, 10, 'feito', 89, '2025-06-20'),
(5, 29, 55, 5, 'tava acabando', 89, '2025-06-22'),
(6, 29, 55, 10, 'feito', 89, '2025-06-28'),
(7, 30, 56, 10, 'reposição', 92, '2025-06-28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `financials`
--

CREATE TABLE `financials` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `tipo` enum('receita','despesa') NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('open','paid','overdue') NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `formas_pgto`
--

CREATE TABLE `formas_pgto` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(50) NOT NULL,
  `taxa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `formas_pgto`
--

INSERT INTO `formas_pgto` (`id`, `company_id`, `nome`, `taxa`) VALUES
(1, 1, 'Dinheiro', 0),
(2, 1, 'Pix', 0),
(4, 1, 'Cartão de Débito', 0),
(12, 1, 'Pix (Banco NuBank)', 0),
(19, 30, 'cartão', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `pix` varchar(50) DEFAULT NULL,
  `tipo_chave` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `frequencias`
--

CREATE TABLE `frequencias` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `frequencia` varchar(25) NOT NULL,
  `dias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `frequencias`
--

INSERT INTO `frequencias` (`id`, `company_id`, `frequencia`, `dias`) VALUES
(1, 1, 'Nenhuma', 0),
(2, 1, 'Diária', 1),
(3, 1, 'Semanal', 7),
(4, 1, 'Mensal', 30),
(5, 1, 'Trimestral', 90),
(6, 1, 'Semestral', 180),
(7, 1, 'Anual', 365);

-- --------------------------------------------------------

--
-- Estrutura para tabela `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `produto` int(11) NOT NULL,
  `tipo_item` varchar(30) NOT NULL,
  `valor_item` varchar(30) NOT NULL,
  `texto` varchar(70) NOT NULL,
  `limite` int(11) DEFAULT NULL,
  `ativo` varchar(5) DEFAULT NULL,
  `nome_comprovante` varchar(70) DEFAULT NULL,
  `adicional` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `grades`
--

INSERT INTO `grades` (`id`, `company_id`, `produto`, `tipo_item`, `valor_item`, `texto`, `limite`, `ativo`, `nome_comprovante`, `adicional`) VALUES
(1, 29, 33, 'Múltiplo', 'Sem Valor', 'Escolha as Opções de Sabores', 0, 'Sim', 'Sabores', 'Não'),
(8, 29, 39, 'Múltiplo', 'Agregado', 'Adicionais', 4, 'Sim', 'Adicionais', 'Sim'),
(9, 29, 39, '1 de Cada', 'Sem Valor', 'Remover', 0, 'Sim', 'Itens Removido', 'Não'),
(12, 29, 46, 'Variação', 'Produto', 'Tamanho', 0, 'Sim', 'Tamanho', 'Não'),
(15, 29, 3, 'Variação', 'Único', 'Escolha o Tamanho', 1, 'Sim', 'Tamanho', 'Não'),
(16, 29, 3, '1 de Cada', 'Sem Valor', 'Escolha os Adicional', 2, 'Sim', 'Adicional Grátis', 'Sim'),
(17, 29, 3, 'Múltiplo', 'Agregado', 'Mais Adiconal?', 2, 'Sim', 'Adiconal Extra', 'Sim'),
(20, 29, 51, 'Único', 'Único', 'Escolha o Tamanho', 0, 'Sim', 'Tamanho', 'Não'),
(21, 29, 20, 'Múltiplo', 'Agregado', 'Inserrir Adicionais?', 0, 'Sim', 'Adiconal', 'Sim'),
(22, 29, 20, '1 de Cada', 'Sem Valor', 'Marque para Remover Ingredientes', 0, 'Sim', 'Remover Ingredientes', 'Não'),
(23, 29, 20, 'Múltiplo', 'Agregado', 'Acresentar Bebida', 0, 'Sim', 'Bebida', 'Não');

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupo_acessos`
--

CREATE TABLE `grupo_acessos` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `grupo_acessos`
--

INSERT INTO `grupo_acessos` (`id`, `company_id`, `nome`) VALUES
(1, 1, 'Pessoas'),
(2, 1, 'Cadastros'),
(4, 1, 'Financeiro'),
(7, 1, 'Caixas'),
(9, 1, 'Produtos'),
(10, 1, 'Relatórios');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_grade`
--

CREATE TABLE `itens_grade` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `produto` int(11) NOT NULL,
  `texto` varchar(70) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `limite` int(11) NOT NULL,
  `ativo` varchar(5) DEFAULT NULL,
  `grade` int(11) NOT NULL,
  `adicional` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `itens_grade`
--

INSERT INTO `itens_grade` (`id`, `company_id`, `produto`, `texto`, `valor`, `limite`, `ativo`, `grade`, `adicional`) VALUES
(15, 29, 39, 'Manteiga', 0.00, 1, 'Sim', 9, 0),
(16, 29, 39, 'Milho', 3.00, 2, 'Sim', 8, 3),
(17, 29, 39, 'Bacon', 6.00, 2, 'Sim', 8, 1),
(18, 29, 39, 'Molho Barbecue', 5.00, 2, 'Sim', 8, 5),
(19, 29, 39, 'Gema', 0.00, 1, 'Sim', 9, 0),
(21, 29, 39, 'assssssaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 11.00, 0, 'Sim', 9, 0),
(24, 29, 46, '300ml', 10.00, 0, 'Sim', 12, 0),
(25, 29, 46, '500ml', 12.00, 0, 'Sim', 12, 0),
(26, 29, 46, '800ml', 18.00, 0, 'Sim', 12, 0),
(27, 29, 46, '1Kg', 25.00, 0, 'Sim', 12, 0),
(37, 29, 33, 'Bolinho de Carne', 0.99, 0, 'Sim', 1, 0),
(38, 29, 33, 'Mini Pizza', 2.50, 0, 'Sim', 1, 0),
(39, 29, 33, 'Mini Pastel de Carne', 0.99, 0, 'Sim', 1, 0),
(40, 29, 33, 'Mini Pastel de Frago', 0.99, 0, 'Sim', 1, 0),
(41, 29, 33, 'Bolinho de Pizza', 1.50, 0, 'Sim', 1, 0),
(42, 29, 33, 'Enroladinho', 0.99, 0, 'Sim', 1, 0),
(43, 29, 33, 'Risole', 1.30, 0, 'Sim', 1, 0),
(52, 29, 3, 'Pequena', 10.00, 0, 'Sim', 15, 0),
(53, 29, 3, 'Média', 15.00, 0, 'Sim', 15, 0),
(54, 29, 3, 'Grande', 20.00, 0, 'Sim', 15, 0),
(56, 29, 3, 'Aveia', 0.00, 0, 'Sim', 16, 11),
(57, 29, 3, 'Banana', 0.00, 0, 'Sim', 16, 9),
(58, 29, 3, 'Doçe de Leite', 0.00, 0, 'Sim', 16, 12),
(59, 29, 3, 'Kiwi', 0.00, 0, 'Sim', 16, 14),
(60, 29, 3, 'Leite Ninho', 0.00, 0, 'Sim', 16, 13),
(61, 29, 3, 'Morango', 0.00, 0, 'Sim', 16, 10),
(62, 29, 3, 'Uva Passas', 0.00, 0, 'Sim', 16, 4),
(64, 29, 3, 'Aveia', 1.00, 0, 'Sim', 17, 11),
(66, 29, 3, 'Banana', 3.00, 0, 'Sim', 17, 9),
(67, 29, 3, 'Doçe de Leite', 1.00, 0, 'Sim', 17, 12),
(68, 29, 3, 'Kiwi', 3.00, 0, 'Sim', 17, 14),
(69, 29, 3, 'Leite Ninho', 3.00, 0, 'Sim', 17, 13),
(70, 29, 3, 'Morango', 3.00, 0, 'Sim', 17, 10),
(71, 29, 3, 'Uva Passas', 4.00, 0, 'Sim', 17, 4),
(73, 29, 51, '300ml', 8.00, 0, 'Sim', 20, 0),
(74, 29, 51, '600ML', 12.00, 0, 'Sim', 20, 0),
(75, 29, 51, '800ml', 15.00, 0, 'Sim', 20, 0),
(76, 29, 20, 'Bacon', 6.00, 2, 'Sim', 21, 1),
(77, 29, 20, 'Cheddar', 7.00, 2, 'Sim', 21, 2),
(78, 29, 20, 'Cebola', 0.00, 0, 'Sim', 22, 0),
(79, 29, 20, 'Molho de Tomate', 0.00, 0, 'Sim', 22, 0),
(80, 29, 20, 'Coca Cola 350Ml', 5.00, 0, 'Sim', 23, 0),
(81, 29, 20, 'Coca Cola 600ml', 7.00, 0, 'Sim', 23, 0),
(82, 29, 20, 'Coca Cola 1 L', 12.00, 0, 'Sim', 23, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(25) NOT NULL,
  `ativo` varchar(5) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `mesas`
--

INSERT INTO `mesas` (`id`, `company_id`, `nome`, `ativo`, `status`) VALUES
(35, 29, '7', 'Sim', 'Fechada'),
(36, 29, '5', 'Sim', 'Fechada');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `texto` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagar`
--

CREATE TABLE `pagar` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `descricao` varchar(100) DEFAULT NULL,
  `fornecedor` int(11) DEFAULT NULL,
  `funcionario` int(11) DEFAULT NULL,
  `valor` decimal(8,2) DEFAULT NULL,
  `vencimento` date DEFAULT NULL,
  `data_pgto` date DEFAULT NULL,
  `data_lanc` date DEFAULT NULL,
  `forma_pgto` varchar(50) DEFAULT NULL,
  `frequencia` int(11) DEFAULT NULL,
  `obs` varchar(100) DEFAULT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `referencia` varchar(30) DEFAULT NULL,
  `id_ref` int(11) DEFAULT NULL,
  `multa` decimal(8,2) DEFAULT NULL,
  `juros` decimal(8,2) DEFAULT NULL,
  `desconto` decimal(8,2) DEFAULT NULL,
  `taxa` decimal(8,2) DEFAULT NULL,
  `subtotal` decimal(8,2) DEFAULT NULL,
  `usuario_lanc` int(11) DEFAULT NULL,
  `usuario_pgto` int(11) DEFAULT NULL,
  `pago` varchar(5) DEFAULT NULL,
  `residuo` varchar(5) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `caixa` int(11) DEFAULT NULL,
  `produto` int(11) DEFAULT NULL,
  `pessoa` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `comissao` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `pagar`
--

INSERT INTO `pagar` (`id`, `company_id`, `descricao`, `fornecedor`, `funcionario`, `valor`, `vencimento`, `data_pgto`, `data_lanc`, `forma_pgto`, `frequencia`, `obs`, `arquivo`, `referencia`, `id_ref`, `multa`, `juros`, `desconto`, `taxa`, `subtotal`, `usuario_lanc`, `usuario_pgto`, `pago`, `residuo`, `hora`, `hash`, `caixa`, `produto`, `pessoa`, `quantidade`, `cliente`, `foto`, `tipo`, `comissao`) VALUES
(45, 29, 'Comissão Garçon', NULL, 0, 0.00, '2025-06-22', NULL, '2025-06-22', NULL, NULL, NULL, 'sem-foto.jpg', 'Comissão', 10, NULL, NULL, NULL, NULL, NULL, 89, NULL, 'Não', NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, 'sem-foto.png', 'Comissão', 'Garçon'),
(46, 29, 'Comissão Garçon', NULL, 0, 0.00, '2025-06-22', NULL, '2025-06-22', NULL, NULL, NULL, 'sem-foto.jpg', 'Comissão', 11, NULL, NULL, NULL, NULL, NULL, 89, NULL, 'Não', NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, 'sem-foto.png', 'Comissão', 'Garçon'),
(50, 29, 'Comissão Entrega', NULL, 93, 25.00, '2025-06-29', '2025-06-29', '2025-06-29', '1', NULL, NULL, 'sem-foto.jpg', 'Comissão', 2, 0.00, 0.00, 0.00, NULL, 25.00, 89, 89, 'Sim', NULL, '16:52:35', NULL, 0, NULL, 0, NULL, NULL, 'sem-foto.png', 'Comissão', 'Entregador'),
(53, 29, 'Comissão Entrega', NULL, 93, 2.00, '2025-07-07', NULL, '2025-07-07', NULL, NULL, NULL, 'sem-foto.jpg', 'Comissão', 2, NULL, NULL, NULL, NULL, NULL, 89, NULL, 'Não', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'sem-foto.png', 'Comissão', 'Entregador'),
(54, 29, 'Comissão Entrega', NULL, 93, 2.00, '2025-07-07', '2025-07-07', '2025-07-07', '1', NULL, NULL, 'sem-foto.jpg', 'Comissão', 3, 0.00, 0.00, 0.00, NULL, 2.00, 89, 89, 'Sim', NULL, '17:43:50', NULL, 0, NULL, 0, NULL, NULL, 'sem-foto.png', 'Comissão', 'Entregador'),
(55, 29, 'Comissão Garçon', NULL, 94, 0.00, '2025-07-07', NULL, '2025-07-07', NULL, NULL, NULL, 'sem-foto.jpg', 'Comissão', 12, NULL, NULL, NULL, NULL, NULL, 89, NULL, 'Não', NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, 'sem-foto.png', 'Comissão', 'Garçon'),
(56, 29, 'Comissão Garçon', NULL, 94, 0.00, '2025-07-07', NULL, '2025-07-07', NULL, NULL, NULL, 'sem-foto.jpg', 'Comissão', 13, NULL, NULL, NULL, NULL, NULL, 89, NULL, 'Não', NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, 'sem-foto.png', 'Comissão', 'Garçon'),
(57, 29, 'Comissão Garçon', NULL, 94, 0.00, '2025-07-07', NULL, '2025-07-07', NULL, NULL, NULL, 'sem-foto.jpg', 'Comissão', 14, NULL, NULL, NULL, NULL, NULL, 89, NULL, 'Não', NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, 'sem-foto.png', 'Comissão', 'Garçon');

-- --------------------------------------------------------

--
-- Estrutura para tabela `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `valor_compra` decimal(8,2) NOT NULL,
  `valor_venda` decimal(8,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `nivel_estoque` int(11) NOT NULL,
  `tem_estoque` varchar(5) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `url` varchar(100) NOT NULL,
  `guarnicoes` int(11) DEFAULT NULL,
  `promocao` varchar(5) DEFAULT NULL,
  `combo` varchar(5) DEFAULT NULL,
  `delivery` varchar(5) DEFAULT NULL,
  `preparado` varchar(5) DEFAULT NULL,
  `val_promocional` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `company_id`, `nome`, `descricao`, `categoria`, `valor_compra`, `valor_venda`, `estoque`, `foto`, `nivel_estoque`, `tem_estoque`, `ativo`, `url`, `guarnicoes`, `promocao`, `combo`, `delivery`, `preparado`, `val_promocional`) VALUES
(1, 29, 'Vitamina de Açaí', 'Vitamina ou suco de Açaí', 8, 0.00, 20.00, 0, '10-07-2022-11-04-21-VITAMINA.jpg', 0, 'Não', 'Sim', 'vitamina-de-acai', 3, NULL, NULL, 'Sim', 'Sim', NULL),
(3, 29, 'Taça de Açaí', 'Taça de Açaí', 8, 0.00, 0.00, 9, '17-11-2024-15-37-55-337827-original.jpg', 0, 'Não', 'Sim', 'taca-de-acai', 5, 'Não', 'Não', 'Sim', 'Não', 0.00),
(4, 29, 'Açaí Pote 1 Litro', 'Pote de Açai de 1 Litro', 8, 0.00, 20.00, 7, '10-07-2022-11-04-15-POTE.jpg', 10, 'Sim', 'Sim', 'acai-pote-1-litro', 3, '', '', 'Sim', 'Não', NULL),
(6, 29, 'Água Mineral 500 ML', 'Água Garrafa 500 ML', 4, 2.00, 6.00, 76, '10-07-2022-10-59-20-AGUA.jpg', 15, 'Sim', 'Sim', 'agua-mineral-500-ml', NULL, '', '', 'Sim', 'Não', NULL),
(7, 29, 'Coca Cola Lata 350 ML', 'Lata 350 ML', 4, 0.10, 5.00, 30, '10-07-2022-10-58-50-COCACOLA.jpg', 15, 'Sim', 'Sim', 'coca-cola-lata-350-ml', 0, '', '', 'Sim', 'Não', 0.00),
(8, 29, 'Hot Dog Picante', 'Cachorro quente Picante', 6, 0.00, 11.00, 0, '09-07-2022-21-20-20-DOG-PICANTE.jpg', 0, 'Não', 'Sim', 'hot-dog-picante', NULL, NULL, NULL, 'Sim', 'Sim', NULL),
(9, 29, 'Hot Dog Tradicional', 'Cachorro quente tradicional', 6, 0.00, 9.00, 0, '09-07-2022-21-20-54-DOG-TRADICIONAL.jpg', 0, 'Não', 'Sim', 'hot-dog-tradicional', NULL, NULL, NULL, 'Sim', 'Sim', NULL),
(10, 29, 'Hot Dog Vinagrete', 'Cachorro quente com vinagrete', 6, 0.00, 10.00, 0, '09-07-2022-21-21-18-DOG-VINAGRETE.jpg', 0, 'Não', 'Sim', 'hot-dog-vinagrete', NULL, NULL, NULL, 'Sim', 'Sim', NULL),
(11, 29, 'Pastel de Carne', 'Pastel de Carne moída', 7, 0.00, 7.00, 0, '09-07-2022-21-21-45-PASTEL-CARNE.jpg', 0, 'Não', 'Sim', 'pastel-de-carne', NULL, NULL, NULL, 'Sim', 'Sim', NULL),
(12, 29, 'Pastel Napolitano', 'Pastel Napolitando', 7, 0.00, 7.00, 0, '09-07-2022-21-22-03-PASTEL-NAPOLITANO.jpg', 0, 'Não', 'Sim', 'pastel-napolitano', NULL, NULL, NULL, 'Sim', 'Sim', NULL),
(13, 29, 'Pastel de Queijo', 'Pastel queijo canastra', 7, 0.00, 8.00, 0, '09-07-2022-21-22-26-PASTEL-QUEIJO.jpg', 0, 'Não', 'Sim', 'pastel-de-queijo', NULL, NULL, NULL, 'Sim', 'Sim', NULL),
(14, 29, 'Pizza de Bacon', '(mussarela coberta com bacon e orégano)', 1, 0.00, 20.00, 0, '09-07-2022-21-23-01-PIZZA-BACON.jpg', 0, 'Não', 'Sim', 'pizza-de-bacon', 0, 'Sim', 'Não', 'Sim', 'Sim', 18.99),
(15, 29, 'Suco Lata 350 ML', 'Suco Del Vale Lata', 4, 4.00, 7.00, 5, '10-07-2022-10-59-56-SUCO.jpg', 10, 'Sim', 'Sim', 'suco-lata-350-ml', 5, 'Não', 'Não', 'Sim', 'Não', 0.00),
(16, 29, 'Pizza Calabresa', 'Deliciosa pizza de calabresa com bacon, milho, borda recheada com cheddar.', 1, 0.00, 0.00, 0, '10-07-2022-11-05-04-PIZZA-CALABRESA.jpg', 0, 'Não', 'Sim', 'pizza-calabresa', NULL, NULL, NULL, 'Sim', 'Sim', NULL),
(17, 29, 'Pizza Peperoni', 'Pizza de Peperoni', 1, 0.00, 0.00, 0, '10-07-2022-11-08-05-PIZZA-PEPERONI.jpg', 0, 'Não', 'Sim', 'pizza-peperoni', 2, NULL, NULL, 'Sim', 'Sim', NULL),
(18, 29, 'Burguer Cheddar', 'Sanduíche artesanal de cheddar com bacon, carne de 150g, tomate, cebola, alface e pão gourmet.', 2, 0.00, 23.00, 0, '10-07-2022-11-08-50-BURGUER-CHEDDAR.jpg', 0, 'Não', 'Sim', 'burguer-cheddar', NULL, NULL, NULL, 'Sim', 'Sim', NULL),
(19, 29, 'Burguer Costelinha', 'Sanduíche artesanal de costeinha suína, carne de 150g, tomate, cebola, alface e pão gourmet.', 2, 0.00, 25.00, 0, '10-07-2022-11-09-20-BURGUER-COSTELINHA.jpg', 0, 'Não', 'Sim', 'burguer-costelinha', 0, 'Sim', 'Não', 'Sim', 'Sim', 23.99),
(20, 29, 'Burguer Picanha', 'Sanduíche artesanal de picanha (180g), tomate, cebola, alface e pão gourmet.', 2, 0.00, 30.00, 0, '10-07-2022-11-09-39-BURGUER-PICANHA.jpg', 0, 'Não', 'Sim', 'burguer-picanha', NULL, NULL, NULL, 'Sim', 'Sim', NULL),
(21, 29, 'Mousse de Chocolate', 'Pote de 300 ML', 9, 0.00, 18.00, 0, '10-07-2022-11-10-28-MOUSSE.jpg', 0, 'Não', 'Sim', 'mousse-de-chocolate', 0, 'Sim', 'Não', 'Sim', 'Sim', 17.00),
(22, 29, 'Pavê de Maracujá', 'Delicioso pavê de maracujá...', 9, 0.00, 16.00, 0, '10-07-2022-11-10-58-PAVE.jpg', 0, 'Não', 'Sim', 'pave-de-maracuja', NULL, NULL, NULL, 'Sim', 'Sim', NULL),
(23, 29, 'Pudim de Leite Condensado', 'Pudim de leite condensado, cerca de 350 Gramas.', 9, 0.00, 16.00, 0, '10-07-2022-11-11-36-PUDIM.jpg', 0, 'Não', 'Sim', 'pudim-de-leite-condensado', NULL, NULL, NULL, 'Sim', 'Sim', NULL),
(24, 29, 'Sorvete de Baunilha 300 ML', 'Delicioso sorvete de baunilha, 300 ML', 10, 0.00, 8.00, 0, '10-07-2022-11-12-25-BAUNILHA.jpg', 0, 'Não', 'Sim', 'sorvete-de-baunilha-300-ml', 3, 'Sim', 'Não', 'Sim', 'Não', 6.99),
(25, 29, 'Sorvete de Chocolate', 'Pote de 300 ML de sorvete de chocolate', 10, 0.00, 9.00, 0, '10-07-2022-11-12-46-CHOCOLATE.jpg', 0, 'Não', 'Sim', 'sortete-de-chocolate', 1, 'Sim', 'Não', 'Sim', 'Sim', 5.00),
(27, 29, 'Energético Red Bull', 'Red Bull 476 ML', 4, 8.00, 13.00, 27, '05-09-2022-14-29-17-red.jpg', 5, 'Sim', 'Sim', 'energetico-red-bull', NULL, '', '', 'Sim', 'Não', NULL),
(28, 29, 'Combo Burguer X', 'Sanduíche + Batata + Bebida', 2, 0.00, 30.00, 0, '22-08-2023-10-57-11-combo-4-8551.jpg', 0, 'Não', 'Sim', 'combo-burguer-x', 0, 'Sim', 'Sim', 'Sim', 'Sim', 25.99),
(29, 29, 'Combo Burguer Costelinha', 'Sanduíche + Batata + Bebida', 2, 0.00, 39.00, 0, '22-08-2023-11-18-38-combo2.jpg', 0, 'Não', 'Sim', 'combo-burguer-costelinha', 0, 'Não', 'Sim', 'Sim', 'Sim', NULL),
(33, 29, 'Salgados Fritos', 'Diversos tipos', 14, 0.00, 0.00, 0, '04-03-2024-12-50-23-salgados.jpg', 0, 'Não', 'Sim', 'salgados-fritos', 0, 'Não', 'Não', 'Sim', 'Sim', NULL),
(34, 29, 'Cuscuz com Queijo', 'Cuscuz com Queijo e manteiga', 15, 0.00, 10.00, 0, '29-07-2024-11-28-50-cuscuz---casa-da-any.jpg', 0, 'Não', 'Sim', 'cuscuz-com-queijo', 0, 'Não', 'Não', 'Sim', 'Sim', NULL),
(36, 29, 'Pizza Mussarela', 'Mussarela, rodelas de tomate e orégano', 1, 0.00, 30.00, 0, '03-08-2024-14-02-48-12-2-pizza-png.png', 0, 'Não', 'Sim', 'piizza-mussarela', 3, 'Não', 'Não', 'Sim', 'Sim', NULL),
(37, 29, 'Pizza Atum', 'Mussarela, atum e cebola, orégano e milho', 1, 0.00, 35.00, 0, '16-08-2024-15-26-10-atum1.png', 0, 'Não', 'Sim', 'pizza-atum', 0, 'Não', 'Não', 'Sim', 'Sim', NULL),
(38, 29, 'Pizza Calabresa e Milho', 'Mussarela, linguiça calabresa e cebola', 1, 0.00, 35.00, 0, '16-08-2024-15-28-16-calabreza.png', 0, 'Não', 'Sim', 'pizza-calabresa-e-milho', 0, 'Não', 'Não', 'Sim', 'Sim', NULL),
(43, 29, 'Combo Hamburger Da Casa', 'Hambúrguer + Coca + Batata', 19, 0.00, 30.00, 0, '08-11-2024-23-27-48-Hangar-combo.png', 0, 'Não', 'Sim', 'combo-hamburger-da-casa', NULL, 'Não', 'Sim', 'Sim', 'Sim', 0.00),
(44, 29, 'Cocal Cola 1 L', '', 4, 6.00, 10.00, 10, '10-11-2024-20-52-13-36763-8-coca-cola.png', 2, 'Sim', 'Sim', 'cocal-cola-1-l', NULL, 'Não', 'Não', 'Sim', 'Não', 0.00),
(45, 29, 'Cocal 600ml', '', 4, 5.00, 8.00, 21, '10-11-2024-20-53-05-36763-8-coca-cola.png', 2, 'Sim', 'Sim', 'cocal-600ml', NULL, 'Sim', 'Não', 'Sim', 'Não', 0.10),
(48, 29, 'Pizza de Banana', 'Pizza de banana com massa básica de farinha, ovo e fermento.', 24, 0.00, 35.00, 0, '17-11-2024-15-05-34-banana.png', 0, 'Não', 'Sim', 'pizza-de-banana', NULL, 'Não', 'Não', 'Sim', 'Sim', 30.00),
(50, 29, 'Pizza Morango', 'Pizza de morango com base doce, morangos frescos e chocolate.', 24, 0.00, 35.00, 0, '17-11-2024-15-08-28-c07b807225197db7eed29e49ffb980cc.jpg', 0, 'Não', 'Sim', 'pizza-morango', NULL, 'Não', 'Não', 'Sim', 'Sim', 0.00),
(56, 30, 'macarronada de queijo', 'macarronada de queijo com varios tipos de queijo', 29, 10.00, 17.00, 7, '28-06-2025-12-38-47-macarronada-de-calabresa-19-0911.jpg', 1, 'Sim', 'Sim', 'macarronada-de-queijo', NULL, 'Não', 'Não', 'Sim', 'Sim', 14.99);

-- --------------------------------------------------------

--
-- Estrutura para tabela `receber`
--

CREATE TABLE `receber` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `descricao` varchar(100) DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL,
  `valor` decimal(8,2) DEFAULT NULL,
  `vencimento` date DEFAULT NULL,
  `data_pgto` date DEFAULT NULL,
  `data_lanc` date DEFAULT NULL,
  `forma_pgto` varchar(50) DEFAULT NULL,
  `frequencia` int(11) DEFAULT NULL,
  `obs` varchar(100) DEFAULT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `referencia` varchar(30) DEFAULT NULL,
  `id_ref` int(11) DEFAULT NULL,
  `multa` decimal(8,2) DEFAULT NULL,
  `juros` decimal(8,2) DEFAULT NULL,
  `desconto` decimal(8,2) DEFAULT NULL,
  `taxa` decimal(8,2) DEFAULT NULL,
  `subtotal` decimal(8,2) DEFAULT NULL,
  `usuario_lanc` int(11) DEFAULT NULL,
  `usuario_pgto` int(11) DEFAULT NULL,
  `pago` varchar(5) DEFAULT NULL,
  `residuo` varchar(5) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `caixa` int(11) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `pessoa` int(11) DEFAULT NULL,
  `produto` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `funcionario` int(11) DEFAULT NULL,
  `adiantamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `receber`
--

INSERT INTO `receber` (`id`, `company_id`, `descricao`, `cliente`, `valor`, `vencimento`, `data_pgto`, `data_lanc`, `forma_pgto`, `frequencia`, `obs`, `arquivo`, `referencia`, `id_ref`, `multa`, `juros`, `desconto`, `taxa`, `subtotal`, `usuario_lanc`, `usuario_pgto`, `pago`, `residuo`, `hora`, `hash`, `caixa`, `tipo`, `foto`, `pessoa`, `produto`, `quantidade`, `funcionario`, `adiantamento`) VALUES
(84, 29, 'Balcão', 14, 7.00, '2025-06-20', '2025-06-20', '2025-06-20', '1', NULL, NULL, 'sem-foto.png', 'Balcão', NULL, NULL, NULL, NULL, NULL, 7.00, NULL, 89, 'Sim', NULL, '15:09:36', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(85, 29, 'Balcão', 14, 7.00, '2025-06-20', '2025-06-20', '2025-06-20', '1', NULL, NULL, 'sem-foto.png', 'Balcão', NULL, NULL, NULL, NULL, NULL, 7.00, NULL, 89, 'Sim', NULL, '15:20:14', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(86, 29, 'Balcão', 0, 7.00, '2025-06-21', '2025-06-21', '2025-06-21', '1', NULL, NULL, 'sem-foto.png', 'Balcão', NULL, NULL, NULL, NULL, NULL, 7.00, NULL, 89, 'Sim', NULL, '15:19:02', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(87, 29, 'Balcão', 15, 14.00, '2025-06-21', '2025-06-21', '2025-06-21', '1', NULL, NULL, 'sem-foto.png', 'Balcão', NULL, NULL, NULL, NULL, NULL, 14.00, NULL, 89, 'Sim', NULL, '19:43:27', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(88, 29, 'Venda Mesa', NULL, 0.00, '2025-06-22', '2025-06-22', '2025-06-22', '1', NULL, NULL, 'sem-foto.jpg', 'Venda', 10, NULL, NULL, NULL, NULL, 0.00, 89, 89, 'Sim', NULL, NULL, NULL, 0, 'Venda', 'sem-foto.png', 0, NULL, NULL, NULL, NULL),
(89, 29, 'Venda Mesa', NULL, 0.00, '2025-06-22', '2025-06-22', '2025-06-22', '1', NULL, NULL, 'sem-foto.jpg', 'Venda', 11, NULL, NULL, NULL, NULL, 0.00, 89, 89, 'Sim', NULL, NULL, NULL, 0, 'Venda', 'sem-foto.png', 0, NULL, NULL, NULL, NULL),
(90, 29, 'Retirar', 16, 7.00, '2025-06-25', '2025-06-25', '2025-06-25', '2', NULL, NULL, 'sem-foto.png', 'Retirar', NULL, NULL, NULL, NULL, NULL, 7.00, NULL, 89, 'Sim', NULL, '15:44:38', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(91, 29, 'Delivery', 16, 16.00, '2025-06-28', '2025-06-28', '2025-06-28', '2', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 16.00, NULL, 89, 'Sim', NULL, '12:33:34', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(92, 29, 'Retirar', 14, 7.00, '2025-06-28', '2025-06-28', '2025-06-28', '1', NULL, NULL, 'sem-foto.png', 'Retirar', NULL, NULL, NULL, NULL, NULL, 7.00, NULL, 89, 'Sim', NULL, '12:33:54', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(93, 29, 'Retirar', 16, 14.00, '2025-06-28', '2025-06-28', '2025-06-28', '1', NULL, NULL, 'sem-foto.png', 'Retirar', NULL, NULL, NULL, NULL, NULL, 14.00, NULL, 89, 'Sim', NULL, '12:34:03', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(94, 30, 'Consumir Local', 17, 34.00, '2025-06-28', '2025-06-28', '2025-06-28', '1', NULL, NULL, 'sem-foto.png', 'Consumir Local', NULL, NULL, NULL, NULL, NULL, 34.00, NULL, 92, 'Sim', NULL, '13:49:45', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(95, 30, 'Retirar', 17, 17.00, '2025-06-28', '2025-06-28', '2025-06-28', '1', NULL, NULL, 'sem-foto.png', 'Retirar', NULL, NULL, NULL, NULL, NULL, 17.00, NULL, 92, 'Sim', NULL, '13:50:36', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(96, 29, 'Retirar', 16, 7.00, '2025-06-28', '2025-06-28', '2025-06-28', '2', NULL, NULL, 'sem-foto.png', 'Retirar', NULL, NULL, NULL, NULL, NULL, 7.00, NULL, 89, 'Sim', NULL, '14:13:12', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(97, 29, 'Retirar', 16, 14.00, '2025-06-28', '2025-06-28', '2025-06-28', '2', NULL, NULL, 'sem-foto.png', 'Retirar', NULL, NULL, NULL, NULL, NULL, 14.00, NULL, 89, 'Sim', NULL, '14:13:19', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(98, 29, 'Retirar', 18, 26.50, '2025-06-28', '2025-06-28', '2025-06-28', '2', NULL, NULL, 'sem-foto.png', 'Retirar', NULL, NULL, NULL, NULL, NULL, 26.50, NULL, 89, 'Sim', NULL, '15:09:30', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(99, 29, 'Balcão', 19, 115.00, '2025-06-28', '2025-06-28', '2025-06-28', '1', NULL, NULL, 'sem-foto.png', 'Balcão', NULL, NULL, NULL, NULL, NULL, 115.00, NULL, 89, 'Sim', NULL, '15:27:38', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(100, 29, 'Delivery', 21, 16.20, '2025-06-28', '2025-06-28', '2025-06-28', '2', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 16.20, NULL, 89, 'Sim', NULL, '17:37:33', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(101, 29, 'Retirar', 20, 22.50, '2025-06-28', '2025-06-28', '2025-06-28', '1', NULL, NULL, 'sem-foto.png', 'Retirar', NULL, NULL, NULL, NULL, NULL, 22.50, NULL, 89, 'Sim', NULL, '17:39:56', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(102, 29, 'Delivery', 22, 10.44, '2025-06-28', '2025-06-28', '2025-06-28', '3', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 10.44, NULL, 89, 'Sim', NULL, '17:49:29', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(103, 29, 'Delivery', 23, 24.00, '2025-06-29', '2025-06-29', '2025-06-29', '1', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 24.00, NULL, 89, 'Sim', NULL, '15:48:10', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(104, 29, 'Delivery', 24, 25.00, '2025-06-29', '2025-06-29', '2025-06-29', '1', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 25.00, NULL, 89, 'Sim', NULL, '16:50:50', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(105, 29, 'Delivery', 24, 11.00, '2025-07-03', '2025-07-03', '2025-07-03', '1', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 11.00, NULL, 89, 'Sim', NULL, '22:38:33', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(106, 29, 'Delivery', 24, 36.00, '2025-07-07', '2025-07-07', '2025-07-07', '2', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 36.00, NULL, 89, 'Sim', NULL, '14:11:21', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(107, 29, 'Delivery', 24, 9.00, '2025-07-07', '2025-07-07', '2025-07-07', '', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 9.00, NULL, 89, 'Sim', NULL, '14:52:17', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(108, 29, 'Delivery', 24, 9.00, '2025-07-07', '2025-07-07', '2025-07-07', '', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 9.00, NULL, 89, 'Sim', NULL, '14:52:22', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(109, 29, 'Delivery', 24, 9.00, '2025-07-07', '2025-07-07', '2025-07-07', '', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 9.00, NULL, 89, 'Sim', NULL, '14:52:31', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(110, 29, 'Delivery', 24, 9.00, '2025-07-07', '2025-07-07', '2025-07-07', '', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 9.00, NULL, 89, 'Sim', NULL, '14:52:33', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(111, 29, 'Delivery', 24, 9.00, '2025-07-07', '2025-07-07', '2025-07-07', '', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 9.00, NULL, 89, 'Sim', NULL, '14:52:35', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(112, 29, 'Delivery', 24, 15.98, '2025-07-07', '2025-07-07', '2025-07-07', '4', NULL, NULL, 'sem-foto.png', 'Delivery', NULL, NULL, NULL, NULL, NULL, 15.98, NULL, 89, 'Sim', NULL, '15:00:34', NULL, 0, NULL, 'sem-foto.png', NULL, NULL, NULL, NULL, NULL),
(113, 29, 'Adiantamento Mesa', NULL, 23.00, '2025-07-07', '2025-07-07', '2025-07-07', '1', NULL, NULL, 'sem-foto.jpg', 'Adiantamento Mesa', 12, NULL, NULL, NULL, NULL, NULL, 89, 89, 'Sim', NULL, NULL, NULL, 0, 'Abertura', 'sem-foto.jpg', 0, NULL, NULL, NULL, 3),
(114, 29, 'Venda Mesa', NULL, 10.98, '2025-07-07', '2025-07-07', '2025-07-07', '1', NULL, NULL, 'sem-foto.jpg', 'Venda', 12, NULL, NULL, NULL, NULL, 10.98, 89, 89, 'Sim', NULL, NULL, NULL, 0, 'Venda', 'sem-foto.png', 0, NULL, NULL, NULL, NULL),
(115, 29, 'Venda Mesa', NULL, 0.00, '2025-07-07', '2025-07-07', '2025-07-07', '1', NULL, NULL, 'sem-foto.jpg', 'Venda', 13, NULL, NULL, NULL, NULL, 0.00, 89, 89, 'Sim', NULL, NULL, NULL, 0, 'Venda', 'sem-foto.png', 0, NULL, NULL, NULL, NULL),
(116, 29, 'Venda Mesa', NULL, 11.00, '2025-07-07', '2025-07-07', '2025-07-07', '1', NULL, NULL, 'sem-foto.jpg', 'Venda', 14, NULL, NULL, NULL, NULL, 11.00, 89, 89, 'Sim', NULL, NULL, NULL, 0, 'Venda', 'sem-foto.png', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `saidas`
--

CREATE TABLE `saidas` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sangrias`
--

CREATE TABLE `sangrias` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `usuario` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `caixa` int(11) NOT NULL,
  `feito_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `usuario` int(11) NOT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `hora_mensagem` time DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `prioridade` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `sessao` varchar(35) NOT NULL,
  `tabela` varchar(25) NOT NULL,
  `id_item` int(11) NOT NULL,
  `carrinho` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `categoria` varchar(5) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `valor_item` decimal(8,2) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `tipagem` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `temp`
--

INSERT INTO `temp` (`id`, `company_id`, `sessao`, `tabela`, `id_item`, `carrinho`, `data`, `categoria`, `grade`, `valor_item`, `quantidade`, `tipagem`) VALUES
(111, 29, '2025-06-28-16:00:26-943', 'Variação', 52, 136, '2025-06-28', NULL, 15, 10.00, 1, 'Único'),
(113, 29, '2025-06-28-16:00:26-943', '1 de Cada', 61, 136, '2025-06-28', NULL, 16, 0.00, 1, 'Sem Valor'),
(114, 29, '2025-06-28-16:00:26-943', '1 de Cada', 60, 136, '2025-06-28', NULL, 16, 0.00, 1, 'Sem Valor'),
(115, 29, '2025-06-28-16:00:26-943', 'Múltiplo', 69, 136, '2025-06-28', NULL, 17, 3.00, 1, 'Agregado'),
(116, 29, '2025-06-28-16:00:26-943', 'Múltiplo', 68, 136, '2025-06-28', NULL, 17, 3.00, 1, 'Agregado'),
(117, 29, '2025-06-28-17:40:10-134', 'Múltiplo', 37, 137, '2025-06-28', NULL, 1, 0.99, 1, 'Sem Valor'),
(118, 29, '2025-06-28-17:40:10-134', 'Múltiplo', 38, 137, '2025-06-28', NULL, 1, 2.50, 1, 'Sem Valor'),
(122, 29, '2025-06-28-17:40:10-134', 'Múltiplo', 39, 137, '2025-06-28', NULL, 1, 0.99, 4, 'Sem Valor'),
(123, 29, '2025-06-28-17:40:10-134', 'Múltiplo', 42, 137, '2025-06-28', NULL, 1, 0.99, 1, 'Sem Valor'),
(124, 29, '2025-06-29-15:44:52-213', 'Variação', 53, 138, '2025-06-29', NULL, 15, 15.00, 1, 'Único'),
(125, 29, '2025-06-29-15:44:52-213', '1 de Cada', 57, 138, '2025-06-29', NULL, 16, 0.00, 1, 'Sem Valor'),
(126, 29, '2025-06-29-15:44:52-213', '1 de Cada', 60, 138, '2025-06-29', NULL, 16, 0.00, 1, 'Sem Valor'),
(127, 29, '2025-06-29-15:44:52-213', 'Múltiplo', 71, 138, '2025-06-29', NULL, 17, 4.00, 1, 'Agregado'),
(128, 29, '2025-06-29-15:44:52-213', 'Múltiplo', 70, 138, '2025-06-29', NULL, 17, 3.00, 1, 'Agregado'),
(129, 29, '2025-07-07-14:08:42-80', 'Variação', 52, 142, '2025-07-07', NULL, 15, 10.00, 1, 'Único'),
(130, 29, '2025-07-07-14:08:42-80', '1 de Cada', 60, 142, '2025-07-07', NULL, 16, 0.00, 1, 'Sem Valor'),
(131, 29, '2025-07-07-14:08:42-80', '1 de Cada', 58, 142, '2025-07-07', NULL, 16, 0.00, 1, 'Sem Valor'),
(132, 29, '2025-07-07-14:08:42-80', 'Múltiplo', 71, 142, '2025-07-07', NULL, 17, 4.00, 1, 'Agregado'),
(133, 29, '2025-07-07-14:08:42-80', 'Múltiplo', 70, 142, '2025-07-07', NULL, 17, 3.00, 1, 'Agregado'),
(135, 29, '2025-07-07-15:44:23-263', 'Múltiplo', 39, 147, '2025-07-07', NULL, 1, 0.99, 2, 'Sem Valor');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tenants`
--

CREATE TABLE `tenants` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `dominio` varchar(255) DEFAULT NULL,
  `email_admin` varchar(100) DEFAULT NULL,
  `senha_admin` varchar(255) DEFAULT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('master','admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `password`, `role`) VALUES
(3, 'ryan1', 'ryan@gmail.com', '$2y$10$rr445upV0x.28jQhVuHlzeE7VLtFiN3hqy/tObzjqc9nKPaqGO8SW', 'admin'),
(4, 'Master', 'master@exemplo.com', '$2y$10$BrHRN9lxG5jfUl/IFLolA.CwdAIsL3GIrN30qmEJILeUZ9pdrvzSe', 'master');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `senha_crip` varchar(130) NOT NULL,
  `nivel` varchar(25) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `data` date NOT NULL,
  `comissao` int(11) DEFAULT NULL,
  `id_ref` int(11) NOT NULL,
  `pix` varchar(100) DEFAULT NULL,
  `token` varchar(150) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `acessar_painel` varchar(5) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `mostrar_registros` varchar(5) DEFAULT NULL,
  `tipo_chave` varchar(50) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `company_id`, `nome`, `email`, `senha`, `senha_crip`, `nivel`, `ativo`, `telefone`, `endereco`, `foto`, `data`, `comissao`, `id_ref`, `pix`, `token`, `data_nasc`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `acessar_painel`, `cpf`, `mostrar_registros`, `tipo_chave`, `complemento`) VALUES
(88, 1, 'Administrador', 'contato@hugocursos.com.br', '', '$2y$10$A8mGQ8yoXNQ3dEJGN.4ptuspOd2ictjfr33s9VGeWSlB/dSxddDwK', 'Administrador', 'Sim', '(31)97527-5084', NULL, 'sem-foto.jpg', '2025-06-20', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000.000.000-00', NULL, '', NULL),
(89, 29, 'vascão', 'teste1@gmail.com', NULL, '$2y$10$bKOJX0VlBZ6iFtk2Qk7F8ehc/9ziEPOjpV1LL7ULgQPJnNIpEw0gW', 'Administrador', 'Sim', '(84) 99176-3691', '', '1751055389-99091912.jpg', '2025-06-20', NULL, 29, NULL, NULL, '0000-00-00', '', '', '', '', '', 'Sim', NULL, NULL, '', ''),
(92, 30, 'teste2', 'teste2@gmail.com', NULL, '$2y$10$ffnUwMJqLV6dZHp9TUPuf.jI.PK3fBz5xQkF5rZqekUOnPbsxjY.G', 'Administrador', 'Sim', NULL, NULL, 'sem-foto.jpg', '2025-06-28', NULL, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sim', NULL, NULL, '', NULL),
(93, 29, 'joão', 'joao@gmail.com', '123456', '$2y$10$nPVNaBjQ1CQfspwAeEycE.AP6nED3Ciyzq4bKoJQJVSFo9KaXrWji', 'Entregador', 'Sim', '(84) 99174-8176', '', 'sem-foto.jpg', '2025-06-28', NULL, 0, '', NULL, NULL, '115', '', 'Nova Cruz', 'RN', '59215-000', 'Sim', '', NULL, 'CNPJ', 'proximo ao ginasio'),
(94, 29, 'ze', 'zee@gmail.com', '', '$2y$10$bKOJX0VlBZ6iFtk2Qk7F8ehc/9ziEPOjpV1LL7ULgQPJnNIpEw0gW', 'Garçon', 'Sim', '(84) 99147-8596', '', 'sem-foto.jpg', '2025-07-07', NULL, 0, '', NULL, '2003-07-23', '', '', '', '', '', 'Sim', '', NULL, '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_permissoes`
--

CREATE TABLE `usuarios_permissoes` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `usuario` int(11) NOT NULL,
  `permissao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios_permissoes`
--

INSERT INTO `usuarios_permissoes` (`id`, `company_id`, `usuario`, `permissao`) VALUES
(1, 1, 2, 1),
(2, 1, 2, 2),
(3, 1, 2, 3),
(4, 1, 2, 4),
(5, 1, 2, 5),
(6, 1, 2, 8),
(7, 1, 2, 9),
(8, 1, 2, 10),
(9, 1, 2, 11),
(10, 1, 2, 12),
(11, 1, 2, 13),
(12, 1, 2, 14),
(13, 1, 2, 15),
(14, 1, 2, 16),
(15, 1, 2, 17),
(16, 1, 2, 18),
(17, 1, 2, 19),
(20, 1, 2, 25),
(21, 1, 2, 26),
(22, 1, 2, 27),
(30, 1, 15, 1),
(31, 1, 15, 2),
(32, 1, 15, 3),
(33, 1, 15, 4),
(34, 1, 15, 5),
(35, 1, 15, 8),
(36, 1, 15, 9),
(37, 1, 15, 10),
(38, 1, 15, 11),
(39, 1, 15, 12),
(40, 1, 15, 13),
(41, 1, 15, 14),
(42, 1, 15, 15),
(43, 1, 15, 23),
(44, 1, 15, 25),
(45, 1, 15, 26),
(46, 1, 15, 28),
(47, 1, 15, 29),
(48, 1, 15, 30),
(49, 1, 15, 31),
(50, 1, 15, 32),
(51, 1, 15, 33),
(52, 1, 15, 34),
(53, 1, 15, 35),
(54, 1, 15, 36),
(55, 1, 15, 37),
(56, 1, 15, 38),
(57, 1, 15, 39),
(58, 1, 15, 40),
(59, 1, 15, 41),
(60, 1, 15, 42),
(61, 1, 15, 43),
(62, 1, 15, 44),
(63, 1, 15, 45),
(64, 1, 15, 46),
(65, 1, 15, 47),
(66, 1, 15, 48),
(67, 1, 15, 49),
(68, 1, 15, 50),
(69, 1, 15, 51),
(70, 1, 15, 52),
(71, 1, 18, 1),
(72, 1, 18, 2),
(73, 1, 18, 3),
(74, 1, 18, 4),
(75, 1, 18, 5),
(76, 1, 18, 8),
(77, 1, 18, 9),
(78, 1, 18, 10),
(79, 1, 18, 11),
(80, 1, 18, 12),
(81, 1, 18, 13),
(82, 1, 18, 14),
(83, 1, 18, 15),
(84, 1, 18, 23),
(85, 1, 18, 25),
(86, 1, 18, 26),
(87, 1, 18, 28),
(88, 1, 18, 29),
(89, 1, 18, 30),
(90, 1, 18, 31),
(91, 1, 18, 32),
(92, 1, 18, 33),
(93, 1, 18, 34),
(94, 1, 18, 35),
(95, 1, 18, 36),
(96, 1, 18, 37),
(97, 1, 18, 38),
(98, 1, 18, 39),
(99, 1, 18, 40),
(100, 1, 18, 41),
(101, 1, 18, 42),
(102, 1, 18, 43),
(103, 1, 18, 44),
(104, 1, 18, 45),
(105, 1, 18, 46),
(106, 1, 18, 47),
(107, 1, 18, 48),
(108, 1, 18, 49),
(109, 1, 18, 50),
(110, 1, 18, 51),
(111, 1, 18, 52),
(635, 1, 16, 1),
(636, 1, 16, 2),
(637, 1, 16, 3),
(638, 1, 16, 4),
(639, 1, 16, 5),
(640, 1, 16, 8),
(641, 1, 16, 9),
(642, 1, 16, 10),
(643, 1, 16, 11),
(644, 1, 16, 12),
(645, 1, 16, 13),
(646, 1, 16, 14),
(647, 1, 16, 15),
(648, 1, 16, 23),
(649, 1, 16, 25),
(650, 1, 16, 26),
(651, 1, 16, 28),
(652, 1, 16, 29),
(653, 1, 16, 30),
(654, 1, 16, 31),
(655, 1, 16, 32),
(656, 1, 16, 33),
(657, 1, 16, 34),
(658, 1, 16, 35),
(659, 1, 16, 36),
(660, 1, 16, 37),
(661, 1, 16, 38),
(662, 1, 16, 39),
(663, 1, 16, 40),
(664, 1, 16, 41),
(665, 1, 16, 42),
(666, 1, 16, 43),
(667, 1, 16, 44),
(668, 1, 16, 45),
(669, 1, 16, 46),
(670, 1, 16, 47),
(671, 1, 16, 48),
(672, 1, 16, 49),
(673, 1, 16, 50),
(674, 1, 16, 51),
(675, 1, 16, 52),
(676, 1, 16, 53),
(677, 1, 16, 54),
(678, 1, 16, 55),
(679, 1, 11, 1),
(680, 1, 11, 2),
(681, 1, 11, 3),
(682, 1, 11, 4),
(683, 1, 11, 5),
(684, 1, 11, 8),
(685, 1, 11, 9),
(686, 1, 11, 10),
(687, 1, 11, 11),
(688, 1, 11, 12),
(689, 1, 11, 13),
(690, 1, 11, 14),
(691, 1, 11, 15),
(692, 1, 11, 23),
(693, 1, 11, 25),
(694, 1, 11, 26),
(695, 1, 11, 28),
(696, 1, 11, 29),
(697, 1, 11, 30),
(698, 1, 11, 31),
(699, 1, 11, 32),
(700, 1, 11, 33),
(701, 1, 11, 34),
(702, 1, 11, 35),
(703, 1, 11, 36),
(704, 1, 11, 37),
(705, 1, 11, 38),
(706, 1, 11, 39),
(707, 1, 11, 40),
(708, 1, 11, 41),
(709, 1, 11, 42),
(710, 1, 11, 43),
(711, 1, 11, 44),
(712, 1, 11, 45),
(713, 1, 11, 46),
(714, 1, 11, 47),
(715, 1, 11, 48),
(716, 1, 11, 49),
(717, 1, 11, 50),
(718, 1, 11, 51),
(719, 1, 11, 52),
(720, 1, 11, 53),
(721, 1, 11, 54),
(722, 1, 11, 55),
(723, 1, 30, 23),
(724, 1, 30, 51),
(726, 1, 30, 25),
(727, 1, 30, 49),
(728, 1, 30, 50),
(729, 1, 30, 55),
(731, 1, 13, 1),
(732, 1, 13, 2),
(733, 1, 13, 3),
(734, 1, 13, 4),
(735, 1, 13, 5),
(736, 1, 13, 8),
(737, 1, 13, 9),
(738, 1, 13, 10),
(739, 1, 13, 11),
(740, 1, 13, 12),
(741, 1, 13, 13),
(742, 1, 13, 14),
(743, 1, 13, 15),
(744, 1, 13, 23),
(745, 1, 13, 25),
(746, 1, 13, 26),
(747, 1, 13, 28),
(748, 1, 13, 29),
(749, 1, 13, 30),
(750, 1, 13, 31),
(751, 1, 13, 32),
(752, 1, 13, 33),
(753, 1, 13, 34),
(754, 1, 13, 35),
(755, 1, 13, 36),
(756, 1, 13, 37),
(757, 1, 13, 38),
(758, 1, 13, 39),
(759, 1, 13, 40),
(760, 1, 13, 41),
(761, 1, 13, 42),
(762, 1, 13, 43),
(763, 1, 13, 44),
(764, 1, 13, 45),
(765, 1, 13, 46),
(766, 1, 13, 47),
(767, 1, 13, 48),
(768, 1, 13, 49),
(769, 1, 13, 50),
(770, 1, 13, 51),
(771, 1, 13, 52),
(772, 1, 13, 53),
(773, 1, 13, 54),
(774, 1, 13, 55),
(775, 1, 13, 56),
(776, 1, 31, 49),
(777, 1, 31, 52),
(778, 1, 31, 51),
(780, 1, 31, 55),
(885, 29, 93, 1),
(886, 29, 93, 2),
(895, 29, 93, 13),
(896, 29, 93, 14),
(897, 29, 93, 15),
(898, 29, 93, 23),
(899, 29, 93, 25),
(900, 29, 93, 26),
(908, 29, 93, 35),
(909, 29, 93, 36),
(910, 29, 93, 37),
(911, 29, 93, 38),
(912, 29, 93, 39),
(913, 29, 93, 40),
(914, 29, 93, 41),
(915, 29, 93, 42),
(916, 29, 93, 43),
(917, 29, 93, 44),
(918, 29, 93, 45),
(919, 29, 93, 46),
(920, 29, 93, 47),
(921, 29, 93, 48),
(922, 29, 93, 49),
(923, 29, 93, 50),
(924, 29, 93, 51),
(925, 29, 93, 52),
(926, 29, 93, 53),
(927, 29, 93, 54),
(928, 29, 93, 55),
(929, 29, 93, 56),
(930, 29, 93, 57),
(932, 30, 92, 1),
(933, 30, 92, 2),
(934, 30, 92, 3),
(935, 30, 92, 4),
(936, 30, 92, 5),
(937, 30, 92, 8),
(938, 30, 92, 9),
(939, 30, 92, 10),
(940, 30, 92, 11),
(941, 30, 92, 12),
(942, 30, 92, 13),
(943, 30, 92, 14),
(944, 30, 92, 15),
(945, 30, 92, 23),
(946, 30, 92, 25),
(947, 30, 92, 26),
(948, 30, 92, 28),
(949, 30, 92, 29),
(950, 30, 92, 30),
(951, 30, 92, 31),
(952, 30, 92, 32),
(953, 30, 92, 33),
(954, 30, 92, 34),
(955, 30, 92, 35),
(956, 30, 92, 36),
(957, 30, 92, 37),
(958, 30, 92, 38),
(959, 30, 92, 39),
(960, 30, 92, 40),
(961, 30, 92, 41),
(962, 30, 92, 42),
(963, 30, 92, 43),
(964, 30, 92, 44),
(965, 30, 92, 45),
(966, 30, 92, 46),
(967, 30, 92, 47),
(968, 30, 92, 48),
(969, 30, 92, 49),
(970, 30, 92, 50),
(971, 30, 92, 51),
(972, 30, 92, 52),
(973, 30, 92, 53),
(974, 30, 92, 54),
(975, 30, 92, 55),
(976, 30, 92, 56),
(977, 30, 92, 57),
(978, 29, 89, 1),
(979, 29, 89, 2),
(980, 29, 89, 3),
(981, 29, 89, 4),
(982, 29, 89, 5),
(983, 29, 89, 8),
(984, 29, 89, 9),
(985, 29, 89, 10),
(986, 29, 89, 11),
(987, 29, 89, 12),
(988, 29, 89, 13),
(989, 29, 89, 14),
(990, 29, 89, 15),
(991, 29, 89, 23),
(992, 29, 89, 25),
(993, 29, 89, 26),
(994, 29, 89, 28),
(995, 29, 89, 29),
(996, 29, 89, 30),
(997, 29, 89, 31),
(998, 29, 89, 32),
(999, 29, 89, 33),
(1000, 29, 89, 34),
(1001, 29, 89, 35),
(1002, 29, 89, 36),
(1003, 29, 89, 37),
(1004, 29, 89, 38),
(1005, 29, 89, 39),
(1006, 29, 89, 40),
(1007, 29, 89, 41),
(1008, 29, 89, 42),
(1009, 29, 89, 43),
(1010, 29, 89, 44),
(1011, 29, 89, 45),
(1012, 29, 89, 46),
(1013, 29, 89, 47),
(1014, 29, 89, 48),
(1015, 29, 89, 49),
(1016, 29, 89, 50),
(1017, 29, 89, 51),
(1018, 29, 89, 52),
(1019, 29, 89, 53),
(1020, 29, 89, 54),
(1021, 29, 89, 55),
(1022, 29, 89, 56),
(1023, 29, 89, 57),
(1024, 29, 95, 1),
(1025, 29, 95, 2),
(1026, 29, 95, 3),
(1027, 29, 95, 4),
(1028, 29, 95, 5),
(1029, 29, 95, 8),
(1030, 29, 95, 9),
(1031, 29, 95, 10),
(1032, 29, 95, 11),
(1033, 29, 95, 12),
(1034, 29, 95, 13),
(1035, 29, 95, 14),
(1036, 29, 95, 15),
(1037, 29, 95, 23),
(1038, 29, 95, 25),
(1039, 29, 95, 26),
(1040, 29, 95, 28),
(1041, 29, 95, 29),
(1042, 29, 95, 30),
(1043, 29, 95, 31),
(1044, 29, 95, 32),
(1045, 29, 95, 33),
(1046, 29, 95, 34),
(1047, 29, 95, 35),
(1048, 29, 95, 36),
(1049, 29, 95, 37),
(1050, 29, 95, 38),
(1051, 29, 95, 39),
(1052, 29, 95, 40),
(1053, 29, 95, 41),
(1054, 29, 95, 42),
(1055, 29, 95, 43),
(1056, 29, 95, 44),
(1057, 29, 95, 45),
(1058, 29, 95, 46),
(1059, 29, 95, 47),
(1060, 29, 95, 48),
(1061, 29, 95, 49),
(1062, 29, 95, 50),
(1063, 29, 95, 51),
(1064, 29, 95, 52),
(1065, 29, 95, 53),
(1066, 29, 95, 54),
(1067, 29, 95, 55),
(1068, 29, 95, 56),
(1069, 29, 95, 57),
(1070, 29, 96, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `valor_adiantamento`
--

CREATE TABLE `valor_adiantamento` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `abertura` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `forma_pgto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `valor_adiantamento`
--

INSERT INTO `valor_adiantamento` (`id`, `company_id`, `abertura`, `valor`, `nome`, `forma_pgto`) VALUES
(3, 29, 12, 23.00, 'ze', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `variacoes`
--

CREATE TABLE `variacoes` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `produto` int(11) NOT NULL,
  `sigla` varchar(5) NOT NULL,
  `nome` varchar(35) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `ativo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `variacoes`
--

INSERT INTO `variacoes` (`id`, `company_id`, `produto`, `sigla`, `nome`, `descricao`, `valor`, `ativo`) VALUES
(2, 29, 4, 'M', 'Médio', '25CM', 35.00, 'Sim'),
(3, 29, 0, 'f', 'f', 'f', 50.00, 'Sim'),
(4, 29, 0, 'M', 'Média', '6 Fatias', 30.00, 'Sim'),
(12, 29, 3, '300ML', 'Pequeno', 'Pote de 300 ML', 15.00, 'Sim'),
(13, 29, 3, '500ML', 'Médio', 'Pote de 500 ML', 20.00, 'Sim'),
(14, 29, 3, '700ML', 'Grande', 'Pote de 500 ML', 25.00, 'Sim'),
(15, 29, 1, '300ML', 'Pequena', 'Vitamina 300 ML', 10.00, 'Sim'),
(16, 29, 1, '500ML', 'Média', 'Vitamina 500 ML', 18.00, 'Sim'),
(20, 29, 14, 'P', 'Pequena', '4 Fatias', 25.00, 'Sim'),
(21, 29, 14, 'M', 'Média', '6 Fatias', 30.00, 'Sim'),
(22, 29, 14, 'G', 'Grande', '8 Fatias', 35.00, 'Sim'),
(26, 29, 25, 'P', '300 ML', 'Pote Pequeno', 25.00, 'Sim'),
(27, 29, 25, 'M', '500 ML', '', 35.00, 'Sim'),
(29, 29, 31, 'P', 'Pequena', '4 Fatias', 25.00, 'Sim'),
(30, 29, 31, 'M', 'Média', '6 Fatias', 30.00, 'Sim'),
(31, 29, 31, 'G', 'Grande', '8 Fatias', 35.00, 'Sim'),
(32, 29, 31, 'GG', 'Gigante', '10 Fatias', 40.00, 'Sim'),
(33, 29, 17, 'P', 'Pequena', '4 Fatias', 28.00, 'Sim'),
(34, 29, 17, 'M', 'Média', '6 Fatias', 32.00, 'Sim'),
(35, 29, 17, 'G', 'Grande', '8 Fatias', 37.00, 'Sim'),
(38, 29, 16, 'P', 'Pequena', '4 Fatias', 22.00, 'Sim'),
(39, 29, 16, 'M', 'Média', '6 Fatias', 25.00, 'Sim'),
(40, 29, 16, 'G', 'Grande', '8 Fatias', 30.00, 'Sim'),
(41, 29, 16, 'GG', 'Gigante', '10 Fatias', 35.00, 'Sim'),
(42, 29, 14, 'GG', 'Gigante', '10 Fatias', 42.00, 'Sim'),
(43, 29, 32, 'P', 'Pequena', '4 Fatias', 10.00, 'Sim'),
(44, 29, 17, 'GG', 'Gigante', '10 Fatias', 50.00, 'Sim'),
(45, 29, 36, 'P', 'Pequena', '4 Fatias', 30.00, 'Sim'),
(46, 29, 36, 'M', 'Média', '6 Fatias', 50.00, 'Sim'),
(47, 29, 36, 'G', 'Grande', '8 Fatias', 80.00, 'Sim'),
(48, 29, 36, 'GG', 'Gigante', '10 Fatias', 90.00, 'Sim'),
(49, 29, 37, 'P', 'Pequena', '4 Fatias', 35.00, 'Sim'),
(50, 29, 37, 'M', 'Média', '6 Fatias', 45.00, 'Sim'),
(51, 29, 37, 'G', 'Grande', '8 Fatias', 55.00, 'Sim'),
(52, 29, 37, 'GG', 'Gigante', '10 Fatias', 65.00, 'Sim'),
(53, 29, 38, 'P', 'Pequena', '4 Fatias', 35.00, 'Sim'),
(54, 29, 38, 'M', 'Média', '6 Fatias', 45.00, 'Sim'),
(55, 29, 38, 'G', 'Grande', '8 Fatias', 55.00, 'Sim'),
(56, 29, 38, 'GG', 'Gigante', '10 Fatias', 65.00, 'Sim'),
(57, 29, 47, 'P', 'Pequena', '4 Fatias', 35.00, 'Sim'),
(58, 29, 47, 'M', 'Média', '8 Fatias', 45.00, 'Sim'),
(59, 29, 47, 'G', 'Grande', '8 Fatias', 55.00, 'Sim'),
(60, 29, 47, 'GG', 'Gigante', '10 Fatias', 65.00, 'Sim'),
(61, 29, 48, 'P', 'Pequena', '4 Fatias', 35.00, 'Sim'),
(62, 29, 48, 'M', 'Média', '6 Pedaços', 48.00, 'Sim'),
(63, 29, 48, 'G', 'Grande', '8 Fatias', 58.00, 'Sim'),
(64, 29, 48, 'GG', 'Gigante', '10 Fatias', 70.00, 'Sim'),
(65, 29, 50, 'P', 'Pequena', '4 Fatias', 38.00, 'Sim'),
(66, 29, 50, 'M', 'Média', '6 Pedaços', 48.00, 'Sim'),
(67, 29, 50, 'G', 'Grande', '8 Fatias', 58.00, 'Sim'),
(68, 29, 50, 'GG', 'Gigante', '10 Fatias', 68.00, 'Sim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `variacoes_cat`
--

CREATE TABLE `variacoes_cat` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `categoria` int(11) NOT NULL,
  `sigla` varchar(15) NOT NULL,
  `nome` varchar(35) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `sabores` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `variacoes_cat`
--

INSERT INTO `variacoes_cat` (`id`, `company_id`, `categoria`, `sigla`, `nome`, `descricao`, `sabores`) VALUES
(9, 29, 1, 'P', 'Pequena', '4 Fatias', 2),
(10, 29, 1, 'M', 'Média', '6 Fatias', 2),
(11, 29, 1, 'G', 'Grande', '8 Fatias', 4),
(12, 29, 1, 'GG', 'Gigante', '10 Fatias', 6),
(13, 29, 8, 'P', 'Pequeno', '300 ML', 0),
(14, 29, 8, 'M', 'Médio', '500 ML', 0),
(15, 29, 8, 'G', 'Grande', '700 ML', 0),
(16, 29, 17, 'P', 'Pequena', '4 Fatias', 3),
(17, 29, 17, 'M', 'Média', '8 Fatias', 3),
(18, 29, 17, 'G', 'Grande', '12 Fatias', 3),
(28, 29, 23, 'P', 'Pequena', '4 Fatias', 1),
(29, 29, 23, 'M', 'Média', '8 Fatias', 2),
(30, 29, 23, 'G', 'Grande', '8 Fatias', 3),
(31, 29, 23, 'GG', 'Gigante', '10 Fatias', 4),
(33, 29, 24, 'P', 'Pequena', '4 Fatias', 1),
(34, 29, 24, 'M', 'Média', '6 Pedaços', 2),
(35, 29, 24, 'G', 'Grande', '8 Fatias', 3),
(36, 29, 24, 'GG', 'Gigante', '10 Fatias', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `cliente` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `total_pago` decimal(8,2) NOT NULL,
  `troco` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(25) NOT NULL,
  `pago` varchar(5) NOT NULL,
  `obs` varchar(100) DEFAULT NULL,
  `taxa_entrega` decimal(8,2) NOT NULL,
  `tipo_pgto` varchar(25) NOT NULL,
  `usuario_baixa` int(11) NOT NULL,
  `entrega` varchar(25) NOT NULL,
  `mesa` varchar(15) DEFAULT NULL,
  `nome_cliente` varchar(50) DEFAULT NULL,
  `cupom` decimal(8,2) DEFAULT NULL,
  `entregador` int(11) DEFAULT NULL,
  `pago_entregador` varchar(5) DEFAULT NULL,
  `pedido` int(11) DEFAULT NULL,
  `impressao` varchar(5) DEFAULT NULL,
  `ref_api` varchar(50) DEFAULT NULL,
  `caixa` int(11) DEFAULT NULL,
  `tipo_pedido` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `company_id`, `cliente`, `valor`, `total_pago`, `troco`, `data`, `hora`, `status`, `pago`, `obs`, `taxa_entrega`, `tipo_pgto`, `usuario_baixa`, `entrega`, `mesa`, `nome_cliente`, `cupom`, `entregador`, `pago_entregador`, `pedido`, `impressao`, `ref_api`, `caixa`, `tipo_pedido`) VALUES
(38, 29, 14, 7.00, 7.00, 0.00, '2025-06-20', '15:09:35', 'Finalizado', 'Sim', '', 0.00, 'Dinheiro', 89, 'Retirar', '', 'marcelo', 0.00, NULL, 'Não', 1, NULL, '', NULL, 'Balcão'),
(39, 29, 14, 7.00, 7.00, 0.00, '2025-06-20', '15:20:13', 'Finalizado', 'Sim', '', 0.00, 'Dinheiro', 89, 'Consumir Local', '', 'sabrina', 0.00, NULL, 'Não', 2, NULL, '', NULL, 'Balcão'),
(40, 29, 0, 7.00, 7.00, 0.00, '2025-06-21', '15:19:02', 'Finalizado', 'Sim', '', 0.00, 'Dinheiro', 89, 'Consumir Local', '', '', 0.00, NULL, 'Não', 1, NULL, '', NULL, 'Balcão'),
(41, 1, 14, 7.00, 7.00, 0.00, '2025-06-21', '15:24:44', 'Iniciado', 'Não', '', 0.00, 'Dinheiro', 0, 'Retirar', '', 'ryan', 0.00, NULL, 'Não', 2, NULL, '', NULL, ''),
(42, 1, 14, 14.00, 14.00, 0.00, '2025-06-21', '17:23:49', 'Iniciado', 'Não', '', 0.00, 'Dinheiro', 0, 'Retirar', '', 'ryan', 0.00, NULL, 'Não', 3, NULL, '', NULL, ''),
(43, 29, 14, 7.00, 7.00, 0.00, '2025-06-21', '19:38:30', 'Finalizado', 'Não', '', 0.00, 'Dinheiro', 89, 'Retirar', '', 'marcelo', 0.00, NULL, 'Não', 2, NULL, '', NULL, ''),
(44, 29, 15, 14.00, 14.00, 0.00, '2025-06-21', '19:43:26', 'Finalizado', 'Sim', '', 0.00, 'Dinheiro', 89, 'Retirar', '', 'jose', 0.00, NULL, 'Não', 3, NULL, '', NULL, 'Balcão'),
(45, 29, 16, 14.00, 14.00, 0.00, '2025-06-22', '16:26:18', 'Finalizado', 'Não', '', 0.00, 'Dinheiro', 89, 'Retirar', '', 'azul', 0.00, NULL, 'Não', 1, NULL, '', NULL, ''),
(46, 29, 16, 7.00, 7.00, 0.00, '2025-06-25', '15:20:59', 'Finalizado', 'Não', '', 0.00, 'Pix', 89, 'Retirar', '', 'azul', 0.00, NULL, 'Não', 1, NULL, '', NULL, ''),
(47, 29, 16, 14.00, 14.00, 0.00, '2025-06-27', '16:42:44', 'Finalizado', 'Não', '', 0.00, 'Pix', 89, 'Retirar', '', 'toim', 0.00, NULL, 'Não', 1, NULL, '', NULL, ''),
(48, 29, 16, 16.00, 16.00, 0.00, '2025-06-28', '12:30:55', 'Finalizado', 'Não', '', 2.00, 'Pix', 89, 'Delivery', '', 'helo', 0.00, NULL, 'Não', 1, NULL, '', NULL, ''),
(49, 30, 17, 34.00, 34.00, 0.00, '2025-06-28', '13:45:46', 'Finalizado', 'Sim', '', 0.00, 'Dinheiro', 92, 'Consumir Local', '', 'maranhauns', 0.00, NULL, 'Não', 1, NULL, '', NULL, ''),
(50, 29, 16, 7.00, 7.00, 0.00, '2025-06-28', '13:46:37', 'Finalizado', 'Não', '', 0.00, 'Pix', 89, 'Retirar', '', 'melo', 0.00, NULL, 'Não', 2, NULL, '', NULL, ''),
(51, 30, 17, 17.00, 17.00, 0.00, '2025-06-28', '13:48:22', 'Finalizado', 'Sim', '', 0.00, 'Dinheiro', 92, 'Retirar', '', 'ze roberto', 0.00, NULL, 'Não', 2, NULL, '', NULL, ''),
(52, 29, 18, 26.50, 26.50, 0.00, '2025-06-28', '15:08:43', 'Finalizado', 'Não', '', 0.00, 'Pix', 89, 'Retirar', '', 'maike', 0.00, NULL, 'Não', 3, NULL, '', NULL, ''),
(53, 29, 19, 115.00, 200.00, 85.00, '2025-06-28', '15:27:37', 'Finalizado', 'Sim', '', 2.00, 'Dinheiro', 89, 'Delivery', '', 'Sabrina', 0.00, NULL, 'Não', 4, NULL, '', NULL, 'Balcão'),
(54, 29, 20, 22.50, 22.50, 0.00, '2025-06-28', '15:58:40', 'Finalizado', 'Não', '', 0.00, 'Dinheiro', 89, 'Retirar', '', 'CHARLES', 2.50, NULL, 'Não', 5, NULL, '', NULL, ''),
(55, 29, 21, 16.20, 16.20, 0.00, '2025-06-28', '17:36:48', 'Finalizado', 'Sim', '', 2.00, 'Pix', 89, 'Delivery', '', 'Mateus', 1.80, NULL, 'Não', 6, NULL, '', NULL, ''),
(56, 29, 22, 10.44, 10.44, 0.00, '2025-06-28', '17:42:04', 'Finalizado', 'Não', '', 2.00, 'Cartão de Crédito', 89, 'Delivery', '', 'bob', 0.00, 93, 'Não', 7, NULL, '', NULL, ''),
(57, 29, 23, 24.00, 24.00, 0.00, '2025-06-29', '15:47:02', 'Finalizado', 'Não', '', 2.00, 'Dinheiro', 89, 'Delivery', '', 'thomas', 0.00, 93, 'Não', 1, NULL, '', NULL, ''),
(58, 29, 24, 25.00, 25.00, 0.00, '2025-06-29', '16:28:43', 'Finalizado', 'Sim', '', 2.00, 'Dinheiro', 89, 'Delivery', '', 'miranda', 0.00, 93, 'Não', 2, NULL, '', NULL, ''),
(59, 29, 24, 23.00, 23.00, 0.00, '2025-07-03', '22:23:21', 'Iniciado', 'Não', '', 0.00, 'Cartão de Débito', 0, 'Retirar', '', 'miranda', 0.00, NULL, 'Não', 1, NULL, '', NULL, ''),
(60, 29, 24, 11.00, 11.00, 0.00, '2025-07-03', '22:38:03', 'Finalizado', 'Não', '', 2.00, 'Dinheiro', 89, 'Delivery', '', 'miranda', 0.00, 93, 'Não', 2, NULL, '', NULL, ''),
(61, 29, 24, 36.00, 36.00, 0.00, '2025-07-07', '14:10:14', 'Finalizado', 'Não', '', 2.00, 'Pix', 89, 'Delivery', '', 'manel', 0.00, 93, 'Não', 1, NULL, '', NULL, ''),
(62, 29, 24, 9.00, 9.00, 0.00, '2025-07-07', '14:34:35', 'Finalizado', 'Não', '', 2.00, 'Cartão de Crédito', 89, 'Delivery', '', 'manel', 0.00, 93, 'Não', 2, NULL, '', NULL, ''),
(63, 29, 24, 15.98, 15.98, 0.00, '2025-07-07', '15:00:06', 'Finalizado', 'Não', '', 2.00, 'Cartão de Débito', 89, 'Delivery', '', 'manel', 0.00, 93, 'Não', 3, NULL, '', NULL, ''),
(64, 29, 19, 11.00, 11.00, 0.00, '2025-07-11', '17:00:22', 'Aceito', 'Não', '', 2.00, 'Dinheiro', 0, 'Delivery', '', 'edileuza', 0.00, NULL, 'Não', 1, NULL, '', NULL, '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `abertura_mesa`
--
ALTER TABLE `abertura_mesa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acessos_company` (`company_id`);

--
-- Índices de tabela `adicionais`
--
ALTER TABLE `adicionais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `adicionais_cat`
--
ALTER TABLE `adicionais_cat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `anotacoes`
--
ALTER TABLE `anotacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `banner_rotativo`
--
ALTER TABLE `banner_rotativo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `bordas`
--
ALTER TABLE `bordas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `caixas`
--
ALTER TABLE `caixas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Índices de tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `cupons`
--
ALTER TABLE `cupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `delivery_users`
--
ALTER TABLE `delivery_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `financials`
--
ALTER TABLE `financials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `formas_pgto`
--
ALTER TABLE `formas_pgto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `frequencias`
--
ALTER TABLE `frequencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `itens_grade`
--
ALTER TABLE `itens_grade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `pagar`
--
ALTER TABLE `pagar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `receber`
--
ALTER TABLE `receber`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `saidas`
--
ALTER TABLE `saidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `sangrias`
--
ALTER TABLE `sangrias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `valor_adiantamento`
--
ALTER TABLE `valor_adiantamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `variacoes`
--
ALTER TABLE `variacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `variacoes_cat`
--
ALTER TABLE `variacoes_cat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `abertura_mesa`
--
ALTER TABLE `abertura_mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `adicionais`
--
ALTER TABLE `adicionais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `adicionais_cat`
--
ALTER TABLE `adicionais_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `anotacoes`
--
ALTER TABLE `anotacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `banner_rotativo`
--
ALTER TABLE `banner_rotativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `bordas`
--
ALTER TABLE `bordas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `caixas`
--
ALTER TABLE `caixas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `cupons`
--
ALTER TABLE `cupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `delivery_users`
--
ALTER TABLE `delivery_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `dias`
--
ALTER TABLE `dias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `financials`
--
ALTER TABLE `financials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `formas_pgto`
--
ALTER TABLE `formas_pgto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `frequencias`
--
ALTER TABLE `frequencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `itens_grade`
--
ALTER TABLE `itens_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de tabela `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pagar`
--
ALTER TABLE `pagar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de tabela `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de tabela `receber`
--
ALTER TABLE `receber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de tabela `saidas`
--
ALTER TABLE `saidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `sangrias`
--
ALTER TABLE `sangrias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de tabela `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1071;

--
-- AUTO_INCREMENT de tabela `valor_adiantamento`
--
ALTER TABLE `valor_adiantamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `variacoes`
--
ALTER TABLE `variacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de tabela `variacoes_cat`
--
ALTER TABLE `variacoes_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `abertura_mesa`
--
ALTER TABLE `abertura_mesa`
  ADD CONSTRAINT `fk_abertura_mesa_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `acessos`
--
ALTER TABLE `acessos`
  ADD CONSTRAINT `fk_acessos_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `adicionais`
--
ALTER TABLE `adicionais`
  ADD CONSTRAINT `fk_adicionais_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `adicionais_cat`
--
ALTER TABLE `adicionais_cat`
  ADD CONSTRAINT `fk_adicionais_cat_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `anotacoes`
--
ALTER TABLE `anotacoes`
  ADD CONSTRAINT `fk_anotacoes_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `arquivos`
--
ALTER TABLE `arquivos`
  ADD CONSTRAINT `fk_arquivos_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `bairros`
--
ALTER TABLE `bairros`
  ADD CONSTRAINT `fk_bairros_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `banner_rotativo`
--
ALTER TABLE `banner_rotativo`
  ADD CONSTRAINT `fk_banner_rotativo_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `bordas`
--
ALTER TABLE `bordas`
  ADD CONSTRAINT `fk_bordas_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `caixas`
--
ALTER TABLE `caixas`
  ADD CONSTRAINT `fk_caixas_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `cargos`
--
ALTER TABLE `cargos`
  ADD CONSTRAINT `fk_cargos_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `fk_carrinho_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categorias_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `config`
--
ALTER TABLE `config`
  ADD CONSTRAINT `fk_config_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `cupons`
--
ALTER TABLE `cupons`
  ADD CONSTRAINT `fk_cupons_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `delivery_users`
--
ALTER TABLE `delivery_users`
  ADD CONSTRAINT `delivery_users_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `dias`
--
ALTER TABLE `dias`
  ADD CONSTRAINT `fk_dias_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_entradas_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `financials`
--
ALTER TABLE `financials`
  ADD CONSTRAINT `financials_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `formas_pgto`
--
ALTER TABLE `formas_pgto`
  ADD CONSTRAINT `fk_formas_pgto_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD CONSTRAINT `fk_fornecedores_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `frequencias`
--
ALTER TABLE `frequencias`
  ADD CONSTRAINT `fk_frequencias_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `fk_grades_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  ADD CONSTRAINT `fk_grupo_acessos_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `itens_grade`
--
ALTER TABLE `itens_grade`
  ADD CONSTRAINT `fk_itens_grade_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `mesas`
--
ALTER TABLE `mesas`
  ADD CONSTRAINT `fk_mesas_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pagar`
--
ALTER TABLE `pagar`
  ADD CONSTRAINT `fk_pagar_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `receber`
--
ALTER TABLE `receber`
  ADD CONSTRAINT `fk_receber_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `saidas`
--
ALTER TABLE `saidas`
  ADD CONSTRAINT `fk_saidas_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `sangrias`
--
ALTER TABLE `sangrias`
  ADD CONSTRAINT `fk_sangrias_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tarefas`
--
ALTER TABLE `tarefas`
  ADD CONSTRAINT `fk_tarefas_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `temp`
--
ALTER TABLE `temp`
  ADD CONSTRAINT `fk_temp_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  ADD CONSTRAINT `fk_usuarios_permissoes_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `valor_adiantamento`
--
ALTER TABLE `valor_adiantamento`
  ADD CONSTRAINT `fk_valor_adiantamento_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `variacoes`
--
ALTER TABLE `variacoes`
  ADD CONSTRAINT `fk_variacoes_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `variacoes_cat`
--
ALTER TABLE `variacoes_cat`
  ADD CONSTRAINT `fk_variacoes_cat_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `fk_vendas_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
