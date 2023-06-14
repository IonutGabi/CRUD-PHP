<?php
include("../Database/conexion.php");
include("../funciones.php"); 

if (isset($_GET['numprestamo'])) {
    $numprestamo = $_GET['numprestamo'];
    $mysql->query("DELETE FROM prestamos WHERE numprestamo = $numprestamo") or
            die("Problemas con el DELETE: " . $mysql->error());
    escapar($_SESSION['mensaje'] = "Prestámo borrado con éxito");
    $_SESSION['mensaje_type'] = 'success';
}

header("Location: ../prestamos.php");
?>