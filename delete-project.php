<?php

include 'connexion-bdd.php';


$projets_del = $tdl->prepare('DELETE FROM projectslist WHERE id = ?');
$projets_del->execute(array($_GET['idProject']));


header('Location: interface.php');

?>
