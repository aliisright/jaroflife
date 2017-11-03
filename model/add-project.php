<?php

require '../connection-db/connexion-bdd.php';

$projets = $tdl->prepare('INSERT INTO projectslist (name, description) VALUES (?, ?)');

if(isset($_POST['name'], $_POST['description'])) {

  $projets->execute(array($_POST['name'], $_POST['description']));

}

header('Location: ../index/index.php');

?>
