-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2026 a las 14:25:49
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_estudio_gym_dance`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_admin`, `usuario`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `numero_documento` int(11) DEFAULT NULL,
  `telefono` int(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `nombre`, `apellido`, `numero_documento`, `telefono`, `email`, `fecha_nacimiento`, `id_tipo_documento`, `password`) VALUES
(3, 'Damaris ', 'Olexen', 47337561, 1123944570, 'olexendama@gmail', '2006-04-06', 2, 'dama123'),
(8, 'pepe', 'olexen', 0, 1123944570, 'hola123@yahoo.com', '2001-04-03', NULL, 'd123'),
(14, 'micaela', 'sanchez', 47083524, 1123944570, 'hola@gmail.com', '1995-07-26', 1, 'hola456'),
(15, 'andre', 'fuentes', 44685707, 1138429928, '', '2003-01-10', NULL, 'andre123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id_asistencia` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `presente` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id_asistencia`, `id_alumno`, `fecha`, `presente`) VALUES
(1, 15, '2026-06-12', 1),
(2, 15, '2026-06-12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `estado` varchar(20) DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `id_alumno`, `fecha`, `estado`) VALUES
(1, 15, '2026-06-18 14:37:29', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_detalle`
--

CREATE TABLE `carrito_detalle` (
  `id_detalle` int(11) NOT NULL,
  `id_carrito` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_talle` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito_detalle`
--

INSERT INTO `carrito_detalle` (`id_detalle`, `id_carrito`, `id_producto`, `id_talle`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 1, 3, 1, 10.00),
(2, 1, 1, 2, 1, 10.00),
(3, 1, 2, 5, 1, 20.00),
(4, 1, 3, 2, 1, 15.00),
(5, 1, 1, 2, 1, 10.00),
(6, 1, 4, 5, 1, 25.00),
(7, 1, 1, 4, 1, 10.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_disciplinas`
--

CREATE TABLE `categorias_disciplinas` (
  `idcategorias_disciplinas` int(11) NOT NULL,
  `nombrecategoria` varchar(100) NOT NULL,
  `imagen_url` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_disciplinas`
--

INSERT INTO `categorias_disciplinas` (`idcategorias_disciplinas`, `nombrecategoria`, `imagen_url`, `descripcion`) VALUES
(1, 'Tap', 'https://i.ibb.co/Pv6HCfG2/IMG-5257.jpg', 'Ritmo dinamico que combina coordinacion, musicalidad y percusion coporal mediante el uso de zapatos especiales.'),
(2, 'Ritmos Latinos', 'https://i.ibb.co/zHDdgs1M/IMG-5255.jpg', 'Clases llenas de energia donde se trabajan estilos como salsa, bachate y merengue para todos los niveles.'),
(3, 'Danza Clasica', 'https://i.ibb.co/5hmRWJnY/IMG-5250.jpg', 'Disciplina que desarrolla tecnica, postura, equilibrio y expresion artistica a traves del ballet.'),
(4, 'Reggaeton', 'https://i.ibb.co/GQc6ZZVL/IMG-5254.jpg', 'Clases intensas y divertidas enfocadas en la coordinacion, el ritmo y la expresion urbana.'),
(5, 'Femme y Heels', 'https://i.ibb.co/JjswpgDv/IMG-5253.jpg', 'Disciplina que desarrolla seguridad, elegancia y tecnica de baile utilizando zapatos de taco.'),
(6, 'Contemporaneo', 'https://i.ibb.co/vSjtpCp/IMG-5251.jpg', 'Estilo que permite explorar la creatividad y la expresion emocional mediante movimientos fluidos y libres.'),
(7, 'Arabe', 'https://i.ibb.co/8L5MsFx6/IMG-5256.jpg', 'Estilo que combina movimientos elegantes, coordinacion y expresion corporal inspirada en la danza oriental.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id_clase` int(11) NOT NULL,
  `id_profesor` int(11) DEFAULT NULL,
  `id_disciplina` int(11) DEFAULT NULL,
  `horario` time DEFAULT NULL,
  `cupo_maximo` int(11) DEFAULT NULL,
  `id_dia` int(11) DEFAULT NULL,
  `id_nivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id_clase`, `id_profesor`, `id_disciplina`, `horario`, `cupo_maximo`, `id_dia`, `id_nivel`) VALUES
(1, 1, 5, '16:00:00', 22, 1, 1),
(2, 1, 5, '16:00:00', 24, 3, 1),
(3, 4, 7, '16:00:00', 25, 6, 1),
(4, 1, 6, '17:00:00', 24, 1, 1),
(5, 3, 1, '17:00:00', 24, 5, 1),
(6, 1, 6, '17:00:00', 24, 3, 1),
(7, 3, 2, '17:00:00', 25, 5, 1),
(8, 2, 3, '18:00:00', 24, 1, 2),
(9, 1, 5, '18:00:00', 25, 2, 2),
(10, 2, 3, '18:00:00', 24, 3, 2),
(11, 1, 6, '18:00:00', 25, 4, 2),
(12, 1, 5, '18:00:00', 24, 5, 2),
(13, 4, 8, '19:00:00', 25, 2, 2),
(14, 4, 7, '19:00:00', 24, 3, 3),
(15, 2, 3, '19:00:00', 25, 4, 2),
(16, 3, 1, '20:00:00', 25, 1, 3),
(17, 5, 9, '20:00:00', 24, 2, 3),
(18, 3, 1, '20:00:00', 24, 3, 3),
(19, 1, 5, '20:00:00', 25, 4, 3),
(20, 4, 8, '20:00:00', 25, 5, 3),
(21, 2, 3, '21:00:00', 0, 1, 3),
(22, 3, 2, '21:00:00', 0, 2, 3),
(23, 4, 4, '21:00:00', 25, 3, 3),
(24, 3, 2, '21:00:00', 24, 4, 3),
(25, 4, 4, '21:00:00', 0, 5, 3),
(26, 4, 7, '17:00:00', 25, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_dia`
--

CREATE TABLE `clase_dia` (
  `id_clase_dia` int(11) NOT NULL,
  `id_clase` int(11) DEFAULT NULL,
  `id_dia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id_detalle` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias_semanas`
--

CREATE TABLE `dias_semanas` (
  `id_dia` int(11) NOT NULL,
  `nombre_dia` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dias_semanas`
--

INSERT INTO `dias_semanas` (`id_dia`, `nombre_dia`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sabado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id_disciplina` int(11) NOT NULL,
  `nombre_disciplina` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `disciplinas`
--

INSERT INTO `disciplinas` (`id_disciplina`, `nombre_disciplina`) VALUES
(1, 'Ritmos Latinos '),
(2, 'Reggaeton'),
(3, 'Urbano'),
(4, 'Heels'),
(5, 'Danza Clasica'),
(6, 'Tap'),
(7, 'Arabe'),
(8, 'Femme'),
(9, 'Contemporaneo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id_inscripcion` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_pack` int(11) DEFAULT NULL,
  `fecha_inscripcion` date DEFAULT NULL,
  `id_clase` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id_inscripcion`, `id_alumno`, `id_pack`, `fecha_inscripcion`, `id_clase`, `estado`) VALUES
(3, 3, 1, '2026-06-09', 1, 'Activa'),
(8, 15, NULL, NULL, 1, 'Activa'),
(9, 15, NULL, NULL, 26, 'Activa'),
(10, 15, NULL, '2026-06-11', 4, 'Activa'),
(11, 15, NULL, '2026-06-11', 2, 'Activa'),
(12, 15, NULL, '2026-06-11', 6, 'Activa'),
(13, 15, NULL, '2026-06-11', 5, 'Activa'),
(14, 15, NULL, '2026-06-11', 25, 'Activa'),
(15, 15, NULL, '2026-06-11', 24, 'Activa'),
(16, 15, NULL, '2026-06-11', 8, 'Activa'),
(17, 15, NULL, '2026-06-11', 12, 'Activa'),
(18, 15, NULL, '2026-06-11', 17, 'Activa'),
(19, 15, NULL, '2026-06-11', 18, 'Activa'),
(20, 15, NULL, '2026-06-11', 10, 'Activa'),
(21, 15, NULL, '2026-06-11', 14, 'Activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `id_material` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `archivo` varchar(255) NOT NULL,
  `fecha_subida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id_material`, `id_clase`, `titulo`, `descripcion`, `archivo`, `fecha_subida`) VALUES
(1, 1, 'material', 'hola ', 'materiales/descarga.jpg', '2026-06-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `id_nivel` int(11) NOT NULL,
  `nombre_nivel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id_nivel`, `nombre_nivel`) VALUES
(1, 'Kids'),
(2, 'Juveniles'),
(3, 'Adultos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `packs`
--

CREATE TABLE `packs` (
  `id_pack` int(11) NOT NULL,
  `nombre_pack` varchar(50) DEFAULT NULL,
  `cantidad_clases` int(11) DEFAULT NULL,
  `precio_actual` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `packs`
--

INSERT INTO `packs` (`id_pack`, `nombre_pack`, `cantidad_clases`, `precio_actual`) VALUES
(1, 'Clase Individual', 1, 5000.00),
(2, 'Pack Essential', 4, 18000.00),
(3, 'Pack Energy', 8, 38000.00),
(4, 'Pack Premium', 12, 58000.00),
(5, 'prueba', 9, 670.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_inscripcion` int(11) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `monto_pagado` decimal(10,2) DEFAULT NULL,
  `metodo_pago` varchar(30) DEFAULT NULL,
  `id_pack` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios_productos`
--

CREATE TABLE `precios_productos` (
  `id_precio` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `fecha_desde` date DEFAULT NULL,
  `fecha_hasta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion`, `stock`, `imagen`, `precio`) VALUES
(1, 'Malla de Danza Clasica', 'Malla elastica profesional para clases y presentaciones de danza clasica', 14, 'https://i.ibb.co/Kchc0tQZ/IMG-5279.png', '10.000'),
(2, 'Zapatillas de Ballet', 'Zapatillas de tela reforzada para entrenamiento y practica diaria', 10, 'https://i.ibb.co/gL0y3wdf/IMG-5280.png', '20.000'),
(3, 'Pollera de Ballet', 'Pollera liviana de gasa para complementar la indumentaria de las alumnas', 8, 'https://i.ibb.co/4RVbsXQZ/IMG-5281.png', '15.000'),
(4, 'Mochilla para Danza ', 'Mochila espaciosa para transportar ropa, calzado y accesorio de danza', 12, 'https://i.ibb.co/9kybkccn/IMG-5282.png', '25.000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_talles`
--

CREATE TABLE `producto_talles` (
  `id_producto_talle` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_talle` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_talles`
--

INSERT INTO `producto_talles` (`id_producto_talle`, `id_producto`, `id_talle`, `stock`) VALUES
(1, 1, 2, 5),
(2, 1, 3, 5),
(3, 1, 4, 5),
(4, 2, 5, 10),
(5, 3, 2, 3),
(6, 3, 3, 3),
(7, 3, 4, 2),
(8, 4, 5, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id_profesor` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `telefono` int(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id_profesor`, `nombre`, `apellido`, `telefono`, `email`, `password`) VALUES
(1, 'Valentina ', 'Torres', NULL, 'valentina@gmail.com', '1234'),
(2, 'Lucas', 'Fernandez', NULL, NULL, NULL),
(3, 'Sofia', 'Martinez', NULL, NULL, NULL),
(4, 'Camila', 'Rodriguez', NULL, NULL, NULL),
(5, 'Mateo', 'Gonzalez', NULL, NULL, NULL),
(6, 'Julieta', 'Herrera', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_disciplina`
--

CREATE TABLE `profesor_disciplina` (
  `id_profesor_disciplina` int(11) NOT NULL,
  `id_profesor` int(11) DEFAULT NULL,
  `id_disciplina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesor_disciplina`
--

INSERT INTO `profesor_disciplina` (`id_profesor_disciplina`, `id_profesor`, `id_disciplina`) VALUES
(1, 1, 5),
(2, 1, 6),
(3, 2, 3),
(4, 2, 4),
(5, 3, 1),
(6, 3, 2),
(7, 4, 7),
(8, 4, 8),
(9, 5, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talles`
--

CREATE TABLE `talles` (
  `id_talle` int(11) NOT NULL,
  `nombre_talle` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `talles`
--

INSERT INTO `talles` (`id_talle`, `nombre_talle`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'Unico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documento`
--

CREATE TABLE `tipos_documento` (
  `id_tipo_doc` int(11) NOT NULL,
  `nombre_tipo` varchar(20) NOT NULL,
  `abreviatura` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_documento`
--

INSERT INTO `tipos_documento` (`id_tipo_doc`, `nombre_tipo`, `abreviatura`) VALUES
(1, 'DNI', ''),
(2, 'Pasaporte', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `fecha_venta` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`),
  ADD UNIQUE KEY `numero_documento` (`numero_documento`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_tipo_documento` (`id_tipo_documento`);

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id_asistencia`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `carrito_detalle`
--
ALTER TABLE `carrito_detalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_carrito` (`id_carrito`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_talle` (`id_talle`);

--
-- Indices de la tabla `categorias_disciplinas`
--
ALTER TABLE `categorias_disciplinas`
  ADD PRIMARY KEY (`idcategorias_disciplinas`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id_clase`),
  ADD KEY `id_profesor` (`id_profesor`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `fk_clases_nivel` (`id_nivel`);

--
-- Indices de la tabla `clase_dia`
--
ALTER TABLE `clase_dia`
  ADD PRIMARY KEY (`id_clase_dia`),
  ADD KEY `id_clase` (`id_clase`),
  ADD KEY `id_dia` (`id_dia`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `dias_semanas`
--
ALTER TABLE `dias_semanas`
  ADD PRIMARY KEY (`id_dia`);

--
-- Indices de la tabla `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`id_disciplina`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id_inscripcion`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_pack` (`id_pack`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `id_clase` (`id_clase`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Indices de la tabla `packs`
--
ALTER TABLE `packs`
  ADD PRIMARY KEY (`id_pack`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_inscripcion` (`id_inscripcion`);

--
-- Indices de la tabla `precios_productos`
--
ALTER TABLE `precios_productos`
  ADD PRIMARY KEY (`id_precio`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `producto_talles`
--
ALTER TABLE `producto_talles`
  ADD PRIMARY KEY (`id_producto_talle`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_talle` (`id_talle`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id_profesor`);

--
-- Indices de la tabla `profesor_disciplina`
--
ALTER TABLE `profesor_disciplina`
  ADD PRIMARY KEY (`id_profesor_disciplina`),
  ADD KEY `id_profesor` (`id_profesor`),
  ADD KEY `id_disciplina` (`id_disciplina`);

--
-- Indices de la tabla `talles`
--
ALTER TABLE `talles`
  ADD PRIMARY KEY (`id_talle`);

--
-- Indices de la tabla `tipos_documento`
--
ALTER TABLE `tipos_documento`
  ADD PRIMARY KEY (`id_tipo_doc`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_alumno` (`id_alumno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `carrito_detalle`
--
ALTER TABLE `carrito_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categorias_disciplinas`
--
ALTER TABLE `categorias_disciplinas`
  MODIFY `idcategorias_disciplinas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id_clase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `clase_dia`
--
ALTER TABLE `clase_dia`
  MODIFY `id_clase_dia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dias_semanas`
--
ALTER TABLE `dias_semanas`
  MODIFY `id_dia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `id_disciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `packs`
--
ALTER TABLE `packs`
  MODIFY `id_pack` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `precios_productos`
--
ALTER TABLE `precios_productos`
  MODIFY `id_precio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto_talles`
--
ALTER TABLE `producto_talles`
  MODIFY `id_producto_talle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id_profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `profesor_disciplina`
--
ALTER TABLE `profesor_disciplina`
  MODIFY `id_profesor_disciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `talles`
--
ALTER TABLE `talles`
  MODIFY `id_talle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipos_documento`
--
ALTER TABLE `tipos_documento`
  MODIFY `id_tipo_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipos_documento` (`id_tipo_doc`);

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`);

--
-- Filtros para la tabla `carrito_detalle`
--
ALTER TABLE `carrito_detalle`
  ADD CONSTRAINT `carrito_detalle_ibfk_1` FOREIGN KEY (`id_carrito`) REFERENCES `carrito` (`id_carrito`),
  ADD CONSTRAINT `carrito_detalle_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `carrito_detalle_ibfk_3` FOREIGN KEY (`id_talle`) REFERENCES `talles` (`id_talle`);

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id_profesor`),
  ADD CONSTRAINT `clases_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplinas` (`id_disciplina`),
  ADD CONSTRAINT `fk_clases_nivel` FOREIGN KEY (`id_nivel`) REFERENCES `niveles` (`id_nivel`);

--
-- Filtros para la tabla `clase_dia`
--
ALTER TABLE `clase_dia`
  ADD CONSTRAINT `clase_dia_ibfk_1` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`),
  ADD CONSTRAINT `clase_dia_ibfk_2` FOREIGN KEY (`id_dia`) REFERENCES `dias_semanas` (`id_dia`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `detalle_ventas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`),
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`id_pack`) REFERENCES `packs` (`id_pack`);

--
-- Filtros para la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD CONSTRAINT `materiales_ibfk_1` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_inscripcion`) REFERENCES `inscripciones` (`id_inscripcion`);

--
-- Filtros para la tabla `precios_productos`
--
ALTER TABLE `precios_productos`
  ADD CONSTRAINT `precios_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `producto_talles`
--
ALTER TABLE `producto_talles`
  ADD CONSTRAINT `producto_talles_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `producto_talles_ibfk_2` FOREIGN KEY (`id_talle`) REFERENCES `talles` (`id_talle`);

--
-- Filtros para la tabla `profesor_disciplina`
--
ALTER TABLE `profesor_disciplina`
  ADD CONSTRAINT `profesor_disciplina_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id_profesor`),
  ADD CONSTRAINT `profesor_disciplina_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplinas` (`id_disciplina`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
