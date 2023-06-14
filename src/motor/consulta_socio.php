<?php
include("../Database/conexion.php");
include("../funciones.php");
include("../includes/header.php");

$codsocio = $_POST['codsocio'];

if (isset($codsocio))

    $consulta = "SELECT codsocio, nombre, apellidos, CONCAT('****', SUBSTR(dni, -3)) AS dni, DATE_FORMAT(fechanacimiento, '%d/%m/%Y') AS fechanacimiento FROM socios
            WHERE codsocio = $codsocio";

$registros = $mysql->query($consulta) or
    die("Problemas con el SELECT: " . $mysql->error());

while ($reg = $registros->fetch_array()) {
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-3">Información del socio</h2>
            </div>
            <table class="table table-bordered ms-3">
                <thead>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Fecha de nacimiento</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $reg['nombre']; ?>
                        </td>
                        <td>
                            <?php echo $reg['apellidos']; ?>
                        </td>
                        <td>
                            <?php echo $reg['dni']; ?>
                        </td>
                        <td>
                            <?php echo $reg['fechanacimiento']; ?>
                        </td>
                        <td>
                            <a href="../motor/edit_socio.php?codsocio=<?php echo $reg['codsocio']; ?>"
                                class="btn btn-secondary">
                                <i class="fa-solid fa-square-pen"></i>
                            </a>

                            <a href="../motor/delete_socio.php?codsocio=<?php echo $reg['codsocio']; ?>"
                                onclick="return confirm('¿Esta seguro de que quiere eliminar este registro?')"
                                class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-primary" href="../muestrasocios.php">Volver a la lista de socios</a>
            </div>
        </div>
    </div>
<?php }
include("../includes/footer.php");
?>