<?php 
  header ("HTTP/1.1 200");
  include 'utils.php';
  include 'config.php'; 
  $dbConn = connect($db);
   
  /*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
  // var_dump($_GET);
    if (isset($_GET['codigo']))
    {
      //Mostrar un post
      $sql = $dbConn->prepare("SELECT * FROM articulo where codigo=:codigo");
      $sql->bindValue(':codigo', $_GET['codigo']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
      exit();
	  }
    
    else {
      $sql = $dbConn->prepare("SELECT * FROM articulo");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      // print_r($sql->fetchAll());
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
	}
}


?>

