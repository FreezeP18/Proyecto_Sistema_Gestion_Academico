-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2023 a las 20:14:01
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
-- Base de datos: `proyectoescuela`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_administrador` int(11) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `contraseña` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_colegio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_administrador`, `login`, `contraseña`, `email`, `id_colegio`) VALUES
(1, 'admin1', 'f98b1446e9443b1c5e9b6e54a53d7d45', 'admin1@example.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `contraseña` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `id_colegio` int(11) DEFAULT 1,
  `id_nivel` int(11) DEFAULT NULL,
  `cedula_alumno` varchar(50) DEFAULT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `login`, `contraseña`, `nombre`, `apellidos`, `id_colegio`, `id_nivel`, `cedula_alumno`, `estado`) VALUES
(1, 'alumno1', '64b576d16b6416ec994d812ad869ff79', 'Juan', 'Pérez', 1, 1, '123456', 'aprobado'),
(2, 'alumno2', '64b576d16b6416ec994d812ad869ff79', 'Jose', 'Ramirez', 1, 1, '654987', 'aprobado'),
(12, 'alumno3', '64b576d16b6416ec994d812ad869ff79', 'adolfo', 'hernandez', 1, 1, '789456', 'aprobado'),
(13, 'alumno4', '64b576d16b6416ec994d812ad869ff79', 'John', 'Doe', 1, 2, '741258', 'Aprobado'),
(15, 'alumno5', '64b576d16b6416ec994d812ad869ff79', 'Jane', 'Smith', 1, 2, '963258', 'Aprobado'),
(16, 'alumno6', '64b576d16b6416ec994d812ad869ff79', 'Michael', 'Johnson', 1, 3, '951753', 'Aprobado'),
(17, 'alumno7', '64b576d16b6416ec994d812ad869ff79', 'Emma', 'Lee', 1, 3, '753159', 'Aprobado'),
(18, 'alumno8', '64b576d16b6416ec994d812ad869ff79', 'Oliver', 'Wilson', 1, 4, '654258', 'Aprobado'),
(19, 'alumno9', '64b576d16b6416ec994d812ad869ff79', 'Sophia', 'Martin', 1, 5, '789528', 'Aprobado'),
(20, 'alumno10', '64b576d16b6416ec994d812ad869ff79', 'Chiaki', 'Nanami', 1, 5, '753159852', 'aprobado'),
(23, 'alumno11', '3783e5a1ed6a7cf7b7102a881a9abc12', 'Daniel', 'brenes', 1, 1, '456258', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id_asignatura` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id_asignatura`, `nombre`) VALUES
(1, 'Matemáticas'),
(2, 'Español'),
(3, 'Ciencias Naturales'),
(4, 'Historia'),
(5, 'Inglés'),
(6, 'Educacion Fisica'),
(7, 'Artes Plasticas'),
(8, 'Música'),
(9, 'Informatica'),
(10, 'Civica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegio`
--

CREATE TABLE `colegio` (
  `id_colegio` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colegio`
--

INSERT INTO `colegio` (`id_colegio`, `nombre`) VALUES
(1, 'Colegio Christopher Steller');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `falta_asistencia`
--

CREATE TABLE `falta_asistencia` (
  `id_falta` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `justificada` text DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `falta_asistencia`
--

INSERT INTO `falta_asistencia` (`id_falta`, `fecha`, `justificada`, `id_alumno`, `id_asignatura`) VALUES
(21, '2023-08-01', '1', 1, 1),
(22, '2023-08-03', '1', 1, 1),
(23, '2023-08-03', '0', 2, 1),
(24, '2023-08-02', '1', 1, 1),
(25, '2023-08-06', '1', 13, 1),
(26, '2023-08-04', '0', 13, 1),
(27, '2023-08-04', '0', 13, 1),
(28, '2023-08-13', '1', 1, 1),
(29, '2023-08-07', '1', 2, 1),
(30, '2023-08-08', '1', 13, 1),
(31, '2023-08-08', '0', 1, 2),
(32, '2023-08-09', '1', 2, 2),
(33, '2023-08-10', '1', 20, 1),
(34, '2023-08-12', '1', 16, 1),
(35, '2023-08-13', '0', 16, 1),
(36, '2023-08-14', '1', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `dia` varchar(100) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `id_nivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id_horario`, `dia`, `hora_inicio`, `hora_fin`, `id_asignatura`, `id_nivel`) VALUES
(1, 'Lunes', '07:30:00', '09:30:00', 1, 1),
(2, 'Lunes', '09:45:00', '12:30:00', 2, 1),
(3, 'Lunes', '07:30:00', '09:30:00', 3, 2),
(4, 'Lunes', '09:45:00', '12:30:00', 4, 2),
(5, 'Lunes', '07:30:00', '09:30:00', 5, 3),
(6, 'Lunes', '09:45:00', '12:30:00', 6, 3),
(7, 'Lunes', '07:30:00', '09:30:00', 7, 4),
(8, 'Lunes', '09:45:00', '12:30:00', 8, 4),
(9, 'Lunes', '07:30:00', '09:30:00', 9, 5),
(10, 'Lunes', '09:45:00', '12:30:00', 10, 5),
(11, 'Martes', '07:30:00', '09:30:00', 3, 1),
(12, 'Martes\r\n', '09:45:00', '12:30:00', 4, 1),
(13, 'Martes', '07:30:00', '09:30:00', 5, 2),
(14, 'Martes', '09:45:00', '12:30:00', 6, 2),
(15, 'Martes', '07:30:00', '09:30:00', 7, 3),
(16, 'Martes', '09:45:00', '12:30:00', 8, 3),
(17, 'Martes', '07:30:00', '09:30:00', 9, 4),
(18, 'Martes', '09:45:00', '12:30:00', 10, 4),
(19, 'Martes', '07:30:00', '09:30:00', 1, 5),
(20, 'Martes', '09:45:00', '12:30:00', 2, 5),
(21, 'Miercoles', '07:30:00', '09:30:00', 5, 1),
(22, 'Miercoles', '09:45:00', '12:30:00', 6, 1),
(23, 'Miercoles', '07:30:00', '09:30:00', 7, 2),
(24, 'Miercoles', '09:45:00', '12:30:00', 8, 2),
(25, 'Miercoles', '07:30:00', '09:30:00', 9, 3),
(26, 'Miercoles', '09:45:00', '12:30:00', 10, 3),
(27, 'Miercoles', '07:30:00', '09:30:00', 1, 4),
(28, 'Miercoles', '09:45:00', '12:30:00', 2, 4),
(29, 'Miercoles', '07:30:00', '09:30:00', 3, 5),
(30, 'Miercoles', '09:45:00', '12:30:00', 4, 5),
(31, 'Jueves', '07:30:00', '09:30:00', 7, 1),
(32, 'Jueves', '09:45:00', '12:30:00', 8, 1),
(33, 'Jueves', '07:30:00', '09:30:00', 9, 2),
(34, 'Jueves', '09:45:00', '12:30:00', 10, 2),
(35, 'Jueves', '07:30:00', '09:30:00', 1, 3),
(36, 'Jueves', '09:45:00', '12:30:00', 2, 3),
(37, 'Jueves', '07:30:00', '09:30:00', 3, 4),
(38, 'Jueves', '09:45:00', '12:30:00', 4, 4),
(39, 'Jueves', '07:30:00', '09:30:00', 5, 5),
(40, 'Jueves', '09:45:00', '12:30:00', 6, 5),
(41, 'Viernes', '07:30:00', '09:30:00', 9, 1),
(42, 'Viernes', '09:45:00', '12:30:00', 10, 1),
(43, 'Viernes', '07:30:00', '09:30:00', 1, 2),
(44, 'Viernes', '09:45:00', '12:30:00', 2, 2),
(45, 'Viernes', '07:30:00', '09:30:00', 3, 3),
(46, 'Viernes', '09:45:00', '12:30:00', 4, 3),
(47, 'Viernes', '07:30:00', '09:30:00', 5, 4),
(48, 'Viernes', '09:45:00', '12:30:00', 6, 4),
(49, 'Viernes', '07:30:00', '09:30:00', 7, 5),
(50, 'Viernes', '09:45:00', '12:30:00', 8, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `id_matricula` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`id_matricula`, `id_alumno`, `id_asignatura`) VALUES
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 2, 1),
(12, 2, 2),
(13, 2, 3),
(14, 2, 4),
(15, 2, 5),
(16, 2, 6),
(17, 2, 7),
(18, 2, 8),
(19, 2, 9),
(20, 2, 10),
(21, 16, 1),
(22, 16, 2),
(23, 16, 3),
(24, 16, 4),
(26, 13, 2),
(32, 20, 1),
(33, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `id_nivel` int(11) NOT NULL,
  `nivel` varchar(100) DEFAULT NULL,
  `curso` varchar(100) DEFAULT NULL,
  `aula` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`id_nivel`, `nivel`, `curso`, `aula`) VALUES
(1, 'Nivel 7', '1º', 'Aula 1'),
(2, 'Nivel 8', '2º', 'Aula 2'),
(3, 'Nivel 9', '3', 'Aula 3'),
(4, 'Nivel 10', '4', 'Aula 4'),
(5, 'Nivel 11', '5', 'Aula 5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL,
  `trimestre` int(11) DEFAULT NULL,
  `valor` decimal(5,2) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`id_nota`, `trimestre`, `valor`, `id_alumno`, `id_asignatura`) VALUES
(1, 1, 8.00, 1, 1),
(2, 1, 5.50, 2, 1),
(3, 1, 7.70, 1, 2),
(4, 2, 8.00, 1, 1),
(7, 2, 8.00, 2, 1),
(12, 3, 7.00, 1, 1),
(13, 3, 8.00, 2, 1),
(14, 1, 5.00, 16, 1),
(15, 2, 6.90, 1, 2),
(16, 1, 75.00, 2, 2),
(17, 1, 75.00, 16, 2),
(18, 1, 9.00, 20, 1),
(19, 2, 8.00, 16, 1),
(20, 3, 8.00, 16, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padres`
--

CREATE TABLE `padres` (
  `id_padre` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `cedula_padre` varchar(50) DEFAULT NULL,
  `correo_padres` varchar(100) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `contraseña` varchar(50) DEFAULT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `padres`
--

INSERT INTO `padres` (`id_padre`, `nombre`, `apellidos`, `cedula_padre`, `correo_padres`, `login`, `contraseña`, `estado`) VALUES
(1, 'juancho', 'Pérez', '636231', 'p1@gmail.com', 'padre1', 'cbfc28ca8897a8118cad183434142302', 'aprobado'),
(2, 'marcelo', 'ramirez', '664799', 'p2@gmail.com', 'padre2', 'cbfc28ca8897a8118cad183434142302', 'aprobado'),
(7, 'gutavo', 'hernandez', '366831', 'p3@gmail.com', 'padre3', 'cbfc28ca8897a8118cad183434142302', 'aprobado'),
(8, 'Andre', 'Doe', '663862', 'ad@gmail.com', 'padre4', 'cbfc28ca8897a8118cad183434142302', 'aprobado'),
(9, 'Julio', 'Smith', '338388', 'js@gmail.com', 'padre5', 'cbfc28ca8897a8118cad183434142302', 'aprobado'),
(10, 'Oriol', 'Johnson', '880900', 'oj@gmail.com', 'padre6', 'cbfc28ca8897a8118cad183434142302', 'aprobado'),
(11, 'Takefusa', 'lee', '868034', 'tl@gmail.com', 'padre7', 'cbfc28ca8897a8118cad183434142302', 'aprobado'),
(12, 'Satoru', 'Wilson', '634482', 'thehonoredone@gmail.com', 'padre8', 'cbfc28ca8897a8118cad183434142302', 'aprobado'),
(13, 'Ferran', 'Martin', '426859', 'rm@gmail.com', 'padre9', 'cbfc28ca8897a8118cad183434142302', 'aprobado'),
(14, 'Chihiro', 'Nanami', '373314', 'Nanami@gmail.com', 'padre10', 'cbfc28ca8897a8118cad183434142302', 'aprobado'),
(16, 'Naruto', 'Brenes', '000000', 'uzumaki@gmail.com', 'padre11', 'cbfc28ca8897a8118cad183434142302', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id_profesor` int(11) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `contraseña` varchar(50) DEFAULT NULL,
  `nombre_profe` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `especialista` varchar(100) DEFAULT NULL,
  `id_colegio` int(11) DEFAULT 1,
  `id_asignatura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id_profesor`, `login`, `contraseña`, `nombre_profe`, `apellido`, `email`, `especialista`, `id_colegio`, `id_asignatura`) VALUES
(1, 'profemate', '49a34ad909d53623ede8fb7922515e22', 'Pedro', 'Gomez', 'pedrogomez@gmail.com', 'Matemática', 1, 1),
(2, 'ProfeEspañol', '49a34ad909d53623ede8fb7922515e22', 'Tomas', 'Lopez', 'tlopez@gmail.com', 'Español', 1, 2),
(3, 'profeciencias', '49a34ad909d53623ede8fb7922515e22', 'Juana', 'Arguedas', 'juana.arguedas@example.com', 'Ciencias Naturales', 1, 3),
(4, 'profeHistoria', '49a34ad909d53623ede8fb7922515e22', 'kendall', 'garcia', 'kegar@gmail.com', 'Historia', 1, 4),
(5, 'profeingles', '49a34ad909d53623ede8fb7922515e22', 'rebeca', 'conejo', 'rconejo@gmail.com', 'Inglés', 1, 5),
(6, 'profeedufisc', '49a34ad909d53623ede8fb7922515e22', 'Alexander', 'rojas', 'ar@gmail.com', 'Educacion Fisica', 1, 6),
(7, 'profeArte', '49a34ad909d53623ede8fb7922515e22', 'Gabriela', 'Espinoza', 'ge@gmail.com', 'Artes Plasticas', 1, 7),
(8, 'profeMusc', '49a34ad909d53623ede8fb7922515e22', 'Jorge', 'Sayegh', 'jorgelias995@gmail.com', 'Música', 1, 8),
(9, 'profeInfo', '49a34ad909d53623ede8fb7922515e22', 'Randall', 'Asofeifa', 'rf@gmail.com', 'Informatica', 1, 9),
(10, 'profeCivi', '49a34ad909d53623ede8fb7922515e22', 'Jonathan', 'Ugalde', 'jugalde@gmail.com', 'Civica', 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_padres_alumno`
--

CREATE TABLE `relacion_padres_alumno` (
  `id_relacion` int(11) NOT NULL,
  `id_padre` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `relacion_padres_alumno`
--

INSERT INTO `relacion_padres_alumno` (`id_relacion`, `id_padre`, `id_alumno`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 7, 12),
(4, 8, 13),
(5, 9, 15),
(6, 10, 16),
(7, 11, 17),
(8, 12, 18),
(9, 13, 19),
(12, 14, 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_administrador`),
  ADD KEY `id_colegio` (`id_colegio`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`),
  ADD UNIQUE KEY `unique_login` (`login`),
  ADD UNIQUE KEY `unique_cedula` (`cedula_alumno`),
  ADD KEY `id_colegio` (`id_colegio`),
  ADD KEY `id_nivel` (`id_nivel`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id_asignatura`);

--
-- Indices de la tabla `colegio`
--
ALTER TABLE `colegio`
  ADD PRIMARY KEY (`id_colegio`);

--
-- Indices de la tabla `falta_asistencia`
--
ALTER TABLE `falta_asistencia`
  ADD PRIMARY KEY (`id_falta`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `id_nivel` (`id_nivel`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id_matricula`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `padres`
--
ALTER TABLE `padres`
  ADD PRIMARY KEY (`id_padre`),
  ADD UNIQUE KEY `unique_cedula` (`cedula_padre`),
  ADD UNIQUE KEY `unique_correo` (`correo_padres`),
  ADD UNIQUE KEY `unique_login` (`login`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id_profesor`),
  ADD KEY `id_colegio` (`id_colegio`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `relacion_padres_alumno`
--
ALTER TABLE `relacion_padres_alumno`
  ADD PRIMARY KEY (`id_relacion`),
  ADD KEY `id_padre` (`id_padre`),
  ADD KEY `id_alumno` (`id_alumno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `colegio`
--
ALTER TABLE `colegio`
  MODIFY `id_colegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `falta_asistencia`
--
ALTER TABLE `falta_asistencia`
  MODIFY `id_falta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `padres`
--
ALTER TABLE `padres`
  MODIFY `id_padre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id_profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `relacion_padres_alumno`
--
ALTER TABLE `relacion_padres_alumno`
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`id_colegio`) REFERENCES `colegio` (`id_colegio`);

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`id_colegio`) REFERENCES `colegio` (`id_colegio`),
  ADD CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id_nivel`);

--
-- Filtros para la tabla `falta_asistencia`
--
ALTER TABLE `falta_asistencia`
  ADD CONSTRAINT `falta_asistencia_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  ADD CONSTRAINT `falta_asistencia_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `horario_ibfk_2` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id_nivel`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`);

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`);

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`id_colegio`) REFERENCES `colegio` (`id_colegio`),
  ADD CONSTRAINT `profesor_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`);

--
-- Filtros para la tabla `relacion_padres_alumno`
--
ALTER TABLE `relacion_padres_alumno`
  ADD CONSTRAINT `relacion_padres_alumno_ibfk_1` FOREIGN KEY (`id_padre`) REFERENCES `padres` (`id_padre`),
  ADD CONSTRAINT `relacion_padres_alumno_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
