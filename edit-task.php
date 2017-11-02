<?php

include 'connexion-bdd.php';


$tasksEdit = $tdl->prepare('UPDATE taskList SET name=?, description=?, date_last_modification=? WHERE id = ?');

$tasksEdit->execute(array($_POST['editName'], $_POST['editDescription'], date('Y-m-d H:i:s'), $_GET['idTask']));

header('Location: interface-tasks.php?idProject=' . $_GET['idProject']);

?>
