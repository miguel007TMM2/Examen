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

    $sqlv = "SELECT * FROM `factura`";
    $facturas = $objConection->consultar($sqlv);

    



    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Facturas
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="index.php" method="post">

                                <table class="table table-striped table-bordered table-sm divScroll">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Producto</th>
                                            <th>Factura</th>
                                            <th>Precio total</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($facturas as $factura) { ?>
                                            <tr>
                                                <th><?php $sqldb = "SELECT `name` FROM `cliente` WHERE `id`=".$factura['cliente_id']; 
                                                $clientes= $objConection->consultar($sqldb);
                                                echo $clientes[0]['name'];
                                                ?></th>

                                                <td><?php $sqls = "SELECT `name` FROM `producto` WHERE `id`=".$factura['producto_id'];
                                                $resultado = $objConection->consultar($sqls);
                                                echo $resultado[0]['name']?></td>

                                                <td><?php echo $factura['id']; ?></td>
                                                <td><?php echo $factura['total']; ?></td>
                                                <td><?php echo $factura['fecha']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php" ?>
</body>

</html>