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
     * @param string|null $message
     * @return void
     */
    public function displayAddPokemon(?string $message = null): void
    {
        $addPokemonView = new View('AddPokemon');
        $addPokemonView->generer(["message" => $message]);
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
     * @param int $idPokemon
     * @return void
     */
    public function displayEditPokemon(int $idPokemon): void
    {
        $editPokemonView = new View('AddPokemon');
        $editPokemonView->generer(["idPokemon" => $idPokemon]);
    }

    /**
     * Supprime un Pokémon
     * @param int $idPokemon
     * @return void
     */
    public function delPokemon(int $idPokemon): void
    {
        $manager = new PokemonManager();
        $pokemons = $manager->getAll();

        $delPokemonView = new View('Index');
        $delPokemonView->generer(["pokemons" => $pokemons, "message" => "Le pokémon {$idPokemon} a bien été supprimé"]);
    }
}