<?php
session_start();

require '../model/model.php'; //Fichier model (fonctions du site)

include '../view/header.php'; //Head et Header

addTask(); //Ajout de taches (model.php)

require '../view/interface-tasks.php'; //Connexion vue tasks

