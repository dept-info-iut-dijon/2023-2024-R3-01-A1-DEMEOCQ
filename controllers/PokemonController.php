<?php

namespace controllers;

require_once("helpers/Message.php");
require_once("views/View.php");
require_once("model/PokemonManager.php");
require_once("model/Pokemon.php");

use helpers\Message;
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
        if($message !== null) $message = new Message($message, "Erreur", "danger");
        $addPokemonView = new View('AddPokemon');
        $addPokemonView->generer(["message" => $message]);
    }

    public function addPokemon(array $params): void
    {
        $manager = new PokemonManager();

        $pokemon = new Pokemon();
        $pokemon->hydrate($params);

        // ajout du pokémon en bdd
        $pokemon = $manager->createPokemon($pokemon);

        if ($pokemon !== false) {
            $pokemons = $manager->getAll();
            $message = new Message("Le pokémon {$pokemon->getNomEspece()} a bien été ajouté", "Succès", "success");
            $indexView = new View('Index');
            $indexView->generer(["pokemons" => $pokemons, "message" => $message]);
        }
        else {
            $this->displayAddPokemon("Le pokémon n'a pas pu être ajouté");
        }
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
        $manager = new PokemonManager();
        $pokemon = $manager->getById($idPokemon);

        if($pokemon !== null) {
            $editPokemonView = new View('AddPokemon');
            $editPokemonView->generer(["pokemon" => $pokemon]);
        }
        else
            $this->displayAddPokemon("Le pokémon {$idPokemon} n'existe pas");
    }

    /**
     * Supprime un Pokémon
     * @param int $idPokemon
     * @return void
     */
    public function delPokemon(int $idPokemon): void
    {
        $manager = new PokemonManager();
        // suppression du pokémon
        if ($manager->deletePokemon($idPokemon) > 0) {
            $message = new Message("Le pokémon {$idPokemon} a bien été supprimé", "Succès", "success");
        }
        else {
            $message = new Message("Le pokémon {$idPokemon} n'a pas pu être supprimé", "Erreur", "danger");
        }

        $pokemons = $manager->getAll();

        // affiche l'index avec le message
        $delPokemonView = new View('Index');
        $delPokemonView->generer(["pokemons" => $pokemons, "message" => $message]);
    }


    /**
     * modifie un Pokemon
     * @param array $dataPokemon
     * @return void
     */
    public function editPokemonAndIndex(array $dataPokemon): void
    {
        $manager = new PokemonManager();
        $pokemon = $manager->getById($dataPokemon['idPokemon']);

        if($pokemon !== null) {
            $manager->editPokemon($dataPokemon);
            $pokemons = $manager->getAll();
            $message = new Message("Le pokémon {$pokemon->getNomEspece()} a été mis à jour", "Pokémon modifié", "success");
            $indexView = new View('Index');
            $indexView->generer(['pokemons' => $pokemons, "msgType" => "success", "message"=> $message]);
        }
        else
            $this->displayAddPokemon("Le pokémon n'a pas pu être modifié");
    }
}