-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2017 a las 03:49:32
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pdvsa`
--
CREATE DATABASE IF NOT EXISTS `pdvsa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pdvsa`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beca`
--

CREATE TABLE `beca` (
  `id` int(8) NOT NULL,
  `beca` varchar(70) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `sede` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `perfil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beca_solicitante`
--

CREATE TABLE `beca_solicitante` (
  `id` int(11) NOT NULL,
  `id_beca` int(11) NOT NULL,
  `id_solicitante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrevista`
--

CREATE TABLE `entrevista` (
  `id` int(8) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` int(11) NOT NULL,
  `hora` int(11) NOT NULL,
  `lugar` varchar(70) NOT NULL,
  `formato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(8) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `estado`) VALUES
(1, 'Zulia'),
(2, 'Merida'),
(3, 'Lara'),
(4, 'Carabobo'),
(5, 'Barinas'),
(6, 'Apure'),
(7, 'Bolivar'),
(8, 'Cojedes'),
(9, 'Falcon'),
(10, 'Miranda'),
(11, 'Monagas'),
(12, 'Sucre'),
(13, 'Tachira'),
(14, 'Trujillo'),
(15, 'Vargas'),
(16, 'Yaracuy'),
(17, 'Amazonas'),
(18, 'Anzoategui'),
(19, 'Aragua'),
(20, 'Delta amacuro'),
(21, 'Distrito capital'),
(22, 'Guarico'),
(23, 'Portuguesa'),
(24, 'Dependencias federal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id` int(8) NOT NULL,
  `grupo` varchar(100) NOT NULL,
  `dias` varchar(150) NOT NULL,
  `hora_entrada` int(11) NOT NULL,
  `hora_salida` int(11) NOT NULL,
  `cupos` int(5) NOT NULL,
  `formato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_solicitante`
--

CREATE TABLE `grupo_solicitante` (
  `id` int(8) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_solicitante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id` int(8) NOT NULL,
  `id_estado` int(8) NOT NULL,
  `municipio` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id`, `id_estado`, `municipio`) VALUES
(1, 1, 'Maracaibo'),
(2, 1, 'Simon bolivar'),
(3, 1, 'San francisco'),
(4, 21, 'Libertador'),
(5, 17, 'Alto orinoco'),
(6, 17, 'Atabapo'),
(7, 17, 'Atures'),
(8, 1, 'Almirante padilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquia`
--

CREATE TABLE `parroquia` (
  `id` int(8) NOT NULL,
  `id_municipio` int(8) NOT NULL,
  `parroquia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parroquia`
--

INSERT INTO `parroquia` (`id`, `id_municipio`, `parroquia`) VALUES
(1, 1, 'Cecilio acosta'),
(2, 1, 'Chiquinquira'),
(3, 1, 'Coquivacoa'),
(4, 1, 'Cacique mara'),
(5, 1, 'Bolivar'),
(6, 1, 'San isidro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(8) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `cedula` int(9) NOT NULL,
  `correo` varchar(70) NOT NULL,
  `genero` enum('masculino','femenino') NOT NULL,
  `direccion` text,
  `telefono1` varchar(15) DEFAULT NULL,
  `telefono2` varchar(15) DEFAULT NULL,
  `fecha_nacimiento` int(11) DEFAULT NULL,
  `fecha_ingreso` int(11) NOT NULL,
  `perfil` varchar(100) NOT NULL DEFAULT './public/dev/images/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombre`, `apellido`, `cedula`, `correo`, `genero`, `direccion`, `telefono1`, `telefono2`, `fecha_nacimiento`, `fecha_ingreso`, `perfil`) VALUES
(1, 'Admin', 'Admin', 25444777, 'admin@demo.com', 'masculino', NULL, NULL, NULL, NULL, 1494126066, './public/dev/images/default.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitante`
--

CREATE TABLE `solicitante` (
  `id` int(8) NOT NULL,
  `id_estado` int(8) NOT NULL,
  `id_municipio` int(8) NOT NULL,
  `id_parroquia` int(8) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '0',
  `nacionalidad` enum('V','E') NOT NULL,
  `curriculo` varchar(70) NOT NULL,
  `id_personal` int(11) NOT NULL,
  `redes_sociales` text NOT NULL,
  `tiempo_solicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitante_entrevista`
--

CREATE TABLE `solicitante_entrevista` (
  `id` int(8) NOT NULL,
  `id_solicitante` int(11) NOT NULL,
  `id_entrevista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(8) NOT NULL,
  `rango` tinyint(1) NOT NULL DEFAULT '0',
  `id_personal` int(8) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(70) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `keyreg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rango`, `id_personal`, `usuario`, `clave`, `activo`, `keyreg`) VALUES
(1, 2, 1, 'admin@demo.com', '$2y$10$ER8z8ywDoSAY/bdlcOMy7ecYMSFlEgrOmddpJjfuQWqBdHLK9EUmm', 1, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beca`
--
ALTER TABLE `beca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `beca_solicitante`
--
ALTER TABLE `beca_solicitante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_beca` (`id_beca`),
  ADD KEY `id_solicitante` (`id_solicitante`);

--
-- Indices de la tabla `entrevista`
--
ALTER TABLE `entrevista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo_solicitante`
--
ALTER TABLE `grupo_solicitante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_municipio` (`id_municipio`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `solicitante`
--
ALTER TABLE `solicitante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_municipio` (`id_municipio`),
  ADD KEY `id_parroquia` (`id_parroquia`),
  ADD KEY `id_personal` (`id_personal`);

--
-- Indices de la tabla `solicitante_entrevista`
--
ALTER TABLE `solicitante_entrevista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_personal` (`id_personal`),
  ADD KEY `id_dominio` (`rango`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `beca`
--
ALTER TABLE `beca`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `beca_solicitante`
--
ALTER TABLE `beca_solicitante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `entrevista`
--
ALTER TABLE `entrevista`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupo_solicitante`
--
ALTER TABLE `grupo_solicitante`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `solicitante`
--
ALTER TABLE `solicitante`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `solicitante_entrevista`
--
ALTER TABLE `solicitante_entrevista`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD CONSTRAINT `parroquia_ibfk_1` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitante`
--
ALTER TABLE `solicitante`
  ADD CONSTRAINT `solicitante_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitante_ibfk_2` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitante_ibfk_3` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitante_ibfk_4` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquia` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitante_ibfk_6` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
