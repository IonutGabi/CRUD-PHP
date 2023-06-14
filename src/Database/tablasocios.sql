USE biblioteca;

CREATE TABLE socios(
    codsocio INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    dni CHAR(9) NOT NULL,
    fechanacimiento DATE NOT NULL,
    domicilio VARCHAR(100),
    PRIMARY KEY(codsocio)
);