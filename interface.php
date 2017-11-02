<!DOCTYPE html>
<html>
<head>
  <title>ToDoList</title>
  <meta charset="utf-8">
</head>
<body>

<?php
include 'connexion-bdd.php';
?>
<h1>To Do List!</h1>
<hr>
<section>
  <h3>Create a project</h3>
  <form action="add-project.php" method="POST">
    Project name: <input type="text" name="name"><br>
    Project description: <input type="text" name="description"><br>

    <input type="submit" name="create">
  </form>
</section>

<section>
  <h3>Your projects</h3>
  <?php
  $projects = $tdl->query('SELECT * FROM projectslist ORDER BY date_creation DESC');
  ?>
   <table border="1">
      <tr>
        <th>Project</th>
        <th>Description</th>
        <th>Creation date</th>
        <th>Last modification</th>
      </tr>
  <?php
  while($donnees = $projects->fetch()) {
    ?>
      <tr>
        <td> <?php echo $donnees['name'] ?> </td>
        <td> <?php echo $donnees['description'] ?> </td>
        <td> <?php echo $donnees['date_creation'] ?> </td>
        <td> <?php echo $donnees['date_last_modification'] ?> </td>
        <td>  <a href ="interface-tasks.php?idProject= <?php echo $donnees['id'] ?>">Go to</a> </td>
        <td> <a href ="delete-project.php?idProject= <?php echo $donnees['id'] ?>" onclick="return confirm('Are you sure that you want to delete this project ?')">Delete</a> </td>
        <td> <a href ="interface-edit-project.php?idProject= <?php echo $donnees['id']; ?>">Edit</a> </td>
      </tr>
  <?php
  }

  $projects->closeCursor();
  ?>
  </table>
</section>


</body>
</html>
