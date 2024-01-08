<?php

namespace controllers;

require_once("views/View.php");
require_once("model/PokemonManager.php");

use views\View;
use model\PokemonManager;

/**
 * Class PokemonController
 * Contrôleur pour l'affichage du formulaire d'ajout de Pokémon
 */
class PokemonController
{
    /**
     * Affiche la page d'ajout de pokémon
     * @return void
     */
    public function displayAddPokemon(): void
    {
        $addPokemonView = new View('AddPokemon');
        $addPokemonView->generer([]);
    }

    /**
     * Affiche la page d'ajout de type de pokémon
     * @return void
     */
    public function displayAddType(): void
    {
        $addTypeView = new View('AddType');
        $addTypeView->generer([]);
    }

    /**
     * Affiche la page d'édition de Pokémon
     * @param array $params Paramètres à passer à la page
     * @return void
     */
    public function displayEditPokemon(array $params): void
    {
        $editPokemonView = new View('AddPokemon');
        $editPokemonView->generer(["idPokemon" => $params["idPokemon"]]);
    }

    /**
     * Supprime un Pokémon
     * @param array $params Paramètres à passer à la page
     * @return void
     */
    public function delPokemon(array $params): void
    {
        $manager = new PokemonManager();
        $pokemons = $manager->getAll();

        $delPokemonView = new View('Index');
        $delPokemonView->generer(["pokemons" => $pokemons, "message" => "Le pokémon {$params['idPokemon']} a bien été supprimé"]);
    }
}