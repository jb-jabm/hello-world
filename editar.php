<?php
  include 'utils.php';
  include 'config.php';
  $dbConn = connect($db);
 
  
    if (!isset($_GET['codigo'])) {
        $resultado['error'] = true;
        $resultado['mensaje'] = 'El alumno no existe';
        $resultado['mensaje'] = $error->getMessage();
    }else{
        $codigo = $_GET['codigo'];
        $sql = "SELECT * FROM articulos WHERE codigo =" . $codigo;
        $sentencia = $dbConn->prepare($sql);
        $sentencia->execute();

         $articulo= $sentencia->fetch(PDO::FETCH_ASSOC);
         if (!$articulo) {
            $resultado['error'] = true;
            $resultado['mensaje'] = 'No se ha encontrado el alumno';
          }
    }

    if (isset($_POST['submit'])) {
        try {
          $articulo = [
            "codigo"=> $_GET['codigo'],
            "nombre"=> $_POST['nombre'],
            "descripcion"=> $_POST['descripcion'],
            "precio"=> $_POST['precio'],
            "cantidad"=> $_POST['cantidad']
          ];
          
          $sql = "UPDATE articulos SET
              nombre = :nombre,
              descripcion = :descripcion,
              precio = :precio,
              cantidad = :cantidad
              WHERE codigo = :codigo";
          
          $sentencia = $dbConn->prepare($sql);
          $sentencia->execute($articulo);
          $resultado['error'] = false;
          $resultado['mensaje']='Articulo actualizado exitoxamente.' ;
    
        } catch(PDOException $error) {
          $resultado['error'] = true;
          $resultado['mensaje'] = $error->getMessage();
        }
      }

?>
<?php require "templates/header.php"; 
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
<?php
  if (isset($articulo) && $articulo) {
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <h2 class="mt-4">Editando el alumno <?=$articulo['codigo'] . ' ' . $articulo['nombre']  ?></h2>    
        <hr>
        <form method="post">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= $articulo['nombre'] ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" value="<?= $articulo['descripcion'] ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="precio"></label>
            <input type="text" name="precio" id="precio" value="<?= $articulo['precio'] ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="text" name="cantidad" id="cantidad" value="<?= $articulo['cantidad'] ?>" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
}
?>
<!-- código de la página -->
<?php require "templates/footer.php"; ?>