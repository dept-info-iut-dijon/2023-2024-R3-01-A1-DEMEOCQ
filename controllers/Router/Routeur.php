<?php

namespace controllers\Router;

require_once('controllers/MainController.php');
require_once('controllers/PokemonController.php');
require_once('controllers/Router/Route/RouteAddPokemon.php');
require_once('controllers/Router/Route/RouteIndex.php');

use controllers\MainController;
use controllers\PokemonController;
use controllers\Router\Route\RouteAddPokemon;
use controllers\Router\Route\RouteIndex;

/**
 * Classe Routeur
 * Gère le routage
 */
class Routeur
{
    private array $routeList;
    private array $ctrlList;
    private string $action_key;

    /**
     * Initialise le routeur
     * @param string $actionKeyName Nom de la clé dans le tableau GET ou POST qui contient le nom de l'action à effectuer
     */
    public function __construct(string $actionKeyName = "action")
    {
        $this->createControllerList();
        $this->createRouteList();
        $this->action_key = $actionKeyName;
    }

    private function CreateControllerList(): void
    {
        $this->ctrlList = ["main" => new MainController(), "pokemon" => new PokemonController()];
    }

    private function CreateRouteList(): void
    {
        $this->routeList = ["index" => new RouteIndex($this->ctrlList["main"]), "add-pokemon" => new RouteAddPokemon($this->ctrlList["pokemon"])];
    }

    /**
     * Exécute le routage
     * @param array $get Paramètres GET
     * @param array $post Paramètres POST
     * @return void
     */
    public function routing(array $get = [], array $post = []): void
    {
        $action = $get[$this->action_key] ?? $post[$this->action_key] ?? "index";
        if ($post === []) {
            $this->routeList[$action]->action($get);
        } else {
            $this->routeList[$action]->action($post, 'POST');
        }
    }
}