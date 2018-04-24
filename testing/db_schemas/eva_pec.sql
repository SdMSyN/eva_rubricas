-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2017 a las 00:43:40
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `eva_pec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`) VALUES
(1, 'Activo'),
(2, 'Desactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `nombre`, `creado`) VALUES
(1, 'Director', '2017-11-10'),
(2, 'Administrativo', '2017-11-10'),
(3, 'Profesor', '2017-11-10'),
(4, 'Alumno', '2017-11-10'),
(5, 'Tutor', '2017-11-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `logo` varchar(25) DEFAULT NULL,
  `informacion_id` int(11) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `creado` date NOT NULL,
  `actualizado` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `user`, `pass`, `clave`, `logo`, `informacion_id`, `perfil_id`, `estado_id`, `creado`, `actualizado`) VALUES
(1, 'Luigi Perez Calzada', 'GianBros', '123', 'gianbros', 'gianbros.png', 1, 2, 1, '2017-11-10', NULL),
(2, 'Test Profesor 1', 'prof1', 'prof1', 'prof1', NULL, 2, 3, 1, '2017-11-18', '2017-11-20 14:44:00'),
(3, 'Test profesor 2', 'prof2', 'prof2', 'prof2', NULL, 3, 3, 1, '2017-11-19', NULL),
(4, 'Test profesor 3', 'prof3', 'prof3', 'prof3', NULL, 4, 3, 1, '2017-11-19', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_informacion`
--

CREATE TABLE IF NOT EXISTS `usuarios_informacion` (
  `id` int(11) NOT NULL,
  `dir` varchar(150) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `creado` date NOT NULL,
  `actualizado` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_informacion`
--

INSERT INTO `usuarios_informacion` (`id`, `dir`, `tel`, `mail`, `creado`, `actualizado`) VALUES
(1, 'Av. Revolucion No. 168, Acxotla del Río, Totolac, Tlaxcala.', '2461231894', 'gianbros260@gmail.com', '2017-11-10', NULL),
(2, '', '1515151515', '', '2017-11-18', '2017-11-20 14:44:00'),
(3, '', '0987654321', '', '2017-11-19', NULL),
(4, '', '', 'algo@hot.com', '2017-11-19', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `user` (`user`), ADD KEY `id` (`id`), ADD KEY `informacion_id` (`informacion_id`,`perfil_id`,`estado_id`), ADD KEY `perfil_id` (`perfil_id`), ADD KEY `estado_id` (`estado_id`);

--
-- Indices de la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios_informacion`
--
ALTER TABLE `usuarios_informacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`informacion_id`) REFERENCES `usuarios_informacion` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
