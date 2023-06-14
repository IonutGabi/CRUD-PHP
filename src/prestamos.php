<?php
include("./Database/conexion.php");
include("./funciones.php");
include("./includes/header.php");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-3">Préstamos</h2>
            <hr>
            <form action="./motor/consulta_prestamo.php" method="post" class="form-inline">
                <div class="form-group mt-3">
                    <input type="text" name="numprestamo" placeholder="Buscar por el número de préstamo" class="form-control">
                </div>
                <input type="hidden" name="csrf" value="<?php echo escapar($_SESSION['csrf']); ?>">
                <button type="submit" name="submit" class="btn btn-primary mt-3 mb-3">Consultar</button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Número del préstamo</th>
                        <th>Fecha de salida</th>
                        <th>Fecha de devolución</th>
                        <th>Días máximos para devolución</th>
                        <th>Nombre del socio</th>
                        <th>Titulo del libro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $consulta = "SELECT numprestamo, DATE_FORMAT(fechasalida, '%d/%m/%Y') AS fechasalida, DATE_FORMAT(fechadevolucion, '%d/%m/%Y') AS fechadevolucion , DATEDIFF(fechadevolucion, fechasalida) AS diasmaximo, socios.nombre, libros.titulo
                                FROM ((prestamos INNER JOIN libros ON prestamos.codlibro = libros.idlibro) INNER JOIN socios ON prestamos.codsocio = socios.codsocio)";
                    
                    $registros = $mysql->query($consulta) or
                        die("Problemas con la consulta SELECT: " . $mysql->error());

                        while ($reg = $registros->fetch_array()) {
                    ?>
                    <tr>
                       
                        <td><?php echo $reg['numprestamo']?></td>
                        <td><?php echo $reg['fechasalida']?></td>
                        <td><?php echo $reg['fechadevolucion']?></td>
                        <td><?php echo $reg['diasmaximo']?></td>
                        <td><?php echo $reg['nombre']?></td>
                        <td><?php echo $reg['titulo']?></td>
                        <td>
                        <a href="./motor/edit_prestamo.php?numprestamo=<?php echo $reg['numprestamo'];?>" class="btn btn-secondary" >
                                <i class="fa-solid fa-square-pen"></i>
                            </a>
                            
                            <a href="./motor/delete_prestamo.php?numprestamo=<?php echo $reg['numprestamo'];?>"  onclick="return confirm('¿Esta seguro de que quiere eliminar este registro?')" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                    }
                    $mysql->close();
                    ?>
                </tbody>
            </table>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end" >
            <a class="btn btn-primary" href="./index.php">Volver a la página principal</a>
            </div>
        </div>
    </div>
</div>
<?php include("./includes/footer.php");?>