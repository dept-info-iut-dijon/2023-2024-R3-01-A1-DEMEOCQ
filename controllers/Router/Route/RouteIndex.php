<?php

namespace controllers\Router\Route;

require_once('controllers/Router/Route.php');
require_once('controllers/MainController.php');

use controllers\Router\Route;
use controllers\MainController;

/**
 * Classe RouteIndex
 * Route pour la page d'accueil
 */
class RouteIndex extends Route
{
    private MainController $controller;

    /**
     * Prépare l'affichage de la page
     * @param MainController $controller
     */
    public function __construct(MainController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    /**
     * Affiche la page d'accueil
     * @param array $params Paramètres à passer à la page
     * @return void
     */
    protected function get(array $params = []): void
    {
        $this->controller->Index();
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     */
    protected function post(array $params = []): void
    {    }
}