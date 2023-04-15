<?php

include("conexion.php");

if (isset($_GET['idlibro'])) {
    $registros = $mysql->query("SELECT idlibro, titulo, autor, fechapublicacion,genero  FROM libros WHERE idlibro = '$_GET[idlibro]'") or
    die($mysql->error($mysql));
    if ($reg = $registros->fetch_array()) {
    
}
?>

<?php
include("./funciones.php"); 
csrf();
if (isset($_GET['libro']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
    die();
}
include("./includes/header.php"); 
?>

<?php
if (isset($_SESSION['mensaje']) && isset($_POST['submit']))  {
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
<?php }?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4">Editando el libro <?php echo $reg['titulo'];?></h2>
            <hr>
            <form method="post">
                <input type="hidden" name="idlibro" value="<?php echo $_REQUEST['idlibro'];?>" >
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" name="titulo" id="titulo" value="<?php echo $reg['titulo'];?>">
                </div>
                <br>
                <div class="form-group">
                    <label for="autor">Autor</label>
                    <input type="text" name="autor" id="autor" value="<?php echo $reg['autor'];?>">
                </div>
                <br>
                <div class="form-group">
                    <label for="fechapublicacion">Fecha de publicación</label>
                    <input type="text" name="fechapublicacion" id="fechapublicacion" value="<?php echo $reg['fechapublicacion'];?>">
                </div>
                <br>
                <div class="form-group">
                    <label for="genero">Género</label>
                    <input type="text" name="genero" id="genero" value="<?php echo $reg['genero'];?>">
                </div>
                <br>
                <div class="form-group">
                    <input type="hidden" name="csrf" value="<?php echo escapar($_SESSION['csrf']);?>">
                    <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
                    <a href="index.php" class="btn btn-primary">Volver a la página principal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php }

if (isset($_POST['submit'])) {
    $mysql->query("UPDATE libros SET
                            titulo = '$_POST[titulo]',
                            autor = '$_POST[autor]',
                            fechapublicacion = '$_POST[fechapublicacion]',
                            genero = '$_POST[genero]'
                    WHERE idlibro = '$_REQUEST[idlibro]'") or
        die($mysql->error($mysql));
}

escapar($_SESSION['mensaje'] = 'Libro actulizado satisfactoriamente');
$_SESSION['mensaje_type'] = 'success'
?>
<?php include("./includes/footer.php");?>