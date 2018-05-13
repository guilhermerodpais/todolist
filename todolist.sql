-- --------------------------------------------------------

CREATE DATABASE todolist;
USE todolist;
--
-- Estrutura da tabela `list`
--

CREATE TABLE `list` (
  `id` int(11) NOT NULL,
  `description` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `list`
--

INSERT INTO `list` (`id`, `description`) VALUES
(3, 'Minha Festa'),
(6, 'Viagem Julho'),
(7, 'Sprint Trabalho - MarÃ§o'),
(8, 'Sprint Trabalho - Abril'),
(9, 'Meu Mercado - Maio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `list_id` int(11) DEFAULT NULL,
  `check_value` varchar(50) DEFAULT 'false',
  `description` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `task`
--

INSERT INTO `task` (`id`, `list_id`, `check_value`, `description`) VALUES
(1, 3, 'false', 'Mercado'),
(2, 3, 'false', 'Comprar Cadeira'),
(33, 3, 'false', 'Contratar Buffet'),
(38, 8, 'false', 'Ajuste BotÃ£o Comprar'),
(39, 8, 'false', 'Ajuste Quebra de Linha no cabeÃ§alho'),
(40, 8, 'true', 'Ajuste Tom do rodapÃ©, ajustar para #282828'),
(41, 7, 'true', 'Realizar Teste UnitÃ¡rio dos cadastros de usuÃ¡rio'),
(42, 7, 'false', 'Realizar SCRUM DiÃ¡rio'),
(43, 7, 'false', 'Realizar Checkup das tarefas'),
(44, 6, 'false', 'Ler 5 livros'),
(45, 6, 'false', 'Visitar Museus'),
(46, 6, 'false', 'Visitar Galeria do Rock'),
(48, 9, 'false', '1 Duzia de Banana'),
(49, 9, 'false', '2 Latas de Nescau'),
(50, 9, 'true', '7 Laranjas Seleta'),
(51, 9, 'true', '1kg de AÃ§ucar Refinado');

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_list` (`list_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk_list` FOREIGN KEY (`list_id`) REFERENCES `list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
