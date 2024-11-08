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
  <h1>Procesando carritos de compras de <?=$username?></h1>
  <h2>Se añade a 'Sales', se elimina de 'cart' y de decrementa el stock de 'Products'</h2>

  <?php
    require 'connectionPDO.php';
    try {
    $link->beginTransaction();

    $cartStmt = $link->prepare('SELECT products.id, name, price, username, amount, stock FROM products INNER JOIN cart ON products.id = cart.id WHERE username = :username');
    $cartStmt->bindParam(':username', $username);

    $insertSalesStmt = $link->prepare('INSERT INTO sales (id, username, amount, price, date) VALUES (:id, :username, :amount, :price, NOW())');
    $insertSalesStmt->bindParam(':id', $id, PDO::PARAM_INT);
    $insertSalesStmt->bindParam(':username', $username);
    $insertSalesStmt->bindParam(':amount', $amount);
    $insertSalesStmt->bindParam(':price', $price);

    $deleteCartStmt = $link->prepare('DELETE FROM cart WHERE id = :id AND username = :username');
    $deleteCartStmt->bindParam(':id', $id, PDO::PARAM_INT);
    $deleteCartStmt->bindParam(':username', $username);

    $updateStockStmt = $link->prepare('UPDATE products SET stock = :stock WHERE id = :id');
    $updateStockStmt->bindParam(':id', $id, PDO::PARAM_INT);
    $updateStockStmt->bindParam(':stock', $stock, PDO::PARAM_INT);
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
        
          $id = $row->id;
          $amount = $row->amount;
          $price = $row->price;
          $stock = $row->stock - $amount;
          if ($stock < 0) {
            throw new Exception('No hay stock');
          }
          $insertSalesStmt->execute();
          $deleteCartStmt->execute();
          $updateStockStmt->execute();
        }
        $cartStmt = null;
        $insertSalesStmt = null;
        $deleteCartStmt = null;
        $link->commit();
      } catch (Exception $e) {
        $link->rollBack();
        $e->getMessage();
      }
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