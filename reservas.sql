/*
Navicat MySQL Data Transfer

Source Server         : conexion
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : reservas

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2016-02-09 23:32:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for asiento
-- ----------------------------
DROP TABLE IF EXISTS `asiento`;
CREATE TABLE `asiento` (
  `idasiento` int(11) NOT NULL AUTO_INCREMENT,
  `nroasiento` varchar(45) DEFAULT NULL,
  `idseccion` int(11) DEFAULT NULL,
  `idestadio` int(11) DEFAULT NULL,
  PRIMARY KEY (`idasiento`),
  KEY `idestadio` (`idestadio`),
  KEY `idseccion` (`idseccion`),
  CONSTRAINT `idestadio` FOREIGN KEY (`idestadio`) REFERENCES `estadio` (`idestadio`),
  CONSTRAINT `idseccion` FOREIGN KEY (`idseccion`) REFERENCES `seccion` (`idseccion`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of asiento
-- ----------------------------
INSERT INTO `asiento` VALUES ('1', 'E-001', '1', '1');
INSERT INTO `asiento` VALUES ('2', 'E-002', '1', '1');
INSERT INTO `asiento` VALUES ('3', 'E-003', '1', '1');
INSERT INTO `asiento` VALUES ('4', 'E-004', '2', '1');
INSERT INTO `asiento` VALUES ('5', 'E-005', '2', '1');
INSERT INTO `asiento` VALUES ('6', 'E-006', '3', '1');
INSERT INTO `asiento` VALUES ('7', 'E-007', '3', '1');
INSERT INTO `asiento` VALUES ('8', 'E-008', '3', '1');
INSERT INTO `asiento` VALUES ('9', 'E-009', '4', '1');
INSERT INTO `asiento` VALUES ('10', 'E-010', '4', '1');
INSERT INTO `asiento` VALUES ('22', 'E-011', '5', '1');
INSERT INTO `asiento` VALUES ('23', 'E-012', '5', '1');
INSERT INTO `asiento` VALUES ('24', 'E-013', '5', '1');
INSERT INTO `asiento` VALUES ('25', 'E-014', '5', '1');
INSERT INTO `asiento` VALUES ('26', 'E-001', '1', '2');
INSERT INTO `asiento` VALUES ('27', 'E-002', '1', '2');
INSERT INTO `asiento` VALUES ('28', 'E-003', '1', '2');
INSERT INTO `asiento` VALUES ('29', 'E-004', '2', '2');
INSERT INTO `asiento` VALUES ('30', 'E-005', '2', '2');
INSERT INTO `asiento` VALUES ('31', 'E-1', '1', '3');
INSERT INTO `asiento` VALUES ('32', 'E-2', '1', '3');
INSERT INTO `asiento` VALUES ('33', 'E-3', '1', '3');
INSERT INTO `asiento` VALUES ('34', 'E-4', '1', '3');
INSERT INTO `asiento` VALUES ('35', 'E-5', '1', '3');
INSERT INTO `asiento` VALUES ('36', 'E-6', '2', '3');
INSERT INTO `asiento` VALUES ('37', 'E-7', '2', '3');
INSERT INTO `asiento` VALUES ('38', 'E-8', '5', '3');
INSERT INTO `asiento` VALUES ('39', 'E-9', '5', '3');
INSERT INTO `asiento` VALUES ('40', 'E-10', '5', '3');

-- ----------------------------
-- Table structure for codigo
-- ----------------------------
DROP TABLE IF EXISTS `codigo`;
CREATE TABLE `codigo` (
  `idcodigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) DEFAULT NULL,
  `estado_codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idcodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of codigo
-- ----------------------------
INSERT INTO `codigo` VALUES ('1', 'FRT235ER', 'OCUPADO');
INSERT INTO `codigo` VALUES ('2', 'AQW760WW', 'DISPONIBLE');
INSERT INTO `codigo` VALUES ('3', 'SED224FG', 'DISPONIBLE');

-- ----------------------------
-- Table structure for costo
-- ----------------------------
DROP TABLE IF EXISTS `costo`;
CREATE TABLE `costo` (
  `idcosto` int(11) NOT NULL AUTO_INCREMENT,
  `costo` varchar(20) DEFAULT NULL,
  `idpartido` int(11) DEFAULT NULL,
  `idseccion` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcosto`),
  KEY `idseccion2` (`idseccion`),
  KEY `idpartido2` (`idpartido`),
  CONSTRAINT `idpartido2` FOREIGN KEY (`idpartido`) REFERENCES `partido` (`idpartido`),
  CONSTRAINT `idseccion2` FOREIGN KEY (`idseccion`) REFERENCES `seccion` (`idseccion`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of costo
-- ----------------------------
INSERT INTO `costo` VALUES ('1', '25.00', '1', '1');
INSERT INTO `costo` VALUES ('2', '15.50', '1', '2');
INSERT INTO `costo` VALUES ('3', '14.80', '1', '3');
INSERT INTO `costo` VALUES ('4', '20.00', '1', '4');
INSERT INTO `costo` VALUES ('6', '23.69', '2', '1');
INSERT INTO `costo` VALUES ('7', '40.00', '2', '2');
INSERT INTO `costo` VALUES ('8', '30.50', '2', '3');
INSERT INTO `costo` VALUES ('9', '40.00', '2', '4');
INSERT INTO `costo` VALUES ('10', '32.90', '2', '5');
INSERT INTO `costo` VALUES ('12', '20.00', '3', '1');
INSERT INTO `costo` VALUES ('13', '15.00', '3', '2');
INSERT INTO `costo` VALUES ('26', '23', '3', '1');
INSERT INTO `costo` VALUES ('27', '21', '3', '2');
INSERT INTO `costo` VALUES ('28', '12', '3', '5');
INSERT INTO `costo` VALUES ('29', '1', '3', '1');
INSERT INTO `costo` VALUES ('30', '1', '3', '2');
INSERT INTO `costo` VALUES ('31', '1', '3', '5');
INSERT INTO `costo` VALUES ('32', '30', '25', '1');
INSERT INTO `costo` VALUES ('33', '25', '25', '2');
INSERT INTO `costo` VALUES ('34', '5', '25', '5');
INSERT INTO `costo` VALUES ('35', '23', '26', '1');
INSERT INTO `costo` VALUES ('36', '21', '26', '2');
INSERT INTO `costo` VALUES ('37', '5', '26', '5');

-- ----------------------------
-- Table structure for detalle_reserva
-- ----------------------------
DROP TABLE IF EXISTS `detalle_reserva`;
CREATE TABLE `detalle_reserva` (
  `idreserva` int(11) DEFAULT NULL,
  `idasiento` int(11) DEFAULT NULL,
  KEY `idreserva` (`idreserva`),
  KEY `idasiento` (`idasiento`),
  CONSTRAINT `idasiento` FOREIGN KEY (`idasiento`) REFERENCES `asiento` (`idasiento`),
  CONSTRAINT `idreserva` FOREIGN KEY (`idreserva`) REFERENCES `reserva` (`idreserva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of detalle_reserva
-- ----------------------------
INSERT INTO `detalle_reserva` VALUES ('57', '29');
INSERT INTO `detalle_reserva` VALUES ('57', '30');
INSERT INTO `detalle_reserva` VALUES ('58', '6');
INSERT INTO `detalle_reserva` VALUES ('58', '7');
INSERT INTO `detalle_reserva` VALUES ('58', '9');
INSERT INTO `detalle_reserva` VALUES ('60', '1');
INSERT INTO `detalle_reserva` VALUES ('62', '26');
INSERT INTO `detalle_reserva` VALUES ('62', '27');
INSERT INTO `detalle_reserva` VALUES ('63', '1');
INSERT INTO `detalle_reserva` VALUES ('63', '2');
INSERT INTO `detalle_reserva` VALUES ('63', '3');
INSERT INTO `detalle_reserva` VALUES ('63', '22');
INSERT INTO `detalle_reserva` VALUES ('63', '23');
INSERT INTO `detalle_reserva` VALUES ('63', '24');

-- ----------------------------
-- Table structure for detalle_usuario
-- ----------------------------
DROP TABLE IF EXISTS `detalle_usuario`;
CREATE TABLE `detalle_usuario` (
  `idusuario` int(11) DEFAULT NULL,
  `idestadio` int(11) DEFAULT NULL,
  KEY `idusuario` (`idusuario`),
  KEY `idestadio2` (`idestadio`),
  CONSTRAINT `idestadio2` FOREIGN KEY (`idestadio`) REFERENCES `estadio` (`idestadio`),
  CONSTRAINT `idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of detalle_usuario
-- ----------------------------
INSERT INTO `detalle_usuario` VALUES ('2', '1');
INSERT INTO `detalle_usuario` VALUES ('4', '2');
INSERT INTO `detalle_usuario` VALUES ('21', '3');

-- ----------------------------
-- Table structure for estadio
-- ----------------------------
DROP TABLE IF EXISTS `estadio`;
CREATE TABLE `estadio` (
  `idestadio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `localidad` varchar(150) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `capacidad` int(20) DEFAULT NULL,
  `maxreserva` int(20) DEFAULT NULL,
  PRIMARY KEY (`idestadio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of estadio
-- ----------------------------
INSERT INTO `estadio` VALUES ('1', 'ESTADIO 1', 'Machala', 'Juan Palomino', '1', '14', '3');
INSERT INTO `estadio` VALUES ('2', 'ESTADIO 2', 'Pasaje', 'xxx', '4', '10', '2');
INSERT INTO `estadio` VALUES ('3', 'Estadio 3', 'Ya sabe', 'xxxw', '10', '3000', '3');

-- ----------------------------
-- Table structure for partido
-- ----------------------------
DROP TABLE IF EXISTS `partido`;
CREATE TABLE `partido` (
  `idpartido` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `equipolocal` varchar(45) DEFAULT NULL,
  `equipovisita` varchar(45) DEFAULT NULL,
  `arbitro` varchar(45) DEFAULT NULL,
  `idestadio` int(11) DEFAULT NULL,
  `idseccionpartido` int(11) DEFAULT NULL,
  `idtipopartido` int(11) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpartido`),
  KEY `idestadio3` (`idestadio`),
  KEY `idtipopartido` (`idtipopartido`),
  KEY `idseccionpartido` (`idseccionpartido`),
  CONSTRAINT `idseccionpartido` FOREIGN KEY (`idseccionpartido`) REFERENCES `seccionpartido` (`idseccionpartido`),
  CONSTRAINT `idestadio3` FOREIGN KEY (`idestadio`) REFERENCES `estadio` (`idestadio`),
  CONSTRAINT `idtipopartido` FOREIGN KEY (`idtipopartido`) REFERENCES `tipopartido` (`idtipopartido`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of partido
-- ----------------------------
INSERT INTO `partido` VALUES ('1', '2015-01-15', '02:30 PM', '4', '5', 'Mario Calle', '1', '1', '2', 'HABILITADO');
INSERT INTO `partido` VALUES ('2', '2015-01-10', '08:00 PM', '3', '6', 'Jorge Campos', '1', '1', '2', 'HABILITADO');
INSERT INTO `partido` VALUES ('3', '2015-01-16', '12:00 PM', '1', '2', 'Luis', '2', '2', '1', 'HABILITADO');
INSERT INTO `partido` VALUES ('25', '2016-02-14', '04:00 PM', '1', '2', 'Pepe el grillo', '3', '1', '2', 'HABILITADO');
INSERT INTO `partido` VALUES ('26', '2016-02-20', '05:30 PM', '7', '10', 'xxx', '3', '2', '1', 'HABILITADO');

-- ----------------------------
-- Table structure for persona
-- ----------------------------
DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `genero` varchar(45) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpersona`),
  KEY `idusuario2` (`idusuario`),
  CONSTRAINT `idusuario2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of persona
-- ----------------------------
INSERT INTO `persona` VALUES ('1', 'Cristhian AndrÃ©s', 'Delgado Calle', '2968287', 'Juan Montalvo y 11va Norte', '1994-07-01', 'Masculino', '3');
INSERT INTO `persona` VALUES ('13', 'MarÃ­a del Rosario', 'Salgado Crespo', '2980765', 'Guayas entre BolÃ­var y Pichincha', '1990-05-12', 'Femenino', '16');
INSERT INTO `persona` VALUES ('14', 'as', 'as', 'as', 'as', '0022-02-22', 'Masculino', '17');
INSERT INTO `persona` VALUES ('15', 'William', 'Roa', '2961761', 'buenavista y 10ma norte', '1991-07-24', 'Masculino', '18');
INSERT INTO `persona` VALUES ('16', 'Andres', 'Garcia', '2961761', 'santa elena', '2016-02-07', 'Masculino', '19');
INSERT INTO `persona` VALUES ('17', 'Pepe El Grillo', 'Jajaja', 'xxxx', 'xxxx', '0002-02-02', 'Masculino', '20');

-- ----------------------------
-- Table structure for reserva
-- ----------------------------
DROP TABLE IF EXISTS `reserva`;
CREATE TABLE `reserva` (
  `idreserva` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) DEFAULT NULL,
  `idpartido` int(11) DEFAULT NULL,
  `precio` varchar(20) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `codreserva` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idreserva`),
  KEY `idpersona` (`idpersona`),
  KEY `idpartido` (`idpartido`),
  CONSTRAINT `idpartido` FOREIGN KEY (`idpartido`) REFERENCES `partido` (`idpartido`),
  CONSTRAINT `idpersona` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reserva
-- ----------------------------
INSERT INTO `reserva` VALUES ('57', '1', '3', '30', 'PENDIENTE', null);
INSERT INTO `reserva` VALUES ('58', '1', '1', '49.6', 'PENDIENTE', null);
INSERT INTO `reserva` VALUES ('60', '1', '2', '23.69', 'PENDIENTE', null);
INSERT INTO `reserva` VALUES ('62', '15', '3', '40', 'PENDIENTE', null);
INSERT INTO `reserva` VALUES ('63', '15', '1', '75', 'PENDIENTE', null);
INSERT INTO `reserva` VALUES ('64', '17', '3', '20', 'PENDIENTE', null);

-- ----------------------------
-- Table structure for rol
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES ('1', 'SUPERADMINISTRADOR', 'SUPERADMINISTRADOR');
INSERT INTO `rol` VALUES ('2', 'ADMINISTRADOR', 'ADMINISTRADOR');
INSERT INTO `rol` VALUES ('3', 'CLIENTE', 'CLIENTE');
INSERT INTO `rol` VALUES ('4', 'EMPLEADO', 'EMPLEADO');

-- ----------------------------
-- Table structure for seccion
-- ----------------------------
DROP TABLE IF EXISTS `seccion`;
CREATE TABLE `seccion` (
  `idseccion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idseccion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of seccion
-- ----------------------------
INSERT INTO `seccion` VALUES ('1', 'VIP', 'VIP');
INSERT INTO `seccion` VALUES ('2', 'Palco', 'Palco');
INSERT INTO `seccion` VALUES ('3', 'Preferencial', 'Preferencial');
INSERT INTO `seccion` VALUES ('4', 'Tribuna', 'Tribuna');
INSERT INTO `seccion` VALUES ('5', 'General', 'General');

-- ----------------------------
-- Table structure for seccionpartido
-- ----------------------------
DROP TABLE IF EXISTS `seccionpartido`;
CREATE TABLE `seccionpartido` (
  `idseccionpartido` int(11) NOT NULL AUTO_INCREMENT,
  `seccionpartido` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idseccionpartido`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of seccionpartido
-- ----------------------------
INSERT INTO `seccionpartido` VALUES ('1', 'Clubes');
INSERT INTO `seccionpartido` VALUES ('2', 'Paises');

-- ----------------------------
-- Table structure for tipopartido
-- ----------------------------
DROP TABLE IF EXISTS `tipopartido`;
CREATE TABLE `tipopartido` (
  `idtipopartido` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtipopartido`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipopartido
-- ----------------------------
INSERT INTO `tipopartido` VALUES ('1', 'Amistoso', 'Amistoso');
INSERT INTO `tipopartido` VALUES ('2', 'Campeonato Nacional', 'Campeonato Nacional');
INSERT INTO `tipopartido` VALUES ('3', 'Campeontao Internacional', 'Campeontao Internacional');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `idrol` int(11) DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `idusuario` (`idusuario`),
  KEY `idrol` (`idrol`),
  CONSTRAINT `idrol` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'admin@gmail.com', '123456', '1');
INSERT INTO `usuario` VALUES ('2', 'estadio1@gmail.com', '123456', '2');
INSERT INTO `usuario` VALUES ('3', 'cris.adc.94@gmail.com', '123456', '3');
INSERT INTO `usuario` VALUES ('4', 'estadio2@gmail.com', '123456', '2');
INSERT INTO `usuario` VALUES ('16', 'maria@gmail.com', '123456', '3');
INSERT INTO `usuario` VALUES ('17', 'as', 'as', '3');
INSERT INTO `usuario` VALUES ('18', 'wilyroa@gmail.com', '123456', '3');
INSERT INTO `usuario` VALUES ('19', 'wilypipo@hotmail.com', '123456', '3');
INSERT INTO `usuario` VALUES ('20', '222', '123456', '3');
INSERT INTO `usuario` VALUES ('21', 'estadio3@gmail.com', '123456', '2');
