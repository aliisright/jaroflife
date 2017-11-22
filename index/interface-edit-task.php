<?php
session_start();

require '../model/model.php'; //Fichier model (fonctions du site)

include '../view/header.php'; //Head et Header

editTask(); //Modif tache (model.php)

require '../view/interface-edit-task.php'; //Connexion view: interface edit task

