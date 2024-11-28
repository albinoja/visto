-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2024 a las 15:17:32
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
-- Base de datos: `sciv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `backups`
--

DROP TABLE IF EXISTS `backups`;
CREATE TABLE `backups` (
  `idBackup` int(255) NOT NULL,
  `nombreBackup` varchar(255) NOT NULL,
  `fechaRealizado` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `backups`
--

INSERT INTO `backups` (`idBackup`, `nombreBackup`, `fechaRealizado`) VALUES
(5, 'sciv_backup_2024-10-27_07-53-37.sql', '2024-10-27 13:53:38.000000'),
(6, 'sciv_backup_2024-10-27_07-55-02.sql', '0000-00-00 00:00:00.000000'),
(7, 'sciv_backup_2024-10-27_07-56-04.sql', '2024-10-27 13:56:04.000000'),
(8, 'sciv_backup_2024-10-27_08-00-32.sql', '2024-10-27 14:00:33.000000'),
(9, 'sciv_backup_2024-10-27_08-01-09.sql', '2024-10-27 14:01:09.000000'),
(10, 'sciv_backup_2024-10-27_08-04-32.sql', '2024-10-27 14:04:33.000000'),
(11, 'sciv_backup_2024-10-27_08-05-06.sql', '2024-10-27 14:05:06.000000'),
(12, 'sciv_backup_2024-10-27_08-05-28.sql', '2024-10-27 14:05:28.000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_sesiones`
--

DROP TABLE IF EXISTS `bitacora_sesiones`;
CREATE TABLE `bitacora_sesiones` (
  `idbitacora` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `estado_sesion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora_sesiones`
--

INSERT INTO `bitacora_sesiones` (`idbitacora`, `idusuario`, `fecha_inicio`, `fecha_fin`, `estado_sesion`) VALUES
(26, 1, '2024-10-01 16:09:40', NULL, 'Iniciado'),
(27, 1, '2024-10-01 21:00:28', '2024-10-01 21:07:09', 'Finalizado'),
(28, 1, '2024-10-01 21:07:15', NULL, 'Iniciado'),
(29, 1, '2024-10-01 21:19:43', NULL, 'Iniciado'),
(30, 1, '2024-10-01 21:44:01', '2024-10-01 21:46:32', 'Finalizado'),
(31, 1, '2024-10-01 21:47:39', NULL, 'Iniciado'),
(32, 1, '2024-10-01 22:09:13', '2024-10-01 22:47:50', 'Finalizado'),
(33, 1, '2024-10-01 22:49:33', '2024-10-01 22:49:42', 'Finalizado'),
(34, 1, '2024-10-05 14:55:42', NULL, 'Iniciado'),
(35, 1, '2024-10-13 09:08:41', NULL, 'Iniciado'),
(36, 1, '2024-10-13 09:50:11', NULL, 'Iniciado'),
(37, 1, '2024-10-13 10:32:42', NULL, 'Iniciado'),
(38, 1, '2024-10-15 15:05:29', NULL, 'Iniciado'),
(39, 1, '2024-10-15 15:35:43', NULL, 'Iniciado'),
(40, 1, '2024-10-15 15:45:24', NULL, 'Iniciado'),
(41, 1, '2024-10-15 21:10:43', '2024-10-15 21:25:14', 'Finalizado'),
(42, 1, '2024-10-15 21:27:55', NULL, 'Iniciado'),
(43, 1, '2024-10-15 21:56:27', NULL, 'Iniciado'),
(44, 1, '2024-10-15 21:59:40', NULL, 'Iniciado'),
(45, 1, '2024-10-16 14:36:29', NULL, 'Iniciado'),
(46, 1, '2024-10-16 15:31:36', NULL, 'Iniciado'),
(47, 1, '2024-10-16 21:12:27', NULL, 'Iniciado'),
(48, 1, '2024-10-20 08:23:31', NULL, 'Iniciado'),
(49, 1, '2024-10-20 08:40:42', NULL, 'Iniciado'),
(50, 1, '2024-10-25 19:24:38', NULL, 'Iniciado'),
(51, 1, '2024-10-27 07:34:15', NULL, 'Iniciado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `categoria`, `estado`) VALUES
(1, '', 1),
(2, 'Tecnología', 1),
(4, 'Electrodomésticos', 1),
(8, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventas`
--

DROP TABLE IF EXISTS `detalleventas`;
CREATE TABLE `detalleventas` (
  `iddventa` int(11) NOT NULL,
  `idventa` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `detalleventas`
--

INSERT INTO `detalleventas` (`iddventa`, `idventa`, `idproducto`, `cantidad`, `total`, `estado`, `fecha`) VALUES
(10, 8, 2, 1, 0.15, 1, '2024-10-13'),
(11, 9, 2, 2, 0.3, 1, '2024-10-16'),
(12, 10, 2, 1, 0.15, 1, '2024-10-16'),
(13, 11, 2, 1, 0.15, 1, '2024-10-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `notas` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `notas`) VALUES
(19, 'nota actualizadas\n'),
(20, 'notas 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL,
  `producto` text DEFAULT NULL,
  `detalle` text DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `pventa` float DEFAULT NULL,
  `pcompra` float DEFAULT NULL,
  `minimo` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `idproveedor` int(11) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `producto`, `detalle`, `stock`, `pventa`, `pcompra`, `minimo`, `img`, `idproveedor`, `idcategoria`, `estado`) VALUES
(2, 'Churritos Dian', 'Diana Churritos Pequeños', 5, 0.15, 0.1, 15, '2.png', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores` (
  `idproveedor` int(11) NOT NULL,
  `proveedor` text DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idproveedor`, `proveedor`, `telefono`, `email`, `direccion`, `estado`) VALUES
(2, 'DIana', '2200-2870', 'diana@gmail.com', ', Edificio N° 5200, San Salvador.', 1),
(5, 'Bocadeli', '64736722', 'bacadeli@gmail.com', 'sndjsnjdsndjnsd', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `empleado` text NOT NULL,
  `clave` text NOT NULL,
  `tipo` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `usuario`, `empleado`, `clave`, `tipo`, `estado`) VALUES
(1, 'admin', 'Root', '$2y$10$wNtNpJ4rPgVK1DOg/D7pu./FJom1iucdM.ZKlT4m19TRAL7Fs.kx6', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas` (
  `idventa` int(11) NOT NULL,
  `cliente` text DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`idventa`, `cliente`, `idusuario`, `fecha`, `estado`) VALUES
(8, 'hector', 1, '2024-10-09 16:28:38', 1),
(9, 'hector', 1, '2024-10-16 15:53:20', 1),
(10, 'hector', 1, '2024-10-16 16:27:07', 1),
(11, 'juan', 1, '2024-10-16 16:29:06', 1),
(12, 'hector', 1, '2024-10-16 21:12:36', 0),
(13, 'hector', 1, '2024-10-20 11:45:44', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `backups`
--
ALTER TABLE `backups`
  ADD PRIMARY KEY (`idBackup`);

--
-- Indices de la tabla `bitacora_sesiones`
--
ALTER TABLE `bitacora_sesiones`
  ADD PRIMARY KEY (`idbitacora`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD PRIMARY KEY (`iddventa`),
  ADD KEY `idventa` (`idventa`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `idproveedor` (`idproveedor`),
  ADD KEY `idcategoria` (`idcategoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `idusuario` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `backups`
--
ALTER TABLE `backups`
  MODIFY `idBackup` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `bitacora_sesiones`
--
ALTER TABLE `bitacora_sesiones`
  MODIFY `idbitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  MODIFY `iddventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD CONSTRAINT `detalleventas_ibfk_1` FOREIGN KEY (`idventa`) REFERENCES `ventas` (`idventa`),
  ADD CONSTRAINT `detalleventas_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedores` (`idproveedor`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`idproveedor`) REFERENCES `proveedores` (`idproveedor`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
