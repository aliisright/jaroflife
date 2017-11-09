<!--FORM MODIF DE PROJET-->

  <?php
    $sql = 'SELECT * FROM projectsList WHERE id = ? AND id_user = ?';

    $project = $tdl->prepare($sql);
    $project->execute(array($_GET['idProject'], $_SESSION['id']));

    while($donnees = $project->fetch()) {
      echo '<h3 align="center">Edit: ' . $donnees['name'] . '</h3><hr>';
  ?>
    <section class="add-form container-fluid row">
      <div class="col-md-4"></div>

      <form class="form-zone col-md-4" action="" method="POST">

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
            <a href="../index/interface-projects.php" role="button" class="btn btn-outline-secondary">Back to projects</a>
          </div>


      </form>

      <div class="col-md-4"></div>`

      <!--Déconnexion-->
    </section>

    <p align="center"><a href="../model/signout.php">Sign out</a></p><br>


<?php } ?>

<!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- Bootstrap JavaScript -->
  <script src=“https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js”></script>
</body>
</html>
