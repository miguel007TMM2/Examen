<?php include "auth.php"?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Clientes</title>
</head>

<body>
<?php include "nav.php" ?>
<?php

if ($_POST) {

    $name =  $_POST['name'];
    $cedula = $_POST["cedula"];
    $direccion =  $_POST["direccion"];

    $sql = "INSERT INTO `cliente` (`id`, `name`, `cedula`, `direccion`) VALUES (NULL, '$name', '$cedula', '$direccion')";
    $objConection->ejecutar($sql);

    header('location:cliente.php');
}


$sqls = "SELECT * FROM `cliente`";
$clientes= $objConection->consultar($sqls);

if ($_GET) {

    $sqlm = "DELETE FROM `cliente` WHERE `cliente`.`id` = " . $_GET['borrar'];
    $objConection->ejecutar($sqlm);

    header('location:cliente.php');
}

?>
<div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Insertar Cliente
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="cliente.php" method="post" enctype="multipart/form-data">

                                <label for="">Nombre</label>
                                <input required type="text" name="name" id="" class="form-control">
                                <br>

                                <label for="">Cedula</label>
                                <input required type="text" name="cedula" id="" class="form-control">
                                <br>
                                <label for="" class="form-label">Direccion</label>
                                <input required type="text" name="direccion" id="" class="form-control">
                                <br>
                                <input type="submit" value="Agregar cliente" class="btn btn-success">
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
                        <th>Cedula</th>
                        <th>Direccion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente) { ?>
                        <tr>
                            <td><?php echo $cliente['id']; ?></td>
                            <td><?php echo $cliente['name']; ?></td>  
                            <td><?php echo $cliente['cedula']; ?></td>
                            <td><?php echo $cliente['direccion']; ?></td>
                            <td><a name="" id="" class="btn btn-danger" href="?borrar=<?php echo $cliente['id'] ?>" role="button">Eliminar</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include "footer.php" ?>
</body>

</html>