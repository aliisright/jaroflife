<?php
session_start();

require '../connection-db/connexion-bdd.php';

$sql = 'DELETE FROM taskList WHERE id = ?'

if(isset($_GET['idTask'])) {

  $pdo_statement = $tdl->prepare($sql);

  $tasksDel->execute(array($_GET['idTask']));

}

header('Location: ../index/interface-tasks.php?idProject=' . $_GET['idProject']);

?>
