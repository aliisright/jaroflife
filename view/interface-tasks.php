<!--AJOUT TACHE-->
  <section class="form-task container-fluid row">
    <div class="col"></div>
    <div class="col">
      <?php

        $getIdProject = $_GET['idProject'];
        $sessionId = $_SESSION['id'];

        $sql = 'SELECT * FROM projectsList WHERE id = ? AND id_user = ?';

        if(isset($getIdProject, $sessionId)) {

          $statement = connectionDb($sql);
          $statement->execute(array($getIdProject, $sessionId));

        }

          while($donnees = $statement->fetch() ) {
      ?>
            <!--Nom de projet-->
            <h3 align="center"><?php echo $donnees['name'] . ' | N°: ' . $donnees['id'] ?></h3>
            <a href="../index/interface-projects.php" role="button" class="btn btn-outline-secondary">Back to projects</a>
            <hr>

      <?php
          }

      ?>

        <form action="" method="POST"> <!--Formaulaire ajout-->

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
          $sql = 'SELECT * FROM tasklist WHERE id_project = ? AND id_user = ? AND done_date IS NULL ORDER BY priority ASC';

          if(isset($getIdProject, $sessionId)) {

            $statement = connectionDb($sql);
            $statement->execute(array($getIdProject, $sessionId));

          }
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
          while($donnees = $statement->fetch()) {
          ?>

          <tr>
            <td> <?php echo $donnees['name'] ?></td>
            <td> <?php echo $donnees['description'] ?></td>
            <td> <?php echo $donnees['date_creation'] ?></td>
            <td> <?php echo $donnees['date_last_modification'] ?></td>
            <td> <?php echo $donnees['priority'] ?></td>

            <td> <a href ="interface-edit-task.php?idTask=<?php echo $donnees['id']; ?>&idProject=<?php echo $donnees['id_project']; ?>"><img src="../view/img/edit.png" alt="edit" width="20px"></a></td>

            <td> <a href ="../model/model.php?idTaskDelete=<?php echo $donnees['id']; ?>&idProject=<?php echo $donnees['id_project']; ?>" onclick="return confirm('Are you sure that you want to remove this task ?')"><img src="../view/img/delete.png" alt="delete" width="20px"></a> </td>

            <td> <a href ="../model/model.php?idTaskDone=<?php echo $donnees['id']; ?>&idProject=<?php echo $donnees['id_project']; ?>" onclick="return confirm('Are you sure that you have accomplished this task ?')"><img src="../view/img/done.png" alt="done" width="20px"></a> </td>

          </tr>

          <?php
          }
          ?>

      </table>

    </div>


<!--HISTORIQUE DE TACHES REALISEES-->
    <div class="row">
      <div class="col-3"></div>
      <div class="done col-6">
        <h4>History of tasks done</h4>

        <?php

          $sql = 'SELECT * FROM tasklist WHERE id_project = ? AND id_user = ? AND done_date IS NOT NULL ORDER BY done_date DESC';

          if(isset($getIdProject, $sessionId)) {

            $statement = connectionDb($sql);
            $statement->execute(array($getIdProject, $sessionId));

          }

        ?>

        <table class="table">
            <tr>
              <th>Task</th>
              <th>done on</th>
            </tr>

            <?php
            while($donnees = $statement->fetch()) {
            ?>

            <tr>
              <td> <?php echo $donnees['name'] ?></td>
              <td> <?php echo $donnees['done_date'] ?></td>

              <td> <a href ="../model/model.php?idTaskDelete=<?php echo $donnees['id']; ?>&idProject= <?php echo $donnees['id_project']; ?>" onclick="return confirm('Are you sure that you want to remove this task ?')">Delete</a> </td>

              <td> <a href ="../model/model.php?idTaskNotDone=<?php echo $donnees['id']; ?>&idProject= <?php echo $donnees['id_project']; ?>" onclick="return confirm('Are you sure that you want to move this task to your to do list?')">move to my list</a> </td>

            </tr>

            <?php
             }
            ?>

        </table>

      </div>
    </div>

  <!--Déconnexion-->
  <p align="right"><a href="../model/model.php?idSignOut=true">Sign out</a></p><br>
  </section>


<!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- Bootstrap JavaScript -->
  <script src=“https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js”></script>

</body>
</html>
