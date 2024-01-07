<?php

namespace model;
require_once("model/DAO/DAO.php");

use model\DAO\DAO;
use Exception;
use PDO;
use PDOException;
use PDOStatement;

/**
 * Classe abstraite Model
 * Model général
 */
abstract class Model
{
    /**
     * Définit le DAO utilisé par le model
     * @return PDO le PDO utilisé par le DAO
     */
    private function getDAO():PDO
    {
        return DAO::getDB();
    }

    /**
     * @param string $sql requête SQL à exécuter
     * @param array|null $params Paramètres de la requête
     * @return PDOStatement|false Résultat de la requête
     */
    protected function execRequest(string $sql, array $params = null) : PDOStatement|false
    {
        $res = false;

        if ($params === null) {
            $res = $this->getDAO()->query($sql); // requête sans paramètre
        }
        else {
            $res = $this->getDAO()->prepare($sql); // requête préparée avec des paramètres
            $res->execute($params);
        }

        return $res;
    }


}