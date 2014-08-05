-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-08-2014 a las 11:44:37
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=705 ;

--
-- Volcado de datos para la tabla `almacenProducto`
--

INSERT INTO `almacenProducto` (`idAlmacenProducto`, `idProducto`, `stockU`, `stockP`, `idAlmacen`) VALUES
(1, 1, 0, 0, 1),
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
(74, 73, 0, 0, 1),
(83, 74, 0, 0, 1),
(84, 75, 0, 0, 1),
(85, 76, 0, 0, 1),
(86, 77, 0, 0, 1),
(87, 78, 0, 0, 1),
(88, 79, 0, 0, 1),
(89, 80, 0, 0, 1),
(90, 81, 0, 0, 1),
(91, 82, 0, 0, 1),
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
(110, 101, 0, 0, 1),
(111, 102, 0, 0, 1),
(112, 103, 0, 0, 1),
(113, 104, 0, 0, 1),
(114, 105, 0, 0, 1),
(115, 106, 0, 0, 1),
(116, 107, 0, 0, 1),
(117, 108, 0, 0, 1),
(118, 109, 0, 0, 1),
(119, 110, 0, 0, 1),
(120, 111, 0, 0, 1),
(121, 112, 0, 0, 1),
(122, 113, 0, 0, 1),
(123, 114, 0, 0, 1),
(124, 115, 0, 0, 1),
(125, 116, 0, 0, 1),
(435, 1, 0, 0, 2),
(436, 2, 0, 0, 2),
(437, 45, 0, 0, 2),
(438, 47, 0, 0, 2),
(439, 44, 0, 0, 2),
(440, 46, 0, 0, 2),
(441, 48, 0, 0, 2),
(442, 29, 0, 0, 2),
(443, 103, 0, 0, 2),
(444, 31, 0, 0, 2),
(445, 30, 0, 0, 2),
(446, 32, 0, 0, 2),
(447, 109, 0, 0, 2),
(448, 108, 0, 0, 2),
(449, 19, 0, 0, 2),
(450, 18, 0, 0, 2),
(451, 106, 0, 0, 2),
(452, 26, 0, 0, 2),
(453, 28, 0, 0, 2),
(454, 105, 0, 0, 2),
(455, 107, 0, 0, 2),
(458, 27, 0, 0, 2),
(459, 104, 0, 0, 2),
(461, 77, 0, 0, 2),
(464, 4, 0, 0, 2),
(466, 74, 0, 0, 2),
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
(502, 84, 0, 0, 2),
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
(513, 12, 0, 0, 2),
(514, 20, 0, 0, 2),
(515, 98, 0, 0, 2),
(516, 17, 0, 0, 2),
(517, 95, 0, 0, 2),
(518, 14, 0, 0, 2),
(519, 100, 0, 0, 2),
(520, 11, 0, 0, 2),
(521, 97, 0, 0, 2),
(522, 16, 0, 0, 2),
(523, 25, 0, 0, 2),
(524, 94, 0, 0, 2),
(525, 102, 0, 0, 2),
(526, 13, 0, 0, 2),
(527, 21, 0, 0, 2),
(528, 99, 0, 0, 2),
(529, 96, 0, 0, 2),
(530, 15, 0, 0, 2),
(531, 42, 0, 0, 2),
(532, 111, 0, 0, 2),
(533, 39, 0, 0, 2),
(534, 110, 0, 0, 2),
(535, 40, 0, 0, 2),
(536, 114, 0, 0, 2),
(537, 116, 0, 0, 2),
(538, 113, 0, 0, 2),
(539, 115, 0, 0, 2),
(540, 112, 0, 0, 2),
(541, 37, 0, 0, 2),
(542, 36, 0, 0, 2),
(543, 41, 0, 0, 2),
(544, 38, 0, 0, 2),
(545, 35, 0, 0, 2),
(546, 43, 0, 0, 2),
(547, 117, 0, 0, 1),
(548, 118, 0, 0, 1),
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
(570, 140, 0, 0, 1),
(571, 141, 0, 0, 1),
(572, 142, 0, 0, 1),
(573, 143, 0, 0, 1),
(574, 144, 0, 0, 1),
(575, 24, 0, 0, 2),
(576, 140, 0, 0, 2),
(577, 23, 0, 0, 2),
(578, 141, 0, 0, 2),
(579, 143, 0, 0, 2),
(580, 144, 0, 0, 2),
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
(622, 170, 0, 0, 2),
(623, 55, 0, 0, 2),
(624, 54, 0, 0, 2),
(625, 150, 0, 0, 2),
(626, 153, 0, 0, 2),
(627, 148, 0, 0, 2),
(628, 151, 0, 0, 2),
(629, 154, 0, 0, 2),
(630, 146, 0, 0, 2),
(631, 53, 0, 0, 2),
(632, 149, 0, 0, 2),
(633, 152, 0, 0, 2),
(634, 147, 0, 0, 2),
(635, 49, 0, 0, 2),
(636, 52, 0, 0, 2),
(637, 50, 0, 0, 2),
(638, 51, 0, 0, 2),
(639, 56, 0, 0, 2),
(640, 59, 0, 0, 2),
(641, 174, 0, 0, 2),
(642, 172, 0, 0, 2),
(643, 173, 0, 0, 2),
(644, 66, 0, 0, 2),
(645, 62, 0, 0, 2),
(646, 58, 0, 0, 2),
(647, 169, 0, 0, 2),
(648, 164, 0, 0, 2),
(649, 165, 0, 0, 2),
(650, 70, 0, 0, 2),
(651, 73, 0, 0, 2),
(652, 68, 0, 0, 2),
(653, 71, 0, 0, 2),
(654, 69, 0, 0, 2),
(655, 67, 0, 0, 2),
(656, 156, 0, 0, 2),
(657, 157, 0, 0, 2),
(658, 72, 0, 0, 2),
(659, 155, 0, 0, 2),
(660, 129, 0, 0, 2),
(661, 134, 0, 0, 2),
(662, 132, 0, 0, 2),
(663, 130, 0, 0, 2),
(664, 133, 0, 0, 2),
(665, 131, 0, 0, 2),
(666, 137, 0, 0, 2),
(667, 135, 0, 0, 2),
(668, 138, 0, 0, 2),
(669, 136, 0, 0, 2),
(670, 139, 0, 0, 2),
(671, 118, 0, 0, 2),
(672, 119, 0, 0, 2),
(673, 33, 0, 0, 2),
(674, 34, 0, 0, 2),
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
(685, 158, 0, 0, 2),
(686, 161, 0, 0, 2),
(687, 159, 0, 0, 2),
(688, 160, 0, 0, 2),
(689, 162, 0, 0, 2),
(690, 163, 0, 0, 2),
(691, 64, 0, 0, 2),
(692, 61, 0, 0, 2),
(693, 179, 0, 0, 2),
(694, 176, 0, 0, 2),
(695, 178, 0, 0, 2),
(696, 175, 0, 0, 2),
(697, 177, 0, 0, 2),
(698, 63, 0, 0, 2),
(699, 57, 0, 0, 2),
(700, 168, 0, 0, 2),
(701, 60, 0, 0, 2),
(702, 166, 0, 0, 2),
(703, 167, 0, 0, 2),
(704, 181, 0, 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidadCTP`
--

CREATE TABLE IF NOT EXISTS `cantidadCTP` (
  `idCantidadCTP` int(11) NOT NULL,
  `Inicio` int(11) DEFAULT NULL,
  `final` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCantidadCTP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(9, '000', 'singular', 'singular', '', '2014-08-01 15:26:36', '', '', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

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
  `idHorario` int(11) NOT NULL,
  `inicio` time DEFAULT NULL,
  `final` time DEFAULT NULL,
  `prioridad` int(11) DEFAULT NULL,
  PRIMARY KEY (`idHorario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `precioSF` double NOT NULL,
  `precioCF` double NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMatrizPreciosCTP`),
  KEY `fk_MatrizPreciosCTP_horario1` (`idHorario`),
  KEY `fk_MatrizPreciosCTP_cantidadCTP1` (`idCantidad`),
  KEY `fk_MatrizPreciosCTP_TiposClientes1` (`idTiposClientes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

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
  `idMatrizPrecios` int(11) DEFAULT NULL,
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
  PRIMARY KEY (`idProducto`),
  KEY `fk_producto_MatrizPreciosCTP1` (`idMatrizPrecios`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=182 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `idMatrizPrecios`, `codigo`, `material`, `color`, `marca`, `industria`, `cantXPaquete`, `precioSFU`, `precioSFP`, `precioCFU`, `precioCFP`, `familia`, `detalle`) VALUES
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
(49, NULL, 'TP-1A-C', 'Tintas de Proceso', 'Cyan', 'Amstrong', 'Alemania', 0, 68, 0, 72, 0, 'Tintas', '1Kg'),
(50, NULL, 'TP-1A-M', 'Tintas de Proceso', 'Magenta', 'Amstrong', 'Alemania', 0, 65, 0, 69, 0, 'Tintas', '1Kg'),
(51, NULL, 'TP-1A-A', 'Tintas de Proceso', 'Amarillo', 'Amstrong', 'Alemania', 0, 65, 0, 69, 0, 'Tintas', '1Kg'),
(52, NULL, 'TP-1A-N', 'Tintas de Proceso', 'Negro', 'Amstrong', 'Alemania', 0, 65, 0, 69, 0, 'Tintas', '1Kg'),
(53, NULL, 'TE-1A-BO', 'Tintas Epeciales', 'Blanco Opaco', 'Amstrong', 'Alemania', 0, 107, 0, 115, 0, 'Tintas', '1Kg'),
(54, NULL, 'TE-1A-RB', 'Tintas Epeciales', 'Reflex Blue', 'Amstrong', 'Alemania', 0, 145, 0, 157, 0, 'Tintas', '1Kg'),
(55, NULL, 'TT-1B-R', 'Tintas Tipografica', 'Rojo', 'Boston', '', 0, 95, 0, 100, 0, 'Tintas', '1Kg, Balde'),
(56, NULL, 'SF-1Ch', 'Solucion de Fuente', '', 'Chemical', '', 0, 28, 0, 31, 0, 'Quimicos', '1L'),
(57, NULL, 'LR-1BW', 'Lavador de Rodillos', '', 'Blue Wash', '', 0, 0, 0, 0, 0, 'Quimicos', '1L'),
(58, NULL, 'R-1A', 'Renal', '', 'Antalis', '', 0, 80, 0, 86.5, 0, 'Quimicos', '1L'),
(59, NULL, '', 'Solucion de Fuente', '', 'Antalis', '', 0, 27, 0, 30, 0, 'Quimicos', '1L, Stabilat 52'),
(60, NULL, '', 'Diluyente de Tinta', '', '', '', 0, 60, 0, 68, 0, 'Quimicos', 'frasco'),
(61, NULL, 'GA-1Ch', 'Goma Arabica', '', 'Chemical', '', 0, 15, 0, 18, 0, 'Quimicos', '1L, frasco'),
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
(133, NULL, 'PQI52-OF-V', 'Papel Quimico Int.', 'Verde', 'Focus', 'China', 500, 0.097, 44.5, 0.11, 46.5, 'Papel', '52G Oficio'),
(134, NULL, 'PQI52-OF-R', 'Papel Quimico Int.', 'Rosado', 'Focus', 'China', 500, 0.097, 44.5, 0.11, 46.5, 'Papel', '52G Oficio'),
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
(181, NULL, '', 'Placas', '', '', '', 0, 0, 0, 0, 0, 'Placas', 'MO 015');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
  PRIMARY KEY (`idTiposClientes`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `TiposClientes`
--

INSERT INTO `TiposClientes` (`idTiposClientes`, `nombre`) VALUES
(1, 'Preferencial A'),
(2, 'singular');

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
(1, 'helier', '5629500575ffe706d9d57fca5472153e', '2014-08-02 13:21:32', 0, '1', 2),
(2, 'erika', 'e10adc3949ba59abbe56e057f20f883e', '2014-08-04 10:02:56', 0, '3', 3),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

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
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_MatrizPreciosCTP1` FOREIGN KEY (`idMatrizPrecios`) REFERENCES `MatrizPreciosCTP` (`idMatrizPreciosCTP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
