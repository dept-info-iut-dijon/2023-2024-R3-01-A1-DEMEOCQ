<?php

namespace controllers;

require_once("views/View.php");
require_once("model/PokemonManager.php");
require_once("model/Pokemon.php");

use views\View;
use model\PokemonManager;
use model\Pokemon;

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

    public function addPokemon(array $params): void
    {
        // création du manager de pokémons
        $manager = new PokemonManager();

        // création d'un pokémon
        $pokemon = new Pokemon();
        $pokemon->hydrate($params);

        // ajout du pokémon en bdd
        $pokemon = $manager->createPokemon($pokemon);

        $msgType = ($pokemon !== false) ? "success" : "danger";
        $msg = ($pokemon !== false) ? "Le pokémon {$pokemon->getNomEspece()} a bien été ajouté" : "Le pokémon n'a pas pu être ajouté";

        $pokemons = $manager->getAll();

        // affichage de l'index
        $indexView = new View('Index');
        $indexView->generer(["pokemons" => $pokemons, "msgType" => $msgType, "message" => $msg]);
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
        $delPokemonView->generer(["pokemons" => $pokemons, "msgType" => "success", "message" => "Le pokémon {$idPokemon} a bien été supprimé"]);
    }
}