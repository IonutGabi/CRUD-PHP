<?php
include("../Database/conexion.php");
include("../funciones.php");
csrf();
siEsAleatorioElCsrf($_POST['submit'], $_SESSION['csrf'], $_POST['csrf']);
include("./validaciones.php");
include("../includes/header.php");

if (isset($_SESSION['mensaje']) && $_POST['submit']) {
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
}
?>

<link rel="stylesheet" href="../css/styles.css">
<div class="modal-dialog text-center">
    <div class="col-sm-8 seccion-principal">
        <div class="modal-content">
            <div class="col-12 user-image">
                <img src="../images/user.png" alt="">
            </div>
            <form class="col-12" method="post">
                <div class="form-group">
                    <input type="text" name="nombre" class="form-control-lg" placeholder="Nombre" />
                </div>
                <div class="form-group informacionpersonal">
                    <input type="text" name="apellidos" class="form-control-lg" placeholder="Apellidos" />
                </div>

                <div class="form-group informacionpersonal">
                    <input type="text" name="fechanacimiento" class="form-control-lg" placeholder="Fecha de nacimiento">
                </div>

                <div class="form-group informacionpersonal">
                    <input type="text" name="dni" class="form-control-lg" placeholder="DNI">
                </div>

                <div class="form-group informacionpersonal">
                    <input type="hidden" name="csrf" value="<?php echo escapar($_SESSION['csrf']); ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary" id="button" value="Enviar"><i
                        class="fas fa-sign-in-alt"></i> Registrarse</button>
                <a class="btn btn-primary" href="../muestrasocios.php">Volver a la lista de socios</a>
                <?php
                if (isset($_POST['submit'])) {
                    $errores = [];
                    $errores[] = validarNombre($_POST['nombre']);
                    $errores[] = validarApellidos($_POST['apellidos']);
                    $errores[] = validarFecha($_POST['fechanacimiento']);
                    $errores[] = validarDNI($_POST['dni']);
                
               
                ?>
                <div class="alert alert-danger" role="alert" >
                    <ul>
                        <?php
                        if (isset($errores)) {
                            foreach ($errores as $error)
                            {
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

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fechaNacimiento = $_POST['fechanacimiento'];
    $dni = $_POST['dni'];

    $consulta = "INSERT INTO socios(nombre,apellidos,dni,fechanacimiento,domicilio) VALUES( '$nombre', '$apellidos',  '$dni' , '$fechaNacimiento')";


    $mysql->query($consulta) or
        die($mysql->error($mysql));
    $mysql->close();

}
escapar($_SESSION['mensaje'] = "Socio insertado con éxito");
$_SESSION['mensaje_type'] = 'success';
?>