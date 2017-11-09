<?php
require '../model/model.php'; //Fichier model (fonctions du site)

addMember(); //Ajout de membre (model.php)

include '../view/header.php'; //Head et Header

require '../view/register.php'; //Connexion view: register
