-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2017 a las 02:46:09
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

--
-- Volcado de datos para la tabla `beca`
--

INSERT INTO `beca` (`id`, `beca`, `tipo`, `sede`, `descripcion`, `perfil`) VALUES
(1, 'Beca #1', 'Estudiantil', '5 de Julio', '<h3 style=\"text-align: center; \"><b>Lorem ipsum dolor sit amet, consectetur adipisicing elit</b></h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p><p>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p><p>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p><p>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p><p>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', './public/dev/images/becas/1/1.png'),
(2, 'Beca #3', 'Estudiantil', '5 de Julio ', '<h2 style=\"text-align: center; \">&nbsp; <b>&nbsp;&nbsp;<span style=\"font-size: 1rem;\">Lorem ipsum dolor sit amet</span></b></h2><h2 style=\"text-align: center; \"><b><span style=\"font-size: 1rem;\"><br></span></b></h2><ol><li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</li><li>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</li><li>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</li><li>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</li><li>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</li><li>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li></ol>', './public/dev/images/becas/2/2.jpg'),
(3, 'Beca #2', 'Estudiantil', '5 de julio', '<p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p><p>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p><p>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p><p>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p><p>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', './public/dev/images/becas/3/3.jpg'),
(4, 'Beca #4', 'Estudiante', '5 de julio', '<p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p><p>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p><p>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p><p>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p><p>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', './public/dev/images/becas/4/4.jpg'),
(5, 'Beca #5', 'estudiantil', '5 de julio', '<p>asdadsadsadsadadas</p>', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beca_solicitante`
--

CREATE TABLE `beca_solicitante` (
  `id` int(11) NOT NULL,
  `id_beca` int(11) NOT NULL,
  `id_solicitante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `beca_solicitante`
--

INSERT INTO `beca_solicitante` (`id`, `id_beca`, `id_solicitante`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 2),
(5, 1, 3),
(6, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condicion`
--

CREATE TABLE `condicion` (
  `id` tinyint(1) NOT NULL,
  `condicion` varchar(15) NOT NULL,
  `icon` int(11) NOT NULL,
  `color` varchar(10) NOT NULL,
  `por_defecto` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `condicion`
--

INSERT INTO `condicion` (`id`, `condicion`, `icon`, `color`, `por_defecto`) VALUES
(3, 'Verificando', 7, 'warning', 2),
(4, 'En espera', 5, 'info', 0),
(5, 'Aprobado', 10, 'success', 0),
(6, 'Desaprobado', 11, 'danger', 0),
(7, 'Creacion', 15, 'info', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrevista`
--

CREATE TABLE `entrevista` (
  `id_solicitante` int(8) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `lugar` varchar(70) NOT NULL
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
(16, 'Yaracuy');

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

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `grupo`, `dias`, `hora_entrada`, `hora_salida`, `cupos`, `formato`) VALUES
(1, 'Grupo #1', '[\"Lunes\",\"Miercoles\",\"Viernes\"]', 1491582600, 1491600600, 100, 1),
(2, 'Grupo #2', '[\"Martes\",\"Jueves\",\"Sabado\"]', 1491593400, 1491600600, 150, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_solicitante`
--

CREATE TABLE `grupo_solicitante` (
  `id` int(8) NOT NULL,
  `id_grupo` int(8) NOT NULL,
  `id_solicitante` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(3, 1, 'San francisco');

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
(1, 'Administrador', 'Aministrador', 55555555, 'admin@demo.com', 'masculino', NULL, NULL, NULL, NULL, 1492133446, './public/dev/images/solicitantes/1/1.jpg'),
(2, 'Administradordos', 'Administradordos', 77888999, 'admin2@demo.com', 'masculino', '', '', '', 1492056000, 1492134040, './public/dev/images/perfil/2/2.jpg'),
(3, 'Solicitantetre', 'Etnaticilostre', 25888991, 'solicitante33@demo.com', 'masculino', 'hola ke ase por la casa', '04265557788', '04245558877', 791956800, 1492269517, './public/dev/images/solicitantes/1/1.jpg'),
(4, 'Solicitantedos', 'Etnaticilosdos', 25666889, 'solicitante2@demo.com', 'masculino', 'En algún lugar de mi casa', '04245558899', '04265559988', 1492228800, 1492269577, './public/dev/images/solicitantes/2/2.jpg'),
(5, 'Solicitantetre', 'Etnaticilostre', 25888994, 'solicitante333@demo.com', 'masculino', 'sdasdsadsadadsafafadfsadsadsa', '04265557788', '04245558877', 799992000, 1492297988, './public/dev/images/default.png'),
(6, 'Solicitantecuatro', 'Etnaticiloscuatro', 25444666, 'solicitante4@demo.com', 'masculino', 'dmsadlsansckajoncfaosdsapd,sa´dpakfasmvajkfnauirwhreawerwaldfawñdá', '04247778899', '04267779988', 1492315200, 1492359564, './public/dev/images/default.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitante`
--

CREATE TABLE `solicitante` (
  `id` int(8) NOT NULL,
  `id_estado` int(8) NOT NULL,
  `id_municipio` int(8) NOT NULL,
  `id_parroquia` int(8) NOT NULL,
  `id_condicion` tinyint(1) NOT NULL,
  `nacionalidad` enum('V','E') NOT NULL,
  `curriculo` varchar(70) NOT NULL,
  `id_personal` int(11) NOT NULL,
  `redes_sociales` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `solicitante`
--

INSERT INTO `solicitante` (`id`, `id_estado`, `id_municipio`, `id_parroquia`, `id_condicion`, `nacionalidad`, `curriculo`, `id_personal`, `redes_sociales`) VALUES
(1, 1, 1, 1, 7, 'V', './public/dev/images/solicitantes/1/1_curriculo_.docx', 3, ''),
(2, 1, 1, 1, 7, 'E', './public/dev/images/solicitantes/2/2_curriculo_.docx', 4, ''),
(3, 1, 1, 1, 7, 'V', './public/dev/images/solicitantes/3/3_curriculo_.docx', 5, ''),
(4, 1, 1, 4, 7, 'E', '', 6, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(8) NOT NULL,
  `rango` tinyint(1) NOT NULL DEFAULT '0',
  `id_personal` int(8) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rango`, `id_personal`, `usuario`, `clave`) VALUES
(1, 2, 1, 'admin@demo.com', '$2y$10$fTaejjtlJjxs4qP3epwAr.xzbs1RX2vlvEBGU4Ld7tVIG7x2t.ZiG'),
(2, 2, 2, 'admin2@demo.com', '$2y$10$ilTGsiCjaziVDbZ1QJYDXOoLdf1WFRj0VcLEoM5EbOyooKvAHT5ee'),
(3, 0, 3, 'solicitante@demo.com', '$2y$10$VQOcQk0ymASDYGU6CMY.5.DYJs7SYlEV6SXdixE7YmqXFPQ26MGXa'),
(4, 0, 4, 'solicitante2@demo.com', '$2y$10$0WPa3lDRsSOrwld2p9HZLOvYI0Zx.iW0pQInvIFJ0eilCl4UEX.wG'),
(5, 0, 5, 'solicitante333@demo.com', '$2y$10$J77k9u9tSEcxOa41UOCiouvHE1qB4Uoj9X.Ysd7IkYXiLy.oHVvb6'),
(6, 0, 6, 'solicitante4@demo.com', '$2y$10$4pr8q2dbdtutKuDwXXGM/.I8x2fZUFhGxNp6fo6wUjYxVRQq33LaG');

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
-- Indices de la tabla `condicion`
--
ALTER TABLE `condicion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrevista`
--
ALTER TABLE `entrevista`
  ADD KEY `id_solicitante` (`id_solicitante`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_solicitante` (`id_solicitante`);

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
  ADD KEY `id_condicion` (`id_condicion`),
  ADD KEY `id_personal` (`id_personal`);

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
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `beca_solicitante`
--
ALTER TABLE `beca_solicitante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `condicion`
--
ALTER TABLE `condicion`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `grupo_solicitante`
--
ALTER TABLE `grupo_solicitante`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `solicitante`
--
ALTER TABLE `solicitante`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrevista`
--
ALTER TABLE `entrevista`
  ADD CONSTRAINT `entrevista_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitante` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `grupo_solicitante`
--
ALTER TABLE `grupo_solicitante`
  ADD CONSTRAINT `grupo_solicitante_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `solicitante_ibfk_5` FOREIGN KEY (`id_condicion`) REFERENCES `condicion` (`id`) ON DELETE CASCADE,
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
