<?php
session_start();

require '../connection-db/connexion-bdd.php';

$projets_del = $tdl->prepare('DELETE FROM projectslist WHERE id = ?');

if(isset($_GET['idProject'])) {

  $projets_del->execute(array($_GET['idProject']));

}

header('Location: ../index/interface-projects.php');

  ?>
