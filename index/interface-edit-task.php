<?php
session_start();

require '../model/session_start_head.php'; //session_start et récupération de données utilisateur membre

require '../model/model.php'; //Fichier model (fonctions du site)

include '../view/header.php'; //Head et Header

editTask(); //Modif tache (model.php)

require '../view/interface-edit-task.php'; //Connexion view: interface edit task

