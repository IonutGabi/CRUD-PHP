<?php
include("../Database/conexion.php");

if (isset($_GET['numprestamo'])) {
    $numprestamo = $_GET['numprestamo'];

    $consulta = "SELECT * FROM prestamos WHERE numprestamo = $numprestamo";

    $registros = $mysql->query($consulta) or
        die("Problemas con la consulta SELECT: " . $mysql->error());

    if ($reg = $registros->fetch_array()) {

    }
    ?>

    <?php
    include("../funciones.php");
    csrf();

    siEsAleatorioElCsrf($_POST['submit'], $_SESSION['csrf'], $_POST['csrf']);

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
                <h2 class="mt-4">Editando el prestámo con id
                    <?php echo $reg['numprestamo']; ?>
                </h2>
                <hr>
                <form method="post">
                    <div class="form-group mb-3">
                        <label for="fechasalida">Fecha de salida</label>
                        <input type="text" name="fechasalida" class="form-control" id="fechasalida"
                            value="<?php echo $reg['fechasalida']; ?>">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="fechadevolucion">Fecha de devolución</label>
                        <input type="text" name="fechadevolucion" id="fechadevolucion" class="form-control"
                            value="<?php echo $reg['fechadevolucion']; ?>">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="codlibro">Código del libro</label>
                        <input type="text" name="codlibro" id="codlibro" class="form-control"
                            value="<?php echo $reg['codlibro']; ?>">
                    </div>
                
                    <div class="form-group mb-3">
                        <label for="codsocio">Código del socio</label>
                        <input type="text" name="codsocio" id="codsocio" class="form-control"
                            value="<?php echo $reg['codsocio']; ?>">
                    </div>
                    
                    <div class="form-group">
                        <input type="hidden" name="csrf" value="<?php echo escapar($_SESSION['csrf']); ?>">
                        <input type="submit" name="submit" class="btn btn-primary" value="Editar">
                        <a href="../prestamos.php" class="btn btn-primary">Vovler a la página de prestámos</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}
if (isset($_POST['submit'])) {
    $fechasalida = $_POST['fechasalida'];
    $fechadevolucion = $_POST['fechadevolucion'];
    $codlibro = $_POST['codlibro'];
    $codsocio = $_POST['codsocio'];

    $consulta = "UPDATE prestamos SET fechasalida = '$fechasalida', fechadevolucion = '$fechadevolucion', codlibro = '$codlibro', codsocio = $codsocio 
                    WHERE numprestamo = '$numprestamo'";

    $mysql->query($consulta) or
        die("Problemas con la consulta UPDATE: " . $mysql->error());
}

escapar($_SESSION['mensaje'] = 'Prestámo modificado con éxito');
$_SESSION['mensaje_type'] = 'success';
?>