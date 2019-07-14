-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: fdb26.awardspace.net
-- Tiempo de generación: 14-07-2019 a las 20:31:46
-- Versión del servidor: 5.7.20-log
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `3073018_lacomanda`
--
CREATE DATABASE IF NOT EXISTS `3073018_lacomanda` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `3073018_lacomanda`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `ID_empleado` int(11) NOT NULL,
  `ID_tipo_empleado` int(11) NOT NULL,
  `nombre_empleado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_ultimo_login` datetime DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad_operaciones` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`ID_empleado`, `ID_tipo_empleado`, `nombre_empleado`, `usuario`, `clave`, `fecha_registro`, `fecha_ultimo_login`, `estado`, `cantidad_operaciones`) VALUES
(4, 5, 'Maria Debian', 'socio1', 'socio1', '2019-06-22 15:48:25', '2019-07-14 12:54:21', 'A', 44),
(5, 5, 'Juan Perez', 'socio2', 'socio2', '2019-06-22 15:48:36', '2019-07-14 12:54:30', 'A', 8),
(6, 5, 'Martin Gonzales', 'socio3', 'socio3', '2019-06-22 15:49:10', NULL, 'A', 0),
(7, 4, 'Sansa Stark', 'mozo1', 'mozo1', '2019-06-22 15:49:46', '2019-07-14 17:13:58', 'A', 29),
(8, 4, 'Pepe', 'mozo2', 'mozo2', '2019-06-22 15:49:58', '2019-06-30 14:49:09', 'A', 2),
(9, 4, 'Juanita', 'mozo3', 'mozo3', '2019-06-22 15:50:13', NULL, 'A', 0),
(10, 1, 'Gauss', 'bartender1', 'bartender1', '2019-06-22 15:50:52', NULL, 'A', 0),
(11, 2, 'Strauss', 'cervecero1', 'cervecero1', '2019-06-22 15:51:25', NULL, 'S', 0),
(12, 3, 'ChefffPe', 'cocinero1', 'cocinero1', '2019-06-23 15:32:52', NULL, 'B', 0),
(13, 3, 'Ramsay', 'cocinero2', 'cocinero2', '2019-06-23 15:52:51', '2019-07-14 14:51:12', 'A', 7),
(15, 2, 'Pedro', 'cervecero5', 'cervecero5', '2019-07-09 14:50:22', NULL, 'A', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

DROP TABLE IF EXISTS `encuestas`;
CREATE TABLE `encuestas` (
  `id` int(11) NOT NULL,
  `puntuacion_mesa` int(11) NOT NULL,
  `codigoMesa` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `puntuacion_restaurante` int(11) NOT NULL,
  `puntuacion_mozo` int(11) NOT NULL,
  `idMozo` int(11) NOT NULL,
  `puntuacion_cocinero` int(11) NOT NULL,
  `comentario` varchar(66) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`id`, `puntuacion_mesa`, `codigoMesa`, `puntuacion_restaurante`, `puntuacion_mozo`, `idMozo`, `puntuacion_cocinero`, `comentario`, `fecha`) VALUES
(1, 10, 'MES01', 10, 7, 7, 8, 'comentario prueba', '2019-07-14 14:53:09'),
(2, 10, 'MES05', 10, 9, 7, 8, 'Excelente comida de php', '2019-07-14 17:23:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedidos`
--

DROP TABLE IF EXISTS `estado_pedidos`;
CREATE TABLE `estado_pedidos` (
  `id_estado_pedidos` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estado_pedidos`
--

INSERT INTO `estado_pedidos` (`id_estado_pedidos`, `descripcion`) VALUES
(1, 'Pendiente'),
(2, 'En Preparacion'),
(3, 'Listo para Servir'),
(4, 'Entregado'),
(5, 'Cancelado'),
(6, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

DROP TABLE IF EXISTS `facturas`;
CREATE TABLE `facturas` (
  `idFactura` int(11) NOT NULL,
  `importe` int(11) NOT NULL,
  `codigoMesa` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`idFactura`, `importe`, `codigoMesa`, `fecha`) VALUES
(1, 0, 'MES02', '2019-07-09 15:16:39'),
(2, 0, 'MES01', '2019-07-09 15:22:53'),
(3, 500, 'MES03', '2019-07-09 15:30:17'),
(4, 0, 'MES01', '2019-07-14 17:14:07'),
(5, 0, 'MES02', '2019-07-14 17:14:11'),
(6, 0, 'MES03', '2019-07-14 17:14:13'),
(7, 0, 'MES04', '2019-07-14 17:14:16'),
(8, 250, 'MES05', '2019-07-14 17:27:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `id_sector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `nombre`, `precio`, `id_sector`) VALUES
(1, 'Pizza', 500, 3),
(2, 'Cerveza', 180, 2),
(3, 'Empanadas', 300, 3),
(4, 'Vino', 300, 1),
(5, 'Milanesa', 187, 3),
(6, 'Milanesa con pure', 250, 3),
(7, 'Tortilla de papas', 250, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

DROP TABLE IF EXISTS `mesas`;
CREATE TABLE `mesas` (
  `codigo_mesa` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`codigo_mesa`, `estado`, `foto`) VALUES
('MES01', 'Con clientes comiendo', './Fotos/Mesas/MES01..jpg'),
('MES02', 'Con clientes pagando', './Fotos/Mesas/MES02..jpg'),
('MES03', 'Con clientes pagando', './Fotos/Mesas/MES03..jpg'),
('MES04', 'Con clientes comiendo', './Fotos/Mesas/MES04..jpg'),
('MES05', 'Con clientes pagando', NULL),
('MES06', 'Cerrada', NULL),
('MES07', 'Cerrada', NULL),
('MES08', 'Cerrada', NULL),
('MES09', 'Cerrada', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `codigo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `id_estado_pedidos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `hora_inicial` time NOT NULL,
  `hora_entrega_estimada` time DEFAULT NULL,
  `hora_entrega_real` time DEFAULT NULL,
  `id_mesa` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_mozo` int(11) NOT NULL,
  `id_encargado` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`codigo`, `id_estado_pedidos`, `fecha`, `hora_inicial`, `hora_entrega_estimada`, `hora_entrega_real`, `id_mesa`, `id_menu`, `id_mozo`, `id_encargado`, `nombre_cliente`) VALUES
('02afm', 6, '2019-07-14 00:00:00', '14:44:00', '15:21:00', NULL, 'MES01', 3, 7, 13, 'ClientePepe'),
('4qin7', 6, '2019-06-30 00:00:00', '12:15:00', '13:20:00', '14:05:00', 'MES01', 1, 7, 13, 'cliente1'),
('nt815', 6, '2019-07-14 00:00:00', '17:15:00', '17:45:00', '17:26:00', 'MES05', 7, 7, 13, 'ClientePepe22'),
('ok36k', 6, '2019-06-30 00:00:00', '12:17:00', NULL, NULL, 'MES01', 5, 7, NULL, 'cliente1'),
('u6u8h', 6, '2019-06-30 00:00:00', '12:25:00', NULL, NULL, 'MES03', 2, 7, NULL, 'cliente4'),
('uhhgf', 6, '2019-06-30 00:00:00', '12:24:00', '13:21:00', '14:04:00', 'MES03', 1, 7, 13, 'cliente3'),
('w551a', 5, '2019-06-30 00:00:00', '12:17:00', NULL, NULL, 'MES01', 2, 7, NULL, 'cliente1'),
('zo93a', 6, '2019-06-30 00:00:00', '12:19:00', '15:17:00', '14:48:00', 'MES02', 2, 8, 14, 'cliente2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoempleado`
--

DROP TABLE IF EXISTS `tipoempleado`;
CREATE TABLE `tipoempleado` (
  `ID_tipo_empleado` int(11) NOT NULL,
  `descripcion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(1) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipoempleado`
--

INSERT INTO `tipoempleado` (`ID_tipo_empleado`, `descripcion`, `estado`) VALUES
(1, 'Bartender', 'A'),
(2, 'Cervecero', 'A'),
(3, 'Cocinero', 'A'),
(4, 'Mozo', 'A'),
(5, 'Socio', 'A');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`ID_empleado`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `clave` (`clave`);

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_pedidos`
--
ALTER TABLE `estado_pedidos`
  ADD PRIMARY KEY (`id_estado_pedidos`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idFactura`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`codigo_mesa`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `tipoempleado`
--
ALTER TABLE `tipoempleado`
  ADD PRIMARY KEY (`ID_tipo_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `ID_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tipoempleado`
--
ALTER TABLE `tipoempleado`
  MODIFY `ID_tipo_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
