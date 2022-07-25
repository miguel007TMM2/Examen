<?php include "auth.php" ?>

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

    if (isset($_POST['insertar'])) {

        $name =  $_POST['name'];
        $cedula = $_POST["cedula"];
        $direccion =  $_POST["direccion"];


        $sql = "INSERT INTO `cliente` (`id`, `name`, `cedula`, `direccion`) VALUES (NULL, '$name', '$cedula', '$direccion')";
        $objConection->ejecutar($sql);

        header('location:cliente.php');
    }


    $sqls = "SELECT * FROM `cliente`";
    $clientes = $objConection->consultar($sqls);

    if (isset($_GET['borrar'])) {

        try{

            $sqlm = "DELETE FROM `cliente` WHERE `cliente`.`id` = " . $_GET['borrar'];
            $objConection->ejecutar($sqlm);
            

        }catch(PDOException $error){
           echo "<div class='alert alert-danger' role='alert'>
                No se puede elimnar el cliente
            </div>";

           
        }
        
        header('location:cliente.php');
    }

    if(isset($_POST['id_edit'])){

        if((isset($_POST['name_edit'])) && ($_POST['name_edit'] != $_POST['name_client'])){
            $nameEdit=$_POST['name_edit'];
            echo $sqlm = "UPDATE cliente SET  `name`='$nameEdit' WHERE `id` = " . $_POST['id_edit'];
            $objConection->ejecutar($sqlm);
        }

        if(isset($_POST['cedula_edit']) && ($_POST['cedula_edit'] != $_POST['cedula_client'])){
            $cedulaEdit=$_POST['cedula_edit'];
            echo $sqlm = "UPDATE cliente SET  `cedula`='$cedulaEdit' WHERE `id` = " . $_POST['id_edit'];
            $objConection->ejecutar($sqlm);
        }



        if(isset($_POST['direccion_edit']) && (($_POST['direccion_edit'] != $_POST['direccion_client']))){
            $direccionEdit=$_POST['direccion_edit'];
            echo $sqlm = "UPDATE cliente SET  `direccion`= '$direccionEdit' WHERE `id` = " . $_POST['id_edit'];
            $objConection->ejecutar($sqlm);
        }

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
                       
                                <input type="hidden" name="insertar">
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
                        <?php foreach ($clientes as $cliente) {
                            if (!isset($_POST['id_client'])) { ?>
                                <form action="cliente.php" method="post">
                                    <tr>
                                        <td><?php echo $cliente['id']; ?><input type="hidden" name="id_client" value="<?php echo $cliente['id']; ?>"></td>
                                        <td><?php echo $cliente['name']; ?><input type="hidden" name="name_client" value="<?php echo $cliente['name']; ?>"></td>
                                        <td><?php echo $cliente['cedula']; ?><input type="hidden" name="cedula_client" value="<?php echo $cliente['cedula']; ?>"></td>
                                       
                                        <td><?php echo $cliente['direccion']; ?><input type="hidden" name="direccion_client" value="<?php echo $cliente['direccion']; ?>"></td>
                                        <td><input class="btn btn-primary" type="submit" value="Editar"> | <a name="" id=""  class="btn btn-danger" href="?borrar=<?php echo $cliente['id'] ?>" role="button">Eliminar</a></td>
                                    </tr>
                                </form>
                        <?php }
                        } ?>
                        <?php if (isset($_POST['id_client'])) { ?>
                            <form action="cliente.php" method="post">
                                <tr>
                                    <td><?php echo $_POST['id_client'] ?><input type="hidden" name="id_edit" value="<?php echo $_POST['id_client']; ?>"></td>
                                    <td><input type="text" name="name_edit" value="<?php echo $_POST['name_client']; ?>" id=""></td>
                                    <td><input type="text" name="cedula_edit" value="<?php echo $_POST['cedula_client']; ?>" id=""></td>
                                
                                    <td><input type="float" name="direccion_edit" value="<?php echo $_POST['direccion_client']; ?>" id=""></td>

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