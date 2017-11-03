<?php
  require '../connection-db/connexion-bdd.php';

  //AJOUT PROJET

  function addProject() {

    $projets = $tdl->prepare('INSERT INTO projectslist (name, description) VALUES (?, ?)');

      if(isset($_POST['name'], $_POST['description'])) {

        $projets->execute(array($_POST['name'], $_POST['description']));
        $projets->fetchAll()
      }

      header('Location: ../index/index.php');
    }



?>
