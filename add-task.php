<?php

include 'connexion-bdd.php';


  $tasks = $tdl->prepare('INSERT INTO tasklist (id_project, name, description, priority) VALUES (?, ?, ?, ?)');
  $tasks->execute(array($_POST['id_project'], $_POST['name'], $_POST['description'], $_POST['priority']));




  header('Location: interface-tasks.php?idProject='.$_POST['id_project']);

?>
