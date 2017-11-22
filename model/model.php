<?php
//Connexion Base de données
function connectionDb($sql) {

  require '../configDb/config.php';

  try {

    $tdl = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $statement = $tdl->prepare($sql);

  } catch (Exception $e) {
    die('Erreur: ' . $e->getMessage());
  }
  return $statement;
}

//AJOUT DE PROJETS
function addProject() {

  if(isset($_SESSION['id'], $_POST['name'], $_POST['description'])) {

    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $sessionId = $_SESSION['id'];

    $sql = 'INSERT INTO projectslist (id_user, name, description) VALUES (?, ?, ?)';

    $statement = connectionDb($sql);

    $statement->execute(array($sessionId, $name, $description));

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

      $sql = 'UPDATE projectsList SET name=?, description=?, date_last_modification=? WHERE id = ?';

      $statement = connectionDb($sql);

      $statement->execute(array($editName, $editDescription, date('Y-m-d H:i:s'), $getIdProject));

    }

    echo "<p align=\"center\" style=\"color: green\">changes saved</p>";

  }

}

//SUPPRESSION DE PROJETS
function deleteProject() {

  session_start();

  $sql = 'DELETE FROM projectslist WHERE id = ?';

  if(isset($_GET['idProjectDelete'])) {

    $idProjectDelete = $_GET['idProjectDelete'];

    $statement = connectionDb($sql);

    $statement->execute(array($idProjectDelete));

  }

  header('Location: ../index/interface-projects.php');

  }

  if (isset($_GET['idProjectDelete'])) {

    deleteProject();

  }

//AJOUT DE TACHES
function addTask() {

  if(isset($_SESSION['id'], $_POST['id_project'], $_POST['name'], $_POST['description'], $_POST['priority'])) {

    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $priority = htmlspecialchars($_POST['priority']);
    $postIdProject = $_POST['id_project'];
    $sessionId = $_SESSION['id'];

    $sql = 'INSERT INTO tasklist (id_project, id_user, name, description, priority) VALUES (?, ?, ?, ?, ?)';

    $statement = connectionDb($sql);

    $statement->execute(array($postIdProject, $sessionId, $name, $description, $priority));

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

      $sql = 'UPDATE taskList SET name=?, description=?, priority=? WHERE id = ?';

      $statement = connectionDb($sql);

      $statement->execute(array($editName, $editDescription, $editPriority, $getIdTask));

    }

    echo "<p align=\"center\" style=\"color: green\">changes saved</p>";

  }

}

//SUPPRESSION DE TACHES
function deleteTask() {

  session_start();

  //require '../connection-db/connexion-bdd.php';

  $sql = 'DELETE FROM taskList WHERE id = ?';

  if(isset($_GET['idTaskDelete'], $_GET['idProject'])) {

    $idTaskDelete = htmlspecialchars($_GET['idTaskDelete']);
    $idProject = htmlspecialchars($_GET['idProject']);

    $statement = connectionDb($sql);

    $statement->execute(array($idTaskDelete));

  }

  header('Location: ../index/interface-tasks.php?idProject=' . $idProject);

  }

  if (isset($_GET['idTaskDelete'])) {

    deleteTask();

  }

//TACHES REALISEES
function taskDone() {

  session_start();

  $sql = 'UPDATE taskList SET done_date = ? WHERE id = ?';

  if(isset($_GET['idTaskDone'], $_GET['idProject'])) {

    $idTaskDone = htmlspecialchars($_GET['idTaskDone']);
    $idProject = htmlspecialchars($_GET['idProject']);

    $statement = connectionDb($sql);

    $statement->execute(array(date('Y-m-d H:i:s'), $idTaskDone));

  }

  header('Location: ../index/interface-tasks.php?idProject=' . $idProject);

  }

  if (isset($_GET['idTaskDone'])) {

      taskDone();

  }

//TACHES PAS REALISEES (REPLACER LA TACHE DANS LA TO DO LIST)
function taskNotDone() {

  session_start();

  $sql = 'UPDATE taskList SET done_date = ? WHERE id = ?';

  if(isset($_GET['idTaskNotDone'], $_GET['idProject'])) {

    $idTaskNotDone = htmlspecialchars($_GET['idTaskNotDone']);
    $idProject = htmlspecialchars($_GET['idProject']);

    $statement = connectionDb($sql);

    $statement->execute(array(NULL, $idTaskNotDone));

  }

  header('Location: ../index/interface-tasks.php?idProject=' . $idProject);

  }

  if (isset($_GET['idTaskNotDone'])) {

      taskNotDone();

  }

//INSCRIPTION NOUVEAU MEMBRE
function addMember() {

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
                $sql = 'SELECT * FROM users WHERE email = ?';

                $reqmail = connectionDb($sql);
                $reqmail->execute(array($email));
                $mailexist = $reqmail->rowCount();

                if ($mailexist == 0) {

                  $sql = 'SELECT * FROM users WHERE pseudo = ?';

                  $reqpseudo = connectionDb($sql);
                  $reqpseudo->execute(array($pseudo));
                  $pseudoexist = $reqpseudo->rowCount();

                  if ($pseudoexist == 0) {

                    $sql = 'INSERT INTO users (pseudo, password, email) VALUES (?, ?, ?)';

                    $statement = connectionDb($sql);

                    $statement->execute(array($pseudo, $mdp, $email));

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

  if (isset($_POST['submit'])) {

    $email = htmlspecialchars(strtolower($_POST['email']));
    $mdp = sha1($_POST['mdp']);

    if (isset($email, $mdp)) {

      $sql = 'SELECT * FROM users WHERE email = ? AND password =  ?';

      $statement = connectionDb($sql);
      $statement->execute(array($email, $mdp));
      $userexist = $statement->rowCount();

      if ($userexist == 1) {

        $userData = $statement->fetch();
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

//DECONNEXION MEMBRE
function signOut() {

  session_start();

  $_SESSION = array();

  session_destroy();

  header('location: ../index/signin.php');

  }

  if (isset($_GET['idSignOut'])) {

        signOut();

  }



