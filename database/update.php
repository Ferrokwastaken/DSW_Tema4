<?php
  if (!empty($_GET['id']) && !empty($_POST['name']) && !empty($_POST['price'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $id = $_GET['id'];

    require_once 'connection.php';
    $updateSQL = "UPDATE products SET name = '$name', price = $price WHERE id = $id";
    $link->query($updateSQL);
    echo "Se ha actualizado con éxito el producto $name con el precio $price con el id: $id";
  }
?>

<p>
  <a href="read.php">Volver a la tabla</a>
</p>