<!DOCTYPE html>
<html>
<head>
  <title>ToDoList Project</title>
  <meta charset="utf-8">
<!-- Responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<!-- My stylesheet -->
  <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>

<!--CONNEXION A LA BASE DE DONNEES-->
  <?php
  include 'connexion-bdd.php';
  ?>

<!--HEADER ET LOGO-->
  <div class="header">
    <header class="logo">

        <h1>tdl</h1>
        <img src="img/logo_simplon.png" height="50px">

    </header>
    <hr>
  <!--FORM AJOUT DE PROJET-->
    <section class="add-form container-fluid row">
      <div class="col-md-4"></div>

      <form class="form-zone col-md-4" action="add-project.php" method="POST">

          <div class="form-group">
            <label for="name">Project name</label>
            <input class="form-control" type="text" name="name" id="name">
          </div>

          <div class="form-group">
            <label for="description">Project description</label>
            <textarea class="form-control type="text" name="description" id="description" rows="4"></textarea>
          </div>

          <div class="form-group">
            <button class="btn btn-dark" type="submit" name="create">Add project</button>
          </div>

      </form>

      <div class="col-md-4"></div>
    </section>
  </div>

<!--LISTE DE PROJETS-->
  <section class="browse container">

    <?php //RECUPERATION DES DONNEES ET LES AFFICHER AVEC WHILE
      $projects = $tdl->query('SELECT * FROM projectslist ORDER BY date_creation DESC');

      while($donnees = $projects->fetch()) {
    ?>
        <div class="project-section">
          <!--TITRE DU PROJET ET LES OUTILS DE MODIF-->
          <div class="title-tools row">
            <div class="title col-md-6"> <!--nom de projet-->
              <a href="interface-tasks.php?idProject= <?php echo $donnees['id'] ?>"><?php echo $donnees['name']; ?></a>
            </div>
            <div class="tools col-md-6"> <!--les outils / modifier et supprimer-->
              <p><a href ="interface-edit-project.php?idProject= <?php echo $donnees['id']; ?>"><img src="img/edit.png" width="20px"></a></p>

              <p><a href ="delete-project.php?idProject= <?php echo $donnees['id'] ?>" onclick="return confirm('Are you sure that you want to delete this project ?')"><img src="img/delete.png" width="20px"></a></p>

            </div>
          </div>

          <!--DESCRIPTION DU PROJET / DATE DE CREATION ET DE LA DERNIERE MODIF-->
          <article class="dates-description row">

            <div class="dates col-md-12">
              <p><span class="badge badge-dark">Added on: <?php echo $donnees['date_creation']; ?></span>   <span class="badge badge-dark">Last edit: <?php $donnees['date_last_modification']; ?></span></p>
            </div>

            <article class="description col-md-12">
              <p class="description"><?php echo $donnees['description']; ?></p>
            </article>

          </article>

        </div>

    <?php //PHP TERMINE
      }
      $projects->closeCursor();
    ?>

  </section>

<!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- Bootstrap JavaScript -->
  <script src=“https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js”></script>
</body>
</html>
