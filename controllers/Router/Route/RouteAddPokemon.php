<?php

namespace controllers\Router\Route;

require_once('controllers/Router/Route.php');
require_once('controllers/PokemonController.php');

use controllers\Router\Route;
use controllers\PokemonController;

/**
 * Classe RouteAddPokemon
 * Route pour la page d'ajout
 */
class RouteAddPokemon extends Route
{
    private PokemonController $controller;

    public function __construct(PokemonController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    /**
     * Affiche la page d'ajout
     * @param array $params Paramètres à passer à la page
     * @return void
     */
    protected function get(array $params = [])
    {
        $this->controller->displayAddPokemon();
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     */
    protected function post(array $params = [])
    {    }
}