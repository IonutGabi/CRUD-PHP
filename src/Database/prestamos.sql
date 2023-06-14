USE biblioteca;

CREATE TABLE prestamos 
(
    numpedido INT AUTO_INCREMENT,
    fechasalida DATE NOT NULL,
    fechadevolucion DATE NOT NULL,
    diasmaximo INT NOT NULL,
    codlibro INT NOT NULL,
    codsocio INT NOT NULL,
    PRIMARY KEY (numpedido)
);