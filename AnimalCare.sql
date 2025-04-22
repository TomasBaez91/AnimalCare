-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-03-2025 a las 17:12:28
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `AnimalCare`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `idMascota` int(11) NOT NULL,
  `idVeterinario` int(11) NOT NULL,
  `fechaHora` datetime NOT NULL,
  `motivoConsulta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id`, `idMascota`, `idVeterinario`, `fechaHora`, `motivoConsulta`) VALUES
(9, 1, 6, '2025-03-06 21:37:00', ''),
(10, 1, 0, '2025-03-07 21:42:00', 'wdad'),
(11, 0, 2, '2025-03-20 23:47:00', ''),
(12, 1, 9, '2025-02-26 13:09:00', 'Chip'),
(18, 10004, 2, '2025-03-30 20:15:00', 'Dolor de estomago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id` int(11) NOT NULL,
  `nombreTutor` varchar(150) NOT NULL,
  `telefonoMovil` int(11) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `nif` varchar(150) DEFAULT NULL,
  `numeroChip` int(100) NOT NULL,
  `nombreMascota` varchar(150) NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `especie` varchar(30) NOT NULL,
  `raza` varchar(50) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `expedienteAnimal` text NOT NULL,
  `observaciones` text NOT NULL,
  `alergias` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id`, `nombreTutor`, `telefonoMovil`, `email`, `nif`, `numeroChip`, `nombreMascota`, `fechaNacimiento`, `especie`, `raza`, `sexo`, `expedienteAnimal`, `observaciones`, `alergias`) VALUES
(1, 'Javier Hernandez', 654654123, 'javier.hernandez@gmai.com', '44743094D', 992277733, 'Zelda', '2023-09-07', 'CANINO', 'Husky', 'HEMBRA', '- Sin historial', 'Ansiedad y estrés', 'Gluten'),
(10004, 'Tomas', 654543212, 'tomas.baez91@gmail.com', '44743932B', 232323232, 'Berlin', '2024-01-01', 'Canis lupus', 'Pincher', 'Macho', 'Vacuna contra la rabia (2024)\r\nVacuna contra parvovirus (2024)\r\nVacuna contra hepatitis canina (2024)', 'Peso Actual: 12 kg', '-No conocida'),
(10005, 'Jose Luis Armas', 654654456, 'jlarmas@gmail.com', '123456786', 0, 'Lucas', '2025-03-03', 'Ave', 'Loro', 'Hembra', '', '', ''),
(10006, 'Pedro Romero', 678678678, 'pedro.romero1222@example.com', '4474393233', 0, 'Negro', '2025-03-06', 'Canino', 'Doberman', 'Macho', 'Sin historial', 'Sin observaciones', 'Ninguna conocida'),
(10007, 'Angel Leon', 65242362, 'pedro.romero1222@example.com', '4474393233', 99923823, 'Charmander', '2025-03-12', 'Roedor', 'Hamster', 'MACHO', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajesemail`
--

CREATE TABLE `mensajesemail` (
  `id` int(10) UNSIGNED NOT NULL,
  `idUsuario` int(10) UNSIGNED NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `destinatarios` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`destinatarios`)),
  `destinatariosCC` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`destinatariosCC`)),
  `destinatariosCCO` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`destinatariosCCO`)),
  `cuerpoMensaje` text NOT NULL,
  `fechaHoraCreacion` datetime NOT NULL,
  `fechaHoraUltimoEnvio` datetime NOT NULL,
  `enviado` tinyint(1) NOT NULL,
  `error` tinyint(1) NOT NULL,
  `mensajeError` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajesemail`
--

INSERT INTO `mensajesemail` (`id`, `idUsuario`, `asunto`, `destinatarios`, `destinatariosCC`, `destinatariosCCO`, `cuerpoMensaje`, `fechaHoraCreacion`, `fechaHoraUltimoEnvio`, `enviado`, `error`, `mensajeError`) VALUES
(1, 1, 'Consulta confirmada', '[{\"nombre\":\"\",\"email\":\"\"}]', '[]', '[]', 'Consulta confirmada05/03/2025 20:18<br>Si no puede acudir, avise con antelación', '2025-03-17 18:16:32', '0000-00-00 00:00:00', 0, 1, 'Invalid address:  (to): '),
(2, 1, 'Consulta confirmada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada11/03/2025 21:23<br>Si no puede acudir, avise con antelación', '2025-03-17 18:20:54', '0000-00-00 00:00:00', 0, 1, 'SMTP Error: Could not authenticate.'),
(3, 1, 'Consulta confirmada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada08/03/2025 21:28<br>Si no puede acudir, avise con antelación', '2025-03-17 18:25:49', '0000-00-00 00:00:00', 0, 1, 'SMTP Error: Could not authenticate.'),
(4, 1, 'Consulta confirmada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada11/03/2025 21:33<br>Si no puede acudir, avise con antelación', '2025-03-17 18:30:53', '2025-03-17 06:30:55', 0, 1, ''),
(5, 1, 'Consulta confirmada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada11/03/2025 21:33<br>Si no puede acudir, avise con antelación', '2025-03-17 18:30:55', '2025-03-17 06:30:58', 0, 1, ''),
(6, 1, 'Consulta confirmada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada06/03/2025 21:37<br>Si no puede acudir, avise con antelación', '2025-03-17 18:34:58', '2025-03-17 06:35:01', 1, 0, ''),
(7, 1, 'Consulta confirmada', '[{\"nombre\":\"Javier Hernandez\",\"email\":\"javier.hernandez@gmai.com\"}]', '[]', '[]', 'Consulta confirmada07/03/2025 21:42<br>Si no puede acudir, avise con antelación', '2025-03-17 18:39:53', '2025-03-17 06:39:55', 1, 0, ''),
(8, 1, 'Consulta confirmada', '[{\"nombre\":\"\",\"email\":\"\"}]', '[]', '[]', 'Consulta confirmada20/03/2025 23:47<br>Si no puede acudir, avise con antelación', '2025-03-20 20:44:04', '2025-03-20 08:44:04', 0, 1, 'Invalid address:  (to): '),
(9, 1, 'Consulta confirmada', '[{\"nombre\":\"Andrew\",\"email\":\"Andres.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada11/03/2025 20:13<br>Si no puede acudir, avise con antelación', '2025-03-23 10:43:42', '2025-03-23 10:43:43', 0, 1, 'SMTP Error: Could not authenticate.'),
(10, 1, 'Consulta confirmada', '[{\"nombre\":\"Javier Hernandez\",\"email\":\"javier.hernandez@gmai.com\"}]', '[]', '[]', 'Consulta confirmada26/02/2025 13:09<br>Si no puede acudir, avise con antelación', '2025-03-23 11:07:43', '2025-03-23 11:07:44', 0, 1, 'SMTP Error: Could not authenticate.'),
(11, 1, 'Consulta Cancelada', '[{\"nombre\":\"Javier Hernandez\",\"email\":\"javier.hernandez@gmai.com\"}]', '[]', '[]', 'Consulta Cancelada24/03/2025 22:54<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 11:10:59', '2025-03-23 11:11:00', 0, 1, 'SMTP Error: Could not authenticate.'),
(12, 1, 'Consulta Cancelada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta Cancelada11/03/2025 20:13<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 11:15:23', '2025-03-23 11:15:24', 0, 1, 'SMTP Error: Could not authenticate.'),
(13, 1, 'Consulta Cancelada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta Cancelada12/03/2025 18:13<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 11:15:26', '2025-03-23 11:15:27', 0, 1, 'SMTP Error: Could not authenticate.'),
(14, 1, 'Consulta Cancelada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta Cancelada05/03/2025 20:18<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 11:15:28', '2025-03-23 11:15:29', 0, 1, 'SMTP Error: Could not authenticate.'),
(15, 1, 'Consulta Cancelada', '[{\"nombre\":\"\",\"email\":\"\"}]', '[]', '[]', 'Consulta Cancelada01/01/1970 00:00<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 11:15:30', '2025-03-23 11:15:30', 0, 1, 'Invalid address:  (to): '),
(16, 1, 'Consulta Cancelada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta Cancelada11/03/2025 21:23<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 11:15:48', '2025-03-23 11:15:49', 0, 1, 'SMTP Error: Could not authenticate.'),
(17, 1, 'Consulta Cancelada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta Cancelada08/03/2025 21:28<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 11:15:51', '2025-03-23 11:15:52', 0, 1, 'SMTP Error: Could not authenticate.'),
(18, 1, 'Consulta Cancelada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta Cancelada11/03/2025 21:33<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 11:15:55', '2025-03-23 11:15:55', 0, 1, 'SMTP Error: Could not authenticate.'),
(19, 1, 'Consulta Cancelada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta Cancelada11/03/2025 21:33<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 11:15:57', '2025-03-23 11:15:58', 0, 1, 'SMTP Error: Could not authenticate.'),
(20, 1, 'Consulta confirmada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada13/03/2025 14:20<br>Si no puede acudir, avise con antelación', '2025-03-23 11:16:11', '2025-03-23 11:16:12', 0, 1, 'SMTP Error: Could not authenticate.'),
(21, 1, 'Consulta confirmada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada16/01/2025 11:20<br>Si no puede acudir, avise con antelación', '2025-03-23 11:17:45', '2025-03-23 11:17:46', 0, 1, 'SMTP Error: Could not authenticate.'),
(22, 1, 'Consulta Cancelada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta Cancelada13/03/2025 14:20<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 11:22:30', '2025-03-23 11:22:31', 0, 1, 'SMTP Error: Could not authenticate.'),
(23, 1, 'Consulta confirmada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada18/03/2025 14:25<br>Si no puede acudir, avise con antelación', '2025-03-23 11:22:41', '2025-03-23 11:22:42', 0, 1, 'SMTP Error: Could not authenticate.'),
(24, 1, 'Consulta confirmada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada03/03/2025 15:27<br>Si no puede acudir, avise con antelación', '2025-03-23 11:25:13', '2025-03-23 11:25:14', 0, 1, 'SMTP Error: Could not authenticate.'),
(25, 1, 'Consulta confirmada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada26/02/2025 13:30<br>Si no puede acudir, avise con antelación', '2025-03-23 11:27:47', '2025-03-23 11:27:49', 1, 0, ''),
(26, 1, 'Consulta Cancelada', '[{\"nombre\":\"Andrew\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta Cancelada16/01/2025 11:20<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 11:28:00', '2025-03-23 11:28:02', 1, 0, ''),
(27, 1, 'Consulta Cancelada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta Cancelada18/03/2025 14:25<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 18:46:01', '2025-03-23 06:46:04', 1, 0, ''),
(28, 1, 'Consulta Cancelada', '[{\"nombre\":\"\",\"email\":\"\"}]', '[]', '[]', 'Consulta Cancelada01/01/1970 00:00<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 18:46:04', '2025-03-23 06:46:04', 0, 1, 'Invalid address:  (to): '),
(29, 1, 'Consulta Cancelada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta Cancelada03/03/2025 15:27<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 18:46:06', '2025-03-23 06:46:08', 1, 0, ''),
(30, 1, 'Consulta confirmada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada26/02/2025 13:30<br>Si no puede acudir, avise con antelación', '2025-03-23 18:46:56', '2025-03-23 06:46:58', 1, 0, ''),
(31, 1, 'Consulta Cancelada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta Cancelada26/02/2025 13:30<br>Su consulta ha sido cancelada,cualquier duda contacte con nosotros', '2025-03-23 19:13:26', '2025-03-23 07:13:29', 1, 0, ''),
(32, 1, 'Consulta confirmada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada30/03/2025 20:15<br>Si no puede acudir, avise con antelación', '2025-03-23 19:13:43', '2025-03-23 07:13:45', 1, 0, ''),
(33, 1, 'Consulta confirmada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Consulta confirmada30/03/2025 20:15<br>Si no puede acudir, avise con antelación', '2025-03-23 19:14:00', '2025-03-23 07:14:03', 1, 0, ''),
(34, 1, 'Consulta confirmada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Su consulta veterinaria confirmada.Tiene cita el  30/03/2025 20:15<br>Si no puede acudir, avise con antelación', '2025-03-23 19:17:52', '2025-03-23 07:17:54', 1, 0, ''),
(35, 1, 'Consulta confirmada', '[{\"nombre\":\"Tomas\",\"email\":\"tomas.baez91@gmail.com\"}]', '[]', '[]', 'Su consulta veterinaria  ha sido confirmada.Tiene cita el  30/03/2025 20:15<br>Si no puede acudir, avise con antelación, gracias', '2025-03-23 19:21:10', '2025-03-23 07:21:12', 1, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `ipUltimoAcceso` varchar(20) NOT NULL,
  `fechaHoraUltimoAcceso` datetime DEFAULT NULL,
  `intentosFallidos` smallint(6) NOT NULL,
  `bloqueado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `ipUltimoAcceso`, `fechaHoraUltimoAcceso`, `intentosFallidos`, `bloqueado`) VALUES
(1, 'Juan Diego', 'Martin', 'Juandiego@gmail.com', '$2y$12$HwTSX5gv1VLoKc/2wmPkfePZF7SebGk2gC1cTaoX..JOvRbF82kDi', 'ADMINISTRADOR', '::1', '2025-03-24 15:54:28', 0, 0),
(2, 'Antonio', 'Perrera', 'antoniop@gmail.com', '12345', 'VETERINARIO', '', '2025-03-15 19:24:17', 0, 0),
(3, 'Liliana', 'Dominguez', 'lili.dom@gmail.com', '12345', 'ADMINISTRATIVO', '', '2025-03-15 19:26:25', 0, 0),
(5, 'Mariana', 'Suarez', 'm.suarez@gmai.com', '12345', 'AUXILIAR', '', '2025-03-15 19:47:11', 0, 0),
(6, 'Pedro', 'Pajares', 'ppajares@gmail.com', '$2y$12$TG.Itag/Ox/mWrXGNraIqe/BNV7OftfTSZcTpptj.b/UL18907Dj2', 'VETERINARIO', '', NULL, 0, 0),
(7, 'Luis', 'Doreste', 'LuisDoreste@gmai.com', '$2y$12$vJmPlw11kSI8yEx2itU.jeEfNw5Y0FKXg0L6CgbDu2wTWlqGI/X12', 'ADMINISTRATIVO', '', NULL, 0, 1),
(8, 'Bartolome', 'De la fuentes', 'Bdelafuente@gmail.com', '$2y$12$jlhcqxDPqZN3pPlRs4uEyuCGLye/rydz1hAvtkJ41EIWEtXDNAKC.', 'AUXILIAR', '', NULL, 0, 0),
(9, 'Juan Antonio', 'Diego', 'juandiego2@gmail.com', '$2y$12$UBiZVkPfMldvjSZV2.Qqsei4xW7kfPqoa2pJE2w4G92fRHbGjx8sa', 'VETERINARIO', '::1', '2025-03-20 22:54:39', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nif` (`nif`,`email`) USING BTREE;

--
-- Indices de la tabla `mensajesemail`
--
ALTER TABLE `mensajesemail`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10008;

--
-- AUTO_INCREMENT de la tabla `mensajesemail`
--
ALTER TABLE `mensajesemail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
