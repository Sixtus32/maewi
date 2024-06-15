-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-06-2024 a las 06:04:54
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

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

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `accountId` int NOT NULL AUTO_INCREMENT,
  `account_activation_code` int NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `account_status` varchar(255) NOT NULL,
  `account_opening_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `userId` int NOT NULL,
  `account_info` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'No Info.',
  PRIMARY KEY (`accountId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `accounts`
--

INSERT INTO `accounts` (`accountId`, `account_activation_code`, `verified`, `account_status`, `account_opening_date`, `userId`, `account_info`) VALUES
(3, 95209572, 0, 'Activo ahora', '2024-05-25 00:00:00', 5, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `eventId` int NOT NULL AUTO_INCREMENT,
  `event_title` varchar(25) NOT NULL,
  `event_description` varchar(200) NOT NULL,
  `event_image_url` varchar(255) DEFAULT NULL,
  `date_started` datetime NOT NULL,
  `date_ended` datetime NOT NULL,
  `event_location` varchar(100) NOT NULL DEFAULT 'Planeta Tierra',
  `number_passes` int NOT NULL,
  `passes` int DEFAULT '0',
  `privacy` tinyint(1) NOT NULL DEFAULT '0',
  `event_status` enum('TO START','INITIATED','IN PROGRESS','FINALIZED') NOT NULL DEFAULT 'TO START',
  `payment` tinyint(1) NOT NULL DEFAULT '0',
  `unique_id` int NOT NULL,
  PRIMARY KEY (`eventId`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`eventId`, `event_title`, `event_description`, `event_image_url`, `date_started`, `date_ended`, `event_location`, `number_passes`, `passes`, `privacy`, `event_status`, `payment`, `unique_id`) VALUES
(13, 'Netflix y de Chill', 'Disfrutemos de unos snacks, bebidas y en un ambiente acogedor 😜. !Te espero!', '1717279477netflix2.jpg', '2024-06-15 14:00:00', '2024-06-15 18:30:00', 'Murcia', 2, 0, 1, 'TO START', 1, 26312842),
(14, 'Yoga al Amanecer', 'Comienza tu día con una sesión de yoga al amanecer. Paz y tranquilidad para el alma ', '1717279682yoga.jpg', '2024-06-20 08:30:00', '2024-06-20 14:10:00', 'Sevilla', 5, 0, 1, 'TO START', 1, 26312842),
(15, 'Picnic en el Parque Gabar', 'Un picnic relajante en el parque con juegos y comida para todos. ¡Ven a disfrutar!', '1717280118picni.jpg', '2024-06-17 08:20:00', '2024-06-22 04:18:00', 'Murcia, Mula', 3, 0, 0, 'TO START', 0, 26312842),
(17, 'Fútbol y Tapas 👟🏐', 'Ven a disfrutar de un partido de fúltbol y unas tapas !No te lo pierdas¡', '1717280941futball.jpg', '2024-06-19 10:30:00', '2024-06-19 17:30:00', 'Madrid', 12, 0, 0, 'TO START', 1, 95787700);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `followers`
--

DROP TABLE IF EXISTS `followers`;
CREATE TABLE IF NOT EXISTS `followers` (
  `follower_id` int NOT NULL AUTO_INCREMENT,
  `user_id_follower` int NOT NULL,
  `user_id_followed` int NOT NULL,
  `date_started` int NOT NULL,
  PRIMARY KEY (`follower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `like_id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(10000) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 26312842, 18413072, 'GGGG'),
(2, 18413072, 26312842, 'hola sixtus es guapo'),
(3, 18413072, 26312842, 'ademas es más guapo que orwell'),
(4, 26312842, 18413072, 'a que si'),
(5, 18413072, 26312842, 'hola'),
(6, 18413072, 26312842, 'hola prima'),
(7, 18413072, 26312842, 'dddfd'),
(8, 26312842, 18413072, 'hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participations`
--

DROP TABLE IF EXISTS `participations`;
CREATE TABLE IF NOT EXISTS `participations` (
  `participationId` int NOT NULL AUTO_INCREMENT,
  `unique_id` int NOT NULL,
  `eventId` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`participationId`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `participations`
--

INSERT INTO `participations` (`participationId`, `unique_id`, `eventId`, `created_at`) VALUES
(3, 26312842, 16, '2024-06-02 08:23:18'),
(8, 26312842, 15, '2024-06-02 09:07:02'),
(9, 18413072, 13, '2024-06-02 16:37:07'),
(10, 18413072, 14, '2024-06-02 16:37:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `social_media_links`
--

DROP TABLE IF EXISTS `social_media_links`;
CREATE TABLE IF NOT EXISTS `social_media_links` (
  `social_link_id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `media_type` enum('phone','gmail','instagram','tiktok','twitter','facebook') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`social_link_id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `ticket_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `event_id` int NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `unique_id` int NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_surname` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_image_banner` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_profile_photo` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active Now',
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userId`, `unique_id`, `user_name`, `user_surname`, `user_password`, `username`, `user_image_banner`, `user_email`, `user_profile_photo`, `status`) VALUES
(1, 18413072, 'Sixtus', 'Nosike', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '@sixtus32', '', 'sixtuswork18@gmail.com', '1716492254github.png', 'Active Now'),
(2, 95787700, 'Javier', 'Cuenca', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '@javier22', '', 'javicuenca@gmail.com', '1716492411117d5fce879aa8f94e7af8b6a5733a29.jpg', 'Active Now'),
(5, 26312842, 'Anabel', 'Gónzalez', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '@anabel14', '', 'anabel14@gmail.com', '1716618928home-user-image-1.jpg', 'Active Now');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_details`
--

DROP TABLE IF EXISTS `users_details`;
CREATE TABLE IF NOT EXISTS `users_details` (
  `user_detail_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`user_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
