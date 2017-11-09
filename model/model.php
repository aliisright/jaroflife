<?php

//AJOUT DE PROJETS
function addProject() {

  if(isset($_SESSION['id'], $_POST['name'], $_POST['description'])) {

    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $sessionId = $_SESSION['id'];

    require '../connection-db/connexion-bdd.php';

    $projets = $tdl->prepare('INSERT INTO projectslist (id_user, name, description) VALUES (?, ?, ?)');

    $projets->execute(array($sessionId, $name, $description));

  }
}

//MODIFICATION DE PROJET (NOM ET DESCRIPTION)
function editProject() {

  if(isset($_POST['create'])) {

    if(isset($_SESSION['id'], $_POST['editName'], $_POST['editDescription'], $_GET['idProject'])) {

      $editName = htmlspecialchars($_POST['editName']);
      $editDescription = htmlspecialchars($_POST['editDescription']);
      $getIdProject = htmlspecialchars($_GET['idProject']);
      $sessionId = $_SESSION['id'];

      require '../connection-db/connexion-bdd.php';

      $tasksEdit = $tdl->prepare('UPDATE projectsList SET name=?, description=?, date_last_modification=? WHERE id = ?');

      $tasksEdit->execute(array($editName, $editDescription, date('Y-m-d H:i:s'), $getIdProject));

    }

    echo "<p align=\"center\" style=\"color: green\">changes saved</p>";

  }

}

//AJOUT DE TACHES
function addTask() {

  if(isset($_SESSION['id'], $_POST['id_project'], $_POST['name'], $_POST['description'], $_POST['priority'])) {

    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $priority = htmlspecialchars($_POST['priority']);
    $postIdProject = $_POST['id_project'];
    $sessionId = $_SESSION['id'];

    require '../connection-db/connexion-bdd.php';

    $tasks = $tdl->prepare('INSERT INTO tasklist (id_project, id_user, name, description, priority) VALUES (?, ?, ?, ?, ?)');

    $tasks->execute(array($postIdProject, $sessionId, $name, $description, $priority));

  }

}

//MODIFICATION DE TACHE (NOM, DESCRIPTION ET PRIORITE)
function editTask() {

  if(isset($_POST['create'])) {

    if(isset($_SESSION['id'], $_POST['editName'], $_POST['editDescription'], $_POST['editPriority'], $_GET['idTask'])) {

      $editName = htmlspecialchars($_POST['editName']);
      $editDescription = htmlspecialchars($_POST['editDescription']);
      $editPriority = $_POST['editPriority'];
      $getIdTask = htmlspecialchars($_GET['idTask']);
      $sessionId = $_SESSION['id'];

      require '../connection-db/connexion-bdd.php';

      $tasksEdit = $tdl->prepare('UPDATE taskList SET name=?, description=?, priority=? WHERE id = ?');

      $tasksEdit->execute(array($_POST['editName'], $_POST['editDescription'], $_POST['priority'], $_GET['idTask']));

    }

    echo "<p align=\"center\" style=\"color: green\">changes saved</p>";

  }

}

//INSCRIPTION NOUVEAU MEMBRE
function addMember() {
  require '../connection-db/connexion-bdd.php';

  if (isset($_POST['submit'])) {


    $pseudo = htmlspecialchars(strtolower($_POST['pseudo']));
    $email = htmlspecialchars(strtolower($_POST['email']));
    $email2 = htmlspecialchars(strtolower($_POST['email2']));
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

    if (isset($pseudo, $email, $email2, $mdp, $mdp2)) {

      $pseudolength = strlen($pseudo);

      if ($pseudolength <= 15) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

          if ($email == $email2) {

            $mdplength = strlen($_POST['mdp']);

            if ($mdplength >= 6) {

              if ($mdp == $mdp2) {

                $reqmail = $tdl->prepare('SELECT * FROM users WHERE email = ?');
                $reqmail->execute(array($email));
                $mailexist = $reqmail->rowCount();

                if ($mailexist == 0) {

                  $reqpseudo = $tdl->prepare('SELECT * FROM users WHERE pseudo = ?');
                  $reqpseudo->execute(array($pseudo));
                  $pseudoexist = $reqpseudo->rowCount();

                  if ($pseudoexist == 0) {

                    $pdo_statement = $tdl->prepare('INSERT INTO users (pseudo, password, email) VALUES (?, ?, ?)');
                    $pdo_statement->execute(array($pseudo, $mdp, $email));
                    $formMessage = "<h6 align =\"center\" style=\"color: green\">Successfully registered! Sign in and build your first To Do List!</h6>";

                  } else {
                    $formMessage = "This nickname is already taken!";
                  }


                } else {
                  $formMessage = "This email address is already used. If you're already member, sign in!";
                }

              } else {
                $formMessage = "Your 2 password entries don't match!";
              }

            } else {
              $formMessage = "Your password must have at least 6 characters!";
            }

          } else {
            $formMessage = "Your email address entries don't match!";
          }

         } else {
         $formMessage = "Please, enter a valid email address!";
       }

      } else {
        $formMessage = "Your nickname can't have more than 15 characters!";
      }

    } else {
      $formMessage = "All fields must me filled!";
    }
    header('location: ../index/register.php?message=' . $formMessage);
  }

}

//CONNEXION MEMBRE
function signIn() {

  session_start();

  require '../connection-db/connexion-bdd.php';

  if (isset($_POST['submit'])) {

    $email = htmlspecialchars(strtolower($_POST['email']));
    $mdp = sha1($_POST['mdp']);

    if (isset($email, $mdp)) {

      $pdo_statement = $tdl->prepare('SELECT * FROM users WHERE email = ? AND password =  ?');
      $pdo_statement->execute(array($email, $mdp));
      $userexist = $pdo_statement->rowCount();

      if ($userexist == 1) {

        $userData = $pdo_statement->fetch();
        $_SESSION['id'] = $userData['id'];
        $_SESSION['pseudo'] = $userData['pseudo'];
        $_SESSION['email'] = $userData['email'];

        header('location: interface-projects.php?');

      } else {

        $formMessage = "wrong email or password!";
        header('location: signin.php?message=' . $formMessage);

        }

    }
  }

}


