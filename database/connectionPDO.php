<?php
$user = 'shopuser';
$password = '9128';
$dsn = "mysql:host=localhost;dbname=shop";

try {
  $link = new PDO($dsn, $user, $password);
  $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
  die ("Error en la conexion: " . $ex->getMessage());
}

