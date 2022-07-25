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

    if (isset($_POST['insertar'])) {

        $name =  $_POST['name'];
        $descripcion = $_POST["descripcion"];
        $precioProducto =  $_POST["precio"];

        $sql = "INSERT INTO `producto` (`id`, `name`, `descripcion`, `precio_unitario`) VALUES (NULL, '$name', '$descripcion', $precioProducto)";
        $objConection->ejecutar($sql);

        header('location:producto.php');
    }


    $sqls = "SELECT * FROM `producto`";
    $resultado = $objConection->consultar($sqls);

    if (isset($_GET['borrar'])) {

        
        $sqlm = "DELETE FROM `producto` WHERE `producto`.`id` = " . $_GET['borrar'];
        $objConection->ejecutar($sqlm);

        // header('location:producto.php');
    }

    if(isset($_POST['id_edit'])){

        if((isset($_POST['name_edit'])) && ($_POST['name_edit'] != $_POST['name_product'])){
            $nameEdit=$_POST['name_edit'];
            echo $sqlm = "UPDATE producto SET  `name`='$nameEdit' WHERE `id` = " . $_POST['id_edit'];
            $objConection->ejecutar($sqlm);
        }

        if(isset($_POST['descripcion_edit']) && ($_POST['descripcion_edit'] != $_POST['descripcion_product'])){
            $descripcionEdit=$_POST['descripcion_edit'];
            echo $sqlm = "UPDATE producto SET  `descripcion`='$descripcionEdit' WHERE `id` = " . $_POST['id_edit'];
            $objConection->ejecutar($sqlm);
        }

        if(isset($_POST['precio_unitario_edit']) && (($_POST['precio_unitario_edit'] != $_POST['precio_unitario_product']))){
            $precio_unitarioEdit=(int)$_POST['precio_unitario_edit'];
            echo $sqlm = "UPDATE producto SET  `precio_unitario`=$precio_unitarioEdit WHERE `id` = " . $_POST['id_edit'];
            $objConection->ejecutar($sqlm);
        }

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
                                <input required type="float" name="precio" id="" class="form-control">
                                <br>
                                <input type="hidden" name="insertar">
                                <input type="submit" value="Insertar" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-header">
                    Lsita de productos
                </div>
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
                        <?php foreach ($resultado as $datos) {
                            if (!isset($_POST['id_product'])) { ?>
                            <form action="producto.php" method="post">
                            <tr>
                                    <td><?php echo $datos['id']; ?><input type="hidden" name="id_product" value="<?php echo $datos['id']; ?>"></td>
                                    <td><?php echo $datos['name']; ?><input type="hidden" name="name_product" value="<?php echo $datos['name']; ?>"></td>
                                    <td><?php echo $datos['descripcion']; ?><input type="hidden" name="descripcion_product" value="<?php echo $datos['descripcion']; ?>"></td>
                                    <td><?php echo $datos['precio_unitario']; ?><input type="hidden" name="precio_unitario_product" value="<?php echo $datos['precio_unitario']; ?>"><input type="hidden" name="editar"></td>
                                    <td><input  class="btn btn-primary" type="submit" value="Editar"> | <a name="" id="" class="btn btn-danger" href="?borrar=<?php echo $datos['id'] ?>" role="button">Eliminar</a></td>
                                </tr>
                            </form>
                                
                        <?php }
                        } ?>
                        <?php if (isset($_POST['id_product'])) {?>

                            <form action="producto.php" method="post">
                                <tr>
                                    <td><?php echo $_POST['id_product'] ?><input type="hidden" name="id_edit" value="<?php echo $_POST['id_product']; ?>"></td>
                                    <td><input type="text" name="name_edit" value="<?php echo $_POST['name_product']; ?>" id=""></td>
                                    <td><input type="text" name="descripcion_edit" value="<?php echo $_POST['descripcion_product']; ?>" id=""></td>
                                    <td><input type="float" name="precio_unitario_edit" value="<?php echo $_POST['precio_unitario_product']; ?>" id=""></td>

                                    <td><input type="submit" value="Save" class="btn btn-primary"></td>
                                </tr>
                            </form>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include "footer.php" ?>
</body>

</html>