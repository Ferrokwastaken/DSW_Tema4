<!-- Israel Antonio Duque Silva -->
<?php include 'menu.php'; ?>
<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Proyectos</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Proyectos</h1>
  <table>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Horas máx.</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
        <?php
          $projectsStatement = $link->prepare('SELECT project_id, name, max_hours FROM projects');
          $projectsStatement->execute();
          $projects = $projectsStatement->fetchAll(PDO::FETCH_OBJ);
          foreach($projects as $project) {
            printf('<tr> <td><a href="assignments.php?project_id=%d">%s</a></td> <td>%d</td> <td><a href="delete.php?project_id=%d">Eliminar</a></td> </tr>', $project->project_id, $project->name, $project->max_hours, $project->project_id);
          }
          $projectsStatement = null;
        ?>
        <!-- <td><a href="">Nombre del proyecto</a></td>
        <td>999</td>
        <td><a href="">Eliminar</a></td> -->
    </tbody>
    <tfoot>
        <?php
          $projectsTotalHours = $link->prepare('SELECT SUM(max_hours) AS totalhours FROM projects');
          $projectsTotalHours->execute();
          $countHours = $projectsTotalHours->fetchAll(PDO::FETCH_OBJ);
          foreach ($countHours as $hours) {
            printf('<tr> <th>Horas Totales</th> <td>%d</td> <td></td> </tr>', $hours->totalhours);
          }
          $projectsTotalHours = null;
          $link = null;
        ?>
      <!-- <th>Horas totales</th>
      <td>9999</td>
      <td></td> -->
    </tfoot>
  </table>
</body>
</html>