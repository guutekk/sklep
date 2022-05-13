-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Maj 2022, 14:11
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accounts`
--

CREATE TABLE `accounts` (
  `Id_klienta` int(255) NOT NULL,
  `Imie` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `Nazwisko` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `Telefon` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `Haslo` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `Type` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `accounts`
--

INSERT INTO `accounts` (`Id_klienta`, `Imie`, `Nazwisko`, `Email`, `Telefon`, `Haslo`, `Type`) VALUES
(1, 'Krystian', 'Bielski', 'krystian.bielski@spoko.pl', '797767242', 'c20ad4d76fe97759aa27a0c99bff6710', 1),
(2, 'Marek', 'Ligas', 'dolas@vip.onet.pl', '987654321', 'c20ad4d76fe97759aa27a0c99bff6710', 0),
(5, 'Gabi', 'Ligaas', 'Gabi.Ligas@gmail.com', '567423452', 'e10adc3949ba59abbe56e057f20f883e', 0),
(6, 'awd', 'awd', 'garfild.maciej@onet.pl', '123445664', 'e10adc3949ba59abbe56e057f20f883e', 0),
(7, 'awd', 'awd', 'spoko@spoko.pl', '345742342', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accounts_address`
--

CREATE TABLE `accounts_address` (
  `Id_adresu` int(11) NOT NULL,
  `Ulica` text NOT NULL,
  `Nr_budynku` text NOT NULL,
  `Kod_pocztowy` int(11) NOT NULL,
  `Miasto` text NOT NULL,
  `Id_wojewodztwa` int(11) NOT NULL,
  `Id_klienta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `accounts_address`
--

INSERT INTO `accounts_address` (`Id_adresu`, `Ulica`, `Nr_budynku`, `Kod_pocztowy`, `Miasto`, `Id_wojewodztwa`, `Id_klienta`) VALUES
(7, 'Półrzeczki', '208', 34643, 'Jurków', 6, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `carts`
--

CREATE TABLE `carts` (
  `Id_koszyka` int(11) NOT NULL,
  `Id_produktu` int(11) NOT NULL,
  `Ilosc` int(11) NOT NULL,
  `Id_klienta` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `carts`
--

INSERT INTO `carts` (`Id_koszyka`, `Id_produktu`, `Ilosc`, `Id_klienta`, `Status`) VALUES
(1, 2, 1, 1, 0),
(2, 1, 1, 1, 0),
(3, 3, 1, 1, 0),
(4, 4, 1, 1, 0),
(5, 5, 1, 1, 0),
(6, 25, 5, 1, 0),
(7, 26, 2, 1, 0),
(8, 27, 1, 1, 0),
(9, 25, 5, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `Id_kategorii` int(255) NOT NULL,
  `Nazwa` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `Zdjecie` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`Id_kategorii`, `Nazwa`, `Zdjecie`) VALUES
(1, 'V-DOLCE', 'images/'),
(2, 'SKINY', 'images/'),
(3, 'KARNETY', 'images/');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `delivery_method`
--

CREATE TABLE `delivery_method` (
  `Id_dostawy` int(11) NOT NULL,
  `Nazwa` text NOT NULL,
  `Cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `delivery_method`
--

INSERT INTO `delivery_method` (`Id_dostawy`, `Nazwa`, `Cena`) VALUES
(1, 'InPost Paczkomaty 24/7', 11),
(2, 'Przesyłka kurierska krajowa', 17),
(3, 'Poczta polska', 20),
(4, 'DHL', 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `images`
--

CREATE TABLE `images` (
  `Id_zdjecia` int(11) NOT NULL,
  `Nazwa_pliku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `Id_produktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `images`
--

INSERT INTO `images` (`Id_zdjecia`, `Nazwa_pliku`, `uploaded_on`, `status`, `Id_produktu`) VALUES
(7, 'black_knight.png', '2022-05-12 09:35:34', '1', 25),
(8, 'szafka_png.jpg', '2022-05-12 09:35:34', '1', 25),
(9, 'vdolce.png', '2022-05-12 09:35:34', '1', 25),
(11, 'vdolce.png', '2022-05-12 10:09:15', '1', 26),
(12, 'pies.png', '2022-05-12 11:27:38', '1', 27);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `Id_zamowienia` int(11) NOT NULL,
  `Id_klienta` int(11) NOT NULL,
  `Id_dostawy` int(11) NOT NULL,
  `Id_platnosci` int(11) NOT NULL,
  `Data_zamowienia` date NOT NULL,
  `Cena` int(11) NOT NULL,
  `Ilosc` int(11) NOT NULL,
  `Ulica` text NOT NULL,
  `Nr_budynku` text NOT NULL,
  `Kod_pocztowy` int(11) NOT NULL,
  `Miasto` text NOT NULL,
  `Id_wojewodztwa` int(11) NOT NULL,
  `Id_statusu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`Id_zamowienia`, `Id_klienta`, `Id_dostawy`, `Id_platnosci`, `Data_zamowienia`, `Cena`, `Ilosc`, `Ulica`, `Nr_budynku`, `Kod_pocztowy`, `Miasto`, `Id_wojewodztwa`, `Id_statusu`) VALUES
(5, 1, 1, 1, '2022-05-12', 21, 0, 'Półrzeczki', '208', 34643, 'Jurków', 6, 0),
(6, 1, 1, 1, '2022-05-12', 21, 0, 'Półrzeczki', '208', 34643, 'Jurków', 6, 0),
(7, 1, 1, 1, '2022-05-13', 170, 0, 'Półrzeczki', '208', 34643, 'Jurków', 14, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders_status`
--

CREATE TABLE `orders_status` (
  `Id_statusu` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payments`
--

CREATE TABLE `payments` (
  `Id_platnosci` int(11) NOT NULL,
  `Nazwa` text NOT NULL,
  `Cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `payments`
--

INSERT INTO `payments` (`Id_platnosci`, `Nazwa`, `Cena`) VALUES
(1, 'Pobranie', 10),
(2, 'Przelew', 0),
(3, 'Blik', 0),
(4, 'Paypal', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `Id_produktu` int(255) NOT NULL,
  `Nazwa` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `Opis` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `Id_kategorii` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `Cena` int(255) NOT NULL,
  `Ilosc` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`Id_produktu`, `Nazwa`, `Opis`, `Id_kategorii`, `Cena`, `Ilosc`) VALUES
(25, '1000 VDOLCY', 'Po zakupie tego przedmiotu zostanie dodane 1000 Vdolcy do twojego konta fortnite', '1', 20, 5),
(26, 'Vdolce 5000', 'awdawdawdawdawd', '1', 24, 2),
(27, 'test', 'test', '2', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `provinces`
--

CREATE TABLE `provinces` (
  `Id_wojewodztwa` int(11) NOT NULL,
  `Nazwa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `provinces`
--

INSERT INTO `provinces` (`Id_wojewodztwa`, `Nazwa`) VALUES
(1, 'Dolnośląskie'),
(2, 'Kujawsko-pomorskie'),
(3, 'Lubelskie'),
(4, 'Lubuskie'),
(5, 'Łódzkie'),
(6, 'Małopolskie'),
(7, 'Mazowieckie'),
(8, 'Opolskie'),
(9, 'Podkarpackie'),
(10, 'Podlaskie'),
(11, 'Pomorskie'),
(12, 'Śląskie'),
(13, 'Świętokrzyskie'),
(14, 'Warmińsko-mazurskie'),
(15, 'Wielkopolskie'),
(16, 'Zachodniopomorskie');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Id_klienta`);

--
-- Indeksy dla tabeli `accounts_address`
--
ALTER TABLE `accounts_address`
  ADD PRIMARY KEY (`Id_adresu`);

--
-- Indeksy dla tabeli `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`Id_koszyka`);

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Id_kategorii`);

--
-- Indeksy dla tabeli `delivery_method`
--
ALTER TABLE `delivery_method`
  ADD PRIMARY KEY (`Id_dostawy`);

--
-- Indeksy dla tabeli `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`Id_zdjecia`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id_zamowienia`);

--
-- Indeksy dla tabeli `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`Id_platnosci`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id_produktu`);

--
-- Indeksy dla tabeli `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`Id_wojewodztwa`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `accounts`
--
ALTER TABLE `accounts`
  MODIFY `Id_klienta` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `accounts_address`
--
ALTER TABLE `accounts_address`
  MODIFY `Id_adresu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `carts`
--
ALTER TABLE `carts`
  MODIFY `Id_koszyka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `Id_kategorii` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `delivery_method`
--
ALTER TABLE `delivery_method`
  MODIFY `Id_dostawy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `images`
--
ALTER TABLE `images`
  MODIFY `Id_zdjecia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `Id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `payments`
--
ALTER TABLE `payments`
  MODIFY `Id_platnosci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `Id_produktu` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `provinces`
--
ALTER TABLE `provinces`
  MODIFY `Id_wojewodztwa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
