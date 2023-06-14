<?php

include("../Database/conexion.php");

if (isset($_GET['idlibro'])) {

    $consulta = "SELECT * FROM libros WHERE idlibro = '$_GET[idlibro]'";

    $registros = $mysql->query($consulta) or
        die($mysql->error($mysql));
    if ($reg = $registros->fetch_array()) {

    }
    ?>

    <?php
    include("../funciones.php");
    csrf();
    siEsAleatorioElCsrf($_POST['submit'], $_SESSION['csrf'], $_POST['csrf']);
    include("../includes/header.php");
    ?>

    <?php
    if (isset($_SESSION['mensaje']) && isset($_POST['submit'])) {
        ?>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-<?= $_SESSION['mensaje_type'] ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['mensaje'];
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-4">Editando el libro
                    <?php echo $reg['titulo']; ?>
                </h2>
                <hr>
                <form method="post">
                    <div class="form-group mb-3">
                        <label for="titulo">Titulo</label>
                        <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $reg['titulo']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="autor">Autor</label>
                        <input type="text" class="form-control" name="autor" id="autor" value="<?php echo $reg['autor']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="fechapublicacion">Fecha de publicación</label>
                        <input type="text" class="form-control" name="fechapublicacion" id="fechapublicacion"
                            value="<?php echo $reg['fechapublicacion']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="genero">Género</label>
                        <input type="text" class="form-control" name="genero" id="genero" value="<?php echo $reg['genero']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="csrf" value="<?php echo escapar($_SESSION['csrf']); ?>">
                        <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
                        <a href="../index.php" class="btn btn-primary">Volver a la página principal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php }

if (isset($_POST['submit'])) {

    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $fechaPublicacion = $_POST['fechapublicacion'];
    $genero = $_POST['genero'];
    $idlibro = $_REQUEST['idlibro'];

    $consulta = "UPDATE libros SET titulo = '$titulo',autor = '$autor',fechapublicacion = '$fechaPublicacion',genero = '$genero' WHERE idlibro = '$idlibro'";

    $mysql->query($consulta) or
        die($mysql->error($mysql));
}

escapar($_SESSION['mensaje'] = 'Libro actulizado satisfactoriamente');
$_SESSION['mensaje_type'] = 'success'
    ?>
<?php include("../includes/footer.php"); ?>