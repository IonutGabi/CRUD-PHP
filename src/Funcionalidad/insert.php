<?php
include("../Database/conexion.php"); 
include("../funciones.php");
csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
    die();
}
include("../includes/header.php");
?>
<?php
if (isset($_SESSION['mensaje']) && (isset($_POST['submit']))) {
?>
<div class="container mt-3">
    <div class="row">
    <div class="col-md-12">
        <div class="alert alert-<?=$_SESSION['mensaje_type'] ?> alert-dismissible fade show" role="alert">
        <?=$_SESSION['mensaje'];
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    </div>
</div>
<?php
}?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4">Introducir libro</h2>
            <hr>
            <form method="post">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" name="titulo" id="titulo" class="form-control">
                </div>
                <br />
                <div class="form-group">
                    <label for="autor">Autor</label>
                    <input type="text" name="autor" id="autor" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="fechapublicacion">Fecha de publicación</label>
                    <input type="text" name="fechapublicacion" id="fechapublicacion" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="genero">Género</label>
                    <input type="text" name="genero" id="genero" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <input type="hidden" name="csrf" value="<?php echo escapar($_SESSION['csrf']);?>">
                    <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
                    <a class="btn btn-primary" href="../index.php">Volver a la página principal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>

<?php

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$fechaPublicacion = $_POST['fechapublicacion'];
$genero = $_POST['genero'];

$consulta = "INSERT INTO libros(titulo,autor,fechapublicacion,genero) VALUES ('$titulo','$autor','$fechaPublicacion','$genero')";

if (isset($_POST['submit'])) {

    $mysql->query($consulta) or
        die($mysql->error($mysql));

        $mysql->close();
}

escapar($_SESSION['mensaje'] = 'Libro insertado con éxito');
$_SESSION['mensaje_type'] = 'success';


?>