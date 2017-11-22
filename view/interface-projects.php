<!--Hello Member! message & Déconnexion-->
  <h3 align="center">Hello <?php echo $_SESSION['pseudo'] ?> !</h3>
  <p align="center"><a href="../model/model.php?idSignOut=true">Sign out</a></p><br>


  <!--FORM AJOUT DE PROJET-->
    <section class="add-form container-fluid row">
      <div class="col-md-4"></div>

      <form class="form-zone col-md-4" action="" method="POST">

          <div class="form-group">
            <label for="name">Project name</label>
            <input class="form-control" type="text" name="name" id="name" required>
          </div>

          <div class="form-group">
            <label for="description">Project description</label>
            <textarea class="form-control type="text" name="description" id="description" rows="4"></textarea>
          </div>

          <div class="form-group">
            <button class="btn btn-dark" type="submit" name="create">+ Add project</button>
          </div>

      </form>

      <div class="col-md-4"></div>
    </section>

<!--LISTE DE PROJETS-->
  <section class="browse container">

    <?php //RECUPERATION DE DONNEES ET LES AFFICHER AVEC WHILE
      $sql = 'SELECT * FROM projectslist WHERE id_user = ? ORDER BY date_creation DESC';
      $statement = connectionDb($sql);
      $statement->execute(array($_SESSION['id']));

      while($donnees = $statement->fetch()) {


    ?>
        <div class="list-section">
          <!--TITRE DU PROJET ET LES OUTILS DE MODIF-->
          <div class="title-tools row">
            <div class="title col-md-6"> <!--nom de projet-->
              <a href="interface-tasks.php?idProject= <?php echo $donnees['id'] ?>"><?php echo $donnees['name']; ?></a>
            </div>
            <div class="tools col-md-6"> <!--les outils / modifier et supprimer-->
              <p><a href ="interface-edit-project.php?idProject=<?php echo $donnees['id']; ?>"><img src="../view/img/edit.png" alt="edit" width="20px"></a></p>

              <p><a href ="../model/model.php?idProjectDelete=<?php echo $donnees['id'] ?>" onclick="return confirm('Are you sure that you want to delete this project ?')"><img src="../view/img/delete.png" alt="delete" width="20px"></a></p>

            </div>
          </div>

          <!--DESCRIPTION DU PROJET / DATE DE CREATION ET DE LA DERNIERE MODIF-->
          <article class="dates-description">

            <div class="dates col-md-12">
              <p><span class="badge badge-dark">Added on: <?php echo $donnees['date_creation'] ; ?></span>   <span class="badge badge-dark">Last edit: <?php echo $donnees['date_last_modification']; ?></span></p>
            </div>

            <article class="description col-md-12">
              <p><?php echo $donnees['description']; ?></p>
            </article>

          </article>

        </div>

    <?php //PHP TERMINE
      }
    ?>

  </section>

<!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- Bootstrap JavaScript -->
  <script src=“https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js”></script>
</body>
</html>
