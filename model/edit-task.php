<?php

require '../connection-db/connexion-bdd.php';

$tasksEdit = $tdl->prepare('UPDATE taskList SET name=?, description=?, priority=? WHERE id = ?');

if(isset($_POST['editName'], $_POST['editDescription'], $_POST['priority'], $_GET['idTask'])) {

  $tasksEdit->execute(array($_POST['editName'], $_POST['editDescription'], $_POST['priority'], $_GET['idTask']));

}

header('Location: ../index/interface-tasks.php?idProject=' . $_GET['idProject']);

?>
