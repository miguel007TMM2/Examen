-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2022 a las 17:46:29
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
-- Base de datos: `facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `cedula` varchar(500) NOT NULL,
  `direccion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `name`, `cedula`, `direccion`) VALUES
(2, 'Miguel Rafael Mateo', '40232198404', 'Cerros de gurabo Hurbanizacion casirda calle C.A'),
(3, 'zaida valdez', '40232198404', 'Cerros de gurabo Hurbanizacion casirda calle C.A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `total` int(11) NOT NULL,
  `productos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`productos`)),
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `fecha`, `total`, `productos`, `cliente_id`) VALUES
(137, '2022-07-19', 2246, '[{\"id\":49,\"0\":49,\"name\":\"Maletas\",\"1\":\"Maletas\",\"precio_unitario\":2000,\"2\":2000,\"descripcion\":\"Maleta blanca\",\"3\":\"Maleta blanca\"},{\"id\":50,\"0\":50,\"name\":\"Aprender\",\"1\":\"Aprender\",\"precio_unitario\":123,\"2\":123,\"descripcion\":\"APREND\",\"3\":\"APREND\"},{\"id\":51,\"0\":51,\"name\":\"Aprender\",\"1\":\"Aprender\",\"precio_unitario\":123,\"2\":123,\"descripcion\":\"APREND\",\"3\":\"APREND\"}]', 3),
(138, '2022-07-19', 2246, '[{\"id\":52,\"0\":52,\"name\":\"Aprender\",\"1\":\"Aprender\",\"precio_unitario\":123,\"2\":123,\"descripcion\":\"APREND\",\"3\":\"APREND\"},{\"id\":53,\"0\":53,\"name\":\"Maletas\",\"1\":\"Maletas\",\"precio_unitario\":2000,\"2\":2000,\"descripcion\":\"Maleta blanca\",\"3\":\"Maleta blanca\"},{\"id\":54,\"0\":54,\"name\":\"Aprender\",\"1\":\"Aprender\",\"precio_unitario\":123,\"2\":123,\"descripcion\":\"APREND\",\"3\":\"APREND\"}]', 2),
(139, '2022-07-19', 2246, '[{\"id\":55,\"0\":55,\"name\":\"Maletas\",\"1\":\"Maletas\",\"precio_unitario\":2000,\"2\":2000,\"descripcion\":\"Maleta blanca\",\"3\":\"Maleta blanca\"},{\"id\":56,\"0\":56,\"name\":\"Aprender\",\"1\":\"Aprender\",\"precio_unitario\":123,\"2\":123,\"descripcion\":\"APREND\",\"3\":\"APREND\"},{\"id\":57,\"0\":57,\"name\":\"Aprender\",\"1\":\"Aprender\",\"precio_unitario\":123,\"2\":123,\"descripcion\":\"APREND\",\"3\":\"APREND\"}]', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `name`, `precio_unitario`, `descripcion`) VALUES
(26, 'Maletas', 2000, 'Maleta blanca'),
(27, 'Aprender', 123, 'APREND');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productotemporal`
--

CREATE TABLE `productotemporal` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `lastName` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `lastName`, `email`, `password`) VALUES
(1, 'Jose', 'Mateo', 'miguelrafael@gmail.com', '12345'),
(2, 'Miguel', 'Mateo', 'climaxfran@gmail.com', '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_factura` (`cliente_id`),
  ADD KEY `id_factura_2` (`cliente_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productotemporal`
--
ALTER TABLE `productotemporal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `productotemporal`
--
ALTER TABLE `productotemporal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
