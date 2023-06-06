-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 06 2023 г., 17:46
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `registry`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accept-appointment`
--

CREATE TABLE `accept-appointment` (
  `id` int(11) NOT NULL,
  `id_appoint` int(11) NOT NULL,
  `treatment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `accept-appointment`
--

INSERT INTO `accept-appointment` (`id`, `id_appoint`, `treatment`) VALUES
(1, 3, 'сифилис');

-- --------------------------------------------------------

--
-- Структура таблицы `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `id_pation` int(11) NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `appointment`
--

INSERT INTO `appointment` (`id`, `id_doctor`, `id_pation`, `date`, `time`) VALUES
(2, 3, 5, '2023-06-03', '9:00'),
(3, 3, 5, '2023-06-06', '9:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` text NOT NULL,
  `dismiss` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `id_group`, `login`, `password`, `email`, `full_name`, `phone`, `dismiss`) VALUES
(2, 4, 'admin', '$2y$10$SH.GFbqFS6txWtvdOuPeP.EEyju3TTQV507VJCNElUK8h7hpXZ2bm', 'admin@admin', 'admin', '123123', 0),
(3, 3, 'doctor', '$2y$10$uyHNqmxJs17qECZZFzLVueons/OkYdEq4Q/mRFgxhMgQohepmCWGW', 'doctor@doctor', 'doctor', '123123', 0),
(4, 2, 'registry', '$2y$10$GjVOKxeAVl3Z9phoVOVnzOAD2.TXYy.OzcGZfZzIKU85xm2Y8f.VC', 'registry@registry', 'registry', '123123', 0),
(5, 1, 'pation', '$2y$10$NrIrZiQ8oi1bEJTgqhIcNu97G/3A/J8aVeauQDE9Luvv9NX0daYwG', 'pation@pation', 'pation', '123123', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accept-appointment`
--
ALTER TABLE `accept-appointment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accept-appointment`
--
ALTER TABLE `accept-appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
