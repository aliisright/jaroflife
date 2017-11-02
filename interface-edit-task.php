<!DOCTYPE html>
<html>
<head>
  <title>Modify task</title>
</head>
<body>

<?php
include 'connexion-bdd.php';
?>
<h1>To Do List!</h1>
<hr>

<section>

  <?php
    $sql = 'SELECT * FROM taskList ';
    $parameters = [];

    if(isset($_GET['idTask'])) {
      $sql .= 'WHERE id = ? ';
      $parameters[] = $_GET['idTask'];
    }

    $task = $tdl->prepare($sql);
    $task->execute($parameters);

    while($donnees = $task->fetch()) {
      echo $donnees['name'];
?>


</section>




<section>

    <form action="edit-task.php?idTask=<?php echo $_GET['idTask']; ?>&idProject=<?php echo $_GET['idProject']; ?>" method="POST">
      Name edit: <input type="text" name="editName" value="<?php echo $donnees['name']; ?>"><br>
      Description edit: <input type="text" name="editDescription" value="<?php echo $donnees['description']; ?>"><br>
      <input type="submit" name="Ok" value="Save changes" onclick="return confirm('Are you sure that you want to modify this task ?')">

    </form>
</section>
<?php } ?>
</body>
</html>
