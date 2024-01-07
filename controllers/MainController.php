<?php

namespace controllers;
require_once("views/View.php");
require_once("model/PokemonManager.php");

use model\PokemonManager;
use views\View;

/**
 * Class MainController
 * Controleur principal
 */
class MainController
{
    public function Index() : void {
        // création du manager de Pokemon
        $pokManager = new PokemonManager();
        // récupère la liste des Pokemon
        $allPok = $pokManager->getAll();

        $indexView = new View('Index');
        $indexView->generer(['listPokemon' => $allPok]);

    }

}