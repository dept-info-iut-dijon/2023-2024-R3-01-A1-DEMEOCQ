<?php

require_once ("controllers\Router\Routeur.php");

use controllers\Router\Routeur;

// Routeur
$routeur = new Routeur();
$routeur->routing($_GET, $_POST);
