-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2023 a las 12:41:45
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
-- Estructura de tabla para la tabla `asignacion_rutina_ejercicios`
--

CREATE TABLE `asignacion_rutina_ejercicios` (
  `asignacion_rutina_ejercicios_id` bigint(20) UNSIGNED NOT NULL,
  `tabla_de_ejercicios_id` bigint(20) UNSIGNED NOT NULL,
  `ejercicio_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `serie` int(11) DEFAULT NULL,
  `repeticion` int(11) DEFAULT NULL,
  `distancia` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asignacion_rutina_ejercicios`
--

INSERT INTO `asignacion_rutina_ejercicios` (`asignacion_rutina_ejercicios_id`, `tabla_de_ejercicios_id`, `ejercicio_id`, `created_at`, `updated_at`, `serie`, `repeticion`, `distancia`) VALUES
(1, 40, 63, NULL, NULL, 0, 0, 0.00),
(3, 40, 42, NULL, NULL, 4, 10, 0.00),
(4, 41, 3, NULL, NULL, NULL, NULL, NULL),
(5, 41, 44, NULL, NULL, 4, 10, NULL),
(6, 41, 62, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacidad_clase`
--

CREATE TABLE `capacidad_clase` (
  `capacidad_clase_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `clase_planificada_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `capacidad_clase`
--

INSERT INTO `capacidad_clase` (`capacidad_clase_id`, `fecha_registro`, `clase_planificada_id`, `usuario_id`, `created_at`, `updated_at`) VALUES
(54, '2023-04-25', 65, 69, NULL, NULL),
(55, '2023-04-25', 67, 69, NULL, NULL),
(57, '2023-04-25', 65, 72, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_ejercicio`
--

CREATE TABLE `categoria_ejercicio` (
  `categoria_ejercicio_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_ejercicio`
--

INSERT INTO `categoria_ejercicio` (`categoria_ejercicio_id`, `nombre`, `created_at`, `updated_at`) VALUES
(3, 'Piernas', NULL, NULL),
(5, 'Hombros', NULL, NULL),
(7, 'Espalda', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `clases_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gimnasio_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`clases_id`, `nombre`, `gimnasio_id`, `created_at`, `updated_at`) VALUES
(1, 'Boxeo', 3, NULL, NULL),
(2, 'Cuadriceps', 1, NULL, NULL),
(3, 'Yoga', 4, NULL, NULL),
(4, 'Natación', 4, NULL, NULL),
(5, 'Pilates', 2, NULL, NULL),
(6, 'Funcional', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_planificada`
--

CREATE TABLE `clase_planificada` (
  `clase_planificada_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_clase` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `clases_id` bigint(20) UNSIGNED NOT NULL,
  `sala_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `monitor_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clase_planificada`
--

INSERT INTO `clase_planificada` (`clase_planificada_id`, `fecha_clase`, `hora_inicio`, `hora_fin`, `clases_id`, `sala_id`, `created_at`, `updated_at`, `monitor_id`) VALUES
(7, '2023-03-02', '11:00:00', '12:49:00', 2, 4, NULL, NULL, 0),
(8, '2023-03-03', '13:00:00', '13:55:00', 2, 2, NULL, NULL, 0),
(9, '2023-03-04', '16:00:00', '20:49:00', 2, 4, NULL, NULL, 0),
(10, '2023-03-05', '16:00:00', '17:15:00', 2, 4, NULL, NULL, 0),
(11, '2023-03-06', '16:00:00', '16:49:00', 2, 2, NULL, NULL, 0),
(12, '2023-03-07', '16:00:00', '17:49:00', 2, 4, NULL, NULL, 0),
(14, '2023-03-13', '10:00:00', '10:45:00', 6, 7, NULL, NULL, 0),
(15, '2023-03-14', '10:00:00', '10:45:00', 6, 7, NULL, NULL, 0),
(16, '2023-03-15', '10:00:00', '10:45:00', 6, 7, NULL, NULL, 0),
(17, '2023-03-16', '10:00:00', '10:45:00', 6, 7, NULL, NULL, 0),
(21, '2023-03-14', '11:00:00', '11:45:00', 1, 6, NULL, NULL, 0),
(22, '2023-03-15', '11:00:00', '11:45:00', 1, 6, NULL, NULL, 0),
(23, '2023-03-16', '11:00:00', '11:45:00', 1, 6, NULL, NULL, 0),
(24, '2023-03-14', '12:00:00', '13:00:00', 5, 5, NULL, NULL, 0),
(25, '2023-03-15', '12:00:00', '13:00:00', 5, 5, NULL, NULL, 0),
(26, '2023-03-16', '12:00:00', '13:00:00', 5, 5, NULL, NULL, 0),
(27, '2023-03-17', '12:00:00', '13:00:00', 5, 5, NULL, NULL, 0),
(28, '2023-03-18', '12:00:00', '13:00:00', 5, 5, NULL, NULL, 0),
(29, '2023-03-19', '12:00:00', '13:00:00', 5, 5, NULL, NULL, 0),
(35, '2023-04-11', '10:00:00', '11:15:00', 3, 8, NULL, NULL, 0),
(36, '2023-04-12', '10:00:00', '11:15:00', 3, 8, NULL, NULL, 0),
(37, '2023-04-13', '10:00:00', '11:15:00', 3, 8, NULL, NULL, 0),
(38, '2023-04-14', '10:00:00', '11:15:00', 3, 8, NULL, NULL, 0),
(58, '2023-04-12', '10:00:00', '10:45:00', 2, 7, NULL, NULL, 70),
(59, '2023-04-13', '10:00:00', '10:45:00', 2, 7, NULL, NULL, 70),
(60, '2023-04-14', '10:00:00', '10:45:00', 2, 7, NULL, NULL, 70),
(62, '2023-04-13', '09:50:00', '10:15:00', 6, 2, NULL, NULL, 77),
(63, '2023-04-14', '09:50:00', '10:15:00', 6, 2, NULL, NULL, 77),
(64, '2023-04-15', '09:50:00', '10:15:00', 6, 2, NULL, NULL, 77),
(65, '2023-04-12', '09:50:00', '10:15:00', 6, 2, NULL, NULL, 77),
(67, '2023-04-24', '09:00:00', '10:15:00', 6, 9, NULL, NULL, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicio` (
  `ejercicio_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ejercicioPorDefecto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ejercicio`
--

INSERT INTO `ejercicio` (`ejercicio_id`, `nombre`, `categoria_id`, `tipo_id`, `created_at`, `updated_at`, `ejercicioPorDefecto`) VALUES
(1, 'Pullover', 7, 1, NULL, NULL, 0),
(2, 'Cuadriceps', 3, 1, NULL, NULL, 0),
(3, 'Isquios', 3, 1, NULL, NULL, 1),
(42, 'Dominadas', 7, 1, NULL, NULL, 1),
(43, 'Press militar', 5, 1, NULL, NULL, 0),
(44, 'Gemelos', 3, 1, NULL, NULL, 1),
(45, 'Elevaciones laterales', 5, 1, NULL, NULL, 1),
(46, 'Dorsales', 7, 1, NULL, NULL, 0),
(47, 'Elevaciones frontales', 5, 1, NULL, NULL, 0),
(62, 'mio 3', 5, 1, NULL, NULL, 0),
(63, 'mio 2', 5, 1, NULL, NULL, 0),
(64, 'mio', 5, 1, NULL, NULL, 0);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evolucion_ejercicios_datos`
--

CREATE TABLE `evolucion_ejercicios_datos` (
  `evolucion_ejercicios_datos_id` bigint(20) UNSIGNED NOT NULL,
  `serie` int(11) NOT NULL,
  `repeticion` int(11) DEFAULT NULL,
  `distancia` double(8,2) DEFAULT NULL,
  `peso` double(8,2) DEFAULT NULL,
  `ejercicio_id` bigint(20) UNSIGNED NOT NULL,
  `evolucion_ejercicios_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `evolucion_ejercicios_datos`
--

INSERT INTO `evolucion_ejercicios_datos` (`evolucion_ejercicios_datos_id`, `serie`, `repeticion`, `distancia`, `peso`, `ejercicio_id`, `evolucion_ejercicios_id`, `created_at`, `updated_at`) VALUES
(8, 1, 1, NULL, 11.00, 42, 19, NULL, NULL),
(9, 1, 1, NULL, 15.00, 42, 19, NULL, NULL),
(10, 3, 25, NULL, 25.00, 42, 19, NULL, NULL),
(11, 1, 10, NULL, 5.00, 63, 19, NULL, NULL),
(12, 2, 10, NULL, 7.50, 63, 19, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gimnasio`
--

CREATE TABLE `gimnasio` (
  `gimnasio_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provincia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codigo_postal` int(11) NOT NULL,
  `localidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `gimnasio`
--

INSERT INTO `gimnasio` (`gimnasio_id`, `nombre`, `direccion`, `provincia`, `created_at`, `updated_at`, `codigo_postal`, `localidad`) VALUES
(1, 'Lowfit', 'Calle Polvorin 6', 'Huelva', NULL, NULL, 21006, 'Huelva'),
(2, 'BasicFit', 'Calle Plaza de las Monjas 5', 'Huelva', NULL, NULL, 21002, 'Huelva'),
(3, 'FitGym', 'Calle Huelva 5', 'Sevilla', NULL, NULL, 41080, 'Sevilla'),
(4, 'O2 Gym', 'Calle San Sebastian 45', 'Huelva', NULL, NULL, 21002, 'Huelva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(148, '2014_10_12_000000_create_users_table', 1),
(149, '2014_10_12_100000_create_password_resets_table', 1),
(150, '2019_08_19_000000_create_failed_jobs_table', 1),
(151, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(152, '2022_10_08_115051_create_permissions_table', 1),
(153, '2022_10_08_115100_create_roles_table', 1),
(154, '2022_10_08_115220_create_users_permissions_table', 1),
(155, '2022_10_08_115408_create_users_roles_table', 1),
(156, '2022_10_08_115534_create_roles_permissions_table', 1),
(175, '2023_02_13_102945_create_categoria_ejercicio_table', 2),
(176, '2023_02_13_102559_create_tipo_ejercicio_table', 3),
(177, '2023_02_09_105213_create_ejercicio_table', 4),
(178, '2023_02_09_110920_create_gimnasio_table', 5),
(179, '2023_02_09_111100_create_sala_table', 6),
(185, '2023_02_14_131239_create_usuario_gimnasio_table', 12),
(186, '2023_02_14_140043_create_usuario_ejercicio_table', 13),
(187, '2023_02_14_144315_alter_gimnasio_table', 14),
(188, '2023_02_14_150329_alter_gimnasio_2_table', 15),
(189, '2023_02_14_150605_alter_gimnasio_3_table', 16),
(190, '2023_02_21_154550_rename_capacidad_column', 17),
(195, '2023_02_22_141228_create_clases_table', 20),
(196, '2023_02_22_141606_create_clase_planificada_table', 21),
(197, '2023_02_22_142148_create_capacidad_clase_table', 22),
(198, '2023_04_14_150342_alter_clase_planificada_2_table', 23),
(199, '2023_04_25_164359_alter_ejercicio_table', 24),
(200, '2023_05_03_131755_remove_activo_clase_tipo_categoria_table', 25),
(201, '2023_05_03_132735_remove_imagen_ejercicio_table', 26),
(202, '2023_06_15_142110_create_tabla_de_ejercicios_table', 27),
(203, '2023_06_15_142943_create_asignacion_rutina_ejercicios_table', 28),
(204, '2023_06_19_161503_alter_tabla_de_ejercicio_table', 29),
(205, '2023_06_20_141140_alter_asignacion_tabla_ejercicio_table', 30),
(206, '2023_06_21_094616_create_usuario_pagos_table', 31),
(207, '2023_06_21_152232_create_evolucion_ejercicios_table', 32),
(208, '2023_06_21_152316_create_evolucion_ejercicios_datos_table', 33),
(209, '2023_06_21_154758_alter_usuario_pagos_table', 34),
(210, '2023_06_21_155413_remove_usuario_ejercicio_table', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Create Tasks', 'create-tasks', '2022-10-08 10:46:36', '2022-10-08 10:46:36'),
(2, 'Edit Users', 'edit-users', '2022-10-08 10:46:36', '2022-10-08 10:46:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '2022-10-08 10:46:36', '2022-10-08 10:46:36'),
(2, 'Jefe', 'jefe', '2022-10-08 10:46:36', '2022-10-08 10:46:36'),
(3, 'Recepción', 'recepción', '2023-02-13 18:45:40', '2023-02-13 18:45:40'),
(4, 'Personal', 'personal', '2023-02-13 18:46:17', '2023-02-13 18:46:17'),
(5, 'Socio', 'socio', '2023-02-13 18:46:52', '2023-02-13 18:46:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 4, NULL, NULL),
(39, 5, NULL, NULL),
(63, 3, NULL, NULL),
(66, 3, NULL, NULL),
(67, 5, NULL, NULL),
(69, 1, NULL, NULL),
(70, 4, NULL, NULL),
(71, 3, NULL, NULL),
(72, 5, NULL, NULL),
(73, 2, NULL, NULL),
(74, 5, NULL, NULL),
(75, 4, NULL, NULL),
(76, 4, NULL, NULL),
(77, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE `sala` (
  `sala_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacidad` int(11) NOT NULL,
  `gimnasio_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`sala_id`, `nombre`, `capacidad`, `gimnasio_id`, `created_at`, `updated_at`) VALUES
(1, 'Sala 1', 50, 3, NULL, NULL),
(2, 'Sala 2', 30, 1, NULL, NULL),
(3, 'Sala 5', 25, 2, NULL, NULL),
(4, 'Sala 1', 45, 1, NULL, NULL),
(5, 'Sala 3', 35, 2, NULL, NULL),
(6, 'Sala 4', 20, 3, NULL, NULL),
(7, 'Sala 3', 48, 1, NULL, NULL),
(8, 'Sala 1', 25, 4, NULL, NULL),
(9, 'Sala Prueba', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_de_ejercicios`
--

CREATE TABLE `tabla_de_ejercicios` (
  `tabla_de_ejercicios_id` bigint(20) UNSIGNED NOT NULL,
  `nombre_rutina_ejercicio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tabla_de_ejercicios`
--

INSERT INTO `tabla_de_ejercicios` (`tabla_de_ejercicios_id`, `nombre_rutina_ejercicio`, `created_at`, `updated_at`, `usuario_id`) VALUES
(40, 'Pruebas', NULL, NULL, 69),
(41, 'Ejemplo', NULL, NULL, 72);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ejercicio`
--

CREATE TABLE `tipo_ejercicio` (
  `tipo_ejercicio_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_ejercicio`
--

INSERT INTO `tipo_ejercicio` (`tipo_ejercicio_id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Peso y repeticiones', NULL, NULL),
(2, 'Tiempo y repeticiones', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_permissions`
--

CREATE TABLE `users_permissions` (
  `usuarios_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `fechaNac` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `dni`, `usersname`, `password`, `sexo`, `email`, `telefono`, `fechaNac`, `created_at`, `updated_at`) VALUES
(3, 'Jesús', 'Campos Márquez', '49239768b', 'gsus8', '$2y$10$Tr1C8/QMT3iUpHjo6k5Lnefay.jgVXRAJ4mYQIf3OSKefOPS1pFu.', 1, 'gsus27497@gmail.com', 683591611, '2023-01-26', NULL, NULL),
(39, 'Jesus socio', 'socio 1', '00000000A', 's1', '$2y$10$0En3R2SBr8jWSHr49dkjc.cwo2pdTj7W1KTUAf6bHM2AuTse62n4m', 1, 'socio1@s.com', 666666667, '2023-02-24', NULL, NULL),
(63, 'Recepcionista1', 'Sofia', '44477552k', 'sofiar1', '$2y$10$pAynjeK/0D8TiJ818nO/uepjWgafIkHC3RhWVwzCydCUHsOVtLBgO', 0, 'sofiar1@gmail.com', 555444777, '2022-02-05', NULL, NULL),
(66, 'Recepcionista2', 'Juan', '222444555p', 'juanr2', '$2y$10$pDnK99SV4TNGjDf2G3tus.Z5mOZ2nZGslVb2fMnQYjGSCfpIfWiai', 1, 'juanr2@gmail.com', 654789563, '2023-02-01', NULL, NULL),
(67, 'Socio3', 'Nuria', '444555752g', 'nurias3', '$2y$10$ylpGu48HZZimUhy0ZJ.xUujUqSdxByeqsfSari29YQxqfdVsBCfxu', 0, 'nurias3@gmail.com', 654785230, '2023-02-06', NULL, NULL),
(69, 'admin', 'admin2', '456789b', 'admin', '$2y$10$jfXwnPbfNSU5DJVm5QfTR.26CL9m1zarMizjQPTQoBjaq8zv3lzO6', 1, 'admin@gmail.com', 666555444, '2023-02-02', NULL, NULL),
(70, 'Fran', 'Gonzalez', '423756789K', 'frang', '$2y$10$LB/V6QFCBZvlPqcxId/98OjOuWrF0wW56JKNfpSIi1R9Ks.jIIcYq', 1, 'frang@gmail.com', 665789456, '2023-02-02', NULL, NULL),
(71, 'Rocio', 'Martin', '42377569K', 'rociom', '$2y$10$SNM6q9TKAKwAiVzff.TbA.bCF6A.POYh325xbmaYILVkqGLT3BGvq', 0, 'rociom@gmail.com', 657489523, '2023-01-05', NULL, NULL),
(72, 'Sara', 'Fernandez', '42374532P', 'saraf', '$2y$10$dzw4STFiTvWUUeziMJDWuesI16sLz992QbYhoPUqVq/AgaXE6erui', 0, 'saraf@gmail.com', 657489123, '2023-01-18', NULL, NULL),
(73, 'Carlos', 'Contreras', '42371230M', 'carlosc', '$2y$10$CDIxGFoNA1TuGmcpZbp89.X0cNbGpl4i.Dw0wTWX7c7wsujgBnP6O', 1, 'carlosc@gmail.com', 657412375, '2023-01-13', NULL, NULL),
(74, 'Pablo', 'Lopez', '45217852B', 'pablol', '$2y$10$dsJFA4ZfR6EB2I3W9yJBgutZZV4jI46IqkHm8efl/S6HP/6qOJOTq', 1, 'pablol@gmail.com', 654111235, '2000-05-16', NULL, NULL),
(75, 'Luis', 'Perez', '210452103K', 'luisp', '$2y$10$MPnvPjctNv3nmsAJb4MazehCQz6kG1XpPy1YedvE67kJOYAcn7eg6', 1, 'luisp@gmail.com', 621450321, '1999-02-09', NULL, NULL),
(76, 'Marcos', 'Dominguez', '210541201K', 'marcosd', '$2y$10$L4crRe2UZ9lSTHoqb4iznOT/wUXrKYQQvOTlFAamoqOqURTbKJwZm', 1, 'marcosd@gmail.com', 654287011, '1999-02-03', NULL, NULL),
(77, 'Jose', 'Garcia', '452124785P', 'jgarcia', '$2y$10$C0kcaFRnPPc2yy77BAsmJOklYDZYxHTn514dTjRWg0h.hkpEUpp2i', 1, 'jgarcia@gmail.com', 654125785, '1997-06-11', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_ejercicio`
--

CREATE TABLE `usuario_ejercicio` (
  `usuario_ejercicio_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `usuarios_id` bigint(20) UNSIGNED NOT NULL,
  `ejercicio_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_ejercicio`
--

INSERT INTO `usuario_ejercicio` (`usuario_ejercicio_id`, `fecha`, `usuarios_id`, `ejercicio_id`, `created_at`, `updated_at`) VALUES
(2, '2023-06-15', 72, 62, NULL, NULL),
(3, '2023-06-15', 3, 63, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_gimnasio`
--

CREATE TABLE `usuario_gimnasio` (
  `usuario_gimnasio_id` bigint(20) UNSIGNED NOT NULL,
  `gimnasio_id` bigint(20) UNSIGNED NOT NULL,
  `usuarios_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_gimnasio`
--

INSERT INTO `usuario_gimnasio` (`usuario_gimnasio_id`, `gimnasio_id`, `usuarios_id`, `created_at`, `updated_at`) VALUES
(14, 4, 3, NULL, NULL),
(25, 1, 39, NULL, NULL),
(26, 3, 39, NULL, NULL),
(27, 1, 39, NULL, NULL),
(28, 3, 39, NULL, NULL),
(31, 2, 63, NULL, NULL),
(35, 3, 66, NULL, NULL),
(36, 4, 67, NULL, NULL),
(38, 1, 69, NULL, NULL),
(39, 2, 69, NULL, NULL),
(40, 3, 69, NULL, NULL),
(41, 4, 69, NULL, NULL),
(42, 1, 70, NULL, NULL),
(43, 1, 71, NULL, NULL),
(44, 1, 72, NULL, NULL),
(45, 1, 73, NULL, NULL),
(46, 2, 74, NULL, NULL),
(47, 2, 75, NULL, NULL),
(48, 3, 76, NULL, NULL),
(49, 1, 77, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_pagos`
--

CREATE TABLE `usuario_pagos` (
  `usuario_pagos_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_pago` date NOT NULL,
  `cuota_pago` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_pagos`
--

INSERT INTO `usuario_pagos` (`usuario_pagos_id`, `usuario_id`, `fecha_pago`, `cuota_pago`, `created_at`, `updated_at`) VALUES
(1, 69, '2023-06-21', 30.00, NULL, NULL),
(2, 69, '2023-06-21', 30.00, NULL, NULL),
(3, 72, '2023-06-21', 30.00, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacion_rutina_ejercicios`
--
ALTER TABLE `asignacion_rutina_ejercicios`
  ADD PRIMARY KEY (`asignacion_rutina_ejercicios_id`),
  ADD KEY `asignacion_rutina_ejercicios_tabla_de_ejercicios_id_foreign` (`tabla_de_ejercicios_id`),
  ADD KEY `asignacion_rutina_ejercicios_ejercicio_id_foreign` (`ejercicio_id`);

--
-- Indices de la tabla `capacidad_clase`
--
ALTER TABLE `capacidad_clase`
  ADD PRIMARY KEY (`capacidad_clase_id`),
  ADD KEY `capacidad_clase_clase_planificada_id_foreign` (`clase_planificada_id`),
  ADD KEY `capacidad_clase_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `categoria_ejercicio`
--
ALTER TABLE `categoria_ejercicio`
  ADD PRIMARY KEY (`categoria_ejercicio_id`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`clases_id`),
  ADD KEY `clases_gimnasio_id_foreign` (`gimnasio_id`);

--
-- Indices de la tabla `clase_planificada`
--
ALTER TABLE `clase_planificada`
  ADD PRIMARY KEY (`clase_planificada_id`),
  ADD KEY `clase_planificada_clases_id_foreign` (`clases_id`),
  ADD KEY `clase_planificada_sala_id_foreign` (`sala_id`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`ejercicio_id`),
  ADD KEY `ejercicio_categoria_id_foreign` (`categoria_id`),
  ADD KEY `ejercicio_tipo_id_foreign` (`tipo_id`);

--
-- Indices de la tabla `evolucion_ejercicios`
--
ALTER TABLE `evolucion_ejercicios`
  ADD PRIMARY KEY (`evolucion_ejercicios_id`),
  ADD KEY `evolucion_ejercicios_tabla_de_ejercicios_id_foreign` (`tabla_de_ejercicios_id`),
  ADD KEY `evolucion_ejercicios_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `evolucion_ejercicios_datos`
--
ALTER TABLE `evolucion_ejercicios_datos`
  ADD PRIMARY KEY (`evolucion_ejercicios_datos_id`),
  ADD KEY `evolucion_ejercicios_datos_evolucion_ejercicios_id_foreign` (`evolucion_ejercicios_id`),
  ADD KEY `evolucion_ejercicios_datos_ejercicio_id_foreign` (`ejercicio_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `gimnasio`
--
ALTER TABLE `gimnasio`
  ADD PRIMARY KEY (`gimnasio_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `roles_permissions_permission_id_foreign` (`permission_id`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `users_roles_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`sala_id`),
  ADD KEY `sala_gimnasio_id_foreign` (`gimnasio_id`);

--
-- Indices de la tabla `tabla_de_ejercicios`
--
ALTER TABLE `tabla_de_ejercicios`
  ADD PRIMARY KEY (`tabla_de_ejercicios_id`),
  ADD KEY `tabla_de_ejercicios_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `tipo_ejercicio`
--
ALTER TABLE `tipo_ejercicio`
  ADD PRIMARY KEY (`tipo_ejercicio_id`);

--
-- Indices de la tabla `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD PRIMARY KEY (`usuarios_id`,`permission_id`),
  ADD KEY `users_permissions_permission_id_foreign` (`permission_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_email_unique` (`email`);

--
-- Indices de la tabla `usuario_ejercicio`
--
ALTER TABLE `usuario_ejercicio`
  ADD PRIMARY KEY (`usuario_ejercicio_id`),
  ADD KEY `usuario_ejercicio_usuarios_id_foreign` (`usuarios_id`),
  ADD KEY `usuario_ejercicio_ejercicio_id_foreign` (`ejercicio_id`);

--
-- Indices de la tabla `usuario_gimnasio`
--
ALTER TABLE `usuario_gimnasio`
  ADD PRIMARY KEY (`usuario_gimnasio_id`),
  ADD KEY `usuario_gimnasio_gimnasio_id_foreign` (`gimnasio_id`),
  ADD KEY `usuario_gimnasio_usuarios_id_foreign` (`usuarios_id`);

--
-- Indices de la tabla `usuario_pagos`
--
ALTER TABLE `usuario_pagos`
  ADD PRIMARY KEY (`usuario_pagos_id`),
  ADD KEY `usuario_pagos_usuario_id_foreign` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacion_rutina_ejercicios`
--
ALTER TABLE `asignacion_rutina_ejercicios`
  MODIFY `asignacion_rutina_ejercicios_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `capacidad_clase`
--
ALTER TABLE `capacidad_clase`
  MODIFY `capacidad_clase_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `categoria_ejercicio`
--
ALTER TABLE `categoria_ejercicio`
  MODIFY `categoria_ejercicio_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `clases_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clase_planificada`
--
ALTER TABLE `clase_planificada`
  MODIFY `clase_planificada_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  MODIFY `ejercicio_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `evolucion_ejercicios`
--
ALTER TABLE `evolucion_ejercicios`
  MODIFY `evolucion_ejercicios_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `evolucion_ejercicios_datos`
--
ALTER TABLE `evolucion_ejercicios_datos`
  MODIFY `evolucion_ejercicios_datos_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gimnasio`
--
ALTER TABLE `gimnasio`
  MODIFY `gimnasio_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sala`
--
ALTER TABLE `sala`
  MODIFY `sala_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tabla_de_ejercicios`
--
ALTER TABLE `tabla_de_ejercicios`
  MODIFY `tabla_de_ejercicios_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `tipo_ejercicio`
--
ALTER TABLE `tipo_ejercicio`
  MODIFY `tipo_ejercicio_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `usuario_ejercicio`
--
ALTER TABLE `usuario_ejercicio`
  MODIFY `usuario_ejercicio_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_gimnasio`
--
ALTER TABLE `usuario_gimnasio`
  MODIFY `usuario_gimnasio_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `usuario_pagos`
--
ALTER TABLE `usuario_pagos`
  MODIFY `usuario_pagos_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacion_rutina_ejercicios`
--
ALTER TABLE `asignacion_rutina_ejercicios`
  ADD CONSTRAINT `asignacion_rutina_ejercicios_ejercicio_id_foreign` FOREIGN KEY (`ejercicio_id`) REFERENCES `ejercicio` (`ejercicio_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asignacion_rutina_ejercicios_tabla_de_ejercicios_id_foreign` FOREIGN KEY (`tabla_de_ejercicios_id`) REFERENCES `tabla_de_ejercicios` (`tabla_de_ejercicios_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `capacidad_clase`
--
ALTER TABLE `capacidad_clase`
  ADD CONSTRAINT `capacidad_clase_clase_planificada_id_foreign` FOREIGN KEY (`clase_planificada_id`) REFERENCES `clase_planificada` (`clase_planificada_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `capacidad_clase_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_gimnasio_id_foreign` FOREIGN KEY (`gimnasio_id`) REFERENCES `gimnasio` (`gimnasio_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clase_planificada`
--
ALTER TABLE `clase_planificada`
  ADD CONSTRAINT `clase_planificada_clases_id_foreign` FOREIGN KEY (`clases_id`) REFERENCES `clases` (`clases_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clase_planificada_sala_id_foreign` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`sala_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD CONSTRAINT `ejercicio_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categoria_ejercicio` (`categoria_ejercicio_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ejercicio_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_ejercicio` (`tipo_ejercicio_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `evolucion_ejercicios`
--
ALTER TABLE `evolucion_ejercicios`
  ADD CONSTRAINT `evolucion_ejercicios_tabla_de_ejercicios_id_foreign` FOREIGN KEY (`tabla_de_ejercicios_id`) REFERENCES `tabla_de_ejercicios` (`tabla_de_ejercicios_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evolucion_ejercicios_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `evolucion_ejercicios_datos`
--
ALTER TABLE `evolucion_ejercicios_datos`
  ADD CONSTRAINT `evolucion_ejercicios_datos_ejercicio_id_foreign` FOREIGN KEY (`ejercicio_id`) REFERENCES `ejercicio` (`ejercicio_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evolucion_ejercicios_datos_evolucion_ejercicios_id_foreign` FOREIGN KEY (`evolucion_ejercicios_id`) REFERENCES `evolucion_ejercicios` (`evolucion_ejercicios_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `users_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_roles_usuarios_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `sala_gimnasio_id_foreign` FOREIGN KEY (`gimnasio_id`) REFERENCES `gimnasio` (`gimnasio_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tabla_de_ejercicios`
--
ALTER TABLE `tabla_de_ejercicios`
  ADD CONSTRAINT `tabla_de_ejercicios_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD CONSTRAINT `users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_permissions_usuarios_id_foreign` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario_ejercicio`
--
ALTER TABLE `usuario_ejercicio`
  ADD CONSTRAINT `usuario_ejercicio_ejercicio_id_foreign` FOREIGN KEY (`ejercicio_id`) REFERENCES `ejercicio` (`ejercicio_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuario_ejercicio_usuarios_id_foreign` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario_gimnasio`
--
ALTER TABLE `usuario_gimnasio`
  ADD CONSTRAINT `usuario_gimnasio_gimnasio_id_foreign` FOREIGN KEY (`gimnasio_id`) REFERENCES `gimnasio` (`gimnasio_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuario_gimnasio_usuarios_id_foreign` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario_pagos`
--
ALTER TABLE `usuario_pagos`
  ADD CONSTRAINT `usuario_pagos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
