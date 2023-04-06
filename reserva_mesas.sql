-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2022 a las 08:57:44
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reserva_mesas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `rut_administrador_pk` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `clave_administrador` varchar(15) NOT NULL,
  `correo_administrador` varchar(30) NOT NULL,
  `privilegio_administrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`rut_administrador_pk`, `nombre`, `apellido`, `clave_administrador`, `correo_administrador`, `privilegio_administrador`) VALUES
('21497621-1', 'kevin', 'arias', '21497621', 'asdasd@gmail.com', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `rut_cliente_pk` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `clave_cliente` varchar(15) NOT NULL,
  `correo_cliente` varchar(30) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `comuna` varchar(30) NOT NULL,
  `privilegio_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`rut_cliente_pk`, `nombre`, `apellido`, `clave_cliente`, `correo_cliente`, `telefono`, `direccion`, `comuna`, `privilegio_cliente`) VALUES
('12345678-9', 'cliente', 'prueba', '21497621', 'asdasd@gmail.com', 945994208, 'lia aguirre', 'La Florida', 0),
('21497621-8', 'Eduardo', 'Arias', '21497621', 'sdasd@gmail.com', 945994208, 'bio bio 1255', 'Renca', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_mesa`
--

CREATE TABLE `reserva_mesa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `posicion` varchar(50) NOT NULL,
  `rut_cliente` varchar(10) NOT NULL,
  `estatus` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `hora_reserva` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reserva_mesa`
--

INSERT INTO `reserva_mesa` (`id`, `nombre`, `cantidad`, `posicion`, `rut_cliente`, `estatus`, `fecha`, `hora_reserva`) VALUES
(1, '1', '6', '1', '12345678-9', '0', '2022-06-24', '00:00:00'),
(2, '2', '6', '2', '12345678-9', '1', '2022-06-21', '02:40:13'),
(3, '3', '1', '3', '2', '0', '2022-06-30', '00:00:00'),
(4, '4', '5', '4', '1', '1', '2022-06-16', '00:00:00'),
(5, '5', '1', '5', '25996851-8', '0', '2022-06-16', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `rut_Trabajador_PK` varchar(10) NOT NULL,
  `clave_trabajador` varchar(12) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `edad` int(11) NOT NULL,
  `correo_trabajador` varchar(30) NOT NULL,
  `telefono_trabajador` int(11) NOT NULL,
  `trabajador_privilegio` int(11) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `comuna` varchar(30) NOT NULL,
  `numero_casa` int(11) NOT NULL,
  `region` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`rut_Trabajador_PK`, `clave_trabajador`, `Nombre`, `apellido`, `edad`, `correo_trabajador`, `telefono_trabajador`, `trabajador_privilegio`, `direccion`, `comuna`, `numero_casa`, `region`) VALUES
('25996851-8', '21497621', 'kevin', 'arias', 25, 'asdasd@gmail.com', 945994208, 2, 'asdasd', 'Renca', 1522, 'Region Metropolitana');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`rut_administrador_pk`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`rut_cliente_pk`);

--
-- Indices de la tabla `reserva_mesa`
--
ALTER TABLE `reserva_mesa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`rut_Trabajador_PK`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reserva_mesa`
--
ALTER TABLE `reserva_mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
