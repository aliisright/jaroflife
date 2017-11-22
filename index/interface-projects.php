<?php
session_start();

require '../model/model.php'; //Fichier model (fonctions du site)

include '../view/header.php'; //Head et Header

addProject(); //Ajout de projet (model.php)

require '../view/interface-projects.php'; //Connexion vue interface (index)

