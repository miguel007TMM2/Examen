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

    $totalfactura = 0;

    if (isset($_POST['p_id'])) {
        if ((!empty($_POST['cantidad'])) && ($_POST['cantidad'] != 0) && ($_POST['cantidad'] >= 1)) {
            $sqlm = "SELECT * FROM `producto` WHERE `producto`.`id` = " . $_POST['p_id'];

            $producto = $objConection->consultar($sqlm);

            $name = $producto[0]['name'];
            $descripcion = $producto[0]['descripcion'];
            $precio_unitario = $producto[0]['precio_unitario'];


            $cantidadProducto = (int)$_POST['cantidad'];
            $sqlc = "INSERT INTO `productotemporal` (`id`, `name`, `precio_unitario`, `descripcion`, `cantidad`) VALUES (NULL, '$name',  $precio_unitario, '$descripcion',$cantidadProducto )";

            $objConection->ejecutar($sqlc);

            header('location:index.php');
        } else {
            echo "<script>alert('La cantidad tiene que ser Mayor o diferente de 0');</script>";
        }
    }

    if (isset($_POST['yes'])) {


        $sqlm = "DELETE FROM `productotemporal` WHERE `productotemporal`.`id` = " . $_POST['borrar'];
        $objConection->ejecutar($sqlm);

        header('location:index.php');
    }


    if (isset($_POST['clienteSelect'])) {

        $sqlTotalProductos = "SELECT * FROM `productotemporal`";
        $allProductos = $objConection->consultar($sqlTotalProductos);


        if (isset($allProductos[0]['name'])) {

            $clienteSelect = $_POST['clienteSelect'];

            $sqlfactura = "INSERT INTO `factura` (`id`, `fecha`, `cliente_id`) VALUES (NULL, current_timestamp(), $clienteSelect);";
            $objConection->ejecutar($sqlfactura);

            $sqlfacturaId = "SELECT id FROM `factura` WHERE `id`=(SELECT max(`id`) FROM `factura`)";
            $facturaId = $objConection->consultar($sqlfacturaId);

            $facturaID = $facturaId[0]['id'];

            foreach ($allProductos as $soultProducto) {
                $nameP = $soultProducto['name'];
                $precioP = (float)$soultProducto['precio_unitario'];
                $cantidadP = (int)$soultProducto['cantidad'];
                $sqlfactura_producto = "INSERT INTO `factura_producto` (`id`, `name`, `precio`, `cantiadad`,`factura_id`) VALUES (NULL, '$nameP' , $precioP, $cantidadP,   $facturaID);";
                $objConection->ejecutar($sqlfactura_producto);
                print_r($soultProducto);
            }

            foreach ($allProductos as $allProducto) {
                $sqlDelete = "DELETE FROM `productotemporal` WHERE `productotemporal`.`id` = " . $allProducto['id'];
                $objConection->ejecutar($sqlDelete);
            }


            header('location:reporteFacturas.php');
        } else {
            echo "<script>alert('Tiene que agragar un producto al carrito.');</script>";
        }
    }
    switch (isset($_POST)) {
        case isset($_POST['id_search']):
            $sqlproductosSearch = "SELECT * FROM `producto` WHERE `id`=" . $_POST['id_search'];
            $sqlproductoSearch = $objConection->consultar($sqlproductosSearch);
            break;
        case isset($_POST['name_search']):
            $name_search =  $_POST['name_search'];
            $sqlproductosSearch = "SELECT * FROM `producto` WHERE `name`= '$name_search'";
            $sqlproductoSearch = $objConection->consultar($sqlproductosSearch);
            break;

        case isset($_POST['precio_search']):
            if (is_numeric($_POST['precio_search'])) {
                $sqlproductosSearch = "SELECT * FROM `producto` WHERE `precio_unitario`=" . $_POST['precio_search'];
                $sqlproductoSearch = $objConection->consultar($sqlproductosSearch);
                break;
            }
            break;
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <nav class="navbar navbar-light bg-light">
                            <?php if (!isset($_POST['searchSelect'])) { ?>
                                <form class="form-inline" method="POST">
                                    <button class="btn btn-outline-success my-2 my-sm-2" type="button" name="back" onclick="clickMe()">Atras</button>
                                    <label for="">Tipo de busqueda</label>
                                    <select name="searchSelect" id="" >

                                        <option value="id">ID</option>
                                        <option value="name">Nombre</option>
                                        <option value="precio">Precio</option>

                                    </select>
                                    <input type="hidden" name="selected">
                                    <button class="btn btn-outline-success my-2 my-sm-2" type="submit">Seleccionar</button>
                                </form>
                            <?php } ?>
                            <?php if ((isset($_POST['searchSelect'])) && ($_POST['searchSelect'] == "id")) { ?>
                                <form action="index.php" method="post">
                                    <button class="btn btn-outline-success my-2 my-sm-2" type="button" name="back" onclick="clickMe()">Atras</button>
                                    <input type="number" name="id_search" required placeholder="ID">
                                    <button class="btn btn-outline-success my-2 my-sm-2" type="submit" name="search">Buscar</button>
                                </form>
                            <?php } ?>
                            <?php if ((isset($_POST['searchSelect'])) && ($_POST['searchSelect'] == "name")) { ?>
                                <form action="index.php" method="post">
                                    <button class="btn btn-outline-success my-2 my-sm-2" type="button" name="back" onclick="clickMe()">Atras</button>
                                    <input type="text" name="name_search" required placeholder="Name">
                                    <button class="btn btn-outline-success my-2 my-sm-2" type="submit" name="search">Buscar</button>
                                </form>
                            <?php } ?>
                            <?php if ((isset($_POST['searchSelect'])) && ($_POST['searchSelect'] == "precio")) { ?>
                                <form action="index.php" method="post">
                                    <button class="btn btn-outline-success my-2 my-sm-2" type="button" name="back" onclick="clickMe()">Atras</button>
                                    <input type="float" name="precio_search" required placeholder="precio">
                                    <button class="btn btn-outline-success my-2 my-sm-2" type="submit" name="search">Buscar</button>
                                </form>
                            <?php } ?>
                        </nav>
                    </div>
                    <script>
                        function clickMe() {
                            window.location.href = "index.php"
                        }
                    </script>
                    <div class="card-body">
                        <div class="container">
                            <table class="table table-striped table-bordered table-sm divScroll">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descriccion</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!isset($sqlproductoSearch)) {
                                        foreach ($resultado as $datos) { ?>
                                            <form action="index.php" method="POST">
                                                <tr>
                                                    <td><?php echo $datos['id']; ?></td>
                                                    <td><?php echo $datos['name']; ?></td>
                                                    <td><?php echo $datos['descripcion']; ?></td>
                                                    <td><?php echo "$" . $datos['precio_unitario']; ?></td>
                                                    <td><input class="col-md-4" type="number" name="cantidad" required><input type="hidden" name="p_id" value="<?php echo $datos['id'] ?>"></td>
                                                    <td> <input type="submit" value="Agregar al carrito" class="btn btn-primary"></td>
                                                </tr>
                                            </form>
                                    <?php }
                                    } ?>
                                    <?php if (isset($sqlproductoSearch)) { ?>
                                        <?php if ((isset($_POST['id_search'])) && (isset($sqlproductoSearch))) {
                                            foreach ($sqlproductoSearch as $sqlproducto) { ?>
                                                <form method="POST">
                                                    <tr>
                                                        <td><?php echo $sqlproducto['id']; ?></td>
                                                        <td><?php echo $sqlproducto['name']; ?></td>
                                                        <td><?php echo $sqlproducto['descripcion']; ?></td>
                                                        <td><?php echo "$" . $sqlproducto['precio_unitario']; ?></td>
                                                        <td><input class="col-md-4" type="number" name="cantidad" required><input type="hidden" name="p_id" value="<?php echo $sqlproducto['id'] ?>"></td>
                                                        <td> <input type="submit" value="Agregar al carrito" class="btn btn-primary"></td>
                                                    </tr>
                                                </form>
                                        <?php }
                                        } ?>
                                        <?php if (isset($_POST['name_search'])) {
                                            foreach ($sqlproductoSearch as $sqlproducto) { ?>
                                                <form method="POST">
                                                    <tr>
                                                        <td><?php echo $sqlproducto['id']; ?></td>
                                                        <td><?php echo $sqlproducto['name']; ?></td>
                                                        <td><?php echo $sqlproducto['descripcion']; ?></td>
                                                        <td><?php echo "$" . $sqlproducto['precio_unitario']; ?></td>
                                                        <td><input class="col-md-4" type="number" name="cantidad" required><input type="hidden" name="p_id" value="<?php echo $sqlproducto['id'] ?>"></td>
                                                        <td> <input type="submit" value="Agregar al carrito" class="btn btn-primary"></td>
                                                    </tr>
                                                </form>
                                        <?php }
                                        } ?>
                                        <?php if (isset($_POST['precio_search'])) {
                                            foreach ($sqlproductoSearch as $sqlproducto) { ?>
                                                <form method="POST">
                                                    <tr>
                                                        <td><?php echo $sqlproducto['id']; ?></td>
                                                        <td><?php echo $sqlproducto['name']; ?></td>
                                                        <td><?php echo $sqlproducto['descripcion']; ?></td>
                                                        <td><?php echo "$" . $sqlproducto['precio_unitario']; ?></td>
                                                        <td><input class="col-md-4" type="number" name="cantidad" required><input type="hidden" name="p_id" value="<?php echo $sqlproducto['id'] ?>"></td>
                                                        <td> <input type="submit" value="Agregar al carrito" class="btn btn-primary"></td>
                                                    </tr>
                                                </form>
                                        <?php }
                                        } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Carrito de compras
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-sm divScroll">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mostrarCarrito as $productosCarrito) { ?>
                                        <form action="index.php" method="POST">
                                            <tr>
                                                <td><?php echo $productosCarrito['name']; ?></td>
                                                <td><?php echo $productosCarrito['descripcion']; ?></td>
                                                <td><?php echo $productosCarrito['precio_unitario']; ?></td>
                                                <td><?php echo $productosCarrito['cantidad']; ?></td>
                                                <td><?php
                                                    $importe = $productosCarrito['precio_unitario'] *  $productosCarrito['cantidad'];
                                                    $totalfactura += $importe;
                                                    echo "$" . number_format($importe);
                                                    ?></td>
                                                <td><?php if (!isset($_POST['btn_borrar'])) { ?>
                                                        <input type="submit" value="Eliminar" class="btn btn-danger" name="btn_borrar">
                                                    <?php } ?> <?php if (isset($_POST['btn_borrar'])) { ?>
                                                        <input class="btn btn-success" type="submit" name="yes" value="YES"> |
                                                        <input class="btn btn-primary" type="submit" name="no" value="NO">
                                                        <input type="hidden" name="borrar" value="<?php echo $productosCarrito['id'] ?>">
                                                    <?php } ?>

                                                </td>
                                            </tr>
                                        </form>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                Total: <?php echo "$" . number_format($totalfactura)
                                        ?>
                        </div>
                    </div>

                </div>
                <form action="index.php" method="post">
                    <label for="">Seleccione un cliente</label>
                    <select name="clienteSelect" id="">

                        <?php foreach ($clientes  as  $cliente) { ?>
                            <option value="<?php echo $cliente['id'] ?>"><?php echo $cliente['name'] ?></option>

                        <?php } ?>
                    </select>
                    <input type="hidden" name="selected">
                    <input type="submit" value="Realizar compra" class="btn btn-success">
                </form>
            </div>
        </div>
        <?php include "footer.php" ?>
</body>

</html>