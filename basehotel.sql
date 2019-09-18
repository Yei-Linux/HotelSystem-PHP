-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2019 a las 07:56:05
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basehotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `ID_CATEGORIA` int(11) NOT NULL,
  `NOMBRE_CATEGORIA` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`ID_CATEGORIA`, `NOMBRE_CATEGORIA`) VALUES
(1, 'Cereales'),
(2, 'Bebidas'),
(3, 'Snacks'),
(4, 'Galletas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID_CLIENTE` int(11) NOT NULL,
  `ID_PERSONA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID_CLIENTE`, `ID_PERSONA`) VALUES
(1, 2),
(2, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumo`
--

CREATE TABLE `consumo` (
  `ID_CONSUMO` int(11) NOT NULL,
  `SUBTOTAL` double DEFAULT NULL,
  `ID_DETALLE_HOSPEDAJE_HAB` int(11) DEFAULT NULL,
  `PRODUCTOS` text,
  `ID_EMPLEADO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `consumo`
--

INSERT INTO `consumo` (`ID_CONSUMO`, `SUBTOTAL`, `ID_DETALLE_HOSPEDAJE_HAB`, `PRODUCTOS`, `ID_EMPLEADO`) VALUES
(1, 21.6, 2, '[{\"id\":\"4\",\"descripcion\":\"Coca Cola\",\"cantidad\":\"2\",\"stock\":\"23\",\"precio\":\"8\",\"total\":\"16\"},{\"id\":\"3\",\"descripcion\":\"Nesquik\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"5.6\",\"total\":\"5.6\"}]', 1),
(2, 5.6, NULL, '[{\"id\":\"3\",\"descripcion\":\"Nesquik\",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"5.6\",\"total\":\"5.6\"}]', 1),
(3, 13.6, 3, '[{\"id\":\"3\",\"descripcion\":\"Nesquik\",\"cantidad\":\"1\",\"stock\":\"15\",\"precio\":\"5.6\",\"total\":\"5.6\"},{\"id\":\"4\",\"descripcion\":\"Coca Cola\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"8\",\"total\":\"8\"}]', 1),
(4, 17.6, 7, '[{\"id\":\"3\",\"descripcion\":\"Nesquik\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"5.6\",\"total\":\"5.6\"},{\"id\":\"5\",\"descripcion\":\"Sprite\",\"cantidad\":\"2\",\"stock\":\"12\",\"precio\":\"6\",\"total\":\"12\"}]', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_hospedaje_hab`
--

CREATE TABLE `detalle_hospedaje_hab` (
  `ID_DETALLE_HOSPEDAJE_HAB` int(11) NOT NULL,
  `ESTADO_HOSPEDAJE` varchar(100) DEFAULT NULL,
  `FECHA_INICIO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FECHA_FIN` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FECHA_SALIDA` date DEFAULT NULL,
  `HORA_SALIDA` time DEFAULT NULL,
  `CANTIDAD_DIAS` int(11) DEFAULT NULL,
  `COSTO_ADICIONAL` double DEFAULT NULL,
  `EMOJI_SALIDA` varchar(100) DEFAULT NULL,
  `NUMERO_ADULTOS` int(11) NOT NULL,
  `NUMERO_NINOS` int(11) NOT NULL,
  `ID_HABITACION` int(11) NOT NULL,
  `ID_HOSPEDAJE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_hospedaje_hab`
--

INSERT INTO `detalle_hospedaje_hab` (`ID_DETALLE_HOSPEDAJE_HAB`, `ESTADO_HOSPEDAJE`, `FECHA_INICIO`, `FECHA_FIN`, `FECHA_SALIDA`, `HORA_SALIDA`, `CANTIDAD_DIAS`, `COSTO_ADICIONAL`, `EMOJI_SALIDA`, `NUMERO_ADULTOS`, `NUMERO_NINOS`, `ID_HABITACION`, `ID_HOSPEDAJE`) VALUES
(1, 'Anulada', '2019-04-18 22:01:05', '2019-05-10 21:59:04', '2019-04-18', '16:59:53', 1, 0, NULL, 2, 0, 1, 1),
(2, 'Facturada', '2019-04-18 22:39:20', '2019-05-10 22:01:58', '2019-04-18', '17:38:38', 1, 0, NULL, 3, 1, 2, 2),
(3, 'Facturada', '2019-04-19 22:01:17', '2019-05-10 21:15:06', '2019-04-19', '17:00:24', 1, 0, NULL, 1, 1, 1, 3),
(4, 'Anulada', '2019-04-19 21:55:26', '2019-05-15 21:53:28', '2019-04-19', '16:54:59', 1, 0, NULL, 4, 2, 3, 4),
(5, 'Anulada', '2019-04-19 21:59:48', '2019-05-20 21:55:57', '2019-04-19', '16:59:47', 1, 0, NULL, 2, 2, 2, 5),
(6, 'Facturada', '2019-09-18 05:39:21', '2019-05-16 22:04:45', '2019-09-18', '00:34:15', 153, 18750, NULL, 2, 0, 1, 6),
(7, 'Ocupada', '2019-09-18 05:44:01', '2019-09-30 05:44:01', NULL, NULL, NULL, NULL, NULL, 2, 0, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_servicio`
--

CREATE TABLE `detalle_servicio` (
  `ID_DETALLE_SERVICIO` int(11) NOT NULL,
  `SUBTOTAL` double NOT NULL,
  `ID_DETALLE_HOSPEDAJE_HAB` int(11) NOT NULL,
  `SERVICIOS` text,
  `ID_EMPLEADO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `ID_EMPLEADO` int(11) NOT NULL,
  `ID_PERSONA` int(11) NOT NULL,
  `ID_HOTEL` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `FOTO` varchar(200) DEFAULT NULL,
  `FOTO2` varchar(100) DEFAULT NULL,
  `ESTADO` int(30) DEFAULT NULL,
  `ULTIMO_LOGIN` datetime DEFAULT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`ID_EMPLEADO`, `ID_PERSONA`, `ID_HOTEL`, `ID_USUARIO`, `FOTO`, `FOTO2`, `ESTADO`, `ULTIMO_LOGIN`, `FECHA`) VALUES
(1, 1, 1, 1, 'vistas/img/usuarios/Pedro/564.png', '564.png', 1, NULL, '2019-09-18 05:54:17'),
(2, 3, 1, 2, 'vistas/img/usuarios/Carlita/586.png', '586.png', 1, NULL, '2019-04-18 18:59:14'),
(3, 4, 2, 3, 'vistas/img/usuarios/tobias/308.jpg', '308.jpg', 1, NULL, '2019-04-19 22:08:08'),
(4, 5, 1, 4, 'vistas/img/usuarios/albi/413.jpg', '413.jpg', 1, NULL, '2019-04-18 19:38:40'),
(5, 6, 1, 5, 'vistas/img/usuarios/lynch/832.png', '832.png', 1, NULL, '2019-04-18 19:21:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `ID_ESTADO` int(11) NOT NULL,
  `NOMBRE_ESTADO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`ID_ESTADO`, `NOMBRE_ESTADO`) VALUES
(1, 'Libre'),
(2, 'Ocupada'),
(3, 'Limpieza'),
(4, 'Mantenimiento'),
(5, 'Reservada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion_pago`
--

CREATE TABLE `facturacion_pago` (
  `OBSERVACIONES` varchar(100) DEFAULT NULL,
  `TIPO_COMPROBANTE` varchar(100) DEFAULT NULL,
  `COMPROBANTE_SERIE` varchar(10) DEFAULT NULL,
  `COMPROBANTE_NUMERO` varchar(10) DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `ID_PAGO` int(11) DEFAULT NULL,
  `ID_HOSPEDAJE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturacion_pago`
--

INSERT INTO `facturacion_pago` (`OBSERVACIONES`, `TIPO_COMPROBANTE`, `COMPROBANTE_SERIE`, `COMPROBANTE_NUMERO`, `TOTAL`, `ID_PAGO`, `ID_HOSPEDAJE`) VALUES
('El cliente se retiro el mismo día.', 'Boleta', '1B23-345A', '0001', 725.6, 1, 2),
('El cliente se retiro el mismo día.', 'Boleta', '1B23-345A', '0001', 277.6, 2, 3),
('El cliente se retiro muy tarde,pago adicional(S./18750)', '', '8B23-645A', '0003', 59601, 3, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE `forma_pago` (
  `ID_FORMA_PAGO` int(11) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`ID_FORMA_PAGO`, `NOMBRE`) VALUES
(1, 'Efectivo'),
(2, 'Deposito Bancario'),
(3, 'Tarjeta Credito'),
(4, 'Tarjeta Debito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `ID_HABITACION` int(11) NOT NULL,
  `FOTO` varchar(200) NOT NULL,
  `RUTA_FOTO2` varchar(100) DEFAULT NULL,
  `NUMERO_HABITACION` int(11) NOT NULL,
  `PISO` int(11) NOT NULL,
  `DESCRIPCION_HAB` varchar(200) DEFAULT NULL,
  `PLAZAS` int(11) NOT NULL,
  `ID_TIPO_HABITACION` int(11) NOT NULL,
  `ID_HOTEL` int(11) NOT NULL,
  `ID_ESTADO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`ID_HABITACION`, `FOTO`, `RUTA_FOTO2`, `NUMERO_HABITACION`, `PISO`, `DESCRIPCION_HAB`, `PLAZAS`, `ID_TIPO_HABITACION`, `ID_HOTEL`, `ID_ESTADO`) VALUES
(1, 'vistas/img/habitaciones/100/633.jpg', '633.jpg', 100, 1, 'Habitación de 1 cama con televisor y baño', 1, 1, 1, 2),
(2, 'vistas/img/habitaciones/101/591.jpg', '591.jpg', 101, 1, 'Habitación de 2 camas con televisor y servicios', 2, 2, 1, 1),
(3, 'vistas/img/habitaciones/102/251.jpg', '251.jpg', 102, 1, 'Habitación de 3 camas con televisor y baño', 3, 3, 1, 1),
(4, 'vistas/img/habitaciones/100/881.png', '881.png', 100, 1, 'Habitación de 1 cama con televisor y baño', 2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospedaje`
--

CREATE TABLE `hospedaje` (
  `ID_HOSPEDAJE` int(11) NOT NULL,
  `ID_EMPLEADO` int(11) NOT NULL,
  `ID_CLIENTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hospedaje`
--

INSERT INTO `hospedaje` (`ID_HOSPEDAJE`, `ID_EMPLEADO`, `ID_CLIENTE`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 1),
(4, 1, 1),
(5, 1, 1),
(6, 1, 1),
(7, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
--

CREATE TABLE `hotel` (
  `ID_HOTEL` int(11) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `PISOS` int(11) NOT NULL,
  `ID_PROVINCIA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hotel`
--

INSERT INTO `hotel` (`ID_HOTEL`, `NOMBRE`, `PISOS`, `ID_PROVINCIA`) VALUES
(1, 'Francisco Lima', 3, 1),
(2, 'Franciso Arequipa', 3, 2),
(3, 'Franciso Huancayo', 3, 3),
(4, 'Franciso Cusco', 3, 4),
(5, 'Franciso Lima2', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `ID_PAGO` int(11) NOT NULL,
  `MONTO` double NOT NULL,
  `FECHA` date NOT NULL,
  `ID_FORMA_PAGO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`ID_PAGO`, `MONTO`, `FECHA`, `ID_FORMA_PAGO`) VALUES
(1, 800, '2019-04-18', 1),
(2, 300, '2019-04-19', 1),
(3, 45900, '2019-09-18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `ID_PERSONA` int(11) NOT NULL,
  `APELLIDO_PATERNO` varchar(30) NOT NULL,
  `APELLIDO_MATERNO` varchar(30) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `DNI` varchar(30) NOT NULL,
  `DIRECCION` varchar(30) NOT NULL,
  `TELEFONO` varchar(30) NOT NULL,
  `CORREO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`ID_PERSONA`, `APELLIDO_PATERNO`, `APELLIDO_MATERNO`, `NOMBRE`, `DNI`, `DIRECCION`, `TELEFONO`, `CORREO`) VALUES
(1, 'Suarez', 'Vertiz', 'Pedro', '25673412', 'Jr Pazos', '(966) 001-332_', 'pedrosv@hotmail.com'),
(2, 'Alvarez', 'Leiva', 'Boby', '34548501', 'Jr Pazoz', '(999) 888-7776', 'boby@hotmail.com'),
(3, 'Rodriguez', 'Diaz', 'Carlota', '55713935', 'Jr Huanuco', '(555) 888-9999', 'carlota@gmail.com'),
(4, 'Dario', 'Robles', 'Tobias', '95542234', 'Jr Trujillo', '(999) 453-6777', 'todias@hotmail.com'),
(5, 'Lopez', 'Gonzales', 'Alberto', '24652661', 'Jr Lima', '(989) 991-1236', 'alb@gmail.com'),
(6, 'Vela', 'Linch', 'Christian', '23467165', 'Jr Layo', '(998) 124-8871', 'chris@gmail.com'),
(7, 'Herrera', 'Loyo', 'Freddy', '28917865', 'Jr Electric', '(998) 445-7781', 'fred@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_PRODUCTO` int(11) NOT NULL,
  `DESCRIPCION` varchar(30) NOT NULL,
  `STOCK` int(11) DEFAULT NULL,
  `PRECIO` double NOT NULL,
  `FOTO_PRODUCTO` varchar(100) NOT NULL,
  `RUTA_FOTOPRODUCTO2` varchar(100) DEFAULT NULL,
  `ID_CATEGORIA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_PRODUCTO`, `DESCRIPCION`, `STOCK`, `PRECIO`, `FOTO_PRODUCTO`, `RUTA_FOTOPRODUCTO2`, `ID_CATEGORIA`) VALUES
(1, 'Galleta Oreo', 39, 5.5, 'vistas/img/productos/Galleta Oreo/158.png', '158.png', 4),
(2, ' Galleta Ritz', 17, 6.5, 'vistas/img/productos/Galleta Ritz/888.png', '888.png', 4),
(3, 'Nesquik', 14, 5.6, 'vistas/img/productos/Nesquik/899.jpg', '899.jpg', 1),
(4, 'Coca Cola', 18, 8, 'vistas/img/productos/Coca Cola/717.jpg', '717.jpg', 2),
(5, 'Sprite', 12, 6, 'vistas/img/productos/Sprite/824.jpg', '824.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `ID_PROVINCIA` int(11) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`ID_PROVINCIA`, `NOMBRE`) VALUES
(1, 'Lima'),
(2, 'Arequipa'),
(3, 'Huancayo'),
(4, 'Cusco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `ID_RESERVA` int(11) NOT NULL,
  `FECHA_RESERVA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FECHA_LLEGADA` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CANTIDAD_NINOS` int(11) NOT NULL,
  `CANTIDAD_ADULTOS` int(11) NOT NULL,
  `ESTADO_RESERVA` varchar(30) NOT NULL,
  `OBSERVACIONES` varchar(100) NOT NULL,
  `ID_CLIENTE` int(11) NOT NULL,
  `ID_EMPLEADO` int(11) NOT NULL,
  `ID_HABITACION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`ID_RESERVA`, `FECHA_RESERVA`, `FECHA_LLEGADA`, `CANTIDAD_NINOS`, `CANTIDAD_ADULTOS`, `ESTADO_RESERVA`, `OBSERVACIONES`, `ID_CLIENTE`, `ID_EMPLEADO`, `ID_HABITACION`) VALUES
(1, '2019-04-19 21:15:06', '2019-05-20 21:00:00', 0, 2, 'Realizado', 'Llegara con un auto rojo.', 1, 1, 1),
(2, '2019-04-19 22:04:45', '2019-04-21 21:00:00', 0, 2, 'Realizado', 'Llegara en auto.', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `ID_SERVICIO` int(11) NOT NULL,
  `SERVICIO` varchar(100) NOT NULL,
  `DESCRIPCION` varchar(200) NOT NULL,
  `PRECIO` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`ID_SERVICIO`, `SERVICIO`, `DESCRIPCION`, `PRECIO`) VALUES
(1, 'Limpieza', 'La limpieza sera en toda el cuarto', 45),
(3, 'Mantenimiento', 'Mantenimiento en algún desperfecto de la habitación', 80.45),
(4, 'Desayuno', 'Satisfacer las necesidades del cliente de un buen desayuno,consta de 2 panes triples, 2 jugos cualquier sabor  y dos postres', 100.56);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporada`
--

CREATE TABLE `temporada` (
  `ID_TEMPORADA` int(11) NOT NULL,
  `TEMPORADA` varchar(30) NOT NULL,
  `FECHA_DESDE` varchar(30) NOT NULL,
  `FECHA_HASTA` varchar(30) NOT NULL,
  `DESCUENTO` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `temporada`
--

INSERT INTO `temporada` (`ID_TEMPORADA`, `TEMPORADA`, `FECHA_DESDE`, `FECHA_HASTA`, `DESCUENTO`) VALUES
(1, 'Primavera', '9', '11', 11),
(2, 'Verano', '12', '2', 13),
(3, 'Otoño', '3', '5', 12),
(4, 'Invierno', '6', '8', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE `tipo_habitacion` (
  `ID_TIPO_HABITACION` int(11) NOT NULL,
  `TIPO_HABITACION` varchar(30) NOT NULL,
  `DESCRIPCION` varchar(200) NOT NULL,
  `PRECIO` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`ID_TIPO_HABITACION`, `TIPO_HABITACION`, `DESCRIPCION`, `PRECIO`) VALUES
(1, 'Habitación Individual', 'Habitacion solo para uno', 150),
(2, 'Habitación Doble', 'Habitacion para dos personas', 200),
(3, 'Habitación Familiar', 'Habitacion para toda la familia', 350),
(5, 'Suite Individual', 'Habitación exclusiva solo para una persona', 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `ID_TIPO_USU` int(11) NOT NULL,
  `NOM_TIPO_USU` varchar(30) NOT NULL,
  `DESCRIPCION` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`ID_TIPO_USU`, `NOM_TIPO_USU`, `DESCRIPCION`) VALUES
(1, 'Administrador', 'Encargado de administrar casi todo'),
(2, 'Hotelero', 'Encargado de administrar el control de habitaciones'),
(3, 'Vendedor', 'Encargado de solo vender a los clientes ,productos'),
(5, 'Seguridad', 'Encargado de la seguridad del hotel'),
(6, 'Tecnico y Mantenimiento', 'Encargado de dar mantenimiento a cada habitacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_USUARIO` int(11) NOT NULL,
  `USARIO` varchar(30) NOT NULL,
  `PASS` varchar(200) NOT NULL,
  `ID_TIPO_USU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `USARIO`, `PASS`, `ID_TIPO_USU`) VALUES
(1, 'Pedro', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 1),
(2, 'Carlita', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', 1),
(3, 'tobias', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 1),
(4, 'albi', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', 1),
(5, 'lynch', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_CLIENTE`),
  ADD KEY `fk_id_persona` (`ID_PERSONA`);

--
-- Indices de la tabla `consumo`
--
ALTER TABLE `consumo`
  ADD PRIMARY KEY (`ID_CONSUMO`),
  ADD KEY `fk_id_detalle_hospedaje_hab` (`ID_DETALLE_HOSPEDAJE_HAB`),
  ADD KEY `fk_idemp_tienda` (`ID_EMPLEADO`);

--
-- Indices de la tabla `detalle_hospedaje_hab`
--
ALTER TABLE `detalle_hospedaje_hab`
  ADD PRIMARY KEY (`ID_DETALLE_HOSPEDAJE_HAB`),
  ADD KEY `fk2_id_habitacion` (`ID_HABITACION`),
  ADD KEY `fk_id_hospedaje` (`ID_HOSPEDAJE`);

--
-- Indices de la tabla `detalle_servicio`
--
ALTER TABLE `detalle_servicio`
  ADD PRIMARY KEY (`ID_DETALLE_SERVICIO`),
  ADD KEY `fk2_id_detalle_hospedaje_hab` (`ID_DETALLE_HOSPEDAJE_HAB`),
  ADD KEY `fk_id_empleado_tienda_serv` (`ID_EMPLEADO`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`ID_EMPLEADO`),
  ADD KEY `fk2_id_persona` (`ID_PERSONA`),
  ADD KEY `fk_id_hotel` (`ID_HOTEL`),
  ADD KEY `fk_id_usuario` (`ID_USUARIO`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`ID_ESTADO`);

--
-- Indices de la tabla `facturacion_pago`
--
ALTER TABLE `facturacion_pago`
  ADD KEY `fk_id_pago` (`ID_PAGO`),
  ADD KEY `fk3_id_hospedaje` (`ID_HOSPEDAJE`);

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`ID_FORMA_PAGO`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`ID_HABITACION`),
  ADD KEY `fk_id_tipo_hab` (`ID_TIPO_HABITACION`),
  ADD KEY `fk2_id_hotel` (`ID_HOTEL`),
  ADD KEY `fk_id_estado` (`ID_ESTADO`);

--
-- Indices de la tabla `hospedaje`
--
ALTER TABLE `hospedaje`
  ADD PRIMARY KEY (`ID_HOSPEDAJE`),
  ADD KEY `fk_id_empleado` (`ID_EMPLEADO`),
  ADD KEY `fk2_id_cliente` (`ID_CLIENTE`);

--
-- Indices de la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`ID_HOTEL`),
  ADD KEY `fk_id_provincia` (`ID_PROVINCIA`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`ID_PAGO`),
  ADD KEY `fk_id_forma_pago` (`ID_FORMA_PAGO`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ID_PERSONA`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_PRODUCTO`),
  ADD KEY `fk_id_categoria` (`ID_CATEGORIA`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`ID_PROVINCIA`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`ID_RESERVA`),
  ADD KEY `fk_id_cliente` (`ID_CLIENTE`),
  ADD KEY `fk_id_habitacion` (`ID_HABITACION`),
  ADD KEY `fk_id_empleado_reserva` (`ID_EMPLEADO`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`ID_SERVICIO`);

--
-- Indices de la tabla `temporada`
--
ALTER TABLE `temporada`
  ADD PRIMARY KEY (`ID_TEMPORADA`);

--
-- Indices de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  ADD PRIMARY KEY (`ID_TIPO_HABITACION`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`ID_TIPO_USU`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD KEY `fk_id_tipo_usu` (`ID_TIPO_USU`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `ID_CATEGORIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_CLIENTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `consumo`
--
ALTER TABLE `consumo`
  MODIFY `ID_CONSUMO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_hospedaje_hab`
--
ALTER TABLE `detalle_hospedaje_hab`
  MODIFY `ID_DETALLE_HOSPEDAJE_HAB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_servicio`
--
ALTER TABLE `detalle_servicio`
  MODIFY `ID_DETALLE_SERVICIO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `ID_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `ID_ESTADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `ID_FORMA_PAGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `ID_HABITACION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `hospedaje`
--
ALTER TABLE `hospedaje`
  MODIFY `ID_HOSPEDAJE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `hotel`
--
ALTER TABLE `hotel`
  MODIFY `ID_HOTEL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `ID_PAGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `ID_PERSONA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `ID_PROVINCIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `ID_RESERVA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `ID_SERVICIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `temporada`
--
ALTER TABLE `temporada`
  MODIFY `ID_TEMPORADA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `ID_TIPO_HABITACION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `ID_TIPO_USU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_id_persona` FOREIGN KEY (`ID_PERSONA`) REFERENCES `persona` (`ID_PERSONA`);

--
-- Filtros para la tabla `consumo`
--
ALTER TABLE `consumo`
  ADD CONSTRAINT `fk_id_detalle_hospedaje_hab` FOREIGN KEY (`ID_DETALLE_HOSPEDAJE_HAB`) REFERENCES `detalle_hospedaje_hab` (`ID_DETALLE_HOSPEDAJE_HAB`),
  ADD CONSTRAINT `fk_idemp_tienda` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleado` (`ID_EMPLEADO`);

--
-- Filtros para la tabla `detalle_hospedaje_hab`
--
ALTER TABLE `detalle_hospedaje_hab`
  ADD CONSTRAINT `fk2_id_habitacion` FOREIGN KEY (`ID_HABITACION`) REFERENCES `habitacion` (`ID_HABITACION`),
  ADD CONSTRAINT `fk_id_hospedaje` FOREIGN KEY (`ID_HOSPEDAJE`) REFERENCES `hospedaje` (`ID_HOSPEDAJE`);

--
-- Filtros para la tabla `detalle_servicio`
--
ALTER TABLE `detalle_servicio`
  ADD CONSTRAINT `fk_id_empleado_tienda_serv` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleado` (`ID_EMPLEADO`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk2_id_persona` FOREIGN KEY (`ID_PERSONA`) REFERENCES `persona` (`ID_PERSONA`),
  ADD CONSTRAINT `fk_id_hotel` FOREIGN KEY (`ID_HOTEL`) REFERENCES `hotel` (`ID_HOTEL`),
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Filtros para la tabla `facturacion_pago`
--
ALTER TABLE `facturacion_pago`
  ADD CONSTRAINT `fk3_id_hospedaje` FOREIGN KEY (`ID_HOSPEDAJE`) REFERENCES `hospedaje` (`ID_HOSPEDAJE`),
  ADD CONSTRAINT `fk_id_pago` FOREIGN KEY (`ID_PAGO`) REFERENCES `pago` (`ID_PAGO`);

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `fk2_id_hotel` FOREIGN KEY (`ID_HOTEL`) REFERENCES `hotel` (`ID_HOTEL`),
  ADD CONSTRAINT `fk_id_estado` FOREIGN KEY (`ID_ESTADO`) REFERENCES `estado` (`ID_ESTADO`),
  ADD CONSTRAINT `fk_id_tipo_hab` FOREIGN KEY (`ID_TIPO_HABITACION`) REFERENCES `tipo_habitacion` (`ID_TIPO_HABITACION`);

--
-- Filtros para la tabla `hospedaje`
--
ALTER TABLE `hospedaje`
  ADD CONSTRAINT `fk2_id_cliente` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `cliente` (`ID_CLIENTE`),
  ADD CONSTRAINT `fk_id_empleado` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleado` (`ID_EMPLEADO`);

--
-- Filtros para la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `fk_id_provincia` FOREIGN KEY (`ID_PROVINCIA`) REFERENCES `provincia` (`ID_PROVINCIA`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `fk_id_forma_pago` FOREIGN KEY (`ID_FORMA_PAGO`) REFERENCES `forma_pago` (`ID_FORMA_PAGO`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_id_categoria` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `categorias` (`ID_CATEGORIA`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_id_cliente` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `cliente` (`ID_CLIENTE`),
  ADD CONSTRAINT `fk_id_empleado_reserva` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleado` (`ID_EMPLEADO`),
  ADD CONSTRAINT `fk_id_habitacion` FOREIGN KEY (`ID_HABITACION`) REFERENCES `habitacion` (`ID_HABITACION`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_id_tipo_usu` FOREIGN KEY (`ID_TIPO_USU`) REFERENCES `tipo_usuario` (`ID_TIPO_USU`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
