<!-- Israel Antonio Duque Silva -->
<?php include 'menu.php'; ?>
<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asignaciones</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Asignaciones al proyecto</h1>
  <table>
    <thead>
      <?php
        if (!empty($_GET['project_id'])) {
          $projectID = $_GET['project_id'];

          $projectsStatement = $link->prepare('SELECT name, max_hours FROM projects WHERE project_id = ' . $projectID);
          $projectsStatement->execute();
          $projectRecovery = $projectsStatement->fetchAll(PDO::FETCH_OBJ);
          foreach($projectRecovery as $project) {
            printf('<tr> <th colspan="3">%s</th> </tr> <tr> <td colspan="3">Horas máximo: <strong>%d</strong></td> </tr>', $project->name, $project->max_hours);
          }
          $projectsStatement = null;
        }
      ?>
      <!-- <tr>
        <th colspan="3">Nombre del proyecto</th>
      </tr>
      <tr>
        <td colspan="3">Horas máximo: <strong>300</strong></td>
      </tr> -->
      <tr>
        <th>Empleado</th>
        <th>Horas</th>
        <th>Cargo</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="3">No hay empleados asignados a este proyecto</td>
      </tr>
      <tr>
        <td>Nombre empleado</td>
        <td>23</td>
        <td>Cargo del empleado</td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <th>Horas asignadas:</th>
        <td>23</td>
        <td></td>
      </tr>
      <tr>
        <form action="assignments.php?project_id=<?=$projectID;?>" method="post">
          <td>
            <select name="employee_id">
              <option disabled selected>Elige un empleado...</option>
              <?php
                $employeesStatement = $link->prepare('SELECT name FROM employees');
                $employeesStatement->execute();
                $pickUpEmployees = $employeesStatement->fetchAll(PDO::FETCH_OBJ);

                foreach($pickUpEmployees as $employee) {
                  printf('<option value="">%s</option>', $employee->name);
                }
              ?>
              <!-- <option value="">Nombre empleado</option> -->
            </select>
          </td>
          <td>
            <input type="number" name="hours" value="0" min="0" max="3">
          </td>
          <td>
            <button type="submit">Asignar</button>
            <input type="hidden" name="" value="">
          </td>
        </form>
      </tr>
    </tfoot>
  </table>
  <?php
    $employeesStatement = null;
    $link = null;
  ?>
</body>
</html>