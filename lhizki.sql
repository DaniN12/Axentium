
-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.2.0 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para lhizki
DROP DATABASE IF EXISTS `lhizki`;
CREATE DATABASE IF NOT EXISTS `lhizki` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lhizki`;

-- Volcando estructura para tabla lhizki.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.categorias: ~2 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `nombre`) VALUES
	(1, 'geografia'),
	(2, 'historia');

-- Volcando estructura para tabla lhizki.centros
CREATE TABLE IF NOT EXISTS `centros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `localidad` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.centros: ~2 rows (aproximadamente)
INSERT INTO `centros` (`id`, `nombre`, `localidad`) VALUES
	(1, 'CPES San Luis', 'Bilbao'),
	(2, 'IES Laudio', 'Llodio');

-- Volcando estructura para tabla lhizki.centros_ciclos
CREATE TABLE IF NOT EXISTS `centros_ciclos` (
  `centroId` int NOT NULL,
  `cicloId` int NOT NULL,
  PRIMARY KEY (`centroId`,`cicloId`),
  KEY `FK_centros_ciclos_ciclos` (`cicloId`),
  CONSTRAINT `FK_centros_ciclos_centros` FOREIGN KEY (`centroId`) REFERENCES `centros` (`id`),
  CONSTRAINT `FK_centros_ciclos_ciclos` FOREIGN KEY (`cicloId`) REFERENCES `ciclos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.centros_ciclos: ~4 rows (aproximadamente)
INSERT INTO `centros_ciclos` (`centroId`, `cicloId`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(2, 2);

-- Volcando estructura para tabla lhizki.ciclos
CREATE TABLE IF NOT EXISTS `ciclos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `familiaId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ciclos_familias` (`familiaId`),
  CONSTRAINT `FK_ciclos_familias` FOREIGN KEY (`familiaId`) REFERENCES `familias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.ciclos: ~3 rows (aproximadamente)
INSERT INTO `ciclos` (`id`, `nombre`, `familiaId`) VALUES
	(1, 'DAW', 1),
	(2, 'ADE', 2),
	(3, 'SMR', 1);

-- Volcando estructura para tabla lhizki.familias
CREATE TABLE IF NOT EXISTS `familias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.familias: ~2 rows (aproximadamente)
INSERT INTO `familias` (`id`, `nombre`) VALUES
	(1, 'Informática'),
	(2, 'administración');

-- Volcando estructura para tabla lhizki.glosario
CREATE TABLE IF NOT EXISTS `glosario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `palabra_euskera` varchar(100) NOT NULL,
  `palabra_castellano` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.glosario: ~0 rows (aproximadamente)

-- Volcando estructura para tabla lhizki.juegos
CREATE TABLE IF NOT EXISTS `juegos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `familiaId` int NOT NULL,
  `activo` tinyint NOT NULL DEFAULT '0',
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_juegos_familias` (`familiaId`),
  CONSTRAINT `FK_juegos_familias` FOREIGN KEY (`familiaId`) REFERENCES `familias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.juegos: ~2 rows (aproximadamente)
INSERT INTO `juegos` (`id`, `familiaId`, `activo`, `fecha_inicio`, `fecha_fin`) VALUES
	(28, 1, 1, '2025-11-05 00:00:00', '2025-11-10 00:00:00'),
	(29, 2, 1, '2025-11-05 00:00:00', '2025-11-10 00:00:00');

-- Volcando estructura para tabla lhizki.juegos_preguntas
CREATE TABLE IF NOT EXISTS `juegos_preguntas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `juegoId` int NOT NULL,
  `preguntaId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_juegos_preguntas_juegos` (`juegoId`),
  KEY `FK_juegos_preguntas_preguntas` (`preguntaId`),
  CONSTRAINT `FK_juegos_preguntas_juegos` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`),
  CONSTRAINT `FK_juegos_preguntas_preguntas` FOREIGN KEY (`preguntaId`) REFERENCES `preguntas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.juegos_preguntas: ~4 rows (aproximadamente)
INSERT INTO `juegos_preguntas` (`id`, `juegoId`, `preguntaId`) VALUES
	(35, 28, 3),
	(36, 28, 1),
	(37, 29, 3),
	(38, 29, 2);

-- Volcando estructura para tabla lhizki.preguntas
CREATE TABLE IF NOT EXISTS `preguntas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(200) NOT NULL,
  `opcion1` varchar(200) NOT NULL,
  `opcion2` varchar(200) NOT NULL,
  `opcion3` varchar(200) NOT NULL,
  `correcta` int NOT NULL,
  `usada` tinyint NOT NULL DEFAULT '0',
  `img` varchar(200) DEFAULT NULL,
  `familiaId` int DEFAULT NULL,
  `categoriaId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_preguntas_familias` (`familiaId`),
  KEY `FK_preguntas_categorias` (`categoriaId`),
  CONSTRAINT `FK_preguntas_categorias` FOREIGN KEY (`categoriaId`) REFERENCES `categorias` (`id`),
  CONSTRAINT `FK_preguntas_familias` FOREIGN KEY (`familiaId`) REFERENCES `familias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.preguntas: ~3 rows (aproximadamente)
INSERT INTO `preguntas` (`id`, `pregunta`, `opcion1`, `opcion2`, `opcion3`, `correcta`, `usada`, `img`, `familiaId`, `categoriaId`) VALUES
	(1, 'Traduce: dato de tráfico', 'zirkulazio-kontrol', 'seinale-datu', 'zirkulazio-datu', 3, 0, NULL, 1, NULL),
	(2, 'Traduce: absorción', 'irenspen', 'iragazketa', 'pilaketa', 1, 0, NULL, 2, NULL),
	(3, 'Capital de Uganda', 'Kiev', 'Managua', 'Kampala', 3, 0, NULL, NULL, 1);

-- Volcando estructura para tabla lhizki.preguntas_generales
CREATE TABLE IF NOT EXISTS `preguntas_generales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(200) NOT NULL,
  `opcion1` varchar(200) NOT NULL,
  `opcion2` varchar(200) NOT NULL,
  `opcion3` varchar(200) NOT NULL,
  `correcta` int NOT NULL,
  `usada` tinyint NOT NULL DEFAULT '0',
  `img` varchar(200) DEFAULT NULL,
  `categoriaId` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_preguntas_generales_categorias` (`categoriaId`),
  CONSTRAINT `FK_preguntas_generales_categorias` FOREIGN KEY (`categoriaId`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla lhizki.preguntas_generales: ~0 rows (aproximadamente)

-- Volcando estructura para tabla lhizki.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.roles: ~0 rows (aproximadamente)
INSERT INTO `roles` (`id`, `nombre`) VALUES
	(0, 'sa'),
	(1, 'admin'),
	(2, 'usuario');

-- Volcando estructura para tabla lhizki.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `centroId` int NOT NULL,
  `cicloId` int NOT NULL,
  `rolId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usuarios_centros` (`centroId`),
  KEY `FK_usuarios_ciclos` (`cicloId`),
  KEY `FK_usuarios_roles` (`rolId`),
  CONSTRAINT `FK_usuarios_centros` FOREIGN KEY (`centroId`) REFERENCES `centros` (`id`),
  CONSTRAINT `FK_usuarios_ciclos` FOREIGN KEY (`cicloId`) REFERENCES `ciclos` (`id`),
  CONSTRAINT `FK_usuarios_roles` FOREIGN KEY (`rolId`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.usuarios: ~0 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `centroId`, `cicloId`, `rolId`) VALUES
	(3, 'juan', 'j@email.com', '1234', 1, 1, 2),
	(4, 'ane', 'a@email.com', '1234', 1, 2, 2),
	(5, 'admin', 'admin@email.com', '1234', 1, 1, 1);

-- Volcando estructura para tabla lhizki.usuario_juego
CREATE TABLE IF NOT EXISTS `usuario_juego` (
  `juegoId` int NOT NULL,
  `usuarioId` int NOT NULL,
  `puntuacion` int DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`juegoId`,`usuarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.usuario_juego: ~0 rows (aproximadamente)

-- Volcando estructura para tabla lhizki.usuario_preguntas
CREATE TABLE IF NOT EXISTS `usuario_preguntas` (
  `usuarioId` int NOT NULL,
  `juegoId` int NOT NULL,
  `preguntaId` int NOT NULL,
  `respuesta` int DEFAULT NULL,
  PRIMARY KEY (`usuarioId`,`preguntaId`,`juegoId`) USING BTREE,
  KEY `FK_usuario_preguntas_preguntas` (`preguntaId`),
  KEY `FK_usuario_preguntas_juegos` (`juegoId`),
  CONSTRAINT `FK_usuario_preguntas_juegos` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`),
  CONSTRAINT `FK_usuario_preguntas_preguntas` FOREIGN KEY (`preguntaId`) REFERENCES `preguntas` (`id`),
  CONSTRAINT `FK_usuario_preguntas_usuarios` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.usuario_preguntas: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

