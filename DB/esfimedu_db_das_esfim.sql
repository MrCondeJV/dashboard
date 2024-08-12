-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2024 at 05:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esfimedu_db_das_esfim`
--

-- --------------------------------------------------------

--
-- Table structure for table `historial`
--

CREATE TABLE `historial` (
  `ID` int(11) NOT NULL,
  `cod_ticket` varchar(100) NOT NULL,
  `fecha_prestamo` varchar(100) NOT NULL,
  `solicitante` varchar(100) NOT NULL,
  `aula_solicitada` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_inicial` varchar(30) NOT NULL,
  `fecha_final` varchar(30) NOT NULL,
  `aprueba` varchar(50) NOT NULL,
  `estado` enum('Aprobada','Rechazada','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historial`
--

INSERT INTO `historial` (`ID`, `cod_ticket`, `fecha_prestamo`, `solicitante`, `aula_solicitada`, `cantidad`, `fecha_inicial`, `fecha_final`, `aprueba`, `estado`) VALUES
(31, '33', '2024-06-19 08:07:47', 'Juan Sebastian Salive Triana', 'Centro de Convenciones', 0, '2024-06-20 09:00:00', '2024-06-20 10:00:00', 'Giver Mora', 'Aprobada'),
(32, '34', '2024-06-19 08:52:42', 'JOHN EDWAR JIMENEZ CUESTA', 'Aula Maxima', 0, '2024-06-19 07:00:00', '2024-06-20 11:00:00', 'Andres Mora', 'Aprobada'),
(33, '35', '2024-06-24 11:44:14', 'JOHN EDWAR JIMENEZ CUESTA', 'Centro de Convenciones', 0, '2024-06-28 09:30:00', '2024-06-28 11:31:00', 'Tellys Paternina', 'Aprobada'),
(34, '36', '2024-06-24 11:54:27', 'Tellys Paternina', 'Centro de Convenciones', 0, '2024-06-25 07:45:00', '2024-06-25 10:01:00', 'Tellys Paternina', 'Aprobada'),
(35, '37', '2024-06-24 16:30:51', 'SVIF RIVERA LLORENTE JAIRO', 'Centro de Convenciones', 0, '2024-06-26 15:00:00', '2024-06-26 17:00:00', 'Tellys Paternina', 'Aprobada'),
(36, '38', '2024-07-16 11:36:40', 'LUIS ALBERTO RUIZ ZAMORA', 'Aula Maxima', 0, '2024-07-17 18:01:00', '2024-07-17 20:00:00', 'Giver Mora', 'Aprobada'),
(37, '39', '2024-07-25 14:27:29', 'TN GRANADOS ARAUJO CRISTIAN CAMILO', 'Aula Maxima', 0, '2024-07-25 16:00:00', '2024-07-25 18:00:00', 'Giver Mora', 'Aprobada'),
(38, '40', '2024-07-25 17:40:48', 'JOSE MANUEL ARBOLEDA MICHAELS', 'Centro de Convenciones', 0, '2024-07-26 07:00:00', '2024-07-26 09:00:00', 'Giver Mora', 'Aprobada'),
(39, '43', '2024-08-05 09:55:58', 'Tellys Paternina', 'Centro de Convenciones', 0, '2024-08-26 09:57:00', '2024-09-01 09:57:00', 'Tellys Paternina', 'Aprobada'),
(40, '41', '2024-08-05 14:06:20', 'PEREZ QUIÃ‘ONES YORDY HORLANDO', 'Centro de Convenciones', 0, '2024-08-05 14:00:00', '2024-08-05 16:30:00', 'Giver Mora', 'Aprobada'),
(41, '42', '2024-08-06 10:00:33', 'Leonardo Fabio Meza RodrÃ­guez ', 'Aula Maxima', 0, '2024-08-05 07:30:00', '2024-08-05 12:30:00', 'Alexis Ruiz', 'Aprobada'),
(42, '44', '2024-08-06 14:50:44', 'MASSIEL MIRANDA YANES ', 'Centro de Convenciones', 0, '2024-09-03 08:15:00', '2024-09-03 09:40:00', 'Giver Mora', 'Aprobada'),
(43, '45', '2024-08-06 14:50:49', 'MASSIEL MIRANDA YANES ', 'Centro de Convenciones', 0, '2024-09-10 08:15:00', '2024-09-10 09:40:00', 'Giver Mora', 'Aprobada'),
(44, '46', '2024-08-12 17:09:15', 'MASSIEL MIRANDA YANES ', 'Centro de Convenciones', 0, '2024-08-23 07:00:00', '2024-08-23 08:30:00', 'Luis Barrios', 'Aprobada'),
(45, '47', '2024-08-12 17:11:30', 'MASSIEL MIRANDA YANES ', 'Aula Maxima', 35, '2024-08-16 08:00:00', '2024-08-16 09:00:00', 'Luis Barrios', 'Aprobada');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`ID`, `Nombre`) VALUES
(1, 'Administrador'),
(2, 'Observador'),
(3, 'Validador');

-- --------------------------------------------------------

--
-- Table structure for table `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `nro_documento` varchar(20) NOT NULL,
  `nombre_solicitante` varchar(200) NOT NULL,
  `unidad_trabajo` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `aula` varchar(30) NOT NULL,
  `descripcion_evento` varchar(500) NOT NULL,
  `cantidad_personas` int(11) NOT NULL,
  `fecha_inicial` datetime NOT NULL,
  `fecha_final` datetime NOT NULL,
  `docPdf` mediumblob NOT NULL,
  `estado` enum('Aprobada','Rechazada','','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ID` int(11) NOT NULL,
  `cod_ticket` varchar(100) NOT NULL,
  `nombre_ticket` varchar(100) NOT NULL,
  `fecha_ticket` date NOT NULL,
  `usuario_aprueba` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Usuario` varchar(250) DEFAULT NULL,
  `contrasena` varchar(250) DEFAULT NULL,
  `ID_Rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Nombre`, `Usuario`, `contrasena`, `ID_Rol`) VALUES
(1, 'Luis Barrios', 'luis.barrios', '9ca069fd2ed5a65f521770dbcd39a7c4764e3053', 1),
(5, 'Diana Garcia', 'diana.garcia', '231af8a6ae04ff46eb249861ba81da41394b97a9', 1),
(6, 'Luis Ocampo', 'luis.ocampo', 'ef73af4619e7a1203464ff8dad0a4d570b068d1c', 2),
(7, 'Tellys Paternina', 'tellys.alexis', 'a9c8cafe363d46922ff0c57d196a773cc6e59d80', 1),
(16, 'Giver Mora', 'g.mora', '377e53fe9105405413479aa8b27cdb1c41939df3', 3),
(18, 'Alexis Ruiz', 'alexis.ruiz', '0472505ae447c28793e3f8959307f79b96a6e23a', 3),
(20, 'Jonathan Rodriguez', 'jonathan.rodriguez', 'eeef8a3f8f6e560d08001a3637dff4aa879cb391', 3),
(21, 'Andres Mora', 'andres.mora1', '5bc616ac0757dbd80d3345e9d2b18822356c8d8f', 3),
(22, 'Gilson Aranda', 'gilson.aranda', '7dd0e5171b78c2351be8d55c55055ae0114b3afb', 3),
(23, 'pepito', 'pepito', 'd4159a4b5af79458762954e1c804c809dcc2c758', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Rol` (`ID_Rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historial`
--
ALTER TABLE `historial`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ID_Rol`) REFERENCES `rol` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
