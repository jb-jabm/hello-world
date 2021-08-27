<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  <script src="utils.js"></script>
</head>

<body>
    <?php include "templates/header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-1">
                 <a href="crear.php"  class="btn btn-primary mt-4">Agregar Articulo</a>
                 <hr>
            </div>
        </div>
    </div>
      <!-- Aquí el código HTML de la aplicación -->
    <?php include "templates/footer.php"; ?>

  <div class="container">
    <div class="row" style="padding: 50px">
      <div class="col-md offset-md-1">
        <button type="button" class="btn btn-primary">Registrar</button>

      </div>
      <div class="col-md-6 offset-md-1">
        <input type="text" id="buscar" class="form-control" placeholder="Buscar articulo" aria-label="Buscar Articulo">
      </div>
      <div class="col-md-2">
        <button type="button" class="btn btn-primary" onclick="capturarBusqueda()">Buscar</button>
      </div>
    </div>
    <div class="row" style:="margin-top 20 px">

    </div>

  </div>
</body>

</html>