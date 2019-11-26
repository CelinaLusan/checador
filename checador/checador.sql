-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-11-2019 a las 22:11:16
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `checador`
--
CREATE DATABASE IF NOT EXISTS `checador` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `checador`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `idCliente` int(3) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `calle` varchar(40) NOT NULL,
  `notas` varchar(1000) NOT NULL,
  `colonia` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombre`, `apellido`, `calle`, `notas`, `colonia`) VALUES
(1, 'María', 'Pérez', 'Oaxaca de juárez', 'Ejemplo de notas adicionales', ''),
(2, 'José', 'Cruz', 'Ocotlán de morelos', 'Notas adicionales', ''),
(3, 'Beatriz', 'lópez', 'gardenias', 'Ejemplo de notas', 'reforma'),
(4, 'Ara', 'martínez', 'reforma', 'nota adicional cliente ara', 'reforma');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motos`
--

DROP TABLE IF EXISTS `motos`;
CREATE TABLE `motos` (
  `idMoto` int(11) NOT NULL,
  `marca` varchar(40) NOT NULL,
  `placas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `motos`
--

INSERT INTO `motos` (`idMoto`, `marca`, `placas`) VALUES
(1, 'Suzuki', 'GCU-R490'),
(2, 'Italika', 'RFC-6Y'),
(5, 'MARCA', 'PORTE-41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

DROP TABLE IF EXISTS `registros`;
CREATE TABLE `registros` (
  `idRegistro` int(11) NOT NULL,
  `horaSalida` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `horaLlegada` datetime NOT NULL,
  `clienteDestino` int(3) NOT NULL,
  `monto` double NOT NULL,
  `chofer` int(2) NOT NULL,
  `observaciones` varchar(1000) NOT NULL,
  `estatus` int(1) NOT NULL COMMENT 'si es 0 esta taerminada si es 1 esta en proceso'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`idRegistro`, `horaSalida`, `horaLlegada`, `clienteDestino`, `monto`, `chofer`, `observaciones`, `estatus`) VALUES
(1, '2019-11-13 19:20:20', '0000-00-00 00:00:00', 2, 145000, 2, 'Notas adicionales ejemplo de la salida de un chofer', 1),
(2, '2019-11-13 19:34:46', '2019-11-19 16:56:01', 1, 130000, 4, '', 0),
(3, '2019-11-13 20:07:24', '2019-11-19 16:48:50', 1, 12000, 4, '', 0),
(4, '2019-11-15 22:36:23', '0000-00-00 00:00:00', 2, 154000, 4, 'Observación Notas del día de prueba', 1),
(5, '2019-11-15 22:36:57', '0000-00-00 00:00:00', 2, 12, 5, '', 1),
(6, '2019-11-19 16:55:43', '0000-00-00 00:00:00', 3, 1234, 4, 'Observaciones salidas', 1),
(7, '2019-11-25 20:31:15', '0000-00-00 00:00:00', 4, 123, 4, 'Observaciones ara', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `idRol` int(2) NOT NULL,
  `descripcion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `descripcion`) VALUES
(1, 'administrador'),
(2, 'chofer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idUsuario` int(2) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `nombreUsuario` varchar(40) NOT NULL,
  `password` longtext NOT NULL,
  `idRol` int(2) NOT NULL,
  `idMoto` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellido`, `nombreUsuario`, `password`, `idRol`, `idMoto`) VALUES
(1, 'administrador', 'jefe', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, -1),
(2, 'Toño', 'Pérez', 'Guizart', 'd8529176f1b147d8adec8d0085f8a139', 2, 0),
(4, 'Pedro', '', 'pedro', 'c6cc8094c2dc07b700ffcc36d64e2138', 2, 1),
(5, 'maria', 'maria', 'maria', '263bce650e68ab4e23f28263760b9fa5', 2, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `motos`
--
ALTER TABLE `motos`
  ADD PRIMARY KEY (`idMoto`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`idRegistro`),
  ADD KEY `clienteDestino` (`clienteDestino`),
  ADD KEY `chofer` (`chofer`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`),
  ADD KEY `idMoto` (`idMoto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `motos`
--
ALTER TABLE `motos`
  MODIFY `idMoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `idRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
