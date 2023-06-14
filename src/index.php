<?php
include("./Database/conexion.php");
include("funciones.php");
csrf();
siEsAleatorioElCsrf($_POST['submit'], $_SESSION['csrf'], $_POST['csrf']);
include("./includes/header.php");
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="./motor/insert.php" class="btn btn-primary mt-4">Introducir libro</a>
            <a href="./motor/insert_socio.php" class="btn btn-primary mt-4">Hacerse socio</a>
            <a href="./motor/insert_prestamo.php" class="btn btn-primary mt-4">Hacer un préstamo</a>
            <hr />
            <form action="./motor/consulta.php" method="post" class="form-inline">
                <div class="form-group mr-3">
                    <input type="text" name="idlibro" id="idlibro" placeholder="Buscar por el ID del libro"
                        class="form-control">
                </div>
                <input type="hidden" name="csrf" value="<?php echo escapar($_SESSION['csrf']); ?>">
                <button type="submit" name="submit" class="btn btn-primary mt-4">Consultar</button>
                <a href="./muestrasocios.php" class="btn btn-primary mt-4">Ver socios</a>
                <a href="./prestamos.php" class="btn btn-primary mt-4">Ver préstamos</a>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-3">Listado de libros</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>idlibro</th>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Fecha de publicación</th>
                        <th>Género</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $consulta = "SELECT idlibro, titulo, autor, DATE_FORMAT(fechapublicacion, '%d/%m/%Y') AS fechapublicacion, genero FROM libros";

                    $registros = $mysql->query($consulta) or
                        die("Problemas con la consulta SELECT: " . $mysql->error());

                    while ($reg = $registros->fetch_array()) { ?>
                        <tr>
                            <td>
                                <?php echo $reg['idlibro']; ?>
                            </td>
                            <td>
                                <?php echo $reg['titulo']; ?>
                            </td>
                            <td>
                                <?php echo $reg['autor']; ?>
                            </td>
                            <td>
                                <?php echo $reg['fechapublicacion']; ?>
                            </td>
                            <td>
                                <?php echo $reg['genero']; ?>
                            </td>
                            <td>
                                <a href="./motor/edit.php?idlibro=<?php echo $reg['idlibro']; ?>"
                                    class="btn btn-secondary">
                                    <i class="fa-solid fa-square-pen"></i>
                                </a>

                                <a href="./motor/delete.php?idlibro=<?php echo $reg['idlibro']; ?>" onclick="return confirm('¿Esta seguro de que quiere eliminar este registro?')" 
                                    class="btn btn-danger">
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
        </div>
    </div>
</div>

<?php include("./includes/footer.php"); ?>