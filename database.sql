-- phpMyAdmin SQL Dump
-- version 5.1.1-1.fc33
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-06-2023 a las 17:45:15
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `arredondo_saldeello`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auspiciante`
--

CREATE TABLE `auspiciante` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `cuil_cuit` varchar(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) DEFAULT 1,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `home` int(11) DEFAULT NULL,
  `atributos` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ml_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagenceo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorynotas`
--

CREATE TABLE `categorynotas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category_marcas`
--

CREATE TABLE `category_marcas` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `marcas_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id` int(11) UNSIGNED NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 1, 0, 0, 0, 0, '{}', 1),
(2, 1, 'name', 'text', 'Name', 0, 1, 1, 0, 0, 1, '{}', 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 0, 0, 1, '{}', 4),
(4, 1, 'password', 'password', 'Password', 0, 0, 0, 0, 0, 0, '{}', 5),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '{}', 6),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 7),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(8, 1, 'avatar', 'image', 'Avatar', 0, 0, 1, 1, 1, 1, '{}', 9),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":\"0\",\"taggable\":\"0\"}', 12),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 0, 0, 0, 0, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 14),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, '{}', 16),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 0, 0, 1, 1, 1, 1, '{}', 11),
(22, 4, 'id', 'text', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(23, 4, 'titulo', 'text', 'Titulo', 0, 1, 1, 1, 1, 1, '{}', 2),
(24, 4, 'texto', 'rich_text_box', 'Texto', 0, 0, 1, 1, 1, 1, '{}', 3),
(25, 4, 'imagen', 'image', 'Imagen', 0, 1, 1, 1, 1, 1, '{}', 4),
(26, 4, 'status', 'checkbox', 'Estado', 0, 1, 1, 1, 1, 1, '{}', 5),
(27, 4, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(28, 4, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(29, 8, 'id', 'text', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(30, 8, 'user_id', 'text', 'User Id', 1, 0, 0, 1, 1, 0, '{}', 2),
(31, 8, 'category_id', 'text', 'Category Id', 0, 0, 0, 1, 1, 1, '{}', 3),
(32, 8, 'subcategoryId', 'text', 'SubcategoryId', 0, 0, 0, 1, 1, 1, '{}', 4),
(33, 8, 'marca_id', 'text', 'Marca Id', 0, 0, 0, 1, 1, 1, '{}', 5),
(34, 8, 'Modelos_id', 'text', 'Modelos Id', 0, 0, 0, 1, 1, 1, '{}', 6),
(35, 8, 'provincia_id', 'text', 'Provincia Id', 0, 0, 0, 0, 0, 0, '{}', 7),
(36, 8, 'localidad_id', 'text', 'Localidad Id', 0, 0, 0, 0, 0, 0, '{}', 8),
(37, 8, 'title', 'text', 'Titulo', 1, 1, 1, 1, 1, 1, '{}', 9),
(38, 8, 'body', 'text_area', 'Descripcion', 1, 0, 1, 1, 1, 1, '{}', 10),
(39, 8, 'precios', 'number', 'Precio', 0, 1, 1, 1, 1, 1, '{}', 11),
(40, 8, 'cantidad', 'number', 'Cantidad', 0, 1, 1, 1, 1, 1, '{}', 12),
(41, 8, 'status', 'select_dropdown', 'Estado', 1, 1, 1, 1, 1, 1, '{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\",\"CANCELLED\":\"cancelled\"}}', 13),
(42, 8, 'condicion', 'select_dropdown', 'Condicion', 0, 0, 1, 1, 1, 1, '{\"options\":{\"USADO\":\"Usado\",\"NUEVO\":\"Nuevo\"}}', 14),
(43, 8, 'fecha_vencimiento', 'date', 'Fecha Vencimiento', 0, 0, 1, 1, 1, 1, '{}', 15),
(44, 8, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 1, 0, 1, '{}', 16),
(45, 8, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 17),
(46, 8, 'ml_id', 'text', 'Ml Id', 0, 0, 1, 1, 1, 1, '{}', 18),
(47, 8, 'post_belongsto_user_relationship', 'relationship', 'Usuario', 0, 0, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 19),
(49, 1, 'apellido', 'text', 'Apellido', 0, 1, 1, 0, 0, 1, '{}', 3),
(50, 1, 'empresa', 'text', 'Empresa', 0, 0, 1, 0, 1, 1, '{}', 10),
(51, 1, 'cuit', 'text', 'Cuit', 0, 0, 1, 0, 0, 1, '{}', 13),
(52, 1, 'telefono', 'text', 'Telefono', 0, 0, 1, 0, 0, 1, '{}', 15),
(53, 1, 'provincia_id', 'select_dropdown', 'Provincia Id', 0, 0, 1, 0, 0, 1, '{}', 17),
(54, 1, 'localidad_id', 'select_dropdown', 'Localidad Id', 0, 0, 1, 0, 0, 1, '{}', 18),
(55, 1, 'direccion', 'text', 'Direccion', 0, 0, 1, 0, 0, 1, '{}', 19),
(56, 1, 'logo_empresa', 'text', 'Logo Empresa', 0, 0, 1, 0, 0, 1, '{}', 20),
(57, 1, 'dateChangePassword', 'text', 'DateChangePassword', 0, 0, 0, 0, 0, 0, '{}', 21),
(58, 1, 'active', 'number', 'Active', 0, 1, 1, 1, 1, 1, '{}', 22),
(59, 1, 'cpa', 'text', 'Cpa', 0, 0, 1, 0, 0, 1, '{}', 23),
(60, 1, 'email_verified_at', 'timestamp', 'Email Verified At', 0, 0, 1, 1, 1, 1, '{}', 24),
(61, 1, 'provider', 'text', 'Provider', 0, 1, 1, 0, 0, 0, '{}', 25),
(62, 1, 'provider_id', 'text', 'Provider Id', 0, 0, 1, 0, 0, 0, '{}', 26),
(63, 9, 'id', 'text', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(64, 9, 'tittle', 'text', 'Titulo', 0, 1, 1, 1, 1, 1, '{}', 2),
(65, 9, 'image', 'image', 'Image', 0, 1, 1, 1, 1, 1, '{}', 3),
(66, 9, 'active', 'select_dropdown', 'Estado', 0, 1, 1, 1, 1, 1, '{\"options\":{\"0\":\"DESASTIVADO\",\"1\":\"ACTIVO\"}}', 4),
(69, 9, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 1, 0, 1, '{}', 7),
(70, 9, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(71, 9, 'orden', 'number', 'Orden', 0, 1, 1, 1, 1, 1, '{}', 9),
(72, 10, 'id', 'text', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(73, 10, 'parent_id', 'text', 'Parent Id', 0, 0, 1, 1, 1, 1, '{}', 2),
(74, 10, 'order', 'text', 'Order', 0, 0, 1, 1, 1, 1, '{}', 3),
(75, 10, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 4),
(76, 10, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 1, 0, 1, '{}', 5),
(77, 10, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(78, 10, 'home', 'checkbox', 'Home', 0, 1, 1, 1, 1, 1, '{}', 7),
(79, 10, 'atributos', 'text', 'Atributos', 0, 0, 1, 1, 1, 1, '{}', 8),
(80, 10, 'ml_id', 'text', 'Ml Id', 0, 0, 1, 1, 1, 1, '{}', 9),
(82, 10, 'category_belongsto_category_relationship_1', 'relationship', 'Parent', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\Category\",\"table\":\"categories\",\"type\":\"belongsTo\",\"column\":\"parent_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 11),
(83, 11, 'id', 'text', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(84, 11, 'provincia', 'text', 'Provincia', 0, 1, 1, 1, 1, 1, '{}', 2),
(85, 11, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(86, 11, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(87, 11, 'sratus', 'checkbox', 'Sratus', 0, 1, 1, 1, 1, 1, '{}', 5),
(88, 12, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(89, 12, 'provincias_id', 'text', 'Provincia', 0, 0, 1, 1, 1, 1, '{}', 2),
(90, 12, 'localidad', 'text', 'Localidad', 0, 1, 1, 1, 1, 1, '{}', 3),
(91, 12, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(92, 12, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(93, 12, 'localidade_belongsto_provincia_relationship', 'relationship', 'provincia', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\provincias\",\"table\":\"provincias\",\"type\":\"belongsTo\",\"column\":\"provincias_id\",\"key\":\"id\",\"label\":\"provincia\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6),
(94, 13, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(95, 13, 'name', 'text', 'Name', 0, 1, 1, 1, 1, 1, '{}', 2),
(96, 13, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(97, 13, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(98, 14, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(99, 14, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(100, 14, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(101, 14, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(102, 15, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(103, 15, 'category_id', 'select_dropdown', 'Category Id', 0, 0, 1, 1, 1, 1, '{}', 2),
(104, 15, 'marcas_id', 'select_dropdown', 'Marcas Id', 0, 0, 1, 1, 1, 1, '{}', 3),
(105, 15, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(106, 15, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(107, 15, 'category_marca_belongsto_marca_relationship', 'relationship', 'marcas', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\Marcas\",\"table\":\"marcas\",\"type\":\"belongsTo\",\"column\":\"marcas_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6),
(108, 15, 'category_marca_belongsto_category_relationship', 'relationship', 'Sub categoria', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\Category\",\"table\":\"categories\",\"type\":\"belongsTo\",\"column\":\"category_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(109, 16, 'id', 'text', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(110, 16, 'marcas_id', 'select_dropdown', 'Marcas Id', 1, 0, 1, 1, 1, 1, '{}', 2),
(111, 16, 'modelos_id', 'select_dropdown', 'Modelos Id', 1, 0, 1, 1, 1, 1, '{}', 3),
(112, 16, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(113, 16, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(114, 16, 'marcas_modelo_belongsto_marca_relationship', 'relationship', 'marcas', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\Marcas\",\"table\":\"marcas\",\"type\":\"belongsTo\",\"column\":\"marcas_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":null}', 6),
(115, 16, 'marcas_modelo_belongsto_modelo_relationship', 'relationship', 'modelos', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\Modelos\",\"table\":\"modelos\",\"type\":\"belongsTo\",\"column\":\"modelos_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":null}', 7),
(116, 17, 'id', 'text', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(117, 17, 'users_id', 'select_dropdown', 'Users Id', 1, 0, 1, 1, 1, 1, '{}', 2),
(118, 17, 'category_id', 'select_dropdown', 'Category Id', 1, 0, 1, 1, 1, 1, '{}', 3),
(119, 17, 'titulo', 'text', 'Titulo', 1, 1, 1, 1, 1, 1, '{}', 4),
(120, 17, 'descripcion', 'text', 'Descripcion', 1, 1, 1, 1, 1, 1, '{}', 5),
(121, 17, 'status', 'checkbox', 'Status', 0, 1, 1, 1, 1, 1, '{}', 6),
(122, 17, 'foto', 'image', 'Foto', 0, 1, 1, 1, 1, 1, '{}', 7),
(123, 17, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 1, 0, 1, '{}', 8),
(124, 17, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 9),
(125, 17, 'servicio_belongsto_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"users_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":null}', 10),
(126, 17, 'servicio_belongsto_category_relationship', 'relationship', 'categories', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\Category\",\"table\":\"categories\",\"type\":\"belongsTo\",\"column\":\"category_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":null}', 11),
(127, 18, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(128, 18, 'user_id', 'select_dropdown', 'User Id', 1, 0, 1, 1, 1, 1, '{}', 2),
(129, 18, 'post_id', 'select_dropdown', 'Post Id', 1, 0, 1, 1, 1, 1, '{}', 3),
(130, 18, 'detalle_reporte', 'text', 'Detalle Reporte', 1, 1, 1, 1, 1, 1, '{}', 4),
(131, 18, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(132, 18, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(133, 18, 'reporte_belongsto_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":null}', 7),
(134, 18, 'reporte_belongsto_post_relationship', 'relationship', 'posts', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\Post\",\"table\":\"posts\",\"type\":\"belongsTo\",\"column\":\"post_id\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":null}', 8),
(135, 19, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(136, 19, 'posts_id', 'select_dropdown', 'Posts Id', 1, 0, 1, 1, 1, 1, '{}', 2),
(137, 19, 'cant_visita', 'number', 'Cant Visita', 1, 1, 1, 1, 1, 1, '{}', 3),
(138, 19, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(139, 19, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(140, 19, 'posts_visita_belongsto_post_relationship', 'relationship', 'posts', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\Post\",\"table\":\"posts\",\"type\":\"belongsTo\",\"column\":\"posts_id\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":null}', 6),
(141, 20, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(142, 20, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(143, 20, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(144, 20, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(145, 21, 'id', 'text', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(146, 21, 'color', 'color', 'Color', 0, 1, 1, 1, 1, 1, '{}', 2),
(147, 21, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(148, 21, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(149, 22, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(150, 22, 'talle', 'text', 'Talle', 0, 1, 1, 1, 1, 1, '{}', 2),
(151, 22, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(152, 22, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(153, 23, 'id', 'text', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(154, 23, 'user_id', 'select_dropdown', 'User Id', 0, 0, 1, 1, 1, 1, '{}', 2),
(155, 23, 'titulo', 'text', 'Titulo', 0, 1, 1, 1, 1, 1, '{}', 3),
(156, 23, 'banner', 'image', 'Banner', 0, 0, 1, 1, 1, 1, '{}', 4),
(157, 23, 'status', 'select_dropdown', 'Status', 0, 1, 1, 1, 1, 1, '{\"options\":{\"0\":\"Suspendida\",\"1\":\"Habilitado\",\"rev\":\"En revision\"}}', 5),
(158, 23, 'destacada', 'checkbox', 'Destacada', 0, 1, 1, 1, 1, 1, '{}', 6),
(159, 23, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 1, 0, 1, '{}', 7),
(160, 23, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(161, 23, 'tienda_belongsto_user_relationship', 'relationship', 'Usuario', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 9),
(162, 24, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(163, 24, 'users_id', 'select_dropdown', 'Users Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(164, 24, 'tipo', 'text', 'Tipo', 1, 1, 1, 1, 1, 1, '{}', 3),
(165, 24, 'detalle', 'text', 'Detalle', 1, 1, 1, 1, 1, 1, '{}', 4),
(166, 24, 'archivo', 'file', 'Archivo', 0, 1, 1, 1, 1, 1, '{}', 5),
(167, 24, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(168, 24, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(169, 24, 'incidencia_belongsto_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"users_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":null}', 8),
(170, 10, 'descripcion', 'text', 'Descripcion', 0, 1, 1, 1, 1, 1, '{}', 10),
(171, 10, 'imagenceo', 'image', 'Imagenceo', 0, 1, 1, 1, 1, 1, '{}', 11),
(172, 9, 'link', 'text', 'Link', 0, 1, 1, 1, 1, 1, '{}', 8),
(173, 25, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(174, 25, 'titulo', 'text', 'Titulo', 0, 1, 1, 1, 1, 1, '{}', 2),
(175, 25, 'imagen', 'image', 'Imagen', 0, 1, 1, 1, 1, 1, '{}', 3),
(176, 25, 'texto', 'rich_text_box', 'Texto', 0, 0, 1, 1, 1, 1, '{}', 4),
(177, 25, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(178, 25, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(179, 23, 'tienda_belongsto_category_relationship', 'relationship', 'Categoria', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\Category\",\"table\":\"categories\",\"type\":\"belongsTo\",\"column\":\"category_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 10),
(180, 23, 'descripcion', 'text', 'Descripcion', 0, 0, 1, 1, 1, 1, '{}', 10),
(181, 23, 'direccion', 'text', 'Direccion', 0, 1, 1, 1, 1, 1, '{}', 11),
(182, 23, 'category_id', 'text', 'Category Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(188, 23, 'logo', 'image', 'Logo', 0, 0, 1, 1, 1, 1, '{}', 12),
(205, 28, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(206, 28, 'name', 'text', 'Name', 0, 1, 1, 1, 1, 1, '{}', 2),
(207, 28, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 3),
(208, 28, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(209, 4, 'nota_belongsto_categorynota_relationship', 'relationship', 'categorynotas', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\CategoryNotas\",\"table\":\"categorynotas\",\"type\":\"belongsTo\",\"column\":\"category_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"carritoItems\",\"pivot\":\"0\",\"taggable\":\"0\"}', 8),
(210, 4, 'category_id', 'select_dropdown', 'Category Id', 0, 0, 1, 1, 1, 1, '{}', 6),
(211, 29, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(212, 29, 'nombre', 'text', 'Nombre', 1, 1, 1, 1, 1, 1, '{}', 2),
(213, 29, 'apellido', 'text', 'Apellido', 1, 1, 1, 1, 1, 1, '{}', 3),
(214, 29, 'telefono', 'text', 'Telefono', 1, 0, 1, 1, 1, 1, '{}', 4),
(215, 29, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, '{}', 5),
(216, 29, 'razon_social', 'text', 'Razon Social', 1, 0, 1, 1, 1, 1, '{}', 6),
(217, 29, 'dni', 'text', 'Dni', 1, 0, 1, 1, 1, 1, '{}', 7),
(218, 29, 'cuil_cuit', 'text', 'Cuil Cuit', 1, 0, 1, 1, 1, 1, '{}', 8),
(219, 29, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 9),
(220, 29, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 10),
(221, 30, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(222, 30, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(223, 30, 'ubicacion', 'select_dropdown', 'Ubicacion', 1, 1, 1, 1, 1, 1, '{\"default\":\"\",\"options\":{\"homeh1\":\"Inicio Horizontal 1\",\"homeh2\":\"Inicio Horizontal 2\",\"homev1\":\"Inicio Vertical 1\",\"prdh1\":\"Productos Horizontal 1\",\"prdv1\":\"Productos Vertical 1\",\"bush1\":\"Buscador Horizontal 1\",\"bush2\":\"Buscador Horizontal 2\",\"cath1\":\"Categorias Horizontal 1\",\"cath2\":\"Categorias Horizontal 2 \"}}', 3),
(224, 30, 'precio', 'number', 'Precio', 1, 1, 1, 1, 1, 1, '{}', 4),
(225, 30, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(226, 30, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(227, 31, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(228, 31, 'post_id', 'select_dropdown', 'Post Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(229, 31, 'user_id', 'select_dropdown', 'User Id', 1, 1, 1, 1, 1, 1, '{}', 3),
(230, 31, 'answered', 'text', 'Respuesta', 0, 1, 1, 1, 1, 1, '{}', 4),
(231, 31, 'mensaje', 'text', 'Pregunta', 1, 1, 1, 1, 1, 1, '{}', 5),
(232, 31, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 1, 0, 1, '{}', 6),
(233, 31, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(234, 8, 'tienda_id', 'select_dropdown', 'Tienda', 0, 1, 1, 1, 1, 1, '{}', 19),
(235, 8, 'post_belongsto_tienda_relationship', 'relationship', 'tiendas', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\Tiendas\",\"table\":\"tiendas\",\"type\":\"belongsTo\",\"column\":\"tienda_id\",\"key\":\"id\",\"label\":\"titulo\",\"pivot_table\":\"auspiciante\",\"pivot\":\"0\",\"taggable\":null}', 20),
(236, 34, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(237, 34, 'user_id', 'select_dropdown', 'User Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(238, 34, 'puesto', 'text', 'Puesto', 1, 1, 1, 1, 1, 1, '{}', 3),
(239, 34, 'vacantes', 'number', 'Vacantes', 1, 1, 1, 1, 1, 1, '{}', 4),
(240, 34, 'direccion', 'text', 'Direccion', 1, 1, 1, 1, 1, 1, '{}', 5),
(241, 34, 'email', 'text', 'Email', 0, 1, 1, 1, 1, 1, '{}', 6),
(242, 34, 'descripcion', 'text_area', 'Descripcion', 1, 0, 1, 1, 1, 1, '{}', 7),
(243, 34, 'tipo_solicitud', 'text', 'Tipo Solicitud', 0, 0, 1, 1, 1, 1, '{}', 8),
(244, 34, 'status', 'number', 'Status', 0, 1, 1, 1, 1, 1, '{}', 9),
(245, 34, 'titulo', 'text', 'Titulo', 1, 1, 1, 1, 1, 1, '{}', 10),
(246, 34, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 1, 0, 1, '{}', 11),
(247, 34, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 12),
(248, 34, 'imagen', 'image', 'Imagen', 0, 0, 1, 1, 1, 1, '{}', 13),
(249, 34, 'ofertas_laborale_belongsto_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"auspiciante\",\"pivot\":\"0\",\"taggable\":null}', 14),
(250, 34, 'ofertas_laborale_hasmany_ofertas_laborales_postulante_relationship', 'relationship', 'ofertas_laborales_postulantes', 0, 1, 1, 1, 1, 1, '{\"model\":\"\\\\App\\\\Models\\\\OfertasPostulantes\",\"table\":\"ofertas_laborales_postulantes\",\"type\":\"hasMany\",\"column\":\"oferta_id\",\"key\":\"id\",\"label\":\"user_id\",\"pivot_table\":\"auspiciante\",\"pivot\":\"0\",\"taggable\":null}', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2020-05-09 19:41:06', '2020-07-27 21:11:24'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2020-05-09 19:41:06', '2020-05-09 19:41:06'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2020-05-09 19:41:06', '2020-05-09 19:41:06'),
(4, 'notas', 'notas', 'Nota', 'Notas', NULL, 'App\\Models\\Notas', NULL, NULL, NULL, 0, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-05-18 17:17:26', '2021-03-28 20:47:34'),
(8, 'posts', 'posts', 'Publicacion', 'Publicaciones', NULL, 'App\\Models\\Post', NULL, '\\TCG\\Voyager\\Http\\Controllers\\VoyagerPostController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"id\",\"scope\":null}', '2020-05-19 00:32:10', '2021-04-07 02:55:28'),
(9, 'sliders', 'sliders', 'Slider', 'Sliders', 'voyager-paint-bucket', 'App\\Models\\Slider', NULL, NULL, NULL, 1, 1, '{\"order_column\":\"orden\",\"order_display_column\":\"image\",\"order_direction\":\"asc\",\"default_search_key\":\"tittle\",\"scope\":null}', '2020-05-20 18:20:35', '2020-09-15 18:10:25'),
(10, 'categories', 'categories', 'Categoria', 'Categorias', 'voyager-pie-chart', 'App\\Models\\Category', NULL, NULL, NULL, 1, 1, '{\"order_column\":\"order\",\"order_display_column\":\"name\",\"order_direction\":\"asc\",\"default_search_key\":\"name\",\"scope\":null}', '2020-05-20 18:55:10', '2020-08-21 17:52:30'),
(11, 'provincias', 'provincias', 'Provincia', 'Provincias', NULL, 'App\\Models\\provincias', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"provincia\"}', '2020-05-20 19:08:05', '2020-05-20 19:08:05'),
(12, 'localidades', 'localidades', 'Localidade', 'Localidades', NULL, 'App\\Models\\localidades', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"localidad\",\"scope\":null}', '2020-05-20 19:09:32', '2020-05-20 19:10:33'),
(13, 'marcas', 'marcas', 'Marca', 'Marcas', NULL, 'App\\Models\\Marcas', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"name\"}', '2020-05-20 19:14:31', '2020-05-20 19:14:31'),
(14, 'modelos', 'modelos', 'Modelo', 'Modelos', NULL, 'App\\Models\\Modelos', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"name\"}', '2020-05-20 19:15:21', '2020-05-20 19:15:21'),
(15, 'category_marcas', 'category-marcas', 'Category Marca', 'Category Marcas', NULL, 'App\\Models\\CategoryMarcas', NULL, NULL, 'En esta seccion se relacionan las sub categorias con las marcas', 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":\"created_at\",\"scope\":null}', '2020-05-20 19:16:27', '2020-08-01 05:23:28'),
(16, 'marcas_modelos', 'marcas-modelos', 'Marcas Modelo', 'Marcas Modelos', NULL, 'App\\Models\\MarcasModelos', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"marcas_id\"}', '2020-05-20 19:23:04', '2020-05-20 19:23:04'),
(17, 'servicios', 'servicios', 'Servicio', 'Servicios', NULL, 'App\\Models\\Servicios', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"titulo\"}', '2020-05-20 19:33:28', '2020-05-20 19:33:28'),
(18, 'reportes', 'reportes', 'Reporte', 'Reportes', NULL, 'App\\Models\\Reportes', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"user_id\"}', '2020-05-20 19:38:32', '2020-05-20 19:38:32'),
(19, 'posts_visitas', 'posts-visitas', 'Posts Visita', 'Posts Visitas', NULL, 'App\\Models\\PostVisitas', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"posts_id\"}', '2020-05-20 19:42:04', '2020-05-20 19:42:04'),
(20, 'tipos_vehiculos', 'tipos-vehiculos', 'Tipos Vehiculo', 'Tipos Vehiculos', NULL, 'App\\Models\\TiposVehiculos', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-05-20 19:44:17', '2020-05-20 19:44:17'),
(21, 'colores', 'colores', 'Colore', 'Colores', NULL, 'App\\Models\\Colores', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-05-20 19:49:24', '2020-05-20 19:49:24'),
(22, 'talles', 'talles', 'Talle', 'Talles', NULL, 'App\\Models\\Talles', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-05-20 19:51:51', '2020-05-20 19:51:51'),
(23, 'tiendas', 'tiendas', 'Tienda', 'Tiendas', NULL, 'App\\Models\\Tiendas', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":\"titulo\",\"scope\":null}', '2020-05-20 19:53:56', '2021-03-28 01:08:51'),
(24, 'incidencias', 'incidencias', 'Incidencia', 'Incidencias', NULL, 'App\\Models\\Incidencias', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":\"users_id\"}', '2020-07-11 04:55:08', '2020-07-11 04:55:08'),
(25, 'plantillasemail', 'plantillasemail', 'Plantillasemail', 'Plantillasemails', NULL, 'App\\Models\\Plantillas', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":\"titulo\"}', '2020-10-26 05:56:13', '2020-10-26 05:56:13'),
(28, 'categorynotas', 'categorynotas', 'Categorynota', 'Categorynotas', NULL, 'App\\Models\\CategoryNotas', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null}', '2021-03-28 20:40:48', '2021-03-28 20:40:48'),
(29, 'auspiciante', 'auspiciante', 'Auspiciante', 'Auspiciantes', NULL, 'App\\Models\\Auspiciantes', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":\"nombre\"}', '2021-03-28 21:54:23', '2021-03-28 21:54:23'),
(30, 'posiciones', 'posiciones', 'Posicione', 'Posiciones', NULL, 'App\\Models\\Posiciones', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":\"name\",\"scope\":null}', '2021-03-28 22:12:08', '2021-03-28 22:12:47'),
(31, 'interesados', 'interesados', 'Interesado', 'Interesados', NULL, 'App\\Models\\Interesados', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":\"mensaje\"}', '2021-04-07 02:47:08', '2021-04-07 02:47:08'),
(34, 'ofertas_laborales', 'ofertas-laborales', 'Ofertas Laborale', 'Ofertas Laborales', NULL, 'App\\Models\\OfertasLaborales', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2021-11-25 16:31:34', '2021-11-25 16:31:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` bigint(10) UNSIGNED DEFAULT NULL,
  `tipo` varchar(100) NOT NULL,
  `detalle` text NOT NULL,
  `archivo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interesados`
--

CREATE TABLE `interesados` (
  `id` int(11) NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL,
  `answered` varchar(255) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `id` int(11) UNSIGNED NOT NULL,
  `provincias_id` int(10) UNSIGNED DEFAULT NULL,
  `localidad` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mailen`
--

CREATE TABLE `mailen` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plantilla_id` int(10) UNSIGNED NOT NULL,
  `notif` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_modelos`
--

CREATE TABLE `marcas_modelos` (
  `id` int(10) UNSIGNED NOT NULL,
  `marcas_id` int(10) UNSIGNED NOT NULL,
  `modelos_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-05-09 19:41:08', '2020-05-09 19:41:08'),
(2, 'menu', '2020-05-09 21:14:56', '2020-05-09 21:14:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2020-05-09 19:41:08', '2020-05-20 19:48:30', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, 5, 2, '2020-05-09 19:41:08', '2020-05-20 19:48:25', 'voyager.media.index', NULL),
(3, 1, 'Usuarios', '/admin/users', '_self', NULL, NULL, 29, 2, '2020-05-09 19:41:08', '2020-05-20 19:36:17', NULL, ''),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, 5, 1, '2020-05-09 19:41:08', '2020-05-20 19:48:25', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 4, '2020-05-09 19:41:08', '2020-05-20 19:52:09', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 3, '2020-05-09 19:41:08', '2020-05-20 19:48:25', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 4, '2020-05-09 19:41:08', '2020-05-20 19:48:25', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 5, '2020-05-09 19:41:08', '2020-05-20 19:48:25', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 6, '2020-05-09 19:41:09', '2020-05-20 19:48:25', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, 5, 7, '2020-05-09 19:41:09', '2020-05-20 19:48:25', 'voyager.settings.index', NULL),
(12, 2, 'Categorias', '#categorias', '_self', NULL, '#000000', NULL, 5, '2020-05-09 21:15:45', '2022-09-02 00:16:15', NULL, ''),
(13, 2, 'Computacion', '/categoria/12/computacion', '_self', NULL, '#000000', 12, 1, '2020-05-09 21:16:04', '2020-05-16 01:03:35', NULL, ''),
(14, 2, 'Servicios', '/contratar/servicios', '_self', NULL, '#000000', NULL, 3, '2020-05-09 21:16:40', '2022-09-02 00:16:12', NULL, ''),
(15, 2, 'Mejores precios', '/promociones', '_self', NULL, '#000000', NULL, 4, '2020-05-09 21:16:55', '2022-09-02 00:16:35', NULL, ''),
(16, 2, 'Tiendas', '/tiendas-digitales', '_self', NULL, '#000000', NULL, 1, '2020-05-09 21:17:07', '2022-09-02 00:16:05', NULL, ''),
(19, 2, 'Celulares', '/categoria/10/celulares-y-telefonos', '_self', NULL, NULL, 12, 2, '2020-05-16 03:37:28', '2020-05-18 21:16:43', NULL, ''),
(20, 1, 'Notas', '', '_self', NULL, NULL, NULL, 5, '2020-05-18 17:17:27', '2020-05-20 19:52:09', 'voyager.notas.index', NULL),
(21, 2, 'Autos, Motos y Otros', '/categoria/6/autos-motos-y-otros', '_self', NULL, NULL, 12, 3, '2020-05-18 21:16:02', '2020-05-18 21:16:06', NULL, ''),
(22, 2, 'Hogar, muebles y jardin', '/categoria/19/hogar-muebles-y-jardin', '_self', NULL, NULL, 12, 4, '2020-05-18 21:17:27', '2020-05-18 21:17:31', NULL, ''),
(23, 2, 'Electronica Audio y video', '/categoria/16/electronica-audio-y-video', '_self', NULL, NULL, 12, 5, '2020-05-18 21:22:00', '2020-05-18 21:22:03', NULL, ''),
(24, 2, 'Alimentos y bebidas', '/categoria/2/alimentos-y-bebidas', '_self', NULL, NULL, 12, 6, '2020-05-18 21:34:44', '2020-05-18 21:34:47', NULL, ''),
(25, 2, 'Animales y mascotas', '/categoria/3/animales-y-mascotas', '_self', NULL, NULL, 12, 7, '2020-05-18 21:35:04', '2020-05-18 21:35:07', NULL, ''),
(27, 2, 'Ropa y accesorios', '/categoria/27/ropa-y-accesorios', '_self', NULL, NULL, 12, 8, '2020-05-18 21:35:57', '2020-05-18 21:36:00', NULL, ''),
(28, 2, 'Ver todas las categorias', '/todas-las-categorias', '_self', NULL, NULL, 12, 9, '2020-05-18 21:37:00', '2020-05-18 21:37:05', NULL, ''),
(29, 1, 'Saldeello', '#', '_self', NULL, NULL, NULL, 2, '2020-05-19 00:26:34', '2021-11-29 19:44:00', NULL, ''),
(30, 1, 'Publicaciones', '/admin/posts', '_self', NULL, NULL, 29, 1, '2020-05-19 00:32:11', '2020-05-19 00:34:05', NULL, ''),
(31, 1, 'Sliders', '/admin/sliders', '_self', NULL, NULL, 29, 3, '2020-05-20 18:20:36', '2020-05-20 19:36:36', NULL, ''),
(32, 1, 'Atributos', '#', '_self', NULL, NULL, NULL, 3, '2020-05-20 18:51:01', '2020-05-20 19:48:30', NULL, ''),
(33, 1, 'Categorias', '/admin/categories', '_self', NULL, NULL, 32, 1, '2020-05-20 18:55:11', '2020-05-20 19:04:53', NULL, ''),
(34, 1, 'Provincias', '', '_self', NULL, NULL, NULL, 6, '2020-05-20 19:08:05', '2020-05-20 19:52:09', 'voyager.provincias.index', NULL),
(35, 1, 'Localidades', '', '_self', NULL, NULL, NULL, 7, '2020-05-20 19:09:32', '2020-05-20 19:52:10', 'voyager.localidades.index', NULL),
(36, 1, 'Marcas', '', '_self', NULL, NULL, 32, 2, '2020-05-20 19:14:32', '2020-05-20 19:14:57', 'voyager.marcas.index', NULL),
(37, 1, 'Modelos', '', '_self', NULL, NULL, 32, 3, '2020-05-20 19:15:21', '2020-05-20 19:15:28', 'voyager.modelos.index', NULL),
(38, 1, 'Category Marcas', '', '_self', NULL, NULL, 32, 4, '2020-05-20 19:16:27', '2020-05-20 19:19:23', 'voyager.category-marcas.index', NULL),
(39, 1, 'Marcas Modelos', '', '_self', NULL, NULL, 32, 5, '2020-05-20 19:23:04', '2020-05-20 19:24:34', 'voyager.marcas-modelos.index', NULL),
(40, 1, 'Servicios', '', '_self', NULL, NULL, 29, 4, '2020-05-20 19:33:28', '2020-05-20 19:36:05', 'voyager.servicios.index', NULL),
(41, 1, 'Reportes', '', '_self', NULL, NULL, 29, 5, '2020-05-20 19:38:32', '2020-05-20 19:39:31', 'voyager.reportes.index', NULL),
(42, 1, 'Posts Visitas', '', '_self', NULL, NULL, NULL, 8, '2020-05-20 19:42:04', '2020-05-20 19:52:10', 'voyager.posts-visitas.index', NULL),
(43, 1, 'Tipos Vehiculos', '', '_self', NULL, NULL, 32, 6, '2020-05-20 19:44:17', '2020-05-20 19:44:31', 'voyager.tipos-vehiculos.index', NULL),
(44, 1, 'Colores', '', '_self', NULL, NULL, 32, 7, '2020-05-20 19:49:25', '2020-05-20 19:49:36', 'voyager.colores.index', NULL),
(45, 1, 'Talles', '', '_self', NULL, NULL, 32, 8, '2020-05-20 19:51:51', '2020-05-20 19:52:09', 'voyager.talles.index', NULL),
(46, 1, 'Tiendas', '', '_self', NULL, NULL, NULL, 9, '2020-05-20 19:53:56', '2020-05-20 19:53:56', 'voyager.tiendas.index', NULL),
(47, 1, 'Incidencias', '', '_self', NULL, NULL, NULL, 10, '2020-07-11 04:55:08', '2020-07-11 04:55:08', 'voyager.incidencias.index', NULL),
(48, 1, 'Plantillas', '/admin/plantillasemail', '_self', NULL, NULL, 49, 1, '2020-10-26 05:56:13', '2020-10-26 05:57:28', NULL, ''),
(49, 1, 'Mailen', '', '_self', 'voyager-mail', NULL, NULL, 11, '2020-10-26 05:56:53', '2020-10-26 05:57:04', NULL, ''),
(50, 1, 'Correos', '/admin/mailen', '_self', NULL, NULL, 49, 2, '2020-10-26 05:57:42', '2020-10-26 05:57:47', NULL, ''),
(53, 1, 'Categorynotas', '', '_self', NULL, NULL, NULL, 14, '2021-03-28 20:40:48', '2021-03-28 20:40:48', 'voyager.categorynotas.index', NULL),
(54, 1, 'Auspiciantes', '', '_self', NULL, NULL, NULL, 15, '2021-03-28 21:54:24', '2021-03-28 21:54:24', 'voyager.auspiciante.index', NULL),
(55, 1, 'Posiciones', '', '_self', NULL, NULL, NULL, 16, '2021-03-28 22:12:08', '2021-03-28 22:12:08', 'voyager.posiciones.index', NULL),
(56, 1, 'Interesados', '', '_self', NULL, NULL, NULL, 17, '2021-04-07 02:47:08', '2021-04-07 02:47:08', 'voyager.interesados.index', NULL),
(57, 1, 'Ofertas Laborales', '', '_self', NULL, NULL, NULL, 18, '2021-11-25 16:31:34', '2021-11-25 16:31:34', 'voyager.ofertas-laborales.index', NULL),
(58, 2, 'Empleos', '/republica-dominicana/empleos', '_self', NULL, NULL, NULL, 2, '2021-11-25 17:33:03', '2022-09-02 00:16:09', NULL, '');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2016_01_01_000000_add_voyager_user_fields', 1),
(3, '2016_01_01_000000_create_data_types_table', 1),
(4, '2016_05_19_173453_create_menu_table', 1),
(5, '2016_10_21_190000_create_roles_table', 1),
(6, '2016_10_21_190000_create_settings_table', 1),
(7, '2016_11_30_135954_create_permission_table', 1),
(8, '2016_11_30_141208_create_permission_role_table', 1),
(9, '2016_12_26_201236_data_types__add__server_side', 1),
(10, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(11, '2017_01_14_005015_create_translations_table', 1),
(12, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(13, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(14, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(15, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(16, '2017_08_05_000000_add_group_to_settings_table', 1),
(17, '2017_11_26_013050_add_user_role_relationship', 1),
(18, '2017_11_26_015000_create_user_roles_table', 1),
(19, '2018_03_11_000000_add_user_settings', 1),
(20, '2018_03_14_000000_add_details_to_data_types_table', 1),
(21, '2018_03_16_000000_make_settings_value_nullable', 1),
(22, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_laborales`
--

CREATE TABLE `ofertas_laborales` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `puesto` varchar(60) NOT NULL,
  `vacantes` int(11) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo_solicitud` varchar(60) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `titulo` varchar(120) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_laborales_postulantes`
--

CREATE TABLE `ofertas_laborales_postulantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `oferta_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pautas`
--

CREATE TABLE `pautas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auspiciante_id` bigint(20) UNSIGNED NOT NULL,
  `posicion_id` bigint(20) UNSIGNED NOT NULL,
  `banner` varchar(255) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `banner_responsive` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2020-05-09 19:41:09', '2020-05-09 19:41:09'),
(2, 'browse_bread', NULL, '2020-05-09 19:41:09', '2020-05-09 19:41:09'),
(3, 'browse_database', NULL, '2020-05-09 19:41:09', '2020-05-09 19:41:09'),
(4, 'browse_media', NULL, '2020-05-09 19:41:09', '2020-05-09 19:41:09'),
(5, 'browse_compass', NULL, '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(6, 'browse_menus', 'menus', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(7, 'read_menus', 'menus', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(8, 'edit_menus', 'menus', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(9, 'add_menus', 'menus', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(10, 'delete_menus', 'menus', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(11, 'browse_roles', 'roles', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(12, 'read_roles', 'roles', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(13, 'edit_roles', 'roles', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(14, 'add_roles', 'roles', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(15, 'delete_roles', 'roles', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(16, 'browse_users', 'users', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(17, 'read_users', 'users', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(18, 'edit_users', 'users', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(19, 'add_users', 'users', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(20, 'delete_users', 'users', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(21, 'browse_settings', 'settings', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(22, 'read_settings', 'settings', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(23, 'edit_settings', 'settings', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(24, 'add_settings', 'settings', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(25, 'delete_settings', 'settings', '2020-05-09 19:41:10', '2020-05-09 19:41:10'),
(26, 'browse_hooks', NULL, '2020-05-09 19:41:12', '2020-05-09 19:41:12'),
(27, 'browse_notas', 'notas', '2020-05-18 17:17:26', '2020-05-18 17:17:26'),
(28, 'read_notas', 'notas', '2020-05-18 17:17:26', '2020-05-18 17:17:26'),
(29, 'edit_notas', 'notas', '2020-05-18 17:17:26', '2020-05-18 17:17:26'),
(30, 'add_notas', 'notas', '2020-05-18 17:17:26', '2020-05-18 17:17:26'),
(31, 'delete_notas', 'notas', '2020-05-18 17:17:26', '2020-05-18 17:17:26'),
(32, 'browse_posts', 'posts', '2020-05-19 00:32:11', '2020-05-19 00:32:11'),
(33, 'read_posts', 'posts', '2020-05-19 00:32:11', '2020-05-19 00:32:11'),
(34, 'edit_posts', 'posts', '2020-05-19 00:32:11', '2020-05-19 00:32:11'),
(35, 'add_posts', 'posts', '2020-05-19 00:32:11', '2020-05-19 00:32:11'),
(36, 'delete_posts', 'posts', '2020-05-19 00:32:11', '2020-05-19 00:32:11'),
(37, 'browse_sliders', 'sliders', '2020-05-20 18:20:36', '2020-05-20 18:20:36'),
(38, 'read_sliders', 'sliders', '2020-05-20 18:20:36', '2020-05-20 18:20:36'),
(39, 'edit_sliders', 'sliders', '2020-05-20 18:20:36', '2020-05-20 18:20:36'),
(40, 'add_sliders', 'sliders', '2020-05-20 18:20:36', '2020-05-20 18:20:36'),
(41, 'delete_sliders', 'sliders', '2020-05-20 18:20:36', '2020-05-20 18:20:36'),
(42, 'browse_categories', 'categories', '2020-05-20 18:55:11', '2020-05-20 18:55:11'),
(43, 'read_categories', 'categories', '2020-05-20 18:55:11', '2020-05-20 18:55:11'),
(44, 'edit_categories', 'categories', '2020-05-20 18:55:11', '2020-05-20 18:55:11'),
(45, 'add_categories', 'categories', '2020-05-20 18:55:11', '2020-05-20 18:55:11'),
(46, 'delete_categories', 'categories', '2020-05-20 18:55:11', '2020-05-20 18:55:11'),
(47, 'browse_provincias', 'provincias', '2020-05-20 19:08:05', '2020-05-20 19:08:05'),
(48, 'read_provincias', 'provincias', '2020-05-20 19:08:05', '2020-05-20 19:08:05'),
(49, 'edit_provincias', 'provincias', '2020-05-20 19:08:05', '2020-05-20 19:08:05'),
(50, 'add_provincias', 'provincias', '2020-05-20 19:08:05', '2020-05-20 19:08:05'),
(51, 'delete_provincias', 'provincias', '2020-05-20 19:08:05', '2020-05-20 19:08:05'),
(52, 'browse_localidades', 'localidades', '2020-05-20 19:09:32', '2020-05-20 19:09:32'),
(53, 'read_localidades', 'localidades', '2020-05-20 19:09:32', '2020-05-20 19:09:32'),
(54, 'edit_localidades', 'localidades', '2020-05-20 19:09:32', '2020-05-20 19:09:32'),
(55, 'add_localidades', 'localidades', '2020-05-20 19:09:32', '2020-05-20 19:09:32'),
(56, 'delete_localidades', 'localidades', '2020-05-20 19:09:32', '2020-05-20 19:09:32'),
(57, 'browse_marcas', 'marcas', '2020-05-20 19:14:32', '2020-05-20 19:14:32'),
(58, 'read_marcas', 'marcas', '2020-05-20 19:14:32', '2020-05-20 19:14:32'),
(59, 'edit_marcas', 'marcas', '2020-05-20 19:14:32', '2020-05-20 19:14:32'),
(60, 'add_marcas', 'marcas', '2020-05-20 19:14:32', '2020-05-20 19:14:32'),
(61, 'delete_marcas', 'marcas', '2020-05-20 19:14:32', '2020-05-20 19:14:32'),
(62, 'browse_modelos', 'modelos', '2020-05-20 19:15:21', '2020-05-20 19:15:21'),
(63, 'read_modelos', 'modelos', '2020-05-20 19:15:21', '2020-05-20 19:15:21'),
(64, 'edit_modelos', 'modelos', '2020-05-20 19:15:21', '2020-05-20 19:15:21'),
(65, 'add_modelos', 'modelos', '2020-05-20 19:15:21', '2020-05-20 19:15:21'),
(66, 'delete_modelos', 'modelos', '2020-05-20 19:15:21', '2020-05-20 19:15:21'),
(67, 'browse_category_marcas', 'category_marcas', '2020-05-20 19:16:27', '2020-05-20 19:16:27'),
(68, 'read_category_marcas', 'category_marcas', '2020-05-20 19:16:27', '2020-05-20 19:16:27'),
(69, 'edit_category_marcas', 'category_marcas', '2020-05-20 19:16:27', '2020-05-20 19:16:27'),
(70, 'add_category_marcas', 'category_marcas', '2020-05-20 19:16:27', '2020-05-20 19:16:27'),
(71, 'delete_category_marcas', 'category_marcas', '2020-05-20 19:16:27', '2020-05-20 19:16:27'),
(72, 'browse_marcas_modelos', 'marcas_modelos', '2020-05-20 19:23:04', '2020-05-20 19:23:04'),
(73, 'read_marcas_modelos', 'marcas_modelos', '2020-05-20 19:23:04', '2020-05-20 19:23:04'),
(74, 'edit_marcas_modelos', 'marcas_modelos', '2020-05-20 19:23:04', '2020-05-20 19:23:04'),
(75, 'add_marcas_modelos', 'marcas_modelos', '2020-05-20 19:23:04', '2020-05-20 19:23:04'),
(76, 'delete_marcas_modelos', 'marcas_modelos', '2020-05-20 19:23:04', '2020-05-20 19:23:04'),
(77, 'browse_servicios', 'servicios', '2020-05-20 19:33:28', '2020-05-20 19:33:28'),
(78, 'read_servicios', 'servicios', '2020-05-20 19:33:28', '2020-05-20 19:33:28'),
(79, 'edit_servicios', 'servicios', '2020-05-20 19:33:28', '2020-05-20 19:33:28'),
(80, 'add_servicios', 'servicios', '2020-05-20 19:33:28', '2020-05-20 19:33:28'),
(81, 'delete_servicios', 'servicios', '2020-05-20 19:33:28', '2020-05-20 19:33:28'),
(82, 'browse_reportes', 'reportes', '2020-05-20 19:38:32', '2020-05-20 19:38:32'),
(83, 'read_reportes', 'reportes', '2020-05-20 19:38:32', '2020-05-20 19:38:32'),
(84, 'edit_reportes', 'reportes', '2020-05-20 19:38:32', '2020-05-20 19:38:32'),
(85, 'add_reportes', 'reportes', '2020-05-20 19:38:32', '2020-05-20 19:38:32'),
(86, 'delete_reportes', 'reportes', '2020-05-20 19:38:32', '2020-05-20 19:38:32'),
(87, 'browse_posts_visitas', 'posts_visitas', '2020-05-20 19:42:04', '2020-05-20 19:42:04'),
(88, 'read_posts_visitas', 'posts_visitas', '2020-05-20 19:42:04', '2020-05-20 19:42:04'),
(89, 'edit_posts_visitas', 'posts_visitas', '2020-05-20 19:42:04', '2020-05-20 19:42:04'),
(90, 'add_posts_visitas', 'posts_visitas', '2020-05-20 19:42:04', '2020-05-20 19:42:04'),
(91, 'delete_posts_visitas', 'posts_visitas', '2020-05-20 19:42:04', '2020-05-20 19:42:04'),
(92, 'browse_tipos_vehiculos', 'tipos_vehiculos', '2020-05-20 19:44:17', '2020-05-20 19:44:17'),
(93, 'read_tipos_vehiculos', 'tipos_vehiculos', '2020-05-20 19:44:17', '2020-05-20 19:44:17'),
(94, 'edit_tipos_vehiculos', 'tipos_vehiculos', '2020-05-20 19:44:17', '2020-05-20 19:44:17'),
(95, 'add_tipos_vehiculos', 'tipos_vehiculos', '2020-05-20 19:44:17', '2020-05-20 19:44:17'),
(96, 'delete_tipos_vehiculos', 'tipos_vehiculos', '2020-05-20 19:44:17', '2020-05-20 19:44:17'),
(97, 'browse_colores', 'colores', '2020-05-20 19:49:25', '2020-05-20 19:49:25'),
(98, 'read_colores', 'colores', '2020-05-20 19:49:25', '2020-05-20 19:49:25'),
(99, 'edit_colores', 'colores', '2020-05-20 19:49:25', '2020-05-20 19:49:25'),
(100, 'add_colores', 'colores', '2020-05-20 19:49:25', '2020-05-20 19:49:25'),
(101, 'delete_colores', 'colores', '2020-05-20 19:49:25', '2020-05-20 19:49:25'),
(102, 'browse_talles', 'talles', '2020-05-20 19:51:51', '2020-05-20 19:51:51'),
(103, 'read_talles', 'talles', '2020-05-20 19:51:51', '2020-05-20 19:51:51'),
(104, 'edit_talles', 'talles', '2020-05-20 19:51:51', '2020-05-20 19:51:51'),
(105, 'add_talles', 'talles', '2020-05-20 19:51:51', '2020-05-20 19:51:51'),
(106, 'delete_talles', 'talles', '2020-05-20 19:51:51', '2020-05-20 19:51:51'),
(107, 'browse_tiendas', 'tiendas', '2020-05-20 19:53:56', '2020-05-20 19:53:56'),
(108, 'read_tiendas', 'tiendas', '2020-05-20 19:53:56', '2020-05-20 19:53:56'),
(109, 'edit_tiendas', 'tiendas', '2020-05-20 19:53:56', '2020-05-20 19:53:56'),
(110, 'add_tiendas', 'tiendas', '2020-05-20 19:53:56', '2020-05-20 19:53:56'),
(111, 'delete_tiendas', 'tiendas', '2020-05-20 19:53:56', '2020-05-20 19:53:56'),
(112, 'browse_incidencias', 'incidencias', '2020-07-11 04:55:08', '2020-07-11 04:55:08'),
(113, 'read_incidencias', 'incidencias', '2020-07-11 04:55:08', '2020-07-11 04:55:08'),
(114, 'edit_incidencias', 'incidencias', '2020-07-11 04:55:08', '2020-07-11 04:55:08'),
(115, 'add_incidencias', 'incidencias', '2020-07-11 04:55:08', '2020-07-11 04:55:08'),
(116, 'delete_incidencias', 'incidencias', '2020-07-11 04:55:08', '2020-07-11 04:55:08'),
(117, 'browse_plantillasemail', 'plantillasemail', '2020-10-26 05:56:13', '2020-10-26 05:56:13'),
(118, 'read_plantillasemail', 'plantillasemail', '2020-10-26 05:56:13', '2020-10-26 05:56:13'),
(119, 'edit_plantillasemail', 'plantillasemail', '2020-10-26 05:56:13', '2020-10-26 05:56:13'),
(120, 'add_plantillasemail', 'plantillasemail', '2020-10-26 05:56:13', '2020-10-26 05:56:13'),
(121, 'delete_plantillasemail', 'plantillasemail', '2020-10-26 05:56:13', '2020-10-26 05:56:13'),
(132, 'browse_categorynotas', 'categorynotas', '2021-03-28 20:40:48', '2021-03-28 20:40:48'),
(133, 'read_categorynotas', 'categorynotas', '2021-03-28 20:40:48', '2021-03-28 20:40:48'),
(134, 'edit_categorynotas', 'categorynotas', '2021-03-28 20:40:48', '2021-03-28 20:40:48'),
(135, 'add_categorynotas', 'categorynotas', '2021-03-28 20:40:48', '2021-03-28 20:40:48'),
(136, 'delete_categorynotas', 'categorynotas', '2021-03-28 20:40:48', '2021-03-28 20:40:48'),
(137, 'browse_auspiciante', 'auspiciante', '2021-03-28 21:54:23', '2021-03-28 21:54:23'),
(138, 'read_auspiciante', 'auspiciante', '2021-03-28 21:54:23', '2021-03-28 21:54:23'),
(139, 'edit_auspiciante', 'auspiciante', '2021-03-28 21:54:23', '2021-03-28 21:54:23'),
(140, 'add_auspiciante', 'auspiciante', '2021-03-28 21:54:23', '2021-03-28 21:54:23'),
(141, 'delete_auspiciante', 'auspiciante', '2021-03-28 21:54:23', '2021-03-28 21:54:23'),
(142, 'browse_posiciones', 'posiciones', '2021-03-28 22:12:08', '2021-03-28 22:12:08'),
(143, 'read_posiciones', 'posiciones', '2021-03-28 22:12:08', '2021-03-28 22:12:08'),
(144, 'edit_posiciones', 'posiciones', '2021-03-28 22:12:08', '2021-03-28 22:12:08'),
(145, 'add_posiciones', 'posiciones', '2021-03-28 22:12:08', '2021-03-28 22:12:08'),
(146, 'delete_posiciones', 'posiciones', '2021-03-28 22:12:08', '2021-03-28 22:12:08'),
(147, 'browse_interesados', 'interesados', '2021-04-07 02:47:08', '2021-04-07 02:47:08'),
(148, 'read_interesados', 'interesados', '2021-04-07 02:47:08', '2021-04-07 02:47:08'),
(149, 'edit_interesados', 'interesados', '2021-04-07 02:47:08', '2021-04-07 02:47:08'),
(150, 'add_interesados', 'interesados', '2021-04-07 02:47:08', '2021-04-07 02:47:08'),
(151, 'delete_interesados', 'interesados', '2021-04-07 02:47:08', '2021-04-07 02:47:08'),
(152, 'browse_ofertas_laborales', 'ofertas_laborales', '2021-11-25 16:31:34', '2021-11-25 16:31:34'),
(153, 'read_ofertas_laborales', 'ofertas_laborales', '2021-11-25 16:31:34', '2021-11-25 16:31:34'),
(154, 'edit_ofertas_laborales', 'ofertas_laborales', '2021-11-25 16:31:34', '2021-11-25 16:31:34'),
(155, 'add_ofertas_laborales', 'ofertas_laborales', '2021-11-25 16:31:34', '2021-11-25 16:31:34'),
(156, 'delete_ofertas_laborales', 'ofertas_laborales', '2021-11-25 16:31:34', '2021-11-25 16:31:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 7),
(2, 1),
(2, 7),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(16, 7),
(17, 7),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(21, 7),
(22, 1),
(22, 7),
(23, 1),
(23, 7),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(27, 7),
(28, 1),
(28, 7),
(29, 1),
(29, 7),
(30, 1),
(31, 1),
(32, 1),
(32, 7),
(33, 1),
(33, 7),
(34, 1),
(34, 7),
(35, 1),
(36, 1),
(37, 1),
(37, 7),
(38, 1),
(38, 7),
(39, 1),
(39, 7),
(40, 1),
(40, 7),
(41, 1),
(41, 7),
(42, 1),
(42, 7),
(43, 1),
(43, 7),
(44, 1),
(44, 7),
(45, 1),
(47, 1),
(47, 7),
(48, 1),
(48, 7),
(49, 1),
(49, 7),
(50, 1),
(50, 7),
(51, 1),
(52, 1),
(52, 7),
(53, 1),
(53, 7),
(54, 1),
(54, 7),
(55, 1),
(55, 7),
(56, 1),
(57, 1),
(57, 7),
(58, 1),
(58, 7),
(59, 1),
(59, 7),
(60, 1),
(60, 7),
(62, 1),
(62, 7),
(63, 1),
(63, 7),
(64, 1),
(64, 7),
(65, 1),
(65, 7),
(67, 1),
(67, 7),
(68, 1),
(68, 7),
(69, 1),
(69, 7),
(70, 1),
(70, 7),
(71, 7),
(72, 1),
(72, 7),
(73, 1),
(73, 7),
(74, 1),
(74, 7),
(75, 1),
(75, 7),
(76, 7),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(82, 7),
(83, 1),
(83, 7),
(84, 1),
(84, 7),
(85, 1),
(85, 7),
(87, 1),
(87, 7),
(88, 1),
(88, 7),
(89, 1),
(89, 7),
(90, 1),
(90, 7),
(92, 1),
(92, 7),
(93, 1),
(93, 7),
(94, 1),
(94, 7),
(95, 1),
(95, 7),
(97, 1),
(97, 7),
(98, 1),
(98, 7),
(99, 1),
(99, 7),
(100, 1),
(100, 7),
(101, 1),
(102, 1),
(102, 7),
(103, 1),
(103, 7),
(104, 1),
(104, 7),
(105, 1),
(105, 7),
(106, 1),
(107, 1),
(107, 7),
(108, 1),
(108, 7),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(112, 7),
(113, 1),
(113, 7),
(114, 1),
(114, 7),
(115, 1),
(116, 1),
(117, 1),
(117, 7),
(118, 1),
(118, 7),
(119, 1),
(119, 7),
(120, 1),
(121, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantillasemail`
--

CREATE TABLE `plantillasemail` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posiciones`
--

CREATE TABLE `posiciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `precio` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `subcategoryId` int(10) UNSIGNED DEFAULT NULL,
  `marca_id` int(10) UNSIGNED DEFAULT NULL,
  `Modelos_id` int(10) UNSIGNED DEFAULT NULL,
  `provincia_id` int(10) UNSIGNED DEFAULT NULL,
  `localidad_id` int(11) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `precios` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `status` enum('REVISION','PUBLISHED','DRAFT','PENDING','CANCELLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `condicion` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ml_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tienda_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts_colores`
--

CREATE TABLE `posts_colores` (
  `id` int(11) NOT NULL,
  `posts_id` int(10) UNSIGNED NOT NULL,
  `color_id` int(30) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts_talles`
--

CREATE TABLE `posts_talles` (
  `id` int(11) NOT NULL,
  `posts_id` int(30) UNSIGNED DEFAULT NULL,
  `talle_id` int(30) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts_vehiculos`
--

CREATE TABLE `posts_vehiculos` (
  `id` int(10) UNSIGNED NOT NULL,
  `posts_id` int(10) UNSIGNED DEFAULT NULL,
  `kilometros` varchar(20) DEFAULT NULL,
  `anio` varchar(20) DEFAULT NULL,
  `transmision` varchar(20) DEFAULT NULL,
  `colores_id` int(10) UNSIGNED DEFAULT NULL,
  `tipos_vehiculos_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts_visitas`
--

CREATE TABLE `posts_visitas` (
  `id` int(10) UNSIGNED NOT NULL,
  `posts_id` int(10) UNSIGNED NOT NULL,
  `cant_visita` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_imagenes`
--

CREATE TABLE `post_imagenes` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `posts_id` int(10) UNSIGNED DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `storage` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(10) UNSIGNED NOT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sratus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(11) NOT NULL,
  `user_id` bigint(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `detalle_reporte` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(110) NOT NULL,
  `descripcion` text NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Marketplace  -  compra y vende artículos | saldeello.com', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Marketplace República Dominicana descubre Autos, Casas, Motos y mucho mas somos el sitio de compra venta de República Dominicana', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', 'settings/April2023/RnALXYrzsbu1XoSvQWVf.png', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', 'GA1.1.904941809.1556093647', '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Saldeello', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Bienvenido al Administrador de Saldeello', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 1, 'Admin'),
(11, 'site.keywords', 'Keywords', 'markeplace, compra venta, tiendas en linea, publicar productos, publicar servicios', NULL, 'text', 6, 'Site'),
(12, 'site.lf', 'Logo del Footer', 'settings/October2021/5ujm7VB67wurCLuyhu77.png', NULL, 'image', 7, 'Site'),
(13, 'site.ogimage', 'OgImagen', 'settings/October2021/wMJgmcel2ZQqLo1CLepx.jpeg', NULL, 'image', 8, 'Site'),
(14, 'site.ccg', 'Recaptcha - Clave del sitio', '6LcAF1QUAAAAAOk2ID8uMU0cUhOuC8jJW_VO9qkE', NULL, 'text', 9, 'Site'),
(15, 'site.ccdg', 'Recaptcha - Clave secreta', '6LcAF1QUAAAAABr9s_0zyjIUua6qx8hwEaQfQi5e', NULL, 'text', 10, 'Site'),
(16, 'site.from', 'Emal From', 'notif@saldeello.com', NULL, 'text', 11, 'Site'),
(17, 'site.inf', 'Imgen no disponible', 'settings/May2020/WCDiftUsi2UgGZR4TfLu.png', NULL, 'image', 12, 'Site'),
(18, 'site.admin_icon_image', 'Favicon', 'settings/October2021/6kqtUIyZ3Ts86CmbyWuI.png', NULL, 'image', 13, 'Site');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `tittle` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talles`
--

CREATE TABLE `talles` (
  `id` int(11) UNSIGNED NOT NULL,
  `talle` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE `tiendas` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `titulo` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `destacada` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_vehiculos`
--

CREATE TABLE `tipos_vehiculos` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuit` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provincia_id` int(11) DEFAULT NULL,
  `localidad_id` int(11) DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo_empresa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateChangePassword` date DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `cpa` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auspiciante`
--
ALTER TABLE `auspiciante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`),
  ADD KEY `atributos` (`atributos`);

--
-- Indices de la tabla `categorynotas`
--
ALTER TABLE `categorynotas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `category_marcas`
--
ALTER TABLE `category_marcas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `marcas_id` (`marcas_id`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indices de la tabla `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indices de la tabla `interesados`
--
ALTER TABLE `interesados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `vendedor_id` (`user_id`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provincias_id` (`provincias_id`);

--
-- Indices de la tabla `mailen`
--
ALTER TABLE `mailen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `plantilla_id` (`plantilla_id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `marcas_modelos`
--
ALTER TABLE `marcas_modelos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marcas_id` (`marcas_id`),
  ADD KEY `modelos_id` (`modelos_id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indices de la tabla `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notas_category_id_index` (`category_id`);

--
-- Indices de la tabla `ofertas_laborales`
--
ALTER TABLE `ofertas_laborales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `ofertas_laborales_postulantes`
--
ALTER TABLE `ofertas_laborales_postulantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oferta_id` (`oferta_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `pautas`
--
ALTER TABLE `pautas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auspiciante_id` (`auspiciante_id`),
  ADD KEY `posicion_id` (`posicion_id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indices de la tabla `plantillasemail`
--
ALTER TABLE `plantillasemail`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posiciones`
--
ALTER TABLE `posiciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor` (`user_id`),
  ADD KEY `categoria` (`category_id`),
  ADD KEY `marca_id` (`marca_id`),
  ADD KEY `provincia_id` (`provincia_id`),
  ADD KEY `localidad_id` (`localidad_id`),
  ADD KEY `Modelos_id` (`Modelos_id`),
  ADD KEY `subcategoryId` (`subcategoryId`),
  ADD KEY `fecha_vencimiento` (`fecha_vencimiento`),
  ADD KEY `ml_id` (`ml_id`),
  ADD KEY `tienda_id` (`tienda_id`);

--
-- Indices de la tabla `posts_colores`
--
ALTER TABLE `posts_colores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_id` (`posts_id`),
  ADD KEY `pcoi` (`color_id`);

--
-- Indices de la tabla `posts_talles`
--
ALTER TABLE `posts_talles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `talle` (`talle_id`),
  ADD KEY `productos_id` (`posts_id`);

--
-- Indices de la tabla `posts_vehiculos`
--
ALTER TABLE `posts_vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_id` (`posts_id`),
  ADD KEY `colores_id` (`colores_id`),
  ADD KEY `tipos_vehiculos_id` (`tipos_vehiculos_id`);

--
-- Indices de la tabla `posts_visitas`
--
ALTER TABLE `posts_visitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_id` (`posts_id`),
  ADD KEY `cant_visita` (`cant_visita`);

--
-- Indices de la tabla `post_imagenes`
--
ALTER TABLE `post_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_id` (`posts_id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indices de la tabla `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `talles`
--
ALTER TABLE `talles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userTienda` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `tipos_vehiculos`
--
ALTER TABLE `tipos_vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `provincia_id` (`provincia_id`),
  ADD KEY `localidad_id` (`localidad_id`);

--
-- Indices de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auspiciante`
--
ALTER TABLE `auspiciante`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorynotas`
--
ALTER TABLE `categorynotas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `category_marcas`
--
ALTER TABLE `category_marcas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT de la tabla `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `interesados`
--
ALTER TABLE `interesados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mailen`
--
ALTER TABLE `mailen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas_modelos`
--
ALTER TABLE `marcas_modelos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas_laborales`
--
ALTER TABLE `ofertas_laborales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas_laborales_postulantes`
--
ALTER TABLE `ofertas_laborales_postulantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pautas`
--
ALTER TABLE `pautas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT de la tabla `plantillasemail`
--
ALTER TABLE `plantillasemail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posiciones`
--
ALTER TABLE `posiciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posts_colores`
--
ALTER TABLE `posts_colores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posts_talles`
--
ALTER TABLE `posts_talles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posts_vehiculos`
--
ALTER TABLE `posts_vehiculos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posts_visitas`
--
ALTER TABLE `posts_visitas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `post_imagenes`
--
ALTER TABLE `post_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `talles`
--
ALTER TABLE `talles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_vehiculos`
--
ALTER TABLE `tipos_vehiculos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `category_marcas`
--
ALTER TABLE `category_marcas`
  ADD CONSTRAINT `category_id2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `marcas_id2` FOREIGN KEY (`marcas_id`) REFERENCES `marcas` (`id`);

--
-- Filtros para la tabla `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `user_incidencia` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `interesados`
--
ALTER TABLE `interesados`
  ADD CONSTRAINT `interesadoPosts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `interesados_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD CONSTRAINT `provincias` FOREIGN KEY (`provincias_id`) REFERENCES `provincias` (`id`);

--
-- Filtros para la tabla `mailen`
--
ALTER TABLE `mailen`
  ADD CONSTRAINT `pmailen` FOREIGN KEY (`plantilla_id`) REFERENCES `plantillasemail` (`id`),
  ADD CONSTRAINT `umailen` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `marcas_modelos`
--
ALTER TABLE `marcas_modelos`
  ADD CONSTRAINT `marcas_id` FOREIGN KEY (`marcas_id`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `modelos_id` FOREIGN KEY (`modelos_id`) REFERENCES `modelos` (`id`);

--
-- Filtros para la tabla `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ofertas_laborales`
--
ALTER TABLE `ofertas_laborales`
  ADD CONSTRAINT `user_oferta` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `ofertas_laborales_postulantes`
--
ALTER TABLE `ofertas_laborales_postulantes`
  ADD CONSTRAINT `postulaofertass` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas_laborales` (`id`),
  ADD CONSTRAINT `postulauser` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `pautas`
--
ALTER TABLE `pautas`
  ADD CONSTRAINT `p_au` FOREIGN KEY (`auspiciante_id`) REFERENCES `auspiciante` (`id`),
  ADD CONSTRAINT `p_position` FOREIGN KEY (`posicion_id`) REFERENCES `posiciones` (`id`);

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `addre_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cat_related` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `posr_localidad` FOREIGN KEY (`localidad_id`) REFERENCES `localidades` (`id`),
  ADD CONSTRAINT `posr_provincia` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`),
  ADD CONSTRAINT `post_marcaId` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `post_modelo` FOREIGN KEY (`Modelos_id`) REFERENCES `modelos` (`id`),
  ADD CONSTRAINT `subcat_related` FOREIGN KEY (`subcategoryId`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `posts_colores`
--
ALTER TABLE `posts_colores`
  ADD CONSTRAINT `color_post` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_colorId` FOREIGN KEY (`color_id`) REFERENCES `colores` (`id`);

--
-- Filtros para la tabla `posts_vehiculos`
--
ALTER TABLE `posts_vehiculos`
  ADD CONSTRAINT `posts_vehiculos_ibfk_1` FOREIGN KEY (`colores_id`) REFERENCES `colores` (`id`),
  ADD CONSTRAINT `posts_vehiculos_ibfk_2` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `posts_vehiculos_ibfk_3` FOREIGN KEY (`tipos_vehiculos_id`) REFERENCES `tipos_vehiculos` (`id`);

--
-- Filtros para la tabla `post_imagenes`
--
ALTER TABLE `post_imagenes`
  ADD CONSTRAINT `post_imagenes_ibfk_1` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`);

--
-- Filtros para la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD CONSTRAINT `tiendas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tiendas_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
