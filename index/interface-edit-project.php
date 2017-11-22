<?php
session_start();

require '../model/model.php'; //Fichier model (fonctions du site)

include '../view/header.php'; //Head et Header

editProject(); //Modif projet (model.php)

require '../view/interface-edit-project.php'; //Connexion view: interface edit project
