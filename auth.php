<?php include "conection.php"?>

<?php 
session_start();

$objConection= new conexiones();

$sql="SELECT `name` FROM `usuarios`";

$result = $objConection->consultar($sql);

foreach($result as $admin){
    if(( isset($_SESSION['usuario']) != $admin['name'])){
        header('location:login.php');
    }
}

?>