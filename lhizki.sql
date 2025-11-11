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
CREATE DATABASE IF NOT EXISTS `lhizki` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lhizki`;

-- Volcando estructura para tabla lhizki.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.categorias: ~2 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `nombre`) VALUES
	(1, 'geografia'),
	(2, 'historia'),
	(3, 'animales');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.familias: ~4 rows (aproximadamente)
INSERT INTO `familias` (`id`, `nombre`) VALUES
	(1, 'Informática'),
	(2, 'Empresa'),
	(3, 'Integración'),
	(4, 'Marketing');

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.juegos: ~2 rows (aproximadamente)
INSERT INTO `juegos` (`id`, `familiaId`, `activo`, `fecha_inicio`, `fecha_fin`) VALUES
	(38, 1, 0, '2025-11-03 00:00:00', '2025-11-10 00:00:00'),
	(39, 2, 0, '2025-11-03 00:00:00', '2025-11-10 00:00:00'),
	(40, 2, 1, '2025-11-18 00:00:00', '2025-11-25 00:00:00'),
	(43, 1, 1, '2025-11-10 00:00:00', '2025-11-17 00:00:00'),
	(44, 2, 1, '2025-11-10 00:00:00', '2025-11-17 00:00:00');

-- Volcando estructura para tabla lhizki.juegos_preguntas
CREATE TABLE IF NOT EXISTS `juegos_preguntas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `juegoId` int NOT NULL,
  `preguntaId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_juegos_preguntas_juegos` (`juegoId`),
  KEY `FK_juegos_preguntas_preguntas` (`preguntaId`),
  CONSTRAINT `FK_juegos_preguntas_juegos` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_juegos_preguntas_preguntas` FOREIGN KEY (`preguntaId`) REFERENCES `preguntas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.juegos_preguntas: ~4 rows (aproximadamente)
INSERT INTO `juegos_preguntas` (`id`, `juegoId`, `preguntaId`) VALUES
	(54, 38, 4),
	(55, 38, 11),
	(56, 39, 4),
	(57, 39, 30),
	(58, 40, 4),
	(59, 40, 27),
	(60, 41, 4),
	(61, 41, 21),
	(62, 42, 4),
	(63, 42, 28),
	(64, 43, 57),
	(65, 43, 5),
	(66, 44, 57),
	(67, 44, 34);

-- Volcando estructura para tabla lhizki.partidas
CREATE TABLE IF NOT EXISTS `partidas` (
  `juegoId` int NOT NULL,
  `usuarioId` int NOT NULL,
  `puntuacion` int DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`juegoId`,`usuarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.partidas: ~0 rows (aproximadamente)
INSERT INTO `partidas` (`juegoId`, `usuarioId`, `puntuacion`, `fecha`) VALUES
	(38, 3, 488, '2025-11-09 21:47:08'),
	(39, 4, 478, '2025-11-10 06:34:42');

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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.preguntas: ~52 rows (aproximadamente)
INSERT INTO `preguntas` (`id`, `pregunta`, `opcion1`, `opcion2`, `opcion3`, `correcta`, `usada`, `img`, `familiaId`, `categoriaId`) VALUES
	(3, 'Capital de Uganda', 'Kiev', 'Managua', 'Kampala', 3, 1, NULL, NULL, 1),
	(4, 'Capital de Italia', 'Roma', 'Milan', 'Venecia', 1, 1, NULL, NULL, 1),
	(5, 'ámbito de uso', 'erabileraeremu', 'erabilera-eremu', 'erabilera-ezparru', 2, 0, NULL, 1, NULL),
	(6, 'alinear', 'lerrokatu', 'errokatu', 'berdindu', 1, 0, NULL, 1, NULL),
	(7, 'auditoría interna', 'barne-auditoria', 'kanpo-auditoria', 'barneauditoria', 1, 0, NULL, 1, NULL),
	(8, 'búsqueda', 'kontaketa', 'bilaketa', 'bilatu', 2, 0, NULL, 1, NULL),
	(9, 'celda', 'gelaxka', 'zutabe', 'zelda', 1, 0, NULL, 1, NULL),
	(10, 'código', 'seinale', 'kode', 'arau', 2, 0, NULL, 1, NULL),
	(11, 'criterio general', 'baldintza', 'ikuspegi', 'irizpide orokor', 3, 1, NULL, 1, NULL),
	(12, 'dato de tráfico', 'zirkulazio-kontrol', 'seinale-datu', 'zirkulazio-datu', 3, 0, NULL, 1, NULL),
	(13, 'deterioro grave', 'narriadura larri', 'kalte arina', 'higadura', 1, 0, NULL, 1, NULL),
	(14, 'dirección', 'helbide', 'bide', 'kokapen', 1, 0, NULL, 1, NULL),
	(15, 'documento base', 'oinarri-agiria', 'dokumentu-oinarria', 'oinarri-dokumentua', 1, 0, NULL, 1, NULL),
	(16, 'elemento estructural', 'egitura-elementu', 'egiturazko-elementu', 'osagai', 2, 0, NULL, 1, NULL),
	(17, 'entrada de datos', 'sarrera-datu', 'datu-sarrera', 'informazio-sarrera', 2, 0, NULL, 1, NULL),
	(18, 'equipo de trabajo', 'lan-ekipo', 'lan-ekipamendu', 'ekipo-lana', 2, 0, NULL, 1, NULL),
	(19, 'evaluación de riesgos', 'arrisku-ebaluazio', 'arrisku-balorazio', 'arrisku-azterketa', 1, 0, NULL, 1, NULL),
	(20, 'fuente de energía', 'energia-iturria', 'energia-sorgailua', 'energia-baliabidea', 1, 0, NULL, 1, NULL),
	(21, 'indicador', 'erakusle', 'adierazle', 'markatzaile', 2, 0, NULL, 1, NULL),
	(22, 'instalación eléctrica', 'instalazio elektrikoa', 'ekipo elektrikoa', 'instalazio elektronikoa', 1, 0, NULL, 1, NULL),
	(23, 'medio ambiente', 'ingurumen', 'ingurugiro', 'giro-ingurumen', 1, 0, NULL, 1, NULL),
	(24, 'método de control', 'kontrol-bidea', 'kontrol-metodo', 'gainbegiratze-metodo', 2, 0, NULL, 1, NULL),
	(25, 'nivel de calidad', 'kalitate-maila', 'kalitate-egoera', 'maila orokor', 1, 0, NULL, 2, NULL),
	(26, 'objetivo general', 'helburu orokor', 'xede orokor', 'asmo nagusi', 1, 0, NULL, 2, NULL),
	(27, 'organización interna', 'barne-antolaketa', 'antolaketa barnekoa', 'egitura barne', 1, 0, NULL, 2, NULL),
	(28, 'plan de actuación', 'jarduketa-plan', 'plan ekintza', 'ekintza-plan', 3, 0, NULL, 2, NULL),
	(29, 'proceso productivo', 'ekoizpen-prozesu', 'ekoizpen-jarduera', 'lan-prozesu', 1, 0, NULL, 2, NULL),
	(30, 'producto final', 'azken produktua', 'produktua bukatua', 'amaitutako produktua', 1, 1, NULL, 2, NULL),
	(31, 'riesgo laboral', 'laneko arriskua', 'arrisku profesionala', 'lan arrisku', 1, 0, NULL, 2, NULL),
	(32, 'sistema de gestión', 'kudeaketa-sistema', 'sistemaren kudeaketa', 'sistema-kontrol', 1, 0, NULL, 2, NULL),
	(33, 'tarea rutinaria', 'eguneroko lana', 'ohiko lana', 'lan arrunta', 2, 0, NULL, 2, NULL),
	(34, 'tipo de material', 'material mota', 'materialaren tipologia', 'osagai mota', 1, 0, NULL, 2, NULL),
	(35, 'unidad de medida', 'neurri-unitate', 'unitate neurketa', 'neurketa-unitate', 3, 0, NULL, 3, NULL),
	(36, 'uso responsable', 'erabilera arduratsua', 'arduradun erabilera', 'erabilera egokia', 1, 0, NULL, 3, NULL),
	(37, 'valor añadido', 'balio gehigarria', 'balio gehitu', 'balio handiago', 1, 0, NULL, 3, NULL),
	(38, 'variable de control', 'kontrol-aldagai', 'aldagai kontrola', 'aldagaia', 1, 0, NULL, 3, NULL),
	(39, 'verificación final', 'azken egiaztapena', 'egiaztapen bukatua', 'amaierako egiaztapena', 3, 0, NULL, 3, NULL),
	(40, 'zona de trabajo', 'lan-eremua', 'eremu lan', 'lan gunea', 1, 0, NULL, 3, NULL),
	(41, 'herramienta básica', 'oinarrizko tresna', 'tresna nagusia', 'tresna arrunta', 1, 0, NULL, 3, NULL),
	(42, 'proyecto piloto', 'proiektu pilotua', 'proba-proiektua', 'pilotaje-proiektua', 1, 0, NULL, 3, NULL),
	(43, 'análisis de datos', 'datuen analisia', 'analisi datu', 'azterketa datu', 1, 0, NULL, 3, NULL),
	(44, 'mantenimiento preventivo', 'mantentze prebentiboa', 'mantentze aurretikoa', 'aurre-mantentze', 1, 0, NULL, 3, NULL),
	(45, 'componente principal', 'osagai nagusia', 'osagai orokorra', 'elementu nagusi', 1, 0, NULL, 4, NULL),
	(46, 'consumo energético', 'energia kontsumoa', 'kontsumo energetikoa', 'kontsumoa energia', 2, 0, NULL, 4, NULL),
	(47, 'control de calidad', 'kalitate kontrola', 'kontrol kalitate', 'kalitate gainbegiratze', 1, 0, NULL, 4, NULL),
	(48, 'eficiencia operativa', 'eraginkortasun operatiboa', 'operazio-eraginkortasuna', 'lan-eraginkortasuna', 1, 0, NULL, 4, NULL),
	(49, 'informe técnico', 'txosten teknikoa', 'txostena', 'dokumentu tekniko', 1, 0, NULL, 4, NULL),
	(50, 'nivel de riesgo', 'arrisku maila', 'arriskuaren maila', 'arrisku egoera', 1, 0, NULL, 4, NULL),
	(51, 'plan de mejora', 'hobekuntza plana', 'plana hobekuntza', 'plan hobetze', 1, 0, NULL, 4, NULL),
	(52, 'procedimiento estándar', 'prozedura estandarra', 'estandarreko prozedura', 'prozedura orokorra', 1, 0, NULL, 4, NULL),
	(53, 'recurso material', 'baliabide materiala', 'material-baliabide', 'baliabide fisiko', 1, 0, NULL, 4, NULL),
	(54, 'sistema operativo', 'sistema eragilea', 'sistema funtzionala', 'eragiketa-sistema', 1, 0, NULL, 4, NULL),
	(57, '¿Cómo se dice en euskera?', 'txakur', 'zaldi', 'katu', 1, 0, '1762772358_perro.jpg', NULL, 3);

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
  PRIMARY KEY (`id`),
  KEY `FK_usuarios_centros` (`centroId`),
  KEY `FK_usuarios_ciclos` (`cicloId`),
  KEY `FK_usuarios_roles` (`rolId`),
  CONSTRAINT `FK_usuarios_centros` FOREIGN KEY (`centroId`) REFERENCES `centros` (`id`),
  CONSTRAINT `FK_usuarios_ciclos` FOREIGN KEY (`cicloId`) REFERENCES `ciclos` (`id`),
  CONSTRAINT `FK_usuarios_roles` FOREIGN KEY (`rolId`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla lhizki.usuarios: ~3 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `centroId`, `cicloId`, `rolId`) VALUES
	(3, 'juan', 'j@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 2),
	(4, 'ane', 'a@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 2, 2),
	(5, 'admin', 'admin@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 1);

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

-- Volcando datos para la tabla lhizki.usuario_preguntas: ~4 rows (aproximadamente)
INSERT INTO `usuario_preguntas` (`usuarioId`, `juegoId`, `preguntaId`, `respuesta`) VALUES
	(3, 38, 4, 1),
	(3, 38, 11, 1),
	(4, 39, 4, 1),
	(4, 39, 30, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
