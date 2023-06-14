<?php
include("../Database/conexion.php");
include("../funciones.php");
include("../includes/header.php");

$numprestamo = $_POST['numprestamo'];

if (isset($numprestamo))

    $consulta = "SELECT numprestamo, DATE_FORMAT(fechasalida, '%d/%m/%Y') AS fechasalida, DATE_FORMAT(fechadevolucion, '%d/%m/%Y') AS fechadevolucion , DATEDIFF(fechadevolucion, fechasalida) AS diasmaximo, socios.nombre, libros.titulo
FROM ((prestamos INNER JOIN libros ON prestamos.codlibro = libros.idlibro) INNER JOIN socios ON prestamos.codsocio = socios.codsocio) WHERE numprestamo = $numprestamo";

$registros = $mysql->query($consulta) or
    die("Problemas con el SELECT: " . $mysql->error());

while ($reg = $registros->fetch_array()) {
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-3">Informacion del préstamo</h2>
            </div>
            <table class="table table-bordered">
                <thead>
                    <th>Fecha de salida</th>
                    <th>Fecha de devolución</th>
                    <th>Días máximos para devolución</th>
                    <th>Nombre del socio</th>
                    <th>Titulo del libro</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $reg['fechasalida']; ?>
                        </td>
                        <td>
                            <?php echo $reg['fechadevolucion']; ?>
                        </td>
                        <td>
                            <?php echo $reg['diasmaximo']; ?>
                        </td>
                        <td>
                            <?php echo $reg['nombre']; ?>
                        </td>
                        <td>
                            <?php echo $reg['titulo']; ?>
                        </td>
                        <td>
                            <a href="./edit_prestamo.php?numprestamo=<?php echo $reg['numprestamo']; ?>"
                                class="btn btn-secondary">
                                <i class="fa-solid fa-square-pen"></i>
                            </a>

                            <a href="./delete_prestamo.php?numprestamo=<?php echo $reg['numprestamo']; ?>"
                                onclick="return confirm('¿Esta seguro de que quiere eliminar este registro?')"
                                class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-primary" href="../prestamos.php">Volver a la lista de prestámos</a>
            </div>
        </div>
    </div>
<?php }
include("../includes/footer.php");
?>