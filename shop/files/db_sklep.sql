-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Gru 2020, 21:51
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `db_sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'RPG'),
(2, 'Strategiczne'),
(3, 'Akcji'),
(4, 'Wyścigowe'),
(5, 'Symulacja');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `value` float NOT NULL,
  `type` varchar(5) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`order_id`, `date`, `value`, `type`, `user_id`) VALUES
(16, '2020-12-06', 375, 'box', 6),
(17, '2020-12-06', 103, 'steam', 15),
(18, '2020-12-06', 180, 'steam', 15),
(19, '2020-12-06', 100, 'box', 15),
(20, '2020-12-06', 1, 'box', 15),
(23, '2020-12-06', 187.5, 'steam', 15),
(24, '2020-12-06', 407.5, 'steam', 6),
(25, '2020-12-06', 750, 'steam', 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_detail`
--

CREATE TABLE `order_detail` (
  `od_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `order_detail`
--

INSERT INTO `order_detail` (`od_id`, `product_id`, `number`, `order_id`) VALUES
(11, 6, 2, 16),
(12, 9, 1, 17),
(13, 2, 3, 17),
(14, 3, 1, 17),
(15, 1, 2, 18),
(16, 6, 2, 19),
(17, 6, 1, 20),
(20, 6, 1, 20),
(22, 6, 1, 20),
(23, 6, 1, 23),
(24, 6, 1, 24),
(25, 4, 2, 24),
(26, 6, 4, 24),
(27, 6, 4, 25),
(28, 6, 1, 25),
(30, 6, 1, 25);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `picture_path` varchar(100) NOT NULL,
  `number_of_products` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`product_id`, `title`, `price`, `category_id`, `description`, `picture_path`, `number_of_products`) VALUES
(1, 'Witcher 3: Wild Hunt', 90, 1, 'Polska gra studia CD Projekt Red wydana w 2015 roku podbija serca wszystkich fanów gier RPG. Jest kontynuacją serii składającej się jeszcze z dwóch poprzednich części.', 'dataBasePics/1.jpg', 170),
(2, 'Gothic', 10, 1, 'Kultowa gra niemieckiego studia Piranha Bytes w której gracz wciela się w Bezimiennego bohatera próbującego wydostać się z niebezpiecznej koloni górniczej.', 'dataBasePics/2.jpg', 150),
(3, 'Heroes of Might and Magic III', 15, 2, 'Kultowa gra strategiczna studia 3DO, w którą grał zapewne każdy, kto urodził się w poprzedniej dekadzie.', 'dataBasePics/3.jpg', 250),
(4, 'Civilization V', 110, 2, 'Poprowadź swoje państwo ku zwycięstwo przez wszystkie epoki i rozwijaj nowe technologie. Civilization V daje Ci nowe doznania i ciekawsze mechaniki od poprzednich części.', 'dataBasePics/4.jpg', 248),
(5, 'Resident Evil 2', 80, 3, 'Nowa odsłona mrożącego krew w żyłach horroru – bazując na oryginalnej wersji gry z 1998 roku, Resident Evil 2 został całkowicie przebudowany, oddając w ręce graczy jeszcze bardziej przerażającą historię.', 'dataBasePics/5.jpg', 300),
(6, 'Call of Duty: Modern Warfare', 250, 3, 'W pełnej napięcia i dramatyzmu kampanii dla pojedynczego gracza Call of Duty: Modern Warfare przesuwa granice i łamie zasady w sposób typowy dla tej innowacyjnej serii.', 'dataBasePics/6.jpg', 115),
(7, 'Need for Speed Most Wanted', 60, 4, 'Gra z serii Need for Speed produkowana przez Criterion Games i wydawana przez Electronic Arts. Nowe samochody, nowa grafika, nowe i lepsze wyzwania', 'dataBasePics/7.jpg', 400),
(8, 'DiRT 4', 55, 4, 'Dirt 4 to wyścigowa gra wyścigowa stworzona przez Codemasters. Jest to dwunasta gra z serii Colin McRae Rally i szósty tytuł z nazwą Dirt.', 'dataBasePics/8.jpg', 200),
(9, 'Euro Truck Simulator 2', 58, 5, 'Komputerowa gra symulacyjna stworzona przez SCS Software będąca kontynuacją Euro Truck Simulator. To największy symulator prowadzenia europejskich ciężarówek dostępny na rynku.', 'dataBasePics/9.jpg', 100),
(10, 'The Sims 4', 110, 5, 'Komputerowa gra symulacyjna, będąca czwartą częścią serii The Sims, w której gracze sterują życiem wirtualnych ludzi.', 'dataBasePics/10.jpg', 0),
(11, 'Kingdom Hearts III', 122, 1, ' Gra akcji RPG opracowana i wydana przez Square Enix na PlayStation 4 i Xbox One. Jest to dwunasta część serii Kingdom Hearts i stanowi zakończenie wątku fabularnego Dark Seeker Saga, który rozpoczął się wraz z oryginalną grą.', 'dataBasePics/11.jpg', 30),
(12, 'Ni no Kuni II: Revenant Kingdom', 145, 1, ' Gra RPG akcji opracowana przez Level-5 i wydana przez Bandai Namco Entertainment . Gra jest kontynuacją Ni no Kuni: Wrath of the White Witch i została wydana na Microsoft Windows i PlayStation 4 23 marca 2018 roku. ', 'dataBasePics/12.jpg', 150),
(13, 'Assassin\'s Creed Odyssey', 210, 1, ' Przygodowa gra akcji z elementami RPG, stworzona przez kanadyjskie studio Ubisoft Quebec i wydana przez Ubisoft. Akcja gry dzieje się w 431 r. p.n.e. w czasach wielkiej wojny peloponeskiej.', 'dataBasePics/13.jpg', 98),
(14, 'Total War: Three Kingdoms', 170, 2, ' Strategia turowa czasie rzeczywistym taktyka gry wideo opracowany przez Creative Assembly i wydana przez firmę Sega . Jako 12. pozycja główna w serii Total War , gra została wydana na Microsoft Windows 23 maja 2019 roku.', 'dataBasePics/14.jpg', 320),
(15, 'Planet Zoo', 9, 2, ' Gra wideo symulująca budowę i zarządzanie opracowana i opublikowana przez Frontier Developments dla Microsoft Windows.', 'dataBasePics/15.jpg', 119),
(16, 'Steel Division 2', 55, 2, ' Gra strategiczna czasu rzeczywistego, której akcja toczy się podczas operacji Bagration . Gra została wydana na całym świecie 20 czerwca 2019 roku. Gra została stworzona przez Eugen Systems i została opublikowana niezależnie.', 'dataBasePics/16.jpg', 115),
(17, 'Sekiro: Shadows Die Twice', 110, 3, ' Przygodowa gra akcji opracowana przez FromSoftware i wydana przez Activision. Gra podąża za shinobi znanym jako Wilk, który próbuje zemścić się naklanie samurajów, który zaatakował go i porwał jego pana.', 'dataBasePics/17.jpg', 244),
(18, 'Gears 5', 78, 3, 'Strzelec trzeciej osoby gra wideo stworzona przez Koalicję i opublikowane przez Xbox Game Studios na Xbox One , Microsoft Windows i Xbox Serii X / S. Jest to piąta odsłona serii Gears of War i kontynuacja Gears of War 4.', 'dataBasePics/18.jpg', 275),
(19, 'Days Gone', 119, 3, ' Przygodowa gra wideo typu survival horror z 2019 rokuopracowana przez SIE Bend Studio i wydana przez Sony Interactive Entertainment na PlayStation 4 . ', 'dataBasePics/19.jpg', 300),
(20, 'Forza Motorsport 7', 130, 4, ' Komputerowa gra wyścigowa wyprodukowana przez amerykańskie studio Turn 10 Studios. Gra została wydana 3 października 2017 roku przez Microsoft Studios na platformy Xbox One i PC. Jest to siódma część z serii Forza Motorsport.', 'dataBasePics/20.jpg', 52),
(21, 'DiRT Rally 2.0', 35, 4, ' komputerowa gra wyścigowa wyprodukowana i wydana przez Codemasters 26 lutego 2019 roku. Jest to kontynuacja gry Dirt Rally z 2015 roku.', 'dataBasePics/21.jpg', 152),
(22, 'Burnout Paradise Remastered', 46, 4, ' Wyścigowa gra wideo z otwartym światem z 2008 roku opracowana przez Criterion Games i wydana przez Electronic Arts na PlayStation 3 , Xbox 360 i Microsoft Windows.', 'dataBasePics/22.jpg', 234),
(23, 'Farming Simulator 19', 79, 5, ' Komputerowa gra symulacyjna szwajcarskiej firmy Giants Software GmbH wydana po raz pierwszy w 2008 roku, będąca symulatorem pojazdów i maszyn rolniczych.', 'dataBasePics/23.jpg', 533),
(24, 'F1 2019', 90, 5, 'Oficjalna gra wideo Mistrzostw Formuły 1 i Formuły 2 2019 opracowana i opublikowana przez Codemasters . Jest to dwunasty tytuł zrozwijanej przez studio serii Formuły 1.', 'dataBasePics/24.jpg', 23),
(25, 'Assetto Corsa', 170, 5, ' Komputerowa gra wyścigowa wyprodukowana i wydana przez włoskie studio Kunos Simulazioni. Gra została wydana 19 grudnia 2014 roku na platformę PC, PlayStation 4 oraz Xbox One.', 'dataBasePics/25.jpg', 121);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `promotion`
--

CREATE TABLE `promotion` (
  `promotion_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `promotion`
--

INSERT INTO `promotion` (`promotion_id`, `product_id`, `date`) VALUES
(1, 4, '2020-12-07');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `province`
--

CREATE TABLE `province` (
  `province_id` int(11) NOT NULL,
  `province` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `province`
--

INSERT INTO `province` (`province_id`, `province`) VALUES
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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `house_number` int(11) DEFAULT NULL,
  `postal_code` varchar(6) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `phone_number` varchar(9) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `name`, `surname`, `address`, `house_number`, `postal_code`, `province_id`, `phone_number`, `isAdmin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1),
(6, 'test@wp.pl', '62f2596b743b732c244ca5451a334b4f', 'test', 'test', 'test', 123, 'test', 1, '123456789', 0),
(15, 'kap@wp.pl', '62f2596b743b732c244ca5451a334b4f', 'Maciej', 'Kapera', 'Krasne', 127, '34-620', 6, '123456789', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`od_id`),
  ADD KEY `order_id` (`order_id`,`product_id`),
  ADD KEY `order_detail_ibfk_1` (`product_id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeksy dla tabeli `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`promotion_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeksy dla tabeli `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`province_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `province_id` (`province_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT dla tabeli `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `od_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `promotion`
--
ALTER TABLE `promotion`
  MODIFY `promotion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `province`
--
ALTER TABLE `province`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `promotion_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `province` (`province_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
