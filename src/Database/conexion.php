<?php

session_start();

$mysql = new mysqli("basedatos", "gabi", "Gabrelutu12.", "biblioteca" );

if ($mysql->connect_error)
    die("Problemas con la conexión a la base de datos");

?>