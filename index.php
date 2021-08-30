<?php
include 'utils.php';
include 'config.php';
$dbConn = connect($db);

if (isset($_POST['nombre'])) {
  $titulo = isset($_POST['nombre']) ? 'Lista de Articulos (' . $_POST['nombre'] . ')' : 'Lista de Articulos';
  $sql = "SELECT * FROM articulos WHERE nombre LIKE '%" . $_POST['nombre'] . "%'";
  $sentencia = $dbConn->prepare($sql);
  $sentencia->execute();
  $articulos = $sentencia->fetchAll();
} else {
  $titulo = 'Lista de Articulos';
  $sql = "SELECT * FROM articulos";
  $sentencia = $dbConn->prepare($sql);
  $sentencia->execute();
  $articulos = $sentencia->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>

<body>
    <?php include "templates/header.php"; ?>
    
  <div class="container">
    <div class="row">
        <div class="col-md-10 offset-1">
            <a href="crear.php"  class="btn btn-primary mt-4">Agregar Articulo</a>
              <hr>
              <form method="post" class="form-inline">
                <div class="form-group mr-3">
                  <input type="text" id="nombre" name="nombre" placeholder="Buscar por Nombre" class="form-control">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ver resultados</button>
              </form>
         </div>
    </div>
 </div>

 <div class="container">
  <div class="row">
    <div class="col-md-10 offset-1">
      <h2 class="mt-3"><?php echo $titulo ?></h2>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Opcion</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($articulos && $sentencia->rowCount() > 0) {
            foreach ($articulos as $fila) {
              ?>
              <tr>
                <td><?php echo ($fila["codigo"]); ?></td>
                <td><?php echo ($fila["nombre"]); ?></td>
                <td><?php echo ($fila["descripcion"]); ?></td>
                <td><?php echo ($fila["precio"]); ?></td>
                <td><?php echo ($fila["cantidad"]); ?></td>
                <td>
                   <a href="<?= 'editar.php?codigo='.$fila["codigo"]?>">✏️Editar</a>
                   <a href="<?= 'borrar.php?id=' . $fila["codigo"] ?>">🗑️Borrar</a>
                </td>
              </tr>
              <?php
            }
          }else{
          ?>
            <div class="alert alert-danger" role="alert">
              <?php echo "No encuentro la busqueda"; ?>
            </div>
            <?php
          }
          ?>
        <tbody>
      </table>
    </div>
  </div>
</div>
  <!-- Aquí el código HTML de la aplicación -->
<?php include "templates/footer.php"; ?>

</body>

</html>