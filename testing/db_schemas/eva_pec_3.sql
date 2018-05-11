-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2018 a las 03:38:51
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
-- Estructura de tabla para la tabla `banco_materias`
--

CREATE TABLE IF NOT EXISTS `banco_materias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `plan_estudio_id` int(11) NOT NULL,
  `nivel_grado_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_materias`
--

INSERT INTO `banco_materias` (`id`, `nombre`, `plan_estudio_id`, `nivel_grado_id`) VALUES
(1, 'MatemÃ¡ticas', 1, 1),
(2, 'MatemÃ¡ticas', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_niveles_escolares`
--

CREATE TABLE IF NOT EXISTS `banco_niveles_escolares` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_niveles_escolares`
--

INSERT INTO `banco_niveles_escolares` (`id`, `nombre`, `creado`) VALUES
(1, 'Secundaria', '2018-04-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_niveles_grados`
--

CREATE TABLE IF NOT EXISTS `banco_niveles_grados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `nivel_escolar_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_niveles_grados`
--

INSERT INTO `banco_niveles_grados` (`id`, `nombre`, `nivel_escolar_id`) VALUES
(1, '1ro', 1),
(2, '2do', 1),
(3, '3ro', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_nivel_turnos`
--

CREATE TABLE IF NOT EXISTS `banco_nivel_turnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_nivel_turnos`
--

INSERT INTO `banco_nivel_turnos` (`id`, `nombre`, `creado`) VALUES
(1, 'Matutino', '2018-04-27'),
(2, 'Vespertino', '2018-04-27');

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
-- Estructura de tabla para la tabla `grupos_alumnos`
--

CREATE TABLE IF NOT EXISTS `grupos_alumnos` (
  `id` int(11) NOT NULL,
  `grupo_info_id` int(11) NOT NULL,
  `user_alumno_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_info`
--

CREATE TABLE IF NOT EXISTS `grupos_info` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `nivel_escolar_id` int(11) NOT NULL,
  `nivel_turno_id` int(11) NOT NULL,
  `nivel_grado_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `plan_estudios_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos_info`
--

INSERT INTO `grupos_info` (`id`, `nombre`, `nivel_escolar_id`, `nivel_turno_id`, `nivel_grado_id`, `year`, `plan_estudios_id`, `creado`) VALUES
(1, 'A', 1, 1, 1, 2018, 1, '2018-05-09'),
(2, 'B', 1, 1, 2, 2018, 1, '2018-05-10'),
(3, 'I', 1, 1, 3, 2018, 1, '2018-05-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_mat_alum`
--

CREATE TABLE IF NOT EXISTS `grupos_mat_alum` (
  `id` int(11) NOT NULL,
  `grupo_mat_prof_id` int(11) NOT NULL,
  `user_alumno_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_mat_prof`
--

CREATE TABLE IF NOT EXISTS `grupos_mat_prof` (
  `id` int(11) NOT NULL,
  `banco_materia_id` int(11) NOT NULL,
  `user_profesor_id` int(11) NOT NULL,
  `grupo_info_id` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Estructura de tabla para la tabla `planes_estudios`
--

CREATE TABLE IF NOT EXISTS `planes_estudios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `planes_estudios`
--

INSERT INTO `planes_estudios` (`id`, `nombre`, `year`, `creado`) VALUES
(1, 'UATx', 2012, '2018-04-27'),
(2, 'Plan estudios', 2018, '2018-04-27');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `user`, `pass`, `clave`, `logo`, `informacion_id`, `perfil_id`, `estado_id`, `creado`, `actualizado`) VALUES
(5, 'Enrique Moran', 'dire', 'dire', 'director', NULL, 1, 1, 1, '2018-04-27', NULL),
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
-- Indices de la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banco_niveles_escolares`
--
ALTER TABLE `banco_niveles_escolares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banco_niveles_grados`
--
ALTER TABLE `banco_niveles_grados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banco_nivel_turnos`
--
ALTER TABLE `banco_nivel_turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `grupos_alumnos`
--
ALTER TABLE `grupos_alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos_info`
--
ALTER TABLE `grupos_info`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos_mat_alum`
--
ALTER TABLE `grupos_mat_alum`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos_mat_prof`
--
ALTER TABLE `grupos_mat_prof`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `planes_estudios`
--
ALTER TABLE `planes_estudios`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `banco_materias`
--
ALTER TABLE `banco_materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `banco_niveles_escolares`
--
ALTER TABLE `banco_niveles_escolares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `banco_niveles_grados`
--
ALTER TABLE `banco_niveles_grados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `banco_nivel_turnos`
--
ALTER TABLE `banco_nivel_turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `grupos_info`
--
ALTER TABLE `grupos_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `grupos_mat_alum`
--
ALTER TABLE `grupos_mat_alum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupos_mat_prof`
--
ALTER TABLE `grupos_mat_prof`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `planes_estudios`
--
ALTER TABLE `planes_estudios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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
