<?php
include("../Database/conexion.php");
include("../funciones.php");

if (isset($_GET['codsocio'])) {
    $codsocio = $_GET['codsocio'];

    $mysql->query("DELETE FROM socios WHERE codsocio = $codsocio") or
    die("Problemas con el DELETE: " . $mysql->error());
    
    escapar($_SESSION['mensaje']  = "Socio borrado satisfactoriamente");
    $_SESSION['mensaje_type'] = 'success';
}

header("Location: ../muestrasocios.php");

?>