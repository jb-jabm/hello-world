<?php
include 'utils.php';
include 'config.php';
include 'funciones.php';
$dbConn = connect($db);

if (isset($_POST['submit'])) {

  if ($_POST['nombre'] == "" || $_POST['descripcion'] == "" || $_POST['precio'] == "" || $_POST['cantidad'] == "") {
    $resultado['error'] = true;
    $resultado['mensaje'] = "Debe llenar todos los campos";
  }else{
    $articulo = array(
      "nombre" => $_POST['nombre'],
      "descripcion" => $_POST['descripcion'],
      "precio" => $_POST['precio'],
      "cantidad" => $_POST['cantidad'],
    );
    $sql = "INSERT INTO articulos (nombre, descripcion, precio, cantidad) VALUES (:" . implode(", :", array_keys($articulo)) . ")";
    $statement = $dbConn->prepare($sql);
    $statement->execute($articulo);
    $resultado['error'] = false;
    $resultado['mensaje'] = "Registro existoso";
  } 
}
?>
<?php include "templates/header.php";

if (isset($resultado)) {
?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Agregar articulo</h2>
      <hr>
      <form method="post">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
        </div>
        <div class="form-group">
          <label for="descripcion">Descripcion</label>
          <input type="text" name="descripcion" id="descripcion" class="form-control">
        </div>
        <div class="form-group">
          <label for="precio">Precio</label>
          <input type="text" name="precio" id="precio" class="form-control">
        </div>
        <div class="form-group">
          <label for="cantidad">Cantidad</label>
          <input type="text" name="cantidad" id="cantidad" class="form-control">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" value="registrar">
          <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
          <div class="form-group">
          </div>
      </form>
    </div>
  </div>
</div>
<?php include "templates/footer.php"; ?>