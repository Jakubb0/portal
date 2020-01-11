-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Sty 2020, 15:58
-- Wersja serwera: 10.1.32-MariaDB
-- Wersja PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `portal`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `files`
--

INSERT INTO `files` (`id`, `name`, `path`) VALUES
(8, 'BIZNESPLAN2.docx', 'files\\BIZNESPLAN2.docx'),
(9, 'BIZNESPLAN-KWIACIARNIA.docx', 'files\\BIZNESPLAN-KWIACIARNIA.docx'),
(10, 'Przedsiębiorczość-akademicka-test.docx', 'D:\\xampp\\htdocs\\portal2\\public\\files\\Przedsiębiorczość-akademicka-test.docx'),
(11, 'Psychologia.pdf', 'D:\\xampp\\htdocs\\portal2\\public\\files\\Psychologia.pdf'),
(12, 'Seminarium-dyplomowe-prezentacja.pptx', 'D:\\xampp\\htdocs\\portal2\\public\\files\\Seminarium-dyplomowe-prezentacja.pptx');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `file_post`
--

CREATE TABLE `file_post` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `file_post`
--

INSERT INTO `file_post` (`id`, `file_id`, `post_id`) VALUES
(1, 8, 14),
(2, 9, 14),
(3, 10, 19),
(4, 11, 19),
(5, 12, 19);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `institute` varchar(64) NOT NULL,
  `year` int(4) NOT NULL,
  `type` int(11) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `groups`
--

INSERT INTO `groups` (`id`, `name`, `institute`, `year`, `type`, `owner`) VALUES
(1, 'test', 'test', 2019, 1, 3),
(2, 'test2', 'xx', 2010, 1, 3),
(3, 'asd', 'test', 1234, 2, 3),
(4, 'testowa', 'pl', 1999, 1, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `group_post`
--

CREATE TABLE `group_post` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `group_post`
--

INSERT INTO `group_post` (`id`, `group_id`, `post_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 1, 14),
(5, 1, 17),
(6, 2, 17);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `group_user`
--

CREATE TABLE `group_user` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `group_user`
--

INSERT INTO `group_user` (`id`, `user_id`, `group_id`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 7, 1),
(4, 3, 3),
(5, 4, 3),
(6, 4, 2),
(7, 5, 2),
(8, 6, 2),
(9, 9, 1),
(10, 11, 1),
(11, 13, 1),
(12, 14, 1),
(13, 15, 4),
(14, 16, 2),
(15, 17, 1),
(16, 18, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `public` float DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `user_id`, `public`, `date`) VALUES
(1, 'costam', 'tsasdasdasdas', 3, NULL, '2019-12-14 00:00:00'),
(2, 'sdfasd', 'sfasdfasdbfl', 3, NULL, '2019-12-15 00:00:00'),
(3, 'xcxd', 'sfsdf', 7, NULL, '2019-12-14 00:00:00'),
(4, 'asd', '123', 3, NULL, '2020-01-02 17:51:40'),
(5, 'asd', '123', 3, NULL, '2020-01-02 17:52:02'),
(6, 'asd', 'asd', 3, NULL, '2020-01-02 17:55:59'),
(7, '1', '1', 3, NULL, '2020-01-02 17:57:17'),
(8, '1', '1', 3, NULL, '2020-01-02 18:13:04'),
(9, '1', '1', 3, NULL, '2020-01-02 18:13:54'),
(10, 'asd', '123', 3, NULL, '2020-01-02 18:18:45'),
(11, 'asd', '123', 3, NULL, '2020-01-02 18:19:19'),
(12, 'asd', '123', 3, NULL, '2020-01-02 18:19:30'),
(13, 'asd', '123', 3, NULL, '2020-01-02 18:20:16'),
(14, 'asd', '123', 3, NULL, '2020-01-02 18:21:09'),
(15, 'testowanko', 'tekst', 3, NULL, '2020-01-03 16:42:37'),
(16, 'testowanko', 'tekst', 3, NULL, '2020-01-03 16:43:21'),
(17, 'testowanko', 'tekst', 3, NULL, '2020-01-03 16:43:36'),
(18, 'publiczny test', 'publiczna wiadomość', 3, 1, '2020-01-06 14:37:49'),
(19, 'publiczna z plikami', 'Wysyłam pliki do wszystkich', 3, 1, '2020-01-06 14:42:08');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `role` int(11) NOT NULL,
  `album` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `surname`, `email`, `role`, `album`) VALUES
(3, 'asd', '$2y$10$sEVxXSe2ptBe0CtAzLw5XeG4j82slaPkoCb0jpKnYvsIoIPYy.1eK', 'Jakub', 'Bogdański', 'asd@asd.pl', 3, NULL),
(4, 'asd', '$2y$10$nNO6tYeILNiJFmlodnCyBu1FuROrJgNxE2BM0xFl0fLJFTQ2r./Ee', 'asd', 'asd', 'asd@asd.pl', 1, NULL),
(5, 'asd', '$2y$10$p/k.S6VvwtHN.B4vu61JheMVGCrEg7D2x2yxTSAOXCMt2HZQ9GsIG', 'asd', 'asd', 'asd@asd.pl', 1, NULL),
(6, 'qwe', '$2y$10$X3u4ztrngVRaM9xECWNvl.skJGIZzDuCByA.TFd90iZ6FWLzXawYy', 'asd', 'asd', '123@123.123', 1, NULL),
(7, 'zxc', '$2y$10$eb5ogOqSTgokV.cw74ZhruK1rAnP/VRi/vqzuFR.ZEGCEihLSC/Xe', 'qwe', 'qwe', 'qwe@qwe.pl', 1, NULL),
(8, 'zxc', '$2y$10$dSKvthlZQiIvApRt3IfAeODFtYf5jmQ61MBeTH3WeFUAB59F/fgKO', 'qwe', 'qwe', 'qwe@qwe.pl', 1, NULL),
(9, 'test', '$2y$10$CRew4DWX.BMvgzzG6GHQC.TZ3KlH4SyEPUZ2fh7x3a3O/Uubf8fJ.', 'test', 'test', 'test@test.pl', 1, NULL),
(10, 'test', '$2y$10$ry6RRSKn0mR1ozLs3qt4BeRwLTpm/fq/E7E9GoQ9LoGK4QSYD881S', 'test', 'test', 'test@test.pl', 1, NULL),
(11, 'test', '$2y$10$Q5uEaSJj3dqzgWDGTlWVYeHPK1ALqX050xm6SHgDN74xi2PrFabiK', 'test', 'test', 'test@test.pl', 1, NULL),
(12, 'test', '$2y$10$.zT9KXtmPaJLIpi8ofiR7uf9t9vTdgSxjw7ZkFih0I0DOvn6vKZxK', 'test', 'test', 'test@test.pl', 1, NULL),
(13, 'test2', '$2y$10$6pHI1Y3bWXi3Nf9ERadl4./Q8uavLdlfLIqGDgZ7xhyAv8qHt2.v.', 'test2', 'test2', 'test@test.pl', 1, NULL),
(14, 'jan', '$2y$10$sEVxXSe2ptBe0CtAzLw5XeG4j82slaPkoCb0jpKnYvsIoIPYy.1eK', 'jan', 'janowski', 'a@a.pl', 1, NULL),
(15, 'jozek', '$2y$10$sEVxXSe2ptBe0CtAzLw5XeG4j82slaPkoCb0jpKnYvsIoIPYy.1eK', 'jozef', 'ski', 'b@b', 1, NULL),
(16, 'stefan', '$2y$10$cM1FBvopLqvVXgaBE0yUNumfwW6YNF2rKARHPEH1WXNlBib5Hap4S', 'stefan', 'owski', 'c@c.pl', 1, NULL),
(17, 'mmm', '$2y$10$26O09wTpCi4KoPISJXSJXODaJzRX9pzPKxuzj05xjjQ0Wn.VQ.JQG', 'asd', '123', 's@s.pl', 1, NULL),
(18, 'xin', '$2y$10$dDpqmDKFSf4Rj9CdhDj0bO9FhVEB9bEhjjz22eC5REyq6MMZTpm1i', 'xin', 'xin', 'z@x.c', 1, NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `file_post`
--
ALTER TABLE `file_post`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `group_post`
--
ALTER TABLE `group_post`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `file_post`
--
ALTER TABLE `file_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `group_post`
--
ALTER TABLE `group_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
