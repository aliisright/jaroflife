<?php
 require '../connection-db/connexion-bdd.php';

  if (isset($_SESSION['id'])) {
    $pdo_statement = $tdl->prepare('SELECT * FROM users WHERE id = ?');
    $pdo_statement->execute(array($_SESSION['id']));
    $userinfo = $pdo_statement->fetch();
  }
