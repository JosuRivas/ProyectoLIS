-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2021 at 02:42 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aerolinea`
--
CREATE DATABASE IF NOT EXISTS `aerolinea` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `aerolinea`;

-- --------------------------------------------------------

--
-- Table structure for table `aerolinea`
--

CREATE TABLE `aerolinea` (
  `Id_Aerolinea` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Codigo_Area` varchar(3) NOT NULL,
  `Telefono` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `Id_Cliente` int(11) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `Edad` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pago`
--

CREATE TABLE `pago` (
  `Id_Pago` int(11) NOT NULL,
  `Monto` double NOT NULL,
  `Numero_Comprobante` int(11) NOT NULL,
  `Id_Pasaje` int(11) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pasaje`
--

CREATE TABLE `pasaje` (
  `Id_Pasaje` int(11) NOT NULL,
  `Id_Cliente` int(11) NOT NULL,
  `Id_vuelo` int(11) NOT NULL,
  `Clase` varchar(5) NOT NULL,
  `Asiento` varchar(10) NOT NULL,
  `Monto` double NOT NULL,
  `Pasaporte` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_Usuario` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `Tipo_User` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vuelo`
--

CREATE TABLE `vuelo` (
  `Id_Vuelo` int(11) NOT NULL,
  `Id_Aerolinea` int(11) NOT NULL,
  `Capacidad` int(11) NOT NULL,
  `Origen` varchar(100) NOT NULL,
  `Destino` varchar(100) NOT NULL,
  `Fecha_salida` date NOT NULL,
  `Hora` varchar(10) NOT NULL,
  `Numero_Vuelo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aerolinea`
--
ALTER TABLE `aerolinea`
  ADD PRIMARY KEY (`Id_Aerolinea`),
  ADD UNIQUE KEY `telefono_unique` (`Telefono`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id_Cliente`),
  ADD UNIQUE KEY `email_unique` (`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`Id_Pago`),
  ADD UNIQUE KEY `comprobante_unique` (`Numero_Comprobante`),
  ADD KEY `Id_Pasaje` (`Id_Pasaje`) USING BTREE;

--
-- Indexes for table `pasaje`
--
ALTER TABLE `pasaje`
  ADD PRIMARY KEY (`Id_Pasaje`),
  ADD KEY `Id_Cliente` (`Id_Cliente`) USING BTREE,
  ADD KEY `Id_vuelo` (`Id_vuelo`) USING BTREE;

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_Usuario`);

--
-- Indexes for table `vuelo`
--
ALTER TABLE `vuelo`
  ADD PRIMARY KEY (`Id_Vuelo`),
  ADD KEY `Id_Aerolinea` (`Id_Aerolinea`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aerolinea`
--
ALTER TABLE `aerolinea`
  MODIFY `Id_Aerolinea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `Id_Cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pago`
--
ALTER TABLE `pago`
  MODIFY `Id_Pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pasaje`
--
ALTER TABLE `pasaje`
  MODIFY `Id_Pasaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vuelo`
--
ALTER TABLE `vuelo`
  MODIFY `Id_Vuelo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`Id_Pasaje`) REFERENCES `pasaje` (`Id_Pasaje`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pasaje`
--
ALTER TABLE `pasaje`
  ADD CONSTRAINT `pasaje_ibfk_1` FOREIGN KEY (`Id_Cliente`) REFERENCES `cliente` (`Id_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pasaje_ibfk_2` FOREIGN KEY (`Id_vuelo`) REFERENCES `vuelo` (`Id_Vuelo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vuelo`
--
ALTER TABLE `vuelo`
  ADD CONSTRAINT `vuelo_ibfk_1` FOREIGN KEY (`Id_Aerolinea`) REFERENCES `aerolinea` (`Id_Aerolinea`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
