<?php include "auth.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Facturar</title>
</head>

<body>
    <?php include "nav.php" ?>

    <?php

    $sqls = "SELECT * FROM `producto`";
    $resultado = $objConection->consultar($sqls);

    $sqld = "SELECT * FROM `productotemporal`";
    $mostrarCarrito = $objConection->consultar($sqld);

    $sqle = "SELECT `name`, `id` FROM `cliente`";
    $clientes = $objConection->consultar($sqle);

    
    $total="";

    if (isset($_GET['agregar'])) {

        $sqlm = "SELECT * FROM `producto` WHERE `producto`.`id` = ". $_GET['agregar'];
        
        $producto= $objConection->consultar($sqlm);

        $name=$producto[0]['name'];
        $descripcion=$producto[0]['descripcion'];
        $precio_unitario=$producto[0]['precio_unitario'];

        $sqlc="INSERT INTO `productotemporal` (`id`, `name`, `precio_unitario`, `descripcion`) VALUES (NULL, '$name',  $precio_unitario, '$descripcion')";

        $objConection->ejecutar($sqlc);

        header("location:index.php");
    }

    if (isset($_GET['borrar'])) {

        $sqlm = "DELETE FROM `productotemporal` WHERE `productotemporal`.`id` = " . $_GET['borrar'];
        $objConection->ejecutar($sqlm);

        header('location:index.php');
    }

    if($_POST){

        $sqlTotalProducto ="SELECT SUM(precio_unitario) FROM `productotemporal`";
        $totaProductos = $objConection->consultar($sqlTotalProducto);

        $total= $totaProductos;
        $total = $total[0]['SUM(precio_unitario)'];

        $clienteSelect= $_POST['clienteSelect'];

        $sqlfactura ="INSERT INTO `factura` (`id`, `fecha`, `total`, `cliente_id`, `producto_id`) VALUES (NULL, current_timestamp(), $total, $clienteSelect);";
        $objConection->ejecutar($sqlfactura);

    }   

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Productos disponibles
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="index.php" method="post">

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
                                                <td><a name="" id="" class="btn btn-primary" href="?agregar=<?php echo $datos['id'] ?>" role="button">Agregar al carrito</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form action="index.php" method="post">
                <table class="table table-striped table-bordered table-sm divScroll">
                    <thead>
                        <tr>

                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Total</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mostrarCarrito as $productosCarrito) { ?>
                            <tr>
                                <td><?php echo $productosCarrito['name']; ?></td>
                                <td><?php echo $productosCarrito['descripcion']; ?></td>
                                <td><?php echo $productosCarrito['precio_unitario']; ?></td>
                                <td><a name="" id="" class="btn btn-danger" href="?borrar=<?php echo $productosCarrito['id'] ?>" role="button">Eliminar</a></td>
                            </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
                <label for="">Seleccione un cliente</label>
                <select name="clienteSelect" id="">
                 <?php foreach( $clientes  as  $cliente){?>
                    <option value="<?php echo $cliente['id']?>"><?php echo $cliente['name']?></option>
                 <?php }?>
                </select>
                
                <input type="submit" value="Realizar compra" class="btn btn-success">                        
                </form>
                
            </div>
        </div>
        <?php include "footer.php" ?>
</body>

</html>