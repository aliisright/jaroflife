<?php

include 'connexion-bdd.php';

$projets = $tdl->prepare('INSERT INTO projectslist (name, description) VALUES (?, ?)');
$projets->execute(array($_POST['name'], $_POST['description']));


header('Location: interface.php');

?>
