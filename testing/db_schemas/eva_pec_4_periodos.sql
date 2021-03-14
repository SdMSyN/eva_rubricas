-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2018 a las 23:02:21
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
-- Estructura de tabla para la tabla `periodo_fecha`
--

CREATE TABLE IF NOT EXISTS `periodo_fecha` (
  `id` int(11) NOT NULL,
  `periodo_info_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_info`
--

CREATE TABLE IF NOT EXISTS `periodo_info` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `num_periodos` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubrica_detalles_calif`
--

CREATE TABLE IF NOT EXISTS `rubrica_detalles_calif` (
  `id` int(11) NOT NULL,
  `rubrica_info_calif_id` int(11) NOT NULL,
  `user_alumno_id` int(11) NOT NULL,
  `calificacion` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubrica_info`
--

CREATE TABLE IF NOT EXISTS `rubrica_info` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `grupo_mat_prof_id` int(11) NOT NULL,
  `periodo_fecha_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `porcentaje` int(3) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubrica_info_calif`
--

CREATE TABLE IF NOT EXISTS `rubrica_info_calif` (
  `id` int(11) NOT NULL,
  `rubrica_info_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `periodo_fecha`
--
ALTER TABLE `periodo_fecha`
  ADD PRIMARY KEY (`id`), ADD KEY `periodo_info_id` (`periodo_info_id`);

--
-- Indices de la tabla `periodo_info`
--
ALTER TABLE `periodo_info`
  ADD PRIMARY KEY (`id`), ADD KEY `estado_id` (`estado_id`);

--
-- Indices de la tabla `rubrica_detalles_calif`
--
ALTER TABLE `rubrica_detalles_calif`
  ADD PRIMARY KEY (`id`), ADD KEY `rubrica_info_calif_id` (`rubrica_info_calif_id`,`user_alumno_id`), ADD KEY `user_alumno_id` (`user_alumno_id`);

--
-- Indices de la tabla `rubrica_info`
--
ALTER TABLE `rubrica_info`
  ADD PRIMARY KEY (`id`), ADD KEY `grupo_mat_prof_id` (`grupo_mat_prof_id`,`periodo_fecha_id`,`estado_id`), ADD KEY `periodo_fecha_id` (`periodo_fecha_id`), ADD KEY `estado_id` (`estado_id`);

--
-- Indices de la tabla `rubrica_info_calif`
--
ALTER TABLE `rubrica_info_calif`
  ADD PRIMARY KEY (`id`), ADD KEY `rubrica_info_id` (`rubrica_info_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `periodo_fecha`
--
ALTER TABLE `periodo_fecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `periodo_info`
--
ALTER TABLE `periodo_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rubrica_detalles_calif`
--
ALTER TABLE `rubrica_detalles_calif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rubrica_info`
--
ALTER TABLE `rubrica_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rubrica_info_calif`
--
ALTER TABLE `rubrica_info_calif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `periodo_fecha`
--
ALTER TABLE `periodo_fecha`
ADD CONSTRAINT `periodo_fecha_ibfk_1` FOREIGN KEY (`periodo_info_id`) REFERENCES `periodo_info` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `periodo_info`
--
ALTER TABLE `periodo_info`
ADD CONSTRAINT `periodo_info_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `rubrica_detalles_calif`
--
ALTER TABLE `rubrica_detalles_calif`
ADD CONSTRAINT `rubrica_detalles_calif_ibfk_1` FOREIGN KEY (`rubrica_info_calif_id`) REFERENCES `rubrica_info_calif` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `rubrica_detalles_calif_ibfk_2` FOREIGN KEY (`user_alumno_id`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `rubrica_info`
--
ALTER TABLE `rubrica_info`
ADD CONSTRAINT `rubrica_info_ibfk_1` FOREIGN KEY (`grupo_mat_prof_id`) REFERENCES `grupos_mat_prof` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `rubrica_info_ibfk_2` FOREIGN KEY (`periodo_fecha_id`) REFERENCES `periodo_fecha` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `rubrica_info_ibfk_3` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `rubrica_info_calif`
--
ALTER TABLE `rubrica_info_calif`
ADD CONSTRAINT `rubrica_info_calif_ibfk_1` FOREIGN KEY (`rubrica_info_id`) REFERENCES `rubrica_info` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
