<?php 
  require_once 'connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Producto</title>
</head>
<body>
  <h1>Modificar Producto</h1>
  <?php
    if (!empty($_GET['id']) && !empty($_GET['name']) && !empty($_GET['price'])) {
      $results = $link->query('SELECT * FROM products WHERE id = ' . $_GET['id']);
      $product = $results->fetch_object();
      if ($product) {
  ?>
  <form action="update.php?id=<?=$_GET['id']?>" method="post">
    <input type="hidden" name="id" value="<?=$_GET['id']?>">
  <p>
    <input type="text" name="name" value="<?=$_GET['name'] ?>" maxlength="30">
  </p>
  <p>
    <input type="numbe" name="price" id="" step="0.01" value="<?=$_GET['price'] ?>">
  </p>
  <p>
    <button type="submit">Modificar</button>
  </p>
  </form>
  <?php
      }
    }
  ?>
  <p>
    <a href="read.php">Volver a la tabla</a>
  </p>
</body>
</html>