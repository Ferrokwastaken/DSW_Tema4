<?php
  require_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>¿Lectura?</title>
  <style>
    th, td {
      border: 1px solid black;
      padding: 4px 10px;
    }

    table {
      border-collapse: collapse;
    }
  </style>
</head>
<body>
  <h1>Tabla de Productos</h1>
  <p>
    <a href="create.html">Crear nuevo producto</a>
  </p>
  <table>
    <thead>
      <tr>
        <th>id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th colspan="2">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $results = $link->query('SELECT * FROM products ORDER BY price DESC');
        while ($product = $results->fetch_object()) {
          echo "<tr>";
          printf('<td>%d</td>', $product->id);
          printf('<td>%s</td>', $product->name);
          printf('<td>%.2f€</td>', $product->price);
          printf('<td><a href="delete.php?id=%d">eliminar</a></td>', $product->id);
          printf('<td><a href="edit.php?id=%d&name=%s&price=%.2f">editar</a></td>', $product->id, $product->name, $product->price);
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>
</body>
</html>