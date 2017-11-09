<?php
session_start();

require '../model/session_start_head.php'; //session_start et récupération de données utilisateur membre

require '../model/model.php'; //Fichier model (fonctions du site)

include '../view/header.php'; //Head et Header

addProject(); //Ajout de projet (model.php)

require '../view/interface-projects.php'; //Connexion vue interface (index)

