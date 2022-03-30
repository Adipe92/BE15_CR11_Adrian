-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Mar 2022, 10:56
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `be15_cr11_petadoption_adrian`
--
CREATE DATABASE IF NOT EXISTS `be15_cr11_petadoption_adrian` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be15_cr11_petadoption_adrian`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `aname` varchar(255) NOT NULL,
  `kind` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `loca` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `txt` varchar(500) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `animals`
--

INSERT INTO `animals` (`id`, `aname`, `kind`, `age`, `size`, `hobbies`, `loca`, `breed`, `txt`, `picture`) VALUES
(12, 'Rocky', 'Dog', '11', 'small', 'Looking for sticks', 'Warsaw', 'German Sheperd', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam numquam fuga, vitae nisi dolorum.', '624378d7bfb35.jpg'),
(13, 'Backy', 'Dog', '3', 'small', 'Play ball', 'Cracow', 'Shiba', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam numquam fuga, vitae nisi dolorum.', '6242c2952b725.jpg'),
(14, 'Oana', 'Guinea Pig', '2', 'small', 'Lying in the grass', 'Wraclaw', 'Guinea', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam numquam fuga, vitae nisi dolorum.', '6242c3391d6aa.jpg'),
(15, 'Daisy', 'Cat', '4', 'medium', 'Catching Mice', 'Gdansk', 'Syberian', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam numquam fuga, vitae nisi dolorum.', '6242c3dd697c8.jpg'),
(16, 'Manuela', 'Cat', '7', 'small', 'Dancing', 'Poznan', 'Norwegian', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam numquam fuga, vitae nisi dolorum.', '6242c4cdb8502.jpg'),
(17, 'Lilly', 'Dog', '9', 'large', 'Eating shoes', 'Resovia', 'Buldog', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam numquam fuga, vitae nisi dolorum.', '6242c542c0d81.jpg'),
(18, 'Rocky', 'Pig', '3', 'small', 'Running', 'Bydgoszcz', 'Hampshire', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam numquam fuga, vitae nisi dolorum.', '6242c5c18c5b5.jpg'),
(19, 'Raty', 'Rat', '1', 'small', 'Eating cheese', 'Warsaw', 'Rex', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam numquam fuga, vitae nisi dolorum.', '6242c63867187.jpg'),
(20, 'Barney', 'Turtle', '10', 'large', 'Swimming', 'Lodz', 'African Sideneck', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam numquam fuga, vitae nisi dolorum.', '6242c6e8d08ad.jpg'),
(21, 'Alex', 'Dog', '10', 'small', 'Sticks', 'Cracow', 'Husky', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quibusdam numquam fuga, vitae nisi dolorum.', '6243786ee987e.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `fk_user_id` int(11) NOT NULL,
  `fk_animal_id` int(11) NOT NULL,
  `adoption_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `phone_nb` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `pass`, `date_of_birth`, `user_address`, `phone_nb`, `email`, `picture`, `status`) VALUES
(1, 'Adrian', 'Pedziwiatr', '1234567', '1992-01-10', 'Eckertgasse 7/6', 505677618, 'adrianpe092@gmail.com', 'avatar.png', 'adm'),
(2, 'Maciek', 'Skalski', 'maciek12345', '1995-03-08', 'Rożana20', 505677618, 'maciek@mail.com', 'avatar.png', 'user'),
(3, 'Adrian', 'Pedziwiatr', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2022-03-16', 'Vienna', 123456789, 'adrian@mail.com', 'avatar.png', 'user'),
(4, 'Maria', 'Maria', 'd37414f39496c561655d6a6c91cabd676b051b864bd81d2c74638d909819a260', '2022-03-09', 'Vienna', 123456789, 'maria@mail.com', 'avatar.png', 'adm');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_animal_id` (`fk_animal_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`fk_animal_id`) REFERENCES `animals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
