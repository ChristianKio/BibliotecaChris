-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2022 a las 01:09:09
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_fallecimiento` date NOT NULL,
  `lugar_nacimiento` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `biografia` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id`, `nombre`, `apellidos`, `fecha_nacimiento`, `fecha_fallecimiento`, `lugar_nacimiento`, `biografia`, `foto`, `fecha_creacion`, `fecha_modificacion`) VALUES
(2, 'EVA', 'GARCIA SAENZ DE URTURI', '1972-08-20', '0000-00-00', 'Vitoria,Alava', 'Nacida en Vitoria en 1972, vive en Alicante desde los quince años.', '220px-20201118_EVA_G_SAENZ_DE_URTURI-055_2.jpg', '2022-02-27 14:45:33', '2022-02-27 14:45:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `fecha_creacion`, `fecha_modificacion`) VALUES
(8, 'Misterio', '2022-02-27 14:49:41', '2022-02-27 14:49:41'),
(9, 'Suspense', '2022-02-27 14:49:49', '2022-02-27 14:49:49'),
(10, 'Ficcion', '2022-02-27 14:49:57', '2022-02-27 14:49:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

CREATE TABLE `editoriales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `editoriales`
--

INSERT INTO `editoriales` (`id`, `nombre`, `fecha_creacion`, `fecha_modificacion`) VALUES
(3, 'Planeta', '2022-02-27 14:50:20', '2022-02-27 14:50:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `autor` int(11) NOT NULL,
  `editorial` int(11) NOT NULL,
  `imagen` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` int(11) NOT NULL,
  `sinopsis` text COLLATE utf8_spanish_ci NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `autor`, `editorial`, `imagen`, `categoria`, `sinopsis`, `disponibilidad`, `fecha_creacion`, `fecha_modificacion`) VALUES
(5, 'EL LIBRO NEGRO DE LAS HORAS', 2, 3, '9788408252856.jpg', 8, 'Alguien que lleva muerto cuarenta años no puede ser secuestrado y, desde luego, no puede sangrar.\r\n\r\nVitoria, 2022. El exinspector Unai López de Ayala —alias Kraken— recibe una llamada anónima que cambiará lo que cree saber de su pasado familiar: tiene una semana para encontrar el legendario Libro Negro de las Horas, una joya bibliográfica exclusiva, si no, su madre, quien descansa en el cementerio desde hace décadas, morirá.\r\n\r\n¿Cómo es esto posible?\r\n\r\nUna carrera contrarreloj entre Vitoria y el Madrid de los bibliófilos para trazar el perfil criminal más importante de su vida, uno capaz de modificar el pasado, para siempre.\r\n\r\n\r\nMe llamo Unai. Me llaman Kraken.\r\n\r\nAquí termina tu caza, aquí comienza la mía.\r\n\r\n¿Y si tu madre fuera la mejor falsificadora de libros antiguos de la historia?', 1, '2022-02-27 14:51:08', '2022-02-27 17:39:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL,
  `libro` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha_prestamo` date NOT NULL DEFAULT current_timestamp(),
  `fecha_devolucion` date NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `libro`, `usuario`, `fecha_prestamo`, `fecha_devolucion`, `estado`, `fecha_creacion`, `fecha_modificacion`) VALUES
(8, 5, 4, '2022-02-27', '2022-03-06', 0, '2022-02-27 15:10:02', '2022-02-27 16:39:35'),
(11, 5, 4, '2022-02-27', '2022-03-06', 1, '2022-02-27 16:40:43', '2022-02-27 16:40:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `apellido` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` enum('bibliotecario','alumno') COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `username`, `password`, `avatar`, `tipo`, `activo`, `fecha_creacion`, `fecha_modificacion`) VALUES
(4, 'Christian', 'Vazquez', 'christianvazquezoliver@alumno.ieselrincon.es', 'ChristianKio', '$2y$04$Uucvj4ART7u2Mro5LteRa.JBW', 'image.png', 'alumno', 1, '2022-02-27 14:33:15', '2022-02-27 16:51:49');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `autor` (`autor`),
  ADD KEY `editorial` (`editorial`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `libro` (`libro`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `autores` FOREIGN KEY (`autor`) REFERENCES `autores` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `categorias` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `editoriales` FOREIGN KEY (`editorial`) REFERENCES `editoriales` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `libros` FOREIGN KEY (`libro`) REFERENCES `libros` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
