-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-09-2014 a las 16:52:40
-- Versión del servidor: 5.5.38
-- Versión de PHP: 5.4.4-14+deb7u14

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=726 ;

--
-- Volcado de datos para la tabla `almacenProducto`
--

INSERT INTO `almacenProducto` (`idAlmacenProducto`, `idProducto`, `stockU`, `stockP`, `idAlmacen`) VALUES
(1, 1, 0, 0, 1),
(3, 2, 0, 0, 1),
(4, 3, 0, 0, 1),
(5, 4, 0, 28, 1),
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
(22, 21, 0, 24, 1),
(24, 23, 0, 3, 1),
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
(36, 35, 0, 15, 1),
(37, 36, 0, 20, 1),
(38, 37, 0, 15, 1),
(39, 38, 0, 10, 1),
(40, 39, 0, 4, 1),
(41, 40, 0, 15, 1),
(42, 41, 0, 10, 1),
(43, 42, 0, 14, 1),
(44, 43, 0, 31, 1),
(45, 44, 0, 6, 1),
(46, 45, 0, 10, 1),
(47, 46, 0, 15, 1),
(48, 47, 0, 14, 1),
(49, 48, 0, 6, 1),
(50, 49, 0, 45, 1),
(51, 50, 0, 25, 1),
(52, 51, 0, 16, 1),
(53, 52, 0, 29, 1),
(54, 53, 0, 0, 1),
(55, 54, 0, 0, 1),
(56, 55, 0, 9, 1),
(57, 56, 0, 0, 1),
(58, 57, 0, 0, 1),
(59, 58, 0, 0, 1),
(60, 59, 0, 0, 1),
(61, 60, 0, 0, 1),
(62, 61, 0, 5, 1),
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
(116, 107, 26, 2, 1),
(117, 108, 0, 0, 1),
(118, 109, 0, 0, 1),
(119, 110, 0, 8, 1),
(120, 111, 0, 21, 1),
(121, 112, 0, 18, 1),
(122, 113, 0, 11, 1),
(123, 114, 0, 16, 1),
(124, 115, 0, 13, 1),
(125, 116, 0, 17, 1),
(435, 1, 0, 0, 2),
(436, 2, 1, 9, 2),
(437, 45, 97, 0, 2),
(438, 47, 53, 0, 2),
(439, 44, 67, 0, 2),
(440, 46, 26, 1, 2),
(441, 48, 31, 1, 2),
(442, 29, 0, 10, 2),
(443, 103, 67, 0, 2),
(444, 31, 40, 3, 2),
(445, 30, 89, 4, 2),
(446, 32, 25, 0, 2),
(447, 109, 4, 0, 2),
(448, 108, 0, 0, 2),
(449, 19, 4, 0, 2),
(450, 18, 89, 3, 2),
(451, 106, 0, 0, 2),
(452, 26, 11, 0, 2),
(453, 28, 0, 0, 2),
(454, 105, 0, 0, 2),
(455, 107, 16, 2, 2),
(458, 27, 60, 0, 2),
(459, 104, 20, 3, 2),
(461, 77, 0, 0, 2),
(464, 4, 179, 7, 2),
(466, 74, 223, 0, 2),
(468, 9, 21, 0, 2),
(469, 79, 33, 0, 2),
(472, 6, 220, 0, 2),
(474, 76, 24, 0, 2),
(476, 3, 0, 0, 2),
(477, 8, 27, 4, 2),
(480, 78, 0, 0, 2),
(481, 5, 0, 0, 2),
(483, 75, 22, 0, 2),
(485, 7, 10, 0, 2),
(488, 85, 0, 0, 2),
(489, 93, 5, 0, 2),
(491, 82, 50, 0, 2),
(499, 90, 0, 0, 2),
(500, 87, 163, 0, 2),
(502, 84, 0, 0, 2),
(503, 92, 17, 0, 2),
(504, 81, 163, 0, 2),
(505, 89, 0, 0, 2),
(506, 86, 0, 0, 2),
(507, 83, 0, 0, 2),
(508, 91, 9, 0, 2),
(509, 10, 21, 2, 2),
(510, 80, 50, 4, 2),
(511, 88, 106, 7, 2),
(512, 101, 0, 0, 2),
(513, 12, 72, 0, 2),
(514, 20, 32, 4, 2),
(515, 98, 0, 0, 2),
(516, 17, 145, 6, 2),
(517, 95, 0, 0, 2),
(518, 14, 86, 1, 2),
(519, 100, 77, 2, 2),
(520, 11, 273, 0, 2),
(521, 97, 103, 0, 2),
(522, 16, 0, 0, 2),
(523, 25, 64, 12, 2),
(524, 94, 12, 0, 2),
(525, 102, 0, 0, 2),
(526, 13, 0, 1, 2),
(527, 21, 207, 0, 2),
(528, 99, 0, 0, 2),
(529, 96, 0, 0, 2),
(530, 15, 223, 7, 2),
(531, 42, 352, 3, 2),
(532, 111, 22, 3, 2),
(533, 39, 345, 3, 2),
(534, 110, 478, 2, 2),
(535, 40, 50, 3, 2),
(536, 114, 262, 0, 2),
(537, 116, 113, 1, 2),
(538, 113, 134, 2, 2),
(539, 115, 178, 1, 2),
(540, 112, 276, 0, 2),
(541, 37, 432, 0, 2),
(542, 36, 444, 0, 2),
(543, 41, 180, 0, 2),
(544, 38, 130, 0, 2),
(545, 35, 234, 0, 2),
(546, 43, 304, 0, 2),
(547, 117, 0, 0, 1),
(548, 118, 12, 0, 1),
(549, 119, 0, 0, 1),
(550, 120, 0, 90, 1),
(551, 121, 0, 90, 1),
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
(566, 136, 0, 5, 1),
(567, 137, 0, 0, 1),
(568, 138, 0, 0, 1),
(569, 139, 0, 0, 1),
(570, 140, 0, 25, 1),
(571, 141, 0, 0, 1),
(572, 142, 0, 0, 1),
(573, 143, 0, 0, 1),
(574, 144, 0, 2, 1),
(575, 24, 25, 0, 2),
(576, 140, 146, 0, 2),
(577, 23, 25, 0, 2),
(578, 141, 0, 0, 2),
(579, 143, 0, 4, 2),
(580, 144, 52, 0, 2),
(581, 142, 0, 0, 2),
(582, 121, 0, 6, 2),
(583, 181, 56, 0, 3),
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
(631, 53, 0, 0, 2),
(632, 149, 2, 0, 2),
(633, 152, 0, 0, 2),
(634, 147, 3, 0, 2),
(635, 49, 14, 0, 2),
(636, 52, 10, 0, 2),
(637, 50, 15, 0, 2),
(638, 51, 6, 0, 2),
(639, 56, 14, 0, 2),
(640, 59, 0, 0, 2),
(641, 174, 15, 0, 2),
(642, 172, 102, 3, 2),
(643, 173, 25, 0, 2),
(644, 66, 18, 0, 2),
(645, 62, 18, 0, 2),
(646, 58, 4, 0, 2),
(647, 169, 0, 0, 2),
(648, 164, 0, 0, 2),
(649, 165, 0, 0, 2),
(650, 70, 52, 0, 2),
(651, 73, 0, 0, 2),
(652, 68, 75, 0, 2),
(653, 71, 66, 0, 2),
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
(674, 34, 150, 4, 2),
(675, 126, 0, 0, 2),
(676, 124, 0, 0, 2),
(677, 127, 0, 0, 2),
(678, 125, 0, 0, 2),
(679, 128, 0, 0, 2),
(680, 122, 0, 0, 2),
(681, 117, 0, 0, 2),
(682, 120, 0, 4, 2),
(683, 123, 0, 0, 2),
(684, 180, 0, 0, 2),
(685, 158, 7, 0, 2),
(686, 161, 2, 0, 2),
(687, 159, 3, 0, 2),
(688, 160, 8, 0, 2),
(689, 162, 0, 0, 2),
(690, 163, 2073, 0, 2),
(691, 64, 10, 0, 2),
(692, 61, 2, 1, 2),
(693, 179, 18, 0, 2),
(694, 176, 39, 1, 2),
(695, 178, 0, 0, 2),
(696, 175, 24, 0, 2),
(697, 177, 19, 0, 2),
(698, 63, 13, 3, 2),
(699, 57, 0, 0, 2),
(700, 168, 9, 1, 2),
(701, 60, 0, 0, 2),
(702, 166, 0, 0, 2),
(703, 167, 0, 0, 2),
(704, 181, 400, 0, 1),
(705, 182, 0, 0, 1),
(706, 182, 129, 0, 2),
(707, 183, 0, 9, 1),
(708, 183, 17, 0, 2),
(709, 184, 850, 0, 1),
(710, 184, 22, 0, 3),
(711, 185, 0, 0, 1),
(712, 186, 0, 0, 1),
(713, 187, 0, 0, 1),
(714, 188, 0, 0, 1),
(715, 188, 0, 0, 3),
(716, 185, 0, 0, 3),
(717, 187, 0, 0, 3),
(718, 186, 0, 0, 3),
(719, 189, 0, 0, 1),
(720, 189, 122, 0, 2),
(721, 190, 0, 0, 1),
(722, 190, 5, 126, 2),
(723, 191, 0, 0, 1),
(724, 192, 0, 0, 1),
(725, 192, 0, 0, 2);

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
(1, 'administracion', 10460.2, NULL),
(2, 'distribuidora', 686.2, 1),
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
  `idCajaMovimientoVenta` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCajaArqueo`),
  KEY `fk_cajaVenta_caja1` (`idCaja`),
  KEY `fk_cajaVenta_user1` (`idUser`),
  KEY `fk_cajaArqueo_cajaMovimientoVenta1` (`idCajaMovimientoVenta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `cajaArqueo`
--

INSERT INTO `cajaArqueo` (`idCajaArqueo`, `idCaja`, `idUser`, `monto`, `fechaArqueo`, `fechaVentas`, `comprobante`, `saldo`, `idCajaMovimientoVenta`) VALUES
(1, 2, 2, 558, '2014-08-19 16:11:14', '2014-08-18 00:00:00', '1', 0, 11),
(2, 2, 2, 1200, '2014-08-20 16:34:11', '2014-08-19 00:00:00', '2', 76.6, 26),
(3, 2, 2, 1600, '2014-08-21 09:11:56', '2014-08-20 00:00:00', '3', 22.2, 50),
(4, 2, 2, 1800, '2014-08-22 18:20:30', '2014-08-21 00:00:00', '4', 11.1, 80),
(5, 2, 2, 900, '2014-08-25 18:09:33', '2014-08-22 00:00:00', '5', 62.2, 123),
(6, 2, 2, 2382.2, '2014-08-27 16:13:08', '2014-08-26 00:00:00', '6', 234.6, 137),
(7, 2, 2, 520, '2014-08-28 19:10:10', '2014-08-27 00:00:00', '7', 47.1, 149),
(10, 2, 1, 0, '2014-08-29 16:25:10', '2014-08-28 00:00:00', '', 391.6, 151),
(11, 2, 2, 1500, '2014-08-30 14:49:41', '2014-08-29 00:00:00', '8', 80.7, 158);

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
  `detalle` varchar(100) NOT NULL,
  `Obs` varchar(100) NOT NULL,
  `registro` int(11) NOT NULL,
  `factura` varchar(50) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=159 ;

--
-- Volcado de datos para la tabla `cajaMovimientoVenta`
--

INSERT INTO `cajaMovimientoVenta` (`idCajaMovimientoVenta`, `idUser`, `monto`, `motivo`, `fechaMovimiento`, `tipo`, `arqueo`, `idCaja`) VALUES
(1, 2, 8, 'Nota de Venta', '2014-08-20 17:48:46', -1, 0, 2),
(2, 2, 2.9, 'Nota de Venta', '2014-08-20 17:48:58', -1, 0, 2),
(3, 2, 1.2, 'Nota de Venta', '2014-08-20 17:49:15', -1, 0, 2),
(4, 2, 15, 'Nota de Venta', '2014-08-18 19:34:34', 0, 1, 2),
(5, 2, 155.7, 'Nota de Venta', '2014-08-18 19:35:55', 0, 1, 2),
(6, 2, 290, 'Nota de Venta', '2014-08-18 19:40:45', 0, 1, 2),
(7, 2, 35, 'Nota de Venta', '2014-08-20 17:49:44', -1, 0, 2),
(8, 2, 28.3, 'Nota de Venta', '2014-08-18 20:11:53', 0, 1, 2),
(9, 2, 69, 'Nota de Venta', '2014-08-18 19:48:59', 0, 1, 2),
(10, 2, 60, 'Nota de Venta', '2014-08-20 17:50:21', -1, 0, 2),
(11, 2, 558, 'Traspaso de efectivo a Administracion', '2014-08-18 23:59:59', 0, 1, 2),
(12, 2, 55, 'Nota de Venta', '2014-08-20 17:41:39', -1, 0, 2),
(13, 2, 3.5, 'Nota de Venta', '2014-08-20 17:51:05', -1, 0, 2),
(14, 2, 40, 'Nota de Venta', '2014-08-19 17:13:38', 0, 2, 2),
(15, 2, 34.4, 'Nota de Venta', '2014-08-19 17:14:22', 0, 2, 2),
(16, 2, 16, 'Nota de Venta', '2014-08-19 17:14:55', 0, 2, 2),
(17, 2, 116.2, 'Nota de Venta', '2014-08-19 17:18:28', 0, 2, 2),
(18, 2, 236.5, 'Nota de Venta', '2014-08-19 18:17:51', 0, 2, 2),
(19, 2, 135.1, 'Nota de Venta', '2014-08-20 17:53:38', -1, 0, 2),
(20, 2, 240, 'Nota de Venta', '2014-08-19 18:22:52', 0, 2, 2),
(21, 2, 28, 'Nota de Venta', '2014-08-19 18:25:11', 0, 2, 2),
(22, 2, 53.3, 'Nota de Venta', '2014-08-20 17:53:58', -1, 0, 2),
(23, 2, 115.5, 'Nota de Venta', '2014-08-19 19:13:24', 0, 2, 2),
(24, 2, 65, 'Nota de Venta', '2014-08-19 19:18:23', 0, 2, 2),
(25, 2, 385, 'Nota de Venta', '2014-08-19 19:20:36', 0, 2, 2),
(26, 2, 1200, 'Traspaso de efectivo a Administracion', '2014-08-19 23:59:59', 0, 2, 2),
(27, 2, 165, 'Nota de Venta', '2014-08-20 16:36:31', 0, 3, 2),
(28, 2, 51.6, 'Nota de Venta', '2014-08-20 16:37:46', 0, 3, 2),
(29, 2, 33, 'Nota de Venta', '2014-08-20 17:54:08', -1, 0, 2),
(30, 2, 133, 'Nota de Venta', '2014-08-20 20:00:45', -1, 0, 2),
(31, 2, 151.9, 'Nota de Venta', '2014-08-20 20:12:37', 0, 3, 2),
(32, 2, 15.7, 'Nota de Venta', '2014-08-20 20:15:10', 0, 3, 2),
(33, 2, 27.3, 'Nota de Venta', '2014-08-20 20:26:59', -1, 0, 2),
(34, 2, 318.5, 'Nota de Venta', '2014-08-20 20:28:40', -1, 0, 2),
(35, 2, 165.8, 'Nota de Venta', '2014-08-20 20:31:34', -1, 0, 2),
(36, 2, 66, 'Nota de Venta', '2014-08-20 20:34:37', -1, 0, 2),
(37, 2, 85, 'Nota de Venta', '2014-08-20 20:35:31', -1, 0, 2),
(38, 2, 8, 'Nota de Venta', '2014-08-20 20:36:41', -1, 0, 2),
(39, 2, 12, 'Nota de Venta', '2014-08-20 20:37:29', 0, 3, 2),
(40, 2, 38.3, 'Nota de Venta', '2014-08-20 20:38:23', 0, 3, 2),
(41, 2, 78, 'Nota de Venta', '2014-08-20 20:40:07', 0, 3, 2),
(42, 2, 130, 'Nota de Venta', '2014-08-20 20:41:38', 0, 3, 2),
(43, 2, 180.6, 'Nota de Venta', '2014-08-20 20:42:13', 0, 3, 2),
(44, 2, 68, 'Nota de Venta', '2014-08-20 20:43:18', 0, 3, 2),
(45, 2, 47, 'Nota de Venta', '2014-08-20 20:44:26', 0, 3, 2),
(46, 2, 14, 'Nota de Venta', '2014-08-20 20:45:21', 0, 3, 2),
(47, 2, 43.5, 'Nota de Venta', '2014-08-20 20:46:14', 0, 3, 2),
(48, 2, 44, 'Nota de Venta', '2014-08-20 20:46:54', 0, 3, 2),
(49, 2, 506, 'Nota de Venta', '2014-08-20 20:47:45', 0, 3, 2),
(50, 2, 1600, 'Traspaso de efectivo a Administracion', '2014-08-20 23:59:59', 0, 3, 2),
(51, 2, 46.5, 'Nota de Venta', '2014-08-21 15:17:27', 0, 4, 2),
(52, 2, 68, 'Nota de Venta', '2014-08-21 15:18:03', 0, 4, 2),
(53, 2, 5.7, 'Nota de Venta', '2014-08-21 15:19:04', 0, 4, 2),
(54, 2, 340.2, 'Nota de Venta', '2014-08-21 15:21:14', -1, 0, 2),
(55, 2, 237.3, 'Nota de Venta', '2014-08-21 15:24:47', 0, 4, 2),
(56, 2, 2.5, 'Nota de Venta', '2014-08-21 15:46:13', -1, 0, 2),
(57, 2, 2.9, 'Nota de Venta', '2014-08-21 15:50:22', -1, 0, 2),
(58, 2, 14, 'Nota de Venta', '2014-08-21 15:51:08', 0, 4, 2),
(59, 2, 36.9, 'Nota de Venta', '2014-08-21 15:51:59', -1, 0, 2),
(60, 2, 155, 'Nota de Venta', '2014-08-21 15:54:44', -1, 0, 2),
(61, 2, 14, 'Nota de Venta', '2014-08-21 15:55:30', 0, 4, 2),
(62, 2, 98, 'Nota de Venta', '2014-08-21 15:56:26', 0, 4, 2),
(63, 2, 81.7, 'Nota de Venta', '2014-08-21 15:58:39', 0, 4, 2),
(64, 2, 58, 'Nota de Venta', '2014-08-21 16:00:48', -1, 0, 2),
(65, 2, 289.9, 'Nota de Venta', '2014-08-21 16:02:20', -1, 0, 2),
(66, 2, 640, 'Nota de Venta', '2014-08-21 16:03:23', 0, 4, 2),
(67, 2, 113.6, 'Nota de Venta', '2014-08-21 16:05:52', 0, 4, 2),
(68, 2, 72.3, 'Nota de Venta', '2014-08-21 16:07:07', 0, 4, 2),
(69, 2, 232.8, 'Nota de Venta', '2014-08-21 16:10:03', -1, 0, 2),
(70, 2, 13, 'Nota de Venta', '2014-08-21 16:10:39', 0, 4, 2),
(71, 2, 18, 'Nota de Venta', '2014-08-21 16:19:22', 0, 4, 2),
(72, 2, 17, 'Nota de Venta', '2014-08-21 16:19:52', 0, 4, 2),
(73, 2, 84, 'Nota de Venta', '2014-08-21 16:20:50', 0, 4, 2),
(74, 2, 268.2, 'Nota de Venta', '2014-08-21 16:23:23', -1, 0, 2),
(75, 2, 175.5, 'Nota de Venta', '2014-08-21 18:51:05', -1, 0, 2),
(76, 2, 25.8, 'Nota de Venta', '2014-08-21 18:51:51', 0, 4, 2),
(77, 2, 240, 'Nota de Venta', '2014-08-21 18:54:57', 0, 4, 2),
(78, 2, 167.7, 'Nota de Venta', '2014-08-21 18:55:41', -1, 0, 2),
(79, 2, 8, 'Nota de Venta', '2014-08-21 18:56:25', -1, 0, 2),
(80, 2, 1800, 'Traspaso de efectivo a Administracion', '2014-08-21 23:59:59', 0, 4, 2),
(81, 2, 25, 'Nota de Venta', '2014-08-22 18:40:10', 0, 5, 2),
(82, 2, 17.2, 'Nota de Venta', '2014-08-22 18:40:50', 0, 5, 2),
(83, 2, 150.5, 'Nota de Venta', '2014-08-22 18:41:24', 0, 5, 2),
(84, 2, 49, 'Nota de Venta', '2014-08-22 18:42:51', 0, 5, 2),
(85, 2, 85.5, 'Nota de Venta', '2014-08-22 18:44:44', 0, 5, 2),
(86, 2, 16, 'Nota de Venta', '2014-08-22 18:45:32', -1, 0, 2),
(87, 2, 205, 'Nota de Venta', '2014-08-22 18:46:13', 0, 5, 2),
(88, 2, 79.5, 'Nota de Venta', '2014-08-22 18:46:50', 0, 5, 2),
(89, 2, 165.6, 'Nota de Venta', '2014-08-22 18:47:32', 0, 5, 2),
(90, 2, 43, 'Nota de Venta', '2014-08-22 18:47:53', 0, 5, 2),
(91, 2, 11525, 'Nota de Venta', '2014-08-22 19:04:31', -1, 0, 2),
(92, 2, 23, 'Nota de Venta', '2014-08-22 19:06:01', 0, 5, 2),
(93, 2, 15, 'Nota de Venta', '2014-08-22 19:50:57', 0, 5, 2),
(94, 2, 5, 'Nota de Venta', '2014-08-22 19:51:25', 0, 5, 2),
(95, 2, 941.2, 'Nota de Venta', '2014-08-22 20:04:47', -1, 0, 2),
(96, 2, 15, 'Nota de Venta', '2014-08-22 20:06:34', 0, 5, 2),
(97, 2, 37.5, 'Nota de Venta', '2014-08-22 20:07:18', 0, 5, 2),
(98, 2, 35.3, 'Nota de Venta', '2014-08-22 20:09:20', 0, 5, 2),
(99, 2, 11525, 'Nota de Venta', '2014-08-25 16:21:14', -1, 0, 2),
(100, 2, 65, 'Nota de Venta', '2014-08-25 16:33:45', 0, 6, 2),
(101, 2, 65, 'Nota de Venta', '2014-08-25 16:36:56', 0, 6, 2),
(102, 2, 133, 'Nota de Venta', '2014-08-25 16:38:36', -1, 0, 2),
(103, 2, 130, 'Nota de Venta', '2014-08-25 16:39:14', 0, 6, 2),
(104, 2, 68, 'Nota de Venta', '2014-08-25 16:39:49', 0, 6, 2),
(105, 2, 68, 'Nota de Venta', '2014-08-25 16:40:30', 0, 6, 2),
(106, 2, 263, 'Nota de Venta', '2014-08-25 16:51:27', 0, 6, 2),
(107, 2, 784.8, 'Nota de Venta', '2014-08-25 17:23:57', -1, 0, 2),
(108, 2, 162, 'Nota de Venta', '2014-08-25 17:25:33', 0, 6, 2),
(109, 2, 20.8, 'Nota de Venta', '2014-08-25 17:26:28', -1, 0, 2),
(110, 2, 25.6, 'Nota de Venta', '2014-08-25 17:27:10', -1, 0, 2),
(111, 2, 325, 'Nota de Venta', '2014-08-25 17:29:29', 0, 6, 2),
(112, 2, 84.6, 'Nota de Venta', '2014-08-25 17:34:29', 0, 6, 2),
(113, 2, 108.6, 'Nota de Venta', '2014-08-25 17:35:27', 0, 6, 2),
(114, 2, 49, 'Nota de Venta', '2014-08-25 17:36:05', 0, 6, 2),
(115, 2, 506, 'Nota de Venta', '2014-08-25 17:37:42', 0, 6, 2),
(116, 2, 9, 'Nota de Venta', '2014-08-25 17:38:34', -1, 0, 2),
(117, 2, 8895, 'Nota de Venta', '2014-08-25 18:03:14', -1, 0, 2),
(118, 2, 50, 'Nota de Venta', '2014-08-25 18:04:38', 0, 6, 2),
(119, 2, 396, 'Nota de Venta', '2014-08-25 18:05:37', 0, 6, 2),
(120, 2, 18, 'Nota de Venta', '2014-08-25 18:07:01', -1, 0, 2),
(121, 2, 9, 'Nota de Venta', '2014-08-25 18:08:11', -1, 0, 2),
(122, 2, 10, 'Nota de Venta', '2014-08-25 18:08:42', 0, 6, 2),
(123, 2, 900, 'Traspaso de efectivo a Administracion', '2014-08-22 23:59:59', 0, 5, 2),
(124, 2, 2.6, 'Nota de Venta', '2014-08-26 18:34:06', -1, 0, 2),
(125, 2, 77.7, 'Nota de Venta', '2014-08-26 18:43:47', 0, 6, 2),
(126, 2, 1608, 'Nota de Venta', '2014-08-26 19:04:23', -1, 0, 2),
(127, 2, 102, 'Nota de Venta', '2014-08-26 19:05:21', -1, 0, 2),
(128, 2, 16, 'Nota de Venta', '2014-08-26 19:07:25', 0, 6, 2),
(129, 2, 45.7, 'Nota de Venta', '2014-08-26 19:08:21', 0, 6, 2),
(130, 2, 61.2, 'Nota de Venta', '2014-08-26 19:09:12', -1, 0, 2),
(131, 2, 25, 'Nota de Venta', '2014-08-26 19:09:59', 0, 6, 2),
(132, 2, 173.7, 'Nota de Venta', '2014-08-26 19:11:11', -1, 0, 2),
(133, 2, 3.3, 'Nota de Venta', '2014-08-26 19:11:53', -1, 0, 2),
(134, 2, 15, 'Nota de Venta', '2014-08-26 19:12:17', 0, 6, 2),
(135, 2, 25, 'Nota de Venta', '2014-08-26 19:16:51', 0, 6, 2),
(136, 2, 48.1, 'Nota de Venta', '2014-08-26 19:17:27', -1, 0, 2),
(137, 2, 2382.2, 'Traspaso de efectivo a Administracion', '2014-08-26 23:59:59', 0, 6, 2),
(138, 2, 76.2, 'Nota de Venta', '2014-08-27 17:56:38', 0, 7, 2),
(139, 2, 110.5, 'Nota de Venta', '2014-08-27 18:05:17', 0, 7, 2),
(140, 2, 3199.8, 'Nota de Venta', '2014-08-27 18:10:08', -1, 0, 2),
(141, 2, 9, 'Nota de Venta', '2014-08-27 18:11:44', -1, 0, 2),
(142, 2, 145.8, 'Nota de Venta', '2014-08-27 18:13:16', 0, 7, 2),
(143, 2, 361.2, 'Nota de Venta', '2014-08-27 18:23:52', -1, 0, 2),
(144, 2, 2369.6, 'Nota de Venta', '2014-08-27 19:09:20', -1, 0, 2),
(145, 2, 74.8, 'Nota de Venta', '2014-08-28 16:14:05', -1, 0, 2),
(146, 2, 25.5, 'Nota de Venta', '2014-08-28 16:16:05', 0, 10, 2),
(147, 2, 200, 'Nota de Venta', '2014-08-28 16:17:28', 0, 10, 2),
(148, 2, 667.5, 'Nota de Venta', '2014-08-28 18:10:37', -1, 0, 2),
(149, 2, 520, 'Traspaso de efectivo a Administracion', '2014-08-27 23:59:59', 0, 7, 2),
(150, 2, 119, 'Nota de Venta', '2014-08-28 19:17:10', 0, 10, 2),
(151, 1, 0, 'Arqueo de Caja', '2014-08-28 23:59:59', 0, 10, 2),
(152, 2, 21.5, 'Nota de Venta', '2014-08-29 18:09:15', 0, 11, 2),
(153, 2, 1.5, 'Nota de Venta', '2014-08-29 18:10:54', 0, 11, 2),
(154, 2, 1033.1, 'Nota de Venta', '2014-08-29 18:20:17', 0, 11, 2),
(155, 2, 44, 'Nota de Venta', '2014-08-29 19:50:21', -1, 0, 2),
(156, 2, 133, 'Nota de Venta', '2014-08-29 20:29:24', 0, 11, 2),
(157, 2, 605.5, 'Nota de Venta', '2014-08-30 14:48:57', 0, 0, 2),
(158, 2, 1500, 'Traspaso de efectivo a Administracion', '2014-08-29 23:59:59', 0, 11, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidadCTP`
--

CREATE TABLE IF NOT EXISTS `cantidadCTP` (
  `idCantidadCTP` int(11) NOT NULL AUTO_INCREMENT,
  `Inicio` int(11) DEFAULT NULL,
  `final` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCantidadCTP`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `cantidadCTP`
--

INSERT INTO `cantidadCTP` (`idCantidadCTP`, `Inicio`, `final`) VALUES
(1, 1, 24),
(2, 25, 60),
(3, 61, 120),
(9, 121, 200),
(10, 201, 0);

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
  `idParent` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCliente`),
  KEY `fk_cliente_TiposClientes1` (`idTiposClientes`),
  KEY `fk_cliente_cliente1` (`idParent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nitCi`, `apellido`, `nombre`, `correo`, `fechaRegistro`, `telefono`, `direccion`, `idTiposClientes`, `idParent`) VALUES
(1, '00072', 'vargas', NULL, NULL, '2014-06-17 00:00:00', NULL, NULL, 4, NULL),
(2, '4852444019', 'mariño', NULL, NULL, '2014-06-17 00:00:00', NULL, NULL, 4, NULL),
(3, '5999242', 'Cortez', NULL, NULL, '2014-06-27 00:00:00', '', NULL, NULL, NULL),
(4, '3442350015', 'vasquez', NULL, NULL, '2014-07-17 00:00:00', NULL, NULL, 4, NULL),
(5, '6765717019', 'CAMINO', NULL, NULL, '2014-07-18 00:00:00', NULL, NULL, 4, NULL),
(6, '8435336', 'PINEDO', NULL, NULL, '2014-07-21 00:00:00', NULL, NULL, 4, NULL),
(7, '2364915011', 'TICONA', NULL, NULL, '2014-07-21 00:00:00', NULL, NULL, 4, NULL),
(8, '4865513019', 'VILLA', NULL, NULL, '2014-07-25 00:00:00', NULL, NULL, 4, NULL),
(9, '000', 'singular', 'singular', '', '2014-08-25 00:00:00', '', '', 4, NULL),
(10, '000123', 'DESCONOCIDO', '', '', '2014-08-18 00:00:00', '', '', 4, NULL),
(11, '00123', 'DESCONOCIDO', NULL, NULL, '2014-08-20 00:00:00', '', NULL, 4, NULL),
(12, '00123456', 'tst', '', '', '2014-08-22 00:00:00', '', '', 4, 9);

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
  `fechaEntega` datetime DEFAULT NULL,
  `obsCaja` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idCTP`),
  KEY `fk_venta_cliente1` (`idCliente`),
  KEY `fk_venta_cajaMovimientoVenta1` (`idCajaMovimientoVenta`),
  KEY `fk_CTP_user1` (`idUserOT`),
  KEY `fk_CTP_user2` (`idUserVenta`),
  KEY `fk_CTP_CTP1` (`idCTPParent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleEnvio`
--

CREATE TABLE IF NOT EXISTS `detalleEnvio` (
  `idDetalleEnvio` int(11) NOT NULL,
  `idAlmacenProducto` int(11) NOT NULL,
  `cantidadP` int(11) NOT NULL,
  `cantidadU` int(11) NOT NULL,
  `idEnvioMaterial` int(11) NOT NULL,
  PRIMARY KEY (`idDetalleEnvio`),
  KEY `fk_detalleEnvio_envioMaterial1` (`idEnvioMaterial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=225 ;

--
-- Volcado de datos para la tabla `detalleVenta`
--

INSERT INTO `detalleVenta` (`idDetalleVenta`, `idVenta`, `cantidadU`, `costoU`, `cantidadP`, `costoP`, `costoAdicional`, `costoTotal`, `idAlmacenProducto`) VALUES
(6, 4, 10, 1.5, 0, 330, NULL, 15, 674),
(7, 5, 55, 2.83, 0, 273, NULL, 155.7, 450),
(8, 6, 0, 3, 1, 290, NULL, 290, 450),
(12, 9, 1, 69, 0, 0, NULL, 69, 638),
(14, 8, 10, 2.83, 0, 273, NULL, 28.3, 450),
(18, 13, 0, 0, 0, 0, 40, 40, 585),
(19, 14, 8, 4.3, 0, 420, NULL, 34.4, 577),
(20, 15, 1, 16, 0, 0, NULL, 16, 692),
(22, 16, 12, 2.83, 0, 273, NULL, 34, 450),
(23, 16, 30, 2.74, 0, 261, NULL, 82.2, 445),
(24, 18, 55, 4.3, 0, 420, NULL, 236.5, 577),
(28, 20, 1, 240, 0, 0, NULL, 240, 685),
(29, 21, 1, 28, 0, 0, NULL, 28, 639),
(31, 23, 210, 0.55, 0, 265, NULL, 115.5, 527),
(32, 25, 1, 65, 0, 0, NULL, 65, 638),
(33, 26, 77, 5, 0, 460, NULL, 385, 577),
(34, 27, 55, 3, 0, 700, NULL, 165, 576),
(35, 28, 12, 4.3, 0, 420, NULL, 51.6, 577),
(38, 11, 0, 0.072, 1, 30, NULL, 0, 582),
(39, 11, 0, 0.062, 1, 25, NULL, 0, 682),
(40, 1, 1, 8, 0, 0, NULL, 0, 642),
(41, 2, 1, 2.9, 0, 700, NULL, 0, 576),
(42, 3, 1, 1.2, 0, 291, NULL, 0, 500),
(43, 7, 1, 35, 0, 0, NULL, 0, 698),
(44, 10, 1, 60, 0, 0, NULL, 0, 700),
(45, 12, 1, 3.5, 0, 0, NULL, 0, 694),
(46, 19, 70, 0.62, 0, 300, NULL, 0, 546),
(47, 19, 70, 0.66, 0, 315, NULL, 0, 543),
(48, 19, 70, 0.65, 0, 310, NULL, 0, 539),
(49, 22, 21, 2.54, 0, 253, NULL, 0, 503),
(50, 29, 1, 33, 0, 0, NULL, 0, 698),
(53, 30, 1, 65, 0, 0, NULL, 0, 636),
(54, 30, 1, 68, 0, 0, NULL, 0, 635),
(57, 31, 115, 0.65, 0, 315, NULL, 74.75, 546),
(58, 31, 115, 0.67, 0, 322, NULL, 77.1, 536),
(59, 32, 6, 2.62, 0, 247, NULL, 15.7, 439),
(61, 34, 65, 0.42, 0, 211, NULL, 0, 520),
(62, 35, 165, 0.62, 0, 300, NULL, 0, 546),
(63, 35, 165, 0.66, 0, 315, NULL, 0, 542),
(64, 35, 165, 0.65, 0, 310, NULL, 0, 536),
(65, 36, 195, 0.85, 0, 205, NULL, 0, 464),
(66, 38, 120, 0.55, 0, 265, NULL, 0, 527),
(67, 39, 100, 0.85, 0, 205, NULL, 0, 464),
(68, 40, 1, 8, 0, 0, NULL, 0, 642),
(69, 41, 0, 0, 0, 0, 12, 12, 585),
(70, 42, 10, 2.83, 0, 273, 10, 38.3, 449),
(71, 43, 40, 0.62, 0, 300, NULL, 24.8, 546),
(72, 43, 40, 0.66, 0, 315, NULL, 26.4, 542),
(73, 43, 40, 0.67, 0, 310, NULL, 26.8, 536),
(74, 44, 2, 65, 0, 0, NULL, 130, 638),
(75, 45, 42, 4.3, 0, 420, NULL, 180.6, 577),
(76, 46, 1, 68, 0, 0, NULL, 68, 635),
(77, 47, 10, 4.7, 0, 420, NULL, 47, 577),
(78, 48, 0, 0, 0, 0, 14, 14, 585),
(79, 49, 50, 0.77, 0, 184, 5, 43.5, 518),
(80, 50, 80, 0.55, 0, 265, NULL, 44, 527),
(81, 51, 20, 4.3, 1, 420, NULL, 506, 577),
(82, 52, 15, 3.1, 0, 750, NULL, 46.5, 576),
(83, 53, 1, 68, 0, 0, NULL, 68, 635),
(84, 54, 2, 2.83, 0, 273, NULL, 5.7, 449),
(85, 55, 200, 0.62, 0, 300, NULL, 0, 546),
(86, 55, 165, 0.66, 0, 315, NULL, 0, 541),
(87, 55, 165, 0.65, 0, 310, NULL, 0, 536),
(88, 56, 115, 0.65, 0, 315, 4.9, 79.7, 546),
(89, 56, 115, 0.69, 0, 327, NULL, 79.4, 545),
(90, 56, 115, 0.68, 0, 322, NULL, 78.2, 540),
(91, 57, 6, 0.42, 0, 211, NULL, 0, 520),
(92, 58, 7, 0.42, 0, 211, NULL, 0, 520),
(93, 59, 1, 14, 0, 0, NULL, 14, 692),
(94, 60, 67, 0.55, 0, 265, NULL, 0, 527),
(95, 61, 50, 3.1, 0, 305, NULL, 0, 468),
(96, 62, 1, 14, 0, 0, NULL, 14, 692),
(97, 63, 140, 0.7, 0, 154, NULL, 98, 523),
(98, 65, 19, 4.3, 0, 420, NULL, 81.7, 577),
(99, 66, 0, 0.062, 1, 26.5, NULL, 0, 682),
(100, 66, 0, 0.072, 1, 31.5, NULL, 0, 582),
(101, 67, 390, 0.66, 0, 315, NULL, 0, 544),
(102, 67, 50, 0.65, 0, 310, NULL, 0, 536),
(103, 68, 200, 0.55, 2, 265, NULL, 640, 527),
(104, 69, 35, 1.2, 0, 291, NULL, 42, 477),
(105, 69, 26, 1.79, 0, 175, NULL, 46.5, 435),
(106, 69, 14, 1.79, 0, 175, NULL, 25.1, 508),
(107, 70, 85, 0.85, 0, 205, NULL, 72.3, 464),
(108, 71, 35, 0.85, 1, 203, NULL, 0, 464),
(109, 72, 0, 0, 0, 0, 13, 13, 585),
(110, 73, 5, 3.6, 0, 340, NULL, 18, 443),
(111, 74, 20, 0.85, 0, 205, NULL, 17, 464),
(112, 75, 28, 3, 0, 290, NULL, 84, 450),
(113, 76, 33, 0.55, 1, 250, NULL, 0, 527),
(114, 77, 67, 2.62, 0, 247, NULL, 0, 439),
(115, 78, 6, 4.3, 0, 420, NULL, 25.8, 577),
(116, 79, 47, 5, 0, 460, 5, 240, 577),
(117, 80, 64, 2.62, 0, 247, NULL, 0, 439),
(118, 81, 1, 8, 0, 0, NULL, 0, 642),
(119, 82, 1, 25, 0, 0, NULL, 25, 722),
(120, 83, 4, 4.3, 0, 420, NULL, 17.2, 577),
(121, 84, 35, 4.3, 0, 420, NULL, 150.5, 577),
(122, 85, 1, 19, 0, 0, NULL, 19, 692),
(123, 85, 1, 30, 0, 0, NULL, 30, 639),
(124, 86, 8, 4.3, 0, 420, NULL, 34.4, 577),
(125, 86, 18, 2.84, 0, 273, NULL, 51.1, 449),
(126, 87, 2, 8, 0, 0, NULL, 0, 642),
(127, 88, 0, 0.85, 1, 205, NULL, 205, 464),
(128, 89, 28, 2.84, 0, 273, NULL, 79.5, 449),
(129, 90, 138, 1.2, 0, 291, NULL, 165.6, 477),
(130, 91, 10, 4.3, 0, 420, NULL, 43, 577),
(131, 93, 40, 65, 0, 0, NULL, 0, 638),
(132, 93, 50, 68, 0, 0, NULL, 0, 635),
(133, 93, 45, 65, 0, 0, NULL, 0, 637),
(134, 93, 40, 65, 0, 0, NULL, 0, 636),
(135, 94, 5, 4.6, 0, 0, NULL, 23, 653),
(136, 95, 0, 0, 0, 0, 15, 15, 585),
(137, 96, 0, 0, 0, 0, 5, 5, 585),
(138, 97, 78, 2.9, 1, 715, NULL, 0, 720),
(139, 98, 10, 1.5, 0, 330, NULL, 15, 674),
(140, 99, 25, 1.5, 0, 330, NULL, 37.5, 674),
(141, 100, 10, 3.1, 0, 305, NULL, 31, 468),
(142, 100, 1, 4.3, 0, 420, NULL, 4.3, 577),
(143, 101, 40, 65, 0, 0, NULL, 0, 638),
(144, 101, 50, 68, 0, 0, NULL, 0, 635),
(145, 101, 45, 65, 0, 0, NULL, 0, 637),
(146, 101, 40, 65, 0, 0, NULL, 0, 636),
(147, 102, 1, 65, 0, 0, NULL, 65, 638),
(148, 104, 1, 65, 0, 0, NULL, 65, 638),
(149, 105, 1, 68, 0, 0, NULL, 0, 635),
(150, 105, 1, 65, 0, 0, NULL, 0, 636),
(151, 106, 2, 65, 0, 0, NULL, 130, 638),
(152, 107, 1, 68, 0, 0, NULL, 68, 635),
(153, 108, 1, 68, 0, 0, NULL, 68, 635),
(154, 109, 1, 65, 0, 0, NULL, 65, 638),
(155, 109, 1, 68, 0, 0, NULL, 68, 635),
(156, 109, 1, 65, 0, 0, NULL, 65, 637),
(157, 109, 1, 65, 0, 0, NULL, 65, 636),
(158, 111, 80, 2.91, 2, 276, NULL, 0, 459),
(159, 112, 135, 1.2, 0, 291, NULL, 162, 477),
(160, 113, 13, 1.6, 0, 178, NULL, 0, 469),
(161, 114, 8, 3.2, 0, 305, NULL, 0, 468),
(162, 115, 2, 65, 0, 0, NULL, 130, 638),
(163, 115, 2, 65, 0, 0, NULL, 130, 637),
(164, 115, 1, 65, 0, 0, NULL, 65, 636),
(165, 116, 20, 0.55, 0, 265, NULL, 11, 527),
(166, 116, 26, 2.83, 0, 273, NULL, 73.6, 450),
(167, 117, 37, 2.8, 0, 273, 5, 108.6, 450),
(168, 118, 7, 7, 0, 0, NULL, 49, 652),
(169, 120, 20, 4.3, 1, 420, NULL, 506, 577),
(170, 121, 1, 9, 0, 0, NULL, 0, 642),
(171, 123, 30, 65, 0, 0, NULL, 0, 638),
(172, 123, 40, 68, 0, 0, NULL, 0, 635),
(173, 123, 35, 65, 0, 0, NULL, 0, 637),
(174, 123, 30, 65, 0, 0, NULL, 0, 636),
(175, 124, 10, 5, 0, 460, NULL, 50, 577),
(176, 125, 2, 65, 0, 0, NULL, 130, 638),
(177, 125, 2, 68, 0, 0, NULL, 136, 635),
(178, 125, 2, 65, 0, 0, NULL, 130, 637),
(179, 126, 2, 9, 0, 0, NULL, 0, 642),
(180, 127, 1, 9, 0, 0, NULL, 0, 642),
(181, 128, 0, 0, 0, 0, 10, 10, 585),
(182, 129, 1, 2.62, 0, 247, NULL, 0, 439),
(183, 130, 30, 0.62, 0, 300, NULL, 18.6, 546),
(184, 130, 30, 0.66, 0, 315, NULL, 19.8, 541),
(185, 130, 30, 0.66, 0, 315, NULL, 19.8, 543),
(186, 130, 30, 0.65, 0, 310, NULL, 19.5, 539),
(187, 131, 400, 0.68, 4, 334, NULL, 0, 725),
(188, 132, 120, 0.85, 0, 205, NULL, 0, 464),
(189, 133, 5, 3.2, 0, 305, NULL, 16, 468),
(190, 134, 9, 4.3, 0, 420, 7, 45.7, 577),
(191, 135, 90, 0.68, 0, 334, NULL, 0, 725),
(192, 136, 5, 5, 0, 460, NULL, 25, 577),
(193, 137, 90, 0.62, 0, 300, NULL, 0, 546),
(194, 137, 90, 0.66, 0, 315, NULL, 0, 543),
(195, 137, 90, 0.65, 0, 310, NULL, 0, 537),
(196, 138, 5, 0.66, 0, 315, NULL, 0, 543),
(197, 139, 1, 15, 0, 0, NULL, 15, 692),
(198, 140, 1, 25, 0, 0, NULL, 25, 639),
(199, 141, 17, 2.83, 0, 273, NULL, 0, 450),
(200, 142, 60, 0.62, 0, 300, NULL, 37.2, 546),
(201, 142, 60, 0.65, 0, 310, NULL, 39, 540),
(202, 143, 130, 0.85, 0, 205, NULL, 110.5, 464),
(203, 145, 90, 2.62, 12, 247, NULL, 0, 439),
(204, 146, 1, 9, 0, 0, NULL, 0, 642),
(205, 147, 265, 0.55, 0, 265, NULL, 145.8, 527),
(206, 149, 40, 0.68, 1, 334, NULL, 0, 725),
(207, 150, 418, 0.55, 7, 265, NULL, 0, 527),
(208, 150, 3, 2.91, 1, 276, NULL, 0, 452),
(209, 151, 88, 0.85, 0, 205, NULL, 0, 464),
(210, 152, 30, 0.85, 0, 205, NULL, 25.5, 464),
(211, 153, 0, 0.8, 1, 195, 5, 200, 526),
(212, 154, 250, 0.55, 2, 265, NULL, 0, 527),
(215, 155, 140, 0.85, 0, 205, NULL, 119, 464),
(216, 156, 5, 4.3, 0, 420, NULL, 21.5, 577),
(217, 157, 1, 1.5, 0, 330, NULL, 1.5, 674),
(218, 159, 56, 0.62, 1, 300, NULL, 334.7, 546),
(219, 159, 56, 0.66, 1, 315, NULL, 352, 545),
(220, 159, 56, 0.65, 1, 310, NULL, 346.4, 540),
(221, 160, 10, 4.4, 0, 425, NULL, 0, 455),
(222, 161, 1, 65, 0, 0, NULL, 65, 638),
(223, 161, 1, 68, 0, 0, NULL, 68, 635),
(224, 162, 170, 0.95, 2, 222, NULL, 605.5, 464);

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
-- Estructura de tabla para la tabla `envioMaterial`
--

CREATE TABLE IF NOT EXISTS `envioMaterial` (
  `idEnvioMaterial` int(11) NOT NULL,
  `fechaEnvio` datetime DEFAULT NULL,
  `origen` varchar(45) DEFAULT NULL,
  `destino` varchar(45) DEFAULT NULL,
  `responsable` varchar(45) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEnvioMaterial`),
  KEY `fk_envioMaterial_user1` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fallasCTP`
--

CREATE TABLE IF NOT EXISTS `fallasCTP` (
  `idfallasCTP` int(11) NOT NULL AUTO_INCREMENT,
  `idCtpRep` int(11) DEFAULT NULL,
  `obs` varchar(60) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `costoT` double DEFAULT NULL,
  PRIMARY KEY (`idfallasCTP`),
  KEY `fk_fallasCTP_idCTP1` (`idCtpRep`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
(1, '08:00:00', '20:05:00', 0),
(2, '20:06:00', '07:59:00', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

--
-- Volcado de datos para la tabla `MatrizPreciosCTP`
--

INSERT INTO `MatrizPreciosCTP` (`idMatrizPreciosCTP`, `idTiposClientes`, `idHorario`, `idCantidad`, `idAlmacenProducto`, `precioSF`, `precioCF`, `nombre`) VALUES
(6, 1, 1, 1, 583, 34.5, 38.5, NULL),
(7, 1, 2, 1, 583, 35, 39, NULL),
(8, 1, 1, 2, 583, 34, 38, NULL),
(9, 1, 2, 2, 583, 34.5, 38.5, NULL),
(10, 1, 1, 3, 583, 33.5, 37.5, NULL),
(11, 1, 2, 3, 583, 34, 38, NULL),
(16, 3, 1, 1, 583, 35, 39, NULL),
(17, 3, 2, 1, 583, 35.5, 39.5, NULL),
(18, 3, 1, 2, 583, 34.5, 38.5, NULL),
(19, 3, 2, 2, 583, 35, 39, NULL),
(20, 3, 1, 3, 583, 34, 38, NULL),
(21, 3, 2, 3, 583, 34.5, 38.5, NULL),
(30, 1, 1, 9, 583, 33, 37, NULL),
(31, 1, 2, 9, 583, 33.5, 37.5, NULL),
(32, 3, 1, 9, 583, 33.5, 37.5, NULL),
(33, 3, 2, 9, 583, 34, 38, NULL),
(34, 4, 1, 1, 583, 35.5, 39.5, NULL),
(35, 4, 2, 1, 583, 36, 40, NULL),
(36, 4, 1, 2, 583, 35, 39, NULL),
(37, 4, 2, 2, 583, 35.5, 39.5, NULL),
(38, 4, 1, 3, 583, 34.5, 38.5, NULL),
(39, 4, 2, 3, 583, 35, 39, NULL),
(40, 4, 1, 9, 583, 34, 38, NULL),
(41, 4, 2, 9, 583, 34.5, 38.5, NULL),
(48, 1, 1, 1, 710, 14.5, 16.5, NULL),
(49, 1, 2, 1, 710, 15, 17, NULL),
(50, 1, 1, 2, 710, 14, 16, NULL),
(51, 1, 2, 2, 710, 14.5, 16.5, NULL),
(52, 1, 1, 3, 710, 13.5, 15.5, NULL),
(53, 1, 2, 3, 710, 14, 16, NULL),
(54, 1, 1, 9, 710, 13, 15, NULL),
(55, 1, 2, 9, 710, 13.5, 15.5, NULL),
(58, 3, 1, 1, 710, 15, 17, NULL),
(59, 3, 2, 1, 710, 15.5, 17.5, NULL),
(60, 3, 1, 2, 710, 14.5, 16.5, NULL),
(61, 3, 2, 2, 710, 15, 17, NULL),
(62, 3, 1, 3, 710, 14, 16, NULL),
(63, 3, 2, 3, 710, 14.5, 16.5, NULL),
(64, 3, 1, 9, 710, 13.5, 15.5, NULL),
(65, 3, 2, 9, 710, 14, 16, NULL),
(68, 4, 1, 1, 710, 15.5, 17.5, NULL),
(69, 4, 2, 1, 710, 16, 18, NULL),
(70, 4, 1, 2, 710, 15, 17, NULL),
(71, 4, 2, 2, 710, 15.5, 17.5, NULL),
(72, 4, 1, 3, 710, 14.5, 16.5, NULL),
(73, 4, 2, 3, 710, 15, 17, NULL),
(74, 4, 1, 9, 710, 14, 16, NULL),
(75, 4, 2, 9, 710, 14.5, 16.5, NULL),
(78, 1, 1, 1, 716, 16.5, 18.5, NULL),
(79, 1, 2, 1, 716, 16, 18, NULL),
(80, 1, 1, 2, 716, 16, 18, NULL),
(81, 1, 2, 2, 716, 16.5, 18.5, NULL),
(82, 1, 1, 3, 716, 15.5, 17.5, NULL),
(83, 1, 2, 3, 716, 16, 18, NULL),
(84, 1, 1, 9, 716, 15, 17, NULL),
(85, 1, 2, 9, 716, 15.5, 17.5, NULL),
(88, 3, 1, 1, 716, 17, 19, NULL),
(89, 3, 2, 1, 716, 17.5, 19.5, NULL),
(90, 3, 1, 2, 716, 16.5, 18.5, NULL),
(91, 3, 2, 2, 716, 17, 19, NULL),
(92, 3, 1, 3, 716, 16, 18, NULL),
(93, 3, 2, 3, 716, 16.5, 18.5, NULL),
(94, 3, 1, 9, 716, 15.5, 17.5, NULL),
(95, 3, 2, 9, 716, 16, 18, NULL),
(98, 4, 1, 1, 716, 17.5, 19.5, NULL),
(99, 4, 2, 1, 716, 18, 20, NULL),
(100, 4, 1, 2, 716, 17, 19, NULL),
(101, 4, 2, 2, 716, 17.5, 19.5, NULL),
(102, 4, 1, 3, 716, 16.5, 18.5, NULL),
(103, 4, 2, 3, 716, 17, 19, NULL),
(104, 4, 1, 9, 716, 16, 18, NULL),
(105, 4, 2, 9, 716, 16.5, 18.5, NULL),
(108, 1, 1, 1, 718, 28.5, 30.5, NULL),
(109, 1, 2, 1, 718, 29, 31, NULL),
(110, 1, 1, 2, 718, 28, 30, NULL),
(111, 1, 2, 2, 718, 28.5, 30.5, NULL),
(112, 1, 1, 3, 718, 27.5, 29.5, NULL),
(113, 1, 2, 3, 718, 28, 30, NULL),
(114, 1, 1, 9, 718, 27, 29, NULL),
(115, 1, 2, 9, 718, 27.5, 29.5, NULL),
(118, 3, 1, 1, 718, 29, 31, NULL),
(119, 3, 2, 1, 718, 29.5, 31.5, NULL),
(120, 3, 1, 2, 718, 28.5, 30.5, NULL),
(121, 3, 2, 2, 718, 29, 31, NULL),
(122, 3, 1, 3, 718, 28, 30, NULL),
(123, 3, 2, 3, 718, 28.5, 30.5, NULL),
(124, 3, 1, 9, 718, 27.5, 29.5, NULL),
(125, 3, 2, 9, 718, 28, 30, NULL),
(128, 4, 1, 1, 718, 29.5, 31.5, NULL),
(129, 4, 2, 1, 718, 30, 32, NULL),
(130, 4, 1, 2, 718, 29, 31, NULL),
(131, 4, 2, 2, 718, 0, 0, NULL),
(132, 4, 1, 3, 718, 28.5, 30.5, NULL),
(133, 4, 2, 3, 718, 29, 31, NULL),
(134, 4, 1, 9, 718, 28, 30, NULL),
(135, 4, 2, 9, 718, 28.5, 30.5, NULL),
(138, 1, 1, 1, 717, 48, 52, NULL),
(139, 1, 2, 1, 717, 48.5, 52.5, NULL),
(140, 1, 1, 2, 717, 47.5, 51.5, NULL),
(141, 1, 2, 2, 717, 48, 52, NULL),
(142, 1, 1, 3, 717, 47, 51, NULL),
(143, 1, 2, 3, 717, 47.5, 51.5, NULL),
(144, 1, 1, 9, 717, 46.5, 50.5, NULL),
(145, 1, 2, 9, 717, 47, 51, NULL),
(148, 3, 1, 1, 717, 49, 53, NULL),
(149, 3, 2, 1, 717, 49.5, 53.5, NULL),
(150, 3, 1, 2, 717, 48.5, 52.5, NULL),
(151, 3, 2, 2, 717, 49, 53, NULL),
(152, 3, 1, 3, 717, 48, 52, NULL),
(153, 3, 2, 3, 717, 48.5, 52.5, NULL),
(154, 3, 1, 9, 717, 47.5, 51.5, NULL),
(155, 3, 2, 9, 717, 48, 52, NULL),
(158, 4, 1, 1, 717, 50, 54, NULL),
(159, 4, 2, 1, 717, 50.5, 54.5, NULL),
(160, 4, 1, 2, 717, 49.5, 53.5, NULL),
(161, 4, 2, 2, 717, 50, 54, NULL),
(162, 4, 1, 3, 717, 49, 53, NULL),
(163, 4, 2, 3, 717, 49.5, 53.5, NULL),
(164, 4, 1, 9, 717, 48.5, 52.5, NULL),
(165, 4, 2, 9, 717, 49, 53, NULL),
(168, 1, 1, 1, 715, 110, 125, NULL),
(169, 1, 2, 1, 715, 111, 126, NULL),
(170, 1, 1, 2, 715, 108, 123, NULL),
(171, 1, 2, 2, 715, 109, 124, NULL),
(172, 1, 1, 3, 715, 106, 121, NULL),
(173, 1, 2, 3, 715, 107, 122, NULL),
(174, 1, 1, 9, 715, 104, 119, NULL),
(175, 1, 2, 9, 715, 105, 118, NULL),
(178, 3, 1, 1, 715, 112, 127, NULL),
(179, 3, 2, 1, 715, 113, 128, NULL),
(180, 3, 1, 2, 715, 110, 125, NULL),
(181, 3, 2, 2, 715, 111, 126, NULL),
(182, 3, 1, 3, 715, 108, 123, NULL),
(183, 3, 2, 3, 715, 109, 124, NULL),
(184, 3, 1, 9, 715, 106, 121, NULL),
(185, 3, 2, 9, 715, 107, 122, NULL),
(188, 4, 1, 1, 715, 114, 129, NULL),
(189, 4, 2, 1, 715, 115, 130, NULL),
(190, 4, 1, 2, 715, 112, 127, NULL),
(191, 4, 2, 2, 715, 113, 128, NULL),
(192, 4, 1, 3, 715, 110, 125, NULL),
(193, 4, 2, 3, 715, 111, 126, NULL),
(194, 4, 1, 9, 715, 108, 123, NULL),
(195, 4, 2, 9, 715, 109, 124, NULL),
(196, 1, 1, 10, 710, 12.5, 14.5, NULL),
(197, 1, 2, 10, 710, 13, 15, NULL),
(198, 3, 1, 10, 710, 13, 15, NULL),
(199, 3, 2, 10, 710, 13.5, 15.5, NULL),
(200, 4, 1, 10, 710, 13.5, 15.5, NULL),
(201, 4, 2, 10, 710, 14, 16, NULL),
(202, 1, 1, 10, 716, 14.5, 16.5, NULL),
(203, 1, 2, 10, 716, 15, 17, NULL),
(204, 3, 1, 10, 716, 15, 17, NULL),
(205, 3, 2, 10, 716, 15.5, 17.5, NULL),
(206, 4, 1, 10, 716, 15.5, 17.5, NULL),
(207, 4, 2, 10, 716, 16, 18, NULL),
(208, 1, 1, 10, 718, 26.5, 28.5, NULL),
(209, 1, 2, 10, 718, 27, 29, NULL),
(210, 3, 1, 10, 718, 27, 29, NULL),
(211, 3, 2, 10, 718, 27.5, 29.5, NULL),
(212, 4, 1, 10, 718, 27.5, 29.5, NULL),
(213, 4, 2, 10, 718, 28, 30, NULL),
(214, 1, 1, 10, 583, 32.5, 36.5, NULL),
(215, 1, 2, 10, 583, 33, 37, NULL),
(216, 3, 1, 10, 583, 33, 37, NULL),
(217, 3, 2, 10, 583, 33.5, 37.5, NULL),
(218, 4, 1, 10, 583, 33.5, 37.5, NULL),
(219, 4, 2, 10, 583, 34, 38, NULL),
(220, 1, 1, 10, 717, 46, 50, NULL),
(221, 1, 2, 10, 717, 46.5, 50.5, NULL),
(222, 3, 1, 10, 717, 47, 51, NULL),
(223, 3, 2, 10, 717, 47.5, 51.5, NULL),
(224, 4, 1, 10, 717, 48, 52, NULL),
(225, 4, 2, 10, 717, 48.5, 52.5, NULL),
(226, 1, 1, 10, 715, 102, 117, NULL),
(227, 1, 2, 10, 715, 103, 118, NULL),
(228, 3, 1, 10, 715, 104, 119, NULL),
(229, 3, 2, 10, 715, 105, 120, NULL),
(230, 4, 1, 10, 715, 106, 121, NULL),
(231, 4, 2, 10, 715, 107, 122, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=470 ;

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
(312, 55, 1, 2, 13, NULL, NULL, '2014-08-05 12:28:30'),
(313, 183, 1, 2, 17, NULL, NULL, '2014-08-05 12:29:27'),
(314, 170, 1, 2, 2, NULL, NULL, '2014-08-05 12:30:28'),
(315, 150, 1, 2, 2, NULL, NULL, '2014-08-05 12:44:41'),
(316, 147, 1, 2, 3, NULL, NULL, '2014-08-05 12:46:19'),
(317, 148, 1, 2, 2, NULL, NULL, '2014-08-05 12:46:29'),
(318, 54, 1, 2, 5, NULL, NULL, '2014-08-05 12:46:38'),
(319, 153, 1, 2, 1, NULL, NULL, '2014-08-05 12:46:59'),
(320, 149, 1, 2, 2, NULL, NULL, '2014-08-05 12:47:16'),
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
(348, 175, 1, 2, 24, NULL, NULL, '2014-08-05 12:55:49'),
(349, 184, NULL, 1, 100, NULL, NULL, '2014-08-14 17:29:06'),
(350, 181, NULL, 1, 500, NULL, NULL, '2014-08-14 17:31:52'),
(351, 184, 1, 3, 50, NULL, NULL, '2014-08-14 17:33:09'),
(352, 184, NULL, 1, 800, NULL, NULL, '2014-08-14 17:33:52'),
(353, 181, 1, 3, 100, NULL, NULL, '2014-08-14 17:35:02'),
(354, 120, NULL, 1, NULL, 6, NULL, '2014-08-18 19:59:52'),
(355, 121, NULL, 1, NULL, 8, NULL, '2014-08-18 20:01:02'),
(356, 120, NULL, 1, NULL, 90, NULL, '2014-08-18 20:09:10'),
(357, 121, NULL, 1, NULL, 90, NULL, '2014-08-18 20:09:57'),
(358, 120, 1, 2, NULL, 6, NULL, '2014-08-18 20:10:16'),
(359, 121, 1, 2, NULL, 8, NULL, '2014-08-18 20:10:34'),
(360, 23, 1, 2, NULL, 1, NULL, '2014-08-19 17:26:57'),
(361, 21, 1, 2, NULL, 5, NULL, '2014-08-19 19:05:47'),
(363, 23, 1, 2, NULL, 1, NULL, '2014-08-19 19:19:32'),
(366, 11, NULL, 1, 339, NULL, NULL, '2014-08-20 20:22:47'),
(367, 11, 1, 2, 339, NULL, NULL, '2014-08-20 20:23:41'),
(368, 94, 1, 2, -339, NULL, NULL, '2014-08-20 20:24:15'),
(369, 94, NULL, 1, -339, NULL, NULL, '2014-08-20 20:25:10'),
(370, 23, 1, 2, NULL, 1, NULL, '2014-08-20 20:47:21'),
(371, 23, 1, 2, NULL, 1, NULL, '2014-08-21 15:58:10'),
(372, 189, NULL, 1, 200, 1, NULL, '2014-08-21 19:06:56'),
(373, 61, NULL, 1, NULL, 6, NULL, '2014-08-22 17:44:39'),
(374, 61, 1, 2, NULL, 1, NULL, '2014-08-22 17:45:31'),
(375, 23, 1, 2, NULL, 1, NULL, '2014-08-22 17:46:10'),
(376, 4, 1, 2, NULL, 8, NULL, '2014-08-22 17:46:24'),
(377, 21, 1, 2, NULL, 5, NULL, '2014-08-22 17:46:50'),
(382, 190, NULL, 1, NULL, 127, NULL, '2014-08-22 18:34:04'),
(383, 190, NULL, 1, NULL, 127, NULL, '2014-08-22 18:36:51'),
(384, 190, NULL, 1, NULL, -127, NULL, '2014-08-22 18:38:01'),
(385, 190, 1, 2, NULL, 127, NULL, '2014-08-22 18:39:08'),
(390, 43, NULL, 1, NULL, 10, NULL, '2014-08-22 19:34:00'),
(391, 38, NULL, 1, NULL, 5, NULL, '2014-08-22 19:34:44'),
(392, 37, NULL, 1, NULL, 5, NULL, '2014-08-22 19:35:09'),
(393, 36, NULL, 1, NULL, 10, NULL, '2014-08-22 19:35:23'),
(394, 41, NULL, 1, NULL, 10, NULL, '2014-08-22 19:35:39'),
(395, 35, NULL, 1, NULL, 5, NULL, '2014-08-22 19:36:10'),
(396, 116, NULL, 1, NULL, 5, NULL, '2014-08-22 19:37:10'),
(397, 136, NULL, 1, NULL, 5, NULL, '2014-08-22 19:37:52'),
(398, 115, NULL, 1, NULL, 10, NULL, '2014-08-22 19:38:24'),
(399, 114, NULL, 1, NULL, 5, NULL, '2014-08-22 19:41:42'),
(400, 112, NULL, 1, NULL, 5, NULL, '2014-08-22 19:41:57'),
(401, 189, NULL, 1, NULL, NULL, NULL, '2014-08-22 19:59:02'),
(402, 189, 1, 2, 200, NULL, NULL, '2014-08-22 20:01:03'),
(403, 189, 1, 2, NULL, 1, NULL, '2014-08-22 20:01:13'),
(414, 51, NULL, 1, NULL, 7, NULL, '2014-08-23 11:14:28'),
(415, 49, NULL, 1, NULL, 11, NULL, '2014-08-23 11:15:26'),
(416, 50, NULL, 1, NULL, 13, NULL, '2014-08-23 11:15:41'),
(417, 52, NULL, 1, NULL, 17, NULL, '2014-08-23 11:15:53'),
(418, 51, NULL, 1, 11, NULL, NULL, '2014-08-23 11:16:30'),
(419, 49, NULL, 1, 11, NULL, NULL, '2014-08-23 11:16:47'),
(420, 51, NULL, 1, -10, NULL, NULL, '2014-08-23 11:17:08'),
(421, 50, NULL, 1, 10, NULL, NULL, '2014-08-23 11:17:24'),
(422, 52, NULL, 1, 8, NULL, NULL, '2014-08-23 11:17:34'),
(423, 51, 1, 2, 1, NULL, NULL, '2014-08-23 11:17:57'),
(424, 49, 1, 2, 11, NULL, NULL, '2014-08-23 11:18:08'),
(425, 50, 1, 2, 10, NULL, NULL, '2014-08-23 11:18:16'),
(426, 52, 1, 2, 8, NULL, NULL, '2014-08-23 11:18:25'),
(427, 51, NULL, 1, 5, 17, NULL, '2014-08-23 11:20:23'),
(428, 51, 1, 2, 40, NULL, NULL, '2014-08-23 11:20:56'),
(429, 49, NULL, 1, NULL, 22, NULL, '2014-08-23 12:52:58'),
(430, 49, NULL, 1, NULL, 22, NULL, '2014-08-25 16:10:35'),
(431, 49, 1, 2, 50, NULL, NULL, '2014-08-25 16:11:17'),
(432, 50, NULL, 1, NULL, 21, NULL, '2014-08-25 16:14:29'),
(433, 50, 1, 2, 40, NULL, NULL, '2014-08-25 16:15:11'),
(434, 52, NULL, 1, 5, 19, NULL, '2014-08-25 16:19:04'),
(435, 52, 1, 2, 40, NULL, NULL, '2014-08-25 16:19:26'),
(436, 51, 1, 2, 10, NULL, NULL, '2014-08-25 16:36:29'),
(437, 104, 1, 2, -6, NULL, NULL, '2014-08-25 17:16:09'),
(438, 104, NULL, 1, -6, 6, NULL, '2014-08-25 17:16:23'),
(439, 104, 1, 2, NULL, 6, NULL, '2014-08-25 17:16:52'),
(440, 104, 1, 2, NULL, NULL, NULL, '2014-08-25 17:22:12'),
(441, 23, 1, 2, NULL, 1, NULL, '2014-08-25 17:37:17'),
(442, 51, 1, 2, 5, NULL, NULL, '2014-08-25 17:41:24'),
(443, 51, 1, 2, 30, NULL, NULL, '2014-08-25 17:55:12'),
(444, 49, 1, 2, 40, NULL, NULL, '2014-08-25 17:55:36'),
(445, 50, 1, 2, 30, NULL, NULL, '2014-08-25 17:55:55'),
(446, 52, 1, 2, 30, NULL, NULL, '2014-08-25 17:56:11'),
(447, 50, 1, 2, 10, NULL, NULL, '2014-08-25 18:02:10'),
(448, 52, 1, 2, 5, NULL, NULL, '2014-08-25 18:13:51'),
(449, 192, NULL, 1, NULL, 6, NULL, '2014-08-26 18:55:29'),
(450, 192, NULL, 1, NULL, 6, NULL, '2014-08-26 18:56:39'),
(451, 192, NULL, 1, NULL, -6, NULL, '2014-08-26 18:59:35'),
(452, 192, 1, 2, NULL, 6, NULL, '2014-08-26 19:03:17'),
(453, 44, 1, 2, NULL, 5, NULL, '2014-08-27 18:09:30'),
(454, 192, NULL, 1, 30, NULL, NULL, '2014-08-27 18:20:53'),
(455, 192, 1, 2, 30, NULL, NULL, '2014-08-27 18:21:22'),
(456, 21, 1, 2, NULL, 2, NULL, '2014-08-27 19:07:17'),
(457, 2, 1, 2, NULL, NULL, NULL, '2014-08-28 15:53:36'),
(458, 30, NULL, 1, NULL, 1, NULL, '2014-08-28 17:59:11'),
(459, 30, 1, 2, NULL, 1, NULL, '2014-08-28 17:59:19'),
(460, 30, 1, 2, -70, NULL, NULL, '2014-08-28 18:00:47'),
(461, 30, NULL, 1, 49, 4, NULL, '2014-08-28 18:01:30'),
(462, 30, 1, 2, 119, 4, NULL, '2014-08-28 18:02:04'),
(463, 30, 1, 2, -30, NULL, NULL, '2014-08-28 18:03:27'),
(464, 30, NULL, 1, -30, NULL, NULL, '2014-08-28 18:03:40'),
(465, 49, 1, 2, 10, NULL, NULL, '2014-08-29 10:55:57'),
(466, 50, 1, 2, 10, NULL, NULL, '2014-08-29 10:56:10'),
(467, 43, 1, 2, NULL, 1, NULL, '2014-08-29 18:18:44'),
(468, 107, NULL, 1, 26, NULL, NULL, '2014-08-29 19:48:08'),
(469, 107, NULL, 1, NULL, 2, NULL, '2014-08-29 19:48:20');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=193 ;

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
(30, NULL, 'CD225-77110C', 'Cartulina Duplex', 'Blanco/Café', 'CMPC', 'Chile', 100, 2.76, 261, 2.86, 271, 'Cartulina', '225G 77x110CM'),
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
(107, NULL, 'CT350-77110C', 'Cartulina Triplex', 'Blanco', 'CMPC', 'Chile', 100, 4.4, 425, 4.67, 452, 'Cartulina', '350G 77x110CM'),
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
(120, NULL, 'PB75-CC', 'Papel Bond', 'Blanco', 'Report', 'Argentino', 500, 0.062, 26, 0.068, 29, 'Papel', '75G Carta'),
(121, NULL, 'PB75-OC', 'Papel Bond', 'Blanco', 'Report', 'Argentino', 500, 0.072, 31, 0.078, 34, 'Papel', '75G Oficio'),
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
(158, NULL, 'M-45x457A', 'Mantilla', 'Azul', 'Antalis', '', 0, 240, 0, 260, 0, 'Mantillas', '(GTO46) H.45xA45.7, 4Lonas'),
(159, NULL, 'M-45x54A', 'Mantilla', 'Azul', 'Antalis', '', 0, 282, 0, 305, 0, 'Mantillas', '(GTO52) H.45xA54, 4Lonas'),
(160, NULL, 'M-58x67A', 'Mantilla', 'Azul', 'Antalis', '', 0, 450, 0, 490, 0, 'Mantillas', '(MO) H.58xA67, 4Lonas'),
(161, NULL, 'M-45x625A', 'Mantilla', 'Azul', 'Antalis', '', 0, 490, 0, 530, 0, 'Mantillas', '(ROLAND65) H.45xA.62.5, 4 Lonas'),
(162, NULL, '', 'Maletón', 'Rojo', '', '', 0, 1.37, 0, 1.45, 0, 'Maletones', '7 ancho, sintético, lineal, p/GTO46, 52'),
(163, NULL, '', 'Maletón', 'Rojo', '', '', 0, 1.6, 0, 1.75, 0, 'Maletones', '7.5 ancho, Sintetico, lineal,  p/MO, KORD, GESTETNER'),
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
(181, NULL, '', 'PLACAS CTP', 'MO', '', '', 0, 0, 0, 0, 0, '', '65x55x0.20'),
(182, NULL, '', 'Adhesivo Couche C/C', 'Blanco Alto Brillo', 'Adestor', 'España', 0, 0, 0, 0, 0, 'Adhesivo', '80G 70x50CM'),
(183, NULL, 'TT-1B-N', 'Tintas Tipografica', 'Negro', 'Boston', '', 18, 95, 0, 100, 0, 'Tintas', '1Kg'),
(184, NULL, '', 'PLACAS CTP', 'GTO46', '', '', 0, 0, 0, 0, 0, '', '45x37x0.15'),
(185, NULL, '', 'PLACAS CTP', 'GTO52', '', '', 0, 0, 0, 0, 0, '', '51x40x0.15'),
(186, NULL, '', 'PLACAS CTP', 'SM52', '', '', 0, 0, 0, 0, 0, '', '52.5x49.5x0.15'),
(187, NULL, '', 'PLACAS CTP', 'ROLAND 74', '', '', 0, 0, 0, 0, 0, '', '74.5x60.5x0.30'),
(188, NULL, '', 'PLACAS CTP', 'RESMA', '', '', 0, 0, 0, 0, 0, '', '77(79)x110x0.30'),
(189, NULL, 'ACSBM-C-5070AD', 'Adhesivo Papel C/C', 'BLANCO MATE ', 'ADESTOR', 'España', 250, 2.9, 715, 3.1, 750, 'Adhesivo', '50X70 CM'),
(190, NULL, 'I-CILCPT-P', 'Lapíz Corrector de Placas', 'Verde blanco', 'China', 'China', 6, 25, 0, 28, 0, 'COMPLEMENTOS DE IMPRENTA', 'DOBLE PUNTA X TERMAL PIEZA , PERMANENT'),
(191, NULL, '', '', '', '', '', 0, 0, 0, 0, 0, '', ''),
(192, NULL, 'PB63-77110CH', 'Papel Bond', 'Blanco', 'Chambril', 'Argentino', 500, 0.68, 334, 0.72, 350, 'Papel', 'Alcalino 63 G 77X110 ');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `TiposClientes`
--

INSERT INTO `TiposClientes` (`idTiposClientes`, `nombre`, `servicio`) VALUES
(1, 'Preferencial A', 1),
(2, 'singular', 0),
(3, 'Preferencial B', 1),
(4, 'nuevo', 1);

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
(1, 'helier', '5629500575ffe706d9d57fca5472153e', '2014-09-01 15:20:38', 0, '1', 2),
(2, 'erika', 'e10adc3949ba59abbe56e057f20f883e', '2014-09-01 11:27:40', 0, '3', 3),
(3, 'sergio', 'e10adc3949ba59abbe56e057f20f883e', '2014-07-21 15:14:21', 0, '4', 4),
(4, 'erick', '202cb962ac59075b964b07152d234b70', '2014-08-29 17:37:08', 0, '1', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=163 ;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idVenta`, `fechaVenta`, `tipoVenta`, `formaPago`, `idCliente`, `fechaPlazo`, `codigo`, `numero`, `serie`, `montoVenta`, `montoPagado`, `montoCambio`, `montoDescuento`, `estado`, `factura`, `autorizado`, `responsable`, `obs`, `idCajaMovimientoVenta`) VALUES
(1, '2014-08-18 19:23:43', 1, 0, 9, NULL, 'AP-1-14', 1, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. A PAPELES', 1),
(2, '2014-08-18 19:25:38', 1, 0, 9, NULL, 'AP-2-14', 2, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 174', 2),
(3, '2014-08-18 19:28:12', 1, 0, 9, NULL, 'AP-3-14', 3, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 174', 3),
(4, '2014-08-18 19:34:34', 1, 0, 10, NULL, 'AP-4-14', 4, 65, 15, 15, 0, NULL, 1, NULL, NULL, NULL, '', 4),
(5, '2014-08-18 19:35:54', 1, 0, 10, NULL, 'AP-5-14', 5, 65, 155.7, 155.7, 0, NULL, 1, NULL, NULL, NULL, '', 5),
(6, '2014-08-18 19:40:45', 0, 0, 10, NULL, '1-P', 1, NULL, 290, 290, 0, NULL, 1, '', NULL, NULL, 'PENDIENTE LA FACTURA', 6),
(7, '2014-08-18 19:46:28', 1, 0, 9, NULL, 'AP-6-14', 6, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. A DON LUIS - PRENSISTA', 7),
(8, '2014-08-18 19:47:21', 1, 0, 10, NULL, 'AP-7-14', 7, 65, 28.3, 28.3, 0, NULL, 1, NULL, NULL, NULL, '', 8),
(9, '2014-08-18 19:48:59', 0, 0, 10, NULL, '2-P', 2, NULL, 69, 69, 0, NULL, 1, '9653', NULL, NULL, '', 9),
(10, '2014-08-18 19:51:48', 1, 0, 9, NULL, 'AP-8-14', 8, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. AL GUILLOTINISTA - JORGE', 10),
(11, '2014-08-19 17:06:21', 1, 0, 9, NULL, 'AP-9-14', 9, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. T/ OFICO A VERONICA - ENTRG. T/ C A ERICKA (OFICNA)', 12),
(12, '2014-08-19 17:10:23', 1, 0, 9, NULL, 'AP-10-14', 10, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. A ERICKA DISEÑO (OFICINA)', 13),
(13, '2014-08-19 17:13:38', 1, 0, 10, NULL, 'AP-11-14', 11, 65, 40, 40, 0, NULL, 1, NULL, NULL, NULL, '', 14),
(14, '2014-08-19 17:14:22', 1, 0, 10, NULL, 'AP-12-14', 12, 65, 34.4, 34.4, 0, NULL, 1, NULL, NULL, NULL, '', 15),
(15, '2014-08-19 17:14:55', 1, 0, 10, NULL, 'AP-13-14', 13, 65, 16, 16, 0, NULL, 1, NULL, NULL, NULL, '', 16),
(16, '2014-08-19 17:16:07', 1, 0, 10, NULL, 'AP-14-14', 14, 65, 116.2, 116.2, 0, NULL, 1, NULL, NULL, NULL, '', 17),
(18, '2014-08-19 18:17:50', 1, 0, 10, NULL, 'AP-15-14', 15, 65, 236.5, 236.5, 0, NULL, 1, NULL, NULL, NULL, '', 18),
(19, '2014-08-19 18:19:42', 1, 0, 9, NULL, 'AP-16-14', 16, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 153', 19),
(20, '2014-08-19 18:22:51', 1, 0, 10, NULL, 'AP-17-14', 17, 65, 240, 240, 0, NULL, 1, NULL, NULL, NULL, '', 20),
(21, '2014-08-19 18:25:11', 1, 0, 10, NULL, 'AP-18-14', 18, 65, 28, 28, 0, NULL, 1, NULL, NULL, NULL, '', 21),
(22, '2014-08-19 18:26:16', 1, 0, 9, NULL, 'AP-19-14', 19, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 183', 22),
(23, '2014-08-19 19:13:24', 1, 0, 10, NULL, 'AP-20-14', 20, 65, 115.5, 115.5, 0, NULL, 1, NULL, NULL, NULL, '', 23),
(25, '2014-08-19 19:18:22', 1, 0, 10, NULL, 'AP-21-14', 21, 65, 65, 65, 0, NULL, 1, NULL, NULL, NULL, '', 24),
(26, '2014-08-19 19:20:35', 0, 0, 10, NULL, '3-P', 3, NULL, 385, 385, 0, NULL, 1, '9728', NULL, NULL, '', 25),
(27, '2014-08-20 16:36:31', 1, 0, 10, NULL, 'AP-22-14', 22, 65, 165, 165, 0, NULL, 1, NULL, NULL, NULL, '', 27),
(28, '2014-08-20 16:37:46', 1, 0, 10, NULL, 'AP-23-14', 23, 65, 51.6, 51.6, 0, NULL, 1, NULL, NULL, NULL, '', 28),
(29, '2014-08-20 16:38:19', 1, 0, 9, NULL, 'AP-24-14', 24, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. A DON LUIS - PRENSISTA', 29),
(30, '2014-08-20 19:40:21', 1, 0, 9, NULL, 'AP-25-14', 25, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. A DON LUIS - PRENSISTA', 30),
(31, '2014-08-20 20:09:31', 0, 0, 10, NULL, '4-P', 4, NULL, 151.9, 151.9, 0, NULL, 1, '9731', NULL, NULL, '', 31),
(32, '2014-08-20 20:15:10', 1, 0, 10, NULL, 'AP-26-14', 26, 65, 15.7, 15.7, 0, NULL, 1, NULL, NULL, NULL, '', 32),
(34, '2014-08-20 20:26:40', 1, 0, 9, NULL, 'AP-27-14', 27, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 153', 33),
(35, '2014-08-20 20:28:40', 1, 0, 9, NULL, 'AP-28-14', 28, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 179', 34),
(36, '2014-08-20 20:31:34', 1, 0, 9, NULL, 'AP-29-14', 29, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 178', 35),
(38, '2014-08-20 20:34:37', 1, 0, 9, NULL, 'AP-30-14', 30, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 177', 36),
(39, '2014-08-20 20:35:31', 1, 0, 9, NULL, 'AP-31-14', 31, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 176', 37),
(40, '2014-08-20 20:36:41', 1, 0, 9, NULL, 'AP-32-14', 32, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTR. A PAPALES', 38),
(41, '2014-08-20 20:37:28', 1, 0, 10, NULL, 'AP-33-14', 33, 65, 12, 12, 0, NULL, 1, NULL, NULL, NULL, '', 39),
(42, '2014-08-20 20:38:23', 1, 0, 10, NULL, 'AP-34-14', 34, 65, 38.3, 38.3, 0, NULL, 1, NULL, NULL, NULL, '', 40),
(43, '2014-08-20 20:40:06', 1, 0, 10, NULL, 'AP-35-14', 35, 65, 78, 78, 0, NULL, 1, NULL, NULL, NULL, '', 41),
(44, '2014-08-20 20:41:38', 1, 0, 10, NULL, 'AP-36-14', 36, 65, 130, 130, 0, NULL, 1, NULL, NULL, NULL, '', 42),
(45, '2014-08-20 20:42:13', 1, 0, 10, NULL, 'AP-37-14', 37, 65, 180.6, 180.6, 0, NULL, 1, NULL, NULL, NULL, '', 43),
(46, '2014-08-20 20:43:17', 1, 0, 10, NULL, 'AP-38-14', 38, 65, 68, 68, 0, NULL, 1, NULL, NULL, NULL, '', 44),
(47, '2014-08-20 20:44:26', 1, 0, 10, NULL, 'AP-39-14', 39, 65, 47, 47, 0, NULL, 1, NULL, NULL, NULL, '', 45),
(48, '2014-08-20 20:45:21', 1, 0, 10, NULL, 'AP-40-14', 40, 65, 14, 14, 0, NULL, 1, NULL, NULL, NULL, 'FALTO BS. 1 EN LA ENTRG, DE  DIENRO', 46),
(49, '2014-08-20 20:46:14', 1, 0, 10, NULL, 'AP-41-14', 41, 65, 43.5, 43.5, 0, NULL, 1, NULL, NULL, NULL, '', 47),
(50, '2014-08-20 20:46:53', 1, 0, 10, NULL, 'AP-42-14', 42, 65, 44, 44, 0, NULL, 1, NULL, NULL, NULL, '', 48),
(51, '2014-08-20 20:47:45', 1, 0, 10, NULL, 'AP-43-14', 43, 65, 506, 506, 0, NULL, 1, NULL, NULL, NULL, '', 49),
(52, '2014-08-21 15:17:26', 0, 0, 10, NULL, '5-P', 5, NULL, 46.5, 46.5, 0, NULL, 1, '', NULL, NULL, '', 51),
(53, '2014-08-21 15:18:03', 1, 0, 10, NULL, 'AP-44-14', 44, 65, 68, 68, 0, NULL, 1, NULL, NULL, NULL, '', 52),
(54, '2014-08-21 15:19:04', 1, 0, 10, NULL, 'AP-45-14', 45, 65, 5.7, 5.7, 0, NULL, 1, NULL, NULL, NULL, '', 53),
(55, '2014-08-21 15:21:14', 1, 0, 9, NULL, 'AP-46-14', 46, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 180', 54),
(56, '2014-08-21 15:24:47', 0, 0, 10, NULL, '6-P', 6, NULL, 237.3, 237.3, 0, NULL, 1, '9746', NULL, NULL, '', 55),
(57, '2014-08-21 15:46:13', 1, 0, 9, NULL, 'AP-47-14', 47, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'TAPAS - ORDENES DE TRABAJO PARA CBBA', 56),
(58, '2014-08-21 15:50:22', 1, 0, 9, NULL, 'AP-48-14', 48, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 180', 57),
(59, '2014-08-21 15:51:07', 1, 0, 10, NULL, 'AP-49-14', 49, 65, 14, 14, 0, NULL, 1, NULL, NULL, NULL, '', 58),
(60, '2014-08-21 15:51:58', 1, 0, 9, NULL, 'AP-50-14', 50, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 181', 59),
(61, '2014-08-21 15:54:43', 1, 0, 9, NULL, 'AP-51-14', 51, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 175', 60),
(62, '2014-08-21 15:55:30', 1, 0, 10, NULL, 'AP-52-14', 52, 65, 14, 14, 0, NULL, 1, NULL, NULL, NULL, '', 61),
(63, '2014-08-21 15:56:26', 1, 0, 10, NULL, 'AP-53-14', 53, 65, 98, 98, 0, NULL, 1, NULL, NULL, NULL, '', 62),
(65, '2014-08-21 15:58:38', 1, 0, 10, NULL, 'AP-54-14', 54, 65, 81.7, 81.7, 0, NULL, 1, NULL, NULL, NULL, '', 63),
(66, '2014-08-21 16:00:48', 1, 0, 9, NULL, 'AP-55-14', 55, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. A VERONICA - OFICINA', 64),
(67, '2014-08-21 16:02:20', 1, 0, 9, NULL, 'AP-56-14', 56, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 153', 65),
(68, '2014-08-21 16:03:23', 1, 0, 10, NULL, 'AP-57-14', 57, 65, 640, 640, 0, NULL, 1, NULL, NULL, NULL, '', 66),
(69, '2014-08-21 16:05:51', 1, 0, 10, NULL, 'AP-58-14', 58, 65, 113.6, 113.6, 0, NULL, 1, NULL, NULL, NULL, '', 67),
(70, '2014-08-21 16:07:06', 1, 0, 10, NULL, 'AP-59-14', 59, 65, 72.3, 72.3, 0, NULL, 1, NULL, NULL, NULL, '', 68),
(71, '2014-08-21 16:10:03', 1, 0, 9, NULL, 'AP-60-14', 60, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 182', 69),
(72, '2014-08-21 16:10:39', 1, 0, 10, NULL, 'AP-61-14', 61, 65, 13, 13, 0, NULL, 1, NULL, NULL, NULL, '', 70),
(73, '2014-08-21 16:19:22', 1, 0, 10, NULL, 'AP-62-14', 62, 65, 18, 18, 0, NULL, 1, NULL, NULL, NULL, '', 71),
(74, '2014-08-21 16:19:52', 1, 0, 10, NULL, 'AP-63-14', 63, 65, 17, 17, 0, NULL, 1, NULL, NULL, NULL, '', 72),
(75, '2014-08-21 16:20:50', 0, 0, 10, NULL, '7-P', 7, NULL, 84, 84, 0, NULL, 1, '9776', NULL, NULL, '', 73),
(76, '2014-08-21 16:23:22', 1, 0, 9, NULL, 'AP-64-14', 64, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 184', 74),
(77, '2014-08-21 18:51:05', 1, 0, 9, NULL, 'AP-65-14', 65, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 49 - CHANCHULLO', 75),
(78, '2014-08-21 18:51:50', 1, 0, 10, NULL, 'AP-66-14', 66, 65, 25.8, 25.8, 0, NULL, 1, NULL, NULL, NULL, '', 76),
(79, '2014-08-21 18:54:56', 0, 0, 10, NULL, '8-P', 8, NULL, 240, 240, 0, NULL, 1, '9801', NULL, NULL, '', 77),
(80, '2014-08-21 18:55:41', 1, 0, 9, NULL, 'AP-67-14', 67, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 49 - CHANCHULLO', 78),
(81, '2014-08-21 18:56:25', 1, 0, 9, NULL, 'AP-68-14', 68, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTREGADO A PAPELES', 79),
(82, '2014-08-22 18:40:10', 1, 0, 10, NULL, 'AP-69-14', 69, 65, 25, 25, 0, NULL, 1, NULL, NULL, NULL, '', 81),
(83, '2014-08-22 18:40:50', 1, 0, 10, NULL, 'AP-70-14', 70, 65, 17.2, 17.2, 0, NULL, 1, NULL, NULL, NULL, '', 82),
(84, '2014-08-22 18:41:23', 1, 0, 10, NULL, 'AP-71-14', 71, 65, 150.5, 150.5, 0, NULL, 1, NULL, NULL, NULL, '', 83),
(85, '2014-08-22 18:42:50', 0, 0, 10, NULL, '9-P', 9, NULL, 49, 49, 0, NULL, 1, '9830', NULL, NULL, '', 84),
(86, '2014-08-22 18:44:44', 1, 0, 10, NULL, 'AP-72-14', 72, 65, 85.5, 85.5, 0, NULL, 1, NULL, NULL, NULL, '', 85),
(87, '2014-08-22 18:45:32', 1, 0, 9, NULL, 'AP-73-14', 73, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. A PAPELES', 86),
(88, '2014-08-22 18:46:12', 1, 0, 10, NULL, 'AP-74-14', 74, 65, 205, 205, 0, NULL, 1, NULL, NULL, NULL, '', 87),
(89, '2014-08-22 18:46:50', 1, 0, 10, NULL, 'AP-75-14', 75, 65, 79.5, 79.5, 0, NULL, 1, NULL, NULL, NULL, '', 88),
(90, '2014-08-22 18:47:32', 1, 0, 10, NULL, 'AP-76-14', 76, 65, 165.6, 165.6, 0, NULL, 1, NULL, NULL, NULL, '', 89),
(91, '2014-08-22 18:47:52', 1, 0, 10, NULL, 'AP-77-14', 77, 65, 43, 43, 0, NULL, 1, NULL, NULL, NULL, '', 90),
(93, '2014-08-22 19:04:30', 1, 0, 9, NULL, 'AP-78-14', 78, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENVIÓ A SUCURSAL CBBA, AUT. POR DON ERICK', 91),
(94, '2014-08-22 19:06:01', 1, 0, 10, NULL, 'AP-79-14', 79, 65, 23, 23, 0, NULL, 1, NULL, NULL, NULL, '', 92),
(95, '2014-08-22 19:50:56', 1, 0, 10, NULL, 'AP-80-14', 80, 65, 15, 15, 0, NULL, 1, NULL, NULL, NULL, '', 93),
(96, '2014-08-22 19:51:25', 1, 0, 10, NULL, 'AP-81-14', 81, 65, 5, 5, 0, NULL, 1, NULL, NULL, NULL, '', 94),
(97, '2014-08-22 20:04:47', 1, 0, 9, NULL, 'AP-82-14', 82, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 185', 95),
(98, '2014-08-22 20:06:34', 1, 0, 10, NULL, 'AP-83-14', 83, 65, 15, 15, 0, NULL, 1, NULL, NULL, NULL, '', 96),
(99, '2014-08-22 20:07:17', 1, 0, 10, NULL, 'AP-84-14', 84, 65, 37.5, 37.5, 0, NULL, 1, NULL, NULL, NULL, '', 97),
(100, '2014-08-22 20:09:20', 1, 0, 10, NULL, 'AP-85-14', 85, 65, 35.3, 35.3, 0, NULL, 1, NULL, NULL, NULL, '', 98),
(101, '2014-08-25 16:21:13', 1, 0, 9, NULL, 'AP-86-14', 86, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENVIÓ A SUCURSAL CBBA', 99),
(102, '2014-08-25 16:33:45', 1, 0, 10, NULL, 'AP-87-14', 87, 65, 65, 65, 0, NULL, 1, NULL, NULL, NULL, '', 100),
(104, '2014-08-25 16:36:56', 1, 0, 10, NULL, 'AP-88-14', 88, 65, 65, 65, 0, NULL, 1, NULL, NULL, NULL, '', 101),
(105, '2014-08-25 16:38:36', 1, 0, 9, NULL, 'AP-89-14', 89, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. A DON LUSI  - PRENSISTA', 102),
(106, '2014-08-25 16:39:14', 1, 0, 10, NULL, 'AP-90-14', 90, 65, 130, 130, 0, NULL, 1, NULL, NULL, NULL, '', 103),
(107, '2014-08-25 16:39:49', 1, 0, 10, NULL, 'AP-91-14', 91, 65, 68, 68, 0, NULL, 1, NULL, NULL, NULL, '', 104),
(108, '2014-08-25 16:40:30', 1, 0, 10, NULL, 'AP-92-14', 92, 65, 68, 68, 0, NULL, 1, NULL, NULL, NULL, '', 105),
(109, '2014-08-25 16:51:26', 1, 0, 10, NULL, 'AP-93-14', 93, 65, 263, 263, 0, NULL, 1, NULL, NULL, NULL, '', 106),
(111, '2014-08-25 17:23:57', 1, 0, 9, NULL, 'AP-94-14', 94, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 187', 107),
(112, '2014-08-25 17:25:33', 1, 0, 10, NULL, 'AP-95-14', 95, 65, 162, 162, 0, NULL, 1, NULL, NULL, NULL, '', 108),
(113, '2014-08-25 17:26:27', 1, 0, 9, NULL, 'AP-96-14', 96, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 190', 109),
(114, '2014-08-25 17:27:10', 1, 0, 9, NULL, 'AP-97-14', 97, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 189', 110),
(115, '2014-08-25 17:29:28', 1, 0, 10, NULL, 'AP-98-14', 98, 65, 325, 325, 0, NULL, 1, NULL, NULL, NULL, '', 111),
(116, '2014-08-25 17:34:29', 1, 0, 10, NULL, 'AP-99-14', 99, 65, 84.6, 84.6, 0, NULL, 1, NULL, NULL, NULL, '', 112),
(117, '2014-08-25 17:35:26', 1, 0, 10, NULL, 'AP-100-14', 100, 65, 108.6, 108.6, 0, NULL, 1, NULL, NULL, NULL, '', 113),
(118, '2014-08-25 17:36:05', 1, 0, 10, NULL, 'AP-101-14', 101, 65, 49, 49, 0, NULL, 1, NULL, NULL, NULL, '', 114),
(120, '2014-08-25 17:37:42', 1, 0, 10, NULL, 'AP-102-14', 102, 65, 506, 506, 0, NULL, 1, NULL, NULL, NULL, '', 115),
(121, '2014-08-25 17:38:34', 1, 0, 9, NULL, 'AP-103-14', 103, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. A DON LUIS - PRENSISTA', 116),
(123, '2014-08-25 18:03:14', 1, 0, 9, NULL, 'AP-104-14', 104, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENVIADO A SUCURSAL EL ALTO', 117),
(124, '2014-08-25 18:04:38', 0, 0, 10, NULL, '10-P', 10, NULL, 50, 50, 0, NULL, 1, '9881', NULL, NULL, '', 118),
(125, '2014-08-25 18:05:37', 1, 0, 10, NULL, 'AP-105-14', 105, 65, 396, 396, 0, NULL, 1, NULL, NULL, NULL, '', 119),
(126, '2014-08-25 18:07:01', 1, 0, 9, NULL, 'AP-106-14', 106, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. A PAPELES', 120),
(127, '2014-08-25 18:08:10', 1, 0, 9, NULL, 'AP-107-14', 107, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTREGADO A YHANIRA - PARA EMBALAR', 121),
(128, '2014-08-25 18:08:42', 1, 0, 10, NULL, 'AP-108-14', 108, 65, 10, 10, 0, NULL, 1, NULL, NULL, NULL, '', 122),
(129, '2014-08-26 18:34:06', 1, 0, 9, NULL, 'AP-109-14', 109, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. A DOÑA MIRIAM', 124),
(130, '2014-08-26 18:43:47', 1, 0, 10, NULL, 'AP-110-14', 110, 65, 77.7, 77.7, 0, NULL, 1, NULL, NULL, NULL, '', 125),
(131, '2014-08-26 19:04:23', 1, 0, 9, NULL, 'AP-111-14', 111, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 96 - CHANCHULLO', 126),
(132, '2014-08-26 19:05:21', 1, 0, 9, NULL, 'AP-112-14', 112, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 88', 127),
(133, '2014-08-26 19:07:25', 1, 0, 10, NULL, 'AP-113-14', 113, 65, 16, 16, 0, NULL, 1, NULL, NULL, NULL, '', 128),
(134, '2014-08-26 19:08:21', 1, 0, 10, NULL, 'AP-114-14', 114, 65, 45.7, 45.7, 0, NULL, 1, NULL, NULL, NULL, '', 129),
(135, '2014-08-26 19:09:12', 1, 0, 9, NULL, 'AP-115-14', 115, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 96 - CHANCHULLO', 130),
(136, '2014-08-26 19:09:59', 0, 0, 10, NULL, '11-P', 11, NULL, 25, 25, 0, NULL, 1, '9899', NULL, NULL, '', 131),
(137, '2014-08-26 19:11:11', 1, 0, 9, NULL, 'AP-116-14', 116, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 191\r\n', 132),
(138, '2014-08-26 19:11:53', 1, 0, 9, NULL, 'AP-117-14', 117, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 153\r\n', 133),
(139, '2014-08-26 19:12:16', 1, 0, 10, NULL, 'AP-118-14', 118, 65, 15, 15, 0, NULL, 1, NULL, NULL, NULL, '', 134),
(140, '2014-08-26 19:16:51', 1, 0, 10, NULL, 'AP-119-14', 119, 65, 25, 25, 0, NULL, 1, NULL, NULL, NULL, '', 135),
(141, '2014-08-26 19:17:26', 1, 0, 9, NULL, 'AP-120-14', 120, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 192', 136),
(142, '2014-08-27 17:56:37', 1, 0, 10, NULL, 'AP-121-14', 121, 65, 76.2, 76.2, 0, NULL, 1, NULL, NULL, NULL, '', 138),
(143, '2014-08-27 18:05:17', 1, 0, 10, NULL, 'AP-122-14', 122, 65, 110.5, 110.5, 0, NULL, 1, NULL, NULL, NULL, '', 139),
(145, '2014-08-27 18:10:07', 1, 0, 9, NULL, 'AP-123-14', 123, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 96 - TAPA CHANCHULLO', 140),
(146, '2014-08-27 18:11:43', 1, 0, 9, NULL, 'AP-124-14', 124, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTREGADO A PAPELES', 141),
(147, '2014-08-27 18:13:16', 1, 0, 10, NULL, 'AP-125-14', 125, 65, 145.8, 145.8, 0, NULL, 1, NULL, NULL, NULL, '', 142),
(149, '2014-08-27 18:23:52', 1, 0, 9, NULL, 'AP-126-14', 126, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 96 - CHANCHULLO (DEMASÍA DE 30 HOJAS AL ABRIR LA RESMA)', 143),
(150, '2014-08-27 19:09:19', 1, 0, 9, NULL, 'AP-127-14', 127, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 186 - JULIO ARCE', 144),
(151, '2014-08-28 16:14:05', 1, 0, 9, NULL, 'AP-128-14', 128, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ORDEN Nº 194 - GRAFICA SINGULAR', 145),
(152, '2014-08-28 16:16:05', 1, 0, 10, NULL, 'AP-129-14', 129, 65, 25.5, 25.5, 0, NULL, 1, NULL, NULL, NULL, '', 146),
(153, '2014-08-28 16:17:27', 1, 0, 10, NULL, 'AP-130-14', 130, 65, 200, 200, 0, NULL, 1, NULL, NULL, NULL, '', 147),
(154, '2014-08-28 18:10:37', 1, 0, 9, NULL, 'AP-131-14', 131, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'VENTA QUE NO SE REGISTRO  FECHA 05/08/14 (4302)', 148),
(155, '2014-08-28 19:11:41', 1, 0, 10, NULL, 'AP-132-14', 132, 65, 119, 119, 0, NULL, 1, NULL, NULL, NULL, '', 150),
(156, '2014-08-29 18:09:14', 1, 0, 10, NULL, 'AP-133-14', 133, 65, 21.5, 21.5, 0, NULL, 1, NULL, NULL, NULL, '', 152),
(157, '2014-08-29 18:10:54', 1, 0, 10, NULL, 'AP-134-14', 134, 65, 1.5, 1.5, 0, NULL, 1, NULL, NULL, NULL, '', 153),
(159, '2014-08-29 18:20:16', 1, 0, 10, NULL, 'AP-135-14', 135, 65, 1033.1, 1033.1, 0, NULL, 1, NULL, NULL, NULL, '', 154),
(160, '2014-08-29 19:50:21', 1, 0, 9, NULL, 'AP-136-14', 136, 65, 0, 0, 0, NULL, 1, NULL, NULL, NULL, 'ENTRG. A DON ERICK', 155),
(161, '2014-08-29 20:29:24', 1, 0, 10, NULL, 'AP-137-14', 137, 65, 133, 133, 0, NULL, 1, NULL, NULL, NULL, '', 156),
(162, '2014-08-30 14:48:57', 0, 0, 10, NULL, '12-P', 12, NULL, 605.5, 605.5, 0, NULL, 1, NULL, NULL, NULL, '', 157);

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
  ADD CONSTRAINT `fk_cajaArqueo_cajaMovimientoVenta1` FOREIGN KEY (`idCajaMovimientoVenta`) REFERENCES `cajaMovimientoVenta` (`idCajaMovimientoVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
  ADD CONSTRAINT `fk_cliente_cliente1` FOREIGN KEY (`idParent`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cliente_TiposClientes1` FOREIGN KEY (`idTiposClientes`) REFERENCES `TiposClientes` (`idTiposClientes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `CTP`
--
ALTER TABLE `CTP`
  ADD CONSTRAINT `fk_CTP_CTP1` FOREIGN KEY (`idCTPParent`) REFERENCES `CTP` (`idCTP`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
-- Filtros para la tabla `detalleEnvio`
--
ALTER TABLE `detalleEnvio`
  ADD CONSTRAINT `fk_detalleEnvio_envioMaterial1` FOREIGN KEY (`idEnvioMaterial`) REFERENCES `envioMaterial` (`idEnvioMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleVenta`
--
ALTER TABLE `detalleVenta`
  ADD CONSTRAINT `fk_detalleVenta_almacenProducto1` FOREIGN KEY (`idAlmacenProducto`) REFERENCES `almacenProducto` (`idAlmacenProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleVenta_venta1` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `envioMaterial`
--
ALTER TABLE `envioMaterial`
  ADD CONSTRAINT `fk_envioMaterial_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fallasCTP`
--
ALTER TABLE `fallasCTP`
  ADD CONSTRAINT `fk_fallasCTP_idCTP1` FOREIGN KEY (`idCtpRep`) REFERENCES `CTP` (`idCTP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
