<?php

namespace controllers;
require_once("views/View.php");

use views\View;

class MainController
{
    public function Index() : void {
        $indexView = new View('Index');
        $indexView->generer(['nomDresseur' => "Red"]);
    }

}