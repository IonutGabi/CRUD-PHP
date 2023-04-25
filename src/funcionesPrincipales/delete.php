<?php

include("../conexion.php");
include("../funciones.php");

if (isset($_GET['idlibro'])) {
    $idlibro = $_GET['idlibro'];
    $mysql->query("DELETE FROM libros WHERE idlibro = $idlibro") or
    die("Problemas con la consulta: " . $mysql->error());

    escapar($_SESSION['mensaje'] = 'Libro borrado satisfactoriamente');
    $_SESSION['mensaje_type'] = 'danger';
    header("Location: ../index.php");
    
}
?>