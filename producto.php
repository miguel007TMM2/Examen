<?php include "auth.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Producto</title>
</head>

<body>
    <?php include "nav.php" ?>

    <?php

    if ($_POST) {

        $name =  $_POST['name'];
        $descripcion = $_POST["descripcion"];
        $precioProducto =  $_POST["precio"];

        $sql = "INSERT INTO `producto` (`id`, `name`, `descripcion`, `precio_unitario`) VALUES (NULL, '$name', '$descripcion', $precioProducto)";
        $objConection->ejecutar($sql);

        header('location:producto.php');
    }


    $sqls = "SELECT * FROM `producto`";
    $resultado = $objConection->consultar($sqls);

    if ($_GET) {

        $sqlm = "DELETE FROM `producto` WHERE `producto`.`id` = " . $_GET['borrar'];
        $objConection->ejecutar($sqlm);

        header('location:producto.php');
    }

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Insertar productos
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="producto.php" method="post" enctype="multipart/form-data">

                                <label for="">Nombre del producto </label>
                                <input required type="text" name="name" id="" class="form-control">
                                <br>

                                <label for="">Descripcion del producto</label>
                                <input required type="text" name="descripcion" id="" class="form-control">
                                <br>
                                <label for="" class="form-label">Precio del producto</label>
                                <input required type="number" name="precio" id="" class="form-control">
                                <br>
                                <input type="submit" value="Insertar" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <table class="table table-striped table-bordered table-sm divScroll">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $datos) { ?>
                        <tr>
                            <td><?php echo $datos['id']; ?></td>
                            <td><?php echo $datos['name']; ?></td>  
                            <td><?php echo $datos['descripcion']; ?></td>
                            <td><?php echo $datos['precio_unitario']; ?></td>
                            <td><a name="" id="" class="btn btn-danger" href="?borrar=<?php echo $datos['id'] ?>" role="button">Eliminar</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
        <?php include "footer.php" ?>
</body>

</html>