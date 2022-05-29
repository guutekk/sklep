-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Maj 2022, 22:42
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.1

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
(1, 'Admin', 'Admin', 'admin@admin.pl', '123456789', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'user1', 'user1', 'user1@user1.pl', '345345343', 'e10adc3949ba59abbe56e057f20f883e', 0),
(3, 'user2', 'user2', 'user2@user2.pl', '452232343', 'e10adc3949ba59abbe56e057f20f883e', 0);

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
(2, 15, 1, 2, 1, 45000),
(3, 6, 1, 2, 1, 45000),
(4, 5, 1, 2, 1, 45000),
(5, 4, 2, 3, 1, 99640),
(6, 7, 1, 3, 1, 99640),
(7, 10, 3, 3, 1, 99640),
(8, 2, 1, 1, 0, 0);

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
  `typ` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `Id_produktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `images`
--

INSERT INTO `images` (`Id_zdjecia`, `Nazwa_pliku`, `uploaded_on`, `typ`, `Id_produktu`) VALUES
(1, '1000vdolcy.jpg', '2022-05-29 21:54:35', '1', 1),
(2, '1000vdolcy-1.jpg', '2022-05-29 21:54:35', '1', 1),
(3, '1000vdolcy-2.jpg', '2022-05-29 21:54:35', '1', 1),
(4, '1000vdolcy-2.jpg', '2022-05-29 21:56:20', '1', 2),
(5, '2800vdolcy.jpg', '2022-05-29 21:56:20', '1', 2),
(6, '2800vdolcy1.jpg', '2022-05-29 21:56:20', '1', 2),
(7, '5KVDOLCY.jpg', '2022-05-29 21:58:36', '1', 3),
(8, '5KVDOLCY-1.jpg', '2022-05-29 21:58:36', '1', 3),
(9, '5KVDOLCY-2.jpg', '2022-05-29 21:58:36', '1', 3),
(10, '13K.jpg', '2022-05-29 21:59:55', '1', 4),
(11, '13K1.jpg', '2022-05-29 21:59:55', '1', 4),
(12, '1000vdolcy-2.jpg', '2022-05-29 21:59:55', '1', 4),
(13, '30K.jpg', '2022-05-29 22:01:11', '1', 5),
(14, '32K.jpg', '2022-05-29 22:01:11', '1', 5),
(15, '1000vdolcy-2.jpg', '2022-05-29 22:01:11', '1', 5),
(16, 'AURA1.jpg', '2022-05-29 22:02:34', '1', 6),
(17, 'AURA2.jpg', '2022-05-29 22:02:34', '1', 6),
(18, 'AURA3.jpg', '2022-05-29 22:02:34', '1', 6),
(19, 'TRAVIS.jpg', '2022-05-29 22:03:31', '1', 7),
(20, 'TRAVIS2.jpg', '2022-05-29 22:03:31', '1', 7),
(21, 'TRAVIS3.jpg', '2022-05-29 22:03:31', '1', 7),
(22, 'ikonik.png', '2022-05-29 22:06:08', '1', 8),
(23, 'ikonik1.png', '2022-05-29 22:06:08', '1', 8),
(24, 'ikonik2.png', '2022-05-29 22:06:08', '1', 8),
(25, 'glow.jpg', '2022-05-29 22:07:36', '1', 9),
(26, 'glow2.png', '2022-05-29 22:07:36', '1', 9),
(27, 'glow3.jpg', '2022-05-29 22:07:36', '1', 9),
(28, 'honor1.jpg', '2022-05-29 22:08:05', '1', 10),
(29, 'honor2.jpg', '2022-05-29 22:08:05', '1', 10),
(30, 'honor3.jpg', '2022-05-29 22:08:05', '1', 10),
(31, 'KARNET7.jpg', '2022-05-29 22:10:00', '1', 11),
(32, 'KARTNET2.jpg', '2022-05-29 22:10:00', '1', 11),
(33, 'KARTNET3.jpg', '2022-05-29 22:10:00', '1', 11),
(34, 'KARNET1.jpg', '2022-05-29 22:10:28', '1', 12),
(35, 'KARNET6.jpg', '2022-05-29 22:10:28', '1', 12),
(36, 'KARTNET4.jpg', '2022-05-29 22:10:28', '1', 12),
(37, 'KARNET7.jpg', '2022-05-29 22:10:46', '1', 13),
(38, 'KARNET8.jpg', '2022-05-29 22:10:46', '1', 13),
(39, 'KARTNET2.jpg', '2022-05-29 22:10:46', '1', 13),
(40, 'KARNET1.jpg', '2022-05-29 22:11:03', '1', 14),
(41, 'KARNET5.jpg', '2022-05-29 22:11:03', '1', 14),
(42, 'KARTNET3.jpg', '2022-05-29 22:11:03', '1', 14),
(43, 'ikonik1.png', '2022-05-29 22:11:24', '1', 15),
(44, 'ikonik2.png', '2022-05-29 22:11:24', '1', 15),
(45, 'KARNET5.jpg', '2022-05-29 22:11:24', '1', 15),
(46, 'KARTNET3.jpg', '2022-05-29 22:11:24', '1', 15);

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
(1, 2, 2, 2, '2022-05-29', 726, 'Marka', 'LIgasa', 53421, 'Ligasowic', 12, 2, '45000'),
(2, 3, 1, 1, '2022-05-29', 748, 'Gabi', 'Ligas', 45662, 'Markowice', 9, 3, '99640');

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
(1, '1000 VDOLCY', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na 1000Vdolcy', '1', 31, 5),
(2, '2800 VDOLCY', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na 2800 VDOLCY', '1', 79, 5),
(3, '5000 VDOLCY', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na 5000 VDOLCY', '1', 127, 5),
(4, '13000 VDOLCY', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na 13000 VDOLCY', '1', 319, 5),
(5, '27000 VDOLCY', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na 27000 VDOLCY', '1', 638, 5),
(6, 'SKIN AURA', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na SKINA AURE', '2', 15, 5),
(7, 'SKIN TRAVIS SCOOT', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na skina travisa', '2', 50, 5),
(8, 'SKIN IKONIK', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na skina ikonika', '2', 13, 5),
(9, 'SKIN GLOW', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na skina glow', '2', 51, 5),
(10, 'SKIN HONOR', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na SKINA HONOR', '2', 13, 5),
(11, 'KARNET SEZON 1', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na karnet', '3', 65, 23),
(12, 'KARNET SEZON 2', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na karnet', '3', 13, 76),
(13, 'KARNET SEZON 3', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na karnet', '3', 53, 2),
(14, 'KARNET SEZON 4', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na karnet', '3', 32, 43),
(15, 'KARNET SEZON 5', 'Po zakupie wyślemy do ciebie kartę podarunkowa z kodem na karnet', '3', 56, 234);

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
  MODIFY `Id_klienta` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `accounts_address`
--
ALTER TABLE `accounts_address`
  MODIFY `Id_adresu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `carts`
--
ALTER TABLE `carts`
  MODIFY `Id_koszyka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `Id_kategorii` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `delivery_method`
--
ALTER TABLE `delivery_method`
  MODIFY `Id_dostawy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `images`
--
ALTER TABLE `images`
  MODIFY `Id_zdjecia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `Id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `Id_produktu` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `provinces`
--
ALTER TABLE `provinces`
  MODIFY `Id_wojewodztwa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
