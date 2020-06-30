-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2019 a las 17:20:18
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `idEntrada` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidadEntrante` mediumint(9) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`idEntrada`, `idProducto`, `cantidadEntrante`, `precio`, `fecha`) VALUES
(12, 1, 100, '2.00', '2019-05-05 06:46:52'),
(13, 1, 50, '50.00', '2019-05-05 07:01:05'),
(14, 1, 200, '54.00', '2019-05-07 05:12:39'),
(15, 1, 200, '60.00', '2019-05-06 18:06:38'),
(16, 1, 100, '100.00', '2019-05-22 18:05:36'),
(17, 10, 100, '2.60', '2019-05-24 13:55:49'),
(18, 10, 100, '2.20', '2019-05-24 14:40:38');

--
-- Disparadores `entradas`
--
DELIMITER $$
CREATE TRIGGER `tgEntradas` AFTER INSERT ON `entradas` FOR EACH ROW update productos set cantidad = ((SELECT productos.cantidad  WHERE idProducto = new.idProducto) + new.cantidadEntrante), precio = ((SELECT productos.precio  WHERE idProducto = new.idProducto) + new.precio)/2 where idProducto = new.idProducto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) DEFAULT NULL,
  `nombre` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio` decimal(6,2) DEFAULT NULL,
  `cantidad` decimal(10,3) DEFAULT NULL,
  `medida` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `idProveedor`, `nombre`, `precio`, `cantidad`, `medida`) VALUES
(1, 1, 'caja vacia', '77.72', '344.968', ''),
(10, 4, 'gasolina regular', '2.39', '1053.307', 'galones'),
(11, 4, 'gasolina especial', '2.65', '2000.000', 'galones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `nombre`, `descripcion`) VALUES
(1, 'provedorcito', 'este proveedor es una prueba'),
(4, 'puma energy', 'proveedor desconocido'),
(5, 'Texaco', 'Proveedor de gasolina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `idSalida` int(11) NOT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `cantidad` decimal(10,3) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`idSalida`, `idProducto`, `cantidad`, `precio`, `fecha`) VALUES
(1, 1, '100.000', '20.00', '2019-05-06 04:55:16'),
(2, 1, '150.000', '55.44', '2019-05-06 18:21:36'),
(3, 1, '4.000', '55.44', '2019-05-06 18:25:33'),
(4, 10, '6.000', '2.81', '2019-05-21 06:50:10'),
(5, 10, '5.764', '2.81', '2019-05-21 06:53:16'),
(6, 10, '5.764', '2.81', '2019-05-21 06:55:29'),
(7, 1, '100.000', '77.72', '2019-05-22 18:06:13'),
(8, 10, '2.882', '2.81', '2019-05-24 13:12:26'),
(9, 10, '3.422', '2.84', '2019-05-24 14:25:18'),
(10, 1, '1.032', '85.49', '2019-05-24 14:26:45'),
(11, 10, '100.000', '2.39', '2019-05-24 14:42:35'),
(12, 10, '6.115', '2.63', '2019-05-24 14:45:07'),
(13, 10, '6.115', '2.63', '2019-11-13 02:11:56'),
(14, 10, '10.395', '2.63', '2019-11-13 02:28:43');

--
-- Disparadores `salidas`
--
DELIMITER $$
CREATE TRIGGER `tgSalidas` AFTER INSERT ON `salidas` FOR EACH ROW update productos set cantidad = ((SELECT productos.cantidad  WHERE idProducto = new.idProducto) - new.cantidad) where idProducto = new.idProducto
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`idEntrada`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `fk_prods_Prov` (`idProveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`idSalida`),
  ADD KEY `fk_sali_Prod` (`idProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `idSalida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_prods_Prov` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD CONSTRAINT `fk_sali_Prod` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
