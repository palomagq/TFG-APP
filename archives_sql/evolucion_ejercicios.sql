-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2023 a las 12:40:39
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gymapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evolucion_ejercicios`
--

CREATE TABLE `evolucion_ejercicios` (
  `evolucion_ejercicios_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `tabla_de_ejercicios_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `evolucion_ejercicios`
--

INSERT INTO `evolucion_ejercicios` (`evolucion_ejercicios_id`, `fecha_registro`, `tabla_de_ejercicios_id`, `usuario_id`, `created_at`, `updated_at`) VALUES
(19, '2023-06-22', 40, 69, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `evolucion_ejercicios`
--
ALTER TABLE `evolucion_ejercicios`
  ADD PRIMARY KEY (`evolucion_ejercicios_id`),
  ADD KEY `evolucion_ejercicios_tabla_de_ejercicios_id_foreign` (`tabla_de_ejercicios_id`),
  ADD KEY `evolucion_ejercicios_usuario_id_foreign` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evolucion_ejercicios`
--
ALTER TABLE `evolucion_ejercicios`
  MODIFY `evolucion_ejercicios_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evolucion_ejercicios`
--
ALTER TABLE `evolucion_ejercicios`
  ADD CONSTRAINT `evolucion_ejercicios_tabla_de_ejercicios_id_foreign` FOREIGN KEY (`tabla_de_ejercicios_id`) REFERENCES `tabla_de_ejercicios` (`tabla_de_ejercicios_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evolucion_ejercicios_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
