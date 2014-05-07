-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-05-2014 a las 14:35:01
-- Versión del servidor: 5.5.37
-- Versión de PHP: 5.4.4-14+deb7u9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `singularTest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE IF NOT EXISTS `almacen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) NOT NULL,
  `idTipoAlmacen` int(11) NOT NULL,
  `stockUnidad` int(11) NOT NULL,
  `stockPaquete` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saldo` float NOT NULL,
  `fechaArqueo` datetime NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `obs` varchar(200) NOT NULL,
  `arqueo` int(11) NOT NULL,
  `entregado` float NOT NULL,
  `comprovante` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `saldo`, `fechaArqueo`, `nombre`, `obs`, `arqueo`, `entregado`, `comprovante`) VALUES
(1, 0, '0000-00-00 00:00:00', 'papeles', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nitCi` varchar(15) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito`
--

CREATE TABLE IF NOT EXISTS `credito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idVenta` int(11) NOT NULL,
  `monto` float NOT NULL,
  `saldo` float NOT NULL,
  `fechaPago` datetime NOT NULL,
  `idRecibo` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleVenta`
--

CREATE TABLE IF NOT EXISTS `detalleVenta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idVenta` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idAlmacen` int(11) NOT NULL,
  `cantUnidad` int(11) NOT NULL,
  `cantPaquete` int(11) NOT NULL,
  `adicional` varchar(20) NOT NULL,
  `costoTotal` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `ci` varchar(20) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `turno` varchar(50) NOT NULL,
  `sueldo` int(11) NOT NULL,
  `skype` varchar(100) NOT NULL,
  `face` varchar(100) NOT NULL,
  `sucursal` int(11) NOT NULL,
  `superior` int(11) NOT NULL,
  `fechaIngreso` datetime NOT NULL,
  `idUsers` int(11) NOT NULL,
  `obs` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombres`, `apellidos`, `ci`, `telefono`, `email`, `cargo`, `turno`, `sueldo`, `skype`, `face`, `sucursal`, `superior`, `fechaIngreso`, `idUsers`, `obs`) VALUES
(1, 'Helier', 'Cortez', '5999242', '73221183', '', 'sistemas', '', 1000, 'helier20', '', 1, 0, '2014-02-23 00:00:00', 1, ''),
(2, 'Erika', 'Lecoña Castro', '4846615', '', '', 'Papeles', '', 0, '', '', 1, 0, '1969-12-31 00:00:00', 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `calle` varchar(500) NOT NULL,
  `maps` varchar(1000) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `correo` varchar(500) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `horarios` varchar(50) NOT NULL,
  `skype` varchar(500) NOT NULL,
  `facebook` varchar(500) NOT NULL,
  `patern` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `ciudad`, `calle`, `maps`, `fax`, `correo`, `telefono`, `horarios`, `skype`, `facebook`, `patern`) VALUES
(1, 'Singular Central', 'La Paz', 'Juan de la Riva', '', '', 'demo@demo.com', '123456', '9:00 a 13:00 / 14:30 a 19:30', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresaServicio`
--

CREATE TABLE IF NOT EXISTS `empresaServicio` (
  `idEmpresa` int(11) NOT NULL,
  `idServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Industria`
--

CREATE TABLE IF NOT EXISTS `Industria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `detalle` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientoAlmacen`
--

CREATE TABLE IF NOT EXISTS `movimientoAlmacen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpleado` int(11) NOT NULL,
  `idAlmacen` int(11) NOT NULL,
  `unidad` int(11) NOT NULL,
  `paquete` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFinal` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientoCaja`
--

CREATE TABLE IF NOT EXISTS `movimientoCaja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCaja` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` int(11) NOT NULL,
  `obs` varchar(200) NOT NULL,
  `tipo` int(11) NOT NULL,
  `idComprovante` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  `peso` varchar(10) NOT NULL,
  `idColor` int(11) NOT NULL,
  `dimension` varchar(20) NOT NULL,
  `procedencia` varchar(20) NOT NULL,
  `costoSF` double NOT NULL,
  `costoSFUnidad` double NOT NULL,
  `costoCF` double NOT NULL,
  `costoCFUnidad` double NOT NULL,
  `idIndustria` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `obs` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nit` varchar(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `obs` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nit` (`nit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo`
--

CREATE TABLE IF NOT EXISTS `recibo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `responsable` varchar(50) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `fecha` datetime NOT NULL,
  `concepto` varchar(200) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `idTrabajo` int(11) NOT NULL,
  `monto` float NOT NULL,
  `acuenta` float NOT NULL,
  `saldo` float NOT NULL,
  `obs` varchar(500) NOT NULL,
  `tipo` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `idCaja` int(11) NOT NULL,
  `descuento` varchar(50) NOT NULL,
  `nro` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `detalle` varchar(500) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `idParent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `detalle`, `fechaCreacion`, `idParent`) VALUES
(1, 'Imprenta', 'imprenta', '2014-03-13 00:00:00', 0),
(2, 'CTP', 'ctp', '2014-03-14 00:00:00', 0),
(3, 'Editorial', 'Editorial', '2014-03-19 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoAlmacen`
--

CREATE TABLE IF NOT EXISTS `tipoAlmacen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipoAlmacen`
--

INSERT INTO `tipoAlmacen` (`id`, `nombre`) VALUES
(1, 'Deposito Central'),
(2, 'Tienda Distribuidora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(150) NOT NULL,
  `fechaLogin` datetime NOT NULL,
  `estado` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fechaLogin`, `estado`, `tipo`) VALUES
(1, 'helier', '5629500575ffe706d9d57fca5472153e', '2014-05-05 18:38:31', 0, 'admin'),
(2, 'erika', 'e10adc3949ba59abbe56e057f20f883e', '2014-04-30 16:19:21', 0, 'ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCaja` int(11) NOT NULL,
  `tipoPago` int(11) NOT NULL,
  `formaPago` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `fechaVenta` datetime NOT NULL,
  `fechaPlazo` datetime NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `montoTotal` float NOT NULL,
  `montoPagado` float NOT NULL,
  `montoCambio` float NOT NULL,
  `montoDescuento` float NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `factura` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `autorizado` varchar(50) NOT NULL,
  `obs` varchar(200) NOT NULL,
  `serie` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;