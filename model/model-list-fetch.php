<?php
//Connexion à la base de données
require '../connection-db/connexion-bdd.php';


//Récupération données liste de projets (index.php)
function fetch_list_projets() {

  $projects = $tdl->query('SELECT * FROM projectslist ORDER BY date_creation DESC');

}



?>
