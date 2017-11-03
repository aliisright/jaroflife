<?php
try {
    $tdl = new PDO('mysql:host=localhost;dbname=todolist', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    die('Erreur: ' . $e->getMessage());
  }
?>
