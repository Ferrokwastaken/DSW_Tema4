<!-- Israel Antonio Duque Silva -->
<?php include 'menu.php'; ?>
<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Proyecto</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Crear un proyecto</h1>
  <form action="create-project-statement.php" method="post">
    <fieldset>
      <legend>Nuevo proyecto</legend>
      <p>
        <label for="">Nombre: </label>
        <input type="text" name="name">
      </p>
      <p>
        <label for="">Horas máximo:</label>
        <input type="number" name="hours">
      </p>
      <p>
        <button type="submit" name="create">Crear</button>
      </p>
    </fieldset>
  </form>
  <!-- <div class="success"><h2>Proyecto creado con éxito</h2></div>
  <div class="error"><h2>Error al crear el proyecto</h2><p>Aquí viene el tipo de error<p></div> -->
</body>
</html>