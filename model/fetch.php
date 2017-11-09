<?php
function fetchProjects($sql) {

  require '../connection-db/connexion-bdd.php';

  $projects = $tdl->prepare('SELECT * FROM projectslist WHERE id_user = ? ORDER BY date_creation DESC');
  $projects->execute(array($userinfo['id']));

}

function fetchTasks() {

  require '../connection-db/connexion-bdd.php';

  if(isset($_GET['idProject'], $_SESSION['id'])) {

    $getIdProject = $_GET['idProject'];
    $sessionId = $_SESSION['id'];
    $sql = 'SELECT * FROM projectsList WHERE id = ? AND id_user = ?';

    $pdo_statement = $tdl->prepare($sql);
    $pdo_statement->execute(array($getIdProject, $sessionId));

  }
}

function fetchTasksDone($sql) {



}


