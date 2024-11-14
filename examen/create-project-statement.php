<!-- Israel Antonio Duque Silva -->
<?php include 'menu.php'; ?>
<?php
  require 'connection.php';

  if (!empty($_POST['name']) && !empty($_POST['hours'])) {
    try {
      $projectName = $_POST['name'];
      $projectHours = $_POST['hours'];
  
      $insertProjectStatement = $link->prepare('INSERT INTO projects (project_id, name, max_hours) VALUES (NULL, :name, :max_hours)');
      $insertProjectStatement->bindParam(':name', $projectName);
      $insertProjectStatement->bindParam(':max_hours', $projectHours);
      $insertProjectStatement->execute();

      if ($insertProjectStatement) {
        printf('<div class="success"><h2>Proyecto creado con éxito<h2></div>');
      }
    } catch (Exception $err) {
      die('<div class="error"><h2>Error al crear el proyecto<h2> ' . $err->getMessage() . '</div>');
    }
    $insertProjectStatement = null;
    $link = null;
  }
?>

<p><a href="create-project.php">Volver al menú de creación de proyectos</a></p>