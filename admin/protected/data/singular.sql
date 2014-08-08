-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-08-2014 a las 15:20:35
-- Versión del servidor: 5.5.38
-- Versión de PHP: 5.4.4-14+deb7u12

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=709 ;

--
-- Volcado de datos para la tabla `almacenProducto`
--

INSERT INTO `almacenProducto` (`idAlmacenProducto`, `idProducto`, `stockU`, `stockP`, `idAlmacen`) VALUES
(1, 1, 0, 0, 1),
(3, 2, 0, 0, 1),
(4, 3, 0, 0, 1),
(5, 4, 0, 36, 1),
(6, 5, 0, 0, 1),
(7, 6, 0, 0, 1),
(8, 7, 0, 15, 1),
(9, 8, 0, 0, 1),
(10, 9, 0, 0, 1),
(11, 10, 0, 11, 1),
(12, 11, 0, 0, 1),
(13, 12, 0, 0, 1),
(14, 13, 0, 0, 1),
(15, 14, 0, 0, 1),
(16, 15, 0, 5, 1),
(17, 16, 0, 0, 1),
(18, 17, 0, 23, 1),
(19, 18, 0, 0, 1),
(20, 19, 0, 0, 1),
(21, 20, 0, 11, 1),
(22, 21, 0, 36, 1),
(24, 23, 0, 9, 1),
(25, 24, 0, 0, 1),
(26, 25, 0, 5, 1),
(27, 26, 0, 7, 1),
(28, 27, 0, 0, 1),
(29, 28, 0, 10, 1),
(30, 29, 0, 0, 1),
(31, 30, 0, 0, 1),
(32, 31, 0, 17, 1),
(33, 32, 0, 0, 1),
(34, 33, 0, 10, 1),
(35, 34, 0, 5, 1),
(36, 35, 0, 10, 1),
(37, 36, 0, 10, 1),
(38, 37, 0, 10, 1),
(39, 38, 0, 5, 1),
(40, 39, 0, 4, 1),
(41, 40, 0, 15, 1),
(42, 41, 0, 0, 1),
(43, 42, 0, 14, 1),
(44, 43, 0, 22, 1),
(45, 44, 0, 11, 1),
(46, 45, 0, 10, 1),
(47, 46, 0, 15, 1),
(48, 47, 0, 14, 1),
(49, 48, 0, 6, 1),
(50, 49, 0, 11, 1),
(51, 50, 0, 13, 1),
(52, 51, 0, 7, 1),
(53, 52, 0, 0, 1),
(54, 53, 0, 0, 1),
(55, 54, 0, 0, 1),
(56, 55, 0, 9, 1),
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
(91, 82, 0, 2, 1),
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
(119, 110, 0, 8, 1),
(120, 111, 0, 21, 1),
(121, 112, 0, 13, 1),
(122, 113, 0, 11, 1),
(123, 114, 0, 11, 1),
(124, 115, 0, 3, 1),
(125, 116, 0, 12, 1),
(435, 1, 26, 0, 2),
(436, 2, 1, 9, 2),
(437, 45, 97, 0, 2),
(438, 47, 53, 0, 2),
(439, 44, 45, 9, 2),
(440, 46, 26, 1, 2),
(441, 48, 31, 1, 2),
(442, 29, 0, 10, 2),
(443, 103, 72, 0, 2),
(444, 31, 40, 3, 2),
(445, 30, 0, 0, 2),
(446, 32, 25, 0, 2),
(447, 109, 4, 0, 2),
(448, 108, 0, 0, 2),
(449, 19, 62, 0, 2),
(450, 18, 74, 6, 2),
(451, 106, 0, 0, 2),
(452, 26, 14, 1, 2),
(453, 28, 0, 0, 2),
(454, 105, 0, 0, 2),
(455, 107, 26, 2, 2),
(458, 27, 60, 0, 2),
(459, 104, 6, 0, 2),
(461, 77, 0, 0, 2),
(464, 4, 42, 8, 2),
(466, 74, 223, 0, 2),
(468, 9, 94, 0, 2),
(469, 79, 46, 0, 2),
(472, 6, 220, 0, 2),
(474, 76, 24, 0, 2),
(476, 3, 0, 0, 2),
(477, 8, 85, 5, 2),
(480, 78, 0, 0, 2),
(481, 5, 0, 0, 2),
(483, 75, 22, 0, 2),
(485, 7, 10, 0, 2),
(488, 85, 0, 0, 2),
(489, 93, 5, 0, 2),
(491, 82, 50, 0, 2),
(499, 90, 0, 0, 2),
(500, 87, 164, 0, 2),
(502, 84, 0, 0, 2),
(503, 92, 38, 0, 2),
(504, 81, 163, 0, 2),
(505, 89, 0, 0, 2),
(506, 86, 0, 0, 2),
(507, 83, 0, 0, 2),
(508, 91, 23, 0, 2),
(509, 10, 21, 2, 2),
(510, 80, 50, 4, 2),
(511, 88, 106, 7, 2),
(512, 101, 0, 0, 2),
(513, 12, 72, 0, 2),
(514, 20, 32, 4, 2),
(515, 98, 0, 0, 2),
(516, 17, 145, 6, 2),
(517, 95, 0, 0, 2),
(518, 14, 136, 1, 2),
(519, 100, 77, 2, 2),
(520, 11, 12, 0, 2),
(521, 97, 103, 0, 2),
(522, 16, 0, 0, 2),
(523, 25, 204, 12, 2),
(524, 94, 351, 0, 2),
(525, 102, 0, 0, 2),
(526, 13, 0, 2, 2),
(527, 21, 370, 3, 2),
(528, 99, 0, 0, 2),
(529, 96, 0, 0, 2),
(530, 15, 223, 7, 2),
(531, 42, 352, 3, 2),
(532, 111, 22, 3, 2),
(533, 39, 345, 3, 2),
(534, 110, 478, 2, 2),
(535, 40, 50, 3, 2),
(536, 114, 297, 1, 2),
(537, 116, 203, 1, 2),
(538, 113, 134, 2, 2),
(539, 115, 278, 1, 2),
(540, 112, 7, 2, 2),
(541, 37, 127, 1, 2),
(542, 36, 149, 1, 2),
(543, 41, 375, 0, 2),
(544, 38, 20, 1, 2),
(545, 35, 405, 1, 2),
(546, 43, 245, 2, 2),
(547, 117, 0, 0, 1),
(548, 118, 12, 0, 1),
(549, 119, 0, 0, 1),
(550, 120, 0, 0, 1),
(551, 121, 0, 0, 1),
(552, 122, 0, 0, 1),
(553, 123, 0, 0, 1),
(554, 124, 0, 0, 1),
(555, 125, 0, 0, 1),
(556, 126, 0, 0, 1),
(557, 127, 0, 0, 1),
(558, 128, 0, 0, 1),
(559, 129, 0, 0, 1),
(560, 130, 0, 0, 1),
(561, 131, 0, 0, 1),
(562, 132, 0, 0, 1),
(563, 133, 0, 0, 1),
(564, 134, 0, 0, 1),
(565, 135, 0, 0, 1),
(566, 136, 0, 0, 1),
(567, 137, 0, 0, 1),
(568, 138, 0, 0, 1),
(569, 139, 0, 0, 1),
(570, 140, 0, 25, 1),
(571, 141, 0, 0, 1),
(572, 142, 0, 0, 1),
(573, 143, 0, 0, 1),
(574, 144, 0, 2, 1),
(575, 24, 25, 0, 2),
(576, 140, 217, 0, 2),
(577, 23, 28, 0, 2),
(578, 141, 0, 0, 2),
(579, 143, 0, 4, 2),
(580, 144, 52, 0, 2),
(581, 142, 0, 0, 2),
(582, 121, 0, 0, 2),
(583, 181, 0, 0, 3),
(584, 145, 0, 0, 1),
(585, 145, 0, 0, 2),
(586, 146, 0, 0, 1),
(587, 147, 0, 0, 1),
(588, 148, 0, 0, 1),
(589, 149, 0, 0, 1),
(590, 150, 0, 0, 1),
(591, 151, 0, 0, 1),
(592, 152, 0, 0, 1),
(593, 153, 0, 0, 1),
(594, 154, 0, 0, 1),
(595, 155, 0, 0, 1),
(596, 156, 0, 0, 1),
(597, 157, 0, 0, 1),
(598, 158, 0, 0, 1),
(599, 159, 0, 0, 1),
(600, 160, 0, 0, 1),
(601, 161, 0, 0, 1),
(602, 162, 0, 0, 1),
(603, 163, 0, 0, 1),
(604, 164, 0, 0, 1),
(605, 165, 0, 0, 1),
(606, 166, 0, 0, 1),
(607, 167, 0, 0, 1),
(608, 168, 0, 0, 1),
(609, 169, 0, 0, 1),
(610, 170, 0, 0, 1),
(611, 171, 0, 0, 1),
(612, 172, 0, 0, 1),
(613, 173, 0, 0, 1),
(614, 174, 0, 0, 1),
(615, 175, 0, 0, 1),
(616, 176, 0, 0, 1),
(617, 177, 0, 0, 1),
(618, 178, 0, 0, 1),
(619, 179, 0, 0, 1),
(620, 180, 0, 0, 1),
(621, 171, 0, 0, 2),
(622, 170, 2, 0, 2),
(623, 55, 13, 0, 2),
(624, 54, 5, 0, 2),
(625, 150, 2, 0, 2),
(626, 153, 1, 0, 2),
(627, 148, 2, 0, 2),
(628, 151, 0, 0, 2),
(629, 154, 0, 0, 2),
(630, 146, 0, 0, 2),
(631, 53, 8, 0, 2),
(632, 149, 2, 0, 2),
(633, 152, 0, 0, 2),
(634, 147, 3, 0, 2),
(635, 49, 11, 0, 2),
(636, 52, 0, 0, 2),
(637, 50, 10, 0, 2),
(638, 51, 1, 0, 2),
(639, 56, 17, 0, 2),
(640, 59, 0, 0, 2),
(641, 174, 15, 0, 2),
(642, 172, 112, 0, 2),
(643, 173, 25, 0, 2),
(644, 66, 18, 0, 2),
(645, 62, 18, 0, 2),
(646, 58, 4, 0, 2),
(647, 169, 0, 0, 2),
(648, 164, 0, 0, 2),
(649, 165, 0, 0, 2),
(650, 70, 52, 0, 2),
(651, 73, 0, 0, 2),
(652, 68, 82, 0, 2),
(653, 71, 71, 0, 2),
(654, 69, 0, 0, 2),
(655, 67, 0, 0, 2),
(656, 156, 0, 0, 2),
(657, 157, 115, 0, 2),
(658, 72, 76, 0, 2),
(659, 155, 122, 0, 2),
(660, 129, 0, 0, 2),
(661, 134, 200, 1, 2),
(662, 132, 0, 0, 2),
(663, 130, 0, 4, 2),
(664, 133, 345, 3, 2),
(665, 131, 0, 0, 2),
(666, 137, 450, 2, 2),
(667, 135, 0, 8, 2),
(668, 138, 0, 0, 2),
(669, 136, 0, 0, 2),
(670, 139, 0, 1, 2),
(671, 118, 0, 0, 2),
(672, 119, 0, 0, 2),
(673, 33, 0, 0, 2),
(674, 34, 196, 4, 2),
(675, 126, 0, 0, 2),
(676, 124, 0, 0, 2),
(677, 127, 0, 0, 2),
(678, 125, 0, 0, 2),
(679, 128, 0, 0, 2),
(680, 122, 0, 0, 2),
(681, 117, 0, 0, 2),
(682, 120, 0, 0, 2),
(683, 123, 0, 0, 2),
(684, 180, 0, 0, 2),
(685, 158, 8, 0, 2),
(686, 161, 2, 0, 2),
(687, 159, 3, 0, 2),
(688, 160, 8, 0, 2),
(689, 162, 0, 0, 2),
(690, 163, 2073, 0, 2),
(691, 64, 10, 0, 2),
(692, 61, 7, 0, 2),
(693, 179, 18, 0, 2),
(694, 176, 40, 0, 2),
(695, 178, 0, 0, 2),
(696, 175, 24, 0, 2),
(697, 177, 19, 0, 2),
(698, 63, 15, 0, 2),
(699, 57, 0, 0, 2),
(700, 168, 10, 0, 2),
(701, 60, 0, 0, 2),
(702, 166, 0, 0, 2),
(703, 167, 0, 0, 2),
(704, 181, 0, 0, 1),
(705, 182, 0, 0, 1),
(706, 182, 129, 0, 2),
(707, 183, 0, 9, 1),
(708, 183, 17, 0, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`idCaja`, `nombre`, `saldo`, `idParent`) VALUES
(1, 'administracion', 0, NULL),
(2, 'distribuidora', 0, 1),
(3, 'CTP', 0, 1),
(4, 'Imprenta', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajaArqueo`
--

CREATE TABLE IF NOT EXISTS `cajaArqueo` (
  `idCajaArqueo` int(11) NOT NULL AUTO_INCREMENT,
  `idCaja` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `monto` double NOT NULL,
  `fechaArqueo` datetime DEFAULT NULL,
  `fechaVentas` datetime DEFAULT NULL,
  `comprobante` varchar(20) DEFAULT NULL,
  `saldo` double NOT NULL,
  PRIMARY KEY (`idCajaArqueo`),
  KEY `fk_cajaVenta_caja1` (`idCaja`),
  KEY `fk_cajaVenta_user1` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajaChica`
--

CREATE TABLE IF NOT EXISTS `cajaChica` (
  `idcajaChica` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `idCaja` int(11) DEFAULT NULL,
  `saldo` double NOT NULL,
  `maximo` double DEFAULT NULL,
  `detalle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idcajaChica`),
  KEY `fk_cajaChica_caja1` (`idCaja`),
  KEY `fk_cajaChica_user1` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cajaChica`
--

INSERT INTO `cajaChica` (`idcajaChica`, `idUser`, `idCaja`, `saldo`, `maximo`, `detalle`) VALUES
(1, 1, 4, 0, 2000, 'Caja chica de prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajaChicaMovimiento`
--

CREATE TABLE IF NOT EXISTS `cajaChicaMovimiento` (
  `idcajaChicaMovimiento` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `idTipoMovimiento` int(11) DEFAULT NULL,
  `monto` double NOT NULL,
  `saldo` double NOT NULL,
  `fechaMovimiento` datetime NOT NULL,
  `tipoMovimiento` int(11) DEFAULT NULL,
  `idcajaChica` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcajaChicaMovimiento`),
  KEY `fk_cajaChicaMovimiento_cajaChica1` (`idcajaChica`),
  KEY `fk_cajaChicaMovimiento_TipoMovimiento1` (`tipoMovimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajaChicaTipo`
--

CREATE TABLE IF NOT EXISTS `cajaChicaTipo` (
  `idcajaChicaTipo` int(11) NOT NULL AUTO_INCREMENT,
  `idcajaChica` int(11) NOT NULL,
  `idTipoMovimiento` int(11) NOT NULL,
  PRIMARY KEY (`idcajaChicaTipo`),
  KEY `fk_cajaChicaTipo_TipoMovimiento1` (`idTipoMovimiento`),
  KEY `fk_cajaChicaTipo_cajaChica1` (`idcajaChica`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `cajaChicaTipo`
--

INSERT INTO `cajaChicaTipo` (`idcajaChicaTipo`, `idcajaChica`, `idTipoMovimiento`) VALUES
(8, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajaMovimientoVenta`
--

CREATE TABLE IF NOT EXISTS `cajaMovimientoVenta` (
  `idCajaMovimientoVenta` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `monto` double NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `fechaMovimiento` datetime DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `arqueo` int(11) DEFAULT NULL,
  `idCaja` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCajaMovimientoVenta`),
  KEY `fk_movimientoCaja_user1` (`idUser`),
  KEY `fk_cajaMovimientoVenta_caja1` (`idCaja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidadCTP`
--

CREATE TABLE IF NOT EXISTS `cantidadCTP` (
  `idCantidadCTP` int(11) NOT NULL AUTO_INCREMENT,
  `Inicio` int(11) DEFAULT NULL,
  `final` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCantidadCTP`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `cantidadCTP`
--

INSERT INTO `cantidadCTP` (`idCantidadCTP`, `Inicio`, `final`) VALUES
(1, 1, 24),
(2, 25, 60),
(3, 61, 120),
(9, 121, 200);

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
  `idTiposClientes` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCliente`),
  KEY `fk_cliente_TiposClientes1` (`idTiposClientes`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nitCi`, `apellido`, `nombre`, `correo`, `fechaRegistro`, `telefono`, `direccion`, `idTiposClientes`) VALUES
(1, '00072', 'vargas', NULL, NULL, '2014-06-17 00:00:00', NULL, NULL, NULL),
(2, '4852444019', 'mariño', NULL, NULL, '2014-06-17 00:00:00', NULL, NULL, NULL),
(3, '5999242', 'Cortez', NULL, NULL, '2014-06-27 00:00:00', '', NULL, NULL),
(4, '3442350015', 'vasquez', NULL, NULL, '2014-07-17 00:00:00', NULL, NULL, NULL),
(5, '6765717019', 'CAMINO', NULL, NULL, '2014-07-18 00:00:00', NULL, NULL, NULL),
(6, '8435336', 'PINEDO', NULL, NULL, '2014-07-21 00:00:00', NULL, NULL, NULL),
(7, '2364915011', 'TICONA', NULL, NULL, '2014-07-21 00:00:00', NULL, NULL, NULL),
(8, '4865513019', 'VILLA', NULL, NULL, '2014-07-25 00:00:00', NULL, NULL, NULL),
(9, '000', 'singular', 'singular', '', '2014-08-01 15:26:36', '73221183', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CTP`
--

CREATE TABLE IF NOT EXISTS `CTP` (
  `idCTP` int(11) NOT NULL AUTO_INCREMENT,
  `fechaOrden` datetime DEFAULT NULL,
  `tipoOrden` int(11) DEFAULT NULL,
  `formaPago` int(11) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `fechaPlazo` datetime DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `serie` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `montoVenta` double NOT NULL,
  `montoPagado` double NOT NULL,
  `montoCambio` double NOT NULL,
  `montoDescuento` double NOT NULL,
  `estado` int(11) NOT NULL,
  `factura` varchar(50) DEFAULT NULL,
  `autorizado` varchar(50) DEFAULT NULL,
  `responsable` varchar(50) DEFAULT NULL,
  `obs` varchar(200) DEFAULT NULL,
  `idCajaMovimientoVenta` int(11) DEFAULT NULL,
  `idUserOT` int(11) DEFAULT NULL,
  `idUserVenta` int(11) DEFAULT NULL,
  `idImprenta` int(11) DEFAULT NULL,
  `idCTPParent` int(11) DEFAULT NULL,
  `tipoCTP` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCTP`),
  KEY `fk_venta_cliente1` (`idCliente`),
  KEY `fk_venta_cajaMovimientoVenta1` (`idCajaMovimientoVenta`),
  KEY `fk_CTP_user1` (`idUserOT`),
  KEY `fk_CTP_user2` (`idUserVenta`),
  KEY `fk_CTP_Imprenta1` (`idImprenta`),
  KEY `fk_CTP_CTP1` (`idCTPParent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `CTP`
--

INSERT INTO `CTP` (`idCTP`, `fechaOrden`, `tipoOrden`, `formaPago`, `idCliente`, `fechaPlazo`, `codigo`, `serie`, `numero`, `montoVenta`, `montoPagado`, `montoCambio`, `montoDescuento`, `estado`, `factura`, `autorizado`, `responsable`, `obs`, `idCajaMovimientoVenta`, `idUserOT`, `idUserVenta`, `idImprenta`, `idCTPParent`, `tipoCTP`) VALUES
(1, '2014-08-07 17:05:23', 1, 1, 9, NULL, 'AC-1-14', 65, 1, 0, 0, 0, 0, 1, NULL, NULL, 'helier cortez', '', NULL, 1, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleCTP`
--

CREATE TABLE IF NOT EXISTS `detalleCTP` (
  `idDetalleCTP` int(11) NOT NULL AUTO_INCREMENT,
  `idCTP` int(11) DEFAULT NULL,
  `idAlmacenProducto` int(11) DEFAULT NULL,
  `nroPlacas` int(11) DEFAULT NULL,
  `formato` varchar(50) DEFAULT NULL,
  `trabajo` varchar(100) DEFAULT NULL,
  `pinza` int(11) DEFAULT NULL,
  `resolucion` double DEFAULT NULL,
  `costo` double NOT NULL,
  `costoAdicional` double NOT NULL,
  `costoTotal` double NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `C` tinyint(1) DEFAULT NULL,
  `M` tinyint(1) DEFAULT NULL,
  `Y` tinyint(1) DEFAULT NULL,
  `K` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idDetalleCTP`),
  KEY `fk_detalleCTP_CTP1` (`idCTP`),
  KEY `fk_detalleCTP_almacenProducto1` (`idAlmacenProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `detalleCTP`
--

INSERT INTO `detalleCTP` (`idDetalleCTP`, `idCTP`, `idAlmacenProducto`, `nroPlacas`, `formato`, `trabajo`, `pinza`, `resolucion`, `costo`, `costoAdicional`, `costoTotal`, `estado`, `C`, `M`, `Y`, `K`) VALUES
(1, 1, 583, 4, 'MO 015', 'afiche', 6, 175, 0, 2, 0, NULL, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleVenta`
--

CREATE TABLE IF NOT EXISTS `detalleVenta` (
  `idDetalleVenta` int(11) NOT NULL AUTO_INCREMENT,
  `idVenta` int(11) DEFAULT NULL,
  `cantidadU` int(11) NOT NULL,
  `costoU` double NOT NULL,
  `cantidadP` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombre`, `apellido`, `fechaRegistro`, `email`, `telefono`, `ci`) VALUES
(1, 'Erick', 'Paredes', NULL, '', '', ''),
(2, 'Helier', 'Cortez', NULL, 'hdnymib@gmail.com', '73221183', '5999242'),
(3, 'Erika', 'Lecoña ', '2014-05-26 15:46:49', '', '', '4846615'),
(4, 'sergio', '', '2014-07-07 17:58:35', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `idHorario` int(11) NOT NULL AUTO_INCREMENT,
  `inicio` time DEFAULT NULL,
  `final` time DEFAULT NULL,
  `prioridad` int(11) DEFAULT NULL,
  PRIMARY KEY (`idHorario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idHorario`, `inicio`, `final`, `prioridad`) VALUES
(1, '06:00:00', '19:00:00', 0),
(2, '19:01:00', '05:59:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Imprenta`
--

CREATE TABLE IF NOT EXISTS `Imprenta` (
  `idImprenta` int(11) NOT NULL AUTO_INCREMENT,
  `fechaOrden` datetime DEFAULT NULL,
  `tipoOrden` int(11) DEFAULT NULL,
  `formaPago` int(11) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `fechaPlazo` datetime DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `serie` int(11) DEFAULT NULL,
  `montoVenta` double NOT NULL,
  `montoPagado` double NOT NULL,
  `montoCambio` double NOT NULL,
  `montoDescuento` double NOT NULL,
  `estado` int(11) NOT NULL,
  `factura` varchar(50) DEFAULT NULL,
  `autorizado` varchar(50) DEFAULT NULL,
  `responsable` varchar(50) DEFAULT NULL,
  `obs` varchar(200) DEFAULT NULL,
  `idCajaMovimientoVenta` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `idUserOT` int(11) NOT NULL,
  `idUserVenta` int(11) NOT NULL,
  PRIMARY KEY (`idImprenta`),
  KEY `fk_venta_cliente1` (`idCliente`),
  KEY `fk_venta_cajaMovimientoVenta1` (`idCajaMovimientoVenta`),
  KEY `fk_CTP_user1` (`idUserOT`),
  KEY `fk_CTP_user2` (`idUserVenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MatrizPreciosCTP`
--

CREATE TABLE IF NOT EXISTS `MatrizPreciosCTP` (
  `idMatrizPreciosCTP` int(11) NOT NULL AUTO_INCREMENT,
  `idTiposClientes` int(11) DEFAULT NULL,
  `idHorario` int(11) DEFAULT NULL,
  `idCantidad` int(11) DEFAULT NULL,
  `idAlmacenProducto` int(11) DEFAULT NULL,
  `precioSF` double NOT NULL,
  `precioCF` double NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMatrizPreciosCTP`),
  KEY `fk_MatrizPreciosCTP_horario1` (`idHorario`),
  KEY `fk_MatrizPreciosCTP_cantidadCTP1` (`idCantidad`),
  KEY `fk_MatrizPreciosCTP_TiposClientes1` (`idTiposClientes`),
  KEY `fk_MatrizPreciosCTP_almacenProductos1` (`idAlmacenProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `MatrizPreciosCTP`
--

INSERT INTO `MatrizPreciosCTP` (`idMatrizPreciosCTP`, `idTiposClientes`, `idHorario`, `idCantidad`, `idAlmacenProducto`, `precioSF`, `precioCF`, `nombre`) VALUES
(6, 1, 1, 1, 583, 1.7, 1, NULL),
(7, 1, 2, 1, 583, 0, 0, NULL),
(8, 1, 1, 2, 583, 1, 0, NULL),
(9, 1, 2, 2, 583, 0, 0, NULL),
(10, 1, 1, 3, 583, 0, 0, NULL),
(11, 1, 2, 3, 583, 0, 0, NULL),
(16, 3, 1, 1, 583, 0, 0, NULL),
(17, 3, 2, 1, 583, 0, 0, NULL),
(18, 3, 1, 2, 583, 0, 0, NULL),
(19, 3, 2, 2, 583, 0, 0, NULL),
(20, 3, 1, 3, 583, 0, 0, NULL),
(21, 3, 2, 3, 583, 0, 0, NULL),
(30, 1, 1, 9, 583, 0, 0, NULL),
(31, 1, 2, 9, 583, 0, 0, NULL),
(32, 3, 1, 9, 583, 0, 0, NULL),
(33, 3, 2, 9, 583, 0, 0, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=349 ;

--
-- Volcado de datos para la tabla `movimientoAlmacen`
--

INSERT INTO `movimientoAlmacen` (`idMovimientoAlmacen`, `idProducto`, `idAlmacenOrigen`, `idAlmacenDestino`, `cantidadU`, `cantidadP`, `idUser`, `fechaMovimiento`) VALUES
(109, 74, NULL, 1, 223, 4, NULL, '2014-08-04 11:48:57'),
(110, 2, NULL, 1, 1, 9, NULL, '2014-08-04 11:49:21'),
(111, 4, NULL, 1, 42, 44, NULL, '2014-08-04 11:49:49'),
(112, 6, NULL, 1, 220, NULL, NULL, '2014-08-04 11:50:18'),
(113, 76, NULL, 1, 24, NULL, NULL, '2014-08-04 11:50:34'),
(114, 8, NULL, 1, 85, 5, NULL, '2014-08-04 11:51:10'),
(115, 79, NULL, 1, 46, NULL, NULL, '2014-08-04 11:51:37'),
(116, 7, NULL, 1, 10, 15, NULL, '2014-08-04 11:52:59'),
(117, 1, NULL, 1, 26, NULL, NULL, '2014-08-04 11:53:17'),
(118, 75, NULL, 1, 22, NULL, NULL, '2014-08-04 11:53:31'),
(119, 9, NULL, 1, 94, NULL, NULL, '2014-08-04 11:53:49'),
(120, 80, NULL, 1, 50, 4, NULL, '2014-08-04 11:54:24'),
(121, 81, NULL, 1, 163, NULL, NULL, '2014-08-04 11:54:36'),
(122, 82, NULL, 1, 50, 2, NULL, '2014-08-04 11:54:48'),
(123, 87, NULL, 1, 164, NULL, NULL, '2014-08-04 11:55:14'),
(124, 88, NULL, 1, 106, 7, NULL, '2014-08-04 11:55:30'),
(125, 91, NULL, 1, 23, NULL, NULL, '2014-08-04 11:55:59'),
(126, 92, NULL, 1, 38, NULL, NULL, '2014-08-04 11:56:16'),
(127, 93, NULL, 1, 5, NULL, NULL, '2014-08-04 11:56:31'),
(128, 10, NULL, 1, 21, 13, NULL, '2014-08-04 11:56:48'),
(129, 17, NULL, 1, 145, 29, NULL, '2014-08-04 11:57:23'),
(130, 94, NULL, 1, NULL, 351, NULL, '2014-08-04 11:57:50'),
(131, 11, NULL, 1, 12, NULL, NULL, '2014-08-04 11:58:05'),
(132, 21, NULL, 1, 39, 370, NULL, '2014-08-04 11:58:46'),
(133, 20, NULL, 1, 32, 15, NULL, '2014-08-04 11:59:02'),
(134, 13, NULL, 1, NULL, 2, NULL, '2014-08-04 11:59:32'),
(135, 14, NULL, 1, 136, 1, NULL, '2014-08-04 12:00:06'),
(136, 12, NULL, 1, 72, NULL, NULL, '2014-08-04 12:00:51'),
(137, 25, NULL, 1, 204, 17, NULL, '2014-08-04 12:01:14'),
(138, 15, NULL, 1, 223, 12, NULL, '2014-08-04 12:01:46'),
(139, 97, NULL, 1, 103, NULL, NULL, '2014-08-04 12:04:02'),
(140, 100, NULL, 1, 77, 2, NULL, '2014-08-04 12:04:47'),
(141, 101, NULL, 1, NULL, 5, NULL, '2014-08-04 12:05:15'),
(142, 29, NULL, 1, NULL, 10, NULL, '2014-08-04 12:05:37'),
(143, 31, NULL, 1, 40, 20, NULL, '2014-08-04 12:05:56'),
(144, 32, NULL, 1, 25, NULL, NULL, '2014-08-04 12:06:12'),
(145, 103, NULL, 1, 72, NULL, NULL, '2014-08-04 12:06:27'),
(146, 104, NULL, 1, 6, NULL, NULL, '2014-08-04 12:06:46'),
(147, 26, NULL, 1, 14, 8, NULL, '2014-08-04 12:06:58'),
(148, 27, NULL, 1, 60, NULL, NULL, '2014-08-04 12:07:11'),
(149, 28, NULL, 1, NULL, 10, NULL, '2014-08-04 12:07:28'),
(150, 107, NULL, 1, 26, 2, NULL, '2014-08-04 12:07:43'),
(151, 109, NULL, 1, 4, NULL, NULL, '2014-08-04 12:08:12'),
(152, 19, NULL, 1, 62, NULL, NULL, '2014-08-04 12:08:22'),
(153, 18, NULL, 1, 74, 6, NULL, '2014-08-04 12:08:33'),
(154, 45, NULL, 1, 97, 10, NULL, '2014-08-04 12:09:00'),
(155, 44, NULL, 1, 45, 20, NULL, '2014-08-04 12:09:15'),
(156, 48, NULL, 1, 31, 7, NULL, '2014-08-04 12:09:29'),
(157, 46, NULL, 1, 26, 16, NULL, '2014-08-04 12:10:14'),
(158, 47, NULL, 1, 53, 14, NULL, '2014-08-04 12:10:25'),
(159, 42, NULL, 1, 352, 17, NULL, '2014-08-04 12:11:03'),
(160, 39, NULL, 1, 345, 7, NULL, '2014-08-04 12:11:26'),
(161, 110, NULL, 1, 478, 10, NULL, '2014-08-04 12:11:43'),
(162, 111, NULL, 1, 22, 24, NULL, '2014-08-04 12:11:58'),
(163, 40, NULL, 1, 50, 18, NULL, '2014-08-04 12:12:11'),
(164, 43, NULL, 1, 245, 24, NULL, '2014-08-04 12:12:38'),
(165, 37, NULL, 1, 127, 11, NULL, '2014-08-04 12:13:05'),
(166, 35, NULL, 1, 405, 11, NULL, '2014-08-04 12:13:27'),
(167, 41, NULL, 1, 375, NULL, NULL, '2014-08-04 12:13:50'),
(168, 38, NULL, 1, 20, 6, NULL, '2014-08-04 12:14:06'),
(169, 36, NULL, 1, 149, 11, NULL, '2014-08-04 12:14:29'),
(170, 113, NULL, 1, 134, 13, NULL, '2014-08-04 12:14:51'),
(171, 112, NULL, 1, 7, 15, NULL, '2014-08-04 12:15:10'),
(172, 114, NULL, 1, 297, 12, NULL, '2014-08-04 12:15:28'),
(173, 116, NULL, 1, 203, 13, NULL, '2014-08-04 12:15:42'),
(174, 115, NULL, 1, 278, 4, NULL, '2014-08-04 12:15:55'),
(175, 118, NULL, 1, 12, NULL, NULL, '2014-08-04 12:16:11'),
(176, 34, NULL, 1, 196, 9, NULL, '2014-08-04 12:16:39'),
(177, 33, NULL, 1, NULL, 10, NULL, '2014-08-04 12:16:47'),
(178, 130, NULL, 1, NULL, 4, NULL, '2014-08-04 12:17:26'),
(179, 134, NULL, 1, 200, 1, NULL, '2014-08-04 12:17:45'),
(180, 133, NULL, 1, 345, 3, NULL, '2014-08-04 12:17:59'),
(181, 135, NULL, 1, NULL, 8, NULL, '2014-08-04 12:18:20'),
(182, 137, NULL, 1, 450, 2, NULL, '2014-08-04 12:18:37'),
(183, 139, NULL, 1, NULL, 1, NULL, '2014-08-04 12:18:50'),
(184, 23, NULL, 1, 28, 9, NULL, '2014-08-04 12:19:40'),
(185, 24, NULL, 1, 25, NULL, NULL, '2014-08-04 12:20:09'),
(186, 140, NULL, 1, 217, 25, NULL, '2014-08-04 12:20:48'),
(187, 182, NULL, 1, 129, NULL, NULL, '2014-08-04 12:23:15'),
(188, 143, NULL, 1, NULL, 4, NULL, '2014-08-04 12:24:13'),
(189, 144, NULL, 1, 52, 2, NULL, '2014-08-04 12:24:22'),
(190, 182, 1, 2, 129, NULL, NULL, '2014-08-04 12:26:47'),
(191, 140, 1, 2, 217, NULL, NULL, '2014-08-04 12:27:12'),
(192, 24, 1, 2, 25, NULL, NULL, '2014-08-04 12:27:25'),
(193, 23, 1, 2, 28, NULL, NULL, '2014-08-04 12:27:38'),
(194, 143, 1, 2, NULL, 4, NULL, '2014-08-04 12:28:20'),
(195, 144, 1, 2, 52, NULL, NULL, '2014-08-04 12:28:29'),
(196, 51, NULL, 1, 1, 7, NULL, '2014-08-04 12:30:07'),
(197, 49, NULL, 1, 11, 11, NULL, '2014-08-04 12:30:24'),
(198, 50, NULL, 1, 10, 13, NULL, '2014-08-04 12:30:53'),
(199, 53, NULL, 1, 8, NULL, NULL, '2014-08-04 12:31:25'),
(200, 149, NULL, 1, 2, NULL, NULL, '2014-08-04 12:32:11'),
(201, 153, NULL, 1, 1, NULL, NULL, '2014-08-04 12:32:33'),
(202, 54, NULL, 1, 5, NULL, NULL, '2014-08-04 12:33:48'),
(203, 148, NULL, 1, 2, NULL, NULL, '2014-08-04 12:34:16'),
(204, 147, NULL, 1, 3, NULL, NULL, '2014-08-04 12:40:19'),
(205, 150, NULL, 1, 2, NULL, NULL, '2014-08-04 12:40:40'),
(206, 55, NULL, 1, 13, 9, NULL, '2014-08-04 12:41:19'),
(207, 183, NULL, 1, 13, 9, NULL, '2014-08-04 12:42:43'),
(208, 183, NULL, 1, 4, NULL, NULL, '2014-08-04 12:43:05'),
(209, 72, NULL, 1, 76, NULL, NULL, '2014-08-04 12:43:40'),
(210, 155, NULL, 1, 122, NULL, NULL, '2014-08-04 12:43:59'),
(211, 157, NULL, 1, 115, NULL, NULL, '2014-08-04 12:44:30'),
(212, 71, NULL, 1, 71, NULL, NULL, '2014-08-04 12:45:08'),
(213, 68, NULL, 1, 82, NULL, NULL, '2014-08-04 12:45:31'),
(214, 70, NULL, 1, 52, NULL, NULL, '2014-08-04 12:45:50'),
(215, 66, NULL, 1, 18, NULL, NULL, '2014-08-04 12:46:24'),
(216, 62, NULL, 1, 18, NULL, NULL, '2014-08-04 12:46:37'),
(217, 64, NULL, 1, 10, NULL, NULL, '2014-08-04 12:46:57'),
(218, 58, NULL, 1, 4, NULL, NULL, '2014-08-04 12:47:06'),
(219, 56, NULL, 1, 17, NULL, NULL, '2014-08-04 12:47:30'),
(220, 63, NULL, 1, 15, NULL, NULL, '2014-08-04 12:47:50'),
(221, 61, NULL, 1, 7, NULL, NULL, '2014-08-04 12:48:08'),
(222, 158, NULL, 1, 8, NULL, NULL, '2014-08-04 12:48:35'),
(223, 159, NULL, 1, NULL, 3, NULL, '2014-08-04 12:48:53'),
(224, 161, NULL, 1, 2, NULL, NULL, '2014-08-04 12:49:06'),
(225, 160, NULL, 1, 8, NULL, NULL, '2014-08-04 12:49:16'),
(226, 163, NULL, 1, 2073, NULL, NULL, '2014-08-04 12:49:44'),
(227, 168, NULL, 1, 10, NULL, NULL, '2014-08-04 12:50:06'),
(228, 170, NULL, 1, 2, NULL, NULL, '2014-08-04 12:50:27'),
(229, 172, NULL, 1, 112, NULL, NULL, '2014-08-04 12:50:48'),
(230, 173, NULL, 1, 25, NULL, NULL, '2014-08-04 12:51:01'),
(231, 174, NULL, 1, 15, NULL, NULL, '2014-08-04 12:51:12'),
(232, 179, NULL, 1, 18, NULL, NULL, '2014-08-04 12:51:54'),
(233, 177, NULL, 1, 19, NULL, NULL, '2014-08-04 12:52:41'),
(234, 176, NULL, 1, 40, NULL, NULL, '2014-08-04 12:52:54'),
(235, 175, NULL, 1, 24, NULL, NULL, '2014-08-04 12:53:13'),
(236, 74, 1, 2, 223, NULL, NULL, '2014-08-04 13:05:28'),
(237, 2, 1, 2, 1, 9, NULL, '2014-08-04 13:05:54'),
(238, 4, 1, 2, 42, 8, NULL, '2014-08-04 13:06:13'),
(239, 6, 1, 2, 220, NULL, NULL, '2014-08-04 13:06:47'),
(240, 76, 1, 2, 24, NULL, NULL, '2014-08-04 13:07:13'),
(241, 8, 1, 2, 85, 5, NULL, '2014-08-04 13:07:34'),
(242, 79, 1, 2, 46, NULL, NULL, '2014-08-04 13:07:55'),
(243, 7, 1, 2, 10, NULL, NULL, '2014-08-04 13:08:11'),
(244, 1, 1, 2, 26, NULL, NULL, '2014-08-04 13:08:31'),
(245, 75, 1, 2, 22, NULL, NULL, '2014-08-04 13:08:47'),
(246, 9, 1, 2, 94, NULL, NULL, '2014-08-04 13:08:59'),
(247, 80, 1, 2, 50, 4, NULL, '2014-08-04 13:09:20'),
(248, 81, 1, 2, 163, NULL, NULL, '2014-08-04 13:09:29'),
(249, 82, 1, 2, 50, NULL, NULL, '2014-08-04 13:09:40'),
(250, 87, 1, 2, 164, NULL, NULL, '2014-08-04 13:10:04'),
(251, 88, 1, 2, 106, 7, NULL, '2014-08-04 13:10:20'),
(252, 92, 1, 2, 38, NULL, NULL, '2014-08-04 13:10:49'),
(253, 91, 1, 2, 23, NULL, NULL, '2014-08-04 13:11:02'),
(254, 93, 1, 2, 5, NULL, NULL, '2014-08-04 13:11:52'),
(255, 10, 1, 2, 21, 2, NULL, '2014-08-04 13:12:11'),
(256, 17, 1, 2, 145, 6, NULL, '2014-08-04 13:12:38'),
(257, 94, NULL, 1, 351, -351, NULL, '2014-08-04 13:13:47'),
(258, 94, 1, 2, 351, NULL, NULL, '2014-08-04 13:14:55'),
(259, 11, 1, 2, 12, NULL, NULL, '2014-08-04 13:15:19'),
(260, 21, NULL, 1, 331, -331, NULL, '2014-08-04 13:18:22'),
(261, 21, 1, 2, 370, 3, NULL, '2014-08-04 13:18:40'),
(262, 20, 1, 2, 32, 4, NULL, '2014-08-04 13:19:41'),
(263, 13, 1, 2, NULL, 2, NULL, '2014-08-04 13:20:08'),
(264, 14, 1, 2, 136, 1, NULL, '2014-08-04 13:20:21'),
(265, 12, 1, 2, 72, NULL, NULL, '2014-08-04 13:20:46'),
(266, 25, 1, 2, 204, 12, NULL, '2014-08-04 13:21:01'),
(267, 15, 1, 2, 223, 7, NULL, '2014-08-04 13:21:20'),
(268, 97, 1, 2, 103, NULL, NULL, '2014-08-04 13:22:35'),
(269, 100, 1, 2, 77, 2, NULL, '2014-08-04 13:23:01'),
(270, 29, 1, 2, NULL, 10, NULL, '2014-08-04 13:24:20'),
(271, 31, 1, 2, 40, 3, NULL, '2014-08-04 13:24:49'),
(272, 32, 1, 2, 25, NULL, NULL, '2014-08-04 13:24:58'),
(273, 103, 1, 2, 72, NULL, NULL, '2014-08-04 13:25:14'),
(274, 104, 1, 2, 6, NULL, NULL, '2014-08-04 13:25:34'),
(275, 26, 1, 2, 14, 1, NULL, '2014-08-04 13:25:44'),
(276, 27, 1, 2, 60, NULL, NULL, '2014-08-04 13:25:52'),
(277, 107, 1, 2, 26, 2, NULL, '2014-08-04 13:26:10'),
(278, 109, 1, 2, 4, NULL, NULL, '2014-08-04 13:26:28'),
(279, 19, 1, 2, 62, NULL, NULL, '2014-08-04 13:26:38'),
(280, 18, 1, 2, 74, 6, NULL, '2014-08-04 13:26:52'),
(281, 45, 1, 2, 97, NULL, NULL, '2014-08-04 13:27:16'),
(282, 44, 1, 2, 45, 9, NULL, '2014-08-04 13:27:33'),
(283, 48, 1, 2, 31, 1, NULL, '2014-08-04 13:27:50'),
(284, 46, 1, 2, 26, 1, NULL, '2014-08-04 13:28:10'),
(285, 47, 1, 2, 53, NULL, NULL, '2014-08-04 13:28:21'),
(286, 42, 1, 2, 352, 3, NULL, '2014-08-04 13:28:45'),
(287, 39, 1, 2, 345, 3, NULL, '2014-08-04 13:29:03'),
(288, 110, 1, 2, 478, 2, NULL, '2014-08-04 13:29:23'),
(289, 111, 1, 2, 22, 3, NULL, '2014-08-04 13:29:37'),
(290, 40, 1, 2, 50, 3, NULL, '2014-08-04 13:30:03'),
(291, 43, 1, 2, 245, 2, NULL, '2014-08-04 13:30:23'),
(292, 37, 1, 2, 127, 1, NULL, '2014-08-04 13:30:39'),
(293, 35, 1, 2, 405, 1, NULL, '2014-08-04 13:30:59'),
(294, 41, 1, 2, 375, NULL, NULL, '2014-08-04 13:31:10'),
(295, 38, 1, 2, 20, 1, NULL, '2014-08-04 13:31:29'),
(296, 36, 1, 2, 149, 1, NULL, '2014-08-04 13:31:48'),
(297, 113, 1, 2, 134, 2, NULL, '2014-08-04 13:32:08'),
(298, 112, 1, 2, 7, 2, NULL, '2014-08-04 13:32:21'),
(299, 114, 1, 2, 297, 1, NULL, '2014-08-04 13:32:42'),
(300, 116, 1, 2, 203, 1, NULL, '2014-08-04 13:32:55'),
(301, 115, 1, 2, 278, 1, NULL, '2014-08-04 13:33:11'),
(302, 34, 1, 2, 196, 4, NULL, '2014-08-04 13:34:00'),
(303, 130, 1, 2, NULL, 4, NULL, '2014-08-04 13:34:54'),
(304, 134, 1, 2, 200, 1, NULL, '2014-08-04 13:36:32'),
(305, 133, 1, 2, 345, 3, NULL, '2014-08-04 13:36:47'),
(306, 135, 1, 2, NULL, 8, NULL, '2014-08-04 13:37:08'),
(307, 137, 1, 2, 450, 2, NULL, '2014-08-04 13:37:27'),
(308, 139, 1, 2, NULL, 1, NULL, '2014-08-04 13:37:41'),
(309, 51, 1, 2, 1, NULL, NULL, '2014-08-05 12:27:41'),
(310, 49, 1, 2, 11, NULL, NULL, '2014-08-05 12:27:54'),
(311, 50, 1, 2, 10, NULL, NULL, '2014-08-05 12:28:05'),
(312, 55, 1, 2, 13, NULL, NULL, '2014-08-05 12:28:30'),
(313, 183, 1, 2, 17, NULL, NULL, '2014-08-05 12:29:27'),
(314, 170, 1, 2, 2, NULL, NULL, '2014-08-05 12:30:28'),
(315, 150, 1, 2, 2, NULL, NULL, '2014-08-05 12:44:41'),
(316, 147, 1, 2, 3, NULL, NULL, '2014-08-05 12:46:19'),
(317, 148, 1, 2, 2, NULL, NULL, '2014-08-05 12:46:29'),
(318, 54, 1, 2, 5, NULL, NULL, '2014-08-05 12:46:38'),
(319, 153, 1, 2, 1, NULL, NULL, '2014-08-05 12:46:59'),
(320, 149, 1, 2, 2, NULL, NULL, '2014-08-05 12:47:16'),
(321, 53, 1, 2, 8, NULL, NULL, '2014-08-05 12:47:28'),
(322, 56, 1, 2, 17, NULL, NULL, '2014-08-05 12:47:43'),
(323, 174, 1, 2, 15, NULL, NULL, '2014-08-05 12:47:57'),
(324, 173, 1, 2, 25, NULL, NULL, '2014-08-05 12:48:06'),
(325, 66, 1, 2, 18, NULL, NULL, '2014-08-05 12:48:17'),
(326, 172, 1, 2, 112, NULL, NULL, '2014-08-05 12:48:27'),
(327, 62, 1, 2, 18, NULL, NULL, '2014-08-05 12:48:40'),
(328, 58, 1, 2, 4, NULL, NULL, '2014-08-05 12:48:49'),
(329, 70, 1, 2, 52, NULL, NULL, '2014-08-05 12:49:22'),
(330, 68, 1, 2, 82, NULL, NULL, '2014-08-05 12:49:32'),
(331, 71, 1, 2, 71, NULL, NULL, '2014-08-05 12:49:48'),
(332, 72, 1, 2, 76, NULL, NULL, '2014-08-05 12:49:58'),
(333, 157, 1, 2, 115, NULL, NULL, '2014-08-05 12:50:11'),
(334, 155, 1, 2, 122, NULL, NULL, '2014-08-05 12:50:26'),
(335, 160, 1, 2, 8, NULL, NULL, '2014-08-05 12:50:53'),
(336, 161, 1, 2, 2, NULL, NULL, '2014-08-05 12:51:01'),
(337, 159, NULL, 1, 3, -3, NULL, '2014-08-05 12:51:51'),
(338, 159, 1, 2, 3, NULL, NULL, '2014-08-05 12:52:02'),
(339, 158, 1, 2, 8, NULL, NULL, '2014-08-05 12:52:13'),
(340, 163, 1, 2, 2073, NULL, NULL, '2014-08-05 12:52:34'),
(341, 64, 1, 2, 10, NULL, NULL, '2014-08-05 12:54:20'),
(342, 168, 1, 2, 10, NULL, NULL, '2014-08-05 12:54:29'),
(343, 63, 1, 2, 15, NULL, NULL, '2014-08-05 12:54:42'),
(344, 179, 1, 2, 18, NULL, NULL, '2014-08-05 12:55:15'),
(345, 61, 1, 2, 7, NULL, NULL, '2014-08-05 12:55:24'),
(346, 177, 1, 2, 19, NULL, NULL, '2014-08-05 12:55:34'),
(347, 176, 1, 2, 40, NULL, NULL, '2014-08-05 12:55:41'),
(348, 175, 1, 2, 24, NULL, NULL, '2014-08-05 12:55:49');

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
  `servicio` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=184 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `servicio`, `codigo`, `material`, `color`, `marca`, `industria`, `cantXPaquete`, `precioSFU`, `precioSFP`, `precioCFU`, `precioCFP`, `familia`, `detalle`) VALUES
(1, NULL, 'CB250-6787N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 100, 1.79, 175, 1.86, 182, 'Couche', '250G 67x87CM'),
(2, NULL, 'CB090-77110N', 'Couché Brillo', 'blanco', 'Nevia', 'China', 250, 0.99, 240, 1.03, 250, 'papales', '90G 77x110CM'),
(3, NULL, 'CB300-6787N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 100, 2.16, 212, 2.26, 222, 'Couche', '300G 67x87CM'),
(4, NULL, 'CB115-6787N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 250, 0.85, 205, 0.9, 217, 'Couche', '115G 67x87CM'),
(5, NULL, 'CB115-6789N', 'Couché Brillo', 'blanco', 'Nevia', 'China', 250, 0.89, 215, 0.92, 223, 'Couche', '115G 67x89CM'),
(6, NULL, 'CB115-77110N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 250, 1.19, 287, 1.24, 299, 'Couche', '115G 77x110CM'),
(7, NULL, 'CB200-77110N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 125, 1.98, 240, 2.15, 259, 'Couche', '200G 77x110CM'),
(8, NULL, 'CB170-6787N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 250, 1.2, 291, 1.25, 303, 'Couche', '170G 67x87CM'),
(9, NULL, 'CB300-77110N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 100, 3.2, 305, 3.33, 318, 'Couche', '300G 77x110CM'),
(10, NULL, 'CM300-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 100, 3.2, 305, 3.33, 318, 'Couche', '300G 77x110CM'),
(11, NULL, 'PB063-6787T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 500, 0.45, 211, 0.47, 218, 'Papel', '63G 67x87CM'),
(12, NULL, 'PB090-6787S', 'Papel Bond', 'Blanco Alcalino', 'Suzano', 'Brazil', 250, 0.73, 169, 0.77, 179, 'Papel', '90G 67x87CM'),
(13, NULL, 'PB075-77110S', 'Papel Bond', 'Blanco Alcalino', 'Suzano', 'Brazil', 250, 0.8, 195, 0.83, 203, 'Papel', '75G 77x110CM'),
(14, NULL, 'PB075-77110T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 250, 0.77, 184, 0.79, 191, 'Papel', '75G 77x110CM'),
(15, NULL, 'PB090-77110T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 250, 0.91, 219, 0.95, 228, 'Papel', '90G 77x110CM'),
(16, NULL, 'PB120-6787S', 'Papel Bond', 'Blanco', 'Sosein', 'China', 250, 0.85, 200, 0.89, 210, 'Papel', '120G 67x87CM'),
(17, NULL, 'PB054-6787B', 'Papel Bond', 'Blanco Alcalino', 'Bilt', 'India', 500, 0.42, 190, 0.44, 200, 'Papel', '54G 67x87CM'),
(18, NULL, 'CH240-65100M-C', 'Cartulina Hilada', 'Crema', 'Multiverde', 'Brazil', 100, 2.83, 273, 3, 290, 'Cartulina', '240G 65x100CM'),
(19, NULL, 'CH240-65100M-B', 'Cartulina Hilada', 'Blanco', 'Multiverde', 'China', 100, 2.83, 273, 3, 290, 'Cartulina', '240G 65x100CM'),
(20, NULL, 'PB075-6787T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 500, 0.53, 252, 0.55, 260, 'Papel', '75G 67x87CM'),
(21, NULL, 'PB075-6787S', 'Papel Bond', 'Blanco Alcalino', 'Suzano', 'Brazil', 500, 0.55, 265, 0.58, 283, 'papales', '75G 67x87M'),
(23, NULL, 'AC80-70100A-sc', 'Adhesivo Couche S/C - P3H', 'Blanco Semi Brillo', 'Arclad', 'Colombia', 100, 4.3, 420, 4.7, 460, 'Adhesivo', '80G 70x100CM'),
(24, NULL, 'AC80-70100A-cc', 'Adhesivo Couche C/C - P', 'Blanco Semi Brillo', 'Arclad', 'Colombia', 100, 4.8, 460, 5.3, 510, 'Adhesivo', '70x100CM'),
(25, NULL, 'PB090-6787T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 250, 0.65, 154, 0.67, 159, 'Papel', '90G 67x87CM'),
(26, NULL, 'CT225-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 2.91, 276, 3.03, 288, 'Cartulina', '225G 77x110CM'),
(27, NULL, 'CT255-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 3.38, 3.26, 3.54, 342, 'Cartulina', '255G 77x110CM'),
(28, NULL, 'CT300-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 3.6, 350, 3.71, 360, 'Cartulina', '300G 77x110CM'),
(29, NULL, 'CD180-77110C', 'Cartulina Duplex', 'Blanco/Café', 'CMPC', 'Chile', 100, 2.48, 233, 2.63, 248, 'Cartulina', '180G 77x110CM'),
(30, NULL, 'CD205-77110C', 'Cartulina Duplex', 'Blanco/Café', 'CMPC', 'Chile', 100, 2.76, 261, 2.86, 271, 'Cartulina', '225G 77x110CM'),
(31, NULL, 'CD250-77110C', 'Cartulina Duplex', 'Blanco/Café', 'CMPC', 'Chile', 100, 3.03, 288, 3.15, 300, 'Cartulina', '250G 77x110CM'),
(32, NULL, 'CD275-77110C', 'Cartulina Duplex', 'Blanco/Café', 'CMPC', 'Chile', 100, 3.3, 315, 3.4, 325, 'Cartulina', '275G 77x110CM'),
(33, NULL, 'PK125-102160', 'Papel Kraft', 'Marron Claro', '', '', 100, 2.8, 260, 3.1, 290, 'Papel', '125G 102x160CM'),
(34, NULL, 'PK080-815125', 'Papel Kraft', 'Marron Claro', '', '', 250, 1.5, 330, 1.7, 360, 'Papel', '80G 81.5x125CM'),
(35, NULL, 'PQI35-6787F-B', 'Papel Quimico Int.', 'Blanco', 'Focus', 'Colombia', 500, 0.66, 315, 0.68, 327, 'Papel', '35G 67x87CM'),
(36, NULL, 'PQI35-6787F-V', 'Papel Quimico Int.', 'Verde', 'Focus', 'Colombia', 500, 0.66, 315, 0.68, 327, 'Papel', '35G 67x87CM'),
(37, NULL, 'PQI35-6787F-A', 'Papel Quimico Int.', 'Amarillo', 'Focus', 'Colombia', 500, 0.66, 315, 0.68, 327, 'Papel', '35G 67x87CM'),
(38, NULL, 'PQI35-6787F-R', 'Papel Quimico Int.', 'Rosado', 'Focus', 'Colombia', 500, 0.66, 315, 0.68, 327, 'Papel', '35G 67x87CM'),
(39, NULL, 'PC35-6787P-B', 'Papel Copia', 'Blanco', 'Propal', 'Colombia', 500, 0.31, 142, 0.33, 155, 'Papel', '35G 67x87CM'),
(40, NULL, 'PC35-6787P-V', 'Papel Copia', 'Verde', 'Propal', 'Colombia', 500, 0.31, 142, 0.33, 155, 'Papel', '35G 67x87CM'),
(41, NULL, 'PQI35-6787F-C', 'Papel Quimico Int.', 'Celeste', 'Focus', 'Colombia', 500, 0.66, 315, 0.68, 327, 'Papel', '35G 67x87CM'),
(42, NULL, 'PC35-6787P-A', 'Papel Copia', 'Amarillo', 'Propal', 'Colombia', 500, 0.31, 142, 0.33, 155, 'Papel', '35G 67x87CM'),
(43, NULL, 'PQO35-6787F', 'Papel Quimico Orig.', 'Blanco', 'Focus', 'Colombia', 500, 0.62, 300, 0.65, 315, 'Papel', '35G 67x87CM'),
(44, NULL, 'CC180-65100M-B', 'Cartulina Corriente', 'Blanco', 'Multiverde', 'Brazil', 125, 2.62, 247, 2.74, 259, 'Cartulina', '180G 65x100CM'),
(45, NULL, 'CC180-65100M-A', 'Cartulina Corriente', 'Amarillo', 'Multiverde', 'Brazil', 125, 2.62, 247, 2.74, 259, 'Cartulina', '180G 65x100CM'),
(46, NULL, 'CC180-65100M-R', 'Cartulina Corriente', 'Rosado', 'Multiverde', 'Brazil', 125, 2.62, 247, 2.74, 259, 'Cartulina', '180G 65x100CM'),
(47, NULL, 'CC180-65100M-V', 'Cartulina Corriente', 'Verde', 'Multiverde', 'Brazil', 125, 2.62, 247, 2.74, 259, 'Cartulina', '180G 65x100CM'),
(48, NULL, 'CC180-65100M-C', 'Cartulina Corriente', 'Celeste', 'Multiverde', 'Brazil', 125, 2.62, 247, 2.74, 259, 'Cartulina', '180G 65x100CM'),
(49, NULL, 'TP-1A-C', 'Tintas de Proceso', 'Cyan', 'Amstrong', 'Alemania', 10, 68, 0, 72, 0, 'Tintas', '1Kg'),
(50, NULL, 'TP-1A-M', 'Tintas de Proceso', 'Magenta', 'Amstrong', 'Alemania', 10, 65, 0, 69, 0, 'Tintas', '1Kg'),
(51, NULL, 'TP-1A-A', 'Tintas de Proceso', 'Amarillo', 'Amstrong', 'Alemania', 10, 65, 0, 69, 0, 'Tintas', '1Kg'),
(52, NULL, 'TP-1A-N', 'Tintas de Proceso', 'Negro', 'Amstrong', 'Alemania', 10, 65, 0, 69, 0, 'Tintas', '1Kg'),
(53, NULL, 'TE-1A-BO', 'Tintas Epeciales', 'Blanco Opaco', 'Amstrong', 'Alemania', 10, 107, 0, 115, 0, 'Tintas', '1Kg'),
(54, NULL, 'TE-1A-RB', 'Tintas Epeciales', 'Reflex Blue', 'Amstrong', 'Alemania', 0, 145, 0, 157, 0, 'Tintas', '1Kg'),
(55, NULL, 'TT-1B-R', 'Tintas Tipografica', 'Rojo', 'Boston', '', 18, 95, 0, 100, 0, 'Tintas', '1Kg, Balde'),
(56, NULL, 'SF-1Ch', 'Solucion de Fuente', '', 'Chemical', '', 16, 28, 0, 31, 0, 'Quimicos', '1L'),
(57, NULL, 'LR-1BW', 'Lavador de Rodillos', '', 'Blue Wash', '', 0, 0, 0, 0, 0, 'Quimicos', '1L'),
(58, NULL, 'R-1A', 'Renal', '', 'Antalis', '', 0, 80, 0, 86.5, 0, 'Quimicos', '1L'),
(59, NULL, '', 'Solucion de Fuente', '', 'Antalis', '', 16, 27, 0, 30, 0, 'Quimicos', '1L, Stabilat 52'),
(60, NULL, '', 'Diluyente de Tinta', '', '', '', 0, 60, 0, 68, 0, 'Quimicos', 'frasco'),
(61, NULL, 'GA-1Ch', 'Goma Arabica', '', 'Chemical', '', 16, 15, 0, 18, 0, 'Quimicos', '1L, frasco'),
(62, NULL, 'RN-095A', 'Revelador Negativo', '', 'Antalis', '', 0, 29, 0, 31.5, 0, 'Quimicos', '0.95L, DN-SH'),
(63, NULL, '', 'Lavador de Rodillos', '', '1609', '', 0, 35, 0, 38, 0, 'Quimicos', '1Lt'),
(64, NULL, 'LE-1A', 'Lithio Emulsion', '', 'Antalis', '', 0, 58, 0, 62.5, 0, 'Quimicos', '1L'),
(65, NULL, '', 'Filtro', '', '', '', 0, 0, 0, 0, 0, '', ''),
(66, NULL, 'RP-095A', 'Revelador Positivo', '', 'Antalis', '', 0, 110, 0, 119, 0, 'Quimicos', '0.95L, DP-8'),
(67, NULL, 'PP-GTO46', 'Placas Positiva', 'GTO 46', 'Eco Plate', 'China', 0, 6, 0, 6.5, 0, 'Placas', '45x37 CM, 015 Esp, 1 cara '),
(68, NULL, 'PP-GTO52', 'Placas Positiva', 'GTO 52', 'Eco Plate', 'China', 0, 7, 0, 7.5, 0, 'Placas', '51x40 CM, 0.15 Esp, 1cara'),
(69, NULL, 'PP-DOficio', 'Placas Positiva', 'Doble Oficio', 'Eco Plate', 'China', 0, 6, 0, 6.5, 0, 'Placas', '45,7x38.1 CM, 0.15 Esp, 1Cara'),
(70, NULL, 'PP-MO', 'Placas Positiva', 'MO', 'Eco Plate', 'China', 0, 15, 0, 16.5, 0, 'Placas', '65x55 CM, 0.15 Esp, 1Cara'),
(71, NULL, 'PP-DCarta', 'Placas Positiva', 'Doble Carta', 'Eco Plate', 'China', 0, 4.5, 0, 5, 0, 'Placas', '45.7x27.9 CM, 0.15 Esp, 1Cara'),
(72, NULL, 'PN-Oficio', 'Placas Negativas', 'Oficio', 'Fuji', 'Japon', 0, 9.5, 0, 10.5, 0, 'Placas', '25.4x38.7 CM, 0.15 Esp, 2 Caras'),
(73, NULL, 'PP-Oficio', 'Placas Positiva', 'Oficio', 'Eco Plate', 'China', 0, 3.2, 0, 3.6, 0, 'Placas', '25.4x38.7 CM, 0.15 Esp, 1 cara'),
(74, NULL, 'CB090-6787N', 'Couché Brillo', 'blanco', 'Nevia', 'China', 250, 0.68, 158, 0.71, 166, 'Couche', '90G 67x87CM'),
(75, NULL, 'CB250-77110N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 100, 2.57, 253, 2.69, 265, 'Couche', '250G 77x110CM'),
(76, NULL, 'CB150-6787N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 250, 1.08, 261, 1.13, 269, 'Couche', '150G 67x87CM'),
(77, NULL, 'CB150-77110N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 250, 1.54, 375, 1.59, 390, 'Couche', '150G 77x110CM'),
(78, NULL, 'CB170-77110N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 250, 1.76, 427, 1.83, 447, 'Couche', '170G 77x110CM'),
(79, NULL, 'CB200-6787N', 'Couché Brillo', 'Blanco', 'Nevia', 'China', 125, 1.63, 183, 1.69, 197, 'Couche', '200G 67x87CM'),
(80, NULL, 'CM090-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 0.68, 158, 0.71, 166, 'Couche', '90G 67x87CM'),
(81, NULL, 'CM090-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 0.99, 240, 1.03, 250, 'Couche', '90G 77x110CM'),
(82, NULL, 'CM115-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 0.85, 205, 0.9, 217, 'Couche', '115G 67x87CM'),
(83, NULL, 'CM115-6789N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 0.89, 215, 0.92, 223, 'Couche', '115G 67x89CM'),
(84, NULL, 'CM115-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 1.19, 287, 1.24, 299, 'Couche', '115G 77x110CM'),
(85, NULL, 'CM150-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 1.08, 261, 1.13, 269, 'Couche', '150G 67x87CM'),
(86, NULL, 'CM150-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 1.54, 375, 1.59, 390, 'Couche', '150G 77x110CM'),
(87, NULL, 'CM170-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 1.2, 291, 1.25, 303, 'Couche', '170G 67x87CM'),
(88, NULL, 'CM170-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 250, 1.76, 427, 1.83, 447, 'Couche', '170G 77x110CM'),
(89, NULL, 'CM200-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 125, 1.63, 183, 1.69, 197, 'Couche', '200G 67x87CM'),
(90, NULL, 'CM200-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 125, 1.98, 240, 2.15, 259, 'Couche', '200G 77x110CM'),
(91, NULL, 'CM250-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 100, 1.79, 175, 1.86, 182, 'Couche', '250G 67x87CM'),
(92, NULL, 'CM250-77110N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 100, 2.57, 253, 2.69, 265, 'Couche', '250G 77x110CM'),
(93, NULL, 'CM300-6787N', 'Couché Mate', 'Blanco', 'Nevia', 'China', 100, 2.16, 212, 2.26, 222, 'Couche', '300G 67x87CM'),
(94, NULL, 'PB063-6787S', 'Papel Bond', 'Blanco Alcalino', 'Suzano', 'Brazil', 500, 0.5, 235, 0.52, 246, 'Papel', '63G 67x87CM'),
(95, NULL, 'PB070-6787T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 500, 0.5, 234, 0.52, 242, 'Papel', '70G 67x87CM'),
(96, NULL, 'PB070-6787S', 'Papel Bond', 'Blanco Alcalino', 'Suzano', 'Brazil', 500, 0.53, 247, 0.55, 259, 'Papel', '70G 67x87CM'),
(97, NULL, 'PB75-6787K-A', 'Papel Bond', 'Amarillo', 'Korab', 'China', 500, 0.6, 275, 0.62, 292, 'Papel', '75G 67x87CM'),
(98, NULL, 'PB75-6787K-C', 'Papel Bond', 'Celeste', 'Korab', 'China', 500, 0.6, 275, 0.62, 292, 'Papel', '75G 67x87CM'),
(99, NULL, 'PB75-6787K-V', 'Papel Bond', 'Verde', 'Korab', 'China', 500, 0.6, 275, 0.62, 292, 'Papel', '75G 67x87CM'),
(100, NULL, 'PB75-6787K-R', 'Papel Bond', 'Rosado', 'Korab', 'China', 500, 0.6, 275, 0.62, 292, 'Papel', '75G 67x87CM'),
(101, NULL, 'PB75-6787T', 'Papel Bond', 'Hueso', 'Tucuman', 'Argentina', 500, 0.57, 270, 0.6, 286, 'Papel', '75G 67x87CM'),
(102, NULL, 'PB80-6787T', 'Papel Bond', 'Hueso', 'Tucuman', 'Argentina', 500, 0.61, 287, 0.64, 305, 'Papel', '80G 67x87CM'),
(103, NULL, 'CD300-77110S', 'Cartulina Duplex', 'Blanco/Café', 'Sosein', 'China', 100, 3.55, 340, 3.69, 354, 'Cartulina', '300G 77x110CM'),
(104, NULL, 'CT205-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 2.7, 255, 2.8, 265, 'Cartulina', '205G 77x110CM'),
(105, NULL, 'CT280-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 3.59, 334, 3.62, 347, 'Cartulina', '280G 77x110CM'),
(106, NULL, 'CT330-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 4.05, 390, 4.31, 416, 'Cartulina', '330G 77x110CM'),
(107, NULL, 'CT360-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 4.4, 425, 4.67, 452, 'Cartulina', '360G 77x110CM'),
(108, NULL, 'CH180-65100M-B', 'Cartulina Hilada', 'Blanco', 'Multiverde', 'Brazil', 100, 2.22, 207, 2.37, 221, 'Cartulina', '180G 65x100CM'),
(109, NULL, 'CH180-65100M-C', 'Cartulina Hilada', 'Crema', 'Multiverde', 'Brazil', 100, 2.22, 207, 2.37, 221, 'Cartulina', '180G 65x100CM'),
(110, NULL, 'PC35-6787P-C', 'Papel Copia', 'Celeste', 'Propal', 'Colombia', 500, 0.31, 142, 0.33, 155, 'Papel', '35G 67x87CM'),
(111, NULL, 'PC35-6787P-R', 'Papel Copia', 'Rosado', 'Propal', 'Colombia', 500, 0.31, 142, 0.33, 155, 'Papel', '35G 67x87CM'),
(112, NULL, 'PQF35-6787F-B', 'Papel Quimico Fin.', 'Blanco', 'Focus', 'Colombia', 500, 0.65, 310, 0.67, 322, 'Papel', '35G 67x87CM'),
(113, NULL, 'PQF35-6787F-A', 'Papel Quimico Fin.', 'Amarillo', 'Focus', 'Colombia', 500, 0.65, 310, 0.67, 322, 'Papel', '35G 67x87CM'),
(114, NULL, 'PQF35-6787F-C', 'Papel Quimico Fin.', 'Celeste', 'Focus', 'Colombia', 500, 0.65, 310, 0.67, 322, 'Papel', '35G 67x87CM'),
(115, NULL, 'PQF35-6787F-V', 'Papel Quimico Fin.', 'Verde', 'Focus', 'Colombia', 500, 0.65, 310, 0.67, 322, 'Papel', '35G 67x87CM'),
(116, NULL, 'PQF35-6787F-R', 'Papel Quimico Fin.', 'Rosado', 'Focus', 'Colombia', 500, 0.65, 310, 0.67, 322, 'Papel', '35G 67x87CM'),
(117, NULL, 'PB063-77110T', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 250, 0.66, 150, 0.7, 160, 'Papel', '63G 77x110CM'),
(118, NULL, 'PP48-6787S', 'Papel Periodico', 'Blanco Ceniza', 'Sosein', 'Chile', 500, 0.31, 142, 0.33, 150, 'Papel', '48G 67x87CM'),
(119, NULL, 'PP48-77110S', 'Papel Periodico', 'Blanco Ceniza', 'Sosein', 'Chile', 500, 0.43, 202, 0.46, 215, 'Papel', '48G 77x110CM'),
(120, NULL, 'PB75-CC', 'Papel Bond', 'Blanco', 'Chamex', 'Brazil', 500, 0.062, 26, 0.068, 29, 'Papel', '75G Carta'),
(121, NULL, 'PB75-OC', 'Papel Bond', 'Blanco', 'Chamex', 'Brazil', 500, 0.072, 31, 0.078, 34, 'Papel', '75G Oficio'),
(122, NULL, 'PB63-OT', 'Papel Bond', 'Blanco', 'Tucuman', 'Argentina', 500, 0.06, 28, 0.066, 31, 'Papel', '63G Oficio'),
(123, NULL, 'PB63-OS', 'Papel Bond', 'Blanco', 'Suzano', 'Argentina', 500, 0.065, 30, 0.071, 33, 'Papel', '63G Oficio'),
(124, NULL, 'PC35-OP-B', 'Papel Copia', 'Blanco', 'Propal', 'Colombia', 500, 0.043, 19.5, 0.047, 21, 'Papel', '35G Oficio'),
(125, NULL, 'PC35-OP-A', 'Papel Copia', 'Amarillo', 'Propal', 'Colombia', 500, 0.043, 19.5, 0.047, 21, 'Papel', '35G Oficio'),
(126, NULL, 'PC35-OP-C', 'Papel Copia', 'Celeste', 'Propal', 'Colombia', 500, 0.043, 19.5, 0.047, 21, 'Papel', '35G Oficio'),
(127, NULL, 'PC35-OP-V', 'Papel Copia', 'Verde', 'Propal', 'Colombia', 500, 0.043, 19.5, 0.047, 21, 'Papel', '35G Oficio'),
(128, NULL, 'PC35-OP-R', 'Papel Copia', 'Rosado', 'Propal', 'Colombia', 500, 0.043, 19.5, 0.047, 21, 'Papel', '35G Oficio'),
(129, NULL, 'PQO55-OF', 'Papel Quimico Orig.', 'Blanco', 'Focus', 'China', 500, 0.092, 42, 0.096, 44, 'Papel', '55G Oficio'),
(130, NULL, 'PQI52-OF-B', 'Papel Quimico Int.', 'Blanco', 'Focus', 'China', 500, 0.097, 44.5, 0.11, 46.5, 'Papel', '52G Oficio'),
(131, NULL, 'PQI52-OF-A', 'Papel Quimico Int.', 'Amarillo', 'Focus', 'China', 500, 0.097, 44.5, 0.11, 46.5, 'Papel', '52G Oficio'),
(132, NULL, 'PQI52-OF-C', 'Papel Quimico Int.', 'Celeste', 'Focus', 'China', 500, 0.097, 44.5, 0.11, 46.5, 'Papel', '52G Oficio'),
(133, NULL, 'PQI52-OF-R', 'Papel Quimico Int.', 'Rosado', 'Focus', 'China', 500, 0.097, 44.5, 0.11, 46.5, 'Papel', '52G Oficio'),
(134, NULL, 'PQI52-OF-V', 'Papel Quimico Int.', 'Verde', 'Focus', 'China', 500, 0.097, 44.5, 0.11, 46.5, 'Papel', '52G Oficio'),
(135, NULL, 'PQF55-OF-B', 'Papel Quimico Fin.', 'Blanco', 'Focus', 'China', 500, 0.095, 43.5, 0.099, 45.5, 'Papel', '55G Oficio'),
(136, NULL, 'PQF55-OF-A', 'Papel Quimico Fin.', 'Amarillo', 'Focus', 'China', 500, 0.095, 43.5, 0.099, 45.5, 'Papel', '55G Oficio'),
(137, NULL, 'PQF55-OF-C', 'Papel Quimico Fin.', 'Celeste', 'Focus', 'China', 500, 0.095, 43.5, 0.099, 45.5, 'Papel', '55G Oficio'),
(138, NULL, 'PQF55-OF-V', 'Papel Quimico Fin.', 'Verde', 'Focus', 'China', 500, 0.095, 43.5, 0.099, 45.5, 'Papel', '55G Oficio'),
(139, NULL, 'PQF55-OF-R', 'Papel Quimico Fin.', 'Rosado', 'Focus', 'China', 500, 0.095, 43.5, 0.099, 45.5, 'Papel', '55G Oficio'),
(140, NULL, 'AC80-7050A', 'Adhesivo Couche C/C', 'Blanco Semi Brillo', 'Adestor', 'España', 250, 2.9, 700, 3.1, 750, 'Adhesivo', '80G 70x50CM'),
(141, NULL, 'AP80-70100A', 'Adhesivo Papel', 'Blanco', 'Arclad', 'Colombia', 100, 4.1, 400, 3.1, 750, 'Adhesivo', '80G 70x100CM'),
(142, NULL, 'AP90-77110A-BB', 'Adhesivo PVC', 'Blanco Brillo', 'Arclad', 'Colombia', 100, 10.5, 1000, 11, 1050, 'Adhesivo', '90G 77x110CM'),
(143, NULL, 'AP90-77110A-BM', 'Adhesivo PVC', 'Blanco Mate', 'Arclad', 'Colombia', 100, 10.5, 1000, 11, 1050, 'Adhesivo', '90G 77x110CM'),
(144, NULL, 'AP90-77110A-T', 'Adhesivo PVC', 'Transparente', 'Arclad', 'Colombia', 100, 10.5, 1000, 11, 1050, 'Adhesivo', '90G 77x110CM'),
(145, NULL, '', 'Corte', '', '', '', 0, 0, 0, 0, 0, '', ''),
(146, NULL, 'TE-1A-R032', 'Tintas Epeciales', 'Red 032', 'Amstrong', 'Alemania', 0, 168, 0, 181, 0, 'Tintas', '1Kg'),
(147, NULL, 'TE-1A-RR', 'Tintas Epeciales', 'Rubine Red', 'Amstrong', 'Alemania', 0, 121, 0, 130, 0, 'Tintas', '1Kg'),
(148, NULL, 'TE-1A-RhR', 'Tintas Epeciales', 'Rhodamine Red', 'Amstrong', 'Alemania', 0, 250, 0, 270, 0, 'Tintas', '1Kg'),
(149, NULL, 'TE-1A-G', 'Tintas Epeciales', 'Green', 'Amstrong', 'Alemania', 0, 148, 0, 156, 0, 'Tintas', ''),
(150, NULL, 'TE-1A-V', 'Tintas Epeciales', 'Voliet', 'Amstrong', 'Alemania', 0, 210, 0, 227, 0, 'Tintas', '1Kg'),
(151, NULL, 'TE-1A-R021', 'Tintas Epeciales', 'Range 021', 'Amstrong', 'Alemania', 0, 250, 0, 270, 0, 'Tintas', '1Kg'),
(152, NULL, 'TE-1A-BT', 'Tintas Epeciales', 'Blanco Transparente', 'Amstrong', 'Alemania', 0, 85, 0, 92, 0, 'Tintas', '1Kg'),
(153, NULL, 'TE-1A-OR', 'Tintas Epeciales', 'Oro Royal', 'Gold Middle', '', 0, 390, 0, 420, 0, 'Tintas', '1Kg'),
(154, NULL, 'TE-1A-P', 'Tintas Epeciales', 'Plata', 'Silver', '', 0, 195, 0, 210, 0, 'Tintas', '1Kg'),
(155, NULL, 'PN-GTO46', 'Placas Negativas', 'GTO 46', 'Fuji', 'Japon', 0, 16, 0, 17.5, 0, 'Placas', '45x37, 015 Esp, 2 caras'),
(156, NULL, 'PN-GTO52', 'Placas Negativas', 'GTO 52', 'Fuji', 'Japon', 0, 19, 0, 20.5, 0, 'Placas', '51x40 CM, 0.15 Esp, 2Caras'),
(157, NULL, 'PN-MO', 'Placas Negativas', 'MO', 'Fuji', 'Japon', 0, 32, 0, 35, 0, 'Placas', '65x55 CM, 0.15 Esp, 2Caras'),
(158, NULL, 'M-45x457A', 'Mantilla', 'Azul', 'Antalis', '', 0, 240, 0, 260, 0, 'Mantillas', 'H.45xA45.7, 4Lonas'),
(159, NULL, 'M-45x54A', 'Mantilla', 'Azul', 'Antalis', '', 0, 282, 0, 305, 0, 'Mantillas', 'H.45xA54, 4Lonas'),
(160, NULL, 'M-58x67A', 'Mantilla', 'Azul', 'Antalis', '', 0, 450, 0, 490, 0, 'Mantillas', 'H.58xA67, 4Lonas'),
(161, NULL, 'M-45x625A', 'Mantilla', 'Azul', 'Antalis', '', 0, 490, 0, 530, 0, 'Mantillas', 'H.45xA.62.5, 4 Lonas'),
(162, NULL, '', 'Maletón', 'Rojo', '', '', 0, 1.37, 0, 1.45, 0, 'Maletones', '7 ancho, sintético, lineal'),
(163, NULL, '', 'Maletón', 'Rojo', '', '', 0, 1.6, 0, 1.75, 0, 'Maletones', '7.5 ancho, Sintetico, lineal'),
(164, NULL, '', 'Plasticola', 'Blanco', 'Monopol', 'Bolivia', 0, 0, 0, 0, 0, 'Pegamento', '300ml, frasco'),
(165, NULL, '', 'Plasticola', 'Blanco', 'Monopol', 'Bolivia', 0, 16, 0, 18, 0, 'Pegamento', '3.5L, Balde'),
(166, NULL, '', 'Clefa', 'Marron Transparente', 'Amazonas', 'Brazil', 0, 52, 0, 56, 0, 'Pegamento', '0.75L, Frazco'),
(167, NULL, '', 'Clefa', 'Marron Transparente', 'Amazonas', 'Brazil', 0, 152, 0, 164, 0, 'Pegamento', '2.85L, Balde'),
(168, NULL, '', 'Liston de Corte', 'Rojo', '', '', 0, 60, 0, 69, 0, 'Complementos', 'Pieza, (para guillotinas de 92 de luz)'),
(169, NULL, '', 'Polvo Antirrepinte', 'Blanco', '', '', 0, 65, 0, 70, 0, 'Complementos', '1Kg, Balde'),
(170, NULL, '', 'Barniz Mate', '', 'Wikoffcolor', '', 0, 363, 0, 393, 0, 'Complementos', '2 Kg, Lata'),
(171, NULL, '', 'Barniz Brillo', '', 'Wikoffcolor', '', 0, 363, 0, 393, 0, 'Complementos', '2 Kg, Lata'),
(172, NULL, '', 'Scoch Grande', 'Transparente', '', '', 0, 9, 0, 10, 0, 'Otros', 'Pieza'),
(173, NULL, '', 'Scoch Grande', 'Café', '', '', 0, 9, 0, 10, 0, '', 'Pieza'),
(174, NULL, '', 'Scoch Pequeño', 'Transparente', '', '', 0, 1.5, 0, 2, 0, '', 'Pieza'),
(175, NULL, '', 'Grapas', '', 'Madisson', '', 0, 2.5, 0, 3, 0, 'Otros', '26.6, caja 1000U.'),
(176, NULL, '', 'Grapas', '', 'Madisson', '', 0, 3, 0, 4, 0, 'Otros', '24.6, caja 1000U.'),
(177, NULL, '', 'Grapas', '', 'Kw Trio', '', 0, 10, 0, 11, 0, 'Otros', '23.8, caja 1000U.'),
(178, NULL, '', 'Grapas', '', 'Kw Trio', '', 0, 11, 0, 12, 0, 'Otros', '23.1, caja 1000U.'),
(179, NULL, '', 'Grapas', '', 'Kw Trio', '', 0, 12, 0, 13, 0, 'Otros', '23.13, caja 1000U.'),
(180, NULL, '', 'Marcadores', '', '', '', 0, 3, 0, 3.5, 0, 'Otros', 'pieza, Distintos Colores'),
(181, NULL, '', 'Placas', '', '', '', 0, 0, 0, 0, 0, 'Placas', 'MO 015'),
(182, NULL, '', 'Adhesivo Couche C/C', 'Blanco Alto Brillo', 'Adestor', 'España', 0, 0, 0, 0, 0, 'Adhesivo', '80G 70x50CM'),
(183, NULL, 'TT-1B-N', 'Tintas Tipografica', 'Negro', 'Boston', '', 18, 95, 0, 100, 0, 'Tintas', '1Kg');

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
-- Estructura de tabla para la tabla `TipoMovimiento`
--

CREATE TABLE IF NOT EXISTS `TipoMovimiento` (
  `idTipoMovimiento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`idTipoMovimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `TipoMovimiento`
--

INSERT INTO `TipoMovimiento` (`idTipoMovimiento`, `nombre`, `estado`) VALUES
(1, 'Erick', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TiposClientes`
--

CREATE TABLE IF NOT EXISTS `TiposClientes` (
  `idTiposClientes` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `servicio` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTiposClientes`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `TiposClientes`
--

INSERT INTO `TiposClientes` (`idTiposClientes`, `nombre`, `servicio`) VALUES
(1, 'Preferencial A', 1),
(2, 'singular', 0),
(3, 'Preferencial B', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`idUser`, `username`, `password`, `fechaLogin`, `estado`, `tipo`, `idEmpleado`) VALUES
(1, 'helier', '5629500575ffe706d9d57fca5472153e', '2014-08-08 15:16:06', 0, '1', 2),
(2, 'erika', 'e10adc3949ba59abbe56e057f20f883e', '2014-08-05 12:31:05', 0, '3', 3),
(3, 'sergio', 'e10adc3949ba59abbe56e057f20f883e', '2014-07-21 15:14:21', 0, '4', 4),
(4, 'erick', '202cb962ac59075b964b07152d234b70', '2014-07-24 17:30:27', 0, '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `idVenta` int(11) NOT NULL AUTO_INCREMENT,
  `fechaVenta` datetime DEFAULT NULL,
  `tipoVenta` int(11) DEFAULT NULL,
  `formaPago` int(11) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `fechaPlazo` datetime DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `numero` int(11) NOT NULL,
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
-- Filtros para la tabla `cajaChica`
--
ALTER TABLE `cajaChica`
  ADD CONSTRAINT `fk_cajaChica_caja1` FOREIGN KEY (`idCaja`) REFERENCES `caja` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cajaChica_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cajaChicaMovimiento`
--
ALTER TABLE `cajaChicaMovimiento`
  ADD CONSTRAINT `fk_cajaChicaMovimiento_cajaChica1` FOREIGN KEY (`idcajaChica`) REFERENCES `cajaChica` (`idcajaChica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cajaChicaMovimiento_TipoMovimiento1` FOREIGN KEY (`tipoMovimiento`) REFERENCES `TipoMovimiento` (`idTipoMovimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cajaChicaTipo`
--
ALTER TABLE `cajaChicaTipo`
  ADD CONSTRAINT `fk_cajaChicaTipo_cajaChica1` FOREIGN KEY (`idcajaChica`) REFERENCES `cajaChica` (`idcajaChica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cajaChicaTipo_TipoMovimiento1` FOREIGN KEY (`idTipoMovimiento`) REFERENCES `TipoMovimiento` (`idTipoMovimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cajaMovimientoVenta`
--
ALTER TABLE `cajaMovimientoVenta`
  ADD CONSTRAINT `fk_cajaMovimientoVenta_caja1` FOREIGN KEY (`idCaja`) REFERENCES `caja` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoCaja_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_TiposClientes1` FOREIGN KEY (`idTiposClientes`) REFERENCES `TiposClientes` (`idTiposClientes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `CTP`
--
ALTER TABLE `CTP`
  ADD CONSTRAINT `fk_CTP_CTP1` FOREIGN KEY (`idCTPParent`) REFERENCES `CTP` (`idCTP`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CTP_Imprenta1` FOREIGN KEY (`idImprenta`) REFERENCES `Imprenta` (`idImprenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CTP_user1` FOREIGN KEY (`idUserOT`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CTP_user2` FOREIGN KEY (`idUserVenta`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_cajaMovimientoVenta10` FOREIGN KEY (`idCajaMovimientoVenta`) REFERENCES `cajaMovimientoVenta` (`idCajaMovimientoVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_cliente10` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleCTP`
--
ALTER TABLE `detalleCTP`
  ADD CONSTRAINT `fk_detalleCTP_almacenProducto1` FOREIGN KEY (`idAlmacenProducto`) REFERENCES `almacenProducto` (`idAlmacenProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleCTP_CTP1` FOREIGN KEY (`idCTP`) REFERENCES `CTP` (`idCTP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleVenta`
--
ALTER TABLE `detalleVenta`
  ADD CONSTRAINT `fk_detalleVenta_almacenProducto1` FOREIGN KEY (`idAlmacenProducto`) REFERENCES `almacenProducto` (`idAlmacenProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleVenta_venta1` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Imprenta`
--
ALTER TABLE `Imprenta`
  ADD CONSTRAINT `fk_CTP_user10` FOREIGN KEY (`idUserOT`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CTP_user20` FOREIGN KEY (`idUserVenta`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_cajaMovimientoVenta100` FOREIGN KEY (`idCajaMovimientoVenta`) REFERENCES `cajaMovimientoVenta` (`idCajaMovimientoVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_cliente100` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MatrizPreciosCTP`
--
ALTER TABLE `MatrizPreciosCTP`
  ADD CONSTRAINT `fk_MatrizPreciosCTP_almacenProductos1` FOREIGN KEY (`idAlmacenProducto`) REFERENCES `almacenProducto` (`idAlmacenProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MatrizPreciosCTP_cantidadCTP1` FOREIGN KEY (`idCantidad`) REFERENCES `cantidadCTP` (`idCantidadCTP`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MatrizPreciosCTP_horario1` FOREIGN KEY (`idHorario`) REFERENCES `horario` (`idHorario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MatrizPreciosCTP_TiposClientes1` FOREIGN KEY (`idTiposClientes`) REFERENCES `TiposClientes` (`idTiposClientes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_recibos_cajaMovimientoVenta1` FOREIGN KEY (`idCajaMovimientoVenta`) REFERENCES `cajaMovimientoVenta` (`idCajaMovimientoVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
  ADD CONSTRAINT `fk_venta_cajaMovimientoVenta1` FOREIGN KEY (`idCajaMovimientoVenta`) REFERENCES `cajaMovimientoVenta` (`idCajaMovimientoVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_cliente1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
