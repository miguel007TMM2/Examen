<?php include "auth.php" ?>

<?php 

$sqls = "SELECT * FROM `cliente`";
$clientes = $objConection->consultar($sqls);


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
	Lista completa de clientes.
</div>

<table class="table my-3">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Cedula</th>
	  <th scope="col">Direccion</th>
    </tr>
  </thead>
  <tbody>
   
    <?php foreach($clientes as $cliente) { ?> 
    <tr>
      <td><?php echo $cliente['id'] ?></td>
      <td><?php echo $cliente['name'] ?></td>
      <td><?php echo $cliente['cedula'] ?></td>
      <td><?php echo $cliente['direccion'] ?></td>

    </tr>
    <?php } ?>
    
  </tbody>
</table>



</div>
</div>
</div>

</body>

</html>