-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-06-2014 a las 17:44:07
-- Versión del servidor: 5.5.37
-- Versión de PHP: 5.4.4-14+deb7u11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `singular`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE IF NOT EXISTS `almacen` (
  `idAlmacen` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `idParent` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAlmacen`),
  KEY `fk_almacen_almacen1` (`idParent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`idAlmacen`, `nombre`, `idParent`) VALUES
(1, 'Deposito Central', NULL),
(2, 'Tienda', 1),
(3, 'CTP', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenProducto`
--

CREATE TABLE IF NOT EXISTS `almacenProducto` (
  `idAlmacenProducto` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) DEFAULT NULL,
  `stockU` int(11) DEFAULT NULL,
  `stockP` int(11) DEFAULT NULL,
  `idAlmacen` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAlmacenProducto`),
  KEY `fk_almacenProducto_producto1` (`idProducto`),
  KEY `fk_almacenProducto_almacen1` (`idAlmacen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=547 ;

--
-- Volcado de datos para la tabla `almacenProducto`
--

INSERT INTO `almacenProducto` (`idAlmacenProducto`, `idProducto`, `stockU`, `stockP`, `idAlmacen`) VALUES
(1, 1, 1, 0, 1),
(3, 2, 0, 0, 1),
(4, 3, 0, 0, 1),
(5, 4, 0, 50, 1),
(6, 5, 0, 0, 1),
(7, 6, 0, 0, 1),
(8, 7, 0, 15, 1),
(9, 8, 0, 5, 1),
(10, 9, 0, 1, 1),
(11, 10, 0, 11, 1),
(12, 11, 1, 0, 1),
(13, 12, 0, 0, 1),
(14, 13, 0, 0, 1),
(15, 14, 0, 0, 1),
(16, 15, 0, 5, 1),
(17, 16, 0, 0, 1),
(18, 17, 0, 23, 1),
(19, 18, 0, 5, 1),
(20, 19, 0, 0, 1),
(21, 20, 0, 11, 1),
(22, 21, 0, 49, 1),
(24, 23, 0, 0, 1),
(25, 24, 0, 0, 1),
(26, 25, 0, 5, 1),
(27, 26, 0, 7, 1),
(28, 27, 0, 3, 1),
(29, 28, 10, 0, 1),
(30, 29, 0, 10, 1),
(31, 30, 0, 4, 1),
(32, 31, 0, 17, 1),
(33, 32, 0, 0, 1),
(34, 33, 0, 0, 1),
(35, 34, 0, 0, 1),
(36, 35, 0, 10, 1),
(37, 36, 0, 10, 1),
(38, 37, 0, 10, 1),
(39, 38, 0, 10, 1),
(40, 39, 0, 4, 1),
(41, 40, 0, 18, 1),
(42, 41, 0, 0, 1),
(43, 42, 0, 18, 1),
(44, 43, 0, 21, 1),
(45, 44, 0, 12, 1),
(46, 45, 0, 10, 1),
(47, 46, 0, 15, 1),
(48, 47, 0, 14, 1),
(49, 48, 0, 4, 1),
(50, 49, 0, 0, 1),
(51, 50, 0, 0, 1),
(52, 51, 0, 0, 1),
(53, 52, 0, 0, 1),
(54, 53, 0, 0, 1),
(55, 54, 0, 0, 1),
(56, 55, 0, 0, 1),
(57, 56, 0, 0, 1),
(58, 57, 0, 0, 1),
(59, 58, 0, 0, 1),
(60, 59, 0, 0, 1),
(61, 60, 0, 0, 1),
(62, 61, 0, 0, 1),
(63, 62, 0, 0, 1),
(64, 63, 0, 0, 1),
(65, 64, 0, 0, 1),
(66, 65, 0, 0, 1),
(67, 66, 0, 0, 1),
(68, 67, 0, 0, 1),
(69, 68, 0, 0, 1),
(70, 69, 0, 0, 1),
(71, 70, 0, 0, 1),
(72, 71, 0, 0, 1),
(73, 72, 0, 0, 1),
(74, 73, 0, 0, 1),
(83, 74, 0, 4, 1),
(84, 75, 0, 0, 1),
(85, 76, 0, 0, 1),
(86, 77, 0, 0, 1),
(87, 78, 0, 0, 1),
(88, 79, 0, 0, 1),
(89, 80, 0, 0, 1),
(90, 81, 0, 0, 1),
(91, 82, 0, 3, 1),
(92, 83, 0, 0, 1),
(93, 84, 0, 0, 1),
(94, 85, 0, 0, 1),
(95, 86, 0, 0, 1),
(96, 87, 0, 0, 1),
(97, 88, 0, 0, 1),
(98, 89, 0, 0, 1),
(99, 90, 0, 0, 1),
(100, 91, 0, 0, 1),
(101, 92, 0, 0, 1),
(102, 93, 0, 0, 1),
(103, 94, 0, 0, 1),
(104, 95, 0, 0, 1),
(105, 96, 0, 0, 1),
(106, 97, 0, 0, 1),
(107, 98, 0, 0, 1),
(108, 99, 0, 0, 1),
(109, 100, 0, 0, 1),
(110, 101, 0, 5, 1),
(111, 102, 0, 0, 1),
(112, 103, 0, 0, 1),
(113, 104, 0, 0, 1),
(114, 105, 0, 0, 1),
(115, 106, 0, 0, 1),
(116, 107, 0, 0, 1),
(117, 108, 0, 0, 1),
(118, 109, 0, 0, 1),
(119, 110, 0, 11, 1),
(120, 111, 0, 0, 1),
(121, 112, 0, 13, 1),
(122, 113, 0, 11, 1),
(123, 114, 0, 11, 1),
(124, 115, 0, 10, 1),
(125, 116, 0, 12, 1),
(435, 1, 0, 0, 2),
(436, 2, 7, 0, 2),
(437, 45, 76, 0, 2),
(438, 47, 53, 0, 2),
(439, 44, 109, 8, 2),
(440, 46, 27, 1, 2),
(441, 48, 32, 3, 2),
(442, 29, 0, 0, 2),
(443, 103, 71, 0, 2),
(444, 31, 40, 3, 2),
(445, 30, 14, 2, 2),
(446, 32, 25, 0, 2),
(447, 109, 4, 0, 2),
(448, 108, 0, 0, 2),
(449, 19, 0, 0, 2),
(450, 18, 32, 0, 2),
(451, 106, 0, 0, 2),
(452, 26, 14, 1, 2),
(453, 28, 0, 0, 2),
(454, 105, 0, 0, 2),
(455, 107, 0, 0, 2),
(458, 27, 39, 0, 2),
(459, 104, 6, 0, 2),
(461, 77, 0, 0, 2),
(464, 4, 190, 3, 2),
(466, 74, 223, 0, 2),
(468, 9, 0, 0, 2),
(469, 79, 0, 0, 2),
(472, 6, 0, 0, 2),
(474, 76, 0, 0, 2),
(476, 3, 0, 0, 2),
(477, 8, 0, 0, 2),
(480, 78, 0, 0, 2),
(481, 5, 0, 0, 2),
(483, 75, 0, 0, 2),
(485, 7, 0, 0, 2),
(488, 85, 0, 0, 2),
(489, 93, 0, 0, 2),
(491, 82, 0, 0, 2),
(499, 90, 0, 0, 2),
(500, 87, 0, 0, 2),
(502, 84, 250, 4, 2),
(503, 92, 0, 0, 2),
(504, 81, 0, 0, 2),
(505, 89, 0, 0, 2),
(506, 86, 0, 0, 2),
(507, 83, 0, 0, 2),
(508, 91, 0, 0, 2),
(509, 10, 0, 0, 2),
(510, 80, 0, 0, 2),
(511, 88, 0, 0, 2),
(512, 101, 0, 0, 2),
(513, 12, 72, 0, 2),
(514, 20, 0, 0, 2),
(515, 98, 0, 0, 2),
(516, 17, 145, 6, 2),
(517, 95, 0, 0, 2),
(518, 14, 0, 0, 2),
(519, 100, 0, 0, 2),
(520, 11, 0, 0, 2),
(521, 97, 0, 0, 2),
(522, 16, 0, 0, 2),
(523, 25, 0, 0, 2),
(524, 94, 12, 0, 2),
(525, 102, 0, 0, 2),
(526, 13, 114, 3, 2),
(527, 21, 184, 0, 2),
(528, 99, 0, 0, 2),
(529, 96, 0, 0, 2),
(530, 15, 0, 0, 2),
(531, 42, 67, 0, 2),
(532, 111, 91, 25, 2),
(533, 39, 25, 4, 2),
(534, 110, 513, 0, 2),
(535, 40, 371, 0, 2),
(536, 114, 88, 2, 2),
(537, 116, 485, 1, 2),
(538, 113, 193, 2, 2),
(539, 115, 88, 2, 2),
(540, 112, 7, 2, 2),
(541, 37, 13, 2, 2),
(542, 36, 120, 2, 2),
(543, 41, 71, 0, 2),
(544, 38, 220, 2, 2),
(545, 35, 465, 1, 2),
(546, 43, 61, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(500) NOT NULL,
  `texto` varchar(1000) NOT NULL,
  `fecha` datetime NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `banner`
--

INSERT INTO `banner` (`id`, `imagen`, `texto`, `fecha`, `order`) VALUES
(1, 'logo.png', '<h1>\r\n	Historia</h1>\r\n<p>\r\n	El 15 de mayo de 2006 se fundo <strong>GRAFICA SINGULAR </strong>en la calle<strong> Juan de la Riva</strong></p>\r\n<p>\r\n	Dise&ntilde;o grafico y publicidad</p>\r\n<p>\r\n	Sistemas de preprensa CTP</p>\r\n', '2014-03-19 16:56:17', 1),
(2, 'Capa3.png', '<h1>\r\n	VALORES</h1>\r\n', '2014-03-11 18:06:57', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE IF NOT EXISTS `caja` (
  `idCaja` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `saldo` double NOT NULL,
  `idParent` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCaja`),
  KEY `fk_caja_caja1` (`idParent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`idCaja`, `nombre`, `saldo`, `idParent`) VALUES
(1, 'administracion', 0, NULL),
(2, 'distribuidora', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajaArqueo`
--

CREATE TABLE IF NOT EXISTS `cajaArqueo` (
  `idCajaVenta` int(11) NOT NULL AUTO_INCREMENT,
  `idCaja` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `monto` double NOT NULL,
  `fechaArqueo` datetime DEFAULT NULL,
  `fechaVentas` datetime DEFAULT NULL,
  `comprobante` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idCajaVenta`),
  KEY `fk_cajaVenta_caja1` (`idCaja`),
  KEY `fk_cajaVenta_user1` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajaMovimientoVenta`
--

CREATE TABLE IF NOT EXISTS `cajaMovimientoVenta` (
  `idCajaMovimientoVenta` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `fechaMovimiento` datetime DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `arqueo` int(11) DEFAULT NULL,
  `idCaja` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCajaMovimientoVenta`),
  KEY `fk_movimientoCaja_user1` (`idUser`),
  KEY `fk_cajaMovimientoVenta_caja1` (`idCaja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nitCi` varchar(20) DEFAULT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nitCi`, `apellido`, `nombre`, `correo`, `fechaRegistro`, `telefono`, `direccion`) VALUES
(1, '00072', 'vargas', NULL, NULL, '2014-06-17 00:00:00', NULL, NULL),
(2, '4852444019', 'mariño', NULL, NULL, '2014-06-17 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleVenta`
--

CREATE TABLE IF NOT EXISTS `detalleVenta` (
  `idDetalleVenta` int(11) NOT NULL AUTO_INCREMENT,
  `idVenta` int(11) DEFAULT NULL,
  `cantidadU` int(11) DEFAULT NULL,
  `costoU` double DEFAULT NULL,
  `cantidadP` int(11) DEFAULT NULL,
  `costoP` double DEFAULT NULL,
  `costoAdicional` double DEFAULT NULL,
  `costoTotal` double DEFAULT NULL,
  `idAlmacenProducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDetalleVenta`),
  KEY `fk_detalleVenta_venta1` (`idVenta`),
  KEY `fk_detalleVenta_almacenProducto1` (`idAlmacenProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `idEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `ci` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idEmpleado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombre`, `apellido`, `fechaRegistro`, `email`, `telefono`, `ci`) VALUES
(1, '', '', NULL, '', '', ''),
(2, 'Helier', 'Cortez', NULL, 'hdnymib@gmail.com', '73221183', '5999242'),
(3, 'Erika', 'Lecoña ', '2014-05-26 15:46:49', '', '', '4846615');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientoAlmacen`
--

CREATE TABLE IF NOT EXISTS `movimientoAlmacen` (
  `idMovimientoAlmacen` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) DEFAULT NULL,
  `idAlmacenOrigen` int(11) DEFAULT NULL,
  `idAlmacenDestino` int(11) DEFAULT NULL,
  `cantidadU` int(11) DEFAULT NULL,
  `cantidadP` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `fechaMovimiento` datetime DEFAULT NULL,
  PRIMARY KEY (`idMovimientoAlmacen`),
  KEY `fk_movimientoAlmacen_producto1` (`idProducto`),
  KEY `fk_movimientoAlmacen_almacen1` (`idAlmacenOrigen`),
  KEY `fk_movimientoAlmacen_almacen2` (`idAlmacenDestino`),
  KEY `fk_movimientoAlmacen_user1` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Volcado de datos para la tabla `movimientoAlmacen`
--

INSERT INTO `movimientoAlmacen` (`idMovimientoAlmacen`, `idProducto`, `idAlmacenOrigen`, `idAlmacenDestino`, `cantidadU`, `cantidadP`, `idUser`, `fechaMovimiento`) VALUES
(1, 1, NULL, 1, 2, 1, NULL, '2014-05-22 16:35:59'),
(2, 1, 1, 2, 1, 1, NULL, '2014-05-22 16:39:25'),
(3, 45, NULL, 1, 96, 10, NULL, '2014-06-12 16:54:18'),
(4, 44, NULL, 1, 109, 20, NULL, '2014-06-12 16:54:44'),
(5, 48, NULL, 1, 32, 7, NULL, '2014-06-12 16:55:22'),
(6, 46, NULL, 1, 27, 16, NULL, '2014-06-12 16:55:43'),
(7, 47, NULL, 1, 53, 14, NULL, '2014-06-12 16:56:03'),
(8, 29, NULL, 1, NULL, 10, NULL, '2014-06-12 16:56:15'),
(9, 30, NULL, 1, 14, 6, NULL, '2014-06-12 17:00:30'),
(10, 31, NULL, 1, 40, 20, NULL, '2014-06-12 17:00:44'),
(11, 32, NULL, 1, 25, NULL, NULL, '2014-06-12 17:00:55'),
(12, 103, NULL, 1, 71, NULL, NULL, '2014-06-12 17:01:06'),
(13, 109, NULL, 1, 4, NULL, NULL, '2014-06-12 17:01:15'),
(14, 18, NULL, 1, 32, 5, NULL, '2014-06-12 17:02:25'),
(15, 104, NULL, 1, 6, NULL, NULL, '2014-06-12 17:02:57'),
(16, 26, NULL, 1, 14, 8, NULL, '2014-06-12 18:02:53'),
(17, 27, NULL, 1, 39, 3, NULL, '2014-06-12 18:04:56'),
(18, 28, NULL, 1, 10, NULL, NULL, '2014-06-12 18:06:46'),
(19, 74, NULL, 1, 4, 223, NULL, '2014-06-12 18:07:08'),
(20, 2, NULL, 1, 9, 1, NULL, '2014-06-12 18:07:26'),
(21, 4, NULL, 1, 190, 53, NULL, '2014-06-12 18:07:49'),
(22, 8, NULL, 1, NULL, 5, NULL, '2014-06-12 18:09:25'),
(23, 7, NULL, 1, NULL, 15, NULL, '2014-06-12 18:11:31'),
(24, 9, NULL, 1, NULL, 1, NULL, '2014-06-12 18:12:03'),
(25, 82, NULL, 1, NULL, 3, NULL, '2014-06-12 18:13:40'),
(26, 84, NULL, 1, 250, 4, NULL, '2014-06-12 18:14:27'),
(27, 10, NULL, 1, NULL, 11, NULL, '2014-06-12 18:15:01'),
(28, 17, NULL, 1, 145, 29, NULL, '2014-06-12 18:15:28'),
(29, 94, NULL, 1, 12, NULL, NULL, '2014-06-12 18:15:40'),
(30, 11, NULL, 1, 1, NULL, NULL, '2014-06-12 18:15:51'),
(31, 21, NULL, 1, 184, 49, NULL, '2014-06-12 18:16:27'),
(32, 20, NULL, 1, NULL, 11, NULL, '2014-06-12 18:16:41'),
(33, 13, NULL, 1, 114, 3, NULL, '2014-06-12 18:16:56'),
(34, 12, NULL, 1, 72, NULL, NULL, '2014-06-12 18:17:29'),
(35, 25, NULL, 1, NULL, 5, NULL, '2014-06-12 18:17:39'),
(36, 15, NULL, 1, NULL, 5, NULL, '2014-06-12 18:17:48'),
(37, 101, NULL, 1, NULL, 5, NULL, '2014-06-12 18:18:08'),
(38, 42, NULL, 1, 67, 18, NULL, '2014-06-12 18:18:40'),
(39, 39, NULL, 1, 25, 8, NULL, '2014-06-12 18:18:58'),
(40, 110, NULL, 1, 11, 513, NULL, '2014-06-12 18:19:13'),
(41, 111, NULL, 1, 25, 91, NULL, '2014-06-12 18:19:27'),
(42, 40, NULL, 1, 371, 18, NULL, '2014-06-12 18:19:48'),
(43, 113, NULL, 1, 193, 13, NULL, '2014-06-12 18:21:19'),
(44, 112, NULL, 1, 7, 15, NULL, '2014-06-12 18:21:49'),
(45, 114, NULL, 1, 88, 13, NULL, '2014-06-12 18:22:12'),
(46, 116, NULL, 1, 485, 13, NULL, '2014-06-12 18:22:33'),
(47, 115, NULL, 1, 88, 12, NULL, '2014-06-12 18:23:15'),
(48, 37, NULL, 1, 13, 12, NULL, '2014-06-12 18:23:32'),
(49, 35, NULL, 1, 465, 11, NULL, '2014-06-12 18:23:59'),
(50, 41, NULL, 1, 71, NULL, NULL, '2014-06-12 18:24:46'),
(51, 38, NULL, 1, 220, 12, NULL, '2014-06-12 18:25:03'),
(52, 36, NULL, 1, 120, 12, NULL, '2014-06-12 18:25:19'),
(53, 43, NULL, 1, 61, 23, NULL, '2014-06-12 18:25:40'),
(54, 46, 1, 2, 27, 1, NULL, '2014-06-12 18:26:42'),
(55, 45, 1, 2, 96, NULL, NULL, '2014-06-12 18:26:54'),
(56, 44, 1, 2, 109, 8, NULL, '2014-06-12 18:27:10'),
(57, 48, 1, 2, 32, 1, NULL, '2014-06-12 18:31:22'),
(58, 47, 1, 2, 53, NULL, NULL, '2014-06-12 18:32:02'),
(59, 30, 1, 2, 14, 2, NULL, '2014-06-12 18:33:09'),
(60, 31, 1, 2, 40, 3, NULL, '2014-06-12 18:35:00'),
(61, 32, 1, 2, 25, NULL, NULL, '2014-06-12 18:35:17'),
(62, 103, 1, 2, 71, NULL, NULL, '2014-06-12 18:35:36'),
(63, 18, 1, 2, 32, NULL, NULL, '2014-06-12 18:36:39'),
(64, 109, 1, 2, 4, NULL, NULL, '2014-06-12 18:37:05'),
(65, 104, 1, 2, 6, NULL, NULL, '2014-06-12 18:38:04'),
(66, 26, 1, 2, 14, 1, NULL, '2014-06-12 18:38:39'),
(67, 27, 1, 2, 39, NULL, NULL, '2014-06-12 18:38:56'),
(68, 74, 1, 2, 223, NULL, NULL, '2014-06-12 18:39:35'),
(69, 2, 1, 2, 9, 1, NULL, '2014-06-12 18:47:35'),
(70, 4, 1, 2, 190, 3, NULL, '2014-06-12 18:48:05'),
(71, 84, 1, 2, 250, 4, NULL, '2014-06-12 18:48:56'),
(72, 17, 1, 2, 145, 6, NULL, '2014-06-12 18:49:52'),
(73, 94, 1, 2, 12, NULL, NULL, '2014-06-12 18:50:20'),
(74, 21, 1, 2, 184, NULL, NULL, '2014-06-12 18:50:50'),
(75, 13, 1, 2, 114, 3, NULL, '2014-06-12 18:51:20'),
(76, 12, 1, 2, 72, NULL, NULL, '2014-06-12 18:52:15'),
(77, 42, 1, 2, 67, NULL, NULL, '2014-06-12 18:52:50'),
(78, 39, 1, 2, 25, 4, NULL, '2014-06-12 18:54:51'),
(79, 110, 1, 2, 513, NULL, NULL, '2014-06-12 18:55:31'),
(80, 111, 1, 2, 91, 25, NULL, '2014-06-12 18:58:35'),
(81, 40, 1, 2, 371, NULL, NULL, '2014-06-12 18:58:54'),
(82, 113, 1, 2, 193, 2, NULL, '2014-06-12 18:59:33'),
(83, 112, 1, 2, 7, 2, NULL, '2014-06-12 19:00:01'),
(84, 116, 1, 2, 485, 1, NULL, '2014-06-12 19:00:24'),
(85, 115, 1, 2, 88, 2, NULL, '2014-06-12 19:00:52'),
(86, 114, 1, 2, 88, 2, NULL, '2014-06-12 19:01:13'),
(87, 41, 1, 2, 71, NULL, NULL, '2014-06-12 19:01:30'),
(88, 35, 1, 2, 465, 1, NULL, '2014-06-12 19:01:53'),
(89, 36, 1, 2, 120, 2, NULL, '2014-06-12 19:02:07'),
(90, 38, 1, 2, 220, 2, NULL, '2014-06-12 19:02:22'),
(91, 37, 1, 2, 13, 2, NULL, '2014-06-12 19:02:33'),
(92, 43, 1, 2, 61, 2, NULL, '2014-06-12 19:03:18'),
(93, 48, 1, 2, NULL, 2, NULL, '2014-06-23 19:45:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `enable` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `pages`
--

INSERT INTO `pages` (`id`, `nombre`, `contenido`, `enable`, `order`, `fecha`) VALUES
(1, 'Imprenta', '<h1 style="font-weight: normal; line-height: 1.2; color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, ''Trebuchet MS''; text-align: center;">\r\n	IMPRENTA</h1>\r\n<div>\r\n	&nbsp;</div>\r\n', 1, 1, '2014-03-10 19:54:33'),
(3, 'CTP', '<h1 style="text-align: center;">\r\n	<u>CTP</u></h1>\r\n<p>\r\n	Texto de demostracion</p>\r\n', 1, 2, '2014-03-05 19:34:22'),
(4, 'Editorial', '<p>\r\n	Texto de demostracion&nbsp;</p>\r\n', 1, 3, '2014-03-05 19:34:25'),
(5, 'Distribuidora', '<p>\r\n	Texto de demostracion&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 1, 4, '2014-03-05 19:34:29'),
(6, 'Contacto', '<p>\r\n	Ubicacion juan de la riva ..</p>\r\n', 1, 5, '2014-03-12 16:32:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `servicio` int(11) NOT NULL,
  `codigo` varchar(40) NOT NULL,
  `material` varchar(40) NOT NULL,
  `color` varchar(40) NOT NULL,
  `marca` varchar(40) NOT NULL,
  `industria` varchar(40) NOT NULL,
  `cantXPaquete` int(11) NOT NULL,
  `precioSFU` double NOT NULL,
  `precioSFP` double NOT NULL,
  `precioCFU` double NOT NULL,
  `precioCFP` double NOT NULL,
  `familia` varchar(40) NOT NULL,
  `detalle` varchar(100) NOT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `servicio`, `codigo`, `material`, `color`, `marca`, `industria`, `cantXPaquete`, `precioSFU`, `precioSFP`, `precioCFU`, `precioCFP`, `familia`, `detalle`) VALUES
(1, 1, 'CB250-6787N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 100, 1.79, 175, 1.86, 182, 'Couche', '250G 67x87CM'),
(2, 0, 'CB090-77110N', 'Couché Brillo', 'blanco', 'Nevia', 'China', 250, 0.99, 240, 1.03, 250, 'papales', '90G 77x110CM'),
(3, 0, 'CB300-6787N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 100, 2.16, 212, 2.26, 222, 'Couche', '300G 67x87CM'),
(4, 0, 'CB115-6787N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 250, 0.83, 195, 0.87, 207, 'Couche', '115G 67x87CM'),
(5, 0, 'CB115-6789N', 'Couché Brillo', 'blanco', 'Nevia', 'China', 250, 0.89, 215, 0.92, 223, 'Couche', '115G 67x89CM'),
(6, 0, 'CB115-77110N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 250, 1.19, 287, 1.24, 299, 'Couche', '115G 77x110CM'),
(7, 0, 'CB200-77110N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 125, 1.98, 240, 2.15, 259, 'Couche', '200G 77x110CM'),
(8, 0, 'CB170-6787N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 250, 1.2, 291, 1.25, 303, 'Couche', '170G 67x87CM'),
(9, 0, 'CB300-77110N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 100, 3.08, 304, 3.21, 317, 'Couche', '300G 77x110CM'),
(10, 0, 'CM300-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 100, 3.08, 304, 3.21, 317, 'Couche', '300G 77x110CM'),
(11, 0, 'PB063-6787T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 250, 0.45, 211, 0.47, 218, 'Papel', '63G 67x87CM'),
(12, 0, 'PB090-6787S', 'Papel Bond', 'Blanco Alcalino', 'Suzano', 'Brazil', 250, 0.73, 169, 0.77, 179, 'Papel', '90G 67x87CM'),
(13, 0, 'PB075-77110S', 'Papel Bond', 'Blanco Alcalino', 'Suzano', 'Brazil', 250, 0.8, 194, 0.83, 203, 'Papel', '75G 77x110CM'),
(14, 0, 'PB075-77110T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 250, 0.77, 184, 0.79, 191, 'Papel', '75G 77x110CM'),
(15, 0, 'PB090-77110T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 250, 0.91, 219, 0.95, 228, 'Papel', '90G 77x110CM'),
(16, 0, 'PB120-6787S', 'Papel Bond', 'Blanco', 'Tucuman', 'China', 250, 0.85, 200, 0.89, 210, 'Papel', '120G 67x87CM'),
(17, 0, 'PB054-6787B', 'Papel Bond', 'Blanco Alcalino', 'Bilt', 'India', 500, 0.42, 190, 0.44, 200, 'Papel', '54G 67x87CM'),
(18, 0, 'CH240-65100M-C', 'Cartulina Hilada', 'Crema', 'Multiverde', 'Brazil', 100, 2.82, 267, 3, 285, 'Cartulina', '240G 65x100CM'),
(19, 0, 'CH240-65100M-B', 'Cartulina Hilada', 'Blanco', 'Multiverde', 'China', 100, 2.82, 267, 3, 285, 'Cartulina', '240G 65x100CM'),
(20, 0, 'PB075-6787T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 500, 0.53, 250, 0.55, 257, 'Papel', '75G 67x87CM'),
(21, 0, 'PB075-6787S', 'Papel Bond', 'Blanco Alcalino', 'Suzano', 'Brazil', 500, 0.55, 255, 0.58, 273, 'papales', '75G 67x87M'),
(23, 0, '', 'Adhesivo', 'Transparente', '', 'China', 100, 0, 0, 0, 0, 'Adhesivo', ''),
(24, 0, '', 'Adhesivo', 'blanco', '', 'China', 100, 0, 0, 0, 0, 'Adhesivo', '70x100CM'),
(25, 0, 'PB090-6787T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 250, 0.65, 154, 0.67, 159, 'Papel', '90G 67x87CM'),
(26, 0, 'CT225-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 2.91, 276, 3.03, 288, 'Cartulina', '225G 77x110CM'),
(27, 0, 'CT255-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 3.38, 323, 3.54, 339, 'Cartulina', '255G 77x110CM'),
(28, 0, 'CT300-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 3.57, 342, 3.71, 356, 'Cartulina', '300G 77x110CM'),
(29, 0, 'CD180-77110C', 'Cartulina Duplex', 'Blanco/Café', 'CMPC', 'Chile', 100, 2.48, 2333, 2.63, 248, 'Cartulina', '180G 77x110CM'),
(30, 0, 'CD205-77110C', 'Cartulina Duplex', 'Blanco/Café', 'CMPC', 'Chile', 100, 2.76, 261, 2.86, 271, 'Cartulina', '225G 77x110CM'),
(31, 0, 'CD250-77110C', 'Cartulina Duplex', 'Blanco/Café', 'CMPC', 'Chile', 100, 3.03, 288, 3.15, 300, 'Cartulina', '250G 77x110CM'),
(32, 0, 'CD275-77110C', 'Cartulina Duplex', 'Blanco/Café', 'CMPC', 'Chile', 100, 3.3, 340, 3.69, 354, 'Cartulina', '275G 77x110CM'),
(33, 0, '', 'Papel Kraft', '', '', '', 100, 0, 0, 0, 0, 'papales', '125G 102x160CM'),
(34, 0, '', 'Papel Kraft', '', '', '', 250, 0, 0, 0, 0, 'papales', '80G 81.5x125CM'),
(35, 0, 'PQI35-6787F-B', 'Papel Quimico Int.', 'Blanco', 'Focus', 'Colombia', 500, 0.66, 315, 0.68, 327, 'Papel', '35G 67x87CM'),
(36, 0, 'PQI35-6787F-V', 'Papel Quimico Int.', 'Verde', 'Focus', 'Colombia', 500, 0.66, 315, 0.68, 327, 'Papel', '35G 67x87CM'),
(37, 0, 'PQI35-6787F-A', 'Papel Quimico Int.', 'Amarillo', 'Focus', 'Colombia', 500, 0.66, 315, 0.68, 327, 'Papel', '35G 67x87CM'),
(38, 0, 'PQI35-6787F-R', 'Papel Quimico Int.', 'Rosado', 'Focus', 'Colombia', 500, 0.66, 315, 0.68, 327, 'Papel', '35G 67x87CM'),
(39, 0, 'PC35-6787P-B', 'Papel Copia', 'Blanco', 'Propal', 'Colombia', 500, 0.31, 140, 0.33, 147, 'Papel', '35G 67x87CM'),
(40, 0, 'PC35-6787P-V', 'Papel Copia', 'Verde', 'Propal', 'Colombia', 500, 0.31, 140, 0.33, 147, 'Papel', '35G 67x87CM'),
(41, 0, 'PQI35-6787F-C', 'Papel Quimico Int.', 'Celeste', 'Focus', 'Colombia', 500, 0.66, 315, 0.68, 327, 'Papel', '35G 67x87CM'),
(42, 0, 'PC35-6787P-A', 'Papel Copia', 'Amarillo', 'Propal', 'Colombia', 500, 0.31, 140, 0.33, 147, 'Papel', '35G 67x87CM'),
(43, 0, 'PQO35-6787F', 'Papel Quimico Orig.', 'Blanco', 'Focus', 'Colombia', 500, 0.62, 295, 0.65, 310, 'Papel', '35G 67x87CM'),
(44, 0, 'CC180-65100M-B', 'Cartulina Corriente', 'Blanco', 'Multiverde', 'Brazil', 125, 2.62, 247, 2.74, 259, 'Cartulina', '180G 65x100CM'),
(45, 0, 'CC180-65100M-A', 'Cartulina Corriente', 'Amarillo', 'Multiverde', 'Brazil', 125, 2.62, 247, 2.74, 259, 'Cartulina', '180G 65x100CM'),
(46, 0, 'CC180-65100M-R', 'Cartulina Corriente', 'Rosado', 'Multiverde', 'Brazil', 125, 2.62, 247, 2.74, 259, 'Cartulina', '180G 65x100CM'),
(47, 0, 'CC180-65100M-V', 'Cartulina Corriente', 'Verde', 'Multiverde', 'Brazil', 125, 2.62, 247, 2.74, 259, 'Cartulina', '180G 65x100CM'),
(48, 0, 'CC180-65100M-C', 'Cartulina Corriente', 'Celeste', 'Multiverde', 'Brazil', 125, 2.62, 247, 2.74, 259, 'Cartulina', '180G 65x100CM'),
(49, 0, '', 'Tintas', 'Cyan', 'Amstrong', '', 0, 0, 0, 0, 0, 'Tintas', '1Kg'),
(50, 0, '', 'Tintas', 'Magenta', 'Amstrong', '', 0, 0, 0, 0, 0, 'Tintas', '1Kg'),
(51, 0, '', 'Tintas', 'Amarillo', 'Amstrong', '', 0, 0, 0, 0, 0, 'Tintas', '1Kg'),
(52, 0, '', 'Tintas', 'negro', 'Amstrong', '', 0, 0, 0, 0, 0, 'Tintas', '1Kg'),
(53, 0, '', 'Tintas Epeciales', 'Blanco Opaco', 'Amstrong', '', 0, 0, 0, 0, 0, 'Tintas', '1Kg'),
(54, 0, '', 'Tintas Epeciales', 'negro', '', '', 18, 0, 0, 0, 0, 'Tintas', '1Kg Tipografica'),
(55, 0, '', 'Tintas Epeciales', 'Rojo', '', '', 18, 0, 0, 0, 0, 'Tintas', '1Kg Tipografica'),
(56, 0, '', 'Solucion de Fuente Chemical', '', '', '', 0, 0, 0, 0, 0, 'Quimicos', '1lt'),
(57, 0, '', 'Lavador de Rodillos', '', '', '', 0, 0, 0, 0, 0, 'Quimicos', '1609 20Lt'),
(58, 0, '', 'Goma Arabica', '', '', '', 0, 0, 0, 0, 0, 'Quimicos', '1Lt Chemical'),
(59, 0, '', 'Solucion de Fuente Chemical', '', '', '', 0, 0, 0, 0, 0, 'Quimicos', 'Bidon'),
(60, 0, '', 'Goma Arabica', '', '', '', 0, 0, 0, 0, 0, 'Quimicos', 'Bidon'),
(61, 0, '', 'Solucion de Fuente de Rodillos', '', '', '', 0, 0, 0, 0, 0, 'Quimicos', '20Lt'),
(62, 0, '', 'Solucion de Fuente', '', 'Stabilat', '', 0, 0, 0, 0, 0, 'Quimicos', '5Lt'),
(63, 0, '', 'Lavador de Rodillos', '', '', '', 0, 0, 0, 0, 0, 'Quimicos', '1609 5Lt'),
(64, 0, '', 'Goma Arabica', '', '', '', 0, 0, 0, 0, 0, '', ''),
(65, 0, '', 'Filtro', '', '', '', 0, 0, 0, 0, 0, '', ''),
(66, 0, '', 'Revelador de placas termales', '', '', '', 0, 0, 0, 0, 0, '', ''),
(67, 0, '', 'Placas GTO 46', '', '', '', 0, 0, 0, 0, 0, '', ''),
(68, 0, '', 'Placas GTO 52', '', '', '', 0, 0, 0, 0, 0, '', ''),
(69, 0, '', 'Placas S/master', '', '', '', 0, 0, 0, 0, 0, '', ''),
(70, 0, '', 'Placas MO 015', '', '', '', 0, 0, 0, 0, 0, '', ''),
(71, 0, '', 'Placas Roland', '', '', '', 0, 0, 0, 0, 0, '', ''),
(72, 0, '', 'Placas Sorm', '', '', '', 0, 0, 0, 0, 0, '', '72.4x61.5CM'),
(73, 0, '', 'Placas Resmas', '', '', '', 0, 0, 0, 0, 0, '', ''),
(74, 0, 'CB090-6787N', 'Couché Brillo', 'blanco', 'Nevia', 'China', 250, 0.68, 158, 0.71, 166, 'Couche', '90G 67x87CM'),
(75, 0, 'CB250-77110N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 100, 2.57, 253, 2.69, 265, 'Couche', '250G 77x110CM'),
(76, 0, 'CB150-6787N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 250, 1.08, 261, 1.13, 269, 'Couche', '150G 67x87CM'),
(77, 0, 'CB150-77110N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 250, 1.54, 375, 1.59, 390, 'Couche', '150G 77x110CM'),
(78, 0, 'CB170-77110N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 250, 1.76, 427, 1.83, 447, 'Couche', '170G 77x110CM'),
(79, 0, 'CB200-6787N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 125, 1.63, 183, 1.69, 197, 'Couche', '200G 67x87CM'),
(80, 0, 'CM090-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 0.68, 158, 0.71, 166, 'Couche', '90G 67x87CM'),
(81, 0, 'CM090-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 0.99, 240, 1.03, 250, 'Couche', '90G 77x110CM'),
(82, 0, 'CM115-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 0.83, 195, 0.87, 207, 'Couche', '115G 67x87CM'),
(83, 0, 'CM115-6789N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 0.89, 215, 0.92, 223, 'Couche', '115G 67x89CM'),
(84, 0, 'CM115-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 1.19, 287, 1.24, 299, 'Couche', '115G 77x110CM'),
(85, 0, 'CM150-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 1.08, 261, 1.13, 269, 'Couche', '150G 67x87CM'),
(86, 0, 'CM150-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 1.54, 375, 1.59, 390, 'Couche', '150G 77x110CM'),
(87, 0, 'CM170-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 1.2, 291, 1.25, 303, 'Couche', '170G 67x87CM'),
(88, 0, 'CM170-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 1.76, 427, 1.83, 447, 'Couche', '170G 77x110CM'),
(89, 0, 'CM200-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 125, 1.63, 183, 1.69, 197, 'Couche', '200G 67x87CM'),
(90, 0, 'CM200-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 125, 1.98, 240, 2.15, 259, 'Couche', '200G 77x110CM'),
(91, 0, 'CM250-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 100, 1.79, 175, 1.86, 182, 'Couche', '250G 67x87CM'),
(92, 0, 'CM250-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 100, 2.57, 253, 2.69, 265, 'Couche', '250G 77x110CM'),
(93, 0, 'CM300-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 100, 2.16, 212, 2.26, 222, 'Couche', '300G 67x87CM'),
(94, 0, 'PB063-6787S', 'Papel Bond', 'Blanco Alcalino', 'Suzano', 'Brazil', 500, 0.5, 235, 0.52, 246, 'Papel', '63G 67x87CM'),
(95, 0, 'PB070-6787T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 500, 0.5, 234, 0.52, 242, 'Papel', '70G 67x87CM'),
(96, 0, 'PB070-6787S', 'Papel Bond', 'Blanco Alcalino', 'Suzano', 'Brazil', 500, 0.53, 247, 0.55, 259, 'Papel', '70G 67x87CM'),
(97, 0, 'PB75-6787K-A', 'Papel Bond', 'Amarillo', 'Korab', 'China', 500, 0.6, 275, 0.62, 292, 'Papel', '75G 67x87CM'),
(98, 0, 'PB75-6787K-C', 'Papel Bond', 'Celeste', 'Korab', 'China', 500, 0.6, 275, 0.62, 292, 'Papel', '75G 67x87CM'),
(99, 0, 'PB75-6787K-V', 'Papel Bond', 'Verde', 'Korab', 'China', 500, 0.6, 275, 0.62, 292, 'Papel', '75G 67x87CM'),
(100, 0, 'PB75-6787K-R', 'Papel Bond', 'Rosado', 'Korab', 'China', 500, 0.6, 275, 0.62, 292, 'Papel', '75G 67x87CM'),
(101, 0, 'PB75-6787T', 'Papel Bond', 'Hueso', 'Tucuman', 'Argentina', 500, 0.57, 270, 0.6, 286, 'Papel', '75G 67x87CM'),
(102, 0, 'PB80-6787T', 'Papel Bond', 'Hueso', 'Tucuman', 'Argentina', 500, 0.61, 287, 0.64, 305, 'Papel', '80G 67x87CM'),
(103, 0, 'CD300-77110S', 'Cartulina Duplex', 'Blanco/Café', 'Sosein', 'China', 100, 3.55, 340, 3.69, 354, 'Cartulina', '300G 77x110CM'),
(104, 0, 'CT205-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 2.7, 255, 2.8, 265, 'Cartulina', '205G 77x110CM'),
(105, 0, 'CT280-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 3.59, 334, 3.62, 347, 'Cartulina', '280G 77x110CM'),
(106, 0, 'CT330-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 4.05, 390, 4.31, 416, 'Cartulina', '330G 77x110CM'),
(107, 0, 'CT360-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 4.4, 425, 4.67, 452, 'Cartulina', '360G 77x110CM'),
(108, 0, 'CH180-65100M-B', 'Cartulina Hilada', 'Blanco', 'Multiverde', 'Brazil', 100, 2.22, 207, 2.37, 221, 'Cartulina', '180G 65x100CM'),
(109, 0, 'CH180-65100M-C', 'Cartulina Hilada', 'Crema', 'Multiverde', 'Brazil', 100, 2.22, 207, 2.37, 221, 'Cartulina', '180G 65x100CM'),
(110, 0, 'PC35-6787P-C', 'Papel Copia', 'Celeste', 'Propal', 'Colombia', 500, 0.31, 140, 0.33, 147, 'Papel', '35G 67x87CM'),
(111, 0, 'PC35-6787P-R', 'Papel Copia', 'Rosado', 'Propal', 'Colombia', 500, 0.31, 140, 0.33, 147, 'Papel', '35G 67x87CM'),
(112, 0, 'PQF35-6787F-B', 'Papel Quimico Fin.', 'Blanco', 'Focus', 'Colombia', 500, 0.65, 310, 0.67, 322, 'Papel', '35G 67x87CM'),
(113, 0, 'PQF35-6787F-A', 'Papel Quimico Fin.', 'Amarillo', 'Focus', 'Colombia', 500, 0.65, 310, 0.67, 322, 'Papel', '35G 67x87CM'),
(114, 0, 'PQF35-6787F-C', 'Papel Quimico Fin.', 'Celeste', 'Focus', 'Colombia', 500, 0.65, 310, 0.67, 322, 'Papel', '35G 67x87CM'),
(115, 0, 'PQF35-6787F-V', 'Papel Quimico Fin.', 'Verde', 'Focus', 'Colombia', 500, 0.65, 310, 0.67, 322, 'Papel', '35G 67x87CM'),
(116, 0, 'PQF35-6787F-R', 'Papel Quimico Fin.', 'Rosado', 'Focus', 'Colombia', 500, 0.65, 310, 0.67, 322, 'Papel', '35G 67x87CM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE IF NOT EXISTS `recibos` (
  `idRecibos` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(40) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `responsable` varchar(40) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `concepto` varchar(100) DEFAULT NULL,
  `codigoNumero` varchar(20) DEFAULT NULL,
  `servicio` varchar(20) DEFAULT NULL,
  `monto` double DEFAULT NULL,
  `acuenta` double DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  `obs` varchar(200) DEFAULT NULL,
  `tipoRecivo` int(11) DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `idCajaMovimientoVenta` int(11) NOT NULL,
  PRIMARY KEY (`idRecibos`),
  KEY `fk_recibos_cliente1` (`idCliente`),
  KEY `fk_recibos_cajaMovimientoVenta1` (`idCajaMovimientoVenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `fechaLogin` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  KEY `fk_user_empleado1` (`idEmpleado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`idUser`, `username`, `password`, `fechaLogin`, `estado`, `tipo`, `idEmpleado`) VALUES
(1, 'helier', '5629500575ffe706d9d57fca5472153e', '2014-06-27 16:31:09', 0, '1', 2),
(2, 'erika', 'e10adc3949ba59abbe56e057f20f883e', '2014-06-23 19:13:00', 0, '3', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `idVenta` int(11) NOT NULL AUTO_INCREMENT,
  `fechaVenta` datetime DEFAULT NULL,
  `tipoVenta` int(11) DEFAULT NULL,
  `formaPago` datetime DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `fechaPlazo` datetime DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `serie` int(11) DEFAULT NULL,
  `montoVenta` double DEFAULT NULL,
  `montoPagado` double DEFAULT NULL,
  `montoCambio` double DEFAULT NULL,
  `montoDescuento` double DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `factura` varchar(50) DEFAULT NULL,
  `autorizado` varchar(50) DEFAULT NULL,
  `responsable` varchar(50) DEFAULT NULL,
  `obs` varchar(200) DEFAULT NULL,
  `idCajaMovimientoVenta` int(11) DEFAULT NULL,
  PRIMARY KEY (`idVenta`),
  KEY `fk_venta_cliente1` (`idCliente`),
  KEY `fk_venta_cajaMovimientoVenta1` (`idCajaMovimientoVenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `fk_almacen_almacen1` FOREIGN KEY (`idParent`) REFERENCES `almacen` (`idAlmacen`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `almacenProducto`
--
ALTER TABLE `almacenProducto`
  ADD CONSTRAINT `fk_almacenProducto_almacen1` FOREIGN KEY (`idAlmacen`) REFERENCES `almacen` (`idAlmacen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_almacenProducto_producto1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `fk_caja_caja1` FOREIGN KEY (`idParent`) REFERENCES `caja` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cajaArqueo`
--
ALTER TABLE `cajaArqueo`
  ADD CONSTRAINT `fk_cajaVenta_caja1` FOREIGN KEY (`idCaja`) REFERENCES `caja` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cajaVenta_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cajaMovimientoVenta`
--
ALTER TABLE `cajaMovimientoVenta`
  ADD CONSTRAINT `fk_movimientoCaja_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cajaMovimientoVenta_caja1` FOREIGN KEY (`idCaja`) REFERENCES `caja` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleVenta`
--
ALTER TABLE `detalleVenta`
  ADD CONSTRAINT `fk_detalleVenta_venta1` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleVenta_almacenProducto1` FOREIGN KEY (`idAlmacenProducto`) REFERENCES `almacenProducto` (`idAlmacenProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `movimientoAlmacen`
--
ALTER TABLE `movimientoAlmacen`
  ADD CONSTRAINT `fk_movimientoAlmacen_almacen1` FOREIGN KEY (`idAlmacenOrigen`) REFERENCES `almacen` (`idAlmacen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoAlmacen_almacen2` FOREIGN KEY (`idAlmacenDestino`) REFERENCES `almacen` (`idAlmacen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoAlmacen_producto1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoAlmacen_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD CONSTRAINT `fk_recibos_cliente1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recibos_cajaMovimientoVenta1` FOREIGN KEY (`idCajaMovimientoVenta`) REFERENCES `cajaMovimientoVenta` (`idCajaMovimientoVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_empleado1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_cliente1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_cajaMovimientoVenta1` FOREIGN KEY (`idCajaMovimientoVenta`) REFERENCES `cajaMovimientoVenta` (`idCajaMovimientoVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
