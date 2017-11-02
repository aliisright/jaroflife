<?php

include 'connexion-bdd.php';


$tasksDel = $tdl->prepare('DELETE FROM taskList WHERE id = ?');
$tasksDel->execute(array($_GET['idTask']));

header('Location: interface-tasks.php?idProject=' . $_GET['idProject']);

?>
