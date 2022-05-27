-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Maj 2022, 12:19
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
(15, 'Półrzeczki', '208', 34643, 'Jurków', 6, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `carts`
--

CREATE TABLE `carts` (
  `Id_koszyka` int(11) NOT NULL,
  `Id_produktu` int(11) NOT NULL,
  `Ilosc` int(11) NOT NULL,
  `Id_klienta` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0,
  `Nr_zamowienia` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `carts`
--

INSERT INTO `carts` (`Id_koszyka`, `Id_produktu`, `Ilosc`, `Id_klienta`, `Status`, `Nr_zamowienia`) VALUES
(1, 26, 1, 1, 1, 48596),
(2, 25, 1, 1, 1, 48596),
(3, 26, 1, 1, 1, 52904),
(4, 26, 1, 1, 1, 36217);

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
(1, 'VDOLCE', 'images/'),
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
  `typ` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `Id_produktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `images`
--

INSERT INTO `images` (`Id_zdjecia`, `Nazwa_pliku`, `uploaded_on`, `typ`, `Id_produktu`) VALUES
(13, '2df2435abcaea00207d5c199e67ed903.jpg', '2022-05-18 11:24:32', '1', 29),
(14, '1.jfif', '2022-05-18 11:24:47', '1', 0),
(15, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 11:24:47', '1', 0),
(16, 'fa05e-16167982574169-800.jpg', '2022-05-18 11:24:47', '1', 0),
(17, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 11:30:17', '1', 0),
(18, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 11:30:41', '1', 0),
(19, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 11:31:35', '1', 0),
(20, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 11:32:16', '1', 0),
(21, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 11:32:59', '1', 0),
(22, '4.jfif', '2022-05-18 11:33:28', '1', 0),
(24, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 11:36:47', '1', 30),
(25, 'fa05e-16167982574169-800.jpg', '2022-05-18 11:36:47', '1', 30),
(26, '2df2435abcaea00207d5c199e67ed903.jpg', '2022-05-18 11:38:27', '1', 31),
(27, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 11:38:27', '1', 31),
(28, 'fa05e-16167982574169-800.jpg', '2022-05-18 11:38:27', '1', 31),
(29, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 11:43:02', '1', 31),
(30, 'fa05e-16167982574169-800.jpg', '2022-05-18 11:44:47', '1', 28),
(31, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 11:46:18', '1', 28),
(32, '2df2435abcaea00207d5c199e67ed903.jpg', '2022-05-18 11:46:25', '1', 28),
(33, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 11:46:41', '1', 26),
(34, '18br-textile-social-4up-3840x2160-3840x2160-5bab52d5f838.jpg', '2022-05-18 12:46:02', '1', 25),
(35, '2df2435abcaea00207d5c199e67ed903.jpg', '2022-05-18 12:05:07', '1', 25),
(37, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 12:49:04', '1', 25),
(38, '18br-textile-social-4up-3840x2160-3840x2160-5bab52d5f838.jpg', '2022-05-18 13:06:15', '1', 27),
(40, '18br-textile-social-4up-3840x2160-3840x2160-5bab52d5f838.jpg', '2022-05-18 13:09:49', '1', 29),
(41, 'abd9220838520c132d329ed8a50d0289.jpg', '2022-05-18 13:09:49', '1', 29);

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
  `Ulica` text NOT NULL,
  `Nr_budynku` text NOT NULL,
  `Kod_pocztowy` int(11) NOT NULL,
  `Miasto` text NOT NULL,
  `Id_wojewodztwa` int(11) NOT NULL,
  `Id_statusu` int(11) NOT NULL,
  `Nr_zamowienia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`Id_zamowienia`, `Id_klienta`, `Id_dostawy`, `Id_platnosci`, `Data_zamowienia`, `Cena`, `Ulica`, `Nr_budynku`, `Kod_pocztowy`, `Miasto`, `Id_wojewodztwa`, `Id_statusu`, `Nr_zamowienia`) VALUES
(1, 1, 1, 1, '2022-05-26', 65, 'Półrzeczki', '208', 34643, 'Jurków', 6, 1, '48596'),
(2, 1, 1, 1, '2022-05-26', 45, 'Półrzeczki', '208', 34643, 'Jurków', 6, 1, '52904'),
(3, 1, 1, 1, '2022-05-26', 45, 'Półrzeczki', '208', 34643, 'Jurków', 6, 1, '36217');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders_status`
--

CREATE TABLE `orders_status` (
  `Id_statusu` int(11) NOT NULL,
  `Nazwa` text NOT NULL DEFAULT '\'0\''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders_status`
--

INSERT INTO `orders_status` (`Id_statusu`, `Nazwa`) VALUES
(1, 'Oczekiwanie'),
(2, 'Przygotowane do wysyłki'),
(3, 'Wysłane'),
(4, 'Dostarczone');

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
(27, 'test', 'test', '2', 1, 1),
(28, 'skin debil', 'to jest debil', '2', 123, 1),
(29, 'test', 'test', '2', 1, 1);

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
-- Indeksy dla tabeli `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`Id_statusu`);

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
  MODIFY `Id_adresu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `carts`
--
ALTER TABLE `carts`
  MODIFY `Id_koszyka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `Id_zdjecia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `Id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `orders_status`
--
ALTER TABLE `orders_status`
  MODIFY `Id_statusu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `payments`
--
ALTER TABLE `payments`
  MODIFY `Id_platnosci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `Id_produktu` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT dla tabeli `provinces`
--
ALTER TABLE `provinces`
  MODIFY `Id_wojewodztwa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
