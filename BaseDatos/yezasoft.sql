-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2019 a las 02:34:36
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `yezasoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adelanto`
--

CREATE TABLE `adelanto` (
  `idadelanto` bigint(20) UNSIGNED NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idempleado` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `adelanto`
--

INSERT INTO `adelanto` (`idadelanto`, `valor`, `fecha`, `idempleado`) VALUES
(1, 856000, '2018-12-04 22:55:27', '100'),
(2, 37000, '2019-02-09 01:20:36', '1085282140'),
(3, 30000, '2019-02-22 20:02:29', '1085282140');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `idcaja` bigint(20) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL,
  `fechasalida` datetime DEFAULT NULL,
  `base` int(20) UNSIGNED NOT NULL,
  `gasto` bigint(20) UNSIGNED DEFAULT NULL,
  `usuariocaja` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`idcaja`, `fecha`, `fechasalida`, `base`, `gasto`, `usuariocaja`) VALUES
(48, '2018-12-06 05:48:36', NULL, 50000, NULL, '1233194301'),
(49, '2018-12-06 11:11:37', NULL, 400000, NULL, '1233194301'),
(50, '2018-12-06 20:51:34', '2018-12-06 21:44:15', 789456, NULL, '1233194301'),
(51, '2018-12-06 21:44:26', '2018-12-06 21:51:18', 79846, NULL, '1233194301'),
(52, '2018-12-06 21:51:29', '2018-12-06 22:02:31', 564146, NULL, '1233194301'),
(53, '2018-12-06 22:04:23', NULL, 78945, NULL, '1233194301'),
(54, '2018-12-07 08:39:16', '2018-12-07 08:42:26', 456465, NULL, '1233194301'),
(55, '2018-12-09 17:28:15', '2018-12-11 11:55:10', 0, NULL, '1233194301'),
(56, '2018-12-11 11:55:47', NULL, 98456, NULL, '1233194301'),
(57, '2018-12-16 14:42:03', '2018-12-16 14:42:20', 45678, NULL, '1233194301'),
(58, '2018-12-19 11:31:12', '2018-12-19 16:08:37', 9999, NULL, '1233194301'),
(60, '2019-02-22 09:19:17', '2019-02-22 09:20:56', 789000, NULL, '1233194301'),
(73, '2019-02-22 10:39:25', '2019-02-22 10:47:37', 78954, NULL, '1233194301'),
(74, '2019-02-22 11:03:12', '2019-02-22 11:11:00', 456, NULL, '1233194301'),
(75, '2019-02-27 00:55:13', NULL, 456445, NULL, '1233194301'),
(76, '2019-02-27 00:57:22', NULL, 465456, NULL, '1233194301'),
(77, '2019-02-27 16:24:02', NULL, 7845654, NULL, '1085282140');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `idcargo` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `sueldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`idcargo`, `nombre`, `sueldo`) VALUES
(1, 'CHEF', 1200000),
(2, 'VIGILANTE', 800000),
(3, 'MESERO', 4500000),
(5, 'Aseo', 528000),
(7, 'Auxiliar de cocina', 850000),
(8, 'Cajero', 820000),
(9, 'Asador', 980000),
(10, 'Cocina', 850000),
(11, 'Turno Mesa', 148000),
(12, 'Administrador', 1250000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `identificacion` varchar(35) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`identificacion`, `nombres`, `apellidos`, `telefono`, `email`, `clave`) VALUES
('100', 'Yohan Alexis ', 'Caratar Pabon', '3146027224', 'jacaratar5@misen.edu.co', '100'),
('1002', 'Pepito Perez', 'Lopez Mejia', '724564', 'pepe@gmail.com', '1002'),
('10020', 'Deisy', 'Garcia', '3146027224', 'ja@xn--gmai-jqa.com', '10020'),
('1003', 'Mauro ', 'Alexander', '456456487', 'mau@gmail.com', '1003'),
('1004', 'luis fernandez', 'Garcia gomez', '356456', 'mejia@gamil.com', '1004'),
('101', 'Sara Maria ', 'Pabon Riascos', '3146027224', 'saramaria@gmail.com', '101'),
('1021', 'Carmen ', 'Gonzales', '489784456', 'carme@gamil.com', '1021'),
('1022', 'PP', 'suarez', '789784', 'pp@gmail.com', '1022'),
('123456123', 'prueba error', 'prueb', '3146027224', 'prueba@gmail.com', '123456123'),
('14546749845', 'prueba nada', 'nada', '31460272556', 'jaca@gmail.com', '14546749845'),
('19546', 'prueba', 'prueb', '31', 'prueba@gmail.com', '19546'),
('45645', 'prueba error', 'prueb', '3146027224', 'prueba@gmail.com', '45645'),
('4564562', 'nada de nada', 'caratar pabon', '3146025864', 'prueba@gmail.com', '4564562'),
('456465', 'prueba error', 'prueb', '3146027224', 'prueba@gmail.com', '456465'),
('46512', 'jorge perez', 'prueb', '36456', 'prueba@gmail.com', '46512'),
('7875656', 'prueba error', 'error', '3146027224', 'prueba@gmail.com', '7875656'),
('789563', 'prueba error', 'error', '3146027224', 'prueba@gmail.com', '789563');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda`
--

CREATE TABLE `comanda` (
  `idcomanda` bigint(20) UNSIGNED NOT NULL,
  `idempleado` varchar(35) DEFAULT NULL,
  `mesa` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `estado` varchar(1) NOT NULL,
  `reserva` bigint(20) UNSIGNED DEFAULT NULL,
  `factura` bigint(11) UNSIGNED DEFAULT NULL,
  `domicilio` bigint(20) UNSIGNED DEFAULT NULL,
  `caja` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comanda`
--

INSERT INTO `comanda` (`idcomanda`, `idempleado`, `mesa`, `fecha`, `estado`, `reserva`, `factura`, `domicilio`, `caja`) VALUES
(509, '1233194301', 37, '2018-12-06 05:49:19', 'L', NULL, 555, NULL, 48),
(510, '1233194301', NULL, '2018-12-06 05:51:27', 'L', 41, 556, NULL, 48),
(511, '1233194301', NULL, '2018-12-06 05:53:35', 'L', 42, 557, NULL, 48),
(512, '1233194301', NULL, '2018-12-06 05:56:04', 'L', 43, 558, NULL, 48),
(513, '1233194301', NULL, '2018-12-06 05:57:41', 'L', 44, 559, NULL, 48),
(514, '1233194301', NULL, '2018-12-06 05:59:52', 'L', 45, 560, NULL, 48),
(515, '1233194301', NULL, '2018-12-06 06:01:44', 'L', NULL, 561, 43, 48),
(516, '1233194301', NULL, '2018-12-06 06:03:02', 'L', NULL, 562, 44, 48),
(517, '1233194301', NULL, '2018-12-06 06:04:22', 'L', NULL, 563, 45, 48),
(518, '1233194301', NULL, '2018-12-06 06:05:17', 'L', NULL, 564, 46, 48),
(520, '1233194301', 47, '2018-12-06 11:13:39', 'L', NULL, 566, NULL, 49),
(521, '123', 47, '2018-12-09 17:28:42', 'L', NULL, 567, NULL, 55),
(525, '123', 32, '2018-12-09 17:29:00', 'L', NULL, 571, NULL, 55),
(526, '1233194301', 47, '2018-12-09 19:17:09', 'P', NULL, 572, NULL, 55),
(527, '1233194301', 37, '2018-12-10 17:32:10', 'P', NULL, 573, NULL, 55),
(528, '1233194301', 28, '2018-12-10 17:33:51', 'P', NULL, 574, NULL, 55),
(529, '1233194301', 37, '2018-12-10 22:09:30', 'P', NULL, 575, NULL, 55),
(530, '1233194301', 40, '2018-12-10 22:14:14', 'P', NULL, 576, NULL, 55),
(531, '1233194301', 48, '2018-12-10 22:14:32', 'P', NULL, 577, NULL, 55),
(532, '1233194301', 60, '2018-12-11 07:11:49', 'P', NULL, 578, NULL, 55),
(533, '1233194301', 71, '2018-12-11 07:16:14', 'P', NULL, 579, NULL, 55),
(534, '1233194301', 76, '2018-12-11 10:14:46', 'P', NULL, 580, NULL, 55),
(535, '1233194301', NULL, '2018-12-11 11:56:43', 'P', NULL, 581, 47, 56),
(536, '1233194301', NULL, '2018-12-11 11:58:06', 'P', 46, 582, NULL, 56),
(537, '1233194301', 29, '2018-12-12 01:04:59', 'P', NULL, 583, NULL, 56),
(538, '27456350', 52, '2018-12-12 08:18:16', 'P', NULL, 584, NULL, 56),
(539, '27456350', 30, '2018-12-13 22:12:25', 'P', NULL, 585, NULL, 56),
(545, '1233194301', NULL, '2019-02-27 01:29:34', 'P', 57, 598, NULL, 76),
(547, '1233194301', NULL, '2019-02-27 01:48:35', 'P', 58, 601, NULL, 76),
(548, '1233194301', NULL, '2019-02-27 16:16:37', 'P', NULL, 602, 48, 76),
(549, '1233194301', NULL, '2019-02-27 16:44:11', 'V', NULL, 603, NULL, 77),
(552, '1085282140', NULL, '2019-02-27 16:59:11', 'P', NULL, 606, NULL, 77),
(577, '1085282140', NULL, '2019-02-27 18:19:51', 'P', NULL, 631, NULL, 77),
(578, '1085282140', NULL, '2019-02-27 18:21:49', 'P', NULL, 632, NULL, 77),
(579, '1233194301', NULL, '2019-02-27 18:21:59', 'P', NULL, 633, NULL, 77),
(581, '1085282140', NULL, '2019-02-27 18:24:28', 'P', NULL, 635, NULL, 77),
(582, '1233194301', NULL, '2019-02-27 18:25:47', 'P', NULL, 636, NULL, 77),
(583, '123', 66, '2019-02-27 19:29:45', 'P', NULL, 637, NULL, 77),
(584, '123', 77, '2019-02-27 19:31:44', 'P', NULL, 638, NULL, 77);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleorden`
--

CREATE TABLE `detalleorden` (
  `iddetalle` bigint(20) UNSIGNED NOT NULL,
  `comanda` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `nota` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `plato` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `domicilio` bigint(20) UNSIGNED DEFAULT NULL,
  `vrunitario` int(11) NOT NULL,
  `reserva` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalleorden`
--

INSERT INTO `detalleorden` (`iddetalle`, `comanda`, `cantidad`, `nota`, `plato`, `domicilio`, `vrunitario`, `reserva`) VALUES
(264, 509, 5, NULL, '006', NULL, 40000, NULL),
(265, 509, 2, NULL, '010', NULL, 4500, NULL),
(266, 509, 1, NULL, '004', NULL, 18000, NULL),
(267, 510, 1, '', '563', NULL, 8000, 41),
(268, 510, 2, '', '004', NULL, 18000, 41),
(269, 510, 2, '', '011', NULL, 12000, 41),
(270, 511, 2, '', '006', NULL, 40000, 42),
(271, 511, 4, '', '001', NULL, 21474, 42),
(272, 512, 2, '', '009', NULL, 3500, 43),
(273, 512, 8, '', '001', NULL, 21474, 43),
(274, 512, 2, '', '013', NULL, 12000, 43),
(275, 513, 2, '', '014', NULL, 13000, 44),
(276, 513, 4, '', '013', NULL, 12000, 44),
(277, 513, 5, '', '006', NULL, 40000, 44),
(278, 514, 1, '', '560', NULL, 85000, 45),
(279, 514, 1, '', '561', NULL, 45, 45),
(280, 514, 1, '', '563', NULL, 8000, 45),
(281, 514, 15, '', '006', NULL, 40000, 45),
(282, 514, 20, '', '005', NULL, 15000, 45),
(283, 514, 12, '', '014', NULL, 13000, 45),
(284, 515, 10, NULL, '005', 43, 15000, NULL),
(285, 516, 2, NULL, '011', 44, 12000, NULL),
(286, 516, 4, NULL, '004', 44, 18000, NULL),
(287, 517, 10, NULL, '001', 45, 21474, NULL),
(288, 518, 1, NULL, '006', 46, 40000, NULL),
(289, 520, 2, NULL, '006', NULL, 40000, NULL),
(290, 520, 2, NULL, '009', NULL, 3500, NULL),
(291, 521, 2, NULL, '003', NULL, 8000, NULL),
(292, 525, 2, NULL, '004', NULL, 18000, NULL),
(293, 526, 2, NULL, '004', NULL, 18000, NULL),
(294, 527, 2, NULL, '004', NULL, 18000, NULL),
(295, 528, 2, NULL, '005', NULL, 15000, NULL),
(296, 529, 2, NULL, '004', NULL, 18000, NULL),
(297, 530, 2, NULL, '002', NULL, 12000, NULL),
(298, 531, 4, NULL, '002', NULL, 12000, NULL),
(299, 532, 2, NULL, '002', NULL, 12000, NULL),
(300, 533, 2, NULL, '002', NULL, 12000, NULL),
(301, 534, 2, NULL, '002', NULL, 12000, NULL),
(302, 535, 1, NULL, '001', 47, 21474, NULL),
(303, 535, 1, NULL, '005', 47, 15000, NULL),
(304, 536, 1, '', '561', NULL, 45, 46),
(305, 536, 1, '', '563', NULL, 8000, 46),
(306, 536, 1, '', '010', NULL, 4500, 46),
(307, 536, 1, '', '012', NULL, 12000, 46),
(308, 537, 2, NULL, '011', NULL, 12000, NULL),
(309, 538, 2, NULL, '002', NULL, 12000, NULL),
(310, 539, 2, NULL, '001', NULL, 21474, NULL),
(311, 539, 2, NULL, '009', NULL, 3500, NULL),
(319, 545, 1, '', '564', NULL, 3250000, 57),
(320, 545, 1, '', '563', NULL, 8000, 57),
(321, 545, 1, '', '562', NULL, 45000, 57),
(322, 545, 1, '', '561', NULL, 45, 57),
(323, 545, 1, '', '560', NULL, 85000, 57),
(324, 545, 1, '', '556', NULL, 11500, 57),
(325, 545, 20, '', '008', NULL, 5000, 57),
(333, 547, 1, '', '564', NULL, 3250000, 58),
(334, 547, 1, '', '563', NULL, 8000, 58),
(335, 547, 1, '', '562', NULL, 45000, 58),
(336, 547, 1, '', '561', NULL, 45, 58),
(337, 547, 1, '', '560', NULL, 85000, 58),
(338, 547, 1, '', '556', NULL, 11500, 58),
(339, 547, 40, '', '001', NULL, 21474, 58),
(340, 547, 1, '', '011', NULL, 12000, 58),
(341, 548, 1, NULL, '017', 48, 5500, NULL),
(342, 548, 1, NULL, '456465', 48, 546, NULL),
(343, 549, 8, 'nada', '012', NULL, 12000, NULL),
(344, 549, 5, '', '005', NULL, 15000, NULL),
(345, 549, 5, '', '002', NULL, 12000, NULL),
(347, 552, 5, 'nada', '011', NULL, 12000, NULL),
(348, 579, 5, '', '011', NULL, 12000, NULL),
(349, 581, 5, '..', '002', NULL, 12000, NULL),
(350, 582, 2, 'nada', '002', NULL, 12000, NULL),
(351, 583, 5, NULL, '006', NULL, 40000, NULL),
(352, 583, 2, NULL, '010', NULL, 4500, NULL),
(353, 584, 2, NULL, '002', NULL, 12000, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE `domicilio` (
  `iddomicilio` bigint(20) UNSIGNED NOT NULL,
  `idplato` varchar(35) DEFAULT NULL,
  `fechasistema` datetime NOT NULL,
  `fechadomicilio` datetime NOT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `identificacioncliente` varchar(35) DEFAULT NULL,
  `barrio` varchar(30) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `abono` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`iddomicilio`, `idplato`, `fechasistema`, `fechadomicilio`, `direccion`, `identificacioncliente`, `barrio`, `hora`, `abono`) VALUES
(43, '556', '2018-12-06 06:01:44', '2018-12-28 00:00:00', 'casa GRANDE', '10020', 'San carlos', '00:56:00', 20000),
(44, '556', '2018-12-06 06:03:01', '2018-12-07 00:00:00', 'calle 13-Ab', '1021', 'las AMERICAS', '00:56:00', 0),
(45, '556', '2018-12-06 06:04:21', '2018-12-24 00:00:00', 'Mz U casa 12', '1021', 'CHAMBU', '16:56:00', 0),
(46, '556', '2018-12-06 06:05:17', '2018-12-21 00:00:00', 'clla 12b ', '1022', 'centro', '12:56:00', 0),
(47, '556', '2018-12-11 11:56:43', '2018-12-21 00:00:00', 'San Juan de Pasto', '100', 'PRUBEA', '12:56:00', 0),
(48, '556', '2019-02-27 16:16:37', '2019-02-28 00:00:00', 'Manzana O casa 18', '14546749845', 'San carlos', '00:56:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `identificacion` varchar(35) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `fechaingreso` date NOT NULL,
  `fechafin` date DEFAULT NULL,
  `cargo` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`identificacion`, `nombres`, `apellidos`, `genero`, `telefono`, `fechanacimiento`, `email`, `fechaingreso`, `fechafin`, `cargo`) VALUES
('100', 'prueba', 'completa', 'Masculino', '7202020', '2018-10-30', 'prueba@gmail.com', '2018-11-30', '2019-01-30', 3),
('1085282140', 'Ferney ', '...', 'Masculino', '7546555', '1997-07-15', 'lacasitadelcuy@gmail.com', '2019-02-08', '2019-07-25', 11),
('123', 'Mauro Alexander', 'Caratar  Pabon', 'Masculino', '320202020', '1997-03-26', 'mau12futbol@gmail.com', '2018-11-30', '2019-01-30', 3),
('1233189463', 'Judy Alexandra', 'Iguad Castro', 'Femenino', '3008298690', '2018-11-30', 'castroalexandra831@gmail.com', '2018-12-13', '2019-01-30', 8),
('1233194301', 'Yohan Alexis', 'Alexis Caratar', 'Masculino', '30082986890', '1999-03-30', 'jacaratar5@misena.edu.co', '2019-02-27', '2018-12-13', 12),
('123987', 'alexistoo', 'pabon', 'Masculino', '3167403850', '1999-09-02', 'alexi@gmail.com', '2019-02-06', '2019-03-06', 8),
('27456350', 'Sara Maria', 'Pabon Riascos', 'Masculino', '3146027224', '1990-08-01', 'saramariapabon@gmail.com', '2018-11-30', '2019-01-10', 1),
('454', '452', '4', 'Masculino', '4512', '2019-02-12', 'ja@gmail.com', '2019-02-20', '2019-02-21', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `nit` varchar(100) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `administrador` varchar(120) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `barrio` varchar(100) NOT NULL,
  `ciudad` varchar(120) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `redessociales` varchar(80) DEFAULT NULL,
  `foto` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`nit`, `nombre`, `administrador`, `direccion`, `barrio`, `ciudad`, `telefono`, `celular`, `redessociales`, `foto`) VALUES
('123', 'LA CASITA DEL CUY', 'Danny Bastidas', 'Calle 21a No. 4-79, B', 'El Ejido', 'San Juan de Pasto', '7202020', '3005251022', 'lacasitadelcuy@gmail.com', 'foto/123fodfg.gif');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `idevento` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(350) DEFAULT NULL,
  `foto` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`idevento`, `nombre`, `descripcion`, `foto`) VALUES
(1, 'Bodas', 'El mejor salon para tu boda\r\n ', 'foto/1evento_sociales_bodas.jpg'),
(2, 'Recreativos', 'El mejor evento para hacer recreacion\r\n        ', 'foto/2eventos_recreacional3.png'),
(3, 'Empresariales', 'Para reunion empresaria encontraras la casita del cuy el mejor salon\r\n ', 'foto/eventos-educativos1.jpg'),
(4, 'Graduacion', ' El salon esta disponible para tu graduacion Disfrutalo!!\r\n', 'foto/slinder5.jpg'),
(5, '15 AÑOS', 'El mejor salon para tus 15 años          ', 'foto/5fondo5.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idfactura` bigint(20) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL,
  `identificacioncliente` varchar(35) DEFAULT NULL,
  `cambio` int(11) DEFAULT NULL,
  `empresa` varchar(100) NOT NULL,
  `descuento` int(11) DEFAULT NULL,
  `pago` int(11) DEFAULT NULL,
  `totalfactura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idfactura`, `fecha`, `identificacioncliente`, `cambio`, `empresa`, `descuento`, `pago`, `totalfactura`) VALUES
(554, '2018-12-06 03:26:57', NULL, NULL, '123', NULL, NULL, NULL),
(555, '2018-12-06 05:49:19', NULL, NULL, '123', NULL, NULL, NULL),
(556, '2018-12-06 05:51:27', '100', NULL, '123', NULL, NULL, NULL),
(557, '2018-12-06 05:53:35', '101', NULL, '123', NULL, NULL, NULL),
(558, '2018-12-06 05:56:04', '1002', NULL, '123', NULL, NULL, NULL),
(559, '2018-12-06 05:57:41', '1003', NULL, '123', NULL, NULL, NULL),
(560, '2018-12-06 05:59:52', '1004', NULL, '123', NULL, NULL, NULL),
(561, '2018-12-06 06:01:44', '10020', NULL, '123', NULL, NULL, NULL),
(562, '2018-12-06 06:03:02', '1021', NULL, '123', NULL, NULL, NULL),
(563, '2018-12-06 06:04:22', '1021', NULL, '123', NULL, NULL, NULL),
(564, '2018-12-06 06:05:17', '1022', NULL, '123', NULL, NULL, NULL),
(565, '2018-12-06 06:05:34', NULL, NULL, '123', NULL, NULL, NULL),
(566, '2018-12-06 11:13:39', NULL, NULL, '123', NULL, NULL, NULL),
(567, '2018-12-09 17:28:42', NULL, NULL, '123', NULL, NULL, NULL),
(568, '2018-12-09 17:28:50', NULL, NULL, '123', NULL, NULL, NULL),
(569, '2018-12-09 17:28:51', NULL, NULL, '123', NULL, NULL, NULL),
(570, '2018-12-09 17:28:52', NULL, NULL, '123', NULL, NULL, NULL),
(571, '2018-12-09 17:28:59', NULL, NULL, '123', NULL, NULL, NULL),
(572, '2018-12-09 19:17:09', NULL, NULL, '123', NULL, NULL, NULL),
(573, '2018-12-10 17:32:10', NULL, NULL, '123', NULL, NULL, NULL),
(574, '2018-12-10 17:33:50', NULL, NULL, '123', NULL, NULL, NULL),
(575, '2018-12-10 22:09:30', NULL, NULL, '123', NULL, NULL, NULL),
(576, '2018-12-10 22:14:14', NULL, NULL, '123', NULL, NULL, NULL),
(577, '2018-12-10 22:14:32', NULL, NULL, '123', NULL, NULL, NULL),
(578, '2018-12-11 07:11:49', NULL, NULL, '123', NULL, NULL, NULL),
(579, '2018-12-11 07:16:14', NULL, NULL, '123', NULL, NULL, NULL),
(580, '2018-12-11 10:14:46', NULL, NULL, '123', NULL, NULL, NULL),
(581, '2018-12-11 11:56:43', '100', NULL, '123', NULL, NULL, NULL),
(582, '2018-12-11 11:58:06', '100', NULL, '123', NULL, NULL, NULL),
(583, '2018-12-12 01:04:58', NULL, NULL, '123', NULL, NULL, NULL),
(584, '2018-12-12 08:18:15', NULL, NULL, '123', NULL, NULL, NULL),
(585, '2018-12-13 22:12:25', NULL, NULL, '123', NULL, NULL, NULL),
(586, '2019-02-06 15:15:16', NULL, NULL, '123', NULL, NULL, NULL),
(587, '2019-02-27 00:22:42', '100', NULL, '123', NULL, NULL, NULL),
(588, '2019-02-27 00:32:15', '789563', NULL, '123', NULL, NULL, NULL),
(589, '2019-02-27 00:34:23', '7875656', NULL, '123', NULL, NULL, NULL),
(590, '2019-02-27 00:37:00', '123456123', NULL, '123', NULL, NULL, NULL),
(591, '2019-02-27 00:44:27', '123456123', NULL, '123', NULL, NULL, NULL),
(592, '2019-02-27 00:44:38', '123456123', NULL, '123', NULL, NULL, NULL),
(593, '2019-02-27 00:44:41', '123456123', NULL, '123', NULL, NULL, NULL),
(594, '2019-02-27 01:09:23', '19546', NULL, '123', NULL, NULL, NULL),
(595, '2019-02-27 01:11:17', '19546', NULL, '123', NULL, NULL, NULL),
(596, '2019-02-27 01:12:26', '456465', NULL, '123', NULL, NULL, NULL),
(598, '2019-02-27 01:29:34', '45645', NULL, '123', NULL, NULL, NULL),
(599, '2019-02-27 01:36:54', '4564562', NULL, '123', NULL, NULL, NULL),
(601, '2019-02-27 01:48:35', '46512', NULL, '123', NULL, NULL, NULL),
(602, '2019-02-27 16:16:37', '14546749845', NULL, '123', NULL, NULL, NULL),
(603, '2019-02-27 16:44:11', NULL, NULL, '123', NULL, NULL, NULL),
(604, '2019-02-27 16:54:38', NULL, NULL, '123', NULL, NULL, NULL),
(605, '2019-02-27 16:57:34', NULL, NULL, '123', NULL, NULL, NULL),
(606, '2019-02-27 16:59:11', NULL, NULL, '123', NULL, NULL, NULL),
(607, '2019-02-27 16:59:24', NULL, NULL, '123', NULL, NULL, NULL),
(608, '2019-02-27 16:59:26', NULL, NULL, '123', NULL, NULL, NULL),
(609, '2019-02-27 16:59:28', NULL, NULL, '123', NULL, NULL, NULL),
(610, '2019-02-27 16:59:30', NULL, NULL, '123', NULL, NULL, NULL),
(611, '2019-02-27 17:00:15', NULL, NULL, '123', NULL, NULL, NULL),
(612, '2019-02-27 17:00:43', NULL, NULL, '123', NULL, NULL, NULL),
(613, '2019-02-27 17:03:06', NULL, NULL, '123', NULL, NULL, NULL),
(614, '2019-02-27 17:51:51', NULL, NULL, '123', NULL, NULL, NULL),
(615, '2019-02-27 17:57:50', NULL, NULL, '123', NULL, NULL, NULL),
(616, '2019-02-27 17:58:58', NULL, NULL, '123', NULL, NULL, NULL),
(617, '2019-02-27 17:59:37', NULL, NULL, '123', NULL, NULL, NULL),
(618, '2019-02-27 17:59:39', NULL, NULL, '123', NULL, NULL, NULL),
(619, '2019-02-27 17:59:56', NULL, NULL, '123', NULL, NULL, NULL),
(620, '2019-02-27 18:00:40', NULL, NULL, '123', NULL, NULL, NULL),
(621, '2019-02-27 18:03:31', NULL, NULL, '123', NULL, NULL, NULL),
(622, '2019-02-27 18:03:36', NULL, NULL, '123', NULL, NULL, NULL),
(623, '2019-02-27 18:09:19', NULL, NULL, '123', NULL, NULL, NULL),
(624, '2019-02-27 18:12:09', NULL, NULL, '123', NULL, NULL, NULL),
(625, '2019-02-27 18:12:59', NULL, NULL, '123', NULL, NULL, NULL),
(626, '2019-02-27 18:13:47', NULL, NULL, '123', NULL, NULL, NULL),
(627, '2019-02-27 18:14:50', NULL, NULL, '123', NULL, NULL, NULL),
(628, '2019-02-27 18:18:49', NULL, NULL, '123', NULL, NULL, NULL),
(629, '2019-02-27 18:18:51', NULL, NULL, '123', NULL, NULL, NULL),
(630, '2019-02-27 18:19:23', NULL, NULL, '123', NULL, NULL, NULL),
(631, '2019-02-27 18:19:51', NULL, NULL, '123', NULL, NULL, NULL),
(632, '2019-02-27 18:21:49', NULL, NULL, '123', NULL, NULL, NULL),
(633, '2019-02-27 18:21:58', NULL, NULL, '123', NULL, NULL, NULL),
(634, '2019-02-27 18:22:00', NULL, NULL, '123', NULL, NULL, NULL),
(635, '2019-02-27 18:24:28', NULL, NULL, '123', NULL, NULL, NULL),
(636, '2019-02-27 18:25:47', NULL, NULL, '123', NULL, NULL, NULL),
(637, '2019-02-27 19:29:45', NULL, NULL, '123', NULL, NULL, NULL),
(638, '2019-02-27 19:31:43', NULL, NULL, '123', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto`
--

CREATE TABLE `gasto` (
  `idgastos` bigint(20) UNSIGNED NOT NULL,
  `valor` int(11) NOT NULL,
  `descripcion` varchar(350) NOT NULL,
  `caja` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gasto`
--

INSERT INTO `gasto` (`idgastos`, `valor`, `descripcion`, `caja`) VALUES
(1, 50000, 'servicios', 55),
(2, 5000, 'Jabon losa', 60),
(3, 456, 'nada d bueno', 74);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `idmenu` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idmenu`, `nombre`) VALUES
(68, 'Bandejas'),
(2, 'Desayunos'),
(3, 'Frito Pastuso'),
(58, 'Almuerzos'),
(66, 'Cuy'),
(69, 'Comida de mar'),
(70, 'Jugos'),
(71, 'Gaseosas'),
(74, 'Platos a la carta'),
(75, 'Sancocho de Gallina'),
(82, 'Bebidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `idmesa` bigint(20) UNSIGNED NOT NULL,
  `area` varchar(25) NOT NULL,
  `color` varchar(8) DEFAULT NULL,
  `mesainicial` int(11) NOT NULL,
  `piso` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`idmesa`, `area`, `color`, `mesainicial`, `piso`) VALUES
(28, 'A', '#ff8000', 1, '1'),
(29, ' A', '#ff8000', 2, '1'),
(30, ' A', '#ff8000', 3, '1'),
(31, ' A', '#ff8000', 4, '1'),
(32, ' A', '#ff8000', 5, '1'),
(33, ' A', '#ff8000', 6, '1'),
(34, ' A', '#ff8000', 7, '1'),
(35, ' A', '#ff8000', 8, '1'),
(36, ' A', '#ff8000', 9, '1'),
(37, ' A', '#ff8000', 10, '1'),
(38, ' D', '#00ff00', 11, '2'),
(39, ' D', '#00ff00', 12, '2'),
(40, ' D', '#00ff00', 13, '2'),
(41, ' D', '#00ff00', 14, '2'),
(42, ' D', '#00ff00', 15, '2'),
(43, ' D', '#00ff00', 16, '2'),
(44, ' D', '#00ff00', 17, '2'),
(45, ' D', '#00ff00', 18, '2'),
(46, ' D', '#00ff00', 19, '2'),
(47, ' D', '#00ff00', 20, '2'),
(48, ' D', '#00ff00', 21, '2'),
(49, ' D', '#00ff00', 22, '2'),
(50, ' D', '#00ff00', 23, '2'),
(51, ' D', '#00ff00', 24, '2'),
(52, ' D', '#00ff00', 25, '2'),
(60, 'E', '#80ffff', 30, '2'),
(61, 'E', '#80ffff', 31, '2'),
(62, 'E', '#80ffff', 32, '2'),
(63, 'E', '#80ffff', 33, '2'),
(64, 'E', '#80ffff', 34, '2'),
(65, 'E', '#80ffff', 35, '2'),
(66, 'cc', '#8080ff', 40, '4'),
(67, 'cc', '#8080ff', 41, '4'),
(68, 'cc', '#8080ff', 42, '4'),
(69, 'cc', '#8080ff', 43, '4'),
(70, 'cc', '#8080ff', 44, '4'),
(71, 'cc', '#8080ff', 45, '4'),
(72, 'pruebA', '#ff0000', 46, '2'),
(73, 'pruebA', '#ff6666', 47, '2'),
(74, 'pruebA', '#ff6666', 48, '2'),
(75, 'pruebA', '#ff6666', 49, '2'),
(76, 'pruebA', '#ff6666', 50, '2'),
(77, 'RPER', '#2E9AFE', 100, '5'),
(78, 'RPER', '#2E9AFE', 101, '5'),
(79, 'RPER', '#2E9AFE', 102, '5'),
(80, 'RPER', '#2E9AFE', 103, '5'),
(81, 'RPER', '#2E9AFE', 104, '5'),
(82, 'RPER', '#2E9AFE', 105, '5'),
(83, 'RPER', '#2E9AFE', 106, '5'),
(84, 'RPER', '#2E9AFE', 107, '5'),
(85, 'RPER', '#2E9AFE', 108, '5'),
(86, 'RPER', '#2E9AFE', 109, '5'),
(87, 'RPER', '#2E9AFE', 110, '5'),
(88, 'RPER', '#2E9AFE', 111, '5'),
(89, 'RPER', '#2E9AFE', 112, '5'),
(90, 'RPER', '#FE2E2E', 113, '5'),
(91, 'RPER', '#FE2E2E', 114, '5'),
(92, 'RPER', '#FE2E2E', 115, '5'),
(93, 'RPER', '#FE2E2E', 116, '5'),
(94, 'RPER', '#FE2E2E', 117, '5'),
(95, 'RPER', '#FE2E2E', 118, '5'),
(96, 'RPER', '#FE2E2E', 119, '5'),
(97, 'RPER', '#FE2E2E', 120, '5'),
(98, 'RPER', '#FE2E2E', 121, '5'),
(99, 'RPER', '#FE2E2E', 122, '5'),
(100, 'RPER', '#FE2E2E', 123, '5'),
(101, '#FE2E2E', '#ff0000', 124, '5'),
(102, 'RPER', '#FE2E2E', 125, '5'),
(103, 'RPER', '#FE2E2E', 126, '5'),
(104, 'RPER', '#FE2E2E', 127, '5'),
(105, 'RPER', '#FE2E2E', 128, '5'),
(106, 'RPER', '#FE2E2E', 129, '5'),
(107, 'RPER', '#D7DF01', 130, '5'),
(108, 'RPER', '#D7DF01', 131, '5'),
(109, 'RPER', '#D7DF01', 132, '5'),
(110, 'pp', '#00ffff', 132, '1'),
(111, 'pp', '#00ffff', 133, '1'),
(112, 'pp', '#00ffff', 135, '1'),
(113, 'pp', '#00ffff', 136, '1'),
(114, 'pp', '#00ffff', 137, '1'),
(115, 'pp', '#00ffff', 138, '1'),
(116, 'pp', '#00ffff', 139, '1'),
(117, 'pp', '#00ffff', 140, '1'),
(118, 'pp', '#00ffff', 141, '1'),
(119, 'pp', '#00ffff', 142, '1'),
(120, 'pp', '#00ffff', 143, '1'),
(121, 'pp', '#00ffff', 144, '1'),
(122, 'pp', '#00ffff', 145, '1'),
(123, 'AA', '#ff0080', 200, '1'),
(124, 'AA', '#ff0080', 201, '1'),
(125, 'AA', '#ff0080', 202, '1'),
(126, 'AA', '#ff0080', 203, '1'),
(127, 'AA', '#ff0080', 204, '1'),
(128, 'AA', '#ff0080', 205, '1'),
(129, 'AA', '#ff0080', 206, '1'),
(130, 'AA', '#ff0080', 207, '1'),
(131, 'AA', '#ff0080', 208, '1'),
(132, 'AA', '#ff0080', 209, '1'),
(133, 'AA', '#ff0080', 210, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `idpago` bigint(20) UNSIGNED NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `valor` int(11) NOT NULL,
  `prestamo` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`idpago`, `fecha`, `valor`, `prestamo`) VALUES
(20, '2018-10-31 03:53:14', 6, 21),
(21, '2018-10-31 03:53:18', 6, 21),
(23, '2018-12-04 22:54:24', 456, 22),
(24, '2018-12-05 03:13:34', 12500, 24),
(25, '2018-12-05 03:13:52', 4500, 24),
(26, '2019-02-09 01:27:29', 200000, 25),
(27, '2019-02-09 01:29:33', 100000, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagoempleado`
--

CREATE TABLE `pagoempleado` (
  `idpagoempleado` bigint(20) UNSIGNED NOT NULL,
  `idempleado` varchar(35) NOT NULL,
  `horasextras` int(11) DEFAULT NULL,
  `auxiliotrasporte` int(11) DEFAULT NULL,
  `descuentosalud` int(11) DEFAULT NULL,
  `descuentopencion` int(11) DEFAULT NULL,
  `fechainicio` date NOT NULL,
  `fechafin` date NOT NULL,
  `sueldo` int(11) DEFAULT NULL,
  `fechasistema` datetime NOT NULL,
  `riesgolaboral` int(11) NOT NULL,
  `valorhoraextra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagoempleado`
--

INSERT INTO `pagoempleado` (`idpagoempleado`, `idempleado`, `horasextras`, `auxiliotrasporte`, `descuentosalud`, `descuentopencion`, `fechainicio`, `fechafin`, `sueldo`, `fechasistema`, `riesgolaboral`, `valorhoraextra`) VALUES
(1, '100', 5, 25000, 20000, 12000, '2018-12-05', '2019-01-05', 4495500, '2018-12-04 20:52:42', 15000, 3500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plato`
--

CREATE TABLE `plato` (
  `idplato` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `valor` int(11) NOT NULL,
  `tiempopreparacion` int(11) DEFAULT NULL,
  `menu` bigint(20) DEFAULT NULL,
  `tipo` varchar(1) NOT NULL,
  `foto` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plato`
--

INSERT INTO `plato` (`idplato`, `nombre`, `descripcion`, `valor`, `tiempopreparacion`, `menu`, `tipo`, `foto`) VALUES
('001', 'Medio cuy', 'El mejor cuy lo encuentras aqui en la casita del cuy\r\n', 21474, 21, 66, 'P', 'foto/cuyasado.jpg'),
('002', 'Bandeja Paisa', 'La mejor bandeja paisa que encontraras en san juan de pasto', 12000, 10, 68, 'P', 'foto/bandeja-paisa.jpg'),
('003', 'Sancocho de Gallina', 'El mejor sancocho preparado por los mejores chefs', 8000, 10, 58, 'P', 'foto/almuerzo.jpg'),
('004', 'Pollo Entero', 'El mejor pollo para su mesa para su paladar', 18000, 12, 68, 'P', 'foto/pollo.jpg'),
('005', 'Frito Pastuso', 'El mejor frito de todo nariño', 15000, 10, 3, 'P', 'foto/mediofrito.jpg'),
('006', 'Cuy entero', 'EL mejor cuy preparado en la casita del cuy', 40000, 40, 66, 'P', 'foto/cuyentero.jpg'),
('007', 'Pescado Entero', 'EL mejor pescado ', 15000, 10, 69, 'P', 'foto/pescado.jpg'),
('008', 'Jugos Naturales', 'Preparados de los mejores cheft', 5000, 5, 70, 'P', 'foto/jugos naturales.jpg'),
('009', 'Gaseosas', 'Gran variedad de gaseosas en la casita del cuy', 3500, 2, 71, 'P', 'foto/gaseosa.jpg'),
('010', 'Malteada', 'Rica y deliciosa Malteada', 4500, 5, 70, 'P', 'foto/malteada.png'),
('011', 'Lomo de Cerdo', 'El mejor lomo de cerdo esta en la casita del cuy', 12000, 10, 2, 'P', 'foto/lomo de cerdo.jpg'),
('012', 'Sopa de Mariscos', 'los maricos en sopa una delicia', 12000, 10, 69, 'P', 'foto/sopamariscos.jpg'),
('013', 'Mariscos Fritos', 'En el mejor plato encuentras los mariscos', 12000, 10, 69, 'P', 'foto/mariscos fritos.jpg'),
('014', 'Arroz con pollo', 'Buena porción de pollo, papa frita y ensalada', 13000, 10, 74, 'P', 'foto/arroz con pollo.jpg'),
('015', 'Crispetas de pollo', 'pollo apanado y porción grande de papa frita.', 10000, 10, 74, 'P', 'foto/crispetas de pollo.jpg'),
('016', 'Salchipapa Grande', 'asda', 97865, 10, 74, 'P', 'foto/salchipapagrande.JPG'),
('017', 'Salchipapa Pequeña', 'salchipapa pequeña', 5500, 10, 74, 'P', 'foto/salchipapagrande.JPG'),
('456465', 'frutas', 'nada', 546, 456, 74, 'P', 'foto/INDEX.jpg'),
('556', 'luces y bailes', 'El mejor baile en la casita de cuy la encontraras', 11500, NULL, NULL, 'S', 'foto/eventos-sociales-3.jpg'),
('560', 'pastel', 'el mejor pastel en la casita del cuy\r\n', 85000, NULL, NULL, 'S', 'foto/eventos_ponque.png'),
('561', 'Silla Vestidas', 'viste tus sillas para tus eventos', 45, NULL, NULL, 'S', 'foto/eventos_decoracion2.jpg'),
('562', 'Gramilla', 'la mejor gramilla ', 45000, NULL, NULL, 'S', 'foto/salonalcala2.jpg'),
('563', 'Champaña', 'champaña para tu reserva o evento lo pordras tener', 8000, NULL, NULL, 'S', 'foto/eventos-sociales-1.jpg'),
('564', 'chef', 'El mejor chef a tu servicio', 3250000, NULL, NULL, 'S', 'foto/chef.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `idprestamo` bigint(20) UNSIGNED NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `valor` int(11) NOT NULL,
  `interes` int(11) NOT NULL,
  `idempleado` varchar(35) NOT NULL,
  `cuota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`idprestamo`, `fecha`, `valor`, `interes`, `idempleado`, `cuota`) VALUES
(21, '2018-10-31 03:52:40', 12, 5, '1233194301', 2),
(22, '2018-12-04 21:56:28', 50000, 20, '100', 10),
(23, '2018-12-04 22:17:11', 1000000, 5, '1233194301', 10),
(24, '2018-12-04 22:21:19', 350000, 2, '100', 5),
(25, '2019-02-09 01:24:49', 1000000, 2, '1085282140', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `idreserva` bigint(20) UNSIGNED NOT NULL,
  `idplato` varchar(35) DEFAULT NULL,
  `evento` bigint(20) UNSIGNED DEFAULT NULL,
  `fechasistema` datetime NOT NULL,
  `fechareserva` datetime NOT NULL,
  `numeropersona` int(11) NOT NULL,
  `abono` int(11) DEFAULT NULL,
  `direccion` varchar(80) NOT NULL,
  `observacion` varchar(350) DEFAULT NULL,
  `identificacioncliente` varchar(35) NOT NULL,
  `piso` varchar(2) DEFAULT NULL,
  `barrio` char(30) DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idreserva`, `idplato`, `evento`, `fechasistema`, `fechareserva`, `numeropersona`, `abono`, `direccion`, `observacion`, `identificacioncliente`, `piso`, `barrio`, `hora`) VALUES
(41, NULL, NULL, '2018-12-06 05:51:27', '2018-12-07 00:00:00', 10, 0, 'Mz O casa 18', '.', '100', '1', 'San carlos', '12:56:00'),
(42, NULL, NULL, '2018-12-06 05:53:35', '2018-12-19 00:00:00', 4, 0, 'Mz O casa 18', '.', '101', '1', 'San carlos', '16:56:00'),
(43, NULL, NULL, '2018-12-06 05:56:04', '2018-12-20 00:00:00', 8, 20000, 'calle 13 -56', '.', '1002', '1', 'San carlos', '17:00:00'),
(44, NULL, NULL, '2018-12-06 05:57:40', '2018-12-20 00:00:00', 10, 0, 'Mz O casa 18', '.', '1003', '1', 'San carlos', '03:05:00'),
(45, NULL, NULL, '2018-12-06 05:59:52', '2018-12-28 00:00:00', 20, 100000, 'calle 18-26', '0', '1004', '2', 'las lunas', '12:56:00'),
(46, NULL, NULL, '2018-12-11 11:58:06', '2018-12-10 00:00:00', 10, 0, 'San Juan de Past', '.', '100', '1', 'san carlos', '16:25:00'),
(47, NULL, NULL, '2019-02-27 00:22:42', '2019-03-10 00:00:00', 14, 12000, 'CASA 97B', '.', '100', '2', 'JONGOVITO', '00:56:00'),
(48, NULL, NULL, '2019-02-27 00:32:15', '2019-03-10 00:00:00', 20, 0, 'Manzana O casa 18', 'listo', '789563', '2', 'San carlos', '00:56:00'),
(49, NULL, NULL, '2019-02-27 00:34:23', '2019-03-10 00:00:00', 20, 0, 'Manzana O casa 18', 'listo', '7875656', '2', 'San carlos', '00:56:00'),
(50, NULL, NULL, '2019-02-27 00:37:00', '2019-03-10 00:00:00', 20, 0, 'Manzana O casa 18', 'LISTO', '123456123', '2', 'San carlos', '00:56:00'),
(51, NULL, NULL, '2019-02-27 00:44:26', '2019-03-10 00:00:00', 20, 0, 'Manzana O casa 18', 'LISTO', '123456123', '2', 'San carlos', '00:56:00'),
(52, NULL, NULL, '2019-02-27 00:44:38', '2019-03-10 00:00:00', 20, 0, 'Manzana O casa 18', 'LISTO', '123456123', '2', 'San carlos', '00:56:00'),
(53, NULL, NULL, '2019-02-27 00:44:41', '2019-03-10 00:00:00', 20, 0, 'Manzana O casa 18', 'LISTO', '123456123', '2', 'San carlos', '00:56:00'),
(54, NULL, NULL, '2019-02-27 01:09:23', '2019-03-10 00:00:00', 20, 0, 'Manzana O casa 18', '.', '19546', '2', 'San carlos', '00:56:00'),
(55, NULL, NULL, '2019-02-27 01:11:14', '2019-03-10 00:00:00', 20, 0, 'Manzana O casa 18', '.', '19546', '2', 'San carlos', '00:56:00'),
(56, NULL, NULL, '2019-02-27 01:12:26', '2019-03-20 00:00:00', 30, 0, 'Manzana O casa 18', '.', '456465', '2', 'San carlos', '14:00:00'),
(57, '556', 4, '2019-02-27 01:29:34', '2019-03-10 00:00:00', 10, 0, 'Manzana O casa 18', '.', '45645', '2', 'San carlos', '00:56:00'),
(58, '556', 1, '2019-02-27 01:48:35', '2019-02-21 00:00:00', 40, 150000, 'Manzana O casa 18', '0', '46512', '2', 'San carlos', '00:56:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(25) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `empleado` varchar(35) DEFAULT NULL,
  `rol` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `clave`, `empleado`, `rol`) VALUES
('admin', '123', '1233194301', 'admin'),
('cajero', '123', '1085282140', 'cajero'),
('cocina', '123', '27456350', 'cocina'),
('mesero', '123', '123', 'mesero'),
('sara', '456', '27456350', 'cocina');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adelanto`
--
ALTER TABLE `adelanto`
  ADD PRIMARY KEY (`idadelanto`),
  ADD UNIQUE KEY `idadelanto` (`idadelanto`),
  ADD KEY `idempleado` (`idempleado`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`idcaja`),
  ADD UNIQUE KEY `idcaja` (`idcaja`),
  ADD KEY `gasto` (`gasto`),
  ADD KEY `usuariocaja` (`usuariocaja`),
  ADD KEY `usuariocaja_2` (`usuariocaja`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`idcargo`),
  ADD UNIQUE KEY `id` (`idcargo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`identificacion`);

--
-- Indices de la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`idcomanda`),
  ADD UNIQUE KEY `idcomanda` (`idcomanda`),
  ADD KEY `reserva` (`reserva`),
  ADD KEY `factura` (`factura`),
  ADD KEY `mesa` (`mesa`),
  ADD KEY `idempleado` (`idempleado`),
  ADD KEY `caja` (`caja`),
  ADD KEY `domicilio` (`domicilio`);

--
-- Indices de la tabla `detalleorden`
--
ALTER TABLE `detalleorden`
  ADD PRIMARY KEY (`iddetalle`),
  ADD UNIQUE KEY `iddetalle` (`iddetalle`),
  ADD UNIQUE KEY `iddetalle_2` (`iddetalle`),
  ADD KEY `domicilio` (`domicilio`),
  ADD KEY `reservas` (`reserva`),
  ADD KEY `comanda` (`comanda`),
  ADD KEY `plato` (`plato`);

--
-- Indices de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD PRIMARY KEY (`iddomicilio`),
  ADD UNIQUE KEY `iddomicilio` (`iddomicilio`),
  ADD KEY `identificacioncliente` (`identificacioncliente`),
  ADD KEY `idplato` (`idplato`),
  ADD KEY `idplato_2` (`idplato`),
  ADD KEY `idplato_3` (`idplato`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`identificacion`),
  ADD KEY `cargo` (`cargo`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idevento`),
  ADD UNIQUE KEY `idevento` (`idevento`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfactura`),
  ADD UNIQUE KEY `idfactura` (`idfactura`),
  ADD KEY `empresa` (`empresa`),
  ADD KEY `clienteidentificacion` (`identificacioncliente`);

--
-- Indices de la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD PRIMARY KEY (`idgastos`),
  ADD UNIQUE KEY `idgastos` (`idgastos`),
  ADD KEY `caja` (`caja`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD UNIQUE KEY `idmenu` (`idmenu`),
  ADD KEY `idmenu_2` (`idmenu`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`idmesa`),
  ADD UNIQUE KEY `idmesa` (`idmesa`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idpago`),
  ADD UNIQUE KEY `idpago` (`idpago`),
  ADD KEY `prestamo` (`prestamo`);

--
-- Indices de la tabla `pagoempleado`
--
ALTER TABLE `pagoempleado`
  ADD PRIMARY KEY (`idpagoempleado`),
  ADD UNIQUE KEY `idpagoempleado` (`idpagoempleado`),
  ADD KEY `idempleado` (`idempleado`);

--
-- Indices de la tabla `plato`
--
ALTER TABLE `plato`
  ADD PRIMARY KEY (`idplato`),
  ADD KEY `menu1` (`menu`),
  ADD KEY `menu` (`menu`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`idprestamo`),
  ADD UNIQUE KEY `idprestamo` (`idprestamo`),
  ADD KEY `idempleado` (`idempleado`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idreserva`),
  ADD UNIQUE KEY `idreserva` (`idreserva`),
  ADD KEY `identificacioncliente` (`identificacioncliente`),
  ADD KEY `evento` (`evento`),
  ADD KEY `idplato` (`idplato`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`),
  ADD KEY `empleado` (`empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adelanto`
--
ALTER TABLE `adelanto`
  MODIFY `idadelanto` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `idcaja` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `idcargo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `comanda`
--
ALTER TABLE `comanda`
  MODIFY `idcomanda` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=585;

--
-- AUTO_INCREMENT de la tabla `detalleorden`
--
ALTER TABLE `detalleorden`
  MODIFY `iddetalle` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;

--
-- AUTO_INCREMENT de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  MODIFY `iddomicilio` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `idevento` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idfactura` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=639;

--
-- AUTO_INCREMENT de la tabla `gasto`
--
ALTER TABLE `gasto`
  MODIFY `idgastos` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `idmesa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `idpago` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `pagoempleado`
--
ALTER TABLE `pagoempleado`
  MODIFY `idpagoempleado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `idprestamo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idreserva` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adelanto`
--
ALTER TABLE `adelanto`
  ADD CONSTRAINT `adelanto_ibfk_1` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD CONSTRAINT `comanda_ibfk_1` FOREIGN KEY (`factura`) REFERENCES `factura` (`idfactura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comanda_ibfk_2` FOREIGN KEY (`reserva`) REFERENCES `reserva` (`idreserva`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comanda_ibfk_3` FOREIGN KEY (`mesa`) REFERENCES `mesa` (`idmesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comanda_ibfk_4` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comanda_ibfk_5` FOREIGN KEY (`caja`) REFERENCES `caja` (`idcaja`),
  ADD CONSTRAINT `comanda_ibfk_6` FOREIGN KEY (`domicilio`) REFERENCES `domicilio` (`iddomicilio`);

--
-- Filtros para la tabla `detalleorden`
--
ALTER TABLE `detalleorden`
  ADD CONSTRAINT `detalleorden_ibfk_2` FOREIGN KEY (`reserva`) REFERENCES `reserva` (`idreserva`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleorden_ibfk_3` FOREIGN KEY (`domicilio`) REFERENCES `domicilio` (`iddomicilio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleorden_ibfk_4` FOREIGN KEY (`comanda`) REFERENCES `comanda` (`idcomanda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleorden_ibfk_5` FOREIGN KEY (`plato`) REFERENCES `plato` (`idplato`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD CONSTRAINT `domicilio_ibfk_2` FOREIGN KEY (`identificacioncliente`) REFERENCES `cliente` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `domicilio_ibfk_3` FOREIGN KEY (`idplato`) REFERENCES `plato` (`idplato`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`idcargo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`identificacioncliente`) REFERENCES `cliente` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`nit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD CONSTRAINT `gasto_ibfk_1` FOREIGN KEY (`caja`) REFERENCES `caja` (`idcaja`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`prestamo`) REFERENCES `prestamo` (`idprestamo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagoempleado`
--
ALTER TABLE `pagoempleado`
  ADD CONSTRAINT `pagoempleado_ibfk_1` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`evento`) REFERENCES `evento` (`idevento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`idplato`) REFERENCES `plato` (`idplato`),
  ADD CONSTRAINT `reserva_ibfk_4` FOREIGN KEY (`identificacioncliente`) REFERENCES `cliente` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`empleado`) REFERENCES `empleado` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
