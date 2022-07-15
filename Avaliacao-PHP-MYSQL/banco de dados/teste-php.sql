-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Jul-2022 às 21:17
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste-php`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `precos`
--

CREATE TABLE `precos` (
  `idpreco` int(11) NOT NULL,
  `idprod` int(11) NOT NULL,
  `preco` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `precos`
--

INSERT INTO `precos` (`idpreco`, `idprod`, `preco`) VALUES
(1, 1, '7.75'),
(3, 3, '4.90'),
(4, 4, '25.00'),
(5, 5, '2.99'),
(6, 6, '8.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idprod` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `cor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idprod`, `nome`, `cor`) VALUES
(1, 'Leite', 'BRANCO'),
(3, 'Açucar', 'VERMELHO'),
(4, 'Frango Frito', 'AZUL'),
(5, 'Abacaxi', 'LARANJA'),
(6, 'Colve', 'AZUL');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `precos`
--
ALTER TABLE `precos`
  ADD PRIMARY KEY (`idpreco`),
  ADD KEY `fk_prod` (`idprod`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idprod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `precos`
--
ALTER TABLE `precos`
  MODIFY `idpreco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idprod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `precos`
--
ALTER TABLE `precos`
  ADD CONSTRAINT `fk_prod` FOREIGN KEY (`idprod`) REFERENCES `produtos` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
