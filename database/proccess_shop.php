<?php
  require 'connectionPDO.php';

  if (isset($_POST['username'])) {
    $stmt = $link->prepare('INSERT INTO cart (id, username, amount) VALUES (:id, :username, :amount)');
    $stmt->bindParam(':id', $key);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':amount', $value);

    $username = $_POST['username'];

    foreach($_POST as $key => $value) {
      if (is_numeric($value) > 0) {
       printf('<p>clave: %s => valor: %s</p>', $key, $value);
       $stmt->execute();
      }
    }
  }
?>