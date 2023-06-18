<?php
include("../Database/conexion.php");

if (isset($_GET['codsocio'])) {
    $consulta = "SELECT * FROM socios WHERE codsocio = '$_GET[codsocio]'";
    
    $registros = $mysql->query($consulta) or
    die($mysql->error());

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
<?php }?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4">Editando a <?php echo escapar($reg['nombre']);?>
            </h2>
            <hr>
            <form method="post">
                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $reg['nombre'];?>">
                </div>
                <div class="form-group mb-3">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?php echo $reg['apellidos'];?>">
                </div>
                <div class="form-group mb-3">
                    <label for="dni">DNI</label>
                    <input type="text" class="form-control" name="dni" id="dni" value="<?php echo $reg['dni'];?>">
                </div>
                <div class="form-group mb-3">
                    <label for="fechanacimiento">Fecha de nacimiento</label>
                    <input type="text" class="form-control" name="fechanacimiento" id="fechanacimiento" value="<?php echo $reg['fechanacimiento'];?>">
                    
                <div class="form-group mt-3">
                    <input type="hidden" name="csrf" value="<?php echo escapar($_SESSION['csrf']);?>">
                    <input type="submit" name="submit" class="btn btn-primary" value="Modificar">
                    <a href="../muestrasocios.php" class="btn btn-primary">Volver a la tabla de socios</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php }
    if (isset($_POST['submit'])) {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $fechanacimiento = $_POST['fechanacimiento'];

        $consulta = "UPDATE socios SET nombre = '$nombre', apellidos = '$apellidos', dni = '$dni', fechanacimiento = '$fechanacimiento'
                    WHERE codsocio = '$_GET[codsocio]'";

        $mysql->query($consulta) or 
        die("Error en la consulta del SELECT: " . $mysql->error());
    }
    escapar($_SESSION['mensaje'] = 'Socio actualizado satisfactoriamente');
    $_SESSION['mensaje_type'] = 'success';

    include("../includes/footer.php");
 ?>