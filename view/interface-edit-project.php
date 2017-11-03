<!DOCTYPE html>
<html>
<head>
  <title>The ToDoList Project</title>
  <meta charset="utf-8">
<!-- Responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<!-- My stylesheet -->
  <link rel="stylesheet" type="text/css" href="../view/style/home.css">
</head>
<body>

  <?php include '../view/header.php'; ?> <!--HEADER-->

  <!--FORM MODIF DE PROJET-->

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
      echo '<h3 align="center">Edit: ' . $donnees['name'] . '</h3><hr>';
?>
    <section class="add-form container-fluid row">
      <div class="col-md-4"></div>

      <form class="form-zone col-md-4" action="../model/edit-project.php?idProject=<?php echo $_GET['idProject']; ?>" method="POST">

          <div class="form-group">
            <label for="name">Edit name</label>
            <input class="form-control" type="text" name="editName" id="name" value="<?php echo $donnees['name']; ?>">
          </div>

          <div class="form-group">
            <label for="description">Edit description</label>
            <textarea class="form-control type="text" name="editDescription" id="description" rows="4"><?php echo $donnees['description']; ?></textarea>
          </div>

          <div class="form-group">
            <button class="btn btn-dark" type="submit" name="create" onclick="return confirm('Are you sure that you want to modify this project ?')">Save changes</button>
            <a href="../index/index.php" role="button" class="btn btn-outline-secondary">Back to projects</a>
          </div>


      </form>

      <div class="col-md-4"></div>
    </section>
  </div>

<?php } ?>

<!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- Bootstrap JavaScript -->
  <script src=“https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js”></script>
</body>
</html>


