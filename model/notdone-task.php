<?php

require '../connection-db/connexion-bdd.php';

$tasksDel = $tdl->prepare('UPDATE taskList SET done_date = ? WHERE id = ?');

if(isset($_GET['idTask'])) {

  $tasksDel->execute(array(NULL, $_GET['idTask']));

}

header('Location: ../index/interface-tasks.php?idProject=' . $_GET['idProject']);

?>
