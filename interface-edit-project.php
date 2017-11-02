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
    $sql = 'SELECT * FROM projectsList ';
    $parameters = [];

    if(isset($_GET['idProject'])) {
      $sql .= 'WHERE id = ? ';
      $parameters[] = $_GET['idProject'];
    }

    $project = $tdl->prepare($sql);
    $project->execute($parameters);

    while($donnees = $project->fetch()) {
      echo $donnees['name'];
?>


</section>




<section>

    <form action="edit-project.php?idProject=<?php echo $_GET['idProject']; ?>" method="POST">
      Name edit: <input type="text" name="editName" value="<?php echo $donnees['name']; ?>"><br>
      Description edit: <input type="text" name="editDescription" value="<?php echo $donnees['description']; ?>"><br>
      <input type="submit" name="Ok" value="Save changes" onclick="return confirm('Are you sure that you want to modify this project ?')">

    </form>
</section>
<?php } ?>
</body>
</html>
