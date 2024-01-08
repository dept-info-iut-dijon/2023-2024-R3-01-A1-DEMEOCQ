<?php

namespace controllers;
require_once("views/View.php");
require_once("model/PokemonManager.php");
require_once("model/Pokemon.php");

use model\Pokemon;
use ReflectionClass;
use ReflectionProperty;

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

    /**
     * Génère la vue de recherche de pokémon
     * @return void
     */
    public function Search(?array $params = null): void
    {
        $data = null;
        $pokemons = [];

        if($params != null)
        {
            $data = [
                'recherche' => $params['recherche'],
                'champ' => $params['champ']
            ];

            $manager = new PokemonManager();
            $pokemons = $manager->searchPokemons($params);
        }
        $champs = (new ReflectionClass(new Pokemon()))->getProperties(ReflectionProperty::IS_PRIVATE);
        $searchView = new View('Search');
        $searchView->generer([]);
        $searchView->generer(["champs" => $champs, "data" => $data, "pokemons" => $pokemons]);
    }

    public function Exception(?array $params = null): void
    {
        $notFoundView = new View('NotFound');
        $notFoundView->generer($params);
    }
}