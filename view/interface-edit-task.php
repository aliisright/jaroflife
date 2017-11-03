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
  <link rel="stylesheet" type="text/css" href="../view/style/tasks.css">
</head>
<body>

  <?php include '../view/header.php'; ?> <!--HEADER-->

  <!--FORM MODIF DE TACHE-->

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
      echo '<h3 align="center">Edit: ' . $donnees['name'] . '</h3><hr>';
?>
    <section class="add-form container-fluid row">
      <div class="col-md-4"></div>

      <form class="form-zone col-md-4" action="../model/edit-task.php?idTask=<?php echo $_GET['idTask']; ?>&idProject=<?php echo $_GET['idProject']; ?>" method="POST">

          <div class="form-group">
            <label for="name">Edit name</label>
            <input class="form-control" type="text" name="editName" id="name" value="<?php echo $donnees['name']; ?>">
          </div>

          <div class="form-group">
            <label for="description">Edit description</label>
            <textarea class="form-control type="text" name="editDescription" id="description" rows="4"><?php echo $donnees['description']; ?></textarea>
          </div>

          <div class="form-group">
          <select class="form-control" name="priority" id="priority">
                        <option value="" disabled="disabled" selected="selected">Select</option>
                        <option value="1">Urgent</option>
                        <option value="2">High</option>
                        <option value="3">Medium</option>
                        <option value="4">Low</option>
                        <option value="5">Not a priority</option>
            </select>
          </div>

          <div class="form-group">
            <button class="btn btn-dark" type="submit" name="create" onclick="return confirm('Are you sure that you want to modify this task ?')">Save changes</button>
            <a href="interface-tasks.php?idProject=<?php echo $_GET['idProject']; ?>" role="button" class="btn btn-outline-secondary">Back to tasks</a>
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
