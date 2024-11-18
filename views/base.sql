-----------------------------------------------------------------------------

CREATE TABLE `ma_ocupacional_pacientes` (
  `id_ocupacional_pacientes` int NOT NULL,
  `id_empresa` int NOT NULL,
  `tipo_documento` text COLLATE utf8mb4_general_ci NOT NULL,
  `nombre_completo` text COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_nacimiento`  date DEFAULT NULL,
  `edad` text COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` text COLLATE utf8mb4_general_ci NOT NULL,
  `estado_civil` text COLLATE utf8mb4_general_ci NOT NULL,
  `grado_instruccion` text COLLATE utf8mb4_general_ci NOT NULL,
  `ocupacion` text COLLATE utf8mb4_general_ci NOT NULL,
  `telefono_emergencia` text COLLATE utf8mb4_general_ci NOT NULL,
  `nombre_contacto` text COLLATE utf8mb4_general_ci NOT NULL,
  `parentesco_emergencia` text COLLATE utf8mb4_general_ci NOT NULL,
  `correo` text COLLATE utf8mb4_general_ci NOT NULL,
  `pais_residencia` text COLLATE utf8mb4_general_ci NULL,
  `departamento_residencia` text COLLATE utf8mb4_general_ci NULL,
  `provincia_residencia` text COLLATE utf8mb4_general_ci NULL,
  `distrito_residencia` text COLLATE utf8mb4_general_ci NULL,
  `direccion_residencia` text COLLATE utf8mb4_general_ci NULL,
  `pais_nacimiento` text COLLATE utf8mb4_general_ci NULL,
  `departamento_nacimiento` text COLLATE utf8mb4_general_ci NULL,
  `provincia_nacimiento` text COLLATE utf8mb4_general_ci NULL,
  `distrito_nacimiento` text COLLATE utf8mb4_general_ci NULL,
  `direccion_nacimiento` text COLLATE utf8mb4_general_ci NULL,
  `estado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;