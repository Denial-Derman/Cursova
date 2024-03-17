-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Бер 17 2024 р., 18:10
-- Версія сервера: 8.0.30
-- Версія PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `StoneBreaker`
--

-- --------------------------------------------------------

--
-- Структура таблиці `club_train`
--

CREATE TABLE `club_train` (
  `id` varchar(10) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `club_train`
--

INSERT INTO `club_train` (`id`, `name`, `image`, `description`) VALUES
('T1', 'Спорт клуб', 'our_club_time.png', NULL),
('T2', 'Тренажерний зал', 'gym.png', NULL),
('T3', 'Фітнес зал', 'fitness-gym.png', NULL),
('T4', 'Басейн', 'swimming-pool.png', NULL),
('T5', 'Душова', 'shower.png', NULL),
('T6', 'Дитяча зона', 'nursery.png', NULL),
('T7', 'Роздягальня', 'changing.png', NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `duration`
--

CREATE TABLE `duration` (
  `id_duration` varchar(10) NOT NULL,
  `duration_month` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `duration`
--

INSERT INTO `duration` (`id_duration`, `duration_month`) VALUES
('d1', '1 місяць'),
('d2', '3 місяці'),
('d3', '6 місяців');

-- --------------------------------------------------------

--
-- Структура таблиці `home`
--

CREATE TABLE `home` (
  `id_home` varchar(10) NOT NULL,
  `id_sub` varchar(10) DEFAULT NULL,
  `id_timetable` varchar(10) DEFAULT NULL,
  `id_vac` varchar(10) DEFAULT NULL,
  `id_trainers` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `home`
--

INSERT INTO `home` (`id_home`, `id_sub`, `id_timetable`, `id_vac`, `id_trainers`) VALUES
('H1', 'HS1', 'HTi1', 'HV1', 'HTr1');

-- --------------------------------------------------------

--
-- Структура таблиці `subscription`
--

CREATE TABLE `subscription` (
  `id` tinyint NOT NULL,
  `id_sub-home` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name_sub` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_fee_for` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `shower` tinyint(1) DEFAULT NULL,
  `cloakroom` tinyint(1) DEFAULT NULL,
  `safe` tinyint(1) DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `price` smallint DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `subscription`
--

INSERT INTO `subscription` (`id`, `id_sub-home`, `name_sub`, `id_fee_for`, `shower`, `cloakroom`, `safe`, `description`, `price`, `currency`) VALUES
(1, 'HS1', 'Стандартний (без тренера)', 'd1', 1, 1, 1, NULL, 1200, 'грн'),
(2, 'HS1', 'Сезонний (без тренера)', 'd2', 1, 1, 1, NULL, 1800, 'грн'),
(3, 'HS1', 'Стандартний (з тренером)', 'd1', 1, 1, 1, NULL, 4800, 'грн'),
(4, 'HS1', 'Сезонний (з тренером)', 'd2', 1, 1, 1, NULL, 4800, 'грн'),
(5, 'HS1', 'Стандартний диятчий (до 11 років)', 'd1', 1, 1, 1, NULL, 600, 'грн');

-- --------------------------------------------------------

--
-- Структура таблиці `timetable`
--

CREATE TABLE `timetable` (
  `id` varchar(10) NOT NULL,
  `id_time_home` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name_time` text,
  `time_list` text,
  `id_club_train` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `timetable`
--

INSERT INTO `timetable` (`id`, `id_time_home`, `name_time`, `time_list`, `id_club_train`) VALUES
('Ti1', 'HTi1', 'Робота клуба', '07:00 - відкриття\r\n20:00 - закриття', 'T1'),
('Ti2', 'HTi1', 'Тренажерний зал', '08:00 - відкриття\r\n18:00 - закриття\r\n09:00 - початок тренування з тренером\r\n17:30 - кінець тренування з тренером', 'T2'),
('Ti3', 'HTi1', 'Фітнес зал', '09:00 - перший сеанс\r\n11:00 - кінець першого сеансу\r\n11:30 - другий сеанс\r\n13:30 - кінець другого сеансу\r\n14:00 - третій сеанс\r\n16:00 - кінець третього сеансу\r\n16:30 - четвертий сеанс\r\n18:30 - кінець четвертого сеансу', 'T3'),
('Ti4', 'HTi1', 'Басейн ', '08:00 - відкриття\r\n09:00 - розминка\r\n09:30 - початок тренування\r\n12:00 - кінець тренування\r\n12:10 - ігри\r\n13:00 - закриття', 'T4');

-- --------------------------------------------------------

--
-- Структура таблиці `trainers`
--

CREATE TABLE `trainers` (
  `id` varchar(10) NOT NULL,
  `id_train_home` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_trainers_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `certificate` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `trainers`
--

INSERT INTO `trainers` (`id`, `id_train_home`, `image`, `name`, `id_trainers_type`, `information`, `certificate`) VALUES
('Tr1', 'HTr1', 'trainers1.png', 'Ольга Ковальчук', 'Vt4', 'Моя мотивація - мої діти. Вони є джерелом мого гарного настрою та енергії на тренуваннях.  \r\nСподіваюсь, що для вас стану такою ж мотивацією та партнером по фітнесу.', 1),
('Tr2', 'HTr1', 'trainers2.png', 'Олександр Шевченко', 'Vt3', 'Плавання - моє життя.\r\nЗдоров\'я - ваше життя.', 1),
('Tr3', 'HTr1', 'trainers3.png', 'Сергій Прокопенко', 'Vt1', 'Моя мотивація - гарний сніданок і пробіжечка, все що потрібно для гарного настрою на день.', 1),
('Tr4', 'HTr1', 'trainers4.png', 'Михайло Гончаренко', 'Vt2', 'Моя сестра завжди казала, що малі діти мене люблять. \r\nА я люблю їх тренувати та розважати.', 1),
('Tr5', 'HTr1', 'trainers5.png', 'Марія Коваленко', 'Vt4', 'Корисне харчування - це крок до здорового тіла.', 1),
('Tr6', 'HTr1', 'trainers6.png', 'Іван Бондаренко', 'Vt3', 'Моя мотивація - пропливи 10км, щоб з\'їсти смачний телячий стейк.\r\nДодаткове повітря в легенях не буває зайвим в житті.', 1),
('Tr7', 'HTr1', 'trainers7.png', 'Наталія Гриценко', 'Vt2', 'Моя мотивація - розминка після сну та перед, зберігає позитивну енергію в тілі. \r\nМузика - це рух.', 1),
('Tr8', 'HTr1', 'trainers8.png', 'Денис Савченко', 'Vt1', 'Моя мотивація - мало кому подобається з дівчат не спортивне тіло, тому я тут щоб це виправити для вас.', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `trainers_types`
--

CREATE TABLE `trainers_types` (
  `id_trainers_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name_vacancies` varchar(50) DEFAULT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fons` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `trainers_types`
--

INSERT INTO `trainers_types` (`id_trainers_type`, `name_vacancies`, `image`, `fons`) VALUES
('Vt1', 'Тренер', 'coach.png', 'coach-fons.png'),
('Vt2', 'Тренер з дітьми', 'trainer-with-children.png', 'trainer-with-children-fons.png'),
('Vt3', 'Тренер з плавання', 'swimming-coach.png', 'swimming-coach-fons.png'),
('Vt4', 'Тренер з фітнесу', 'fitness-trainer.png', 'fitness-trainer-fons.png'),
('Vt5', 'Менеджер', 'manager.png', 'manager-fons.png'),
('Vt6', 'Прибиральник', 'cleaner.png', 'cleaner-fons.png');

-- --------------------------------------------------------

--
-- Структура таблиці `vacancies`
--

CREATE TABLE `vacancies` (
  `id` varchar(10) NOT NULL,
  `id_vac_home` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_trainers_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `requirements` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `duties` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `vacancies`
--

INSERT INTO `vacancies` (`id`, `id_vac_home`, `id_trainers_type`, `requirements`, `duties`) VALUES
('V1', 'HV1', 'Vt1', 'Високий рівень професійної компетентності у галузі тренування.\r\nДосвід роботи з різними віковими групами для тренерів загального спрямування.\r\nНаявність сертифікатів і ліцензій у галузі тренування.', 'Розробка та викладання індивідуальних тренувальних програм для клієнтів.\r\nОрганізація та проведення тренувань для різних групових класів.\r\nСтворення мотивуючої та позитивної атмосфери на тренуваннях.'),
('V2', 'HV1', 'Vt2', 'Високий рівень професійної компетентності у галузі тренування.\r\nСпеціалізований досвід роботи з дітьми для тренера з дітьми.\r\nНаявність сертифікатів і ліцензій у галузі тренування.', 'Розробка та викладання індивідуальних тренувальних програм для клієнтів.\r\nОрганізація та проведення тренувань для різних групових класів.\r\nСтворення мотивуючої та позитивної атмосфери на тренуваннях.\r\nДогляд за дітьми під час тренування.'),
('V3', 'HV1', 'Vt3', 'Високий рівень професійної компетентності у галузі тренування.\r\nНаявність сертифікатів і ліцензій у галузі тренування.\r\nЗдатність розробки та викладання індивідуальних тренувальних програм.', 'Розробка та викладання індивідуальних тренувальних програм для клієнтів.\r\nОрганізація та проведення тренувань для різних групових класів.\r\nСтворення мотивуючої та позитивної атмосфери на тренуваннях.\r\nДогляд за дітьми під час тренування.'),
('V4', 'HV1', 'Vt4', 'Високий рівень професійної компетентності у галузі тренування.\r\nНаявність сертифікатів і ліцензій у галузі тренування.\r\nЗдатність розробки та викладання індивідуальних тренувальних програм.\r\n', 'Розробка та викладання індивідуальних тренувальних програм для клієнтів.\r\nОрганізація та проведення тренувань для різних групових класів.\r\nСтворення мотивуючої та позитивної атмосфери на тренуваннях.\r\nДогляд за дітьми під час тренування.'),
('V5', 'HV1', 'Vt5', 'Комунікабельність та навички роботи з різними особистісними характеристиками клієнтів.\r\nВисока робоча ефективність та здатність до постійного самовдосконалення.\r\nДосвід у викладанні та організації тренувань для групових занять для менеджера.\r\n', 'Взаємодія з клієнтами для визначення їхніх цілей та очікувань.\r\nВедення документації про прогрес та досягнення клієнтів.\r\nНадання ефективного керівництва груповими заняттями для тренера з дітьми.'),
('V6', 'HV1', 'Vt6', 'Вміти прибирати.', 'Стеження за  чистотою обладнання.\r\nСтеження за  чистотою приміщення.');

-- --------------------------------------------------------

--
-- Структура таблиці `vacancies_resum`
--

CREATE TABLE `vacancies_resum` (
  `id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `tel` varchar(14) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text,
  `id_vacancies` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `vacancies_resum`
--

INSERT INTO `vacancies_resum` (`id`, `name`, `tel`, `email`, `message`, `id_vacancies`) VALUES
('Vr1', 'Host Club', '+380636645405', 'support@stonebrreaker.ua', NULL, NULL);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `club_train`
--
ALTER TABLE `club_train`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `duration`
--
ALTER TABLE `duration`
  ADD PRIMARY KEY (`id_duration`);

--
-- Індекси таблиці `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id_home`),
  ADD KEY `id_timetable` (`id_timetable`),
  ADD KEY `id_trainers` (`id_trainers`),
  ADD KEY `id_vac` (`id_vac`),
  ADD KEY `id_sub` (`id_sub`);

--
-- Індекси таблиці `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sub-home` (`id_sub-home`),
  ADD KEY `id_fee_for` (`id_fee_for`);

--
-- Індекси таблиці `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_club_train` (`id_club_train`),
  ADD KEY `id_time_home` (`id_time_home`);

--
-- Індекси таблиці `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trainers_type` (`id_trainers_type`),
  ADD KEY `id_train_home` (`id_train_home`);

--
-- Індекси таблиці `trainers_types`
--
ALTER TABLE `trainers_types`
  ADD PRIMARY KEY (`id_trainers_type`);

--
-- Індекси таблиці `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trainers_type` (`id_trainers_type`),
  ADD KEY `id_vac_home` (`id_vac_home`);

--
-- Індекси таблиці `vacancies_resum`
--
ALTER TABLE `vacancies_resum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacancies_resum_ibfk_1` (`id_vacancies`);

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`id_sub-home`) REFERENCES `home` (`id_sub`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`id_fee_for`) REFERENCES `duration` (`id_duration`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Обмеження зовнішнього ключа таблиці `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`id_club_train`) REFERENCES `club_train` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`id_time_home`) REFERENCES `home` (`id_timetable`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Обмеження зовнішнього ключа таблиці `trainers`
--
ALTER TABLE `trainers`
  ADD CONSTRAINT `trainers_ibfk_1` FOREIGN KEY (`id_trainers_type`) REFERENCES `trainers_types` (`id_trainers_type`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `trainers_ibfk_2` FOREIGN KEY (`id_train_home`) REFERENCES `home` (`id_trainers`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Обмеження зовнішнього ключа таблиці `vacancies`
--
ALTER TABLE `vacancies`
  ADD CONSTRAINT `vacancies_ibfk_1` FOREIGN KEY (`id_trainers_type`) REFERENCES `trainers_types` (`id_trainers_type`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `vacancies_ibfk_2` FOREIGN KEY (`id_vac_home`) REFERENCES `home` (`id_vac`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Обмеження зовнішнього ключа таблиці `vacancies_resum`
--
ALTER TABLE `vacancies_resum`
  ADD CONSTRAINT `vacancies_resum_ibfk_1` FOREIGN KEY (`id_vacancies`) REFERENCES `trainers_types` (`id_trainers_type`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
