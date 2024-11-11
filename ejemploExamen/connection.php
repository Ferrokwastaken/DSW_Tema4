<?php
  $user = 'root';
  $password = '';
  $database = 'filmdb';
  $dsn = 'mysql:host=localhost;dbname=' . $database;
  try {
    $link = new PDO($dsn, $user, $password);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (Exception $ex) {
    die('Error de conexión: ' . $ex->getMessage());
  }
?>