<?php

namespace controllers;
require_once("views/View.php");
require_once("model/PokemonManager.php");

use model\PokemonManager;
use views\View;

class MainController
{
    public function Index() : void {
        $indexView = new View('Index');
        $pokManager = new PokemonManager();
        $allPok = $pokManager->getAll();

        $indexView->generer(['nomDresseur' => "Red", 'listPokemon' => $allPok]);
    }

}