<?php
include("./Database/conexion.php");
include("./funciones.php");
csrf();
siEsAleatorioElCsrf($_POST['submit'], $_SESSION['csrf'], $_POST['csrf']);
include("./includes/header.php");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-3">Lista de Socios</h2>
            <hr>
            <form action="./motor/consulta_socio.php" method="post" class="form-inline">
                <div class="form-group mt-3">
                    <input type="text" name="codsocio" placeholder="Buscar por el código de socio" class="form-control">
                </div>
                <input type="hidden" name="csrf" value="<?php echo escapar($_SESSION['csrf']); ?>">
                <button type="submit" name="submit" class="btn btn-primary mt-3 mb-3">Consultar</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código de socio</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>DNI</th>
                            <th>Fecha de nacimiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT codsocio, nombre, apellidos, 
                                CONCAT('****', SUBSTR(dni, -3)) AS dni, DATE_FORMAT(fechanacimiento, '%d/%m/%Y') AS fechanacimiento
                                FROM socios";

                        $registros = $mysql->query($consulta) or
                            die("Problemas con la consulta SELECT: " . $mysql->error());

                        while ($reg = $registros->fetch_array()) { ?>
                            <tr>
                                <td>
                                    <?php echo $reg['codsocio']; ?>
                                </td>
                                <td>
                                    <?php echo $reg['nombre']; ?>
                                </td>
                                <td>
                                    <?php echo $reg['apellidos']; ?>
                                </td>
                                <td>
                                    <?php echo $reg['dni']; ?>
                                </td>
                                <td>
                                    <?php echo $reg['fechanacimiento']; ?>
                                </td>
                                <td>
                                    <a href="../motor/edit_socio.php?codsocio=<?php echo $reg['codsocio']; ?>"
                                        class="btn btn-secondary">
                                        <i class="fa-solid fa-square-pen"></i>
                                    </a>

                                    <a href="../motor/delete_socio.php?codsocio=<?php echo $reg['codsocio']; ?>"
                                        onclick="return confirm('¿Esta seguro de que quiere eliminar este registro?')"
                                        class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        $mysql->close()
                            ?>
                    </tbody>
                </table>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary" href="./index.php">Volver a la página principal</a>
                </div>
        </div>
    </div>
</div>
<?php include("./includes/footer.php"); ?>