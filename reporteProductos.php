<?php include "auth.php" ?>

<?php 

$sqls = "SELECT * FROM `producto`";
$productos = $objConection->consultar($sqls);


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
	Lista completa de Productos
</div>

<table class="table my-3">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Precio</th>
  
    </tr>
  </thead>
  <tbody>
   
    <?php foreach($productos as $producto) { ?> 
    <tr>
      <td><?php echo $producto['id'] ?></td>
      <td><?php echo $producto['name'] ?></td>
      <td><?php echo $producto['descripcion'] ?></td>
      <td><?php echo $producto['precio_unitario'] ?></td>

    </tr>
    <?php } ?>
    
  </tbody>
</table>



</div>
</div>
</div>

</body>

</html>