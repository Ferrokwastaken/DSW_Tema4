<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carritos</title>
  <style>
    table {
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid black;
      padding: 4px 10px;
    }
  </style>
</head>
<body>
  <?php include 'menu.php';?>
  <?php
    $username = isset($_GET['username']) ? $_GET['username'] : '';
  ?>
  <h1>Carritos de compras<?=$username?></h1>
  <h2>Pendientes de procesado</h2>

  <?php
    require 'connectionPDO.php';
    $cartStmt = $link->prepare('SELECT products.id, name, price, username, amount FROM products INNER JOIN cart ON products.id = cart.id WHERE username = :username');
    $cartStmt->bindParam(':username', $username);
  ?>
  <table>
    <thead>
      <tr>
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $total = 0;
        $cartStmt->execute();
        while ($row = $cartStmt->fetchObject()) {
          $subtotal = $row->price * $row->amount;
          $total += $subtotal;
          printf('<tr> <td>%s</td> <td>%.2f€</td> <td>%d</td> <td>%.2f€</td> </tr>',
        $row->name, $row->price, $row->amount, $subtotal);
        }
        $cartStmt = null;
        $link = null;
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="3">Total</th>
        <td>
          <?= sprintf('%.2f€', $total); ?>
        </td>
      </tr>
    </tfoot>
  </table>
</body>
</html>