-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2018 a las 08:36:22
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `phpzag_demos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shop_products`
--

CREATE TABLE `shop_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_desc` text NOT NULL,
  `product_code` varchar(60) NOT NULL,
  `product_image` varchar(60) NOT NULL,
  `product_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `shop_products`
--

INSERT INTO `shop_products` (`id`, `product_name`, `product_desc`, `product_code`, `product_image`, `product_price`) VALUES
(1, 'Ali', 'Link from The Legend of Zelda Majora\'s Mask', '2000', 'AliPNG.png', 64),
(2, 'Ali Transformada', 'Link from The Legend of Zelda Wind Waker', '2003', 'AliTransformada.png', 128),
(3, 'Coneja', 'Zelda from The Legend of Zelda Wind Waker', '2004', 'ConejaPNG.png', 128),
(4, 'Flor', 'Link from the Legend of Zelda Breath of the Wild', '2017', 'Flor.png', 256),
(5, 'Jessi', 'Marth from Fire Emblem', '1', 'JessiPNG.png', 128),
(6, 'Lila', 'Lina from Slayers', '2', 'LilaBatalla.png', 32),
(7, 'Lucas', 'Lillie from Pokemon Sun/Moon', '3', 'LucasFrente.png', 256),
(8, 'Margarito', 'D.Va from OverWatch', '4', 'MargaritoPng.png', 256),
(9, 'Sabio', 'Ryuko from KLK', '5', 'SABIOFrente.png', 32);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `shop_products`
--
ALTER TABLE `shop_products`
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
