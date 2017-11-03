<?php

require '../connection-db/connexion-bdd.php';

$tasks = $tdl->prepare('INSERT INTO tasklist (id_project, name, description, priority) VALUES (?, ?, ?, ?)');

if(isset($_POST['id_project'], $_POST['name'], $_POST['description'], $_POST['priority'])) {

  $tasks->execute(array($_POST['id_project'], $_POST['name'], $_POST['description'], $_POST['priority']));

}

  header('Location: ../index/interface-tasks.php?idProject='.$_POST['id_project']);

?>
