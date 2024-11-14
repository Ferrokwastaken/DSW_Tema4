<!-- Israel Antonio Duque Silva -->
<?php
$user = 'projectuser';
$password = 'dsw_mola';
$db = 'projectdb';
$dsn = 'mysql:host=localhost;dbname=' . $db;
try {
  $link = new PDO($dsn, $user, $password);
  $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  die('Error en la conexión: ' . $e->getMessage());
}