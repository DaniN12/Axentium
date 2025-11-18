-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.2.0 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
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
CREATE DATABASE IF NOT EXISTS `lhizki` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lhizki`;

-- Volcando estructura para tabla lhizki.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.categorias: ~6 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `nombre`) VALUES
	(1, 'geografia'),
	(2, 'historia'),
	(3, 'animales'),
	(4, 'personas'),
	(5, 'objetos'),
	(6, 'matematicas');

-- Volcando estructura para tabla lhizki.centros
CREATE TABLE IF NOT EXISTS `centros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `localidad` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.centros: ~3 rows (aproximadamente)
INSERT INTO `centros` (`id`, `nombre`, `localidad`) VALUES
	(1, 'CPES San Luis', 'Bilbao'),
	(2, 'IES Laudio', 'Llodio'),
	(3, 'CIFP Tartanga LHII', 'Erandio');

-- Volcando estructura para tabla lhizki.centros_ciclos
CREATE TABLE IF NOT EXISTS `centros_ciclos` (
  `centroId` int NOT NULL,
  `cicloId` int NOT NULL,
  PRIMARY KEY (`centroId`,`cicloId`),
  KEY `FK_centros_ciclos_ciclos` (`cicloId`),
  CONSTRAINT `FK_centros_ciclos_centros` FOREIGN KEY (`centroId`) REFERENCES `centros` (`id`),
  CONSTRAINT `FK_centros_ciclos_ciclos` FOREIGN KEY (`cicloId`) REFERENCES `ciclos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.centros_ciclos: ~10 rows (aproximadamente)
INSERT INTO `centros_ciclos` (`centroId`, `cicloId`) VALUES
	(1, 1),
	(2, 1),
	(1, 3),
	(3, 4),
	(1, 5),
	(1, 6),
	(1, 7),
	(1, 8),
	(1, 9),
	(1, 10);

-- Volcando estructura para tabla lhizki.ciclos
CREATE TABLE IF NOT EXISTS `ciclos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `familiaId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ciclos_familias` (`familiaId`),
  CONSTRAINT `FK_ciclos_familias` FOREIGN KEY (`familiaId`) REFERENCES `familias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.ciclos: ~9 rows (aproximadamente)
INSERT INTO `ciclos` (`id`, `nombre`, `familiaId`) VALUES
	(1, 'DAW', 1),
	(3, 'SMR', 1),
	(4, 'DAM', 1),
	(5, 'ASIR', 1),
	(6, 'Gestión Administrativa', 2),
	(7, 'Administración y Finanzas', 2),
	(8, 'Actividades Comerciales', 4),
	(9, 'Marketing y Publicidad', 4),
	(10, 'Integración social', 3);

-- Volcando estructura para tabla lhizki.familias
CREATE TABLE IF NOT EXISTS `familias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.familias: ~4 rows (aproximadamente)
INSERT INTO `familias` (`id`, `nombre`) VALUES
	(1, 'Informática y comunicaciones'),
	(2, 'Administración y gestión'),
	(3, 'Servicios socioculturales y a la comunidad'),
	(4, 'Comercio y marketing');

-- Volcando estructura para tabla lhizki.glosario
CREATE TABLE IF NOT EXISTS `glosario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `palabra_euskera` varchar(100) NOT NULL,
  `palabra_castellano` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.glosario: ~27 rows (aproximadamente)
INSERT INTO `glosario` (`id`, `palabra_euskera`, `palabra_castellano`) VALUES
	(2, 'hezkuntza', 'educación'),
	(3, 'gako-hitz', 'palabra clave'),
	(4, 'informatika', 'informática'),
	(5, 'eragile', 'operador'),
	(6, 'arau orokor', 'norma general'),
	(7, 'atal', 'apartado'),
	(8, 'adimen artifizial', 'inteligencia artificial'),
	(9, 'bilaketa', 'búsqueda'),
	(10, 'zerrenda', 'lista'),
	(11, 'egitura', 'estructura'),
	(12, 'luzapen', 'extensión'),
	(13, 'helbide', 'dirección'),
	(14, 'zirkulazio-datu', 'dato de tráfico'),
	(15, 'sagu', 'ratón'),
	(16, 'zor', 'deuda'),
	(17, 'merkataritza', 'comercio'),
	(18, 'jarduera', 'actividad'),
	(19, 'etekin', 'beneficio'),
	(20, 'bezero', 'cliente'),
	(21, 'eraso', 'agresión'),
	(22, 'ikasle', 'alumnado'),
	(23, 'ongizate', 'bienestar'),
	(24, 'sormen', 'creatividad'),
	(25, 'gatazka', 'conflicto'),
	(26, 'nerabe', 'adolescente'),
	(27, 'produktu gatibu', 'producto cautivo'),
	(28, 'ukiezintasun', 'intangibilidad');

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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.juegos: ~4 rows (aproximadamente)
INSERT INTO `juegos` (`id`, `familiaId`, `activo`, `fecha_inicio`, `fecha_fin`) VALUES
	(77, 1, 0, '2025-11-10 00:00:00', '2025-11-16 00:00:00'),
	(78, 2, 0, '2025-11-10 00:00:00', '2025-11-16 00:00:00'),
	(79, 3, 0, '2025-11-10 00:00:00', '2025-11-16 00:00:00'),
	(80, 4, 0, '2025-11-10 00:00:00', '2025-11-16 00:00:00');

-- Volcando estructura para tabla lhizki.juegos_preguntas
CREATE TABLE IF NOT EXISTS `juegos_preguntas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `juegoId` int NOT NULL,
  `preguntaId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_juegos_preguntas_juegos` (`juegoId`),
  KEY `FK_juegos_preguntas_preguntas` (`preguntaId`),
  CONSTRAINT `FK_juegos_preguntas_juegos` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_juegos_preguntas_preguntas` FOREIGN KEY (`preguntaId`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=373 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.juegos_preguntas: ~40 rows (aproximadamente)
INSERT INTO `juegos_preguntas` (`id`, `juegoId`, `preguntaId`) VALUES
	(323, 77, 244),
	(324, 77, 132),
	(325, 77, 243),
	(326, 77, 143),
	(327, 77, 240),
	(328, 77, 126),
	(329, 77, 245),
	(330, 77, 134),
	(331, 77, 237),
	(332, 77, 118),
	(333, 78, 244),
	(334, 78, 170),
	(335, 78, 243),
	(336, 78, 165),
	(337, 78, 240),
	(338, 78, 148),
	(339, 78, 245),
	(340, 78, 155),
	(341, 78, 237),
	(342, 78, 164),
	(343, 79, 244),
	(344, 79, 176),
	(345, 79, 243),
	(346, 79, 188),
	(347, 79, 240),
	(348, 79, 183),
	(349, 79, 245),
	(350, 79, 177),
	(351, 79, 237),
	(352, 79, 190),
	(353, 80, 244),
	(354, 80, 214),
	(355, 80, 243),
	(356, 80, 218),
	(357, 80, 240),
	(358, 80, 221),
	(359, 80, 245),
	(360, 80, 229),
	(361, 80, 237),
	(362, 80, 215);

-- Volcando estructura para tabla lhizki.notificaciones
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `texto` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.notificaciones: ~1 rows (aproximadamente)
INSERT INTO `notificaciones` (`id`, `texto`, `fecha`) VALUES
	(1, 'Ongi etorri LHizki-ra!', '2025-11-15 23:46:35'),
	(2, '¡Nuevo juego de la semana! Asteko jolas berria!', '2025-11-18 01:20:37');

-- Volcando estructura para tabla lhizki.partidas
CREATE TABLE IF NOT EXISTS `partidas` (
  `juegoId` int NOT NULL,
  `usuarioId` int NOT NULL,
  `puntuacion` int DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`juegoId`,`usuarioId`),
  CONSTRAINT `FK_partidas_juegos` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.partidas: ~7 rows (aproximadamente)
INSERT INTO `partidas` (`juegoId`, `usuarioId`, `puntuacion`, `fecha`) VALUES
	(77, 6, 483, '2025-11-17 23:57:32'),
	(77, 8, 787, '2025-11-10 23:51:05'),
	(77, 11, 488, '2025-11-17 23:54:22'),
	(77, 12, 788, '2025-11-10 23:55:58'),
	(78, 4, 583, '2025-11-17 23:43:37'),
	(78, 13, 786, '2025-11-17 23:47:42'),
	(79, 9, 986, '2025-11-17 23:49:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.preguntas: ~130 rows (aproximadamente)
INSERT INTO `preguntas` (`id`, `pregunta`, `opcion1`, `opcion2`, `opcion3`, `correcta`, `usada`, `img`, `familiaId`, `categoriaId`) VALUES
	(116, 'ámbito de uso', 'erabileraeremu', 'erabilera-eremu', 'erabilera-ezparru', 2, 0, NULL, 1, NULL),
	(117, 'alinear', 'lerrokatu', 'errokatu', 'berdindu', 1, 0, NULL, 1, NULL),
	(118, 'auditoría interna', 'barne-auditoria', 'kanpo-auditoria', 'barneauditoria', 1, 1, NULL, 1, NULL),
	(119, 'búsqueda', 'kontaketa', 'bilaketa', 'bilatu', 2, 0, NULL, 1, NULL),
	(120, 'celda', 'gelaxka', 'zutabe', 'zelda', 1, 0, NULL, 1, NULL),
	(121, 'código', 'seinale', 'kode', 'arau', 2, 0, NULL, 1, NULL),
	(122, 'criterio general', 'baldintza', 'ikuspegi', 'irizpide orokor', 3, 0, NULL, 1, NULL),
	(123, 'dato de tráfico', 'zirkulazio-kontrol', 'seinale-datu', 'zirkulazio-datu', 3, 0, NULL, 1, NULL),
	(124, 'deterioro grave', 'narriadura larri', 'kalte arina', 'higadura', 1, 0, NULL, 1, NULL),
	(125, 'dirección', 'helbide', 'bide', 'kokapen', 1, 0, NULL, 1, NULL),
	(126, 'enlace', 'esteka', 'lokarri', 'hari', 1, 1, NULL, 1, NULL),
	(127, 'escritorio', 'bulego', 'mahai', 'mahaigain', 3, 0, NULL, 1, NULL),
	(128, 'estructura', 'eraikuntza', 'egitura', 'osaketa', 2, 0, NULL, 1, NULL),
	(129, 'extensión', 'handipen', 'luzapen', 'osagarri', 2, 0, NULL, 1, NULL),
	(130, 'fila', 'zutabe', 'errenkada', 'multzo', 2, 0, NULL, 1, NULL),
	(131, 'hoja de contenido', 'eduki-orri', 'aurkibide', 'eskuliburu', 1, 0, NULL, 1, NULL),
	(132, 'host', 'arduraduna', 'ostalari', 'ostatu', 2, 1, NULL, 1, NULL),
	(133, 'inteligencia artificial', 'adimen natural', 'adimen-natural', 'adimen artifizial', 3, 0, NULL, 1, NULL),
	(134, 'lenguaje asp', 'asp-lengoaia', 'asp lengoaia', 'asp lingoaia', 2, 1, NULL, 1, NULL),
	(135, 'librería', 'fitxategi', 'liburutegi', 'biltegi', 2, 0, NULL, 1, NULL),
	(136, 'lista', 'zerrenda', 'multzo', 'erregistro', 1, 0, NULL, 1, NULL),
	(137, 'marcador', 'fitxa', 'markatzaile', 'indikatzaile', 2, 0, NULL, 1, NULL),
	(138, 'nivel de suelo', 'zoru-maila', 'soru-maila', 'maila altua', 1, 0, NULL, 1, NULL),
	(139, 'norma general', 'arau orokor', 'arau zehatz', 'irizpide orokor', 1, 0, NULL, 1, NULL),
	(140, 'operador', 'erabiltzaile', 'kudeatzaile', 'eragile', 3, 0, NULL, 1, NULL),
	(141, 'página', 'dokumentu', 'fitxa', 'orri', 3, 0, NULL, 1, NULL),
	(142, 'página principal', 'sarrera', 'atari', 'orri nagusi', 3, 0, NULL, 1, NULL),
	(143, 'palabra clave', 'gako-hitz', 'pasahitz', 'seinale', 1, 1, NULL, 1, NULL),
	(144, 'puerto', 'ataka', 'ibilbide', 'atal', 1, 0, NULL, 1, NULL),
	(145, 'ratón', 'botoi', 'sagu', 'teklatu', 2, 0, NULL, 1, NULL),
	(146, 'absorción', 'irenspen', 'iragazketa', 'pilaketa', 1, 0, NULL, 2, NULL),
	(147, 'acreedor', 'hartzekodun', 'ordaintzaile', 'zorpetu', 1, 0, NULL, 2, NULL),
	(148, 'actividad', 'ekintza', 'jarduera', 'lana', 2, 1, NULL, 2, NULL),
	(149, 'antigüedad', 'historia', 'antsinatasun', 'antzinatasun', 3, 0, NULL, 2, NULL),
	(150, 'apartado', 'eremu', 'atal', 'kutxa', 2, 0, NULL, 2, NULL),
	(151, 'asiento de ajuste', 'doikuntza-idazpen', 'kontu-lerro', 'erregistro', 1, 0, NULL, 2, NULL),
	(152, 'auditoría', 'azterketa', 'berrikuspen', 'ikuskaritza', 3, 0, NULL, 2, NULL),
	(153, 'autorización', 'baimen', 'agindu', 'ziurtagiri', 1, 0, NULL, 2, NULL),
	(154, 'base', 'oinarri', 'azpiegitura', 'hondo', 1, 0, NULL, 2, NULL),
	(155, 'base imponible', 'zerga-kuota', 'zerga-oinarri', 'tasa-maila', 2, 1, NULL, 2, NULL),
	(156, 'beneficio', 'sarrera', 'gastu', 'etekin', 3, 0, NULL, 2, NULL),
	(157, 'bien', 'ondasun', 'zerbitzu', 'produktu', 1, 0, NULL, 2, NULL),
	(158, 'bolsa', 'burtsa', 'karpeta', 'pakete', 1, 0, NULL, 2, NULL),
	(159, 'caja', 'kutxa', 'poltsa', 'karpeta', 1, 0, NULL, 2, NULL),
	(160, 'carta', 'agiri', 'gutun', 'nota', 2, 0, NULL, 2, NULL),
	(161, 'CIF', 'IFK', 'NAN', 'KPI', 1, 0, NULL, 2, NULL),
	(162, 'cliente', 'erabiltzaile', 'hornitzaile', 'bezero', 3, 0, NULL, 2, NULL),
	(163, 'cobertura', 'estaldura', 'hedadura', 'aseguramendu', 1, 0, NULL, 2, NULL),
	(164, 'comercio', 'merkataritza', 'industria', 'negozio', 1, 1, NULL, 2, NULL),
	(165, 'compra', 'eskaintza', 'erosketa', 'kontratazio', 2, 1, NULL, 2, NULL),
	(166, 'concesión', 'lizentzia', 'kontratu', 'emakida', 3, 0, NULL, 2, NULL),
	(167, 'convenio', 'kontratu', 'hitzarmen', 'araudi', 2, 0, NULL, 2, NULL),
	(168, 'cónyuge', 'senide', 'ezkontide', 'lagun', 2, 0, NULL, 2, NULL),
	(169, 'corte', 'ebaki', 'txanda', 'banaketa', 1, 0, NULL, 2, NULL),
	(170, 'departamento', 'sail', 'unitate', 'bulego', 1, 1, NULL, 2, NULL),
	(171, 'depósito', 'biltegi', 'fondo', 'gordailu', 3, 0, NULL, 2, NULL),
	(172, 'deuda', 'gastu', 'zor', 'kreditu', 2, 0, NULL, 2, NULL),
	(173, 'día natural', 'lanegun', 'egun natural', 'jai-egun', 2, 0, NULL, 2, NULL),
	(174, 'discapacidad', 'mugikortasun', 'ezintasun', 'ezintasun', 2, 0, NULL, 2, NULL),
	(175, 'ejercicio', 'ekitaldi', 'jarduera', 'saio', 1, 0, NULL, 2, NULL),
	(176, 'acogida', 'harrera', 'laguntza', 'topaketa', 1, 1, NULL, 3, NULL),
	(177, 'actitud', 'izaera', 'jarrera', 'ohitura', 2, 1, NULL, 3, NULL),
	(178, 'adaptación', 'egokitzapen', 'aldaketa', 'prestaketa', 1, 0, NULL, 3, NULL),
	(179, 'adolescente', 'haur', 'gazte', 'nerabe', 3, 0, NULL, 3, NULL),
	(180, 'agresión', 'gatazka', 'eraso', 'eztabaida', 2, 0, NULL, 3, NULL),
	(181, 'alimentación', 'otordu', 'elikadura', 'sukaldaritza', 2, 0, NULL, 3, NULL),
	(182, 'alojamiento', 'ostatu', 'gela', 'gelaxka', 1, 0, NULL, 3, NULL),
	(183, 'alumnado', 'ikastaro', 'klase', 'ikasle', 3, 1, NULL, 3, NULL),
	(184, 'amenaza', 'beldur', 'mehatxu', 'zigor', 2, 0, NULL, 3, NULL),
	(185, 'amistad', 'harreman', 'adiskidetasun', 'senidetasun', 2, 0, NULL, 3, NULL),
	(186, 'apego', 'harreman', 'maitasun', 'atxikimendu', 3, 0, NULL, 3, NULL),
	(187, 'apoyo', 'laguntza', 'sendotasun', 'konfiantza', 1, 0, NULL, 3, NULL),
	(188, 'asesoramiento', 'prestakuntza', 'ikasketa', 'aholkularitza', 3, 1, NULL, 3, NULL),
	(189, 'aula', 'klase', 'ikastoki', 'gela', 3, 0, NULL, 3, NULL),
	(190, 'barrio', 'auzo', 'herri', 'hiri', 1, 1, NULL, 3, NULL),
	(191, 'bienestar', 'ongisate', 'ongizate', 'lasaitasun', 2, 0, NULL, 3, NULL),
	(192, 'canica', 'pustarri', 'puxtarri', 'puxtaharri', 2, 0, NULL, 3, NULL),
	(193, 'carnaval', 'hinauteri', 'ihinauteri', 'inauteri', 3, 0, NULL, 3, NULL),
	(194, 'cesión', 'salmenta', 'lagapen', 'transferentzia', 2, 0, NULL, 3, NULL),
	(195, 'conducta', 'jarrera', 'ohitura', 'harrera', 1, 0, NULL, 3, NULL),
	(196, 'conferencia', 'hitzaldi', 'bilera', 'aurkezpen', 1, 0, NULL, 3, NULL),
	(197, 'conflicto', 'borroka', 'tentsio', 'gatazka', 3, 0, NULL, 3, NULL),
	(198, 'creatividad', 'sormen', 'adimen', 'inspirazio', 1, 0, NULL, 3, NULL),
	(199, 'crecimiento', 'hazkuntza', 'garapen', 'azkuntza', 1, 0, NULL, 3, NULL),
	(200, 'cuento', 'histori', 'ipuin', 'historia', 2, 0, NULL, 3, NULL),
	(201, 'cuidado', 'zaintza', 'laguntza', 'prebentzio', 1, 0, NULL, 3, NULL),
	(202, 'cuna', 'sehaska', 'seaska', 'zehaska', 1, 0, NULL, 3, NULL),
	(203, 'curso', 'ikastaro', 'ikasgai', 'ikasketa', 1, 0, NULL, 3, NULL),
	(204, 'dependencia', 'mendekotazun', 'mendekotasun', 'erlazio', 2, 0, NULL, 3, NULL),
	(205, 'derecho', 'arau', 'eskubide', 'ezkubide', 2, 0, NULL, 3, NULL),
	(206, 'variabilidad', 'aldakortasun', 'aldekortasun', 'egonkortasun', 1, 0, NULL, 4, NULL),
	(207, 'inseparabilidad', 'banaestazun', 'banaezintasun', 'bateragarritasun', 2, 0, NULL, 4, NULL),
	(208, 'novedad', 'ohikotasun', 'berritasun', 'berritazun', 2, 0, NULL, 4, NULL),
	(209, 'declive', 'ganbehera', 'gainbehera', 'gorakada', 2, 0, NULL, 4, NULL),
	(210, 'madurez', 'gaztetasun', 'gastetasun', 'heldutasun', 3, 0, NULL, 4, NULL),
	(211, 'caducidad', 'galkortasun', 'iraunkortasun', 'iraungitasun', 1, 0, NULL, 4, NULL),
	(212, 'imagen de marca', 'marka-irudi', 'markairudi', 'marka-izudi', 1, 0, NULL, 4, NULL),
	(213, 'lanzamiento', 'merkataritza', 'merkaturatze', 'merkaturazte', 2, 0, NULL, 4, NULL),
	(214, 'prueba', 'probaze', 'saiakuntza', 'probatze', 3, 1, NULL, 4, NULL),
	(215, 'producto cautivo', 'produktogaitibu', 'produktu lotu', 'produktu gatibu', 3, 1, NULL, 4, NULL),
	(216, 'servicio posventa', 'salduosteko laguntza', 'saldu osteko zerbitzu', 'saldu osteko arreta', 2, 0, NULL, 4, NULL),
	(217, 'intangibilidad', 'ukigarritasun', 'hukiezintasun', 'ukiezintasun', 3, 0, NULL, 4, NULL),
	(218, 'sobreprecio', 'gehigarri', 'gainprezio', 'gainkostu', 2, 1, NULL, 4, NULL),
	(219, 'fijación de precios', 'prezio-ezarpen', 'prezioen kontrola', 'prezio-politika', 1, 0, NULL, 4, NULL),
	(220, 'precio promocional', 'sustapen-prezio', 'eskaintza berezi', 'deskontu-prezio', 1, 0, NULL, 4, NULL),
	(221, 'distribución', 'zabalpena', 'banaketa', 'sabalpena', 2, 1, NULL, 4, NULL),
	(222, 'distribuidor', 'hornitzaile', 'bitartekari', 'banatzaile', 3, 0, NULL, 4, NULL),
	(223, 'intermediario', 'agente', 'ordezkari', 'bitartekari', 3, 0, NULL, 4, NULL),
	(224, 'cadena de tiendas', 'denda-kate', 'denda multzo', 'dendakate', 1, 0, NULL, 4, NULL),
	(225, 'escaparate', 'erakusleiho', 'erakusgela', 'erakusleio', 1, 0, NULL, 4, NULL),
	(226, 'mayorista', 'enpresari', 'handizkari', 'saltzaile', 2, 0, NULL, 4, NULL),
	(227, 'conflicto', 'eztabaida', 'gatazka', 'gataska', 2, 0, NULL, 4, NULL),
	(228, 'venta a granel', 'saltze', 'solteko salmeta', 'soltako salmeta', 2, 0, NULL, 4, NULL),
	(229, 'minorista', 'txikizkari', 'txikiskari', 'denda-kudeatzaile', 1, 1, NULL, 4, NULL),
	(230, 'DAFO', 'AIMA', 'AMYA', 'AMIA', 3, 0, NULL, 4, NULL),
	(231, 'imagen', 'irudi', 'ikuspegi', 'iduri', 1, 0, NULL, 4, NULL),
	(232, 'receptor', 'hartzaile', 'jasotzaile', 'entzule', 1, 0, NULL, 4, NULL),
	(233, 'promoción', 'publizitate', 'kanpaina', 'sustapen', 3, 0, NULL, 4, NULL),
	(234, 'ruido', 'zarata', 'oihu', 'sarata', 1, 0, NULL, 4, NULL),
	(235, 'cliente', 'erosle', 'bezero', 'hornitzaile', 2, 0, NULL, 4, NULL),
	(236, '¿Cómo se dice en euskera?', 'txakurra', 'zaldia', 'katua', 1, 0, '1762772358_perro.jpg', NULL, 3),
	(237, '¿Cómo se dice en euskera?', 'behia', 'ahatea', 'zaldia', 3, 1, '1762946193_caballo.jpg', NULL, 3),
	(238, '¿Cómo se llama?', 'Ane Gabarain', 'Itziar Ituño', 'Elena Irureta', 2, 0, '1762946341_itziar.jpg', NULL, 4),
	(239, '¿Cómo se llama?', 'Totoro', 'Doraemon', 'Kirby', 2, 0, '1763240483_2d395cf8a95cf4493fbe111737213494.jpg', NULL, 4),
	(240, '¿Cómo se llama?', 'Aritz Aduriz', 'Gaizka Toquero', 'Iñaki Williams', 3, 1, '1763240720_inaki.jpg', NULL, 4),
	(241, '¿Cómo se llama?', 'talo', 'goxua', 'marmitako', 1, 0, '1763240985_talo.jpg', NULL, 5),
	(242, '¿Cómo se llama?', 'Celedón', 'Marijaia', 'La Otxoa', 2, 0, '1763241283_marijaia.jpg', NULL, 4),
	(243, '¿Dónde está? ', 'Bilbao', 'Donosti', 'Vitoria', 1, 1, '1763241619_guggenheim.jpg', NULL, 1),
	(244, '¿Cómo se llama?', 'Txalaparta', 'Alboka', 'Trikitixa', 3, 1, '1763241735_triki.jpg', NULL, 5),
	(245, '¿Cómo se llama?', 'Karra Elejalde', 'Iñaki Urdangarin', 'Mikel Oyarzabal', 1, 1, '1763378055_karra.png', NULL, 4);

-- Volcando estructura para tabla lhizki.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.roles: ~3 rows (aproximadamente)
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
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usuarios_centros` (`centroId`),
  KEY `FK_usuarios_ciclos` (`cicloId`),
  KEY `FK_usuarios_roles` (`rolId`),
  CONSTRAINT `FK_usuarios_centros` FOREIGN KEY (`centroId`) REFERENCES `centros` (`id`),
  CONSTRAINT `FK_usuarios_ciclos` FOREIGN KEY (`cicloId`) REFERENCES `ciclos` (`id`),
  CONSTRAINT `FK_usuarios_roles` FOREIGN KEY (`rolId`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.usuarios: ~10 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `centroId`, `cicloId`, `rolId`, `fecha_registro`) VALUES
	(4, 'ane', 'a@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 7, 2, '2025-09-15 23:32:34'),
	(5, 'admin', 'admin@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 1, '2025-09-15 23:32:36'),
	(6, 'dani', 'dani@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 4, 2, '2025-11-15 23:32:36'),
	(7, 'amaia', 'amaia@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, 2, '2025-11-15 23:32:37'),
	(8, 'inge', 'inge@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 5, 2, '2025-11-15 23:32:38'),
	(9, 'brahim', 'brahim@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 10, 2, '2025-11-17 01:22:02'),
	(10, 'gorka', 'gorka@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 8, 2, '2025-11-17 01:35:04'),
	(11, 'juan', 'juan@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 2, '2025-11-17 07:22:36'),
	(12, 'deiner', 'deiner@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 2, '2025-11-17 11:30:52'),
	(13, 'itxaso', 'itxaso@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 6, 2, '2025-11-18 00:47:00');

-- Volcando estructura para tabla lhizki.usuario_preguntas
CREATE TABLE IF NOT EXISTS `usuario_preguntas` (
  `usuarioId` int NOT NULL,
  `juegoId` int NOT NULL,
  `preguntaId` int NOT NULL,
  `respuesta` int DEFAULT NULL,
  PRIMARY KEY (`usuarioId`,`preguntaId`,`juegoId`) USING BTREE,
  KEY `FK_usuario_preguntas_preguntas` (`preguntaId`),
  KEY `FK_usuario_preguntas_juegos` (`juegoId`),
  CONSTRAINT `FK_usuario_preguntas_juegos` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_usuario_preguntas_preguntas` FOREIGN KEY (`preguntaId`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_usuario_preguntas_usuarios` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.usuario_preguntas: ~70 rows (aproximadamente)
INSERT INTO `usuario_preguntas` (`usuarioId`, `juegoId`, `preguntaId`, `respuesta`) VALUES
	(4, 78, 148, 1),
	(4, 78, 155, 1),
	(4, 78, 164, 1),
	(4, 78, 165, 1),
	(4, 78, 170, 1),
	(4, 78, 237, 1),
	(4, 78, 240, 1),
	(4, 78, 243, 1),
	(4, 78, 244, 1),
	(4, 78, 245, 1),
	(6, 77, 118, 1),
	(6, 77, 126, 1),
	(6, 77, 132, 1),
	(6, 77, 134, 1),
	(6, 77, 143, 1),
	(6, 77, 237, 1),
	(6, 77, 240, 1),
	(6, 77, 243, 1),
	(6, 77, 244, 1),
	(6, 77, 245, 1),
	(8, 77, 118, 1),
	(8, 77, 126, 1),
	(8, 77, 132, 1),
	(8, 77, 134, 1),
	(8, 77, 143, 1),
	(8, 77, 237, 1),
	(8, 77, 240, 1),
	(8, 77, 243, 1),
	(8, 77, 244, 1),
	(8, 77, 245, 1),
	(9, 79, 176, 1),
	(9, 79, 177, 1),
	(9, 79, 183, 1),
	(9, 79, 188, 1),
	(9, 79, 190, 1),
	(9, 79, 237, 1),
	(9, 79, 240, 1),
	(9, 79, 243, 1),
	(9, 79, 244, 1),
	(9, 79, 245, 1),
	(11, 77, 118, 1),
	(11, 77, 126, 1),
	(11, 77, 132, 1),
	(11, 77, 134, 1),
	(11, 77, 143, 1),
	(11, 77, 237, 1),
	(11, 77, 240, 1),
	(11, 77, 243, 1),
	(11, 77, 244, 1),
	(11, 77, 245, 1),
	(12, 77, 118, 1),
	(12, 77, 126, 1),
	(12, 77, 132, 1),
	(12, 77, 134, 1),
	(12, 77, 143, 1),
	(12, 77, 237, 1),
	(12, 77, 240, 1),
	(12, 77, 243, 1),
	(12, 77, 244, 1),
	(12, 77, 245, 1),
	(13, 78, 148, 1),
	(13, 78, 155, 1),
	(13, 78, 164, 1),
	(13, 78, 165, 1),
	(13, 78, 170, 1),
	(13, 78, 237, 1),
	(13, 78, 240, 1),
	(13, 78, 243, 1),
	(13, 78, 244, 1),
	(13, 78, 245, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
