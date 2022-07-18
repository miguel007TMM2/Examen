<?php include "conection.php" ?>
<?php

$usuario = "";
$password = "";

$objConection = new conexiones();
session_start();


if ($_POST) {
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
    $password = (isset($_POST['password'])) ? $_POST['password'] : "";

    if (($usuario != "") && ($password != "")) {
        $val = json_encode($usuario);

        $sql = "SELECT `name`, `password` FROM `usuarios` WHERE `name`=$val";

        $result = $objConection->consultar($sql);

        foreach ($result as $admin) {
            if (($admin['name'] == $usuario) && ($admin['password'] == $password)) {

                $_SESSION['usuario'] = $usuario;

                header("location:index.php");
            }
        }
    } else {
        echo "<script>alert('Usuario o password incorrectos');</script>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <br>
    <div class="container position-relative">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">
                        Inicial Sesion
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="post">

                            <label for="">Usuario:</label>
                            <input type="text" name="usuario" id="" class="form-control">
                            <br>

                            <label for="">Contrasena:</label>
                            <input type="password" name="password" id="" class="form-control">
                            <br>

                            <input type="submit" value="Entrar al portafolio" class="btn btn-success">

                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>

    </div>
</body>

</html>