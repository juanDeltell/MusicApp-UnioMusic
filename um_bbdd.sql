-- BASE DE DATOS DE UNIONMUSIC

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `Composicion`
--

CREATE TABLE IF NOT EXISTS `Composicion` (
  `fk_pista` int(9) unsigned NOT NULL,
  `fk_maqueta` int(9) unsigned NOT NULL,
  PRIMARY KEY (`fk_pista`,`fk_maqueta`),
  KEY `fk_pista` (`fk_pista`),
  KEY `fk_maqueta` (`fk_maqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Genero`
--

CREATE TABLE IF NOT EXISTS `Genero` (
  `id_genero` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Genero`
--

INSERT INTO `Genero` (`id_genero`, `nombre`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Indie'),
(4, 'House');

-- --------------------------------------------------------

--
-- Table structure for table `Maqueta`
--

CREATE TABLE IF NOT EXISTS `Maqueta` (
  `id_maqueta` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sonido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `num_reproducciones` int(9) NOT NULL,
  `duracion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fk_genero` int(9) unsigned NOT NULL,
  `time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `en_uso` tinyint(1) NOT NULL,
  `fk_propietario` int(9) unsigned NOT NULL,
  `popularidad` int(9) NOT NULL,
  PRIMARY KEY (`id_maqueta`),
  KEY `fk_genero` (`fk_genero`),
  KEY `fk_propietario` (`fk_propietario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `Mensaje`
--

CREATE TABLE IF NOT EXISTS `Mensaje` (
  `id_mensaje` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `fk_remitente` int(9) unsigned NOT NULL,
  `fk_destinatario` int(9) unsigned NOT NULL,
  `asunto` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `contenido` text COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_mensaje`),
  KEY `fk_remitente` (`fk_remitente`),
  KEY `fk_destinatario` (`fk_destinatario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Pista`
--

CREATE TABLE IF NOT EXISTS `Pista` (
  `id_pista` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `sonido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `num_reproducciones` int(9) NOT NULL,
  `duracion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fk_genero` int(9) unsigned NOT NULL,
  `time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `en_uso` tinyint(1) NOT NULL,
  `fk_propietario` int(9) unsigned NOT NULL,
  PRIMARY KEY (`id_pista`),
  KEY `fk_genero` (`fk_genero`),
  KEY `fk_propietario` (`fk_propietario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `Seguidor`
--

CREATE TABLE IF NOT EXISTS `Seguidor` (
  `user_origen` int(9) unsigned NOT NULL,
  `user_destino` int(9) unsigned NOT NULL,
  PRIMARY KEY (`user_origen`,`user_destino`),
  KEY `user_destino` (`user_destino`),
  KEY `user_origen` (`user_origen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `id_usuario` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `popularidad` int(9) NOT NULL,
  `time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `baja` tinyint(1) NOT NULL,
  `baneado` tinyint(1) NOT NULL,
  `administrador` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`id_usuario`, `nombre`, `apellidos`, `correo`, `nombre_user`, `password`, `fecha_nacimiento`, `foto`, `sexo`, `popularidad`, `time`, `baja`, `baneado`, `administrador`) VALUES
(2, 'Administrador', '', 'admin@unionmusic.com', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '2014-05-09', '', 'm', 0, '1399988366.9733', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Valora`
--

CREATE TABLE IF NOT EXISTS `Valora` (
  `fk_usuario` int(9) unsigned NOT NULL,
  `fk_maqueta` int(9) unsigned NOT NULL,
  `valoracion` int(2) NOT NULL,
  PRIMARY KEY (`fk_usuario`,`fk_maqueta`),
  KEY `fk_usuario` (`fk_usuario`),
  KEY `fk_maqueta` (`fk_maqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Composicion`
--
ALTER TABLE `Composicion`
  ADD CONSTRAINT `Composicion_ibfk_1` FOREIGN KEY (`fk_pista`) REFERENCES `Pista` (`id_pista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Composicion_ibfk_2` FOREIGN KEY (`fk_maqueta`) REFERENCES `Maqueta` (`id_maqueta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Maqueta`
--
ALTER TABLE `Maqueta`
  ADD CONSTRAINT `Maqueta_ibfk_1` FOREIGN KEY (`fk_genero`) REFERENCES `Genero` (`id_genero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Maqueta_ibfk_2` FOREIGN KEY (`fk_propietario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Mensaje`
--
ALTER TABLE `Mensaje`
  ADD CONSTRAINT `Mensaje_ibfk_1` FOREIGN KEY (`fk_remitente`) REFERENCES `Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Mensaje_ibfk_2` FOREIGN KEY (`fk_destinatario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Pista`
--
ALTER TABLE `Pista`
  ADD CONSTRAINT `Pista_ibfk_1` FOREIGN KEY (`fk_genero`) REFERENCES `Genero` (`id_genero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Pista_ibfk_2` FOREIGN KEY (`fk_propietario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Seguidor`
--
ALTER TABLE `Seguidor`
  ADD CONSTRAINT `Seguidor_ibfk_1` FOREIGN KEY (`user_origen`) REFERENCES `Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Seguidor_ibfk_2` FOREIGN KEY (`user_destino`) REFERENCES `Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Valora`
--
ALTER TABLE `Valora`
  ADD CONSTRAINT `Valora_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Valora_ibfk_2` FOREIGN KEY (`fk_maqueta`) REFERENCES `Maqueta` (`id_maqueta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
--/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
--/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
