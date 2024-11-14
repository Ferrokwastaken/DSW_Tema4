<!-- Israel Antonio Duque Silva -->
<?php include 'menu.php'; ?>
<?php 
  require 'connection.php'; 

  if (!empty($_GET['project_id'])) {
    try {
      $id = $_GET['project_id'];
      $deleteStatement = $link->prepare('DELETE FROM projects WHERE project_id = ' . $id);
      $deleteStatement->execute();
  
      if ($deleteStatement) {
        printf('<div class="success"><h2>Proyecto eliminado con éxito</h2></div>');
      }
    } catch (Exception $err) {
      die('<div class="error"><h2>Error al borrar</h2> ' . $err->getMessage() . '</div>');
    }
    $deleteStatement = null;
    $link = null;
  }
?>

<p><a href="projects.php">Volver a la tabla de proyectos</a></p>