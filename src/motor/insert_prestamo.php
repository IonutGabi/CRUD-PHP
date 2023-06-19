<?php
include("../Database/conexion.php");
include("../funciones.php");
csrf();
siEsAleatorioElCsrf($_POST['submit'], $_SESSION['csrf'], $_POST['csrf']);
include("./validaciones.php");
include("../includes/header.php");

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
    <?php
} ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4">Hacer Préstamo</h2>
        </div>
        <hr>
        <form method="post">
            <div class="form-group mb-3">
                <input type="text" name="fechasalida" class="form-control" placeholder="Fecha de salida" />
            </div>
            
            <div class="form-group mb-3">
                <input type="text" name="fechadevolucion" class="form-control" placeholder="Fecha de devolución">
            </div>
            
            <div class="form-group mb-3">
                <input type="text" name="codlibro" class="form-control" placeholder="Código del libro" />
            </div>
            
            <div class="form-group mb-3">
                <input type="text" name="codsocio" class="form-control" placeholder="Código del socio">
            </div>
            <div class="form-group">
                <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
                <input type="submit" name="submit" class="btn btn-primary" value="Insertar registro">
                <a class="btn btn-primary" href="../prestamos.php">Volver a la página principal</a>
            </div>
            <?php
            if (isset($_POST['submit'])) {
                $errores = [];
                $errores[] = validarFechasPrestamo($_POST['fechasalida'], $_POST['fechadevolucion']);
                $errores[] = validarCódigos($_POST['codlibro'], $_POST['codsocio']);
            
            ?>

            <div class="alert alert-danger">
                <ul>
                    <?php
                    if (isset($errores)) {
                        foreach ($errores as $error) {
                            echo '<li>' . $error . '</li>';
                        }
                        
                    }
                }
                    ?>
                </ul>
            </div>
        </form>
    </div>
</div>

<?php include("../includes/footer.php");?>

<?php
if (isset($_POST['submit']) && empty($error)) {
    $fechasalida = $_POST['fechasalida'];
    $fechadevolucion = $_POST['fechadevolucion'];
    $codlibro = $_POST['codlibro'];
    $codsocio = $_POST['codsocio'];

    $consulta = "INSERT INTO prestamos(fechasalida, fechadevolucion, codlibro, codsocio) VALUES ('$fechasalida', '$fechadevolucion', '$codlibro', '$codsocio')";

    $mysql->query($consulta) or
        die($mysql->error());
    $mysql->close();

}

escapar($_SESSION['mensaje'] = "Préstamo insertado con éxito");
$_SESSION['mensaje_type'] = 'success';
?>