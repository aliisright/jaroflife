<?php

require '../connection-db/connexion-bdd.php';

$tasksEdit = $tdl->prepare('UPDATE projectsList SET name=?, description=?, date_last_modification=? WHERE id = ?');

if(isset($_POST['editName'], $_POST['editDescription'], $_GET['idProject'])) {

  $tasksEdit->execute(array($_POST['editName'], $_POST['editDescription'], date('Y-m-d H:i:s'), $_GET['idProject']));

}

header('Location: ../index/index.php');

?>
