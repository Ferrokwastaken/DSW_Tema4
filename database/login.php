<?php

if (isset($_GET['username']) && isset($_GET['password'])) {
  $username = $_GET['username'];
  $password = $_GET['password'];

  echo "us: $username, pass: $password";

  require 'connection.php';

  $stmt = $link->stmt_init();
  $stmt->prepare("SELECT * FROM users WHERE username=? AND password=?");
  $stmt->bind_param("ss", $username, $password);

  $stmt->execute();
  $results = $stmt->get_result();

  if ($results->num_rows > 0 ) {
    echo "<h1>Bienvenido</h1>";
  } else {
    echo "<h2>Error en el usuario y/o contraseña</h2>";
  }
  $stmt->close();
  $link->close();

  // $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'"; 
  // echo "<pre>$sql</pre>";
  // $results = $link->query($sql);
  // if ($results->num_rows > 0) {
  //   echo "<h1>Bienvenido</h1>";
  // } else {
  //   echo "<h2>Error en el usuario y/o contraseña</h2>";
  // }
  // $link->close();
} else {
  echo "No existen los parámetros";
}