<?php
include("./conexion.php");
include("./funciones.php");
csrf();

if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
    die();
}

include("./includes/header.php");


?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="insert.php" class="btn btn-primary mt-4">Introducir libro</a>
            <hr/>
            <form action="consulta.php" method="post" class="form-inline">
                <div class="form-group mr-3">
                    <input type="text" name="idlibro" id="idlibro" placeholder="Buscar por el ID del libro" class="form-control">
                </div>
                <input type="hidden" name="csrf" value="<?php echo escapar($_SESSION['csrf']);?>">
                <br>
                <button type="submit" name="submit" class="btn btn-primary">Consultar</button>
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
                    
                    $registros = $mysql->query("SELECT idlibro, titulo, autor, DATE_FORMAT(fechapublicacion,'%d/%m/%Y') AS fechapublicacion, genero FROM libros") or
                    die($mysql->error($mysql));
                    
                    while ($reg = $registros->fetch_array()) { ?>
                    <tr>
                        <td><?php echo $reg['idlibro'];?></td>
                        <td><?php echo $reg['titulo']; ?></td>
                        <td><?php echo $reg['autor']; ?></td>
                        <td><?php echo $reg['fechapublicacion']; ?></td>
                        <td><?php echo $reg['genero']; ?></td>
                        <td>
                            <a href="edit.php?idlibro=<?php echo $reg['idlibro'];?>" class="btn btn-secondary" >
                                <i class="fa-solid fa-square-pen"></i>
                            </a>
                            
                            <a href="delete.php?idlibro=<?php echo $reg['idlibro'];?>" class="btn btn-danger">
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

<?php include("includes/footer.php");?>