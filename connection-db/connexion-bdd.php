<?php
try {
    $tdl = new PDO('mysql:host=https://databases-auth.000webhost.com/;dbname=id908762_todolist;charset=utf8', 'id908762_alihasan', '123456', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    die('Erreur: ' . $e->getMessage());
  }
?>
