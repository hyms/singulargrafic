-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-05-2014 a las 13:10:22
-- Versión del servidor: 5.5.37
-- Versión de PHP: 5.4.4-14+deb7u9

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`idAlmacen`, `nombre`, `idParent`) VALUES
(1, 'Deposito Central', NULL),
(2, 'Tienda', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Volcado de datos para la tabla `almacenProducto`
--

INSERT INTO `almacenProducto` (`idAlmacenProducto`, `idProducto`, `stockU`, `stockP`, `idAlmacen`) VALUES
(1, 1, 1, 0, 1),
(2, 1, 1, 1, 2),
(3, 2, 0, 0, 1),
(4, 3, 0, 0, 1),
(5, 4, 0, 0, 1),
(6, 5, 0, 0, 1),
(7, 6, 0, 0, 1),
(8, 7, 0, 0, 1),
(9, 8, 0, 0, 1),
(10, 9, 0, 0, 1),
(11, 10, 0, 0, 1),
(12, 11, 0, 0, 1),
(13, 12, 0, 0, 1),
(14, 13, 0, 0, 1),
(15, 14, 0, 0, 1),
(16, 15, 0, 0, 1),
(17, 16, 0, 0, 1),
(18, 17, 0, 0, 1),
(19, 18, 0, 0, 1),
(20, 19, 0, 0, 1),
(21, 20, 0, 0, 1),
(22, 21, 0, 0, 1),
(23, 22, 0, 0, 1),
(24, 23, 0, 0, 1),
(25, 24, 0, 0, 1),
(26, 25, 0, 0, 1),
(27, 26, 0, 0, 1),
(28, 27, 0, 0, 1),
(29, 28, 0, 0, 1),
(30, 29, 0, 0, 1),
(31, 30, 0, 0, 1),
(32, 31, 0, 0, 1),
(33, 32, 0, 0, 1),
(34, 33, 0, 0, 1),
(35, 34, 0, 0, 1),
(36, 35, 0, 0, 1),
(37, 36, 0, 0, 1),
(38, 37, 0, 0, 1),
(39, 38, 0, 0, 1),
(40, 39, 0, 0, 1),
(41, 40, 0, 0, 1),
(42, 41, 0, 0, 1),
(43, 42, 0, 0, 1),
(44, 43, 0, 0, 1),
(45, 44, 0, 0, 1),
(46, 45, 0, 0, 1),
(47, 46, 0, 0, 1),
(48, 47, 0, 0, 1),
(49, 48, 0, 0, 1),
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
(74, 73, 0, 0, 1);

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
  `nombre` varchar(50) DEFAULT NULL,
  `idParent` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCaja`),
  KEY `fk_caja_caja1` (`idParent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`idCaja`, `nombre`, `idParent`) VALUES
(1, 'administracion', NULL),
(2, 'papeles', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajaVenta`
--

CREATE TABLE IF NOT EXISTS `cajaVenta` (
  `idCajaVenta` int(11) NOT NULL AUTO_INCREMENT,
  `idCaja` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  `fechaArqueo` datetime DEFAULT NULL,
  `entregado` double DEFAULT NULL,
  `comprobante` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idCajaVenta`),
  KEY `fk_cajaVenta_caja1` (`idCaja`),
  KEY `fk_cajaVenta_user1` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cajaVenta`
--

INSERT INTO `cajaVenta` (`idCajaVenta`, `idCaja`, `idUser`, `saldo`, `fechaArqueo`, `entregado`, `comprobante`) VALUES
(1, 2, 1, 0, NULL, 0, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleVenta`
--

CREATE TABLE IF NOT EXISTS `detalleVenta` (
  `idDetalleVenta` int(11) NOT NULL AUTO_INCREMENT,
  `idVenta` int(11) DEFAULT NULL,
  `cantidadU` int(11) DEFAULT NULL,
  `costoU` double NOT NULL,
  `cantidadP` int(11) DEFAULT NULL,
  `costoP` double NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombre`, `apellido`, `fechaRegistro`, `email`, `telefono`, `ci`) VALUES
(1, '', '', NULL, '', '', ''),
(2, 'Helier', 'Cortez', NULL, 'hdnymib@gmail.com', '73221183', '5999242');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `movimientoAlmacen`
--

INSERT INTO `movimientoAlmacen` (`idMovimientoAlmacen`, `idProducto`, `idAlmacenOrigen`, `idAlmacenDestino`, `cantidadU`, `cantidadP`, `idUser`, `fechaMovimiento`) VALUES
(1, 1, NULL, 1, 2, 1, NULL, '2014-05-22 16:35:59'),
(2, 1, 1, 2, 1, 1, NULL, '2014-05-22 16:39:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientoCaja`
--

CREATE TABLE IF NOT EXISTS `movimientoCaja` (
  `idMovimientoCaja` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double DEFAULT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  `fechaMovimiento` datetime DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idCaja` int(11) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMovimientoCaja`),
  KEY `fk_movimientoCaja_user1` (`idUser`),
  KEY `fk_movimientoCaja_cajaVenta1` (`idCaja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `servicio`, `codigo`, `material`, `color`, `marca`, `industria`, `cantXPaquete`, `precioSFU`, `precioSFP`, `precioCFU`, `precioCFP`, `familia`, `detalle`) VALUES
(1, 1, 'CB90-6787AT', 'Couché Brillo', 'blanco', 'Art Tech', 'China', 250, 0, 0, 0, 0, 'papales', '90G 67x87CM'),
(2, 0, 'CB90-77110N', 'Couché Brillo', 'blanco', 'Nevia', 'China', 250, 0, 0, 0, 0, 'papales', '90G 77x110CM'),
(3, 0, 'CB90-77110SP', 'Couché Brillo', 'blanco', 'Sarrio Papel', 'China', 250, 0, 0, 0, 0, 'papales', '90G 77x110CM'),
(4, 0, 'CB115-6787GE', 'Couché Brillo', 'blanco', 'Gold East', 'China', 250, 0, 0, 0, 0, 'papales', '115G 67x87CM'),
(5, 0, 'CB115-6789GE', 'Couché Brillo', 'blanco', 'Gold East', 'China', 250, 0, 0, 0, 0, 'papales', '115G 67x89CM'),
(6, 0, 'CB115-77110AT', 'Couché Brillo', 'blanco', 'Art Tech', 'China', 250, 0, 0, 0, 0, 'papales', '115G 77x110CM'),
(7, 0, 'CB200-77110GE', 'Couché Brillo', 'blanco', 'Gold East', 'China', 250, 0, 0, 0, 0, 'papales', '200G 77x110CM'),
(8, 0, 'CB170-6787AT', 'Couché Brillo', 'blanco', 'Art Tech', 'China', 250, 0, 0, 0, 0, 'papales', '170G 67x87CM'),
(9, 0, 'CB300-77110GHS', 'Couché Brillo', 'blanco', 'GHS', 'China', 250, 0, 0, 0, 0, 'papales', '300G 77x110CM'),
(10, 0, 'CM300-77110GHS', 'Couché Mate', 'blanco', 'GHS', 'China', 100, 0, 0, 0, 0, 'papales', '300G 77x110CM'),
(11, 0, 'PB63-6787T', 'Papel Bond', 'blanco', 'Tucuman', 'China', 500, 0, 0, 0, 0, 'papales', '63G 67x87CM'),
(12, 0, 'PB75-6787T', 'Papel Bond', 'blanco', 'Tucuman', 'China', 500, 0, 0, 0, 0, 'papales', '75G 67x87CM'),
(13, 0, 'PB75-6787P', 'Papel Bond', 'blanco', 'Primapres', 'China', 500, 0, 0, 0, 0, 'papales', '75G 67x87CM'),
(14, 0, 'PB75-6787A', 'Papel Bond', 'blanco', 'Ahuesado', 'China', 250, 0, 0, 0, 0, 'papales', '75G 67x87CM'),
(15, 0, 'PB90-6787T', 'Papel Bond', 'blanco', 'Tucuman', 'China', 250, 0, 0, 0, 0, 'papales', '90G 67x87CM'),
(16, 0, 'PB90-77110T', 'Papel Bond', 'blanco', 'Tucuman', 'China', 250, 0, 0, 0, 0, 'papales', '90G 77x110CM'),
(17, 0, 'PB54-6787I', 'Papel Bond', 'blanco', 'Indu', 'China', 500, 0, 0, 0, 0, 'papales', '54G 67x87CM'),
(18, 0, 'CH240-65100', 'Cartulina Hilada', 'Crema', '', 'China', 0, 0, 0, 0, 0, 'Cartulina', '240G 65x100CM'),
(19, 0, 'CH240-65100-2', 'Cartulina Hilada', 'blanco', '', 'China', 0, 0, 0, 0, 0, 'Cartulina', '240G 65x100CM'),
(20, 0, 'PB75-21528', 'Papel Bond', 'blanco', '', 'China', 0, 0, 0, 0, 0, 'papales', '75G 21.5x28CM'),
(21, 0, 'PB75-21533', 'Papel Bond', 'blanco', '', 'China', 0, 0, 0, 0, 0, 'papales', '75G 21.5x33CM'),
(22, 0, '', 'Adhesivo', '', '', 'China', 100, 0, 0, 0, 0, 'Adhesivo', ''),
(23, 0, '', 'Adhesivo', 'Transparente', '', 'China', 100, 0, 0, 0, 0, 'Adhesivo', ''),
(24, 0, '', 'Adhesivo', 'blanco', '', 'China', 100, 0, 0, 0, 0, 'Adhesivo', '70x100CM'),
(25, 0, 'PB75-6787S', 'Papel Bond', 'Blanco Alcalino', 'Suzano', 'China', 500, 0, 0, 0, 0, 'papales', '75G 67x87CM'),
(26, 0, '', 'Triplex', '', 'CMPC', 'China', 100, 0, 0, 0, 0, 'papales', '225G 77x110CM'),
(27, 0, '', 'Triplex', '', 'Sosein', 'China', 100, 0, 0, 0, 0, 'papales', '255G 77x110CM'),
(28, 0, '', 'Triplex', '', 'Sosein', 'China', 100, 0, 0, 0, 0, 'papales', '300G 77x110CM'),
(29, 0, '', 'Duplex', '', 'CMPC', 'China', 100, 0, 0, 0, 0, 'papales', '180G 77x110CM'),
(30, 0, '', 'Duplex', '', 'CMPC', 'China', 100, 0, 0, 0, 0, 'papales', '225G 77x110CM'),
(31, 0, '', 'Duplex', '', 'CMPC', 'China', 100, 0, 0, 0, 0, 'papales', '250G 77x110CM'),
(32, 0, '', 'Duplex', '', 'CMPC', 'China', 100, 0, 0, 0, 0, 'papales', '275G 77x110CM'),
(33, 0, '', 'Papel Kraft', '', '', '', 100, 0, 0, 0, 0, 'papales', '125G 102x160CM'),
(34, 0, '', 'Papel Kraft', '', '', '', 250, 0, 0, 0, 0, 'papales', '80G 81.5x125CM'),
(35, 0, '', 'Papel Quimico', 'blanco', '', '', 500, 0, 0, 0, 0, 'papales', '50G 67x87CM'),
(36, 0, '', 'Papel Quimico', 'verde', '', '', 500, 0, 0, 0, 0, 'papales', '50G 67x87CM'),
(37, 0, '', 'Papel Quimico', 'Amarillo', '', '', 500, 0, 0, 0, 0, 'papales', '50G 67x87CM'),
(38, 0, '', 'Papel Quimico', 'Rosado', '', '', 500, 0, 0, 0, 0, 'papales', '50G 67x87CM'),
(39, 0, '', 'Papel Copia', 'blanco', '', '', 500, 0, 0, 0, 0, 'papales', '35G 67x87CM'),
(40, 0, '', 'Papel Copia', 'verde', '', '', 500, 0, 0, 0, 0, 'papales', '35G 67x87CM'),
(41, 0, '', 'Papel Quimico', 'celeste', '', '', 500, 0, 0, 0, 0, 'papales', '35G 67x87CM'),
(42, 0, '', 'Papel Copia', 'Amarillo', '', '', 500, 0, 0, 0, 0, 'papales', '35G 67x87CM'),
(43, 0, '', 'Papel Quimico', 'Rosado', '', '', 500, 0, 0, 0, 0, 'papales', '35G 67x87CM'),
(44, 0, '', 'Cartulina', 'blanco', '', '', 0, 0, 0, 0, 0, 'Cartulina', '180G 65x100CM'),
(45, 0, '', 'Cartulina', 'Amarillo', '', '', 0, 0, 0, 0, 0, 'Cartulina', '180G 65x100CM'),
(46, 0, '', 'Cartulina', 'Rosado', '', '', 0, 0, 0, 0, 0, 'Cartulina', '180G 65x100CM'),
(47, 0, '', 'Cartulina', 'verde', '', '', 0, 0, 0, 0, 0, 'Cartulina', '180G 65x100CM'),
(48, 0, '', 'Cartulina', 'celeste', '', '', 0, 0, 0, 0, 0, 'Cartulina', '180G 65x100CM'),
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
(73, 0, '', 'Placas Resmas', '', '', '', 0, 0, 0, 0, 0, '', '');

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
  `idCaja` int(11) DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  PRIMARY KEY (`idRecibos`),
  KEY `fk_recibos_cliente1` (`idCliente`),
  KEY `fk_recibos_cajaVenta1` (`idCaja`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`idUser`, `username`, `password`, `fechaLogin`, `estado`, `tipo`, `idEmpleado`) VALUES
(1, 'helier', '5629500575ffe706d9d57fca5472153e', '2014-05-23 18:37:42', 0, '1', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `idVenta` int(11) NOT NULL AUTO_INCREMENT,
  `idCaja` int(11) DEFAULT NULL,
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
  `obs` varchar(200) NOT NULL,
  PRIMARY KEY (`idVenta`),
  KEY `fk_venta_cliente1` (`idCliente`),
  KEY `fk_venta_cajaVenta1` (`idCaja`)
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
-- Filtros para la tabla `cajaVenta`
--
ALTER TABLE `cajaVenta`
  ADD CONSTRAINT `fk_cajaVenta_caja1` FOREIGN KEY (`idCaja`) REFERENCES `caja` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cajaVenta_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleVenta`
--
ALTER TABLE `detalleVenta`
  ADD CONSTRAINT `fk_detalleVenta_almacenProducto1` FOREIGN KEY (`idAlmacenProducto`) REFERENCES `almacenProducto` (`idAlmacenProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleVenta_venta1` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `movimientoAlmacen`
--
ALTER TABLE `movimientoAlmacen`
  ADD CONSTRAINT `fk_movimientoAlmacen_almacen1` FOREIGN KEY (`idAlmacenOrigen`) REFERENCES `almacen` (`idAlmacen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoAlmacen_almacen2` FOREIGN KEY (`idAlmacenDestino`) REFERENCES `almacen` (`idAlmacen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoAlmacen_producto1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoAlmacen_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `movimientoCaja`
--
ALTER TABLE `movimientoCaja`
  ADD CONSTRAINT `fk_movimientoCaja_cajaVenta1` FOREIGN KEY (`idCaja`) REFERENCES `cajaVenta` (`idCajaVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoCaja_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD CONSTRAINT `fk_recibos_cajaVenta1` FOREIGN KEY (`idCaja`) REFERENCES `cajaVenta` (`idCajaVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recibos_cliente1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_empleado1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_cajaVenta1` FOREIGN KEY (`idCaja`) REFERENCES `cajaVenta` (`idCajaVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_cliente1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
