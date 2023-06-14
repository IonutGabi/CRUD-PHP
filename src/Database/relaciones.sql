USE biblioteca;
ALTER TABLE prestamos ADD CONSTRAINT fk_prestamoslibro FOREIGN KEY (codlibro) REFERENCES libros (idlibro);
ALTER TABLE prestamos ADD CONSTRAINT fk_prestamossocio FOREIGN KEY (codsocio) REFERENCES socios (codsocio);