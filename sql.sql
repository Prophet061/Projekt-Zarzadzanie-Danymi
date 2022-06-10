-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mariadb106.server640683.nazwa.pl:3306
-- Czas generowania: 10 Cze 2022, 19:46
-- Wersja serwera: 10.6.7-MariaDB-log
-- Wersja PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `server640683_zarzadzanie`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `education`
--

INSERT INTO `education` (`id`, `name`) VALUES
(1, 'Wykształcenie podstawowe'),
(2, 'Wykształcenie średnie'),
(3, 'Wykształcenie zawodowe'),
(4, 'Wykształcenie branżowe\r\n'),
(5, 'Wykształcenie wyższe'),
(8, 'Brak wykształcenia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `id_offer` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `industry`
--

CREATE TABLE `industry` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `industry`
--

INSERT INTO `industry` (`id`, `name`) VALUES
(2, 'IT'),
(4, 'Mechanik'),
(5, 'Kucharz'),
(6, 'Piekarz'),
(7, 'Murarz'),
(8, 'Tynkarz'),
(9, 'Kurier'),
(10, 'Spedytor');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `company` varchar(256) NOT NULL,
  `industry` varchar(64) NOT NULL,
  `description` longtext NOT NULL,
  `responsibilities` longtext NOT NULL,
  `requirments` longtext NOT NULL,
  `education` int(11) NOT NULL,
  `speciality` int(11) NOT NULL,
  `offer_type` int(11) NOT NULL,
  `salary_from` decimal(8,2) NOT NULL,
  `salary_to` decimal(8,2) NOT NULL,
  `highlighted` int(11) NOT NULL DEFAULT 0,
  `address_city` varchar(64) NOT NULL,
  `address_zipcode` varchar(6) NOT NULL,
  `address_street` varchar(128) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_expiration` datetime NOT NULL DEFAULT '2100-12-31 23:59:59',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `offer`
--

INSERT INTO `offer` (`id`, `id_user`, `name`, `company`, `industry`, `description`, `responsibilities`, `requirments`, `education`, `speciality`, `offer_type`, `salary_from`, `salary_to`, `highlighted`, `address_city`, `address_zipcode`, `address_street`, `mobile`, `email`, `status`, `date_expiration`, `date_created`, `date_modified`) VALUES
(10, 10, 'Murarz akrobata', 'JanuszexPol', '7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel ipsum nec ligula lobortis placerat. Pellentesque eu bibendum lorem. Cras semper dictum fringilla. Phasellus volutpat commodo ex sit amet finibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras a diam id massa aliquet fringilla. Aliquam orci sapien, commodo sit amet ipsum rutrum, tempus eleifend orci. Vestibulum et dictum mi, ac rhoncus nulla. Sed vitae neque tincidunt, convallis tellus quis, imperdiet nulla. Nunc lacinia dapibus eros non pharetra.\r\n\r\nAenean tristique, eros in pretium sagittis, metus nibh tempor nulla, sit amet varius magna tortor non libero. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque tincidunt vehicula eros, at cursus felis ornare ac. Nullam feugiat porttitor venenatis. Vivamus ultrices neque vitae risus iaculis bibendum. Suspendisse placerat justo vitae ligula tristique, in porttitor diam tempus. In vehicula eget mi vitae ultricies. Integer ac purus vel metus commodo viverra. Etiam ultricies lorem vitae lorem mattis, ac aliquet mauris mollis. Nullam quis elementum elit. Nam nec sem eget felis sollicitudin iaculis. In et felis bibendum, placerat ipsum in, cursus leo. Nam tincidunt ut leo id fermentum. Quisque et nisi dictum, fermentum enim ac, blandit dolor. Curabitur metus leo, vestibulum vitae imperdiet eu, lobortis vel odio.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel ipsum nec ligula lobortis placerat. Pellentesque eu bibendum lorem. Cras semper dictum fringilla. Phasellus volutpat commodo ex sit amet finibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras a diam id massa aliquet fringilla. Aliquam orci sapien, commodo sit amet ipsum rutrum, tempus eleifend orci. Vestibulum et dictum mi, ac rhoncus nulla. Sed vitae neque tincidunt, convallis tellus quis, imperdiet nulla. Nunc lacinia dapibus eros non pharetra.\r\n\r\nAenean tristique, eros in pretium sagittis, metus nibh tempor nulla, sit amet varius magna tortor non libero. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque tincidunt vehicula eros, at cursus felis ornare ac. Nullam feugiat porttitor venenatis. Vivamus ultrices neque vitae risus iaculis bibendum. Suspendisse placerat justo vitae ligula tristique, in porttitor diam tempus. In vehicula eget mi vitae ultricies. Integer ac purus vel metus commodo viverra. Etiam ultricies lorem vitae lorem mattis, ac aliquet mauris mollis. Nullam quis elementum elit. Nam nec sem eget felis sollicitudin iaculis. In et felis bibendum, placerat ipsum in, cursus leo. Nam tincidunt ut leo id fermentum. Quisque et nisi dictum, fermentum enim ac, blandit dolor. Curabitur metus leo, vestibulum vitae imperdiet eu, lobortis vel odio.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel ipsum nec ligula lobortis placerat. Pellentesque eu bibendum lorem. Cras semper dictum fringilla. Phasellus volutpat commodo ex sit amet finibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras a diam id massa aliquet fringilla. Aliquam orci sapien, commodo sit amet ipsum rutrum, tempus eleifend orci. Vestibulum et dictum mi, ac rhoncus nulla. Sed vitae neque tincidunt, convallis tellus quis, imperdiet nulla. Nunc lacinia dapibus eros non pharetra.\r\n\r\nAenean tristique, eros in pretium sagittis, metus nibh tempor nulla, sit amet varius magna tortor non libero. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque tincidunt vehicula eros, at cursus felis ornare ac. Nullam feugiat porttitor venenatis. Vivamus ultrices neque vitae risus iaculis bibendum. Suspendisse placerat justo vitae ligula tristique, in porttitor diam tempus. In vehicula eget mi vitae ultricies. Integer ac purus vel metus commodo viverra. Etiam ultricies lorem vitae lorem mattis, ac aliquet mauris mollis. Nullam quis elementum elit. Nam nec sem eget felis sollicitudin iaculis. In et felis bibendum, placerat ipsum in, cursus leo. Nam tincidunt ut leo id fermentum. Quisque et nisi dictum, fermentum enim ac, blandit dolor. Curabitur metus leo, vestibulum vitae imperdiet eu, lobortis vel odio.', 1, 3, 2, '300.00', '500.00', 1, 'Dębica', '39-200', 'Rzeszowska 1', '+48 333 333 333', 'januszex@pol.pl', 1, '2100-12-31 23:59:59', '2022-06-10 01:19:46', '2022-06-10 02:52:34');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offer_type`
--

CREATE TABLE `offer_type` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `offer_type`
--

INSERT INTO `offer_type` (`id`, `name`) VALUES
(1, 'Umowa zlecenie'),
(2, 'Umowa o dzieło'),
(3, 'Umowa o staż'),
(4, 'Umowa na czas określony'),
(5, 'Umowa na czas nieokreślony'),
(6, 'Umowa B2B');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `speciality`
--

CREATE TABLE `speciality` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `speciality`
--

INSERT INTO `speciality` (`id`, `name`) VALUES
(1, 'Informatyka'),
(2, 'Kosmetologia'),
(3, 'Kulturoznastwo'),
(4, 'Lotnictwo'),
(5, 'Księgowość');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` char(32) NOT NULL,
  `access_token` char(32) NOT NULL,
  `auth_key` char(32) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `type` int(11) NOT NULL DEFAULT 0,
  `name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `access_token`, `auth_key`, `status`, `type`, `name`, `surname`, `date_created`, `date_modified`) VALUES
(8, 'Osoba', '0ab83b6bdb7efb1657299bcbd478c0e8', '8MK793dB07CN2XQCZlYKKktAu2aKCdsR', 'S4nnV3S0hfdGGEmXSu53NTwKxSSVhhaK', 1, 1, 'Osoba', '', '2022-06-09 23:14:20', '2022-06-10 19:45:16'),
(10, 'Pracodawca', '0ab83b6bdb7efb1657299bcbd478c0e8', '8MK793dB07CN2XQCZlYKKktAu2aKCdsR', 'S4nnV3S0hfdGGEmXSu53NTwKxSSVhhaK', 1, 2, 'Pracodawca', '', '2022-06-10 01:09:55', '2022-06-10 19:44:45'),
(11, 'Admin', '0ab83b6bdb7efb1657299bcbd478c0e8', '8MK793dB07CN2XQCZlYKKktAu2aKCdsR', 'S4nnV3S0hfdGGEmXSu53NTwKxSSVhhaK', 1, 1, 'Admin', '', '2022-06-10 19:44:01', '2022-06-10 19:45:17');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `industry`
--
ALTER TABLE `industry`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `offer_type`
--
ALTER TABLE `offer_type`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `speciality`
--
ALTER TABLE `speciality`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `industry`
--
ALTER TABLE `industry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `offer_type`
--
ALTER TABLE `offer_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `speciality`
--
ALTER TABLE `speciality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
