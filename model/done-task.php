<?php
session_start();

require '../connection-db/connexion-bdd.php';

$sql = 'UPDATE taskList SET done_date = ? WHERE id = ?';

if(isset($_GET['idTask'])) {

  $pdo_statement = $tdl->prepare($sql);

  $pdo_statement->execute(array(date('Y-m-d H:i:s'), $_GET['idTask']));

}

header('Location: ../index/interface-tasks.php?idProject=' . $_GET['idProject']);

?>
