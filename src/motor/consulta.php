<?php
include("../Database/conexion.php");
include("../funciones.php");
include("../includes/header.php");

$idlibro = $_POST['idlibro'];

if (isset($idlibro))

    $consulta = "SELECT idlibro, titulo, autor, DATE_FORMAT(fechapublicacion, '%d/%m/%Y') AS fechapublicacion, genero FROM libros WHERE idlibro = $idlibro";

$registros = $mysql->query($consulta) or
    die($mysql->error());

while ($reg = $registros->fetch_array()) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-3">Información del libro</h2>
                <table class="table table-bordered">
                    <thead>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Fecha de publicación</th>
                        <th>Género</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <td>
                            <?php echo $reg['titulo']; ?>
                        </td>
                        <td>
                            <?php echo $reg['autor']; ?>
                        </td>
                        <td>
                            <?php echo $reg['fechapublicacion']; ?>
                        </td>
                        <td>
                            <?php echo $reg['genero']; ?>
                        </td>
                        <td>
                            <a href="edit.php?idlibro=<?php echo $reg['idlibro']; ?>" class="btn btn-secondary">
                                <i class="fa-solid fa-square-pen"></i>
                            </a>
                            <a href="delete.php?idlibro=<?php echo $reg['idlibro']; ?>" class="btn btn-danger">
                                <i class="fa-solid fa-trash" onclick="return confirm('¿Esta seguro de que quiere eliminar este registro?')"></i>
                            </a>
                        </td>

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-primary" href="../index.php">Volver a la página de inicio</a>
                </div>
            </div>
        </div>
    </div>
<?php }
include("../includes/footer.php");
?>