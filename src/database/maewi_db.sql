-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2024 a las 11:42:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `maewi_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounts`
--

CREATE TABLE `accounts` (
  `accountId` int(11) NOT NULL,
  `account_info` varchar(255) NOT NULL,
  `account_activation_code` varchar(255) NOT NULL,
  `account_phone_number` varchar(255) NOT NULL,
  `verifed` tinyint(1) NOT NULL DEFAULT 0,
  `account_status` tinyint(1) NOT NULL DEFAULT 0,
  `account_opening_date` date NOT NULL DEFAULT current_timestamp(),
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrators`
--

CREATE TABLE `administrators` (
  `adminId` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_profile_photo` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chats`
--

CREATE TABLE `chats` (
  `chatId` int(11) NOT NULL,
  `chat_type` enum('DUAL_CONVERSATION','CHAT_GROUP','','') NOT NULL DEFAULT 'DUAL_CONVERSATION',
  `chat_account_creator_id` int(11) NOT NULL,
  `chat_name` varchar(255) NOT NULL,
  `chat_members_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_members`
--

CREATE TABLE `chat_members` (
  `chat_members_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `eventId` int(11) NOT NULL,
  `privacy` tinyint(1) NOT NULL DEFAULT 0,
  `number_likes` int(11) NOT NULL,
  `number_passes` int(11) NOT NULL,
  `payement` tinyint(1) DEFAULT 0,
  `date_started` date NOT NULL,
  `date_ended` date NOT NULL,
  `event_status` enum('STARTED','IN_PROGRESS','FINISHED','PAUSED','TO_START') NOT NULL DEFAULT 'TO_START',
  `assisance_conditions` varchar(2000) NOT NULL,
  `accountId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `message_` int(11) NOT NULL,
  `account_receiver_id` int(11) NOT NULL,
  `account_issuer_id` int(11) NOT NULL,
  `message_content` varchar(255) NOT NULL,
  `message_sending_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `notificationId` int(11) NOT NULL,
  `notification_content` varchar(255) NOT NULL,
  `notification_receiver_id` int(11) NOT NULL,
  `notification_issuer_id` int(11) NOT NULL,
  `notification_date_sending` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_surname` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_image_banner` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_profile_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountId`),
  ADD KEY `account_user_fk` (`userId`);

--
-- Indices de la tabla `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`adminId`);

--
-- Indices de la tabla `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chatId`),
  ADD KEY `chats_fk` (`chat_members_id`);

--
-- Indices de la tabla `chat_members`
--
ALTER TABLE `chat_members`
  ADD PRIMARY KEY (`chat_members_id`),
  ADD KEY `chat_member_account_fk` (`account_id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `account_event_fk` (`accountId`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `administrators`
--
ALTER TABLE `administrators`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chats`
--
ALTER TABLE `chats`
  MODIFY `chatId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chat_members`
--
ALTER TABLE `chat_members`
  MODIFY `chat_members_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `message_` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `account_user_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_fk` FOREIGN KEY (`chat_members_id`) REFERENCES `chat_members` (`chat_members_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `chat_members`
--
ALTER TABLE `chat_members`
  ADD CONSTRAINT `chat_member_account_fk` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `account_event_fk` FOREIGN KEY (`accountId`) REFERENCES `accounts` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
