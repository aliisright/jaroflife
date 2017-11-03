<!DOCTYPE html>
<html>
<head>
<title>My list</title>
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

<!--AJOUT TACHE-->
  <section class="form-task container-fluid row">
    <div class="col"></div>
    <div class="col">
      <?php

        if(isset($_GET['idProject'])) {
          $nameProjet = $tdl->prepare('SELECT * FROM projectsList WHERE id = ?');
          $nameProjet->execute(array($_GET['idProject']));

          while($title = $nameProjet->fetch() ) {
      ?>
            <!--Nom de projet-->
            <h3 align="center"><?php echo $title['name'] . ' | N°: ' . $title['id'] ?></h3>
            <a href="../index/index.php" role="button" class="btn btn-outline-secondary">Back to projects</a>
            <hr>

      <?php
          }
        }

      ?>
        <!--Formaulaire ajout-->
        <form action="../model/add-task.php" method="POST">

          <div class="group-control">
            <label for="name">Task name </label>
            <input class="form-control" type="text" name="name" id="name" required>
          </div>

          <div class="group-control">
            <label for="description">Task description</label>
            <textarea class="form-control" type="text" name="description" id="description" rows="3"></textarea>
          </div>

          <div class="group-control">
            <label for="priority">Priority</label>
            <select class="form-control" name="priority" id="priority" required>
                        <option value="" disabled="disabled" selected="selected">Select</option>
                        <option value="1">Urgent</option>
                        <option value="2">High</option>
                        <option value="3">Medium</option>
                        <option value="4">Low</option>
                        <option value="5">Not a priority</option>
            </select>
          </div>


          <input type="hidden" value="<?php echo $_GET['idProject']; ?>" name="id_project"><br>

          <button class="btn btn-dark align-self-center" type="submit" name="create" role="button">+ Add task</button>
        </form>
        <hr>
    </div>
    <div class="col"></div>

  </section>



<!--LISTE DE TACHES-->
  <section class="lists container">
    <div>

      <h3 align="center">Your to do list</h3>


      <?php
    $sql = 'SELECT * FROM tasklist ';
    $parameters = [];

    if(isset($_GET['idProject'])) {
      $sql .= 'WHERE id_project = ? ';
      $parameters[] = $_GET['idProject'];
    }

    $sql .= 'AND done_date IS NULL ORDER BY priority ASC';

    $tasks = $tdl->prepare($sql);
    $tasks->execute($parameters);

  ?>

             <table class="table table-dark">
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

                  <td> <a href ="interface-edit-task.php?idTask=<?php echo $donnees['id']; ?>&idProject= <?php echo $donnees['id_project']; ?>"><img src="../view/img/edit.png" width="20px"></a> </td>

                  <td> <a href ="../model/delete-task.php?idTask=<?php echo $donnees['id']; ?>&idProject= <?php echo $donnees['id_project']; ?>" onclick="return confirm('Are you sure that you want to remove this task ?')"><img src="../view/img/delete.png" width="20px"></a> </td>

                  <td> <a href ="../model/done-task.php?idTask=<?php echo $donnees['id']; ?>&idProject= <?php echo $donnees['id_project']; ?>" onclick="return confirm('Are you sure that you have accomplished this task ?')"><img src="../view/img/done.png" width="20px"></a> </td>

                </tr>

            <?php
            }

            $tasks->closeCursor();
          ?>
            </table>
    </div>



  <div class="row">
    <div class="col-3"></div>
    <div class="done col-6">
      <h4>History of tasks done</h4>

        <?php
        $sql = 'SELECT * FROM tasklist ';
        $parameters = [];
        if(isset($_GET['idProject'])) {
        $sql .= 'WHERE id_project = ? ';
        $parameters[] = $_GET['idProject'];
      }

      $sql .= 'AND done_date IS NOT NULL ORDER BY done_date DESC';

      $tasks = $tdl->prepare($sql);
      $tasks->execute($parameters);

      ?>

           <table class="table">
              <tr>
                <th>Task</th>
                <th>done on</th>
              </tr>
          <?php
          while($donnees = $tasks->fetch()) {
            ?>

              <tr>
                <td> <?php echo $donnees['name'] ?></td>
                <td> <?php echo $donnees['done_date'] ?></td>

                <td> <a href ="../model/delete-task.php?idTask=<?php echo $donnees['id']; ?>&idProject= <?php echo $donnees['id_project']; ?>" onclick="return confirm('Are you sure that you want to remove this task ?')">Delete</a> </td>

                <td> <a href ="../model/notdone-task.php?idTask=<?php echo $donnees['id']; ?>&idProject= <?php echo $donnees['id_project']; ?>" onclick="return confirm('Are you sure that you want to move this task to your to do list?')">move to my list</a> </td>

              </tr>

          <?php
          }

          $tasks->closeCursor();
        ?>
          </table>
    </div>
  </div>


  </section>

<!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- Bootstrap JavaScript -->
  <script src=“https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js”></script>

</body>
</html>
