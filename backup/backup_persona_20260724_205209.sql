-- Backup table: documento_identidad
CREATE TABLE `documento_identidad` (
  `nuip` varchar(12) NOT NULL,
  `tipo_documento` int(1) NOT NULL,
  `apellidos` tinytext NOT NULL,
  `nombres` tinytext NOT NULL,
  `nacionalidad` tinyint(3) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `lugar_nacimiento` tinytext NOT NULL,
  `estatura` tinytext NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `grupo_sanguineo` tinytext NOT NULL,
  `fecha_expedicion` date NOT NULL,
  `lugar_expedicion` tinytext NOT NULL,
  `huella` text NOT NULL,
  `foro_persona` text NOT NULL,
  `fecha_expiracion` date NOT NULL,
  `firma_persona` text NOT NULL,
  `qr` text NOT NULL,
  `firma_registrador` text NOT NULL,
  `codigo_verificacion` tinytext NOT NULL,
  PRIMARY KEY (`nuip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



