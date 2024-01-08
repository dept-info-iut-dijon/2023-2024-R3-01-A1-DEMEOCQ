<?php

namespace controllers\Router;

require_once('controllers/MainController.php');
require_once('controllers/PokemonController.php');
require_once('controllers/Router/Route/RouteAddPokemon.php');
require_once('controllers/Router/Route/RouteIndex.php');
require_once('controllers/Router/Route/RouteAddType.php');
require_once('controllers/Router/Route/RouteSearch.php');
require_once('controllers/Router/Route/RouteDelPokemon.php');
require_once('controllers/Router/Route/RouteEditPokemon.php');
require_once('controllers/Router/Route/RouteException.php');

use controllers\MainController;
use controllers\PokemonController;
use controllers\Router\Route\RouteAddPokemon;
use controllers\Router\Route\RouteIndex;
use controllers\Router\Route\RouteAddType;
use controllers\Router\Route\RouteSearch;
use controllers\Router\Route\RouteDelPokemon;
use controllers\Router\Route\RouteEditPokemon;
use controllers\Router\Route\RouteException;

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
        $this->ctrlList = [
            "main" => new MainController(),
            "pokemon" => new PokemonController()
        ];
    }

    private function CreateRouteList(): void
    {
        $this->routeList = [
            "index" => new RouteIndex($this->ctrlList["main"]),
            "add-pokemon" => new RouteAddPokemon($this->ctrlList["pokemon"]),
            "add-pokemon-type" => new RouteAddType($this->ctrlList["pokemon"]),
            "search" => new RouteSearch($this->ctrlList["main"]),
            "del-pokemon" => new RouteDelPokemon($this->ctrlList["pokemon"]),
            "edit-pokemon" => new RouteEditPokemon($this->ctrlList["pokemon"]),
            "exception" => new RouteException($this->ctrlList["main"])
        ];
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
        try {
            if ($post === []) {
                $this->routeList[$action]->action($get);
            }
            else {
                $this->routeList[$action]->action($post, 'POST');
            }
        }
        catch (\Exception $e)
        {
            http_response_code(404);
            $get["error"] = $e->getMessage();
            $this->routeList["exception"]->action($get);
        }
    }
}