CREATE DATABASE biblioteca;
USE biblioteca;
CREATE TABLE libros(
    idlibro int NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(150) NOT NULL,
    autor VARCHAR(150),
    fechapublicacion DATE,
    genero VARCHAR(150) NOT NULL,
    PRIMARY KEY (idlibro)

);
