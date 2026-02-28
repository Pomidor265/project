-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 28 2026 г., 08:07
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Appointment`
--

CREATE TABLE `Appointment` (
  `Appointment_id` int NOT NULL,
  `Doctor_id` int NOT NULL,
  `User_id` int NOT NULL,
  `hospital_id` int NOT NULL,
  `Appointment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Appointment`
--

INSERT INTO `Appointment` (`Appointment_id`, `Doctor_id`, `User_id`, `hospital_id`, `Appointment_date`) VALUES
(1, 1, 1, 1, '2026-02-02'),
(2, 2, 2, 2, '2026-02-05');

-- --------------------------------------------------------

--
-- Структура таблицы `Disease`
--

CREATE TABLE `Disease` (
  `Disease_id` int NOT NULL,
  `Disease_name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Disease_description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Disease_symptoms` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Disease_cause` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Disease`
--

INSERT INTO `Disease` (`Disease_id`, `Disease_name`, `Disease_description`, `Disease_symptoms`, `Disease_cause`, `Category_id`) VALUES
(1, 'Простуда', 'Распространенная вирусная инфекция верхних дыхательных путей', 'Першение в горле, кашель, насморк', 'Низкий иммунитет, переохлаждение, вирусные инфекции', 1),
(2, 'Острый бронхит', 'Воспаление слизистой оболочки бронхов', 'Температура до 38-39 градусов, сухой кашель, першение в горле', 'Вирусы, бактериальные инфекции', 2),
(3, 'Туберкулез', 'Опасная инфекционная болезнь поражающая в основном легкие', 'Длительный кашель, слабость, утомляемость, длительная повышенная температура 37,2-37,4 градусов', 'Заражение бактерией палочка Коха', 3),
(4, 'Лейкемия', 'Злокачественное системное поражение красного костного мозга, во время которого здоровые лейкоциты в крови замещаются измененными клетками', 'Прогрессирующая слабость, быстрая утомляемость, сонливость. ', 'В настоящее время причиной рака крови считают нарушения молекулярной структуры в хромосомах', 4),
(5, 'Гемофилия', 'Гемофилия является редким, но серьезным наследственным заболеванием, связанным с нарушением функции свертывания крови, что приводит к неконтролируемым и часто спонтанным кровотечениям и кровоизлияниям в различные органы и ткани', 'длительные кровотечения после травм, ', 'Вередается от родителей к ребенку, хотя примерно в трети случаев вызвано спонтанной мутацией.', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `Disease_category`
--

CREATE TABLE `Disease_category` (
  `Category_id` int NOT NULL,
  `Category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Disease_category`
--

INSERT INTO `Disease_category` (`Category_id`, `Category_name`) VALUES
(1, 'Легкие заболевания'),
(2, 'Средние заболевания'),
(3, 'Тяжелые заболевания'),
(4, 'Онкологические заболевания'),
(5, 'Генетические заболевания');

-- --------------------------------------------------------

--
-- Структура таблицы `Doctor`
--

CREATE TABLE `Doctor` (
  `Doctor_id` int NOT NULL,
  `Doctor_surname` varchar(100) NOT NULL,
  `Doctor_name` varchar(100) NOT NULL,
  `Doctor_patronymic` varchar(100) NOT NULL,
  `Doctor_type_id` int NOT NULL,
  `Hospital_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Doctor`
--

INSERT INTO `Doctor` (`Doctor_id`, `Doctor_surname`, `Doctor_name`, `Doctor_patronymic`, `Doctor_type_id`, `Hospital_id`) VALUES
(1, 'Иванов', 'Иван', 'Иванович', 1, 1),
(2, 'Сергеев', 'Сергей', 'Сергеевич', 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `DoctorType`
--

CREATE TABLE `DoctorType` (
  `Doctor_type_id` int NOT NULL,
  `Type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `DoctorType`
--

INSERT INTO `DoctorType` (`Doctor_type_id`, `Type_name`) VALUES
(1, 'Педиатр'),
(2, 'Хирург');

-- --------------------------------------------------------

--
-- Структура таблицы `History`
--

CREATE TABLE `History` (
  `History_id` int NOT NULL,
  `Appointment_id` int NOT NULL,
  `Disease_id` int NOT NULL,
  `History_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `History`
--

INSERT INTO `History` (`History_id`, `Appointment_id`, `Disease_id`, `History_date`) VALUES
(1, 1, 2, '2026-02-02'),
(2, 2, 1, '2026-02-09');

-- --------------------------------------------------------

--
-- Структура таблицы `Hospital`
--

CREATE TABLE `Hospital` (
  `Hospital_id` int NOT NULL,
  `Hospital_address` varchar(100) NOT NULL,
  `Hospital_description` varchar(100) NOT NULL,
  `Hospital_contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Hospital`
--

INSERT INTO `Hospital` (`Hospital_id`, `Hospital_address`, `Hospital_description`, `Hospital_contact`) VALUES
(1, 'г. Якутск ', 'Больница', '8474713'),
(2, 'г. Москва', 'Платная поликлиника', '8714124');

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE `User` (
  `User_id` int NOT NULL,
  `User_surname` varchar(100) NOT NULL,
  `User_name` varchar(100) NOT NULL,
  `User_patronymic` varchar(100) NOT NULL,
  `User_birthday` date NOT NULL,
  `User_email` varchar(100) NOT NULL,
  `User_phone` varchar(100) NOT NULL,
  `User_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`User_id`, `User_surname`, `User_name`, `User_patronymic`, `User_birthday`, `User_email`, `User_phone`, `User_password`) VALUES
(1, 'Бурцев', 'Баир', 'Викторович', '2008-03-22', 'example@mail.ru', '8888888', '123'),
(2, 'Бурцев', 'Марк', 'Викторович', '2009-11-18', 'example2@mail.ru', '8888887', '123');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Appointment`
--
ALTER TABLE `Appointment`
  ADD PRIMARY KEY (`Appointment_id`),
  ADD KEY `Doctor_id` (`Doctor_id`),
  ADD KEY `hospital_id` (`hospital_id`),
  ADD KEY `User_id` (`User_id`);

--
-- Индексы таблицы `Disease`
--
ALTER TABLE `Disease`
  ADD PRIMARY KEY (`Disease_id`),
  ADD KEY `Category_id` (`Category_id`);

--
-- Индексы таблицы `Disease_category`
--
ALTER TABLE `Disease_category`
  ADD PRIMARY KEY (`Category_id`);

--
-- Индексы таблицы `Doctor`
--
ALTER TABLE `Doctor`
  ADD PRIMARY KEY (`Doctor_id`),
  ADD KEY `Doctor_type_id` (`Doctor_type_id`),
  ADD KEY `Hospital_id` (`Hospital_id`);

--
-- Индексы таблицы `DoctorType`
--
ALTER TABLE `DoctorType`
  ADD PRIMARY KEY (`Doctor_type_id`);

--
-- Индексы таблицы `History`
--
ALTER TABLE `History`
  ADD PRIMARY KEY (`History_id`),
  ADD KEY `Appointment_id` (`Appointment_id`),
  ADD KEY `Disease_id` (`Disease_id`);

--
-- Индексы таблицы `Hospital`
--
ALTER TABLE `Hospital`
  ADD PRIMARY KEY (`Hospital_id`);

--
-- Индексы таблицы `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`User_id`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Appointment`
--
ALTER TABLE `Appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`Doctor_id`) REFERENCES `Doctor` (`Doctor_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `Hospital` (`Hospital_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`User_id`) REFERENCES `User` (`User_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Disease`
--
ALTER TABLE `Disease`
  ADD CONSTRAINT `disease_ibfk_1` FOREIGN KEY (`Category_id`) REFERENCES `Disease_category` (`Category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Doctor`
--
ALTER TABLE `Doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`Doctor_type_id`) REFERENCES `DoctorType` (`Doctor_type_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `doctor_ibfk_2` FOREIGN KEY (`Hospital_id`) REFERENCES `Hospital` (`Hospital_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `History`
--
ALTER TABLE `History`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`Appointment_id`) REFERENCES `Appointment` (`Appointment_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`Disease_id`) REFERENCES `Disease` (`Disease_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
