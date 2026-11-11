-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-11-2026 a las 13:37:08
-- Versión del servidor: 8.4.7
-- Versión de PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parcial2_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `imagen` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT 'https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=500',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `categoria`, `descripcion`, `precio`, `stock`, `imagen`) VALUES
(1, 'Llantas R17 Deportivas', 'Ruedas', 'Llantas de aleación rodado 17 multirrayo de aluminio', 185000.00, 8, 'https://http2.mlstatic.com/D_NQ_NP_823594-MLA112462158609_052026-O.webp'),
(2, 'Aceite de Motor 5W30 4L', 'Lubricantes', 'Aceite sintético de máxima protección para motores nafta/diesel', 38000.00, 20, 'https://ar.moovelub.com/storage/uploads/00000001059.png'),
(3, 'Filtro de Aire Alto Flujo', 'Motor', 'Filtro lavable deportivo para mayor rendimiento de motor', 22500.00, 15, 'https://acdn-us.mitiendanube.com/stores/004/843/665/products/img_4436-bl-ed72d7a8b3aeb32ebb17477501529119-1024-1024.webp'),
(4, 'Juego de Faros LED universal', 'Iluminación', 'Kit antiniebla led cree 10000 lumens alta intensidad', 42000.00, 12, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0roeE_N4tSA45RKDuEv1PDGfjDamEaImu1xBrcHy30XyxaZrqCknkhhw&s=10'),
(5, 'Pastillas de Freno Cerámicas', 'Frenos', 'Juego delantero compuesto cerámico para alto frenado', 29500.00, 18, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUiWt_6I8PsXb2O-AFH9inWSUCPqEdgL6AUOt520C2KA&s'),
(6, 'Volante Deportivo De Cuero', 'Accesorios', 'Volante universales en cuero sintético reforzado', 65000.00, 6, 'https://http2.mlstatic.com/D_NQ_NP_848781-CBT115386434651_072026-O.webp'),
(7, 'Cubierta 265/65/17', 'Ruedas', 'Cubiertas Pirelli Scorpion ATR 265/65/17', 230000.00, 24, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSmZOAhMYhv_MGDFmzu4fF_aUAkov0zIq6YllJIu2bAqw&s=10');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
