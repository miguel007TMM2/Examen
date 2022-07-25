<?php include "auth.php" ?>

<?php

$sqls = "SELECT * FROM `factura`";
$facturas = $objConection->consultar($sqls);


?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>


    <div class="container">
        <div class="row my-3 justify-content-center">
            <div class="col-md-12">

                <div class="alert alert-success my-3" role="alert">
                    Lista completa de facturas.
                </div>

                <table class="table my-3"">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">#Factura</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($facturas as $factura) { ?>
                    
                            <tr>
                                <th><?php $sqldb = "SELECT `name` FROM `cliente` WHERE `id`=" . $factura['cliente_id'];
                                    $clientes = $objConection->consultar($sqldb);
                                    echo $clientes[0]['name'];
                                    ?></th>
                                <td><?php echo $factura['id']; ?></td>
                           
                                
                                <td><?php echo $factura['fecha']; ?></td>
                                <td><a name="" id="" class="btn btn-primary" href="detalleFactura.php?id=<?php echo $factura['id'] ?>" role="button">Ver</a>
                                </td>
                                
                            </tr>

                            
                        <?php } ?>
                    </tbody>
                </table>



            </div>
        </div>
    </div>

</body>

</html>