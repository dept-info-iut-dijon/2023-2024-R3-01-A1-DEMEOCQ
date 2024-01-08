<?php

namespace controllers;

require_once("views/View.php");

use views\View;

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
}