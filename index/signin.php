<?php
require '../model/model.php'; //Fichier model (fonctions du site)

signIn(); //Connexion membre (model.php)

include '../view/header.php'; //Head et Header

require '../view/signin.php'; //Connexion view: signin
