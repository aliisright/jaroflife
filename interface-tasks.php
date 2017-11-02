<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

  <?php
    include 'connexion-bdd.php';
  ?>
  <h1>To Do List!</h1>
  <hr>

  <?php

    if(isset($_GET['idProject'])) {
      $nameProjet = $tdl->prepare('SELECT * FROM projectsList WHERE id = ?');
      $nameProjet->execute(array($_GET['idProject']));

      while($title = $nameProjet->fetch() ) {
  ?>
      <h3><?php echo $title['name'] . ' | N°: ' . $title['id'] ?></h3>


  <?php
      }
    }

  ?>


  <section>
  <h3> Add a Task </h3>
  <form action="add-task.php" method="POST">
    Task name: <input type="text" name="name"><br>
    Task description: <input type="text" name="description"><br>
    Priority: <select name="priority">
                  <option value="" disabled="disabled" selected="selected">Select</option>
                  <option value="5">Urgent</option>
                  <option value="4">High</option>
                  <option value="3">Medium</option>
                  <option value="2">Low</option>
                  <option value="1">Not a priority</option>
              </select>

    <input type="hidden" value="<?php echo $_GET['idProject']; ?>" name="id_project"><br>

    <input type="submit" name="create">
  </form>
  </section>

<section>
  <h3>Tasks</h3>
  <?php
    $sql = 'SELECT * FROM tasklist ';
    $parameters = [];

    if(isset($_GET['idProject'])) {
      $sql .= 'WHERE id_project = ? ';
      $parameters[] = $_GET['idProject'];
    }

    $sql .= 'ORDER BY priority DESC';

    $tasks = $tdl->prepare($sql);
    $tasks->execute($parameters);

  ?>

   <table border="1">
      <tr>
        <th>Task</th>
        <th>Description</th>
        <th>Creation date</th>
        <th>Last modification</th>
        <th>Priority</th>
      </tr>
  <?php
  while($donnees = $tasks->fetch()) {
    ?>

      <tr>
        <td> <?php echo $donnees['name'] ?></td>
        <td> <?php echo $donnees['description'] ?></td>
        <td> <?php echo $donnees['date_creation'] ?></td>
        <td> <?php echo $donnees['date_last_modification'] ?></td>
        <td> <?php echo $donnees['priority'] ?></td>
        <td> <a href ="delete-task.php?idTask=<?php echo $donnees['id']; ?>&idProject= <?php echo $donnees['id_project']; ?>" onclick="return confirm('Are you sure that you want to remove this task ?')">Delete</a> </td>
        <td> <a href ="interface-edit-task.php?idTask=<?php echo $donnees['id']; ?>&idProject= <?php echo $donnees['id_project']; ?>">Edit</a> </td>
      </tr>

  <?php
  }

  $tasks->closeCursor();
?>
  </table>
</section>

</body>
</html>
