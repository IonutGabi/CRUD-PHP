<?php
include("../Database/conexion.php");
include("../funciones.php");
csrf();
siEsAleatorioElCsrf($_POST['submit'], $_SESSION['csrf'], $_POST['csrf']);
include("./validaciones.php");
include("../includes/header.php");
?>
<?php
if (isset($_SESSION['mensaje']) && (isset($_POST['submit']))) {
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
            <?php session_unset(); ?>
        </div>
    </div>
    <?php
} ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4">Introducir libro</h2>
            <hr>
            <form method="post">
                <div class="form-group mb-3">
                    <input type="text" name="titulo" class="form-control" placeholder="Titulo del libro">
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="autor" class="form-control" placeholder="Autor">
                </div>

                <div class="form-group mb-3">
                    <input type="text" name="fechapublicacion" class="form-control" placeholder="Fecha de publicación">
                </div>

                <div class="form-group mb-3">
                    <input type="text" name="genero" class="form-control" placeholder="Género">
                </div>
                <div class="form-group">
                    <input type="hidden" name="csrf" value="<?php echo escapar($_SESSION['csrf']); ?>">
                    <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
                    <a class="btn btn-primary" href="../index.php">Volver a la página principal</a>
                </div>
                <?php
                if (isset($_POST['submit'])) {
                    $errores = [];
                    $errores[] = validarTitulo($_POST['titulo']);
                    $errores[] = validarAutor($_POST['autor']);
                    $errores[] = validarFecha($_POST['fechapublicacion']);
                    $errores[] = validarGenero($_POST['genero']);

                    ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php
                            if (isset($errores)) {
                                foreach ($errores as $error) {
                                    echo '<li>' . $error . '</li>';

                                }
                                die();
                            }
                }
                ?>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>

<?php
if (isset($_POST['submit']) && empty($error)) {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $fechaPublicacion = $_POST['fechapublicacion'];
    $genero = $_POST['genero'];


    $consulta = "INSERT INTO libros(titulo,autor,fechapublicacion,genero) VALUES ('$titulo','$autor','$fechaPublicacion','$genero')";
    $mysql->query($consulta) or
        die($mysql->error($mysql));
    $mysql->close();
}


escapar($_SESSION['mensaje'] = 'Libro insertado con éxito');
$_SESSION['mensaje_type'] = 'success';
?>