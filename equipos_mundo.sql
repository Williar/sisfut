/*
Navicat MySQL Data Transfer

Source Server         : conexion
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : equipos_mundo

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2016-02-09 23:32:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for equipo
-- ----------------------------
DROP TABLE IF EXISTS `equipo`;
CREATE TABLE `equipo` (
  `idequipo_pais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_equipo` varchar(150) DEFAULT NULL,
  `estadio` varchar(150) DEFAULT NULL,
  `entrenador` varchar(150) DEFAULT NULL,
  `ubicacion` varchar(150) DEFAULT NULL,
  `imagen_nomequi` varchar(225) DEFAULT NULL,
  `idpais` int(11) DEFAULT NULL,
  PRIMARY KEY (`idequipo_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of equipo
-- ----------------------------
INSERT INTO `equipo` VALUES ('1', 'Emelec', 'George Capwell', 'Omar De Felippe', 'Guayaquil', 'img/img_equipo/ecuador/Emelec.png', '1');
INSERT INTO `equipo` VALUES ('2', 'Barcelona', 'Monumental Isidro Romero Carbo', 'Guillermo Almada', 'Guayaquil', 'img/img_equipo/ecuador/BarcelonaSC.png', '1');
INSERT INTO `equipo` VALUES ('3', 'Liga de Quito', 'Casa Blanca', 'Luis Zubeldia', 'Quito', 'img/img_equipo/ecuador/ligaquito.png', '1');
INSERT INTO `equipo` VALUES ('4', 'Independiente del Valle', 'Rumiñahui', 'Pablo Repetto', 'Sangolqui', 'img/img_equipo/ecuador/independientevalle.png', '1');
INSERT INTO `equipo` VALUES ('5', 'Deportivo Cuenca', 'Estadio Alejandro Serrano Aguilar', 'Álex Aguinaga', 'Cuenca', 'img/img_equipo/ecuador/CD Cuenca.png', '1');
INSERT INTO `equipo` VALUES ('6', 'Espoli', 'Olímpico Atahualpa', '-', 'Quito', 'img/img_equipo/ecuador/CD Espoli.png', '1');
INSERT INTO `equipo` VALUES ('7', 'Olmedo', 'Estadio Olímpico de Riobamba', 'Vicente Girona', 'Riobamba', 'img/img_equipo/ecuador/CD Olmedo.png', '1');
INSERT INTO `equipo` VALUES ('8', 'Deportivo Azogues', 'Estadio Federativo de Azogues', 'Diego Alarcón', 'Azogues', 'img/img_equipo/ecuador/Deportivo Azogues.png', '1');
INSERT INTO `equipo` VALUES ('9', 'EL Nacional', 'Olímpico Atahualpa', 'Eduardo Favaro', 'Quito', 'img/img_equipo/ecuador/El Nacional Ecuador.png', '1');
INSERT INTO `equipo` VALUES ('10', 'Liga de Loja', 'Estadio Federativo Reina del Cisne', 'Geovanny Cumbicus', 'Loja', 'img/img_equipo/ecuador/LDU Loja.png', '1');
INSERT INTO `equipo` VALUES ('11', 'Macara', 'Estadio Bellavista', 'Paúl Vélez', 'Ambato', 'img/img_equipo/ecuador/Macara Ambato.png', '1');
INSERT INTO `equipo` VALUES ('12', 'Manta', 'Estadio Jocay', 'Luis Espinel', 'Manta', 'img/img_equipo/ecuador/Manta FC.png', '1');
INSERT INTO `equipo` VALUES ('13', 'Esmeraldas Petrolero', 'Folke Anderson', 'Segundo Cirilo Montaño', 'Esmeraldas', 'img/img_equipo/ecuador/petrolero.png', '1');
INSERT INTO `equipo` VALUES ('14', 'Deportivo Quevedo', '7 de Octubre', 'José Mora', 'Quevedo', 'img/img_equipo/ecuador/quevedo.png', '1');
INSERT INTO `equipo` VALUES ('15', 'River Ecuador', 'Christian Benítez', 'Marcelo Trobbiani', 'Guayaquil', 'img/img_equipo/ecuador/riverecuador.png', '1');
INSERT INTO `equipo` VALUES ('16', 'Deportivo Saquisilí', 'Estadio de Liga Deportiva Cantonal de Saquisilí', '-', 'Saquisilí', 'img/img_equipo/ecuador/saquisili.png', '1');
INSERT INTO `equipo` VALUES ('17', 'Aucas', 'Gonzalo Pozo Ripalda', 'Carlos Ischia', 'Quito', 'img/img_equipo/ecuador/SD Aucas.png', '1');
INSERT INTO `equipo` VALUES ('18', 'Deportivo Quito', 'Olímpico Atahualpa', 'Marcelo Fleitas', 'Quito', 'img/img_equipo/ecuador/SD Quito.png', '1');
INSERT INTO `equipo` VALUES ('19', 'Universidad Católica', 'Olímpico Atahualpa', 'Jorge Célico', 'Quito', 'img/img_equipo/ecuador/Universidad Catolica Quito.png', '1');
INSERT INTO `equipo` VALUES ('20', 'Arsenal', 'Julio Humberto Grondona', 'Sergio Rondina', 'Sarandí', 'img/img_equipo/argentina/Arsenal de Sarandi.png', '3');
INSERT INTO `equipo` VALUES ('21', 'Boca Juniors', 'Estadio Alberto J. Armando', 'Rodolfo Arruabarrena', 'Buenos Aires', 'img/img_equipo/argentina/Boca Juniors.png', '3');
INSERT INTO `equipo` VALUES ('22', 'All Boys', 'Estadio Islas Malvinas', 'José Santos Romero', 'Buenos Aires', 'img/img_equipo/argentina/Club Atletico All Boys.png', '3');
INSERT INTO `equipo` VALUES ('23', 'Club Atlético Estudiantes', 'Ciudad de Caseros', 'Óscar Pacheco', 'Caseros', 'img/img_equipo/argentina/estudiantes.png', '3');
INSERT INTO `equipo` VALUES ('24', 'Godoy Cruz ', 'Feliciano Gambatre', 'Sebastián Méndez', 'Godoy Cruz', 'img/img_equipo/argentina/Godoy Cruz.png', '3');
INSERT INTO `equipo` VALUES ('25', 'Huracán', 'Tomás Adolfo Ducó', 'Eduardo Domínguez', 'Buenos Aires', 'img/img_equipo/argentina/Huracan.png', '3');
INSERT INTO `equipo` VALUES ('26', 'Independiente de Avellaneda', 'Libertadores de América', 'Mauricio Pellegrino', 'Avellaneda', 'img/img_equipo/argentina/Independiente de Avellaneda.png', '3');
INSERT INTO `equipo` VALUES ('27', 'Independiente Rivadavia', 'Bautista Gargantini', 'Pablo Quinteros', 'Mendoza', 'img/img_equipo/argentina/Independiente Rivadavia.png', '3');
INSERT INTO `equipo` VALUES ('28', 'Racing', 'Presidente Perón', 'Facundo Sava', 'Avellaneda', 'img/img_equipo/argentina/Racing de Avellaneda.png', '3');
INSERT INTO `equipo` VALUES ('29', 'River Plate', 'Antonio Vespucio Liberti', 'Marcelo Gallardo', 'Buenos Aires', 'img/img_equipo/argentina/River Plate.png', '3');
INSERT INTO `equipo` VALUES ('30', 'San Lorenzo de Almagro', 'Estadio Pedro Bidegain', 'Pablo Guede', 'Buenos Aires', 'img/img_equipo/argentina/San Lorenzo de Almagro.png', '3');
INSERT INTO `equipo` VALUES ('31', 'Alianza Lima', 'Estadio Alejandro Villanueva', 'Roberto Mosquera Vera', 'Lima', 'img/img_equipo/peru/Alianza Lima.png', '5');
INSERT INTO `equipo` VALUES ('32', 'Sporting Cristal', 'Estadio Alberto Gallardo', 'Daniel Ahmed', 'Lima', 'img/img_equipo/peru/Sporting Cristal.png', '5');
INSERT INTO `equipo` VALUES ('33', 'Universidad Cesar Vallejo Trujillo', 'Estadio Mansiche', 'Franco Navarro', 'Trujillo', 'img/img_equipo/peru/Universidad Cesar Vallejo Trujillo.png', '5');
INSERT INTO `equipo` VALUES ('34', 'Universidad San Martin Lima', 'Miguel Grau', 'José del Solar', 'Callao', 'img/img_equipo/peru/Universidad San Martin Lima.png', '5');
INSERT INTO `equipo` VALUES ('35', 'Universitario Lima', ' Estadio Monumental', 'Roberto Chale', 'Lima', 'img/img_equipo/peru/Universitario Lima.png', '5');
INSERT INTO `equipo` VALUES ('36', 'Cobreloa Calana', 'Estadio Zorros del Desierto', 'César Vigevani', 'Calama', 'img/img_equipo/chile/Cobreloa.png', '4');
INSERT INTO `equipo` VALUES ('37', 'Colo Colo', 'Monumental', 'José Luis Sierra', 'Macul', 'img/img_equipo/chile/Colo-Colo.png', '4');
INSERT INTO `equipo` VALUES ('38', 'Huachipato', 'CAP', 'Miguel Ponce', 'Talcahuano', 'img/img_equipo/chile/Huachipato.png', '4');
INSERT INTO `equipo` VALUES ('39', 'Independiente de Cauquenes', 'Fiscal Manuel Moya Medel', 'Rubén Martínez', 'Cauquenes', 'img/img_equipo/chile/Independiente de Cauquenes.png', '4');
INSERT INTO `equipo` VALUES ('40', 'Palestino', 'Municipal de La Cisterna', 'Nicolás Córdova', 'La Cisterna', 'img/img_equipo/chile/Palestino.png', '4');
INSERT INTO `equipo` VALUES ('41', 'Universidad de Chile', 'Nacional', 'Sebastián Becaccece', 'Ñuñoa', 'img/img_equipo/chile/Universidad de Chile.png', '4');
INSERT INTO `equipo` VALUES ('42', 'Bayer Leverkusen', 'BayArena', 'Roger Schmidt', 'Leverkusen', 'img/img_equipo/alemania/Bayer-Leverkusen.png', '11');
INSERT INTO `equipo` VALUES ('43', 'Borussia Dortmund', 'Signal Iduna Park', 'Thomas Tuchel', 'Dortmund', 'img/img_equipo/alemania/Borussia-Dortmund-icon.png', '11');
INSERT INTO `equipo` VALUES ('44', 'Borussia Monchengladbach', 'Borussia Park', 'André Schubert', 'Mönchengladbach', 'img/img_equipo/alemania/Borussia-Monchengladbach-icon.png', '11');
INSERT INTO `equipo` VALUES ('45', 'Eintracht Frankfurt', 'Commerzbank-Arena', 'Armin Veh', 'Fráncfort del Meno', 'img/img_equipo/alemania/Eintracht-Frankfurt-icon.png', '11');
INSERT INTO `equipo` VALUES ('46', 'Hamburgo SV', 'Imtech Arena', 'Bruno Labbadia', 'Hamburgo', 'img/img_equipo/alemania/Hamburger-SV-icon.png', '11');
INSERT INTO `equipo` VALUES ('47', 'Hannover 96', 'HDI-Arena', 'Thomas Schaaf', 'Hannover', 'img/img_equipo/alemania/Hannover-96-icon.png', '11');
INSERT INTO `equipo` VALUES ('48', 'Hoffenheim', 'Rhein-Neckar-Arena', 'Huub Stevens', 'Hoffenheim', 'img/img_equipo/alemania/hoffenheim.png', '11');
INSERT INTO `equipo` VALUES ('49', 'Kaiserslautern', 'Fritz-Walter-Stadion', 'Konrad Fünfstück', 'Kaiserslautern', 'img/img_equipo/alemania/Kaiserslautern.png', '11');
INSERT INTO `equipo` VALUES ('50', 'Schalke 04', 'André Breitenreiter', 'Veltins-Arena', 'Gelsenkirchen', 'img/img_equipo/alemania/Schalke-04-icon.png', '11');
INSERT INTO `equipo` VALUES ('51', 'Wolfsburg', 'Volkswagen-Arena', 'Dieter Hecking', 'Wolfsburgo', 'img/img_equipo/alemania/VfL-Wolfsburg-icon.png', '11');
INSERT INTO `equipo` VALUES ('52', 'Werder Bremen', 'Weserstadion', 'Viktor Skrypnyk', 'Bremen', 'img/img_equipo/alemania/Werder-Bremen-icon.png', '11');

-- ----------------------------
-- Table structure for pais
-- ----------------------------
DROP TABLE IF EXISTS `pais`;
CREATE TABLE `pais` (
  `idpais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `entrenador_pais` varchar(155) DEFAULT NULL,
  `estadio_pais` varchar(155) DEFAULT NULL,
  `imagen_pais` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pais
-- ----------------------------
INSERT INTO `pais` VALUES ('1', 'Ecuador', 'Gustavo Quinteros', 'Atahualpa', 'img/img_pais/Flag-of-Ecuador.png');
INSERT INTO `pais` VALUES ('2', 'Brasil', 'Dunga', 'Maracana', 'img/img_pais/Flag-of-Brazil.png');
INSERT INTO `pais` VALUES ('3', 'Argentina', 'Gerardo Martino', 'Antonio Vespucio Liberti', 'img/img_pais/Flag-of-Argentina.png');
INSERT INTO `pais` VALUES ('4', 'Chile', 'Jorge Sampaoli', 'Nacional de Chile', 'img/img_pais/Flag-of-Chile.png');
INSERT INTO `pais` VALUES ('5', 'Peru', 'Ricardo Gareca', 'Nacional de Peru', 'img/img_pais/Flag-of-Peru.png');
INSERT INTO `pais` VALUES ('6', 'Paraguay', 'Ramon Angel Diaz', 'Defensores del Chaco', 'img/img_pais/Flag-of-Paraguay.png');
INSERT INTO `pais` VALUES ('7', 'Bolivia', 'Mauricio Soria', 'Hernando Siles', 'img/img_pais/Flag-of-Bolivia.png');
INSERT INTO `pais` VALUES ('8', 'Venezuela', 'Noel Sanvicente', 'Cachamay', 'img/img_pais/Flag-of-Venezuela.png');
INSERT INTO `pais` VALUES ('9', 'Uruguay', 'Oscar Washington Tabarez', 'Centenario', 'img/img_pais/Flag-of-Uruguay.png');
INSERT INTO `pais` VALUES ('10', 'Colombia', 'José Néstor Pékerman', 'Estadio Metropolitano Roberto Meléndez', 'img/img_pais/Flag-of-Colombia.png');
INSERT INTO `pais` VALUES ('11', 'Alemania', 'Joachim Löw', 'Allianz Arena', 'img/img_pais/Flag-of-Germany.png');
INSERT INTO `pais` VALUES ('12', 'Italia', 'Antonio Conte', 'Estadio Olímpico de Roma', 'img/img_pais/Flag-of-Italy.png');
INSERT INTO `pais` VALUES ('13', 'EspaÃ±a', 'Vicente del Bosque', 'Estadio Santiago Bernabéu', 'img/img_pais/Flag-of-Spain.png');
