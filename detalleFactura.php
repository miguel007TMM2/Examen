<?php include "auth.php" ?>
<?php

$sqls = "SELECT * FROM `factura_producto` WHERE `factura_producto`.`factura_id`=" . $_GET['id'];
$productos = $objConection->consultar($sqls);

$sqlv = "SELECT * FROM `factura`  WHERE `id`=" . $_GET['id'];
$facturas = $objConection->consultar($sqlv);


$sqlname = "SELECT `name` FROM `cliente` WHERE `id`=" . $facturas[0]['cliente_id'];
$sqlnames = $objConection->consultar($sqlname);

$total = 0;
$importe = 0;

?>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style type="text/css">
        body {
            background-color: #fff;

        }

        container {
            text-align: center;
        }
    </style>
</head>
<div class="container">
    <div class="row my-3 justify-content-center">
        <div class="col-md-12">

            <div class="alert alert-success my-3" role="alert">
                Productos
            </div>

            <table class="table my-3">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $datos) {
                    ?>
                        <tr>
                            <td><?php echo $datos['name']; ?></td>
                            <td><?php echo $datos['precio']; ?></td>
                            <td><?php echo $datos['cantiadad']; ?></td>
                        </tr>

                    <?php
                        $importe = $datos['precio'] * $datos['cantiadad'];
                        $total += $importe;
                    } ?>

                </tbody>
            </table>
            <hr />
            <div class="alert alert-success" role="alert">
                <?php echo "Cliente: <b>" . $sqlnames[0]['name'] . "</b><br/> Total de la factura --> $" . number_format($total) ?>
            </div>
        </div>
    </div>
</div>

</body>

</html>